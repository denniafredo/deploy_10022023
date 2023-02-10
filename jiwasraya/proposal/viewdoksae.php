<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<? 
$polisbaru_smart=$prefixpertanggungan+"-"+$nopertanggungan; 
//$polisbaru_smart="IB-001646447"; 
printf("<input type=\"button\" name=\"docpolis\" value=\"DOKUMEN\" onclick=\"NewWindow('http://192.168.2.6/smart/list.php?no_polis1=".base64_encode(base64_encode($polisbaru_smart))."','popupkomisi','700','400','yes');return false\" style=\"font-size: 8pt\">"); ?>

