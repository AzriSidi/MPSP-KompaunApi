<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model{
	public function getKomDB($no_akaun){
		$column = "NO_AKAUN,ALAMAT1,ALAMAT2,KATEGORI,PERKARA1,PERKARA3,JABATAN,NO_RUJUKAN,
				   to_char(TKH_MASUK,'yyyy/mm/dd hh24:mi:ss') as TKH_MASUK,
				   NO_RUJUKAN2,TAHUN,JENIS,PERKARA,PETAK,MASA,AKAUN,NO_PEKERJA,POST,
				   to_char(TARIKH_POST,'yyyy/mm/dd hh24:mi:ss') as TARIKH_POST,
				   PERKARA4,PERKARA5,KP,KAWASAN,
				   to_char(TKH_ENTRY,'yyyy/mm/dd hh24:mi:ss') as TKH_ENTRY,
				   ID_HANDHELD,CCTV,CATATAN,OKU,AMAUN_BAYAR,
				   to_char(TKH_BAYAR,'yyyy/mm/dd hh24:mi:ss') as TKH_BAYAR,NO_RESIT";
        $this->db->select($column);
        $this->db->from('HASIL.BIL');
        $this->db->where("NO_AKAUN",$no_akaun);
        $query = $this->db->get();
		if ($query->num_rows() > 0 ){
        	$row = $query->row_array();
		}else{
			$row['mgs'] = "No Data";
		}

		$this->db->close();
		return $row;
    }

	public function insertKompaun($input){
		$this->db->select("*");
        $this->db->from('HASIL.BIL');
        $this->db->where("NO_AKAUN",$input['no_akaun']);
        $query = $this->db->get();

		$this->db->set('NO_AKAUN', $input['no_akaun']);
		$this->db->set('ALAMAT1', $input['alamat1']);
		$this->db->set('ALAMAT2', $input['alamat2']);
		$this->db->set('KATEGORI', $input['kategori']);
		$this->db->set('PERKARA1',$input['perkara1']);
		$this->db->set('PERKARA3', $input['perkara3']);
		$this->db->set('JABATAN', $input['jabatan']);
		$this->db->set('NO_RUJUKAN', $input['no_rujukan']);
		$this->db->set('TKH_MASUK', "to_date('".$input['tkh_masuk']."','yyyy/mm/dd hh24:mi:ss')",FALSE);
		$this->db->set('NO_RUJUKAN2', $input['no_rujukan2']);
		$this->db->set('TAHUN', $input['tahun']);
		$this->db->set('JENIS', $input['jenis']);
		$this->db->set('PERKARA', $input['perkara']);
		$this->db->set('PETAK', $input['petak']);
		$this->db->set('MASA', $input['masa']);
		$this->db->set('AKAUN', $input['akaun']);
		$this->db->set('NO_PEKERJA', $input['no_pekerja']);
		$this->db->set('POST',$input['post']);
		$this->db->set('TARIKH_POST', "to_date('".$input['tarikh_post']."','yyyy/mm/dd hh24:mi:ss')",FALSE);
		$this->db->set('PERKARA4', $input['perkara4']);
		$this->db->set('PERKARA5', $input['perkara5']);
        $this->db->set('KP', $input['kp']);
        $this->db->set('KAWASAN', $input['kawasan']);
        $this->db->set('TKH_ENTRY', "to_date('".$input['tkh_entry']."','yyyy/mm/dd hh24:mi:ss')",FALSE);
        $this->db->set('ID_HANDHELD', $input['id_handheld']);
        $this->db->set('CCTV', $input['cctv']);
        $this->db->set('CATATAN', $input['catatan']);
        $this->db->set('OKU', $input['oku']);
        $this->db->set('AMAUN_BAYAR', $input['amaun_bayar']);
		
		if ($query->num_rows() > 0 ){
			$mgs = "Already Exist";
    	}else{			
			$this->db->insert("HASIL.BIL");
        	$mgs = "Success";
		}

        $this->db->close();
    	return $mgs;
	}

	public function updateKompaun($input){
		$this->db->set('AMAUN_BAYAR', $input['amaun_bayar']);
		$this->db->set('TKH_BAYAR', "to_date('".$input['tkh_bayar']."','yyyy/mm/dd hh24:mi:ss')",FALSE);
		$this->db->set('NO_RESIT', $input['no_resit']);
		$this->db->set('MAHKAMAH', $input['mahkamah']);
		$this->db->where('NO_AKAUN', $input['no_akaun']);
		
		$this->db->select("*");
        $this->db->from('HASIL.BIL');
        $this->db->where("NO_AKAUN",$input['no_akaun']);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0 ){
			$this->db->update('HASIL.BIL');
			$mgs = "Success";
    	}else{			
        	$mgs = "Not Exist";
		}

		$this->db->close();
		return $mgs;
	}
}