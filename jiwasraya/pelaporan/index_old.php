<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	//include "../../includes/whoisonline.php";
 ?>
<html>
<head>
<title>Untitled</title>
</head>
<STYLE type=text/css>#divDescription {
	Z-INDEX: 200; VISIBILITY: hidden; WIDTH: 200px; POSITION: absolute
}
.clDescription {
  color : #ffffff;FONT-WEIGHT: bold;
	BORDER-RIGHT: #000000 1px solid; PADDING-RIGHT: 3px; 
	BORDER-TOP: #000000 1px solid; PADDING-LEFT: 3px; 
	FONT-SIZE: 11px ; PADDING-BOTTOM: 3px; BORDER-LEFT: #000000 1px solid; 
	WIDTH: 150px; PADDING-TOP: 3px; BORDER-BOTTOM: #000000 1px solid; 
	FONT-FAMILY: verdana,arial,helvetica; BACKGROUND-COLOR: #ff0000; 
}
#divlinks {
	Z-INDEX: 1; LEFT: 100px; POSITION: absolute; TOP: 200px
}
</STYLE>

<SCRIPT language=JavaScript type=text/javascript>
/********************************************************************************
Copyright (C) 1999 Thomas Brattli
This script is made by and copyrighted to Thomas Brattli at www.bratta.com
Visit for more great scripts. This may be used freely as long as this msg is intact!
I will also appriciate any links you could give me.
********************************************************************************/
//Default browsercheck, added to all scripts!
function checkBrowser(){
	this.ver=navigator.appVersion
	this.dom=document.getElementById?1:0
	this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom)?1:0;
	this.ie4=(document.all && !this.dom)?1:0;
	this.ns5=(this.dom && parseInt(this.ver) >= 5) ?1:0;
	this.ns4=(document.layers && !this.dom)?1:0;
	this.bw=(this.ie5 || this.ie4 || this.ns4 || this.ns5)
	return this
}
bw=new checkBrowser()
/***************************************************************************************
Variables to set:
***************************************************************************************/
messages=new Array()
//Write your descriptions in here.
messages[0]="Link ini berdasarkan entry data(tidak otomatis) karena sampai saat ini GL-link masih dalam proses pemeriksaan di Divisi KAI"
messages[1]="Text lain 1"
messages[2]="Text lain 2"
messages[3]="Text lain 3 !!"
messages[4]="To set the font size, font type, border color or remove the border or whatever"
//To have more descriptions just add to the array.

fromX=50 //How much from the actual mouse X should the description box appear?
fromY=-20////How much from the actual mouse Y should the description box appear?

//To set the font size, font type, border color or remove the border or whatever,
//change the clDescription class in the stylesheet.

//Makes crossbrowser object.
function makeObj(obj){								
   	this.css=bw.dom? document.getElementById(obj).style:bw.ie4?document.all[obj].style:bw.ns4?document.layers[obj]:0;	
   	this.wref=bw.dom? document.getElementById(obj):bw.ie4?document.all[obj]:bw.ns4?document.layers[obj].document:0;		
	this.writeIt=b_writeIt;																
	return this
}
function b_writeIt(text){if(bw.ns4){this.wref.write(text);this.wref.close()}
else this.wref.innerHTML=text}

//Capturing mousemove
var descx,descy;
function popmousemove(e){descx=bw.ns4?e.pageX:event.x; descy=bw.ns4?e.pageY:event.y}

//Initiates page
var isLoaded;
function popupInit(){
    oDesc=new makeObj('divDescription')
    if(bw.ns4)document.captureEvents(Event.MOUSEMOVE)
    document.onmousemove=popmousemove;
    isLoaded=true;
}	
//Shows the messages
function popup(num){
    if(isLoaded){
	oDesc.writeIt('<span class="clDescription">'+messages[num]+'</span>')
	if(bw.ie5) descy=descy+document.body.scrollTop
	oDesc.css.left=descx+fromX; oDesc.css.top=descy+fromY
	oDesc.css.visibility='visible'
    }
}
//Hides it
function popout(num){
	if(isLoaded) oDesc.css.visibility='hidden'
}

//initiates page on pageload.
onload=popupInit;
</SCRIPT>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body>
<a class="verdana10blu">
<b>MANAJEMEN INFORMASI</b>
<hr size="1">
<table border="0" width="100%" cellspacing="5" cellpadding="5">
<tr>
<td valign="top" width="50%" class="verdana10blk">

<ol style="color: #003366; font-family: Verdana; font-size: 10pt">
  <li><b>Informasi Proposal Masuk</b><ul type="disc" style="color: #2D2552">
    <li><a class="verdana10blk" href="infoproposalkantor.php">Melihat Proposal Masuk Per Kantor</a></li>
    <li><a class="verdana10blk" href="agenproposalkantor.php">Melihat Proposal Masuk Per Agen</a></li>
    <li><a class="verdana10blk" href="penagihproposalkantor.php">Melihat Proposal Masuk Per Penagih</a></li>
    <li><a class="verdana10blk" href="infoproposal.php">Evaluasi Proposal Masuk</a></li>
  </ul>
  </li>
	<li><b>Informasi Produksi Baru &amp; Yang Lalu</b><ul type="disc" style="color: #2D2552">
    <li><a class="verdana10blk" href="showendbillingkantor.php">Melihat Proses Produksi Bulan Berjalan kantor <? echo $kantor; ?></a></li>
    <li><a class="verdana10blk" href="oldproduksikantor.php">Melihat Proses Produksi Per Bulan kantor <? echo $kantor; ?></a></li>
    <li><a class="verdana10blk" href="produksitahunkantor.php">Melihat Proses Produksi Per Tahun kantor <? echo $kantor; ?></a></li>
    <li><a class="verdana10blk" href="hasilhariini.php">Hasil Premi BP3 (</font><font color="red">Berapa Hasil Anda ?</font><font color="#9d009d">)</font></a></li>
    <li><a class="verdana10blk" href="premiperkantor.php">Hasil Premi BP3 Hari Ini Per Kantor Perwakilan </a></li>
    <li><a class="verdana10blk" href="premipercabang.php">Hasil Premi BP3 Hari Ini Per Kantor Cabang</a></li>
		<li><a class="verdana10blk" href="hasilharimulas.php">Hasil Premi BP3 Hari Ini Berdasarkan Mulai Asuransi</a></li>
		<li><a class="verdana10blk" href="premiperproduk.php">Hasil Premi BP3 Hari Ini Per Produk</a></li>
		<DIV id=divDescription></DIV>
    <DIV id=divLinks>
		<li><a onmouseover=popup(0) onmouseout=popout(0) class="verdana10blk" href="hasilnb.php">Penerimaan Premi NB Per Polis dalam Kantor Perwakilan</a></li>
		<li><a onmouseover=popup(0) onmouseout=popout(0) class="verdana10blk" href="hasilnbperkantor.php">Penerimaan Premi NB Per Kantor Perwakilan</a></li>
		<li><a onmouseover=popup(0) onmouseout=popout(0) class="verdana10blk" href="hasilnbpercabang.php">Penerimaan Premi NB Per Kantor Cabang <font color="red"></font></a></li>
		<li><a onmouseover=popup(0) onmouseout=popout(0) class="verdana10blk" href="hasilob.php">Penerimaan Premi OB Per Polis dalam Kantor Perwakilan </a></li>
		<li><a onmouseover=popup(0) onmouseout=popout(0) class="verdana10blk" href="hasilobperkantor.php">Penerimaan Premi OB Per Kantor Perwakilan <font color="red"></font></a></li>
		<li><a onmouseover=popup(0) onmouseout=popout(0) class="verdana10blk" href="hasilobpercabang.php">Penerimaan Premi OB Per Kantor Cabang <font color="red"></font></a></li>
		</DIV> 
		</ul>
  </li>
  <li><b>Informasi Polis</b><ul type="disc" style="color: #2D2552">
	  <li><a class="verdana10blk" href="../proposal/peliharapolis.php">Melihat Polis Satuan / Kondite Polis Satuan</a></li>
    <li><a class="verdana10blk" style="color: #ff0000" href="../mbah/perbaiki.php?mode=1">Melihat Proposal / Polis (termasuk yang dari luar rayon)</a></li>
    <li><a class="verdana10blk" href="infopoliskantor.php">Melihat Polis Per Kantor</a></li>
		<li><a class="verdana10blk" href="infopolisnamamirip.php">Melihat Jumlah Polis dengan Nama Mirip</a></li>
    <li><a class="verdana10blk" href="infopolisklien.php">Melihat Jumlah Polis Klien</a></li>
    <li><a class="verdana10blk" href="agenpoliskantor.php">Melihat Jumlah Polis Agen</a></li>
    <li><a class="verdana10blk" href="penagihpoliskantor.php">Melihat Jumlah Polis Penagih</a></li>
  </ul>
  </li>

  <li><b>Informasi Penerimaan Premi</b><ul type="disc" style="color: #2D2552">
    <li><a class="verdana10blk" href="konditepoliskantorob.php">Melihat Kondite Polis/Pelunasan Premi OB PP Per Kantor</a></li>
    <li><a class="verdana10blk" href="konditepoliskantornb.php">Melihat Kondite Polis/Pelunasan Premi NB PP Per Kantor</a></li>
    <li><a class="verdana10blk" href="penagihkantor.php?jnspolis=OB">Melihat Kondite Polis/Pelunasan Premi OB PP Per Penagih</a></li>
    <li><a class="verdana10blk" href="penagihkantor.php?jnspolis=NB">Melihat Kondite Polis/Pelunasan Premi NB PP Per Penagih</a></li>
		<li><a class="verdana10blk" href="infotagihan.php">Melihat Premi Tagihan NB/OB</a></li>
  </ul>
  </li>
	



	</ol>
</td>
<td valign="top" width="50%" class="verdana10blk">
 
  <ol style="color: #003366; font-family: Verdana; font-size: 10pt">
	<li value="5"><b>Informasi Perubahan Pertanggungan</b>
	  <ul type="disc" style="color: #2D2552">
	  <li><a class="verdana10blk" href="tebushariini.php"><font color="#424bc1">Hayo... </font><font color="#9b3200">Siapa yang Tebus Hari Ini ?</font></a></li>
    <li><a class="verdana10blk" href="permintaantebus.php"><font color="#424bc1">Hayo... </font><font color="#9b3200">Siapa yang Mengajukan Proses Tebus Hari Ini ?</font></a></li>
    <li><a class="verdana10blk" href="info700.php">Gadai/Tebus/Pemulihan Per Kantor</a></li>
		<li><a class="verdana10blk" href="chgpert_agen.php">Gadai/Tebus/Pemulihan Per Agen</a></li>
    <li><a class="verdana10blk" href="polisbpokantor.php">Bebas Premi Otomatis (BPO) Per Kantor</a></li>
		<li><a class="verdana10blk" href="polisbpo_agen.php">Bebas Premi Otomatis (BPO) Per Agen</a></li>
    <!--
		<li>Gadai Otomatis Per Kantor</li>
    <li>Gadai Otomatis Per Agen</li>
    -->
		<li><a class="verdana10blk" href="infomutasipolis.php">Mutasi Rayon/Alamat Polis Keluar Kantor <? echo $kantor ?></a></li>
		<li><a class="verdana10blk" href="../mutasi/pindahanpolis.php">Mutasi Rayon/Alamat Polis Masuk Kantor <? echo $kantor ?></a></li>
		<li><a class="verdana10blk" href="xpirasiperproduk.php">Informasi Polis Expirasi per Produk</a></li>
	</ul>
  </li>
	
	<li><b>Informasi Jatuh Tempo</b><ul type="disc" style="color: #2D2552">
	 <li><a class="verdana10blk" href="premijatuhtempo.php">Melihat Jatuh Tempo Tagihan Per Kantor / Penagih</a></li>
   <li><a class="verdana10blk" href="klaimjatuhtempo.php">Melihat Jatuh Tempo Klaim Per Kantor / Penagih / Agen</a></li>
   <!--<li>Melihat Jatuh Tempo Pertanggungan Expirasi</li>-->
   </ul>
  </li>
  <li><b>Informasi Agency</b><ul type="disc" style="color: #2D2552">
	  <li><a class="verdana10blk" href="topagent.php">Top Agent</a></li>
		<li><a href="../polis/delagenpen.php">Drop Agen Duplikat</a></li>
   </ul>
  </li>
	<li><b>Informasi Collector</b><ul type="disc" style="color: #2D2552">
    <li><a class="verdana10blk" href="topcollector.php">Top Collector</a></li>
		<li><a href="../polis/delagenpen.php">Drop Collector Duplikat</a></li>    </ul>
  </li>
  <li><b>Informasi Performansi (Pendapatan &amp; Biaya)</b><ul type="disc" style="color: #2D2552">
    <!--<li>Performansi Kantor</li>-->
		<li><a class="verdana10blk" href="rekappolis.php">Rekapitulasi Penjualan Produk Asuransi Kantor <? echo $kantor." "; ?></a></li>
    <li><a class="verdana10blk" href="showuser.php">Laporan Perkembangan Produksi XL-iNdO per Kantor</a></li>
		</ul>
  </li>
  <li><b>Informasi Lainnya</b><ul type="disc" style="color: #2D2552">
    <li><a class="verdana10blk" href="emailterkirim.php">Pengiriman Email/proposal Sudah Menjadi Polis</a></li>
    <li><a class="verdana10blk" href="faqs.php">XL-iNdO FAQs (Frequently Asked Questions)</a></li>
    <li><a class="verdana10blk" href="listuser.php">Pendaftaran User XL-iNdO yang sudah dapat dipergunakan</a></li>
    <li><a class="verdana10blk" href="userslogin.php">Users XL-iNdO yang sedang Aktif</a></li>
		<li><a href="filedatakonversi.php">Informasi Pengiriman File Data Konversi</a></li>
		<li><a href="kwitansibillbook.php" style="color: #ff0000">Informasi Status Cetak Kwitansi</a></li>
  </ul>
  </li>
	<li><b>Daftar Portopolio (Hasil Konversi Data) Kantor <? echo $kantor; ?> </b><ul type="disc" style="color: #2D2552">
    <!--<li><a class="verdana10blk" href="../konversi/carinopolisbaru.php">Pencarian Nomor Polis Baru dari Polis Aplikasi Lama</li>-->
		<li><a class="verdana10blk" href="polisduplikat.php"><font color="red">Polis Duplikat Kantor Anda</font></a><img src="../img/new.gif"></li>
    <li><a class="verdana10blk" href="portopoliokantor.php?lihat=$lihat&start=1&end=200&page=1">Portopolio konversi data</a></li>
    <li><a class="verdana10blk" href="portopoliokantor_lost.php?lihat=$lihat&start=1&end=200&page=1">Data yang tidak ada di master</a></li>
		<li><a class="verdana10blk" href="portopoliokantoraktif.php">Data Aktif</a></li>
		<li><a class="verdana10blk" href="portopoliokantornonaktif.php">Data Non Aktif</a></li>
		<li><a class="verdana10blk" href="penagihpoliskonversi.php">Data Aktif Per Penagih</a></li>
		<li><a class="verdana10blk" href="agenpoliskonversi.php">Data Aktif Per Agen</a></li>
		<li><a class="verdana10blk" href="valutapoliskonversi.php">Data Aktif Per Valuta</a></li>
	</ul>
  </li>
	<!--
		<li><font class="verdana10blk"><b>Drop Agen / Penagih Duplikat</b>
		<ul type="disc">
		<li><font color="red"><a href="../polis/delagenpen.php">Drop Agen / Penagih Duplikat</a></li>
	</ul>
  </li>
	-->
</ol>
	</td>
</tr>
</table>
</a>
<hr size="1">
<a class="verdana10blk" href="../mnuutama.php">Menu Utama</a>

</body>
</html>
