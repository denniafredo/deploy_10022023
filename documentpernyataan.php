<?php 
 include "../../includes/session.php";
 include "../../includes/database.php";
 include "../../includes/klien.php";
include "../../includes/pertanggungan.php";

//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$newNopolis = base64_decode(base64_decode($_REQUEST['no_polis']));
$newnopertanggungan = base64_decode(base64_decode($_REQUEST['nopertanggungan']));
$prefix = base64_decode(base64_decode($_REQUEST['prefix']));
			
$PER=New Pertanggungan($userid,$passwd,$prefix,$newnopertanggungan);
$KLN=New Klien($userid,$passwd,$PER->notertanggung);



function makeRequest($url, $callDetails = false)
{
  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $result = curl_exec($ch);
 
  curl_close($ch);
  $response = json_decode($result, true);
  return $response;

}

$url = "http://aims.ifg-life.id/api/jsspaj/master/bundle-document-local?&nosp=$PER->nosp&noid=$KLN->noid";

$response = makeRequest($url, true);


?>


<html>
<head>
<title>HISTORY DOCUMENT PERNYATAAN</title>
</head>

<body>

<style>
	.demo {
		border:1px solid #C0C0C0;
		border-collapse:collapse;
		padding:5px;
	}
	.demo th {
		border:1px solid #C0C0C0;
		padding:5px;
		background:#F0F0F0;
	}
	.demo td {
		border:1px solid #C0C0C0;
		padding:5px;
    align:center;
	}
</style>
<div align="center"><font color="#333333" size="2" face="Arial Narrow"><img src="../images/logo-ifg.png"></font></div></td>
<table width="650" border="1" align="center" cellpadding="0" cellspacing="0">
<h3 align="center">LIST DOKUMEN PERNYATAAN</h1>
<thead>
	<tr>
		<th class="demo">No</th>
		<th class="demo">Nama Dokumen</th>
		<th class="demo">Action</th>
	</tr>	
</thead>	
<tbody>	  
	<?php if(@$response['data']): $i = 1; foreach($response['data'] as $doc): ?>
	<tr>
		<td class="demo"><?php echo $i++; ?></td>
		<td class="demo"><?php echo $doc['JENIS_DOKUMEN_ID'] ?></td>
		<td class="demo" align="center">
			<a align="center" href="./downloaddoc.php?file=<?= base64_encode("https://aims.ifg-life/api/jsspaj/assets/web/upload/".$doc['META_FILES']) ?>">Download</a>&nbsp;|&nbsp;
			<a href="<?php echo "https://aims.ifg-life.id/Prospek/getfileupload/?files=".$doc['META_FILES']?>">View</a>
		</td>
	</tr>
	<?php endforeach ?>
	<?php endif ?>
	</tbody>
</table>

		</td>
	  </tr>
	  
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="right"><font color="#000000" size="2" face="Arial Narrow">
        
            <input type=button name=exit value="Tutup" class=action onClick="javascript:window.close();">
        </font></div></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>