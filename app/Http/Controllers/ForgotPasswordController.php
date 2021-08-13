<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use App\Mail\PasswordRequestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ForgotPasswordController extends Controller
{
    //
    public function sendResetMail(Request $request){ //method to send the email link for password resetting, the request is for the email address

        try{ //try the desired behavior

            $user = User::where('email', '=', $request->email)->firstOrFail(); //filling the $user variable with the MySQL query result
            //getting the user info where the email matches with the typed email

            $crpId = Crypt::encrypt($user->id); //filling the $crpId with the User ID encrypted

            $url = URL::temporarySignedRoute( //filling the $url variable with a temporary signed route in order to
                //set a valid time for the link sent
                'reset-password', now()->addMinutes(2), ['id' => $crpId] //this include the route itself previously created on the web routes file and catched by the ->name() property
                //followed by the link duration which is in minutes and set to two (2) and lastly the parameter we want to set on the email link itself
                //which is the id to be used on the password reset view in order to make the MySQL update query where the ID matches the ID sent on this link
            );

            Mail::to($request->email)->send(new PasswordRequestMail($url)); //Mail method used to send it to the typed email
            //then sending a new Mail previously created called PasswordRequestMail and sending the as a parameter the $url variable

            return redirect('/')->with('successFgtPwd', 'El enlace de restablecimiento de contraseñas ha sido enviado exitosamente. 
            Por favor revise la bandeja de entrada o de correo no deseado (spam) de su correo electrónico para continuar');
            //After the mail is sent it returns a redirect to the root page with a success message
    
        } catch (\Exception $e){ //if an exception comes up, here is were we get it

            if($e instanceof ModelNotFoundException){ //if the exception has an instance of ModelNotFoundException which means
                //that if the typed email is not found on the database thus it cannot use the model meant for it

                return back()->with('errorReg', 'El E-Mail indicado no se encuentra registrado');
                //then return an error message indicating that the typed email is not registered
            
            }else{ //if the exception is different that ModelNotFoundException

                return back()->with(['errorReg'=>'Hubo un error al momento de enviar el enlace. 
                Revise la información colocada e intente nuevamente',
                'currentEmail'=>$request->email]); //return an error message and send as a parameter the typed email so users can check what they have typed
            }
        }
    
    }
}
