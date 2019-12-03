<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
use api\libraries\REST_Controller;

class ApiController extends REST_Controller {
    public function __construct(){
        parent::__construct();
        // Your own constructor code
        $this->load->model('ApiModel');
	}
	
	function checkKompaun_get($no_akaun){
        $data = $this->ApiModel->getKomDB($no_akaun);
        $this->response($data);
    }

    function sendKompaun_get() {
        $dateTime = date('Y-m-d H:i:s' , time());
        $time = date('H.i' , time());
        $year = date('Y', time());

        $data = array('no_kompaun'=>'string', 'alamat1'=>'string' , 'alamat2'=>'string',
            'kategori'=>'45', 'no_plat'=>'string', 'road_tax'=>'string', 'jabatan'=>'101',
            'no_rujukan'=>'string','tkh_masuk'=>$dateTime, 'kod_kesalahan'=>'string', 'tahun'=>$year, 
            'jenis'=>'1','perkara'=>'P01', 'petak'=>'string', 'masa'=>$time, 'kod_akaun'=>'76417',
			'no_pekerja'=>'12345', 'jenama'=>'string','kp'=>'string', 'kawasan'=>'string', 
			'tkh_entry'=>$dateTime, 'id_handheld'=>'string','cctv'=>'string', 'catatan'=>'string', 
			'oku'=>'string');

        $this->response($data);
	}
	
	function payKompaun_get() {
        $dateTime = date('Y-m-d H:i:s' , time());
        $time = date('H.i' , time());
        $year = date('Y', time());

        $data = array('no_kompaun'=>'string','tkh_bayar'=>$dateTime,'no_resit'=>'string',
                'amaun_bayar'=>'0.00');

        $this->response($data);
	}
     
    function sendKompaun_post() {
		$json = json_decode(json_encode($this->post()));

        $input['no_kompaun'] = empty($json->no_kompaun) ? null : $json->no_kompaun;
        $input['alamat1'] = empty($json->alamat1) ? null : $json->alamat1;
        $input['alamat2'] = empty($json->alamat2) ? null : $json->alamat2;
        $input['kategori'] = empty($json->kategori) ? null : $json->kategori;
        $input['no_plat'] = empty($json->no_plat) ? null : $json->no_plat;
        $input['road_tax'] = empty($json->road_tax) ? null : $json->road_tax;
        $input['jabatan'] = empty($json->jabatan) ? null : $json->jabatan;
        $input['no_rujukan'] = empty($json->no_rujukan) ? null : $json->no_rujukan;
        $input['tkh_masuk'] = empty($json->tkh_masuk) ? null : $json->tkh_masuk;
        $input['kod_kesalahan'] = empty($json->kod_kesalahan) ? null : $json->kod_kesalahan;
        $input['tahun'] = empty($json->tahun) ? null : $json->tahun;
        $input['jenis'] = empty($json->jenis) ? null : $json->jenis;
        $input['perkara'] = empty($json->perkara) ? null : $json->perkara;
        $input['petak'] = empty($json->petak) ? null : $json->petak;
        $input['masa'] = empty($json->masa) ? null : $json->masa;
        $input['kod_akaun'] = empty($json->kod_akaun) ? null : $json->kod_akaun;
        $input['no_pekerja'] = empty($json->no_pekerja) ? null : $json->no_pekerja;
        $input['jenama'] = empty($json->jenama) ? null : $json->jenama;
        $input['kp'] = empty($json->kp) ? null : $json->kp;
        $input['kawasan'] = empty($json->kawasan) ? null : $json->kawasan;
        $input['tkh_entry'] = empty($json->tkh_entry) ? null : $json->tkh_entry;
        $input['id_handheld'] = empty($json->id_handheld) ? null : $json->id_handheld;
        $input['cctv'] = empty($json->cctv) ? null : $json->cctv;
        $input['catatan'] = empty($json->catatan) ? null : $json->catatan;
        $input['oku'] = empty($json->oku) ? null : $json->oku;
        
        $data['message'] = $this->ApiModel->insertBilPSP($input);
        $this->response($data);
	}

    function payKompaun_post(){
        $json = json_decode(json_encode($this->post()));

        $input['no_kompaun'] = $json->no_kompaun;
        $input['tkh_bayar'] = $json->tkh_bayar;
        $input['amaun_bayar'] = $json->amaun_bayar;
        $input['no_resit'] = $json->no_resit;

        $data['message'] = $this->ApiModel->insertDataTempPSP($input);
        $this->response($data);
	}
	
	function updateKompaun_post(){
		$json = json_decode(json_encode($this->post()));

        $input['no_kompaun'] = empty($json->no_kompaun) ? null : $json->no_kompaun;
        $input['alamat1'] = empty($json->alamat1) ? null : $json->alamat1;
        $input['alamat2'] = empty($json->alamat2) ? null : $json->alamat2;
        $input['kategori'] = empty($json->kategori) ? null : $json->kategori;
        $input['no_plat'] = empty($json->no_plat) ? null : $json->no_plat;
        $input['road_tax'] = empty($json->road_tax) ? null : $json->road_tax;
        $input['jabatan'] = empty($json->jabatan) ? null : $json->jabatan;
        $input['no_rujukan'] = empty($json->no_rujukan) ? null : $json->no_rujukan;
        $input['tkh_masuk'] = empty($json->tkh_masuk) ? null : $json->tkh_masuk;
        $input['kod_kesalahan'] = empty($json->kod_kesalahan) ? null : $json->kod_kesalahan;
        $input['tahun'] = empty($json->tahun) ? null : $json->tahun;
        $input['jenis'] = empty($json->jenis) ? null : $json->jenis;
        $input['perkara'] = empty($json->perkara) ? null : $json->perkara;
        $input['petak'] = empty($json->petak) ? null : $json->petak;
        $input['masa'] = empty($json->masa) ? null : $json->masa;
        $input['kod_akaun'] = empty($json->kod_akaun) ? null : $json->kod_akaun;
        $input['no_pekerja'] = empty($json->no_pekerja) ? null : $json->no_pekerja;
        $input['jenama'] = empty($json->jenama) ? null : $json->jenama;
        $input['kp'] = empty($json->kp) ? null : $json->kp;
        $input['kawasan'] = empty($json->kawasan) ? null : $json->kawasan;
        $input['tkh_entry'] = empty($json->tkh_entry) ? null : $json->tkh_entry;
        $input['id_handheld'] = empty($json->id_handheld) ? null : $json->id_handheld;
        $input['cctv'] = empty($json->cctv) ? null : $json->cctv;
        $input['catatan'] = empty($json->catatan) ? null : $json->catatan;
        $input['oku'] = empty($json->oku) ? null : $json->oku;
		
		$data['message'] = $this->ApiModel->updateBilPSP($input);
        $this->response($data);
	}
}
