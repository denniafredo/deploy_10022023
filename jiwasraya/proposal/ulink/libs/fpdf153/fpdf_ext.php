<?
////////////////////////////////////////////////////////////////////////
//Based on HTML2PDF by Clément Lavoillotte
include_once(WD_DIR_PATH_PDFLIB.SLASH."fpdf.php");

	//function hex2dec
	//returns an associative array (keys: R,G,B) from
	//a hex html code (e.g. #3FE5AA)
	function hex2dec($couleur = "#000000")
	{
	    $R = substr($couleur, 1, 2);
	    $rouge = hexdec($R);
	    $V = substr($couleur, 3, 2);
	    $vert = hexdec($V);
	    $B = substr($couleur, 5, 2);
	    $bleu = hexdec($B);
	    $tbl_couleur = array();
	    $tbl_couleur['R']=$rouge;
	    $tbl_couleur['G']=$vert;
	    $tbl_couleur['B']=$bleu;
	    return $tbl_couleur;
	}
	
	//conversion pixel -> millimeter in 72 dpi
	function px2mm($px)
	{
	    return $px*25.4/72;
	}
	
	function txtentities($html)
	{
	    $trans = get_html_translation_table(HTML_ENTITIES);
	    $trans = array_flip($trans);
	    return strtr($html, $trans);
	}
////////////////////////////////////////////////////////////////////////


class PDF extends FPDF
{
	//variables of html parser
	var $B;
	var $I;
	var $U;
	var $HREF;
	var $fontList;
	var $issetfont;
	var $issetcolor;
	
	# EXTENDED 1
	function PDF($orientation='P',$unit='mm',$format='A4')
	{
	    //Call parent constructor
	    $this->FPDF($orientation,$unit,$format);
	    //Initialization
	    $this->B=0;
	    $this->I=0;
	    $this->U=0;
	    $this->HREF='';
	
	    $this->tableborder=0;
	    $this->tdbegin=false;
	    $this->tdwidth=0;
	    $this->tdheight=0;
	    $this->tdalign="L";
	    $this->tdbgcolor=false;
	
	    $this->oldx=0;
	    $this->oldy=0;
	
	    $this->fontlist=array("arial","times","courier","helvetica","symbol");
	    $this->issetfont=false;
	    $this->issetcolor=false;
	}
	
	//////////////////////////////////////
	//html parser
	
	function WriteHTML($html)
	{
	    $html=strip_tags($html,"<b><u><i><a><img><p><br><strong><em><font><tr><blockquote><hr><td><tr><table><sup>"); //remove all unsupported tags
	    $html=str_replace("\n",'',$html); //replace carriage returns by spaces
	    $html=str_replace("\t",'',$html); //replace carriage returns by spaces
	    $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //explodes the string
	    foreach($a as $i=>$e)
	    {
	        if($i%2==0)
	        {
	            //Text
	            if($this->HREF)
	                $this->PutLink($this->HREF,$e);
	            elseif($this->tdbegin) {
	                if(trim($e)!='' and $e!="&nbsp;") {
	                    $this->Cell($this->tdwidth,$this->tdheight,$e,$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
	                }
	                elseif($e=="&nbsp;") {
	                    $this->Cell($this->tdwidth,$this->tdheight,'',$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
	                }
	            }
	            else
	                $this->Write(5,stripslashes(txtentities($e)));
	        }
	        else
	        {
	            //Tag
	            if($e{0}=='/')
	                $this->CloseTag(strtoupper(substr($e,1)));
	            else
	            {
	                //Extract attributes
	                $a2=explode(' ',$e);
	                $tag=strtoupper(array_shift($a2));
	                @$attr=array();
	                foreach($a2 as $v)
	                    if(ereg('^([^=]*)=["\']?([^"\']*)["\']?$',$v,$a3))
	                        @$attr[strtoupper($a3[1])]=$a3[2];
	                $this->OpenTag($tag,@$attr);
	            }
	        }
	    }
	}
	
	function OpenTag($tag,$attr)
	{
	    //Opening tag
	    switch($tag){
	
	        case 'SUP':
	            if(@$attr['SUP'] != '') {    
	                //Set current font to: Bold, 6pt     
	                $this->SetFont('','',6);
	                //Start 125cm plus width of cell to the right of left margin         
	                //Superscript "1"
	                $this->Cell(2,2,@$attr['SUP'],0,0,'L');
	            }
	            break;
	
	        case 'TABLE': // TABLE-BEGIN
	            if( @$attr['BORDER'] != '' ) $this->tableborder=@$attr['BORDER'];
	            else $this->tableborder=0;
	            break;
	        case 'TR': //TR-BEGIN
	            break;
	        case 'TD': // TD-BEGIN
	            if( @$attr['WIDTH'] != '' ) $this->tdwidth=(@$attr['WIDTH']/4);
	            else $this->tdwidth=40; // SET to your own width if you need bigger fixed cells
	            if( @$attr['HEIGHT'] != '') $this->tdheight=(@$attr['HEIGHT']/6);
	            else $this->tdheight=6; // SET to your own height if you need bigger fixed cells
	            if( @$attr['ALIGN'] != '' ) {
	                $align=@$attr['ALIGN'];        
	                if($align=="LEFT") $this->tdalign="L";
	                if($align=="CENTER") $this->tdalign="C";
	                if($align=="RIGHT") $this->tdalign="R";
	            }
	            else $this->tdalign="L"; // SET to your own
	            if( @$attr['BGCOLOR'] != '' ) {
	                $coul=hex2dec(@$attr['BGCOLOR']);
	                    $this->SetFillColor($coul['R'],$coul['G'],$coul['B']);
	                    $this->tdbgcolor=true;
	                }
	            $this->tdbegin=true;
	            break;
	
	        case 'HR':
	            if( @$attr['WIDTH'] != '' )
	                $Width = @$attr['WIDTH'];
	            else
	                $Width = $this->w - $this->lMargin-$this->rMargin;
	            $x = $this->GetX();
	            $y = $this->GetY();
	            $this->SetLineWidth(0.2);
	            $this->Line($x,$y,$x+$Width,$y);
	            $this->SetLineWidth(0.2);
	            $this->Ln(1);
	            break;
	        case 'STRONG':
	            $this->SetStyle('B',true);
	            break;
	        case 'EM':
	            $this->SetStyle('I',true);
	            break;
	        case 'B':
	        case 'I':
	        case 'U':
	            $this->SetStyle($tag,true);
	            break;
	        case 'A':
	            $this->HREF=@$attr['HREF'];
	            break;
	        case 'IMG':
	            if(isset($attr['SRC']) and (isset($attr['WIDTH']) or isset($attr['HEIGHT']))) {
	                if(!isset($attr['WIDTH']))
	                    @$attr['WIDTH'] = 0;
	                if(!isset($attr['HEIGHT']))
	                    @$attr['HEIGHT'] = 0;
	                $this->Image(@$attr['SRC'], $this->GetX(), $this->GetY(), px2mm(@$attr['WIDTH']), px2mm(@$attr['HEIGHT']));
	            }
	            break;
	        //case 'TR':
	        case 'BLOCKQUOTE':
	        case 'BR':
	            $this->Ln(5);
	            break;
	        case 'P':
	            $this->Ln(10);
	            break;
	        case 'FONT':
	            if (isset($attr['COLOR']) and @$attr['COLOR']!='') {
	                $coul=hex2dec(@$attr['COLOR']);
	                $this->SetTextColor($coul['R'],$coul['G'],$coul['B']);
	                $this->issetcolor=true;
	            }
	            if (isset($attr['FACE']) and in_array(strtolower(@$attr['FACE']), $this->fontlist)) {
	                $this->SetFont(strtolower(@$attr['FACE']));
	                $this->issetfont=true;
	            }
	            if (isset($attr['FACE']) and in_array(strtolower(@$attr['FACE']), $this->fontlist) and isset($attr['SIZE']) and @$attr['SIZE']!='') {
	                $this->SetFont(strtolower(@$attr['FACE']),'',@$attr['SIZE']);
	                $this->issetfont=true;
	            }
	            break;
	    }
	}
	
	function CloseTag($tag)
	{
	    //Closing tag
	    if($tag=='SUP') {
	    }
	
	    if($tag=='TD') { // TD-END
	        $this->tdbegin=false;
	        $this->tdwidth=0;
	        $this->tdheight=0;
	        $this->tdalign="L";
	        $this->tdbgcolor=false;
	    }
	    if($tag=='TR') { // TR-END
	        $this->Ln();
	    }
	    if($tag=='TABLE') { // TABLE-END
	        //$this->Ln();
	        $this->tableborder=0;
	    }
	
	    if($tag=='STRONG')
	        $tag='B';
	    if($tag=='EM')
	        $tag='I';
	    if($tag=='B' or $tag=='I' or $tag=='U')
	        $this->SetStyle($tag,false);
	    if($tag=='A')
	        $this->HREF='';
	    if($tag=='FONT'){
	        if ($this->issetcolor==true) {
	            $this->SetTextColor(0);
	        }
	        if ($this->issetfont) {
	            $this->SetFont('arial');
	            $this->issetfont=false;
	        }
	    }
	}
	
	function SetStyle($tag,$enable)
	{
	    //Modify style and select corresponding font
	    $this->$tag+=($enable ? 1 : -1);
	    $style='';
	    foreach(array('B','I','U') as $s)
	        if($this->$s>0)
	            $style.=$s;
	    $this->SetFont('',$style);
	}
	
	function PutLink($URL,$txt)
	{
	    //Put a hyperlink
	    $this->SetTextColor(0,0,255);
	    $this->SetStyle('U',true);
	    $this->Write(5,$txt,$URL);
	    $this->SetStyle('U',false);
	    $this->SetTextColor(0);
	}
	# EXTENDED 1 (END)
	
	# Maaf, untuk sementara fungsi ImageGIF masih dalam taraf beta!
	# EXTENDED 2
	function ImageGIF ( $file, $x, $y, $w=0, $h=0, $type='', $link='')
	{
		// aus dem GIF ein PNG machen
		$im = ImageCreateFromGIF( $file );
		$bb = imagesx($im);
		$hh = imagesy($im);
	
		// temporer speichern
		ImagePNG($im, '$$$.png');
		ImageDestroy($im);
	
		$this->Image( '$$$.png', $x, $y, $w, $h, $type, $link);
		unlink('$$$.png');
	}
	# EXTENDED 2 (END)
	
	# EXTENDED 3
	function VCell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0)
	{
	    //Output a cell
	    $k=$this->k;
	    if($this->y+$h>$this->PageBreakTrigger and !$this->InFooter and $this->AcceptPageBreak())
	    {
	        $x=$this->x;
	        $ws=$this->ws;
	        if($ws>0)
	        {
	            $this->ws=0;
	            $this->_out('0 Tw');
	        }
	        $this->AddPage($this->CurOrientation);
	        $this->x=$x;
	        if($ws>0)
	        {
	            $this->ws=$ws;
	            $this->_out(sprintf('%.3f Tw',$ws*$k));
	        }
	    }
	    if($w==0)
	        $w=$this->w-$this->rMargin-$this->x;
	    $s='';
	// begin change Cell function
	    if($fill==1 or $border>0)
	    {
	        if($fill==1)
	            $op=($border>0) ? 'B' : 'f';
	        else
	            $op='S';
	        if ($border>1) {
	            $s=sprintf(' q %.2f w %.2f %.2f %.2f %.2f re %s Q ',$border,
	                        $this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
	        }
	        else
	            $s=sprintf('%.2f %.2f %.2f %.2f re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
	    }
	    if(is_string($border))
	    {
	        $x=$this->x;
	        $y=$this->y;
	        if(is_int(strpos($border,'L')))
	            $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
	        else if(is_int(strpos($border,'l')))
	            $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
	            
	        if(is_int(strpos($border,'T')))
	            $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
	        else if(is_int(strpos($border,'t')))
	            $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
	        
	        if(is_int(strpos($border,'R')))
	            $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	        else if(is_int(strpos($border,'r')))
	            $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	        
	        if(is_int(strpos($border,'B')))
	            $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	        else if(is_int(strpos($border,'b')))
	            $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	    }
	    if(trim($txt)!='')
	    {
	        $cr=substr_count($txt,"\n");
	        if ($cr>0) { // Multi line
	            $txts = explode("\n", $txt);
	            $lines = count($txts);
	            for($l=0;$l<$lines;$l++) {
	                $txt=$txts[$l];
	                $w_txt=$this->GetStringWidth($txt);
	                if ($align=='U')
	                    $dy=$this->cMargin+$w_txt;
	                elseif($align=='D')
	                    $dy=$h-$this->cMargin;
	                else
	                    $dy=($h+$w_txt)/2;
	                $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
	                if($this->ColorFlag)
	                    $s.='q '.$this->TextColor.' ';
	                $s.=sprintf('BT 0 1 -1 0 %.2f %.2f Tm (%s) Tj ET ',
	                    ($this->x+.5*$w+(.7+$l-$lines/2)*$this->FontSize)*$k,
	                    ($this->h-($this->y+$dy))*$k,$txt);
	                if($this->ColorFlag)
	                    $s.=' Q ';
	            }
	        }
	        else { // Single line
	            $w_txt=$this->GetStringWidth($txt);
	            $Tz=100;
	            if ($w_txt>$h-2*$this->cMargin) {
	                $Tz=($h-2*$this->cMargin)/$w_txt*100;
	                $w_txt=$h-2*$this->cMargin;
	            }
	            if ($align=='U')
	                $dy=$this->cMargin+$w_txt;
	            elseif($align=='D')
	                $dy=$h-$this->cMargin;
	            else
	                $dy=($h+$w_txt)/2;
	            $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
	            if($this->ColorFlag)
	                $s.='q '.$this->TextColor.' ';
	            $s.=sprintf('q BT 0 1 -1 0 %.2f %.2f Tm %.2f Tz (%s) Tj ET Q ',
	                        ($this->x+.5*$w+.3*$this->FontSize)*$k,
	                        ($this->h-($this->y+$dy))*$k,$Tz,$txt);
	            if($this->ColorFlag)
	                $s.=' Q ';
	        }
	    }
	// end change Cell function
	    if($s)
	        $this->_out($s);
	    $this->lasth=$h;
	    if($ln>0)
	    {
	        //Go to next line
	        $this->y+=$h;
	        if($ln==1)
	            $this->x=$this->lMargin;
	    }
	    else
	        $this->x+=$w;
	}
	
	function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
	{
	    //Output a cell
	    $k=$this->k;
	    if($this->y+$h>$this->PageBreakTrigger and !$this->InFooter and $this->AcceptPageBreak())
	    {
	        $x=$this->x;
	        $ws=$this->ws;
	        if($ws>0)
	        {
	            $this->ws=0;
	            $this->_out('0 Tw');
	        }
	        $this->AddPage($this->CurOrientation);
	        $this->x=$x;
	        if($ws>0)
	        {
	            $this->ws=$ws;
	            $this->_out(sprintf('%.3f Tw',$ws*$k));
	        }
	    }
	    if($w==0)
	        $w=$this->w-$this->rMargin-$this->x;
	    $s='';
	// begin change Cell function 12.08.2003
	    if($fill==1 or $border>0)
	    {
	        if($fill==1)
	            $op=($border>0) ? 'B' : 'f';
	        else
	            $op='S';
	        if ($border>1) {
	            $s=sprintf(' q %.2f w %.2f %.2f %.2f %.2f re %s Q ',$border,
	                $this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
	        }
	        else
	            $s=sprintf('%.2f %.2f %.2f %.2f re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
	    }
	    if(is_string($border))
	    {
	        $x=$this->x;
	        $y=$this->y;
	        if(is_int(strpos($border,'L')))
	            $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
	        else if(is_int(strpos($border,'l')))
	            $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
	            
	        if(is_int(strpos($border,'T')))
	            $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
	        else if(is_int(strpos($border,'t')))
	            $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
	        
	        if(is_int(strpos($border,'R')))
	            $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	        else if(is_int(strpos($border,'r')))
	            $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	        
	        if(is_int(strpos($border,'B')))
	            $s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	        else if(is_int(strpos($border,'b')))
	            $s.=sprintf('q 2 w %.2f %.2f m %.2f %.2f l S Q ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	    }
	    if (trim($txt)!='') {
	        $cr=substr_count($txt,"\n");
	        if ($cr>0) { // Multi line
	            $txts = explode("\n", $txt);
	            $lines = count($txts);
	            //$dy=($h-2*$this->cMargin)/$lines;
	            for($l=0;$l<$lines;$l++) {
	                $txt=$txts[$l];
	                $w_txt=$this->GetStringWidth($txt);
	                if($align=='R')
	                    $dx=$w-$w_txt-$this->cMargin;
	                elseif($align=='C')
	                    $dx=($w-$w_txt)/2;
	                else
	                    $dx=$this->cMargin;
	
	                $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
	                if($this->ColorFlag)
	                    $s.='q '.$this->TextColor.' ';
	                $s.=sprintf('BT %.2f %.2f Td (%s) Tj ET ',
	                    ($this->x+$dx)*$k,
	                    ($this->h-($this->y+.5*$h+(.7+$l-$lines/2)*$this->FontSize))*$k,
	                    $txt);
	                if($this->underline)
	                    $s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
	                if($this->ColorFlag)
	                    $s.=' Q ';
	                if($link)
	                    $this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$w_txt,$this->FontSize,$link);
	            }
	        }
	        else { // Single line
	            $w_txt=$this->GetStringWidth($txt);
	            $Tz=100;
	            if ($w_txt>$w-2*$this->cMargin) { // Need compression
	                $Tz=($w-2*$this->cMargin)/$w_txt*100;
	                $w_txt=$w-2*$this->cMargin;
	            }
	            if($align=='R')
	                $dx=$w-$w_txt-$this->cMargin;
	            elseif($align=='C')
	                $dx=($w-$w_txt)/2;
	            else
	                $dx=$this->cMargin;
	            $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
	            if($this->ColorFlag)
	                $s.='q '.$this->TextColor.' ';
	            $s.=sprintf('q BT %.2f %.2f Td %.2f Tz (%s) Tj ET Q ',
	                        ($this->x+$dx)*$k,
	                        ($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k,
	                        $Tz,$txt);
	            if($this->underline)
	                $s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
	            if($this->ColorFlag)
	                $s.=' Q ';
	            if($link)
	                $this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$w_txt,$this->FontSize,$link);
	        }
	    }
	// end change Cell function 12.08.2003
	    if($s)
	        $this->_out($s);
	    $this->lasth=$h;
	    if($ln>0)
	    {
	        //Go to next line
	        $this->y+=$h;
	        if($ln==1)
	            $this->x=$this->lMargin;
	    }
	    else
	        $this->x+=$w;
	}
	# EXTENDED 3 (END)

	# EXTENDED 4
	function WordWrap(&$text, $maxwidth)
	{
	    $text = trim($text);
	    if ($text==='')
	        return 0;
	    $space = $this->GetStringWidth(' ');
	    $lines = explode("\n", $text);
	    $text = '';
	    $count = 0;
	
	    foreach ($lines as $line)
	    {
	        $words = preg_split('/ +/', $line);
	        $width = 0;
	
	        foreach ($words as $word)
	        {
	            $wordwidth = $this->GetStringWidth($word);
	            if ($wordwidth > $maxwidth)
	            {
	                // Word is too long, we cut it
	                for($i=0; $i<strlen($word); $i++)
	                {
	                    $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
	                    if($width + $wordwidth <= $maxwidth)
	                    {
	                        $width += $wordwidth;
	                        $text .= substr($word, $i, 1);
	                    }
	                    else
	                    {
	                        $width = $wordwidth;
	                        $text = rtrim($text)."\n".substr($word, $i, 1);
	                        $count++;
	                    }
	                }
	            }
	            elseif($width + $wordwidth <= $maxwidth)
	            {
	                $width += $wordwidth + $space;
	                $text .= $word.' ';
	            }
	            else
	            {
	                $width = $wordwidth + $space;
	                $text = rtrim($text)."\n".$word.' ';
	                $count++;
	            }
	        }
	        $text = rtrim($text)."\n";
	        $count++;
	    }
	    $text = rtrim($text);
	    return $count;
	}
	# EXTENDED 4 (END)
	
}//end of class

?>