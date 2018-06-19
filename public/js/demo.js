$(document).ready(function(){
    $('#rfid_number').focus();
    $('#rfid_number').on('keypress',function(e){
        var num = $(this).val();
        if(e.which == 13) {
                $.ajax({
                    url : '/demo-attendance/'+num,
                    type : 'GET',
                    success : function(data){
                        $('.last-four').remove();
                        var pos;
                        $.each(data.time,function(i,v){
                             var CurrentDate = moment(data.time[i].log_date+' '+data.time[i].log_time).format('hh:mm:ss A');

                             if (data.time[i].category == 'staff' || data.time[i].category == 'teacher') {
                                pos = data.time[i].designation;
                             }else{
                                pos = 'Grade '+data.time[i].level+' - '+data.time[i].section;
                             }
                            if (i == 0) {
                                $('#student-image').attr('src','../'+ data.time[i].photo);
                                $('#student-name').text(data.time[i].first_name + ' ' + data.time[i].last_name)
                                $('#gr-sec').text(pos)
                                $('#log_time').html(CurrentDate);
                                $('#status').html(data.time[i].status)
                            }else{
                                $('.queue').append('<div class="row last-four">'+
                                    '<div class="col-sm-4">'+
                                        '<img src="../'+data.time[i].photo+'" class="img-responsive img-thumbnail" id="student-image">'+
                                    '</div>'+
                                    '<div class="col-sm-8">'+
                                        '<div class="student-name"><strong class="student-name-data">'+data.time[i].first_name + ' ' + data.time[i].last_name+'</strong></div>'+
                                        '<div class="grade"><strong class="gr-sec-data">'+pos+'</strong></div>'+
                                        '<div ><span class="log_time">'+CurrentDate+'</span> - <span  class="status">'+data.time[i].status+'</span></div>'+
                                    '</div>'+
                               '</div>')
                            }
                            
                            
                        })

                        console.log(data.time);
                    }
                })
            $('#rfid_number').val('');
        }
    })
})