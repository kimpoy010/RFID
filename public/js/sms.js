$(document).ready(function(){
	$('#level').on('change', function(){
		var id = $(this).val();
		$.ajax({
			url : '/get-sections/'+id,
			type : 'GET',
			success: function(response){
				$('#sections option').remove();

				$('#sections').append('<option selected disabled>'+
						'--Select Section--'+
					'</option>');
				
				$.each(response.sections, function(i,v){
					$('#sections').append('<option value='+v.id+'>'+
						'Section ' + v.name +
					'</option>');
				})
				
			}
		})
	});

	$('#btn-all').click(function(){
		swal({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.value) {
		   $('.send-loading').show();

		  }
		})
	})
});

function sensAllSMS(){
	$.ajax({
		url : '',
		type : 'POST',
		data : {
			_token : $('meta[name="csrf-token"]').attr('content'),
			message : $('#message').val()
		},
		success : function(response){

		},
		error : function(error){

		}
	})
}