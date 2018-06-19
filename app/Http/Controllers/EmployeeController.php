<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Level;
use App\User;
use App\UserDetail;
use App\Guardian;
use App\Http\Requests\NewEmployee;
use Session;
use DB;

class EmployeeController extends Controller
{
    public function addNewEmployee(){
    	$levels = Level::all();
    	return view('pages.addemployee',compact('levels'));
    }

     public function getEmployeesList(){
        $user = User::find(Auth::id());
    	$levels = DB::table('users as u')
    		->join('user_details as ud','u.id','=','ud.user_id')
    		->select('u.id as id_user', 'u.username as student_number','ud.first_name','ud.last_name','ud.middle_name','ud.designation','u.category')
            ->where('u.school_id',$user->school_id)
            ->where('u.category','!=','student')
            ->where('u.id','!=',1)
            ->get();

    	return view('pages.employees',compact('levels'));
    }

    public function postNewEmployee(NewEmployee $request){
        $sch = User::find(1);

        if ($request['rfid_number'] == null) {
            $rfidnum = uniqid();
        }else{
             $rfidnum = $request['rfid_number'];
        }

        $user = new User();
        $user->school_id = $sch->school_id;
        $user->rfid_number = $rfidnum;
        $user->username = $request['username'];
        $user->password = bcrypt($request['contact_number']);
        $user->status = 0;
        $user->category = $request['employee_category'];

            if ($user->save()) {

                if ($file = $request->file('file')) {
                   $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                   $path = 'images/profiles/'.$filename;
                   $file->move('images/profiles/', $filename);
                }elseif($request['mydata']){
                    $encoded_data = $request['mydata'];
                    $binary_data = base64_decode( $encoded_data );
                    $filename = uniqid() .'.jpg';
                    $path = 'images/profiles/'.$filename;
                    $result = file_put_contents('images/profiles/'.$filename, $binary_data );
                }else{
                    $path = 'images/default.png';
                }
                                
                $details = new UserDetail();
                $details->user_id = $user->id;
                $details->section_id =  $request['section'];
                $details->first_name = titleCase($request['first_name']);
                $details->middle_name = titleCase($request['middle_name']);
                $details->last_name = titleCase($request['last_name']);
                $details->address = $request['address'];
                $details->bday = $request['bday'];
                $details->gender = $request['gender'];
                $details->designation = $request['designation'];
                $details->contact_number = $request['contact_number'];
                $details->photo = $path;
                if ($details->save()) {
                    $guardian = new Guardian;
                    $guardian->user_id = $user->id;
                    $guardian->guardian_name = htmlentities($request['guardian_name']);
                    $guardian->guardian_address = $request['guardian_address'];
                    $guardian->guardian_number = $request['guardian_number'];

                    if ($guardian->save()) {
                        Session::flash('success',"New employee has been registered!");
                        return redirect()->route('new.employee');
                    }
                    
                }
            }
    }
}
