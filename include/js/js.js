(function($){

	
	 $(document).ready(function(){
	 	
	 	var buscar = $("#search_monitor").val();

    	if (buscar == '') {
    		$.ajax({
    			url: monitor_vars.ajaxurl,
    			type: 'post',
    			data: {
    				action: 'monitor_ajax_submit_buscar',
    				buscar: ''
    			},
    			beforeSend: function(){
    			$(".spinner").css('display','block');
    		},

    			success:function(data){
    			var newdata = JSON.parse(data);
				$("#mascara-prueba").empty();
		newdata.forEach(function(value, index) {
				$("#mascara-prueba").append('<tr><td>'+value.username+'</td><td>'+value.peso+'</td><td>'+value.dollar+'</td><td>'+value.bcv+'</td><td>'+value.dateinfo+'</td></tr>');
			
			});
                $(".spinner").css('display','none');
    			
		

    			}
    		})
    	}
    $("#search_monitor").keyup(function(){
    	var buscar = $(this).val();

    	if (buscar == '') {
    		$.ajax({
    			url: monitor_vars.ajaxurl,
    			type: 'post',
    			data: {
    				action: 'monitor_ajax_submit_buscar',
    				buscar: ''
    			},
    			beforeSend: function(){
    			$(".spinner").css('display','block');
    		},

    			success:function(data){
    			var newdata = JSON.parse(data);
				$("#mascara-prueba").empty();
		newdata.forEach(function(value, index) {
				$("#mascara-prueba").append('<tr><td>'+value.username+'</td><td>'+value.peso+'</td><td>'+value.dollar+'</td><td>'+value.bcv+'</td><td>'+value.dateinfo+'</td></tr>');
			
			});
                $(".spinner").css('display','none');
    			


    			}
    		})
    	}else {
    		$("#mascara-prueba").append('');
    		$.ajax({
    		url: monitor_vars.ajaxurl,
    		type: 'post',
    		data: {
    			action: 'monitor_ajax_submit_buscar',
    			buscar:buscar
    		},
    		beforeSend: function(){
    			$(".spinner").css('display','block');
    		},
    		success:function(data){
    		
    			var newdata = JSON.parse(data);
			$("#mascara-prueba").empty();
			newdata.forEach(function(value, index) {
				$("#mascara-prueba").append('<tr><td>'+value.username+'</td><td>'+value.peso+'</td><td>'+value.dollar+'</td><td>'+value.bcv+'</td><td>'+value.dateinfo+'</td></tr>');
			
			});
    			$(".spinner").css('display','none');

    		}
    	})
    	}
    	
    })
    });
	$("#btn-submit-monitor").click(function(){
        $("#check-id-monitor").css('display', 'none');
        $("#faild-id-monitor").css('display','none');
		$("#loader-monitor").css('display','flex');
		var peso = $("#monitor-peso").val();
		var dollar = $("#monitor-dollar").val();
		var bcv = $("#monitor-bcv").val();

		$.ajax({
			url : monitor_vars.ajaxurl,
			type: 'post',
			data: {
				action : 'monitor_ajax_submit',
				peso : peso,
				dollar : dollar, 
				bcv : bcv
			},
            beforeSend: function(){
                // $(".panel-monitor").css('opacity','0.4');
                $(".spinner").css("display","block");

            },
            error: function(){
                    $("#faild-id-monitor").css('display','block');
            },
			success: function(data){
				$("#loader-monitor").css('display','none');
				
               // console.log(data);
               if(data == false){
                    alert("Error");
                    $(".panel-monitor").css('opacity','1');
                    $(".spinner").css("display","none");
                    $("#faild-id-monitor").css('display','block');
               }else {
                $("#check-id-monitor").css('display','flex');
                var content = JSON.parse(data); 
                $("#output-peso-monitor-peso").text(content.peso);
                $("#output-peso-monitor-dollar").text(content.dollar);
                $("#output-peso-monitor-bcv").text(content.bcv);
                $("#output-peso-monitor-dateinfo").text(content.dateinfo);
                $("#output-peso-monitor-username").text(content.username);
                $(".panel-monitor").css('opacity','1');
                $(".spinner").css("display","none");
               }
				

	

			}
		});
	});
    $("#config_all_update_monitor").click(function(){
        $("#faild-id-monitor").css('display','none');
       var config_1_checked_monitor_peso = 1;
       var config_1_checked_monitor_dollar = 0;
       var config_1_checked_monitor_bcv = 0;

        if($("#config_1_checked_monitor_peso").is(':checked')){
            config_1_checked_monitor_peso = 1;
        }else {
            config_1_checked_monitor_peso = 0;
        }
        if($("#config_1_checked_monitor_dollar").is(':checked')){
            config_1_checked_monitor_dollar = 1;
        }else {
            config_1_checked_monitor_dollar = 0;
        }
        if($("#config_1_checked_monitor_bcv").is(':checked')){
            config_1_checked_monitor_bcv = 1;
        }else {
            config_1_checked_monitor_bcv = 0;
        }

        $.ajax({
            url:  monitor_vars.ajaxurl,
            type: 'post',
            data: {
                action : 'monitor_ajax_submit_setting',
                config_1_checked_monitor_peso : config_1_checked_monitor_peso,
                config_1_checked_monitor_dollar : config_1_checked_monitor_dollar,
                config_1_checked_monitor_bcv : config_1_checked_monitor_bcv
            },
              beforeSend: function(){
                // $(".panel-monitor").css('opacity','0.4');
                $(".spinner").css("display","block");
                $("#check-id-monitor").css('display','none');  
                 $("#faild-id-monitor").css('display','none');



            },
            error: function(data){

                   $(".spinner").css("display","block");
                $("#check-id-monitor").css('display','none');  
                 $("#faild-id-monitor").css('display','block');
                    
            },
            success: function(data){


// alert(data);
                
                $(".spinner").css("display","none");
                $("#check-id-monitor").css('display','flex');  
                 $("#faild-id-monitor").css('display','none');

    

            }
        });
        
        




    });





})(jQuery);