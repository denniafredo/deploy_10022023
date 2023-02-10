<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>Rotations</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="../fpdf.css">
</HEAD>
<BODY ONLOAD="if(window.focus) window.focus()">
<H2>Rotations</H2>
<H4 CLASS="st">Informations</H4>Author: <SCRIPT TYPE="text/javascript">document.write('<A H'+'REF="m'+'ailto:oliver'+'&#'+'64;'+'fpdf.org?subject=Rotations">');</SCRIPT>Olivier<SCRIPT TYPE="text/javascript">document.write('<\/A>');</SCRIPT><BR>License: Freeware
<H4 CLASS="st">Description</H4>This script allows to perform a rotation around a given center.<BR>
The method to set a rotation is:<BR>
<BR>
<TT>function Rotate(<B>float</B> angle [, <B>float</B> x [, <B>float</B> y]])</TT><BR>
<BR>
<TT><U>angle</U></TT>: angle in degrees.<BR>
<TT><U>x</U></TT>: abscissa of the rotation center. Default value: current position.<BR>
<TT><U>y</U></TT>: ordinate of the rotation center. Default value: current position.<BR>
<BR>
The rotation affects all elements which are printed after the method call (with the exception of
the clickable areas).<BR>
<BR>
Remarks:<BR>
<BR>
- Only the display is altered. The GetX() and GetY() methods are not affected, nor the automatic
page break mechanism.<BR>
- Rotation is not kept from page to page. Each page begins with a null rotation.
<H4 CLASS="st">Source</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'fpdf.php'</font><font class="kw">);<br><br>class </font>PDF_Rotate <font class="kw">extends </font>FPDF<br><font class="kw">{<br>var </font>$angle<font class="kw">=</font>0<font class="kw">;<br><br>function </font>Rotate<font class="kw">(</font>$angle<font class="kw">,</font>$x<font class="kw">=-</font>1<font class="kw">,</font>$y<font class="kw">=-</font>1<font class="kw">)<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$x<font class="kw">==-</font>1<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$x<font class="kw">=</font>$<font class="kw">this-&gt;</font>x<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$y<font class="kw">==-</font>1<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$y<font class="kw">=</font>$<font class="kw">this-&gt;</font>y<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$<font class="kw">this-&gt;</font>angle<font class="kw">!=</font>0<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'Q'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>angle<font class="kw">=</font>$angle<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$angle<font class="kw">!=</font>0<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$angle<font class="kw">*=</font>M_PI<font class="kw">/</font>180<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$c<font class="kw">=</font>cos<font class="kw">(</font>$angle<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$s<font class="kw">=</font>sin<font class="kw">(</font>$angle<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$cx<font class="kw">=</font>$x<font class="kw">*</font>$<font class="kw">this-&gt;</font>k<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$cy<font class="kw">=(</font>$<font class="kw">this-&gt;</font>h<font class="kw">-</font>$y<font class="kw">)*</font>$<font class="kw">this-&gt;</font>k<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm'</font><font class="kw">,</font>$c<font class="kw">,</font>$s<font class="kw">,-</font>$s<font class="kw">,</font>$c<font class="kw">,</font>$cx<font class="kw">,</font>$cy<font class="kw">,-</font>$cx<font class="kw">,-</font>$cy<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br>}<br><br>function </font>_endpage<font class="kw">()<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$<font class="kw">this-&gt;</font>angle<font class="kw">!=</font>0<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>angle<font class="kw">=</font>0<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'Q'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">parent::</font>_endpage<font class="kw">();<br>}<br>}<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>

<H4 CLASS="st">Example</H4>Here's an example which defines the utility methods RotatedText() and RotatedImage() and uses
them to print a text and an image rotated to 45°.<BR>
<BR>
<TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br>define<font class="kw">(</font><font class="str">'FPDF_FONTPATH'</font><font class="kw">,</font><font class="str">'font/'</font><font class="kw">);<br>require(</font><font class="str">'rotation.php'</font><font class="kw">);<br><br>class </font>PDF <font class="kw">extends </font>PDF_Rotate<br><font class="kw">{<br>function </font>RotatedText<font class="kw">(</font>$x<font class="kw">,</font>$y<font class="kw">,</font>$txt<font class="kw">,</font>$angle<font class="kw">)<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//Text rotated around its origin<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Rotate<font class="kw">(</font>$angle<font class="kw">,</font>$x<font class="kw">,</font>$y<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Text<font class="kw">(</font>$x<font class="kw">,</font>$y<font class="kw">,</font>$txt<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Rotate<font class="kw">(</font>0<font class="kw">);<br>}<br><br>function </font>RotatedImage<font class="kw">(</font>$file<font class="kw">,</font>$x<font class="kw">,</font>$y<font class="kw">,</font>$w<font class="kw">,</font>$h<font class="kw">,</font>$angle<font class="kw">)<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//Image rotated around its upper-left corner<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Rotate<font class="kw">(</font>$angle<font class="kw">,</font>$x<font class="kw">,</font>$y<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Image<font class="kw">(</font>$file<font class="kw">,</font>$x<font class="kw">,</font>$y<font class="kw">,</font>$w<font class="kw">,</font>$h<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>Rotate<font class="kw">(</font>0<font class="kw">);<br>}<br>}<br><br></font>$pdf<font class="kw">=new </font>PDF<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>AddPage<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>SetFont<font class="kw">(</font><font class="str">'Arial'</font><font class="kw">,</font><font class="str">''</font><font class="kw">,</font>20<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>RotatedImage<font class="kw">(</font><font class="str">'circle.png'</font><font class="kw">,</font>85<font class="kw">,</font>60<font class="kw">,</font>40<font class="kw">,</font>16<font class="kw">,</font>45<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>RotatedText<font class="kw">(</font>100<font class="kw">,</font>60<font class="kw">,</font><font class="str">'Hello!'</font><font class="kw">,</font>45<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Output<font class="kw">();<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>
<BR>
View the result <A HREF="ex2.pdf" TARGET="_blank">here</A>.
<H4 CLASS="st">Download</H4><A HREF="script2.zip">ZIP</A> | <A HREF="script2.tgz">TGZ</A>
</BODY>
</HTML>
