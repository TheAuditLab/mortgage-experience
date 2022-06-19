<?php
?>
<section class="newsletterSignup">
<div class="container-fluid">
    <div class="row getintouchCTA bg-blue animatedDiv data-aos_fade-up  data-aos-delay_100 data-aos-duration_400">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
            <h3>Talk to one of our Mortgage Experts on  <a href="tel:<?php the_field('contact_number', 'option'); ?>"><?php the_field('contact_number', 'option'); ?></a></h3>
            <p>Take the first step to getting a specialist mortgage today, completely stress-free.</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 newsletter-left-image animatedDiv data-aos_fade-up  data-aos-delay_100 data-aos-duration_200">
                <?php $left_image = get_field('left_image');  ?>
                <img src="<?php echo $left_image['url'];?>" />
            </div>
            <div class="col-lg-6 pt-50 pt-sm-20 newsletterCopy">
               <h4><?php the_field('heading'); ?></h4>
                <p><?php the_field('intro_text'); ?></p>
                <p class="pt-2">Enter your email below to sign up for our newsletter</p>

                <!--Zoho Campaigns Web-Optin Form's Header Code Starts Here-->

                <script type="text/javascript" src="https://lzwf.maillist-manage.eu/js/optin.min.js" onload="setupSF('sf3z25489fb7a36709730ebee438a4d96e6a71c25215ebc24f2437af2ed39aa07304','ZCFORMVIEW',false,'acc',false,'2')"></script>
                <script type="text/javascript">
                    function runOnFormSubmit_sf3z25489fb7a36709730ebee438a4d96e6a71c25215ebc24f2437af2ed39aa07304(th){
                        /*Before submit, if you want to trigger your event, "include your code here"*/
                    };
                </script>

                <style>
                    .quick_form_12_css * {
                        -webkit-box-sizing: border-box !important;
                        -moz-box-sizing: border-box !important;
                        box-sizing: border-box !important;
                        overflow-wrap: break-word
                    }
                    input[type="text"]::placeholder {
                        color: rgb(165, 165, 165)
                    }
                    @media only screen and (max-width: 600px) {.quick_form_12_css[name="SIGNUP_BODY"] { width: 100% !important; min-width: 100% !important; margin: 0px auto !important; padding: 0px !important } .SIGNUP_FLD { width: 90% !important; margin: 10px 5% !important; padding: 0px !important } .SIGNUP_FLD input { margin: 0 !important; border-radius: 25px !important } }
                </style>

                <!--Zoho Campaigns Web-Optin Form's Header Code Ends Here--><!--Zoho Campaigns Web-Optin Form Starts Here-->

                <div id="sf3z25489fb7a36709730ebee438a4d96e6a71c25215ebc24f2437af2ed39aa07304" data-type="signupform" style="">
                    <div id="customForm">
                        <div class="quick_form_12_css"  name="SIGNUP_BODY">
                            <div>
                                <div style="font-size: 16px; font-family: inherit; font-weight: bold; color: rgb(166, 166, 166); text-align: left; padding: 0px 15px 5px; width: 100%; display: block" id="SIGNUP_HEADING"></div>
                                <div style="position:relative;">
                                    <div id="Zc_SignupSuccess" style="display:none;position:absolute;margin-left:4%;width:90%;background-color: white; padding: 3px; border: 3px solid rgb(194, 225, 154);  margin-top: 10px;margin-bottom:10px;word-break:break-all">
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                            <tr>
                                                <td width="10%">
                                                    <img class="successicon" src="https://lzwf.maillist-manage.eu/images/challangeiconenable.jpg" align="absmiddle">
                                                </td>
                                                <td>
                                                    <span id="signupSuccessMsg" style="color: rgb(73, 140, 132); font-family: sans-serif; font-size: 14px;word-break:break-word">&nbsp;&nbsp;Thank you for Signing Up</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <form method="POST" id="zcampaignOptinForm" style="margin: 0px; width: 100%; padding: 0px 0px" action="https://maillist-manage.eu/weboptin.zc" target="_zcSignup">
                                    <div style="padding: 10px; color: rgb(210, 0, 0); font-size: 11px; margin: 20px 0px 0px; border: 1px solid rgb(255, 217, 211); opacity: 1; display: none" id="errorMsgDiv">Please correct the marked field(s) below.</div>
                                    <div style="position: relative; margin: 10px 0px 15px; width: 70%; display: inline-block; height: 50px" class="SIGNUP_FLD">
                                        <input type="text" style="font-size: 16px; border: 0px none rgb(255, 255, 255); border-radius: 21px 0px 0px 21px; width: 100%; height: 100%; z-index: 4; outline: currentcolor none medium; padding: 5px 10px; color: rgb(71, 59, 94); text-align: left; font-family: inherit; background-color: rgb(247, 247, 247); box-sizing: border-box" placeholder="Email Address" changeitem="SIGNUP_FORM_FIELD" name="CONTACT_EMAIL" id="EMBED_FORM_EMAIL_LABEL">
                                    </div>
                                    <div style="position: relative; width: 150px; height: 50px; margin: 0 0 15px; text-align: left; display: inline-block" class="SIGNUP_FLD">
                                        <input type="button" style="text-align: center; width: 100%; height: 100%; z-index: 5; font-weight:900;border: 0px none; color: rgb(255, 255, 255); cursor: pointer; outline: currentcolor none medium; font-size: 16px; background-color: rgb(71, 59, 94); margin: 0px 0px 0px -5px; border-radius: 0px 50px 50px 0px" name="SIGNUP_SUBMIT_BUTTON" id="zcWebOptin" value="Subscribe">
                                    </div>
                                    <input type="hidden" id="fieldBorder" value="">
                                    <input type="hidden" id="submitType" name="submitType" value="optinCustomView">
                                    <input type="hidden" id="emailReportId" name="emailReportId" value="">
                                    <input type="hidden" id="formType" name="formType" value="QuickForm">
                                    <input type="hidden" name="zx" id="cmpZuid" value="14acb3511f">
                                    <input type="hidden" name="zcvers" value="2.0">
                                    <input type="hidden" name="oldListIds" id="allCheckedListIds" value="">
                                    <input type="hidden" id="mode" name="mode" value="OptinCreateView">
                                    <input type="hidden" id="zcld" name="zcld" value="113433932ae95982">
                                    <input type="hidden" id="zctd" name="zctd" value="">
                                    <input type="hidden" id="document_domain" value="">
                                    <input type="hidden" id="zc_Url" value="lzwf.maillist-manage.eu">
                                    <input type="hidden" id="new_optin_response_in" value="0">
                                    <input type="hidden" id="duplicate_optin_response_in" value="0">
                                    <input type="hidden" name="zc_trackCode" id="zc_trackCode" value="ZCFORMVIEW">
                                    <input type="hidden" id="zc_formIx" name="zc_formIx" value="3z25489fb7a36709730ebee438a4d96e6a71c25215ebc24f2437af2ed39aa07304">
                                    <input type="hidden" id="viewFrom" value="URL_ACTION">
                                    <span style="display: none" id="dt_CONTACT_EMAIL">1,true,6,Contact Email,2</span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <img src="https://lzwf.maillist-manage.eu/images/spacer.gif" id="refImage" onload="referenceSetter(this)" style="display:none;">
                </div>
                <input type="hidden" id="signupFormType" value="QuickForm_Horizontal">
                <div id="zcOptinOverLay" oncontextmenu="return false" style="display:none;text-align: center; background-color: rgb(0, 0, 0); opacity: 0.5; z-index: 100; position: fixed; width: 100%; top: 0px; left: 0px; height: 988px;"></div>
                <div id="zcOptinSuccessPopup" style="display:none;z-index: 9999;width: 800px; height: 40%;top: 84px;position: fixed; left: 26%;background-color: #FFFFFF;border-color: #E6E6E6; border-style: solid; border-width: 1px;  box-shadow: 0 1px 10px #424242;padding: 35px;">
	<span style="position: absolute;top: -16px;right:-14px;z-index:99999;cursor: pointer;" id="closeSuccess">
		<img src="https://lzwf.maillist-manage.eu/images/videoclose.png">
	</span>
                    <div id="zcOptinSuccessPanel"></div>
                </div>

                <!--Zoho Campaigns Web-Optin Form Ends Here-->

                <p class="privacyStatement"><?php the_field('privacy_statement'); ?></p>
            </div>
        </div>
    </div>
</div>
</section>