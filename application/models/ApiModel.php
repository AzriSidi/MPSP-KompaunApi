<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model{

	public function getKomDB($no_akaun){
		$column = "t1.NO_AKAUN,t1.ALAMAT1,t1.ALAMAT2,t1.KATEGORI,t1.PERKARA1,t1.PERKARA3,
				   t1.JABATAN,t1.NO_RUJUKAN,to_char(TKH_MASUK,'yyyy/mm/dd hh24:mi:ss') TKH_MASUK,
				   t1.NO_RUJUKAN2,t1.TAHUN,t1.JENIS,t1.PERKARA,t1.PETAK,t1.MASA,t1.AKAUN,t1.NO_PEKERJA,
				   t1.PERKARA4,t1.KP,t1.KAWASAN,to_char(TKH_ENTRY,'yyyy/mm/dd hh24:mi:ss') TKH_ENTRY,
				   t1.ID_HANDHELD,t1.CCTV,t1.CATATAN,t1.OKU,
				   to_char(TKH_BAYAR,'yyyy/mm/dd hh24:mi:ss') TKH_BAYAR, t2.AMAUN_BAYAR, t2.NO_RESIT";

		$column2 = "NO_AKAUN,ALAMAT1,ALAMAT2,KATEGORI,PERKARA1,PERKARA3,
					JABATAN,NO_RUJUKAN,to_char(TKH_MASUK,'yyyy/mm/dd hh24:mi:ss') TKH_MASUK,
					NO_RUJUKAN2,TAHUN,JENIS,PERKARA,PETAK,MASA,AKAUN,NO_PEKERJA,
					PERKARA4,KP,KAWASAN,to_char(TKH_ENTRY,'yyyy/mm/dd hh24:mi:ss') TKH_ENTRY,
					ID_HANDHELD,CCTV,CATATAN,OKU";
		
		$this->db->select($column)
			->from('KOMPAUN.BIL_PSP t1')
			->join('MPSP.DATATEMP_PSP t2', 't1.NO_AKAUN = t2.NO_AKAUN', 'INNER')
			->where('t1.NO_AKAUN',$no_akaun);
		$query = $this->db->get();

		$this->db->select($column2)
			->from('KOMPAUN.BIL_PSP')
			->where('NO_AKAUN',$no_akaun);
		$query2 = $this->db->get();
		
		if ($query->num_rows() > 0){
        	$row = $query->result_array();
		}else{
			if($query2->num_rows() > 0){
				$row = $query2->result_array();
			}else{
				$row['mgs'] = "No Data";
			}
		}

		$this->db->close();
		return $row;
    }

	public function insertBilPSP($input){
		$this->db->select("*")
        	->from('KOMPAUN.BIL_PSP')
        	->where("NO_AKAUN",$input['no_kompaun']);
        $query = $this->db->get();

		$this->db->set('NO_AKAUN', $input['no_kompaun'])
			->set('ALAMAT1', $input['alamat1'])
			->set('ALAMAT2', $input['alamat2'])
			->set('KATEGORI', $input['kategori'])
			->set('PERKARA1',$input['no_plat'])
			->set('PERKARA3', $input['road_tax'])
			->set('JABATAN', $input['jabatan'])
			->set('NO_RUJUKAN', $input['no_rujukan'])
			->set('TKH_MASUK', "to_date('".$input['tkh_masuk']."','yyyy/mm/dd hh24:mi:ss')",FALSE)
			->set('NO_RUJUKAN2', $input['kod_kesalahan'])
			->set('TAHUN', $input['tahun'])
			->set('JENIS', $input['jenis'])
			->set('PERKARA', $input['perkara'])
			->set('PETAK', $input['petak'])
			->set('MASA', $input['masa'])
			->set('AKAUN', $input['kod_akaun'])
			->set('NO_PEKERJA', $input['no_pekerja'])
			->set('PERKARA4', $input['jenama'])
        	->set('KP', $input['kp'])
        	->set('KAWASAN', $input['kawasan'])
        	->set('TKH_ENTRY', "to_date('".$input['tkh_entry']."','yyyy/mm/dd hh24:mi:ss')",FALSE)
        	->set('ID_HANDHELD', $input['id_handheld'])
        	->set('CCTV', $input['cctv'])
        	->set('CATATAN', $input['catatan'])
        	->set('OKU', $input['oku']);
		
		if ($query->num_rows() > 0){
			$mgs = "Already Exist";
    	}else{			
			$this->db->insert("KOMPAUN.BIL_PSP");
        	$mgs = "Success";
		}

        $this->db->close();
    	return $mgs;
	}

	public function insertDataTempPSP($input){
		$this->db->select("*")
        	->from('MPSP.DATATEMP_PSP')
        	->where("NO_AKAUN",$input['no_kompaun']);
        $query = $this->db->get();

		$this->db->set('NO_AKAUN', $input['no_kompaun'])
			->set('TKH_BAYAR', "to_date('".$input['tkh_bayar']."','yyyy/mm/dd hh24:mi:ss')",FALSE)
			->set('AMAUN_BAYAR', $input['amaun_bayar'])
			->set('NO_RESIT', $input['no_resit']);
		
		if ($query->num_rows() > 0){
			$mgs = "Already Exist";
		}else{			
			$this->db->insert("MPSP.DATATEMP_PSP");
			$mgs = "Success";
		}	

		$this->db->close();
		return $mgs;
	}

	public function updateBilPSP($input){
		$this->db->select("*")
        	->from('KOMPAUN.BIL_PSP')
        	->where("NO_AKAUN",$input['no_kompaun']);
        $query = $this->db->get();

		$this->db->set('ALAMAT1', $input['alamat1'])			
			->set('ALAMAT2', $input['alamat2'])
			->set('KATEGORI', $input['kategori'])
			->set('PERKARA1',$input['no_plat'])
			->set('PERKARA3', $input['road_tax'])
			->set('JABATAN', $input['jabatan'])
			->set('NO_RUJUKAN', $input['no_rujukan'])
			->set('TKH_MASUK', "to_date('".$input['tkh_masuk']."','yyyy/mm/dd hh24:mi:ss')",FALSE)
			->set('NO_RUJUKAN2', $input['kod_kesalahan'])
			->set('TAHUN', $input['tahun'])
			->set('JENIS', $input['jenis'])
			->set('PERKARA', $input['perkara'])
			->set('PETAK', $input['petak'])
			->set('MASA', $input['masa'])
			->set('AKAUN', $input['kod_akaun'])
			->set('NO_PEKERJA', $input['no_pekerja'])
			->set('PERKARA4', $input['jenama'])
        	->set('KP', $input['kp'])
        	->set('KAWASAN', $input['kawasan'])
        	->set('TKH_ENTRY', "to_date('".$input['tkh_entry']."','yyyy/mm/dd hh24:mi:ss')",FALSE)
        	->set('ID_HANDHELD', $input['id_handheld'])
        	->set('CCTV', $input['cctv'])
        	->set('CATATAN', $input['catatan'])
			->set('OKU', $input['oku'])
			->where('NO_AKAUN', $input['no_kompaun']);
		
		if ($query->num_rows() > 0){
			$this->db->update("KOMPAUN.BIL_PSP");
			$mgs = "Success";
		}else{
			$mgs = "Data not Exist";
		}
		
        $this->db->close();
    	return $mgs;
	}
}
