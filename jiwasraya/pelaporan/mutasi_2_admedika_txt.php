<?php
	include "../../includes/session.php";
	include "../../includes/database.php";
	$DB = new database($userid, $passwd, $DBName);
	
	$sql = "SELECT 2 recordmode,
                'P' recordtype,
                'JS_IND' payorid,
                noid memberid,
                null mappingid,
                null admedikamemberid,
                'JSSINERGY' corporateid,
                null nik,
                null division,
                null branchcode,
                null banknameandaccountno,
                null language,
                '0' typeoofwork,
                null race,
                a.prefixpertanggungan||a.nopertanggungan policynumber,
                decode(meritalstatus, 'A', 'M', 'B', 'M', 'C', 'M', 'D', 'D', 'E', 'M', 'F', 'M', 'G', 'M', 'H', 'D', 'I', 'D', 'J', 'D', 'K', 'M', 'L', 'S', 'M', 'D', 'N', 'D', 'O', 'D', 'P', 'D', meritalstatus) maritalstatus,
                null relationship, 
                TO_CHAR(mulas,'YYYYMMDD') membereffectivedate,
                TO_CHAR(ADD_MONTHS(mulas,60)-1,'YYYYMMDD') memberexpirydate,
                null internaluse20,
                null internaluse21,
                null internaluse22,
                null internaluse23,
                null internaluse24,
                null internaluse25,
				REPLACE(namaklien1,',','.') membername,
                'HOSPITAL CASH PLAN INDIVIDU' address1,
                null address2,
                null address3,
                null address4,
                'ASURANSI JS SINERGY' city,
                null state,
                null postcode,
                null telephoneoffice,
                null telephoneres,
                null telephonemobile,
                null nric,
                null passportno,
                null passportcountry,
                null internaluse40,
                null internaluse41,
                TO_CHAR(tgllahir,'YYYYMMDD') dateofbirth,
                DECODE(jeniskelamin,'L', 'M', 'F') sex,
                null internaluse44,
                kdproduk planid,
                null employmentstatus,
                null internaluse47,
                null internaluse48,
                null internaluse49,
                TO_CHAR(ADD_MONTHS(mulas,60)-1,'YYYYMMDD') dateterminated,
                null preexisting,
                null internaluse52,
                null internaluse53,
                null remarks,
                null internaluse55,
                TO_CHAR(mulas,'YYYYMMDD') membersince,
                null internaluse57,
                'I' policyinforce,
                DECODE(d.kdstatusfile, 1, 'N', 'Y') policysuspended,
                null renewalactivationdate,
                null internaluse61,
                null internaluse62,
                null internaluse63,
                null optionmode
            FROM $DBUser.tabel_200_pertanggungan a
            INNER JOIN $DBUser.tabel_214_acceptance_dokumen b ON a.prefixpertanggungan = b.prefixpertanggungan
                AND a.nopertanggungan = b.nopertanggungan
            INNER JOIN $DBUser.tabel_100_klien c ON a.notertanggung = c.noklien
            INNER JOIN $DBUser.mutasi_2_admedika_detail d ON a.prefixpertanggungan = d.prefixpertanggungan
                AND a.nopertanggungan = d.nopertanggungan
            WHERE d.nomutasi = '$nomutasi'";
	$DB->parse($sql);
	$DB->execute();
	$arr = $DB->result();
	
	if ($mode == 1) {
		header('Content-Type: text/plain');
		header("Content-Disposition: attachment;filename=$namafile");
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');
		
		foreach ($arr as $i => $r) {
			echo "\"$r[RECORDMODE]\",";
			echo "\"$r[RECORDTYPE]\",";
			echo "\"$r[PAYORID]\",";
			echo "\"$r[MEMBERID]\",";
			echo "\"$r[MAPPINGID]\",";
			echo "\"$r[ADMEDIKAMEMBERID]\",";
			echo "\"$r[CORPORATEID]\",";
			echo "\"$r[NIK]\",";
			echo "\"$r[DIVISION]\",";
			echo "\"$r[BRANCHCODE]\",";
			echo "\"$r[BANKNAMEANDACCOUNTNO]\",";
			echo "\"$r[LANGUAGE]\",";
			echo "\"$r[TYPEOFWORK]\",";
			echo "\"$r[RACE]\",";
			echo "\"$r[POLICYNUMBER]\",";
			echo "\"$r[MARITALSTATUS]\",";
			echo "\"$r[RELATIONSHIP]\",";
			echo "\"$r[MEMBEREFFECTIVEDATE]\",";
			echo "\"$r[MEMBEREXPIRYDATE]\",";
			echo "\"$r[INTERNALUSE20]\",";
			echo "\"$r[INTERNALUSE21]\",";
			echo "\"$r[INTERNALUSE22]\",";
			echo "\"$r[INTERNALUSE23]\",";
			echo "\"$r[INTERNALUSE24]\",";
			echo "\"$r[INTERNALUSE25]\",";
			echo "\"$r[MEMBERNAME]\",";
			echo "\"$r[ADDRESS1]\",";
			echo "\"$r[ADDRESS2]\",";
			echo "\"$r[ADDRESS3]\",";
			echo "\"$r[ADDRESS4]\",";
			echo "\"$r[CITY]\",";
			echo "\"$r[STATE]\",";
			echo "\"$r[POSTCODE]\",";
			echo "\"$r[TELEPHONEOFFICE]\",";
			echo "\"$r[TELEPHONERES]\",";
			echo "\"$r[TELEPHONEMOBILE]\",";
			echo "\"$r[NRIC]\",";
			echo "\"$r[PASSPORTNO]\",";
			echo "\"$r[PASSPORTCOUNTRY]\",";
			echo "\"$r[INTERNALUSE40]\",";
			echo "\"$r[INTERNALUSE41]\",";
			echo "\"$r[DATEOFBIRTH]\",";
			echo "\"$r[SEX]\",";
			echo "\"$r[INTERNALUSE44]\",";
			echo "\"$r[PLANID]\",";
			echo "\"$r[EMPLOYMENTSTATUS]\",";
			echo "\"$r[INTERNALUSE47]\",";
			echo "\"$r[INTERNALUSE48]\",";
			echo "\"$r[INTERNALUSE49]\",";
			echo "\"$r[DATETERMINATED]\",";
			echo "\"$r[PREEXISTING]\",";
			echo "\"$r[INTERNALUSE52]\",";
			echo "\"$r[INTERNALUSE53]\",";
			echo "\"$r[REMARKS]\",";
			echo "\"$r[INTERNALUSE55]\",";
			echo "\"$r[MEMBERSINCE]\",";
			echo "\"$r[INTERNALUSE57]\",";
			echo "\"$r[POLICYINFORCE]\",";
			echo "\"$r[POLICYSUSPENDED]\",";
			echo "\"$r[RENEWALACTIVATIONDATE]\",";
			echo "\"$r[INTERNALUSE61]\",";
			echo "\"$r[INTERNALUSE62]\",";
			echo "\"$r[INTERNALUSE63]\",";
			echo "\"$r[OPTIONMODE]\"";
			echo "\r\n";
		}
	} else if ($mode == 2) {
		$txt = "";
		
		$j = count($arr)-1;
		foreach ($arr as $i => $r) {
			$txt .= "\"$r[RECORDMODE]\",";
			$txt .= "\"$r[RECORDTYPE]\",";
			$txt .= "\"$r[PAYORID]\",";
			$txt .= "\"$r[MEMBERID]\",";
			$txt .= "\"$r[MAPPINGID]\",";
			$txt .= "\"$r[ADMEDIKAMEMBERID]\",";
			$txt .= "\"$r[CORPORATEID]\",";
			$txt .= "\"$r[NIK]\",";
			$txt .= "\"$r[DIVISION]\",";
			$txt .= "\"$r[BRANCHCODE]\",";
			$txt .= "\"$r[BANKNAMEANDACCOUNTNO]\",";
			$txt .= "\"$r[LANGUAGE]\",";
			$txt .= "\"$r[TYPEOFWORK]\",";
			$txt .= "\"$r[RACE]\",";
			$txt .= "\"$r[POLICYNUMBER]\",";
			$txt .= "\"$r[MARITALSTATUS]\",";
			$txt .= "\"$r[RELATIONSHIP]\",";
			$txt .= "\"$r[MEMBEREFFECTIVEDATE]\",";
			$txt .= "\"$r[MEMBEREXPIRYDATE]\",";
			$txt .= "\"$r[INTERNALUSE20]\",";
			$txt .= "\"$r[INTERNALUSE21]\",";
			$txt .= "\"$r[INTERNALUSE22]\",";
			$txt .= "\"$r[INTERNALUSE23]\",";
			$txt .= "\"$r[INTERNALUSE24]\",";
			$txt .= "\"$r[INTERNALUSE25]\",";
			$txt .= "\"$r[MEMBERNAME]\",";
			$txt .= "\"$r[ADDRESS1]\",";
			$txt .= "\"$r[ADDRESS2]\",";
			$txt .= "\"$r[ADDRESS3]\",";
			$txt .= "\"$r[ADDRESS4]\",";
			$txt .= "\"$r[CITY]\",";
			$txt .= "\"$r[STATE]\",";
			$txt .= "\"$r[POSTCODE]\",";
			$txt .= "\"$r[TELEPHONEOFFICE]\",";
			$txt .= "\"$r[TELEPHONERES]\",";
			$txt .= "\"$r[TELEPHONEMOBILE]\",";
			$txt .= "\"$r[NRIC]\",";
			$txt .= "\"$r[PASSPORTNO]\",";
			$txt .= "\"$r[PASSPORTCOUNTRY]\",";
			$txt .= "\"$r[INTERNALUSE40]\",";
			$txt .= "\"$r[INTERNALUSE41]\",";
			$txt .= "\"$r[DATEOFBIRTH]\",";
			$txt .= "\"$r[SEX]\",";
			$txt .= "\"$r[INTERNALUSE44]\",";
			$txt .= "\"$r[PLANID]\",";
			$txt .= "\"$r[EMPLOYMENTSTATUS]\",";
			$txt .= "\"$r[INTERNALUSE47]\",";
			$txt .= "\"$r[INTERNALUSE48]\",";
			$txt .= "\"$r[INTERNALUSE49]\",";
			$txt .= "\"$r[DATETERMINATED]\",";
			$txt .= "\"$r[PREEXISTING]\",";
			$txt .= "\"$r[INTERNALUSE52]\",";
			$txt .= "\"$r[INTERNALUSE53]\",";
			$txt .= "\"$r[REMARKS]\",";
			$txt .= "\"$r[INTERNALUSE55]\",";
			$txt .= "\"$r[MEMBERSINCE]\",";
			$txt .= "\"$r[INTERNALUSE57]\",";
			$txt .= "\"$r[POLICYINFORCE]\",";
			$txt .= "\"$r[POLICYSUSPENDED]\",";
			$txt .= "\"$r[RENEWALACTIVATIONDATE]\",";
			$txt .= "\"$r[INTERNALUSE61]\",";
			$txt .= "\"$r[INTERNALUSE62]\",";
			$txt .= "\"$r[INTERNALUSE63]\",";
			$txt .= "\"$r[OPTIONMODE]\"";
			
			if ($i!=$j) $txt .= "\r\n";
		}
				
		/*$myfile = fopen("admedika/$namafile", "w") or die("file tidak dapat dibuka!");
		fwrite($myfile, $txt);
		fclose($myfile);*/
		
		if (!file_exists("admedika/$namafile")) {
			echo "Maaf data gagal dibentuk";
			exit;
		}
		
		// connect and login to FTP server admedika
		$ftp_svr = "ftp.admedika.co.id";
		$thn = date('Y');
		$blnthn = date('m-Y');
		$tglblnthn = date('d-m-Y');
		$dir = "ENROLLMENT/AUTO_PROCESS/$thn/$blnthn/$tglblnthn/";
		
		shell_exec("curl ftp://$ftp_svr/$dir --user $ftp_usn:$ftp_pwd --ftp-create-dirs");
		sleep(2);
		shell_exec("curl -T ./admedika/$namafile ftp://$ftp_svr/$dir --user $ftp_usn:$ftp_pwd");
		sleep(2);
		$output = shell_exec("curl ftp://$ftp_svr/$dir --user $ftp_usn:$ftp_pwd $(tty)");
		
		if (strpos($output, $namafile) !== false) {
			unlink("./admedika/$namafile");
			$sql = "UPDATE $DBUser.mutasi_2_admedika SET tglkirim = sysdate, userkirim = user WHERE nomutasi = '$nomutasi'";
			$DB->parse($sql);
			$DB->execute();
			$DB->commit();

			echo "Batch mutasi $nomutasi berhasil di upload ke admedika";
			echo "<br><br>";
			echo "<a href='mutasi_2_admedika.php' style='text-decoration:none;'>Kembali ke menu sebelumnya</a>";
		} else {
			echo "Batch mutasi $nomutasi gagal terupload ke ftp admedika";
			echo "<br>Pesan Error : $output<br><br>";
			echo "<a href='mutasi_2_admedika.php' style='text-decoration:none;'>Kembali ke menu sebelumnya</a>";
		}
	}
?>