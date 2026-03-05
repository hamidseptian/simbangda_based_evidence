<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Validasi.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Kuisioner extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model([
        //     'validasi/validasi_fisik_model' => 'validasi_fisik_model',
        //      'kegiatan_apbd/kegiatan_apbd_model'   => 'kegiatan_apbd_model',
        //      'informasi/bantuan_model'   => 'bantuan_model',
        //      'informasi/pengumuman_model'   => 'pengumuman_model',
        //     'datatables_model'              => 'datatables_model'
        // ]);
    }

     public function index()
    {
      
        $breadcrumbs    = $this->breadcrumbs;
        $breadcrumbs->add('Admin', base_url());
        $breadcrumbs->add('Export Import', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
        $data['title']          = "Kuisioner";
        $breadcrumbs->render();
        $q_kuisioner = $this->db->query("SELECT  id_kuisioner, judul_kuisioner,  tahun, kode_tahap from kuisioner order by id_kuisioner desc")->result_array();
        $data['icon']           = "metismenu-icon pe-7s-user";
        $data['description']    = "Menampilkan Pengelolaan Import Data Excel pada SIPD";
        $data['breadcrumbs']    = $breadcrumbs->render();
        $page                   = 'kuisioner/survei/index';
      
        $data['data']           = $q_kuisioner;
        $data['id_group']           = $this->session->userdata('id_group');
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('kuisioner/survei/css', $data, true);
        $data['extra_js']       = $this->load->view('kuisioner/survei/js', $data, true);
        $data['modal']          = $this->load->view('kuisioner/survei/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    
       
    }
   


    public function redirect_pengisian($id_kuisioner)
    {
        $id_kuisioner = sbe_crypt($id_kuisioner,'D');
        $breadcrumbs    = $this->breadcrumbs;
        $breadcrumbs->add('Admin', base_url());
        $breadcrumbs->add('Export Import', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
        $data['title']          = "Kuisioner";


        $q_kuisioner = $this->db->query("SELECT  id_kuisioner, judul_kuisioner, status from kuisioner where id_kuisioner='$id_kuisioner'")->row_array();
        $data['icon']           = "metismenu-icon pe-7s-user";
        $data['description']    = "Pengisian Kuisioner";
        $data['id_kuisioner']    =$q_kuisioner['id_kuisioner'];
        $data['kuisioner']    =$q_kuisioner;
        $data['breadcrumbs']    = $breadcrumbs->render();
        $page                   = 'kuisioner/survei/redirect_pengisian';
      
        $data['title']          = "Kuisioner";
        $data['data']           = $q_kuisioner;
        $data['id_group']           = $this->session->userdata('id_group');
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('kuisioner/survei/css', $data, true);
        $data['extra_js']       = $this->load->view('kuisioner/survei/js', $data, true);
        $data['modal']          = $this->load->view('kuisioner/survei/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    
       
    }


    public function selesai_pengisian($id_kuisioner)
    {
        $id_kuisioner = sbe_crypt($id_kuisioner,'D');
        $breadcrumbs    = $this->breadcrumbs;
        $breadcrumbs->add('Admin', base_url());
        $breadcrumbs->add('Export Import', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
        $data['title']          = "Kuisioner";


        $q_kuisioner = $this->db->query("SELECT  id_kuisioner, judul_kuisioner, status from kuisioner where id_kuisioner='$id_kuisioner'")->row_array();
        $data['icon']           = "metismenu-icon pe-7s-user";
        $data['description']    = "Pengisian Kuisioner";
        $data['id_kuisioner']    =$q_kuisioner['id_kuisioner'];
        $data['kuisioner']    =$q_kuisioner;
        $data['breadcrumbs']    = $breadcrumbs->render();
        $page                   = 'kuisioner/survei/selesai_pengisian';
      
        $data['title']          = "Kuisioner";
        $data['data']           = $q_kuisioner;
        $data['id_group']           = $this->session->userdata('id_group');
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('kuisioner/survei/css', $data, true);
        $data['extra_js']       = $this->load->view('kuisioner/survei/js', $data, true);
        $data['modal']          = $this->load->view('kuisioner/survei/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    
       
    }

   
    public function survei($id_kuisioner, $kategori)
    {
        if ($kategori=='identitas') {
            $this->input_identitas($id_kuisioner);
        }else{
            $this->input_kuisioner($id_kuisioner);

        }
       
    }

    public function input_identitas($id_kuisioner){
         $id_kuisioner = sbe_crypt($id_kuisioner,'D');
        $breadcrumbs    = $this->breadcrumbs;
        $breadcrumbs->add('Admin', base_url());
        $breadcrumbs->add('Export Import', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
        $q_kuisioner = $this->db->query("SELECT  id_kuisioner, judul_kuisioner,  tahun, kode_tahap from kuisioner where id_kuisioner = '$id_kuisioner'")->row_array();
       
        $data['title']          = "Kuisioner";
        $data['description']    = "Kuisioner : ". $q_kuisioner['judul_kuisioner'];
     
        $data['icon']           = "metismenu-icon pe-7s-user";


        $page                   = 'kuisioner/survei/identitas';
        $data['select'] = $this->api_master_all();
        $data['query']    = $q_kuisioner;
        $data['id_kuisioner']    = $id_kuisioner;
        $data['breadcrumbs']    = $breadcrumbs->render();
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('kuisioner/survei/css', $data, true);
        $data['extra_js']       = $this->load->view('kuisioner/survei/js', $data, true);
        $data['modal']          = $this->load->view('kuisioner/survei/modal', $data, true);
        $this->template->load('backend_template', $page, $data);

    }

   
    public function input_kuisioner($id_kuisioner){
         $id_kuisioner = sbe_crypt($id_kuisioner,'D');
        $breadcrumbs    = $this->breadcrumbs;
        $breadcrumbs->add('Admin', base_url());
        $breadcrumbs->add('Export Import', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
        $q_kuisioner = $this->db->query("SELECT  id_kuisioner, judul_kuisioner,  tahun, kode_tahap from kuisioner where id_kuisioner = '$id_kuisioner'")->row_array();
        $q_pertanyaan = $this->db->query("SELECT  pertanyaan, bentuk_jawaban, id_kuisioner_pertanyaan, required from kuisioner_pertanyaan where id_kuisioner = '$id_kuisioner'")->result_array();
       
        $data['title']          = "Kuisioner";
        $data['description']    = "Kuisioner : ". $q_kuisioner['judul_kuisioner'];
     
        $data['icon']           = "metismenu-icon pe-7s-user";



        $page                   = 'kuisioner/survei/input_kuisioner';
        $data['query']    = $q_kuisioner;
        // $data['pertanyaan']    = $q_pertanyaan;
        $token = $this->session->userdata('responden')['token'];
        $data['pertanyaan']    = $this->api_pertanyaan($token);
        $data['id_kuisioner']    = $id_kuisioner;
        $data['breadcrumbs']    = $breadcrumbs->render();
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('kuisioner/survei/css', $data, true);
        $data['extra_js']       = $this->load->view('kuisioner/survei/js', $data, true);
        $data['modal']          = $this->load->view('kuisioner/survei/modal', $data, true);
        $this->template->load('backend_template', $page, $data);

    }

   
   
    public function simpan_identitas_responden()
    {

        $id_kuisioner = $this->input->post('id_kuisioner');
         $rules_validasi = [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required'
            ],
        
            [
                'field' => 'jk',
                'label' => 'Jenis Kelamin',
                'rules' => 'required'
            ],
            [
                'field' => 'nohp',
                'label' => 'No HP',
                'rules' => 'required'
            ],
            [
             'field' => 'usia',
                 'label' => 'Usia',
                 'rules' => 'required'
            ],
            [
                'field' => 'pendidikan',
                'label' => 'Pendidikan',
                'rules' => 'required'
            ],
           

            [
                'field' => 'unit_kerja',
                'label' => 'Unit Kerja',
                'rules' => 'required'
            ],
        
        ];

            $usia = $this->input->post('usia');
            if ($usia=='Pilih Usia') {
                $this->session->set_flashdata('pesan','<div class="alert alert-danger">Anda belum memilih usia</div>');
                redirect('kuisioner/survei/'.sbe_crypt($id_kuisioner).'/identitas');
            }
            $pekerjaan = $this->input->post('pekerjaan');
            if ($pekerjaan=='Pilih Pekerjaan') {
                $this->session->set_flashdata('pesan','<div class="alert alert-danger">Anda belum memilih Pekerjaan</div>');
                redirect('kuisioner/survei/'.sbe_crypt($id_kuisioner).'/identitas');
            }
            $validation     = $this->form_validation;
            $validation->set_rules($rules_validasi);
                    if($this->form_validation->run() != false){
                        $userdata = [
                            'id_user'=>id_user(),
                            'id_instansi'=>id_instansi(),
                            'id_kuisioner'=>$id_kuisioner,
                            'skpd'=>$this->input->post('skpd'),
                            'nama'=>$this->input->post('nama'),
                            'jk'=>$this->input->post('jk'),
                            'nohp'=>$this->input->post('nohp'),
                            'pendidikan'=>$this->input->post('pendidikan'),
                            'unit_kerja'=>$this->input->post('unit_kerja'),
                            'jabatan'=>$this->input->post('jabatan'),
                        ];
                        $this->session->set_userdata('responden', $userdata);


                          $params = [
                                "nik" => $this->input->post('nohp'),
                                "nama_lengkap" => $this->input->post('nama'),
                                "usia" => $this->input->post('usia'),
                                "email" => $this->input->post('email'),
                                "jenkel" => $this->input->post('jk'),
                                "pendidikan" =>$this->input->post('pendidikan'),
                                "pekerjaan" => $this->input->post('pekerjaan'),
                                "unit_kerja" => $this->input->post('unit_kerja')
                            ];

                            $payload = json_encode($params);
                            $register = $this->api_register($payload);
                            // var_dump($register); die;
                            if ($register->status==false) {
                            $this->session->set_flashdata('pesan','<div class="alert alert-danger">'.$register->message.'</div>');
                             $this->input_identitas(sbe_crypt($id_kuisioner));
                                # code...
                            }else{
                                $token = $register->token;
                                $userdata = [
                                     'token'=>$token,
                                        'id_user'=>id_user(),
                            'id_instansi'=>id_instansi(),
                            'id_kuisioner'=>$id_kuisioner,
                            'skpd'=>$this->input->post('skpd'),
                            'nama'=>$this->input->post('nama'),
                            'jk'=>$this->input->post('jk'),
                            'nohp'=>$this->input->post('nohp'),
                            'pendidikan'=>$this->input->post('pendidikan'),
                            'unit_kerja'=>$this->input->post('unit_kerja'),


                            "nik" => $this->input->post('nohp'),
                                    "nama_lengkap" => $this->input->post('nama'),
                                    "usia" => $this->input->post('usia'),
                                    "email" => $this->input->post('email'),
                                    "jenkel" => $this->input->post('jk'),
                                    // "pendidikan" =>$this->input->post('pendidikan'),
                                    // "pekerjaan" => $this->input->post('pekerjaan'),
                                    "unit_kerja" => "BIRO ADMINISTRASI PEMBANGUNAN"
                                ];
                                $this->session->set_userdata('responden', $userdata);
                            redirect('kuisioner/survei/'.sbe_crypt($id_kuisioner).'/input_kuisioner');

                            }
                }else{
                     // $this->input_identitas(sbe_crypt($id_kuisioner));

                }
       
    }

   
    public function simpan_kuisioner()
    {

        $id_kuisioner = $this->input->post('id_kuisioner');

        $q_pertanyaan = $this->db->query("SELECT  pertanyaan, bentuk_jawaban, id_kuisioner_pertanyaan, required from kuisioner_pertanyaan where id_kuisioner = '$id_kuisioner'")->result_array();
        $kumpul_jawaban = [];
        foreach ($q_pertanyaan as $k => $v) {
            $id_kuisioner_pertanyaan = $v['id_kuisioner_pertanyaan'];
            if ($v['bentuk_jawaban']=='radio') {
                $pecah = explode('|', $this->input->post('jawaban_'.$v['id_kuisioner_pertanyaan']));
                $nilai = $pecah[0] ;
                $jawaban = $pecah[1];
            }else /*if ($v['bentuk_jawaban']=='text')*/ {
                
                $nilai = '';
                $jawaban = $this->input->post('jawaban_'.$v['id_kuisioner_pertanyaan']);
            }
            $data = [
                'id_kuisioner'=>$id_kuisioner,
                'id_user'=>id_user(),
                'id_kuisioner_pertanyaan'=>$id_kuisioner_pertanyaan,
                'nilai'=>$nilai,
                'jawaban'=>$jawaban,
            ];

            array_push($kumpul_jawaban, $data);

        }
        $data_responden = $this->session->userdata('responden');
        $data_pengisian = ['id_user'=>id_user(), 'id_instansi'=>id_instansi(), 'id_kuisioner'=>$id_kuisioner, 'created_at'=>timestamp()];
        $this->db->trans_begin();

        $this->db->insert('kuisioner_identitas_responden', $data_responden);
        $this->db->insert_batch('kuisioner_jawaban_responden', $kumpul_jawaban);
        $this->db->insert('kuisioner_pengisian', $data_pengisian);

        if  ( $this->db->trans_status()  ===  FALSE ) 
        { 
                $this->db->trans_rollback(); 
        } 
        else 
        { 
            $this->session->unset_userdata('responden');
            // $this->session->set_flashdata('pesan','')
                $this->db->trans_commit(); 
                redirect('kuisioner/selesai_pengisian/'.sbe_crypt($id_kuisioner));
        }
       
    }

   
    public function simpan_pengisian_kuisioner()
    {

        $id_kuisioner = $this->input->post('id_kuisioner');

        $data_responden = $this->session->userdata('responden');
        if ($this->session->userdata('id_group')==7) {
            $id_kota = $this->session->userdata('id_kota');
            $data_pengisian = ['id_user'=>id_user(), 'id_kota'=>$id_kota, 'id_kuisioner'=>$id_kuisioner, 'created_at'=>timestamp()];
        }else{
            $data_pengisian = ['id_user'=>id_user(), 'id_instansi'=>id_instansi(), 'id_kuisioner'=>$id_kuisioner, 'created_at'=>timestamp()];

        }
        $this->db->trans_begin();

        $this->db->insert('kuisioner_pengisian', $data_pengisian);

        if  ( $this->db->trans_status()  ===  FALSE ) 
        { 
                $this->db->trans_rollback(); 
        } 
        else 
        { 
            $this->session->unset_userdata('responden');
                $this->db->trans_commit(); 
                $output = [
                    'id_kuisioner'=>sbe_crypt($id_kuisioner),
                    'status'=>true
                ];
            echo json_encode($output);
        }
       
    }



        public function api_master_pekerjaan(){
                    $curl = curl_init();
                    $url = 'https://sepakat.sumbarprov.go.id/api/v1/pekerjaan';
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_HTTPHEADER => array(
                            // Set Here Your Requesred Headers
                            'Content-Type: application/json',
                           // "Authorization: Bearer ".$token
                          
                        ),
                        // CURLOPT_POST => true,
                        // CURLOPT_POSTFIELDS => http_build_query($a_params)
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = json_decode($response);
                    }
                        return $result;
            }

        public function api_register($payload){

                    $curl = curl_init();
                    $url = 'https://sepakat.sumbarprov.go.id/api/v1/register';
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

                        // POST JSON
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => $payload,

                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Accept: application/json',
                            'Content-Length: ' . strlen($payload)
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = json_decode($response);
                    }
                        return $result;
            }

        public function api_master_pendidikan(){
                    $curl = curl_init();
                    $url = 'https://sepakat.sumbarprov.go.id/api/v1/pendidikan';
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_HTTPHEADER => array(
                            // Set Here Your Requesred Headers
                            'Content-Type: application/json',
                           // "Authorization: Bearer ".$token
                          
                        ),
                        // CURLOPT_POST => true,
                        // CURLOPT_POSTFIELDS => http_build_query($a_params)
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = json_decode($response);
                    }
                        return $result;
            }
        public function api_master_periode(){
                    $curl = curl_init();
                    $url = 'https://sepakat.sumbarprov.go.id/api/v1/periode';
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_HTTPHEADER => array(
                            // Set Here Your Requesred Headers
                            'Content-Type: application/json',
                           // "Authorization: Bearer ".$token
                          
                        ),
                        // CURLOPT_POST => true,
                        // CURLOPT_POSTFIELDS => http_build_query($a_params)
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = json_decode($response);
                    }
                        return $result;
            }
        public function api_master_unit_kerja(){
                    $curl = curl_init();
                    $url = 'https://sepakat.sumbarprov.go.id/api/v1/unit-kerja';
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_HTTPHEADER => array(
                            // Set Here Your Requesred Headers
                            'Content-Type: application/json',
                           // "Authorization: Bearer ".$token
                          
                        ),
                        // CURLOPT_POST => true,
                        // CURLOPT_POSTFIELDS => http_build_query($a_params)
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = json_decode($response);
                    }
                        return $result;
            }
        public function api_master_usia(){
                    $curl = curl_init();
                    $url = 'https://sepakat.sumbarprov.go.id/api/v1/usia';
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_HTTPHEADER => array(
                            // Set Here Your Requesred Headers
                            'Content-Type: application/json',
                           // "Authorization: Bearer ".$token
                          
                        ),
                        // CURLOPT_POST => true,
                        // CURLOPT_POSTFIELDS => http_build_query($a_params)
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = json_decode($response);
                    }
                        return $result;
            }
        public function api_master_all(){
                   $data =[
                    'pekerjaan' =>$this->api_master_pekerjaan()->data ,
                    'pendidikan' =>$this->api_master_pendidikan()->data   ,
                    'periode' =>$this->api_master_periode()->data   ,
                    'unit_kerja' =>$this->api_master_unit_kerja()->data   ,
                    'usia' =>$this->api_master_usia()->data   ,
                   ];
                   return $data;
            }


        public function api_pertanyaan($token){
                    $curl = curl_init();
                    $url = 'https://sepakat.sumbarprov.go.id/api/v1/unsur';
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_HTTPHEADER => array(
                            // Set Here Your Requesred Headers
                            'Content-Type: application/json',
                           "Authorization: Bearer ".$token
                          
                        ),
                        // CURLOPT_POST => true,
                        // CURLOPT_POSTFIELDS => http_build_query($a_params)
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = json_decode($response);
                    }
                        return $result;
            }

        public function api_option_pertanyaan(){
            $token = $this->input->post('token');
            $id = $this->input->post('id');
                    $curl = curl_init();
                    $url = 'https://sepakat.sumbarprov.go.id/api/v1/unsur-jawaban?id='.$id;
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_HTTPHEADER => array(
                            // Set Here Your Requesred Headers
                            'Content-Type: application/json',
                           "Authorization: Bearer ".$token
                          
                        ),
                        // CURLOPT_POST => true,
                        // CURLOPT_POSTFIELDS => http_build_query($a_params)
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = $response;
                    }
                        echo $result;
            }


        public function api_simpan_jawaban(){
            $token = $this->input->post('token');
            $id = $this->input->post('id');
            $nilai_jawaban = $this->input->post('nilai_jawaban');
            $action = 'selanjutnya';

            $data_param = [ 
                "unsur_id"=>$id,
                "action"=>"selanjutnya",
                "answer"=>$nilai_jawaban
            ];

            $json_param = json_encode($data_param);
                    $curl = curl_init();
                    $url = 'https://sepakat.sumbarprov.go.id/api/v1/submit-jawaban';
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_HTTPHEADER => array(
                            // Set Here Your Requesred Headers
                            'Content-Type: application/json',
                           "Authorization: Bearer ".$token,
                          
                        ),
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $json_param
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    // $this->session->set_userdata($id, $nilai_jawaban);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = $response;
                    }
                        echo $result;
            }


    
        public function api_kirim_aspirasi(){
            $token = $this->input->post('token');
            $id = $this->input->post('id');
            $aspirasi = $this->input->post('aspirasi');

            $data_param = [ 
                "aspirasi"=>$aspirasi,
              
            ];

            $json_param = json_encode($data_param);
                    $curl = curl_init();
                    $url = 'https://sepakat.sumbarprov.go.id/api/v1/kirim-aspirasi';
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_HTTPHEADER => array(
                            // Set Here Your Requesred Headers
                            'Content-Type: application/json',
                           "Authorization: Bearer ".$token,
                          
                        ),
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $json_param
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    // $this->session->set_userdata($id, $nilai_jawaban);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = $response;
                    }
                        echo $result;
            }




}
