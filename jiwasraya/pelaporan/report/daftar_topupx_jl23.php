<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  include "../../includes/dropdown_date.php";
  $DB   = new database($DBUser, $DBPass, $DBName);
  $DBD  = new database($DBUser, $DBPass, $DBName);
  $DBL  = new database($DBUser, $DBPass, $DBName);

  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=daftar_topup_sekaligus.xls");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>ALL PRODUCTS - ALL PREVIOUS MONTHS, MONTH TO DATE  & YEAR TO DATE 2020</title>
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
  </head>
  <body>
		<table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
      <tr bgcolor="#89acd8" align="center">
        <td>No.</td>
        <td>Rayon Penagih</td>
        <td>Nomor Polis</td>
        <td>Tgl. Trans.</td>
        <td>Tgl. Booked</td>
        <td>Type</td>
        <!-- <td>Alokasi Investasi dari Premi</td> -->
        <td>Gross Top-Up</td>
        <td>Deskripsi</td>
      </tr>

      <?php
        $myServer   = "danareksa";
        $myUser     = "sa";
        $myPass     = "siar";
        $myDB       = "unitlink";
        $s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
        $d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");
        $tahun = date("Y");
        $bulan = date("m");
         
        $msquery = "SELECT
                      id_nasabah,
                      nomor_polis,
                      convert(varchar,trx_date, 103)as tgltrans,
                      (
                        case 
                          when tgl_booked is NULL then convert(varchar,trx_date, 103) 
                          else convert(varchar,tgl_booked, 103) 
                        end
                      )as tglbooked,
                      trx_date,
                      rp_nett,
                      kdrayonpenagih,
                      convert(varchar,tgl_nab, 103)as tgl_nab,
                      nab_beli,
                      unit,
                      rp_gross, 
                      trx_type, 
                      premi,
                      fee_agent,
                      fee_premi,
                      fee_subcription,
                      fee_topup,
                      fee_redemption,
                      nab_jual, kode_fund,
                      tgl_proses,
                      description,  
                      ( select 
                        (
                          case trx_type 
                            when 'R' then (case st_proses when '9' then keterangan+' Pada Tgl. '+convert(varchar,tgl_verifikasi, 103) else keterangan end) 
                            else keterangan 
                          end
                        ) 
                        from ul_st_proses 
                        where trx_type=a.trx_type and st_proses=a.st_proses and status=a.status and deskripsi=left(a.description,12)
                      )status 
                      FROM ul_transaksi a 
                      WHERE status IN ('GOOD FUND','SEND','NEW') 
                        --and nomor_polis='BG001615854' 
                        and year(trx_date) = ".$tahun."
                        and month(trx_date) = ".$bulan."
                        and st_proses<>'X'
                        and trx_type = 'T'
                        and description like '%SEKALIGUS%'
                        and kdrayonpenagih = 'BI'
                        and premi = 0
                      ORDER BY kdrayonpenagih ASC";
            //echo $msquery;
            $msresults= mssql_query($msquery);
            $i=1;
            while ($row = mssql_fetch_array($msresults)){
              echo "<tr align='center'>";
                echo "<td>".$i."</td>";
                print( " <td>".$row["kdrayonpenagih"]."</td>\n" );
                print( " <td>".$row["nomor_polis"]."</td>\n" );
                print( " <td>".$row["tgltrans"]."</td>\n" );
                print( " <td>".$row["tglbooked"]."</td>\n" );
                print( " <td>".$row["trx_type"]."</td>\n" );
                //print( " <td align=right>".number_format($row["premi"],2,",",".")."</td>\n" );
                print( " <td align=right>".number_format($row["rp_gross"],2,",",".")."</td>\n" );
                 print( " <td>".$row["description"]."</td>\n" );
              echo "</tr>";
              $i++;
            }

        $sql_tux = "SELECT Y.KDRAYONPENAGIH, 
                          W.PREFIXPERTANGGUNGAN, 
                          W.NOPERTANGGUNGAN,
                          TO_CHAR(W.TGLUPDATED,'DD/MM/YYYY')TGLUPDATED,
                          TO_CHAR(W.TGLTRANSFER,'DD/MM/YYYY')TGLTRANSFER,
                          W.JENIS,
                          W.NILAIBENEFIT,
                          W.PREMI,
                          W.KDBENEFIT
                        --SUM(W.PREMI * 0.1) SINGLE_TOPUP_X
                    FROM $DBUser.TABEL_UL_TRANSAKSI_TOPUP W,
                          $DBUser.TABEL_200_PERTANGGUNGAN X,
                          $DBUser.TABEL_500_PENAGIH Y
                    WHERE W.PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN
                          AND W.NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                          AND W.KDBENEFIT = 'BNFTOPUPSG'
                          AND X.NOPENAGIH = Y.NOPENAGIH
                          --AND Y.KDRAYONPENAGIH = '".$carikantor."'
                          AND X.KDPERTANGGUNGAN ='2' 
                          AND X.KDSTATUSEMAIL = '1' 
                          AND TO_CHAR(W.TGLUPDATED, 'MM/YYYY') = '".$bulan."/2020'
                          AND X.KDSTATUSFILE NOT IN ('7', 'X', 'C')
                          AND X.KDPRODUK LIKE 'JL4%'";
            $DBL->parse($sql_tux);
            $DBL->execute();
            while ($arr_tux=$DBL->nextrow()){
              echo "<tr align='center'>";
                echo "<td>".$i."</td>";
                print( " <td>".$arr_tux["KDRAYONPENAGIH"]."</td>\n" );
                print( " <td>".$arr_tux["PREFIXPERTANGGUNGAN"].$arr_tux["NOPERTANGGUNGAN"]."</td>\n" );
                print( " <td>".$arr_tux["TGLUPDATED"]."</td>\n" );
                print( " <td>".$arr_tux["TGLTRANSFER"]."</td>\n" );
                print( " <td>".$arr_tux["JENIS"]."</td>\n" );
                //print( " <td align=right>".number_format($arr_tux["NILAIBENEFIT"],2,",",".")."</td>\n" );
                print( " <td align=right>".number_format($arr_tux["PREMI"],2,",",".")."</td>\n" );
                 print( " <td>".$arr_tux["KDBENEFIT"]."</td>\n" );
              echo "</tr>";
              $i++;
            }
      ?>
    </table>
  </body>
</html>