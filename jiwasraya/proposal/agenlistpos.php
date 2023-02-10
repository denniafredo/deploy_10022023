<?
include "../../includes/session.php";
include "../../includes/database.php";


$DB = New database($DBUser, $DBPass, $DBName);

$formname=(!$a) ? "ntryprop" : $a;
$fieldname=(!$b) ? "noagen" : $b;
?>
<html><title>Agen List</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<link href="../../includes/jws2005.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript">
    <!--
    function OnSumbit(theForm) {
        var a = theForm.nama.value;
        if (a.length < 3) {
            if (confirm('Masukkan 3 Hurup Pertama Yang Ingin Dicari\nKlik OK Untuk Semuanya')) {
                theForm.nama.value='ALL';
                return true;
            } else {
                theForm.nama.focus();
                return false;
            }
        } else {
            return true;
        }
    }
    function gantiKantor(theForm) {
        var kdkantor=theForm.kdkantor.value;
        window.location.replace('agnlistx.php?kdkantor='+kdkantor+'#awaledit');
    }
    //-->
</script>
<body>
<form name="porm" method="post" action="<?echo $PHP_SELF;?>" onsubmit="return OnSumbit(document.porm)">
    <table width="100%" cellpadding="4" cellspacing="0" >
        <tr bgcolor="#f89aa4">
            <td>Nama Agen <font size=1>(min 3 karakter)</font>: &nbsp;
                <input type="text" name="nama" size="8" value="<?echo strtoupper($nama);?>">
                <?
                if($kdkantor==""){$kdkantor=$kantor;}
                $sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' ".
                    "order by kdkantor";
                //echo $sqa;
                $DB->parse($sqa);
                $DB->execute();
                echo "Rayon <select name=kdkantor class=select2 onChange=\"gantiKantor(document.porm)\">";
                while ($arr=$DB->nextrow()) {

                    if($kdkantor==$arr["KDKANTOR"])
                    {
                        $pilih = "selected";
                    }
                    else
                    {
                        $pilih = "";
                    }
                    if($arr["KDKANTOR"]==$kantor)
                    {
                        $kls = "class=sudah";
                    }
                    else
                    {
                        $kls = "class=belum";
                    }
                    echo "<option value=".$arr["KDKANTOR"]." $pilih $kls>".$arr["KDKANTOR"]." - ".substr($arr["NAMAKANTOR"],0,-14)." BO</option>";
                }
                echo "</select>";
                ?>
                <!--<input type="submit" name="submit" value="Cari" class="buton"> di hide dulu-->
                <input type="hidden" name="a" value="<?echo $a;?>">
                <input type="hidden" name="b" value="<?echo $b;?>">
            </td>
        </tr>
    </table>

    <br>
    <?
    if($kdkantor!=$kantor)
    {
        echo "<font color=#5286c5><img border=0 src=../img/warning.png align=left hspace=5 vspace=5>Perhatian!<br>".
            "Agen dibawah bukan dari rayon Anda ($kantor). Silakan pilih dengan hati-hati, ".
            "yakinkan nomor dan nama agen pilihan Anda benar.<br><br></font>";
    }
    ?>
    <b>Daftar Agen Kantor <?=$kdkantor;?> (Status AKTIF)</b><br>
    <?

    if (!$nama) {
        //$dannama = 'kampret';
    } elseif ($nama=='ALL') {
        $dannama = '';
    } else{
        $dannama = "and b.namaklien1 like '".strtoupper($nama)."%'";
    }
    $ad = ($o==1) ?  'desc' : 'asc';
    $f = (!$f) ? '2' : $f;

    $sql = "SELECT a.noagen, d.namaklien1, a.kdpangkat, e.namaareaoffice, a.kdkantor, a.prefixagen, d.no_ponsel
            FROM $DBUser.tabel_400_agen a
            INNER JOIN jaim_201_prospek@jaim b ON a.noagen = b.noagen
            INNER JOIN jaim_300_hitung@jaim c ON b.noprospek = c.no_prospek
            INNER JOIN $DBUser.tabel_100_klien d ON a.noagen = d.noklien
            LEFT OUTER JOIN $DBUser.tabel_410_area_office e ON a.kdareaoffice = e.kdareaoffice
                AND a.kdkantor = e.kdkantor
            WHERE a.kdstatusagen = '01'
                AND a.kdkantor = '$kdkantor'
                AND a.kdjabatanagen NOT IN ('08', '16')
                AND c.tgl_rekam + 14 >= sysdate
                AND flag_spaj = '0'
            GROUP BY a.noagen, d.namaklien1, a.kdpangkat, e.namaareaoffice, a.kdkantor, a.prefixagen, d.no_ponsel
            ORDER BY a.noagen";
    //echo $sql;
    $DB->parse($sql);
    $DB->execute();
    ?>
    <table border="0" width="100%" cellpadding="2" cellspacing="1">
        <tr bgcolor="#f89aa4">
            <?
            $o = (int)!((boolean)$o);
            echo "<td align=\"center\"><b>Kantor</b></td>";
            echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=1&o=$o&kdkantor=$kdkantor\"><b>Nomor Agen</b></a></td>" ;
            echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=2&o=$o&kdkantor=$kdkantor\"><b>Nama Agen</b></a></td>" ;
            echo "<td align=\"center\"><b>Kode Jabatan</b></td>";
            echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=3&o=$o&kdkantor=$kdkantor\"><b>Area Office</b></a></td>";
            echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=3&o=$o&kdkantor=$kdkantor\"><b>Handphone</b></a></td>";
            ?>
        </tr>
        <?
        $i=0;

        while($arr=$DB->nextrow()) {
            #----------------------------[ START NO HP ]----------------------------
            if(($arr["NO_PONSEL"])== ''){
                $nohp = "<font color=red><a href=\"#\" onclick=\"NewWindow('./updateponsel.php?noklien=".$arr["NOAGEN"]."','',800,500,1)\">UPDATE NO. HP</a></font>";
                //echo 'kampret';
            } else {
                $nohp = $arr["NO_PONSEL"];
                //echo 'kampret ok';
            }
            #----------------------------[ END NO HP ]----------------------------

            if($arr["KDPANGKAT"]=="PN") $pn="<b><u>EX PENAGIH</u></b>";
            //include "../../includes/belang.php";
            echo "<tr bgcolor=".($i%2 ? "#d3d3d3" : "#97c8e1").">";
            if(substr($arr["NAMAAREAOFFICE"],0,31)=="UKA KHUSUS ANGGANA ANGGIH PRIMA"){
                $a= "<td align=center>".$arr["KDKANTOR"]."</td>".
                    "<td align=center><a href=\"#\" onclick=\"javascript:window.opener.document.".$formname.".".$fieldname.".value='".$arr["NOAGEN"]."';window.opener.document.".$formname.".nikuseraap.value='".$arr["NOAGEN"]."';window.opener.document.".$formname.".useraap.value='".$arr["NAMAKLIEN1"]."';window.close();\" >".$arr["PREFIXAGEN"]."-".$arr["NOAGEN"]."</a></td>".
                    "<td>".$arr["NAMAKLIEN1"]." $pn</td>".
                    "<td align=center>".$arr["KDJABATANAGEN"]."</td>".
                    "<td>".$arr["NAMAAREAOFFICE"]."</td>".
                    "<td>".$nohp."</td>".
                    "</tr>";
            }else{
                $a= "<td align=center>".$arr["KDKANTOR"]."</td>".
                    "<td align=center><a href=\"#\" onclick=\"javascript:window.opener.document.".$formname.".".$fieldname.".value='".$arr["NOAGEN"]."';window.close();\" >".$arr["PREFIXAGEN"]."-".$arr["NOAGEN"]."</a></td>".
                    "<td>".$arr["NAMAKLIEN1"]." $pn</td>".
                    "<td align=center>".$arr["KDJABATANAGEN"]."</td>".
                    "<td>".$arr["NAMAAREAOFFICE"]."</td>".
                    "<td>".$nohp."</td>".
                    "</tr>";
            }
            echo($a);
            $pn="";
            $i++;
        }
        ?>
    </table>

</body>
</html>