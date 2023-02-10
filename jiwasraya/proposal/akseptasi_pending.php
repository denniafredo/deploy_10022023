<?php
    include "../../includes/session.php";
    include "../../includes/database.php";
    $DB = New database($userid, $passwd, $DBName);

    if ($submit) {
        if(empty($_GET["kategori_pending"])){
            echo "<h3><font face='Verdana' color='red'><u>Kategori Pending tidak boleh kosong!</u></font></h3>";
        }else{
            $sql = "UPDATE $DBUser.tabel_200_pertanggungan SET suspend = 1, keterangan = '$keterangan'
                    WHERE prefixpertanggungan = '$prefixpertanggungan'
                        AND nopertanggungan = '$nopertanggungan'";
            $DB->parse($sql);
            $DB->execute();
        	
        	$sql = "INSERT INTO $DBUser.tabel_600_historis_mutasi_pert (tglmutasi, prefixpertanggungan,
        				nopertanggungan, kdmutasi, keteranganmutasi, userupdated)
        			VALUES (sysdate, '$prefixpertanggungan', '$nopertanggungan', '42', '$keterangan', '$userid')";
        	$DB->parse($sql);
            $DB->execute();
        	
        	$sql = "DELETE FROM $DBUser.tabel_600_historis_mutasi_pert
        			WHERE prefixpertanggungan = '$prefixpertanggungan'
        				AND nopertanggungan = '$nopertanggungan'
        				AND kdmutasi = '26'
        				AND TO_CHAR(tglmutasi,'ddmmyyyy') = TO_CHAR(sysdate,'ddmmyyyy')";
        	$DB->parse($sql);
            $DB->execute();

            /* Menambahkan menu insert ke tabel_216_mutasi_pending untuk mencatat jenis pending pada masing-masing nomor proposal jika ada. (Teguh 08/11/2019) */
            $kategori_pending_ = '';
            foreach($_GET["kategori_pending"] as $x){
                $kategori_pending_ .= $x . ', ';
            }
            $kategori_pending_ = substr($kategori_pending_, 0, -2);

            $sumber_pending_ = '';
            foreach($_GET["sumber_pending"] as $y){
                $sumber_pending_ .= $y . ', ';
            }
            $sumber_pending_ = substr($sumber_pending_, 0, -2);

            $sqlip = "INSERT INTO $DBUser.tabel_216_historis_mutasi_uw (prefixpertanggungan, nopertanggungan, status, kategoripending, sumberpending, keterangan, tglrekam, userrekam)
                        VALUES ('$prefixpertanggungan', '$nopertanggungan', 'Pending',  '$kategori_pending_', '$sumber_pending_', '$keterangan', sysdate, '$userid')";
            $DB->parse($sqlip);
            $DB->execute();

            /*Fungsi untuk mengirimkan email pending ke ASC*/
            include "../../includes/email_pending.php";
            /*End Fungsi Kirim email*/

            /*End Tambahan - Teguh (08/11/2019)*/
        	
            echo "<script type='text/javascript'>
            	window.opener.location.reload(false);
            	window.close();
            </script>";
            /*----Mohon dikirimkan email pending ke pembuat proposal----*/
        }
    }
    $sql = "SELECT keterangan
            FROM $DBUser.tabel_200_pertanggungan
            WHERE prefixpertanggungan = '$prefixpertanggungan'
                AND nopertanggungan = '$nopertanggungan'";
    $DB->parse($sql);
    $DB->execute();
    $r = $DB->nextrow();
?>

<html>
    <head>
        <link type="text/css" href="../../includes/jws.css" rel="stylesheet" />
        <link type="text/css" href="../jquery/demos.css" rel="stylesheet" />
        <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
        <title>Tunda Proposal <?="$prefixpertanggungan-$nopertanggungan"?></title>
    </head>
    <body>
        <font face="Verdana" size="2"><b>TUNDA PROPOSAL <?="$prefixpertanggungan-$nopertanggungan"?></b></font><br>
        <hr size=1>

        <form name="prop" action="<?=$PHP_SELF?>" method="get">
            <input type="hidden" name="prefixpertanggungan" value="<?=$prefixpertanggungan?>" />
            <input type="hidden" name="nopertanggungan" value="<?=$nopertanggungan?>" />
            <table border="0" width="600" cellspacing="0" cellpadding="6" style='border:1px solid #006699; font-family: verdana; font-size: 12px' >
                <!--Menambahkan pilihan untuk jenis pending proposal yang masuk (Teguh 27/08/2019)-->
                <tr>
                    <td align="center" bgcolor="#627EB5" colspan="2">
                        <font color="#fff"><b>ALASAN PROPOSAL DI PENDING</b></font>
                    </td>
                </tr>
                <tr style="height: 50px">
                    <td align="left" bgcolor="#DAE2EF" colspan="2">
                        <b><u>Kategori Pending : </u></b>
                    </td>
                </tr>
                <?php
                    $sqlpdg = "SELECT * FROM $DBUser.tabel_216_status_pending";
                    $DB->parse($sqlpdg);
                    $DB->execute();
                    while ($arr=$DB->nextrow()) {
                        echo ("
                            <tr>
                                <td width ='3%'>
                                    <input type='checkbox' name='kategori_pending[]' value='".$arr['NAMASTATUSPENDING']."'>
                                </td>
                                <td>
                                    <b>".$arr['NAMASTATUSPENDING']."</b>
                                    </br><font color='red'>
                                    ".$arr['SUBSTATUSPENDING']."</font>
                                </td>
                            </tr>");
                    }
                ?>
                <!--Selesai-->
                <tr>
                    <td bgcolor="#DAE2EF" colspan="2">
                        <textarea name="keterangan" rows="5" style="width:100%;" maxlength="1000" placeholder="Maksimal 1000 karakter" <?=$disable==1?'disabled':null;?>><?=$r['KETERANGAN']?></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="2">
                        <b><u>Sumber Pending : </u></b>                
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type='checkbox' name='sumber_pending[]' value='Agen'>
                    </td>
                    <td><b>Agen</b></td>
                </tr>
                <tr>
                    <td>
                        <input type='checkbox' name='sumber_pending[]' value='Presales'>
                    </td>
                    <td><b>Presales</b></td>
                </tr>
                <tr>
                    <td>
                        <input type='checkbox' name='sumber_pending[]' value='Sistem'>
                    </td>
                    <td><b>Sistem</b></td>
                </tr>
                <tr>
                    <td align="center" bgcolor="#E4E4E4" colspan="2">
                        <?php if ($disable != '1') { ?>
                            <input type="submit" value="SUBMIT" name="submit" style="font-size: 8pt; font-family: Verdana"> 
                        <?php } ?>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
