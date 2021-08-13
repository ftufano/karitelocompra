<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingSeason;
use App\Models\BookingSeasonDay;

class DatesController extends Controller
{
    //
    public function index() { //default method called from the route GET 'dates'
        if(session()->has('userEmail')){ //if there is a session active with the 'userName' parameter

            $dates = BookingSeason::orderBy('created_at', 'asc')->get(); //get the period dates from DB

            $quotas = BookingSeasonDay::orderBy('created_at', 'asc')->get(); //get the period date quotas from DB

            if (!$dates->isEmpty()){  //if the $dates query is not empty

                foreach ($dates as $date){ //foreach element of the query as a named variable
                    $eventData[] = [ //create an array to set the elements for the reserved words of the fullcalendar
                        'id' => $date->id, //getting on the 'id' position the id value
                        'title' => $date->type, //getting on the 'title' position the type value
                        'start' => $date->start_date, //getting on the 'start' position the start_date value
                        'end' => $date->end_date, //getting on the 'end' position the end_date value
                        'ship' => $date->shipment_date, //getting on the 'ship' position the shipment_date value
                        'quota' => 'N/A', //setting on the 'quota' value N/A since it does not apply for the period date
                        'bid' => 'N/A', //setting on the 'bid' value N/A since it does not apply for the period date
                        'color' => $date->type == 'Aéreo' ? '#4dc4ff' : '#ff884d', //if type is 'Aéreo' then set the first hex color, else the second hex color
                    ];
                }

                if (!$quotas->isEmpty()){ //if the $quotas query is not empty
                    
                    foreach($quotas as $quota){ //foreach element of the query as a named variable
                        $eventData[] = [ //reopen the previous created array
                            'id' => $quota->id, //getting on the 'id' position the id value
                            'title' => $quota->type, //getting on the 'title' position the type value
                            'start' => $quota->day_date, //getting on the 'start' position the start_date value
                            'end' => 'N/A', //setting on the 'end' value N/A since it does not apply for the period date quota
                            'ship' => 'N/A', //setting on the 'ship' value N/A since it does not apply for the period date quota
                            'quota' => $quota->quota, //getting on the 'quota' position the quota value
                            'bid' => $quota->booking_season_id, //getting on the 'bid' position the booking_season_id value
                            'color' => $quota->type == 'Cupos Aéreo' ? '#71ddff' : '#ffad71', //if type is 'Cupos Aéreo' then set the first hex color, else the second hex color
                        ];
                    }

                }
    
                return view('dates_management')->withDates('events: '.json_encode($eventData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES).',')->withEventData(json_encode($eventData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)); //then return the 'dates_management' view
                //withDates and withEventData methods name can change to with"AnythingYouWantToPut" and then put on the view $anythingyouwanttoput
            }else{

                return view('dates_management'); //then return the 'dates_management' view only

            }

        }
        return redirect('/'); //else redirect the request to the root view
    }

    public function store(Request $request){//Function to create (store) a new period on the database, the request is for the season info
        //that is meant to be stored

        try{ //try the desired behavior

            $season = new BookingSeason; //filling the $season variable invoking the BookingSeason model previously created
            $season->type = $request->type; //getting on the 'season->type' position the '$request->type' value
            $season->start_date = $request->start_date; //getting on the 'season->start_date' position the '$request->start_date' value
            $season->end_date = $request->end_r_date; //getting on the 'season->end_date' position the '$request->end_r_date' value
            $season->shipment_date = $request->shipment_date; //getting on the 'season->shipment_date' position the '$request->shipment_date' value
            $season->save(); //store the new period on DB

            return redirect('dates')->with('successSeason', 'Periodo creado exitosamente'); //return the dates view with the success message

        } catch (\Exception $e) { //if an exception comes up, here is were we get it

            return back()->with('errorSession', 'Hubo un error al momento de crear el periodo. 
                Revise la información colocada e intente nuevamente'); //return back the dates view with the error message

        }
    }

    public function update(Request $request){//Function to update a period on the database, the request is for the season info
        //that is meant to be updated

        try{ //try the desired behavior

            $season = BookingSeason::findOrFail($request->id); //find the period by ID from DB

            $season->type = $request->type; //getting on the 'season->type' position the '$request->type' value
            $season->start_date = $request->start_date; //getting on the 'season->start_date' position the '$request->start_date' value
            $season->end_date = $request->end_r_date; //getting on the 'season->end_date' position the '$request->end_r_date' value
            $season->shipment_date = $request->shipment_date; //getting on the 'season->shipment_date' position the '$request->shipment_date' value
            $season->update(); //update the requested period on DB

            return redirect('dates')->with('successSeason', 'Periodo actualizado exitosamente'); //return the dates view with the success message

        } catch (\Exception $e) { //if an exception comes up, here is were we get it

            return back()->with('errorSession', 'Hubo un error al momento de actualizar el periodo. 
                Revise la información colocada e intente nuevamente'); //return back the dates view with the error message

        }
    }

    public function delete(Request $request) { //Fuction to delete a period, the request is for the season info
        //that is meant to be deleted

        try {//try the desired behavior

            $season = BookingSeason::findOrFail($request->id); //find the period by ID from DB
            $season->delete(); //method to delete the period on DB
            return redirect('dates')->with('successSeason', '¡Periodo Eliminado!'); //return to the dates view with the success message
        
        } catch (\Exception $e) { //if an exception comes up, here is were we get it
            
            $errorCode = $e->errorInfo[1]; //if the exception was a SQL exception, here we get the error code from the error Info message at position 1
            
            if($errorCode == 1451){ //if the exception was a SQL exception and the error code is equal to 1451 value

                return back()->with('errorSession', 'No se puede eliminar el periodo ya que existe al menos 1 cupo asignado a este periodo');
                //return an error message indicating that you can not delete a period that has quotas assigned to it (parent element cannot be eliminated)
            
            }else{ //if the exception is different than the 1062 SQL exception

                return back()->with('errorSession', 'Hubo un error al momento de eliminar el periodo. 
                Revise la información colocada e intente nuevamente'); //return back the dates view with the error message

            }

        }
    }

    public function quotaStore(Request $request){//Function to create (store) a new period quota on the database, the request is for the quota info
        //that is meant to be stored

        try{ //try the desired behavior

            for($i = $request->start_date; $i <= $request->end_date; $i++){ //do a loop from the start date upto the end date and increment the $i value

                $seasonDay = new BookingSeasonDay; //filling the $season variable invoking the BookingSeasonDay model previously created
                $seasonDay->booking_season_id = $request->season_id; //getting on the 'seasonDay->booking_season_id' position the '$request->season_id' value
                $seasonDay->type = $request->type; //getting on the 'seasonDay->type' position the '$request->type' value
                $seasonDay->day_date = $i; //getting on the 'seasonDay->day_date' position the '$i' value which is the current day date meant to be stored
                $seasonDay->quota = $request->quota; //getting on the 'seasonDay->quota' position the '$request->quota' value
                $seasonDay->save(); //store the new period quota(s) on DB

            }

            return redirect('dates')->with('successSeason', 'Cupo(s) creado(s) exitosamente'); //return to the dates view with the success message

        } catch (\Exception $e) { //if an exception comes up, here is were we get it

            return back()->with('errorSession', 'Hubo un error al momento de crear el (los) cupo(s). 
                Revise la información colocada e intente nuevamente'); //return back the dates view with the error message

        }
    }

    public function quotaUpdate(Request $request){//Function to update a period quota on the database, the request is for the quota info
        //that is meant to be stored

        try{ //try the desired behavior

            $seasonDay = BookingSeasonDay::findOrFail($request->id); //find the quota by ID from DB

            $seasonDay->day_date = $request->start_date; //getting on the 'seasonDay->day_date' position the '$i' value which is the current day date meant to be stored
            $seasonDay->quota = $request->quota; //getting on the 'seasonDay->quota' position the '$request->quota' value
            $seasonDay->update(); //update the requested quota on DB

            return redirect('dates')->with('successSeason', 'Cupo(s) actualizado(s) exitosamente'); //return to the dates view with the success message

        } catch (\Exception $e) { //if an exception comes up, here is were we get it

            return back()->with('errorSession', 'Hubo un error al momento de actualizar el (los) cupo(s). 
                Revise la información colocada e intente nuevamente'); //return back the dates view with the error message

        }
    }

    public function quotaDelete(Request $request) { //Fuction to delete a quota, the request is for the quota info
        //that is meant to be stored

        try {//try the desired behavior

            $seasonDay = BookingSeasonDay::findOrFail($request->id); //find the quota by ID from DB
            $seasonDay->delete(); //method to delete the quota on the database
            return redirect('dates')->with('successSeason', '¡Cupo(s) Eliminado(s)!'); //return to the dates view with the success message
        
        } catch (\Exception $e) { //if an exception comes up, here is were we get it
            
            return back()->with('errorSession', 'Hubo un error al momento de eliminar el (los) cupo(s). 
                Revise la información colocada e intente nuevamente');  //return back the dates view with the error message

        }
    }
}
