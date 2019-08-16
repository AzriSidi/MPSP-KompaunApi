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

        $input['no_kompaun'] = $json->no_kompaun;
        $input['alamat1'] = $json->alamat1;
        $input['alamat2'] = $json->alamat2;
        $input['kategori'] = $json->kategori;
        $input['no_plat'] = $json->no_plat;
        $input['road_tax'] = $json->road_tax;
        $input['jabatan'] = $json->jabatan;
        $input['no_rujukan'] = $json->no_rujukan;
        $input['tkh_masuk'] = $json->tkh_masuk;
        $input['kod_kesalahan'] = $json->kod_kesalahan;
        $input['tahun'] = $json->tahun;
        $input['jenis'] = $json->jenis;
        $input['perkara'] = $json->perkara;
        $input['petak'] = $json->petak;
        $input['masa'] = $json->masa;
        $input['kod_akaun'] = $json->kod_akaun;
        $input['no_pekerja'] = $json->no_pekerja;
        $input['jenama'] = $json->jenama;
        $input['kp'] = $json->kp;
        $input['kawasan'] = $json->kawasan;
        $input['tkh_entry'] = $json->tkh_entry;
        $input['id_handheld'] = $json->id_handheld;
        $input['cctv'] = $json->cctv;
        $input['catatan'] = $json->catatan;
        $input['oku'] = $json->oku;
        
        $data['message'] = $this->ApiModel->insertBilPSP($input);
        $this->response($data);
		//$data = $this->decodeToken($input);
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

	/* public function decodeToken($input){	
        if (array_key_exists('token', $input) && !empty($input)) {
            $decodedToken = AUTHORIZATION::validateToken($input['token']);
            if ($decodedToken != false) {
				$json = json_decode(json_encode($decodedToken));
				$user = $json->username;
				$pass = $json->password;

				if($user=="Plamera" && $pass=="Plamera123"){
        			$data['message'] = $this->ApiModel->insertKompaun($input);
				}else{
					$data['message'] = "Wrong token";
				}

				$this->response($data);
                //return;
			}
		}
		
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    } */
}
