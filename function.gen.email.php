<?php

    /*=============================================
        created by : Rizal Jihadudin
        date : 23-09-2022
        note : SEOJK - Report Nilai Tunai Unit Link 
    ================================================*/

    include './cetak_nilai_tunai.php';

    $DBx = new Database($DBUser,$DBPass,$DBName);
    $DBz = new Database($DBUser,$DBPass,$DBName);

    /*** untuk mendapatkan data email **/
    $sql_e = "SELECT  A.PREFIXPERTANGGUNGAN,
                    A.NOPERTANGGUNGAN,
                    NVL(A.NOPOLBARU, A.PREFIXPERTANGGUNGAN||A.NOPERTANGGUNGAN) NOMOR_POLIS,
                    B.NAMAKLIEN1 AS NAMA_PP,
                    NVL(B.EMAILTAGIH, B.EMAILTETAP) EMAIL
                FROM TABEL_200_PERTANGGUNGAN A 
                INNER JOIN TABEL_100_KLIEN B ON A.NOPEMEGANGPOLIS = B.NOKLIEN
                WHERE A.KDPRODUK IN ('JL4BPRO') AND A.KDPERTANGGUNGAN = '2'";
    $DBx->parse($sql_e);
    $DBx->execute();
    $data = $DBx->result();
    /** end data email */

    echo "[".date('d-m-Y H:i:s')."] ##### Mulai proses pengiriman email bulanan laporan perkembangan nilai tunai produk JL4BPRO ##### \n";
    foreach($data as $arr) {

        $noper = $arr['NOMOR_POLIS'];
        /** create PDF **/
        createPDF($noper);
        /** end create PDF **/

            if (function_exists('curl_file_create')) {
                $cFile = curl_file_create('PDF/LAPORAN_PERKEMBANGAN_NILAITUNAI_'.$noper.'.pdf');
            } else {
                $cFile = '@' . realpath('PDF/LAPORAN_PERKEMBANGAN_NILAITUNAI_'.$noper.'.pdf');
            }

            
            /** untuk kirim email **/
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://gateway.ifg-life.id/emailapi/messaging/email/send.php',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array(
                    'from_alias' => 'IFGLife',
                    'to' => $arr['EMAIL'],
                    'subject' => 'Laporan Perkembangan Nilai Tunai - POLIS : '.$noper,
                    'body' => '<p>Nasabah Yth.</p><br>
                                <p>Dengan ini kami sampaikan informasi mengenai ringkasan data pertanggungan dan rincian laporan perkembangan nilai tunai Anda, Polis No. <b>'.$noper.'</b>.</p> <br>
                               <p>Password menggunakan tanggal lahir Anda dengan format 2 (dua) angka tanggal, 2 (dua) angka bulan dan 4 (empat) angka tahun, tanpa spasi.</p>
                                    <p>Contoh: tanggal lahir Anda 15 Desember 1990 maka password untuk membuka file PDF terlampir adalah 15121990</p><br>

                                    <p>Untuk informasi dan penjelasan lebih lanjut mengenai polis tersebut, dapat menghubungi <b>Call Center 1500176,</b> email ke <b>customer_care@ifg-life.id </b> atau dapat melalui website kami di <b>https://ifg-life.id.</b></p>
                                 <p>Atas perhatian Bapak/Ibu kami ucapkan terima kasih.</p></br>

                                 <p>Hormat kami,</p>
                                   <p>PT. Asuransi Jiwa IFG</p></br>
                                   <img src="data:image/png;base64,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" width="130" height="60">',
                    'type' => 'html',
                    'files[]' => $cFile
                ),
              CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ZW1haWxjdXN0b21lcmNhcmU6QzBzdHVNZXJDNFIzIQ=='
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $res = json_decode($response);
            /** end kirim email **/


            echo "polis : ".$noper. "| ".$arr['EMAIL']." | Status Kirim :".$res->message . "\n";
            


             
            if($res->status == true){
                /** insert Log Email **/
                $sql_i = "INSERT INTO TABLE_KIRIM_EMAIL_NILAITUNAI (
                            PREFIXPERTANGGUNGAN, 
                            NOPERTANGGUNGAN, 
                            EMAIL, 
                            STATUS, 
                            TGLREKAM,
                            TGLKIRIM, 
                            KETERANGAN)
                        VALUES(
                            '".$arr['PREFIXPERTANGGUNGAN']."',
                            '".$arr['NOPERTANGGUNGAN']."',
                            '".$arr['EMAIL']."',
                            '1',
                            SYSDATE,
                            SYSDATE,
                            'Laporan Perkembangan Nilai Tunai Tanggal ".date('d-m-Y H:i:s')."'
                        )
                        ";
                $DBz->parse($sql_i);
                $DBz->execute();

                /** hapus PDF **/
                unlink($_SERVER['DOCUMENT_ROOT'] .'/jiwasraya/report/report_nilai_tunai/PDF/LAPORAN_PERKEMBANGAN_NILAITUNAI_'.$noper.'.pdf');
            }


       

        /** post ke SAE **/
        //untuk ngepost ke server SAE
        // $url_sae = "http://sae-aws.ifg-life.id/smart_ifglife/administrator/upload_nopolbaru.php?";
        // $post = array(
        //             'no_polis_baru' => 'PE001974425'
        //             ,'type_id1' => 'LAIN LAIN' // reffer to type_id1 parameter below.
        //             ,'keterangan1' => 'Testing upload file' // Dynamic
        //             ,'submit' => 'Submit'
        //             ,'dokumen'=> $cFile
        //         );

        // $ch = curl_init();            
        // curl_setopt($ch, CURLOPT_URL,$url_sae);
        // curl_setopt($ch, CURLOPT_POST,1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // curl_close($ch);
        // echo $result;

        // if($result != false) {
        //     unlink($_SERVER['DOCUMENT_ROOT'] .'/jiwasraya/report/report_nilai_tunai/PDF/REPORT_NILAI_TUNAI_UNIT_LINK_PE001974425.pdf');
        // }
    }
    echo "[".date('d-m-Y H:i:s')."] ##### Akhir proses pengiriman email bulanan laporan perkembangan nilai tunai produk JL4BPRO ##### \n\n";
        
?>