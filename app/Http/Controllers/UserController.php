<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\User;
use App\UserDetail;
use App\Guardian;
use App\Http\Requests\NewStudent;
use Session;
class UserController extends Controller
{
    public function postNewStudent(NewStudent $request){

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
        $user->category ='student';

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
                $details->photo = $path;
                if ($details->save()) {

                    $guardian = new Guardian;
                    $guardian->user_id = $user->id;
                    $guardian->guardian_name = titleCase($request['guardian_name']);
                    $guardian->guardian_address = $request['address'];
                    $guardian->guardian_number = $request['contact_number'];

                    if ($guardian->save()) {
                        Session::flash('success',"New student has been registered!");
                        return redirect()->route('new.student');
                    }

                }
            }
    }
}
