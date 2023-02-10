<?php
 include "./includes/session.php";
 include "./includes/database.php";
 include "./includes/klien.php";
 include "./includes/pertanggungan.php";
 include "./includes/tgl.php";   
 include "./includes/sendemail.php";
 $DB1  = New Database($userid,$passwd,$DBName);
 $DB2  = New Database($userid,$passwd,$DBName);
 $DB3  = New Database($userid,$passwd,$DBName);
 $DB4  = New Database($userid,$passwd,$DBName);
 $DB5  = New Database($userid,$passwd,$DBName);
 $DB8  = New Database($userid,$passwd,$DBName);
 $DB9  = New Database($userid,$passwd,$DBName);
 $DB10  = New Database($userid,$passwd,$DBName);
 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Mutasi Pertanggungan Freelook</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="./includes/datepicker.css">
  
<style>
  .kdf {
    outline: none;
    border: 0px solid;
    width: 40px;
    margin-left: 10px;
  }
    
  .red-border {
      border: 1px solid red !important;  
  }

</style>

<link rel="stylesheet" href="./includes/bootstrap.min.css">
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/jq.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/bootstrap-datepicker.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/bootstrap.min.js"></script>

                                                         
<script language="JavaScript" type="text/javascript">

function loadcek(theForm){

  let maxFund = parseInt($('#totalfund').val());

  let namafun1 = $(`#namafun1`).val();
  let namafun2 = $(`#namafun2`).val();

  if (maxFund < 2){
    cekKaloSatu()
  }else{
    for (let no = 1; no < maxFund; no++) {


      let kdfun1 = 'A'
      let kdfun2 = 'A'
      let jumlah1 = $('#unitx1').text();
      let jumlah2 = $('#unitx2').text();
      a = $('#unitx1').text()
              b = $('#unitx2').text()
              $('#linkx1').val(a)
              $('#linkx2').val(b)

          if ( kdfun1 == '' && jumlah1 == '' && kdfun2 == '' && jumlah2 == '' ){
            alert(`Isi Jenis Redemption & Jumlah Redemption`);
            $(`#kdredemption1`).focus()
          }

          else if ( kdfun1 == '' && jumlah1 ){
             alert(`Pilih Jenis Redemption ${namafun1}`);
             $(`#kdredemption1`).focus()
          }

          else if ( kdfun1 && jumlah1 == '' ){
             alert(`Isi Jumlah Redemption ${namafun1}`);
             $(`#linkx1`).focus()
          }

          else if ( kdfun2 == '' && jumlah2 ){
             alert(`Pilih Jenis Redemption ${namafun2}`);
             $(`#kdredemption2`).focus()
          }

          else if ( kdfun2 && jumlah2 == '' ){
             alert(`Isi Jumlah Redemption ${namafun2}`);
             $(`#linkx2`).focus()
          }

          else if ( (kdfun1 == 'A' && kdfun2 != 'A') || (kdfun1 != 'A' && kdfun2 == 'A') ){
            var konfirmasi = confirm('Kedua jenis Redemption All harus sama. Lanjutkan Redemption All?')
            if (konfirmasi){
              cekjua.jumlah1.focus()
              $('#kdredemption1').val('A')
              $('#kdredemption2').val('A')
              a = $('#unitx1').text()
              b = $('#unitx2').text()
              $('#linkx1').val(a)
              $('#linkx2').val(b)
              $("#linkx1").prop( "readonly", true )
              $('#kdredemption1').prop( "readonly", true )
              $("#linkx2").prop( "readonly", true )
              $('#kdredemption2').prop( "readonly", true )
            } else {
              $(`#kdredemption1`).focus()
            }
          }

          else if ($('#penerima').val() == ''){
            alert('Isi Nama Penerima!');
            cekjua.penerima.focus()
          }

          else if ($('#rekening').val() == ''){
            alert('Isi Nomor Rekening!');
            cekjua.rekening.focus()
          }

          else if ($('#bank').val() == ''){
            alert('Isi Nama Bank!');
            cekjua.bank.focus()
          }

          else if ($('#cabang').val() == ''){
            alert('Isi Cabang!');
            cekjua.cabang.focus()
          } 

          else {
            if (kdfun1 =='A'){
              $('#submit').prop( "hidden", false )
              $('#batal').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "disabled", true )
              $(`#kdredemption2`).prop( "disabled", true )
              $(`#linkx1`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              $(`#kodered1`).val('U')
              $(`#kodered2`).val('U')
              $("#linkx1").css("background-color","#F0F0F0");
              $("#linkx2").css("background-color","#F0F0F0");
              alert(`Data ${namafun1} Sudah Sesuai`)
            } 

            else if ( kdfun1 =='U' ){
              $('#submit').prop( "hidden", false )
              $('#batal').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "disabled", true )
              $(`#kdredemption2`).prop( "disabled", true )
              $(`#linkx1`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              $(`#kodered1`).val('U')
              $("#linkx1").css("background-color","#F0F0F0");
              $("#linkx2").css("background-color","#F0F0F0");
              alert(`Data ${namafun1} Sudah Sesuai`)
            } 

            else if ( kdfun1 =='R' ) { 
              $('#submit').prop( "hidden", false )
              $('#batal').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "disabled", true )
              $(`#kdredemption2`).prop( "disabled", true )
              $(`#linkx1`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              $(`#kodered1`).val('R')
              $("#linkx1").css("background-color","#F0F0F0");
              $("#linkx2").css("background-color","#F0F0F0");
              alert(`Data ${namafun1} Sudah Sesuai`)
            }



            if (kdfun2 =='A'){
              $('#submit').prop( "hidden", false )
              $('#batal').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "disabled", true )
              $(`#kdredemption2`).prop( "disabled", true )
              $(`#linkx1`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              $(`#kodered1`).val('U')
              $(`#kodered2`).val('U')
              $("#linkx1").css("background-color","#F0F0F0");
              $("#linkx2").css("background-color","#F0F0F0");
              alert(`Data ${namafun2} Sudah Sesuai`)
          }

          else if (kdfun2 =='U'){
              $('#submit').prop( "hidden", false )
              $('#batal').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "disabled", true )
              $(`#kdredemption2`).prop( "disabled", true )
              $(`#linkx1`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              $(`#kodered2`).val('U')
              $("#linkx1").css("background-color","#F0F0F0");
              $("#linkx2").css("background-color","#F0F0F0");
              alert(`Data ${namafun2} Sudah Sesuai`)
            }
            
          else if (kdfun2 =='R') {
              $('#submit').prop( "hidden", false )
              $('#batal').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "disabled", true )
              $(`#kdredemption2`).prop( "disabled", true )
              $(`#linkx1`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              $(`#kodered2`).val('R')
              $("#linkx1").css("background-color","#F0F0F0");
              $("#linkx2").css("background-color","#F0F0F0");
              alert(`Data ${namafun2} Sudah Sesuai`)
            }

          }          
     }
  }
}


function cekKaloSatu(theForm){
  a = $('#unitx1').text();
  $('#linkx1').val(a);
  let unit = parseFloat(cekjua.jumunit1.value);
  let nab = parseFloat(cekjua.jumnab1.value);

  let kdfun = 'A'
  let namafun = $(`#namafun1`).val();
    

    if ($('#linkx1').val() == '' && $('#kdredemption1').val() == ''){
          alert('Isi Jenis Redemption & Jumlah Redemption!');
          cekjua.kdredemption1.focus()
        } 

        else if ($('#kdredemption1').val() == ''){
          alert('Pilih Jenis Redemption!');
          cekjua.kdredemption1.focus()
        } 

        else if ($('#penerima').val() == ''){
          alert('Isi Field Nama Penerima!');
          cekjua.penerima.focus()
        }

        else if ($('#rekening').val() == ''){
          alert('Isi Field Nomor Rekening!');
          cekjua.rekening.focus()
        }

        else if ($('#bank').val() == ''){
          alert('Isi Field Bank!');
          cekjua.bank.focus()
        }

        else if ($('#cabang').val() == ''){
          alert('Isi Field Cabang!');
          cekjua.cabang.focus()
        }

        else if (kdfun=='A'){
            $('#submit').prop( "hidden", false )
            $('#batal').prop( "hidden", false )
            $('#check').prop( "hidden", true )
            $('#kdredemption1').prop( "disabled", true )
            $("#linkx1").prop( "readonly", true )
            $("#penerima").prop( "readonly", true )
            $('#rekening').prop( "readonly", true )
            $("#bank").prop( "readonly", true )
            $('#cabang').prop( "readonly", true )
            $('#alert1').prop( "hidden", true )
            $(`#kodered1`).val('U')
            $("#linkx1").css("background-color","#F0F0F0");
            alert(`Data ${namafun} Sudah Sesuai`)
        } 


          else if(kdfun =='U'){
              $('#submit').prop( "hidden", false )
              $('#batal').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "disabled", true )
              $(`#linkx1`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              $(`#kodered1`).val('U')
              $("#linkx1").css("background-color","#F0F0F0");
              alert(`Data ${namafun} Sudah Sesuai`)
            }

          else if (kdfun =='R') { 
              $('#submit').prop( "hidden", false )
              $('#batal').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "disabled", true )
              $(`#linkx1`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              $(`#kodered1`).val('R')
              $("#linkx1").css("background-color","#F0F0F0");
              alert(`Data ${namafun} Sudah Sesuai`)
            }
}


function test(val){
  let a = $(`#kdredemption${val}`).val()
  let b = $(`#unitx1`).text()
  let c = $(`#unitx2`).text()
  $(`#linkx1`).val(b)
  $(`#linkx2`).val(c)
  $(`#kdredemption1`).val('A')
  $(`#kdredemption2`).val('A')
  $("#linkx1").css("background-color","#F0F0F0");
  $("#linkx2").css("background-color","#F0F0F0");
  $(`#linkx1`).prop( "readonly", true );
  $(`#linkx2`).prop( "readonly", true );
  $( "#rupiah" ).prop( "hidden", true );
  $( "#unitt" ).prop( "hidden", true );
}

function checkVal(val,no) {

      let x = parseFloat(val)

      let namafun1 = $(`#namafun1`).val();
      let namafun2 = $(`#namafun2`).val();
      
      let unitawal1 = parseFloat($('#jumunit1').val())
      let unitawal2 = parseFloat($('#jumunit2').val())
      let unit1 = unitawal1 - x;
      let unit2 = unitawal2 - x;


      let nabawal1 = parseFloat($('#jumnab1').val())
      let nabawal2 = parseFloat($('#jumnab2').val())
      let minimal1 = x * nabawal1;
      let minimal2 = x * nabawal2;


      let rpawal1 = parseFloat($('#jumrp1').val())
      let rpawal2 = parseFloat($('#jumrp2').val())
      let rp1 = parseFloat(rpawal1 - x);
      let rp2 = parseFloat(rpawal2 - x);


      let alert1 = (1000000 / nabawal1) + 0.0001;
      let alert2 = (1000000 / nabawal2) + 0.0001;
      

      if (no == 1){

        if ($(`#kdredemption1`).val() == 'U'){
        if( minimal1 < 1000000 ){
          alert(`Minimal Pengajuan Redemption Partial Unit ${namafun1} ${alert1.toFixed(4)}`)
          $('#linkx1').val('')
          $('#linkx1').focus();
        }
        else if ( (rpawal1 - minimal1) <= 2000000 ) {
          var konfirmasi=confirm(`Sisa saldo ${namafun1} kurang dari Rp 2.000.000, Lanjukan dengan tebus (Redeem All Unit)?`)
            if (konfirmasi){
              cekjua.jumlah1.focus()
              $('#kdredemption1').val('A')
              $('#kdredemption2').val('A')
              a = $('#unitx1').text()
              b = $('#unitx2').text()
              $('#linkx1').val(a)
              $('#linkx2').val(b)
              $("#linkx1").prop( "readonly", true )
              $('#kdredemption1').prop( "readonly", true )
              $("#linkx2").prop( "readonly", true )
              $('#kdredemption2').prop( "readonly", true )
            } else {
              $('#linkx1').val('')
              $('#linkx1').focus();
            } 
        } 

        } else if ($(`#kdredemption1`).val() == 'R'){
          if( x < 1000000 ){
            alert(`Minimal Pengajuan Redemption Partial Amount ${namafun1} Rp 1.000.000`)
            $('#linkx1').val('')
            $('#linkx1').focus();
          }
          else if ( rp1 <= 2000000 ) {
            var konfirmasi=confirm(`Sisa saldo ${namafun1} kurang dari Rp 2.000.000, Lanjukan dengan tebus (Redeem All Unit)?`)
            if (konfirmasi){
              cekjua.jumlah1.focus()
              $('#kdredemption1').val('A')
              $('#kdredemption2').val('A')
              a = $('#unitx1').text()
              b = $('#unitx2').text()
              $('#linkx1').val(a)
              $('#linkx2').val(b)
              $("#linkx1").prop( "readonly", true )
              $('#kdredemption1').prop( "readonly", true )
              $("#linkx2").prop( "readonly", true )
              $('#kdredemption2').prop( "readonly", true )
            } else {
               $('#linkx1').val('')
               $('#linkx1').focus();
            }
      }
    }

      } else if (no == 2){
        if ($(`#kdredemption2`).val() == 'U'){
          if( minimal2 < 1000000 ){
            alert(`Minimal Pengajuan Redemption Partial Unit ${namafun2} ${alert2.toFixed(4)}`)
            $('#linkx2').val('')
            $('#linkx2').focus();
          }
        else if ( (rpawal2 - minimal2) <= 2000000 ){
          var konfirmasi=confirm(`Sisa saldo ${namafun2} kurang dari Rp 2.000.000, Lanjukan dengan tebus (Redeem All Unit)?`)
            if (konfirmasi){
              cekjua.jumlah2.focus()
              $('#kdredemption1').val('A')
              $('#kdredemption2').val('A')
              a = $('#unitx1').text()
              b = $('#unitx2').text()
              $('#linkx1').val(a)
              $('#linkx2').val(b)
              $("#linkx1").prop( "readonly", true )
              $('#kdredemption1').prop( "readonly", true )
              $("#linkx2").prop( "readonly", true )
              $('#kdredemption2').prop( "readonly", true )
        } else {
              $('#linkx2').val('')
              $('#linkx2').focus();
        }
      }

      } else if ($(`#kdredemption2`).val() == 'R'){
        if( x < 1000000 ){
            alert(`Minimal Pengajuan Redemption Partial Amount ${namafun2} Rp 1.000.000`)
            $('#linkx2').val('')
            $('#linkx2').focus();
        }
        else if ( rp2 <= 2000000 ){
          var konfirmasi=confirm(`Sisa saldo ${namafun2} kurang dari Rp 2.000.000, Lanjukan dengan tebus (Redeem All Unit)?`)
            if (konfirmasi){
              cekjua.jumlah2.focus()
              $('#kdredemption1').val('A')
              $('#kdredemption2').val('A')
              a = $('#unitx1').text()
              b = $('#unitx2').text()
              $('#linkx1').val(a)
              $('#linkx2').val(b)
              $("#linkx1").prop( "readonly", true )
              $('#kdredemption1').prop( "readonly", true )
              $("#linkx2").prop( "readonly", true )
              $('#kdredemption2').prop( "readonly", true )
        } else {
              $('#linkx2').val('')
              $('#linkx2').focus();
        }
      }
}
      }

       


      
}

function cancel(){
  var konfirmasi=confirm('Apakah anda yakin ingin membatalkan pengajuan?')
    if (konfirmasi){
      window.location.reload(true)
    }
}


</script>

</head>

<style>
    .important {
      color: #ff0000 !important;
      font-weight: normal;
      margin-left: 0px;
      padding: 0;
      font-size: 13px !important;
    }
  </style>

  <title></title>
</head>



<?php 
if($_POST['Submit']){
$username = $_SESSION["userid"];

    for ($i=1; $i<=$jmlf; $i++)
    {

      $jml = $_POST['jumlah'.$i];
      $koderedd = $_POST['kodered'.$i];
      
      
    
      
        $sqlinsert = "insert into $DBUser.TABEL_UL_PENGAJUAN_REDFREELOOK ".
            "(prefixpertanggungan, nopertanggungan, tgl_pengajuan, ".
            " kode_jenis, jumlah, user_update, tgl_update, status,penerima,rekening,bank,cabang,kdfund,user_rekam,tgl_rekam ".
            ")".
      "values (".
      "'$prefix','$nopertang',".
      "trunc(SYSDATE),'$koderedd',".$jml.",'$username',SYSDATE,'0','$namapenerima','$rekening','$bank','$cabang','".$kd[$i-1]."','$username',SYSDATE)";
      //var_dump($sqlinsert);die;
       $DB1->parse($sqlinsert);
       $DB1->execute();
       $DB1->commit;
       
     }
 

  echo  "<script type='text/javascript'> if(confirm('Data Berhasil Diinput, Apakah anda ingin melihat List Redemption Freelook?')){ window.location.href='mutasipengajuan_redemptionfreelook.php?noper=".$nopertang."&prefix=".$prefix."' }  </script>";
}
     
        $sql = "select a.prefixpertanggungan,a.nopertanggungan,b.kdrayonpenagih,c.namaklien1,d.namaklien1 tertanggung,b.nopenagih ".
               "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b, $DBUser.tabel_100_klien c, $DBUser.tabel_100_klien d ".
               "where (a.prefixpertanggungan || a.nopertanggungan ='$nopertanggungan' OR a.nopolbaru = '$nopertanggungan') and a.kdpertanggungan='2' ".
               "and c.noklien=b.nopenagih and a.nopenagih=b.nopenagih and a.notertanggung=d.noklien order by a.nopertanggungan";
       
       $DB2->parse($sql);
       $DB2->execute();
       $arx=$DB2->nextrow();
       $prefix = $arx["PREFIXPERTANGGUNGAN"];
       $nopert = $arx["NOPERTANGGUNGAN"];
                           
                        
       $PER = New Pertanggungan($userid,$passwd,$prefix,$nopert);
       
       

        $sqlcektrans="select count(*) ada from $DBUser.TABEL_UL_TRANSAKSI WHERE (NOMOR_POLIS = '$nopertanggungan' OR NOMOR_POLIS_NEW = '$nopertanggungan') and status<>'GOOD FUND'";
        $DB8->parse($sqlcektrans);
        $DB8->execute();       
        $arrcek = $DB8->nextrow();

        
  
         ?>
  
  <body>
   
    <form name="cekjua" action="<?php echo $PHP_SELF ?>" method="post" >
    <div class="container mt-4 mb-4" style="width: 750px;">
      <div class="card">
        <div class="card-header alert-primary text-center">
          <table border="0" width="675" cellspacing="1"> 
            <tr>
              <td colspan="2">
                <h3 class="text-center mt-3"><strong>MUTASI REDEMPTION FREELOOK<BR/>NO. POLIS<?php if (!$arx || $PER->kdstatusfile == array('1','3','4','L','A') || ( substr($PER->produk,0,3) != 'JL4' && substr($PER->produk,0,3) != 'JL3') || $arrcek["ADA"] >= '1' ) { echo '';} else {echo " - ".$nopertanggungan; } ?></strong></h3>
              </td>
            </tr>
            <tr>
              <td class="text-center"><input type="text" name="nopertanggungan" class="ccccc text-center mt-2" size="15" maxlength="15" onfocus="highlight(event);document.porm.nopol.value=''" value="" style="background-color: lightyellow;">
                <input type="submit" value="Retrieve" name="insert" onClick="test(1);"class="font-weight-bold text-light ml-2" style="background-color:#ed1c24;">
                </td>
            </tr>
          </table>
        </div>
  
        
        <?php if($insert == 'Retrieve') {
          $sqlValBatal1 = "select * from tabel_700_batal where (prefixpertanggungan || nopertanggungan ='$nopertanggungan' OR prefixpertanggungan || nopertanggungan = (select prefixpertanggungan || nopertanggungan from tabel_200_pertanggungan where nopolbaru='$nopertanggungan'))";
          $DB10->parse($sqlValBatal1);
          $DB10->execute(); 
  
          $ValBatal1 = (int)$DB10->nextrow();

          
          $sqlValBatal2 = "select * from TABEL_UL_PENGAJUAN_REDFREELOOK where (prefixpertanggungan || nopertanggungan ='$nopertanggungan' OR prefixpertanggungan || nopertanggungan = (select prefixpertanggungan || nopertanggungan from tabel_200_pertanggungan where nopolbaru='$nopertanggungan'))";
          $DB9->parse($sqlValBatal2);
          $DB9->execute(); 
  
          $ValBatal2 = (int)$DB9->nextrow();
          // var_dump($ValBatal1);
          //var_dump($sqlValBatal1);
          // die;
          if($ValBatal1<1){
            echo "<script type='text/javascript'>alert('Pembatalan Polis Belum Diajukan.');</script>";
          }
          else if($ValBatal2>=1){
            echo "<script type='text/javascript'>alert('Polis Sudah dilakukan pembatalan.');</script>";
          }
          else if (!$arx){
            $nopertanggungan = '';
            echo "<script type='text/javascript'>alert('Nomor Polis Tidak Terdaftar');</script>";
          } 
            else if(!in_array ($PER->kdstatusfile,array('1','3','4','L','A'))){
            echo "<script type='text/javascript'>alert('Polis Sedang Tidak Aktif');</script>";
          } 
          else if( substr($PER->produk,0,3) != 'JL4' && substr($PER->produk,0,3) != 'JL3') {
            echo "<script type='text/javascript'>alert('Polis bukan produk unit link!');</script>";
          } else if ($arrcek["ADA"] >= '1') {
             echo "<script type='text/javascript'>alert('Mutasi Tidak Dapat Diproses. Masih Terdapat Transaksi yang Belum GOODFUND');</script>";
          } 
          else {
          ?>
          
        <div id="form" class="card-body">
            <div class="form-group row ml-4">
              <label class="col-sm-3 col-form-label">Tertanggung</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $PER->namatertanggung; ?>" readonly="true">
              </div>
            </div>
            <div class="form-group row ml-4">
              <label class="col-sm-3 col-form-label">Pemegang Polis</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $PER->namapemegangpolis; ?>" readonly="true">
              </div>
            </div>
            <div class="form-group row ml-4">
              <label class="col-sm-3 col-form-label">Produk</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="(<?php echo $PER->produk; ?>) <?php echo $PER->namaproduk; ?>" readonly="true">
              </div>
            </div>
            <div class="form-group row ml-4">
              <label class="col-sm-3 col-form-label">Mulai Asuransi</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $PER->mulas; ?>" readonly="true">
              </div>
            </div>
            <div class="form-group row ml-4">
              <label class="col-sm-3 col-form-label">Cara Bayar</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $PER->kdcarabayar; ?>" readonly="true">
              </div>
            </div>
            <div class="form-group row ml-4">
              <label class="col-sm-3 col-form-label">JUA</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $PER->notasi.number_format($PER->jua,2);?>" readonly="true">
              </div>
            </div>
            <div class="form-group row ml-4">
              <label class="col-sm-3 col-form-label">Premi 1</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $PER->notasi.number_format($PER->premi1,2);?>" readonly="true">
              </div>
            </div>
            <div class="form-group row ml-4 mb-4">
              <label class="col-sm-3 col-form-label">Premi 2</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo $PER->notasi.number_format($PER->premi2,2);?>" readonly="true">
              </div>
            </div>
  
            <?php 
  
               $qunit="SELECT NOMOR_POLIS,
              SUM (UNIT * CASE TRX_TYPE
                      WHEN 'S' THEN 1
                                        WHEN 'T' THEN 1
                                        WHEN 'R' THEN -1
                                        WHEN 'C' THEN -1
                               END)
              SALDO,
              SUBSTR (KODE_FUND, -2) FUND,
              (SELECT NAMAFUND FROM $DBUser.TABEL_UL_KODE_FUND WHERE kdfund=SUBSTR (b.KODE_FUND, -2)) NAMAFUND,
              (SELECT nab_jual
                FROM $DBUser.TABEL_ul_nab
                WHERE kode_fund = SUBSTR (b.KODE_FUND, -2)
                  AND tgl_nab IN (select max(tgl_nab)
                            from $DBUser.TABEL_ul_nab
                            where kode_fund=SUBSTR (b.KODE_FUND, -2)
                          )
              ) NAB
            FROM $DBUser.TABEL_UL_TRANSAKSI b
              WHERE (NOMOR_POLIS = '$nopertanggungan' OR NOMOR_POLIS = (SELECT PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE NOPOLBARU = '$nopertanggungan'))
              AND STATUS = 'GOOD FUND'
              AND ST_PROSES <> 'X'
              GROUP BY   NOMOR_POLIS, KODE_FUND ORDER BY KODE_FUND ASC";

          $DB3->parse($qunit);
          $DB3->execute();

        echo "    <tr><td colspan='2'>";
        echo "<table width='100%'>";  
        echo "<tr><td align='center' class='col-form-label'><b>KETERANGAN</b></td><td align='center' class='col-form-label'><b>UNIT</b></td>".
        "<td align='center' class='col-form-label'><b>NAB</b></td><td align='center' class='col-form-label'><b>RUPIAH</b></td></tr>";
        $no = 1;
        while ($aru=$DB3->nextrow()) {

          echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
          echo "<td class='text-center'>".$aru["NAMAFUND"]."</td>";
          echo "<td align='center' id='unitx".$no."' class='text-center'>".$aru["SALDO"]."</td>";
          echo "<td align='center' class='text-center'>".$aru["NAB"]."</td>";
          echo "<td align='right' class='text-center'>".number_format($aru["SALDO"]*$aru["NAB"],2,',','.')."</td>";
          echo "<td class='text-center' align=center>".$arr["PORSI"]."</td>";
          echo "</tr>";

          echo "<input type='hidden' name='jumunit' id='jumunit".$no."' value=".$aru["SALDO"]." >";
          echo "<input type='hidden' name='jumrp' id='jumrp".$no."' value=".$aru["NAB"]*$aru["SALDO"]." >";
          echo "<input type='hidden' name='jumnab' id='jumnab".$no."' value=".$aru["NAB"]." >";
          
          $no++;
          $i++;
          }
        echo "</td></tr>";  
        echo "</table>";

        echo "</td>";
                echo "    </tr>";
        
                $sql = "select * from $DBUser.TABEL_UL_OPSI_FUND A, $DBUser.TABEL_UL_KODE_FUND B where A.KDFUND=B.KDFUND AND prefixpertanggungan = '$prefix' AND nopertanggungan = '$nopert' order by A.KDFUND ASC"; 


          $DB4->parse($sql);
          $DB4->execute();      
          $i = 1;
          while ($arr=$DB4->nextrow()) {
            echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd")." hidden>";
            echo "<tr class='ml-4'>";  
            echo "<select class='mlr-2' size='1' id='kdredemption".$i."' name='kdredemption' onload='test(".$i.")' hidden>";
            echo "<option class='text-center' value='A' selected>Redemption Freelook</option>";
          

          echo "</select>";
            // echo "<td class=\"ml-2 kdfund\">".$arr["KDFUND"]."<input class=\"ml-2 text-center\" type=\"text\" size=\"20\" name=\"jumlah".$i."\" onblur=\"checkVal(this.value,$i)\" id='linkx".$i."' onfocus=\"highlight(event)\")\"></td>";

            echo "<td class=\"ml-2 kdfund\"><input class='kdf' value='".$arr["KDFUND"]."' readonly hidden><input hidden class=\"ml-2 text-center\" type=\"text\" size=\"20\" name=\"jumlah".$i."\" onblur=\"checkVal(this.value,$i)\" id='linkx".$i."' onfocus=\"highlight(event)\")\"></td>";

          echo "</tr>";
          echo "<input type='hidden' id='kodered".$i."' name='kodered".$i."' value=''>";
          echo "<input type='hidden' name='jmlf' value='".$i."'>";
          echo "<input type='hidden' name='kd[]' id='namafun".$i."' value='".$arr["KDFUND"]."'>";          
          $i++;
        }

        $x = $i-1;

        echo "<input type='hidden' id='totalfund' value='".$x."'>";
          ?>

              
            <div class="form-group row mt-4">
              <label class="col-sm-3 col-form-label mt-3">Status : </label>
              <div class="col-sm-5">
                <p class="mt-4"><strong><?php echo $PER->statusfile ?></strong></p>
              </div>
            </div>

            <div class="form-group">
              <label>Nama Penerima<em class="important">*</em></label>
              <input type="text" class="form-control" maxlength="75" id="penerima" name="namapenerima" onkeyup="this.value = this.value.toUpperCase()">
              <small class="form-text text-muted text-right">Max 75 character</small>
            </div>

            <div class="form-group">
              <label>No. Rekening<em class="important">*</em></label>
              <input type="number" class="form-control" maxlength="50" id="rekening" name="rekening">
              <small class="form-text text-muted text-right">Max 50 character</small>
            </div>

            <div class="form-group">
              <label>Nama Bank<em class="important">*</em></label>
              <input type="text" class="form-control" id="bank" name="bank" maxlength="25" onkeyup="this.value = this.value.toUpperCase()">
              <small class="form-text text-muted text-right">Max 25 character</small>
            </div>

            <div class="form-group">
              <label>Cabang<em class="important">*</em></label>
              <input type="text" class="form-control" id="cabang" name="cabang" maxlength="100" onkeyup="this.value = this.value.toUpperCase()">
              <small class="form-text text-muted text-right">Max 100 character</small>
            </div>
  
            <div class="form-group row">
              <div class="col-sm text-center">
                <input type="button" class="btn font-weight-bold text-light bg-primary" id="check" onclick="loadcek();" value="VALIDASI" name="Check">
                <button type="button" id='batal' class="btn btn-outline-secondary font-weight-bold" onclick="cancel();" hidden> CANCEL </button>
                <input type="submit" class="btn font-weight-bold text-light bg-primary" id="submit" value="SUBMIT" name="Submit" hidden>
              </div>
            </div>

            <div class="form-group row" id="checkk"> 
             <div class="col-sm text-center">
              <small class="form-text text-muted text-center" id="alert1"><strong>VALIDASI</strong> Terlebih Dahulu <em class="important">*</em></small>
             </div>
            </div>
            <input type='hidden' name='prefix' value="<?php echo $prefix; ?>">
            <input type='hidden' name='nopertang' value="<?php echo $nopert; ?>">

          </form>
        </div>

      <?php  }} ?>
        <div class="card-footer text-muted alert-primary"></div>
      </div>
    </div>


</body>
</html>