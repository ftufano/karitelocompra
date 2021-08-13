<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function index() { //Function to show the backUsers info

        if(session()->has('userEmail')){ //if is a session active and such session has an 'userEmail' parameter
            
            return view('new_order'); //return the users_management view with the user's contained in $backUsers

        }
        return redirect('/'); //if there's no session or if it is it has not an 'userEmail' parameter, then redirect to the root page

    }

    public function store(Request $request) {//Function to create (store) a new order list on the database, the request is for the season info
        
    }

}
    

