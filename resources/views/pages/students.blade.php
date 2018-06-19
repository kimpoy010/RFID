@extends('layouts.auth')
@section('title','Student List')
@section('page-title','Students List')
@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/student-list.css') }}">
@endsection

@section('content')
  	<div class="row">
	  <div class="col-md-12">
	  	<div class="table-container">
	  		<table class="display table table-bordered table-condensed">
	  			<thead>
	  				<th class="text-center">Student #</th>
	  				<th class="text-center">Name</th>
	  				<th class="text-center">Year Level</th>
	  				<th class="text-center">Section</th>
	  				<th class="text-center">Contact #</th>
	  				<th class="text-center">Action/s</th>
	  			</thead>
	  			<tbody>
	  				@foreach($levels as $level)
	  					<tr class="text-center">
	  						<td>{{ $level->student_number }}</td>
	  						<td class="capitalize text-left">{{ titleCase($level->last_name) }}, {{ titleCase($level->first_name) }} {{ titleCase($level->middle_name) }} {{-- {{ $level->middle_name == '' || $level->middle_name == null ? '' : acronym($level->middle_name) }} --}}</td>
	  						@if($level->lvl_cat == 'G')
	  							<td>Grade {{ $level->lvl_name }}</td>
	  						@elseif($level->lvl_cat == 'P')
	  							<td>{{ $level->lvl_name }}</td>
  							@elseif($level->lvl_cat == 'H')
  								<td>{{ ordinal($level->lvl_name) }} Year</td>
	  						@endif
	  						
	  						<td>{{ $level->sec_name }}</td>
	  						<td>{{ $level->guardian_number }}</td>
	  						<td>
	  							<a class="btn btn-primary btn-xs" title="View Student Info" href="{{ route('view.student',$level->id_user) }}"><i class="fa fa-eye"></i></a>
	  							<a href="{{ route('edit.student',$level->id_user) }}" class="btn btn-success btn-xs" title="Update Student Info"><i class="fa fa-pencil"></i></a>
	  						</td>
	  					</tr>
	  				@endforeach
	  			</tbody>
	  		</table>
	  	</div>
	  	
	  </div>
  	</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/student-list.js') }}"></script>
@endsection
