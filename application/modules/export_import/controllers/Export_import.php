<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Validasi.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Export_import extends MY_Controller
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

     public function sipd($data)
    {
       if ($data=='data_apbd') {
           $this->data_apbd();
       }
       elseif ($data=='target_apbd') {
           $this->target_apbd();
       }else{
        echo "Not Found";
       }
    }
   

    public function data_apbd()
    {
        $breadcrumbs    = $this->breadcrumbs;
         $breadcrumbs->add('Admin', base_url());
        $breadcrumbs->add('Export Import', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
          $data['title']          = "Export - Import | Data APBD";
        $breadcrumbs->render();
        $config = $this->db->query("SELECT tahun_anggaran as tahun from config order by id_config desc")->result_array();
        $q_export = $this->db->query("SELECT  id_export_import, tahun, kode_tahap, status from export_import order by id_export_import desc")->result_array();
        $data['icon']           = "metismenu-icon pe-7s-user";
        $data['description']    = "Menampilkan Pengelolaan Import Data Excel pada SIPD";
        $data['breadcrumbs']    = $breadcrumbs->render();
        $page                   = 'export_import/data_apbd/index';
        $data['tahun']           = $config;
        $data['id_instansi']           = id_instansi();
        $data['data']           = $q_export;
        $data['id_group']           = $this->session->userdata('id_group');
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('export_import/data_apbd/css', $data, true);
        $data['extra_js']       = $this->load->view('export_import/data_apbd/js', $data, true);
        $data['modal']          = $this->load->view('export_import/data_apbd/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    }

    public function list_opd($id_export_import)
    {
        $breadcrumbs    = $this->breadcrumbs;
         $breadcrumbs->add('Admin', base_url());
        $breadcrumbs->add('Export Import', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
          $data['title']          = "Export - Import | Data APBD";
        $breadcrumbs->render();
        $config = $this->db->query("SELECT tahun_anggaran as tahun from config order by id_config desc")->result_array();
        $id_export_import = sbe_crypt($id_export_import,'D');
        $q_export = $this->db->query("SELECT  id_export_import, tahun, kode_tahap, status from export_import where id_export_import='$id_export_import'")->row_array();
        $q_opd = $this->db->query("SELECT nama_instansi, id_instansi from master_instansi where kategori='OPD' and is_active='1' order by nama_instansi asc")->result_array();
        $q_log = $this->db->query("SELECT ei.tgl_import, ei.id_instansi , mu.full_name, mg.group_name
            from export_import_log_data_apbd ei 
            left join master_users mu on ei.import_by = mu.id_user
            left join master_group mg on ei.id_group_pengimport = mg.id_group
            where  
            ei.id_export_import='$id_export_import'")->result_array();

        $kumpul_log = [];
        foreach ($q_log as $k => $v) {
            $kumpul_log[$v['id_instansi']] = [
                'tgl_import'=>$v['tgl_import'],
                'group' =>$v['group_name'],
                'full_name' =>$v['full_name'],
            ];
            # code...
        }
        $data['icon']           = "metismenu-icon pe-7s-user";
        $data['log']           = $kumpul_log;
        $data['description']    = "Menampilkan Pengelolaan Import Data Excel pada SIPD";
        $data['breadcrumbs']    = $breadcrumbs->render();
        $page                   = 'export_import/data_apbd/list_opd';
        $data['id_export_import']           = sbe_crypt($id_export_import);
        $data['data_export_import']           =$q_export;
        $data['tahun']           = $config;
        $data['data']           = $q_opd;
        $data['id_group']           = $this->session->userdata('id_group');
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('export_import/data_apbd/css', $data, true);
        $data['extra_js']       = $this->load->view('export_import/data_apbd/js', $data, true);
        $data['modal']          = $this->load->view('export_import/data_apbd/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    }

   
    public function target_apbd()
    {
        $breadcrumbs    = $this->breadcrumbs;
         $breadcrumbs->add('Admin', base_url());
        $breadcrumbs->add('Export Import', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
          $data['title']          = "Export - Import | Target APBD";
        $breadcrumbs->render();
        $data['icon']           = "metismenu-icon pe-7s-user";
        $data['description']    = "Menampilkan Pengelolaan Import Data Excel pada SIPD";
        $data['breadcrumbs']    = $breadcrumbs->render();
        $page                   = 'export_import/data_apbd/target_apbd'; 
        $data['tahun']           = 2026;// tahun_anggaran();
        $data['kode_tahap']           = 2;//tahapan_apbd();
        $data['instansi']           = $this->db->query("SELECT id_instansi, nama_instansi from master_instansi where kategori ='OPD' and is_active='1'")->result_array();
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('export_import/data_apbd/css', $data, true);
        $data['extra_js']       = $this->load->view('export_import/data_apbd/js', $data, true);
        $data['modal']          = $this->load->view('export_import/data_apbd/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    }

    public function template_target_sipd()
    {
        // $this->load->helper('download');
        $isi = '';
        $nama_file = FCPATH . 'sbe_files_support/export_sipd/template_import_target.xlsx';

    
        $nama_file_baru = 'Template RAK SIPD - SBE.xlsx'; // Nama baru yang diinginkan saat diunduh

        // Baca konten file
        $data = file_get_contents($nama_file);

        force_download($nama_file_baru, $data);


    }

   

    public function detail_import($id_import)
    {
        $id_export_import = sbe_crypt($id_import,'D');
        $breadcrumbs    = $this->breadcrumbs;
        $breadcrumbs->add('Admin', base_url());
        $breadcrumbs->add('Export Import', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
          $data['title']          = "Export - Import | Data APBD";
          $id_import = sbe_crypt($id_import,'D');
     
        $data['icon']           = "metismenu-icon pe-7s-user";


        $id_group           = $this->session->userdata('id_group');
        if ($id_group==5) {
            $id_instansi = id_instansi();
          $query = $this->db->query("SELECT * from export_import_data_apbd_mentah where id_instansi='$id_instansi' and id_export_import_sipd ='$id_export_import'")->result_array();
            $page                   = 'export_import/data_apbd/detail_opd';
        }else{
          $query = $this->db->query("SELECT * from export_import_data_apbd_mentah where id_export_import_sipd ='$id_export_import' ")->result_array();
            $page                   = 'export_import/data_apbd/detail';

        }



        $data['description']    = "Menampilkan Master Sub Kegiatan";
        $data['id_import']    = $id_import;
        $data['query']    = $query;
        $data['breadcrumbs']    = $breadcrumbs->render();
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('export_import/data_apbd/css', $data, true);
        $data['extra_js']       = $this->load->view('export_import/data_apbd/js', $data, true);
        $data['modal']          = $this->load->view('export_import/data_apbd/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    }

   

    public function kelola_import($id_import, $id_instansi)
    {
        $id_export_import = sbe_crypt($id_import,'D');
        $breadcrumbs    = $this->breadcrumbs;
        $breadcrumbs->add('Admin', base_url());
        $breadcrumbs->add('Export Import', base_url($this->router->fetch_class()));
        $breadcrumbs->render();
          $data['title']          = "Export - Import | Data APBD";
          $id_import = sbe_crypt($id_import,'D');
     
        $data['icon']           = "metismenu-icon pe-7s-user";


        $id_group           = $this->session->userdata('id_group');
        
            $id_instansi = sbe_crypt($id_instansi,'D');
          $program = $this->db->query("SELECT kode_program, nama_program from export_import_data_apbd_mentah where id_instansi='$id_instansi' and id_export_import_sipd ='$id_export_import' group by kode_program order by kode_program asc ")->result_array();
            $page                   = 'export_import/data_apbd/kelola_import_opd';
        

                $data['dropdown_option'] = [
                
                    ['tipe'=>'link', 'caption'=>'Lihat Data Metah', 'fa'=>'fas fa-check', 'onclick'=>'export_import/detail_import/'.sbe_crypt($id_import), 'elemen_tambahan'=>'data-toggle="tooltip" title="Kegiatan Unggulan"'],
                    ['tipe'=>'link', 'caption'=>'Kembali', 'fa'=>'fas fa-left-arrow', 'onclick'=>'export_import/sipd/data_apbd/', 'elemen_tambahan'=>'data-toggle="tooltip" title="Kegiatan Unggulan"'],
                    // ['tipe'=>'link', 'caption'=>'Program Unggulan', 'fa'=>'fa fa-thumbs-up', 'onclick'=>'data_apbd/progul', 'elemen_tambahan'=>'data-toggle="tooltip" title="Data Program Unggulan berdasarkan sub kegiatan yang dimiliki SKPD"'],
                ];


          $q_periode = $this->db->query("SELECT kode_tahap, tahun, created_at, id_export_import from export_import where id_export_import='$id_export_import' ")->row_array();

        $data['description']    = "Menampilkan Master Sub Kegiatan";
        $data['id_instansi']    = $id_instansi;
        $data['id_import']    = $id_import;
        $data['nama_instansi']    = nama_instansi($id_instansi);
        $data['periode']    = $q_periode;
        $data['program']    = $program;
        $data['breadcrumbs']    = '';
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('export_import/data_apbd/css', $data, true);
        $data['extra_js']       = $this->load->view('export_import/data_apbd/js', $data, true);
        $data['modal']          = $this->load->view('export_import/data_apbd/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    }

   

    public function import_all_data_apbd()
    {
       $id_export_import = $this->input->post('id_export_import');
       $id_instansi = $this->input->post('id_instansi');
       $kode_tahap = $this->input->post('kode_tahap');
       $tahun = $this->input->post('tahun');
       $data_import = $this->input->post('data_import');
       $decode =  json_decode($data_import, true);

       $data_ski = $decode['ski'];
       $data_ask = $decode['ask'];
       $data_sumberdana = $decode['sumberdana'];
       $this->db->trans_begin();

        $this->db->insert_batch('sub_kegiatan_instansi', $data_ski);
        $this->db->insert_batch('anggaran_sub_kegiatan', $data_ask);
        $this->db->insert_batch('sumber_dana', $data_sumberdana);
        $id_group = $this->session->userdata('id_group');
        $data_log = [ 
            'id_instansi'=>$id_instansi,
            'id_export_import'=>$id_export_import, 
            'tgl_import'=>timestamp(), 
            'import_by'=>id_user(), 
            'id_group_pengimport '=>$id_group, 
];
        $this->db->insert('export_import_log_data_apbd', $data_log);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
                echo json_encode(['id_export_import' => sbe_crypt($id_export_import)]);
        }
    }

   


   public function export_sipd_data_apbd()
{
    
        set_time_limit(0);
        $output = ['status' => false,'data' => []];
        $id = id_instansi();
        $primary_folder = './sbe_files_support/export_sipd/data_apbd';
        $directory = ['export_master_data', id_instansi()];
        $list_directory = $this->sbe_directory($primary_folder, $directory);
        if (!file_exists($list_directory)) {
            mkdir($list_directory, 0777, TRUE);
        }



        $q_master_instansi = $this->db->query("SELECT kode_opd, id_instansi from master_instansi where is_active = '1' and kategori='OPD'")->result_array();
        $kumpul_instansi = [];

        foreach ($q_master_instansi as $k => $v) {
            $kumpul_instansi[$v['kode_opd']] = $v['id_instansi']; 
        }

        $tahun = $this->input->post('tahun');
        $kode_tahap =$this->input->post('kode_tahap');
        $id_export = 1;
        $namafiledisimpan = "SIPD_DataAPBD_" . date('Ymdhis');
        $config['upload_path'] = $list_directory;
        $config['overwrite'] = true;
        $config['allowed_types'] = 'xlsx';
        $config['encrypt_name'] = false;
        $config['file_name'] = $namafiledisimpan;
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('upload_file')) {
            $output['status'] = false;
            $output['message'] = $this->upload->display_errors();
        } else {
            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($_FILES['upload_file']['tmp_name']);
            $apbd = $loadexcel->setActiveSheetIndex(0)->toArray(null, true, true, true);
            $this->db->trans_start();
            $data_apbd = array();
            $numrow = 1;
            $error = 0;
            $pesan = "";

            $data_export_import = [
                'tahun' => $tahun,
                'kode_tahap' => $kode_tahap,
                'file' => $namafiledisimpan,
                'created_at' => timestamp(),
                'created_by' => id_user(),
                'status' => 'Data Mentah', 
            ];

            $this->db->insert("export_import", $data_export_import);
            $id_export_import = $this->db->insert_id();
            $kumpul_data_mentah = [];
            foreach ($apbd as $row) {
                if ($numrow > 1) {
                 

                    if ($row['E']=='4.01.0.00.0.00.01.0000') {
                        $id_instansi = $kumpul_instansi[$row['G']];
                    }else{
                        $id_instansi = $kumpul_instansi[$row['E']];

                    }
                        $data = [
                            'id_export_import_sipd' => $id_export_import,
                            'id_instansi' => $id_instansi,
                            'no' => $row['A'],
                            'tahun' => $row['B'],
                            'kode_urusan' => $row['C'],
                            'nama_urusan' => $row['D'],
                            'kode_skpd' => $row['E'],
                            'nama_skpd' => $row['F'],
                            'kode_sub_unit' => $row['G'],
                            'nama_sub_unit' => $row['H'],
                            'kode_bidang_urusan' => $row['I'],
                            'nama_bidang_urusan' => $row['J'],
                            'kode_program' => $row['K'],
                            'nama_program' => $row['L'],
                            'kode_kegiatan' => $row['M'],
                            'nama_kegiatan' => $row['N'],
                            'kode_sub_kegiatan' => $row['O'],
                            'nama_sub_kegiatan' => $row['P'],

                            'kode_sumber_dana' => $row['Q'] == '' ? '' : $row['Q'],
                            'nama_sumber_dana' => $row['R'] == '' ? '' : $row['R'],
                            'kode_rekening' => $row['S'],
                            'nama_rekening' => $row['T'],
                            'pagu' => $row['U'],
                        ];
                        array_push($kumpul_data_mentah, $data);
                    // } else {
                    //     $error += 1;
                    //     $pesan .= 'Baris ke ' . $numrow . ' Error<br>';
                    // }
                }
                $numrow++;
            }

            $this->db->insert_batch("export_import_data_apbd_mentah", $kumpul_data_mentah);

            $upload = ['upload_data' => $this->upload->data()];
            $file_ext = pathinfo($_FILES["upload_file"]["name"], PATHINFO_EXTENSION);
            $output['status'] = true;
            if ($error > 0) {
                $this->db->trans_rollback();
                $pesan_flashdata = '<div class="alert alert-info">' . $pesan . '<br>Silahkan perbaiki kesalahan pada baris tersebut.</div>';
            } else {
                $this->db->trans_commit();
                $pesan_flashdata = '<div class="alert alert-info">Data Master Sub Kegiatan berhasil di export</div>';
            }
        }

        $id_import = sbe_crypt($id_export_import);
        $this->session->set_flashdata('pesan', $pesan_flashdata);
        redirect('export_import/detail_import/'.$id_import);
    }

   public function export_sipd_target_apbd()
{
    
        set_time_limit(0);
        $output = ['status' => false,'data' => []];
        $id_instansi = $this->input->post('id_instansi');
        $tahun = $this->input->post('tahun');
        $tahap = $this->input->post('tahap');
        $kode_tahap = $tahap;
        $primary_folder = './sbe_files_support/export_sipd/target_sipd_apbd';
        $directory = ['export_master_data', id_instansi()];
        $list_directory = $this->sbe_directory($primary_folder, $directory);
        if (!file_exists($list_directory)) {
            mkdir($list_directory, 0777, TRUE);
        }



        $id_export = 1;
        $namafiledisimpan = "SIPD_DataAPBD_" . date('Ymdhis');
        $config['upload_path'] = $list_directory;
        $config['overwrite'] = true;
        $config['allowed_types'] = 'xlsx';
        $config['encrypt_name'] = false;
        $config['file_name'] = $namafiledisimpan;
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('upload_file')) {
            $output['status'] = false;
            $output['message'] = $this->upload->display_errors();
        } else {
            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load($_FILES['upload_file']['tmp_name']);
            $apbd = $loadexcel->setActiveSheetIndex(0)->toArray(null, true, true, true);
            $this->db->trans_start();
            $data_apbd = array();
            $numrow = 1;
            $error = 0;
            $pesan = "";

            $id_export_import = $this->db->insert_id();
            $kumpul_data_mentah = [];
            $G = 7 ; 
            $S = 19 ; 
            foreach ($apbd as $row) {
                if ($numrow > 5) {
                 $kode_sub_kegiatan = $row['C'];
                 $kode_sub_unit = $row['B'];
                 $pagu = str_replace(',', '', $row['E']);



                 $pecah = explode('.', $kode_sub_kegiatan);



                     if (count($pecah)==6) {
                         $kode_bidang_urusan = $pecah[0].'.'.$pecah[1];
                         $kode_program = $pecah[0].'.'.$pecah[1].'.'.$pecah[2];
                         $kode_kegiatan = $pecah[0].'.'.$pecah[1].'.'.$pecah[2].'.'.$pecah[3].'.'.$pecah[4];
                         $target_fisik_akumulasi =0;
                         $target_keuangan_akumulasi = 0;
                          for ($i=0; $i <12 ; $i++) { 
                            $bulan = $i+1;
                            $angka_kolom_keu = $G+$i; 
                            $angka_kolom_fisik = $S+$i; 

                           $kolom_keu = angkaKeHuruf($angka_kolom_keu);
                           $kolom_fisik = angkaKeHuruf($angka_kolom_fisik);

                           $nilai_keuangan = str_replace(',', '', $row[$kolom_keu]);
                           $nilai_fisik  = $pagu==0 || $pagu=='' ? 0 : str_replace(['.', ','], ['.'], $row[$kolom_fisik]);
                       

                           $target_keuangan_akumulasi += $nilai_keuangan;
                           $target_fisik_akumulasi += (float) $nilai_fisik;
                           $persen_target_keuangan_bulanan = ($pagu==0 || $pagu=='' ? 0 : ($nilai_keuangan / $pagu) * 100 ) ; 
                           $persen_target_keuangan_akumulasi = ($pagu==0 || $pagu=='' ? 0 : ($target_keuangan_akumulasi / $pagu) * 100 ) ; 
                            

                            if ($kode_sub_unit=='') {
                               $simpan_kode_sub_kegiatan = str_replace(' ', '', $kode_sub_kegiatan);
                            }else{
                               $simpan_kode_sub_kegiatan = str_replace(' ', '', $kode_sub_kegiatan.'-'.$kode_sub_unit);

                            }
                        $data = [
                            'id_instansi' => $id_instansi,
                            'kode_bidang_urusan' => str_replace(' ', '', $kode_bidang_urusan),
                            'kode_rekening_program' => str_replace(' ', '', $kode_program),
                            'kode_rekening_kegiatan' => str_replace(' ', '', $kode_kegiatan),
                            'kode_rekening_sub_kegiatan' => $simpan_kode_sub_kegiatan,
                            'kode_tahap' => $kode_tahap,

                            'bulan' => $bulan,
                            'target_fisik' => $target_fisik_akumulasi,
                            'target_keuangan' => $target_keuangan_akumulasi,
                            'persen_target_keuangan' => $persen_target_keuangan_akumulasi,
                            'target_fisik_bulanan' => $nilai_fisik,
                            'target_keuangan_bulanan' => $nilai_keuangan,
                            'persen_target_keuangan_bulanan' => $persen_target_keuangan_bulanan,
                            'keuangan' => '',
                            'tahun' => $tahun,
                            'created_on' => timestamp(),
                            'created_by' => id_user(),
                            'input_by ' => 'Import Excel - Checked',
                        ];
                        array_push($kumpul_data_mentah, $data);
                          }

                     }else{
                        
                     }
                    // } else {
                    //     $error += 1;
                    //     $pesan .= 'Baris ke ' . $numrow . ' Error<br>';
                    // }
                }
                $numrow++;
                echo "<hr>";
            }
            // echo angkaKeHuruf(436);
            // die;
            $this->db->insert_batch("target_apbd", $kumpul_data_mentah);


            $id_group = $this->session->userdata('id_group');
            $data_log = [ 
                'id_instansi'=>$id_instansi,
                'tahun'=>$tahun, 
                'kode_tahap'=>$kode_tahap, 
                'tgl_import'=>timestamp(), 
                'import_by'=>id_user(), 
                'id_group_pengimport '=>$id_group, 
    ];
            $this->db->insert('export_import_log_target_apbd', $data_log);




            $upload = ['upload_data' => $this->upload->data()];
            $file_ext = pathinfo($_FILES["upload_file"]["name"], PATHINFO_EXTENSION);
            $output['status'] = true;
            if ($error > 0) {
                $this->db->trans_rollback();
                $pesan_flashdata = '<div class="alert alert-info">' . $pesan . '<br>Silahkan perbaiki kesalahan pada baris tersebut.</div>';
            } else {
                $this->db->trans_commit();
                $pesan_flashdata = '<div class="alert alert-info">Data RAK Sub Kegiatan berhasil di export</div>';
            }
        }

        $id_import = sbe_crypt($id_export_import);
        $this->session->set_flashdata('pesan', $pesan_flashdata);
        redirect('data_apbd/target_data_apbd?tahun='.$tahun.'&tahap='.$tahap.'&id_instansi='.$id_instansi);
    }


}
