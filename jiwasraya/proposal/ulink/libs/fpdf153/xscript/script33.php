<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>Dashes</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="../fpdf.css">
</HEAD>
<BODY ONLOAD="if(window.focus) window.focus()">
<H2>Dashes</H2>
<H4 CLASS="st">Informations</H4>Author: <SCRIPT TYPE="text/javascript">document.write('<A H'+'REF="m'+'ailto:yukihiro_o'+'&#'+'64;'+'infoseek.jp?subject=Dashes">');</SCRIPT>yukihiro_o<SCRIPT TYPE="text/javascript">document.write('<\/A>');</SCRIPT><BR>License: Freeware
<H4 CLASS="st">Description</H4>This extension allows to set a dash pattern and draw dashed lines or rectangles.<BR>
<BR>
<TT>SetDash(<B>float</B> black, <B>float</B> white)</TT><BR>
<BR>
<TT><U>black</U></TT>: length of dashes<BR>
<TT><U>white</U></TT>: length of gaps<BR>
<BR>
Call the function without parameter to restore normal drawing.
<H4 CLASS="st">Source</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'fpdf.php'</font><font class="kw">);<br><br>class </font>PDF <font class="kw">extends </font>FPDF<br><font class="kw">{<br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>SetDash<font class="kw">(</font>$black<font class="kw">=</font>false<font class="kw">,</font>$white<font class="kw">=</font>false<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$black <font class="kw">and </font>$white<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$s<font class="kw">=</font>sprintf<font class="kw">(</font><font class="str">'[%.3f %.3f] 0 d'</font><font class="kw">,</font>$black<font class="kw">*</font>$<font class="kw">this-&gt;</font>k<font class="kw">,</font>$white<font class="kw">*</font>$<font class="kw">this-&gt;</font>k<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$s<font class="kw">=</font><font class="str">'[] 0 d'</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>$s<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br>}<br><br></font>$pdf<font class="kw">=new </font>PDF<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>Open<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>AddPage<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>SetLineWidth<font class="kw">(</font>0.1<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetDash<font class="kw">(</font>5<font class="kw">,</font>5<font class="kw">); </font><font class="cmt">//5mm on, 5mm off<br></font>$pdf<font class="kw">-&gt;</font>Line<font class="kw">(</font>20<font class="kw">,</font>20<font class="kw">,</font>190<font class="kw">,</font>20<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetLineWidth<font class="kw">(</font>0.5<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Line<font class="kw">(</font>20<font class="kw">,</font>25<font class="kw">,</font>190<font class="kw">,</font>25<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetLineWidth<font class="kw">(</font>0.8<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetDash<font class="kw">(</font>4<font class="kw">,</font>2<font class="kw">); </font><font class="cmt">//4mm on, 2mm off<br></font>$pdf<font class="kw">-&gt;</font>Rect<font class="kw">(</font>20<font class="kw">,</font>30<font class="kw">,</font>170<font class="kw">,</font>20<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>SetDash<font class="kw">(); </font><font class="cmt">//restore no dash<br></font>$pdf<font class="kw">-&gt;</font>Line<font class="kw">(</font>20<font class="kw">,</font>55<font class="kw">,</font>190<font class="kw">,</font>55<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Output<font class="kw">();<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>
<BR>
View the result <A HREF="dash.pdf" TARGET="_blank">here</A>.
<H4 CLASS="st">Download</H4><A HREF="script33.zip">ZIP</A> | <A HREF="script33.tgz">TGZ</A>
</BODY>
</HTML>
