<?php
class Agen extends Database {
	var $userid;
	var $passwd;
	var $noagen;

	function Agen ($userid,$passwd,$noagen) {
		$this->userid=$userid;
		$this->passwd=$passwd;
		$this->noagen=$noagen;
		
		Database::database($userid, $passwd, $DBName);
		
		$sql= "select ".
          	"a.prefixagen,a.noagen,a.kdpangkat,a.kdkelasagen,".
          	"a.kdjenjangagen,a.kdunitproduksi,a.kdstatusagen,".
						"decode(a.kdstatusagen,'01','AKTIF','NON AKTIF') statusagen,".
          	"a.noskagen,to_char(a.tglskagen,'DD/MM/YYYY') as tglskagen,".
          	"to_char(a.tglrekam,'DD/MM/YYYY') as tglrekam,a.userrekam,".
          	"to_char(a.tglupdated,'DD/MM/YYYY') as tglupdated,a.userupdated,".
          	"a.norekening,a.namabank,a.kdkantor,a.kdjabatanagen,".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) namaagen,".
          	"(select namapangkat from $DBUser.tabel_406_kode_pangkat_agen where kdpangkat=a.kdpangkat) namapangkatagen,".
            "(select namakelasagen from $DBUser.tabel_408_kode_kelas_agen where kdkelasagen=a.kdkelasagen) namakelasagen,".
          	"(select namajenjangagen from $DBUser.tabel_407_kode_jenjang_agen where kdjenjangagen=a.kdjenjangagen) namajenjangagen,".
          	"(select urutanjenjang from $DBUser.tabel_407_kode_jenjang_agen where kdjenjangagen=a.kdjenjangagen) urutanjenjang,".
          	"(select namajabatanagen from $DBUser.tabel_413_jabatan_agen where kdjabatanagen=a.kdjabatanagen) namajabatanagen,".
          	"(select namaareaoffice from $DBUser.tabel_410_area_office where kdkantor=a.kdkantor and ".
          	"kdareaoffice=a.kdareaoffice) namaareaoffice,  ".
						"(select namaunitproduksi from $DBUser.tabel_410_kode_unit_produksi where ".
          	"kdunitproduksi=a.kdunitproduksi and kdareaoffice=a.kdareaoffice and kdkantor=a.kdkantor) namaunitproduksi,  ".
						"(select targetpoint from $DBUser.tabel_411_target_point_agen ".  
              "where kdjenjangagen=a.kdjenjangagen and kdpangkat=a.kdpangkat and ". 
              "kdkelasagen=a.kdkelasagen) targetpoint ".
          "from ".
          	"$DBUser.tabel_400_agen a ".
          "where ".
          	"a.noagen='$noagen'";
	
		//echo $sql."<br>";		 
    Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		
    $this->prefixagen				 = $ary["PREFIXAGEN"];
		$this->noagen				 		 = $ary["NOAGEN"];
		$this->namaagen					 = $ary["NAMAAGEN"];
		$this->pangkatagen		 	 = $ary["NAMAPANGKATAGEN"];
		$this->kelasagen			 	 = $ary["NAMAKELASAGEN"];
		$this->jenjangagen			 = $ary["NAMAJENJANGAGEN"];
		$this->urutanjenjang		 = $ary["URUTANJENJANG"];
		$this->jabatanagen			 = $ary["NAMAJABATANAGEN"];
		$this->unitproduksiagen	 = $ary["NAMAUNITPRODUKSI"];
		$this->areaoffice				 = $ary["NAMAAREAOFFICE"];
		$this->noskagen	 				 = $ary["NOSKAGEN"];
		$this->tglskagen				 = $ary["TGLSKAGEN"];
		$this->tglrekamagen			 = $ary["TGLREKAM"];
		$this->targetpoint			 = $ary["TARGETPOINT"];
		$this->statusagen			 	 = $ary["STATUSAGEN"];
	
	}
};
?>