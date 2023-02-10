<?
  include "../../includes/common.php"; 
?>
<HTML>
<SCRIPT language="JavaScript"><!--
function check() {
    // Prompt user for the password ...
    pwd = prompt('Masukkan password sebelum melanjutkan...','');
    // ... then set the browser location. (change the line below this one!)
    location.href = '' + escape(pwd) + '.php';
}
// -->
</SCRIPT>
<HEAD>
<TITLE>Site Entrance</TITLE>
</HEAD>
<BODY>
<DIV align="center">Anda harus mempunyai password untuk masuk halaman Admin FAQs!<P>
    <FORM>
        <INPUT type="Button" onClick="check()" value="MASUK">
    </FORM>
</DIV>
</BODY>
</HTML>

