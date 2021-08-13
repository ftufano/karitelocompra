<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index() { //Function to show the backUsers info

        if(session()->has('userEmail')){ //if is a session active and such session has an 'userEmail' parameter
            
            $backUsers = User::orderBy('created_at', 'asc')->get(); //fill the $backUsers info with the User model query of all users on the table
            return view('users_management')->withUsers($backUsers); //return the users_management view with the user's contained in $backUsers

        }
        return redirect('/'); //if there's no session or if it is it has not an 'userEmail' parameter, then redirect to the root page

    }

    //
    public function store(Request $request) { //Function to create (store) a new user on the database, the request is for the user info
        //that is meant to be stored

        try {//try the desired behavior
            
            $user = new User; //filling the $user variable invoking the User model previously created
            $user->name     = $request->name; //filling model name with typed name
            $user->email    = $request->email; // filling model email with typed email
            $user->phone    = $request->phone; // filling model phone with typed phone
            $user->password = Hash::make($request->password); // filling model password with typed password
            $user->type = $request->type; //filling model type with typed type
            $user->save(); //method to insert the filled info into the database
            
            return redirect('backusers')->with('successMsg', 'Usuario creado exitosamente'); //after insert the new user redirect to the root view
            //with a success message for the user insert

        } catch (\Exception $e) { //if an exception comes up, here is were we get it
            return back()->withInput(); //returns to the same view but no insert has been done
        }
    }

    public function update(Request $request) { //Function to update any user's info, the request is for the user info
        //that is meant to be stored
        
        try { //try the desired behavior
            
            $user = User::findOrFail($request->id); //filling the $user variable using the User model to find the user where the ID matches the $request->id
            $user->name     = $request->name; //filling model name with typed name
            $user->email    = $request->email; // filling model email with typed email
            $user->phone    = $request->phone; // filling model phone with typed phone
            if($request->password != '') //if the type password is not empty
                $user->password = Hash::make($request->password); //fill the model password with the typed password
            $user->type = $request->type; //filling model type with typed type
            $user->update(); //method to update the user's update on the database
            
            return redirect('backusers')->with('successMsg', '¡Usuario Editado!'); //return to the same view with a success message

        } catch (\Exception $e) { //if an exception comes up, here is were we get it

            return back()->withInput(); //returns to the same view but no update has been done
            
        }
    }

    public function delete(Request $request) { //Fuction to delete an user, the request is for the user info
        //that is meant to be stored

        try {//try the desired behavior

            $user = User::findOrFail($request->id); //filling the $user variable using the User model to find the user where the ID matches the $request->id
            $user->delete(); //method to delete the user on the database
            return redirect('backusers')->with('successMsg', '¡Usuario Eliminado!'); //return to the same view with a success message
        
        } catch (\Exception $e) { //if an exception comes up, here is were we get it
            
            return back()->withInput(); //returns to the same view but no dalete has been done

        }
    }
}
