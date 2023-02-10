<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>Circular text</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="../fpdf.css">
</HEAD>
<BODY ONLOAD="if(window.focus) window.focus()">
<H2>Circular text</H2>
<H4 CLASS="st">Informations</H4>Author: <SCRIPT TYPE="text/javascript">document.write('<A H'+'REF="m'+'ailto:fpdf'+'&#'+'64;'+'kreativschmiede.de?subject=Circular%20text">');</SCRIPT>Andreas W�rmser<SCRIPT TYPE="text/javascript">document.write('<\/A>');</SCRIPT><BR>License: Freeware
<H4 CLASS="st">Description</H4>This script prints a circular text inside a given circle. It makes use of the <A HREF='script79.php'>Transformations</A> script.<BR>
<BR>
<TT>CircularText(<B>float</B> x, <B>float</B> y, <B>float</B> r, <B>string</B> text [, <B>string</B> align [, <B>float</B> kerning [, <B>float</B> fontwidth]]])</TT><BR>
<BR>
<TT>x</TT>: abscissa of center<BR>
<TT>y</TT>: ordinate of center<BR>
<TT>r</TT>: radius of circle<BR>
<TT>text</TT>: text to be printed<BR>
<TT>align</TT>: text alignment: <TT>top</TT> or <TT>bottom</TT>. Default value: <TT>top</TT><BR>
<TT>kerning</TT>: spacing between letters in percentage. Default value: 120. Zero is not allowed.<BR>
<TT>fontwidth</TT>: width of letters in percentage. Default value: 100. Zero is not allowed.
<H4 CLASS="st">Source</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'transform.php'</font><font class="kw">);<br><br>class </font>PDF_CircularText <font class="kw">extends </font>PDF_Transform<font class="kw">{<br><br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>CircularText<font class="kw">(</font>$x<font class="kw">, </font>$y<font class="kw">, </font>$r<font class="kw">, </font>$text<font class="kw">, </font>$align<font class="kw">=</font><font class="str">"top"</font><font class="kw">, </font>$kerning<font class="kw">=</font>120<font class="kw">, </font>$fontwidth<font class="kw">=</font>100<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$kerning<font class="kw">/=</font>100<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$fontwidth<font class="kw">/=</font>100<font class="kw">;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$kerning<font class="kw">==</font>0<font class="kw">) </font>$<font class="kw">this-&gt;</font>Error<font class="kw">(</font><font class="str">'Please use values unequal to zero for kerning'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$fontwidth<font class="kw">==</font>0<font class="kw">) </font>$<font class="kw">this-&gt;</font>Error<font class="kw">(</font><font class="str">'Please use values unequal to zero for font width'</font><font class="kw">);&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//get width of every letter<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">for(</font>$i<font class="kw">=</font>0<font class="kw">; </font>$i<font class="kw">&lt;</font>strlen<font class="kw">(</font>$text<font class="kw">); </font>$i<font class="kw">++){<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$w<font class="kw">[</font>$i<font class="kw">]=</font>$<font class="kw">this-&gt;</font>GetStringWidth<font class="kw">(</font>$text<font class="kw">[</font>$i<font class="kw">]);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$w<font class="kw">[</font>$i<font class="kw">]*=</font>$kerning<font class="kw">*</font>$fontwidth<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//total width of string<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$t<font class="kw">+=</font>$w<font class="kw">[</font>$i<font class="kw">];<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//circumference<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$u<font class="kw">=(</font>$r<font class="kw">*</font>2<font class="kw">)*</font>M_PI<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//total width of string in degrees<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$d<font class="kw">=(</font>$t<font class="kw">/</font>$u<font class="kw">)*</font>360<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>StartTransform<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">// rotate matrix for the first letter to center the text<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;// (half of total degrees)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">if(</font>$align<font class="kw">==</font><font class="str">'top'</font><font class="kw">){<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Rotate<font class="kw">(</font>$d<font class="kw">/</font>2<font class="kw">, </font>$x<font class="kw">, </font>$y<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Rotate<font class="kw">(-</font>$d<font class="kw">/</font>2<font class="kw">, </font>$x<font class="kw">, </font>$y<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//run through the string<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">for(</font>$i<font class="kw">=</font>0<font class="kw">; </font>$i<font class="kw">&lt;</font>strlen<font class="kw">(</font>$text<font class="kw">); </font>$i<font class="kw">++){<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$align<font class="kw">==</font><font class="str">'top'</font><font class="kw">){<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//rotate matrix half of the width of current letter + half of the width of preceding letter<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">if(</font>$i<font class="kw">==</font>0<font class="kw">){<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Rotate<font class="kw">(-((</font>$w<font class="kw">[</font>$i<font class="kw">]/</font>2<font class="kw">)/</font>$u<font class="kw">)*</font>360<font class="kw">, </font>$x<font class="kw">, </font>$y<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Rotate<font class="kw">(-((</font>$w<font class="kw">[</font>$i<font class="kw">]/</font>2<font class="kw">+</font>$w<font class="kw">[</font>$i<font class="kw">-</font>1<font class="kw">]/</font>2<font class="kw">)/</font>$u<font class="kw">)*</font>360<font class="kw">, </font>$x<font class="kw">, </font>$y<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$fontwidth<font class="kw">!=</font>1<font class="kw">){<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>StartTransform<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>ScaleX<font class="kw">(</font>$fontwidth<font class="kw">*</font>100<font class="kw">, </font>$x<font class="kw">, </font>$y<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>SetXY<font class="kw">(</font>$x<font class="kw">-</font>$w<font class="kw">[</font>$i<font class="kw">]/</font>2<font class="kw">, </font>$y<font class="kw">-</font>$r<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//rotate matrix half of the width of current letter + half of the width of preceding letter<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">if(</font>$i<font class="kw">==</font>0<font class="kw">){<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Rotate<font class="kw">(((</font>$w<font class="kw">[</font>$i<font class="kw">]/</font>2<font class="kw">)/</font>$u<font class="kw">)*</font>360<font class="kw">, </font>$x<font class="kw">, </font>$y<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Rotate<font class="kw">(((</font>$w<font class="kw">[</font>$i<font class="kw">]/</font>2<font class="kw">+</font>$w<font class="kw">[</font>$i<font class="kw">-</font>1<font class="kw">]/</font>2<font class="kw">)/</font>$u<font class="kw">)*</font>360<font class="kw">, </font>$x<font class="kw">, </font>$y<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$fontwidth<font class="kw">!=</font>1<font class="kw">){<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>StartTransform<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>ScaleX<font class="kw">(</font>$fontwidth<font class="kw">*</font>100<font class="kw">, </font>$x<font class="kw">, </font>$y<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>SetXY<font class="kw">(</font>$x<font class="kw">-</font>$w<font class="kw">[</font>$i<font class="kw">]/</font>2<font class="kw">, </font>$y<font class="kw">+</font>$r<font class="kw">-(</font>$<font class="kw">this-&gt;</font>FontSize<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Cell<font class="kw">(</font>$w<font class="kw">[</font>$i<font class="kw">],</font>$<font class="kw">this-&gt;</font>FontSize<font class="kw">,</font>$text<font class="kw">[</font>$i<font class="kw">],</font>0<font class="kw">,</font>0<font class="kw">,</font><font class="str">'C'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$fontwidth<font class="kw">!=</font>1<font class="kw">){<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>StopTransform<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>StopTransform<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>}<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>

<H4 CLASS="st">Example</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'circulartext.php'</font><font class="kw">);<br><br></font>$pdf <font class="kw">= new </font>PDF_CircularText<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>AddPage<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>SetFont<font class="kw">(</font><font class="str">'Arial'</font><font class="kw">,</font><font class="str">''</font><font class="kw">,</font>32<font class="kw">);<br><br></font>$text<font class="kw">=</font><font class="str">'Circular Text'</font><font class="kw">;<br></font>$pdf<font class="kw">-&gt;</font>CircularText<font class="kw">(</font>105<font class="kw">, </font>50<font class="kw">, </font>30<font class="kw">, </font>$text<font class="kw">, </font><font class="str">'top'</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>CircularText<font class="kw">(</font>105<font class="kw">, </font>50<font class="kw">, </font>30<font class="kw">, </font>$text<font class="kw">, </font><font class="str">'bottom'</font><font class="kw">);<br><br></font>$pdf<font class="kw">-&gt;</font>Output<font class="kw">();<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>
<BR>
View the result <A HREF="ex82.pdf" TARGET="_blank">here</A>.
<H4 CLASS="st">Download</H4><A HREF="script82.zip">ZIP</A> | <A HREF="script82.tgz">TGZ</A>
</BODY>
</HTML>
