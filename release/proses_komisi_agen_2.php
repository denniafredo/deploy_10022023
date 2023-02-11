<?php
include "../../includes/session.php";
include "../../includes/database.php";
  $DB=new Database($userid,$passwd,$DBName);
  $DB1=new Database($userid,$passwd,$DBName);
  $DB2=new Database($userid,$passwd,$DBName);
?>



<?php
$user = $_SESSION['userid'];
$proses = $_GET['proses_komisi'];
if($proses == 1){
    if($jenis_komisi == 'penutupan'){
        $sql = "begin $DBUser.BILLING_BARU.komisi_penutupan_all_tmp ('$tglperiode', '$user');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
       
    } else if($jenis_komisi == 'berkala'){
        $sql = "begin $DBUser.BILLING_BARU.komisi_topup_berkala_all_tmp ('$tglperiode', '$user');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'sekaligus'){
        // $sql = "begin $DBUser.BILLING_BARU.komisi_topup_sekaligus_all ('$tglperiode', '$user');end;";
        
        // $DB->parse($sql);
        // if($DB->execute()) {
        //      echo "<script>alert('Berhasil')</script>";
        // } else {
        //      echo "<script>alert('Gagal')</script>";
        // }

        $sql2 = "begin $DBUser.BILLING_BARU.komisi_topup_sekaligus_all_tmp ('$tglperiode', '$user');end;";
        //echo $sql2;
        $DB->parse($sql2);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'overriding'){
        $sql = "begin $DBUser.REMUNERASI.komisi_or_direct_all_2019_tmp ('$tglperiode');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'faststart'){
        // $sql2 = "DELETE FROM $DBUser.tabel_404_komisi_agen WHERE kdkomisiagen = 'D4' and tglproses = to_date('$tglperiode','ddmmyyyy')";
        // $DB2->parse($sql2);
        // $DB2->execute();
        
        $sql = "begin $DBUser.REMUNERASI.bonus_faststart_tmp ('$tglperiode','$tglbilling');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'persistensi'){
        // $sql2 = "DELETE FROM $DBUser.tabel_404_komisi_agen WHERE kdkomisiagen = 'E2' and tglproses = to_date('$tglperiode','ddmmyyyy')";
        // $DB2->parse($sql2);
        // $DB2->execute();

        $sql = "begin $DBUser.REMUNERASI.bonus_persistensi_tmp ('$tglperiode','$tglperiode');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'recruit'){
        // $sql2 = "DELETE FROM $DBUser.tabel_404_komisi_agen WHERE kdkomisiagen = 'D5' and tglproses = to_date('$tglperiode','ddmmyyyy')";
        // $DB2->parse($sql2);
        // $DB2->execute();
        
        $sql = "begin $DBUser.REMUNERASI.bonus_recruit_tmp ('$tglperiode','$tglbilling');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'recruit_lpp'){
        $sql = "begin $DBUser.REMUNERASI.bonus_recruit_lpp_tmp ('$tglperiode','$tglbilling');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } //lpp
    else if($jenis_komisi == 'monthly_bonus_lpp'){
        echo "<script>document.getElementById('proseskomisi').disabled = true;</script>";
        $sql = "begin $DBUser.REMUNERASI.monthly_production_bonus_lpp ('$tglperiode','$tglbilling');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
            // echo $DB->errormessage;
             echo "<script>alert('Gagal')</script>";
        }
    } //lpp
    else if($jenis_komisi == 'bonus_persistensi_lpp'){
        $sql = "begin $DBUser.REMUNERASI.bonus_persistensi_lpp_tmp ('$tglperiode','$tglbilling');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } //lpp
    else if($jenis_komisi == 'extrabonus'){
       // $sql2 = "DELETE FROM $DBUser.tabel_404_komisi_agen WHERE kdkomisiagen = 'D6' and tglproses = to_date('$tglperiode','ddmmyyyy')";
        // $DB2->parse($sql2);
        // $DB2->execute();
        
        $sql = "begin $DBUser.REMUNERASI.bonus_extrabonus_tmp ('$tglperiode','$tglbilling');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'producer_reward'){
        // $sql2 = "DELETE FROM $DBUser.tabel_404_komisi_agen WHERE kdkomisiagen = 'D7' and tglproses = to_date('$tglperiode','ddmmyyyy')";
        // $DB2->parse($sql2);
        // $DB2->execute();
        
        $sql = "begin $DBUser.REMUNERASI.bonus_producer_reward_tmp ('$tglperiode','$tglbilling');end;";
        // echo $sql;die;
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'pruducer'){
        // $sql2 = "DELETE FROM $DBUser.tabel_404_komisi_agen WHERE kdkomisiagen = 'D9' and tglproses = to_date('$tglperiode','ddmmyyyy')";
        // $DB2->parse($sql2);
        // $DB2->execute();
        
        $sql = "begin $DBUser.REMUNERASI.bonus_producer_tmp ('$tglperiode','$tglbilling');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'developer_reward'){
        // $sql2 = "DELETE FROM $DBUser.TABEL_404_PENDAPATAN_LAIN_AGEN WHERE kdkomisiagen = 'D8' and tglproses = to_date('$tglperiode','ddmmyyyy')";
        // $DB2->parse($sql2);
        // $DB2->execute();
        
        $sql = "begin $DBUser.REMUNERASI.business_developer_reward_tmp ('$tglperiode','$tglbilling');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'loyalty'){
        // $sql2 = "DELETE FROM $DBUser.tabel_404_komisi_agen WHERE kdkomisiagen = 'E3' and tglproses = to_date('$tglperiode','ddmmyyyy')";
        // $DB2->parse($sql2);
        // $DB2->execute();
        
        $sql = "begin $DBUser.REMUNERASI.bonus_loyalty_tmp ('$tglperiode','$tglbilling');end;";
        //echo $sql;die;
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'insentif_bulanan'){
       
        $sql = "begin $DBUser.REMUNERASI_LPA.insentif_bulanan_tmp ('$tglperiode');end;";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'basicallowance'){
        //produksi
        $sql = "begin $DBUser.REMUNERASI_LPA.basic_allowance_tmp ('$tglperiode');end;";

        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }

        //lisensi
        // $sql3 = "begin $DBUser.REMUNERASI_LPA.lisensi_tmp('$tglperiode');end;";

        // $DB1->parse($sql3);
        // $DB1->execute();
    } else if($jenis_komisi == 'insentif_tahun'){

        $sql = "begin $DBUser.REMUNERASI_LPA.insentif_tahunan_tmp ('$tglperiode');end;";
        // echo $sql;
        // die;
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } 
    else if($jenis_komisi == 'ultimate'){
        $sql = "UPDATE $DBUser.TABEL_404_KOMISI_AGEN N SET N.KDREKENINGKOMISIAGEN = '512011120'
        WHERE TO_CHAR(N.TGLUPDATED,'DDMMYYYY') = '$tglapprov_komisi'
            AND N.KDAUTHORISASI = '2'
            AND (SELECT KDPRODUK FROM TABEL_200_PERTANGGUNGAN M WHERE M.PREFIXPERTANGGUNGAN = N.PREFIXPERTANGGUNGAN
                    AND M.NOPERTANGGUNGAN = N.NOPERTANGGUNGAN 
                    ) IN ('JL4X','JL4XN')
            AND KDKOMISIAGEN NOT IN ('D1','D2','D3','D4','D5','D6','D7','D8','D9','E3','E2')";
      
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if($jenis_komisi == 'life_prime'){
        $sql = "UPDATE $DBUser.TABEL_404_KOMISI_AGEN N SET N.KDREKENINGKOMISIAGEN = '512011110'
        WHERE TO_CHAR(N.TGLUPDATED,'DDMMYYYY') = '$tglapprov_komisi'
            AND N.KDAUTHORISASI = '2'
            AND (SELECT KDPRODUK FROM TABEL_200_PERTANGGUNGAN M WHERE M.PREFIXPERTANGGUNGAN = N.PREFIXPERTANGGUNGAN
                    AND M.NOPERTANGGUNGAN = N.NOPERTANGGUNGAN 
                    ) IN ('JL4B','JL4BF','JL4BL', 'JL4BLN')
           AND KDKOMISIAGEN NOT IN ('D1','D2','D3','D4','D5','D6','D7','D8','D9','E3','E2')";
      
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if ($jenis_komisi == 'link_assurace') {
        $sql = "UPDATE $DBUser.TABEL_404_KOMISI_AGEN N SET N.KDREKENINGKOMISIAGEN = '512011130'
        WHERE TO_CHAR(N.TGLUPDATED,'DDMMYYYY') = '$tglapprov_komisi'
            AND N.KDAUTHORISASI = '2'
            AND (SELECT KDPRODUK FROM TABEL_200_PERTANGGUNGAN M WHERE M.PREFIXPERTANGGUNGAN = N.PREFIXPERTANGGUNGAN
                    AND M.NOPERTANGGUNGAN = N.NOPERTANGGUNGAN 
                    ) NOT IN ('JL4B','JL4BF','JL4BL', 'JL4BLN','JL4X','JL4XN')
           AND KDKOMISIAGEN NOT IN ('D1','D2','D3','D4','D5','D6','D7','D8','D9','E3','E2')";
        
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    } else if ($jenis_komisi == 'gmi') {
        $sql = "UPDATE $DBUser.TABEL_404_KOMISI_AGEN B SET B.KDREKENINGKOMISIAGEN = (SELECT A.KODEAKUN FROM TABEL_402_KODE_KOMISI_AGEN A WHERE A.KDKOMISIAGEN = B.KDKOMISIAGEN)
        WHERE
            TO_CHAR(B.TGLUPDATED,'DDMMYYYY') = '$tglapprov_komisi'
            AND B.KDAUTHORISASI = 2
            AND KDKOMISIAGEN IN ('D1','D2','D3','D4','D5','D6','D7','D8','D9','E3')";
        // echo $sql;die;
        $DB->parse($sql);
        if($DB->execute()) {
             echo "<script>alert('Berhasil')</script>";
        } else {
             echo "<script>alert('Gagal')</script>";
        }
    }
} else if($proses == 2) {
    // if($pajakppn == null || $pajakppn == ''){
    //     $sql = "UPDATE $DBUser.TABEL_405_PAJAK_KOMISI_AGEN_N a
    //     SET PAJAK_PPH = '$pajakpph', 
    //     pajak = (select (pajak_ppn + '$pajakpph') as pendapatan from TABEL_405_PAJAK_KOMISI_AGEN_N where noagen = a.noagen and kdkantor = a.kdkantor and tanggal = a.tanggal), 
    //     nett = (select (nett - '$pajakpph') as pendapatan from TABEL_405_PAJAK_KOMISI_AGEN_N where noagen = a.noagen and kdkantor = a.kdkantor and tanggal = a.tanggal)
    //     WHERE noagen = '$noagen' and kdkantor = '$kantor_pajak' and TANGGAL = to_date('$tglapprov','ddmmyyyy')";
    //     //echo $sql;
    //     $DB->parse($sql);
    //     if($DB->execute()) {
        //      echo "<script>alert('Berhasil')</script>";
        // } else {
        //      echo "<script>alert('Gagal')</script>";
        // }
       
    // } else {
    //         $pajak = $pajakpph + $pajakppn;
    //         $sql = "UPDATE $DBUser.TABEL_405_PAJAK_KOMISI_AGEN_N a
    //         SET PAJAK_PPH = '$pajakpph', 
    //         PAJAK_PPN = '$pajakppn', 
    //         pajak = '$pajak', 
    //         nett = (select (pendapatan - '$pajak') as pendapatan from TABEL_405_PAJAK_KOMISI_AGEN_N where noagen = a.noagen and kdkantor = a.kdkantor and tanggal = a.tanggal)
    //         WHERE noagen = '$noagen' and kdkantor = '$kantor_pajak' and TANGGAL = to_date('$tglapprov','ddmmyyyy')";
        
    //         $DB->parse($sql);
    // //         if($DB->execute()) {
    //          echo "<script>alert('Berhasil')</script>";
    //     } else {
    //          echo "<script>alert('Gagal')</script>";
    //     }    
    // }
    $query = "select count(noagen) jml from $DBUser.TBL_405_PAJAK_KOMISI_AGN_N_TMP
              WHERE noagen = '$noagen' 
              and kdkantor = '$kantor_pajak' 
              and TANGGAL = to_date('$tglapprov','ddmmyyyy')
              AND status_approval is null or status_approval = ''";
        $DB2->parse($query);
        $DB2->execute();
        $row = $DB2->nextrow();
    if($row['JML'] > 0) {
        echo "<script>alert('GAGAL!!, Data Sudah Pernah Diajukan, Silahkan Tunggu Untuk Di Approve ')</script>";
    }else {   
        if($pajakppn == null || $pajakppn == ''){
            $sql = "INSERT INTO $DBUser.TBL_405_PAJAK_KOMISI_AGN_N_TMP (NOAGEN, TANGGAL, KDKANTOR, PAJAK_PPH , PAJAK_PPN) VALUES ('$noagen',to_date('$tglapprov','ddmmyyyy'),'$kantor_pajak','$pajakpph', (select PAJAK_PPN FROM $DBUser.TABEL_405_PAJAK_KOMISI_AGEN_N WHERE NOAGEN = '$noagen' and kdkantor = '$kantor_pajak' and TANGGAL = to_date('$tglapprov','ddmmyyyy') ))";
            
                $DB->parse($sql);
                if($DB->execute()) {
                 echo "<script>alert('Berhasil')</script>";
            } else {
                 echo "<script>alert('Gagal')</script>";
            }    
        } else {
            $sql = "INSERT INTO $DBUser.TBL_405_PAJAK_KOMISI_AGN_N_TMP (NOAGEN, TANGGAL, KDKANTOR, PAJAK_PPH, PAJAK_PPN) VALUES ('$noagen',to_date('$tglapprov','ddmmyyyy'),'$kantor_pajak','$pajakpph','$pajakppn')";
        // echo $sql;die;
                $DB->parse($sql);
                if($DB->execute()) {
                 echo "<script>alert('Berhasil')</script>";
            } else {
                 echo "<script>alert('Gagal')</script>";
            }   
        } 
    }
}

?>


  <html>
<title>Tools Remunerasi</title>
<head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/window.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/date.js"></script>
</head>
<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
<script LANGUAGE="JavaScript">
function submitForms() {
if ( (isProposal()))
if (confirm)
{ 
return true;
}
else
{
return false;      
}
else
return false;
}
</script>

<body topmargin="0" bgcolor="#b9e1f7">
<font face="Verdana" size="2"><b>Proses Komisi Susulan</font>
<hr size=1>
<table width="50%" cellspacing="2"  border="0" cellpadding="0">
<form name="cekkomisi" action="proses_komisi_agen_2.php?proses_komisi=1" method="post">
<tr >
  <td>Prefixpertanggungan - Nopertanggungan  </td>
  <td>
  <input id="prefix" name="prefix" class="c" type="text" value="<?=$prefix; ?>" size="2" maxlength="2" onFocus="highlight(event)" disabled  onChange="javascript:this.value=this.value.toUpperCase();"> - 
  <input id="noper" name="noper" class="c" type="text" value="<?=$noper; ?>" size="9" maxlength="9" onFocus="highlight(event)" disabled onBlur="javascript:validasi(this.form.nopertanggungan);">&nbsp; 
  </td>
</tr>
<tr>
  <td>Nomor Polis Baru</td>
  <td>
  <input id="nopolbaru" name="nopolbaru" class="c" type="text" value="<?=$nopolbaru; ?>"onFocus="highlight(event)" disabled onChange="javascript:this.value=this.value.toUpperCase();">
  </td>
</tr>
<tr>
  <td>Tanggal Billing</td>
  <td>
  <input id="tglbilling" name="tglbilling" class="c" type="text" value="<?=$tglbilling; ?>"onFocus="highlight(event)" disabled  onChange="javascript:this.value=this.value.toUpperCase();"><span> Format : DDMMYYYY</span>
  </td>
</tr>
<tr>
  <td>Tanggal Periode/Proses</td>
  <td>
  <input id="tglperiode" name="tglperiode" class="c" type="text" value="<?=$tglperiode; ?>"onFocus="highlight(event)" disabled  onChange="javascript:this.value=this.value.toUpperCase();"><span> Format : DDMMYYYY</span>
  </td>
</tr>
<tr>
  <td>Tanggal Approval</td>
  <td>
  <input id="tglapprov_komisi" name="tglapprov_komisi" class="c" type="text" value="<?=$tglapprov_komisi; ?>"onFocus="highlight(event)" disabled  onChange="javascript:this.value=this.value.toUpperCase();"><span> Format : DDMMYYYY</span>
  </td>
</tr>
<tr>
    <td></td>
    <td>
        <select name="jenis_komisi" id="jenis_komisi" onchange="jeniskomisi(this)" required>
            <option value="" selected disabled>Pilih Jenis Komisi</option>
            <option value="penutupan">Penutupan</option>
            <option value="berkala">Top Up Berkala</option>
            <option value="sekaligus">Top Up Sekaligus</option>
            <option value="overriding">Overriding</option>
            <option value="faststart">Fast Start</option>
            <option value="persistensi">Persistensi</option>
            <option value="recruit">Recruit</option>
            <option value="recruit_lpp">Recruit LPP</option> <!-- LPP -->
            <option value="monthly_bonus_lpp">Monthly Bonus LPP</option> <!-- LPP -->
            <option value="bonus_persistensi_lpp">Bonus Persistensi LPP</option> <!-- LPP -->
            <option value="extrabonus">Extra Bonus</option>
            <option value="producer_reward">Producer Reward</option>
            <option value="pruducer">Producer</option>
            <option value="developer_reward">Developer Reward</option>
            <option value="loyalty">Loyalty</option>
            <option value="insentif_bulanan">Insentif Bulanan</option>
            <option value="insentif_tahun">Insentif Tahunan</option>
            <option value="basicallowance">Bassic Allowance</option>
            <option value="ultimate">Penyesuaian Rekening Ultimate</option>
            <option value="life_prime">Penyesuaian Rekening Life Prime</option>
            <option value="gmi">Penyesuaian Rekening GMI</option> 
            <option value="link_assurace">Penyesuaian Rekening Link Assurance</option>
        </select>
    </td>
</tr>
<tr>
    <td></td>
    <td><button type="submit">Proses</button></td>
</tr>
</form>
</table>
<hr size=1>
<font face="Verdana" size="2"><b>Penyesuaian Pajak</font>
<table width="50%" cellspacing="2" border="0" cellpadding="0">
<form name="cekkomisi" action="proses_komisi_agen_2.php?proses_komisi=2" method="post">
<tr>
  <td>Noagen</td>
  <td>
  <input id="noagen" name="noagen" class="c" type="text" value="<?=$noagen; ?>" onFocus="highlight(event)" onChange="javascript:this.value=this.value.toUpperCase();" required>
  </td>
</tr>
<tr>
  <td>Kantor</td>
  <td>
  <?php
        $kntrsql = "Select kdkantor, namakantor from $DBUser.tabel_001_kantor where status = '1' and kdkantor <> 'KN' 
                    --and kdkantor in ('11','02','12','04','05','09','03','18','01','15','21')
                    and kdkantor != 'KP'
                    order by kdkantor asc";
                    $DB->parse($kntrsql);
                    $DB->execute();		
        print("<select name='kantor_pajak' required>");
        print("<option value ='' selected disabled   >Semua </option>");
        while ($row = $DB->nextrow()) { 
            $dipilih = "";
                if($kantor_pajak == $row['KDKANTOR']){$dipilih = "selected";}
    ?>		
            
            <option value="<?=$row['KDKANTOR']?>" <?=$dipilih;?>> <?php echo $row['KDKANTOR']."-".$row['NAMAKANTOR'];?> </option>; 
    <?	
        }
        print("</select>"); 
    ?>
  </td>
</tr>
<tr>
  <td>Tanggal Aproval</td>
  <td>
  <input id="tglapprov" name="tglapprov" class="c" type="text" value="<?=$tglapprov; ?>" onFocus="highlight(event)" onChange="javascript:this.value=this.value.toUpperCase();" required><span> Format : DDMMYYYY</span>
  </td>
</tr>
<tr>
  <td>Nominal Pajak PPN</td>
  <td>
  <input id="pajakppn" name="pajakppn" class="c" type="number" value="<?=$pajakppn; ?>" onFocus="highlight(event)" onChange="javascript:this.value=this.value.toUpperCase();">
  </td>
</tr>
<tr>
  <td>Nominal Pajak PPH</td>
  <td>
  <input id="pajakpph" name="pajakpph" class="c" type="number" value="<?=$pajakpph; ?>" onFocus="highlight(event)" onChange="javascript:this.value=this.value.toUpperCase();">
  </td>
</tr>
<tr>
    <td></td>
    <td><button type="submit">Proses</button></td>
</tr>
</table>
<hr size=1>
</body>
</html>
<script>
  function jeniskomisi(select){
    if(select.value === 'penutupan'){
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = true;
    } else if (select.value === 'berkala'){
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = true;
    } else if(select.value === 'sekaligus') {
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false; 
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = true;
    } else if(select.value === 'overriding') {
        document.getElementById('prefix').disabled = true;
        document.getElementById('noper').disabled = true;
        document.getElementById('nopolbaru').disabled = true;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = true; 
    } else if(select.value === 'faststart') {
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false;
        document.getElementById('tglapprov_komisi').disabled = true;
    } else if(select.value === 'persistensi') {
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false;
        document.getElementById('tglapprov_komisi').disabled = true;
    } else if(select.value === 'recruit') {
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false;
        document.getElementById('tglapprov_komisi').disabled = true;
    } else if(select.value === 'recruit_lpp') {
        // isi tgl biling tgl 14 bulan berikutnya
        // tgl periode tgl masuk di proses komisinya
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false;
        document.getElementById('tglapprov_komisi').disabled = true;
    } // lpp 
    else if(select.value === 'monthly_bonus_lpp') {
        // isi tgl biling tgl 14 bulan berikutnya
        // tgl periode tgl masuk di proses komisinya
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false;
        document.getElementById('tglapprov_komisi').disabled = true;
    } // lpp
    else if(select.value === 'bonus_persistensi_lpp') {
        // isi tgl biling tgl 14 bulan berikutnya
        // tgl periode tgl masuk di proses komisinya
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false;
        document.getElementById('tglapprov_komisi').disabled = true;
    } // lpp
    else if(select.value === 'extrabonus') {
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false;
        document.getElementById('tglapprov_komisi').disabled = true;
    } else if(select.value === 'producer_reward') {
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false;
        document.getElementById('tglapprov_komisi').disabled = true;
    } else if(select.value === 'pruducer') {
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false;
        document.getElementById('tglapprov_komisi').disabled = true;
    } else if(select.value === 'developer_reward') {
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false;
        document.getElementById('tglapprov_komisi').disabled = true;
    } else if(select.value === 'loyalty') {
        document.getElementById('prefix').disabled = false;
        document.getElementById('noper').disabled = false;
        document.getElementById('nopolbaru').disabled = false;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = false; 
        document.getElementById('tglapprov_komisi').disabled = true;
    }
    else if(select.value === 'insentif_bulanan') {
        document.getElementById('prefix').disabled = true;
        document.getElementById('noper').disabled = true;
        document.getElementById('nopolbaru').disabled = true;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = true;
    }
    else if(select.value === 'insentif_tahun') {
        document.getElementById('prefix').disabled = true;
        document.getElementById('noper').disabled = true;
        document.getElementById('nopolbaru').disabled = true;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = true;
    }
    else if(select.value === 'basicallowance') {
        document.getElementById('prefix').disabled = true;
        document.getElementById('noper').disabled = true;
        document.getElementById('nopolbaru').disabled = true;
        document.getElementById('tglperiode').disabled = false;
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = true;
    }
    else if(select.value === 'ultimate') {
        document.getElementById('prefix').disabled = true;
        document.getElementById('noper').disabled = true;
        document.getElementById('nopolbaru').disabled = true;
        document.getElementById('tglperiode').disabled = true;
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = false;
    } else if(select.value === 'life_prime') {
        document.getElementById('prefix').disabled = true;
        document.getElementById('noper').disabled = true;
        document.getElementById('nopolbaru').disabled = true;
        document.getElementById('tglperiode').disabled = true;
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = false;
    } else if(select.value === 'gmi') {
        document.getElementById('prefix').disabled = true;
        document.getElementById('noper').disabled = true;
        document.getElementById('nopolbaru').disabled = true;
        document.getElementById('tglperiode').disabled = true;
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = false;
    } else if(select.value === 'link_assurace') {
        document.getElementById('prefix').disabled = true;
        document.getElementById('noper').disabled = true;
        document.getElementById('nopolbaru').disabled = true;
        document.getElementById('tglperiode').disabled = true;
        document.getElementById('tglbilling').disabled = true;
        document.getElementById('tglapprov_komisi').disabled = false;
    }
  }
</script>
