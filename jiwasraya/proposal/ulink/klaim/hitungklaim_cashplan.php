<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/duit.php";
	include "../../includes/tunggakan.php";
	include "../../includes/gadai.php";
	include "../../includes/tgl.php";
	include "../../includes/kantor.php";
	echo "<link href=\"../../includes/jws2005.css\" rel=\"stylesheet\" type=\"text/css\">";
	
	$prefix = 	strtoupper($prefix);
	$DB		=	new database($userid, $passwd, $DBName);
	$DA		=	new database($userid, $passwd, $DBName);
	$PER	=	New Pertanggungan($userid,$passwd,$prefix,$noper);
	$kdproduk	=	$PER->produk;
	$TR 	= New Transaksi($userid,$passwd);
	$PWK 	= New Kantor($userid,$passwd,$kantor);
	$KT  	= New Kantor($userid,$passwd,$PWK->kdkantorinduk);	
	$KP  	= New KantorPusat($userid,$passwd);
	
	$sql = "select kelompok from $DBUser.tabel_902_kode_klaim where kdklaim='$kdklaim'";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$klp=$arr["KELOMPOK"];
	
	$sql = 	"select ".
				"to_char(tglpengajuan,'DD/MM/YYYY') tglpengajuan,to_char(tglmeninggal,'DDMMYYYY') tglmeninggal ".
			"from $DBUser.tabel_901_pengajuan_klaim ".
			"where ".
				"prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$kdklaim' ".
				"and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$tglpengajuan=$arr["TGLPENGAJUAN"];				 
	$tglmeninggal=$arr["TGLMENINGGAL"];

	if ($submit=='Submit') {
			$pertanggungan=$prefix."-".$noper;

		 	$sql =  "delete from $DBUser.tabel_905_benefit_klaim ".
       				"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
						"and kdklaim='$kdklaim' and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
		 				//echo $sql;
		 	$DA->parse($sql);
		 	$DA->execute();	
			 
		    //cek klaim yang sudah pernah 
		    $sql = "select max(no_klaim) as maxnoklaim,sum(nilaibenefit) as jmlsudahklaim from $DBUser.tabel_905_historis_klaim_cp where ".
  						"prefixpertanggungan='$prefix' and ".
  						"nopertanggungan='$noper' and ".
  						"kdklaim='$kdklaim' and kdbenefit='".$kdbnft."'";
  		    //echo "<br>".$sql."<br>";
  		 	$DB->parse($sql);
  		 	$DB->execute();	
  		 	$max=$DB->nextrow();
  		 	$maxklaim = $max["MAXNOKLAIM"];
			$jmlklaim = $max["JMLSUDAHKLAIM"];
  		 	$noklaim	= $maxklaim+1; 

			 $nil = 0;
			 $jmlday = 0;
			 echo "<table>";
			 for ($i=0; $i < count($jmlbaris); $i++)
			 {
				if($kdbenefit[$i]==${"kc".$i})
				{
				//$jmlday = ${"jmlhari".$i};
				//$jmlnilai+=$jmlday;
			    echo "<tr>";
				  echo "<td>".${"kc".$i}."</td><td>".(${"jmlhari".$i}==""? "":"".${"jmlhari".$i}." hari")." </td><td align=right>".number_format(${"nilaiklaim".$i},2,",",".")."</td>";
					echo "</tr>";
					$nil = ${"nilaiklaim".$i};

					$sql = "insert into $DBUser.tabel_905_historis_klaim_cp ".
							 	 "(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,kdproduk,".
								 "kdbenefit,nilaibenefit,tglrekam,userrekam,".
								 "no_klaim,jmlhari) ".
								 "values ('$prefix','$noper','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'),'$kdproduk',".
								 "'".${"kc".$i}."',".${"nilaiklaim".$i}.",sysdate,user,".
								 "'$noklaim','".${"jmlhari".$i}."')";
					//echo $sql."<br>";
					$DA->parse($sql);	
					$DA->execute();
					
					$jmlnilai += $nil;
					$jmlday += ${"jmlhari".$i};
				}
			 }
			    echo "<tr>";
				echo "<td colspan=2>Jumlah</td><td align=right>".number_format($jmlnilai,2,",",".")."</td>";
				echo "</tr>";
			 echo "</table><br>";
			 //echo "jml hari = ".$jmlday;
			 
			 $sql = "update $DBUser.tabel_901_pengajuan_klaim set nilaibenefit=".$jmlnilai." ".
			 		"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
					"and kdklaim='$kdklaim' and tglpengajuan=to_date('$tglpengajuan','DD/MM/YYYY')";
			 $DA->parse($sql);	
			 $DA->execute();
			 
			 $sql = "insert into $DBUser.tabel_905_benefit_klaim ".
				      	"(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,kdproduk,kdbenefit,nilaibenefit,tglrekam,userrekam) ".
       			  	"values ".
						"('$prefix','$noper','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'),'$kdproduk','".$kdbnft."',".$jmlnilai.",sysdate,user) ";
			 $DA->parse($sql);
			 if($DA->execute())
			 {
				$a="OK"; //pemicu update tabel pengajuan klaim
			 }
			 else
			 {
			   	echo "Gagal! Pengajuan mungkin sudah pernah dilakukan";
			 }
		 	 
			 
			 if ($a) {
				if($jmlday > 10)
				{
				 $statuspengajuan=0; // jika lebih dari 10 hari, otorisasi ada di kantor pusat
				 $nextprocessmsg = "Pengajuan Klaim Sukses... Proses selanjutnya adalah nunggu persetujuan kantor pusat";
				} else {
				 $statuspengajuan=1;	
				 $nextprocessmsg = "Pengajuan Klaim Sukses... Proses selanjutnya adalah cetak nota desisi dan cetak sip dilakukan oleh kasir.";
				}
			 	$sqa = "update $DBUser.tabel_901_pengajuan_klaim ".
      						   "set userptg=user,tglptg=sysdate,status='$statuspengajuan',".
      							 "userupdated=user,tglupdated=sysdate,tglhitung=trunc(sysdate) ".
      					"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
      						"and kdklaim='$kdklaim' and tglpengajuan=to_date('$tglpengajuan','DD/MM/YYYY')";
				//echo $sqa;
				$DB->parse($sqa);
				$DB->execute();
				for ($i=0; $i<count($bnftklm); $i++) {
				 if($noklaim==2)
				 {
				 $sqa ="update $DBUser.tabel_223_transaksi_produk ".
						   "set status='8' ".
							 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
							 "and kdbenefit ='".$bnftklm[$i]."' ";
				 $DB->parse($sqa);
				 $DB->execute();
				 }
				}			 
				
				echo $nextprocessmsg;
				
				print( "  <table width=\"100%\">\n" );
   			 	print( "   <tr>\n" );
				print( "    <td width=\"50%\" align=\"left\" class=verdana10blk><a href=\"pengajuanklaim_cashplan.php\"><< Back</a></td>\n" );
   			 	if($modul=="2KU"){
				print( "    <td width=\"50%\" align=\"right\" class=verdana10blk><a href=\"#\" onclick=\"window.location.replace('pengajuanklaim_cashplan.php?prefix=$prefix&noper=$noper&kdklaim=$kdklaim&tglpengajuan=$tglpengajuan')\">Lanjut</a></td>\n" );
 	       		} 
			 	print( "	 </tr>\n" );
   			 	print( "	</table>	" );
			 }	 
			 
			//---------------------[ dokumen klaim ] -------------------
  	 		$sqa = "select kddokumen from $DBUser.tabel_904_syarat_klaim  ".
					"where kdklaim='$kdklaim' order by kddokumen desc ";
			$DB->parse($sqa);
			$DB->execute();
  			while ($arr=$DB->nextrow()){			
  				$sql = "update $DBUser.tabel_904_cek_dok_klaim set status='".$$arr["KDDOKUMEN"]."' ,tglupdated=sysdate,userupdated=user ".
         			   "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$kdklaim' ".
  			 				 "and kddokumen='".$arr["KDDOKUMEN"]."' and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
  				$DA->parse($sql);
  				$DA->execute();
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
  <html>
  <head>
  <title>Pengajuan Klaim Tanggal </title>
  <script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/date.js" ></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
  <script language="JavaScript" type="text/javascript">
	function countvalue() {
		h1 = document.propmtc.jmlhari1.value;
		n1 = document.propmtc.actualbenefit1.value;
		document.propmtc.nilaiklaim1.value = h1*n1;
		h2 = document.propmtc.jmlhari2.value;
		n2 = document.propmtc.actualbenefit2.value;
		document.propmtc.nilaiklaim2.value = h2*n2;
		//alert(j1);
	}
	</script>
  <?
	if($kdklaim!="CACAT")
	{
    print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
    print( "<!--\n" );
    
     $sql = "select a.kdbenefit ".
  	 			  "from $DBUser.tabel_223_transaksi_produk a,$DBUser.tabel_207_kode_benefit b ".
  		 	    "where a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
  					//"and b.kdkelompokbenefit='$klp' ".
  					"and a.kdbenefit=b.kdbenefit ";
     
  	 $DB->parse($sql);
  	 $DB->execute();
  	 while ($arr=$DB->nextrow()) {							 
      print( "function Cek".$arr["KDBENEFIT"]."(theForm) {\n" );
    	print( "   if (theForm.cb".$arr["KDBENEFIT"].".checked) {\n" );
    	print( "	  theForm.submit.disabled=false\n" );
    	print( "   } else {\n" );
    	print( "    theForm.submit.disabled=true\n" );
    	print( "	 }	\n" );
    	print( " }\n" );
     }
  	 print( "//-->\n" );
     print( "</script>\n" );
  	 //echo $sql;
  }
	?>
  </head>
  <body>
  <div align="center">
  <form method="POST" name="propmtc" action="<? echo $PHP_SELF;?>">
  <input type="hidden" name="kdklaim" value="<? echo $kdklaim ?>">
  <input type="hidden" name="tglpengajuan" value="<? echo $tglpengajuan ?>">
  
  <table border="0" bgcolor="#cff2b0" cellspacing="1" cellpadding="4" width="95%" align="center">
     <tr bgcolor="#a0d268">
       <td align="center"><b>PERHITUNGAN NILAI KLAIM CASH PLAN</b></td>
     </tr>
		 <tr>
      <td> 
		 
  		 <table border="0" cellpadding="1" width="100%" cellspacing="1">
  				<tr>
  				<td width="23%">Tanggal Pengajuan</td>
  				<td width="2%">:</td>
    			<td width="25%"><input name="tglpengajuan" readonly value="<? echo $tglpengajuan; ?>"></td>
  				<td width="50%" colspan="3"></td>
  				</tr>
  				
  				<tr>
  				<td width="23%">Klaim Yang Diajukan</td>
  				<td width="2%">:</td>
    			<td width="25%"><input name="kdklaim" readonly value="<? echo $kdklaim; ?>"></td>
  				<td width="50%" colspan="3"></td>
  				</tr>
    			<tr>
      		<td width="23%">Nomor Sertifikat</td>
      		<td width="2%">:</td>
  				<td width="23%">
  			  <input type="text" name="prefix" size="2" maxlength="2" readonly value="<? echo $prefix;?>">
  				-<input type="text" name="noper" size="10" readonly value="<? echo $noper;?>"></td>
    			<td width="23%">
  				</td> 
  				<td colspan="2" width="27%"><a href="#" onClick="NewWindow('polis.php?prefix=<?echo$prefix;?>&noper=<?echo$noper;?>','',800,600,1)">Lihat Polis</a></td>
  				</tr>						
  	   </table>	 
			 
  	 </td>
  	 </tr>
  	 <tr bgcolor="#a0d268">
    		<td>Nilai Benefit</td>
	 </tr>
	 <tr>
      <td align="center">

  				 <table bgcolor="#d5f0ec" width="100%" cellpadding="1" cellspacing="1" border="0">
  				  <tr bgcolor="#c0c0c0">
  					 <td align="center" height="20">Nama Benefit</td>
                     <td align="center">Nilai Benefit</td>
  					 <td align="center">Jml. Hari</td>
  					 <td align="center">Jml. Klaim</td>
  					 <td align="center">Pilih</td>
     				</tr>
  					<?
					$sql = 	"select ".
								"a.kdproduk,a.kdbenefit,a.nilaibenefit,a.status,".
								"b.kdkelompokbenefit,b.namabenefit ".
							"from ".
								"$DBUser.tabel_223_transaksi_produk a, ".
								"$DBUser.tabel_207_kode_benefit b ".
							"where ".
								"a.kdbenefit=b.kdbenefit ".
								"and a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
								"and substr(a.kdbenefit,1,2)='CP' ".
								"and nvl(a.status,0)=0";

/*
					$sql = 	"select ".
								"a.kdproduk,a.kdbenefit,a.nilaibenefit,a.status,".
								"b.kdkelompokbenefit,b.namabenefit, ".
								"(select nilaibenefit from $DBUser.tabel_905_historis_klaim_cp ".
									"where to_char(tglpengajuan,'YYYY')='".date('Y')."' ".
									"and substr(kdbenefit,-3)='BDH' ".
									"and NVL(status,0)=3) as nilaisudahklaim ".
							"from ".
								"$DBUser.tabel_223_transaksi_produk a, ".
								"$DBUser.tabel_207_kode_benefit b ".
							"where ".
								"a.kdbenefit=b.kdbenefit ".
								"and a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
								"and substr(a.kdbenefit,1,2)='CP' ".
								"and nvl(a.status,0)=0";
*/
    			    //echo $sql;
    				$DB->parse($sql);
    				$DB->execute();
    				$i=1;
					$j=0;
    				while ($arr=$DB->nextrow()) {
    				 	$sudahklaim = $arr["NILAISUDAHKLAIM"];
						$kdbnft   	= $arr["KDBENEFIT"];
    				 	$nilai 	 	= $arr["NILAIBENEFIT"];
  					 	echo "<input type=\"hidden\" name=\"kdbnft\" value=\"$kdbnft\">";
						include "../../includes/belang.php";
						print( "<td align=\"left\">".$arr["NAMABENEFIT"]."</td>\n" );
						print( "<td align=\"right\">".number_format((round($nilai,2)),2,",",".")."</td>\n" );
						if(substr($kdbnft,-3)=="BDH"){
						print( "<td align=\"right\"><input type=hidden name=jmlhari[]>".($sudahklaim==""? "" : "".number_format($sudahklaim,2,",",".")." (claimed)")."</td>\n" );
						print( "<td align=\"center\"><input type=text name=nilaiklaim$j size=10 class=\"akund\" value=".round($nilai-$sudahklaim,2)."></td>\n" );
						} else {
						print( "<td align=\"right\">x <input type=text name=jmlhari$j value=1 size=5 onblur=countvalue();></td>\n" );
						print( "<td align=\"center\"><input type=text name=nilaiklaim$j size=10 class=\"akund\" value=".round($nilai,2)."></td>\n" );
						}
						print( "<td class=\"verdana9barak\" align=\"center\">".
									"<input type=\"checkbox\" name=\"kc$j\" value=".$kdbnft.">".
									"<input type=hidden name=\"jmlbaris[]\" value=1>".
									"<input type=hidden name=\"actualbenefit$j\" value=".$nilai.">".
									"<input type=hidden name=\"kdbenefit[]\" value=".$kdbnft.">".
							  "</td>\n" );
						print( "</tr>" );
					$i++;
					$j++;
    				}		 
    				?>
					</table>
			 </td>
  		</tr>
			
  		<tr bgcolor="#a0d268">
    		<td>Cek Dokumen</td>
			</tr>
			
  		<tr>
    		<td>
    		<?
    		if ($cekbnf=="ON"){
    		
    		} 
			else 
			{
    			$sql = "select ".
							"a.kddokumen,a.userupdated,a.status,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated, b.namadokumen ".
    					"from ".
							"$DBUser.tabel_904_cek_dok_klaim a, ".
							"$DBUser.tabel_903_dokumen_klaim b ".
    					"where ".
							"a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
							"and a.kddokumen=b.kddokumen ".
    						"and a.kdklaim='$kdklaim' ".
							"and to_char(a.tglpengajuan,'DD/MM/YYYY')='$tglpengajuan' ".
    					"order by b.kddokumen ";
    				//echo $sql;			 
    				$DB->parse($sql);
    				$DB->execute();
    				$kam=$DB->result();
    				$coun=count($kam);
    		?>
    		<table bgcolor="#d5f0ec" width="100%" cellpadding="1" cellspacing="1" border="0">
    		  <tr bgcolor="#c0c0c0">
    					 <td align="center" height="20">No</td>
    					 <td align="center">Nama Dokumen</td>
    					 <td align="center">Status</td>
    					 <td align="center">Tanggal</td>
    					 <td align="center">User</td>
    			</tr>
    					
    				<?
    
    				$i=1;
    				foreach ($kam as $foo => $arr) {
    				 include "../../includes/belang.php";
      			 print( "<td align=\"center\">$i</td>\n" );
      			 print( "<td align=\"left\">".$arr["NAMADOKUMEN"]."</td>\n" );
      			 
    				 switch ($arr["STATUS"]) { 
    				  case '0' :
    					 $option = "<option value=\"1\" class=sudah>SUDAH DITERIMA</option>". 
    					           "<option selected value=\"0\" class=belum>BELUM DITERIMA</option>".
    										 "<option value=\"2\">TIDAK DIPERLUKAN</option>"; 
    					 break;
    					case '1' :
    					 $option = "<option selected value=\"1\" class=sudah>SUDAH DITERIMA</option>". 
    					           "<option value=\"0\">BELUM DITERIMA</option>".
    										 "<option value=\"2\">TIDAK DIPERLUKAN</option>"; 
    					 break;
    					case '2' :
    					 $option = "<option value=\"1\">SUDAH DITERIMA</option>". 
    					           "<option value=\"0\">BELUM DITERIMA</option>".
    										 "<option selected value=\"2\">TIDAK DIPERLUKAN</option>"; 
    					 break;
    				 }	
    				 print( "<td class=\"arial10ungub\" align=\"center\">".
    				 "<select name=\"".$arr["KDDOKUMEN"]."\" onfocus=\"highlight(event)\" class=\"buton\"> ".
    				  $option.
    				 "</select>".
    				 "</td>\n" );
      			 print( "<td align=\"center\">".$arr["TGLUPDATED"]."</td>\n" );
      			 print( "<td align=\"left\">".$arr["USERUPDATED"]."</td>" );
    				 print( "</tr>" );
    				 //print( "<input type=\"hidden\" name=\"".$arr["KDDOKUMEN"]."\">" );
    
    				 $i++;
    				}		 
    				?>	
    		  </table>
    		<? } ?>
    	 </td>
  		</tr>
			
  		<tr bgcolor="#f3e8c2">
  				<td><font size=3 color=red>K</font>&nbsp;&nbsp;&nbsp;&nbsp;berarti sudah pernah diklaim sebelumnya (Termasuk Tahapan / Anuitas / Beasiswa). Tgl Jatuh Tempo adalah Jatuh Tempo untuk pertama Kalinya. Jatuh tempo yang diklaim ditunjukkan oleh Tanggal Pengajuan diatas</td>
  		</tr>			
				
  		<tr bgcolor="#f5e4d6">
      	 <td align="left">Pilihlah Benefit Sesuai Ketentuan Polis dengan Memberikan CEK pada checkbox di kolom Pilih. Kesalahan Entry Menjadi Tanggung Jawab Saudara/i</td>
  		</tr>
			
			<tr>
  		   <td align="right">
  				 <input type="hidden" name="sebabmeninggal" value="<?=$sebabmeninggal;?>">
  				 <input type="hidden" name="tglmeninggal" value="<?=$tglkejadian;?>">
  				 <input type="hidden" name="kdproduk" value="<?=$kdproduk;?>">
  				 <input type="hidden" name="cekbnf" value="<?=$cekbnf;?>">
  				 <input type="hidden" name="namadokter" value="<?=$namadokter;?>">
  				 <input type="hidden" name="alamatdokter" value="<?=$alamatdokter;?>">
  				 <input type="hidden" name="pemohon" value="<?=$pemohon;?>">
  				 <input type="submit" name="submit" value="Submit">
			   </td>
  		</tr>
  </table>
   <?	include "../../footer.php"; ?>
  </form>
  </div>
  </body>
  </html>
<?}?>