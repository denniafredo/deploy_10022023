<script type="text/javascript">
    // Popup windows open
    function openWin(url) {
        window.open(url, "popup", "width=800, height=600, directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no, scrollbars=yes);
    }
</script>
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

    $sql = "insert into $DBUser.tabel_905_benefit_klaim ".
        "(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,kdproduk,kdbenefit,nilaibenefit,tglrekam,userrekam) ".
        "values ".
        "('$prefix','$noper','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'),'$kdproduk','".$kdbnft."',".$jmlnilai.",sysdate,user) ";
    $DA->parse($sql);
    //echo $sql;
    if($DA->execute()) {
        $sqa = "update $DBUser.tabel_901_pengajuan_klaim ".
            "set userptg=user,tglptg=sysdate,status='1',nilaibenefit=$jmlnilai, ".
            "userupdated=user,tglupdated=sysdate,tglhitung=trunc(sysdate) ".
            "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
            "and kdklaim='$kdklaim' and tglpengajuan=to_date('$tglpengajuan','DD/MM/YYYY')";
        //echo $sqa;
        $DB->parse($sqa);
        $DB->execute();

        $sql = "update $DBUser.tabel_901_pengajuan_klaim set kdkantorproses = 'KP', approveho = '1'
                where prefixpertanggungan='$prefix' and nopertanggungan='$noper'
                    and kdklaim='$kdklaim' and tglpengajuan=to_date('$tglpengajuan','dd/mm/yyyy')";
        $DB->parse($sql);
        $DB->execute();

        print( "  <table width=\"100%\">\n" );
        print( "   <tr>\n" );
        print( "    <td colspan='2' align='center'><font face=Verdana size=2 color=#ff3366><b>Proses pembentukan desisi selesai, Silahkan cetak desisi.</font></td>\n" );
        print( "   </tr>\n" );
        print( "   <tr>\n" );
        print( "    <td align=\"left\">
                        <!--a href=\"#\" onclick=\"openWin('../../../polis/cetakizin_klaim.php?prefix=$prefix&noper=$noper&kdklaim=CASHPLAN&tglpengajuan=$tglpengajuan&kantor=KP')\"><font face=Arial size=2>Cetak Desisi</font></a--> &nbsp;&nbsp;
						<!--a href='#' onclick=\"window.open('http://www.google.co.id', 'cetakan desisi')\">Tes</a-->
                        <a href='#' onclick=\"window.location.replace('../../../submenu.php?mnuinduk=150')\"><font face=Arial size=2>Kembali</font></a>
                    </td>\n" );
        print( "	 </tr>\n" );
        print( "	</table>	" );
    } else {
        echo "Gagal! Pengajuan mungkin sudah pernah dilakukan";
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
                                <td align="center" height="20">Uraian</td>
                                <td align="center">Diajukan</td>
                                <td align="center">Beban Pribadi</td>
                                <td align="center">Disetujui</td>
                            </tr>
                            <?
                            $sql = 	"SELECT a.nama_klaim, a.diajukan, a.disetujui, a.piutang
                                     FROM hc_rekam_medis_detail@askes a
                                     INNER JOIN hc_rekam_medis@askes b ON a.no_rekam_medis = b.no_rekam_medis
                                     INNER JOIN hc_master_rekam_medis@askes c ON b.no_master_rekam_medis = c.no_master_rekam_medis
                                     LEFT OUTER JOIN hc_pengelola@askes d ON a.kd_pengelola = d.kd_pengelola
                                     LEFT OUTER JOIN hc_benefit@askes e ON a.kd_benefit = e.kd_benefit
                                     INNER JOIN $DBUser.tabel_901_pengajuan_klaim f ON c.no_registrasi = f.noregistrasi
                                     WHERE prefixpertanggungan = '$prefix'
                                        AND nopertanggungan = '$noper'
                                        AND tglpengajuan = TO_DATE('$tglpengajuan', 'dd/mm/yyyy')
                                     ORDER BY a.no_rekam_medis, a.no_rekam_medis_detail";
                            //echo $sql;
                            $DB->parse($sql);
                            $DB->execute();
                            $i=1;
                            $j=0;
                            $total=0;
                            while ($arr=$DB->nextrow()) {
                                $total += str_replace(",", ".", $arr['DISETUJUI']);
                                include "../../includes/belang.php";
                                print( "<td align=\"left\">".$arr["NAMA_KLAIM"]."</td>\n" );
                                print( "<td align=\"right\">".number_format($arr['DIAJUKAN'],2,",",".")."</td>\n" );
                                print( "<td align=\"right\">".number_format($arr['PIUTANG'],2,",",".")."</td>\n" );
                                print( "<td align=\"right\">".number_format($arr['DISETUJUI'],2,",",".")."</td>\n" );
                                print( "</tr>" );
                                $i++;
                                $j++;
                            }
                            ?>
                            <tr>
                                <?php
                                $sql = "SELECT a.kdbenefit, namabenefit
                                        FROM $DBUser.tabel_223_transaksi_produk a
                                        INNER JOIN $DBUser.tabel_207_kode_benefit b ON a.kdbenefit = b.kdbenefit
                                        WHERE prefixpertanggungan = '$prefix'
                                            AND nopertanggungan = '$noper'
                                            AND substr(a.kdbenefit, 1, 4) = 'JSHC'";
                                $DA->parse($sql);
                                $DA->execute();
                                $res = $DA->nextrow();
                                ?>
                                <td colspan="3" align="center">Nilai Benefit <?=$res['NAMABENEFIT']?><input type="hidden" name="kdbnft" value="<?=$res['KDBENEFIT']?>"></td>
                                <td align="right"><input type="text" name="jmlnilai" value="<?=$total?>" style="text-align:right" /></td>
                            </tr>
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
        </form>
    </div>
    </body>
    </html>
<?}?>