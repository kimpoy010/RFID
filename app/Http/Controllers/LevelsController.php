<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\Section;
class LevelsController extends Controller
{
    public function getSections($id){
    	$sections = Section::where('level_id',$id)->get();
    	return response()->json([
    		'sections'=>$sections
    	]);
    }
}
