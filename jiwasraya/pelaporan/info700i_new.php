<?
  include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/klien.php";
  include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";
  include "../../includes/kantor.php";

  $bln = (!$bl) ? $bln : '';
  $DB = new Database($userid,$passwd,$DBName);

  if($update_pending=1){
    $sql = "UPDATE $DBUser.tabel_700_pulih SET suspend = '', keterangan = '' 
            WHERE prefixpertanggungan = '".$prefixpertanggungannew."' and nopertanggungan = '".$nopertanggungannew."' and to_char (tglhitung, 'DD/MM/YYYY') = '".$tglhitungnew."' ";
    //echo $sql;
    $DB->parse($sql);
    $DB->execute();
    //print_r($PREFIX);echo "</br>";
    //print_r($NOPER);echo "</br>";
    //print_r($TGLHIT);echo "</br>";
    //echo "Update Suspend dan keterangan";
    //var_dump($DB);
  }

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
  <head>
    <title>Informasi Pengajuan Pemulihan</title>
    <link href="../jws.css" rel="stylesheet" type="text/css">
    <? include "../../includes/hide.php";  ?>
    <script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
  </head>
  <body>
    <div align="center">
      <form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
        <table>
            <tr>
              <td align="center" class="arial10blk"><b>PENGECEKAN STATUS PEMULIHAN KANTOR <? echo $kantor; ?><br><br></td>
            </tr>
        </table>
        <!--Fungsi untuk memilih tanggal pengajuan-->
        <table width="50%" cellpadding="5" cellspacing="0" border="0">
          <tr>
            <td align="left" class="arial10" width="45%">Bulan Pengajuan</td>
        		<td width="5%">:</td>
        		<td width="50%">
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
        	<tr>
            <td></td>
            <td></td>
            <td align="left"><input name="cari" value="Periksa Status" type="submit"></td>
        	</tr>
        	
        </table>
        <hr size="1">
        <table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="100%" align="center">
          <tr>
            <td class="tblhead" align="center"><b>DAFTAR PENGAJUAN PEMULIHAN RAYON PENAGIHAN <? echo $kantor; ?></td>
        	</tr>
          <?
            $jns = 'pulih';
          ?>	
          <tr>
            <td class="tblisi" align="center">
        		  <table  width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr class="hijao">
          			  <td align="center">No</td>
          			  <td align="center">Nomor Polis</td>
          			  <td align="center">Pemegang Polis</td>
          			  <td align="center">Tertanggung</td>
          			  <td align="center">Produk</td>
          			  <td align="center">Tanggal<br>Pengajuan</td>
          			  <td align="center">Tanggal<br>Perhitungan</td>
          			  <td align="center">Tanggal<br>Otorisasi</td>
          			  <td align="center">User <br>Rekam</td>
          			  <td align="center">Tanggal<br>Rekam</td>
          			  <td align="center">Status <br>Terakhir</td>
          			 	<td align="center">Cetak<br>SIP / Surat-surat</td>
                  <td align="center"  width="250px">Keterangan Pending</td>
                </tr>
                <?
                  $KTR=New kantor($userid,$passwd,$kantor);
	  
                  $bl = (strlen($bl)==1) ? "0".$bl : $bl;
                  $tglhitung = (strtoupper($jns)=='GADAI') ? "tglgadai" : "tglhitung";
                  $kam = ($bl=='13') ? "to_char(a.tglrekam,'YYYY')='".$th."' and " : "to_char(a.tglrekam,'MMYYYY')='".$bl.$th."' and ";

                  if($kantor == 'KP'){
                    $filter_kantor = "";
                  }else{
                    $filter_kantor = " AND a.kantorproses = '".$kantor."' ";
                  }
                  //$kim = ($bl=='13') ? "to_char(a.tglpengajuan,'YYYY')='".$th."' and " : "to_char(a.tglpengajuan,'MMYYYY')='".$bl.$th."' and ";
      
                  //Dikarenakan tanggal permohonan bisa dibubah-ubah atau sesuai yg diinput oleh ASC, maka untuk tgl pengiriman yg diambil adalah tgl rekam by TEGUH
                  $sql = "select a.nomorsip,a.prefixpertanggungan,a.nopertanggungan,a.userrekam,b.namastatus,a.status, ".
                  		 	 "to_char(a.tglrekam,'DD/MM/YYYY HH24:MI') tglmohon,to_char(a.".$tglhitung.",'DD/MM/YYYY') tglhitung,".
                  			 "to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam, ".
                  		   "to_char(a.tglsip,'DD/MM/YYYY') tglsip, a.suspend, a.keterangan ".
                  			 "from ".
                  			 "$DBUser.tabel_200_pertanggungan c, $DBUser.tabel_700_pulih a,".
                  			 "$DBUser.tabel_999_kode_status b ".
                  			 "where ".
                  			 $kam.
                  			 "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan and a.status ='0' ".
                  			 //"and c.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' ".
            				 //"and c.kdproduk not in ('JSR1','JSR2','JSR3','JSR4') ".
            				     $filter_kantor. 
                  			 "and a.status=b.kdstatus and b.jenisstatus='PULIH' ".
                  			 "order by tglmohon asc, a.prefixpertanggungan,a.nopertanggungan ";
                  
                  $DB->parse($sql);
                  $DB->execute();
                  // echo $sql;
                  $i=1;
                  while ($arr=$DB->nextrow()) {
                    $PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
                    include "../../includes/belang.php"; 
                    $tglmohon = (strtoupper($jns)=='KLAIM') ? substr($arr["KDKLAIM"],0,1)." ".$arr["TGLMOHON"] : $arr["TGLMOHON"];
                    $tglotorisasi = (!$arr["TGLOTORISASI"]=='') ? $arr["TGLOTORISASI"] : "<font color=red>-</font>";
                    echo ( "	<td class=verdana8blu align=\"center\" width=3%>$i</td>\n" );
                    echo ( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>\n" );
                    echo ( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."','',550,300,1);\">&nbsp;".$PER->namapemegangpolis."</a></td>\n" );
                    echo ( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."','',550,300,1);\">&nbsp;".$PER->namatertanggung."</a></td>\n" );
                    echo ( "	<td class=verdana8blu align=\"left\"><a href=\"#\" onclick=\"NewWindow('../polis/simulink.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."','',550,300,1);\">".$PER->produk."</a></td>\n" );
                    echo ( "	<td class=verdana8blu align=\"center\">".$tglmohon."</td>\n" );
                    echo ( "	<td class=verdana8blu align=\"center\">".$arr["TGLHITUNG"]."</td>\n" );
                    echo ( "	<td class=verdana8blu align=\"center\">".$tglotorisasi."</td>\n" );
                    echo ( "	<td class=verdana8blu align=\"left\">".$arr["USERREKAM"]."</td>\n" );
                    echo ( "	<td class=verdana8blu align=\"center\">".$arr["TGLREKAM"]."</td>\n" );
                  	echo ( "	<td class=verdana8blu align=\"left\">".$arr["NAMASTATUS"]."</td>\n" );
                    $status=$arr["STATUS"];
                  	$prefix=$arr["PREFIXPERTANGGUNGAN"];
                  	$noper =$arr["NOPERTANGGUNGAN"];
                    $tglhitung =$arr["TGLHITUNG"];
                    $suspend =$arr["SUSPEND"];
                    $keterangan =$arr["KETERANGAN"];
                  	$kdklaim=$arr["KDKLAIM"];
		                $jenis = 'pulih';

                  	switch ($jenis) {
                      case 'pulih':
                    	  switch ($status) {
                    	  case '0':
                  		 //$lanjut = 'TUNGGU DESISI';
            			   if ($KTR->jeniskantor=='KANTOR PERWAKILAN') {
                  		 	$lanjutkan = "";
                          if ($suspend == '1'){
                              $ket_pending = $keterangan;
                              $kliklanjutpending = "
                                <input type=\"button\" name=\"update_pending\" value=\"Klik Lanjut\" style=\"padding:0px;margin:0px;\" onClick=\"window.location.href=('info700i.php?update_pending=1&prefixpertanggungannew=$prefix&nopertanggungannew=$noper&tglhitungnew=$tglhitung')\">
                              ";
                          }else{
                              $kliklanjutpending = "";
                              $ket_pending = "";
                          }

                     }else {
                          if ($suspend == '1'){
                              $lanjutkan = "";
                              $ket_pending = $keterangan;
                          }else{
                            $ket_pending = "";
                            $lanjutkan = "<a href=\"#\" onclick=\"window.open('../mutasiDPBCLNT/aktifkanPolisPemulihan.php?prefixpertanggungan=$prefix&nopertanggungan=$noper')\">KLIK DISINI</a>";
                          }
                  		}
                  		 $cetaksip ='';
                  		 
                  		 break;
                  	  case '1':
                  		 //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/kasirentry006.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
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
                   }	 	 
                	//print( "	<td class=verdana8blu align=\"left\">".$lanjut."</td>\n" );
                   print( "	<td class=verdana8blu align=\"left\">".$lanjutkan.$cetaksip."</td>\n" );
                	
          			   print( "<td class=verdana8blu width=\"250px\" align=\"center\">".$ket_pending."  </br>  ".$kliklanjutpending."</td>\n");	

      	         print( " </tr>" );
                $i++;
              }			 
              ?>		  
            </table>
          </td>
        </tr>
      </table>

      <table width="100%">
        <tr>
          <td width="50%" align="left"><a href="../polisserv.php"><font face="Verdana" size="2">Menu Pemeliharaan Polis</font></a></td>
      		<td width="50%" align="right"><a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a></td>
      	</tr>
      </table>
    </form>
    </div>
  </body>
</html>