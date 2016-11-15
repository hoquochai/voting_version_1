<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CheckEmailController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $inputs = $request->only('email');
            $url = 'http://api.emailvalidator.co/?AccessKey=30918434.3c05.493e.adc9.4024b7527bce&EmailAddress=' . $inputs['email'] .'&VerificationLevel=4';
            $json = file_get_contents($url);
            $array = json_decode($json, true);

            if ($array['IsValid']) {
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false]);
    }
}
