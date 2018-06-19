<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\User;
use App\UserDetail;
use App\Section;
use App\Guardian;
use DB;
use Session;
class PagesController extends Controller
{
    public function getAddNewStudent(){
    	$levels = Level::all();
    	return view('pages.addstudent',compact('levels'));
    }

    public function getSections(){
        $sections = DB::table('sections as s')
            ->join('levels as l','s.level_id','=','l.id')
            ->select('l.level','l.category','s.*')
            ->get();
        $levels = Level::all();
        return view('pages.sections',compact('sections','levels'));
    }

     public function getStudentsList(){
       
    	$levels = DB::table('users as u')
    		->join('user_details as ud','u.id','=','ud.user_id')
    		->join('guardians as g', 'u.id','=','g.user_id')
    		->join('sections as sec', 'ud.section_id','=','sec.id')
    		->join('levels as lvl', 'sec.level_id','=','lvl.id')
    		->select('u.id as id_user', 'u.username as student_number','ud.first_name','ud.last_name','ud.middle_name','lvl.level as lvl_name','lvl.category as lvl_cat','sec.name as sec_name','g.guardian_number')
            ->where('u.school_id',1)
            ->where('u.category','student')->get();

    	return view('pages.students',compact('levels'));
    }

    public function postNewSection(Request $request){
        $section = new Section();
        $section->level_id = $request['level'];
        $section->school_id = 1;
        $section->name = $request['section_name'];
        if ($section->save()) {
            Session::flash('success',"New section has been added!");
            return back();
        }
    }

    public function deleteSection($id){
        $section = Section::find($id);
        $section->delete();
        Session::flash('error',"Section has been deleted!");
        return back();
    }

    public function getViewStudent($id){
            $fees = [];
            $total = 0;

            $student = DB::table('users as u')
                ->join('user_details as ud','u.id','=','ud.user_id')
                ->join('guardians as g', 'u.id','=','g.user_id')
                ->join('sections as sec', 'ud.section_id','=','sec.id')
                ->join('levels as lvl', 'sec.level_id','=','lvl.id')
                ->select('u.username as student_number','ud.*','lvl.level as lvl_name','lvl.category as lvl_cat','lvl.id as lvl_id','sec.name as sec_name','g.guardian_number','g.guardian_address','g.guardian_name')
                ->where('u.category','student')
                ->where('u.id',$id)->first();

            // $grades = DB::table('user_grades as g')
            //             ->where('g.level_id',$student->lvl_id)
            //             ->where('g.user_id',$student->id)->get();

            // $assessment =  Assessment::where('level_id', $student->lvl_id)->first();

            // if(!empty($assessment)){
            //   $fees = $assessment->details;
            //   $total= $assessment->details->sum('amount');
            // }


            return view('pages.viewstudent',compact('student'));
    }

    public function getEditStudent($id){
            $student = DB::table('users as u')
                ->join('user_details as ud','u.id','=','ud.user_id')
                ->join('guardians as g', 'u.id','=','g.user_id')
                ->join('sections as sec', 'ud.section_id','=','sec.id')
                ->join('levels as lvl', 'sec.level_id','=','lvl.id')
                ->select('u.rfid_number','u.username as student_number','ud.*','lvl.level as lvl_name','lvl.id as lvl_id','sec.name as sec_name','sec.id as sec_id','g.guardian_number','g.guardian_address','g.guardian_name')
                ->where('u.category','student')
                ->where('u.id',$id)->first();
            $levels = Level::all();

            return view('pages.updatestudent',compact('student','levels'));
    }

    public function updateStudentInfo(Request $request, $id){
        $sch = User::find(1);

        $user = User::find($id);
        $user->school_id = $sch->school_id;
        $user->username = $request['std_number'];
        $user->rfid_number = $request['rfid_number'];
        $user->password = bcrypt($request['contact_number']);
        $user->status = 0;
        $user->category ='student';

            if ($user->save()) {

                $details = UserDetail::where('user_id',$id)->first();
                $details->user_id = $user->id;
                $details->section_id =  $request['section'];
                $details->first_name = $request['first_name'];
                $details->middle_name = $request['middle_name'];
                $details->last_name = $request['last_name'];
                $details->address = $request['address'];
                $details->bday = $request['bday'];
                $details->gender = $request['gender'];

                if ($request->file('file')) {
                    $file = $request->file('file');
                    //set a unique file name
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    // //move the files to the correct folder
                    if ($file->move('images/profiles/', $filename)) {
                        $details->photo = 'images/profiles/'.$filename;
                    }
                }elseif($request['mydata']){
                    $encoded_data = $request['mydata'];
                    $binary_data = base64_decode( $encoded_data );
                    $filename = uniqid() .'.jpg';
                    $path = 'images/profiles/'.$filename;
                    $details->photo = $path;
                    $result = file_put_contents('images/profiles/'.$filename, $binary_data );
                }


                if ($details->save()) {
                    $guardian = Guardian::where('user_id',$id)->first();
                    $guardian->user_id = $user->id;
                    $guardian->guardian_name = $request['guardian_name'];
                    $guardian->guardian_address = $request['address'];
                    $guardian->guardian_number = $request['contact_number'];

                    if ($guardian->save()) {
                        Session::flash('success',"Student information has been updated!");
                        //return redirect()->route('view.student',$id);
                        return redirect()->route('students.list');
                    }
                }
            }
    }
}
