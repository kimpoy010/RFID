<?php

use Illuminate\Database\Seeder;
use App\School;
use App\User;
use App\UserDetail;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sch = new School();
        $sch->school_name = 'Carmen National High School';
        $sch->school_address = 'Carmen, Zaragoza, Nueva Ecija';
        $sch->contact_number = '+639056600153';

        if ($sch->save()) {
        	$user = new User();
        	$user->school_id = $sch->id;
            $user->rfid_number = uniqid();
        	$user->email = 'school@gmail.com';
        	$user->username = 'admin';
        	$user->password = bcrypt('admin1234');
        	$user->status = 1;
        	$user->category ='admin';

        		if ($user->save()) {
        			$details = new UserDetail();
        			$details->user_id = $user->id;
        			$details->first_name = 'Juan';
        			$details->middle_name = 'M';
        			$details->last_name = 'Dela Cruz';
        			$details->address = 'admin';
        			$details->bday = '1991/09/10';
        			$details->gender = 'male';
                    $details->photo = 'images/default.png';
        			$details->save();
        		}
        }
    }
}
