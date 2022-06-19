<?php

if (!class_exists('_360dotnet')) {

    /**
     * Class _360dotnet
     */
    class _360dotnet
    {

        /**
         * The form data sent to 360dotnet
         * @var string[] $formData
         */
        public $formData;

        /**
         * Path to the models
         * @var string $modelsPath
         */
        protected $modelsPath;

        /**
         * The form data manipulated into 360dotnet's format
         * @var array $config
         */
        protected $config;

        /**
         * 360dotnet api's details
         * @var string[]
         */
        protected $api;

        /**
         * The environment
         * @var string Options: LIVE, DEV
         */
        protected $env;

        /**
         * Class constructor
         * @param string[] $formData
         * @param string $environment
         */
        public function __construct(array $formData, string $environment = 'DEV')
        {
            $this->env = in_array($environment, ['LIVE', 'DEV']) ? $environment : 'DEV';
            $this->formData = $formData;
            $this->modelsPath = get_template_directory() . '/360dotnet/models/';
            $this->api = [
                'url' => "https://services.360lifecycle.co.uk/LeadService.svc?singlewsdl"
            ];
        }

        /**
         * Submits the loaded config to 360dotnet
         */
        public function submit()
        {
            if(!in_array($this->env, ['LIVE', 'DEV'])){
                error_log('_360dotnet: Environment is not set');
                return;
            }

            $this->loadModels();
            $this->loadConfig();
            $this->initialiseService();

            try {
                $response = $this->api['service']->SaveLead($this->config);

                $caseID = explode(' ',  $response->SaveLeadResult)[5];
                file_put_contents(ABSPATH . "output/$caseID.json", json_encode($response));
            } catch (SoapFault $e) {
                $log_location = ABSPATH . 'output/error_' . $this->generateRandomString(5) . '.json';
                file_put_contents($log_location, json_encode($e));

                error_log('_360dotnet: Error in sending data to 360, view log at: ' . $log_location);
            }
        }

        /*
         * Loads the models
         */
        private function loadModels()
        {
            foreach (scandir($this->modelsPath) as $path) {
                if (strpos($path, 'php') !== false) {
                    if (file_exists($this->modelsPath . $path)) {
                        require_once $this->modelsPath . $path;
                    } else {
                        error_log("_360dotnet: Failed to load model $path");
                    }
                }
            }
        }

        /*
         * Initialises the SoapClient used to talk to 360dotnet
         */
        private function initialiseService()
        {
            try {
                $this->api['service'] = new SoapClient($this->api['url'], array(
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
            } catch (SoapFault $exception) {
                error_log('_360dotnet: Failed to initialise SoapClient: ' . $exception->getMessage());
            }
        }

        /**
         * Loads the config
         */
        private function loadConfig(): void
        {
            $lead = new My360Lead();

            $lead->Address = new My360Address();
            $lead->Address->AddressLine1 = '1st Floor 4, East Terrace Business Park';
            $lead->Address->AddressLine2 = 'Euxton Ln';
            $lead->Address->County = '';
            $lead->Address->MailingName = '';
            $lead->Address->Postcode = 'PR7 6TB';
            $lead->Address->Salutation = '';
            $lead->Address->Town = 'Chorley';

            $lead->Auth = new My360Auth();
            $lead->Auth->Key =
                $this->env === 'LIVE'
                    ? 'A4E3ACCB-0D77-4689-ACBA-0730EF704FAA'
                    : '35688063-9BD9-4C5B-BFA3-6E7CA9746FE1';

            $date = date('c', time());

            $client = new My360Client();
            $client->DateOfBirth = $date;
            $client->Dependants = 0;
            $client->EmploymentStatus = '';
            $client->Forename = '';
            $client->Gender = '';
            $client->Income = 0.0;
            $client->Occupation = '';
            $client->Smoker = '';
            $client->Surname = '';
            $client->Title = '';

            $client->Contact = new My360Contact();
            $client->Contact->Email = '';
            $client->Contact->Mobile = '';
            $client->Contact->Home = '';
            $client->Contact->Work = '';

            $lead->Clients = array($client);

            $note = new My360Note();
            $note->From = '';
            $note->Text = '';

            $lead->Notes = array($note);

            $appointment = new My360Appointment();
            $appointment->End = $date;
            $appointment->Location = '';
            $appointment->LocationType = '';
            $appointment->Start = $date;

            $lead->Opportunity = new My360Opportunity();
            $lead->Opportunity->Advisor =
                $this->env === 'LIVE'
                    ? 'Central Hotbox'
                    : 'Mortgage Experience';
            $lead->Opportunity->Appointment = $appointment;
            $lead->Opportunity->Introducer =
                $this->env === 'LIVE'
                    ? ''
                    : 'Mortgage Experience';
            $lead->Opportunity->LeadSource =
                $this->env === 'LIVE'
                    ? 'Website'
                    : 'Mortgage Experience Lead';
            $lead->Opportunity->LeadType =
                $this->env === 'LIVE'
                    ? ''
                    : 'Other';

            $My360SaveLead = new My360SaveLead();

            if (isset($this->formData['full-name'])) {
                $name = $this->formData['full-name'];
                $first_name = $name;
                $last_name = null;
                if (strpos($name, ' ') !== false) {
                    $name_split = explode(' ', $name);
                    $first_name = $name_split[0];
                    $last_name = $name_split[1];
                    if(count($name_split) > 2){
                        unset($name_split[0]);
                        $last_name = implode(' ', $name_split);
                    }
                }
                $client->Forename = $first_name;
                $client->Surname = $last_name;
            }

            if (isset($this->formData['first-name'])) {
                $client->Forename = $this->formData['first-name'];
            }

            if (isset($this->formData['last-name'])) {
                $client->Surname = $this->formData['last-name'];
            }

            if (isset($this->formData['phone'])) {
                $phone = $this->formData['phone'] ?? '';
                $client->Contact->Mobile = $phone;
            }

            if (isset($this->formData['email'])) {
                $email = $this->formData['email'] ?? '';
                $client->Contact->Email = $email;
            }

            if (isset($this->formData['metadata'])) {
                $metadata = $this->formData['metadata'] ?? '';
                $note->Text = $metadata;
            }

            $My360SaveLead->value = $lead;
            $this->config = $My360SaveLead;
        }

        /**
         * Generates a random string used for naming error files
         * @param int $length
         * @return string
         */
        private function generateRandomString(int $length = 10): string
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
    }

}