<?php

/**
 * androidor     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : android.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Integrasi_aplikasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->sumber_data = "Sumber Data : ???";
        $this->sumber_data_kab_kota = "???";
        $this->load->model('android/android_model', 'android_model');

        $this->load->model([
   //          'model_versi' => 'mversi',
   //          'dashboard/dashboard_model'       => 'dashboard_model',
           
            'datatables_model'                         => 'datatables_model',
			// 'realisasi/realisasi_fisik_keuangan_model'    => 'realisasi_fisik_keuangan_model',
			'Laporan/realisasi_akumulasi_model'		=> 'realisasi_akumulasi_model',
			// 'Laporan/rekap_asisten_model'					=> 'rekap_asisten_model',
			// 'Laporan/ratarata_fisik_keuangan'					=> 'ratarata_fisik_keuangan',
			// 'Laporan/rekap_realisasi_total_model'	=> 'rekap_realisasi_total_model',
			// 'Laporan/jumlah_aktivitas_model'	=> 'jumlah_aktivitas_model',
			// 'Laporan/rekap_kegiatan_kab_kota'	=> 'rekap_kegiatan_kab_kota',
			// 'Laporan/lap_realisasi_fisik_keu'	=> 'lap_realisasi_fisik_keu',
			// 'Laporan/realisasi_per_kab_kota'	=> 'realisasi_per_kab_kota',
			// 'Laporan/realisasi_gabungan_per_kab_kota'	=> 'realisasi_gabungan_per_kab_kota',
			// 'Laporan/target_realisasi_model'	=> 'target_realisasi_model',
			// 'Laporan/rekap_permasalahan_model'	=> 'rekap_permasalahan_model',
			// 'config/config_model' => 'config_model',

            'sumbarsiap/target_realisasi_model'     => 'target_realisasi_model',
			'sumbarsiap/sumbarsiap_model'      => 'sumbarsiap_model',
            'integrasi_sakatoplan/integrasi_sakatoplan_model'      => 'integrasi_sakatoplan_model',
            'integrasi_aplikasi/integrasi_sipedal_model'      => 'integrasi_sipedal_model',
            
        ]);
    }

    public function index()
    {
        
    }


    public function sipd(){
      
        $url = "http://localhost/siap_sumbar_sbe_2022/android/daftar_skpd";
        $tahun = $this->input->post('tahun');
        $id_instansi = $this->input->post('id_instansi');
        $id_instansi = sbe_crypt($id_instansi, 'D');
        $tahap = $this->input->post('tahap');
        $token = "";
        $data       = file_get_contents($url);

        $decode = json_decode($data);

        $nama_instansi = nama_instansi($id_instansi);


        $kumpul_data = [];
        $no=0;
        echo "
        <table class='table table-striped table-bordered' style='margin-top:10px'>
            <tr>
                <th>No</th>
                <th>SKPD</th>
                <th>Tahun</th>
                <th>Tahapan APBD</th>
                <th>Kode Sub Kegiatan</th>
                <th>Kategori</th>
                <th>Kategori</th>
                <th>Keterangan</th>
            </tr>
        ";
        foreach ($decode->data as $key => $value) {
            $no++;

            echo "  
            <tr>
                <td>".$no."</td>
                <td>".$nama_instansi."</td>
                <td>".$tahun."</td>
                <td>".pilihan_nama_tahapan($tahap)."</td>
                <td>????</td>
                <td>????</td>
                <td>????</td>
                <td>????</td>
            
            </tr>";
            $insert_sql = [
                'id_instansi'=>$value->id_instansi,
                'kode_tahap'=>2,
            ];
            array_push($kumpul_data, $insert_sql);
           // var_dump($value->id_instansi);
        }
        echo '</table>';

        echo '
        <div class="col-md-12">
                <div class="form-group">
                    <button class="btn btn-info btn-block" onclick="swal.fire(`Belum Aktif`,`Fitur ini belum aktif \N Cara kerjanya adalah menyalin semua di method ini dan memasukannya ke database`,`error`)" type="button">Kelola integrasi</button>
                </div>
            </div>

            ';
       
        // return $kumpul_data;   
     }  




    public function sipedal()
    {
        $breadcrumbs     = $this->breadcrumbs;
        // $master_paket   = $this->master_paket_model;

        $integrasi_sipedal    = $this->integrasi_sipedal_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Integrasi Sipedal - Paket Pekerjaan', base_url($this->router->fetch_class()));
        
        $breadcrumbs->render();
        $data['input_by']                      = "";

        $data['kode_tahap']                = tahapan_apbd();
        $data['tahun']                = tahun_anggaran();

        $id_group = $this->session->userdata('id_group');

        $id_opd = id_instansi();
        $konversi_instansi = $this->db->query("SELECT integrasi_sipedal_id_instansi, id_instansi, nama_instansi from master_instansi where id_instansi='$id_opd'")->row_array();
        $id_instansi_enc = sbe_crypt($konversi_instansi['integrasi_sipedal_id_instansi'], 'E');
        $tahun = tahun_anggaran();
        $data['opd']                    = $integrasi_sipedal->get_skpd($id_group);
        $data['konfigurasi']                 = $this->db->get('config')->result_array();

         $data['dropdown_option']                      = [
            
            
             ['tipe'=>'link', 'caption'=>'Kelola Hasil Import Pengintegrasian Sipedal ', 'fa'=>'fa fa-arrow-left', 'onclick'=>'integrasi_aplikasi/cek_import_sipedal?id_opd='.$id_instansi_enc.'&tahun='.$tahun.'', 'elemen_tambahan'=>'data-toggle="tooltip" title="Kembali"'],
        ];
        $data['title']                      = "Integrasi Aplikasi - SIPEDAL";
        $data['icon']                       = "metismenu-icon fa fa-list-ul";
        $data['description']                = "Mengambil data dari aplikasi SIPDEAL - Biro Pengadaan Barang Dan Jasa Setda Provinsi Sumatera Barat untuk ditampilkan dan disalin ke dalam aplikasi Simbangda Based Evidence     ";
        $data['breadcrumbs']                ='';// $breadcrumbs->render();
      

        $page                               = 'integrasi_aplikasi/sipedal/index';
        $data['link']                       = $this->router->fetch_method();
        $data['fetch_method']                       = $this->router->fetch_method();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                  = $this->load->view('integrasi_aplikasi/sipedal/css', $data, true);
        $data['extra_js']                   = $this->load->view('integrasi_aplikasi/sipedal/js', $data, true);
        $data['modal']                      = $this->load->view('integrasi_aplikasi/sipedal/modal', $data, true);


       
        $this->template->load('backend_template', $page, $data);
    }



    public function cek_import_sipedal()
    {
        // error_reporting(0);
        $breadcrumbs     = $this->breadcrumbs;
        // $master_paket   = $this->master_paket_model;

        $integrasi_sipedal    = $this->integrasi_sipedal_model;
        $id_opd = sbe_crypt($this->input->get('id_opd'),'D');
        $tahun = $this->input->get('tahun');

        // $url = "https://sipedal.sumbarprov.go.id/api/v1/simbangda/rup_paket_penyedia?tahun=$tahun&instansi_id=D462&idsatker=$id_opd&order_col=namasatker&order_dir=desc";
        // $data       = file_get_contents($url);
        //     $decode = json_decode($data);
            $jumlah_data_sipedal  = $this->input->get('jumlah_sipedal');//       count($decode->data);
        $konversi_instansi = $this->db->query("SELECT id_instansi, nama_instansi from master_instansi where integrasi_sipedal_id_instansi='$id_opd'")->row_array();
        $id_instansi = $konversi_instansi['id_instansi'];

        if (tahapan_apbd()==4) {
            $sub_kegiatan_instansi = $this->db->query("SELECT * from v_sub_kegiatan_apbd where id_instansi='$id_instansi' and tahun='$tahun' and status='1'");
        }else{
            $tahap = 2;
            $sub_kegiatan_instansi = $this->db->query("SELECT * from v_sub_kegiatan_apbd where id_instansi='$id_instansi' and tahun='$tahun' and kode_tahap='$tahap'");
        }
        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Integrasi Sipedal - Paket Pekerjaan', base_url($this->router->fetch_class()));
        
        $breadcrumbs->render();
        // $data['input_by']                      = "";
        $id_group = $this->session->userdata('id_group');



        $q_import_sipedal_sbe = $this->db->query("SELECT id_paket_pekerjaan from paket_pekerjaan where input_by ='Integrasi Sipedal' and tahun='$tahun' and id_instansi='$id_instansi'")->num_rows();
        $q_paket_keseluruhan = $this->db->query("SELECT id_paket_pekerjaan from v_paket where tahun='$tahun' and id_instansi='$id_instansi'")->num_rows();
        $data_page['sub_kegiatan_instansi']                = $sub_kegiatan_instansi->result_array();
        $data_page['fetch_method']                = $this->router->fetch_method();



        $where_cek_lokasi = ['tahun'=>$tahun,'id_instansi'=>$id_instansi , 'synchronize'=>0];
        $lokasi_mentah = $this->db->get_where('lokasi_paket_pekerjaan_sipedal_mentah', $where_cek_lokasi)->num_rows();
        $data_page['lokasi_mentah']                = $lokasi_mentah;



        $data_page['id_opd']                = sbe_crypt($id_instansi,'E');;
        $data_page['tahun']                = $tahun;
        $data_page['jumlah_data_sipedal']                = $jumlah_data_sipedal;
        $data_page['jumlah_import_data_sipedal']                = $q_import_sipedal_sbe;
        $data_page['jumlah_data_paket']                = $q_paket_keseluruhan;

        $data_page['id_instansi']                    = $konversi_instansi['id_instansi'];
        $data_page['nama_instansi']                    = $konversi_instansi['nama_instansi'];
       
        $data_page['title']                      = "Integrasi Aplikasi - SIPEDAL - Cek Import Sipedal";
        $data_page['icon']                       = "metismenu-icon fa fa-list-ul";
        $data_page['description']                = "Mencek hasil import sipedal ke dalam aplikasi Simbangda";
        $data_page['breadcrumbs']                = $breadcrumbs->render();
            
        $data_paket_import = $integrasi_sipedal->cek_paket_sbe_import_sipedal($id_instansi, $tahun)->result_array();
        $data_page['data_paket_import']                = $data_paket_import;

        $page                               = 'integrasi_aplikasi/sipedal/cek_import_sipedal';
        $data_page['link']                       = $this->router->fetch_method();
        $data_page['fetch_method']                       = $this->router->fetch_method();
        $data_page['menu']                       = $this->load->view('layout/menu', $data_page, true);
        $data_page['extra_css']                  = $this->load->view('integrasi_aplikasi/sipedal/css', $data_page, true);
        $data_page['extra_js']                   = $this->load->view('integrasi_aplikasi/sipedal/js', $data_page, true);
        $data_page['modal']                      = $this->load->view('integrasi_aplikasi/sipedal/modal', $data_page, true);


       
        $this->template->load('backend_template', $page, $data_page);
    }



    public function cek_import_ikd(){
        $id_opd = $this->input->get('id_opd');
        $tahun = 2025;
        $kode_tahap = 2;
        $id_instansi = sbe_crypt($id_opd, 'D');
          $data_page['title']                      = "Integrasi Aplikasi - SIPEDAL - Cek Import Sipedal";
        $data_page['icon']                       = "metismenu-icon fa fa-list-ul";
        $data_page['description']                = "Mencek hasil import sipedal ke dalam aplikasi Simbangda";
        $data_page['breadcrumbs']                = '';

        $data_sub_kegiatan = $this->db->query("SELECT * from v_sub_kegiatan_apbd where id_instansi='$id_instansi' and tahun = '2025'");
          $q_target = $this->db->query("SELECT  kode_rekening_sub_kegiatan  from target_apbd where id_instansi = '$id_instansi' and tahun = '$tahun' and kode_tahap='$kode_tahap'")->result_array();
        $kumpul_target = [];
        foreach ($q_target as $k => $v) {
            array_push($kumpul_target, $v['kode_rekening_sub_kegiatan']);
        }
       

        $data_page['kumpul_target'] = $kumpul_target;

 $data_page['dropdown_option']                      = [
            
            
             ['tipe'=>'link', 'caption'=>'Kembali', 'fa'=>'fa fa-arrow-left', 'onclick'=>'integrasi_aplikasi/ikd', 'elemen_tambahan'=>'data-toggle="tooltip" title="Kembali"'],  
        ];


            $page                               = 'integrasi_aplikasi/ikd/cek_import_ikd';
        $data_page['id_opd']                       = sbe_crypt($id_opd,'D');
        $data_page['nama_instansi']                       = nama_instansi($id_instansi);
        $data_page['sub_kegiatan']                       = $data_sub_kegiatan->result_array();
        $data_page['link']                       = $this->router->fetch_method();
        $data_page['fetch_method']                       = $this->router->fetch_method();
        $data_page['menu']                       = $this->load->view('layout/menu', $data_page, true);
        $data_page['tahun']                       = 2025;
        $data_page['extra_css']                  = $this->load->view('integrasi_aplikasi/ikd/css', $data_page, true);
        $data_page['extra_js']                   = $this->load->view('integrasi_aplikasi/ikd/js', $data_page, true);
        $data_page['modal']                      = $this->load->view('integrasi_aplikasi/ikd/modal', $data_page, true);
        $this->template->load('backend_template', $page, $data_page);
    }

    public function cek_import_ikd_detail_pagu(){
        $kode_sub_kegiatan = $this->input->post('kode_sub_kegiatan');
        $tahun = $this->input->post('tahun');
        $kode_tahap = $this->input->post('kode_tahap');
        $id_instansi = $this->input->post('id_instansi');

        $data = $this->db->query("SELECT ask.* , 
        ski.nama_sub_kegiatan, 
         ski.kategori,
ski.jenis_sub_kegiatan,
ski.keterangan 

 from anggaran_sub_kegiatan ask
            left join sub_kegiatan_instansi ski on ask.kode_sub_kegiatan = ski.kode_sub_kegiatan and ski.tahun=ski.tahun and ask.id_instansi = ski.id_instansi and ask.kode_tahap=ski.kode_tahap
         where ask.tahun='$tahun' and ask.kode_sub_kegiatan='$kode_sub_kegiatan' and ask.kode_tahap='$kode_tahap' and ask.id_instansi='$id_instansi'")->row_array();
        echo json_encode($data);

    }


    public function preview_import_dan_auto_evidence()
    {
        // error_reporting(0);
        $breadcrumbs     = $this->breadcrumbs;
        $integrasi_sipedal    = $this->integrasi_sipedal_model;
        $id_opd = sbe_crypt($this->input->get('id_opd'),'D');
        $tahun = $this->input->get('tahun');
        $id_instansi = $id_opd;
        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Integrasi Sipedal - Paket Pekerjaan', base_url($this->router->fetch_class()));
        $breadcrumbs->render();



       
        $data_page['title']                      = "Integrasi Aplikasi - SIPEDAL - Cek Import Sipedal";
        $data_page['icon']                       = "metismenu-icon fa fa-list-ul";
        $data_page['description']                = "Mencek hasil import sipedal ke dalam aplikasi Simbangda";
        $data_page['breadcrumbs']                = $breadcrumbs->render();

        if (tahapan_apbd()==4) {
            $sub_kegiatan_instansi = $this->db->query("SELECT * from v_sub_kegiatan_apbd where id_instansi='$id_instansi' and tahun='$tahun' and status='1'");
        }else{
            $tahap = 2;
            $sub_kegiatan_instansi = $this->db->query("SELECT * from v_sub_kegiatan_apbd where id_instansi='$id_instansi' and tahun='$tahun' and kode_tahap='$tahap'");
        }


        $kumpul_sub_kegiatan = [];
        foreach ($sub_kegiatan_instansi->result_array() as $k => $v) {
            $kode_sub_kegiatan = $v['kode_rekening_sub_kegiatan'];

            $q_paket = $this->db->query("SELECT * from v_paket where id_instansi='$id_instansi' and tahun = '$tahun' and kode_rekening_sub_kegiatan='$kode_sub_kegiatan'")->result_array();

            $nama_sub_kegiatan = $nama_sub_kegiatan = $v['kategori']=='Sub Kegiatan SKPD' ? $v['nama_sub_kegiatan'] : $v['nama_sub_kegiatan'].'<br>'.$v['jenis_sub_kegiatan'].' - '.$v['keterangan'];
        $kumpul_sub_kegiatan[$k] = [
            'kode_sub_kegiatan' => $v['kode_rekening_sub_kegiatan'],
            'kategori' => $v['kategori'],
            'nama_sub_kegiatan' => $nama_sub_kegiatan,
            'pagu' => $v['pagu'],
            'paket' => $q_paket,
        ];
           // $data_sub_kegiatan = [
           //  $v['kode_rekening_sub_kegiatan'] => ''
           // ];

        }


        $data_page['sub_kegiatan_instansi']                = $kumpul_sub_kegiatan;
        $data_page['fetch_method']                = $this->router->fetch_method();






        $page                               = 'integrasi_aplikasi/sipedal/preview_import_sipedal_auto_evidence';
        $data_page['tahun']                       =$tahun;
        $data_page['id_opd']                       =$this->input->get('id_opd');
        $data_page['link']                       = $this->router->fetch_method();
        $data_page['fetch_method']                       = $this->router->fetch_method();
        $data_page['menu']                       = $this->load->view('layout/menu', $data_page, true);
        $data_page['extra_css']                  = $this->load->view('integrasi_aplikasi/sipedal/css', $data_page, true);
        $data_page['extra_js']                   = $this->load->view('integrasi_aplikasi/sipedal/js', $data_page, true);
        $data_page['modal']                      = $this->load->view('integrasi_aplikasi/sipedal/modal', $data_page, true);


       
        $this->template->load('backend_template', $page, $data_page);
    }



    public function get_auto_evidence()
    {
        // error_reporting(0);
        $breadcrumbs     = $this->breadcrumbs;
        $integrasi_sipedal    = $this->integrasi_sipedal_model;
        $id_opd = sbe_crypt($this->input->get('id_opd'),'D');
        $tahun = $this->input->get('tahun');




        $id_instansi = $id_opd;



           $url_spse_paket_nontender = "https://sipedal.sumbarprov.go.id/api/v1/simbangda/spse_paket_nontender";
            $data_spse_paket_nontender       = file_get_contents($url_spse_paket_nontender);
            $decode_spse_paket_nontender = json_decode($data_spse_paket_nontender);
            $kumpul_spse_non_tender = [];
            foreach ($decode_spse_paket_nontender->data as $k => $v) {
                $kumpul_spse_non_tender[$v->kd_nontender] = [];
            }

            // echo json_encode($kumpul_spse_non_tender);





            $q_paket = $this->db->query("SELECT 
                kode_rekening_sub_kegiatan, kode_rekening_kegiatan, kode_rekening_program, kode_bidang_urusan,
                integrasi_sipedal_id_rup, integrasi_sipedal_id_spse, id_paket_pekerjaan, id_metode, jenis_paket from v_paket where id_instansi='$id_instansi' and tahun = '$tahun' and integrasi_sipedal_id_rup !=''")->result_array();
            $kumpul_auto_evidence = [];
            foreach ($q_paket as $k_paket => $v_paket) {
                $id_paket = $v_paket['id_paket_pekerjaan'];
                $id_rup = $v_paket['integrasi_sipedal_id_rup'];
                $id_spse = $v_paket['integrasi_sipedal_id_spse'];
                $id_metode = $v_paket['id_metode'];
                $jenis_paket = $v_paket['jenis_paket']; 
                 $q_bobot = $this->db->query("SELECT * from master_bobot where jenis_paket='$jenis_paket' and id_metode='$id_metode' and auto_evidence=1");
                 foreach ($q_bobot->result_array() as $k_bobot => $v_bobot) {
                     $nama_dokumen = $v_bobot['nama_dokumen']; 
                     $link = $v_bobot['link_auto_evidence']; 
                     $konversi_link_rup = str_replace('$id_rup$', $id_rup, $link) ;
                     $konversi_link_spse = str_replace('$id_spse$', $id_spse, $link);

                     $link_file = $v_bobot['nama_dokumen'] =='RUP' ? $konversi_link_rup : $konversi_link_spse;
                     $cek_sudah_pernah = $this->db->query("SELECT id_realisasi_fisik from realisasi_fisik where id_paket_pekerjaan='$id_paket' and dokumen_key='$nama_dokumen'")->num_rows();
                     $preview_auto_evidence = $v_bobot['preview_auto_evidence'];


                        $data_import_rf = [
                            'id_instansi' => $id_opd,
                            'id_paket_pekerjaan' => $id_paket,
                            'kode_bidang_urusan' => $v_paket['kode_bidang_urusan'],
                            'kode_rekening_program' => $v_paket['kode_rekening_program'],
                            'kode_rekening_kegiatan' => $v_paket['kode_rekening_kegiatan'],
                            'kode_rekening_sub_kegiatan' => $v_paket['kode_rekening_sub_kegiatan'],
                            'bulan' => bulan_aktif(),
                            'tahun' => $tahun,
                            'dokumen_key' => $v_bobot['nama_dokumen'],
                            'dokumen' => $v_bobot['nama_dokumen'],
                            'file_dokumen' => $link_file    ,
                            'status' => 'Validasi Otomatis',
                            'nilai' => $v_bobot['bobot'],
                            'created_on' => timestamp(),

                            'created_by' => id_user() ,

                            'integrasi_sipedal_id_rup' => $v_paket['integrasi_sipedal_id_rup'] ,
                            'auto_evidence ' => '1' ,
                            'preview_auto_evidence ' => $preview_auto_evidence ,
                            'input_by ' => 'Integrasi Sipedal',


                        ];

                    if ($cek_sudah_pernah==0) {
                        array_push($kumpul_auto_evidence, $data_import_rf);
                    }
                 }
            }

            

            $jumlah_evidence = count($kumpul_auto_evidence);
            if ($jumlah_evidence>0) {
                $this->db->trans_begin();
                $this->db->insert_batch('realisasi_fisik', $kumpul_auto_evidence);
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                        $this->session->set_flashdata('pesan','<div class="alert alert-success">Terjadi kesalahan pada aplikasi</div>');
                    }
                    else
                    {
                        $this->db->trans_commit();
                        $this->session->set_flashdata('pesan','<div class="alert alert-success">Auto evidence di simpan ['.$jumlah_evidence.' Evidence]</div>');
                    }
            }else{
                $this->session->set_flashdata('pesan','<div class="alert alert-danger">Tidak ada auto evidence</div>');

            }

            redirect('integrasi_aplikasi/preview_import_dan_auto_evidence?id_opd='.$this->input->get('id_opd').'&tahun='.$tahun);
    }





    public function get_data_sipedal(){
        

        $integrasi_sipedal    = $this->integrasi_sipedal_model;
        $tahun = $this->input->post('tahun');
        $id_instansi = $this->input->post('id_instansi');
        
        $tahap = $this->input->post('tahap');
        $jenis = "PENYEDIA";//$this->input->post('jenis');
        $order = "desc";
        $coloumn_order = "namasatker";

        // if ($id_instansi=='semua_opd') {
        //      $url = "https://sipedal.sumbarprov.go.id/api/v1/simbangda/rup_paket_penyedia?tahun=$tahun&instansi_id=D462";
        //     $data       = file_get_contents($url);
        //     $decode = json_decode($data);

        //      $paket_sbe = $integrasi_sipedal->list_paket_sbe_semua($tahun, $jenis);
        //         $data_paket_tersimpan = [];
        //         foreach ($paket_sbe->result_array() as $k => $v) {
        //            array_push($data_paket_tersimpan, $v['integrasi_sipedal_id_rup']);
        //         }   



        //     $pagedata['nama_instansi']="SEMUA OPD";
        // }else{
            $id_instansi = sbe_crypt($id_instansi, 'D');
            $q_instansi = $this->db->query("SELECT nama_instansi from master_instansi where integrasi_sipedal_id_instansi='$id_instansi'")->row_array();
            $pagedata['nama_instansi']=$q_instansi['nama_instansi'];

            $url = "https://sipedal.sumbarprov.go.id/api/v1/simbangda/rup_paket_penyedia?tahun=$tahun&instansi_id=D462&idsatker=$id_instansi&order_col=$coloumn_order&order_dir=$order";
            // $data       = file_get_contents($url);
            // $decode = json_decode($data);

            $url_swakelola = "https://sipedal.sumbarprov.go.id/api/v1/simbangda/rup_paket_swakelola?tahun=$tahun&instansi_id=D462&idsatker=$id_instansi&order_col=$coloumn_order&order_dir=$order";
            // $data_swakelola       = file_get_contents($url_swakelola);
            // $decode_swakelola = json_decode($data_swakelola);





             $konversi_id_instansi_sipedal_sbe = $integrasi_sipedal->konversi_sipedal_sbe($id_instansi);
            if ($konversi_id_instansi_sipedal_sbe['id_instansi']=='') {
                $konversi_id_instansi_sbe = 'Tidak Ditemukan';
                $data_paket_tersimpan = [];
            }else{
                $konversi_id_instansi_sbe = $konversi_id_instansi_sipedal_sbe['id_instansi'];
                $paket_sbe = $integrasi_sipedal->list_paket_sbe($konversi_id_instansi_sbe, $tahun, $jenis);
                $data_paket_tersimpan = [];
                foreach ($paket_sbe->result_array() as $k => $v) {
                   array_push($data_paket_tersimpan, $v['integrasi_sipedal_id_rup']);
                }   


            }



        // }



       
        $token = '';
        $curl_paket_penyedia = $this->api_sipedal_penyedia($token, $tahun, $id_instansi);
        $curl_paket_swakelola = $this->api_sipedal_swakelola($token, $tahun, $id_instansi);


        // echo $id_instansi;
        $kumpul_data = [];

        $pagedata['cekdata']=$id_instansi;
        $pagedata['data_paket_sbe']=$data_paket_tersimpan;
        $pagedata['data_sipedal_penyedia']=$curl_paket_penyedia;
        // $pagedata['data_sipedal_penyedia']=$decode;
        $pagedata['data_sipedal_swakelola']=$curl_paket_swakelola;
        $pagedata['jumlah_data_sipedal_penyedia']=count($curl_paket_penyedia->data);
        $pagedata['jumlah_data_sipedal_swakelola']=count($curl_paket_swakelola->data);
        $pagedata['integrasi_sipedal']=$integrasi_sipedal;
        $pagedata['id_instansi']=$this->input->post('id_instansi');
        $pagedata['tahun']=$tahun;
        $pagedata['jenis_paket']=$jenis;
        $pagedata['link_api']=$url;
        $pagedata['link_api_swa']=$url_swakelola;
        $data='';
                $page                               = 'integrasi_aplikasi/sipedal/api_sipedal_result';
        // $data['link']                       = $this->router->fetch_method();
        // $data['menu']                       = $this->load->view('layout/menu', $data, true);
        // $data['extra_css']                  = $this->load->view('data_apbd/data_apbd/css', $data, true);
        $pagedata['extra_js']                   = $this->load->view('integrasi_aplikasi/sipedal/js', $data, true);
        // $data['modal']                      = $this->load->view('data_apbd/data_apbd/modal', $data, true);
        $this->load->view($page, $pagedata);





        // $this->load->view('integrasi_aplikasi/sipedal/index', $pagedata);
        // echo "
        // <table class='table table-striped table-bordered' style='margin-top:10px'>
        //     <tr>
        //         <th>No</th>
        //         <th>SKPD</th>
        //         <th>Sub Kegiatan</th>
        //         <th>Tahapan APBD</th>
        //         <th>Paket Pekerjaan</th>
        //         <th>Jenis Paket</th>
        //         <th>Pagu Paket</th>
        //         <th>Metode Paket</th>
        //         <th>Keterangan</th>
        //     </tr>
        // ";
       
        // echo '</table>';

        // echo '
        // <div class="col-md-12">
        //         <div class="form-group">
        //             <button class="btn btn-info btn-block" onclick="swal.fire(`Belum Aktif`,`Fitur ini belum aktif \N Cara kerjanya adalah menyalin semua di method ini dan memasukannya ke database`,`error`)" type="button">Import Ke Dalam Simbangda</button>
        //         </div>
        //     </div>

        //     ';
       
        // return $kumpul_data;   
     }  

    public function import_sipedal_ke_sbe(){


        $integrasi_sipedal    = $this->integrasi_sipedal_model;

        $result     = [
                'success'   => false,
                'messages'  => '',
                'swal_code'  => '',
                'instruksi'  => ''
            ];

        $link_api_penyedia = $this->input->post('link_api_penyedia');
        $link_api_swakelola = $this->input->post('link_api_swakelola');

        $tahun = $this->input->post('tahun');
        $jenis = $this->input->post('jenis');
        $id_instansi = $this->input->post('id_instansi');


        $data       = file_get_contents($link_api_penyedia);
        $decode = json_decode($data);
        $jumlah_data_sipedal_penyedia =  count((array)$decode->data);


        $data_swakelola       = file_get_contents($link_api_swakelola);
        $decode_swakelola = json_decode($data_swakelola);
        $jumlah_data_sipedal_swakelola =  count((array)$decode_swakelola->data);
        $jumlah_data_sipedal_semua = $jumlah_data_sipedal_penyedia + $jumlah_data_sipedal_swakelola;

        $kumpul_data_insert=[];
        $kumpul_data_lokasi=[];
        if ($id_instansi=='semua_opd') {
             $paket_sbe = $integrasi_sipedal->list_paket_sbe_semua($tahun, $jenis);
                $data_paket_tersimpan = [];
                foreach ($paket_sbe->result_array() as $k => $v) {
                   array_push($data_paket_tersimpan, $v['integrasi_sipedal_id_rup']);
                }   
        }else{
            $id_instansi = sbe_crypt($id_instansi, 'D');
            $konversi_id_instansi_sipedal_sbe = $integrasi_sipedal->konversi_sipedal_sbe($id_instansi);
            if ($konversi_id_instansi_sipedal_sbe['id_instansi']=='') {
                $konversi_id_instansi_sbe = 'Tidak Ditemukan';
                $id_instansi_dikonversikan = '';
                $data_paket_tersimpan = [];
            }else{
                $konversi_id_instansi_sbe = $konversi_id_instansi_sipedal_sbe['id_instansi'];
                $paket_sbe = $integrasi_sipedal->list_paket_sbe($konversi_id_instansi_sbe, $tahun, $jenis);
                $data_paket_tersimpan = [];
                foreach ($paket_sbe->result_array() as $k => $v) {
                   array_push($data_paket_tersimpan, $v['integrasi_sipedal_id_rup']);
                }   


            }


            $metode_konversi = $this->db->query("SELECT id_metode, integrasi_sipedal_metodepengadaan from metode")->result_array();
            $kumpul_metode = [];
            foreach ($metode_konversi as $k => $v) {
                $kumpul_metode[$v['integrasi_sipedal_metodepengadaan']] = $v['id_metode'];
            } 


            $sudah_pernah_diimport = 0;

            // penyedia
            foreach ($decode->data as $k => $v) {
                    $id_rup = $v->id_rup;



                    // var_dump($decode_ski[0]).'<br>';



                    if ($v->sumberdana=='APBD') {
                        $tahapan_apbd='2';
                    }else if ($v->sumberdana=='APBDP') {
                        $tahapan_apbd='4';
                    }else{
                        $tahapan_apbd='0';
                    }
                 if (in_array($id_rup, $data_paket_tersimpan)) {
                        $data_insert = [];
                        $sudah_pernah_diimport++;

                    }else{
                        $data_insert = [
                            'id_instansi'=>$konversi_id_instansi_sbe,
                            // 'kode_bidang_urusan'=>$v->id_rup,
                            'kode_rekening_program'=>$v->subkegiatan[0]->kode_programs ,
                            'kode_rekening_kegiatan'=>$v->subkegiatan[0]->kode_programs,
                            'kode_rekening_sub_kegiatan'=> $v->subkegiatan[0]->kode_subkegiatans,
                            'kode_tahap'=>$tahapan_apbd,
                            'tahun'=>$v->tahun,
                            'nama_paket'=>$v->namapaket,
                            'jenis_paket'=>'PENYEDIA',
                            'kategori'=>'',
                            'id_metode'=> @$kumpul_metode[$v->metodepengadaan],
                            'pagu'=>$v->jumlahpagu,
                            'created_on'=>timestamp(),
                            'created_by'=>id_user(),
                            'input_by'=>"Integrasi Sipedal",
                            'status '=>1,



                            'integrasi_sipedal_metode_pengadaan'=>$v->metodepengadaan,
                            'integrasi_sipedal_id_rup'=>$v->id_rup,
                            'integrasi_sipedal_id_satker'=>$v->idsatker,
                            'integrasi_sipedal_tahapan_apbd'=>$v->sumberdana,
                        ];
                        $data_insert_lokasi = [
                            'id_instansi'=>$konversi_id_instansi_sbe,
                           
                            'alamat'=>$v->lokasi,
                            'integrasi_sipedal_id_rup'=>$v->id_rup,
                            'integrasi_sipedal_id_satker'=>$v->idsatker,
                            'integrasi_sipedal_nama_kota'=>$v->lokasi_kab,
                            'integrasi_sipedal_nama_provinsi'=>$v->lokasi_prov,
                            'tahun'=>$v->tahun,
                            'input_by'=>"Integrasi Sipedal",
                            'synchronize'=>0,
                        ];
                        array_push($kumpul_data_insert, $data_insert);
                        array_push($kumpul_data_lokasi, $data_insert_lokasi);


                    }


            }

            // // swakelola

            foreach ($decode_swakelola->data as $k => $v) {
                    $id_rup = $v->id_rup;




                    // var_dump($decode_ski[0]).'<br>';



                    if ($v->sumberdana=='APBD') {
                        $tahapan_apbd='2';
                    }else if ($v->sumberdana=='APBDP') {
                        $tahapan_apbd='4';
                    }else{
                        $tahapan_apbd='0';
                    }
                 if (in_array($id_rup, $data_paket_tersimpan)) {
                        $data_insert = [3,4,3,4];
                        $sudah_pernah_diimport++;

                    }else{

                        if ($v->tipe_swakelola==1) {
                            $metode = $kumpul_metode[$v->tipe_swakelola];
                        }
                        elseif ($v->tipe_swakelola==2) {
                            $metode = $kumpul_metode[$v->tipe_swakelola];
                            # code...
                        }
                        else{
                            $metode = $kumpul_metode['3/4'];

                        }
                        $data_insert = [
                            'id_instansi'=>$konversi_id_instansi_sbe,
                            // 'kode_bidang_urusan'=>$v->id_rup,
                            'kode_rekening_program'=>$v->subkegiatan[0]->kode_programs ,
                            'kode_rekening_kegiatan'=>$v->subkegiatan[0]->kode_programs,
                            'kode_rekening_sub_kegiatan'=> $v->subkegiatan[0]->kode_subkegiatans,
                            'kode_tahap'=>$tahapan_apbd,
                            'tahun'=>$v->tahun,
                            'nama_paket'=>$v->namapaket,
                            'jenis_paket'=>'SWAKELOLA',
                            'kategori'=>'',
                            'id_metode'=> $metode,
                            'pagu'=>$v->jumlahpagu,
                            'created_on'=>timestamp(),
                            'created_by'=>id_user(),
                            'input_by'=>"Integrasi Sipedal",
                            'status '=>1,



                            'integrasi_sipedal_metode_pengadaan'=>' ???? ',
                            'integrasi_sipedal_id_rup'=>$v->id_rup,
                            'integrasi_sipedal_id_satker'=>$v->idsatker,
                            'integrasi_sipedal_tahapan_apbd'=>$v->sumberdana,
                        ];
                        $data_insert_lokasi = [
                            'id_instansi'=>$konversi_id_instansi_sbe,
                           
                            'alamat'=>$v->lokasi,
                            'integrasi_sipedal_id_rup'=>$v->id_rup,
                            'integrasi_sipedal_id_satker'=>$v->idsatker,
                            'integrasi_sipedal_nama_kota'=>$v->lokasi_kab,
                            'integrasi_sipedal_nama_provinsi'=>$v->lokasi_prov,
                            'tahun'=>$v->tahun,
                            'input_by'=>"Integrasi Sipedal",
                            'synchronize'=>0,
                        ];
                        array_push($kumpul_data_insert, $data_insert);
                        array_push($kumpul_data_lokasi, $data_insert_lokasi);


                    }


            }




            $paket_sbe_import_sipedal = $integrasi_sipedal->list_paket_sbe_import_sipedal($konversi_id_instansi_sbe, $tahun, $jenis)->num_rows();
            // echo  json_encode($decode_swakelola->data);
            if ($sudah_pernah_diimport==$jumlah_data_sipedal_semua) {
                   $result['success'] = false ; 
                        $result['message'] = 'Paket pada sipedal sudah di importkan semua';
                        $result['swal_code'] = 'warning';
                        $result['instruksi'] = 'Sudah di import';
            }else{

                if ($paket_sbe_import_sipedal!=$jumlah_data_sipedal_semua) {
                    $this->db->trans_begin();
                    $this->db->insert_batch('paket_pekerjaan', $kumpul_data_insert);
                    $this->db->insert_batch('lokasi_paket_pekerjaan_sipedal_mentah', $kumpul_data_lokasi);
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                        $result['success'] = false ; 
                        $result['message'] = 'Terjadi kesalahan';
                        $result['swal_code'] = 'error';
                        $result['instruksi'] = 'Error Import Data';
                        $this->session->set_flashdata('pesan','<div class="alert alert-danger">Error<br>Terjadi kesalahan</div>');
                    }
                    else
                    {
                        $this->db->trans_commit();
                        $result['success'] = true ; 
                        $result['message'] = 'Data Berhasil Di Import';
                        $result['swal_code'] = 'success';
                        $result['instruksi'] = 'Di Import';
                        $result['tahun'] = $tahun;
                        $result['jumlah_data_sipedal'] = $jumlah_data_sipedal_semua;
                        $result['id_opd'] = sbe_crypt($id_instansi,'E');
                        $this->session->set_flashdata('pesan','<div class="alert alert-success">Berhasil<br>Data berhasil di import<br>'.count($kumpul_data_insert).' Paket pekerjaan ditambahkan ke Simbangda</div>');
                    }
                }else{
                        $result['success'] = false ; 
                        $result['message'] = 'Data Sudah Di Pernah Di Import';
                        $result['swal_code'] = 'warning';
                        $result['instruksi'] = 'Gagal Import';
                        $this->session->set_flashdata('pesan','<div class="alert alert-danger">Gagal<br>Data Sudah Di Pernah Di Import</div>');

                        $result['tahun'] = $tahun;
                        $result['id_opd'] = sbe_crypt($id_instansi,'E');

                }
            }




        }





        echo json_encode($result);
     }  









    public function dt_paket_import_integrasi_sipedal()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $tahun = $this->input->post('tahun');
            $kode_tahap = tahapan_apbd();
            // $id_pptk         = $this->input->post('id_pptk');
            // $kode_rekening  = $this->input->post('kode_rekening');
            $id_instansi = sbe_crypt($this->input->post('id_instansi'),'D');
            $kumpul_msk = [];
            $q_ski = $this->db->query("SELECT kode_rekening_sub_kegiatan, nama_sub_kegiatan, kategori, jenis_sub_kegiatan, keterangan from v_sub_kegiatan_apbd where tahun='$tahun' and id_instansi='$id_instansi'")->result_array();
            foreach ($q_ski as $k => $v) {
                 $nama_sub_kegiatan = $v['kategori']=='Sub Kegiatan SKPD' ? $v['nama_sub_kegiatan'] : $v['nama_sub_kegiatan'].'<br>'.$v['jenis_sub_kegiatan'].' - '.$v['keterangan'];
                $kumpul_msk[$v['kode_rekening_sub_kegiatan']] = $nama_sub_kegiatan;
            }

            if ($kode_tahap==4) {
                $where          = ['id_instansi' => $id_instansi, 'tahun'=>$tahun,'status'=>'1','input_by'=>'Integrasi Sipedal'];
                # code...
            }else{
                $where          =  ['id_instansi' => $id_instansi,'input_by'=>'Integrasi Sipedal', 'tahun'=>$tahun];

            }
            $column_order   = ['', 'nama_paket'];
            $column_search  = ['nama_paket'];
            $order          = ['nama_paket' => 'ASC'];
            $list           = $this->datatables_model->get_datatables('v_paket', $column_order, $column_search, $order, $where);
            $data           = [];
            $no             = $_POST['start'];
            foreach ($list as $lists) {
                $no++;
                $row    = [];
                $row[]     = $no;

                $id_paket_pekerjaan = $lists->id_paket_pekerjaan ; 
                $q_lokasi = $this->db->query("SELECT * from lokasi_paket_pekerjaan where id_paket_pekerjaan='$id_paket_pekerjaan'");
                $j_lokasi = $q_lokasi->num_rows();
                
                $caption_kategori = $lists->jenis_paket == 'PENYEDIA' ? ( $lists->kategori == '' ? 'Belum Ditentukan' : $lists->kategori) : '' ; 
                $row[]  = '<a href="javascript:void(0)" onclick="edit_sub_kegiatan_import_sipedal('."'".$lists->kode_rekening_sub_kegiatan."','".$lists->id_paket_pekerjaan."'".')">'.$lists->kode_rekening_sub_kegiatan.'<br>'.@$kumpul_msk[$lists->kode_rekening_sub_kegiatan].'</a>';
                $row[]  = $lists->nama_paket;
                $row[]  = $lists->jenis_paket;

                $row[]  = '<a href="javascript:void(0)" onclick="edit_kategori_import_sipedal('."'".$lists->id_paket_pekerjaan."'".')">'.$caption_kategori.'</a>';

                $row[]  = $lists->jenis_paket == 'RUTIN' ? '' : $lists->metode=='' ? '<span class="badge badge-danger">'.$lists->integrasi_sipedal_metode_pengadaan.'<br>Belum Sinkron</span>' : $lists->metode;
                $row[]  = $j_lokasi==0 ? 'Belum Sinkron' : $j_lokasi;
                // $row[]  = $lists->jenis_paket == 'RUTIN' ? '' : ($this->lokasi_paket_pekerjaan($lists->id_paket_pekerjaan) == 0 ? '<button class="btn btn-outline-primary" onclick="lokasi(' . "'" . $lists->id_paket_pekerjaan . "'" . ')">Belum Ada</button>' : '<button class="btn btn-outline-primary" onclick="lokasi(' . "'" . $lists->id_paket_pekerjaan . "','input'" . ')">' . $this->lokasi_paket_pekerjaan($lists->id_paket_pekerjaan) . ' Lokasi</button>');
                // $row[]  = $lists->jenis_paket == 'RUTIN' ? '' : '<button class="btn btn-outline-primary" onclick="volume(' . "'" . $lists->id_paket_pekerjaan . "','input'" . ')">' . $lists->volume . '</button>';
                $row[]  = number_format($lists->pagu);
               

                $data[] = $row;
            }

            $output = [
                "draw"              => $_POST['draw'],
                "recordsTotal"      => $this->datatables_model->count_all('v_paket', $where),
                "recordsFiltered"   => $this->datatables_model->count_filtered('v_paket', $column_order, $column_search, $order, $where),
                "data"              => $data,
            ];

            echo json_encode($output);
        }
    }



    public function simpanedit_sub_kegiatan_import_sipedal()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {

            $id_paket         = $this->input->post('id_paket');
            $kode_sub_kegiatan         = $this->input->post('kode_sub_kegiatan');
            $kode_kegiatan         = $this->input->post('kode_kegiatan');
            $kode_program         = $this->input->post('kode_program');
            $kode_bu         = $this->input->post('kode_bu');
          
            $update = [
                'kode_bidang_urusan'=>$kode_sub_kegiatan,
                'kode_rekening_program'=>$kode_program,
                'kode_rekening_kegiatan'=>$kode_kegiatan,
                'kode_rekening_sub_kegiatan '=>$kode_sub_kegiatan
            ];
            $where = ['id_paket_pekerjaan'=>$id_paket];
            $this->db->update('paket_pekerjaan',$update, $where);

            $output = [];

            echo json_encode($output);
        }
    }


    public function simpanedit_kategori_import_sipedal()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {

            $id_paket         = $this->input->post('id_paket');
            $kategori         = $this->input->post('kategori');
          
            $update = [
                'kategori'=>$kategori,
               
            ];
            $where = ['id_paket_pekerjaan'=>$id_paket];
            $this->db->update('paket_pekerjaan',$update, $where);

            $output = [
                'kategori'=>$kategori
            ];

            echo json_encode($output);
        }
    }

    public function import_ikd_ski()
    {
        // if (!$this->input->is_ajax_request()) {
        //     show_404();
        // } else {

            $ask         = $this->input->post('ask');
            $ski         = $this->input->post('ski');

            $simpan_ask = json_decode($ask);
            $simpan_ski = json_decode($ski);

            $this->db->trans_begin();

            if (count($simpan_ski)) {
                $this->db->insert_batch('sub_kegiatan_instansi', $simpan_ski);
            }
            if (count($simpan_ask)) {
                $this->db->insert_batch('anggaran_sub_kegiatan', $simpan_ask);
            }



            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('pesan','<div class="alert alert-info">Data Sub Kegiatan dan anggaran gagal disimpan</div>');
                    $output = ['success'=>500];
            }
            else
            {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('pesan','<div class="alert alert-info">Data Sub Kegiatan dan anggaran di importkan</div>');
                    $output = ['success'=>200];
            }
         

            echo json_encode($output);
        // }
    }

    public function import_ikd_target()
    {
        // if (!$this->input->is_ajax_request()) {
        //     show_404();
        // } else {

            $target         = $this->input->post('target');

            $simpan_target = json_decode($target);

            $this->db->trans_begin();

            if (count($simpan_target)) {
                $this->db->insert_batch('target_apbd', $simpan_target);
            }
         



            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('pesan','<div class="alert alert-info">Data Sub Kegiatan dan anggaran gagal disimpan</div>');
                    $output = ['success'=>500];
            }
            else
            {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('pesan','<div class="alert alert-info">Data Sub Kegiatan dan anggaran di importkan</div>');
                    $output = ['success'=>200];
            }
         

            echo json_encode($output);
        // }
    }
    public function import_ikd_realisasi()
    {
        // if (!$this->input->is_ajax_request()) {
        //     show_404();
        // } else {

            $realisasi         = $this->input->post('realisasi');

            $simpan_realisasi = json_decode($realisasi);

            $this->db->trans_begin();

            if (count($simpan_realisasi)) {
                $this->db->insert_batch('realisasi_keuangan', $simpan_realisasi);
            }
         
     
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('pesan','<div class="alert alert-info">Data Sub Kegiatan dan anggaran gagal disimpan</div>');
                    $output = ['success'=>500];
            }
            else
            {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('pesan','<div class="alert alert-info">Data realisasi di importkan</div>');
                    $output = ['success'=>200];
            }
         

            echo json_encode($output);
        // }
    }

    public function sinkron_lokasi_import_sipedal()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $result     = [
                'success'   => false,
                'messages'  => '',
                'swal_code'  => '',
                'instruksi'  => ''
            ];

            $id_instansi = id_instansi();
            $tahun         =tahun_anggaran();
            $paket_pekerjaan = $this->db->query("SELECT integrasi_sipedal_id_rup, id_paket_pekerjaan from paket_pekerjaan where tahun = '$tahun' and id_instansi = '$id_instansi'")->result_array();

            $kumpul_id_paket = [];
            foreach ($paket_pekerjaan as $k => $v) {
                $kumpul_id_paket[$v['integrasi_sipedal_id_rup']] = $v['id_paket_pekerjaan'];
            }
            

            $kota_konversi = $this->db->query("SELECT id_kota, nama_kota from integrasi_sipedal_konversi_kota")->result_array();
            $kumpul_kota = [];
            foreach ($kota_konversi as $k => $v) {
                $kumpul_kota[$v['nama_kota']] = $v['id_kota'];
            }

            $prov_konversi = $this->db->query("SELECT id_provinsi, integrasi_sipedal_nama_prov from provinsi")->result_array();
            $kumpul_provinsi = [];
            foreach ($prov_konversi as $k => $v) {
                $kumpul_provinsi[$v['integrasi_sipedal_nama_prov']] = $v['id_provinsi'];
            }

          
            
            $where = ['tahun'=>$tahun,'id_instansi'=>$id_instansi, 'synchronize'=>0];


            $lokasi_mentah = $this->db->get_where('lokasi_paket_pekerjaan_sipedal_mentah', $where)->result_array();

            $kumpul_lokasi_baru = [];
            foreach ($lokasi_mentah as $k_lm => $v_lm) {
               $pecah   = explode(';', $v_lm['integrasi_sipedal_nama_kota']);

               $id_paket_konversi = $kumpul_id_paket[$v_lm['integrasi_sipedal_id_rup']];
               foreach ($pecah as $k => $v) {
                   $data_lokasi_baru = [
                    'id_paket_pekerjaan' => $id_paket_konversi,
                    'id_instansi' => $id_instansi,
                    'id_kab_kota' => @$kumpul_kota[$v],
                    // 'id_provinsi' => $kumpul_provinsi[$v_lm['integrasi_sipedal_nama_provinsi']],
                    // 'alamat' => '',
                    // 'latitude' => '',
                    // 'longitude' => '',
                    'integrasi_sipedal_id_instansi' => $v_lm['integrasi_sipedal_id_instansi'],
                    'integrasi_sipedal_id_satker' => $v_lm['integrasi_sipedal_id_satker'],
                    'integrasi_sipedal_id_rup' => $v_lm['integrasi_sipedal_id_rup'],
                    'input_by ' => 'Konversi Integrasi Sipedal',
                   ];
                    // echo $v;


                   array_push($kumpul_lokasi_baru, $data_lokasi_baru);

               }


            }


            $this->db->trans_begin();
            $this->db->insert_batch('lokasi_paket_pekerjaan', $kumpul_lokasi_baru);
            $this->db->update('lokasi_paket_pekerjaan_sipedal_mentah', ['synchronize'=>1],['synchronize'=>0]);
               
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                    $result['success'] = false ; 
                    $result['message'] = 'Terjadi kesalahan';
                    $result['swal_code'] = 'error';
                    $result['instruksi'] = 'Error Import Data';
                }
                else
                {
                    $this->db->trans_commit();
                    $result['success'] = true ; 
                    $result['message'] = 'Sinkronisasi lokasi Selesai';
                    $result['swal_code'] = 'success';
                    $result['instruksi'] = 'Sukses';
                    $result['tahun'] = $tahun;
                    $result['id_opd'] = sbe_crypt($id_instansi,'E');
                }

            // $update = [
            //     'kategori'=>$kategori,
            // ];
            // $this->db->update('paket_pekerjaan',$update, $where);

            // $output = [
            //     'kategori'=>$kategori
            // ];

            echo json_encode($result);
        }
    }
































    public function ikd()
    {
        $breadcrumbs     = $this->breadcrumbs;
        // $master_paket   = $this->master_paket_model;

        $integrasi_sipedal    = $this->integrasi_sipedal_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Integrasi IKD - Data APBD', base_url($this->router->fetch_class()));
        
        $breadcrumbs->render();
        $data['input_by']                      = "";

        $data['kode_tahap']                = tahapan_apbd();
        $data['tahun']                = tahun_anggaran();

        $id_group = $this->session->userdata('id_group');

        $id_opd = id_instansi();
        $konversi_instansi = $this->db->query("SELECT integrasi_ikd_id_instansi, id_instansi, nama_instansi from master_instansi where id_instansi='$id_opd'")->row_array();
        $id_instansi_enc = sbe_crypt($konversi_instansi['integrasi_ikd_id_instansi'], 'E');
        $tahun = tahun_anggaran();
        $data['opd']                    = $integrasi_sipedal->get_skpd($id_group);
        $data['konfigurasi']                 = $this->db->get('config')->result_array();

         $data['dropdown_option']                      = [
            
            
             ['tipe'=>'link', 'caption'=>'Kelola Hasil Import Pengintegrasian Sipedal ', 'fa'=>'fa fa-arrow-left', 'onclick'=>'integrasi_aplikasi/cek_import_ikd?id_opd='.sbe_crypt($id_opd).'&tahun='.$tahun.'', 'elemen_tambahan'=>'data-toggle="tooltip" title="Kembali"'],
             ['tipe'=>'button', 'caption'=>'Update Token', 'fa'=>'fa fa-arrow-left', 'onclick'=>'', 'elemen_tambahan'=>'data-toggle="tooltip" title="Kembali"'],
        ];
        $data['title']                      = "Integrasi Aplikasi - IKD";
        $data['icon']                       = "metismenu-icon fa fa-list-ul";
        $data['description']                = "Mengambil data dari aplikasi IKD - BPKAD Provinsi Sumatera Barat untuk ditampilkan dan disalin ke dalam aplikasi Simbangda Based Evidence     ";
        $data['breadcrumbs']                ='';// $breadcrumbs->render();
      

        $page                               = 'integrasi_aplikasi/ikd/index';
        $data['link']                       = $this->router->fetch_method();
        $data['fetch_method']                       = $this->router->fetch_method();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                  = $this->load->view('integrasi_aplikasi/ikd/css', $data, true);
        $data['extra_js']                   = $this->load->view('integrasi_aplikasi/ikd/js', $data, true);
        $data['modal']                      = $this->load->view('integrasi_aplikasi/ikd/modal', $data, true);


       
        $this->template->load('backend_template', $page, $data);
    }



    public function get_data_ikd(){
        

        $tahun = $this->input->post('tahun');
        $kode_tahap = $this->input->post('tahap');
        $bulan = $this->input->post('bulan');
        $id_instansi = sbe_crypt($this->input->post('id_instansi'),'D');
        
        // $tahap = $this->input->post('tahap');

        $q_token = $this->db->query("SELECT token from token_integrasi where id_token=1")->row_array();
        $token = $q_token['token'];

        $q_instansi = $this->db->query("SELECT nama_instansi, id_instansi from master_instansi where integrasi_ikd_id_instansi='$id_instansi'")->row_array();

        $q_mk = $this->db->query("SELECT nama_kegiatan, kode_kegiatan from master_kegiatan")->result_array();
        $kumpul_master_kegiatan = [];
        foreach ($q_mk as $k => $v) {
            $kumpul_master_kegiatan[$v['kode_kegiatan']] = $v['nama_kegiatan'];
        }
        $q_mp = $this->db->query("SELECT nama_program, kode_program from master_program")->result_array();
        $kumpul_master_program = [];
        foreach ($q_mp as $k => $v) {
            $kumpul_master_program[$v['kode_program']] = $v['nama_program'];
        }
        // ipt = instansi pembantu teknis
        $q_ipt = $this->db->query("SELECT  id_instansi_pembantu_teknis,kode_instansi_teknis,nama_instansi_teknis,jenis_teknis,integrasi_ikd_id_sub_skpd,integrasi_ikd_kode_sub_skpd  from instansi_pembantu_teknis where integrasi_ikd_id_skpd = '$id_instansi'")->result_array();
        $kumpul_ipt = [];
        foreach ($q_ipt as $k => $v) {
            $kumpul_ipt[$v['integrasi_ikd_kode_sub_skpd']] = [
                'kode_instansi_teknis' => $v['kode_instansi_teknis'],
                'jenis_teknis' => $v['jenis_teknis'],
                'nama_instansi_teknis' => $v['nama_instansi_teknis'],
                'id_instansi_pembantu_teknis' => $v['id_instansi_pembantu_teknis'],
            ];
        }


        // ipt = instansi pembantu teknis
        $id_instansi_ski = $q_instansi['id_instansi'];
        $q_ski = $this->db->query("SELECT  kode_sub_kegiatan  from sub_kegiatan_instansi where id_instansi = '$id_instansi_ski' and tahun = '$tahun' and kode_tahap='$kode_tahap'")->result_array();
        $kumpul_ski = [];
        foreach ($q_ski as $k => $v) {
            array_push($kumpul_ski, $v['kode_sub_kegiatan']);
        }
        $q_ask = $this->db->query("SELECT ( bo_bp + bo_bbj + bo_bs + bo_bh + bm_bmt + bm_bmpm + bm_bmgb + bm_bmjji + bm_bmatl + btt + bt_bbh + bt_bbk) as pagu,  kode_sub_kegiatan  from anggaran_sub_kegiatan where id_instansi = '$id_instansi_ski' and tahun = '$tahun' and kode_tahap='$kode_tahap'")->result_array();
        $kumpul_ask = [];
        $data_ask = [];
        foreach ($q_ask as $k => $v) {
            array_push($kumpul_ask, $v['kode_sub_kegiatan']);
            $data_ask[$v['kode_sub_kegiatan']] = $v['pagu'];
        }
       
        $q_target = $this->db->query("SELECT  kode_rekening_sub_kegiatan  from target_apbd where id_instansi = '$id_instansi_ski' and tahun = '$tahun' and kode_tahap='$kode_tahap'")->result_array();
        $kumpul_target = [];
        foreach ($q_target as $k => $v) {
            array_push($kumpul_target, $v['kode_rekening_sub_kegiatan']);
        }

        $q_realisasi = $this->db->query("SELECT  kode_sub_kegiatan  from realisasi_keuangan where id_instansi = '$id_instansi_ski' and tahun = '$tahun' and kode_tahap='$kode_tahap' and bulan='$bulan'")->result_array();
        $kumpul_realisasi = [];
        foreach ($q_realisasi as $k => $v) {
            array_push($kumpul_realisasi, $v['kode_sub_kegiatan']);
        }
       



        $ski = $this->api_ikd_ski($token, $tahun, $id_instansi);
        $target = $this->api_ikd_target_apbd($token, $tahun, $id_instansi);
        $realisasi = $this->api_ikd_realisasi_apbd($token, $bulan, $tahun, $id_instansi);
        $data['ski'] = $ski;
        $data['target'] = $target;
        $data['realisasi'] = $realisasi;
        $data['id_instansi'] = $q_instansi['id_instansi'];
        $data['nama_instansi'] = $q_instansi['nama_instansi'];
        $data['kumpul_master_kegiatan'] = $kumpul_master_kegiatan;
        $data['kumpul_master_program'] = $kumpul_master_program;
        $data['kumpul_ipt'] = $kumpul_ipt;
        $data['kumpul_ski'] = $kumpul_ski;
        $data['kumpul_ask'] = $kumpul_ask;
        $data['data_ask'] = $data_ask;
        $data['kumpul_target'] = $kumpul_target;
        $data['kumpul_realisasi'] = $kumpul_realisasi;
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['kode_tahap'] = $kode_tahap;


       



        if ($id_instansi=='') {
            $page                               = 'integrasi_aplikasi/ikd/api_ikd_result_setda';
        }else{
            $page                               = 'integrasi_aplikasi/ikd/api_ikd_result';
        }
        $data['extra_css']                  = $this->load->view('data_apbd/data_apbd/css', $data, true);
        $pagedata['extra_js']                   = $this->load->view('integrasi_aplikasi/ikd/js', $data, true);
        // $data['modal']                      = $this->load->view('data_apbd/data_apbd/modal', $data, true);
        $this->load->view($page, $pagedata);
     }  

      public function api_sipedal_penyedia($token, $tahun, $id_opd){
                    $curl = curl_init();
                    $url = "https://sipedal.sumbarprov.go.id/api/v1/simbangda/rup_paket_penyedia?tahun=2025&instansi_id=D462&idsatker=$id_opd&order_col=namasatker&order_dir=desc";
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        // CURLOPT_HTTPHEADER => array(
                        //     // Set Here Your Requesred Headers
                        //     'Content-Type: application/json',
                        //    "Authorization: Bearer ".$token
                          
                        // ),
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
      public function api_sipedal_swakelola($token, $tahun, $id_opd){
                    $curl = curl_init();
                    $url = "https://sipedal.sumbarprov.go.id/api/v1/simbangda/rup_paket_swakelola?tahun=2025&instansi_id=D462&idsatker=$id_opd&order_col=namasatker&order_dir=desc";
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        // CURLOPT_HTTPHEADER => array(
                        //     // Set Here Your Requesred Headers
                        //     'Content-Type: application/json',
                        //    "Authorization: Bearer ".$token
                          
                        // ),
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

        public function api_ikd_ski($token, $tahun, $id_instansi_ikd){
                    $curl = curl_init();
                    $url = 'https://ikd-bpkad.sumbarprov.go.id/api/simbangda/master-anggaran-sub-kegiatan-skpd?idskpd='.$id_instansi_ikd.'&tahun='.$tahun.'&pergeseran=1';
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

        public function api_ikd_target_apbd($token, $tahun, $id_instansi_ikd){
                    $curl = curl_init();
                    $url = 'https://ikd-bpkad.sumbarprov.go.id/api/simbangda/rencana-anggaran-kas?idskpd='.$id_instansi_ikd.'&tahun='.$tahun;
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
                        $responcode = 500;
                    } else {
                        $result = json_decode($response);
                        $responcode = 200;
                    }
                        
                        return ['responcode'=>$responcode, 'result'=>$result];


            }


        public function api_ikd_realisasi_apbd($token, $bulan, $tahun, $id_instansi_ikd){
                    $curl = curl_init();
                    // $url ='https://ikd-bpkad.sumbarprov.go.id/api/simbangda/realisasi-sub-kegiatan-skpd?tahun=2025&bulan=4&idskpd=2561';
                    $url = 'https://ikd-bpkad.sumbarprov.go.id/api/simbangda/realisasi-sub-kegiatan-skpd?idskpd='.$id_instansi_ikd.'&tahun='.$tahun.'&bulan='.$bulan;
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
                        $responcode = 500;
                    } else {
                        $result = json_decode($response);
                        $responcode = 200;
                    }
                        
                        return ['responcode'=>$responcode, 'result'=>$result, 'cek'=>$url];


            }


    public function get_token_ikd(){
                // $tahun = $tahun = "" ? date("Y") : $tahun;
                $curl = curl_init();
                // $url = 'https://simbangda.sumbarprov.go.id/integrated/api/dashboard_pembangunan';
                // $url = 'http://182.253.192.84:8556/API/2/GetPerOPD/'.$tahun;
                $url = 'https://ikd-bpkad.sumbarprov.go.id/oauth/token';
                $a_params = [
                     "grant_type"=> "client_credentials",
                      "client_id"=> "3",
                      "client_secret"=> "PorxW1pQYgzcKZwM3Cv1Y74Pb3qf2izDuzwD2C0P",
                      "scope"=> "*"
                    ];

                // var_dump(http_build_query($a_params)); die;
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,// your preferred link
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    // CURLOPT_HTTPHEADER => array(
                    //     // Set Here Your Requesred Headers
                    //     'Content-Type: application/json',
                      
                    // ),
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => http_build_query($a_params)
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
                    
                $token = $result->access_token;
                $this->db->update('token_integrasi',['token'=>$token],['id_token'=>1]);
    }



}
