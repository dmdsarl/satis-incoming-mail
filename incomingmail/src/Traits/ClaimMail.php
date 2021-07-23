<?php
namespace Satis\Incomingmail\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Satis\Incomingmail\IncomingMail;
use Satis\Incomingmail\Services\IncomingMailService;

trait ClaimMail{

    use ConfigValue;
    use Attachment;
    public function register(Request $request,$addColumn = []){
        $incomingMailService = new IncomingMailService();
        $status = "incomplete";
        foreach ($request->data as $datum) {
            $formatData = $incomingMailService->formatData($datum);

            $identity = [
                $this->getObject()["first_name"] => $formatData["first_name"],
                $this->getObject()["last_name"] => $formatData["last_name"],
                $this->getObject()["email"] => $formatData['address'],
            ];
            $identityId = $incomingMailService->storeOrRetrieveIdentity($identity);
            $text = $this->messageFormat()=="html_text"?$datum['htmlMessage']:$datum['plainMessage'];
            $claimId =Str::uuid();
            DB::table($this->objectTable())
                ->insertGetId([
                        'id' => $claimId,
                        'reference' => $incomingMailService->createReference($identityId),
                        'description' => $text,
                        'description_initial' => $text,
                        'status' => $status,
                        'recipient_id' => $identityId,
                        "created_at" => $formatData['date'],
                        "updated_at"=>now()
                    ]+$addColumn);
            Log::info(["claimId"=>$claimId]);
            $attachments = $datum["attachments"];
            for ($i = 0; $i < sizeof($attachments); $i++) {
                $save_img = $this->base64SaveImg($attachments[$i], 'claim-attachments/', $i);
                DB::table("files")->insertGetId([
                   "id"=>Str::uuid(),
                   "title"=>"Incoming mail attachment $i",
                   "url"=>$save_img['link'],
                   "attachmentable_id"=>$claimId,
                   "attachmentable_type"=>"App\Models\Claim"
                ]);
            }
        }
        return true;
    }
}
