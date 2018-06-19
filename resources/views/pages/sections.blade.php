@extends('layouts.auth')
@section('title','Sections List')
@section('page-title','Sections List')
@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/section.css') }}">
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-success" data-toggle="modal" data-target="#newSectionModal">Add New Section</button>
		</div>
	</div>
	<br>
  	<div class="row">
	  <div class="col-md-12">
	  	<div class="table-container">
	  		<table class="display table table-bordered table-condensed">
	  			<thead>
	  				<th class="text-center">#</th>
	  				<th class="text-center">Grade Level</th>
	  				<th class="text-center">Section</th>
	  				<th class="text-center"></th>
	  			</thead>
	  			<tbody>
	  				@foreach($sections as $i => $sec)
	  					<tr class="text-center">
	  						<td>{{ $i+1 }}</td>
	  						@if($sec->category == 'G')
	  							<td>Grade {{ $sec->level }}</td>
	  						@elseif($sec->category == 'P')
	  							<td>{{ $sec->level }}</td>
  							@elseif($sec->category == 'H')
  								<td>{{ ordinal($sec->level) }} Year</td>
	  						@endif
	  						
	  						<td>Section {{ $sec->name }}</td>
	  						<td>
	  							<a href="{{ route('delete.section',$sec->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
	  						</td>
	  					</tr>
	  				@endforeach
	  			</tbody>
	  		</table>
	  	</div>
	  	
	  </div>
  	</div>
  	@include('partials.modal._newsection')
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('js/section.js') }}"></script>
@endsection
