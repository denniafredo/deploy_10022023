<?php
include "../../includes/session.php";
include "../../includes/database.php";
include "../../includes/tgl.php";
$DB = New database($userid, $passwd, $DBName);

if ($nosp) {
    $sql = "UPDATE $DBUser.tabel_ul_spaj_temp SET dokumenlengkap = '1' WHERE nosp = '$nosp'";
    $DB->parse($sql);
    $DB->execute();
    $sql = "UPDATE $DBUser.tabel_704_cek_dok_spaj SET status = '1' WHERE nospa = '$nosp'";
    $DB->parse($sql);
    $DB->execute();
}
if ($lanjut) {
	$sql = "UPDATE $DBUser.tabel_200_pertanggungan SET suspend = NULL, keterangan = NULL
			WHERE nopertanggungan = '$lanjut'";
	$DB->parse($sql);
    $DB->execute();
}

$tgl = !$bl && !$th ? "AND TO_CHAR(a.tglsp, 'mmyyyy') = TO_CHAR(sysdate, 'mmyyyy')" :
       ($bl == '13' ? "AND TO_CHAR(a.tglsp, 'yyyy') = '$th'" : "AND TO_CHAR(a.tglsp, 'mmyyyy') = '".sprintf("%02d",$bl)."$th'");
$sql = "SELECT a.nosp, NVL(a.buildid, '-') buildid, a.namapempol, a.hp, a.premi, a.topup, 
            CASE WHEN a.dokumenlengkap = 0 THEN 'Tidak Lengkap' ELSE 'Lengkap' END dokumenlengkap, 
            a.noagen, b.namaklien1 namaagen, CASE WHEN a.taltup = '1' THEN 'Ya' ELSE 'Tidak' END taltup, 
            a.noref, a.namaref, a.bankcabang, TO_CHAR(a.tglsp, 'dd/mm/yyyy') tglsp, c.suspend,
            CASE WHEN c.nosp IS NULL THEN 'SPAJ' WHEN c.kdpertanggungan = '1' THEN 'Proposal' WHEN c.kdpertanggungan = '2' THEN 'Polis' END status,
            c.prefixpertanggungan, c.nopertanggungan, c.kdproduk, c.kdpertanggungan
        FROM $DBUser.tabel_ul_spaj_temp a
        LEFT OUTER JOIN $DBUser.tabel_100_klien b ON a.noagen = b.noklien
        LEFT OUTER JOIN $DBUser.tabel_200_pertanggungan c ON a.nosp = c.nosp
        WHERE kdkantor = '$kantor'
            $tgl
        ORDER BY a.tglsp DESC";
		//echo $sql;
$DB->parse($sql);
$DB->execute();
?>

<html>
<head>
    <link type="text/css" href="../../includes/jws.css" rel="stylesheet" />
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
    <title>Mutasi Pertanggungan</title>
</head>

<body>
<form name="xxx" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
    <font face="Verdana" size="2"><b>DAFTAR SPAJ - SURAT KONFIRMASI</b></font><br>
    Kantor : <?echo $kantor; ?><br>
    Bulan :
    <select name="bl">
        <? $bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember','SEMUA');
        for ($i=1; $i<=13; $i++) {
            if ($i==$bl || (!$bl && $bulan[$i]==$bln)) {
                echo "<option value='$i' selected='selected'>".$bulan[$i]."</option>";
            } else {
                echo "<option value='$i'>".$bulan[$i]."</option>";
            }
        }
        ?>
    </select>
    <select name="th">
        <? $th=(!$th) ? substr($tanggal,-4) : $th;
        for ($i=1995; $i<=substr($tanggal,-4); $i++) {
            if ($i==$th) {
                echo "<option value='$i' selected='selected'>$i</option>";
            } else {
                echo "<option value='$i'>$i</option>";
            }
        }

        ?>
    </select>
    <input name="cari" value="Cari" type="submit">
    <input name="baru" value="Entry SPAJ" type="button" onclick="window.location.href='ulink/spaj.php'"><br>
    Status : <span style="margin:0 4px;padding:0 6px;background-color:yellow;"><font face="Verdana" size="1"><b>Tertunda / Pending</b></font></span>
    <br><br>
</form>

<form name="xxy" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
    <table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
        <tr>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO</b></font></td>
            <td colspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>SPAJ</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>BUILD ID</b></font></td>
            <td colspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG POLIS</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PREMI</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TOP UP</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>DOKUMEN</b></font></td>
            <td colspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>AGEN</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TALTUP</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>REFERENSI</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>CABANG BANK</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>STATUS</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>OPSI</b></font></td>
        </tr>
        <tr>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NOMOR</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TANGGAL</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NAMA</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NOMOR HP</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NOMOR</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NAMA</b></font></td>
        </tr>
        <?php $i = 0;
        while ($arr = $DB->nextrow()) {
            $bgclear = $i%2 == 0 ? null : "bgcolor='#ffffff'";
            $bgstatus = $arr['SUSPEND'] == '1' ? "bgcolor='yellow'" : $bgclear; ?>
            <tr>
                <td <?=$bgclear?> align="center"><font face="Verdana" size="1"><?=$i+1;?></font></td>
                <td <?=$bgclear?> align="center"><font face="Verdana" size="1"><?=$arr['NOSP'];?></font></td>
                <td <?=$bgclear?> align="center"><font face="Verdana" size="1"><?=$arr['TGLSP'];?></font></td>
                <td <?=$bgclear?> align="center"><font face="Verdana" size="1"><?=$arr['BUILDID'];?></font></td>
                <td <?=$bgclear?> align="left"><font face="Verdana" size="1"><?=$arr['NAMAPEMPOL'];?></font></td>
                <td <?=$bgclear?> align="center"><font face="Verdana" size="1"><?=$arr['HP'];?></font></td>
                <td <?=$bgclear?> align="right"><font face="Verdana" size="1"><?=number_format($arr['PREMI'], 2, ",", ".");?></font></td>
                <td <?=$bgclear?> align="right"><font face="Verdana" size="1"><?=number_format($arr['TOPUP'], 2, ",", ".");?></font></td>
                <td <?=$bgclear?> align="center">
                    <font face="Verdana" size="1">
                        <?php if ($arr['DOKUMENLENGKAP'] == 'Tidak Lengkap') {
                            echo "<a href='javascript:void(0);' onclick=\"NewWindow('cetakdokumen.php?nosp=$arr[NOSP]', 'popupdokumen', '400', '300', 'yes');\">$arr[DOKUMENLENGKAP]</a>";
                        } else {
                            echo $arr['DOKUMENLENGKAP'];
                        } ?>
                    </font>
                </td>
                <td <?=$bgclear?> align="center"><font face="Verdana" size="1"><?=$arr['NOAGEN'];?></font></td>
                <td <?=$bgclear?> align="left"><font face="Verdana" size="1"><?=$arr['NAMAAGEN'];?></font></td>
                <td <?=$bgclear?> align="center"><font face="Verdana" size="1"><?=$arr['TALTUP'];?></font></td>
                <td <?=$bgclear?> align="left"><font face="Verdana" size="1"><?="$arr[NOREF] - $arr[NAMAREF]";?></font></td>
                <td <?=$bgclear?> align="left"><font face="Verdana" size="1"><?=$arr['BANKCABANG'];?></font></td>
                <td <?=$bgstatus?> align="center">
                    <font face="Verdana" size="1">
                        <? if ($arr['SUSPEND'] == '1') {
                            echo "<a href='javascript:void(0);' onclick=\"NewWindow('akseptasi_pending.php?prefixpertanggungan=$arr[PREFIXPERTANGGUNGAN]&nopertanggungan=$arr[NOPERTANGGUNGAN]&disable=1', 'popupdokumen', '620', '400', 'yes');\">$arr[STATUS] $arr[PREFIXPERTANGGUNGAN]-$arr[NOPERTANGGUNGAN]</a>";
                        } else {
							if ($arr['KDPERTANGGUNGAN']) {
								echo "$arr[STATUS] $arr[PREFIXPERTANGGUNGAN]-$arr[NOPERTANGGUNGAN]";
							} else {
								echo "$arr[STATUS] Belum Proposal";
							}
                        }
                        ?>
                    </font>
                </td>
                <td <?=$bgclear?> align="center">
                    <?php if ($arr['DOKUMENLENGKAP'] == 'Tidak Lengkap') {?>
						<input type="hidden" name="nosp" value="<?=$arr['NOSP'];?>" />
						<input type="submit" name="kirim" value="Lengkap" />
                        <!--button type="submit" name="nosp" value="<?=$arr['NOSP'];?>" style="padding:0px;margin:0px;">
                            <font face="Verdana" size="1">Lengkap</font>
                        </button-->
                    <?php } else if ($arr['SUSPEND'] && substr($arr['KDPRODUK'],0,2) != 'JL') { ?>
						<input type="hidden" name="lanjut" value="<?=$arr['NOPERTANGGUNGAN'];?>" />
						<input type="submit" name="kirim" value="Lanjut" />
						<!--button type="submit" name="lanjut" value="<?=$arr['NOPERTANGGUNGAN'];?>" style="padding:0px;margin:0px;">
                            <font face="Verdana" size="1">Lanjut</font>
                        </button-->
					<?php } ?>
                    <button type="button" onClick="NewWindow('ulink/cetakinfo.php?sp=<?=$arr['NOSP'];?>','popuppage','620','500','yes')" style="padding:0px;margin:0px;">
                        <font face="Verdana" size="1">Cetak</font>
                    </button>
                </td>
            </tr>
            <? $i++;
        } ?>
    </table>
</form>

<hr size="1">
<a href="../submenu.php?mnuinduk=200"><font face="Verdana" size="2">Pertanggungan Baru</font></a>
</body>
</html>