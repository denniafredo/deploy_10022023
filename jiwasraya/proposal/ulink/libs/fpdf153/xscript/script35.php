<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>Rounded rectangle</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="../fpdf.css">
</HEAD>
<BODY ONLOAD="if(window.focus) window.focus()">
<H2>Rounded rectangle</H2>
<H4 CLASS="st">Informations</H4>Author: Christophe Prugnaud<BR>License: Freeware
<H4 CLASS="st">Description</H4>This script is based on <A HREF='script7.php'>this one</A> and allows to draw a rectangle with some
rounded corners. Parameters are:
<BR>
<TT><U>x</U></TT>, <TT><U>y</U></TT>: top left corner of the rectangle.<BR>
<TT><U>w</U></TT>, <TT><U>h</U></TT>: width and height.<BR>
<TT><U>r</U></TT>: radius of the rounded corners.<BR>
<TT><U>style</U></TT>: same as Rect(): F, D (default), FD or DF.<BR>
<TT><U>angle</U></TT>: numbers of the corners to be rounded: 1, 2, 3, 4 or any combination
(1=top left, 2=top right, 3=bottom right, 4=bottom left).
<H4 CLASS="st">Source</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'fpdf.php'</font><font class="kw">);<br><br>class </font>PDF <font class="kw">extends </font>FPDF<br><font class="kw">{<br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>RoundedRect<font class="kw">(</font>$x<font class="kw">, </font>$y<font class="kw">, </font>$w<font class="kw">, </font>$h<font class="kw">, </font>$r<font class="kw">, </font>$style <font class="kw">= </font><font class="str">''</font><font class="kw">, </font>$angle <font class="kw">= </font><font class="str">'1234'</font><font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$k <font class="kw">= </font>$<font class="kw">this-&gt;</font>k<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$hp <font class="kw">= </font>$<font class="kw">this-&gt;</font>h<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$style<font class="kw">==</font><font class="str">'F'</font><font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$op<font class="kw">=</font><font class="str">'f'</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;elseif(</font>$style<font class="kw">==</font><font class="str">'FD' </font><font class="kw">or </font>$style<font class="kw">==</font><font class="str">'DF'</font><font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$op<font class="kw">=</font><font class="str">'B'</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$op<font class="kw">=</font><font class="str">'S'</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$MyArc <font class="kw">= </font>4<font class="kw">/</font>3 <font class="kw">* (</font>sqrt<font class="kw">(</font>2<font class="kw">) - </font>1<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f m'</font><font class="kw">,(</font>$x<font class="kw">+</font>$r<font class="kw">)*</font>$k<font class="kw">,(</font>$hp<font class="kw">-</font>$y<font class="kw">)*</font>$k <font class="kw">));<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$xc <font class="kw">= </font>$x<font class="kw">+</font>$w<font class="kw">-</font>$r<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$yc <font class="kw">= </font>$y<font class="kw">+</font>$r<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f l'</font><font class="kw">, </font>$xc<font class="kw">*</font>$k<font class="kw">,(</font>$hp<font class="kw">-</font>$y<font class="kw">)*</font>$k <font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (</font>strpos<font class="kw">(</font>$angle<font class="kw">, </font><font class="str">'2'</font><font class="kw">)===</font>false<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f l'</font><font class="kw">, (</font>$x<font class="kw">+</font>$w<font class="kw">)*</font>$k<font class="kw">,(</font>$hp<font class="kw">-</font>$y<font class="kw">)*</font>$k <font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_Arc<font class="kw">(</font>$xc <font class="kw">+ </font>$r<font class="kw">*</font>$MyArc<font class="kw">, </font>$yc <font class="kw">- </font>$r<font class="kw">, </font>$xc <font class="kw">+ </font>$r<font class="kw">, </font>$yc <font class="kw">- </font>$r<font class="kw">*</font>$MyArc<font class="kw">, </font>$xc <font class="kw">+ </font>$r<font class="kw">, </font>$yc<font class="kw">);<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$xc <font class="kw">= </font>$x<font class="kw">+</font>$w<font class="kw">-</font>$r<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$yc <font class="kw">= </font>$y<font class="kw">+</font>$h<font class="kw">-</font>$r<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f l'</font><font class="kw">,(</font>$x<font class="kw">+</font>$w<font class="kw">)*</font>$k<font class="kw">,(</font>$hp<font class="kw">-</font>$yc<font class="kw">)*</font>$k<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (</font>strpos<font class="kw">(</font>$angle<font class="kw">, </font><font class="str">'3'</font><font class="kw">)===</font>false<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f l'</font><font class="kw">,(</font>$x<font class="kw">+</font>$w<font class="kw">)*</font>$k<font class="kw">,(</font>$hp<font class="kw">-(</font>$y<font class="kw">+</font>$h<font class="kw">))*</font>$k<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_Arc<font class="kw">(</font>$xc <font class="kw">+ </font>$r<font class="kw">, </font>$yc <font class="kw">+ </font>$r<font class="kw">*</font>$MyArc<font class="kw">, </font>$xc <font class="kw">+ </font>$r<font class="kw">*</font>$MyArc<font class="kw">, </font>$yc <font class="kw">+ </font>$r<font class="kw">, </font>$xc<font class="kw">, </font>$yc <font class="kw">+ </font>$r<font class="kw">);<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$xc <font class="kw">= </font>$x<font class="kw">+</font>$r<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$yc <font class="kw">= </font>$y<font class="kw">+</font>$h<font class="kw">-</font>$r<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f l'</font><font class="kw">,</font>$xc<font class="kw">*</font>$k<font class="kw">,(</font>$hp<font class="kw">-(</font>$y<font class="kw">+</font>$h<font class="kw">))*</font>$k<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (</font>strpos<font class="kw">(</font>$angle<font class="kw">, </font><font class="str">'4'</font><font class="kw">)===</font>false<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f l'</font><font class="kw">,(</font>$x<font class="kw">)*</font>$k<font class="kw">,(</font>$hp<font class="kw">-(</font>$y<font class="kw">+</font>$h<font class="kw">))*</font>$k<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_Arc<font class="kw">(</font>$xc <font class="kw">- </font>$r<font class="kw">*</font>$MyArc<font class="kw">, </font>$yc <font class="kw">+ </font>$r<font class="kw">, </font>$xc <font class="kw">- </font>$r<font class="kw">, </font>$yc <font class="kw">+ </font>$r<font class="kw">*</font>$MyArc<font class="kw">, </font>$xc <font class="kw">- </font>$r<font class="kw">, </font>$yc<font class="kw">);<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$xc <font class="kw">= </font>$x<font class="kw">+</font>$r <font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$yc <font class="kw">= </font>$y<font class="kw">+</font>$r<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f l'</font><font class="kw">,(</font>$x<font class="kw">)*</font>$k<font class="kw">,(</font>$hp<font class="kw">-</font>$yc<font class="kw">)*</font>$k <font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (</font>strpos<font class="kw">(</font>$angle<font class="kw">, </font><font class="str">'1'</font><font class="kw">)===</font>false<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f l'</font><font class="kw">,(</font>$x<font class="kw">)*</font>$k<font class="kw">,(</font>$hp<font class="kw">-</font>$y<font class="kw">)*</font>$k <font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f l'</font><font class="kw">,(</font>$x<font class="kw">+</font>$r<font class="kw">)*</font>$k<font class="kw">,(</font>$hp<font class="kw">-</font>$y<font class="kw">)*</font>$k <font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_Arc<font class="kw">(</font>$xc <font class="kw">- </font>$r<font class="kw">, </font>$yc <font class="kw">- </font>$r<font class="kw">*</font>$MyArc<font class="kw">, </font>$xc <font class="kw">- </font>$r<font class="kw">*</font>$MyArc<font class="kw">, </font>$yc <font class="kw">- </font>$r<font class="kw">, </font>$xc<font class="kw">, </font>$yc <font class="kw">- </font>$r<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>$op<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>_Arc<font class="kw">(</font>$x1<font class="kw">, </font>$y1<font class="kw">, </font>$x2<font class="kw">, </font>$y2<font class="kw">, </font>$x3<font class="kw">, </font>$y3<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$h <font class="kw">= </font>$<font class="kw">this-&gt;</font>h<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'%.2f %.2f %.2f %.2f %.2f %.2f c '</font><font class="kw">, </font>$x1<font class="kw">*</font>$<font class="kw">this-&gt;</font>k<font class="kw">, (</font>$h<font class="kw">-</font>$y1<font class="kw">)*</font>$<font class="kw">this-&gt;</font>k<font class="kw">,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$x2<font class="kw">*</font>$<font class="kw">this-&gt;</font>k<font class="kw">, (</font>$h<font class="kw">-</font>$y2<font class="kw">)*</font>$<font class="kw">this-&gt;</font>k<font class="kw">, </font>$x3<font class="kw">*</font>$<font class="kw">this-&gt;</font>k<font class="kw">, (</font>$h<font class="kw">-</font>$y3<font class="kw">)*</font>$<font class="kw">this-&gt;</font>k<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br>}<br><br></font>$pdf<font class="kw">=new </font>PDF<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>Open<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>AddPage<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>SetFillColor<font class="kw">(</font>192<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>RoundedRect<font class="kw">(</font>60<font class="kw">, </font>30<font class="kw">, </font>68<font class="kw">, </font>46<font class="kw">, </font>5<font class="kw">, </font><font class="str">'DF'</font><font class="kw">, </font><font class="str">'13'</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Output<font class="kw">();<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>
<BR>
View the result <A HREF="rounded_rect2.pdf" TARGET="_blank">here</A>.
<H4 CLASS="st">Download</H4><A HREF="script35.zip">ZIP</A> | <A HREF="script35.tgz">TGZ</A>
</BODY>
</HTML>
