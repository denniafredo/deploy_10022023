<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>SVG template engine</TITLE>
<LINK TYPE="text/css" REL="stylesheet" HREF="../fpdf.css">
</HEAD>
<BODY ONLOAD="if(window.focus) window.focus()">
<H2>SVG template engine</H2>
<H4 CLASS="st">Informations</H4>Author: <SCRIPT TYPE="text/javascript">document.write('<A H'+'REF="m'+'ailto:alan'+'&#'+'64;'+'akbkhome.com?subject=SVG%20template%20engine">');</SCRIPT>Alan Knowles<SCRIPT TYPE="text/javascript">document.write('<\/A>');</SCRIPT><BR>License: Freeware
<H4 CLASS="st">Description</H4>XML_SvgToPdf is a PEAR package meant to read a SVG template and generate a PDF. It is
primarily designed to output labels. It has been
tested with <A HREF="http://www.sodipodi.com" TARGET="_blank">Sodipodi</A> (a free SVG
editor).<BR>
It requires that you first install:<BR>
<BR>
- PEAR<BR>
- The <A HREF="http://pear.php.net/package/XML_Parser" TARGET="_blank">XML_Parser</A> package<BR>
- The <A HREF="http://pear.php.net/package/XML_Tree" TARGET="_blank">XML_Tree</A> package<BR>
<BR>
XML_SvgToPdf needs another package, XML_Tree_Morph, included in the archive.
After you have installed the 4 packages, you must have in your PEAR/XML directory:<BR>
<BR>
- Parser.php<BR>
- SvgToPdf.php<BR>
- Tree.php<BR>
<BR>
In PEAR/XML/SvgToPdf:<BR>
<BR>
- Base.php<BR>
- G.php<BR>
- Path.php<BR>
- Rect.php<BR>
- Text.php<BR>
- Tspan.php<BR>
<BR>
In PEAR/XML/Tree:<BR>
<BR>
- Morph.php<BR>
- Node.php<BR>
<BR>
A label is defined by a dynamic area in the page. To define it, proceed like this:<BR>
<UL>
<LI>Draw a rectangle to delimit the area and mark it as non-printable (in the item properties).
Note that this property is Sodipodi-specific (it adds the <TT>sodipodi:nonprintable="true"</TT>
attribute to the <TT>rect</TT> element in the SVG file).<BR>
<LI>Add a text with 3 lines (they won't appear in the PDF):<BR>
<BR>
dynamic=name (name of the group)<BR>
cols=number (number of columns)<BR>
rows=number (number of rows)<BR>
<BR>
<LI>Add one or several texts with variables of the form {variable} in them.<BR>
<LI>Make a group with all these elements.<BR>
</UL>
The XML_SvgToPDF class provides a static factory method which creates a FPDF object
and renders the SVG template on it:<BR>
<BR>
<TT><B>object</B> construct(svg, [<B>array</B> data])</TT><BR>
<BR>
The data array has a single element, whose key is the name of the dynamic group, and the
value is an array with a number of elements. Each element corresponds to a label and is
an array which gives the values for the {variable} variables.<BR>
<BR>
Note: images and curves are not supported.<BR>
You can find more details <A HREF="http://blog.akbkhome.com/blog/archives/26_PHP_SVG_and_PDFs.html" TARGET="_blank">here</A>.
<H4 CLASS="st">Example</H4><TABLE WIDTH="100%" STYLE="color:#4040C0; border-style:ridge" BORDERCOLORLIGHT="#B0B0E0" BORDERCOLORDARK="#000000" BORDER="2" CELLPADDING=6 CELLSPACING=0 BGCOLOR="#F0F5FF"><TR><TD style="border-width:0px">
<NOBR><code><font color="#000000">
&lt;?php<br><font class="cmt">//Include PEAR path if necessary<br></font>ini_set<font class="kw">(</font><font class="str">'include_path'</font><font class="kw">,</font><font class="str">'.;C:/Php/Pear'</font><font class="kw">);<br></font>define<font class="kw">(</font><font class="str">'FPDF_FONTPATH'</font><font class="kw">,</font><font class="str">'font/'</font><font class="kw">);<br>require(</font><font class="str">'XML/SvgToPDF.php'</font><font class="kw">);<br><br></font><font class="cmt">//Print 15 labels<br></font>$label<font class="kw">=array();<br>for(</font>$i<font class="kw">=</font>1<font class="kw">;</font>$i<font class="kw">&lt;=</font>15<font class="kw">;</font>$i<font class="kw">++)<br>&nbsp;&nbsp;&nbsp;&nbsp;</font>$label<font class="kw">[]=array(</font><font class="str">'name'</font><font class="kw">=&gt;</font><font class="str">"Name $i"</font><font class="kw">, </font><font class="str">'address'</font><font class="kw">=&gt;</font><font class="str">"Address $i"</font><font class="kw">, </font><font class="str">'city'</font><font class="kw">=&gt;</font><font class="str">"City $i"</font><font class="kw">);<br></font>$pdf<font class="kw">=</font>XML_SvgToPDF<font class="kw">::</font>construct<font class="kw">(</font><font class="str">'ex.svg'</font><font class="kw">, array(</font><font class="str">'label'</font><font class="kw">=&gt;</font>$label<font class="kw">));<br></font>$pdf<font class="kw">-&gt;</font>Output<font class="kw">();<br></font>?&gt;
</font>
</code></NOBR></TD></TR></TABLE>
<BR>
View the result <A HREF="ex43.pdf" TARGET="_blank">here</A>.
<H4 CLASS="st">Download</H4><A HREF="script43.zip">ZIP</A> | <A HREF="script43.tgz">TGZ</A>
</BODY>
</HTML>
