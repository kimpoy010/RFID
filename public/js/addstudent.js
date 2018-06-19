$(document).ready(function(){
	var socket = io.connect('//127.0.0.1:1337');

	socket.on('connect', function () {
	    console.log('connected');

	    socket.on('newcard', function (data) {
	        $('#rfid_number').val(data.card_no);
	        console.log(data.card_no);
	    });

	    socket.on('usedcard', function (data) {
	        swal('Error!','Card already assigned! Please use other card!','error');
	    });

	    socket.on('disconnect', function () {
	        console.log('disconnected');
	    });
	});


	$('#rfid_number').focus();

	$(window).keydown(function(event){
	    if(event.keyCode == 13) {
	      event.preventDefault();
	      return false;
	    }
  	});

	$('#bday').datetimepicker({
		 format: 'YYYY/MM/DD'
	});

	$("#std_photo").change(function(){
        readURL(this);
    });

	$('#level').on('change', function(){
		var id = $(this).val();
		$.ajax({
			url : '/get-sections/'+id,
			type : 'GET',
			success: function(response){
				$('#section option').remove();

				$('#section').append('<option selected disabled value="">'+
						'--Select Section--'+
					'</option>');
				
				$.each(response.sections, function(i,v){
					$('#section').append('<option value='+v.id+'>'+
						'Section ' + v.name +
					'</option>');
				})
				
			}
		})
	});
})


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#photo-holder').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}


function updatesections(lvls){
	$.ajax({
		url : '/get-sections/'+lvls,
		type : 'GET',
		success: function(response){
			$('#section option').remove();

			$('#section').append('<option selected disabled value="">'+
					'--Select Section--'+
				'</option>');
			
			$.each(response.sections, function(i,v){
				if (v.id == sec) {
					var sel = 'selected'
				}else{
					var sel = '';
				}
				$('#section').append("<option value='"+v.id+"'"+ sel +">"+
					'Section ' + v.name +
				'</option>');
			})
			
		}
	})
}

$('#std_number').change(function(){
	var id = $(this).val();
	searchStudent(id);
});

$('#emp_ategory').change(function(){
	staff();
})

function searchStudent(std_no){
	$.ajax({
		url : '/search-student/'+std_no,
		type : 'GET',
		success: function(response){
			console.log(response);			
		},
		error:function(err){
			$('#std_number-error').text(' ' + err.responseJSON.message);	
		}
	})
}

function staff(){
	if ($('#emp_ategory').val() == 'staff' || $('#emp_ategory').val() == 'admin') {
		$('#level').attr('required',false);
		$('#section').attr('required',false);
		$('.advisory-class').hide();
	}else{
		$('#level').attr('required',true);
		$('#section').attr('required',true);
		$('.advisory-class').show();

	}
}
// function ordinal(i) {
//     var j = i % 10,
//         k = i % 100;
//     if (j == 1 && k != 11) {
//         return i + "st";
//     }
//     if (j == 2 && k != 12) {
//         return i + "nd";
//     }
//     if (j == 3 && k != 13) {
//         return i + "rd";
//     }
//     return i + "th";
// }