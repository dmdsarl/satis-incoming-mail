<?php
return [
    "table" => "my_table", // Represents the name of the table in which you want to save the different received mails
    "message_format" => "html_text", // The format in which you want to save the messages received from the mail :
    // html_text => to save the message in html format and plain_text for plain text
    "object" => [ // The different fields that will be taken into account to record in the table
        "first_name" => "first_name", // Customize the name of the first name field of the sender
        "last_name" => "last_name", // Customize the name of the sender "s name field
        "email" => "email", // Customize the name of the email field
        "message" => "message", // Customize the field name of the message to be saved
        "date" => "date", // Customize the field name of the date the mail was sent
        "attachments" => "attachments", // Customize the name of the file field, this field is of type json
    ],
    "app_registration" => [ //Incoming mail service subscription information
        "app_name" => 'Care - Rwanda', // Name of your application,
        "url" => 'http://localhost:8000/satis/incoming/mail', // Registration link for incoming mail
        "mail_server" => 'smtp.gmail.com', // Mail host
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
