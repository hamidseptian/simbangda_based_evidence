<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Auth.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (identitas() != true) {
            redirect('setup', 'refresh');
        }
        $this->load->model('auth/auth_model', 'auth_model');
        $this->load->model([
            'dashboard/dashboard_model'       => 'dashboard_model',
            'Laporan/ratarata_fisik_keuangan'                   => 'ratarata_fisik_keuangan',

    'Laporan/realisasi_gabungan_per_kab_kota'   => 'realisasi_gabungan_per_kab_kota',

            // 'program_apbd/program_apbd_model' => 'program_apbd_model'
        ]);
    }

   
    public function index()
    {
           $data['title']        = "Selamat datang di Simbangda Based Evidence";
            $page                 = 'beranda/index';
            $class = $this->router->fetch_class();
            $method = $this->router->fetch_method();

            $tahap = tahapan_apbd();
            $tahun = tahun_anggaran();
            $data['nama_tahap'] = pilihan_nama_tahapan($tahap);
            $data['tahun_anggaran'] = $tahun;
            $data['tahap'] = $tahap;
            $data['tahun'] = $tahun;
            $data['bulan'] = bulan_aktif();

            $dashboard      = $this->dashboard_model;
                $pagu = $dashboard->pagu_total($tahap)->row();
                $rk = $dashboard->rk_total($tahap)->row();


                 $bo = $pagu->pagu_bo;
            $bm = $pagu->pagu_bm;
            $btt = $pagu->pagu_btt;
            $bt = $pagu->pagu_bt;


            $bo_bp = $pagu->pagu_bo_bp;
            $bo_bbj = $pagu->pagu_bo_bbj;
            $bo_bs = $pagu->pagu_bo_bs;
            $bo_bh = $pagu->pagu_bo_bh;
            $bm_bmt = $pagu->pagu_bm_bmt;
            $bm_bmpm = $pagu->pagu_bm_bmpm;
            $bm_bmgb = $pagu->pagu_bm_bmgb;
            $bm_bmjji = $pagu->pagu_bm_bmjji;
            $bm_bmatl = $pagu->pagu_bm_bmatl;
            $btt = $pagu->pagu_btt;
            $bt_bbh = $pagu->pagu_bt_bbh;
            $bt_bbk = $pagu->pagu_bt_bbk;

            $pagu_total = $pagu->total == '' ? 0 : $pagu->total;
            $data['bo']       = $bo;
            $data['bm']       = $bm;
            $data['btt']       = $btt;
            $data['bt']       = $bt;

            $data['bo_bp']       = $bo_bp;
            $data['bo_bbj']       = $bo_bbj;
            $data['bo_bs']       = $bo_bs;
            $data['bo_bh']       = $bo_bh;
            $data['bm_bmt']       = $bm_bmt;
            $data['bm_bmpm']       = $bm_bmpm;
            $data['bm_bmgb']       = $bm_bmgb;
            $data['bm_bmjji']       = $bm_bmjji;
            $data['bm_bmatl']       = $bm_bmatl;
            $data['btt']       = $btt;
            $data['bt_bbh']       = $bt_bbh;
            $data['bt_bbk']       = $bt_bbk;

            $data['anggaran_apbd']       = $pagu_total;
            @$data['persen_bo']       = $pagu_total == 0 ? 0 : round(($bo / $pagu_total) * 100, 2);
            @$data['persen_bm']       = $pagu_total == 0 ? 0 : round(($bm / $pagu_total) * 100, 2);
            @$data['persen_btt']       = $pagu_total == 0 ? 0 : round(($btt / $pagu_total) * 100, 2);
            @$data['persen_bt']       = $pagu_total == 0 ? 0 : round(($bt / $pagu_total) * 100, 2);

            @$data['persen_bo_bp']       = $pagu_total == 0 ? 0 : round(($bo_bp / $pagu_total) * 100, 2);
            @$data['persen_bo_bbj']       = $pagu_total == 0 ? 0 : round(($bo_bbj / $pagu_total) * 100, 2);
            @$data['persen_bo_bs']       = $pagu_total == 0 ? 0 : round(($bo_bs / $pagu_total) * 100, 2);
            @$data['persen_bo_bh']       = $pagu_total == 0 ? 0 : round(($bo_bh / $pagu_total) * 100, 2);
            @$data['persen_bm_bmt']       = $pagu_total == 0 ? 0 : round(($bm_bmt / $pagu_total) * 100, 2);
            @$data['persen_bm_bmpm']       = $pagu_total == 0 ? 0 : round(($bm_bmpm / $pagu_total) * 100, 2);
            @$data['persen_bm_bmgb']       = $pagu_total == 0 ? 0 : round(($bm_bmgb / $pagu_total) * 100, 2);
            @$data['persen_bm_bmjji']       = $pagu_total == 0 ? 0 : round(($bm_bmjji / $pagu_total) * 100, 2);
            @$data['persen_bm_bmatl']       = $pagu_total == 0 ? 0 : round(($bm_bmatl / $pagu_total) * 100, 2);
            @$data['persen_btt']       = $pagu_total == 0 ? 0 : round(($btt / $pagu_total) * 100, 2);
            @$data['persen_bt_bbh']       = $pagu_total == 0 ? 0 : round(($bt_bbh / $pagu_total) * 100, 2);
            @$data['persen_bt_bbk']       = $pagu_total == 0 ? 0 : round(($bt_bbk / $pagu_total) * 100, 2);








            $rk_bo = $rk->rk_bo;
            $rk_bm = $rk->rk_bm;
            $rk_btt = $rk->rk_btt;
            $rk_bt = $rk->rk_bt;


            $rk_bo_bp = $rk->rk_bo_bp;
            $rk_bo_bbj = $rk->rk_bo_bbj;
            $rk_bo_bs = $rk->rk_bo_bs;
            $rk_bo_bh = $rk->rk_bo_bh;
            $rk_bm_bmt = $rk->rk_bm_bmt;
            $rk_bm_bmpm = $rk->rk_bm_bmpm;
            $rk_bm_bmgb = $rk->rk_bm_bmgb;
            $rk_bm_bmjji = $rk->rk_bm_bmjji;
            $rk_bm_bmatl = $rk->rk_bm_bmatl;
            $rk_btt = $rk->rk_btt;
            $rk_bt_bbh = $rk->rk_bt_bbh;
            $rk_bt_bbk = $rk->rk_bt_bbk;

            $rk_total = $rk->total == '' ? 0 : $rk->total;
            $data['rk_bo']       = $rk_bo;
            $data['rk_bm']       = $rk_bm;
            $data['rk_btt']       = $rk_btt;
            $data['rk_bt']       = $rk_bt;

            $data['rk_bo_bp']       = $rk_bo_bp;
            $data['rk_bo_bbj']       = $rk_bo_bbj;
            $data['rk_bo_bs']       = $rk_bo_bs;
            $data['rk_bo_bh']       = $rk_bo_bh;
            $data['rk_bm_bmt']       = $rk_bm_bmt;
            $data['rk_bm_bmpm']       = $rk_bm_bmpm;
            $data['rk_bm_bmgb']       = $rk_bm_bmgb;
            $data['rk_bm_bmjji']       = $rk_bm_bmjji;
            $data['rk_bm_bmatl']       = $rk_bm_bmatl;
            $data['rk_btt']       = $rk_btt;
            $data['rk_bt_bbh']       = $rk_bt_bbh;
            $data['rk_bt_bbk']       = $rk_bt_bbk;

            $data['rk_total']       = $rk_total;
            @$data['persen_rk_total']       = $rk_total == 0 ? 0: round(($rk_total / $pagu_total) * 100, 2);

            @$data['persen_rk_bo']       = $rk_total == 0 ? 0: round(($rk_bo / $pagu_total) * 100, 2);
            @$data['persen_rk_bm']       = $rk_total == 0 ? 0: round(($rk_bm / $pagu_total) * 100, 2);
            @$data['persen_rk_btt']       = $rk_total == 0 ? 0: round(($rk_btt / $pagu_total) * 100, 2);
            @$data['persen_rk_bt']       = $rk_total == 0 ? 0: round(($rk_bt / $pagu_total) * 100, 2);

            @$data['persen_rk_bo_bp']       = $rk_total == 0 ? 0: round(($rk_bo_bp / $pagu_total) * 100, 2);
            @$data['persen_rk_bo_bbj']       = $rk_total == 0 ? 0: round(($rk_bo_bbj / $pagu_total) * 100, 2);
            @$data['persen_rk_bo_bs']       = $rk_total == 0 ? 0: round(($rk_bo_bs / $pagu_total) * 100, 2);
            @$data['persen_rk_bo_bh']       = $rk_total == 0 ? 0: round(($rk_bo_bh / $pagu_total) * 100, 2);
            @$data['persen_rk_bm_bmt']       = $rk_total == 0 ? 0: round(($rk_bm_bmt / $pagu_total) * 100, 2);
            @$data['persen_rk_bm_bmpm']       = $rk_total == 0 ? 0: round(($rk_bm_bmpm / $pagu_total) * 100, 2);
            @$data['persen_rk_bm_bmgb']       = $rk_total == 0 ? 0: round(($rk_bm_bmgb / $pagu_total) * 100, 2);
            @$data['persen_rk_bm_bmjji']       = $rk_total == 0 ? 0: round(($rk_bm_bmjji / $pagu_total) * 100, 2);
            @$data['persen_rk_bm_bmatl']       = $rk_total == 0 ? 0: round(($rk_bm_bmatl / $pagu_total) * 100, 2);
            @$data['persen_rk_btt']       = $rk_total == 0 ? 0: round(($rk_btt / $pagu_total) * 100, 2);
            @$data['persen_rk_bt_bbh']       = $rk_total == 0 ? 0: round(($rk_bt_bbh / $pagu_total) * 100, 2);
            @$data['persen_rk_bt_bbk']       = $rk_total == 0 ? 0: round(($rk_bt_bbk / $pagu_total) * 100, 2);




        $bulan              = bulan_aktif();
        $filter                 = 'semua';
        $realisasi              = 'tidak_ada';
        // $tahap              = $tahap;
        // $tahun              = $tahun;
        $nomenklatur                = 'baru';//$this->input->get('nomenklatur');
        $kategori_penampilan_laporan    = 'perengkingan_dengan_deviasi';

        $kategori               = 'Akumulasi';
        $perhitungan                = 'Akuntansi';//$this->input->get('perhitungan');
        $cara_hitung = $perhitungan ;



        $skpd = $this->ratarata_fisik_keuangan->skpd($filter, $bulan, $realisasi, $nomenklatur, $cara_hitung, $kategori)->result();
        $skpd_terurut = [];

        $fisik_tertinggi = [];
        $fisik_terendah = [];
        $keuangan_tertinggi = [];
        $keuangan_terendah = [];
        $deviasi_keu_tertinggi = [];
        $deviasi_keu_terendah = [];
        foreach ($skpd as $k => $v) { 
            $dev_fisik =  $v->realisasi_fisik - $v->target_fisik;//$v->deviasi_fisik;
            $dev_keuangan = $v->deviasi_keuangan;

            if ($dev_fisik <-10) {
              $warna_peringatan_dev_fisik = 'background: #f8b2b2'; 
            }
            elseif ($dev_fisik <-5  && $dev_fisik >=-10) {
              $warna_peringatan_dev_fisik = 'background: #fcf3cf';
            }
            elseif ($dev_fisik <=0  && $dev_fisik >=-5) {
              $warna_peringatan_dev_fisik = 'background: #d5f5e3';
            }else{
              $warna_peringatan_dev_fisik = 'background: #ff7cfd';
            }

            if ($dev_keuangan <-10) {
              $warna_peringatan_dev_keu = 'background: #f8b2b2'; 
            }
            elseif ($dev_keuangan <-5  && $dev_keuangan >=-10) {
              $warna_peringatan_dev_keu = 'background: #fcf3cf';
            }
            elseif ($dev_keuangan <=0  && $dev_keuangan >=-5) {
              $warna_peringatan_dev_keu = 'background: #d5f5e3';
            }else{
              $warna_peringatan_dev_keu = 'background: #ff7cfd';
            }
            if ($kategori=='Akumulasi') {
                $rp_target_keuangan = $v->rp_target_keuangan_akumulasi;
                $rp_realisasi_keuangan = $v->rp_realisasi_keuangan_akumulasi;
            }else{
                $rp_target_keuangan = $v->rp_target_keuangan_bulanan;
                $rp_realisasi_keuangan = $v->rp_realisasi_keuangan_bulanan;
            }

            $capaian_fisik = $v->realisasi_fisik == '' ? 0 : ( $v->target_fisik == 0 ? INF : ($v->realisasi_fisik / $v->target_fisik * 100) );
            $capaian_keuangan = $v->realisasi_keuangan == '' ? 0 : ( $v->target_keuangan == 0 ? INF : ($v->realisasi_keuangan / $v->target_keuangan * 100) );


             if ($v->realisasi_fisik<$v->realisasi_keuangan) {
              $blok_rf = 'style="background: #ebdef0  "';
            }else{
              $blok_rf = '';
            }
             if ($v->target_fisik<$v->target_keuangan) {
              $blok_tf = 'style="background: #ebdef0  "';
            }else{
              $blok_tf = '';
            }


            $data_rfk = [
                'nama_instansi' => $v->nama_instansi,
                'pagu_total' => $v->pagu_total,
                'rp_realisasi_keuangan' => $rp_realisasi_keuangan,
                'rp_target_keuangan' => $rp_target_keuangan ,
                'last_update' => $v->last_update    ,
                'tf' => $v->target_fisik == '' ? 0 : $v->target_fisik,
                'rf' => $v->realisasi_fisik == '' ? 0 : $v->realisasi_fisik,
                'cf' => round($capaian_fisik,2),
                'df' => $dev_fisik == '' ? 0 : $dev_fisik,
                'blok_tf' => $blok_tf,
                'wf' => $warna_peringatan_dev_fisik,
                'tk' => $v->target_keuangan == '' ? 0 : $v->target_keuangan,
                'rk' => $v->realisasi_keuangan == '' ? 0 : $v->realisasi_keuangan,
                'dk' => $dev_keuangan == '' ? 0 : $dev_keuangan,
                'ck' => round($capaian_keuangan,2),
                'blok_rf' => $blok_rf,
                'wk' => $warna_peringatan_dev_keu,
            ];
            array_push($skpd_terurut, $data_rfk);

            $fisik_tertinggi[$k] = [
                'rf' => $v->realisasi_fisik == '' ? 0 : $v->realisasi_fisik,
                'nama_instansi' => $v->nama_instansi,

                'last_update' => $v->last_update    ,
            ];

            $fisik_terendah[$k] = [
                'rf' => $v->realisasi_fisik == '' ? 0 : $v->realisasi_fisik,
                'nama_instansi' => $v->nama_instansi,

                'last_update' => $v->last_update    ,
            ];

            $keuangan_tertinggi[$k] = [
                'rk' => $v->realisasi_keuangan == '' ? 0 : $v->realisasi_keuangan,
                'nama_instansi' => $v->nama_instansi,

                'last_update' => $v->last_update    ,
            ];

            $keuangan_terendah[$k] = [
                'rk' => $v->realisasi_keuangan == '' ? 0 : $v->realisasi_keuangan,
                'nama_instansi' => $v->nama_instansi,

                'last_update' => $v->last_update    ,
            ];

            $deviasi_keu_tertinggi[$k] = [
                'dk' => $dev_keuangan == '' ? 0 : $dev_keuangan,
                'nama_instansi' => $v->nama_instansi,

                'last_update' => $v->last_update    ,
            ];

            $deviasi_keu_terendah[$k] = [
                'dk' => $dev_keuangan == '' ? 0 : $dev_keuangan,
                'nama_instansi' => $v->nama_instansi,

                'last_update' => $v->last_update    ,
            ];

            // echo $dev_fisik." - ".$warna_peringatan_dev_fisik.'<br>';
        }


array_multisort($fisik_tertinggi, SORT_DESC);
array_multisort($fisik_terendah, SORT_ASC);
array_multisort($keuangan_tertinggi, SORT_DESC);
array_multisort($keuangan_terendah, SORT_ASC);

array_multisort($deviasi_keu_tertinggi, SORT_ASC);
array_multisort($deviasi_keu_terendah, SORT_DESC);

            

            $data['skpd']    = $skpd_terurut;
            $data['fisik_tertinggi']    = $fisik_tertinggi;
            $data['fisik_terendah']    = $fisik_terendah;
            $data['keuangan_tertinggi']    = $keuangan_tertinggi;
            $data['keuangan_terendah']    = $keuangan_terendah;
            $data['deviasi_keu_tertinggi']    = $deviasi_keu_tertinggi;
            $data['deviasi_keu_terendah']    = $deviasi_keu_terendah;



            $data['class']    = $class;
            $data['method']    = $method;

            $data['extra_css']    = $this->load->view('beranda/css', $data, true);
            $data['modal']    = $this->load->view('beranda/modal', $data, true);
            $data['extra_js']    = $this->load->view('beranda/js', $data, true);
            $this->template->load('homepage', $page, $data);
        
    }


      public function show_chart($result = '')
    {
        if ($this->session->userdata('id_group')==5) {
            $id_instansi = id_instansi();
        }else{
            $id_instansi = $this->input->get('id_instansi');
        }
        $level = $this->input->get('id_group');
        $kategori = $this->input->get('kategori');
        $tahun = tahun_anggaran();
        $tahap = tahapan_apbd();
        $bulan_aktif = bulan_aktif();
        $fisik   = [];
        $r_fisik = [];
        $d_fisik = [];
        $keu     = [];
        $rea     = [];
        $d_keu     = [];
            if ($kategori=='Akumulasi') {
                 $sync    = $this->dashboard_model->get_grafik_total_akumulasi($tahun, $tahap)->result();
            }else{
                 $sync    = $this->dashboard_model->get_grafik_total_bulanan($tahun, $tahap)->result();
            }

            foreach ($sync as $key => $value) {
                $fisik[$key]   = (float) round($value->target_fisik,2 ) ;
                $keu[$key]     = (float) round($value->target_keuangan,2 ) ;

                if($bulan_aktif>=$value->bulan){

                    $r_fisik[$key] = (float) round($value->realisasi_fisik,2 ) ;
                    $d_fisik[$key]     =round( (float) round($value->realisasi_fisik,2 ) -  (float) round($value->target_fisik,2 ) ,2 ) ;

                    $rea[$key]     = (float) round($value->realisasi_keuangan,2 ) ;
                    $d_keu[$key]     = round( (float) round($value->realisasi_keuangan,2 ) -  (float) round($value->target_keuangan,2 ) ,2) ;
                }else{
                    $r_fisik[$key]= "" ;
                    $d_fisik[$key]    = "" ;

                    $rea[$key]    = "" ;
                    $d_keu[$key]    = "" ;
                }
            }





         


        $output = [];
        $output['fisik'] = $fisik;
        $output['keu']   = $keu;
        $output['r_fis'] = $r_fisik;
        $output['r_keu'] = $rea;
        $output['d_keu'] = $d_keu;
        $output['d_fisik'] = $d_fisik;
        $output['bulan_laporan'] = bulan_aktif();

        if ($result == '') :
            echo json_encode($output);
        else :
            return $output;
        endif;
    }
    public function statistika()
    {
        $tgls= date('Y-m-d');
           $data['title']        = "Statistika - Simbangda Based Evidence";

            $data['description']                = "Statistika User Hari Ini";
            $q_visit = $this->db->query("SELECT 
                v.last_hits, v.last_login, v.last_logout, v.keterangan, v.online,v.id_group, v.modules,
                mg.group_name, 
                mi.nama_instansi, mu.full_name
             from visitor v
                left join master_users mu on v.id_user = mu.id_user
                left join master_instansi mi on v.id_instansi = mi.id_instansi
                left join master_group mg on v.id_group = mg.id_group
                where v.date='$tgls'
                order by online desc
                ")->result_array();

            $q_module = $this->db->query("SELECT  module_name,module_description  from master_modules ")->result_array();
            $kumpul_modul = [];
            foreach ($q_module as $k => $v) {
                $kumpul_modul[$v['module_name']] = $v['module_description'];
            }

            $page                 = 'beranda/statistika';
            $class = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $data['visit']    = $q_visit;
            $data['modul']    = $kumpul_modul;
            $data['extra_css']    = $this->load->view('beranda/css', $data, true);
            $data['extra_js']    = $this->load->view('beranda/js', $data, true);
            $data['class']    = $class;
            $data['method']    = $method;
            $this->template->load('homepage', $page, $data);
        
    }

    public function detail_kab_kota(){
        $id_kota = $this->input->post('id_kota');
        $bulan = bulan_aktif();
        $q = $this->db->query("SELECT * from master_instansi_kab_kota where id_kota='$id_kota'")->result_array();
        $kumpul_instansi = [];
        foreach($q as $k =>$v){
            // query pagu
            $id_instansi = $v['id_instansi'];
            $q_pagu = $this->db->query("SELECT * from anggaran_instansi_kab_kota where id_instansi='$id_instansi' and tahun='2025' and kode_tahap='2'")->row_array();

            $total_bo_pagu = $q_pagu['bo_bp'] + $q_pagu['bo_bbj'] + $q_pagu['bo_bs'] + $q_pagu['bo_bh'] + $q_pagu['bo_bbs'];
            $total_bm_pagu = $q_pagu['bm_bmt'] + $q_pagu['bm_bmpm'] + $q_pagu['bm_bmgb'] + $q_pagu['bm_bmjji'] + $q_pagu['bm_bmatl'] + $q_pagu['bm_bmatb'];
            $total_bt_pagu = $q_pagu['bt_bbh'] + $q_pagu['bt_bbk'];
            $total_pagu = $total_bo_pagu + $total_bm_pagu + $total_bt_pagu + $q_pagu['btt'];
            

            // query realisasi
            $q_realisasi = $this->db->query("SELECT sum(bo_bp) as bo_bp, sum(bo_bbj) as bo_bbj, sum(bo_bs) as bo_bs, sum(bo_bh) as bo_bh, sum(bo_bbs) as bo_bbs, sum(bm_bmt) as bm_bmt, sum(bm_bmpm) as bm_bmpm, sum(bm_bmgb) as bm_bmgp, sum(bm_bmjji) as bm_bmjji, sum(bm_bmatl) as bm_bmatl, sum(bm_bmatb) as bm_bmatb, sum(bt_bbh) as bt_bbh, sum(bt_bbk) as bt_bbk , sum(btt) as btt from realisasi_fisik_keuangan_kab_kota where id_instansi='$id_instansi' and tahun='2025' and kode_tahap='2' and bulan<='$bulan'");
            $data_realisasi = $q_realisasi->row_array();
            if ($q_realisasi->num_rows()==0) {
            $total_bo_realisasi =  0;//$data_realisasi['bo_bp'] + $data_realisasi['bo_bbj'] + $data_realisasi['bo_bs'] + $data_realisasi['bo_bh'] + $data_realisasi['bo_bbs'];
            $total_bm_realisasi =  0;//$data_realisasi['bm_bmt'] + $data_realisasi['bm_bmpm'] + $data_realisasi['bm_bmgb'] + $data_realisasi['bm_bmjji'] + $data_realisasi['bm_bmatl'] + $data_realisasi['bm_bmatb'];
            $total_bt_realisasi =  0;//$data_realisasi['bt_bbh'] + $data_realisasi['bt_bbk'];
            $total_realisasi = 0;// $total_bo_realisasi + $total_bm_realisasi + $total_bt_realisasi + $data_realisasi['btt'];
                # code...
            }else{

            $total_bo_realisasi =  $data_realisasi['bo_bp'] + $data_realisasi['bo_bbj'] + $data_realisasi['bo_bs'] + $data_realisasi['bo_bh'] + $data_realisasi['bo_bbs'];
            $total_bm_realisasi =  $data_realisasi['bm_bmt'] + $data_realisasi['bm_bmpm'] + $data_realisasi['bm_bmgb'] + $data_realisasi['bm_bmjji'] + $data_realisasi['bm_bmatl'] + $data_realisasi['bm_bmatb'];
            $total_bt_realisasi =  $data_realisasi['bt_bbh'] + $data_realisasi['bt_bbk'];
            $total_realisasi =  $total_bo_realisasi + $total_bm_realisasi + $total_bt_realisasi + $data_realisasi['btt'];
            }

            $data = [
                'skpd' =>$v['nama_instansi'],
                'pagu' =>[
                    // 'bo_bp'=>$q_pagu['bo_bp'],
                    'bo_pagu_total'=>$total_bo_pagu,
                    'bm_pagu_total'=>$total_bm_pagu,
                    'btt_pagu'=>$q_pagu['btt'],
                    'bt_pagu_total'=>$total_bt_pagu,
                    'pagu_total' => $total_pagu,
                    'bm'=>['tanah'=>888, 'aset'=>[
                        'tetap'=>1111,
                        'nontetap'=>6666
                    ]],
                ],
                'realisasi'=>[
                    'bo_realisasi_total'=>$total_bo_realisasi,
                    'bm_realisasi_total'=>$total_bm_realisasi,
                    'btt_realisasi'=>$q_realisasi['btt'],
                    'bt_realisasi_total'=>$total_bt_realisasi,
                    'realisasi_total' => $total_realisasi,
                ]
            ];
            array_push($kumpul_instansi, $data);

        }
        $data = ['tes'=>1,'tes_2'=>2];
        $output = ['cek'=>$id_kota, 'data'=>$kumpul_instansi, 'realisasi'=>$q];
        echo json_encode($output);
    }


   
}