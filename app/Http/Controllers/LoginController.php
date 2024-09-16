<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function get_code(Request $request)
    {
        $validatedData =$request->validate([
            'phone' => ['required', 'regex:/^0[0-9]{10}$/'],
        ], [
            'phone.required' => 'وارد کردن شماره تلفن الزامی است.',
            'phone.regex' => 'شماره تلفن باید 11 رقمی باشد و با 0 شروع شود.',
        ]);
    }
}
