<?php

namespace Satis\Incomingmail\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Satis\Incomingmail\Services\IncomingMailService;

trait GeneralMail
{

    use ConfigValue;
    use Attachment;

    public function register(Request $request, $addColumn = [])
    {
        $incomingMailService = new IncomingMailService();
        foreach ($request->data as $datum) {
            $formatData = $incomingMailService->formatData($datum);
            $object = [
                $this->getObject()["first_name"] => $formatData["first_name"],
                $this->getObject()["last_name"] => $formatData["last_name"],
                $this->getObject()["email"] => $formatData['address'],
                $this->getObject()["message"] => $this->messageFormat() == "html_text" ? $datum['htmlMessage'] : $datum['plainMessage'],
                $this->getObject()["date"] => $formatData['date'],
            ];

            $attachments = $datum["attachments"];
            $object["attachments"] = [];
            for ($i = 0; $i < sizeof($attachments); $i++) {
                $save_img = $this->base64SaveImg($attachments[$i], 'claim-attachments/', $i);
                array_push($object["attachments"],$save_img['link']);
            }
            $object["attachments"] = json_encode($object["attachments"]);
            DB::table($this->objectTable())
                ->insertGetId($object + $addColumn);
        }
        return true;
    }

}
