<?php
 include "./includes/session.php";
 include "./includes/database.php";
 include "./includes/klien.php";
 include "./includes/pertanggungan.php";
 include "./includes/tgl.php"; 	
 include "./includes/sendemail.php";
 include './includes/koneksi.php';
 $DB  = New database($userid, $passwd, $DBName);
 $DX  = New database($userid, $passwd, $DBName);	 
 //$prefixpertanggungan = $kantor;
// $mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('08174909545','test')";
			//echo $mysqlins;
 //mysql_query($mysqlins);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<link href="./includes/jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/window.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/highlight.js"></script>
	
    <link type="text/css" href="./jquery/ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="./jquery/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="./jquery/ui.core.js"></script>
	<script type="text/javascript" src="./jquery/ui.datepicker.js"></script>
	<link type="text/css" href="./jquery/demos.css" rel="stylesheet" />
	<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker();
		$('#datepicker').datepicker('option', {dateFormat: 'dd/mm/yy'});
	});
	</script>

<head>
<title>Mutasi Pertanggungan</title>


</head>
<body>
<a class="verdana10blk"><b>SPAJ - SURAT KONFIRMASI</b></a>
<hr size=1>

<? 
if ($Submit) {
 #----------------------------------------------------------------------- sendmail mutasi jua

			 $query = "select COUNT(*) ADA from $DBUser.TABEL_UL_SPAJ_TEMP ".
		          "where NOSP='$spaj'";
			 $DB->parse($query);
			 $DB->execute();
			 $arq=$DB->nextrow();
			 //echo  $query;
			$ada=$arq['ADA'];

			 $sql = "INSERT INTO $DBUser.TABEL_UL_SPAJ_TEMP (NOSP,
                          TGLSP,
                          NOPEMEGANGPOLIS,
                          NOAGEN,
                          TALTUP,PREMI, KDKANTOR,NAMAPEMPOL,ALAMAT,HP,TOPUP,USERAAP,NIKUSERAAP)".
							"values (".
							"'$spaj',to_date('$tglspaj','DD/MM/YYYY'),'$notertanggung','$noagen','$taltup','$premi','$kantor',
								UPPER('$nama'),UPPER('$alamat'),'$phone','$topup','$useraap','$nikuseraap')";

			//echo $sql.'</BR>';
			//die;
			$DX->parse($sql);
			$DX->execute();
			$DX->commit;

			if($ada > 0) 
			{
		    echo 'view';
			
			} else {
			//----------sms--------------
			 //$phone='08174909545';
			 $msg="Yth. Bpk/Ibu ".strtoupper($nama).", terimakasih atas kepercayaan Anda kpd kami.".
	     			"SPAJ Anda No. ".$spaj." akan kami proses lebih lanjut. Utk info hub 021-1500151";
			 
       		$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('$phone','".$msg."','SPAJ MASUK','$kantor','UNDERWRITING','$spaj')";
			
			//echo $mysqlins;
       		mysql_query($mysqlins);
	
			//===========================	
			}
			 //$DX->execute();
			 
			 
			 
		  /* if($DB->execute())
			 {
			   echo "Berhasil.. Top-up sekaligus sudah ditambahkan.";
			 }
			 else
			 {
			   echo "<font color=#ff0000>Gagal.. mungkin sudah ada TOP-UP Sekaligus</font>";
			 }*/
		 

		

	
		 
		 $query = "select nosp, to_char(tglsp,'dd/mm/yyyy') tglsp,NOPEMEGANGPOLIS,
                          NOAGEN,premi,NAMAPEMPOL,ALAMAT,HP,TOPUP,
                          TALTUP from $DBUser.TABEL_UL_SPAJ_TEMP ".
		          "where NOSP='$spaj'";
		 $DB->parse($query);
	     $DB->execute();
	     $arq=$DB->nextrow();
		 //echo  $query;
$noklien=$arq['NOPEMEGANGPOLIS']? $arq['NOPEMEGANGPOLIS'] : $_GET['noklien'];
		 
 } 
 
        echo "<div align=\"center\">";
        echo "<form name=\"ntryprop\" action=\"$PHP_SELF\" method=\"post\" onSubmit=\"return checkbox_checker();\">";
		
        ?>
        
<table border="0" width="600" bgcolor="#006699" cellspacing="1" cellpadding="6">
            <tr>
              <td align="center" bgcolor="#627EB5" class="verdana9wht"><b><?echo "NO. POLIS : ".$prefixpertanggungan." - ".$nopertanggungan; ?></b></td>
            </tr>
        
            <tr>
              <td width="100%" bgcolor="#DAE2EF">
                <?
                echo "  <table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"2\">";
				echo "    <tr>";
                //echo "      <td class=\"verdana9blk\">No. Pemegang Polis</td>";
                //echo "      <td class=\"verdana9blk\">: <input readonly type=\"text\" size=\"10\" name=\"notertanggung\" VALUE=".$noklien.">";
				?> <!--<a href="#" onClick="NewWindow('./cariklien2.php?a=porm','popuppage','420','300','yes')"><img height="20" src="./images/find.png" border="0" alt="cari daftar agen"></a>&nbsp;<a href="./entryklien_ul_prop.php"><font face="Verdana" size="2">Klien Baru</font></a>--><?
                //echo "</td></tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Nama Pemegang Polis</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"35\" name=\"nama\" VALUE=".$arq['NAMAPEMPOL']."></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Alamat Pemegang Polis</td>";
                echo "      <td class=\"verdana9blk\">: <textarea name=\"alamat\" cols=\"35\" rows=\"5\">".$arq['ALAMAT']."</textarea></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Handphone</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"35\" name=\"phone\" VALUE=".$arq['HP']."></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">No. SPAJ</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"20\" name=\"spaj\" VALUE=".$arq['NOSP']."></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Tgl. SPAJ</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"10\" id=\"datepicker\" name=\"tglspaj\" VALUE=".$arq['TGLSP']."></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Premi</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"20\" name=\"premi\" VALUE=".$arq['PREMI']."></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Top Up</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"20\" name=\"topup\" VALUE=".$arq['TOPUP']."></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">No. Agen</td>";
                echo "      <td class=\"verdana9blk\">: <input readonly type=\"text\" size=\"10\" name=\"noagen\" VALUE=".$arq['NOAGEN'].">";
				?> <a href="#" onClick="NewWindow('../agnlistx.php?a=ntryprop','popuppage','420','300','yes')"><img height="20" src="./images/find.png" border="0" alt="cari daftar agen"></a><?
                echo "</td></tr>";                
                echo "    <tr>";
				if ($arq['TALTUP']=='1') {$cek1='checked'; $cek2='';} else {$cek2='checked'; $cek1='';}
                echo "      <td class=\"verdana9blk\">Taltup ?</td>";
                echo "      <td class=\"verdana9blk\">:  <input type=\"radio\" ".$cek1." name=\"taltup\" id=\"taltup\" value=\"1\"/>Ya".
					 "<input type=\"radio\" ".$cek2." name=\"taltup\" id=\"taltup\" value=\"0\"/>Tidak</td>";
                echo "    </tr>";								
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">NIK (Jika Produk Kerjasama dengan AAP)</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" readonly size=\"10\" name=\"nikuseraap\" VALUE=".$arq['NIKUSERAAP']."></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Nama Agen AAP (Jika Produk Kerjasama dengan AAP)</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" readonly size=\"10\" name=\"useraap\" VALUE=".$arq['USERAAP']."></td>";
                echo "    </tr>";
                echo "  </table>";
								?>                </td>
            </tr>
            <? 
			
			//echo $sqllunas;
			
			
        		//if($PER->statusfile!='AKTIF'||substr($PER->produk,0,3)!="JL2"){
			?>
            <tr>
              <td align="center" bgcolor="#E4E4E4"><? echo "<input type=\"submit\" value=\"SUBMIT\" name=\"Submit\" style=\"font-size: 8pt; font-family: Verdana\">"; ?></td>
            </tr>

			<tr>
              <td align="center" bgcolor="#E4E4E4"><a onClick="NewWindow('./cetakinfo.php?sp=<?=$arq['NOSP'];?>','popuppage','620','500','yes')"><img src="./images/cetak.png" border="0" alt="Cetak Surat"></a>&nbsp;<a onClick="NewWindow('./daftar_proposal.php?sp=<?=$arq['NOSP'];?>','popuppage','620','500','yes')"><img src="./images/proposal.png" border="0" alt="Cetak Daftar"></a></td>
            </tr>
</table>
        <?
        echo "</div>";
        echo "</form>";
        
?>
<hr size="1">
<a href="../../submenu.php?mnuinduk=150"><font face="Verdana" size="2">New Unit Link</font></a>
</body>
</html>