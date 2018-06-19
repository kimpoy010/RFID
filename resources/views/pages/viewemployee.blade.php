@extends('layouts.auth')
@section('title','View Employee')
@section('page-title','Employee Information')
@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/student-list.css') }}">
@endsection

@section('content')
  	<div class="row">
  		<div class="col-md-3">
  			<div class="photo-holder">
	  			<img src="{{ asset($employee->photo) }}" class="img-responsive img-thumbnail" id="photo-holder">
	  		</div>
	  		<div class="button">
	  			<a href="{{ route('edit.student',$employee->user_id) }}" class="btn btn-success btn-block"><i class="fa fa-pencil"></i> Update Employee Info</a><br>
	  			<a href="{{ route('employees.list') }}" class="btn btn-warning btn-block"><i class="fa fa-reply"></i> Return to Employees List</a>
	  		</div>
  		</div>
  		<div class="col-md-8">
  			<table class="table table-condensed table-bordered">
  				<tr>
  					<td colspan="4" class="text-center"><strong>PERSONAL INFORMATION</strong></td>
  				</tr>
  				<tr>
  					<td><strong>Employee Number:</strong></td>
  					<td colspan="3">{{ $employee->student_number }}</td>
  				</tr>
  				<tr>
  					<td><strong>Full Name:</strong></td>
  					<td colspan="3">{{ $employee->last_name.', '. $employee->first_name.' '.$employee->middle_name }}</td>
  				</tr>
  				<tr>
  					<td><strong>Birthday:</strong></td>
  					<td>{{ date('F d, Y',strtotime($employee->bday)) }}</td>
  					<td><strong>Gender:</strong></td>
  					<td class="capitalize">{{ $employee->gender }}</td>
  				</tr>
  				<tr>
  					<td><strong>Address:</strong></td>
  					<td colspan="3">{{ $employee->address }}</td>
  				</tr>
          @if($employee->category == 'teacher')
  				<tr>
  					<td colspan="4" class="text-center"><strong>Advisory Class</strong></td>
  				</tr>
  				<tr>
  					<td><strong>Grade/Year Level:</strong></td>
  					<td colspan="3">Grade {{ $employee->lvl_name }}</td>
  				</tr>
  				<tr>
  					<td><strong>Section:</strong></td>
  					<td colspan="3">Section {{ $employee->sec_name }}</td>
  				</tr>
          @endif
          <tr>
            <td colspan="4" class="text-center"><strong>EMERGENCY CONTACT</strong></td>
          </tr>
          <tr>
            <td><strong>Contact Name:</strong></td>
            <td colspan="3">{{ $employee->guardian_name }}</td>
          </tr>
          <tr>
            <td><strong>Contact Address:</strong></td>
            <td colspan="3">{{ $employee->guardian_address }}</td>
          </tr>
          <tr>
            <td><strong>Contact #:</strong></td>
            <td colspan="3">+63{{ $employee->guardian_number }}</td>
          </tr>
  			</table>
  		</div>

  	</div>
@endsection

@section('scripts')

@endsection
