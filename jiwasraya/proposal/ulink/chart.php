<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CSS Vertical Bar Graphs</title>
<?
 include "./includes/database.php";
//include "./includes/session.php";
	
 $DB1 = New Database('ckadm','ckadm',"CKINDO");
 $DB = New Database('jsadm','JSDB',"JSDB");
 ?>
    
<style type="text/css"> 
 
#q-graph {position: relative; width: 600px; height: 300px;
  margin: 1.1em 0 3.5em; padding: 0;
  
  border: 2px solid gray; list-style: none;
  font: 9px Helvetica, Geneva, sans-serif;}
#q-graph ul {margin: 0; padding: 0; list-style: none;}
#q-graph li {position: absolute; bottom: 0; width: 150px; z-index: 2;
  margin: 0; padding: 0;
  text-align: center; list-style: none;}
#q-graph li.qtr {height: 298px; padding-top: 2px;
  border-right: 1px dotted #C4C4C4; color: #AAA;}
#q-graph li.bar {width: 60px; border: 1px solid; border-bottom: none; color: #000;}
#q-graph li.bar p {margin: 5px 0 0; padding: 0;}
#q-graph li.sent {left: 13px; background: #DCA url(fade-dark.png) repeat-x;
  border-color: #EDC #BA9 #000 #EDC;}
#q-graph li.paid {left: 77px; background: #9D9 url(fade-dark.png) repeat-x;
  border-color: #CDC #9B9 #000 #BFB;}
#q-graph #q1 {left: 0;}
#q-graph #q2 {left: 150px;}
#q-graph #q3 {left: 300px;}
#q-graph #q4 {left: 450px; border-right: none;}
 
#q-graph #ticks {width: 600px; height: 300px; z-index: 1;}
#q-graph #ticks .tick {position: relative; border-bottom: 1px solid #BBB; width: 600px;}
#q-graph #ticks .tick p {position: absolute; left: 100%; top: -0.67em; margin: 0 0 0 0.5em;}
</style>
</head>
<body>


<ul id="q-graph">
 <?
	$sql="select sum(kredit)/1000000 JML, round(sum(kredit)/10000000) xx from ckadm.TABEL_802_TRVOUC
			where kdtrans='20130304' AND AKUN='241110000' and debet=0";
			//group by kdkantor";
	$DB1->parse($sql);
	$DB1->execute();
	//echo $sql;
	$i=0;
	$arr1=$DB1->nextrow();
	
	$sql="select sum(nilaipembayaran)/1000000 JML, round(sum(nilaipembayaran)/10000000) xx from tabel_800_pembayaran@JSDB_USED
			where kdpembayaran='001' and
			to_char(tglseatled,'ddmmyyyy')='04032013'";
			//group by kdkantor";
	$DB->parse($sql);
	$DB->execute();
	//echo $sql;
	$i=0;
	$arr=$DB->nextrow(); //{
	//echo $arr["KDKANTOR"];
	echo "<li class=\"qtr\" id=\"q".$i."\">".$arr["KDKANTOR"];
	echo "<ul>";
	echo "<li class=\"sent bar\" style=\"height: ".$arr["XX"]."px;\"><p>".number_format($arr["JML"],2,',','.')."</p></li>";
	echo "<li class=\"paid bar\" style=\"height: ".$arr1["XX"]."px;\"><p>".number_format($arr1["JML"],2,',','.')."</li>";
	echo "</ul>";
	echo "</li>";
	//$i++;
	//}
?>

<!--<li class="qtr" id="q1">Q1
<ul>
<li class="sent bar" style="height: 200px;"><p>$18,450.00</p></li>
<li class="paid bar" style="height: 99px;"><p>$16,500.00</p></li>
</ul>
</li>
 
<li class="qtr" id="q2">Q2
<ul>
<li class="sent bar" style="height: 206px;"><p>$34,340.72</p></li>
<li class="paid bar" style="height: 194px;"><p>$32,340.72</p></li>
</ul>
</li>
 
<li class="qtr" id="q3">Q3
<ul>
<li class="sent bar" style="height: 259px;"><p>$43,145.52</p></li>
<li class="paid bar" style="height: 193px;"><p>$32,225.52</p></li>
</ul>
</li>
 
<li class="qtr" id="q4">Q4
<ul>
<li class="sent bar" style="height: 110px;"><p>$18,415.96</p></li>
<li class="paid bar" style="height: 195px;"><p>$32,425.00</p></li>
</ul>
</li>-->
 
<li id="ticks">
<div class="tick" style="height: 59px;"><p>5.000</p></div>
<div class="tick" style="height: 59px;"><p>4.000</p></div>
<div class="tick" style="height: 59px;"><p>3.000</p></div>
<div class="tick" style="height: 59px;"><p>2.000</p></div>
<div class="tick" style="height: 59px;"><p>1.000</p></div>
</li>
 
</ul>


 
</body>
</html>

