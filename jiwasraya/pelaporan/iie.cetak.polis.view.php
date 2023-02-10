<?php

/*
	Title		: perubahan metoda cetak polis
	Author		: Iie Sumitra
	Libs Req.	: FlexPaper, SWFTools, Fpdf153
	Date		: 09 March 2012
*/

define("DIR_TEMP", "../libs/SWFTools/temp");
define("PDFTOSWF", "../libs/SWFTools");
define("HREF_FLEXVIEWER", "../libs/flaxviewer");
define("HREF_SWFFILE", base64_decode($_GET['do']));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">	
    <head> 
        <title></title>         
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <style type="text/css" media="screen"> 
			html, body	{ height:100%; }
			body { margin:0; padding:0; overflow:auto; }   
			#flashContent { display:none; }
        </style> 
		
		<script type="text/javascript" src="<?=HREF_FLEXVIEWER?>/js/swfobject/swfobject.js"></script>
		<script type="text/javascript" src="<?=HREF_FLEXVIEWER?>/js/flexpaper_flash.js"></script>
		
        <script type="text/javascript"> 
            <!-- For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. --> 
            var swfVersionStr = "9.0.124";
            <!-- To use express install, set to playerProductInstall.swf, otherwise the empty string. -->
            var xiSwfUrlStr = "${expressInstallSwf}";
            var flashvars = { 
                  SwfFile : escape("<?=HREF_SWFFILE?>?v1.4.0final"),
				  Scale : 0.8, 
				  ZoomTransition : "easeOut",
				  ZoomTime : 0.5,
  				  ZoomInterval : 0.1,
  				  FitPageOnLoad : true,
  				  FitWidthOnLoad : true,
  				  
  				  FullScreenAsMaxWindow : false,
				  ProgressiveLoading : true,

					  PrintEnabled : true,
					  PrintToolsVisible : true,

						 				  
				 
  				  ViewModeToolsVisible : true,
  				  ZoomToolsVisible : true,
  				  FullScreenVisible : true,
  				  NavToolsVisible : true,
  				  CursorToolsVisible : true,
  				  SearchToolsVisible : true,
  				  
  				  localeChain: "en_US"
				  };
			

			

		
			 var params = {
				
			    }
            params.quality = "high";
            params.bgcolor = "#ffffff";
            params.allowscriptaccess = "sameDomain";
            params.allowfullscreen = "true";
            var attributes = {};
            attributes.id = "FlexPaperViewer";
            attributes.name = "FlexPaperViewer";
            swfobject.embedSWF(
                "<?=HREF_FLEXVIEWER?>/FlexPaperViewer.swf", "flashContent", 
                "940", "540", 
                swfVersionStr, xiSwfUrlStr, 
                flashvars, params, attributes);
			swfobject.createCSS("#flashContent", "display:block;text-align:left;");
        </script> 
        
    </head> 
    <body> 
    	<div style="position:absolute;left:10px;top:10px;">
	        <div id="flashContent"> 
	        	 <p> 
		        	To view this page ensure that Adobe Flash Player version 
					9.0.124 or greater is installed. 
				</p> 
				<!--
				<script type="text/javascript"> 
					var pageHost = ((document.location.protocol == "https:") ? "https://" :	"http://"); 
					document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='" 
									+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" ); 
				</script>  -->
	        </div>
        </div>
   </body> 
</html> 


<?php

?>




 
