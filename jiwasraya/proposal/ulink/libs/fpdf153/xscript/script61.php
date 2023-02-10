<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>subWrite</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="../fpdf.css">
</HEAD>
<BODY ONLOAD="if(window.focus) window.focus()">
<H2>subWrite</H2>
<H4 CLASS="st">Informations</H4>Author: <SCRIPT TYPE="text/javascript">document.write('<A H'+'REF="m'+'ailto:you2me'+'&#'+'64;'+'web.de?subject=subWrite">');</SCRIPT>Wirus<SCRIPT TYPE="text/javascript">document.write('<\/A>');</SCRIPT><BR>License: Freeware
<H4 CLASS="st">Description</H4>This method prints text from the current position in the same way as Write(). An additional
parameter allows to reduce or increase the font size; it's useful for initials. A second
parameter allows to specify an offset so that text is placed at a superscripted or subscripted
position.<BR>
<BR>
<TT>subWrite(<B>float</B> h, <B>string</B> txt [, <B>mixed</B> link [, <B>float</B> subFontSize [, <B>float</B> subOffset]]])</TT><BR>
<BR>
<TT><U>h</U></TT>
<BLOCKQUOTE>
Line height
</BLOCKQUOTE>
<TT><U>txt</U></TT>
<BLOCKQUOTE>
String to print
</BLOCKQUOTE>
<TT><U>link</U></TT>
<BLOCKQUOTE>
URL or identifier returned by AddLink()
</BLOCKQUOTE>
<TT><U>subFontSize</U></TT>
<BLOCKQUOTE>
Size of font in points (12 by default)
</BLOCKQUOTE>
<TT><U>subOffset</U></TT>
<BLOCKQUOTE>
Offset of text in points (positive means superscript, negative subscript; 0 by default)
</BLOCKQUOTE>
<H4 CLASS="st">Source</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'fpdf.php'</font><font class="kw">);<br><br>class </font>PDF <font class="kw">extends </font>FPDF<br><font class="kw">{<br>function </font>subWrite<font class="kw">(</font>$h<font class="kw">, </font>$txt<font class="kw">, </font>$link<font class="kw">=</font><font class="str">''</font><font class="kw">,</font>$subFontSize<font class="kw">=</font>12<font class="kw">, </font>$subOffset<font class="kw">=</font>0<font class="kw">)<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">// resize font<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$subFontSizeold <font class="kw">= </font>$<font class="kw">this-&gt;</font>FontSizePt<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>SetFontSize<font class="kw">(</font>$subFontSize<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">// reposition y<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$subOffset <font class="kw">= (((</font>$subFontSize <font class="kw">- </font>$subFontSizeold<font class="kw">) / </font>$<font class="kw">this-&gt;</font>k<font class="kw">) * </font>0.3<font class="kw">) + (</font>$subOffset <font class="kw">/ </font>$<font class="kw">this-&gt;</font>k<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$subX&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="kw">= </font>$<font class="kw">this-&gt;</font>x<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$subY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="kw">= </font>$<font class="kw">this-&gt;</font>y<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>SetXY<font class="kw">(</font>$subX<font class="kw">, </font>$subY <font class="kw">- </font>$subOffset<font class="kw">);<br><br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//Output text<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Write<font class="kw">(</font>$h<font class="kw">, </font>$txt<font class="kw">, </font>$link<font class="kw">);<br><br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">// restore y position<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$subX&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="kw">= </font>$<font class="kw">this-&gt;</font>x<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$subY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class="kw">= </font>$<font class="kw">this-&gt;</font>y<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>SetXY<font class="kw">(</font>$subX<font class="kw">,&nbsp;&nbsp;</font>$subY <font class="kw">+ </font>$subOffset<font class="kw">);<br><br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">// restore font size<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>SetFontSize<font class="kw">(</font>$subFontSizeold<font class="kw">);<br>}<br>}<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>

<H4 CLASS="st">Example</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br>define<font class="kw">(</font><font class="str">'FPDF_FONTPATH'</font><font class="kw">,</font><font class="str">'font/'</font><font class="kw">);<br>require(</font><font class="str">'subwrite.php'</font><font class="kw">);<br><br></font>$pdf<font class="kw">=new </font>PDF<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>AddPage<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>SetFont<font class="kw">(</font><font class="str">'Arial'</font><font class="kw">,</font><font class="str">'B'</font><font class="kw">,</font>12<font class="kw">);<br><br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>5<font class="kw">,</font><font class="str">"Hello World!"</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetX<font class="kw">(</font>100<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>5<font class="kw">,</font><font class="str">"This is standard text.\n"</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Ln<font class="kw">(</font>12<font class="kw">);<br><br></font>$pdf<font class="kw">-&gt;</font>subWrite<font class="kw">(</font>10<font class="kw">,</font><font class="str">"H"</font><font class="kw">,</font><font class="str">''</font><font class="kw">,</font>33<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>10<font class="kw">,</font><font class="str">"ello World!"</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetX<font class="kw">(</font>100<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>10<font class="kw">,</font><font class="str">"This is text with a capital first letter.\n"</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Ln<font class="kw">(</font>12<font class="kw">);<br><br></font>$pdf<font class="kw">-&gt;</font>subWrite<font class="kw">(</font>5<font class="kw">,</font><font class="str">"Y"</font><font class="kw">,</font><font class="str">''</font><font class="kw">,</font>6<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>5<font class="kw">,</font><font class="str">"ou can also begin the sentence with a small letter. And word wrap also works if the line is too long!"</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetX<font class="kw">(</font>100<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>5<font class="kw">,</font><font class="str">"This is text with a small first letter.\n"</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Ln<font class="kw">(</font>12<font class="kw">);<br><br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>5<font class="kw">,</font><font class="str">"The world has a lot of km"</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>subWrite<font class="kw">(</font>5<font class="kw">,</font><font class="str">"2"</font><font class="kw">,</font><font class="str">''</font><font class="kw">,</font>6<font class="kw">,</font>4<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetX<font class="kw">(</font>100<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>5<font class="kw">,</font><font class="str">"This is text with a superscripted letter.\n"</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Ln<font class="kw">(</font>12<font class="kw">);<br><br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>5<font class="kw">,</font><font class="str">"The world has a lot of H"</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>subWrite<font class="kw">(</font>5<font class="kw">,</font><font class="str">"2"</font><font class="kw">,</font><font class="str">''</font><font class="kw">,</font>6<font class="kw">,-</font>3<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>5<font class="kw">,</font><font class="str">"O"</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetX<font class="kw">(</font>100<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Write<font class="kw">(</font>5<font class="kw">,</font><font class="str">"This is text with a subscripted letter.\n"</font><font class="kw">);<br><br></font>$pdf<font class="kw">-&gt;</font>Output<font class="kw">();<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>
<BR>
View the result <A HREF="ex61.pdf" TARGET="_blank">here</A>.
<H4 CLASS="st">Download</H4><A HREF="script61.zip">ZIP</A> | <A HREF="script61.tgz">TGZ</A>
</BODY>
</HTML>
