<?php


namespace Satis\Incomingmail;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Satis\Incomingmail\Traits\ConfigValue;

class IncomingMailRegistration extends Command
{
    use ConfigValue;

    protected $signature = 'incomingmailregistration:install';

    protected $description = 'Registration to Incoming Mail Service';

    public function handle()
    {
        $this->info('Begin registration ...');

        // Make Post Fields Array
        $data = Config::get('incoming_mail.app_registration');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->getRegistrationUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $this->error( "Registration Error #:" . $err);
            return "Registration Error #:" . $err;
        } else {
            $this->info('Registration done. Thanks');
            //print_r(json_decode($response));
        }

    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Satis\Incomingmail\IncomingmailServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = '';
        }

        $this->call('vendor:publish', $params);
    }
}
