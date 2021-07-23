<?php

namespace App\Http\Controllers\IncomingMail;

use App\Http\Controllers\Controller;
use App\Http\Traits\GenerateClaimReference;
use Illuminate\Http\Request;
use Satis\Incomingmail\IncomingMail;
use Satis\Incomingmail\Traits\ClaimMail;
use Satis\Incomingmail\Traits\GeneralMail;

class IncomingMailController extends Controller
{
    use GeneralMail;
    //use ClaimMail;
}
