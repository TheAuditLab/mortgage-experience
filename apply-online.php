<?php
//error_reporting(-1);
//ini_set('display_errors', 'On');

/* Template Name: Apply Online */
get_header();

require get_stylesheet_directory() . "/models/My360Lead.php";

Mk_Static_Files::addAssets('mk_button');
Mk_Static_Files::addAssets('mk_audio');
Mk_Static_Files::addAssets('mk_swipe_slideshow');

mk_build_main_wrapper(mk_get_view('singular', 'wp-page', true));

$firstname = filter_input(INPUT_POST, "first-name");
$surname = filter_input(INPUT_POST, "surname");
$address1 = filter_input(INPUT_POST, "address");
$postcode = filter_input(INPUT_POST, "postcode");
$employment = filter_input(INPUT_POST, "employment");
$income = filter_input(INPUT_POST, "income");
$email = filter_input(INPUT_POST, "your-email");
$mobile = filter_input(INPUT_POST, "mobile");
$telephone = filter_input(INPUT_POST, "telephone");
$purchase = filter_input(INPUT_POST, "purchase");
$required = filter_input(INPUT_POST, "required");
$rempurchase = filter_input(INPUT_POST, "rempurchase");
$remrequired = filter_input(INPUT_POST, "remrequired");
$residential = filter_input(INPUT_POST, "residential");
$creditstatus = filter_input(INPUT_POST, "creditstatus");
$consent = filter_input(INPUT_POST, "consent") == "" ? "Y" : "N";

if ($_POST) {
//API Stuff
    $url = "https://services.360lifecycle.co.uk/LeadService.svc?singlewsdl";

    try {
        $service = new SoapClient($url, array(
            'trace' => 1,
            'exception' => 0,
            'classmap' => array(
                'Lead' => 'My360Lead',
                'Address' => 'My360Address',
                'Auth' => 'My360Auth',
                'Client' => 'My360Client',
                'Contact' => 'My360Contact',
                'Opportunity' => 'My360Opportunity',
                'Appointment' => 'My360Appointment',
                'Ping' => 'My360Ping',
                'PingResponse' => 'My360PingResponse',
                'SaveLead' => 'My360SaveLead',
                'SaveLeadResponse' => 'My360SaveLeadResponse'
            ),
            'style' => SOAP_DOCUMENT,
            'use' => SOAP_LITERAL
        ));

        $lead = new My360Lead();



        if ($firstname != "" && $surname != "" && $address1 != "" && $postcode != "" && $telephone != "" && $mobile != "" && $email != "" && $income != "") {
            //Get Contact Form 7 metadata
            global $wpdb;
            $email1 = $wpdb->get_results( "SELECT meta_value FROM wpwq_postmeta where post_id = 141 and meta_key = '_mail'" );
            $emaildetails1 = unserialize($email1[0]->meta_value);
            $to = $emaildetails1["recipient"];
            $from = str_replace("[surname]",$surname,str_replace("[first-name]",$firstname,$emaildetails1["sender"]));
            $subject = $emaildetails1["subject"];
            $headers = "From: $from" . "\r\n" .
                "Reply-To: $email" . "\r\n" .
                "X-Mailer: PHP/" . phpversion();
            $eol = PHP_EOL;
            $message = "From: $firstname $surname <$email>$eol
                    Subject: $subject$eol
                    $eol
                    First Name: $firstname$eol
                    Surname: $surname$eol
                    Address: $address1$eol
                    Postcode: $postcode$eol
                    Telephone: $telephone$eol
                    Mobile: $mobile$eol
                    Email: $email$eol
                    Employment: $employment$eol
                    Monthly Income: $income$eol
                    Residential Status: $residential$eol
                    Credit Status: $creditstatus$eol
                    Purchase Price of Property: $purchase$eol
                    Loan Required: $required$eol
                    Remortage Property Value: $rempurchase$eol
                    Loan Required for remortgage: $remrequired$eol
                    Opt out of marketing? $consent$eol
                    $eol
                    -- $eol
                    This e-mail was sent from a contact form on Mortgage Exchange (http://digital-glue.co.uk/mort)";

            $emailsent = mail($to, $subject, $message, $headers);


            //Get Contact Form 7 metadata
            global $wpdb;
            $email2 = $wpdb->get_results( "SELECT meta_value FROM wpwq_postmeta where post_id = 141 and meta_key = '_mail_2'" );
            $emaildetails2 = unserialize($email2[0]->meta_value);
            $to2 = $email;
            $from2 = $emaildetails2["sender"];
            $subject2 = $emaildetails2["subject"];
            $headers2 = "From: $from2" . "\r\n" .
                $emaildetails2["additional_headers"] . "\r\n" .
                "X-Mailer: PHP/" . phpversion();

            $message2 = "Hi $firstname,$eol
                        $eol
                        Thank you for your application.  We are currently reviewing your details and one of our mortgage advisers will be in touch shortly to discuss your options.$eol
                         $eol
                        Kind regards$eol
                        $eol
                        Mortgage Experience";

            $emailsent2 = mail($to2, $subject2, $message2, $headers2);

            $notes = new My360Note();
            $notes->From = "Central Hotbox";
            $notes->Text = "Property Purchase Price: " . $purchase . PHP_EOL;
            $notes->Text .= "Purchase Loan Required: " . $required . PHP_EOL;
            $notes->Text .= "Remortgage Property Value: " . $rempurchase . PHP_EOL;
            $notes->Text .= "Remortgage Loan Required: " . $remrequired . PHP_EOL;
            $notes->Text .= "Residential Status: $residential$eol";
            $notes->Text .= "Employment Status: $employment$eol";
            $notes->Text .= "Credit Status: $creditstatus$eol";
            $notes->Text .= "Opt out of marketing? $consent$eol";

            //SetAddress
            $lead->Address = new My360Address();
            $lead->Address->AddressLine1 = $address1;
            $lead->Address->AddressLine2 = "";
            $lead->Address->Town = "";
            $lead->Address->County = "";
            $lead->Address->Postcode = $postcode;
            $lead->Address->MailingName = $firstname . " " . $surname;
            $lead->Address->Salutation = "";

            //SetAuth
            $lead->Auth = new My360Auth();
            $lead->Auth->Key = "A4E3ACCB-0D77-4689-ACBA-0730EF704FAA";

            //SetClients
            //Assumingtheresonlyoneclient:
            $client = new My360Client();
            $client->DateOfBirth = date("c", time());
            $client->Dependants = 0;
            //Temporarily set to Unknown - change once fixed
            $client->EmploymentStatus = "Unknown";//$employment;
            $client->Title = "";
            $client->Forename = $firstname;
            $client->Surname = $surname;
            $client->Gender = "";
            $client->Income = $income;
            $client->Occupation = "";
            $client->Smoker = FALSE;

            $client->Contact = new My360Contact();
            $client->Contact->Email = $email;
            $client->Contact->Home = $telephone;
            $client->Contact->Mobile = $mobile;

            $lead->Clients = array($client);

            $lead->Notes = array($notes);

            //Set Opportunity
            $lead->Opportunity = new My360Opportunity();
            $lead->Opportunity->Advisor = "Central Hotbox";
            $lead->Opportunity->Introducer = null;
            $lead->Opportunity->LeadSource = "Website";
            $lead->Opportunity->LeadType = "Other";

            $My360SaveLead = new My360SaveLead();
            $My360SaveLead->value = $lead;

            $response = $service->SaveLead($My360SaveLead);
            $messagecolour = "green";
            $message = "Thank you for your application. We will be in touch soon.";
            if (isset($response)){
                $logfile = "/var/www/vhosts/mortgage-experience.com/httpdocs/wp-content/themes/jupiter-child/logs/api.log";
                file_put_contents($logfile, "Apply Online: " . $response->SaveLeadResult . "\r\n", FILE_APPEND);
            }
        } else {
            $messagecolour = "amber";
            $message = "Please fill in all required fields (marked with a *).";
        }
    } catch (SoapFault$exception) {
        //echo $exception->getMessage();
        $messagecolour = "red";
        $message = "Your application has failed. Please try again.<!--".$exception->getMessage()."-->";
    }
}

?>
    <style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1499873374221{padding-top: 25px !important;}.vc_custom_1499869394389{padding-right: 0px !important;padding-left: 0px !important;background-color: #bdeefc !important;}</style><noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript><style id='dynamic-theme-options-css' type='text/css'> /* 1555442980 */ .mk-single-content p{ font-size:px; line-height:em; font-weight:400; } .mk-single-content h1 { } .mk-single-content h2 { } .mk-single-content h3 { } .mk-single-content h4 { } .mk-single-content h5 { } .mk-single-content h6 { } .mk-blog-single .blog-single-title, .mk-blog-hero .content-holder .the-title{ font-size:px !important; font-weight:600 !important; } #mk-footer .footer-wrapper{padding:30px 0} #mk-footer [class*='mk-col-'] { padding:0 2%; } #sub-footer { background-color:#43474d; } .mk-footer-copyright { font-size:11px; letter-spacing:1px; } #mk-footer .widget { margin-bottom:40px; } #mk-footer, #mk-footer p { font-size:14px; color:#808080; font-weight:400; } #mk-footer .widgettitle { text-transform:uppercase; font-size:14px; color:#fff; font-weight:bolder; } #mk-footer .widgettitle a { color:#fff; } #mk-footer .widget:not(.widget_social_networks) a { color:#999999; } #mk-footer .widget:not(.widget_social_networks) a:hover { color:#ec008c; } .mk-footer-copyright, #mk-footer-navigation li a { color:#8c8e91; } .mk-fullscreen-nav{ background-color:#444; } .mk-fullscreen-nav-logo { margin-bottom:125px; } .fullscreen-navigation-ul .menu-item a{ color:#fff; text-transform:uppercase; font-size:16px; letter-spacing:; font-weight:bolder; padding:25px 0; } .fullscreen-navigation-ul .menu-item a:hover{ background-color:#fff; color:#444; } body { font-size:16px; color:#777777; font-weight:400; line-height:1.66em; } p { font-size:18px; color:#000000; line-height:1.66em; } a { color:#2e2e2e; } a:hover { color:#ec008c; } .master-holder strong { color:#ec008c; } .master-holder h1 { font-size:36px; color:#404040; font-weight:600; text-transform:uppercase; } .master-holder h2 { font-size:30px; color:#404040; font-weight:600; text-transform:uppercase; } .master-holder h3 { font-size:24px; color:#404040; font-weight:600; text-transform:none; } .master-holder h4 { font-size:18px; color:#404040; font-weight:600; text-transform:none; } .master-holder h5 { font-size:16px; color:#404040; font-weight:600; text-transform:uppercase; } .master-holder h6 { font-size:14px; color:#404040; font-weight:600; text-transform:uppercase; } .mk-section-preloader { background-color:#fff !important; } @media handheld, only screen and (max-width:1140px) { .mk-header-bg { } .responsive-searchform .text-input { } .responsive-searchform span i { } .responsive-searchform i svg { } .responsive-searchform .text-input::-webkit-input-placeholder { } .responsive-searchform .text-input:-ms-input-placeholder { } .responsive-searchform .text-input:-moz-placeholder { } .mk-header-toolbar { } .mk-toolbar-navigation a, .mk-toolbar-navigation a:hover, .mk-language-nav > a, .mk-header-login .mk-login-link, .mk-subscribe-link, .mk-checkout-btn, .mk-header-tagline a, .header-toolbar-contact a, .mk-language-nav > a:hover, .mk-header-login .mk-login-link:hover, .mk-subscribe-link:hover, .mk-checkout-btn:hover, .mk-header-tagline a:hover { } .mk-header-tagline, .header-toolbar-contact, .mk-header-date { } .mk-header-toolbar .mk-header-social svg { } } .mk-header-toolbar { background-color:#ffffff; } .mk-toolbar-navigation a, .mk-toolbar-navigation a:hover, .mk-language-nav > a, .mk-header-login .mk-login-link, .mk-subscribe-link, .mk-checkout-btn, .mk-header-tagline a, .header-toolbar-contact a, .mk-language-nav > a:hover, .mk-header-login .mk-login-link:hover, .mk-subscribe-link:hover, .mk-checkout-btn:hover, .mk-header-tagline a:hover { color:#999999; } .mk-header-tagline, .header-toolbar-contact, .mk-header-date { color:#999999; } .mk-header-toolbar .mk-header-social svg { fill:#999999; } .add-header-height, .header-style-1 .mk-header-inner .mk-header-search, .header-style-1 .menu-hover-style-1 .main-navigation-ul > li > a, .header-style-1 .menu-hover-style-2 .main-navigation-ul > li > a, .header-style-1 .menu-hover-style-4 .main-navigation-ul > li > a, .header-style-1 .menu-hover-style-5 .main-navigation-ul > li, .header-style-1 .menu-hover-style-3 .main-navigation-ul > li, .header-style-1 .menu-hover-style-5 .main-navigation-ul > li { height:50px; line-height:50px; } .header-style-1.a-sticky .menu-hover-style-1 .main-navigation-ul > li > a, .header-style-3.a-sticky .menu-hover-style-1 .main-navigation-ul > li > a, .header-style-1.a-sticky .menu-hover-style-5 .main-navigation-ul > li, .header-style-1.a-sticky .menu-hover-style-2 .main-navigation-ul > li > a, .header-style-3.a-sticky .menu-hover-style-2 .main-navigation-ul > li > a, .header-style-1.a-sticky .menu-hover-style-4 .main-navigation-ul > li > a, .header-style-3.a-sticky .menu-hover-style-4 .main-navigation-ul > li > a, .header-style-1.a-sticky .menu-hover-style-3 .main-navigation-ul > li, .header-style-3.a-sticky .mk-header-holder .mk-header-search, .a-sticky:not(.header-style-4) .add-header-height { height:55px !important; line-height:55px !important; } .mk-header-bg { -webkit-opacity:1; -moz-opacity:1; -o-opacity:1; opacity:1; } .a-sticky .mk-header-bg { -webkit-opacity:1; -moz-opacity:1; -o-opacity:1; opacity:1; } .header-style-4 .header-logo { margin:10px 0; } .header-style-2 .mk-header-inner { line-height:50px; } .mk-header-nav-container { } .mk-header-start-tour { font-size:14px; color:#333; } .mk-header-start-tour:hover { color:#333; } .mk-search-trigger, .mk-header .mk-header-cart-count { color:#444444; } .mk-toolbar-resposnive-icon svg, .mk-header .mk-shoping-cart-link svg{ fill:#444444; } .mk-css-icon-close div, .mk-css-icon-menu div { background-color:#444444; } .mk-header-searchform .text-input { color:#c7c7c7; } .mk-header-searchform span i { color:#c7c7c7; } .mk-header-searchform .text-input::-webkit-input-placeholder { color:#c7c7c7; } .mk-header-searchform .text-input:-ms-input-placeholder { color:#c7c7c7; } .mk-header-searchform .text-input:-moz-placeholder { color:#c7c7c7; } .mk-header-social.header-section a.small { margin-top:8px; } .mk-header-social.header-section a.medium { margin-top:0px; } .mk-header-social.header-section a.large { margin-top:-8px; } .a-sticky .mk-header-social.header-section a.small, .a-sticky .mk-header-social.header-section a.medium, .a-sticky .mk-header-social.header-section a.large { margin-top:10.5px; line-height:16px !important; height:16px !important; width:16px !important; padding:8px !important; } .a-sticky .mk-header-social.header-section a.small svg, .a-sticky .mk-header-social.header-section a.medium svg, .a-sticky .mk-header-social.header-section a.large svg { line-height:16px !important; height:16px !important; } .header-section.mk-header-social svg { fill:#999999; } .header-section.mk-header-social a:hover svg { fill:#ccc; } .header-style-4 { text-align :left } .mk-header-inner, .a-sticky .mk-header-inner, .header-style-2.a-sticky .mk-classic-nav-bg { border-bottom:1px solid #ededed; } .header-style-4.header-align-left .mk-header-inner, .header-style-4.header-align-center .mk-header-inner { border-bottom:none; border-right:1px solid #ededed; } .header-style-4.header-align-right .mk-header-inner { border-bottom:none; border-left:1px solid #ededed; } .header-style-2 .mk-header-nav-container { border-top:1px solid #ededed; } .mk-vm-menuwrapper li > a { padding-right:45px; } .header-style-4 .mk-header-right { text-align:left !important; } @media handheld, only screen and (max-width:1740px) and (min-width:1140px){ .dashboard-opened .header-style-3.sticky-style-fixed .mk-dashboard-trigger { transform:translateX(-300px) translateZ(0); transition:all 300ms ease-in-out !important; } } .mk-grid { max-width:1140px; } .mk-header-nav-container, .mk-classic-menu-wrapper { width:1140px; } .theme-page-wrapper #mk-sidebar.mk-builtin { width:27%; } .theme-page-wrapper.right-layout .theme-content, .theme-page-wrapper.left-layout .theme-content { width:73%; } .mk-boxed-enabled #mk-boxed-layout, .mk-boxed-enabled #mk-boxed-layout .header-style-1 .mk-header-holder, .mk-boxed-enabled #mk-boxed-layout .header-style-3 .mk-header-holder { max-width:1200px; } .mk-boxed-enabled #mk-boxed-layout .header-style-2.a-sticky .mk-header-nav-container { width:1200px !important; left:auto !important; } .main-navigation-ul > li.menu-item > a.menu-item-link { color:#444444; font-size:13px; font-weight:500; padding-right:20px !important; padding-left:20px !important; text-transform:capitalize; letter-spacing:px; } .mk-vm-menuwrapper ul li a { color:#444444; font-size:13px; font-weight:500; text-transform:capitalize; } .mk-vm-menuwrapper li > a:after, .mk-vm-menuwrapper li.mk-vm-back:after { color:#444444; } .mk-vm-menuwrapper .mk-svg-icon{ fill:#444444; } .main-navigation-ul > li.no-mega-menu ul.sub-menu li.menu-item a.menu-item-link { width:230px; } .menu-hover-style-1 .main-navigation-ul > li.menu-item > a.menu-item-link:hover, .menu-hover-style-1 .main-navigation-ul > li.menu-item:hover > a.menu-item-link, .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link, .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link, .menu-hover-style-2 .main-navigation-ul > li.menu-item > a.menu-item-link:hover, .menu-hover-style-2 .main-navigation-ul > li.menu-item:hover > a.menu-item-link, .menu-hover-style-2 .main-navigation-ul > li.current-menu-item > a.menu-item-link, .menu-hover-style-2 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link, .menu-hover-style-1.mk-vm-menuwrapper li.menu-item > a:hover, .menu-hover-style-1.mk-vm-menuwrapper li.menu-item:hover > a, .menu-hover-style-1.mk-vm-menuwrapper li.current-menu-item > a, .menu-hover-style-1.mk-vm-menuwrapper li.current-menu-ancestor > a, .menu-hover-style-2.mk-vm-menuwrapper li.menu-item > a:hover, .menu-hover-style-2.mk-vm-menuwrapper li.menu-item:hover > a, .menu-hover-style-2.mk-vm-menuwrapper li.current-menu-item > a, .menu-hover-style-2.mk-vm-menuwrapper li.current-menu-ancestor > a { color:#ec008c !important; } .menu-hover-style-3 .main-navigation-ul > li.menu-item > a.menu-item-link:hover, .menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link, .menu-hover-style-3.mk-vm-menuwrapper li > a:hover, .menu-hover-style-3.mk-vm-menuwrapper li:hover > a, .menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link { border:2px solid #ec008c; } .menu-hover-style-3 .main-navigation-ul > li.current-menu-item > a.menu-item-link, .menu-hover-style-3 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link, .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-item > a, .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a{ border:2px solid #ec008c; background-color:#ec008c; color:#fff; } .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a:after { color:#fff; } .menu-hover-style-4 .main-navigation-ul li.menu-item > a.menu-item-link:hover, .menu-hover-style-4 .main-navigation-ul li.menu-item:hover > a.menu-item-link, .menu-hover-style-4 .main-navigation-ul li.current-menu-item > a.menu-item-link, .menu-hover-style-4 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link, .menu-hover-style-4.mk-vm-menuwrapper li a:hover, .menu-hover-style-4.mk-vm-menuwrapper li:hover > a, .menu-hover-style-4.mk-vm-menuwrapper li.current-menu-item > a, .menu-hover-style-4.mk-vm-menuwrapper li.current-menu-ancestor > a, .menu-hover-style-5 .main-navigation-ul > li.menu-item > a.menu-item-link:after { background-color:#ec008c; color:#fff; } .menu-hover-style-4.mk-vm-menuwrapper li.current-menu-ancestor > a:after, .menu-hover-style-4.mk-vm-menuwrapper li.current-menu-item > a:after, .menu-hover-style-4.mk-vm-menuwrapper li:hover > a:after, .menu-hover-style-4.mk-vm-menuwrapper li a:hover::after { color:#fff; } .menu-hover-style-1 .main-navigation-ul > li.dropdownOpen > a.menu-item-link, .menu-hover-style-1 .main-navigation-ul > li.active > a.menu-item-link, .menu-hover-style-1 .main-navigation-ul > li.open > a.menu-item-link, .menu-hover-style-1 .main-navigation-ul > li.menu-item > a:hover, .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link, .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link { border-top-color:#ec008c; } .menu-hover-style-1.mk-vm-menuwrapper li > a:hover, .menu-hover-style-1.mk-vm-menuwrapper li.current-menu-item > a, .menu-hover-style-1.mk-vm-menuwrapper li.current-menu-ancestor > a { border-left-color:#ec008c; } .header-style-1 .menu-hover-style-3 .main-navigation-ul > li > a.menu-item-link { line-height:25px; } .header-style-1.a-sticky .menu-hover-style-3 .main-navigation-ul > li > a.menu-item-link { line-height:36.666666666667px; } .header-style-1 .menu-hover-style-5 .main-navigation-ul > li > a.menu-item-link { line-height:20px; vertical-align:middle; } .mk-main-navigation li.no-mega-menu ul.sub-menu, .mk-main-navigation li.has-mega-menu > ul.sub-menu, .mk-shopping-cart-box { background-color:#333333; } .mk-main-navigation ul.sub-menu a.menu-item-link, .mk-main-navigation ul .megamenu-title, .megamenu-widgets-container a, .mk-shopping-cart-box .product_list_widget li a, .mk-shopping-cart-box .product_list_widget li.empty, .mk-shopping-cart-box .product_list_widget li span, .mk-shopping-cart-box .widget_shopping_cart .total { color:#b3b3b3; } .mk-main-navigation ul.sub-menu .menu-sub-level-arrow svg { fill:#b3b3b3; } .mk-main-navigation ul.sub-menu li:hover .menu-sub-level-arrow svg { fill:#ffffff; } .mk-shopping-cart-box .button { border-color:#b3b3b3; color:#b3b3b3; } .mk-main-navigation ul .megamenu-title { color:#ffffff; } .mk-main-navigation ul .megamenu-title:after { background-color:#ffffff; } .megamenu-widgets-container { color:#b3b3b3; } .megamenu-widgets-container .widgettitle { text-transform:uppercase; font-size:14px; font-weight:bolder; } .mk-main-navigation ul.sub-menu li.menu-item ul.sub-menu li.menu-item a.menu-item-link svg { color:#e0e0e0; } .mk-main-navigation ul.sub-menu a.menu-item-link:hover, .main-navigation-ul ul.sub-menu li.current-menu-item > a.menu-item-link, .main-navigation-ul ul.sub-menu li.current-menu-parent > a.menu-item-link { color:#ffffff !important; } .megamenu-widgets-container a:hover { color:#ffffff; } .main-navigation-ul ul.sub-menu li.menu-item a.menu-item-link:hover, .main-navigation-ul ul.sub-menu li.menu-item:hover > a.menu-item-link, .main-navigation-ul ul.sub-menu li.menu-item a.menu-item-link:hover, .main-navigation-ul ul.sub-menu li.menu-item:hover > a.menu-item-link, .main-navigation-ul ul.sub-menu li.current-menu-item > a.menu-item-link, .main-navigation-ul ul.sub-menu li.current-menu-parent > a.menu-item-link { background-color:transparent !important; } .mk-search-trigger:hover, .mk-header-start-tour:hover { color:#ec008c; } .mk-search-trigger:hover .mk-svg-icon, .mk-header-start-tour:hover .mk-svg-icon { fill:#ec008c; } .main-navigation-ul li.menu-item ul.sub-menu li.menu-item a.menu-item-link { font-size:12px; font-weight:400; text-transform:uppercase; letter-spacing:1px; } .has-mega-menu .megamenu-title { letter-spacing:1px; } .mk-responsive-wrap { background-color:#fff; } .main-navigation-ul > li.no-mega-menu > ul.sub-menu:after, .main-navigation-ul > li.has-mega-menu > ul.sub-menu:after { background-color:#ec008c; } .mk-shopping-cart-box { border-top:2px solid #ec008c; } @media handheld, only screen and (max-width:1140px){ .mk-grid, .mk-header-nav-container, .mk-classic-menu-wrapper { width:100%; } .mk-padding-wrapper { padding:0 20px; } .header-grid.mk-grid .header-logo.left-logo { left:15px !important; } .header-grid.mk-grid .header-logo.right-logo, .mk-header-right { right:15px !important; } .mk-photo-album { margin-left:0 !important; margin-right:0 !important; width:100% !important; } .mk-edge-slider .mk-grid { padding:0 20px; } } @media handheld, only screen and (max-width:800px){ .theme-page-wrapper .theme-content { width:100% !important; float:none !important; } .theme-page-wrapper { padding-right:15px !important; padding-left:15px !important; } .theme-page-wrapper .theme-content:not(.no-padding) { padding:25px 0 !important; } .theme-page-wrapper #mk-sidebar { width:100% !important; float:none !important; padding:0 !important; } .theme-page-wrapper #mk-sidebar .sidebar-wrapper { padding:20px 0 !important; } } @media handheld, only screen and (max-width:1140px){ .logo-is-responsive .mk-desktop-logo, .logo-is-responsive .mk-sticky-logo { display:none !important; } .logo-is-responsive .mk-resposnive-logo { display:block !important; } .add-header-height, .header-style-1 .mk-header-inner, .header-style-3 .mk-header-inner, .header-style-3 .header-logo, .header-style-1 .header-logo, .header-style-1 .shopping-cart-header, .header-style-3 .shopping-cart-header{ height:50px!important; line-height:50px; } .mk-header:not(.header-style-4) .mk-header-holder { position:relative !important; top:0 !important; } .mk-header-padding-wrapper { display:none !important; } .mk-header-nav-container { width:auto !important; display:none !important; } .header-style-1 .mk-header-right, .header-style-2 .mk-header-right, .header-style-3 .mk-header-right { right:55px !important; } .header-style-1 .mk-header-inner .mk-header-search, .header-style-2 .mk-header-inner .mk-header-search, .header-style-3 .mk-header-inner .mk-header-search { display:none !important; } .mk-fullscreen-search-overlay { display:none; } .mk-header-search { padding-bottom:10px !important; } .mk-header-searchform span .text-input { width:100% !important; } .header-style-2 .header-logo .center-logo { text-align:right !important; } .header-style-2 .header-logo .center-logo a { margin:0 !important; } .header-logo, .header-style-4 .header-logo { height:90px !important; } .header-style-4 .shopping-cart-header { display:none; } .mk-header-inner { padding-top:0 !important; } .header-style-1 .header-logo, .header-style-2 .header-logo, .header-style-4 .header-logo { position:relative !important; right:auto !important; left:auto !important; } .shopping-cart-header { margin:0 20px 0 0 !important; } .mk-responsive-nav li ul li .megamenu-title:hover, .mk-responsive-nav li ul li .megamenu-title, .mk-responsive-nav li a, .mk-responsive-nav li ul li a:hover, .mk-responsive-nav .mk-nav-arrow { color:#444444 !important; } .mk-mega-icon { display:none !important; } .mk-header-bg { zoom:1 !important; filter:alpha(opacity=100) !important; opacity:1 !important; } .header-style-1 .mk-nav-responsive-link, .header-style-2 .mk-nav-responsive-link, .logo-in-middle .header-logo { display:block !important; } .header-grid.mk-grid { position:initial !important; } .mk-header-nav-container { height:100%; z-index:200; } .mk-main-navigation { position:relative; z-index:2; } .header-style-4 .mk-header-inner { width:auto !important; position:relative !important; overflow:visible; padding-bottom:0; } .admin-bar .header-style-4 .mk-header-inner { top:0 !important; } .header-style-4 .mk-header-right { display:none; } .header-style-4 .mk-nav-responsive-link { display:block !important; } .header-style-4 .mk-vm-menuwrapper, .header-style-4 .mk-header-search { display:none; } .header-style-4 .header-logo { width:auto !important; display:inline-block !important; text-align:left !important; margin:0 !important; } .vertical-header-enabled .header-style-4 .header-logo img { max-width:100% !important; left:20px!important; top:50%!important; -webkit-transform:translate(0, -50%)!important; -moz-transform:translate(0, -50%)!important; -ms-transform:translate(0, -50%)!important; -o-transform:translate(0, -50%)!important; transform:translate(0, -50%)!important; position:relative !important; } .vertical-header-enabled.vertical-header-left #theme-page > .mk-main-wrapper-holder, .vertical-header-enabled.vertical-header-center #theme-page > .mk-main-wrapper-holder, .vertical-header-enabled.vertical-header-left #theme-page > .mk-page-section-wrapper .mk-page-section, .vertical-header-enabled.vertical-header-center #theme-page > .mk-page-section-wrapper .mk-page-section, .vertical-header-enabled.vertical-header-left #theme-page > .wpb_row, .vertical-header-enabled.vertical-header-center #theme-page > .wpb_row, .vertical-header-enabled.vertical-header-left #mk-theme-container:not(.trans-header), .vertical-header-enabled.vertical-header-center #mk-footer, .vertical-header-enabled.vertical-header-left #mk-footer, .vertical-header-enabled.vertical-header-center #mk-theme-container:not(.trans-header) { padding-left:0 !important; } .vertical-header-enabled.vertical-header-right #theme-page > .mk-main-wrapper-holder, .vertical-header-enabled.vertical-header-right #theme-page > .mk-page-section-wrapper .mk-page-section, .vertical-header-enabled.vertical-header-right #theme-page > .wpb_row, .vertical-header-enabled.vertical-header-right #mk-footer, .vertical-header-enabled.vertical-header-right #mk-theme-container:not(.trans-header) { padding-right:0 !important; } .header-style-1 .mk-dashboard-trigger, .header-style-2 .mk-dashboard-trigger { display:none; } .header-style-4 .mk-header-bg { height:100% !important; } } @media handheld, only screen and (min-width:1140px) { .trans-header .sticky-style-slide .mk-header-holder { position:absolute; } .trans-header .bg-true:not(.a-sticky) .mk-header-bg { opacity:0; } .trans-header .bg-true.mk-header:not(.a-sticky) .mk-header-inner { border:0; } .trans-header .bg-true.light-skin:not(.a-sticky) .mk-desktop-logo.light-logo { display:block !important; } .trans-header .bg-true.light-skin:not(.a-sticky) .mk-desktop-logo.dark-logo { display:none !important; } .trans-header .bg-true.light-skin:not(.a-sticky) .main-navigation-ul > li.menu-item > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .mk-search-trigger, .trans-header .bg-true.light-skin:not(.a-sticky) .mk-header-cart-count, .trans-header .bg-true.light-skin:not(.a-sticky) .mk-header-start-tour, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.menu-item > a.menu-item-link:hover, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.menu-item:hover > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul > li.menu-item > a.menu-item-link:hover, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul > li.menu-item:hover > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul > li.current-menu-item > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .mk-vm-menuwrapper li a, .trans-header .bg-true.light-skin:not(.a-sticky) .mk-vm-menuwrapper li > a:after, .trans-header .bg-true.light-skin:not(.a-sticky) .mk-vm-menuwrapper li.mk-vm-back:after { color:#fff !important; } .trans-header .bg-true.light-skin:not(.a-sticky) .mk-header-social.header-section a svg, .trans-header .bg-true.light-skin:not(.a-sticky) .main-navigation-ul li.menu-item a.menu-item-link .mk-svg-icon, .trans-header .bg-true.light-skin:not(.a-sticky) .mk-search-trigger .mk-svg-icon, .trans-header .bg-true.light-skin:not(.a-sticky) .mk-shoping-cart-link .mk-svg-icon { fill:#fff !important; } .trans-header .bg-true.light-skin:not(.a-sticky) .mk-css-icon-menu div { background-color:#fff !important; } .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.dropdownOpen > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.active > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.open > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.menu-item > a:hover, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link { border-top-color:#fff; } .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.current-menu-item > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-item > a, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a { border:2px solid #fff; background-color:#fff; color:#222 !important; } .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.menu-item > a.menu-item-link:hover, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li > a:hover, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li:hover > a { border:2px solid #fff; } .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.menu-item > a.menu-item-link:hover, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.menu-item:hover > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.current-menu-item > a.menu-item-link, .trans-header .bg-true.light-skin:not(.a-sticky) .menu-hover-style-5 .main-navigation-ul > li.menu-item > a.menu-item-link:after { background-color:#fff; color:#222 !important; } .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-desktop-logo.dark-logo { display:block !important; } .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-desktop-logo.light-logo { display:none !important; } .trans-header .bg-true.dark-skin:not(.a-sticky) .main-navigation-ul > li.menu-item > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-search-trigger, .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-header-cart-count, .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-header-start-tour, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul li.menu-item > a.menu-item-link:hover, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul li.menu-item:hover > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul li.current-menu-item > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul li.menu-item > a.menu-item-link:hover, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul li.menu-item:hover > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul li.current-menu-item > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-2 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-vm-menuwrapper li a, .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-vm-menuwrapper li > a:after, .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-vm-menuwrapper li.mk-vm-back:after { color:#222 !important; } .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-header-social.header-section a svg, .trans-header .bg-true.dark-skin:not(.a-sticky) .main-navigation-ul li.menu-item a.menu-item-link .mk-svg-icon, .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-search-trigger .mk-svg-icon, .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-shoping-cart-link .mk-svg-icon { fill:#222 !important; } .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.dropdownOpen > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.active > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.open > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.menu-item > a:hover, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-item > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-1 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link { border-top-color:#222; } .trans-header .bg-true.dark-skin:not(.a-sticky) .mk-css-icon-menu div { background-color:#222 !important; } .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.current-menu-item > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.current-menu-ancestor > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-item > a, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li.current-menu-ancestor > a { border:2px solid #222; background-color:#222; color:#fff !important; } .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.menu-item > a.menu-item-link:hover, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3 .main-navigation-ul > li.menu-item:hover > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li > a:hover, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-3.mk-vm-menuwrapper li:hover > a { border:2px solid #222; } .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.menu-item > a.menu-item-link:hover, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.menu-item:hover > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.current-menu-item > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-4 .main-navigation-ul li.current-menu-ancestor > a.menu-item-link, .trans-header .bg-true.dark-skin:not(.a-sticky) .menu-hover-style-5 .main-navigation-ul > li.menu-item > a.menu-item-link:after { background-color:#222; color:#fff !important; } } @media handheld, only screen and (max-width:1140px) { .mk-go-top, .mk-quick-contact-wrapper { right:22px; } .mk-go-top.is-active { right:22px; bottom:72px; } .mk-quick-contact-wrapper.is-active { right:22px; } } .mk-side-dashboard { background-color:#444; } .mk-side-dashboard, .mk-side-dashboard p { font-size:12px; color:#eee; font-weight:400; } .mk-side-dashboard .widgettitle { text-transform:uppercase; font-size:14px; color:#fff; font-weight:bolder; } .mk-side-dashboard .widgettitle a { color:#fff; } .mk-side-dashboard .widget a { color:#fafafa; } .sidedash-navigation-ul li a { font-size:13px; font-weight:600; text-transform:uppercase } .sidedash-navigation-ul .sub-menu li a { font-size:12px; font-weight:400; text-transform:uppercase } .sidedash-navigation-ul li a, .sidedash-navigation-ul li .mk-nav-arrow { color:#fff; } .sidedash-navigation-ul li a:hover { color:#fff; background-color:; } .mk-side-dashboard .widget:not(.widget_social_networks) a:hover { color:#ec008c; } #mk-sidebar, #mk-sidebar p { font-size:14px; color:#999999; font-weight:400; } #mk-sidebar .widgettitle { text-transform:uppercase; font-size:14px; color:#333333; font-weight:bolder; } #mk-sidebar .widgettitle a { color:#333333; } #mk-sidebar .widget a { color:#999999; } #mk-sidebar .widget:not(.widget_social_networks) a:hover { color:#ec008c; } .mk-testimonial-author, .modern-style .mk-testimonial-company, #wp-calendar td#today, .news-full-without-image .news-categories span, .news-half-without-image .news-categories span, .news-fourth-without-image .news-categories span, .mk-read-more, .news-single-social li a, .portfolio-carousel-cats, .blog-showcase-more, .simple-style .mk-employee-item:hover .team-member-position, .mk-portfolio-classic-item .portfolio-categories a, .register-login-links a:hover, .not-found-subtitle, .mk-mini-callout a, .search-loop-meta a, .mk-tooltip a:hover, .new-tab-readmore, .mk-news-tab .mk-tabs-tabs li.is-active a, .mk-woo-tabs .mk-tabs-tabs li.ui-state-active a, .monocolor.pricing-table .pricing-price span, .quantity .plus:hover, .quantity .minus:hover, .blog-modern-comment:hover, .blog-modern-share:hover { color:#ec008c; } .mk-tabs .mk-tabs-tabs li.is-active a > i, .mk-accordion .mk-accordion-single.current .mk-accordion-tab:before, .widget_testimonials .testimonial-slider .testimonial-author, #mk-filter-portfolio li a:hover, #mk-language-navigation ul li a:hover, #mk-language-navigation ul li.current-menu-item > a, .mk-quick-contact-wrapper h4, .divider-go-top:hover i, .widget-sub-navigation ul li a:hover, #mk-footer .widget_posts_lists ul li .post-list-meta time, .mk-footer-tweets .tweet-username, .product-category .item-holder:hover h4 { color:#ec008c !important; } .accent-bg-color, .image-hover-overlay, .newspaper-portfolio, .similar-posts-wrapper .post-thumbnail:hover > .overlay-pattern, .portfolio-logo-section, .post-list-document .post-type-thumb:hover, #cboxTitle, #cboxPrevious, #cboxNext, #cboxClose, .comment-form-button, .mk-dropcaps.fancy-style, .mk-image-overlay, .pinterest-item-overlay, .news-full-with-image .news-categories span, .news-half-with-image .news-categories span, .news-fourth-with-image .news-categories span, .widget-portfolio-overlay, .portfolio-carousel-overlay, .blog-carousel-overlay, .mk-blog-classic-item .blog-loop-comments span, .mk-similiar-overlay, .mk-skin-button, .mk-flex-caption .flex-desc span, .mk-icon-box .mk-icon-wrapper i:hover, .mk-quick-contact-link:hover, .quick-contact-active.mk-quick-contact-link, .mk-fancy-table th, .ui-slider-handle, .widget_price_filter .ui-slider-range, #review_form_wrapper input[type=submit], #mk-nav-search-wrapper form .nav-side-search-icon:hover, form.ajax-search-complete i, .blog-modern-btn, .showcase-blog-overlay, .gform_button[type=submit], .single_add_to_cart_button, .button.checkout-button, .woocommerce #payment #place_order, #respond #submit, .widget_price_filter .price_slider_amount .button, .widget_shopping_cart .button.checkout { background-color:#ec008c !important; } .a_accent-bg-hover:hover { background-color:#ec008c; } ::-webkit-selection { background-color:#ec008c; color:#fff; } ::-moz-selection { background-color:#ec008c; color:#fff; } ::selection { background-color:#ec008c; color:#fff; } .mk-circle-image .item-holder { -webkit-box-shadow:0 0 0 1px #ec008c; -moz-box-shadow:0 0 0 1px #ec008c; box-shadow:0 0 0 1px #ec008c; } .mk-blockquote.line-style, .bypostauthor > .mk-single-comment .comment-content, .bypostauthor > .mk-single-comment .comment-content:after, .mk-tabs.simple-style .mk-tabs-tabs li.is-active a { border-color:#ec008c !important; } .news-full-with-image .news-categories span, .news-half-with-image .news-categories span, .news-fourth-with-image .news-categories span, .mk-flex-caption .flex-desc span { box-shadow:8px 0 0 #ec008c, -8px 0 0 #ec008c; } .monocolor.pricing-table .pricing-cols .pricing-col.featured-plan { border:1px solid #ec008c !important; } .mk-skin-button.three-dimension { box-shadow:0px 3px 0px 0px #bd0070; } .mk-skin-button.three-dimension:active { box-shadow:0px 1px 0px 0px #bd0070; }</style>
    <div class="mk-main-wrapper-holder">
        <div class="theme-page-wrapper full-layout mk-grid vc_row-fluid no-padding">
            <div class="theme-content no-padding">
                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false applyform vc_custom_1499869394389 js-master-row mk-in-viewport">
                    <div style="" class="vc_col-sm-12 wpb_column column_container _ height-full">
                        <div>
                            <form method="post" action="<?php echo get_permalink(); ?>#message" id="apply-online">
                                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false js-master-row mk-in-viewport">
                                    <div style="" class="vc_col-sm-12 wpb_column column_container _ height-full">
                                        <div id="padding-4" class="mk-padding-divider clearfix"></div>
                                        <h2 id="fancy-title-5" class="mk-fancy-title simple-style color-single">
                                        <span>
                                            Your contact details
                                        </span>
                                        </h2>
                                        <div class="clearboth"></div>
                                    </div>
                                </div>
                                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false js-master-row mk-in-viewport">
                                    <div style="" class="vc_col-sm-6 wpb_column column_container _ height-full">
                                        <div id="text-block-6" class="mk-text-block ">
                                            <p>
                                                <label>First Name*<br>
                                                    <span class="first-name">
                                                    <input type="text" name="first-name" value="<?php echo $firstname; ?>" required>
                                                </span>
                                                </label>
                                            </p>
                                            <div class="clearboth"></div>
                                        </div>
                                    </div>
                                    <div style="" class="vc_col-sm-6 wpb_column column_container _ height-full">
                                        <div id="text-block-7" class="mk-text-block ">
                                            <p>
                                                <label>Surname*<br>
                                                    <span class="surname">
                                                    <input type="text" name="surname" value="<?php echo $surname; ?>" aria-required="true" aria-invalid="false" required>
                                                </span>
                                                </label>
                                            </p>
                                            <div class="clearboth"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false js-master-row mk-in-viewport">
                                    <div style="" class="vc_col-sm-12 wpb_column column_container _ height-full">
                                        <div id="text-block-8" class="mk-text-block ">
                                            <p>
                                                <label>Address *<br>
                                                    <span class="address">
                                                    <textarea name="address" cols="40" rows="10" aria-required="true" aria-invalid="false" required><?php echo $address1; ?></textarea>
                                                </span>
                                                </label>
                                            </p>
                                            <div class="clearboth"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false js-master-row ">
                                    <div style="" class="vc_col-sm-6 wpb_column column_container _ height-full">
                                        <div id="text-block-9" class="mk-text-block ">
                                            <p>
                                                <label>Postcode *<br>
                                                    <span class="postcode">
                                                    <input type="text" name="postcode" value="<?php echo $postcode; ?>" aria-required="true" aria-invalid="false" required>
                                                </span>
                                                </label>
                                            </p>
                                            <div class="clearboth"></div>
                                        </div>

                                        <div id="text-block-10" class="mk-text-block ">
                                            <p>
                                                <label>Mobile number*<br>
                                                    <span class="mobile">
                                                    <input type="tel" name="mobile" value="<?php echo $mobile; ?>" aria-required="true" aria-invalid="false" required>
                                                </span>
                                                </label>
                                            </p>
                                            <div class="clearboth"></div>
                                        </div>
                                    </div>

                                    <div style="" class="vc_col-sm-6 wpb_column column_container _ height-full">
                                        <div id="text-block-11" class="mk-text-block ">
                                            <p>
                                                <label>Telephone number*<br>
                                                    <span class="telephone">
                                                    <input type="tel" name="telephone" value="<?php echo $telephone; ?>" aria-required="true" aria-invalid="false" required>
                                                </span>
                                                </label>
                                            </p>
                                            <div class="clearboth"></div>
                                        </div>

                                        <div id="text-block-12" class="mk-text-block ">
                                            <p>
                                                <label>Email address*<br>
                                                    <span class="your-email">
                                                    <input type="email" name="your-email" value="<?php echo $email; ?>" aria-required="true" aria-invalid="false" required>
                                                </span>
                                                </label>
                                            </p>
                                            <div class="clearboth"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false js-master-row ">
                                    <div style="" class="vc_col-sm-12 wpb_column column_container _ height-full">
                                        <h2 id="fancy-title-13" class="mk-fancy-title simple-style color-single">
                                        <span>
                                            Your current circumstance
                                        </span>
                                        </h2>
                                        <div class="clearboth"></div>
                                    </div>

                                    <div style="" class="vc_col-sm-6 wpb_column column_container _ height-full">
                                        <div id="text-block-14" class="mk-text-block ">
                                            <p>
                                                <label>Employment*<br>
                                                    <span class="employment">
                                                    <select name="employment" aria-required="true" aria-invalid="false">
                                                        <option value="Employed"<?php
                                                        if ($employment == "Employed") {
                                                            echo " selected=\"selected\"";
                                                        }
                                                        ?>>Employed</option>
                                                        <option value="Self Employed"<?php
                                                        if ($employment == "Self Employed") {
                                                            echo " selected=\"selected\"";
                                                        }
                                                        ?>>Self Employed</option>
                                                        <option value="Student"<?php
                                                        if ($employment == "Student") {
                                                            echo " selected=\"selected\"";
                                                        }
                                                        ?>>Student</option>
                                                        <option value="Retired"<?php
                                                        if ($employment == "Retired") {
                                                            echo " selected=\"selected\"";
                                                        }
                                                        ?>>Retired</option>
                                                        <option value="Unemployed"<?php
                                                        if ($employment == "Unemployed") {
                                                            echo " selected=\"selected\"";
                                                        }
                                                        ?>>Unemployed</option>
                                                    </select>
                                                </span>
                                                </label>
                                            </p>
                                            <div class="clearboth"></div>
                                        </div>

                                        <div id="text-block-15" class="mk-text-block ">


                                            <p><label>Monthly Income*<br>
                                                    <span class="income">
                                                    <input type="text" name="income" value="<?php echo $income; ?>" aria-required="true" aria-invalid="false" required>
                                                </span>
                                                </label>
                                            </p>

                                            <div class="clearboth"></div>
                                        </div>
                                    </div>

                                    <div style="" class="vc_col-sm-6 wpb_column column_container _ height-full">

                                        <div id="text-block-16" class="mk-text-block ">


                                            <p><label>Residential Status*<br>
                                                    <span class="residential">
                                                    <select name="residential" aria-required="true" aria-invalid="false">
                                                        <option value="Homeowner"<?php
                                                        if ($residential == "Homeowner") {
                                                            echo " selected=\"selected\"";
                                                        }
                                                        ?>>Homeowner</option>
                                                        <option value="Tenant"<?php
                                                        if ($residential == "Tenant") {
                                                            echo " selected=\"selected\"";
                                                        }
                                                        ?>>Tenant</option>
                                                        <option value="Living with Parents"<?php
                                                        if ($residential == "Living with Parents") {
                                                            echo " selected=\"selected\"";
                                                        }
                                                        ?>>Living with Parents</option>
                                                    </select>
                                                </span>
                                                </label>
                                            </p>

                                            <div class="clearboth"></div>
                                        </div>

                                        <div id="text-block-17" class="mk-text-block ">


                                            <p><label>Credit History: Do you have any CCJ's or Defaults?*<br>
                                                    <span class="creditstatus">
                                                    <select name="creditstatus" aria-required="true" aria-invalid="false">
                                                        <option value="No"<?php
                                                        if ($creditstatus == "No") {
                                                            echo " selected=\"selected\"";
                                                        }
                                                        ?>>No</option>
                                                        <option value="Yes"<?php
                                                        if ($creditstatus == "Yes") {
                                                            echo " selected=\"selected\"";
                                                        }
                                                        ?>>Yes</option>
                                                    </select>
                                                </span>
                                                </label>
                                            </p>

                                            <div class="clearboth"></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false applyform remortdet js-master-row ">


                                    <div style="" class="vc_col-sm-12 wpb_column column_container _ height-full">

                                        <h2 id="fancy-title-18" class="mk-fancy-title simple-style color-single">
                                        <span>
                                            Details if purchasing a property			</span>
                                        </h2>
                                        <div class="clearboth"></div>



                                    </div>

                                    <div style="" class="vc_col-sm-6 wpb_column column_container _ height-full">

                                        <div id="text-block-19" class="mk-text-block ">


                                            <p><label>Property Purchase Price<br>
                                                    <span class="purchase">
                                                    <input type="text" name="purchase" value="<?php echo $purchase; ?>" aria-invalid="false">
                                                </span>
                                                </label>
                                            </p>

                                            <div class="clearboth"></div>
                                        </div>
                                    </div>

                                    <div style="" class="vc_col-sm-6 wpb_column column_container _ height-full">

                                        <div id="text-block-20" class="mk-text-block ">


                                            <p><label>Loan Required<br>
                                                    <span class="required">
                                                    <input type="text" name="required" value="<?php echo $required; ?>" aria-invalid="false">
                                                </span>
                                                </label>
                                            </p>

                                            <div class="clearboth"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false js-master-row ">
                                    <div style="" class="vc_col-sm-12 wpb_column column_container _ height-full">
                                        <div id="padding-21" class="mk-padding-divider clearfix"></div>
                                    </div>
                                </div>
                                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false applyform mortdet js-master-row ">
                                    <div style="" class="vc_col-sm-12 wpb_column column_container _ height-full">
                                        <h2 id="fancy-title-22" class="mk-fancy-title simple-style color-single">
                                        <span>
                                            Details if remortgaging
                                        </span>
                                        </h2>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div style="" class="vc_col-sm-6 wpb_column column_container _ height-full">
                                        <div id="text-block-23" class="mk-text-block ">
                                            <p>
                                                <label>Property Value<br>
                                                    <span class="rempurchase">
                                                    <input type="text" name="rempurchase" value="<?php echo $rempurchase; ?>" aria-invalid="false">
                                                </span>
                                                </label>
                                            </p>
                                            <div class="clearboth"></div>
                                        </div>
                                    </div>

                                    <div style="" class="vc_col-sm-6 wpb_column column_container _ height-full">
                                        <div id="text-block-24" class="mk-text-block ">
                                            <p>
                                                <label>Loan Required<br>
                                                    <span class="remrequired">
                                                    <input type="text" name="remrequired" value="<?php echo $remrequired; ?>" aria-invalid="false">
                                                </span>
                                                </label>
                                            </p>
                                            <div class="clearboth"></div>
                                        </div>
                                    </div>
                                </div>

                                <span style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" data-mce-type="bookmark" class="mce_SELRES_start">﻿</span>
                                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false js-master-row ">
                                    <div style="" class="vc_col-sm-12 wpb_column column_container _ height-full">
                                        <div id="text-block-25" class="mk-text-block ">
                                            <p>
                                            <span class="consent">
                                                <span>
                                                    <span class="last">
                                                        <input type="checkbox" name="consent" id="consent" class="apply-check" value="Please tick this box if you wish to receive marketing messages (by mail, e-mail, telephone or other appropriate means) from us related to carefully selected services, products or offers which we believe may be of interest to you.">
                                                        <label for="consent">
                                                            Please tick this box if you wish to receive marketing messages (by mail, e-mail, telephone or other appropriate means) from us related to carefully selected services, products or offers which we believe may be of interest to you.
                                                        </label>
                                                    </span>
                                                </span>
                                            </span>
                                            </p>

                                            <div class="clearboth"></div>
                                        </div>

                                        <div class="wpb_row vc_inner vc_row vc_row-fluid attched-false ">
                                            <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div id="text-block-26" class="mk-text-block submitbutton">
                                                            <p>
                                                                <?php if(!isset($messagecolour) || $messagecolour !="green"){?>
                                                                    <input type="submit" value="Apply" class="apply-btn">
                                                                <?php } ?>
                                                                <span class="ajax-loader"></span>
                                                            </p>
                                                            <div class="clearboth"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-4">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" data-mce-type="bookmark" class="mce_SELRES_end">﻿</span>
                                <?php if (isset($message)) { ?>
                                    <p id="message" class="message <?php echo $messagecolour; ?>"><?php echo $message; ?></p>
                                <?php }
                                if (isset($response)){
                                    echo "<!--" . $response->SaveLeadResult . "-->";
                                }
                                ?>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="wpb_row vc_row vc_row-fluid mk-fullwidth-false attched-false js-master-row mk-in-viewport">
                    <div style="" class="vc_col-sm-12 wpb_column column_container _ height-full">
                        <div id="padding-27" class="mk-padding-divider clearfix"></div>
                    </div>
                </div>
                <div class="clearboth"></div>
                <div class="clearboth"></div>
            </div>
        </div>
    </div>
<?php
get_footer();
