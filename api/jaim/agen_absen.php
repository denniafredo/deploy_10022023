<?php
	/*
	* API file untuk aplikasi jaim
	* method untuk data ABSEN agen
	*/
	require_once 'includes/config.php';
	require_once 'includes/database.php';
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	$show_jam = null;
	if(isset($_GET['nomor_agen']) && $_GET['nomor_agen']!= ""){
		$nomor_agen = $_GET['nomor_agen'];
		
		
		$dtt = "";
		if(isset($_GET['tgl']) && isset($_GET['bln']) && isset($_GET['thn'])){
		$dtt = $_GET['tgl'].'/'.$_GET['bln'].'/'.$_GET['thn'];
		
			$sql = "  select * from view_400_agen_absen
						where nomor_agen = '$nomor_agen' and trunc(tanggal) = to_date('".$dtt."','dd/mm/yyyy')
					";
			
				$DB->parse($sql);
				$DB->execute();
	
				while($result = $DB->nextrow()) {
					$value[] = $result;
				};
			
				//echo $sql;
				//var_dump($value);
				
				foreach ($value as $key => $val){
					$show_jam = "
					<table border =1 cellspacing=0 cellpadding=2>
						<tr><td>TANGGAL</td><td>JAM MASUK</td><td>JAM KELUAR</td><td>KEHADIRAN (JAM)</td></tr>
						<tr><td>".$dtt."</td><td>".$val["JAM_MASUK"]."</td><td>".$val["JAM_KELUAR"]."</td><td>".$val["JAM_KEHADIRAN"]."</td></tr>
					</table>
					
					";
				
				}
				
				
		
		}
		
		
		
		
		
	} else {
		$nomor_agen = 'xxx';
	}
	

	
	
	
	$lang['January']   = "Januari";
	$lang['February']  = "Februari";
	$lang['March']     = "Maret";
	$lang['April']     = "April";
	$lang['May']       = "Mei";
	$lang['June']      = "Juni";
	$lang['July']      = "Juli";
	$lang['August']    = "Agustus";
	$lang['September'] = "September";
	$lang['October']   = "Oktober";
	$lang['November']  = "November";
	$lang['December']  = "Desember";
	
	//error_reporting(1);
		
	$p	= addslashes($p);
		
	$sql = " select to_char(JAM_MASUK,'hh24:mi:ss') JAM_MASUK from tabel_400_absen_agen where nomor_agen = '$nomor_agen' ";
		
	$DB->parse($sql);
	$DB->execute();
	
	while($result = $DB->nextrow()) {
		$value[] = $result;
	};

    function gmtdate($format, $gmepoch, $timezone)
    {
       return ( @gmdate($format, $gmepoch + (3600 * $timezone)));
    }
    if (isset($_GET['monthno']) )
    { 
      $monthno = $_GET['monthno']; 
    }
    elseif (!isset($monthno) )
    { 
      $monthno= gmtdate('n', time(), $timezone ); 
    }
    if (isset($_GET['year']) or isset($_GET['year']))
    {
      $year = $_GET['year']; 
    }
    elseif (!isset($year) )
    {
      $year = gmtdate('Y', time(), $timezone );  
    }
    
    $monthfulltext = date("F", mktime(0, 0, 0, $monthno, 1, $year));
    $day_in_mth = date("t", mktime(0, 0, 0, $monthno, 1, $year)) ;
	?>
	
	<head>
	</head>
	<body style="font-family:Tahoma;font-size:10pt;">
		<form name="frm1" action="<?=$PHP_SELF?>">ID Agen : <input type="text" name="nomor_agen" value="<?=$nomor_agen?>"></input><input type="submit" name="btSub" value="SUBMIT"></input>
		</form>
		<table style="max-width:800px;    border:solid navy 1px;background:#FFFFDA; border-spacing: 2px;
    border-collapse: separate;"  cellpadding="2" width="100%" cellspacing="0" style="border-collapse: collapse" bordercolor="#C0C0C0" id="AutoNumber1">

	<?	
	
	echo "<tr>";
	for ($a=0; $a<=31; $a++) 
	{
		if ($a==0)
		{
			$a=(strlen($a)==1 ? "0$a" : "$a");
			echo "<td align=center bgcolor=#ADCBF8 height=10 width=10><font size=1 face=Tahoma>$year</font></td>";
		}
		else
		{
			$a=(strlen($a)==1 ? "0$a" : "$a");
			echo "<td bgcolor=#ADCBF8 align=center height=10 width=10><font size=1 face=Tahoma>$a</font></td>";
		}
	} 
	echo "</tr>";
	
	
    for ($monthno = 1; $monthno <= 12; $monthno++) {
      $day_in_mth = date("t", mktime(0, 0, 0, $monthno, 1, $year)) ;
      $monthfulltext = date("F", mktime(0, 0, 0, $monthno, 1, $year));
    	echo "<tr>";
    	echo "<td bgcolor=#ADCBF8 align=left height=16 width=12><font size=1 face=Tahoma>".$lang["$monthfulltext"]."</font></td>";
    	for ($date_of_mth = 1; $date_of_mth <= $day_in_mth; $date_of_mth++) {
    
        $date_no = date("j", mktime(0, 0, 0, $monthno, $date_of_mth, $year));
        $day_of_wk = date("w", mktime(0, 0, 0, $monthno, $date_of_mth, $year));
        $currentdate = date("d/m/Y", mktime(0, 0, 0, $monthno, $date_of_mth, $year) );
    
    		$date_no = strlen($date_no)==1 ? "0$date_no" : "$date_no";
    		
			$sql = "
				 select nomor_agen
				 	,to_char(JAM_MASUK,'HH24:MI:SS') JAM_MASUKS
					,to_char(JAM_MASUK,'DD-MM-YYYY') TANGGAL_MASUK
				 from 
					tabel_400_absen_agen where 1=1
					and nomor_agen = '$nomor_agen'
					and trunc(jam_masuk) = to_date('$currentdate','DD/MM/YYYY')
			";
			//echo $sql;
			$DB->parse($sql);
			$DB->execute();
			
			$row1 = $DB->nextrow();
			
    		if(trim($row1['JAM_MASUKS'])=="")
    		{
				$event=0;
    		}
    		else
    		{
				$event=1;
    		}
    
        if ($event > 0 ){
					
				$sqlx = " select 
					nomor_agen
					,to_char(JAM_MASUK,'HH24:MI:SS') JAM_MASUKS
					,to_char(JAM_MASUK,'DD-MM-YYYY') TANGGAL_MASUK
				from tabel_400_absen_agen_libur where tgl_libur = to_date('$currentdate','DD/MM/YYYY' )  ";

			
				$DB->parse($sql);
				$DB->execute();
				
				$row = $DB->nextrow();
					
    			$alt = ${"ketlibur".$currentdate};
					
    			$linkdate = "<a href='".$_SERVER["PHP_SELF"]
					."?nomor_agen=".$nomor_agen
					."&tgl=".$date_of_mth
					."&bln=".$monthno
					."&thn=".$year
					."' style='color:white' alt='MASUK JAM: ".$row['JAM_MASUKS']."'>".$date_of_mth."</a>";
    		
    			if($row['kd_aspek']=="D-OFF") // libur masal
    			{
    			 $warnabg = "#D1B5A7";
    			}
    			else
    			{
    			 if($row['KATAGORI']=="LIBUR NASIONAL") // ada tapi gak lengkap
    			 {
    			   $warnabg = "#FF4F95";
    			 }
					 elseif($row['KATAGORI']=="LIBUR KHUSUS JIWASRAYA")
					 {
					   $warnabg = "#6fa8ff";
					 }
					 elseif($row['KATAGORI']=="LIBUR MASAL")
					 {
					   $warnabg = "#FF9933";
					 }
					 elseif($row['KATAGORI']=="LIBUR LOKAL")
					 {
					   $warnabg = "#669966";
					 }
    			 else
    			 {
    			   $warnabg = "#004f9d";//#cff2b0 //bolos
    			 }
    			}
    			
    		}
        else 
      	{ 
				$linkdate  = $date_no ; 
    			$warnabg = "#d9ebf4";
					
      	}

				// antisipasi jika ada hari libur sabtu atau minggi
				if($event==0)
				{
				    if  ($day_of_wk == 0) //minggu #f89aa4
          	{ 
        		  $warnabg = "#E8B7FF";
        			$alt 		 = "Minggu";
          		echo "<td align=center width=16 bgcolor=$warnabg><font color=#ffffff size=1 face=Tahoma>".$linkdate."</font></td>"; //hari minggu
          	}  
        		elseif($day_of_wk == 6) //sabtu #fecfd3
          	{ 
        		  $warnabg = "#E8B7FF";
          		$alt 		= "Sabtu";
        			echo "<td align=center width=16 bgcolor=$warnabg><font color=#ffffff size=1 face=Tahoma>".$linkdate."</font></td>"; //hari minggu
          	} 
          	else 
          	{ 
        			echo "<td align=center width=16 bgcolor=$warnabg><font color=#c0c0c0 size=1 face=Tahoma>".$linkdate."</font></td>";
          	}
				}
				else
				{
					 
            if  ($day_of_wk == 0) //minggu #f89aa4
          	{ 
        			$alt 		 = "Minggu";
          		echo "<td align=center width=16 bgcolor=$warnabg><font color=#ffffff size=1 face=Tahoma>".$linkdate."</font></td>"; //hari minggu
          	}  
        		elseif($day_of_wk == 6) //sabtu #fecfd3
          	{ 
          		 $alt 		= "Sabtu";
        			echo "<td align=center width=16 bgcolor=$warnabg><font color=#ffffff size=1 face=Tahoma>".$linkdate."</font></td>"; //hari minggu
          	} 
          	else 
          	{ 
        			echo "<td align=center width=16 bgcolor=$warnabg><font color=#c0c0c0 size=1 face=Tahoma>".$linkdate."</font></td>";
          	}
				}
				
      }
    echo "</tr>";
    }
    ?>
    </table>
	<br />
	<? echo $show_jam ?>
	</body>
	
	
	
	
	