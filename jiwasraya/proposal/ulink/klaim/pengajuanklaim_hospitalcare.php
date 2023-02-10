<?
include "../../includes/common.php";
include "../../includes/session.php";
include "../../includes/database.php";
include "../../includes/klien.php";
include "../../includes/pertanggungan.php";
include "../../includes/kantor.php";
include "../../includes/tgl.php";
include "../../includes/constant.php";

$DB  = new database($userid, $passwd, $DBName);
$PWK = New Kantor($userid,$passwd,$kantor);
$KT  = New Kantor($userid,$passwd,$PWK->kdkantorinduk);
$prefix=strtoupper($prefix);
$KP  = New KantorPusat($userid,$passwd);

$sql = "select kelompok,namaklaim from $DBUser.tabel_902_kode_klaim where kdklaim='$jnsklaim'";
$DB->parse($sql);
$DB->execute();
$arr=$DB->nextrow();
$klp=$arr["KELOMPOK"];
$namaklaim=	$arr["NAMAKLAIM"];

if ($submit) { //var_dump($_POST);
    $booked=(!$tglbooked) ? 'NULL' : "to_date('$tglbooked','DD/MM/YYYY')";
    $namadokter=substr($namadokter,0,30);
    $alamatdokter=substr($alamatdokter,0,40);
    $PER=New Pertanggungan($userid,$passwd,$prefix,$noper);
    $kdproduk=$PER->produk;
    $kdrayonpenagih=$PER->kdrayonpenagih;
    $tb=(int)(substr($tglbooked,6,4).substr($tglbooked,3,2).substr($tglbooked,0,2));
    $ts=(int)(substr($PER->sysdate,6,4).substr($PER->sysdate,3,2).substr($PER->sysdate,0,2));


    // mencari no ijin gadai
    $sql = "select max(nourut) as maxurut from $DBUser.tabel_901_pengajuan_klaim";
    $DB->parse($sql);
    $DB->execute();
    $arr=$DB->nextrow();
    $maxurut = $arr["MAXURUT"];

    if (strlen($maxurut)==0) {
        $nourut = "1";
    } else {
        $nourut = $maxurut + 1;
    }
    $noizinbaru = str_pad($nourut,3,"0",STR_PAD_LEFT);
    $noizincp = $noizinbaru."/CASHPLAN/".$kantor.substr($tglpengajuan,2,8);
    //echo $noizincp;

    if($cekbnf=="ON")
    {
        // jika tidak punya benefit meninggal
        // ubah status pertanggungan menjadi KLAIM agan gak kena billing
        $sql =  "insert into $DBUser.tabel_901_pengajuan_klaim ".
            "(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,userfo,tglfo,".
            "userrekam,tglrekam,nilaibenefit,status,tglmeninggal,sebabmeninggal,namadokter,alamatdokter,tglbooked,pemohon, noizin,kdkantorproses) ".
            "values ('$prefix','$noper','$jnsklaim',to_date('$tglpengajuan','DD/MM/YYYY'),user,sysdate, ".
            "user,sysdate,NULL,'4',$meninggal,'$sebabmeninggal','$namadokter','$alamatdokter',$booked,'$pemohon','$noizincp','$kantor')";
    } else {
        $sql = "insert into $DBUser.tabel_901_pengajuan_klaim (prefixpertanggungan,nopertanggungan,kdklaim,
                    tglpengajuan,userrekam,tglrekam,nilaibenefit,status,namadokter,alamatdokter,tglbooked,
                    pemohon,noizin,nourut,kdkantorproses,noregistrasi,metodebayar,penerimasip,norekeningbank,
                    namabank,cabangbank) 
                values ('$prefix','$noper','$jnsklaim',to_date('$tglpengajuan','DD/MM/YYYY'), user,sysdate,
                    NULL,'0','$namadokter','$alamatdokter',$booked,'$pemohon','$noizincp','$maxurut',
                    '$kdrayonpenagih','$noregistrasi','$metodebayar','$penerimasip','$norekeningbank',
                    '$namabank','$cabangbank')";
        $note = "Proses Dilanjutkan Dengan Perhitungan Benefit";
    }
    //echo $sql;
    //die;
    $DB->parse($sql);
    if ($DB->execute())
    {
        // masukkan data klaim kecelakaan
        $sql = "insert into $DBUser.tabel_907_data_kecelakaan ".
            "(prefixpertanggungan,nopertanggungan,kd_klaim,".
            "tgl_pengajuan,tgl_kejadian,sebab_kejadian,".
            "nama_rs,alamat_rs,nama_dokter,".
            "tgl_mulai_rawat,tgl_akhir_rawat,".
            "nama_pemohon,alamat_pemohon,telp_pemohon,hubungan_pemohon,tgl_rekam,user_rekam) ".
            "values ('$prefix','$noper','$jnsklaim',".
            "to_date('$tglpengajuan','DD/MM/YYYY'),to_date('$tglpengajuan','DD/MM/YYYY'),'$sebabkejadian',".
            "'$namars','$alamatrs','$namadokter',".
            "to_date('$tglawal','DD/MM/YYYY'),to_date('$tglakhir','DD/MM/YYYY'),".
            "'$pemohon','$alamatpemohon','$telppemohon','$hubunganpemohon',sysdate,user)";
        $DB->parse($sql);
        $DB->execute();
        //echo $sql;
        print( "  <table width=\"100%\">\n" );
        print( "   <tr>\n" );
        print( "    <td width=\"20%\" align=\"left\"><a href=\"#\" onclick=\"window.location.replace('hitungklaim_hospitalcare.php?prefix=$prefix&noper=$noper&kdklaim=$jnsklaim&tglpengajuan=$tglpengajuan')\"><font face=Arial size=2>Lanjut</font></a></td>\n" );
        print( "		<td width=\"80%\" align=\"right\"><font face=Verdana size=2 color=#ff3366><b>Proses Dilanjutkan Dengan Perhitungan Benefit</font></td>\n" );
        print( "	 </tr>\n" );
        print( "	</table>	" );
    } else { //insert fail
        $sql = "select to_char(max(tglpengajuan),'DD/MM/YYYY') tglpengajuan from $DBUser.tabel_901_pengajuan_klaim ".
            "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$jnsklaim' ";
        //echo $sql;
        $DB->parse($sql);
        $DB->execute();
        if ($arr=$DB->nextrow()) {
            $tglklaim=$arr["TGLPENGAJUAN"];
            print( "  <table width=\"600\">\n" );
            print( "   <tr class=arial10>\n" );
            print( "    <td width=\"20%\" align=\"left\"><a href=\"#\" onclick=\"window.location.replace('".$PHP_SELF."')\">Back</a></td>\n" );
            print( "		<td width=\"80%\" align=\"right\"><b>Proses Tidak Dapat Dilanjutkan</font><br>Klaim $jnsklaim Terakhir diajukan tanggal $tglklaim</td>\n" );
            print( "	 </tr>\n" );
            print( "	</table>	" );
        }
    }

} else {

    $sql="select to_char(sysdate,'HH:MI:SS') detiknow,to_char(sysdate,'DD/MM/YYYY') now from dual";
    $DB->parse($sql);
    $DB->execute();
    $w=$DB->nextrow();
    $tanggal = $w["NOW"];
    ?>

    <html>
    <head>
        <title>Pengajuan Klaim Tanggal </title>

        <style type="text/css">
            <!--
            body {
                background-color: #FFFFFF;
                font-family: Verdana, Arial, Serif;
                font-size: 10px;
                color: #000000;
                margin-left: 0px;
                margin-top: 10px;
                margin-right: 0px;
                margin-bottom: 0px;
            }

            table {
                font-family: verdana;
                font-size: 12px;
            }

            .button {
                font-size: 11px;
                color: #FFFFFF;
                background-color: #99cccc;
                border: solid 0px;
            }

            .select {
                font-family: Verdana, Arial, Serif;
                font-size: 11px;
                color: #336699;
                background-color: #FFFFFF;
            }
            -->
        </style>

        <script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
        <script language="JavaScript" type="text/javascript" src="../../includes/date.js" ></script>
        <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
        <script language="JavaScript" type="text/javascript">
            <!--
            function OpenWin(prefix,noper,noreg) {
                //NewWindow('loadpengajuan_cashplan.php?prefix='+prefix+'&noper='+noper+'','',700,400,1)
                window.frame_aajaxan.location.href='loadpengajuan_hospitalcare.php?prefix='+prefix+'&noper='+noper+'&noreg='+noreg;
            }

            function GantiKlaim(theForm) {
                var prefix=theForm.prefix.value;
                var noper=theForm.noper.value;
                var kdklaim=theForm.jnsklaimx.value;
                prefix=prefix.toUpperCase();
                if (kdklaim=='RAWATINAP'){
                    window.location.replace('pengajuanklaim_cashplan.php?prefix='+prefix+'&noper='+noper+'&kdklaim='+kdklaim+'');
                } else if (kdklaim=='JSHC'){
                    window.location.replace('pengajuanklaim_hospitalcare.php?prefix='+prefix+'&noper='+noper+'&kdklaim='+kdklaim+'');
                } else{
//alert (kdklaim);
                    window.location.replace('pengajuanklaim_rider.php?prefix='+prefix+'&noper='+noper+'&kdklaim='+kdklaim+'');
                }
            }

            function CariRegistrasi () {
                prefix = document.propmtc.prefix.value;
                noper = document.propmtc.noper.value;
                noreg = document.propmtc.noregistrasi.value;

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
                } if (noreg == '' && loadOK) {
                    alert('Masukkan Nomor Registrasi (Askes)');
                    document.propmtc.noregistrasi.focus();
                    loadOK = false;
                }
                if (loadOK) {
                    OpenWin(prefix,noper,noreg);
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
            //-->
        </script>
    </head>
    <body>

    <div align="center">
        <form method="POST" name="propmtc" action="<? echo $PHP_SELF;?>"  onsubmit="return OnSumbit(document.propmtc)">
            <iframe name="frame_aajaxan" style="display:none;"></iframe>
            <table bgcolor="#e5e5e5" border="1" width="95%" align="center" cellpadding="2" style="border-collapse: collapse" bordercolor="#a4a4a4" id="AutoNumber1" cellspacing="0">
                <tr>
                    <td width="100%" height="25" bgcolor="#fac67e" align="center"><b>PENGAJUAN KLAIM RIDER RAWAT INAP JS HOSPITAL CARE</b></td>
                </tr>
                <tr>
                    <td width="100%">
                        <table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
                            <tr>
                                <td>Klaim Diajukan</td>
                                <td>:
                                    <select name="jnsklaimx" class="select" onFocus="highlight(event)" onChange="GantiKlaim(document.propmtc)">
                                        <?
                                        switch($kdklaim)
                                        {
                                            //case "MENINGGAL": $m="selected"; break;
                                            //	case "CACAT": $k="selected"; break;
                                            case "RAWATINAP": $r="selected"; break;
                                            case "RTI": $a="selected"; break;
                                            case "TPD": $b="selected"; break;
                                            case "CI53": $c="selected"; break;
                                            case "ADDB": $d="selected"; break;
                                            //case "HCCP": $e="selected"; break;
                                            case "SDB": $f="selected"; break;
                                            case "STPD": $g="selected"; break;
                                            case "PDB": $h="selected"; break;
                                            case "PTPD": $i="selected"; break;
                                            case "JSHC": $j="selected"; break;
                                        }

                                        //echo "<option value=CACAT $k>KLAIM CACAT TETAP</option>";
                                        //echo "<option value=MENINGGAL $m>KLAIM MENINGGAL DUNIA</option>";
                                        echo "<option value=RTI $a>RIDER TERM INSURANCE</option>";
                                        echo "<option value=TPD $b>RIDER TPD</option>";
                                        echo "<option value=CI53 $c>RIDER CI</option>";
                                        echo "<option value=ADDB $d>RIDER ADDB</option>";
                                        //echo "<option value=HCCP $e>HCCP</option>";
                                        echo "<option value=SDB $f>SPOUSE DEATH BENEFIT</option>";
                                        echo "<option value=STPD $g>SPOUSE TPD</option>";
                                        echo "<option value=PDB $h>PAYOR DEATH BENEFIT</option>";
                                        echo "<option value=PTPD $i>PAYOR TPD</option>";
                                        echo "<option value=RAWATINAP $r>HCCP</option>";
                                        echo "<option value=JSHC $j>HOSPITAL CARE</option>";
                                        ?>
                                    </select>
                                </td>
                                <td>Tanggal Pengajuan</td>
                                <td>: <input type="text" name="tglpengajuan" size="20" readonly value="<? echo $tanggal;?>"></td>
                            </tr>
                            <tr>
                                <td>No. Polis</td>
                                <td>: <input type="text" name="prefix" size="3" maxlength="2" value="<? echo $prefix;?>" onBlur="javascript:this.value=this.value.toUpperCase();">-<input type="text" name="noper" size="16" onBlur="validasi9(this.form.noper);" value="<? echo $noper;?>"></td>
                                <td>No. Registrasi (Askes)</td>
                                <td>: <input type="text" name="noregistrasi" size="20" maxlength="13" onblur="return CariRegistrasi();" value="<?=$noregistrasi?>"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr color="#c0c0c0" size="1"></td>
                            </tr>
                            <tr>
                                <td>DATA POLIS</td>
                                <td></td>
                                <td>YANG MENGAJUKAN KLAIM</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Tertanggung</td>
                                <td>: <input type="text" name="tertanggung" size="35"></td>
                                <td>Nama</td>
                                <td>: <input type="text" name="pemohon" size="35"></td>
                            </tr>
                            <tr>
                                <td>Pemegang Polis</td>
                                <td>: <input type="text" name="pemegangpolis" size="35"></td>
                                <td>Alamat Lengkap</td>
                                <td>: <input type="text" name="alamatpemohon" size="50"></td>
                            </tr>
                            <tr>
                                <td>Valuta</td>
                                <td>: <input type="text" name="valuta" size="20"></td>
                                <td>No. Telp/HP</td>
                                <td>: <input type="text" name="telppemohon" size="20"></td>
                            </tr>
                            <tr>
                                <td>Premi 5 Tahun Pertama</td>
                                <td>: <input type="text" name="premi1" size="20"></td>
                                <td>Hubungan dg tertanggung</td>
                                <td>: <input type="text" name="hubunganpemohon" size="20"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr color="#c0c0c0" size="1"></td>
                            </tr>
                            <!--
                           <tr>
                              <td>BENEFIT</td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td>Jaminan Rawat Inap</td>
                              <td>: <input type="text" name="ben_rawatinap" size="30"></td>
                              <td>x <input type="text" name="hari_rawatinap" size="5"> hari</td>
                              <td>= <input type="text" name="tot_rawatinap" size="20"></td>
                            </tr>
                            <tr>
                              <td>ICU</td>
                              <td>: <input type="text" name="ben_icu" size="30"></td>
                              <td>x <input type="text" name="hari_icu" size="5"> hari</td>
                              <td>= <input type="text" name="tot_icu" size="20"></td>
                            </tr>
                            <tr>
                              <td>Bedah</td>
                              <td>: <input type="text" name="ben_bedah" size="30"></td>
                              <td></td>
                              <td>= <input type="text" name="tot_bedah" size="20"></td>
                            </tr>

                            <tr>
                              <td colspan="4"><hr color="#c0c0c0" size="1"></td>
                            </tr>
                          -->
                            <tr>
                                <td>Nama Rumah Sakit</td>
                                <td>: <input type="text" name="namars" size="55"></td>
                                <td>Metode Bayar</td>
                                <td>: <select name="metodebayar"><option value="TRANSFER">TRANSFER</option></select>
                                    <b>*Pastikan data pembayaran yang Anda masukkan sudah benar</b>
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat Rumah Sakit</td>
                                <td>: <input type="text" name="alamatrs" size="55"></td>
                                <td>Atas Nama</td>
                                <td>: <input type="text" name="penerimasip"></td>
                            </tr>
                            <tr>
                                <td>Nama Dokter</td>
                                <td>: <input type="text" name="namadokter" size="36"></td>
                                <td>No Rek</td>
                                <td>: <input type="text" name="norekeningbank"></td>
                            </tr>

                            <tr>
                                <td>Tanggal Rawat Inap</td>
                                <td>:
                                    <input type="text" name="tglawal" size="14" onBlur="javascript:convert_date(tglawal)"> S/D
                                    <input type="text" name="tglakhir" size="16" onBlur="javascript:convert_date(tglakhir)"> (DD/MM/YYYY)
                                </td>
                                <td>Nama Bank</td>
                                <td>: <input type="text" name="namabank"> Cabang <input type="text" name="cabangbank"></td>
                            </tr>

                            <tr>
                                <td colspan="4"><hr color="#c0c0c0" size="1"></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center">
                                    <input type="hidden" name="cekbnf">
                                    <input type="hidden" name="jnsklaim" value="CASHPLAN">
                                    <input type="hidden" name="premi2">
                                    <input type="submit" name="submit" value="Proses">		</td>
                            </tr>
                        </table>
                    </td>
                </tr>
        </form>
        </table>
        <br />
        <table width="95%">
            <tr>
                <td width="50%" class="arial10" align="left"><a href="../../../submenu.php?mnuinduk=150">Back</a></td>
                <td width="50%" class="arial10" align="right"></td>
            </tr>
        </table>

    </div>
    </body>
    </html>
<?}?>