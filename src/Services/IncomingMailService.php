<?php


namespace Satis\Incomingmail\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Satis\Incomingmail\Traits\ConfigValue;

class IncomingMailService
{
    use ConfigValue;

    public function storeOrRetrieveIdentity($data)
    {
        if(!$this->isIdentityExist($data)){
            $data["id"] =  Str::uuid();
            $identity = DB::table($this->tableIdentities())->insertGetId($data);
            $identity = $this->isIdentityExist($data);
            return $identity;
        }
        if (isset($data["claimer_id"])){
            $claimer_id = $data["claimer_id"];
            unset($data["claimer_id"]);
            DB::table($this->tableIdentities())->whereId($claimer_id)->update($data);
            $identity = $claimer_id;
            return $identity;
        }
        return $this->isIdentityExist($data);
    }

    protected function isIdentityExist($data){

        if(array_key_exists("claimer_id", $data) and $data['claimer_id'] != null and $data['claimer_id'] != "" ){
            $identity = DB::table($this->tableIdentities())->where('id', $data['claimer_id'])->first();
            if ($identity != null) {
                return $identity->id;
            }
            Log::info(["claimer identity"=>$identity]);
        }

        if(array_key_exists("email", $data) and $data['email'] != null and $data['email'] != ""){
            $identity = DB::table($this->tableIdentities())->where('email', $data['email'])->first();
            if ($identity != null) {
                return $identity->id;
            }
            Log::info(["email identity"=>$identity]);
        }

        return false;
    }

    public function createReference($recipient_id)
    {
        $claimsNumber = DB::table($this->objectTable())
                ->whereBetween('created_at', [
                    Carbon::now()->startOfYear()->format('Y-m-d H:i:s'),
                    Carbon::now()->endOfYear()->format('Y-m-d H:i:s')
                ])->get()->count() + 1;
        return strtoupper('CRW-'. substr($recipient_id, 0, 4). "{$claimsNumber}". Carbon::now()->timestamp);
    }

    public function formatData($datum){
        $datum['name'] = $datum['header']['from']['name'];
        $datum['address'] = $datum['header']['from']['address'];
        $datum['date'] = $datum['header']['date'];
        $name_array = explode(" ", $datum["name"], 2);
        $datum['first_name'] = $name_array[0];
        $datum['last_name'] = sizeof($name_array) > 1 ? $name_array[1] : $name_array[0];
        return $datum;
    }

}
