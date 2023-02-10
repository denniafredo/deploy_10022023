<?php
include "../../includes/database.php"; 
include "../../includes/session.php"; 
include "../../includes/common.php";
$DB=new Database($userid, $passwd, $DBName);

include ("../../graph/jpgraph.php");
include ("../../graph/jpgraph_bar.php");

$nx = strlen($tglsearch);
if($nx==4){
	 $thn=$tglsearch;
	 $judul="Tahun $thn";
	 $cari="to_char(h.tglbayar,'YYYY')='$tglsearch' ";
} elseif($nx==6){
	 $bln=substr($tglsearch,0,2);
	 $thn=substr($tglsearch,-4);
	 $judul="$bln/$thn";
	 $cari="to_char(h.tglbayar,'MMYYYY')='$tglsearch' ";
} else {
	 $tgl=substr($tglsearch,0,2);
	 $bln=substr($tglsearch,2,2);
	 $thn=substr($tglsearch,-4);
	 $judul="$tgl/$bln/$thn";
	 $cari="to_char(h.tglbayar,'DDMMYYYY')='$tglsearch' ";
}

$sql = "select r.kdkantor,".
        	   "x.jmlpolis,".
						 "round(x.premirpn/1000000,2) as premirupiah  ".
        "from ".
        	   "(select k.kdkantorinduk,sum(h.nilairp) as premirpn,count(p.nopertanggungan) as jmlpolis  ".
        	   "from ".
        	   "$DBUser.tabel_300_historis_premi h,".
        	   "$DBUser.tabel_200_pertanggungan p,".
        	   "$DBUser.tabel_500_penagih j,".
        	   "$DBUser.tabel_001_kantor k  ".
        	   "where h.prefixpertanggungan=p.prefixpertanggungan and ".
        	   "h.nopertanggungan=p.nopertanggungan and j.nopenagih=p.nopenagih and k.kdkantor=j.kdrayonpenagih ".
        	   "and h.nilairp is not null and h.kdkuitansi like 'NB%' and ".
						 $cari." ".
						 "group by k.kdkantorinduk) x,".
        	   "$DBUser.tabel_001_kantor r ".
        "where ".
        	   "r.kdkantor=x.kdkantorinduk(+) and ".
        	   "r.kdjeniskantor='1' order by r.kdkantor";
				//echo $sql;
				$DB->parse($sql);
				$DB->execute();	
				$l1datay = array();
				$datay = array();
				$datax = array();
				while ($row = $DB->nextrow()) {
                $l1datay[] = $row["JMLPOLIS"];
								$datay[] = $row["PREMIRUPIAH"];
								$datax[]	 = $row["KDKANTOR"];
								
				}
				//$datay=array(12,8,19,3,10,5,2,14);

// Create the graph. These two calls are always required
$graph = new Graph(550,350,"auto");	
$graph->SetScale("textlin");

// Add a drop shadow
$graph->SetShadow();

// Adjust the margin a bit to make more room for titles
$graph->img->SetMargin(50,40,30,50);

// Create a bar pot
$bplot = new BarPlot($datay);

// Adjust fill color
$bplot->SetFillColor('#3399cc');
$bplot->value->Show();
$graph->Add($bplot);

// Setup the titles
$graph->title->Set("Pendapatan Premi Per RO $judul");
$graph->xaxis->title->Set("Regional Office");
$graph->yaxis->title->Set("Premi x 1.000.000 Rupiah");

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
//$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$graph->xaxis->SetTickLabels($datax);
// Display the graph
$graph->Stroke();

?>