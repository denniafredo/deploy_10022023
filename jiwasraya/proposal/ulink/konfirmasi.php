<?
 include "./includes/database.php";
 include "./includes/session.php";
 include "./includes/klien.php";
 include "./includes/pertanggungan.php";
 include "./includes/kantor.php";
 $DB=New database($userid, $passwd, $DBName);	
 
 //$prefixpertanggungan="AC";
 //$nopertanggungan="001226250";
 $PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
 $KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
 $KTR=New Kantor($userid,$passwd,$kantor);
 
 $sql = "select nosp, to_char(tglsp,'dd/mm/yyyy') tglsp,NOPEMEGANGPOLIS,
                          NOAGEN,premi,
                          TALTUP from $DBUser.UL_SPAJ_TEMP ".
		          "where NOSP='$sp'";
		//echo $sql;
 $DB->parse($sql);
 $DB->execute();
 $arq=$DB->nextrow();

 //echo $gross;
?>
<title>Lampiran Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<!--<body onLoad="window.print();window.close()">-->
<body onLoad="alert('Untuk menghilangkan header dan footer, Klik File>Page Setup, Kosongkan kolom header dan footer!, \n\n MOHON AGAR NILAI PADA KLAUSUL DI PERIKSA KEMBALI KEBENARANNYA!');">
<body>
<?
echo "  <table border=\"0\" width=\"600\" cellspacing=\"1\" cellpadding=\"2\">";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">No. SPAJ</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"20\" name=\"spaj\" VALUE=".$arq['NOSP']."></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Mulai Asuransi</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"10\" id=\"datepicker\" name=\"tglspaj\" VALUE=".$arq['TGLSP']."></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "      <td class=\"verdana9blk\">Premi</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"20\" name=\"premi\" VALUE=".$arq['PREMI']."></td>";
                echo "    </tr>";
				echo "    <tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">No. Pemegang Polis</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"10\" name=\"notertanggung\" VALUE=".$arq['NOPEMEGANGPOLIS'].">";
                echo "</td></tr>";
                echo "    <tr>";
                echo "      <td class=\"verdana9blk\">No. Agen</td>";
                echo "      <td class=\"verdana9blk\">: <input type=\"text\" size=\"10\" name=\"noagen\" VALUE=".$arq['NOAGEN'].">";
                echo "</td></tr>";                
                echo "    <tr>";
				if ($arq['TALTUP']=='1') {$cek1='checked'; $cek2='';} else {$cek2='checked'; $cek1='';}
                echo "      <td class=\"verdana9blk\">Taltup ?</td>";
                echo "      <td class=\"verdana9blk\">:  <input type=\"radio\" ".$cek1." name=\"taltup\" id=\"taltup\" value=\"1\"/>Ya".
					 "<input type=\"radio\" ".$cek2." name=\"taltup\" id=\"taltup\" value=\"0\"/>Tidak</td>";
                echo "    </tr>";
                
                echo "  </table>";
?>				
<br/><br/><br/>
<font face="Arial" size="1">
	Catatan : <br/>
    Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.
</font>

</body>
</html>
