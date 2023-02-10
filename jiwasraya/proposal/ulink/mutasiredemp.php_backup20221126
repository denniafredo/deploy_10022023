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
 

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Mutasi Pertanggungan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="./includes/datepicker.css">
  
<style>
    
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


      let kdfun1 = $(`#kdredemption1`).val()
      let kdfun2 = $(`#kdredemption2`).val()

          if (($('#link1').val() == '' || $('#kdredemption1').val() == '') && ($('#linkx2').val() == '' || $('#kdredemption2').val() == '')){
            alert(`Isi Jenis Redemption & Jumlah Redemption Kode Fund`);
            $(`#kdredemption1`).focus()
          } 

          else if ($('#kdredemption1').val() != '' && $('#linkx1').val() == ''){
             $(`#kdredemption1`).val() == ''
          }

          else if ($('#kdredemption2').val() != '' && $('#linkx2').val() == ''){
             $('#kdredemption2').val() == ''
          }

          else if ($('#kdredemption1').val() == '' && $('#linkx1').val() != ''){
            $('#linkx1').val() == ''
          }

          else if ($('#kdredemption2').val() == '' && $('#linkx2').val() != ''){
            $('#linkx2').val() == ''
          }

          // else if (($('#kdredemption1').val() == '' && $('#link1').val() != '') || ($('#kdredemption2').val() == '' && $('#link2').val() != '')){
          //   alert(`Pilih Jenis Redemption`);
          //   // $(`#kdredemption1`).focus()
          // }

          // else if (($('#kdredemption1').val() == '' && $('#link1').val() != '') || ($('#kdredemption2').val() == '' && $('#link2').val() != '')){
          //   alert(`Pilih Jenis Redemption`);
          //   $(`#kdredemption1`).focus()
          // }

          // else if ($('#linkx1').val() == ''){
          //   alert(`Isi Jumlah Redemption Kode Fund ${namafun1}`);
          //   $('#linkx1').focus()
          // }
          // else if ($('#linkx2').val() == '' && $('#kdredemption2').val() == ''){
          //   alert(`Isi Jenis Redemption & Jumlah Redemption Kode Fund ${namafun2}`);
          //   $(`#kdredemption2`).focus()
          // }

          // else if ($('#kdredemption2').val() == ''){
          //   alert(`Pilih Jenis Redemption Kode Fund ${namafun2}`);
          //   $(`#kdredemption2`).focus()
          // } 

          // else if ($('#linkx2').val() == ''){
          //   alert(`Isi Jumlah Redemption Kode Fund ${namafun2}`);
          //   $('#linkx2').focus()
          // }

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

          else if (kdfun1 =='A'){
              $('#submit').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "readonly", true )
              $(`#linkx1`).prop( "readonly", true )
              $(`#kdredemption2`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              $(`#kdredemption1`).val('U')
              alert(`Data ${namafun1} Sudah Sesuai`)
          } 

          else if(kdfun1 =='U'){
              $('#submit').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "readonly", true )
              $(`#linkx1`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              alert(`Data ${namafun1} Sudah Sesuai`)
            }

          else if (kdfun1 =='R') { 
              $('#submit').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption2`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              alert(`Data ${namafun2} Sudah Sesuai`)
            }



          if ($('#penerima').val() == ''){
            cekjua.penerima.focus()
          }

          else if ($('#rekening').val() == ''){
            cekjua.rekening.focus()
          }

          else if ($('#bank').val() == ''){
            cekjua.bank.focus()
          }

          else if ($('#cabang').val() == ''){
            cekjua.cabang.focus()
          }

          else if (kdfun2 =='A'){
              $('#submit').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "readonly", true )
              $(`#linkx1`).prop( "readonly", true )
              $(`#kdredemption2`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              $(`#kdredemption2`).val('U')
              alert(`Data ${namafun2} Sudah Sesuai`)
          }

          else if (kdfun2 =='U'){
              $('#submit').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption2`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              alert(`Data ${namafun2} Sudah Sesuai`)
            }
            
          else if (kdfun2 =='R') {   
              $('#submit').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "readonly", true )
              $(`#linkx1`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              alert(`Data ${namafun1} Sudah Sesuai`)
            }

            
            }
            }
}


function cekKaloSatu(theForm){
  let unit = parseFloat(cekjua.jumunit1.value);
  let nab = parseFloat(cekjua.jumnab1.value);

  let kdfun = $(`#kdredemption1`).val()
  let namafun = $(`#namafun1`).val();
    

    if ($('#linkx1').val() == '' && $('#kdredemption1').val() == ''){
          alert('Isi Jenis Redemption & Jumlah Redemption!');
          cekjua.kdredemption1.focus()
        } 

        else if ($('#kdredemption1').val() == ''){
          alert('Pilih Jenis Redemption!');
          cekjua.kdredemption1.focus()
        } 

        else if ($('#linkx1').val() == ''){
          alert('Isi Jumlah Redemption!');
          cekjua.jumlah.focus()
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
            $('#check').prop( "hidden", true )
            $('#kdredemption1').prop( "readonly", true )
            $("#linkx1").prop( "readonly", true )
            $("#penerima").prop( "readonly", true )
            $('#rekening').prop( "readonly", true )
            $("#bank").prop( "readonly", true )
            $('#cabang').prop( "readonly", true )
            $('#alert1').prop( "hidden", true )
            $('#kdredemption1').val('U')
            alert(`Data ${namafun} Sudah Sesuai`)
        } 


          else if(kdfun =='U'){
              $('#submit').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption1`).prop( "readonly", true )
              $(`#linkx1`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              alert(`Data ${namafun} Sudah Sesuai`)
            }

          else if (kdfun =='R') { 
              $('#submit').prop( "hidden", false )
              $('#check').prop( "hidden", true )
              $(`#kdredemption2`).prop( "readonly", true )
              $(`#linkx2`).prop( "readonly", true )
              $("#penerima").prop( "readonly", true )
              $('#rekening').prop( "readonly", true )
              $("#bank").prop( "readonly", true )
              $('#cabang').prop( "readonly", true )
              $('#alert1').prop( "hidden", true )
              alert(`Data ${namafun} Sudah Sesuai`)
            }
}


function test(val){
  let a = $(`#kdredemption1`).val()
  let d = $(`#kdredemption2`).val()

  if(a == 'A'){
    let b = $(`#unitx1`).text()
    let c = $(`#unitx2`).text()
    $(`#linkx1`).val(b)
    $(`#linkx2`).val(c)
    $(`#kdredemption1`).val('A')
    $(`#kdredemption2`).val('A')
    $(`#linkx1`).prop( "readonly", true );
    $(`#linkx2`).prop( "readonly", true );
    $( "#rupiah" ).prop( "hidden", true );
    $( "#unitt" ).prop( "hidden", true );
  }

  else if(d == 'A'){
    let b = $(`#unitx1`).text()
    let c = $(`#unitx2`).text()
    $(`#linkx1`).val(b)
    $(`#linkx2`).val(c)
    $(`#kdredemption1`).val('A')
    $(`#kdredemption2`).val('A')
    $(`#linkx1`).prop( "readonly", true );
    $(`#linkx2`).prop( "readonly", true );
    $( "#rupiah" ).prop( "hidden", true );
    $( "#unitt" ).prop( "hidden", true );
  }

  else if (a == 'U'){
    $(`#linkx${val}`).val('')
    $(`#linkx${val}`).prop( "readonly", false );
    $( "#rupiah" ).prop( "hidden", true );
    $( "#unitt" ).prop( "hidden", false );
  }

  else if (a == 'R'){
    $(`#linkx${val}`).val('')
    $(`#linkx${val}`).prop( "readonly", false );
    $( "#unitt" ).prop( "hidden", true );
    $( "#rupiah" ).prop( "hidden", false );
  }

  else if (a == ''){
    $(`#linkx${val}`).val('')
    $( "#unitt" ).prop( "hidden", true );
    $( "#rupiah" ).prop( "hidden", true );
  }
}

function checkVal(val,no) {

      let x = parseFloat(val)
      let unitawal1 = parseFloat($('#jumunit1').val())
      let unitawal2 = parseFloat($('#jumunit2').val())
      let rpawal1 = parseFloat($('#jumrp1').val())
      let rpawal2 = parseFloat($('#jumrp2').val())
      let unit1 = unitawal1 - x;
      let unit2 = unitawal2 - x;
      let rp1 = parseFloat(rpawal1 - x);
      let rp2 = parseFloat(rpawal2 - x);

      if (no == 1){

        if ($(`#kdredemption1`).val() == 'U'){
        if( unit1 < 1000 ){
          var konfirmasi=confirm('Sisa saldo kurang dari 1000, Lanjukan dengan tebus (Redeem All Unit)?')
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
          if( rp1 <= 2000000 ){
            var konfirmasi=confirm('Sisa saldo kurang dari Rp 2.000.000, Lanjukan dengan tebus (Redeem All Unit)?')
            if (konfirmasi){
              cekjua.jumlah1.focus()
              $('#kdredemption1').val('A')
              $('#kdredemption1').val('A')
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
        if( unit2 < 1000 ){
          var konfirmasi=confirm('Sisa saldo kurang dari 1000, Lanjukan dengan tebus (Redeem All Unit)?')
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
        if( rp2 <= 2000000 ){
          var konfirmasi=confirm('Sisa saldo kurang dari Rp 2.000.000, Lanjukan dengan tebus (Redeem All Unit)?')
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
    // for ($i=1; $i<=$jmlf; $i++)
    // {
    //   var_dump($kd[$i-1]);
    // }die;
    // $namapenerima = str_replace("'", "`", $penerima);


    for ($i=1; $i<=$jmlf; $i++)
    {

    	$jml = $_POST['jumlah'.$i];
      	$sqlinsert = "insert into $DBUser.TABEL_UL_PENGAJUAN_REDEMPTION ".
            "(prefixpertanggungan, nopertanggungan, tgl_pengajuan, ".
            " kode_jenis, jumlah, user_update, tgl_update, status,penerima,rekening,bank,cabang,kdfund ".
            ")".
      "values (".
      "'$prefix','$nopertang',".
      "to_date(SYSDATE,'DD/MM/YYYY'),'$kdredemption',".$jml.",user,SYSDATE,'0','$namapenerima','$rekening','$bank','$cabang','".$kd[$i-1]."')";

       $DB1->parse($sqlinsert);
       $DB1->execute();
       $DB1->commit;
       
     }
 

      // $sqlinsert = "insert into $DBUser.TABEL_UL_PENGAJUAN_REDEMPTION ".
      //       "(prefixpertanggungan, nopertanggungan, tgl_pengajuan, ".
      //       " kode_jenis, jumlah, user_update, tgl_update, status,penerima,rekening,bank,cabang,kdfund ".
      //       ")".
      // "values (".
      // "'$prefix','$nopertang',".
      // "to_date(SYSDATE,'DD/MM/YYYY'),'$kdredemption',$jumlah,user,SYSDATE,'0','$namapenerima','$rekening','$bank','$cabang','$kd')";

      //  $DB1->parse($sqlinsert);
      //  $DB1->execute();
      //  $DB1->commit;

  echo  "<script type='text/javascript'> if(confirm('Data Berhasil Diinput, Apakah anda ingin melihat List Redemption?')){ window.location.href='mutasipengajuan_redemption.php?noper=".$nopertang."&prefix=".$prefix."' }  </script>";
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
   <!--  <?php var_dump($arrcek["ADA"]) ?> -->
    <form name="cekjua" action="<?php echo $PHP_SELF ?>" method="post" >
    <div class="container mt-4 mb-4" style="width: 750px;">
      <div class="card">
        <div class="card-header alert-primary text-center">
          <table border="0" width="675" cellspacing="1">
            <tr>
              <td colspan="2">
                <h3 class="text-center mt-3"><strong>NO. POLIS<?php if (!$arx || $PER->statusfile == "LAPSE" || ( substr($PER->produk,0,3) != 'JL4' && substr($PER->produk,0,3) != 'JL3') || $arrcek["ADA"] >= '1' ) { echo '';} else {echo " - ".$nopertanggungan; } ?></strong></h3>
              </td>
            </tr>
            <tr>
              <td class="text-center"><input type="text" name="nopertanggungan" class="ccccc text-center mt-2" size="15" maxlength="15" onfocus="highlight(event);document.porm.nopol.value=''" value="" style="background-color: lightyellow;">
                <input type="submit" value="Retrieve" name="insert" class="font-weight-bold text-light ml-2" style="background-color:#ed1c24;">
                </td>
            </tr>
          </table>
        </div>
  
        
        <?php if($insert == 'Retrieve') {
            if (!$arx){
              $nopertanggungan = '';
              echo "<script type='text/javascript'>alert('Nomor Polis Tidak Terdaftar');</script>";
            } 
              else if ($PER->statusfile != "AKTIF"){
              echo "<script type='text/javascript'>alert('Polis Sedang Tidak Aktif');</script>";
            } 
            else if( substr($PER->produk,0,3) != 'JL4' && substr($PER->produk,0,3) != 'JL3') {
              echo "<script type='text/javascript'>alert('Polis bukan produk unit link!');</script>";
            } else if ($arrcek["ADA"] >= '1') {
              echo "<script type='text/javascript'>alert('Mutasi Tidak Dapat Diproses. Masih Terdapat Transaksi yang Belum GOODFUND');</script>";
            } else {
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
              GROUP BY   NOMOR_POLIS, KODE_FUND";

          $DB3->parse($qunit);
          $DB3->execute();

        echo "    <tr><td colspan='2'>";
        echo "<table width='100%'>";  
        echo "<tr><td align='center' class='col-form-label'><b>KETERANGAN</b></td><td align='center' class='col-form-label'><b>UNIT</b></td>".
        "<td align='center' class='col-form-label'><b>NAB</b></td><td align='center' class='col-form-label'><b>RUPIAH</b></td></tr>";
        $no = 1;
        while ($aru=$DB3->nextrow()) {

          // echo "<div class='container w-100 mb-5 mt-5' style='margin-left: 15px'>";
          // echo    "<div class='row w-100 text-center'>";
          // echo      "<div class='col-4 alert-primary'><strong>Keterangan</strong></div>";
          // echo      "<div class='col alert-primary'><strong>Unit</strong></div>";
          // echo      "<div class='col alert-primary'><strong>NAB</strong></div>";
          // echo      "<div class='col-3 alert-primary'><strong>Rupiah</strong></div>";
          // echo      "<div class='w-100'></div>";
          // echo      "<div class='col-4' style='background-color:#ECEFF1;'> ".$aru["NAMAFUND"]." </div>";
          // echo      "<div id='unitx' class='col' style='background-color: #ECEFF1;'> ".$aru["SALDO"]." </div>";
          // echo      "<div class='col' style='background-color:#ECEFF1;'> ".$aru["NAB"]." </div>";
          // echo      "<div class='col-3' style='background-color:#ECEFF1;'> ".number_format($aru["SALDO"]*$aru["NAB"],2,',','.')." </div>";
          // echo    "</div>";
          // echo  "</div>";

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
          echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
            echo "    <tr class='ml-4'> <br>";
                echo "      <td class='ml-1 mb-2'>Pilih Jenis Redemption </td>";
                echo "      <td class='ml-1'>: </td>";
            echo "<select class='mlr-2' size='1' id='kdredemption".$i."' name='kdredemption' onChange='test(".$i.")'>";

          
            echo "<option class='text-center' selected value='' >- SELECT -</option>";
            echo "<option class='text-center' value='R'>Redemption Partial Amount</option>";
            echo "<option class='text-center' value='U'>Redemption Partial Unit</option>";
            echo "<option class='text-center' value='A'>Redemption All</option>";
          

          echo "</select>";
            echo "<td class=\"ml-2\">".$arr["KDFUND"]."<input class=\"ml-2 text-center\" type=\"text\" size=\"20\" name=\"jumlah".$i."\" onblur=\"checkVal(this.value,$i)\" id='linkx".$i."' onfocus=\"highlight(event)\")\"></td>";

          echo "</tr>";
          echo "<input type='hidden' name='jmlf' value='".$i."'>";
          echo "<input type='hidden' name='kd[]' id='namafun".$i."' value='".$arr["KDFUND"]."'>";          
          $i++;
        }

        $x = $i-1;

        echo "<input type='hidden' id='totalfund' value='".$x."'>";
          ?>

              
            <div class="form-group row mt-4">
              <label class="col-sm-3 col-form-label mt-3">Status</label>
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