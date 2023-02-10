<?
  include "../../includes/session.php";
  include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/kantor.php";
	include "../../includes/tgl.php";
	include "../../includes/constant.php";
	
	$DB=new database($userid, $passwd, $DBName);
	$PWK = New Kantor($userid,$passwd,$kantor);
	$KT  = New Kantor($userid,$passwd,$PWK->kdkantorinduk);	
	$prefix=strtoupper($prefix);
	$prefsal = $prefix;	
	$KP  = New KantorPusat($userid,$passwd);
	
?>
<html>
  <head>
  <title>Pengajuan Klaim</title>
  <link href="./jws.css" rel="stylesheet" type="text/css">
  <style type="text/css">
  <!--
  input, textarea, select {
  border-top-width : 1px; 
  border-right-width : 1px; 
  border-bottom-width : 1px; 
  border-left-width : 1px;  
  }
  -->
  </style>
  <script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/date.js" ></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
  </head>
<body>
<div align="center">
<?

	$sql = "select kelompok,namaklaim from $DBUser.tabel_902_kode_klaim where kdklaim='$jnsklaim'";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$klp=$arr["KELOMPOK"];
	$namaklaim=	$arr["NAMAKLAIM"];
	
if($submit) {

  $meninggal=(!$tglmeninggal) ? 'NULL' : "to_date('$tglmeninggal','DD/MM/YYYY')";
	$booked=(!$tglbooked) ? 'NULL' : "to_date('$tglbooked','DD/MM/YYYY')";
	$sebabmeninggal=substr(strtoupper($sebabmeninggal),0,50);
	$namadokter=substr(strtoupper($namadokter),0,30);
	$alamatdokter=substr(strtoupper($alamatdokter),0,40);
	
	$prefix = substr($pertanggungan,0,2);
	$noper = substr($pertanggungan,3); 
	$nopersal = $noper;
	$PER=New Pertanggungan($userid,$passwd,$prefix,$noper);
	$kdproduk=$PER->produk; 
	$tb=(int)(substr($tglbooked,6,4).substr($tglbooked,3,2).substr($tglbooked,0,2));
  $ts=(int)(substr($PER->sysdate,6,4).substr($PER->sysdate,3,2).substr($PER->sysdate,0,2));
	
	if ($klp=='D') {
		 $status = '0' ;
		 $tglpengajuan=$PER->sysdate;

		 //=========================================================================
		 //Revised By Agus on January 06 2005
		 //Lakukan perhitungan terhadap nilai benefit meninggalnya.
		 //get benefit's formula..
		 
		 $sqlp = "select c.rumus, a.kdbenefit ".
		 			 	 "from $DBUser.tabel_206_produk_benefit A, ".
						 "$DBUser.TABEL_207_KODE_BENEFIT B, ".
						 "$DBUser.TABEL_224_RUMUS C ".
						 "where A.KDBENEFIT = B.KDBENEFIT ".
						 "AND A.KDPRODUK='$kdproduk' AND B.KDKELOMPOKBENEFIT='D' ".
						 "AND A.KDRUMUSBENEFIT=C.KDRUMUS ";
		 	$DB->parse($sqlp);
		  $DB->execute();
		  $arr=$DB->nextrow();
		  $rumusan=$arr["RUMUS"];
			$benefit=$arr["KDBENEFIT"];
			
		 //Ambil dilai rumusan dengan memanggil fungsi formula!!
		 		 
		  $sqlg = "select $DBUser.formula.runy('$prefix','$noper','$tglpengajuan','$rumusan') nilaibenefit from dual ";
			$DB->parse($sqlg);
		  $DB->execute();
		  $arr=$DB->nextrow();
		  $nilaibnf=$arr["NILAIBENEFIT"];

			//echo $nilaibnf;
			
			//Update nilai benefit meninggal pada tabel_223_transaksi_produk
			$sql="Update $DBUser.tabel_223_transaksi_produk set nilaibenefit =$nilaibnf  ". 
						"where prefixpertanggungan ='$prefix' and nopertanggungan ='$noper' ".
						"and kdbenefit ='$benefit' " ;
		  $DB->parse($sql);
		  $DB->execute();
			
		 //=========================================================================
		 
	} else {
		 $status = '0';
		 //$status = '1'; // awal status sebelum tgl 25 april
		 if($jnsklaim=="BEASISWA" || $jnsklaim=="ANUITAS" || $jnsklaim=="OTHERS")
		 {
		   $tglpengajuan = $PER->sysdate;
		 } 
		 else
		 {
		   $tglpengajuan =($tb < $ts) ? $tglbooked : $PER->sysdate;
			 //$tglpengajuan = $PER->sysdate;
		 }
	}	 
	//echo $tglpengajuan;
	
	if($cekbnf=="ON"){ // jika tidak punya benefit meninggal
	   // ubah status pertanggungan menjadi KLAIM agan gak kena billing
		 $sql =   "insert into $DBUser.tabel_901_pengajuan_klaim ".
							"(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,userfo,tglfo,".
							"userrekam,tglrekam,nilaibenefit,status,tglmeninggal,".
							"sebabmeninggal,namadokter,alamatdokter,tglbooked,pemohon,kdkantorproses) ".
							"values ('$prefix','$noper','$jnsklaim',to_date('$tglpengajuan','DD/MM/YYYY'),user,sysdate, ".
							"user,sysdate,NULL,'4',$meninggal,".
							"'$sebabmeninggal','$namadokter','$alamatdokter',$booked,'$pemohon','$kantor')";
	   //$note= "Polis ini tidak memiliki Benefit Meninggal. Lanjutkan proses untuk menghentikan pembayaran premi.";

	} else {
		 $sql =   "insert into $DBUser.tabel_901_pengajuan_klaim ".
							"(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,tgljatuhtempo,".
							"userfo,tglfo,".
							"userrekam,tglrekam,nilaibenefit,status,tglmeninggal,".
							"sebabmeninggal,namadokter,alamatdokter,tglbooked,pemohon,kdkantorproses) ".
							"values ('$prefix','$noper','$jnsklaim',to_date('$tglpengajuan','DD/MM/YYYY'),to_date('$tglpengajuan','DD/MM/YYYY'),".
							//"values ('$prefix','$noper','$jnsklaim',sysdate,'',".
							"user,sysdate, ".
							//"user,sysdate,NULL,'$status',$meninggal,'$sebabmeninggal','$namadokter','$alamatdokter','','$pemohon')";
							"user,sysdate,NULL,'$status',$meninggal,".
							"'$sebabmeninggal','$namadokter','$alamatdokter',$booked,'$pemohon','$kantor')";
	
	   $note= "Proses Dilanjutkan Dengan Perhitungan Benefit";
	}
	//echo $sql;
	//die;
	$DB->parse($sql);
	if ($DB->execute()) {
	
	   if($jnsklaim=="BEASISWA" || $jnsklaim=="ANUITAS") // jika jenis klaim anuitas
		 {
				//echo "jenisklaim = ".$jnsklaim;
				//die;
				echo "<script language=\"JavaScript\" type=\"text/javascript\">";
        echo "window.location.replace('pengajuanklaim_anuitas.php?prefix=$prefix&noper=$noper&kdklaim=$jnsklaim&tglpengajuan=$tglpengajuan');";
        echo "</script>";
		 }
		 else
		 {  
				// kirim email 		
				if ($klp=='D') { //kelompok meninggal
						 // langsung ke perhitungan benefit
						 echo "<script language=\"JavaScript\" type=\"text/javascript\">";
          	 echo "window.location.replace('pengajuanklaimFE.php?prefix=$prefix&noper=$noper&kdklaim=$jnsklaim&tglpengajuan=$tglpengajuan&resikoawal=$resikoawal&sebabmeninggal=$sebabmeninggal&namadokter=$namadokter&alamatdokter=$alamatdokter&cekbnf=$cekbnf&pemohon=$pemohon');";
          	 echo "</script>";					 
	 			}	
				else  // selain meninggal
				{ 
						 // di direct ke pengajuanklaimFE.php
						 echo "<script language=\"JavaScript\" type=\"text/javascript\">";
          	 echo "window.location.replace('pengajuanklaimFE.php?prefix=$prefix&noper=$noper&kdklaim=$jnsklaim&tglpengajuan=$tglpengajuan');";
          	 echo "</script>";
				}
		 }
		 		
	} 
	else
	{ //insert fail
		 
				 $sql = "select to_char(max(tglpengajuan),'DD/MM/YYYY') tglpengajuan from $DBUser.tabel_901_pengajuan_klaim ".
				 			  "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$jnsklaim' ";
				 //echo $sql;
				 $DB->parse($sql);
				 $DB->execute();
				 if ($arr=$DB->nextrow()) {
				  $tglklaim=$arr["TGLPENGAJUAN"];
   			  echo "  <table border=1 cellpadding=4 style=\"border-collapse: collapse\" width=600 bordercolor=#C0C0C0>";
					echo "   <tr class=arial10>";
   			  echo "    <td  bgcolor=#FFCACA align=center><b>GAGAL</b></td>";
   			  echo "	 </tr>";
   			  echo "   <tr class=arial10>";
   			  echo "		<td align=center><b>Proses Tidak Dapat Dilanjutkan</font><br>Klaim $jnsklaim Terakhir diajukan tanggal $tglklaim</td>";
   			  echo "	 </tr>";
					echo "   <tr class=arial10>";
   			  echo "    <td align=center bgcolor=#DBDBDB><a href=\"#\" onclick=\"window.location.replace('".$PHP_SELF."')\">Back</a></td>";
   			  echo "	 </tr>";
   			  echo "	</table>"; 
				 }	
 	}
				
} 
else 
{
	$sql="select to_char(sysdate,'HH:MI:SS') detiknow,to_char(sysdate,'DD/MM/YYYY') now from dual";
  $DB->parse($sql);
	$DB->execute();
	$w=$DB->nextrow();
	$tanggal = $w["NOW"];
  ?>
  <script language="JavaScript" type="text/javascript">
  <!--
  function KartuPremi(theForm){
    var polis=theForm.pertanggungan.value;
     if (!polis =='') { 
      var prefix=polis.substring(0,2);
  		var noper=polis.substring(3);
  	  NewWindow('../akunting/kartupremi1.php?prefix='+prefix+'&noper='+noper+'','kartupremi',700,600,1)
    	return true;
  	 }	
  }
  function PanggilDuplikat(){
      var prefix=document.propmtc.prefix.value;
  	  var noper=document.propmtc.noper.value;
  	  NewWindow('../proposal/hist_duplikat.php?pref='+prefix+'&noper='+noper+'','histduplikat',700,600,1)
    	return true;	
  }
  function KartuGadai(theForm){
    var polis=theForm.pertanggungan.value;
     if (!polis =='') { 
      var prefix=polis.substring(0,2);
  		var noper=polis.substring(3);
  	  NewWindow('../akunting/kartugadai1.php?prefix='+prefix+'&noper='+noper+'','kartugadai',700,600,1)
    	return true;
  	 }	
  }
  function Polis(theForm){
    var polis=theForm.pertanggungan.value;
     if (!polis =='') { 
      var prefix=polis.substring(0,2);
  		var noper=polis.substring(3);
  	  NewWindow('polis.php?prefix='+prefix+'&noper='+noper+'','polis',700,600,1)
    	return true;
  	 }	
  }
  
  function GantiKlaim(theForm) {
  var prefix=theForm.prefix.value;
  var noper=theForm.noper.value;
  var kdklaim=theForm.jnsklaim.value;
  prefix=prefix.toUpperCase();
  window.location.replace('pengajuanklaimF.php?prefix='+prefix+'&noper='+noper+'&kdklaim='+kdklaim+'');
  }
  
  function OpenWin(prefix,noper) {
  var kdklaim=document.propmtc.jnsklaim.value;
  NewWindow('loadpengajuanklaimF.php?prefix='+prefix+'&noper='+noper+'&kode='+kdklaim+'','',700,400,1)
  }
  
  function CariPolis () {
  prefix = document.propmtc.prefix.value;
  noper = document.propmtc.noper.value;
  
  loadOK = true;
   if ( prefix == '' && loadOK) {
    alert('Masukkan Prefix Pertanggungan atau \nKlik Pilih Polis');
  	document.propmtc.prefix.focus();
  	loadOK = false;
   }
   if ( ( noper == '' || noper=='000000000') && loadOK ) {
    alert('Masukkan Nomor Pertanggungan');
  	document.propmtc.prefix.focus();
  	loadOK = false;
   }
   if (loadOK) {  
     OpenWin(prefix,noper);
   }
   return loadOK
  }
  function OnSumbit(theForm) {
  var pert=theForm.pertanggungan.value;
   if (pert =='') {
    alert ('Nomor Polis Kosong, Masukkan Nomor Polis Yang Benar Atau Cari Dari Popup');
   	theForm.prefix.focus();
  	return false;
   } else {
    return true
   }
  }
  
  function PilihAo(theForm) {
   var polis=theForm.pertanggungan.value;
  		NewWindow('loadinsurable.php?nopertanggungan='+polis+'','popupcari',500,200,1);
  }
  //-->
  </script>
  <?
  	$sql = "select kelompok from $DBUser.tabel_902_kode_klaim where kdklaim='$kdklaim'";
  	$DB->parse($sql);
  	$DB->execute();
  	$arr=$DB->nextrow();
  	$klp=$arr["KELOMPOK"];
  	
   if ($klp=='D') {
    print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
    print( "<!--\n" );
    print( "function KonverDate(theForm) {\n" );
    print( " tglmati=theForm.tglmeninggal.value;\n" );
    print( " if (!tglmati=='') {\n" );
    print( "  convert_date(theForm.tglmeninggal);\n" );
    print( "	return true;\n" );	
    print( " } else {\n" );
    print( "  alert('Tanggal Meninggal Wajib Diisi');\n" );
    print( "	theForm.tglmeninggal.focus();\n" );
    print( "	return false;\n" );
    print( " }		\n" );
    print( "}\n" );
    print( "//-->\n" );
    print( "</script>\n" );
   }
  ?>
  </script>
  
  <form method="POST" name="propmtc" action="<? echo $PHP_SELF;?>"  onsubmit="return OnSumbit(document.propmtc)">
  
  <table border="0"  cellspacing="1" cellpadding="1" width="800" align="center"  class="tblhead">
     <tr>
     <td colspan="2"  class="tblisi"> 
  		 <table border="0" cellpadding="1" width="100%" cellspacing="1">
   		  <tr>
         <td align="center" colspan="6" class="tblhead"><b>PENGAJUAN KLAIM / BENEFIT ASURANSI</b></td>
   		  </tr>
   		  <tr>	 
  		   <td align="left" colspan="6">
  	 		  <li class="hijao">Front Office Menerima Permintaan Kemudian Diteruskan Ke Seksi Pertanggungan Perwakilan</b>
  	 		 </td>
   	    </tr>
  			<!--add by salman 14-6-10>
				<?php ?>
				<tr>
						<td>
								<input type="text" name="notify_duplikat" value=""  />
						</td>
				</tr>
				<!--end add-->
  				<tr>
  				<td class="arial10" width="23%">Klaim Diajukan</td>
  				<td class="arial10" width="2%">:</td>
    			<td class="arial10" width="25%"><select name="jnsklaim" class="c" onFocus="highlight(event)" onChange="GantiKlaim(document.propmtc)">
  				<?
  				//$kdklaim=(!$kdklaim)? "BEASISWA" :$kdklaim;
  				$sql = "select kdklaim,namaklaim from $DBUser.tabel_902_kode_klaim ".
  						 	 "where kdklaim not in ('PULIH','CASHPLAN') ".
  						   "order by kdklaim desc";
  				$DB->parse($sql);
  				$DB->execute();
  				while ($arr=$DB->nextrow()) {
  				  if ($arr["KDKLAIM"]==$kdklaim) {
  				   print( "<option value=\"".$arr["KDKLAIM"]."\" selected>".$arr["NAMAKLAIM"]."</option>" );
  				 	} else {
  				   print( "<option value=\"".$arr["KDKLAIM"]."\">".$arr["NAMAKLAIM"]."</option>" );
  				  }
  				}	
  				?>
  				</select></td>
  				<td width="50%" colspan="3"></td>
  				</tr>
  				<tr>
  				<td class="arial10" width="23%">Tanggal Pengajuan</td>
  				<td class="arial10" width="2%">:</td>
    			<td class="arial10" width="25%"><input name="tglpengajuan" class="a" size="10" readonly value="<? echo $tanggal;?>"></td>
  				<td width="50%" colspan="3"></td>
  				</tr>
  			
  	   </table>	 
  	 </td>
  	 </tr>
  	 
  	 <tr>
      <td colspan="2" align="center">
  		<table  width="100%" border="0" cellspacing="1" cellpadding="0" class="tblisi">
  				
    			<tr>
      		<td class="arial9" width="23%">Nomor Polis</td>
      		<td class="arial9" width="2%">:</td>
  				<td class="arial9" width="23%">
  			  <input type="text" name="prefix" size="2" maxlength="2" class="c" onFocus="highlight(event)" value="<? echo $prefix;?>">
  				-<input type="text" name="noper" size="10" class="c" onFocus="highlight(event)" onBlur="validasi9(this.form.noper);return CariPolis()" value="<? echo $noper;?>"></td>
    			<td class="arial9" width="23%">
  				<input type="button" class="buton"  name="cari" value="Cari Polis" onClick="OpenWin('','')">
  				</td>
  				<td class="arial9" width="2%"></td>
  				<td class="ver8ungu" width="25%"><input type="button" class="buton" name="carikp" value="Lihat Kartu Premi" onClick="return KartuPremi(document.propmtc)"></td>
   				</tr>
  
  				<tr>
  				 <td colspan="5" width="75%"></td>
  				 <td width="25%">
  				  <input type="button" class="buton" name="lihatpolis" value="Lihat Polis" onClick="return Polis(document.propmtc)">
  				  <input type="button" class="buton" name="lihatgadai" value="Kartu Gadai" onClick="return KartuGadai(document.propmtc)">
  				 </td>
  				</tr>
  				
  				<tr>
  				<td colspan="6"><hr size="1"></td>
  				</tr>
  				
  				<tr>
      		<td class="arial10" width="23%">Pertanggungan Nomor</td>  
  		    <td class="arial10" width="2%">:</td>
  				<td class="arial10" width="25%"><input type="text" name="pertanggungan" class="a" readonly size="15"></td>
    			<td class="arial10" width="23%"></td>
  				<td class="arial10" width="2%"></td>
  				<td class="arial10" width="25%"></td>				
  				</tr>
  								
  				<tr>
      		<td class="arial10" width="23%">Tertanggung</td>  
  		    <td class="arial10" width="2%">:</td>
  				<td class="arial10" width="25%"><input type="text" name="tertanggung" class="a" readonly size="25"></td>
    			<td class="arial10" width="23%">Produk</td>
  				<td class="arial10" width="2%">:</td>
  				<td class="arial10" width="25%"><input type="text" name="produk" class="a" readonly size="25"></td>				
  				</tr>
  				
  				<tr>
      		<td class="arial10" width="23%">Pemegang Polis</td>  
  		    <td class="arial10" width="2%">:</td>
  				<td class="arial10" width="25%"><input type="text" name="pemegangpolis" class="a" readonly size="25"></td>
    			<td class="arial10" width="23%">Jumlah Uang Asuransi</td>
  				<td class="arial10" width="2%">:</td>
  				<td class="arial10" width="25%"><input type="text" name="jua" class="akund" readonly></td>				
  				</tr>
  				
  				<tr>
      		<td class="arial10" width="23%">Valuta</td>
      		<td class="arial10" width="2%">:</td>
  				<td class="arial10" width="25%"><input type="text" name="valuta" class="a" readonly></td>
    			<td class="arial10" width="23%">Index Awal</td>
  				<td class="arial10" width="2%">:</td>
  				<td class="arial10" width="25%"><input type="text" name="indexawal" class="akund" size="6" readonly></td>
  				</tr>
  				
  				<tr>
      		<td class="arial10" width="23%">Premi 5 Tahun Pertama</td>  
  		    <td class="arial10" width="2%">:</td>
  				<td class="arial10" width="25%"><input type="text" name="premi1" class="akund" readonly></td>
    			<td class="arial10" width="23%">Premi Setelah 5 Tahun</td>
  				<td class="arial10" width="2%">:</td>
  				<td class="arial10" width="25%"><input type="text" name="premi2" class="akund" readonly></td>				
  				</tr>
          <?		
          if ($klp=='D') {
           print( "<tr>\n" );
           print( "	<td class=\"arial10\" width=\"23%\">Tgl Meninggal</td>  \n" );
           print( " <td class=\"arial10\" width=\"2%\">:</td>\n" );
           print( "	<td width=\"25%\" class=verdana9barak><input type=\"text\" size=\"10\" name=\"tglmeninggal\" class=\"c\" onfocus=\"highlight(event)\" onblur=\"return KonverDate(document.propmtc)\" value=\"".$tanggal."\">*** Wajib Diisi</td>\n" );
           print( "	<td width=\"23%\" class=\"arial10\">Resiko Awal</td>\n" );
           print( "	<td class=\"arial10\" width=\"2%\">:</td>\n" );
           print( "	<td class=\"arial10\" width=\"25%\"><input type=\"text\" size=\"15\" name=\"resikoawal\" class=\"akund\" readonly></td>	\n" );
           print( "</tr>\n" );
           print( "<tr>\n" );
           print( "	<td class=\"arial10\" width=\"23%\">Sebab Meninggal</td>  \n" );
           print( " <td class=\"arial10\" width=\"2%\">:</td>\n" );
           print( "	<td class=verdana9barak colspan=\"4\" width=\"75%\"><input type=\"text\" size=\"50\" name=\"sebabmeninggal\" class=\"c\" onfocus=\"highlight(event)\">***</td>\n" );
           print( "</tr>\n" );	 
           print( "<tr>\n" );
           print( "	<td class=\"arial10\" width=\"23%\">Nama Dokter</td>  \n" );
           print( " <td class=\"arial10\" width=\"2%\">:</td>\n" );
           print( "	<td class=verdana9barak colspan=\"4\" width=\"75%\"><input type=\"text\" size=\"50\" name=\"namadokter\" class=\"c\" onfocus=\"highlight(event)\">***</td>\n" );
           print( "</tr>\n" );	 
           print( "<tr>\n" );
           print( "	<td class=\"arial10\" width=\"23%\">Alamat Praktek</td>  \n" );
           print( " <td class=\"arial10\" width=\"2%\">:</td>\n" );
           print( "	<td class=verdana9barak colspan=\"4\" width=\"75%\"><input type=\"text\" size=\"50\" name=\"alamatdokter\" class=\"c\" onfocus=\"highlight(event)\">***</td>\n" );
           print( "</tr>\n" );	 
        	 
        	 print( "<tr>\n" );
           print( "	<td class=\"arial10\" width=\"23%\">Nama Pemohon</td>  \n" );
           print( " <td class=\"arial10\" width=\"2%\">:</td>\n" );
           print( "	<td class=verdana9barak colspan=\"4\" width=\"75%\"><input type=\"text\" size=\"40\" name=\"pemohon\" class=\"c\" onfocus=\"highlight(event)\" readonly>".
        	 				" <a href=\"#\" onclick=\"return PilihAo(document.propmtc)\">".
         		          "<img src=\"../img/jswindow.gif\" border=0 name=\"cariao\" alt=\"cari ahliwaris\"></a>".
        					"***</td>\n" );
           print( "</tr>\n" );
        	 
           print( "<tr>\n" );
           print( "	<td class=\"arial10\" colspan=\"6\" width=\"100%\"><textarea cols=\"70\" rows=\"3\" name=\"ket\" class=\"tblisi\"  style=\"width: 100%; border: 0px solid #99ccff\"></textarea></td>\n" );
           print( "</tr>\n" );	 
        	
        	}	else {
           print( "<tr>\n" );
           print( "	<td class=\"arial10\" width=\"23%\">Tgl Booked</td>  \n" );
           print( " <td class=\"arial10\" width=\"2%\">:</td>\n" );
           print( "	<td class=\"arial10\" colspan=\"4\" width=\"75%\"><input type=\"text\" size=\"10\" name=\"tglbooked\" class=\"a\" onfocus=\"highlight(event)\"></td>\n" );
           print( "</tr>\n" );	 
        	}		
        	?>
  				<tr>
  				<td colspan="6"><hr size="1"></td>
  				</tr>
    	
  		    <tr class="tblhead">
      	   <td align="center" colspan="6">
  				 <input type="hidden" name="cekbnf" value="">
					 <input type="text" name="notify" size="58" readonly style="font-family: Arial, Helvetica, sans-serif;    
					 font-size: 14px;color: #FF0000;background-color: #003399;border-style: none" />		   					 <? $tes=""?>
					 
					 <input type="button" name="histduplikat" value="" onClick="PanggilDuplikat();" style="font-family: Arial, Helvetica, sans-serif;    
					 font-size: 14px;color: #FF0000;background-color: #003399;border-style: none">
					 <br>
				<? if($klp=='D'){
				echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" onClick=\"return KonverDate(document.propmtc);\">";
				}else{ ?>
   				 <input type="submit" name="submit" value="Submit">
				 <? } ?>
  		    </td></tr>
  		
       </table>
  		</tr>
  		
  </table>
  
  <table width="800">
    <tr>
      <td width="50%" class="arial10" align="left"><a href="../polisserv.php">Policy Servicing</a></td>
  		<td width="50%" class="arial10" align="right"></td>
  	</tr>
  </table>
  </form> 
<?}?>

</div>
</body>
</html>