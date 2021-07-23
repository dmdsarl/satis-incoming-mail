<?php
return [
    "table" => "my_table",
    "message_format" => "html_text", // html_text or plain_text
    "object" => [
        'first_name' => 'first_name',
        'last_name' => 'last_name',
        'email' => 'email',
        "message"=>"message",
        "date"=>"date",
        "attachments"=>"attachments", //array
    ],
    "app_registration"=>[
        'app_name' => 'Care - Rwanda', //Care - Rwanda
        'url' => 'http://localhost:8000/satis/incoming/mail', // Link of api saving
        'mail_server' => 'smtp.gmail.com',
        'mail_server_username' => 'test.dmd.arafath@gmail.com',
        'mail_server_password' => 'P@ssword@DMD',
        'mail_server_port' => '587',
        'app_login_url' => 'http://localhost:8000/oauth/token',
        'app_login_params' => [
            "grant_type" => "password",
            "client_id" => "93f64252-da39-4f90-86e8-c14a500c6d39",
            "client_secret" => "r3CcD12cCIhpMJAwI7ipcfJw8eab01Mprq81f7vc",
            "username" => "incoming-mail-care@dmdconsult.com",
            "password" => "123456"
        ],
    ]
];
