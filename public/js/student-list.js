$(document).ready(function(){
	$('.display').dataTable({
		dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	});

	$('#start').datetimepicker({
		 format: 'YYYY/MM/DD'
	});
	$('#end').datetimepicker({
		 format: 'YYYY/MM/DD',
		 useCurrent: false
	});

	$("#start").on("dp.change", function (e) {
        $('#end').data("DateTimePicker").minDate(e.date);
    });

    $("#end").on("dp.change", function (e) {
        $('#start').data("DateTimePicker").maxDate(e.date);
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

	$('#apply_filter').click(function(){
		var start = $('#start').val();
		var end = $('#end').val();
		var lvl = $('#level').val();
		var sec = $('#section').val();
		var std = $('#student_number').val();

		if (start == '' || end == '') {
			swal({
			  title: 'Warning!',
			  text: "No date range was selected this will fetch all the attendance data from the beginning and may take some time to load? Do you want to continue?",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Continue'

			}).then((result) => {
			  if (result.value) {
			  	refreshTable();
			  }
			})
		}else{
			refreshTable();
		}
	})
	function refreshTable(){		
		$('.display').DataTable().destroy();

		$.ajax({
			url : att_url,
			type : 'POST',
			data : {
				_token : token,
				start : $('#start').val(),
				end : $('#end').val(),
				lvl : $('#level').val(),
				sec : $('#section').val(),
				std : $('#student_number').val(),
			},
			success : function(response){
				// var res = $('#json').val();
				// var rest = JSON.parse(res);
				var er = response.attendances;		
				var data = jQuery.map(er, function(el, i) {
				 	return [[el.username, el.last_name, el.first_name, el.log_date, el.log_time, el.status]];
				});

				$('.display').DataTable({
					dom: 'Bfrtip',
					buttons: [
					    'copy', 'csv', 'excel', 'pdf', 'print'
					],
			        "ordering": false,
			        "pageLength": 100,
			        "aaData": data,
					"aoColumns": [
						{ "sTitle": "Student Number",'class':'text-center' },
					    { "sTitle": "Last Name",'class':'text-center' },
					    { "sTitle": "First Name",'class':'text-center' },
					    { "sTitle": "Date", 'class':'text-center' },
					    { "sTitle": "Time",'class':'text-center' },
					    { "sTitle": "Status",'class':'text-center' },
					],
				})
			}
		})
	}
})