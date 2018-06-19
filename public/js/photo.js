Webcam.set({
		crop_width: 240,
		crop_height: 240,
		image_format: 'jpeg',
		jpeg_quality: 90,
		flip_horiz: true
	});
Webcam.attach( '#my_camera' );
function take_snapshot() {
	Webcam.snap( function(data_uri) {
		$('#photo-holder').prop('src',data_uri);
		var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
		document.getElementById('mydata').value = raw_image_data;
	} );
}