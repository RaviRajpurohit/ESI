$(document).ready(function(){
	var ladger=$('#ladger').val();	var name;	var voucher;	var batch;	var dataString;	var from_date=$('#fromDate').val();;	var to_date=$('#toDate').val();
	$('#loading').hide();
	$('#department').change( function(){
		department = $(this).val();
		$('#report_department').html(department);
	});
	$('#ladger').change(function(){
		ladger = $(this).val();
		$('#report_ladger').html('Ladger: '+ladger);
		if(ladger=='Issued'){
			$('#head_ladger').html('To Whom Issued');
		}
		else{
			$('#head_ladger').html('From Whom recived');
		}
	});
	$('#name').bind('keyup change', function(){
		name = $(this).val();
		$('#report_name').html('Product Name: '+name);
	});
	$('#voucher').bind('keyup change',function(){
		voucher = $(this).val();
		$('#report_voucher').html('Voucher No: '+voucher);
	});
	$('#batch').bind('keyup change', function(){
		batch = $(this).val();
		$('#report_batch').html('Batch No: '+batch);
	});
	$('#from').change(function(){
		from_date = $(this).val();
		if(from_date==''){
			from_date=$('#fromDate').val();
		}
		console.log(from_date);
	});
	$('#to').change(function(){
		to_date = $(this).val();
		if(to_date==''){
			to_date=$('#toDate').val();
		}
		console.log(to_date);
	});
	$('.search').bind('keyup change',function(){
		$('#loading').show();
		$('#report_table').find('tr').remove();
		dataString ='department='+department+'&ladger='+ladger+'&name='+name+'&voucher='+voucher+'&batch='+batch+'&from_date='+from_date+'&to_date='+to_date;
		$.ajax
		({
			type: "POST",
			url: "get/get_print_table.php",
			data: dataString,
			cache: false,
			success: function(data)
			{	
				$('#report_table').html(data);
			}
		});
		if(department=='All'){
			$('.t_department').show();
		}
		else{
			$('.t_department').hide();
		}
		if(name==''){
			$('.t_name').show();
			$('#report_name').hide();
		}
		else{
			$('.t_name').hide();
			$('#report_name').show();
		}
		if(voucher==''){
			$('.t_voucher').show();
			$('#report_voucher').hide();
		}
		else{
			$('.t_voucher').hide();
			$('#report_voucher').show();
		}
		if(batch==''){
			$('.t_batch').show();
			$('#report_batch').hide();
		}
		else{
			$('.t_batch').hide();
			$('#report_batch').show();
		}
		$('#loading').hide();
		$('#report_table').show();
	});
	$('#print_div').click(function(){
		var divContents = $("#report").html();
		var printWindow = window.open('', '', 'height=400,width=800');
		printWindow.document.write('<html><head><title>'+department+'\'s '+ladger+' Ladger</title>');
		printWindow.document.write('<style>table {width:100%;}table, th, td {border: 1px solid black;    border-collapse: collapse;}th, td {    padding: 5px;    text-align: left;}table#report_table tr:nth-child(even) {    background-color: #eee;}table#report_table tr:nth-child(odd) {    background-color:#fff;}table#report_table th {    background-color: White;    color: Black; font-width:bold;}</style>');
		printWindow.document.write('</head><body >');
		printWindow.document.write(divContents);
		printWindow.document.write('</body></html>');
		printWindow.document.close();
		printWindow.print();
	});
});