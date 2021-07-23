<?php
use App\Http\Controllers\IncomingMail\IncomingMailController;
Route::post('satis/incoming/mail', [IncomingMailController::class, 'saveIncomingMail']);
