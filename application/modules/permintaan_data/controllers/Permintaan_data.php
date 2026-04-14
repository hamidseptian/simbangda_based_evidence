<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Validasi.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan_data extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'validasi/validasi_fisik_model' => 'validasi_fisik_model',
             'kegiatan_apbd/kegiatan_apbd_model'   => 'kegiatan_apbd_model',
             'informasi/bantuan_model'   => 'bantuan_model',
             'informasi/pengumuman_model'   => 'pengumuman_model',
            'datatables_model'              => 'datatables_model'
        ]);
    }

     public function index()
    {
        $id_group = $this->session->userdata('id_group');
        if ($id_group==2) {
            $this->home_admin();
        }
        elseif ($id_group==5) {
            $this->home_operator();
        }else{
            $this->home_kab_kota();
        }
    }
     public function detail($id_permintaan_data )
    {
        $id_group = $this->session->userdata('id_group');
        $id_permintaan_data = sbe_crypt($id_permintaan_data ,'D');
        if ($id_group==2) {
            $this->detail_admin($id_permintaan_data);
        }
        else if ($id_group==5) {
            $this->detail_operator($id_permintaan_data);
        }else{
            $this->detail_kab_kota($id_permintaan_data);
        }
    }
   
     public function home_admin()
    {
        $breadcrumbs    = $this->breadcrumbs;
        $kegiatan_apbd   = $this->kegiatan_apbd_model;
        $pengumuman   = $this->pengumuman_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Informasi', base_url());
        $breadcrumbs->add('Perminaan Data', base_url($this->router->fetch_class()));
        $breadcrumbs->render();

        $data['title']                        = "Pemintaan Data";
        $data['icon']                       = "metismenu-icon fa fa-th";
        $data['description']                = "Menampilkan Permintaan data";


        $data['breadcrumbs']                = '<button onclick="tambah_permintaan()" class="btn btn-info btn-sm">Tambah Permintaan Data</button>';
        $id_group                           = $this->session->userdata('id_group');


          $data_permintaan = $this->db->query("SELECT id_permintaan_data, id_group, judul, keterangan, status from permintaan_data order by id_permintaan_data desc")->result_array();
        $q_group = $this->db->query("SELECT id_group, group_name from master_group")->result_array();
        $kumpul_group = [];
        foreach ($q_group as $k => $v) {
           $kumpul_group[$v['id_group']] = $v['group_name'];
        }
        $page                                 = 'permintaan_data/admin/index';

        $data['group']                       = $kumpul_group;
        $data['permintaan_data']                       = $data_permintaan;
        $data['link']                       = $this->router->fetch_method();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                    = $this->load->view('permintaan_data/admin/css', $data, true);
        $data['extra_js']                    = $this->load->view('permintaan_data/admin/js', $data, true);
        $data['modal']                      = $this->load->view('permintaan_data/admin/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
        
    }
   
     public function home_operator()
    {
        $breadcrumbs    = $this->breadcrumbs;
        $kegiatan_apbd   = $this->kegiatan_apbd_model;
        $pengumuman   = $this->pengumuman_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Informasi', base_url());
        $breadcrumbs->add('Perminatan Data', base_url($this->router->fetch_class()));
        $breadcrumbs->render();

        $data['title']                        = "Pemintaan Data";
        $data['icon']                       = "metismenu-icon fa fa-th";
        $data['description']                = "Menampilkan Permintaan data";


        $data['breadcrumbs']                = $breadcrumbs->render();
        $id_group                           = $this->session->userdata('id_group');
        $id_instansi                           = $this->session->userdata('id_instansi');


        $data_permintaan = $this->db->query("SELECT pd.id_permintaan_data, pd.id_group, pd.judul, pd.keterangan, pd.status, fpd.file 
            from permintaan_data pd
            left join file_permintaan_data fpd on pd.id_permintaan_data = fpd.id_permintaan_data and fpd.id_instansi = '$id_instansi'
            where pd.id_group='5' order by pd.id_permintaan_data desc")->result_array();
        $q_group = $this->db->query("SELECT id_group, group_name from master_group")->result_array();
        $kumpul_group = [];
        foreach ($q_group as $k => $v) {
           $kumpul_group[$v['id_group']] = $v['group_name'];
        }
        $page                                 = 'permintaan_data/operator/index';

        $data['group']                       = $kumpul_group;
        $data['permintaan_data']                       = $data_permintaan;
        $data['link']                       = $this->router->fetch_method();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                    = $this->load->view('permintaan_data/operator/css', $data, true);
        $data['extra_js']                    = $this->load->view('permintaan_data/operator/js', $data, true);
        $data['modal']                      = '';
        $this->template->load('backend_template', $page, $data);
        
    }
   
     public function home_kab_kota()
    {
        $breadcrumbs    = $this->breadcrumbs;
        $kegiatan_apbd   = $this->kegiatan_apbd_model;
        $pengumuman   = $this->pengumuman_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Informasi', base_url());
        $breadcrumbs->add('Perminatan Data', base_url($this->router->fetch_class()));
        $breadcrumbs->render();

        $data['title']                        = "Pemintaan Data";
        $data['icon']                       = "metismenu-icon fa fa-th";
        $data['description']                = "Menampilkan Permintaan data";


        $data['breadcrumbs']                = $breadcrumbs->render();
        $id_group                           = $this->session->userdata('id_group');
        $id_kota                           = $this->session->userdata('id_kota');


        $data_permintaan = $this->db->query("SELECT pd.id_permintaan_data, pd.id_group, pd.judul, pd.keterangan, pd.status, fpd.file 
            from permintaan_data pd
            left join file_permintaan_data fpd on pd.id_permintaan_data = fpd.id_permintaan_data and fpd.id_kota = '$id_kota'
            where pd.id_group='7' order by pd.id_permintaan_data desc")->result_array();
        $q_group = $this->db->query("SELECT id_group, group_name from master_group")->result_array();
        $kumpul_group = [];
        foreach ($q_group as $k => $v) {
           $kumpul_group[$v['id_group']] = $v['group_name'];
        }
        $page                                 = 'permintaan_data/operator/index';

        $data['group']                       = $kumpul_group;
        $data['permintaan_data']                       = $data_permintaan;
        $data['link']                       = $this->router->fetch_method();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                    = $this->load->view('permintaan_data/operator/css', $data, true);
        $data['extra_js']                    = $this->load->view('permintaan_data/operator/js', $data, true);
        $data['modal']                      = $this->load->view('permintaan_data/operator/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
        
    }
   

     public function detail_admin($id_permintaan_data)
    {
        $breadcrumbs    = $this->breadcrumbs;
      
        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Informasi', base_url());
        $breadcrumbs->add('Perminaan Data', base_url($this->router->fetch_class()));
        $breadcrumbs->render();

        $data['title']                        = "Pemintaan Data";
        $data['icon']                       = "metismenu-icon fa fa-th";
        $data['description']                = "Menampilkan Permintaan data";


        $data['breadcrumbs']                = '-';
        $id_group                           = $this->session->userdata('id_group');


          $data_permintaan = $this->db->query("SELECT id_permintaan_data, id_group, judul, keterangan, status , format_file, deadline, judul_file from permintaan_data where id_permintaan_data='$id_permintaan_data'")->row_array();
          $lampiran = $this->db->query("SELECT  id_permintaan_data_lampiran, id_permintaan_data, nama_lampiran, file  from permintaan_data_lampiran where id_permintaan_data='$id_permintaan_data'")->result_array();
          $form = $this->db->query("SELECT   id_permintaan_data, id_permintaan_data_tabel_permintaan,tabel_data_yang_diminta from permintaan_data_tabel_permintaan where id_permintaan_data='$id_permintaan_data'")->result_array();
        $q_group = $this->db->query("SELECT id_group, group_name from master_group")->result_array();
        $kumpul_group = [];
        foreach ($q_group as $k => $v) {
           $kumpul_group[$v['id_group']] = $v['group_name'];
        }

        if ($data_permintaan['id_group']==5) {
            $asisten_1 = [];
            $asisten_2 = [];
            $asisten_3 = [];
            $q_instansi = $this->db->query("SELECT mi.id_parent, mi.id_instansi, mi.nama_instansi , mi.singkatan_nama_instansi,
                fpd.file, fpd.created_at, fpd.updated_at, fpd.id_permintaan_data
             from master_instansi mi 
             left join file_permintaan_data fpd on mi.id_instansi = fpd.id_instansi and fpd.id_permintaan_data='$id_permintaan_data'
             where mi.kategori='OPD' and mi.is_active='1' order by mi.nama_instansi asc")->result_array();
            foreach ($q_instansi as $k => $v) {

                if ($v['updated_at']) {
                    $waktu_upload = $v['updated_at'];
                }else{
                    $waktu_upload = "Ditambahkan Pada ".$v['created_at'];

                }


                if ($v['file']=='') {
                    $keterangan = 'Belum mengirimkan data';
                    $badge = 'badge badge-danger';
                    $status='Belum Upload';
                }else{
                    $keterangan = 'Sudah mengirimkan data '. $waktu_upload  ;
                    $badge = 'badge badge-success';
                    $status='Sudah Upload';

                }

                $data_opd = [
                    'nama_instansi'=>$v['nama_instansi'],
                    'id_permintaan_data'=>$v['id_permintaan_data'],
                    'file'=>$v['file'],
                    'keterangan'=>$keterangan,
                    'badge'=>$badge,
                    'status'=>$status,
                    'file_disimpan'=>$v['singkatan_nama_instansi'].' - '.$data_permintaan['judul_file'],
                ];


                if ($v['id_parent'] == 204) {
                    array_push($asisten_1, $data_opd);
                }
                elseif ($v['id_parent'] == 205) {
                    array_push($asisten_2, $data_opd);
                    # code...
                }else{
                    array_push($asisten_3, $data_opd);

                }
            }

            $data_per_asisten = [
                '1'=>$asisten_1 ,
                '2'=>$asisten_2 ,
                '3'=>$asisten_3 ,
            ];

            $data_file_permintaan = $data_per_asisten  ;
        }else{

            $wilayah_1 = [];
            $wilayah_2 = [];
            $wilayah_3 = [];
            $q_kota = $this->db->query("SELECT k.nama_kota,ckk.wilayah, 
                fpd.file, fpd.created_at, fpd.updated_at, fpd.id_permintaan_data
             from config_kab_kota ckk 
             left join file_permintaan_data fpd on ckk.id_kota = fpd.id_kota and fpd.id_permintaan_data='$id_permintaan_data'
             left join kota k on ckk.id_kota = k.id_kota
             order by k.nama_kota asc")->result_array();
            foreach ($q_kota as $k => $v) {

                if ($v['updated_at']) {
                    $waktu_upload = $v['updated_at'];
                }else{
                    $waktu_upload = "Ditambahkan Pada ".$v['created_at'];

                }


                if ($v['file']=='') {
                    $keterangan = 'Belum mengirimkan data';
                    $badge = 'badge badge-danger';
                    $status='Belum Upload';
                }else{
                    $keterangan = 'Sudah mengirimkan data '. $waktu_upload  ;
                    $badge = 'badge badge-success';
                    $status='Sudah Upload';

                }

                $data_opd = [
                    'nama_kota'=>$v['nama_kota'],
                    'id_permintaan_data'=>$v['id_permintaan_data'],
                    'file'=>$v['file'],
                    'keterangan'=>$keterangan,
                    'badge'=>$badge,
                    'status'=>$status,
                    'file_disimpan'=>$v['nama_kota'].' - '.$data_permintaan['judul_file'],
                ];


                if ($v['wilayah'] == 1) {
                    array_push($wilayah_1, $data_opd);
                }
                elseif ($v['wilayah'] == 2) {
                    array_push($wilayah_2, $data_opd);
                    # code...
                }else{
                    array_push($wilayah_3, $data_opd);

                }
            }

            $data_per_wilayah = [
                '1'=>$wilayah_1 ,
                '2'=>$wilayah_2 ,
                '3'=>$wilayah_3 ,
            ];

            $data_file_permintaan = $data_per_wilayah  ;

        }

        $page                                 = 'permintaan_data/admin/detail';

        $data['form']    = $form ;
        $data['id_permintaan_data']    = $id_permintaan_data ;
        $data['data_file_permintaan']    = $data_file_permintaan;
        $data['group']                       = $kumpul_group;
        $data['permintaan_data']                       = $data_permintaan;
        $data['lampiran']                       = $lampiran;
        $data['link']                       = $this->router->fetch_method();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                    = $this->load->view('permintaan_data/admin/css', $data, true);
        $data['extra_js']                    = $this->load->view('permintaan_data/admin/js', $data, true);
        $data['modal']                      = $this->load->view('permintaan_data/admin/modal_detail', $data, true);
        $this->template->load('backend_template', $page, $data);
        
    }
   


 public function simpan_permintaan_data(){
    $id_group= $this->input->post('id_group');
    $judul= $this->input->post('judul');
    $keterangan= $this->input->post('keterangan');
    $formatfile= $this->input->post('formatfile');
    $deadline= $this->input->post('deadline');

    $data_insert = [
        'id_group' => $id_group, 
        'judul' => $judul, 
        'keterangan' => $keterangan, 
        'status' => 'Permintaan', 
        'created_at' =>timestamp(), 
        'created_by' => id_user(), 
        // 'format_file' => $xxx, 
        'judul_file ' => $formatfile, 
        'deadline ' => $deadline, 
    ];
    $this->db->insert('permintaan_data', $data_insert);
    $id_insert = $this->db->insert_id();
    $this->session->set_flashdata('pesan','<div class="alert alert-info">Permintaan data telah dibuat, silahkan sesuaikan kembali</div>');
    redirect('permintaan_data/detail/'.sbe_crypt($id_insert));

 }

 public function simpanedit_permintaan_data(){
    $id_permintaan_data= $this->input->post('id_permintaan_data');
    $id_group= $this->input->post('id_group');
    $judul= $this->input->post('judul');
    $keterangan= $this->input->post('keterangan');
    $formatfile= $this->input->post('formatfile');
    $deadline= $this->input->post('deadline');
    $where = ['id_permintaan_data'=>$id_permintaan_data];
    $data_insert = [
        'id_group' => $id_group, 
        'judul' => $judul, 
        'keterangan' => $keterangan, 
        'status' => 'Permintaan', 
        'created_at' =>timestamp(), 
        'created_by' => id_user(), 
        // 'format_file' => $xxx, 
        'judul_file ' => $formatfile, 
        'deadline ' => $deadline, 
    ];
    $this->db->update('permintaan_data', $data_insert, $where);
    $this->session->set_flashdata('pesan','<div class="alert alert-info">Permintaan data telah diperbaharui, silahkan sesuaikan kembali</div>');
    redirect('permintaan_data/detail/'.sbe_crypt($id_permintaan_data));

 }


     public function detail_operator($id_permintaan_data)
    {
        $breadcrumbs    = $this->breadcrumbs;
        $kegiatan_apbd   = $this->kegiatan_apbd_model;
        $pengumuman   = $this->pengumuman_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Informasi', base_url());
        $breadcrumbs->add('Perminaan Data', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
        $data['title']                        = "Pemintaan Data";
        $data['icon']                       = "metismenu-icon fa fa-th";
        $data['description']                = "Menampilkan Permintaan data";


        $data['breadcrumbs']                = '-';
        $id_instansi                           = $this->session->userdata('id_instansi');

          $lampiran = $this->db->query("SELECT  id_permintaan_data_lampiran, id_permintaan_data, nama_lampiran, file  from permintaan_data_lampiran where id_permintaan_data='$id_permintaan_data'")->result_array();

          $data_permintaan = $this->db->query("SELECT pd.id_permintaan_data, pd.id_group, pd.judul, pd.keterangan, pd.status, pd.format_file, pd.deadline, pd.judul_file,
            fpd.file, fpd.created_at, fpd.updated_at, fpd.id_pelapor_permintaan_data, 
            mi.nama_instansi, mi.singkatan_nama_instansi
            from permintaan_data pd 
            left join file_permintaan_data fpd on pd.id_permintaan_data = fpd.id_permintaan_data  and fpd.id_instansi = '$id_instansi'
            left join master_instansi mi  on mi.id_instansi = '$id_instansi'
            where pd.id_permintaan_data='$id_permintaan_data'")->row_array();
       
        $page                                 = 'permintaan_data/operator/detail';

        $data['id_instansi']                       = $id_instansi;
        $data['lampiran']                       = $lampiran;
        $data['id_permintaan_data']                       = $id_permintaan_data;
        $data['nama_instansi']                       = $data_permintaan['nama_instansi'];
        $data['permintaan_data']                       = $data_permintaan;
        $data['link']                       = $this->router->fetch_method();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                    = $this->load->view('permintaan_data/operator/css', $data, true);
        $data['extra_js']                    = $this->load->view('permintaan_data/operator/js', $data, true);
        $data['modal']                      = $this->load->view('permintaan_data/operator/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
        
    
   }





     public function detail_kab_kota($id_permintaan_data)
    {
        $breadcrumbs    = $this->breadcrumbs;
        $kegiatan_apbd   = $this->kegiatan_apbd_model;
        $pengumuman   = $this->pengumuman_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Informasi', base_url());
        $breadcrumbs->add('Perminaan Data', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
        $data['title']                        = "Pemintaan Data";
        $data['icon']                       = "metismenu-icon fa fa-th";
        $data['description']                = "Menampilkan Permintaan data";


        $data['breadcrumbs']                = '-';
        $id_kota                           = $this->session->userdata('id_kota');

          $lampiran = $this->db->query("SELECT  id_permintaan_data_lampiran, id_permintaan_data, nama_lampiran, file  from permintaan_data_lampiran where id_permintaan_data='$id_permintaan_data'")->result_array();

          $data_permintaan = $this->db->query("SELECT pd.id_permintaan_data, pd.id_group, pd.judul, pd.keterangan, pd.status, pd.format_file, pd.deadline, pd.judul_file,
            fpd.file, fpd.created_at, fpd.updated_at, fpd.id_pelapor_permintaan_data, 
            k.nama_kota
            from permintaan_data pd 
            left join file_permintaan_data fpd on pd.id_permintaan_data = fpd.id_permintaan_data  and fpd.id_kota = '$id_kota'
            left join kota k  on k.id_kota = '$id_kota'
            where pd.id_permintaan_data='$id_permintaan_data'")->row_array();
       
        $page                                 = 'permintaan_data/kab_kota/detail';

        $data['id_kota']                       = $id_kota;
        $data['lampiran']                       = $lampiran;
        $data['id_permintaan_data']                       = $id_permintaan_data;
        $data['nama_kota']                       = $data_permintaan['nama_kota'];
        $data['permintaan_data']                       = $data_permintaan;
        $data['link']                       = $this->router->fetch_method();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                    = $this->load->view('permintaan_data/kab_kota/css', $data, true);
        $data['extra_js']                    = $this->load->view('permintaan_data/kab_kota/js', $data, true);
        $data['modal']                      = $this->load->view('permintaan_data/kab_kota/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
        
    
   }




    public function simpan_upload_file()
    {
        
            set_time_limit(0);
            $id_permintaan_data = $this->input->post('id_permintaan_data');

            $nama_instansi = $this->input->post('nama_instansi');
            $id_group=$this->session->userdata('id_group');



                      



                      
                      

            $output = [
                'status' => false,
                'data'   => []
            ];

            if ($id_group==5) {
                $id_instansi =$this->input->post('id_instansi');
                $id_pengirim = $id_instansi ; 
             
            }else{
                $id_kota =$this->input->post('id_kota');
                $id_pengirim = $id_kota ; 
              
            }



















        $this->load->library('minio_client');
        $nama_file_disimpan = $id_pengirim.'-'.date('Ymdhis');

        $file_ext = strtolower(pathinfo($_FILES['upload_file']['name'], PATHINFO_EXTENSION));
   $file_name = slug($nama_file_disimpan).'.'.$file_ext; //tidak menggunakan waktu karena kadang2 di db dan di directori berbeda nama



         $tmp_path  = $_FILES['upload_file']['tmp_name'];//$upload_data['full_path'];
        $objectName = implode('/', [
            'permintaan_data',
            $id_permintaan_data,
            'file_pengirim'
        ]);
        $folder = $objectName;
        $spesifik = ['pdf','pptx'];
        $upload = $this->minio_client->upload_spesifik($objectName, $tmp_path, $file_name, $spesifik); 
        if ($upload['success']) {
            // $fileSize  = $_FILES['berkas']['size'];
            // $object_key = $folder. '/'. $upload['filname'];
            // $encryptedKey = urlencode(base64_encode($this->encryption->encrypt($object_key)));
            // $encryptedKey = urlencode(base64_encode(sbe_crypt($object_key)));


                    if ($id_group==5) {
                        $data = [
                            'id_permintaan_data' =>$id_permintaan_data ,
                            'id_group' =>5,
                            'id_instansi' =>$id_instansi,
                            'file' =>$upload['filname'],
                            'tgl_upload' =>date('Y-m-d'),
                            'jam_upload' =>date('H:i'),
                            'created_at' =>timestamp(),
                            'created_by' =>id_user()
                        ];
                    }else{
                        $data = [
                            'id_permintaan_data' =>$id_permintaan_data ,
                            'id_group' =>7,
                            'id_kota' =>$id_kota,
                            'file' =>$upload['filname'],
                            'tgl_upload' =>date('Y-m-d'),
                            'jam_upload' =>date('H:i'),
                            'created_at' =>timestamp(),
                            'created_by' =>id_user()
                         ];

                    }





                    $this->db->insert('file_permintaan_data', $data);
                    $pesan_flashdata  = '<div class="alert alert-info">Permintandata dengan lampiran disimpan</div>';



            // echo json_encode([
            //     'success' => true,
            //     'message' =>  'Upload Sukses',
            //     // 'file' => ['url' => $upload['url'],'name' => $upload['filname'],'size' => $fileSize,'file_publik' => site_url('fitur/publicfile/view/' . $encryptedKey) ],
            //     // 'csrf_hash' => $this->security->get_csrf_hash()
            // ]);
        } else {
            
                            $pesan_flashdata  = '<div class="alert alert-info">File perminaan data Gagal disimpan<br>' .$upload['error'].'</div>';
        }






            // }

            $this->session->set_flashdata('pesan', $pesan_flashdata);
            redirect('permintaan_data/detail/'.sbe_crypt($id_permintaan_data));
        
    }




    public function simpan_upload_lampiran()
    {
        
            set_time_limit(0);
            $id_permintaan_data = $this->input->post('id_permintaan_data');
            $nama = $this->input->post('nama');
          
            $output = [
                'status' => false,
                'data'   => []
            ];






        $this->load->library('minio_client');
        $nama_file_disimpan = $id_pengirim.'-'.date('Ymdhis');

        $file_ext = strtolower(pathinfo($_FILES['upload_file']['name'], PATHINFO_EXTENSION));
   $file_name = slug($nama_file_disimpan).'.'.$file_ext;



         $tmp_path  = $_FILES['upload_file']['tmp_name'];//$upload_data['full_path'];
        $objectName = implode('/', [
            'permintaan_data',
            $id_permintaan_data,
            'lampiran'
        ]);
        $folder = $objectName;
        $spesifik = ['pdf','pptx'];
        $upload = $this->minio_client->upload_spesifik($objectName, $tmp_path, $file_name, $spesifik); 
        if ($upload['success']) {
            // $fileSize  = $_FILES['berkas']['size'];
            // $object_key = $folder. '/'. $upload['filname'];
            // $encryptedKey = urlencode(base64_encode($this->encryption->encrypt($object_key)));
            // $encryptedKey = urlencode(base64_encode(sbe_crypt($object_key)));


            $data = [
                'id_permintaan_data' =>$id_permintaan_data ,
                'nama_lampiran' =>$nama ,

                'file' =>$upload['filname'],

                ];
            $this->db->insert('permintaan_data_lampiran', $data);




                    $pesan_flashdata  = '<div class="alert alert-info">Permintandata dengan lampiran disimpan</div>';



            // echo json_encode([
            //     'success' => true,
            //     'message' =>  'Upload Sukses',
            //     // 'file' => ['url' => $upload['url'],'name' => $upload['filname'],'size' => $fileSize,'file_publik' => site_url('fitur/publicfile/view/' . $encryptedKey) ],
            //     // 'csrf_hash' => $this->security->get_csrf_hash()
            // ]);
        } else {
            
                            $pesan_flashdata  = '<div class="alert alert-info">File perminaan data Gagal disimpan<br>' .$upload['error'].'</div>';
        }












            $this->session->set_flashdata('pesan', $pesan_flashdata);
            redirect('permintaan_data/detail/'.sbe_crypt($id_permintaan_data));
        
    }



    public function simpanedit_upload_file()
    {
        
            set_time_limit(0);
            $id_file = $this->input->post('id_file');
            $file_Lama = $this->input->post('file_lama');
            $id_permintaan_data = $this->input->post('id_permintaan_data');
            $nama_instansi = $this->input->post('nama_instansi');
            $id_instansi = $this->input->post('id_instansi');
            $output = [
                'status' => false,
                'data'   => []
            ];


            $id_group=$this->session->userdata('id_group');




            $primary_folder     = './sbe_files_support/';
            $directory          = [
                'permintaan_data',
                $id_permintaan_data,
                'file',
            ];
            $list_directory = $this->sbe_directory($primary_folder, $directory);




            if ($id_group==5) {
                $id_instansi =$this->input->post('id_instansi');
                $id_pengirim = $id_instansi ; 
             
            }else{
                $id_kota =$this->input->post('id_kota');
                $id_pengirim = $id_kota ; 
              
            }









        $this->load->library('minio_client');
        $nama_file_disimpan = $id_pengirim.'-'.date('Ymdhis');

        $file_ext = strtolower(pathinfo($_FILES['upload_file']['name'], PATHINFO_EXTENSION));
   $file_name = slug($nama_file_disimpan).'.'.$file_ext; //tidak menggunakan waktu karena kadang2 di db dan di directori berbeda nama



         $tmp_path  = $_FILES['upload_file']['tmp_name'];//$upload_data['full_path'];
        $objectName = implode('/', [
            'permintaan_data',
            $id_permintaan_data,
            'file_pengirim'
        ]);
        $folder = $objectName;
        $spesifik = ['pdf','pptx'];
        $upload = $this->minio_client->upload_spesifik($objectName, $tmp_path, $file_name, $spesifik); 
        if ($upload['success']) {
            // $fileSize  = $_FILES['berkas']['size'];
            // $object_key = $folder. '/'. $upload['filname'];
            // $encryptedKey = urlencode(base64_encode($this->encryption->encrypt($object_key)));
            // $encryptedKey = urlencode(base64_encode(sbe_crypt($object_key)));

            $where = ['id_pelapor_permintaan_data' =>$id_file];
            if ($id_group==5) {
                $data = [
                    'id_permintaan_data' =>$id_permintaan_data ,
                    'id_group' =>5,
                    'id_instansi' =>$id_instansi,
                    'file' =>$upload['filname'],
                    'tgl_upload' =>date('Y-m-d'),
                    'jam_upload' =>date('H:i'),
                    'updated_at' =>timestamp(),
                    'updated_by' =>id_user()
                ];
            }else{
                $data = [
                    'id_permintaan_data' =>$id_permintaan_data ,
                    'id_group' =>7,
                    'id_kota' =>$id_kota,
                    'file' =>$upload['filname'],
                    'tgl_upload' =>date('Y-m-d'),
                    'jam_upload' =>date('H:i'),
                    'updated_at' =>timestamp(),
                    'updated_by' =>id_user()
                 ];

            }




                        $this->db->update('file_permintaan_data', $data,$where);
                           $path = $folder.'/'.$file_Lama;
                           echo $path;
                            $delete = $this->minio_client->delete_file($path); 


                            $pesan_flashdata  = '<div class="alert alert-info">File perminaan data telah diperbaharui</div>';



            // echo json_encode([
            //     'success' => true,
            //     'message' =>  'Upload Sukses',
            //     // 'file' => ['url' => $upload['url'],'name' => $upload['filname'],'size' => $fileSize,'file_publik' => site_url('fitur/publicfile/view/' . $encryptedKey) ],
            //     // 'csrf_hash' => $this->security->get_csrf_hash()
            // ]);
        } else {
                            $pesan_flashdata  = '<div class="alert alert-info">File perminaan data Gagal diperbaharui<br>' .$upload['error'].'</div>';
           
        }






            // }

            $this->session->set_flashdata('pesan', $pesan_flashdata);
            redirect('permintaan_data/detail/'.sbe_crypt($id_permintaan_data));
        
    }



    public function simpanedit_upload_lampiran()
    {
        
            set_time_limit(0);
            $filelama = $this->input->post('filelama');
            $id_lampiran = $this->input->post('id_lampiran');
            $id_permintaan_data = $this->input->post('id_permintaan_data');
            $nama = $this->input->post('nama');
            $output = [
                'status' => false,
                'data'   => []
            ];
            $primary_folder     = './sbe_files_support/';
            $directory          = [
                'permintaan_data',
                $id_permintaan_data,
                'lampiran',
            ];
            $list_directory = $this->sbe_directory($primary_folder, $directory);
            if (!file_exists($list_directory)) {
                mkdir($list_directory, 0777, TRUE);
            }
            // untuk menghapus file sebelumnya
            // untuk menghapus file sebelumnya
            $namafiledisimpan = 'Lampiran-'.$id_permintaan_data."-".date('Ymdhis');
            $config['upload_path']   = $list_directory;
            $config['overwrite']     = true;
            $config['allowed_types'] = '*';
            $config['encrypt_name']  = false;
         
            $config['file_name']     = $namafiledisimpan;
            // $config['max_size']      = '10000';
            $this->load->library('upload', $config);
            $filename= $_FILES["upload_file"]["name"];
            $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
            if (empty($_FILES['upload_file']['name'])) {
                  $where = ['id_permintaan_data_lampiran' =>$id_lampiran];
                     $data = [
                        'nama_lampiran' =>$nama ,
                        ];
                        $this->db->update('permintaan_data_lampiran', $data,$where);
                    $pesan_flashdata  = '<div class="alert alert-info">Pengumuman tanpa lampiran disimpan</div>';
            }else{
                if (!$this->upload->do_upload('upload_file')) {
                    $output['status']   = false;
                    $pesan_flashdata  = '<div class="alert alert-info">'.$this->upload->display_errors().'</div>';
                } else {
                    $where = ['id_permintaan_data_lampiran' =>$id_lampiran];
                     $data = [
                        'nama_lampiran' =>$nama ,
                        'file' =>$namafiledisimpan.'.'.$file_ext,
                        ];
                        $this->db->update('permintaan_data_lampiran', $data,$where);
                    $path = $list_directory.$filelama;
                    unlink($path);
                    $pesan_flashdata  = '<div class="alert alert-info">Pengumuman dengan lampiran disimpan</div>';
                }
            }
            $this->session->set_flashdata('pesan', $pesan_flashdata);
            redirect('permintaan_data/detail/'.sbe_crypt($id_permintaan_data));
    }















    public function print($id_permintaan_data)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Legal',
            'orientation' => 'L',

            'margin_left' => 8,     // 15 margin_left
            'margin_right' => 8,        // 15 margin right
            'margin_header' => 7,     // 9 margin header
            'margin_footer' => 7,    
            'tempDir' => '/tmp'
        ]);


          $id_permintaan_data = sbe_crypt($id_permintaan_data,'D');

          $data_permintaan = $this->db->query("SELECT id_permintaan_data, id_group, judul, keterangan, status from permintaan_data where id_permintaan_data='$id_permintaan_data'")->row_array();
            $asisten_1_sudah = [];
            $asisten_2_sudah = [];
            $asisten_3_sudah = [];
            $asisten_1_belum = [];
            $asisten_2_belum = [];
            $asisten_3_belum = [];
            $q_instansi = $this->db->query("SELECT mi.id_parent, mi.id_instansi, mi.nama_instansi ,
                fpd.file, fpd.created_at, fpd.updated_at
             from master_instansi mi 
             left join file_permintaan_data fpd on mi.id_instansi = fpd.id_instansi and fpd.id_permintaan_data='$id_permintaan_data'
             where mi.kategori='OPD' and mi.is_active='1' order by mi.nama_instansi asc")->result_array();
            foreach ($q_instansi as $k => $v) {

                if ($v['updated_at']) {
                    $waktu_upload = $v['updated_at'];
                }else{
                    $waktu_upload = $v['created_at'];

                }


                // if ($v['file']=='') {
                //     $keterangan = 'Belum mengirimkan data';
                //     $badge = 'badge badge-danger';
                // }else{
                //     $keterangan = 'Sudah mengirimkan data '. $waktu_upload  ;
                //     $badge = 'badge badge-success';

                // }

                $data_opd = [
                    'nama_instansi'=>$v['nama_instansi'],
                    'waktu_upload'=>$waktu_upload,
                    // 'badge'=>$badge,
                ];


                if ($v['id_parent'] == 204) {
                    if ($v['file']=='') {
                        array_push($asisten_1_belum, $data_opd);
                    }else{
                        array_push($asisten_1_sudah, $data_opd);
                    }
                }
                elseif ($v['id_parent'] == 205) {
                    if ($v['file']=='') {
                        array_push($asisten_2_belum, $data_opd);
                    }else{
                        array_push($asisten_2_sudah, $data_opd);
                    }
                    # code...
                }else{
                    if ($v['file']=='') {
                        array_push($asisten_3_belum, $data_opd);
                    }else{
                        array_push($asisten_3_sudah, $data_opd);
                    }

                }
            }

            $data_per_asisten = [
                'asisten_1_sudah'=>$asisten_1_sudah ,
                'asisten_2_sudah'=>$asisten_2_sudah ,
                'asisten_3_sudah'=>$asisten_3_sudah ,
                'asisten_1_belum'=>$asisten_1_belum ,
                'asisten_2_belum'=>$asisten_2_belum ,
                'asisten_3_belum'=>$asisten_3_belum ,
            ];

            $data_file_permintaan = $data_per_asisten  ;






        $data['data_file_permintaan'] = $data_file_permintaan;
        $data['data_permintaan'] = $data_permintaan;


            $html =  $this->load->view('permintaan_data/admin/print', $data, true);

        $mpdf->WriteHTML($html);
        $mpdf->Output('tes.pdf', 'I');


}






    public function print_kab_kota($id_permintaan_data)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Legal',
            'orientation' => 'L',

            'margin_left' => 8,     // 15 margin_left
            'margin_right' => 8,        // 15 margin right
            'margin_header' => 7,     // 9 margin header
            'margin_footer' => 7,    
            'tempDir' => '/tmp'
        ]);


          $id_permintaan_data = sbe_crypt($id_permintaan_data,'D');

          $data_permintaan = $this->db->query("SELECT id_permintaan_data, id_group, judul, keterangan, status from permintaan_data where id_permintaan_data='$id_permintaan_data'")->row_array();
            $wilayah_1_sudah = [];
            $wilayah_2_sudah = [];
            $wilayah_3_sudah = [];
            $wilayah_1_belum = [];
            $wilayah_2_belum = [];
            $wilayah_3_belum = [];
            // $q_instansi = $this->db->query("SELECT mi.id_parent, mi.id_instansi, mi.nama_instansi ,
            //     fpd.file, fpd.created_at, fpd.updated_at
            //  from master_instansi mi 
            //  left join file_permintaan_data fpd on mi.id_instansi = fpd.id_instansi and fpd.id_permintaan_data='$id_permintaan_data'
            //  where mi.kategori='OPD' and mi.is_active='1' order by mi.nama_instansi asc")->result_array();


               $q_kota = $this->db->query("SELECT k.nama_kota,ckk.wilayah, 
                fpd.file, fpd.created_at, fpd.updated_at, fpd.id_permintaan_data
             from config_kab_kota ckk 
             left join file_permintaan_data fpd on ckk.id_kota = fpd.id_kota and fpd.id_permintaan_data='$id_permintaan_data'
             left join kota k on ckk.id_kota = k.id_kota
             order by k.nama_kota asc")->result_array();




            foreach ($q_kota as $k => $v) {

                if ($v['updated_at']) {
                    $waktu_upload = $v['updated_at'];
                }else{
                    $waktu_upload = $v['created_at'];

                }


                // if ($v['file']=='') {
                //     $keterangan = 'Belum mengirimkan data';
                //     $badge = 'badge badge-danger';
                // }else{
                //     $keterangan = 'Sudah mengirimkan data '. $waktu_upload  ;
                //     $badge = 'badge badge-success';

                // }

                $data_opd = [
                    'nama_kota'=>$v['nama_kota'],
                    'waktu_upload'=>$waktu_upload,
                    // 'badge'=>$badge,
                ];


                if ($v['wilayah'] == 1) {
                    if ($v['file']=='') {
                        array_push($wilayah_1_belum, $data_opd);
                    }else{
                        array_push($wilayah_1_sudah, $data_opd);
                    }
                }
                elseif ($v['wilayah'] == 2) {
                    if ($v['file']=='') {
                        array_push($wilayah_2_belum, $data_opd);
                    }else{
                        array_push($wilayah_2_sudah, $data_opd);
                    }
                    # code...
                }else{
                    if ($v['file']=='') {
                        array_push($wilayah_3_belum, $data_opd);
                    }else{
                        array_push($wilayah_3_sudah, $data_opd);
                    }

                }
            }

            $data_per_wilayah    = [
                'wilayah_1_sudah'=>$wilayah_1_sudah ,
                'wilayah_2_sudah'=>$wilayah_2_sudah ,
                'wilayah_3_sudah'=>$wilayah_3_sudah ,
                'wilayah_1_belum'=>$wilayah_1_belum ,
                'wilayah_2_belum'=>$wilayah_2_belum ,
                'wilayah_3_belum'=>$wilayah_3_belum ,
            ];

            $data_file_permintaan = $data_per_wilayah  ;






        $data['data_file_permintaan'] = $data_file_permintaan;
        $data['data_permintaan'] = $data_permintaan;


            $html =  $this->load->view('permintaan_data/admin/print_kab_kota', $data, true);

        $mpdf->WriteHTML($html);
        $mpdf->Output('tes.pdf', 'I');


}





    public function download_lampiran(){
        $this->load->library('minio_client');
        $id_permintaan_data = $this->input->get('id_permintaan_data');

        $objectName = implode('/', [
            'permintaan_data',
            $id_permintaan_data,
            'lampiran'
        ]);
        $folder = $objectName;
        $file = $this->input->get('file');
        $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $format = $this->input->get('format').'.'.$file_ext;
        $this->minio_client->download($folder.'/'.$file, $format);
    }



    public function hapus_lampiran(){
        $id_permintaan_data = $this->input->get('id_permintaan_data');
        $id_lampiran = $this->input->get('id_lampiran');
        $nama_lampiran = $this->input->get('nama_lampiran');
        $where = ['id_permintaan_data_lampiran' =>$id_lampiran];
        $this->db->delete('permintaan_data_lampiran', $where);
        $this->session->set_flashdata('pesan','<div class="alert alert-info">File lampiran '.$nama_lampiran.' telah dihapus</div>');

       


               $objectName = implode('/', [
            'permintaan_data',
            $id_permintaan_data,
            'lampiran'
        ]);
        $folder = $objectName;




            $file_lama = $this->input->get('file');
           $path = $list_directory.$file_lama;


           $path = $folder.'/'.$file_Lama;
            $delete = $this->minio_client->delete_file($path); 



            unlink($path);
        redirect('permintaan_data/detail/'.sbe_crypt($id_permintaan_data));
    }



    public function hapus($id_permintaan_data){
        $id_permintaan_data = sbe_crypt($id_permintaan_data,'D');
       
        $where = ['id_permintaan_data_lampiran' =>$id_lampiran];
        $this->db->delete('permintaan_data', $where);
        $this->db->delete('permintaan_data_lampiran', $where);
        $this->db->delete('file_permintaan_data', $where);
        $this->session->set_flashdata('pesan','<div class="alert alert-info">Permintaan data dihapus</div>');

       
        redirect('permintaan_data/');
    }



    public function download_file(){


                $this->load->library('minio_client');
            $id_permintaan_data = $this->input->get('id_permintaan_data');

       $objectName = implode('/', [
            'permintaan_data',
            $id_permintaan_data,
            'file_pengirim'
        ]);
        $folder = $objectName;
        $file = $this->input->get('file');
        $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $format = $this->input->get('format').'.'.$file_ext;


    $this->minio_client->download($folder.'/'.$file, $format);





    }



   
}
