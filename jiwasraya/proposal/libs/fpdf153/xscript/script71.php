<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>Star</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="../fpdf.css">
</HEAD>
<BODY ONLOAD="if(window.focus) window.focus()">
<H2>Star</H2>
<H4 CLASS="st">Informations</H4>Author: <SCRIPT TYPE="text/javascript">document.write('<A H'+'REF="m'+'ailto:lsalvino'+'&#'+'64;'+'impsat.com?subject=Star">');</SCRIPT>Luciano Salvino<SCRIPT TYPE="text/javascript">document.write('<\/A>');</SCRIPT><BR>License: Freeware
<H4 CLASS="st">Description</H4>This script draws a star.<BR>
<BR>
<TT>Star(<B>float</B> X, <B>float</B> Y, <B>float</B> rin, <B>float</B> rout, <B>int</B> points [, <B>string</B> style ])</TT><BR>
<BR>
<TT><U>X</U></TT>: abscissa of center.<BR>
<TT><U>Y</U></TT>: ordinate of center.<BR>
<TT><U>rin</U></TT>: internal radius.<BR>
<TT><U>rout</U></TT>: external radius.<BR>
</TT><U>points</U></TT>: number of points that the star is composed of.<BR>
<TT><U>style</U></TT>: style of rendering, the same as for Rect(): D, F or FD.<BR>
<BR>
Note: if rin=rout, the star will appear as a simple circle.
<H4 CLASS="st">Source</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'fpdf.php'</font><font class="kw">);<br><br>class </font>PDF_Star <font class="kw">extends </font>FPDF<br><font class="kw">{<br><br>function </font>Star<font class="kw">(</font>$x<font class="kw">,</font>$y<font class="kw">,</font>$rin<font class="kw">,</font>$rout<font class="kw">,</font>$points<font class="kw">,</font>$style<font class="kw">=</font><font class="str">'D'</font><font class="kw">)<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$style<font class="kw">==</font><font class="str">'F'</font><font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$op<font class="kw">=</font><font class="str">'f'</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;elseif(</font>$style<font class="kw">==</font><font class="str">'FD' </font><font class="kw">or </font>$style<font class="kw">==</font><font class="str">'DF'</font><font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$op<font class="kw">=</font><font class="str">'B'</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$op<font class="kw">=</font><font class="str">'S'</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$cx <font class="kw">= array(</font>$points<font class="kw">*</font>2<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$cy <font class="kw">= array(</font>$points<font class="kw">*</font>2<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$dth <font class="kw">= (</font>pi<font class="kw">()/</font>$points<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$th <font class="kw">= </font>0<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$k<font class="kw">=</font>$<font class="kw">this-&gt;</font>k<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$h<font class="kw">=</font>$<font class="kw">this-&gt;</font>h<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$points_string <font class="kw">= </font><font class="str">''</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;for(</font>$i<font class="kw">=</font>0<font class="kw">;</font>$i<font class="kw">&lt;(</font>$points<font class="kw">*</font>2<font class="kw">)+</font>1<font class="kw">;</font>$i<font class="kw">++)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$th <font class="kw">= </font>$th<font class="kw">+</font>$dth<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$cx<font class="kw">[</font>$i<font class="kw">] = </font>$x <font class="kw">+ (((</font>$i<font class="kw">%</font>2<font class="kw">==</font>0<font class="kw">)?</font>$rin<font class="kw">:</font>$rout<font class="kw">) * </font>cos<font class="kw">(</font>$th<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$cy<font class="kw">[</font>$i<font class="kw">] = </font>$y <font class="kw">+ (((</font>$i<font class="kw">%</font>2<font class="kw">==</font>0<font class="kw">)?</font>$rin<font class="kw">:</font>$rout<font class="kw">) * </font>sin<font class="kw">(</font>$th<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$points_string <font class="kw">.= </font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f'</font><font class="kw">, </font>$cx<font class="kw">[</font>$i<font class="kw">]*</font>$k<font class="kw">, (</font>$h<font class="kw">-</font>$cy<font class="kw">[</font>$i<font class="kw">])*</font>$k<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$i<font class="kw">==</font>0<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$points_string <font class="kw">.= </font><font class="str">' m '</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$points_string <font class="kw">.= </font><font class="str">' l '</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>$points_string <font class="kw">. </font>$op<font class="kw">);<br>}<br><br>}<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>

<H4 CLASS="st">Example</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'star.php'</font><font class="kw">);<br><br></font>$pdf<font class="kw">=new </font>PDF_Star<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>AddPage<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>SetDrawColor<font class="kw">(</font>0<font class="kw">,</font>0<font class="kw">,</font>0<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetFillColor<font class="kw">(</font>255<font class="kw">,</font>0<font class="kw">,</font>0<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetLineWidth<font class="kw">(</font>0.5<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Star<font class="kw">(</font>100<font class="kw">,</font>50<font class="kw">,</font>40<font class="kw">,</font>30<font class="kw">,</font>36<font class="kw">,</font><font class="str">'DF'</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Output<font class="kw">();<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>
<BR>
View the result <A HREF="ex71.pdf" TARGET="_blank">here</A>.
<H4 CLASS="st">Download</H4><A HREF="script71.zip">ZIP</A> | <A HREF="script71.tgz">TGZ</A>
</BODY>
</HTML>
