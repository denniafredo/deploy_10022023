<?
    /* 
    ** Class: chainedSelectors 
    ** Description: This class allows you to create two selectors.  Selections 
    ** made in the first selector cause the second selector to be updated. 
    ** PHP is used to dynamically create the necessary JavaScript. 
    */ 
    //These constants make the code a bit more readable.  They should be 
    //used in in the creation of the input data arrays, too. 
    define("CS_FORM", 0); 
    define("CS_FIRST_SELECTOR", 1); 
    define("CS_SECOND_SELECTOR", 2); 
    define("CS_SOURCE_ID", 0); 
    define("CS_SOURCE_LABEL", 1); 
    define("CS_TARGET_ID", 2); 
    define("CS_TARGET_LABEL", 3); 
    class chainedSelectors 
    { 
        /* 
        ** Properties 
        */ 
        //Array of names for the form and the two selectors. 
        //Should take the form of array("myForm", "Selector1", "Selector2") 
        var $names;
        //Array of data used to fill the two selectors 
        var $data; 
        //Unique set of choices for the first selector, generated on init 
        var $uniqueChoices; 
        //Calculated counts 
        var $maxTargetChoices; 
        var $longestTargetChoice; 
				var $adds;
        /* 
        ** Methods 
        */ 
        //constructor 
        function chainedSelectors($names, $data ,$adds) 
        { 
            /* 
            **copy parameters into properties 
            */ 
            $this->names = $names; 
            $this->data = $data; 
						$this->adds = $adds;
						/* 
            ** traverse data, create uniqueChoices, get limits 
            */         
            foreach($data as $row) 
						//foreach($data as $row)
            { 
                //create list of unique choices for first selector 
                $this->uniqueChoices[($row[CS_SOURCE_ID])] = $row[CS_SOURCE_LABEL];     
								//echo $this->uniqueChoices[($row[CS_SOURCE_ID])];
                //find the maximum choices for target selector 
                $maxPerChoice[($row[CS_SOURCE_ID])]++; 
                //find longest value for target selector 
                if(strlen($row[CS_TARGET_LABEL]) > $this->longestTargetChoice) 
                { 
                    $this->longestTargetChoice=strlen($row[CS_TARGET_LABEL]); 
                } 
            } 
             
            $this->maxTargetChoices = max($maxPerChoice); 
        } 
        //prints the JavaScript function to update second selector 
        function printUpdateFunction() 
        { 
            /* 
            ** Create some variables to make the code 
            ** more readable. 
            */ 
            $sourceSelector = "document." . $this->names[CS_FORM] . "." .  
                $this->names[CS_FIRST_SELECTOR]; 
            $targetSelector = "document." . $this->names[CS_FORM] . "." .  
                $this->names[CS_SECOND_SELECTOR]; 
            /* 
            ** Start the function 
            */ 
            print("function update" .$this->names[CS_SECOND_SELECTOR] . "()\n"); 
            print("{\n"); 
            /* 
            ** Add code to clear out next selector 
            */ 
            print("\t//clear " . $this->names[CS_SECOND_SELECTOR] . "\n"); 
            print("\tfor(index=0; index < $this->maxTargetChoices; index++)\n"); 
            print("\t{\n"); 
						print("\t\t" . $targetSelector . ".options[index].text = '';\n"); 
            print("\t\t" . $targetSelector . ".options[index].value = '';\n"); 
						print("\t}\n\n"); 
            //print("\t" . $targetSelector . ".options[4].selected = true;\n\n"); 
            /* 
            ** Add code to find which was selected 
            */ 
            print("whichSelected = " . $sourceSelector . ".selectedIndex;\n"); 
            /* 
            ** Add giant "if" tree that puts values into target selector 
            ** based on which selection was made in source selector 
            */ 
  					//var_dump($this->data);						
            //loop over each value of this selector 
            foreach($this->uniqueChoices as $sourceValue=>$sourceLabel) 
            { 
							  print("\tif(" . $sourceSelector . 
                    ".options[whichSelected].value == " . 
              			"'$sourceValue')\n"); 
                print("\t{\n"); 
  					$a=0;					
						while ($this->adds[$a]["PRODUK"]<>''){
									$adi[$a]["VARIABEL"]=$this->adds[$a]["VARIABEL"];
									$adi[$a]["PRODUK"]=$this->adds[$a]["PRODUK"];
									$adi[$a]["USIA_LPP"]=$this->adds[$a]["USIA_LPP"];
									$adi[$a]["LAMA_MIN"]=$this->adds[$a]["LAMA_MIN"];
									$adi[$a]["LAMA_MAX"]=$this->adds[$a]["LAMA_MAX"];
								if ($adi[$a]["PRODUK"]==$sourceValue){
									 //echo $adi[$a]["PRODUK"]."|".$sourceValue."|".$adi[$a]["VARIABEL"].">".$adi[$a]["USIA_LPP"] .">" . $adi[$a]["LAMA_MIN"] . ">". $adi[$a]["LAMA_MAX"];		
									 //echo "\n";								 
												/********************************/
												//print("\t\tdocument.ntryprop.nosp.value = '" .$adi[$a]["PRODUK"]."|".$adi[$a]["VARIABEL"]."|".$adi[$a]["USIA_LPP"] ."|" . $adi[$a]["LAMA_MIN"] . "|". $adi[$a]["LAMA_MAX"] . "';\n");
												print("\t\tdocument.ntryprop.pariabel.value = '".$adi[$a]["VARIABEL"]."';\n");
												print("\t\tdocument.ntryprop.usia_lpp.value = '".$adi[$a]["USIA_LPP"]."';\n");
												print("\t\tdocument.ntryprop.lama_min.value = '".$adi[$a]["LAMA_MIN"]."';\n");
												print("\t\tdocument.ntryprop.lama_max.value = '".$adi[$a]["LAMA_MAX"]."';\n");									
												/********************************/
 							  }		
								$a++;										 						
						}
								$count=0; //pake diatas foreach di bawah																															
                foreach($this->data as $row) 
                { 
                    if($row[0] == $sourceValue) 
                    { 
                        $optionValue = $row[CS_TARGET_ID]; 
                        $optionLabel = $row[CS_TARGET_LABEL]; 
                        print("\t\t" . $targetSelector . 
                            ".options[$count].value = '$optionValue';\n"); 
                        print("\t\t" . $targetSelector . 
                            ".options[$count].text = '$optionLabel';\n\n"); 
                        $count++; 
                    } 
                } 
                print("\t}\n\n");
            } 
            print("\treturn true;\n"); 
            print("}\n\n"); 
				} 
			
        //print the two selectors 
        function printSelectors() 
        { 
            $selected=TRUE; 
            printf ("<tr><td>Kode Produk</td>");
    				echo	 "<td>:</td>";
    				echo	 "<td>";
						print("<select name=\"" . $this->names[CS_FIRST_SELECTOR] . "\" onfocus=\"highlight(event)\" title=\"Produk Asuransi\" " . 
                  "onChange=\"update".$this->names[CS_SECOND_SELECTOR]."();\">\n"); 
            foreach($this->uniqueChoices as $key=>$value) 
            { 
                print("\t<option value=\"$key\""); 
                if($selected) 
                { 
                    print(" selected=\"selected\""); 
                    $selected=FALSE; 
                } 
                print(">$value</option>\n"); 
            } 
            print("</select>");
						echo "&nbsp;<a href=\"popupprod.php\" onclick=\"NewWindow(this.href,'name','260','200','yes');return false\">";
		        echo "<img src=\"../img/jswindow.gif\" border=\"0\" alt=\"lihat produk\"></a>";
						echo "</tr>  \n"; 
            /* 
            **create empty target selector 
            */ 
            $dummyData = str_repeat("X", $this->longestTargetChoice); 
            printf ("<tr><td>Cara Bayar</td>".
    							 "<td>:</td>".
    							 "<td>");
            print("<select name=\"".$this->names[CS_SECOND_SELECTOR]."\" onfocus=\"highlight(event)\" onblur=\"ProdukValuta(this.form)\" >\n"); 
            for($i=0; $i < $this->maxTargetChoices; $i++) 
            { 
                print("\t<option value=\"\">$dummyData</option>\n"); 
            } 
            print("</select></tr>\n"); 
        } 
        //prints a call to the update function 
        function initialize() 
        { 
            print("update" .$this->names[CS_SECOND_SELECTOR] . "();\n"); 
        } 
/*----------------------------------------------------------------------------------------*/
        function selectCarabayar() {
            $sourceSelector = "document." . $this->names[CS_FORM] . "." .  
                $this->names[CS_FIRST_SELECTOR]; 
            $targetSelector = "document." . $this->names[CS_FORM] . "." .  
                $this->names[CS_SECOND_SELECTOR]; 
            print("function select" .$this->names[CS_SECOND_SELECTOR] . "()\n"); 
            print("{\n"); 
            /* 
            ** Add code to clear out next selector 
            */ 
            //loop over each value of this selector 
            foreach($this->uniqueChoices as $sourceValue=>$sourceLabel) 
            { 
                print("\tif (document.ntryprop.kdproduk.value=='$sourceValue') {\n"); 
                $coun=0;
                foreach($this->data as $rowq) 
                { 
                    if($rowq[0] == $sourceValue) 
                    { 
										$optionValue = $rowq[CS_TARGET_ID]; 
										  print( "\t\tif (document.ntryprop.cabar.value=='$optionValue') {\n" );											                    								
                        print("\t\t\t" . $targetSelector.".options[$coun].selected = true;\n");
											print("\t\t}\n");	
                        $coun++; 
                    } 
                } 
                print("\t}\n\n"); 
            } 
            print("\treturn true;\n"); 
            print("}\n\n"); 
				}		
/*----------------------------------------------------------------------------------------*/
    } 
?>
