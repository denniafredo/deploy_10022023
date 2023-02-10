<?
  include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/klien.php";
  include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";
  include "../../includes/kantor.php";

	$bln = (!$bl) ? $bln : '';
  $DB = new database($userid, $passwd, $DBName);

  if($update_pending=1){
    $sql = "UPDATE $DBUser.tabel_700_pulih SET suspend = '', keterangan = '' 
            WHERE prefixpertanggungan = '".$prefixpertanggungannew."' and nopertanggungan = '".$nopertanggungannew."' and to_char (tglhitung, 'DD/MM/YYYY') = '".$tglhitungnew."' ";
    //echo $sql;
    $DB->parse($sql);
    $DB->execute();
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Informasi Pengajuan Tebus/Gadai/Pemulihan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<script language="JavaScript"> 
function Cekbok(doc){ 
 if (doc == true)
 {
 checkedAll('ntryclnthub', true);
 }
 else
 {
 checkedAll('ntryclnthub', false);
 }
} 
</script>
 <script>
      function checkedAll (id, checked) {
	var el = document.getElementById(id);

	for (var i = 0; i < el.elements.length; i++) {
	  el.elements[i].checked = checked;
	}
      }
</script>
</head>
<body>
<div align="center">
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<table >
  <tr>
    <td align="center" class="arial10blk"><b>PENGECEKAN STATUS PENGAJUAN GADAI/TEBUS/PEMULIHAN KANTOR <? echo $kantor; ?></td>
	</tr>
  </table>
<table width="50%" cellpadding="0" cellspacing="0">
 <tr>
    <td align="left" class="arial10" width="45%">Bulan Pengajuan</td>
		<td width="5%">:</td>
		<td width="50%">
		  <select name="tgl" onFocus="highlight(event)" class="c">
        <?php
          $selected = date('d');
          print( "<option value='01'>01</option>" );
          print( "<option value='02'>02</option>" );
          print( "<option value='03'>03</option>" );
          print( "<option value='04'>04</option>" );
          print( "<option value='04'>05</option>" );
          print( "<option value='06'>06</option>" );
          print( "<option value='07'>07</option>" );
          print( "<option value='08'>08</option>" );
          print( "<option value='09'>09</option>" );

          for ($i=10; $i<=31; $i++) {
            if ($i==$tgl) {
              print( "<option value=$i selected>$i</option>" );
            } else {
              print( "<option value=$i>$i</option>" );
            }
          }
          print( "<option value='SEMUA'>SEMUA</option>" );
        ?>
      </select>
      
      <select name="bl" onFocus="highlight(event)" class="c">
  		  <?
  			$bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember','SEMUA');
  			for ($i=1; $i<=13; $i++) {
  			   if ($i==$bl || $bulan[$i]==$bln) {
  				  print( "<option value=$i selected>".$bulan[$i]."</option>" );
  				 } else {
  				  print( "<option value=$i>".$bulan[$i]."</option>" );
  				 }	
  			}
  			?>
		  </select>
		  <select name="th" onFocus="highlight(event)" class="c">
  		  <?
  			$th=(!$th) ? substr($tanggal,-4) : $th;
  			$awalth = 2000;
  			for ($i=$awalth; $i<=substr($tanggal,-4); $i++) {
  			  if ($i==$th) {
  				  print( "<option value=$i selected>$i</option>" );
  				} else {
  				  print( "<option value=$i>$i</option>" );
  				}	
  			}
  			
  			?>
		 </select>
		</td>
	</tr> 
	<?
	  //var_dump($bulan);
			$jnsval = array(1=>'gadai','tebus','pulih','klaim');
			$jnslab = array(1=>'Pinjaman Polis (Gadai)','Penebusan Polis','Pemulihan Pertanggungan','Klaim Asuransi');
	?>
  <tr>
    <td align="left" class="arial10" width="45%">Jenis Pengajuan</td>
		<td width="5%">:</td>
		<td width="50%">
		 <select name="jns" onFocus="highlight(event)" class="c">
		 <?
		 //$jns = "pulih";
		  for ($i=1; $i<=count($jnsval); $i++) {
		   if ($jnsval[$i] == $jns) { 
			 $jenis = $jnsval[$i];
			 	print( " <option selected value=".$jnsval[$i].">".$jnslab[$i]."</option>\n" );
			 } else {
			 	print( " <option value=".$jnsval[$i].">".$jnslab[$i]."</option>\n" );
			 }	
			}
		 ?>
		 </select>
		</td>
	</tr>
	<tr>
		<td colspan="3" width="100%" align="left"><input name="cari" value="Periksa Status" type="submit">
		</td>
	</tr>
	
</table>
<hr size="1">
<table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="100%" align="center">
  <tr>
    <td class="tblhead" align="center"><b>DAFTAR PENGAJUAN <? echo strtoupper($jns);?> RAYON PENAGIHAN <? echo $kantor; ?></td>
	</tr>
    <?
	if ($_POST['bayar']) {
    $box=$_POST['box1']; //as a normal var
    $box_count=count($box); // count how many values in array

    if (($box_count)<1) {
        echo "No Data Updated !";
    }
    else {
        foreach ($box as $dear) {
            $ket = explode('#',$dear);
			//echo $ket[0]."#".$ket[1]."#".$ket[2]."#".$ket[3]."#".$ket[4];
            $tglcari = $ket[1]."/".$ket[2]."/".$ket[3];
            $createsip="begin $DBUser.sip('".$ket[0]."','".$ket[1]."','".$kantor."','".$ket[3]."',to_date('".$ket[2]."','DD/MM/YYYY')); end;";
			//echo $createsip;
					$DB->parse($createsip);
                    $DB->execute();
			//echo $createsip."<br / >";	
			$tglhitgad = $ket[3] == 'GADAI' ? 'tglgadai' : 'tglhitung';
			$sqa = "update $DBUser.tabel_700_".$ket[3]." set statusbayar='1',status='2' where  prefixpertanggungan='".$ket[0]."' ".
				   " and nopertanggungan='".$ket[1]."' and to_char($tglhitgad,'dd/mm/yyyy')='".$ket[2]."'";
                    $DB->parse($sqa);
                    $DB->execute();
            //echo $sqa."<br />";
        }
    }
}
	?>	
	<tr>
    <td class="tblisi" align="center">
		  <table  width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tr class="hijao" align="center">
			  <td>No - <?php echo $tgl;?></td>
			  <td>Nomor Polis</td>
			  <td>Pemegang Polis</td>
			  <td>Tertanggung</td>
			  <td>Produk</td>
        <?php
          if(strtoupper($jns)=='TEBUS'){
            echo "<td>Tanggal<br>Mulas</td>";
            echo "<td>Tanggal<br>Pengajuan Form</td>";
          }else{
            echo "<td>Tanggal<br>Pengajuan</td>";
          }
        ?>
			  <td>Tanggal<br>Perhitungan</td>
			  <td>Tanggal<br>Otorisasi</td>
			  <td>User <br>Rekam</td>
			  <td>Tanggal<br>Rekam</td>
			  <td>Status <br>Terakhir</td>
				<!--<td align="center">Proses<br>Berikut</td>-->
         <?php
          if(strtoupper($jns)=='TEBUS'){
            echo "<td>Status Polis</td>";
          }
        ?>
			 	<td>Cetak<br>SIP / Surat-surat</td>
        <?php
          if($jenis=='pulih'){
            echo"<td width='250px'>Keterangan Pending</td>";
          }else{
          }
        ?>
        <td><input type="checkbox" name="xxx" onClick="Cekbok(this.form.xxx.checked);" /></td>
			 </tr>
      <?
	  $KTR=New kantor($userid,$passwd,$kantor);
	  
      $bl = (strlen($bl)==1) ? "0".$bl : $bl;
      $tglhitung = (strtoupper($jns)=='GADAI') ? "tglgadai" : "tglhitung";
      if($jns =='GADAI'){
        $querytglhitung = "CASE
                  WHEN (EXTRACT (DAY FROM a.tglmohon)) <= (EXTRACT (DAY FROM c.mulas)) THEN  TO_CHAR(c.mulas, 'DD')||'/'||TO_CHAR(a.tglmohon, 'MM/YYYY')
                  WHEN (EXTRACT (DAY FROM a.tglmohon)) > (EXTRACT (DAY FROM c.mulas)) THEN  TO_CHAR(c.mulas, 'DD')||'/'||TO_CHAR(a.tglhitung, 'MM/YYYY') 
                END TGLHITUNG2, ";
      }else{
        $querytglhitung = "";
      }
	    $nilaibenefit = (strtoupper($jns)=='GADAI') ? "nilaigadai" : "nilaitebus";
      //$kamplh = ($bl=='13') ? "to_char(a.tglrekam,'YYYY')='".$th."' and " : "to_char(a.tglrekam,'MMYYYY')='".$bl.$th."' and ";

        if($bl=='13'){
          $kam = "to_char(a.tglmohon,'YYYY')='".$th."' and ";
          $kim = "to_char(a.tglpengajuan,'YYYY')='".$th."' and ";
          $kamplh = "to_char(a.tglrekam,'YYYY')='".$th."' and ";
        }else{
          if($tgl == 'SEMUA'){
            $kam = "to_char(a.tglmohon,'MMYYYY')='".$bl.$th."' and ";
            $kim = "to_char(a.tglpengajuan,'MMYYYY')='".$bl.$th."' and ";
            $kamplh = "to_char(a.tglrekam,'MMYYYY')='".$bl.$th."' and ";
          }else{
            $kam = "to_char(a.tglmohon,'DDMMYYYY')='".$tgl.$bl.$th."' and ";
            $kim = "to_char(a.tglpengajuan,'DDMMYYYY')='".$tgl.$bl.$th."' and ";
            $kamplh = "to_char(a.tglrekam,'DDMMYYYY')='".$tgl.$bl.$th."' and ";
          }
        }
        //$kam = ($bl=='13') ? "to_char(a.tglmohon,'YYYY')='".$th."' and " : "to_char(a.tglmohon,'DDMMYYYY')='".$tgl.$bl.$th."' and ";
      
      //$kim = ($bl=='13') ? "to_char(a.tglpengajuan,'YYYY')='".$th."' and " : "to_char(a.tglpengajuan,'MMYYYY')='".$bl.$th."' and ";
      
      if($jenis=='pulih'){
        $sql = "select a.nomorsip,a.prefixpertanggungan,a.nopertanggungan,a.userrekam,b.namastatus,a.status, ".
                "to_char(a.tglrekam,'DD/MM/YYYY HH24:MI') tglmohon,to_char(a.".$tglhitung.",'DD/MM/YYYY') tglhitung,".
                "to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam, ".
                "to_char(a.tglsip,'DD/MM/YYYY') tglsip, a.suspend, a.keterangan ".
                "from ".
                "$DBUser.tabel_200_pertanggungan c, $DBUser.tabel_700_pulih a,".
                "$DBUser.tabel_500_penagih d, $DBUser.tabel_999_kode_status b ".
                "where ".
                $kamplh.
                "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
                //"and c.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' ".
                //"and c.kdproduk not in ('JSR1','JSR2','JSR3','JSR4') ".
                "and c.nopenagih=d.nopenagih and d.kdrayonpenagih ".
                "in ( ".
                " SELECT   kdkantor ".
                "  FROM   $DBUser.TABEL_001_KANTOR ".
                "  START WITH   KDKANTOR = '$kantor' ".
                "  CONNECT BY   PRIOR KDKANTOR = KDKANTORINDUK ".
                "  ) ".
                "and a.status=b.kdstatus and b.jenisstatus='PULIH' ".
                "order by tglmohon asc, a.prefixpertanggungan,a.nopertanggungan ";
        $DB->parse($sql);
        $DB->execute();
        //echo $sql;
      }else{
        $sql = "select a.nomorsip,a.prefixpertanggungan,a.nopertanggungan,a.userrekam,b.namastatus,a.status, ".
        		 	 "to_char(a.tglmohon,'DD/MM/YYYY') tglmohon,to_char(a.".$tglhitung.",'DD/MM/YYYY') tglhitung,".
        			 "to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam, ".
        		   "to_char(a.tglsip,'DD/MM/YYYY') tglsip, 
               to_char(c.mulas, 'DD/MM/YYYY') mulas,
               (SELECT NAMASTATUSFILE FROM $DBUser.TABEL_299_STATUS_FILE WHERE KDSTATUSFILE = c.KDSTATUSFILE) STATUS_POLIS,
                ".$querytglhitung."
               $nilaibenefit nilaibenefit ".
        			 "from ".
        			 "$DBUser.tabel_200_pertanggungan c, $DBUser.tabel_700_".strtolower($jns)." a,".
        			 "$DBUser.tabel_500_penagih d, $DBUser.tabel_999_kode_status b ".
        			 "where ".
        			 $kam.
        			 "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
        			 //"and c.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' ".
  				 //"and c.kdproduk not in ('JSR1','JSR2','JSR3','JSR4') ".
  				 "and c.nopenagih=d.nopenagih and d.kdrayonpenagih ".
  				 "in ( ".
  				 " SELECT   kdkantor ".
  				 "	FROM   $DBUser.TABEL_001_KANTOR ".
  				 "	START WITH   KDKANTOR = '$kantor' ".
  				 "  CONNECT BY   PRIOR KDKANTOR = KDKANTORINDUK ".
  				 "  ) ".
        			 "and a.status=b.kdstatus and b.jenisstatus='".strtoupper($jns)."' ".
        			 "order by a.prefixpertanggungan,a.nopertanggungan ";
        	//echo $sql;		 
        $sqa =  "select ".
        					"a.prefixpertanggungan,a.nopertanggungan,a.userrekam,c.namastatus,nvl(a.status,'0') status, ".
          		    "a.kdklaim,b.namaklaim,to_char(a.tglpengajuan,'DD/MM/YYYY') tglmohon, ".
          				"to_char(a.tglhitung,'DD/MM/YYYY') tglhitung, ".
           				"to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,".
        					"to_char(a.tglrekam,'DD/MM/YYYY') tglrekam, ".
        					"a.userptg,".
          				"a.useradlog, a.nilaibenefit ".
         				"from ".
          				"$DBUser.tabel_200_pertanggungan e, $DBUser.tabel_901_pengajuan_klaim a, ".
          				"$DBUser.tabel_500_penagih d,$DBUser.tabel_902_kode_klaim b,".
          				"$DBUser.tabel_999_kode_status c ".
        				"where ".
        				  $kim.
          				"a.kdklaim=b.kdklaim and ".
          				"a.prefixpertanggungan=e.prefixpertanggungan and a.nopertanggungan=e.nopertanggungan ".
          			  "and e.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' ".
          			 	"and nvl(a.status,'0')=c.kdstatus and c.jenisstatus='KLAIM' ".
  								"and nvl(a.klaimgroup,'0')='0' ".
        				"order by a.prefixpertanggungan,a.nopertanggungan ";
        
        $sql = ($jns=='klaim') ? $sqa : $sql; 
        $DB->parse($sql);
        $DB->execute();
        //echo $sql;
      }

      $i=1;
      while ($arr=$DB->nextrow()) {
      $PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
      include "../../includes/belang.php"; 
      $tglmohon = (strtoupper($jns)=='KLAIM') ? substr($arr["KDKLAIM"],0,1)." ".$arr["TGLMOHON"] : $arr["TGLMOHON"];
      $tglotorisasi = (!$arr["TGLOTORISASI"]=='') ? $arr["TGLOTORISASI"] : "<font color=red>-</font>";
        print( "	<td class=verdana8blu align=\"center\" width=3%>$i</td>\n" );
        print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>\n" );
        print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."','',550,300,1);\">&nbsp;".$PER->namapemegangpolis."</a></td>\n" );
        print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."','',550,300,1);\">&nbsp;".$PER->namatertanggung."</a></td>\n" );
        print( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."','',550,300,1);\">".$PER->produk."</a></td>\n" );

        // Tambahan - Teguh 13/02/2020
        if(strtoupper($jns)=='TEBUS'){
          echo "<td class=verdana8blu align='center'>".$arr["MULAS"]."</td>";
          echo "<td class=verdana8blu align='center'>".$tglmohon."</td>";
          echo "<td class=verdana8blu align='center'>".$arr["TGLHITUNG2"]."</td>";
        }else{
          print( "  <td class=verdana8blu align='center'>".$tglmohon."</td>\n" );
          print( "  <td class=verdana8blu align='center'>".$arr["TGLHITUNG"]."</td>\n" );
        }
        print( "	<td class=verdana8blu align='center'>".$tglotorisasi."</td>\n" );
        print( "	<td class=verdana8blu align='left'>".$arr["USERREKAM"]."</td>\n" );
        print( "	<td class=verdana8blu align='center'>".$arr["TGLREKAM"]."</td>\n" );
        
        // Tambahan - Teguh 13/02/2020
        if(strtoupper($jns)=='TEBUS'){
          echo "<td class=verdana8blu align='center'>".$arr["STATUS"]."</td>";
          echo "<td class=verdana8blu align='center'>".$arr["STATUS_POLIS"]."</td>";
        }else{
          print( "  <td class=verdana8blu align='left'>".$arr["NAMASTATUS"]."</td>\n" );
        }

        $status=$arr["STATUS"];
      	$prefix=$arr["PREFIXPERTANGGUNGAN"];
      	$noper =$arr["NOPERTANGGUNGAN"];
      	$kdklaim=$arr["KDKLAIM"];
		
      	switch ($jenis) {
      	case 'gadai':
      	 switch ($status) {
      	  case '0':
      		 $lanjut = 'TUNGGU DESISI';
			 $tglgdi = str_replace("/", "", $arr["TGLHITUNG"]);
			 if ($arr['NILAIBENEFIT']) {
				$cetaksip = "<a href='#' onclick='window.location.href=\"../mutasiDPBCLNT/otorisasigadai.php?prefixpertanggungan=$prefix&nopertanggungan=$noper&tglgdi=$tglgdi\"'>Otorisasi</a>";
			 } else {
				$cetaksip = "";
			 }
      		 //$cetaksip = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2_ptg.php?prefix=$prefix&noper=$noper&kdbayar=G01GADAI')\">Cetak Surat Penyataan, Akta, Ijin Gadai</a>";
      		 break;
      	  case '1':
      		 //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2_ptg.php?prefix=$prefix&noper=$noper&kdbayar=G01GADAI')\">Cetak Surat Penyataan, Akta, Ijin Gadai</a>";
      		 break;
      		case '2':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=G01GADAI&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip =  "SIAP | <a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2_ptg.php?prefix=$prefix&noper=$noper&kdbayar=G01GADAI')\">Cetak Surat Penyataan, Akta, Ijin Gadai</a>";
        	 //$cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
        	 break;
      		case '3':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pelunasangadai.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip = '';
      		 break;
      	  case '4':
      		 $lanjut = 'S E L E S A I';
      		 $cetaksip = '';
      		 break;		 
      	 }
      	 break;
      	case 'tebus':
      	 switch ($status) {
      	  case '0':
      		 $lanjut = 'TUNGGU DESISI';
      		 $cetaksip = '';
      		 break;
      	  case '1':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuantebus2.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 //$cetaksip = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuantebus2_ptg.php?prefix=$prefix&noper=$noper&kdbayar=G01GADAI')\">Cetak Desisi Tebus</a>";
      		 $cetaksip = "<a href=\"#\" onclick=\"NewWindow('../polis/cetakizin_tebus.php?prefix=$prefix&noper=$noper','',700,400)\">Cetak Desisi Tebus</a>";
      		 
			 break;
      		case '2':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=T01TEBUS&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip =  "SIAP | <a href=\"#\" onclick=\"NewWindow('../polis/cetakizin_tebus.php?prefix=$prefix&noper=$noper','',700,400)\">Cetak Desisi Tebus</a>";
      		 //$cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
			 //$check="<input type=\"checkbox\" name=\"box1[]\" value=\"".$arr["PREFIXPERTANGGUNGAN"]."#".$arr["NOPERTANGGUNGAN"]."#".$arr["TGL_PENGAJUAN"]."#".$arr["KDKLAIM"]."\">";
        	 break;
      		case '3':
      		 $lanjut = 'TEBUS SELESAI';
        	 $cetaksip = '';
      		 break;
      	 }
      	 break;
      	case 'pulih':
		
      	 switch ($status) {
      	  case '0':
      		 //$lanjut = 'TUNGGU DESISI';
			 if ($KTR->jeniskantor=='KANTOR PERWAKILAN') {
      		 	$lanjutkan = "";} else {
      		 	$lanjutkan = "<a href=\"#\" onclick=\"window.location.replace('../mutasiDPBCLNT/aktifkanPolisPemulihan.php?prefixpertanggungan=$prefix&nopertanggungan=$noper')\">KLIK DISINI</a>";}
      		 $cetaksip ='';
      		 
      		 break;
      	  case '1':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/kasirentry006.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip = "<a href=# onclick=NewWindow('../polis/cetakbatalrider.php?kdsip=$jenis&prefixpertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK KLAUSUL BATAL RIDER</a>";
			 $lanjutkan = "";
      		 break;
      		case '2':
      		 $lanjut = 'TUNGGU SPP';
        	 $cetaksip = '';
      		 //$cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
			 $lanjutkan = "";
        	 break;
      		case '3':
      		 $lanjut = 'SPP TERBIT';
        	 $cetaksip = "<a href=# onclick=NewWindow('../polis/cetakbatalrider.php?kdsip=$jenis&prefixpertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK KLAUSUL BATAL RIDER</a>";
			 $lanjutkan = "";
      		 break;
      		default:
      		 $lanjut = 'P E N D I N G';
        	 $cetaksip = '';
			 $lanjutkan = "";
      		 break;
      	 }
      	 break;
      	 
      	 case 'klaim':
      	 switch ($status) {
      	  case '0':
      		 $lanjut = 'TUNGGU DESISI';
      		 $cetaksip = '';
      		 break;
      	  case '1':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuanklaimFF.php?prefix=$prefix&noper=$noper&kdklaim=$kdklaim&tglpengajuan=".$arr["TGLMOHON"]."')\">KLIK DISINI</a>";
        	 $cetaksip = '';
      		 break;
      		case '2':
      		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/bayar.php?kdklaim=".$arr["KDKLAIM"]."&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
        	 $cetaksip =  "SIAP";
      		 //$cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
        	 break;
      		case '3':
      		 $lanjut = 'KLAIM SELESAI';
        	 $cetaksip = '';
      		 break;
      		} 
       }	 	 
      	//print( "	<td class=verdana8blu align=\"left\">".$lanjut."</td>\n" );
        //Jika Pemulihan dan status pending maka akan muncul keterangan pending dan untuk kantor cabang akan muncul keterangan pending dan tombol klik lanjut Oleh Teguh 20/08/2019
        print( "<td class=verdana8blu align=\"left\">".$lanjutkan.$cetaksip."</td>\n" );
      	
		if (in_array($jenis, array("tebus", "gadai")) && $status=="1") {
			print( "<td class=verdana8blu align=\"left\"><input type=\"checkbox\" name=\"box1[]\" value=\"".$arr["PREFIXPERTANGGUNGAN"]."#".$arr["NOPERTANGGUNGAN"]."#".$arr["TGLHITUNG"]."#".strtoupper($jenis)."\"></td>\n");	
		} elseif ($jenis=='pulih') {
			$tglhitung =$arr["TGLHITUNG"];
			$kliklanjutpending = "<input type=\"button\" name=\"update_pending\" value=\"Klik Lanjut\" style=\"padding:0px;margin:0px;\" onClick=\"window.location.href=('info700i.php?update_pending=1&prefixpertanggungannew=$prefix&nopertanggungannew=$noper&tglhitungnew=$tglhitung')\">";
			if ($kantor=='KP') {
				print( "<td class=verdana8blu width =\"250px\" align=\"center\">".$arr["KETERANGAN"]."</td>\n");
				print( "<td class=verdana8blu align=\"left\"></td>\n");
			} else {
				if($arr["SUSPEND"]=='1'){
					print( "<td class=verdana8blu width =\"250px\" align=\"center\">".$arr["KETERANGAN"]."</br>".$kliklanjutpending."</td>\n");
					print( "<td class=verdana8blu align=\"left\"></td>\n");
				} else {
					print( "<td class=verdana8blu align=\"left\"></td>\n");
					print( "<td class=verdana8blu align=\"left\"></td>\n");
				}
			}
		} else {
			print( "<td class=verdana8blu align=\"left\"></td>\n");	
		}
		print( " </tr>" );
		$i++;
	}
    
	if($kantor=="KP") { ?>
		<tr>
			<td class=verdana8blu  colspan="13"><strong><div align="left">Untuk Proses Pembayaran Hari Ini Silahkan Proses Sebelum Pukul 12.00 WIB</div></strong><div align="right"><input type="submit" name="bayar"  value="Proses Bayar" /></div></td></tr></table></td>
		</tr>
	<? } ?>
</table>

      <table width="100%">
        <tr>
          <td width="50%" align="left"><a href="../polisserv.php"><font face="Verdana" size="2">Menu Pemeliharaan Polis</font></a></td>
      		<td width="50%" align="right"><a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a></td>
      	</tr>
      </table>

      </td>
    </tr>

    </div>
  </body>
</html>