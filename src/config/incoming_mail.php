<?php
return [
    "table" => "my_table", // Représente le nom de la table dans laquelle vous voulez enregistrer les différents mails reçus
    "message_format" => "html_text", //  Le format d'enregistrement des messages reçu depuis le mail :
    // html_text => pour enregistrer le message en format html et plain_text pour le plain text
    "object" => [ // Les différents champs qui seront prise en compte pour enregistrer dans la table
        'first_name' => 'first_name', // Personnaliser le nom du champs du prénom de l"expéditeur
        'last_name' => 'last_name', // Personnaliser le nom du champs du nom de l"expéditeur
        'email' => 'email', // Personnaliser le nom du champs du mail
        "message"=>"message", // Personnaliser le nom du champs du message a enregistré
        "date"=>"date", // Personnaliser le nom du champs du date d'envoie du mail
        "attachments"=>"attachments", // Personnaliser le nom du champs des fichiers, ce champs est de type json
    ],
    "app_registration"=>[ //Informations de subscription au service de incoming mail
        'app_name' => 'Care - Rwanda', // Nom de votre application,
        'url' => 'http://localhost:8000/satis/incoming/mail', // Lien d'enregistrement des mails reçus
        'mail_server' => 'smtp.gmail.com', // Maim host
        'mail_server_username' => 'test.dmd.arafath@gmail.com', // Mail username
        'mail_server_password' => 'P@ssword@DMD', // Mail password
        'mail_server_port' => '587', // Mail port
        'app_login_url' => 'http://localhost:8000/oauth/token', // Authentification api
        'app_login_params' => [ // Informations pour se connecter à votre projet. Les différents colunms à changer suivant
            // les arguments nécessaires pour se connecter à votre project
            "grant_type" => "password",
            "client_id" => "93f64252-da39-4f90-86e8-c14a500c6d39",
            "client_secret" => "r3CcD12cCIhpMJAwI7ipcfJw8eab01Mprq81f7vc",
            "username" => "incoming-mail-care@dmdconsult.com",
            "password" => "123456"
        ],
    ]
];
