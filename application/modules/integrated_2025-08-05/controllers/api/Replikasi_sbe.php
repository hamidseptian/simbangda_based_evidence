<?php

/**
 * androidor     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : android.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Replikasi_sbe extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->sumber_data = "Sumber Data : ???";
        $this->sumber_data_kab_kota = "???";
        $this->load->model('android/android_model', 'android_model');
        $id_kota = $this->session->userdata('id_kota') ; 
        // $nama_kota = $this->db->query("SELECT nama_kota from kota where id_kota='$id_kota'")->row_array()['nama_kota'];
        $this->id_kota = $id_kota;
      
        $config_kab_kota = $this->db->query("SELECT ckk.*, k.nama_kota from config_kab_kota ckk 
            left join kota k on ckk.id_kota = k.id_kota
            where ckk.id_kota='$id_kota'")->row_array();
        $terintegrasi = $config_kab_kota['integrasi_replikasi'];
        $this->nama_kota = $config_kab_kota['nama_kota'];
        $this->terintegrasi = $terintegrasi;
        $this->url_replikasi = $config_kab_kota['url_replikasi'];


        $data_opd_kota = $this->db->query("SELECT nama_instansi, id_instansi, kode_opd from master_instansi_kab_kota where id_kota='$id_kota' and is_active=1")->result_array();
        $this->data_opd_kota = $data_opd_kota;

            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: *");

        $this->load->model([

            'Laporan/realisasi_akumulasi_model'     => 'realisasi_akumulasi_model',
            'integrated/Integrasi_dashboard_pembangunan_model'       => 'dashboard_pembangunan_model',
            'dashboard/dashboard_model'       => 'dashboard_model',
        ]);
    }

    public function index()
    {
        $breadcrumbs     = $this->breadcrumbs;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Data APBD', base_url($this->router->fetch_class()));
        
        $breadcrumbs->render();

        $tahap = tahapan_apbd();
        $tahun = tahun_anggaran();

         $id_kota = $this->id_kota;

             $data['dropdown_option'] = [
                ['tipe'=>'onclick', 'caption'=>'Sub Kegiatan APBD SKPD', 'fa'=>'metismenu-icon fas fa-list-ul', 'onclick'=>"sub_kegiatan_instansi_gabungan('all')", 'elemen_tambahan'=>'data-toggle="tooltip" title="Melihat semua data sub kegiatan yang ada pada SKPD"'],
              
                // ['tipe'=>'button', 'caption'=>'Permasalahan Sub Kegiatan', 'fa'=>'fas fa-exclamation', 'onclick'=>'permasalahan_sub_kegiatan()', 'elemen_tambahan'=>'data-toggle="tooltip" title="Permasalahan Sub Kegiatan"'],
                // ['tipe'=>'link', 'caption'=>'Program Unggulan', 'fa'=>'fa fa-thumbs-up', 'onclick'=>'data_apbd/progul', 'elemen_tambahan'=>'data-toggle="tooltip" title="Data Program Unggulan berdasarkan sub kegiatan yang dimiliki SKPD"'],
            ];
        


        $data_opd_kota = $this->data_opd_kota;

        $config_kab_kota = $this->db->get_where('config_kab_kota',['id_kota'=>$id_kota])->row_array();

        $terintegrasi = $this->terintegrasi;
        if ($terintegrasi==1) {
            # code...
        $url_replikasi = $this->url_replikasi."/integrated/api/dashboard_pembangunan/daftar_opd";
        $get_data_instansi_replikasi = file_get_contents($url_replikasi);
        $data['data_opd_replikasi']                      = json_decode($get_data_instansi_replikasi);
        }else{
        $data['data_opd_replikasi']                      = [];
        }
        $data['config_kab_kota']                      = $config_kab_kota;
        // $to_array = json_decode($get_data_instansi_replikasi);
        // foreach ($to_array->opd as $k => $v) {
        //     # code...
        // }



        // tipe = link / button
         $tahap_replikasi = [
                                'Belum Mereplikasikan',
                                'Peminatan',
                                'Install Localhost / Penyerahan Source Code',
                                'Instalasi & Testing Server',
                                'Instalasi Online / Hosting ',
                                'Testing, Maintenance, Penyesuaian Data',
                                'Implementasi & Maintenance Online',
                                'Terintegrasi ',
                            ];
        $data['title']                      = "Replikasi Simbangda Based Evidence";
        $data['input_by']                      = "";
        $data['data_opd']                      = $data_opd_kota;

        $data['kode_tahap']                = tahapan_apbd();
        $data['nama_kota']                = $this->nama_kota;
        $data['tahap_replikasi']                = $tahap_replikasi;
        $data['terintegrasikan']                = ['Tidak','Ya'];
        $data['tahun']                = 2;//tahun_anggaran();
        $data['icon']                       = "metismenu-icon fa fa-list-ul";
        $data['description']                = "Mengintegrasikan Simbangda Based Evidence Provinsi dengan Replikasi Simbangda Based Evidence Kab Kota";
        $data['breadcrumbs']                = '';//$breadcrumbs->render();
       
        $page                               = 'integrated/replikasi_sbe/index';
        $data['link']                       = $this->router->fetch_method();
        $data['fetch_method']                       = $this->router->fetch_method();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                  = $this->load->view('integrated/replikasi_sbe/css', $data, true);
        $data['extra_js']                   = $this->load->view('integrated/replikasi_sbe/js', $data, true);
        $data['modal']                      = $this->load->view('integrated/replikasi_sbe/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    }







    public function preview_data_replikasi()
    {
        $breadcrumbs            = $this->breadcrumbs;
        $realisasi_akumulasi    = $this->realisasi_akumulasi_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Laporan', base_url($this->router->fetch_class()));
        $breadcrumbs->add('Realisasi Akumulasi', base_url());
        $breadcrumbs->render();

        $data['title']          = "Preview data replikasi";
        $data['icon']           = "metismenu-icon fas fa-file-signature";
        $data['description']    = "Melihat data replikasi untuk di salin";
        $data['breadcrumbs']    = $breadcrumbs->render();
        $data['opd']                    = $realisasi_akumulasi->get_opd();
        $data['config']                 = $this->db->get('config')->result_array();
        $page                   = 'integrated/replikasi_sbe/preview_data_replikasi';
        $data['link']           = $this->router->fetch_method();
        $data['menu']           = $this->load->view('layout/menu', $data, true);
        $data['extra_css']      = $this->load->view('integrated/replikasi_sbe/css', $data, true);
        $data['extra_js']       = $this->load->view('integrated/replikasi_sbe/js', $data, true);
        $data['modal']          = $this->load->view('integrated/replikasi_sbe/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    }








    public function get_data()
    {
        
        $tahun = $this->input->post('tahun');
        $tahap = $this->input->post('tahap');
        $bulan = $this->input->post('bulan');
        $action = $this->input->post('action');
        
         $url_replikasi = $this->url_replikasi."integrated/api/dashboard_pembangunan/get_rfk_opd_replikasi?tahun=".$tahun."&tahap=".$tahap."&bulan=".$bulan;
        $get_data_instansi_replikasi = file_get_contents($url_replikasi);
        $decode = json_decode($get_data_instansi_replikasi);


        $data_opd_kota = $this->data_opd_kota;
        $id_kota = $this->id_kota;









        $table  = '<table class="table table-bordered" id="datatabel">
                    <thead>
                        <tr>
                          <th rowspan="4">No</th>
                          <th rowspan="4">SKPD</th>
                          <th rowspan="4">Keteragan</th>
                          <th colspan="11">Realisasi</th>
                          <th rowspan="4">Status</th>
                          <th rowspan="4">Option</th>
                        </tr>
                        <tr>
                          <th colspan="2">Belanja Operasi</th>
                          <th colspan="2">Belanja modal</th>
                          <th colspan="2">Belanja Tidak Terduga</th>
                          <th colspan="2">Belanja Transfer</th>
                          <th colspan="3">Total Realisasi</th>
                        </tr>
                        <tr>
                          <th rowspan="2">Rp.</th>
                          <th rowspan="2">%</th>
                          <th rowspan="2">Rp.</th>
                          <th rowspan="2">%</th>
                          <th rowspan="2">Rp.</th>
                          <th rowspan="2">%</th>
                          <th rowspan="2">Rp.</th>
                          <th rowspan="2">%</th>
                          <th colspan="2">Keuangan</th>
                          <th>Fisik</th>
                        </tr>
                        <tr>
                         
                          <th>Rp</th>
                          <th>%</th>
                          <th>%</th>
                        </tr>
                    </thead>
                        ';

       $kumpul_opd_replikasi = [];
        $api_opd_replikasi = [];
        $skpd_replikasi_berkode = 0;
        foreach ($decode->opd as $k => $v) {



            $pagu_bo = $v->pagu_bo_bp + $v->pagu_bo_bbj + $v->pagu_bo_bs + $v->pagu_bo_bh + $v->pagu_bo_bbs;
            $rp_realisasi_akumulasi_bo = $v->rp_realisasi_keuangan_akumulasi_bo_bp + $v->rp_realisasi_keuangan_akumulasi_bo_bbj + $v->rp_realisasi_keuangan_akumulasi_bo_bs + $v->rp_realisasi_keuangan_akumulasi_bo_bh + $v->rp_realisasi_keuangan_akumulasi_bo_bbs ;
            @$persen_realisasi_akumulasi_bo = ($rp_realisasi_akumulasi_bo / $pagu_bo) * 100;

            $pagu_bm = $v->pagu_bm_bmt + $v->pagu_bm_bmpm + $v->pagu_bm_bmgb + $v->pagu_bm_bmjji + $v->pagu_bm_bmatl + $v->pagu_bm_bmatb;
            $rp_realisasi_akumulasi_bm = $v->rp_realisasi_keuangan_akumulasi_bm_bmt + $v->rp_realisasi_keuangan_akumulasi_bm_bmpm + $v->rp_realisasi_keuangan_akumulasi_bm_bmgb + $v->rp_realisasi_keuangan_akumulasi_bm_bmjji + $v->rp_realisasi_keuangan_akumulasi_bm_bmatl + $v->rp_realisasi_keuangan_akumulasi_bm_bmatb;
            @$persen_realisasi_akumulasi_bm = ($rp_realisasi_akumulasi_bm / $pagu_bm) * 100;

            $pagu_btt = $v->pagu_btt;
            $rp_realisasi_akumulasi_btt = $v->rp_realisasi_keuangan_akumulasi_btt;
            @$persen_realisasi_akumulasi_btt = ($rp_realisasi_akumulasi_btt / $pagu_btt) * 100;

            $pagu_bt = $v->pagu_bt_bbh + $v->pagu_bt_bbk;
            $rp_realisasi_akumulasi_bt = $v->rp_realisasi_keuangan_akumulasi_bt_bbh + $v->rp_realisasi_keuangan_akumulasi_bt_bbk;
            @$persen_realisasi_akumulasi_bt = ($rp_realisasi_akumulasi_bt / $pagu_bt) * 100;

            $pagu_total = $v->pagu_total;
            $rp_realisasi_akumulasi_total = $v->rp_realisasi_keuangan_akumulasi;
            @$persen_realisasi_akumulasi_total = ($rp_realisasi_akumulasi_total / $pagu_total) * 100;


            $realisasi_fisik_akumulasi = $v->realisasi_fisik_akumulasi;
            // $table  .= '
            //         <tr>
                     
            //           <td rowspan="2">'.($k+1).'</td>
            //           <td rowspan="2">'.$v->nama_instansi.'</td>
            //           <td>Akumulasi</td>
            //           <td>'.number_format($rp_realisasi_akumulasi_bo).'</td>
            //           <td>'.round($persen_realisasi_akumulasi_bo,2).'</td>
            //           <td>'.number_format($rp_realisasi_akumulasi_bm).'</td>
            //           <td>'.round($persen_realisasi_akumulasi_bm,2).'</td>
            //           <td>'.number_format($rp_realisasi_akumulasi_btt).'</td>
            //           <td>'.round($persen_realisasi_akumulasi_btt,2).'</td>
            //           <td>'.number_format($rp_realisasi_akumulasi_bt).'</td>
            //           <td>'.round($persen_realisasi_akumulasi_bt,2).'</td>
            //           <td>'.number_format($rp_realisasi_akumulasi_total).'</td>
            //           <td>'.round($persen_realisasi_akumulasi_total,2).'</td>
            //           <td>'.round($realisasi_fisik_akumulasi,2).'</td>
            //           <td rowspan="2">
            //             <a href="javascript:void(0)" class="btn btn-danger btn-sm">Detail</a>
            //           </td>
            //         </tr>';




            $rp_realisasi_bulanan_bo = $v->rp_realisasi_keuangan_bulanan_bo_bp + $v->rp_realisasi_keuangan_bulanan_bo_bbj + $v->rp_realisasi_keuangan_bulanan_bo_bs + $v->rp_realisasi_keuangan_bulanan_bo_bh + $v->rp_realisasi_keuangan_bulanan_bo_bbs ;
            @$persen_realisasi_bulanan_bo = ($rp_realisasi_bulanan_bo / $pagu_bo) * 100;

            $rp_realisasi_bulanan_bm = $v->rp_realisasi_keuangan_bulanan_bm_bmt + $v->rp_realisasi_keuangan_bulanan_bm_bmpm + $v->rp_realisasi_keuangan_bulanan_bm_bmgb + $v->rp_realisasi_keuangan_bulanan_bm_bmjji + $v->rp_realisasi_keuangan_bulanan_bm_bmatl + $v->rp_realisasi_keuangan_bulanan_bm_bmatb;
            @$persen_realisasi_bulanan_bm = ($rp_realisasi_bulanan_bm / $pagu_bm) * 100;

            $rp_realisasi_bulanan_btt = $v->rp_realisasi_keuangan_bulanan_btt;
            @$persen_realisasi_bulanan_btt = ($rp_realisasi_bulanan_btt / $pagu_btt) * 100;

            $rp_realisasi_bulanan_bt = $v->rp_realisasi_keuangan_bulanan_bt_bbh + $v->rp_realisasi_keuangan_bulanan_bt_bbk;
            @$persen_realisasi_bulanan_bt = ($rp_realisasi_bulanan_bt / $pagu_bt) * 100;

            $rp_realisasi_bulanan_total = $v->rp_realisasi_keuangan_bulanan;
            @$persen_realisasi_bulanan_total = ($rp_realisasi_bulanan_total / $pagu_total) * 100;


            $realisasi_fisik_bulanan = $v->realisasi_fisik_bulanan;
            // $table  .= '
            //         <tr>
                     
            //           <td>Bulanan</td>
            //           <td>'.number_format($rp_realisasi_bulanan_bo).'</td>
            //           <td>'.round($persen_realisasi_bulanan_bo,2).'</td>
            //           <td>'.number_format($rp_realisasi_bulanan_bm).'</td>
            //           <td>'.round($persen_realisasi_bulanan_bm,2).'</td>
            //           <td>'.number_format($rp_realisasi_bulanan_btt).'</td>
            //           <td>'.round($persen_realisasi_bulanan_btt,2).'</td>
            //           <td>'.number_format($rp_realisasi_bulanan_bt).'</td>
            //           <td>'.round($persen_realisasi_bulanan_bt,2).'</td>
            //           <td>'.number_format($rp_realisasi_bulanan_total).'</td>
            //           <td>'.round($persen_realisasi_bulanan_total,2).'</td>
            //           <td>'.round($realisasi_fisik_bulanan,2).'</td>
                      
            //         </tr>';
            

              if ($v->kode_opd!='') {
                $skpd_replikasi_berkode++;
                $api_opd_replikasi[$v->kode_opd] = 
                [
                  'data_api' => [
                    'nama_instansi' =>$v->nama_instansi,
                    'is_active' =>$v->is_active,
                    'id_instansi' => $v->id_instansi,
                    'kode_opd' =>$v->kode_opd,
                    'data' =>[
                      'id_grafik' => $v->id_grafik,
                      'id_instansi' => $v->id_instansi,
                      'realisasi_keuangan_akumulasi' => $v->realisasi_keuangan_akumulasi,
                      'kode_opd' => $v->kode_opd,
                      'bulan' => $v->bulan,
                      'pagu_total' => $v->pagu_total,
                      'kode_tahap' => $v->kode_tahap,
                      'tahun' => $v->tahun,
                      'target_fisik_akumulasi' => $v->target_fisik_akumulasi,
                      'target_fisik_akumulasi_ratarata' => $v->target_fisik_akumulasi_ratarata,
                      'target_fisik_bulanan' => $v->target_fisik_bulanan,
                      'target_fisik_bulanan_ratarata' => $v->target_fisik_bulanan_ratarata,
                      'realisasi_fisik_akumulasi' => $v->realisasi_fisik_akumulasi,
                      'realisasi_fisik_akumulasi_ratarata' => $v->realisasi_fisik_akumulasi_ratarata,
                      'realisasi_fisik_bulanan' => $v->realisasi_fisik_bulanan,
                      'realisasi_fisik_bulanan_ratarata' => $v->realisasi_fisik_bulanan_ratarata,
                      'target_keuangan_akumulasi' => $v->target_keuangan_akumulasi,
                      'target_keuangan_akumulasi_ratarata' => $v->target_keuangan_akumulasi_ratarata,
                      'target_keuangan_bulanan' => $v->target_keuangan_bulanan,
                      'target_keuangan_bulanan_ratarata' => $v->target_keuangan_bulanan_ratarata,
                      'realisasi_keuangan_akumulasi_ratarata' => $v->realisasi_keuangan_akumulasi_ratarata,
                      'realisasi_keuangan_bulanan' => $v->realisasi_keuangan_bulanan,
                      'realisasi_keuangan_bulanan_ratarata' => $v->realisasi_keuangan_bulanan_ratarata,
                      'pagu_bo_bp' => $v->pagu_bo_bp,
                      'pagu_bo_bbj' => $v->pagu_bo_bbj,
                      'pagu_bo_bs' => $v->pagu_bo_bs,
                      'pagu_bo_bh' => $v->pagu_bo_bh,
                      'pagu_bo_bbs' => $v->pagu_bo_bbs,
                      'pagu_bm_bmt' => $v->pagu_bm_bmt,
                      'pagu_bm_bmpm' => $v->pagu_bm_bmpm,
                      'pagu_bm_bmgb' => $v->pagu_bm_bmgb,
                      'pagu_bm_bmjji' => $v->pagu_bm_bmjji,
                      'pagu_bm_bmatl' => $v->pagu_bm_bmatl,
                      'pagu_bm_bmatb' => $v->pagu_bm_bmatb,
                      'pagu_btt' => $v->pagu_btt,
                      'pagu_bt_bbh' => $v->pagu_bt_bbh,
                      'pagu_bt_bbk' => $v->pagu_bt_bbk,
                      'rp_target_keuangan_akumulasi' => $v->rp_target_keuangan_akumulasi,
                      'rp_target_keuangan_bulanan' => $v->rp_target_keuangan_bulanan,
                      'rp_realisasi_keuangan_akumulasi' => $v->rp_realisasi_keuangan_akumulasi,
                      'rp_realisasi_keuangan_akumulasi_bo_bp' => $v->rp_realisasi_keuangan_akumulasi_bo_bp,
                      'rp_realisasi_keuangan_akumulasi_bo_bbj' => $v->rp_realisasi_keuangan_akumulasi_bo_bbj,
                      'rp_realisasi_keuangan_akumulasi_bo_bs' => $v->rp_realisasi_keuangan_akumulasi_bo_bs,
                      'rp_realisasi_keuangan_akumulasi_bo_bh' => $v->rp_realisasi_keuangan_akumulasi_bo_bh,
                      'rp_realisasi_keuangan_akumulasi_bo_bbs' => $v->rp_realisasi_keuangan_akumulasi_bo_bbs,
                      'rp_realisasi_keuangan_akumulasi_bm_bmt' => $v->rp_realisasi_keuangan_akumulasi_bm_bmt,
                      'rp_realisasi_keuangan_akumulasi_bm_bmpm' => $v->rp_realisasi_keuangan_akumulasi_bm_bmpm,
                      'rp_realisasi_keuangan_akumulasi_bm_bmgb' => $v->rp_realisasi_keuangan_akumulasi_bm_bmgb,
                      'rp_realisasi_keuangan_akumulasi_bm_bmjji' => $v->rp_realisasi_keuangan_akumulasi_bm_bmjji,
                      'rp_realisasi_keuangan_akumulasi_bm_bmatl' => $v->rp_realisasi_keuangan_akumulasi_bm_bmatl,
                      'rp_realisasi_keuangan_akumulasi_bm_bmatb' => $v->rp_realisasi_keuangan_akumulasi_bm_bmatb,
                      'rp_realisasi_keuangan_akumulasi_btt' => $v->rp_realisasi_keuangan_akumulasi_btt,
                      'rp_realisasi_keuangan_akumulasi_bt_bbh' => $v->rp_realisasi_keuangan_akumulasi_bt_bbh,
                      'rp_realisasi_keuangan_akumulasi_bt_bbk' => $v->rp_realisasi_keuangan_akumulasi_bt_bbk,
                      'rp_realisasi_keuangan_bulanan' => $v->rp_realisasi_keuangan_bulanan,
                      'rp_realisasi_keuangan_bulanan_bo_bp' => $v->rp_realisasi_keuangan_bulanan_bo_bp,
                      'rp_realisasi_keuangan_bulanan_bo_bbj' => $v->rp_realisasi_keuangan_bulanan_bo_bbj,
                      'rp_realisasi_keuangan_bulanan_bo_bs' => $v->rp_realisasi_keuangan_bulanan_bo_bs,
                      'rp_realisasi_keuangan_bulanan_bo_bh' => $v->rp_realisasi_keuangan_bulanan_bo_bh,
                      'rp_realisasi_keuangan_bulanan_bo_bbs' => $v->rp_realisasi_keuangan_bulanan_bo_bbs,
                      'rp_realisasi_keuangan_bulanan_bm_bmt' => $v->rp_realisasi_keuangan_bulanan_bm_bmt,
                      'rp_realisasi_keuangan_bulanan_bm_bmpm' => $v->rp_realisasi_keuangan_bulanan_bm_bmpm,
                      'rp_realisasi_keuangan_bulanan_bm_bmgb' => $v->rp_realisasi_keuangan_bulanan_bm_bmgb,
                      'rp_realisasi_keuangan_bulanan_bm_bmjji' => $v->rp_realisasi_keuangan_bulanan_bm_bmjji,
                      'rp_realisasi_keuangan_bulanan_bm_bmatl' => $v->rp_realisasi_keuangan_bulanan_bm_bmatl,
                      'rp_realisasi_keuangan_bulanan_bm_bmatb' => $v->rp_realisasi_keuangan_bulanan_bm_bmatb,
                      'rp_realisasi_keuangan_bulanan_btt' => $v->rp_realisasi_keuangan_bulanan_btt,
                      'rp_realisasi_keuangan_bulanan_bt_bbh' => $v->rp_realisasi_keuangan_bulanan_bt_bbh,
                      'rp_realisasi_keuangan_bulanan_bt_bbk' => $v->rp_realisasi_keuangan_bulanan_bt_bbk,
                      'last_update' => $v->last_update,
                      'synchronize' => $v->synchronize,
                      ],
                      'show_data' => [
                        'rp_realisasi_akumulasi_bo'=> $rp_realisasi_akumulasi_bo,
                        'persen_realisasi_akumulasi_bo'=> $persen_realisasi_akumulasi_bo,
                        'rp_realisasi_akumulasi_bm'=> $rp_realisasi_akumulasi_bm,
                        'persen_realisasi_akumulasi_bm'=> $persen_realisasi_akumulasi_bm,
                        'rp_realisasi_akumulasi_btt'=> $rp_realisasi_akumulasi_btt,
                        'persen_realisasi_akumulasi_btt'=> $persen_realisasi_akumulasi_btt,
                        'rp_realisasi_akumulasi_bt'=> $rp_realisasi_akumulasi_bt,
                        'persen_realisasi_akumulasi_bt'=> $persen_realisasi_akumulasi_bt,
                        'rp_realisasi_akumulasi_total'=> $rp_realisasi_akumulasi_total,
                        'persen_realisasi_akumulasi_total'=> $persen_realisasi_akumulasi_total,
                        'realisasi_fisik_akumulasi'=> $realisasi_fisik_akumulasi,

                        'rp_realisasi_bulanan_bo'=> $rp_realisasi_bulanan_bo,
                        'persen_realisasi_bulanan_bo'=> $persen_realisasi_bulanan_bo,
                        'rp_realisasi_bulanan_bm'=> $rp_realisasi_bulanan_bm,
                        'persen_realisasi_bulanan_bm'=> $persen_realisasi_bulanan_bm,
                        'rp_realisasi_bulanan_btt'=> $rp_realisasi_bulanan_btt,
                        'persen_realisasi_bulanan_btt'=> $persen_realisasi_bulanan_btt,
                        'rp_realisasi_bulanan_bt'=> $rp_realisasi_bulanan_bt,
                        'persen_realisasi_bulanan_bt'=> $persen_realisasi_bulanan_bt,
                        'rp_realisasi_bulanan_total'=> $rp_realisasi_bulanan_total,
                        'persen_realisasi_bulanan_total'=> $persen_realisasi_bulanan_total,
                        'realisasi_fisik_bulanan'=> $realisasi_fisik_bulanan,
                      ]
                    ],
                ];


                array_push($kumpul_opd_replikasi, $v->kode_opd);
            }




          
        } // end  foreach ($decode->opd as $k => $v) {



        $no = 0;
        $kumpul_opd_terintegrasi = [];
        $kumpul_insert_db = [];
        $kumpul_update_db = [];
        foreach ($data_opd_kota as $k => $v) { 
          $id_instansi = $v['id_instansi'];
          $no++;
          if (in_array($v['kode_opd'], $kumpul_opd_replikasi)) {

            $data_insert_db = [
              'id_provinsi'=> 13,
              'id_kota'=> $id_kota,
              'id_instansi'=> $id_instansi,
              'kode_tahap'=> $tahap,
              'bulan'=> $bulan,
              'tahun'=> $tahun,

              'bo_bp'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bo_bp'],
              'bo_bbj'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bo_bbj'],
              'bo_bs'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bo_bs'],
              'bo_bh'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bo_bh'],
              'bo_bbs'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bo_bbs'],
              'bo_rf'=> '',
              'bm_bmt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmt'],
              'bm_bmpm'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmpm'],
              'bm_bmgb'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmgb'],
              'bm_bmjji'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmjji'],
              'bm_bmatl'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmatl'],
              'bm_bmatb'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmatb'],
              'bm_rf'=> '',
              'btt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_btt'],
              'btt_rf'=> '',
              'bt_bbh'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bt_bbh'],
              'bt_bbk'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bt_bbk'],
              'bt_rf'=> '',
              'rf_total'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['realisasi_fisik_bulanan'],
              'created_on'=> timestamp(),
              'created_by'=> id_user(),
              'input_by '=> 'Integrated',
            ];

            $data_update_db = [
              'id_provinsi'=> 13,
              'id_kota'=> $id_kota,
              'id_instansi'=> $id_instansi,
              'kode_tahap'=> $tahap,
              'bulan'=> $bulan,
              'tahun'=> $tahun,

              'bo_bp'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bo_bp'],
              'bo_bbj'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bo_bbj'],
              'bo_bs'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bo_bs'],
              'bo_bh'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bo_bh'],
              'bo_bbs'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bo_bbs'],
              'bo_rf'=> '',
              'bm_bmt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmt'],
              'bm_bmpm'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmpm'],
              'bm_bmgb'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmgb'],
              'bm_bmjji'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmjji'],
              'bm_bmatl'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmatl'],
              'bm_bmatb'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bm_bmatb'],
              'bm_rf'=> '',
              'btt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_btt'],
              'btt_rf'=> '',
              'bt_bbh'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bt_bbh'],
              'bt_bbk'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['rp_realisasi_keuangan_bulanan_bt_bbk'],
              'bt_rf'=> '',
              'rf_total'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['data']['realisasi_fisik_bulanan'],
              'updated_on'=> timestamp(),
              'updated_by'=> id_user(),
              'input_by '=> 'Integrated',
            ];
                // $hitung_kode_opd_replikasi++;
                $data_terintegrasi_show  = [
                  'id_instansi' =>$v['id_instansi'], 
                  'id_instansi_api' =>$api_opd_replikasi[$v['kode_opd']]['data_api']['id_instansi'], 
                  'nama_instansi' =>$v['nama_instansi'],
                  // 'kode_opd'=>$api_opd_replikasi[$v['kode_opd']]['data_api']['kode_opd'],
                  'data'=> [
                        'rp_realisasi_akumulasi_bo'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['rp_realisasi_akumulasi_bo'],
                        'persen_realisasi_akumulasi_bo'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['persen_realisasi_akumulasi_bo'],
                        'rp_realisasi_akumulasi_bm'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['rp_realisasi_akumulasi_bm'],
                        'persen_realisasi_akumulasi_bm'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['persen_realisasi_akumulasi_bm'],
                        'rp_realisasi_akumulasi_btt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['rp_realisasi_akumulasi_btt'],
                        'persen_realisasi_akumulasi_btt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['persen_realisasi_akumulasi_btt'],
                        'rp_realisasi_akumulasi_bt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['rp_realisasi_akumulasi_bt'],
                        'persen_realisasi_akumulasi_bt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['persen_realisasi_akumulasi_bt'],
                        'rp_realisasi_akumulasi_total'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['rp_realisasi_akumulasi_total'],
                        'persen_realisasi_akumulasi_total'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['persen_realisasi_akumulasi_total'],
                        'realisasi_fisik_akumulasi'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['realisasi_fisik_akumulasi'],

                        'rp_realisasi_bulanan_bo'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['rp_realisasi_bulanan_bo'],
                        'persen_realisasi_bulanan_bo'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['persen_realisasi_bulanan_bo'],
                        'rp_realisasi_bulanan_bm'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['rp_realisasi_bulanan_bm'],
                        'persen_realisasi_bulanan_bm'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['persen_realisasi_bulanan_bm'],
                        'rp_realisasi_bulanan_btt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['rp_realisasi_bulanan_btt'],
                        'persen_realisasi_bulanan_btt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['persen_realisasi_bulanan_btt'],
                        'rp_realisasi_bulanan_bt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['rp_realisasi_bulanan_bt'],
                        'persen_realisasi_bulanan_bt'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['persen_realisasi_bulanan_bt'],
                        'rp_realisasi_bulanan_total'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['rp_realisasi_bulanan_total'],
                        'persen_realisasi_bulanan_total'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['persen_realisasi_bulanan_total'],
                        'realisasi_fisik_bulanan'=> $api_opd_replikasi[$v['kode_opd']]['data_api']['show_data']['realisasi_fisik_bulanan'],
                    
                  ],
                ] ; 
                array_push($kumpul_opd_terintegrasi, $data_terintegrasi_show);
                array_push($kumpul_insert_db, $data_insert_db);
                array_push($kumpul_update_db, $data_update_db);
         }else{ 
             }
         } // end foreach ($data_opd_kota as $k => $v) { 



          $banyak_data_terintegrasi =0;
          foreach ($kumpul_opd_terintegrasi as $k => $v) { 
          $banyak_data_terintegrasi++;
              $table  .= '
                    <tr>
                      <td  rowspan="2">'.($k+1).'</td>
                      <td  rowspan="2">'.$v['nama_instansi'].'</td>
                      <td>Akumulasi</td>
                      <td align="right">'.number_format($v['data']['rp_realisasi_akumulasi_bo']).'</td>
                      <td align="center">'.round($v['data']['persen_realisasi_akumulasi_bo'],2).'</td>
                      <td align="right">'.number_format($v['data']['rp_realisasi_akumulasi_bm']).'</td>
                      <td align="center">'.round($v['data']['persen_realisasi_akumulasi_bm'],2).'</td>
                      <td align="right">'.number_format($v['data']['rp_realisasi_akumulasi_btt']).'</td>
                      <td align="center">'.round($v['data']['persen_realisasi_akumulasi_btt'],2).'</td>
                      <td align="right">'.number_format($v['data']['rp_realisasi_akumulasi_bt']).'</td>
                      <td align="center">'.round($v['data']['persen_realisasi_akumulasi_bt'],2).'</td>
                      <td align="right">'.number_format($v['data']['rp_realisasi_akumulasi_total']).'</td>
                      <td align="center">'.round($v['data']['persen_realisasi_akumulasi_total'],2).'</td>
                      <td align="center">'.round($v['data']['realisasi_fisik_akumulasi'],2).'</td>
                       <td rowspan="2" id="cek_status_progress_'.$v['id_instansi'].'">
                        
                      </td>
                       <td rowspan="2">
                       <div class="btn-group">
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm import_replikasi" id="opd_terintegrasi_'.$v['id_instansi'].'" onclick="tes_import_data_replikasi('."'".$v['id_instansi']."','".$v['id_instansi_api']."','".$tahap."','".$tahun."','".$bulan."'".')"><i class="fa fa-download"></i></a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm import_replikasi" id="opd_terintegrasi_'.$v['id_instansi'].'" onclick="detail_replikasi_opd('."'".$v['id_instansi']."','".$v['nama_instansi']."','".$v['id_instansi_api']."','".$tahap."','".$tahun."','".$bulan."'".')"><i class="fa fa-folder-open"></i></a>
                        </div>
                      </td>
                    </tr>';
              $table  .= '
                    <tr>
                    
                      <td>Bulanan</td>
                      <td align="right">'.number_format($v['data']['rp_realisasi_bulanan_bo']).'</td>
                      <td align="center">'.round($v['data']['persen_realisasi_bulanan_bo'],2).'</td>
                      <td align="right">'.number_format($v['data']['rp_realisasi_bulanan_bm']).'</td>
                      <td align="center">'.round($v['data']['persen_realisasi_bulanan_bm'],2).'</td>
                      <td align="right">'.number_format($v['data']['rp_realisasi_bulanan_btt']).'</td>
                      <td align="center">'.round($v['data']['persen_realisasi_bulanan_btt'],2).'</td>
                      <td align="right">'.number_format($v['data']['rp_realisasi_bulanan_bt']).'</td>
                      <td align="center">'.round($v['data']['persen_realisasi_bulanan_bt'],2).'</td>
                      <td align="right">'.number_format($v['data']['rp_realisasi_bulanan_total']).'</td>
                      <td align="center">'.round($v['data']['persen_realisasi_bulanan_total'],2).'</td>
                      <td align="center">'.round($v['data']['realisasi_fisik_bulanan'],2).'</td>
                      
                    </tr>';
          }
                    $table .= '</table>';



          // var_dump($kumpul_insert_db);

        if ($banyak_data_terintegrasi>0) {
          $button_import = '    <div class="col-md-12" id="div_import_all">
                                        <div class="btn-group btn-block">
                                                <button class="btn btn-block btn-info btn-sm" onclick="warning_import_data_replikasi_all()" id="import_all" style="width:150px">Import All</button>   
                                          
                                        </div>
                                        
                                        
                                    </div>';
          // $button_import = '<button class="btn btn-danger btn-block btn-sm" onclick="import_data_replikasi_all()" id="import_all">Import</button>';
          // $button_import = '<button class="btn btn-danger btn-block btn-sm" onclick="import_data_replikasi('."'".$banyak_data_terintegrasi."'".')">Import</button>';
        }else{
          $button_import = '';

        }

        if ($action=='import') {
          foreach ($kumpul_insert_db as $key => $v) {
            $id_instansi_cek = $v['id_instansi'];
            $cek_data = $this->db->query("SELECT * from realisasi_fisik_keuangan_kab_kota where tahun='$tahun' and kode_tahap='$tahap' and bulan='$bulan' and id_instansi='$id_instansi_cek'")->num_rows();
            if ($cek_data==0) {
              $this->db->insert('realisasi_fisik_keuangan_kab_kota', $v);
            }else{
              $where = [
                'id_instansi'=>$id_instansi_cek, 
                'bulan'=> $bulan, 
                'tahun'=> $tahun, 
                'kode_tahap'=> $tahap, 
            ];
              $this->db->update('realisasi_fisik_keuangan_kab_kota', $kumpul_update_db[$key], $where);

            }
          }
            $output = ['success'=>true];
            echo json_encode($output);
        }else{
          echo $table.$button_import;
        }
        
        



       

    }









    public function get_data_per_opd()
    {
        
        $id_instansi_api = $this->input->post('id_instansi_api');
        $tahun = $this->input->post('tahun');
        $tahap = $this->input->post('tahap');
        $bulan = $this->input->post('bulan');
        $action = $this->input->post('action');
        
         $url_replikasi = $this->url_replikasi."integrated/api/dashboard_pembangunan/get_rfk_opd_replikasi/".$id_instansi_api."?tahun=".$tahun."&tahap=".$tahap."&bulan=".$bulan;
        $get_data_instansi_replikasi = file_get_contents($url_replikasi);
        $decode = json_decode($get_data_instansi_replikasi);
        $output  = [
            'data'=>$decode,
            'tahap'=>pilihan_nama_tahapan($tahap).'<br>Tahun '.$tahun,
            'pagu'=>' ???? ',
        ];
        echo  json_encode($output);


   }
































    public function import_data($id_instansi_api)
    {
        
        $tahun = $this->input->post('tahun');
        $tahap = $this->input->post('tahap');
        $bulan = $this->input->post('bulan');
        $id_instansi = $this->input->post('id_instansi');
         $url_replikasi = $this->url_replikasi."integrated/api/dashboard_pembangunan/get_rfk_opd_replikasi/".$id_instansi_api."?tahun=".$tahun."&tahap=".$tahap."&bulan=".$bulan;
        $get_data_instansi_replikasi = file_get_contents($url_replikasi);
        $decode = json_decode($get_data_instansi_replikasi);


        $data_opd_kota = $this->data_opd_kota;
        $id_kota = $this->id_kota;

        
         // $result = $this->db->insert_batch('grafik', $data);

        // $output = [];
        // $output['status'] = true;

        $output  = $decode->opd[0]->tahun;
        $v = $decode->opd[0]; 

        $data_insert = [
            'id_provinsi'=>13,
            'id_kota'=>$id_kota,
            'id_instansi'=>$id_instansi,
            'kode_tahap'=>$tahap,
            'bulan'=>$bulan,
            'tahun'=>$tahun,
            'bo_bp'=>$v->rp_realisasi_keuangan_bulanan_bo_bp,
            'bo_bbj'=>$v->rp_realisasi_keuangan_bulanan_bo_bbj,
            'bo_bs'=>$v->rp_realisasi_keuangan_bulanan_bo_bs,
            'bo_bh'=>$v->rp_realisasi_keuangan_bulanan_bo_bh,
            'bo_bbs'=>$v->rp_realisasi_keuangan_bulanan_bo_bbs,
            'bm_bmt'=>$v->rp_realisasi_keuangan_bulanan_bm_bmt,
            'bm_bmpm'=>$v->rp_realisasi_keuangan_bulanan_bm_bmpm,
            'bm_bmgb'=>$v->rp_realisasi_keuangan_bulanan_bm_bmgb,
            'bm_bmjji'=>$v->rp_realisasi_keuangan_bulanan_bm_bmjji,
            'bm_bmatl'=>$v->rp_realisasi_keuangan_bulanan_bm_bmatl,
            'bm_bmatb'=>$v->rp_realisasi_keuangan_bulanan_bm_bmatb,
            'btt'=>$v->rp_realisasi_keuangan_bulanan_btt,
            'bt_bbh'=>$v->rp_realisasi_keuangan_bulanan_bt_bbh,
            'bt_bbk'=>$v->rp_realisasi_keuangan_bulanan_bt_bbk,
            'rf_total'=>$v->realisasi_fisik_bulanan,
            'created_on'=>timestamp(),
            'created_by'=>id_user(),
            'input_by '=>'Integrasi Replikasi',
        ];

        $data_update = [
            'id_provinsi'=>13,
            'id_kota'=>$id_kota,
            'id_instansi'=>$id_instansi,
            'kode_tahap'=>$tahap,
            'bulan'=>$bulan,
            'tahun'=>$tahun,
            'bo_bp'=>$v->rp_realisasi_keuangan_bulanan_bo_bp,
            'bo_bbj'=>$v->rp_realisasi_keuangan_bulanan_bo_bbj,
            'bo_bs'=>$v->rp_realisasi_keuangan_bulanan_bo_bs,
            'bo_bh'=>$v->rp_realisasi_keuangan_bulanan_bo_bh,
            'bo_bbs'=>$v->rp_realisasi_keuangan_bulanan_bo_bbs,
            'bm_bmt'=>$v->rp_realisasi_keuangan_bulanan_bm_bmt,
            'bm_bmpm'=>$v->rp_realisasi_keuangan_bulanan_bm_bmpm,
            'bm_bmgb'=>$v->rp_realisasi_keuangan_bulanan_bm_bmgb,
            'bm_bmjji'=>$v->rp_realisasi_keuangan_bulanan_bm_bmjji,
            'bm_bmatl'=>$v->rp_realisasi_keuangan_bulanan_bm_bmatl,
            'bm_bmatb'=>$v->rp_realisasi_keuangan_bulanan_bm_bmatb,
            'btt'=>$v->rp_realisasi_keuangan_bulanan_btt,
            'bt_bbh'=>$v->rp_realisasi_keuangan_bulanan_bt_bbh,
            'bt_bbk'=>$v->rp_realisasi_keuangan_bulanan_bt_bbk,
            'rf_total'=>$v->realisasi_fisik_bulanan,
            'updated_on'=>timestamp(),
            'updated_by'=>id_user(),
            'input_by '=>'Integrasi Replikasi',
        ];




            $id_instansi_cek = $id_instansi;
            $cek_data = $this->db->query("SELECT id_realisasi_fisik_keuangan_kab_kota from realisasi_fisik_keuangan_kab_kota where tahun='$tahun' and kode_tahap='$tahap' and bulan='$bulan' and id_instansi='$id_instansi_cek'")->num_rows();
            if ($cek_data==0) {
              $this->db->insert('realisasi_fisik_keuangan_kab_kota', $data_insert);
            }else{
              $where = [
                'id_instansi'=>$id_instansi_cek, 
                'bulan'=> $bulan, 
                'tahun'=> $tahun, 
                'kode_tahap'=> $tahap, 
            ];
              $this->db->update('realisasi_fisik_keuangan_kab_kota', $data_update, $where);

            }


        $output = [];
        $output['status'] = true;

        echo json_encode($output);




        // echo json_encode($data_insert);

    }



    // public function detail_data_opd_pengelompokan($id_instansi, $tahun, $tahap, $bulan)
    public function detail_data_opd_pengelompokan($id_instansi)
    {
		// $id_instansi = $this->input->get('id_instansi');
		$tahun = tahun_anggaran();//$this->input->get('tahun');
		$tahap = tahapan_apbd();//$this->input->get('tahap');
		$bulan = bulan_aktif();//$this->input->get('bulan');
        $dashboard_pembangunan    = $this->dashboard_pembangunan_model;

        $q_opd = $this->db->query("SELECT id_instansi, nama_instansi , total_anggaran_skpd_awal(id_instansi , $tahun) as pagu_total from master_instansi where id_instansi='$id_instansi'")->row_array(); 
         $skpd = $q_opd['nama_instansi'];
         $pagu_total = $q_opd['pagu_total'] == '' ? 0 : $q_opd['pagu_total'] ;
        if ($q_opd['pagu_total']==0) {
	      
			$rp_target_keuangan_akumulasi = 0;
			$rp_realisasi_keuangan_akumulasi = 0;
			$persen_target_keuangan = 0;
			$persen_target_keuangan_bulanan = 0;
			$persen_realisasi_keuangan = 0;
			$deviasi_fisik_akumulasi = 0;
			$deviasi_fisik_bulanan = 0;
			$target_fisik_akumulasi = 0;
			$realisasi_fisik_akumulasi = 0;
			$target_fisik_bulanan = 0;
			$realisasi_fisik_bulanan = 0;
			$rp_target_keuangan_bulanan = 0;
        }else{
			$q_pencapaian_opd = $dashboard_pembangunan->laporan_opd($tahun, $tahap, $bulan, $id_instansi)->row_array();
			$rp_target_keuangan_akumulasi = $q_pencapaian_opd['rp_target_keuangan_akumulasi'] == '' ? 0 : $q_pencapaian_opd['rp_target_keuangan_akumulasi'];
			$rp_realisasi_keuangan_akumulasi = $q_pencapaian_opd['rp_realisasi_keuangan_akumulasi'] == '' ? 0 : $q_pencapaian_opd['rp_realisasi_keuangan_akumulasi'];
			$persen_target_keuangan = $q_pencapaian_opd['pagu_total'] == '' ? 0 : ($q_pencapaian_opd['rp_target_keuangan_akumulasi'] / $q_pencapaian_opd['pagu_total']) * 100; 
			$persen_target_keuangan_bulanan = $q_pencapaian_opd['pagu_total'] == '' ? 0 : ($q_pencapaian_opd['rp_target_keuangan_bulanan'] / $q_pencapaian_opd['pagu_total']) * 100; 
			$persen_realisasi_keuangan = $q_pencapaian_opd['pagu_total'] == '' ? 0 : ($q_pencapaian_opd['rp_realisasi_keuangan_akumulasi'] / $q_pencapaian_opd['pagu_total']) * 100; 
			$deviasi_fisik_akumulasi = $q_pencapaian_opd['realisasi_fisik_akumulasi'] - $q_pencapaian_opd['target_fisik_akumulasi'] ;
			$deviasi_fisik_bulanan = $q_pencapaian_opd['realisasi_fisik_bulanan'] - $q_pencapaian_opd['target_fisik_bulanan'] ;
			$target_fisik_akumulasi = $q_pencapaian_opd['target_fisik_akumulasi'] == '' ? 0 : $q_pencapaian_opd['target_fisik_akumulasi'];
			$realisasi_fisik_akumulasi = $q_pencapaian_opd['realisasi_fisik_akumulasi'] == '' ? 0 : $q_pencapaian_opd['realisasi_fisik_akumulasi'];
			$target_fisik_bulanan = $q_pencapaian_opd['target_fisik_bulanan'] == '' ? 0 : $q_pencapaian_opd['target_fisik_bulanan'];
			$realisasi_fisik_bulanan = $q_pencapaian_opd['realisasi_fisik_bulanan'] == '' ? 0 : $q_pencapaian_opd['realisasi_fisik_bulanan'];
			$rp_target_keuangan_bulanan= $q_pencapaian_opd['rp_target_keuangan_bulanan'] == '' ? 0 : $q_pencapaian_opd['rp_target_keuangan_bulanan'] ;
        }

		$pencapaian_opd = [
			'skpd'=> $skpd,
			'pagu'=> $pagu_total,
			'rp_target_keuangan'=>$rp_target_keuangan_akumulasi,
			'persen_target_keuangan'=>round($persen_target_keuangan,2),
			'rp_realisasi_keuangan'=>$rp_realisasi_keuangan_akumulasi,
			'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan,2),

			'target_fisik_akumulasi'=>$target_fisik_akumulasi,
			'realisasi_fisik_akumulasi'=>$realisasi_fisik_akumulasi,
			'deviasi_fisik_akumulasi'=>round($deviasi_fisik_akumulasi,2),

			'target_fisik_bulanan'=>$target_fisik_bulanan,
			'target_keuangan_bulanan'=>$rp_target_keuangan_bulanan,
			'persen_target_keuangan_bulanan'=>$persen_target_keuangan_bulanan,
			// 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
			// 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
			// 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),

			// 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'].'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
		];





        $q_program = $dashboard_pembangunan->laporan_program_opd($id_instansi, $tahun, $tahap, $bulan);
      


        $data_opd = [];


        $kumpul_program = [];
        foreach ($q_program->result_array() as $k_program => $v_program) {

            $kode_program = $v_program['kode_program'];
            $q_kegiatan = $dashboard_pembangunan->laporan_kegiatan_opd($id_instansi, $tahun, $tahap, $bulan, $kode_program)->result_array();
            $kumpul_kegiatan = [];


            $total_pagu_program = 0;
            $persen_target_fisik_program = 0;
            $persen_realisasi_fisik_program = 0;
            $totalkegiatan_rp_target_keuangan_akumulasi = 0;
            $totalkegiatan_rp_realisasi_keuangan_akumulasi = 0;


            foreach ($q_kegiatan as $k_kegiatan => $v_kegiatan) {
                $kode_kegiatan = $v_kegiatan['kode_kegiatan'];
                $q_sub_kegiatan = $dashboard_pembangunan->laporan_sub_kegiatan_opd($id_instansi, $tahun, $tahap, $bulan, $kode_kegiatan)->result_array();
                $kumpul_sub_kegiatan = [];



                $total_sub_kegiatan_persen_target_fisik_akumulasi = 0;
                $total_sub_kegiatan_persen_realisasi_fisik_akumulasi = 0;
                $total_sub_kegiatan_rp_target_keuangan_akumulasi = 0;
                $total_sub_kegiatan_rp_realisasi_keuangan_akumulasi = 0;
                $total_pagu_kegiatan= 0;

                foreach ($q_sub_kegiatan as $k_sk => $value_sk) {

                    $deviasi_fisik = $value_sk['realisasi_fisik_akumulasi'] - $value_sk['target_fisik_akumulasi'] ; 
                    $deviasi_keuangan = $value_sk['realisasi_keuangan_akumulasi'] - $value_sk['target_keuangan_akumulasi'] ; 



                    $persen_target_fisik_akumulasi = $value_sk['target_fisik_akumulasi'] == '' ? 0 : $value_sk['target_fisik_akumulasi'];
                    $persen_realisasi_fisik_akumulasi = $value_sk['realisasi_fisik_akumulasi'] == '' ? 0 : $value_sk['realisasi_fisik_akumulasi'];
                    $rp_target_keuangan_akumulasi = $value_sk['rp_target_keuangan_akumulasi'] == '' ? 0 : $value_sk['rp_target_keuangan_akumulasi'];
                    $rp_realisasi_keuangan_akumulasi = $value_sk['rp_realisasi_keuangan_akumulasi'] == '' ? 0 : $value_sk['rp_realisasi_keuangan_akumulasi'];
                    $persen_target_keuangan_akumulasi = $value_sk['target_keuangan_akumulasi'] == '' ? 0 : $value_sk['target_keuangan_akumulasi'];
                    $persen_realisasi_keuangan_akumulasi = $value_sk['realisasi_keuangan_akumulasi'] == '' ? 0 : $value_sk['realisasi_keuangan_akumulasi'];

                    $pagu_total = $value_sk['pagu_total']=='' ? 0 : $value_sk['pagu_total'];




                    $total_pagu_kegiatan+= $pagu_total;
                     $total_sub_kegiatan_persen_target_fisik_akumulasi += $persen_target_fisik_akumulasi ; 
                     $total_sub_kegiatan_persen_realisasi_fisik_akumulasi += $persen_realisasi_fisik_akumulasi ; 
                     $total_sub_kegiatan_rp_target_keuangan_akumulasi += $rp_target_keuangan_akumulasi ; 
                     $total_sub_kegiatan_rp_realisasi_keuangan_akumulasi += $rp_realisasi_keuangan_akumulasi ; 
                     // $total_sub_kegiatan_persen_target_keuangan_akumulasi += $persen_target_keuangan_akumulasi ; 
                     // $total_sub_kegiatan_persen_realisasi_keuangan_akumulasi += $persen_realisasi_keuangan_akumulasi ; 



                    $data_sub_kegiatan = [
                        'nama_sub_kegiatan'=>$value_sk['nama_sub_kegiatan'],
                        'pptk'=>$value_sk['pptk'],
                        'pagu'=>$pagu_total,
                        'persen_target_fisik'=>round($persen_target_fisik_akumulasi,2),
                        'persen_realisasi_fisik'=>round($persen_realisasi_fisik_akumulasi,2),
                        'deviasi_fisik'=>round($deviasi_fisik,2),

                        'rp_target_keuangan'=>$rp_target_keuangan_akumulasi,
                        'rp_realisasi_keuangan'=>$rp_realisasi_keuangan_akumulasi,
                        'persen_target_keuangan'=>round($persen_target_keuangan_akumulasi,2),
                        'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan_akumulasi,2),
                        'deviasi_keuangan'=>round($deviasi_keuangan,2),
                    ];
                    array_push($kumpul_sub_kegiatan, $data_sub_kegiatan);
                }


                $banyak_sub_kegiatan = count($kumpul_sub_kegiatan);
                $persen_target_fisik_kegiatan = $total_sub_kegiatan_persen_target_fisik_akumulasi / $banyak_sub_kegiatan;
                $persen_realisasi_fisik_kegiatan = $total_sub_kegiatan_persen_realisasi_fisik_akumulasi / $banyak_sub_kegiatan;
                $deviasi_fisik_kegiatan = $persen_realisasi_fisik_kegiatan - $persen_target_fisik_kegiatan ; 
                $persen_target_keuangan_kegiatan = ($total_sub_kegiatan_rp_target_keuangan_akumulasi / $total_pagu_kegiatan) * 100 ;
                $persen_realisasi_keuangan_kegiatan = ($total_sub_kegiatan_rp_realisasi_keuangan_akumulasi / $total_pagu_kegiatan) * 100 ;
                $deviasi_keuangan_kegiatan = $persen_realisasi_keuangan_kegiatan - $persen_target_keuangan_kegiatan;



                $total_pagu_program +=$total_pagu_kegiatan;
                $persen_target_fisik_program +=$persen_target_fisik_kegiatan;
                $persen_realisasi_fisik_program +=$persen_realisasi_fisik_kegiatan;
                $totalkegiatan_rp_target_keuangan_akumulasi +=$total_sub_kegiatan_rp_target_keuangan_akumulasi;
                $totalkegiatan_rp_realisasi_keuangan_akumulasi +=$total_sub_kegiatan_rp_realisasi_keuangan_akumulasi;


                $data_kegiatan = [
                    'nama_kegiatan'=>$v_kegiatan['nama_kegiatan'],


                        'pptk'=>'-',
                        'pagu'=>$total_pagu_kegiatan,
                        'persen_target_fisik'=>round($persen_target_fisik_kegiatan,2),
                        'persen_realisasi_fisik'=>round($persen_realisasi_fisik_kegiatan,2),
                        'deviasi_fisik'=>round($deviasi_fisik_kegiatan,2),

                        'rp_target_keuangan'=>$total_sub_kegiatan_rp_target_keuangan_akumulasi,
                        'rp_realisasi_keuangan'=>$total_sub_kegiatan_rp_realisasi_keuangan_akumulasi,
                        'persen_target_keuangan'=> round($persen_target_keuangan_kegiatan,2), //$total_sub_kegiatan_persen_target_keuangan_akumulasi,
                        'persen_realisasi_keuangan'=> round($persen_realisasi_keuangan_kegiatan,2),//$total_sub_kegiatan_persen_realisasi_keuangan_akumulasi,
                        'deviasi_keuangan'=> round($deviasi_keuangan_kegiatan,2),



                    'data_sub_kegiatan'=>$kumpul_sub_kegiatan,
                ];
                array_push($kumpul_kegiatan, $data_kegiatan);
            }


            $banyak_kegiatan = count($kumpul_kegiatan);
            $persen_target_fisik_program = $persen_target_fisik_program / $banyak_kegiatan;
            $persen_realisasi_fisik_program = $persen_realisasi_fisik_program / $banyak_kegiatan;
            $deviasi_fisik_program = $persen_realisasi_fisik_program - $persen_target_fisik_program;
            $persen_target_keuangan_program = ($totalkegiatan_rp_target_keuangan_akumulasi / $total_pagu_program) * 100 ;
            $persen_realisasi_keuangan_program = ($totalkegiatan_rp_realisasi_keuangan_akumulasi / $total_pagu_program) * 100 ;
            $deviasi_keuangan_program = $persen_realisasi_keuangan_program - $persen_target_keuangan_program;


            $data_program = [
                'nama_program'=>$v_program['nama_program'],

                'pptk'=>'-',
                'pagu'=>$total_pagu_program,
                'persen_target_fisik'=>round($persen_target_fisik_program,2),
                'persen_realisasi_fisik'=>round($persen_realisasi_fisik_program,2),
                'deviasi_fisik'=>round($deviasi_fisik_program,2),

                'rp_target_keuangan'=>$totalkegiatan_rp_target_keuangan_akumulasi,
                'rp_realisasi_keuangan'=>$totalkegiatan_rp_realisasi_keuangan_akumulasi,
                'persen_target_keuangan'=> round($persen_target_keuangan_program,2), //$total_sub_kegiatan_persen_target_keuangan_akumulasi,
                'persen_realisasi_keuangan'=> round($persen_realisasi_keuangan_program,2),//$total_sub_kegiatan_persen_realisasi_keuangan_akumulasi,
                'deviasi_keuangan'=> round($deviasi_keuangan_program,2),

                'data_kegiatan'=>$kumpul_kegiatan,
            ];
            array_push($kumpul_program, $data_program);
           
        }


        


        $output = [
            'status'=>'success',
            'message'=>'Success',
            'bulan'=>$bulan,
            'pencapaian_opd'=>$pencapaian_opd,
            'data'=> $kumpul_program,
        ];

            header('Content-Type: application/json');
        echo json_encode($output);

    }

    public function grafik_akumulasi(){
        $id_instansi = $this->input->get('id_instansi') ? $this->input->get('id_instansi') : 'semua';
        $tahun = tahun_anggaran();
        $tahap = tahapan_apbd();
        $bulan_aktif = bulan_aktif();
        if($id_instansi=='semua'){
            $grafik_akumulasi    = $this->dashboard_model->get_grafik_total_akumulasi($tahun, $tahap)->result_array();
            $nama_opd = "Semua OPD";
        }else{
            $grafik_akumulasi    = $this->dashboard_model->get_grafik_akumulasi($id_instansi, $tahun, $tahap)->result_array();
            $nama_opd = nama_instansi($id_instansi);

        }
            $kumpul_grafik_akumulasi = [];
            foreach($grafik_akumulasi as $k =>$v){
                $bulan = ($k + 1);
                $deviasi_fisik = round($v['realisasi_fisik'],2) - round($v['target_fisik'],2);
                $deviasi_keuangan = round($v['realisasi_keuangan'],2) - round($v['target_keuangan'],2);

                if($bulan_aktif>=$bulan){
                    $data_grafik_akumulasi = [
                        'bulan'=>$bulan,
                        'target_fisik'=>round($v['target_fisik'],2),
                        'realisasi_fisik'=>round($v['realisasi_fisik'],2),
                        'deviasi_fisik'=>round($deviasi_fisik,2),
                        'target_keuangan'=>round($v['target_keuangan'],2),
                        'realisasi_keuangan'=>round($v['realisasi_keuangan'],2),
                        'deviasi_keuangan'=>round($deviasi_keuangan,2),
                    ];
                }else{
                    $data_grafik_akumulasi = [
                        'bulan'=>$bulan,
                        'target_fisik'=>round($v['target_fisik'],2),
                        'realisasi_fisik'=>'',
                        'deviasi_fisik'=>'',
                        'target_keuangan'=>round($v['target_keuangan'],2),
                        'realisasi_keuangan'=>'',
                        'deviasi_keuangan'=>'',
                    ];
                }
                    array_push($kumpul_grafik_akumulasi, $data_grafik_akumulasi);
    
                } 

            
            
                $output = [
                    'nama_opd' => $nama_opd,
                    'data' =>$kumpul_grafik_akumulasi
                ];

                
                header('Content-Type: application/json');
               echo json_encode($output);
        
        
        
        
    }



}
