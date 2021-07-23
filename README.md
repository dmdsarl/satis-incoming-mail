# Satis Incoming Mail
### Installation 

```console
composer require satis/incomingmail 
```

### Publish the package
```console
php artisan vendor:publish --provider=Satis\Incomingmail\IncomingmailServiceProvider"
```
Once published, you will have access to a controller 
**IncomingMail/IncomingMailController.php** which allows you to customize the 
mail registration function. Also a config is generated in **config/incoming_mail.php**.

### Project configuration
Access the configuration in config/incoming_mail.php to make your changes. 
```php

[
    "table" => "my_table", // Represents the name of the table in which you want to save the different received mails
    "message_format" => "html_text", // The format in which you want to save the messages received from the mail :
    // html_text => to save the message in html format and plain_text for plain text
    "object" => [ // The different fields that will be taken into account to record in the table
        "first_name" => "first_name", // Customize the name of the first name field of the sender
        "last_name" => "last_name", // Customize the name of the sender "s name field
        "email" => "email", // Customize the name of the email field
        "message"=>"message", // Customize the field name of the message to be saved
        "date"=>"date", // Customize the field name of the date the mail was sent
        "attachments"=>"attachments", // Customize the name of the file field, this field is of type json
    ],
    "app_registration"=>[ //Incoming mail service subscription information
        "app_name" => 'Care - Rwanda', // Name of your application,
        "url" => 'http://localhost:8000/satis/incoming/mail', // Registration link for incoming mail
        "mail_server" => 'smtp.gmail.com', // Maim host
        "mail_server_username" => 'test.dmd.arafath@gmail.com', // Mail username
        "mail_server_password" => 'P@ssword@DMD', // Mail password
        "mail_server_port" => '587', // Mail port
        "app_login_url" => 'http://localhost:8000/oauth/token', // Api authentication
        "app_login_params" => [ // Information to connect to your project. The different colunms to change following
            // arguments needed to connect to your project
            "grant_type" => "password",
            "client_id" => "93f64252-da39-4f90-86e8-c14a500c6d39",
            "client_secret" => "r3CcD12cCIhpMJAwI7ipcfJw8eab01Mprq81f7vc",
            "username" => "incoming-mail-care@dmdconsult.com",
            "password" => "123456"
        ],
    ]
];
```
>For app_login_params you can for example use :
```console
'app_login_params' => [
            "email" => "incoming-mail-care@dmdconsult.com",
            "password" => "123456"
        ]
```

if these are the fields you need for the connection to your project

### Subscription to the incoming mails service
After the configuration, perform the subscription to the incoming mails service with the following command: 
```console
php artisan incomingmailregistration:install
```
From this moment your project receives unread mails every 1 minute and records them in your database

### GeneralMail or ClaimMail

You have the possibility to save the mails in a classic table
 **(GeneralMail)** or to do it as a claim **(ClaimMail)**

##### GeneralMail
By default your project is configured to save mail in a classic 
table that you have defined in the **config/incoming_mail.php** file.
You can override this function by adding other attributes
 ```console
	use GeneralMail{
        register as registerMail;
    }

    public function register(Request $request){
        $addData = [
            "request_channel_slug"=>"email",
            "response_channel_slug"=>"email",
        ];
        return $this->registerMail($request,$addData);
    } 
```
or change the logic of the code :  
```console
    use GeneralMail{
        register as registerMail;
    }

    public function register(Request $request){
        
        // Your logic here

    } 
```

##### ClaimMail
To use the register as claim, please comment out the **Use GeneralMail** 
line and uncomment the **Use ClaimMail** line.
The registration of mail in the form of claim is done the table 
definite in the config as the GeneralMail with the difference that in 
this case you must have a table **identities** that will contain the information
 of a claimer (You must have the attributes related to the 
 following config: **'first_name' , 'last_name' , 'email'** ) and a 
 table **files** for the registration of attachments with new 
 fields (**title, url, attachmentable_id, attachmentable_type** )

```console
	use ClaimMail{
        register as registerClaim;
    }

    public function register(Request $request){
        $addData = [
            "request_channel_slug"=>"email",
            "response_channel_slug"=>"email",
        ];
        return $this->registerClaim($request,$addData);
    } 
```

or change the logic of the code

```console
 use ClaimMail{
        register as registerClaim;
    }

    public function register(Request $request){
        
        // Your logic here

    } 
```
