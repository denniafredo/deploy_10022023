<?php
 function DateSelector($inName, $useDate=0) 
  { 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  				$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n"); 

					/*echo "<option value=05>05</option>";
					echo "<option value=15>15</option>";
					echo "<option value=25>25</option>";*/
          //for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          //{ 
		  /*		$currentDay=05;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 
			  $currentDay=15;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 	
			  $currentDay=25;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 							
          //} 

          print("</select>"); */
		  for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          { 
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 						
          } 
          print("</select>"); 

  
     // Bulan	
  		$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);			
          print("<select name=" . $inName .  "bln>\n"); 
          for($currentMonth = 1; $currentMonth <= 12;$currentMonth++) 
          { 
              switch($currentMonth)
              {
                case '1' : $namabulan ="JANUARI"; break ;
                case '2' : $namabulan ="FEBRUARI"; break ;
                case '3' : $namabulan ="MARET"; break ;
                case '4' : $namabulan ="APRIL"; break ;
                case '5' : $namabulan ="MEI"; break ;
                case '6' : $namabulan ="JUNI"; break ;
                case '7' : $namabulan ="JULI"; break ;
                case '8' : $namabulan ="AGUSTUS"; break ;
                case '9' : $namabulan ="SEPTEMBER"; break ;
                case '10' : $namabulan ="OKTOBER"; break ;
                case '11' : $namabulan ="NOVEMBER"; break ;
                case '12' : $namabulan ="DESEMBER"; break ;
              }
  						
              print("<option value=\"$currentMonth\""); 
  						if($selected==$currentMonth) 
              { 
                  print(" selected"); 
              } 					
              print(">$namabulan\n"); 						
          } 
          print("</select>"); 
  
  		// Tahun				
  		$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
          print("<select name=" . $inName .  "thn>\n"); 
          $startYear = date( "Y", $useDate); 
          for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
          { 
              print("<option value=\"$currentYear\""); 
              if($selected==$currentYear) 
              { 
                  print(" selected"); 
              } 
              print(">$currentYear\n"); 
  						
          } 
  				print("</select>"); 
  }
  
  ?>