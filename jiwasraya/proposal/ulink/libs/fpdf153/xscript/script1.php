<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>Bookmarks</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="../fpdf.css">
</HEAD>
<BODY ONLOAD="if(window.focus) window.focus()">
<H2>Bookmarks</H2>
<H4 CLASS="st">Informations</H4>Author: <SCRIPT TYPE="text/javascript">document.write('<A H'+'REF="m'+'ailto:oliver'+'&#'+'64;'+'fpdf.org?subject=Bookmarks">');</SCRIPT>Olivier<SCRIPT TYPE="text/javascript">document.write('<\/A>');</SCRIPT><BR>License: Freeware
<H4 CLASS="st">Description</H4>This extension adds bookmark support. The method to add a bookmark is:<BR>
<BR>
<TT>function Bookmark(<B>string</B> txt [, <B>int</B> level [, <B>float</B> y]])</TT><BR>
<BR>
<TT><U>txt</U></TT>: the bookmark title.<BR>
<TT><U>level</U></TT>: the bookmark level (0 is top level, 1 is just below, and so on).<BR>
<TT><U>y</U></TT>: the y position of the bookmark destination in the current page. <TT>-1</TT> means the current position. Default value: <TT>0</TT>.<BR>
<H4 CLASS="st">Source</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="kw">require(</font><font class="str">'fpdf.php'</font><font class="kw">);<br><br>class </font>PDF_Bookmark <font class="kw">extends </font>FPDF<br><font class="kw">{<br>var </font>$outlines<font class="kw">=array();<br>var </font>$OutlineRoot<font class="kw">;<br><br>function </font>Bookmark<font class="kw">(</font>$txt<font class="kw">,</font>$level<font class="kw">=</font>0<font class="kw">,</font>$y<font class="kw">=</font>0<font class="kw">)<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$y<font class="kw">==-</font>1<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$y<font class="kw">=</font>$<font class="kw">this-&gt;</font>GetY<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>outlines<font class="kw">[]=array(</font><font class="str">'t'</font><font class="kw">=&gt;</font>$txt<font class="kw">,</font><font class="str">'l'</font><font class="kw">=&gt;</font>$level<font class="kw">,</font><font class="str">'y'</font><font class="kw">=&gt;</font>$y<font class="kw">,</font><font class="str">'p'</font><font class="kw">=&gt;</font>$<font class="kw">this-&gt;</font>PageNo<font class="kw">());<br>}<br><br>function </font>_putbookmarks<font class="kw">()<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$nb<font class="kw">=</font>count<font class="kw">(</font>$<font class="kw">this-&gt;</font>outlines<font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$nb<font class="kw">==</font>0<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$lru<font class="kw">=array();<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$level<font class="kw">=</font>0<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;foreach(</font>$<font class="kw">this-&gt;</font>outlines <font class="kw">as </font>$i<font class="kw">=&gt;</font>$o<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$o<font class="kw">[</font><font class="str">'l'</font><font class="kw">]&gt;</font>0<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$parent<font class="kw">=</font>$lru<font class="kw">[</font>$o<font class="kw">[</font><font class="str">'l'</font><font class="kw">]-</font>1<font class="kw">];<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//Set parent and last pointers<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>outlines<font class="kw">[</font>$i<font class="kw">][</font><font class="str">'parent'</font><font class="kw">]=</font>$parent<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>outlines<font class="kw">[</font>$parent<font class="kw">][</font><font class="str">'last'</font><font class="kw">]=</font>$i<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$o<font class="kw">[</font><font class="str">'l'</font><font class="kw">]&gt;</font>$level<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//Level increasing: set first pointer<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>outlines<font class="kw">[</font>$parent<font class="kw">][</font><font class="str">'first'</font><font class="kw">]=</font>$i<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;else<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>outlines<font class="kw">[</font>$i<font class="kw">][</font><font class="str">'parent'</font><font class="kw">]=</font>$nb<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(</font>$o<font class="kw">[</font><font class="str">'l'</font><font class="kw">]&lt;=</font>$level <font class="kw">and </font>$i<font class="kw">&gt;</font>0<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//Set prev and next pointers<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$prev<font class="kw">=</font>$lru<font class="kw">[</font>$o<font class="kw">[</font><font class="str">'l'</font><font class="kw">]];<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>outlines<font class="kw">[</font>$prev<font class="kw">][</font><font class="str">'next'</font><font class="kw">]=</font>$i<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>outlines<font class="kw">[</font>$i<font class="kw">][</font><font class="str">'prev'</font><font class="kw">]=</font>$prev<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$lru<font class="kw">[</font>$o<font class="kw">[</font><font class="str">'l'</font><font class="kw">]]=</font>$i<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$level<font class="kw">=</font>$o<font class="kw">[</font><font class="str">'l'</font><font class="kw">];<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//Outline items<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$n<font class="kw">=</font>$<font class="kw">this-&gt;</font>n<font class="kw">+</font>1<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;foreach(</font>$<font class="kw">this-&gt;</font>outlines <font class="kw">as </font>$i<font class="kw">=&gt;</font>$o<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_newobj<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'&lt;&lt;/Title '</font><font class="kw">.</font>$<font class="kw">this-&gt;</font>_textstring<font class="kw">(</font>$o<font class="kw">[</font><font class="str">'t'</font><font class="kw">]));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/Parent '</font><font class="kw">.(</font>$n<font class="kw">+</font>$o<font class="kw">[</font><font class="str">'parent'</font><font class="kw">]).</font><font class="str">' 0 R'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(isset(</font>$o<font class="kw">[</font><font class="str">'prev'</font><font class="kw">]))<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/Prev '</font><font class="kw">.(</font>$n<font class="kw">+</font>$o<font class="kw">[</font><font class="str">'prev'</font><font class="kw">]).</font><font class="str">' 0 R'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(isset(</font>$o<font class="kw">[</font><font class="str">'next'</font><font class="kw">]))<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/Next '</font><font class="kw">.(</font>$n<font class="kw">+</font>$o<font class="kw">[</font><font class="str">'next'</font><font class="kw">]).</font><font class="str">' 0 R'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(isset(</font>$o<font class="kw">[</font><font class="str">'first'</font><font class="kw">]))<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/First '</font><font class="kw">.(</font>$n<font class="kw">+</font>$o<font class="kw">[</font><font class="str">'first'</font><font class="kw">]).</font><font class="str">' 0 R'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if(isset(</font>$o<font class="kw">[</font><font class="str">'last'</font><font class="kw">]))<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/Last '</font><font class="kw">.(</font>$n<font class="kw">+</font>$o<font class="kw">[</font><font class="str">'last'</font><font class="kw">]).</font><font class="str">' 0 R'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font>sprintf<font class="kw">(</font><font class="str">'/Dest [%d 0 R /XYZ 0 %.2f null]'</font><font class="kw">,</font>1<font class="kw">+</font>2<font class="kw">*</font>$o<font class="kw">[</font><font class="str">'p'</font><font class="kw">],(</font>$<font class="kw">this-&gt;</font>h<font class="kw">-</font>$o<font class="kw">[</font><font class="str">'y'</font><font class="kw">])*</font>$<font class="kw">this-&gt;</font>k<font class="kw">));<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/Count 0&gt;&gt;'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'endobj'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="cmt">//Outline root<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_newobj<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>OutlineRoot<font class="kw">=</font>$<font class="kw">this-&gt;</font>n<font class="kw">;<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'&lt;&lt;/Type /Outlines /First '</font><font class="kw">.</font>$n<font class="kw">.</font><font class="str">' 0 R'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/Last '</font><font class="kw">.(</font>$n<font class="kw">+</font>$lru<font class="kw">[</font>0<font class="kw">]).</font><font class="str">' 0 R&gt;&gt;'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'endobj'</font><font class="kw">);<br>}<br><br>function </font>_putresources<font class="kw">()<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">parent::</font>_putresources<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_putbookmarks<font class="kw">();<br>}<br><br>function </font>_putcatalog<font class="kw">()<br>{<br>&nbsp;&nbsp;&nbsp;&nbsp;</font><font class="kw">parent::</font>_putcatalog<font class="kw">();<br>&nbsp;&nbsp;&nbsp;&nbsp;if(</font>count<font class="kw">(</font>$<font class="kw">this-&gt;</font>outlines<font class="kw">)&gt;</font>0<font class="kw">)<br>&nbsp;&nbsp;&nbsp;&nbsp;{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/Outlines '</font><font class="kw">.</font>$<font class="kw">this-&gt;</font>OutlineRoot<font class="kw">.</font><font class="str">' 0 R'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>$<font class="kw">this-&gt;</font>_out<font class="kw">(</font><font class="str">'/PageMode /UseOutlines'</font><font class="kw">);<br>&nbsp;&nbsp;&nbsp;&nbsp;}<br>}<br>}<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>

<H4 CLASS="st">Example</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br>define<font class="kw">(</font><font class="str">'FPDF_FONTPATH'</font><font class="kw">,</font><font class="str">'font/'</font><font class="kw">);<br>require(</font><font class="str">'bookmark.php'</font><font class="kw">);<br><br></font>$pdf<font class="kw">=new </font>PDF_Bookmark<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>Open<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>SetFont<font class="kw">(</font><font class="str">'Arial'</font><font class="kw">,</font><font class="str">''</font><font class="kw">,</font>15<font class="kw">);<br></font><font class="cmt">//Page 1<br></font>$pdf<font class="kw">-&gt;</font>AddPage<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>Bookmark<font class="kw">(</font><font class="str">'Page 1'</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Bookmark<font class="kw">(</font><font class="str">'Paragraph 1'</font><font class="kw">,</font>1<font class="kw">,-</font>1<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Cell<font class="kw">(</font>0<font class="kw">,</font>6<font class="kw">,</font><font class="str">'Paragraph 1'</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Ln<font class="kw">(</font>50<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Bookmark<font class="kw">(</font><font class="str">'Paragraph 2'</font><font class="kw">,</font>1<font class="kw">,-</font>1<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Cell<font class="kw">(</font>0<font class="kw">,</font>6<font class="kw">,</font><font class="str">'Paragraph 2'</font><font class="kw">);<br></font><font class="cmt">//Page 2<br></font>$pdf<font class="kw">-&gt;</font>AddPage<font class="kw">();<br></font>$pdf<font class="kw">-&gt;</font>Bookmark<font class="kw">(</font><font class="str">'Page 2'</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Bookmark<font class="kw">(</font><font class="str">'Paragraph 3'</font><font class="kw">,</font>1<font class="kw">,-</font>1<font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Cell<font class="kw">(</font>0<font class="kw">,</font>6<font class="kw">,</font><font class="str">'Paragraph 3'</font><font class="kw">);<br></font>$pdf<font class="kw">-&gt;</font>Output<font class="kw">();<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>
<BR>
View the result <A HREF="ex1.pdf" TARGET="_blank">here</A>.
<H4 CLASS="st">Download</H4><A HREF="script1.zip">ZIP</A> | <A HREF="script1.tgz">TGZ</A>
</BODY>
</HTML>
