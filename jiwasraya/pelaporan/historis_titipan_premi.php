
<?php
//die;
  /*
  07-09-2007	perubahan batas polis boleh dipulihkan dari 3th dari pelunasan terakhir
							menjadi 3th sejak BPO;
							Request by Sukendro
							Updated by I Kade Budiarta				
  */
  include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
	include "../../includes/session.php";
	include "../../includes/sortnamagadai.php";
	include "../../includes/duit.php";
	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
	$sqlproduk="select substr(kdproduk,1,2) produk from $DBUser.tabel_200_pertanggungan where prefixpertanggungan='".strtoupper($prefix)."' and nopertanggungan='$noper'";
	//echo $sqlproduk;
	$DB->parse($sqlproduk);
	$DB->execute();
	$arrproduk=$DB->nextrow();
	$produk=$arrproduk["PRODUK"];
	if($produk<>"JL"){
		include "../../includes/tunggakan.php";
		//echo "ini produk link <br>";
	}else{
		include "../../includes/tunggakan_link.php";
		//echo "ini produk bukan link <br>";
	}
	//die;
	
/* ------------------------------------------------------------------------------------------ */
				 
 	
?>
<html>
<head>
<title>Pilih Pertanggungan</title>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 

input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; font-weight:bold;border-width: .2em;border-width: .2em;color:333333;text-align:center;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
submit		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

-->
</style>
<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
	<script LANGUAGE="JavaScript">
function cariTotalPremi(theForm) { 
    // window.alert('Price Message' + theForm.cek.length);
		//var el=theForm.elements['cek[]'];
		//for (var i = 0; i < el.length; i++) {		
		var premiTitipan=theForm.premititipan.value;
		var totaltagihan=theForm.totaltagihan.value;
		var sisatitipanold=theForm.sisatitipan.value;
		for (var i = 1; i < theForm.length; i++) {					
			var premiTagihan=1;//theForm.premirp[i].value;
			if(theForm.cek[i].check = true){										
				var tottagihan=totaltagihan+premiTagihan;						
				var sisatitipannew=premiTitipan-tottagihan;
				window.alert('total tagihan ' + totaltagihan + 'sisa titipan = ' + sisatitipannew);
				theForm.totaltagihan.value=tottagihan;
				theForm.sisatitipan.value=sisatitipannew;				
				break;
			}
			else if(theForm.cek[i].check = false){
				theForm.totaltagihan.value=0;	
				theForm.sisatagihan.value=1;
				break;
			}
		}				
		
 
}
</script>
</head>
<body>
<div align="center">
<?

$DB   = New database($userid, $passwd, $DBName);
	 $TGK  = New Tunggakan($userid,$passwd,$prefix,$noper,$tglmohon);
	 $PERT = New Pertanggungan($userid,$passwd,$prefix,$noper);
	 $DU=New Duit($userid,$passwd);
	 $TR=new Transaksi($userid,$passwd);
	 $kt=$TR->Kurs($PERT->valuta,$tglsip);
	 $ks=$DU->Kurs($PERT->valuta,$tglsip);
	 
	 echo $kt;

if (isset($simpan)){
	$box=$_POST['box1']; //as a normal var
      	$box_count=count($box); // count how many values in array
      	if (($box_count)<1)
				{
				echo "No Data Updated !";
				}
				else
				{
    				foreach ($box as $dear) {
					$ket = explode('#',$dear);
					//echo $ket[0]."|".$ket[1]."|".$ket[2]."|".$ket[3]."|".$ket[4]."|".$ket[5];		
    				$sql="insert into $DBUser.tabel_300_titipan_premi (PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,TGLBOOKED,TGLSEATLED,KDREKENINGPREMI,KDKUITANSI,".
      "KDVALUTA,KDREKENINGLAWAN,PREMITAGIHAN,TGLREKAM,USERREKAM,TGLUPDATED,USERUPDATED,NILAIRP,BUKTISETOR,STATUS,TGLSTATUS,LUNAS,TGLLUNAS,".
	  "TRANSFER,TGLTRANSFER,BILLSTATUS,TGLCETAK,TGLBAYAR)  select PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,TGLBOOKED,sysdate,KDREKENINGPREMI,KDKUITANSI,".
      "KDVALUTA,KDREKENINGLAWAN,PREMITAGIHAN,TGLREKAM,USERREKAM,TGLUPDATED,USERUPDATED,NILAIRP,'TTPPRM',STATUS,TGLSTATUS,LUNAS,sysdate,".
	  "TRANSFER,TGLTRANSFER,BILLSTATUS,TGLCETAK,TO_DATE('".$ket[4]."','DD/MM/YYYY') from $DBUser.tabel_300_historis_premi where prefixpertanggungan='".$ket[2]."' and nopertanggungan='".$ket[3]."' and trunc(tglbooked)=to_date('".$ket[5]."','dd/mm/yyyy')";

$totlunas+=$ket[1];

if($ket[0]<$totlunas){
	echo "Jumlah Saldo Tidak mencukupi untuk melakukan pelunasan Premi!!";	
	die;
}else{
	$sql1="insert into $DBUser.TABEL_309_PREMITITIPAN_TRANS (kdkantor,prefixpertanggungan,nopertanggungan,tglseatledtitipan,tgltrans,premititipan,tglbooked,kdtransaksi,saldo,dk,userrekam,tglrekam,status_gllink,status) ".
						  " values('$kantor','$ket[2]','$ket[3]',to_date('$ket[4]','dd/mm/yyyy'),trunc(sysdate),'$ket[0]',to_date('$ket[5]','dd/mm/yyyy'),'2',($ket[0]-$totlunas) ,'D',user,sysdate,'0','0')";
	$DB->parse($sql);
	$DB->execute();
	$DB1->parse($sql1);
	$DB1->execute();
	//die;	
}


$prefix=$ket[2];
$noper=$ket[3];
$tglmohon=$ket[4];
//$premititipan=
					

        			}
					
						}
}




?>


<input type="hidden" name="kode" value="<?echo $kode;?>">
<input type="hidden" name="tglmohon" value="<?echo $tglmohon;?>">


<?
$TUNGK  = New Tunggakan($userid,$passwd,$prefix,$noper,$tglmohon);
$sql="SELECT   TO_CHAR (MIN (a.tglbooked), 'DD/MM/YYYY') lunas
  FROM   $DBUser.tabel_300_historis_premi a
 WHERE       a.prefixpertanggungan = '$prefix'
         AND a.nopertanggungan = '$noper'
         AND tglseatled IS NULL
         AND status <> 'X'";
$DB->parse($sql);
$DB->execute();
$arr=$DB->nextrow();
		 
$sql="begin $DBUser.BILLRANGESATUANPULIH ( '$prefix', '$noper', to_date('".$arr["LUNAS"]."','dd/mm/yyyy'),to_date('$tglmohon','dd/mm/yyyy'), '$userid' ); end;";
$DB->parse($sql);
$DB->execute();

//echo $sql;


	 
	 //echo $kt; 
?>
<h1><?=$prefix.'-'.$noper;?></h1>
<table border="0" cellpadding="2" style="border-collapse: collapse" width="100%" bordercolor="#09b0ce">
<tr><td width="20%" align="left">Tanggal Menunggak</td><td>:</td><td><?=$TUNGK->lastpay;?></td></tr>
<tr><td width="20%" align="left">Tanggal Hitung</td><td>:</td><td><?=$tglmohon;?></td></tr>
</table>
<table border="1" cellpadding="2" style="border-collapse: collapse" width="100%" bordercolor="#09b0ce">
 <tr >
 <td width="10%" align="center">Nomor Polis</td>
 <td width="10%" align="center">Tgl. Booked</td> 
 <td width="10%" align="center">Tgl. Seatled</td>
 <td width="10%" align="center">Tgl. Bayar</td> 
 <td width="10%" align="center">Premi</td>
 <td width="10%" align="center">Premi Rupiah</td>
 <td width="10%" align="center">Kurs</td>
 <td width="10%" align="center">Action</td>
</tr>
<form action="<? echo $PHP_SELF;?>" name="daftartitipanpremi" method="post">
<?
$sqlx="SELECT   prefixpertanggungan,
           nopertanggungan,
		   premitagihan,
           TO_CHAR (tglbooked, 'dd/mm/yyyy') tbooked,
           nilairp,           
           TO_CHAR (tglseatled, 'dd/mm/yyyy') tseatled,
           TO_CHAR (tglbayar, 'dd/mm/yyyy') tbayar
    FROM   $DBUser.tabel_300_historis_premi a
   WHERE       prefixpertanggungan = '$prefix'
           AND nopertanggungan = '$noper'           
ORDER BY   tglbooked ASC";
//echo $sqlx;
$DB1->parse($sqlx);
$DB1->execute();
$i=1;

while ($arq=$DB1->nextrow()) {

include "../../includes/belang.php";
//echo "<tr>";
	print( " <td align=left >".$arq["PREFIXPERTANGGUNGAN"]."-".$arq["NOPERTANGGUNGAN"]."</td>\n" );
	print( " <td align=left >".$arq["TBOOKED"]." ".$arq["ST_TAGIH"]."</td>\n" );
	print( " <td align=right >".$arq["TSEATLED"]."</td>\n" );
	print( " <td align=right >".$arq["TBAYAR"]."</td>\n" ); 
	print( " <td align=right >".$arq["PREMITAGIHAN"]."</td>\n" );
	if ($arq["TSEATLED"]=="") {
		print( " <td align=right >".$arq["NILAIRP"]."<input type=\"hidden\" name=\"premirp\" value=\"".$arq["NILAIRP"]."\" ></td>\n" );
		print( " <td align=right >".$kt."</td>\n" ); 
		print( "<td align=\"center\"><input type=\"checkbox\" name=\"box1[]\" value=\"".$premititipan."#".$arq["NILAIRP"]."#".$prefix."#".$noper."#".$tglmohon."#".$arq["TBOOKED"]."\"></td>" );	
		$i++;
	}else{
		print( " <td align=right >".$arq["NILAIRP"]."</td>\n" );
		print( " <td align=right >".$kt."</td>\n" ); 
		print( " <td align=center></td>\n" );
	}
	
    print( "</tr>" );


}
?>
    

<tr><td></td><td></td>
<td><b>Premi Titipan :</b><br /><input readonly type="text" name="premititipan" value="<?=$premititipan;?>"></td>
<td><b>Total Premi Tagihan :</b><br /><input readonly type="text" name="totaltagihan"></td>
<td><b>Sisa :</b><br /><input readonly type="text" name="sisatitipan" value="<?=$premititipan;?>"></td>
<td><input <?=$disabeled;?> type="submit" name="simpan" value="SIMPAN"></td></tr>
<tr><td colspan="3"></td><td align="center">Kurs</td><td><input readonly type="text" name="nkurs" value="<?=$kt;?>"></td><td colspan="2"></td></tr>
<tr><td colspan="3"></td><td align="center">Total Rupiah</td><td><input readonly type="text" name="ttotalrp" value="<?=$kt*$arq["TTOTAL"];?>"></td><td colspan="2"></td></tr>
</form>

</div>
</body>
</html>
