$(document).ready(function(){
	$('#loading').hide();
	var dataString;
	$('#name').bind('keyup change',function(){
		$('.j').remove();
		$('#loding').show();

		var name = $(this).val();
		if($('#batch').val()!=''){
			dataString = 'department='+department+'&name='+name+'&batch='+$("#batch").val();
		}
		else{
			$('#batch_option').find('option').remove();
			dataString = 'department='+department+'&name='+name;
		}
		console.log(dataString);
		$.ajax
		({
			type: "POST",
			url: "get/get_bn.php",
			data: dataString,
			cache: false,
			success: function(data)
			{	
				$('#batch_option').html(data);
			}
		});
		$.ajax
		({
			type: "POST",
			url: "get/get_home_table.php",
			data: dataString,
			cache: false,
			success: function(data)
			{	
				$('#loading').hide();
				$('#n').append(data);
			}
		});
	});
	$('#batch').bind('keyup change',function(){
		$('.j').remove();
		$('#loding').show();

		var batch = $(this).val();
		if($('#name').val()!=''){
			dataString = 'department='+department+'&name='+$("#name").val()+'&batch='+batch;
		}
		else{
			$('#name_option').find('option').remove();
			dataString = 'department='+department+'&batch='+batch;
		}
		console.log(dataString);
		$.ajax
		({
			type: "POST",
			url: "get/get_bn.php",
			data: dataString,
			cache: false,
			success: function(data)
			{	
				$('#name_option').html(data);
			}
		});
		$.ajax
		({
			type: "POST",
			url: "get/get_home_table.php",
			data: dataString,
			cache: false,
			success: function(data)
			{	
				$('#loading').hide();
				$('#n').append(data);
			}
		});
	});
});