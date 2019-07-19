<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
use api\libraries\REST_Controller;

class ApiController extends REST_Controller {
    function viewKompaun_get() {
        $dateTime = date('Y-m-d H:i:s' , time());
        $time = date('H.i' , time());
        $year = date('Y', time());

        $data = array('no_akaun'=>'string', 'alamat1'=>'string' , 'alamat2'=>'string',
            'kategori'=>'45', 'perkara1'=>'string', 'perkara3'=>'string', 'jabatan'=>'101',
            'no_rujukan'=>'string','tkh_masuk'=>$dateTime, 'no_rujukan2'=>'string', 'tahun'=>$year, 
            'jenis'=>'1','perkara'=>'P01', 'petak'=>'string', 'masa'=>$time, 'akaun'=>'76417',
            'no_pekerja'=>'12345', 'post'=>'1','tarikh_post'=>$dateTime, 'perkara4'=>'string', 
            'perkara5'=>'string', 'kp'=>'string', 'kawasan'=>'string', 'tkh_entry'=>$dateTime, 
            'id_handheld'=>'string','cctv'=>'string', 'catatan'=>'string', 'oku'=>'string', 
            'amaun_bayar'=>'0.00');

        $this->response($data);
    }

    function checkKompaun_get($no_akaun){
        $this->load->model('ApiModel');
        $data = $this->ApiModel->getKomDB($no_akaun);
        $this->response($data);
    }
     
    function sendKompaun_post() {
        $json = json_decode(json_encode($this->post()));

        $input['no_akaun'] = $json->no_akaun;
        $input['alamat1'] = $json->alamat1;
        $input['alamat2'] = $json->alamat2;
        $input['kategori'] = $json->kategori;
        $input['perkara1'] = $json->perkara1;
        $input['perkara3'] = $json->perkara3;
        $input['jabatan'] = $json->jabatan;
        $input['no_rujukan'] = $json->no_rujukan;
        $input['tkh_masuk'] = $json->tkh_masuk;
        $input['no_rujukan2'] = $json->no_rujukan2;
        $input['tahun'] = $json->tahun;
        $input['jenis'] = $json->jenis;
        $input['perkara'] = $json->perkara;
        $input['petak'] = $json->petak;
        $input['masa'] = $json->masa;
        $input['akaun'] = $json->akaun;
        $input['no_pekerja'] = $json->no_pekerja;
        $input['post'] = $json->post;
        $input['tarikh_post'] = $json->tarikh_post;
        $input['perkara4'] = $json->perkara4;
        $input['perkara5'] = $json->perkara5;
        $input['kp'] = $json->kp;
        $input['kawasan'] = $json->kawasan;
        $input['tkh_entry'] = $json->tkh_entry;
        $input['id_handheld'] = $json->id_handheld;
        $input['cctv'] = $json->cctv;
        $input['catatan'] = $json->catatan;
        $input['oku'] = $json->oku;
        $input['amaun_bayar'] = $json->amaun_bayar;
        
        $this->load->model('ApiModel');
        $data['message'] = $this->ApiModel->insertKompaun($input);
        $this->response($data);
    }

    function payKompaun_post(){
        $json = json_decode(json_encode($this->post()));

        $input['no_akaun'] = $json->no_akaun;
        $input['tkh_bayar'] = $json->tkh_bayar;
        $input['amaun_bayar'] = $json->amaun_bayar;
        $input['no_resit'] = $json->no_resit;

        $this->load->model('ApiModel');
        $data['message'] = $this->ApiModel->updateKompaun($input);
        $this->response($data);
    }

    function viewPayKompaun_get() {
        $dateTime = date('Y-m-d H:i:s' , time());
        $time = date('H.i' , time());
        $year = date('Y', time());

        $data = array('no_akaun'=>'string','tkh_bayar'=>$dateTime,'no_resit'=>'string',
                'amaun_bayar'=>'0.00');

        $this->response($data);
    }
}