@extends('layouts.auth')
@section('title','Add Student')
@section('page-title','Student Management')
@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/addstudent.css') }}">
@endsection

@section('content')
  	<div class="row">
	  	<form method="POST" action="{{ route('update.student',$student->user_id) }}" data-parsley-validate enctype="multipart/form-data">
	  		<div class="col-md-4">
	  			<h4>Student Information</h4>
	  			{{ csrf_field() }}
	  			<div class="form-group">
	  				<label for="rfid_number">RFID No:</label><span id="rfid_number-error"></span>
	  				<input type="text" name="rfid_number" id="rfid_number" class="form-control" value="{{ $student->rfid_number }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="std_number">Student No:</label><span id="std_number-error"></span>
	  				<input type="text" name="std_number" class="form-control" required data-parsley-required-message="Please enter the student number!" data-parsley-errors-container="#std_number-error" value="{{ $student->student_number }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="first_name">First Name:</label><span id="first_name-error"></span>
	  				<input type="text" name="first_name" class="form-control" required data-parsley-required-message="Please enter the student first name!" data-parsley-errors-container="#first_name-error" value="{{ $student->first_name }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="middle_name">Middle Name/Initial:</label> 
	  				<input type="text" name="middle_name" class="form-control" value="{{ $student->middle_name }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="last_name">Last Name:</label><span id="last_name-error"></span>
	  				<input type="text" name="last_name" class="form-control" required data-parsley-required-message="Please enter the student last name!" data-parsley-errors-container="#last_name-error" value="{{ $student->last_name }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="last_name">Birthday:</label><span id="bday-error"></span>
	  				<input type="text" name="bday" class="form-control" id="bday" required data-parsley-required-message="Please enter the student birthday!" data-parsley-errors-container="#bday-error" value="{{ $student->bday }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="last_name">Gender:</label> <span id="gender-error"></span>
	  				<select name="gender" class="form-control" required data-parsley-required-message="Please select the student gender!" data-parsley-errors-container="#gender-error">
	  					<option selected disabled>--Select Gender--</option>
	  					<option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
	  					<option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
	  				</select>
	  			</div>
	  		</div>
	  		<div class="col-md-4">
	  			<h4>Contact Information</h4>
	  			<div class="form-group">
	  				<label for="guardian_name">Guardian Name:</label> <span id="guardian_name-error"></span>
	  				<input type="text" name="guardian_name" class="form-control" required data-parsley-required-message="Please enter student's guardian name!" data-parsley-errors-container="#guardian_name-error" value="{{ $student->guardian_name }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="address">Address:</label> <span id="address-error"></span>
	  				<input type="text" name="address" class="form-control" required data-parsley-required-message="Please enter the address!" data-parsley-errors-container="#address-error" value="{{ $student->guardian_address }}">
	  			</div>
	  			<div class="form-group">
	  				<label for="contact_number">Contact Number:</label> <span id="contact_number-error"></span>
	  				<input type="text" name="contact_number" class="form-control" required data-parsley-required-message="Please enter the 10-digit contact number!" data-parsley-errors-container="#contact_number-error" placeholder="9051234567" value="{{ $student->guardian_number }}">
	  			</div>

	  			<h4>Year Level/Section</h4>
	  			<div class="form-group">
	  				<label for="last_name">Year Level:</label> <span id="level-error"></span>
	  				<select name="level" class="form-control" id="level" required data-parsley-required-message="Please select the year level!" data-parsley-errors-container="#level-error">
	  					<option selected disabled>--Select Level--</option>
	  					@foreach($levels as $level)
	  						@if($level->category == 'G')
	  							<option value="{{ $level->id }}" {{ $level->id == $student->lvl_id ? 'selected' : '' }}>Grade {{ $level->level }}</option>
	  						@elseif($level->category == 'P')
	  							<option value="{{ $level->id }}" {{ $level->id == $student->lvl_id ? 'selected' : '' }}>{{ $level->level }}</option>
	  						@endif
	  					@endforeach
	  				</select>
	  			</div>
	  			<div class="form-group">
	  				<label for="last_name">Section:</label> <span id="section-error"></span>
	  				<select name="section" class="form-control" id="section" required data-parsley-required-message="Please select the section!" data-parsley-errors-container="#section-error">
	  					<option disabled>--Select Section--</option>
	  					<option value="{{ $student->sec_id }}" selected>Section {{ $student->sec_name }}</option>
	  				</select>
	  			</div>
	  		</div>

	  		<div class="col-md-4">
	  			<div class="text-center">
	  				<img src="{{ asset($student->photo) }}" width="150" class="img-thumbnail" id="photo-holder">
	  			</div>
	  			<div id="photo-error" class="text-center"></div>
	  			<div class="text-center btn-photo">
	  				<label for="std_photo" class="btn btn-info ">
	  					<input type="file" name="file" id="std_photo"  accept="image/gif, image/jpeg, image/png">
	  					Change Student Photo
	  				</label>
	  				<button class="btn btn-warning" type="button" onclick="take_snapshot();"><i class="fa fa-camera"></i> Take Photo</button>
	  			</div>
	  			<input id="mydata" type="hidden" name="mydata" value=""/>
	  			<div class="buttons text-center">
	  				<button class="btn btn-success" type="submit"><i class="fa fa-pencil"></i> Update Student Info</button>
	  			</div>

	  			<div id="my_camera" style="width:320px; height:240px;margin: 0px auto;"></div>
	  		</div>
	  	</form>
  	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		var lvl = "{{ $student->lvl_id }}";
		var sec = "{{ $student->sec_id }}";
	</script>
	<script type="text/javascript" src="{{ asset('js/webcam.min.js') }}"></script>
	<script src='{{ asset('js/socket.io.min.js') }}'></script>
	<script type="text/javascript" src="{{ asset('js/addstudent.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/photo.js') }}"></script>
	<script type="text/javascript">
		updatesections(lvl);
	</script>
@endsection
