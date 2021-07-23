<?php


namespace Satis\Incomingmail;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Satis\Incomingmail\Services\IncomingMailService;
use Satis\Incomingmail\Traits\ConfigValue;

class IncomingMail
{
    use ConfigValue;

   /* public  function registerClaim(Request $request,$addClaimValue = []){
        $status = "incomplete";
        foreach ($request->data as $datum) {
            $datum['name'] = $datum['header']['from']['name'];
            $datum['address'] = $datum['header']['from']['address'];
            $datum['date'] = $datum['header']['date'];
            $name_array = explode(" ", $datum["name"], 2);
            $identity = [
                $this->getIdentity()["first_name"] => $name_array[0],
                $this->getIdentity()["last_name"] => sizeof($name_array) > 1 ? $name_array[1] : $name_array[0],
                $this->getIdentity()["email"] => $datum['address'],
            ];
            $incomingMailService = new IncomingMailService();
            $identityId = $incomingMailService->storeOrRetrieveIdentity($identity);
            DB::table($this->tableClaims())
                ->insertGetId([
                    'id' => Str::uuid(),
                    "reference" => $incomingMailService->createReference($identityId),
                    $this->getClaim()['event_occured_at'] => $datum['date'],
                    $this->getClaim()['description'] => $datum['plainMessage'],
                    $this->getClaim()['description_initial'] => $datum['plainMessage'],
                    $this->getClaim()['status'] => $status,
                    $this->getClaim()['recipient_id'] => $identityId,
                    $this->getClaim()["created_at"] => $datum['date'],
                    "updated_at"=>now()
                ]+$addClaimValue);
        }
        return true;
    }*/
}
