<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    //
    public function pwdResetById($id, Request $request){ //Function to reset the user's password following the ID obtained
        //the id is obtained from the email link as a ?get parameter and passed to this controller through the route/{id} declared
        //the request is for the user info that is meant to be stored

        if (!$request->hasValidSignature()){ //if the link validity time parameter has expired (has a valid signature yet)

            return redirect('/')->with('lnkXprd', 'El link del email ha expirado, por favor solicite nuevamente
            reestablecer la contraseña a través de la opción "¿Olvidaste tu contraseña?"');
            //return to the root view with an error message indicating that the email link has expired and need to request another one

        }else{ //if the link has not expired yet
            
            $id = Crypt::decrypt($id); //fill the $id variable with the decrypted the id
            return view('reset_password', compact('id')); //return the view reset_password and passing the parameter 'id'

        }
    }

    public function update(Request $request){ //Function to update the user's password

        try { //try the desired behavior

            $user = User::findOrFail($request->id); //filling the $user variable using the User model to find the user where the ID matches the $request->id
            if($request->password != '') //if the type password is not empty
                $user->password = Hash::make($request->password); //fill the model password with the typed password
            $user->update(); //method to update the user's update on the database
            
            return redirect('/')->with('successPwdRst', '¡Se modificó la contraseña exitosamente!');
            //return to the root view with a success message

        } catch (\Exception $e) { //if an exception comes up, here is were we get it

            return back()->with('errorPwdRst', 'Hubo un problema al restablecer su contraseña, 
            por favor intente nuevamente');
            //return an error message indicating to try again
        }
    }
}
