<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>Transparency</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="../fpdf.css">
</HEAD>
<BODY ONLOAD="if(window.focus) window.focus()">
<H2>Transparency</H2>
<H4 CLASS="st">Informations</H4>Author: <SCRIPT TYPE="text/javascript">document.write('<A H'+'REF="m'+'ailto:djmanmaster'+'&#'+'64;'+'gmx.net?subject=Transparency">');</SCRIPT>Martin Hall-May<SCRIPT TYPE="text/javascript">document.write('<\/A>');</SCRIPT><BR>License: Freeware
<H4 CLASS="st">Description</H4>This script gives transparency support. You can set the alpha channel from 0 (fully
transparent) to 1 (fully opaque). It applies to all elements (text, drawings, images).<BR>
<BR>
<B>Note:</B> transparency requires at least Acrobat Reader 5.
<H4 CLASS="st">Source</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'fpdf.php'</font><font class="kw">);<br><br>class </font>AlphaPDF <font class="kw">extends </font>FPDF<br><font class="kw">{<br>&nbsp;&nbsp;&nbsp;&nbsp;var </font>$extgstates<font class="kw">;<br><br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>AlphaPDF<font class="kw">(</font>$orientation<font class="kw">=</font><font class="str">'P'</font><font class="kw">,</font>$unit<font class="kw">=</font><font class="str">'mm'</font><font class="kw">,</font>$format<font class="kw">=</font><font class="str">'A4'</font><font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">parent::</font>FPDF<font class="kw">(</font>$orientation<font class="kw">, </font>$unit<font class="kw">, </font>$format<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>extgstates <font class="kw">= array();<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">// alpha: real value from 0 (transparent) to 1 (opaque)<br>&nbsp;&nbsp;&nbsp;&nbsp;// bm:&nbsp;&nbsp;&nbsp;&nbsp;blend mode, one of the following:<br>&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,<br>&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">function </font>SetAlpha<font class="kw">(</font>$alpha<font class="kw">, </font>$bm<font class="kw">=</font><font class="str">'Normal'</font><font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">// set alpha for stroking (CA) and non-stroking (ca) operations<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$gs <font class="kw">= </font>$<font class="kw">this-&gt;</font>AddExtGState<font class="kw">(array(</font><font class="str">'ca'</font><font class="kw">=&gt;</font>$alpha<font class="kw">, </font><font class="str">'CA'</font><font class="kw">=&gt;</font>$alpha<font class="kw">, </font><font class="str">'BM'</font><font class="kw">=&gt;</font><font class="str">'/'</font><font class="kw">.</font>$bm<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>SetExtGState<font class="kw">(</font>$gs<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>AddExtGState<font class="kw">(</font>$parms<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$n <font class="kw">= </font>count<font class="kw">(</font>$<font class="kw">this-&gt;</font>extgstates<font class="kw">)+</font>1<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>extgstates<font class="kw">[</font>$n<font class="kw">][</font><font class="str">'parms'</font><font class="kw">] = </font>$parms<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return </font>$n<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>SetExtGState<font class="kw">(</font>$gs<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'/GS%d gs'</font><font class="kw">, </font>$gs<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>_enddoc<font class="kw">()<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(!empty(</font>$<font class="kw">this-&gt;</font>extgstates<font class="kw">) &amp;&amp; </font>$<font class="kw">this-&gt;</font>PDFVersion<font class="kw">&lt;</font><font class="str">'1.4'</font><font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>PDFVersion<font class="kw">=</font><font class="str">'1.4'</font><font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">parent::</font>_enddoc<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>_putextgstates<font class="kw">()<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for (</font>$i <font class="kw">= </font>1<font class="kw">; </font>$i <font class="kw">&lt;= </font>count<font class="kw">(</font>$<font class="kw">this-&gt;</font>extgstates<font class="kw">); </font>$i<font class="kw">++)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_newobj<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>extgstates<font class="kw">[</font>$i<font class="kw">][</font><font class="str">'n'</font><font class="kw">] = </font>$<font class="kw">this-&gt;</font>n<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'&lt;&lt;/Type /ExtGState'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach (</font>$<font class="kw">this-&gt;</font>extgstates<font class="kw">[</font>$i<font class="kw">][</font><font class="str">'parms'</font><font class="kw">] as </font>$k<font class="kw">=&gt;</font>$v<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/'</font><font class="kw">.</font>$k<font class="kw">.</font><font class="str">' '</font><font class="kw">.</font>$v<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'&gt;&gt;'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'endobj'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>_putresourcedict<font class="kw">()<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">parent::</font>_putresourcedict<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/ExtGState &lt;&lt;'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;foreach(</font>$<font class="kw">this-&gt;</font>extgstates <font class="kw">as </font>$k<font class="kw">=&gt;</font>$extgstate<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/GS'</font><font class="kw">.</font>$k<font class="kw">.</font><font class="str">' '</font><font class="kw">.</font>$extgstate<font class="kw">[</font><font class="str">'n'</font><font class="kw">].</font><font class="str">' 0 R'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'&gt;&gt;'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br><br>&nbsp;&nbsp;&nbsp;&nbsp;function </font>_putresources<font class="kw">()<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_putextgstates<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">parent::</font>_putresources<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br>}<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>

<H4 CLASS="st">Example</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'alphapdf.php'</font><font class="kw">);<br><br></font>$pdf <font class="kw">= new </font>AlphaPDF<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>AddPage<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>SetLineWidth<font class="kw">(</font>1.5<font class="kw">);<br><br></font><font class="cmt">// draw opaque red square<br></font>$pdf<font class="kw">-&gt;</font>SetFillColor<font class="kw">(</font>255<font class="kw">,</font>0<font class="kw">,</font>0<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Rect<font class="kw">(</font>10<font class="kw">,</font>10<font class="kw">,</font>40<font class="kw">,</font>40<font class="kw">,</font><font class="str">'DF'</font><font class="kw">);<br><br></font><font class="cmt">// set alpha to semi-transparency<br></font>$pdf<font class="kw">-&gt;</font>SetAlpha<font class="kw">(</font>0.5<font class="kw">);<br><br></font><font class="cmt">// draw green square<br></font>$pdf<font class="kw">-&gt;</font>SetFillColor<font class="kw">(</font>0<font class="kw">,</font>255<font class="kw">,</font>0<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Rect<font class="kw">(</font>20<font class="kw">,</font>20<font class="kw">,</font>40<font class="kw">,</font>40<font class="kw">,</font><font class="str">'DF'</font><font class="kw">);<br><br></font><font class="cmt">// draw jpeg image<br></font>$pdf<font class="kw">-&gt;</font>Image<font class="kw">(</font><font class="str">'lena.jpg'</font><font class="kw">,</font>30<font class="kw">,</font>30<font class="kw">,</font>40<font class="kw">);<br><br></font><font class="cmt">// restore full opacity<br></font>$pdf<font class="kw">-&gt;</font>SetAlpha<font class="kw">(</font>1<font class="kw">);<br><br></font><font class="cmt">// print name<br></font>$pdf<font class="kw">-&gt;</font>SetFont<font class="kw">(</font><font class="str">'Arial'</font><font class="kw">, </font><font class="str">''</font><font class="kw">, </font>12<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Text<font class="kw">(</font>46<font class="kw">,</font>68<font class="kw">,</font><font class="str">'Lena'</font><font class="kw">);<br><br></font>$pdf<font class="kw">-&gt;</font>Output<font class="kw">();<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>
<BR>
View the result <A HREF="ex74.pdf" TARGET="_blank">here</A>.
<H4 CLASS="st">Download</H4><A HREF="script74.zip">ZIP</A> | <A HREF="script74.tgz">TGZ</A>
</BODY>
</HTML>
