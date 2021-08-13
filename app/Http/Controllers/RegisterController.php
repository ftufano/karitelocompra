<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function store(Request $request){ //Function to create (store) a new user on the database, the request is for the user info
        //that is meant to be stored

        try { //try the desired behavior

            $user = new User; //filling the $user variable invoking the User model previously created
            $user->name     = $request->name; //filling model name with typed name
            $user->email    = $request->email; // filling model email with typed email
            $user->phone    = $request->phone; // filling model phone with typed phone
            $user->password = Hash::make($request->password); // filling model password with typed password
            $user->type = $request->type; //filling model type with typed type
            $user->save(); //method to insert the filled info into the database
            
            return redirect('/')->with('successReg', 'Usuario creado exitosamente'); //after insert the new user redirect to the root view
            //with a success message for the user insert

        } catch (\Exception $e) { //if an exception comes up, here is were we get it

            $errorCode = $e->errorInfo[1]; //if the exception was a SQL exception, here we get the error code
            
            if($errorCode == 1062){ //if the exception was a SQL exception and the error code is equal to 1062 value

                return back()->with('errorReg', 'El E-Mail indicado ya se encuentra registrado');
                //return an error message indicating that the email already exists
            
            }else{ //if the exception is different than the 1062 SQL exception

                return back()->with(['errorReg'=>'Hubo un error al momento de registrar. 
                Revise la información colocada e intente nuevamente',
                'currentName'=>$request->name,
                'currentEmail'=>$request->email,
                'currentPhone'=>$request->phone,
                'currentPassword'=>$request->password]);
                //return an error message indicating that the typed credentials are wrong, and sending the name, email and password values obtained from the users
                //as parameters to set them back on the input field so the users can r  echeck them

            }
        }
    }
}
