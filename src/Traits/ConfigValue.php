<?php

namespace Satis\Incomingmail\Traits;

use Illuminate\Support\Facades\Config;

trait ConfigValue
{

    public function objectTable()
    {
        return Config::get("incoming_mail.table");
    }

    public function messageFormat()
    {
        return Config::get("incoming_mail.message_format");
    }

    public function getObject()
    {
        return Config::get("incoming_mail.object");
    }

    public function getBaseUrl()
    {
        return "http://incoming-mail-service.local/api/";
    }

    public function getRegistrationUrl()
    {
        return $this->getBaseUrl()."subscribe";
    }

    public function tableIdentities()
    {
        return "identities";
    }


}
