@extends('layouts.auth')
@section('title','Update Employee Info')
@section('page-title','Employee Management')
@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/addstudent.css') }}">
@endsection

@section('content')
  	<div class="row">
  		<div class="col-md-12">
  			<h4>Employee Information</h4>
  		</div>
	  	<form method="POST" action="{{ route('update.employee',$employee->user_id) }}" data-parsley-validate enctype="multipart/form-data">
	  		<div class="col-md-4">
	  			{{ csrf_field() }}
	  			<div class="form-group">
	  				<label for="rfid_number">RFID No:</label><span id="rfid_number-error"></span>
	  				<input type="text" name="rfid_number" id="rfid_number" class="form-control" value="{{ $employee->rfid_number }}" readonly>
	  			</div>
	  			<div class="form-group">
	  				<label for="std_number">Student No:</label><span id="std_number-error"></span>
	  				<input type="text" name="std_number" class="form-control" required data-parsley-required-message="Please enter the student number!" data-parsley-errors-container="#std_number-error" value="{{ $employee->student_number }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="first_name">First Name:</label><span id="first_name-error"></span>
	  				<input type="text" name="first_name" class="form-control" required data-parsley-required-message="Please enter the student first name!" data-parsley-errors-container="#first_name-error" value="{{ $employee->first_name }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="middle_name">Middle Name/Initial:</label> 
	  				<input type="text" name="middle_name" class="form-control" value="{{ $employee->middle_name }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="last_name">Last Name:</label><span id="last_name-error"></span>
	  				<input type="text" name="last_name" class="form-control" required data-parsley-required-message="Please enter the student last name!" data-parsley-errors-container="#last_name-error" value="{{ $employee->last_name }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="last_name">Birthday:</label><span id="bday-error"></span>
	  				<input type="text" name="bday" class="form-control" id="bday" required data-parsley-required-message="Please enter the student birthday!" data-parsley-errors-container="#bday-error" value="{{ $employee->bday }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="last_name">Gender:</label> <span id="gender-error"></span>
	  				<select name="gender" class="form-control" required data-parsley-required-message="Please select the student gender!" data-parsley-errors-container="#gender-error">
	  					<option selected disabled>--Select Gender--</option>
	  					<option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
	  					<option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
	  				</select>
	  			</div>
	  		</div>
	  		<div class="col-md-4">
	  			<div class="form-group">
	  				<label for="address">Address:</label> <span id="address-error"></span>
	  				<input type="text" name="address" class="form-control" required data-parsley-required-message="Please enter the address!" data-parsley-errors-container="#address-error" value="{{ $employee->address }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="guardian_name">Employee Category:</label> <span id="emp_ategory-error"></span>
	  				<select name="emp_ategory" id="emp_ategory" class="form-control" required data-parsley-required-message="Please select employee category" data-parsley-errors-container="#emp_ategory-error">
	  					<option selected disabled>--Select Category--</option>
	  					<option value="teacher" {{ $employee->category == 'teacher' ? 'selected' : '' }} >Teacher</option>
	  					<option value="staff" {{ $employee->category == 'staff' ? 'selected' : '' }} >Staff</option>
	  				</select>
	  			</div>

	  			<div class="form-group">
	  				<label for="address">Designation:</label> <span id="designation-error"></span>
	  				<input type="text" name="designation" class="form-control capitalize" required data-parsley-required-message="Please enter the designation!" data-parsley-errors-container="#designation-error" value="{{ $employee->designation }}">
	  			</div>
	  			@if($employee->category == 'teacher')
	  			<h4>Advisory Class</h4>
	  			<div class="form-group">
	  				<label for="last_name">Year Level:</label> <span id="level-error"></span>
	  				<select name="level" class="form-control" id="level" data-parsley-required-message="Please select the year level!" data-parsley-errors-container="#level-error">
	  					<option selected disabled>--Select Level--</option>
	  					@foreach($levels as $level)
	  						@if($level->category == 'G')
	  							<option value="{{ $level->id }}" {{ $level->id == $employee->lvl_id ? 'selected' : '' }}>Grade {{ $level->level }}</option>
	  						@elseif($level->category == 'P')
	  							<option value="{{ $level->id }}" {{ $level->id == $employee->lvl_id ? 'selected' : '' }}>{{ $level->level }}</option>
	  						@endif
	  					@endforeach
	  				</select>
	  			</div>
	  			<div class="form-group">
	  				<label for="last_name">Section:</label> <span id="section-error"></span>
	  				<select name="section" class="form-control" id="section" data-parsley-required-message="Please select the section!" data-parsley-errors-container="#section-error">
	  					<option disabled>--Select Section--</option>
	  					<option value="{{ $employee->sec_id }}" selected>Section {{ $employee->sec_name }}</option>
	  				</select>
	  			</div>
	  			@endif
	  		</div>

	  		<div class="col-md-4">
	  			<div class="text-center">
	  				<img src="{{ asset($employee->photo) }}" width="150" class="img-thumbnail" id="photo-holder">
	  			</div>
	  			<div id="photo-error" class="text-center"></div>
	  			<div class="text-center btn-photo">
	  				<label for="std_photo" class="btn btn-info ">
	  					<input type="file" name="file" id="std_photo"  accept="image/gif, image/jpeg, image/png">
	  					Change Employee Photo
	  				</label>
	  				<button class="btn btn-warning" type="button" onclick="take_snapshot();"><i class="fa fa-camera"></i> Take Photo</button>
	  			</div>
	  			<input id="mydata" type="hidden" name="mydata" value=""/>
	  			<div class="buttons text-center">
	  				<button class="btn btn-success" type="submit"><i class="fa fa-pencil"></i> Update Employee Info</button>
	  			</div>

	  			<div id="my_camera" style="width:320px; height:240px;margin: 0px auto;"></div>
	  		</div>
	  	</form>
  	</div>
@endsection

@section('scripts')
	@if($employee->category == 'teacher')
	<script type="text/javascript">
		var lvl = "{{ $employee->lvl_id }}";
		var sec = "{{ $employee->sec_id }}";
	</script>
	@endif
	<script type="text/javascript" src="{{ asset('js/webcam.min.js') }}"></script>
	<script src='{{ asset('js/socket.io.min.js') }}'></script>
	<script type="text/javascript" src="{{ asset('js/addstudent.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/photo.js') }}"></script>
	<script type="text/javascript">
		updatesections(lvl);
	</script>
@endsection
