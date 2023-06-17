$(document).ready(function(){

    $('select[name="division_id"]').on('change', function(){
        var division_id = $(this).val();
       if(division_id){
        $.ajax({
            url:"/get_district_data/"+division_id,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                $('select[name="district_id"]').html('');
                $('select[name="state_id"]').html('');
                var d =$('select[name="district_id"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="district_id"]').append('<option value="'+ value.id + '">' + value.district_name + '</option>');
                    });
            }
        });
       }
       else{
        alert('No Data Found');
       }
    });


    $('select[name="district_id"]').on('change', function(){
        var district_id = $(this).val();
       if(district_id){
        $.ajax({
            url:"/get_state_data/"+district_id,
            type:"GET",
            dataType:"JSON",
            success:function(data){
                $('select[name="state_id"]').html('');
                var d =$('select[name="state_id"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="state_id"]').append('<option value="'+ value.id + '">' + value.state_name + '</option>');
                    });
            }
        });
       }
       else{
        alert('No Data Found');
       }
    });

})