@extends('layouts.auth')
@section('title','View Student')
@section('page-title','Student Information')
@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/student-list.css') }}">
@endsection

@section('content')
  	<div class="row">
  		<div class="col-md-3">
  			<div class="photo-holder">
	  			<img src="{{ asset($student->photo) }}" class="img-responsive img-thumbnail" id="photo-holder">
	  		</div>
	  		<div class="button">
	  			<a href="{{ route('edit.student',$student->user_id) }}" class="btn btn-success btn-block"><i class="fa fa-pencil"></i> Update Student Info</a><br>
	  			<a href="{{ route('students.list') }}" class="btn btn-warning btn-block"><i class="fa fa-reply"></i> Return to Students List</a>
	  		</div>
  		</div>
  		<div class="col-md-8">
  			<table class="table table-condensed table-bordered">
  				<tr>
  					<td colspan="4" class="text-center"><strong>PERSONAL INFORMATION</strong></td>
  				</tr>
  				<tr>
  					<td><strong>Student Number:</strong></td>
  					<td colspan="3">{{ $student->student_number }}</td>
  				</tr>
  				<tr>
  					<td><strong>Full Name:</strong></td>
  					<td colspan="3">{{ $student->last_name.', '. $student->first_name.' '.$student->middle_name }}</td>
  				</tr>
  				<tr>
  					<td><strong>Birthday:</strong></td>
  					<td>{{ date('F d, Y',strtotime($student->bday)) }}</td>
  					<td><strong>Gender:</strong></td>
  					<td class="capitalize">{{ $student->gender }}</td>
  				</tr>
  				<tr>
  					<td colspan="4" class="text-center"><strong>CONTACT INFORMATION</strong></td>
  				</tr>
  				<tr>
  					<td><strong>Guardian Name:</strong></td>
  					<td colspan="3">{{ $student->guardian_name }}</td>
  				</tr>
  				<tr>
  					<td><strong>Guardian Address:</strong></td>
  					<td colspan="3">{{ $student->guardian_address }}</td>
  				</tr>
  				<tr>
  					<td><strong>Guardian Contact #:</strong></td>
  					<td colspan="3">+63{{ $student->guardian_number }}</td>
  				</tr>
  				<tr>
  					<td colspan="4" class="text-center"><strong>YEAR LEVEL/SECTION</strong></td>
  				</tr>
  				<tr>
  					<td><strong>Grade Level:</strong></td>
            @if($student->lvl_cat == 'G')
  					 <td colspan="3">Grade {{ $student->lvl_name }}</td>
            @elseif($student->lvl_cat == 'P')
              <td colspan="3">{{ $student->lvl_name }}</td>
            @else
              <td colspan="3">{{ ordinal($student->lvl_name) }} Year</td>
            @endif
  				</tr>
  				<tr>
  					<td><strong>Section:</strong></td>
  					<td colspan="3">Section {{ $student->sec_name }}</td>
  				</tr>
  				
          {{-- <tr>
  					<td colspan="4" class="text-center"><strong>Grades</strong></td>
  				</tr>

  				<tr>
  					<th><strong>Subject</strong></th>
  					<th>Term 1</th>
  					<th>Term 2</th>
  					<th>Term 3</th>
  					<th>Term 4</th>
  					<th>Final</th>
  					<th>Remarks</th>
  				</tr>
            @foreach($grades as $grade)
               <tr>
                  <td><strong>{{ $grade->subject_code }} - {{ $grade->subject_description }}</strong></td>
                  <td>{{ $grade->term1 }}</td>
     					<td>{{ $grade->term2 }}</td>
     					<td>{{ $grade->term3 }}</td>
     					<td>{{ $grade->term4 }}</td>
     					<td>{{ $grade->final }}</td>
     					<td>{{ $grade->remarks }}</td>
     				</tr>
            @endforeach
						<tr>
	  					<td colspan="4" class="text-center"><strong>Assessment</strong></td>
	  				</tr>

	  				<tr>
	  					<th><strong>Fee</strong></th>
	  					<th class="text-right">Amount</th>
	  				</tr>
	            @foreach($fees as $fee)
	               <tr>
	                  <td><strong>{{ $fee->fee_code }} - {{ $fee->fee_description }}</strong></td>
	                  <td class="text-right">{{ $fee->amount }}</td>
	     				</tr>
	            @endforeach
               <tr>
	  					<th><strong>Total:</strong></th>
	  					<th class="text-right">{{ number_format($total , 2) }} </th>
	  				</tr> --}}

  			</table>
  		</div>

  	</div>
@endsection

@section('scripts')

@endsection
