<?php 
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
  
if(($premipertama != "ON") && (strlen($noproposal)==0)) {
	header("location:http://$HTTP_HOST/$KAMP/proposal/ntryprop.php?".$SID."");
} 
  $sql="select prefixpertanggungan,kdpertanggungan,notertanggung,nosp,nopertanggungan,".
       "to_char(tglsp,'DD/MM/YYYY') tglsp,nobp3,kdproduk,to_char(mulas,'DD/MM/YYYY') mulas,".
			 "usia_th,usia_bl,to_char(expirasi,'DD/MM/YYYY') expirasi,lamaasuransi_th,lamaasuransi_bl,".
       "lamapembpremi_th,lamapembpremi_bl,kdvaluta,juamainproduk,premi1,kdcarabayar,indexawal,".
			 "premi2,nopenagih,kdstatusfile,noagen,b.namaklien1,kdstatusmedical ".
	     "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_100_klien b ".
			 "where nopertanggungan = '$noproposal' and prefixpertanggungan='$kantor' and ".
			 "a.notertanggung=b.noklien"; 
  $DB->parse($sql);
	$DB->execute();
	if (!$arr=$DB->nextrow()) {exit;}	 
	 $kdproduk = $arr["KDPRODUK"];
	 $kdvaluta = $arr["KDVALUTA"];
	 $kdcarabayar = $arr["KDCARABAYAR"];
	 $kdkdstatusfile = $arr["KDSTATUSFILE"];
?>
<html>
<head>
<title>PT Asuransi Jiwa IFG Private Network</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
</head>
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F1210</font></td></tr>
</table>
<hr size="1">
<table border="0" width="100%" cellspacing="0" cellpadding="2" bgcolor="#5F58CF">
<form name=ntryprop method="post" action="updprop.php?<? echo $SID; ?>">
  <tr>
    <td width="50"><font size="2" face="Arial" color="white"><b>Prefix :</b></font></td>
    <td width="70"><font size="2" face="Arial" color="white"><b><? echo $kantor ?></b></font></td>
    <td width="100"><font size="2" face="Arial" color="white"><b>No. Proposal :</b></font></td>
    <td><font size="2" face="Arial" color="white"><b><? echo $noproposal; ?></b></font></td>
  </tr>
	</table>
<table border="0" width="100%" cellspacing="2" bgcolor="#C8D5DD">
  <tr>
    <td width="12%"><font size="2" face="Arial">No. Tertanggung</font></td>
    <td width="38%"><font face="Arial" size="2">: <input type="text" name="notertanggung" value="<? echo $arr["NOTERTANGGUNG"]; ?>" size="10" maxlength=10 style="font-family: Arial; font-size: 10pt"></font></td>
    <td width="11%"><font face="Arial" size="2">Lama Premi</font></td>
    <td width="38%">: 
		<input type="text" name="lamapembpremi_th" value="<? echo $arr["LAMAPEMBPREMI_TH"]; ?>" size="2"><font face="Arial" size="1"> tahun </font>
		<input type="text" name="lamapembpremi_bl" value="<? echo $arr["LAMAPEMBPREMI_BL"]; ?>" size="2"><font face="Arial" size="1"> bulan </font></td>
  </tr>
  <tr>
    <td width="12%"><font size="2" face="Arial">Nomor. SP</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="nosp" value="<? echo $arr["NOSP"]; ?>" size="8" maxlength=8 ></font></td>
    <td width="11%"><font size="2" face="Arial">Kode Valuta</font></td>
    <td width="38%"><font size="2" face="Arial">: <select size="1" name="kdvaluta" >
		<? 
		  $sql = "select kdvaluta,kdmatauang,namavaluta from $DBUser.tabel_304_valuta";
			$DB->parse($sql);
			$DB->execute();
			while($arx=$DB->nextrow()){
			  if($kdvaluta==$arx["KDVALUTA"]) {
			    echo("<option selected value=".$arx["KDVALUTA"].">".$arx["NAMAVALUTA"]."</option>");
			  } else {
			    echo("<option value=".$arx["KDVALUTA"].">".$arx["NAMAVALUTA"]."</option>");
				}
			}			 
		?>
		</select></font></td>
  </tr>
  <tr>
    <td width="12%"><font face="Arial" size="2">Tanggal SP</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="tglsp" value="<? echo $arr["TGLSP"]; ?>" size="10" maxlength=10></font></td>
    <td width="11%"><font size="2" face="Arial">JUA</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="juamainproduk" value="<? echo $arr["JUAMAINPRODUK"]; ?>" size="20"></font></td>
  </tr>
  <tr>
    <td width="12%"><font face="Arial" size="2">No. BP3</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="nobp3" value="<? echo $arr["NOBP3"]; ?>" size="20"></font></td>
    <td width="11%"><font face="Arial" size="2">Premi 1</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="premi1" value="<? echo $arr["PREMI1"]; ?>" size="20"></font></td>
  </tr>
  <tr>
    <td width="12%"><font face="Arial" size="2">Kode Produk</font></td>
    <td width="38%"><font size="2" face="Arial">: <select size="1" name="kdproduk">
		<? 
		  $sql = "select kdproduk,namaproduk from $DBUser.tabel_202_produk";
			$DB->parse($sql);
			$DB->execute();
			
			while($arx=$DB->nextrow()){
			  if($kdproduk==$arx["KDPRODUK"]) {
			    echo("<option value=".$arx["KDPRODUK"].">".$arx["NAMAPRODUK"]." [".$arx["KDPRODUK"]."] </option>");
				} else {
			    echo("<option value=".$arx["KDPRODUK"].">".$arx["NAMAPRODUK"]." [".$arx["KDPRODUK"]."] </option>");
			  }
			} 			 
		?>
		</select></font></td>
    <td width="11%"><font face="Arial" size="2">Cara Bayar</font></td>
    <td width="38%"><font size="2" face="Arial">: <select size="1" name="kdcarabayar">
		<? 
		  $sql = "select kdcarabayar,namacarabayar from $DBUser.tabel_305_cara_bayar";
			$DB->parse($sql);
			$DB->execute();
			while($arx=$DB->nextrow()){
			  if($kdcarabayar==$arx["KDCARABAYAR"]) {
			    echo("<option selected value=".$arx["KDCARABAYAR"].">".$arx["NAMACARABAYAR"]."</option>");
				} else {
			    echo("<option value=".$arx["KDCARABAYAR"].">".$arx["NAMACARABAYAR"]."</option>");
				}	
			}			 
		?>
    </select></font></td>
  </tr>
  <tr>
    <td width="12%"><font face="Arial" size="2">Medical ?</font></td>
    <td width="38%"><font size="2" face="Arial">: 
		<? 
		   if($arr["KDSTATUSMEDICAL"]=="M") {
			   echo "<input type=\"checkbox\" name=\"kdstatusmedical\" size=\"1\" value=\"M\" checked>";
			 } else {
			   echo "<input type=\"checkbox\" name=\"kdstatusmedical\" size=\"1\" value=\"M\" >";
		   }
		?></font></td>
    <td width="11%"><font face="Arial" size="2">Index Awal</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="indexawal" value="<? echo $arr["INDEXAWAL"]; ?>" size="20"></font></td>
  </tr>
  <tr>
    <td width="12%"><font face="Arial" size="2">Tanggal Mulas</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="mulas" value="<? echo $arr["MULAS"]; ?>" size="10" maxlength=10></font></td>
    <td width="11%"><font face="Arial" size="2">Premi 2</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="premi2" value="<? echo $arr["PREMI2"]; ?>" size="20"></font></td>
  </tr>
  <tr>
    <td width="12%"><font face="Arial" size="2">Usia</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="usia_th" value="<? echo $arr["USIA_TH"]; ?>" size="2"><font face="Arial" size="1" color="black"> tahun</font></font>
		<input type="text" name="usia_bl" value="<? echo $arr["USIA_BL"]; ?>" size="2"><font face="Arial" size="1" color="black"> bulan</font>
		</td>
    <td width="11%"><font face="Arial" size="2">Penagih</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="nopenagih" value="<? echo $arr["NOPENAGIH"]; ?>" size="10" maxlength=10>
		  <input type="button" value="..." onclick="window.open('pnglist.php','popuppage','width=250,height=200,top=100,left=100');"></font></td>
  </tr>
  <tr>
    <td width="12%"><font face="Arial" size="2">Tgl. Expirasi</font></td>
    <td width="38%"><font size="2" face="Arial">: <input type="text" name="expirasi" value="<? echo $arr["EXPIRASI"]; ?>" size="10" maxlength=10></font></td>
    <td width="11%"><font face="Arial" size="2">Status</font></td>
    <td width="38%"><font size="2" face="Arial">: <select size="1" name="kdstatusfile">
		<? 
		  $sql = "select kdstatusfile,namastatusfile from $DBUser.tabel_299_status_file";
			$DB->parse($sql);
			$DB->execute();
			while($arx=$DB->nextrow()){
			  if($kdstatusfile==$arx["KDSTATUSFILE"]) {
				  echo("<option selected value=".$arx["KDSTATUSFILE"].">".$arx["NAMASTATUSFILE"]."</option>");
			  } else {
				  echo("<option value=".$arx["KDSTATUSFILE"].">".$arx["NAMASTATUSFILE"]."</option>");
				}
			}			 
		?>
    </select></font></td>
  </tr>
  <tr>
    <td width="12%"><font size="2" face="Arial">Lama Asuransi</font></td>
    <td width="38%"><font size="2" face="Arial">: 
		  <input type="text" name="lamaasuransi_th" value="<? echo $arr["LAMAASURANSI_TH"]; ?>" size="2"><font face="Arial" size="1" color="black"> tahun</font>
			<input type="text" name="lamaasuransi_bl" value="<? echo $arr["LAMAASURANSI_BL"]; ?>" size="2"><font face="Arial" size="1" color="black"> bulan</font>
			</font></td>
    <td width="11%"><font face="Arial" size="2">Agen</font></td>
    <td width="38%"><font size="2" face="Arial">: 
		  <input type="text" name="noagen" value="<? echo $arr["NOAGEN"]; ?>" size="10" maxlength=10>
		  <input type="button" value="..." onclick="window.open('agnlist.php','popuppage','width=250,height=200,top=100,left=100');">
			</font></td>
  </tr>
</table>
<hr size="1">
<table width="100%">
  <tr>
    <td width="400"><font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <a href="../mnuptgbaru">Menu Pertanggungan Baru</a></font></td>
    <td align="right">
      <input type="hidden" name="prefixpertanggungan" value="<? echo $kantor; ?>">
    	<input type="hidden" name="nopertanggungan" value="<? echo $noproposal; ?>">
    	<input type="submit" name="submit" value="Submit"></td>
  </tr>
</table>
</form>
</body>
</html>
