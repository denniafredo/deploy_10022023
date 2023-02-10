<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" language="javascript">
function hitungcb(){
 var a=document.form1.x1.value;
 var b=document.form1.x2.value;
 var c=document.form1.x3.value;
 var d=document.form1.x4.value;
e=parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d);

if(e>100){
alert("jumlah lebih dari 100 " + a + " + " + b + " + " + c + " + " + d + " = " + e);
}
}

function jumlahcb(){
 if(document.form1.boxFF.checked){
	 document.form1.FF.disabled=false;
 }else{
	 document.form1.FF.disabled=true; 
 }
 if(document.form1.boxBF.checked){
	 document.form1.BF.disabled=false;
 }else{
	 document.form1.BF.disabled=true;
 }
 if(document.form1.boxEF.checked){
	 document.form1.EF.disabled=false;
 }else{
	 document.form1.EF.disabled=true;
 }
 if(document.form1.boxMM.checked){
	 document.form1.MM.disabled=false;
 }else{
	 document.form1.MM.disabled=true;
 }
 

 
}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
 <input type="text" name="FF" onChange="hitungcb();" value="0" disabled /><input type="checkbox" name="boxFF" value="boxFF" onclick="jumlahcb();" />
 <br />
 <input type="text" name="BF" onChange="hitungcb();" value="0" disabled /><input type="checkbox" name="boxBF" value="boxBF" onclick="jumlahcb();" />
 <br />
 <input type="text" name="EF" onChange="hitungcb();" value="0" disabled /><input type="checkbox" name="boxEF" value="boxEF" onclick="jumlahcb();" />
 <br />
 <input type="text" name="MM" onChange="hitungcb();" value="0" disabled /><input type="checkbox" name="boxMM" value="boxMM" onclick="jumlahcb();" />
</form>
</body>
</html>