<?php 
//phpinfo();

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Connection: close");
	
?>
<head>
<meta charset="utf-8"/>
<title>Jiwasraya Power on Sales</title>
<link rel="shortcut icon" href="<?= base_url();?>assets/img/jspos.ico"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?= base_url();?>assets/plugins/fonts.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/plugins/select2/select2-metronic.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?= base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url();?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url();?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url();?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?= base_url();?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url();?>assets/css/pages/invoice.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link href="<?= base_url();?>assets/css/checkbox.css" rel="stylesheet" type="text/css"/>

<!-- END THEME STYLES -->
<link rel="shortcut icon" href="jspos.ico"/>

<script type="text/javascript">
	function number_format(number, decimals, dec_point, thousands_sep) {
		// Strip all characters but numerical ones.
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function (n, prec) {
				var k = Math.pow(10, prec);
				return '' + Math.round(n * k) / k;
			};
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	}
</script>

</head>
<!-- END HEAD -->