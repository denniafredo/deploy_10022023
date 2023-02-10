<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
Model Sub Menu
*/
class M_soeNotifikasi extends CI_Model
{
	function list_klien(){
		$sql  = "SELECT FULLNAME, NO_KLIEN
				 FROM
				 TABEL_MEMBER
				 WHERE KD_APLIKASI = 'JSOE'";
		
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	public function notifInsert($list_klien, $list_type, $tittleInput, $messageInput, $contentInput)
	{
		$sql  = "INSERT INTO TABEL_NOTIFICATION (NOTIFICATION_ID, NOTIFICATION_LANG, NOTIFICATION_FROM, NOTIFICATION_TO, NOTIFICATION_DATE, TITLE, MESSAGE, EXPIRED, TYPE, CONTENT,KD_APLIKASI)
				 VALUES (IDNOTIFICATION.nextVal, 'ALL', '', '$list_klien', sysdate, '$tittleInput', '$messageInput', '1', '$list_type', '$contentInput', 'JSOE')";
    	
		$query = $this->db->query($sql);
	   	if($query){
	       	return "Sukses Insert Data!";
	   	}else{
	       	return "Gagal Insert Data!";
	   	}
	}

	function soenotifTables(){
		$sql  = "SELECT  NOTIFICATION_ID,
						 CASE
				            WHEN NOTIFICATION_TO IS NOT NULL THEN NOTIFICATION_TO
				            ELSE 'ALL'
				         END
				         AS NOTIFICATION_TO,
				         CASE
				            WHEN y.FULLNAME IS NOT NULL THEN y.FULLNAME
				            ELSE 'ALL'
				         END
				         AS FULLNAME,
				         CASE
				            WHEN EXPIRED = '0' THEN 'none'
				            WHEN EXPIRED = '1' THEN 'true'
				         END
				         AS BUTTON,
				         TITLE,
				         MESSAGE,
				         TYPE,
				         CONTENT,
				         NOTIFICATION_DATE
				  FROM   TABEL_NOTIFICATION x
				  LEFT  OUTER JOIN TABEL_MEMBER y
				  ON x.NOTIFICATION_TO = y.NO_KLIEN
				  ORDER BY NOTIFICATION_DATE DESC";
		
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}	

	function soenotifDetail($id){
		$sql  = "SELECT  NOTIFICATION_ID,
						 CASE
				            WHEN NOTIFICATION_TO IS NOT NULL THEN NOTIFICATION_TO
				            ELSE 'ALL'
				         END
				         AS NOTIFICATION_TO,
				         CASE
				            WHEN y.FULLNAME IS NOT NULL THEN y.FULLNAME
				            ELSE 'ALL'
				         END
				         AS FULLNAME,
				         TITLE,
				         MESSAGE,
				         TYPE,
				         CONTENT
				  FROM   TABEL_NOTIFICATION x
				  LEFT  OUTER JOIN TABEL_MEMBER y
				  ON x.NOTIFICATION_TO = y.NO_KLIEN
				  WHERE NOTIFICATION_ID = '$id'";

		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function pushDetail($id){
		$sql  = "UPDATE TABEL_NOTIFICATION
					SET EXPIRED = '0'
				  WHERE NOTIFICATION_ID = '$id'";

		$query = $this->db->query($sql);
	   	if($query){
	       	return "Sukses Push Data!";
	   	}else{
	       	return "Gagal Push Data!";
	   	}
	}

	function deleteDetail($id){
		$sql  = "DELETE
				   FROM TABEL_NOTIFICATION
				  WHERE NOTIFICATION_ID = '$id'";

		$query = $this->db->query($sql);
	   	if($query){
	       	return "Sukses Delete Data!";
	   	}else{
	       	return "Gagal Delete Data!";
	   	}
	}
}

?>