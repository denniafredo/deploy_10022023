<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>Polygons</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="../fpdf.css">
</HEAD>
<BODY ONLOAD="if(window.focus) window.focus()">
<H2>Polygons</H2>
<H4 CLASS="st">Informations</H4>Author: <SCRIPT TYPE="text/javascript">document.write('<A H'+'REF="m'+'ailto:andy'+'&#'+'64;'+'amcomputing.com?subject=Polygons">');</SCRIPT>Andrew Meier<SCRIPT TYPE="text/javascript">document.write('<\/A>');</SCRIPT><BR>License: Freeware
<H4 CLASS="st">Description</H4>This script allows to draw polygons.<BR>
<BR>
<TT>Polygon(<B>array</B> points [, <B>string</B> style])</TT><BR>
<BR>
<TT><U>points</U></TT>: array of the form (x1, y1, x2, y2, ..., xn, yn) where
(x1, y1) is the starting point and (xn, yn) is the last one.<BR>
<BR>
<TT><U>style</U></TT>: style of rendering, the same as for <TT>Rect()</TT>: <TT>D</TT>, <TT>F</TT>
or <TT>FD</TT>.
<H4 CLASS="st">Source</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'fpdf.php'</font><font class="kw">);<br><br>class </font>PDF_Polygon <font class="kw">extends </font>FPDF<br><font class="kw">{<br><br>function </font>Polygon<font class="kw">(</font>$points<font class="kw">, </font>$style<font class="kw">=</font><font class="str">'D'</font><font class="kw">)<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//Draw a polygon<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">if(</font>$style<font class="kw">==</font><font class="str">'F'</font><font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$op<font class="kw">=</font><font class="str">'f'</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;elseif(</font>$style<font class="kw">==</font><font class="str">'FD' </font><font class="kw">or </font>$style<font class="kw">==</font><font class="str">'DF'</font><font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$op<font class="kw">=</font><font class="str">'b'</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$op<font class="kw">=</font><font class="str">'s'</font><font class="kw">;<br><br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$h <font class="kw">= </font>$<font class="kw">this-&gt;</font>h<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$k <font class="kw">= </font>$<font class="kw">this-&gt;</font>k<font class="kw">;<br><br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$points_string <font class="kw">= </font><font class="str">''</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;for(</font>$i<font class="kw">=</font>0<font class="kw">; </font>$i<font class="kw">&lt;</font>count<font class="kw">(</font>$points<font class="kw">); </font>$i<font class="kw">+=</font>2<font class="kw">){<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$points_string <font class="kw">.= </font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f'</font><font class="kw">, </font>$points<font class="kw">[</font>$i<font class="kw">]*</font>$k<font class="kw">, (</font>$h<font class="kw">-</font>$points<font class="kw">[</font>$i<font class="kw">+</font>1<font class="kw">])*</font>$k<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$i<font class="kw">==</font>0<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$points_string <font class="kw">.= </font><font class="str">' m '</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$points_string <font class="kw">.= </font><font class="str">' l '</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>$points_string <font class="kw">. </font>$op<font class="kw">);<br>}<br><br>}<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>

<H4 CLASS="st">Example</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'polygon.php'</font><font class="kw">);<br><br></font>$pdf<font class="kw">=new </font>PDF_Polygon<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>AddPage<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>SetDrawColor<font class="kw">(</font>255<font class="kw">,</font>0<font class="kw">,</font>0<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetFillColor<font class="kw">(</font>0<font class="kw">,</font>0<font class="kw">,</font>255<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetLineWidth<font class="kw">(</font>4<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Polygon<font class="kw">(array(</font>50<font class="kw">,</font>115<font class="kw">,</font>150<font class="kw">,</font>115<font class="kw">,</font>100<font class="kw">,</font>20<font class="kw">),</font><font class="str">'FD'</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Output<font class="kw">();<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>
<BR>
View the result <A HREF="ex60.pdf" TARGET="_blank">here</A>.
<H4 CLASS="st">Download</H4><A HREF="script60.zip">ZIP</A> | <A HREF="script60.tgz">TGZ</A>
</BODY>
</HTML>
