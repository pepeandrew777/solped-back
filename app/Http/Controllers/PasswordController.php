<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReseteoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function olvido_pass(Request $request)
    {
        $email = $request->input('email');
        $token = Str::random(12);

        DB::table('password_resets')->insert([
            'email'=> $email,
            'token' => $token
        ]);

        Mail::send('resetpassword', ['token' => $token], function (Message $message) use ($email) {                              
            $message->subject('Resetea tu Password');         
            $message->to($email);
            
        });

        return response([
            'message' => 'Verifica tu Correo electronico'
        ]);
    }

    public function reset_password(ReseteoRequest $request)
    {
        $passwordReset = DB::table('password_resets')->where('token', $request->input('token'))->first();

        if (!$usuario = User::where('v_email', $passwordReset->email)->first())
        {
            throw new NotFoundHttpException('Usuario no encontrado');
        }
        $usuario->v_password = Hash::make($request->input('password'));
        $usuario->save();       
        return response([
            'message' => 'Reseteo exitoso'
        ]);
    }
}
