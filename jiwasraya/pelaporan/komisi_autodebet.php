<?  
  include "../../includes/session.php";  
	include "../../includes/database.php";  
  include "../../includes/common.php";
	include "../../includes/pertanggungan.php";	
	include "../../includes/komisiagen.php";
		$DB=new Database($userid, $passwd, $DBName);	
		
   $sql="select ".
           "b.prefixpertanggungan,b.nopertanggungan,".
           "to_number(a.jumlahtagihan)/100 as jmlpremi ".
        "from ".
        	 "$DBUser.tabel_200_pertanggungan b,".
        	 "$DBUser.tabel_315_pelunasan_auto_debet a,".
        	 "$DBUser.tabel_500_penagih c ".
        "where ".
        	  "a.nopolis=b.nopol and ".
        	  "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='1' and ".
        	  "to_char(a.tglupdated,'MMYYYY')='122005' and c.kdrayonpenagih='AE' ";
   $DB->parse($sql);
	 $DB->execute();
	 
	 echo "Komisi penutupan autodebet :<br />";
	 while ($arr=$DB->nextrow()) {
	 $KAG=new KomisiAgen($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
	   	echo $arr["PREFIXPERTANGGUNGAN"]." | ".$arr["NOPERTANGGUNGAN"]." | ".
					 "". $arr["JMLPREMI"]." | ".$KAG->jmlkomisiagen."<BR />";					
	 }
 ?>