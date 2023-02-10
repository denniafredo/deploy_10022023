<!DOCTYPE html>

<html>

	<head>
	
		<title>View -- Dropdown</title>
	
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.css"/>
	
		<script src="<?=base_url()?>asset/js/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.js"></script>
	
		<!--[if lt IE 9]>
			<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker-ltie9.css" />
			<script type="text/javascript" src="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker-ltie9.js"></script>
		<![endif]-->
		
		<style type="text/css">
		
			p
			{
				margin-left: 20px;
			}
		
			input
			{
				width: 200px;
				padding: 10px;
				margin-left: 20px;
				margin-bottom: 20px;
			}
		
		</style>
	
	</head>

	<body>
	
	
		<!------------------------ Date Picker ------------------------>
		<p>Date : </p>
		<input type="text" data-field="date" readonly>
	
		<!------------------------ Time Picker ------------------------>
		<p>Time : </p>
		<input type="text" data-field="time" readonly>
	
		<!---------------------- DateTime Picker ---------------------->
		<p>DateTime : </p>
		<input type="text" data-field="datetime" readonly>
	
	
		<div id="dtBox"></div>
	
	
		<script type="text/javascript">
		
			$(document).ready(function()
			{
				$("#dtBox").DateTimePicker({
				
					isPopup: false
				
				});
			});
		
		</script>
	
	
	</body>

</html>