<? 
include "../../includes/session.php";
include "../../includes/roleptg.php";
include "../../includes/database.php";
$DB=New database($userid, $passwd, $DBName);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Switching Polis</title>
<style type="text/css">
<!-- 
body {
  font-family: Verdana;
	font-size: 12px;
} 

td {
	font-size: 12px;
} 

select {
	font-size: 12px;
} 


.button{
  width: 100px;
	padding : 4px 4px 4px 4px;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="javascript"> 	
		function submitForms() {
						if (isPrefix() && isNoper() && isKdproduk())
              	if (confirm) { 
              		return true;
              	} else {
              		return false;      
              	} else
              	return false;
            }
						
						function isPrefix() {
            	var str=document.fswitching.prefix.value;
            	if (str=="") {
            		alert("Silakan isi prefix")
            		document.fswitching.prefix.focus();
            		return false;
            	}
            	return true;
            }
						
						function isNoper() {
            	var str=document.fswitching.noper.value;
            	if (str=="") {
            		alert("Silakan isi Nomor Pertanggungan")
            		document.fswitching.noper.focus();
            		return false;
            	}
            	return true;
            }

						function isKdproduk() {
            	var str=document.fswitching.kdproduk.value;
            	if (str=="") {
            		alert("Silakan pilih produk")
            		document.fswitching.kdproduk.focus();
            		return false;
            	}
            	return true;
            }
						
     </script>
		 
      <script type="text/javascript" src="../js/ajax.js"></script>
      <script type="text/javascript">
        var ajax = new sack();
        	
        function showLoadingTimer () {
        	var loader = document.getElementById('loadData');
        	loader.style.display = 'block';
        	sentTimer = setTimeout("hideLoadingTimer()",800);
        }
        
        function hideLoadingTimer() {
        	var loader = document.getElementById('loadData');
        	loader.style.display = "none";
        }
      	
      	function getDataPolis(){
      	 showLoadingTimer();
      	 var prefix  = document.fswitching.prefix.value;
       	 var nopert  = document.fswitching.noper.value;
         
         var xmlhttp=false; //Clear our fetching variable
                try {
                        xmlhttp = new ActiveXObject('Msxml2.XMLHTTP'); //Try the first kind of active x object…
                } catch (e) {
                        try {
                                xmlhttp = new
                                ActiveXObject('Microsoft.XMLHTTP'); //Try the second kind of active x object
                    } catch (E) {
                        xmlhttp = false;
                                }
                }
                if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
                        xmlhttp = new XMLHttpRequest(); //If we were able to get a working active x object, start an XMLHttpRequest
                }
        				
                var file = 'switching_data.php?page='; //This is the path to the file we just finished making *
            		xmlhttp.open('GET', file+'&nopertanggungan='+nopert+
      											 '&prefixpertanggungan='+prefix, true); //Open the file through GET, and add the page we want to retrieve as a GET variable **
            		xmlhttp.onreadystatechange=function() 
        				{
                  if (xmlhttp.readyState==4) 
          				{ //Check if it is ready to recieve data
                          var content = xmlhttp.responseText; //The content data which has been retrieved ***
                          if( content )
        									{ //Make sure there is something in the content variable
                                document.getElementById('adddataswitching').innerHTML = content; //Change the inner content of your div to the newly retrieved content ****
                          }
                  }
                }
                xmlhttp.send(null) //Nullify the XMLHttpRequest
         return;
        }
      </script>
</head>
<body>
<? 
if(isset($submit))
{
     /*
     $sql = "insert into $DBUser.tabel_700_tebus_switching (".
		 						"prefixpertanggungan,nopertanggungan,tglmohon,userrekam,status,nosiptebus) ".
		 				"values('".$prefix."','".$noper."',sysdate,user,'0','$nosiptebus')";
		 $DB->parse($sql);
  	 $DB->execute();
		 */
     $sql = "select notertanggung from $DBUser.tabel_200_pertanggungan where ".
		 				"prefixpertanggungan='".$prefix."' and nopertanggungan='".$noper."'";
		 $DB->parse($sql);
  	 $DB->execute();
  	 $res = $DB->nextrow();
  	 $nottg = $res["NOTERTANGGUNG"];
		 
	   echo "<script language=\"JavaScript\" type=\"text/javascript\">";
  	 echo "window.location.replace('ntryprop_jslink.php?prefix=$prefix&noper=$noper&kdproduk=$kdproduk&nottg=$nottg&ntbs=$nilaitebus&nosiptebus=$nosiptebus');";
  	 echo "</script>";
}
?>
<div align="center">

	<table border="1" cellpadding="15" style="border-collapse: collapse" bordercolor="#C0C0C0" cellspacing="0" width="550">
		<tr>
			<td bgcolor="#C0C0C0">
			<p align="center"><b>SWITCHING POLIS</b></td>
		</tr>
		<tr>
			<td>
			<form name="fswitching" action="<?=$PHP_SELF;?>" method="post" onSubmit="return submitForms()">
			<table border="0" cellpadding="5" style="border-collapse: collapse" bordercolor="#C0C0C0" width="520">
				<tr>
					<td width="150">
					<p align="left">Nomor Polis</td>
					<td width="370">: 
					<input type="text" name="prefix" maxlength="2" size="4" onChange="javascript:this.value=this.value.toUpperCase();">&nbsp;
					<input type="text" name="noper" maxlength="9" size="16" onBlur="validasi(this.form.noper);getDataPolis();document.getElementById('adddataswitching').style.display='block';">
					</td>
				</tr>
				<tr>
					<td width="150">Pilih Produk Js.Link</td>
					<td width="370">: 
					<select size="1" name="kdproduk">
					<option value="">---pilih produk---</option>
					<?
					$sql = "select kdproduk,namaproduk from $DBUser.tabel_202_produk where substr(kdproduk,1,4)='JL3X' and status='S'";
					$DB->parse($sql);
        	$DB->execute();
        	while($row = $DB->nextrow())
					{
					  echo "<option value=".$row["KDPRODUK"].">".$row["KDPRODUK"]." - ".$row["NAMAPRODUK"]."</option>";
					}
					?>
					</select>
					
					</td>
				</tr>
			</table>

			<div id="loadData" style="display:none;">
         <strong><font color="#ff8000">Load data&#8230;</font></strong>
         <img src="../img/loading.gif" alt="Loading data..." title="request data" />
      </div>
			<div id="adddataswitching" style="display:block"></div>
			
			</td>
			</form>
		</tr>
	</table>
</div>

</body>
</html>
