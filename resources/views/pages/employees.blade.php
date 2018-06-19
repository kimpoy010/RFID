@extends('layouts.auth')
@section('title','Employees List')
@section('page-title','Employees List')
@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/student-list.css') }}">
@endsection

@section('content')
  	<div class="row">
	  <div class="col-md-12">
	  	<div class="table-container">
	  		<table class="display table table-bordered table-condensed">
	  			<thead>
	  				<th class="text-center">Employee #</th>
	  				<th class="text-center">Name</th>
	  				<th class="text-center">Category</th>
	  				<th class="text-center">Designation</th>
	  				<th class="text-center">Action/s</th>
	  			</thead>
	  			<tbody>
	  				@foreach($levels as $level)
	  					<tr class="text-center">
	  						<td>{{ $level->student_number }}</td>
	  						<td class="capitalize text-left">{{ titleCase($level->last_name) }}, {{ titleCase($level->first_name) }} {{ titleCase($level->middle_name) }} </td>
	  						<td>{{ ucwords($level->category) }} </td>
	  						<td>{{ $level->designation }}</td>
	  						<td>
	  							<a class="btn btn-primary btn-xs" title="View Employee Info" href="{{ route('view.employee',$level->id_user) }}"><i class="fa fa-eye"></i></a>
	  							<a href="{{ route('edit.employee',$level->id_user) }}" class="btn btn-success btn-xs" title="Update Student Info"><i class="fa fa-pencil"></i></a>
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
