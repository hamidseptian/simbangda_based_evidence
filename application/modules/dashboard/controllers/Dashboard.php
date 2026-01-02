<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Dashboard.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'dashboard/dashboard_model'       => 'dashboard_model',
            'program_apbd/program_apbd_model' => 'program_apbd_model'
        ]);
    }

    public function simulasi()
    {
        $t_fisik    = $this->show_chart('a')['fisik'];
        $t_keuangan = $this->show_chart('a')['keu'];
        $r_fisik    = $this->show_chart('a')['r_fis'];
        $r_keu      = $this->show_chart('a')['r_keu'];

        $tes['xAxis']['categories'] = [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec"
        ];

        $tes['title']['text'] = 'Tahun 2020';
        $tes['yAxis']['title']['text'] = 'Persentase %';
        $tes['yAxis']['min'] = 0;
        $tes['yAxis']['max'] = 100;
        $tes['yAxis']['tickInterval'] = 10;

        $tes['plotOptions']['line']['dataLabels']['enabled'] = true;

        foreach ($t_fisik as $key => $value) {
            $tes['series'][0]['data'][] = $value;
            $tes['series'][0]['name'] = "Target Fisik";
        }

        foreach ($t_keuangan as $key => $value) {
            $tes['series'][1]['data'][] = $value;
            $tes['series'][1]['name'] = "Target Keuangan";
        }

        foreach ($r_fisik as $key => $value) {
            $tes['series'][2]['data'][] = $value;
            $tes['series'][2]['name'] = "Realisasi Fisik";
        }

        foreach ($r_keu as $key => $value) {
            $tes['series'][3]['data'][] = $value;
            $tes['series'][3]['name'] = "Realisasi Keuangan";
        }

        echo json_encode($tes);
    }

    public function index()
    {
        if ($this->session->userdata('id_group')==7) {
            $this->dashboard_kab_kota();
        }else{
            $breadcrumbs    = $this->breadcrumbs;
            $dashboard      = $this->dashboard_model;
            $program_apbd   = $this->program_apbd_model;

            $breadcrumbs->add('Home', base_url());
            $breadcrumbs->add('Dashboard', base_url());
            $breadcrumbs->render();

            $data['title']                      = "Dashboard";
            $data['icon']                       = "pe-7s-home";
            $data['description']                = "Menampilkan informasi umum tentang Realisasi Fisik dan Keuangan";
            $data['breadcrumbs']                = $breadcrumbs->render();
            $data['total_users']                = $dashboard->total_users();
            $id_instansi = id_instansi();











            $q = $this->db->query("SELECT 
                    mi.nama_instansi,
                    mi.id_config as id_config_instansi,
                    mi.kode_tahap ,
                    c.id_config,
                    c.tahun_anggaran,
                    c.tahapan_apbd,
                    c.bulan_aktif,
                    c.jadwal_input_data_dasar_awal,
                    c.jadwal_input_data_dasar_akhir,
                    c.tgl_input_rfk_mulai,
                    c.tgl_input_rfk_akhir,
                    c.tgl_validasi_rfk_mulai,
                    c.tgl_validasi_rfk_akhir,
                    c.penginputan,
                    c.status
             from master_instansi mi 
                left join config c on mi.id_config = c.id_config
                where mi.id_instansi='$id_instansi'")->row_array();
            $data['config']           = $q;




            $q_pengumuman = $this->db->query("SELECT * from pengumuman order by id_pengumuman desc");
            $data['jumlah_pengumuman'] = $q_pengumuman->num_rows();
            $data['data_pengumuman'] = $q_pengumuman->row();
            $level = $this->session->userdata('id_group');
            $tahap = tahapan_apbd();
            $tahun = tahun_anggaran();
            $id_instansi = id_instansi();
            if ($level==2) {
                $pagu = $dashboard->pagu_total($tahap)->row();
                $rk = $dashboard->rk_total($tahap)->row();
            }else{
                $pagu = $dashboard->pagu($id_instansi, $tahap, $tahun)->row();
                $rk = $dashboard->rk($id_instansi, $tahap, $tahun)->row();
            }
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
    /*        $data['anggaran_apbd']              = $program_apbd->anggaran_apbd();
            $data['total_program_apbd']         = $program_apbd->total_program_apbd();
            $data['belanja_pegawai_prog']       = $program_apbd->belanja_pegawai_prog();
            $data['belanja_barang_jasa_prog']   = $program_apbd->belanja_barang_jasa_prog();
            $data['belanja_modal_prog']         = $program_apbd->belanja_modal_prog();
            $data['persentase_bp_prog']         = $data['anggaran_apbd'] != 0 ? ROUND(($data['belanja_pegawai_prog'] / $data['anggaran_apbd']) * 100, 2) : 0;
            $data['persentase_bbj_prog']        = $data['anggaran_apbd'] != 0 ? ROUND(($data['belanja_barang_jasa_prog'] / $data['anggaran_apbd']) * 100, 2) : 0;
            $data['persentase_bm_prog']         = $data['anggaran_apbd'] != 0 ? ROUND(($data['belanja_modal_prog'] / $data['anggaran_apbd']) * 100, 2) : 0;*/
            $page                               = 'dashboard/index';
            $data['link']                       = $this->router->fetch_class();
            $data['menu']                       = $this->load->view('layout/menu', $data, true);
            $data['extra_css']                  = $this->load->view('dashboard/css', $data, true);
            $data['extra_js']                   = $this->load->view('dashboard/js', $data, true);
            $data['extra_js2']                   = $this->load->view('informasi/pengumuman/js', $data, true);
            $data['modal']                      = $this->load->view('informasi/pengumuman/modal', $data, true);;
            $this->template->load('backend_template', $page, $data);
        }
    }



    public function dashboard_kab_kota()
    {
        $breadcrumbs    = $this->breadcrumbs;
        $dashboard      = $this->dashboard_model;
        $program_apbd   = $this->program_apbd_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Dashboard', base_url());
        $breadcrumbs->render();

        $data['title']                      = "Dashboard";
        $data['icon']                       = "pe-7s-home";
        $data['description']                = "Menampilkan informasi umum tentang Realisasi Fisik dan Keuangan";
        $data['breadcrumbs']                = $breadcrumbs->render();
        $data['total_users']                = $dashboard->total_users();

        $q_pengumuman = $this->db->query("SELECT * from pengumuman order by id_pengumuman desc");
        $data['jumlah_pengumuman'] = $q_pengumuman->num_rows();
        $data['data_pengumuman'] = $q_pengumuman->row();
        $level = $this->session->userdata('id_group');
        $id_kota = $this->session->userdata('id_kota');
        $nama_tahap = [2=>'APBD AWAL', 4=>'APBD PERUBAHAN'];
        $tahap = config_kab_kota()->tahapan_apbd;

            $pagu = $dashboard->pagu_kab_kota($id_kota,$tahap)->row();

        $bo = $pagu->pagu_bo;
        $bm = $pagu->pagu_bm;
        $btt = $pagu->pagu_btt;
        $bt = $pagu->pagu_bt;
        $pagu_total = $pagu->total == '' ? 0 : $pagu->total;
        $data['bo']       = $bo;
        $data['bm']       = $bm;
        $data['btt']       = $btt;
        $data['bt']       = $bt;
        $data['anggaran_apbd']       = $pagu_total;
        @$data['persen_bo']       = round(($bo / $pagu_total) * 100, 2);
        @$data['persen_bm']       = round(($bm / $pagu_total) * 100, 2);
        @$data['persen_btt']       = round(($btt / $pagu_total) * 100, 2);
        @$data['persen_bt']       = round(($bt / $pagu_total) * 100, 2);

/*        $data['anggaran_apbd']              = $program_apbd->anggaran_apbd();
        $data['total_program_apbd']         = $program_apbd->total_program_apbd();
        $data['belanja_pegawai_prog']       = $program_apbd->belanja_pegawai_prog();
        $data['belanja_barang_jasa_prog']   = $program_apbd->belanja_barang_jasa_prog();
        $data['belanja_modal_prog']         = $program_apbd->belanja_modal_prog();
        $data['persentase_bp_prog']         = $data['anggaran_apbd'] != 0 ? ROUND(($data['belanja_pegawai_prog'] / $data['anggaran_apbd']) * 100, 2) : 0;
        $data['persentase_bbj_prog']        = $data['anggaran_apbd'] != 0 ? ROUND(($data['belanja_barang_jasa_prog'] / $data['anggaran_apbd']) * 100, 2) : 0;
        $data['persentase_bm_prog']         = $data['anggaran_apbd'] != 0 ? ROUND(($data['belanja_modal_prog'] / $data['anggaran_apbd']) * 100, 2) : 0;*/
        $page                               = 'dashboard/dashboard_kab_kota/index';
        $data['bulan_aktif']             = config_kab_kota()->bulan_aktif;;
        $data['nama_tahap_apbd']             = $nama_tahap[$tahap];
        $data['link']                       = $this->router->fetch_class();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                  = $this->load->view('dashboard/dashboard_kab_kota/css', $data, true);
        $data['extra_js']                   = $this->load->view('dashboard/dashboard_kab_kota/js', $data, true);
        $data['extra_js2']                   = $this->load->view('informasi/pengumuman/js', $data, true);
        $data['modal']                      = $this->load->view('informasi/pengumuman/modal', $data, true);;
        $this->template->load('backend_template', $page, $data);
    }



    public function my_profile()
    {
        if ($this->session->userdata('id_group')==7) {
           $this->my_profile_kab_kota();
        }else{

        $breadcrumbs    = $this->breadcrumbs;
        $dashboard      = $this->dashboard_model;
        $program_apbd   = $this->program_apbd_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('My Profile', base_url());
        $breadcrumbs->render();

        $data['title']                      = "My Profile";
        $data['icon']                       = "pe-7s-home";
        $data['description']                = "Menampilkan Identitas User";
        $data['breadcrumbs']                = $breadcrumbs->render();
        $data['data_user']                  = $dashboard->detail_user(id_user())->row();
        $page                               = 'dashboard/my_profile';
        $data['link']                       = $this->router->fetch_class();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                  = $this->load->view('dashboard/css', $data, true);
        $data['extra_js']                   = $this->load->view('dashboard/js_edit_akun', $data, true);
        $data['modal']                      = $this->load->view('dashboard/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
        }
    }
    public function my_profile_kab_kota()
    {
      

        $breadcrumbs    = $this->breadcrumbs;
        $dashboard      = $this->dashboard_model;
        $program_apbd   = $this->program_apbd_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('My Profile', base_url());
        $breadcrumbs->render();

        $data['title']                      = "My Profile";
        $data['icon']                       = "pe-7s-home";
        $data['description']                = "Menampilkan Identitas User";
        $data['breadcrumbs']                = $breadcrumbs->render();
        $data['data_user']                  = $dashboard->detail_user(id_user())->row();
        $page                               = 'dashboard/my_profile_kab_kota';
        $data['link']                       = $this->router->fetch_class();
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                  = $this->load->view('dashboard/css', $data, true);
        $data['extra_js']                   = $this->load->view('dashboard/js', $data, true);
        $data['modal']                      = $this->load->view('dashboard/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
        
    }


    public function tutorial()
    {
        $breadcrumbs    = $this->breadcrumbs;
        $dashboard      = $this->dashboard_model;
        $program_apbd   = $this->program_apbd_model;

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('My Profile', base_url());
        $breadcrumbs->render();

        $data['title']                      = "Tutorial Simbangda Based Evidence V4";
        $data['icon']                       = "pe-7s-home";
        $data['description']                = "Menampilkan cara penggunaan aplikasi Simbangda Base Evidence";
        $data['link']                       = $this->router->fetch_class();
        $data['breadcrumbs']                = $breadcrumbs->render();



        $primary_folder     = 'sbe_files_support/';
            $directory          = [
                'tutorial'
            ];
            $list_directory     = $this->sbe_directory($primary_folder, $directory);
        $group = $this->session->userdata('id_group');
        if ($group==2) {
            $link                 = base_url().'sbe_files_support/tutorial/Manual Book Simbangda Base Evidence 2021_Akses Administrator.pdf';
            # code...
        }
        elseif ($group==4) {
            $link                 = base_url().'sbe_files_support/tutorial/Manual Book Simbangda Base Evidence 2021_Akses Helpdesk.pdf';
            # code...
        }
        else{
            $link                 = base_url().'sbe_files_support/tutorial/Manual Book Simbangda Base Evidence 2021_Akses Operator.pdf';
            
        }
        $data['file']                  = '<iframe src="'.$link.'" frameborder="1" width="100%" height="750px"></iframe>';
        $page                               = 'dashboard/tutorial';
        $data['menu']                       = $this->load->view('layout/menu', $data, true);
        $data['extra_css']                  = $this->load->view('dashboard/css', $data, true);
        $data['extra_js']                   = $this->load->view('dashboard/js', $data, true);
        $data['modal']                      = $this->load->view('dashboard/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    }


    public function rules_edit_password()
    {
        return [
           
            [
                'field' => 'pass_lama',
                'label' => 'Password Lama',
                'rules' => 'required'
            ],
            [
                'field' => 'pass_baru',
                'label' => 'Password',
                'rules' => 'required'
            ],
            [
                'field' => 'pass_confirm',
                'label' => 'Password Confirmation',
                'rules' => 'required|trim|matches[pass_baru]'
            ],

         
        ];
    }
    public function rules_edit_password_default()
    {
        return [
            [
                'field' => 'pass_baru',
                'label' => 'Password',
                'rules' => 'required'
            ],
            [
                'field' => 'pass_confirm',
                'label' => 'Password Confirmation',
                'rules' => 'required|trim|matches[pass_baru]'
            ],

         
        ];
    }
    public function rules_edit_user()
    {
        return [
           
            [
                'field' => 'full_name',
                'label' => 'Full Name',
                'rules' => 'required'
            ]
         
        ];
    }
    public function saveedit_password()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output    = [
                'success' => false,
                'messages' => []
            ];
       
            $validation     = $this->form_validation;
            $validation->set_rules($this->rules_edit_password());
            $validation->set_error_delimiters('<p class="text-danger">', '</p>');
            $id_user = id_user();



            if ($validation->run()) {
                
                $user = $this->db->query("SELECT password from master_users where id_user='$id_user'")->row();
                $cek_passlama = $user->password ; 
                $password_lama = $this->input->post('pass_lama');
                $password_baru = $this->input->post('pass_baru');
                $cocokan_password =  password_verify($password_lama, $cek_passlama);
                if ($cocokan_password) {
                    $data = [
                        'password' => password_hash($password_baru, PASSWORD_DEFAULT)
                    ];
                    $where = ['id_user'=>id_user()];
                    $this->db->update('master_users', $data, $where);
                    $output['success'] = true;
                    $output['messages'] = "Pasword Updated";
                }else{
                    $output['success'] = true;
                    $output['messages'] = "Password Lama Anda tidak cocok";
                }
                
            } else {
                $output['success'] = false;
                foreach ($_POST as $key => $value) {
                    $output['messages'][$key] = form_error($key);
                }
            }

            echo json_encode($output);
        }
    }

    public function saveedit_password_default()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output    = [
                'success' => false,
                'messages' => []
            ];
       
            $validation     = $this->form_validation;
            $validation->set_rules($this->rules_edit_password_default());
            $validation->set_error_delimiters('<p class="text-danger">', '</p>');
         



            if ($validation->run()) {
                
                $password_baru = $this->input->post('pass_baru');
                
                
                    $data = [
                        'pass_default' => password_hash($password_baru, PASSWORD_DEFAULT)
                    ];
                
                    $this->db->update('izin_konfigurasi', $data);
                    $output['success'] = true;
                    $output['messages'] = "Pasword Updated";
              
                
            } else {
                $output['success'] = false;
                foreach ($_POST as $key => $value) {
                    $output['messages'][$key] = form_error($key);
                }
            }
                   

            echo json_encode($output);
        }
    }


public function saveedit_user()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output    = [
                'success' => false,
                'messages' => []
            ];
       
            $validation     = $this->form_validation;
            $validation->set_rules($this->rules_edit_user());
            $validation->set_error_delimiters('<p class="text-danger">', '</p>');
            $id_user = id_user();



            if ($validation->run()) {
                
                
                $where = ['id_user'=>id_user()];
                $update = ['full_name'=>$this->input->post('full_name'), 'nohp'=>$this->input->post('nohp')];
                $this->db->update('master_users', $update, $where);
                
                $output['success'] = true;
            } else {
                $output['success'] = false;
                foreach ($_POST as $key => $value) {
                    $output['messages'][$key] = form_error($key);
                }
            }

            echo json_encode($output);
        }
    }

    public function show_chart($result = '')
    {
        if ($this->session->userdata('id_group')==5) {
            $id_instansi = id_instansi();
        }else{
            $id_instansi = $this->input->get('id_instansi');
        }

        $nama_instansi = nama_instansi($id_instansi);
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
        if ($level==2 || $level==4 || $level==6) {
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





         
        } else {
            if ($kategori=='Akumulasi') {
                $sync    = $this->dashboard_model->get_grafik_akumulasi($id_instansi, $tahun, $tahap)->result();
            }else{
                $sync    = $this->dashboard_model->get_grafik_bulanan($id_instansi, $tahun, $tahap)->result();
            }



            foreach ($sync as $key => $value) {
                
                $fisik[$key]   = (float) round($value->target_fisik,2 ) ;
                $keu[$key]     = (float) round($value->target_keuangan,2 ) ;
                if($bulan_aktif>=$value->bulan){

                    $r_fisik[$key] = (float) round($value->realisasi_fisik,2 ) ;
                    $d_fisik[$key]     = round( (float) round($value->realisasi_fisik,2 ) -  (float) round($value->target_fisik,2 ) ,2) ;

                    $rea[$key]     = (float) round($value->realisasi_keuangan,2 ) ;
                    $d_keu[$key]     =round( (float) round($value->realisasi_keuangan,2 ) -  (float) round($value->target_keuangan,2 ) ,2) ;
                }else{
                    $r_fisik[$key]= "" ;
                    $d_fisik[$key]    = "" ;

                    $rea[$key]    = "" ;
                    $d_keu[$key]    = "" ;
                }
            }




            // $fisik[] = (float) $sync->tf_jan;
            // $fisik[] = (float) $sync->tf_feb;
            // $fisik[] = (float) $sync->tf_mar;
            // $fisik[] = (float) $sync->tf_apr;
            // $fisik[] = (float) $sync->tf_mei;
            // $fisik[] = (float) $sync->tf_jun;
            // $fisik[] = (float) $sync->tf_jul;
            // $fisik[] = (float) $sync->tf_agu;
            // $fisik[] = (float) $sync->tf_sep;
            // $fisik[] = (float) $sync->tf_okt;
            // $fisik[] = (float) $sync->tf_nov;
            // $fisik[] = (float) $sync->tf_des;

            // $keu[] = (float) $sync->tk_jan;
            // $keu[] = (float) $sync->tk_feb;
            // $keu[] = (float) $sync->tk_mar;
            // $keu[] = (float) $sync->tk_apr;
            // $keu[] = (float) $sync->tk_mei;
            // $keu[] = (float) $sync->tk_jun;
            // $keu[] = (float) $sync->tk_jul;
            // $keu[] = (float) $sync->tk_agu;
            // $keu[] = (float) $sync->tk_sep;
            // $keu[] = (float) $sync->tk_okt;
            // $keu[] = (float) $sync->tk_nov;
            // $keu[] = (float) $sync->tk_des;

            // $r_fisik[] = (float) $sync->rf_jan > 0 ? (float) $sync->rf_jan : 0;
            // $r_fisik[] = (float) $sync->rf_feb > 0 ? (float) $sync->rf_feb : 0;
            // $r_fisik[] = (float) $sync->rf_mar > 0 ? (float) $sync->rf_mar : 0;
            // $r_fisik[] = (float) $sync->rf_apr > 0 ? (float) $sync->rf_apr : 0;
            // $r_fisik[] = (float) $sync->rf_mei > 0 ? (float) $sync->rf_mei : 0;
            // $r_fisik[] = (float) $sync->rf_jun > 0 ? (float) $sync->rf_jun : 0;
            // $r_fisik[] = (float) $sync->rf_jul > 0 ? (float) $sync->rf_jul : 0;
            // $r_fisik[] = (float) $sync->rf_agu > 0 ? (float) $sync->rf_agu : 0;
            // $r_fisik[] = (float) $sync->rf_sep > 0 ? (float) $sync->rf_sep : 0;
            // $r_fisik[] = (float) $sync->rf_okt > 0 ? (float) $sync->rf_okt : 0;
            // $r_fisik[] = (float) $sync->rf_nov > 0 ? (float) $sync->rf_nov : 0;
            // $r_fisik[] = (float) $sync->rf_des > 0 ? ((float) $sync->rf_des > 100 ? 100 : (float) $sync->rf_des) : '';

            // $rea[] = (float) $sync->rk_jan > 0 ? (float) $sync->rk_jan : 0;
            // $rea[] = (float) $sync->rk_feb > 0 ? (float) $sync->rk_feb : $rea[0];
            // $rea[] = (float) $sync->rk_mar > 0 ? (float) $sync->rk_mar : $rea[1];
            // $rea[] = (float) $sync->rk_apr > 0 ? (float) $sync->rk_apr : $rea[2];
            // $rea[] = (float) $sync->rk_mei > 0 ? (float) $sync->rk_mei : $rea[3];
            // $rea[] = (float) $sync->rk_jun > 0 ? (float) $sync->rk_jun : $rea[4];
            // $rea[] = (float) $sync->rk_jul > 0 ? (float) $sync->rk_jul : $rea[5];
            // $rea[] = (float) $sync->rk_agu > 0 ? (float) $sync->rk_agu : $rea[6];
            // $rea[] = (float) $sync->rk_sep > 0 ? (float) $sync->rk_sep : $rea[7];
            // $rea[] = (float) $sync->rk_okt > 0 ? (float) $sync->rk_okt : $rea[8];
            // $rea[] = (float) $sync->rk_nov > 0 ? (float) $sync->rk_nov : $rea[9];
            // $rea[] = (float) $sync->rk_des > 0 ? (float) $sync->rk_des : $rea[10];
        }

        $output = [];
        $output['fisik'] = $fisik;
        $output['keu']   = $keu;
        $output['r_fis'] = $r_fisik;
        $output['r_keu'] = $rea;
        $output['d_keu'] = $d_keu;
        $output['d_fisik'] = $d_fisik;
        $output['bulan_laporan'] = bulan_aktif();
        $output['opd'] = $nama_instansi;
        $output['tahapan_apbd'] = pilihan_nama_tahapan($tahap).' '.$tahun;

        if ($result == '') :
            echo json_encode($output);
        else :
            return $output;
        endif;
    }
    public function show_chart_2_tahun_terakhir($result = '')
    {
        if ($this->session->userdata('id_group')==5) {
            $id_instansi = id_instansi();
        }else{
            $id_instansi = $this->input->get('id_instansi');
        }

        $nama_instansi = nama_instansi($id_instansi);
        $level = $this->input->get('id_group');
        $kategori = $this->input->get('kategori');
        $tahun = tahun_anggaran();
        $tahun_sebelumnya = $tahun -1;
        $tahap = tahapan_apbd();
        $tahap_sebelumnya = 4;
        $bulan_aktif = bulan_aktif();
        $fisik   = [];
        $r_fisik = [];
        $d_fisik = [];
        $keu     = [];
        $rea     = [];
        $d_keu     = [];

        $fisik_sebelumnya   = [];
        $r_fisik_sebelumnya = [];
        $d_fisik_sebelumnya = [];
        $keu_sebelumnya     = [];
        $rea_sebelumnya     = [];
        $d_keu_sebelumnya     = [];



        if ($level==2 || $level==4 || $level==6) {
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





         
        }else{ 
            if ($kategori=='Akumulasi') {
                $sync    = $this->dashboard_model->get_grafik_akumulasi($id_instansi, $tahun, $tahap)->result();
                $sync_sebelumnya    = $this->dashboard_model->get_grafik_akumulasi($id_instansi, $tahun_sebelumnya, $tahap_sebelumnya)->result();
            }else{
                $sync    = $this->dashboard_model->get_grafik_bulanan($id_instansi, $tahun, $tahap)->result();
                $sync_sebelumnya    = $this->dashboard_model->get_grafik_bulanan($id_instansi, $tahun_sebelumnya, $tahap_sebelumnya)->result();
            }



            foreach ($sync as $key => $value) {
                
                $fisik[$key]   = (float) round($value->target_fisik,2 ) ;
                $keu[$key]     = (float) round($value->target_keuangan,2 ) ;
                if($bulan_aktif>=$value->bulan){

                    $r_fisik[$key] = (float) round($value->realisasi_fisik,2 ) ;
                    $d_fisik[$key]     = round( (float) round($value->realisasi_fisik,2 ) -  (float) round($value->target_fisik,2 ) ,2) ;

                    $rea[$key]     = (float) round($value->realisasi_keuangan,2 ) ;
                    $d_keu[$key]     =round( (float) round($value->realisasi_keuangan,2 ) -  (float) round($value->target_keuangan,2 ) ,2) ;
                }else{
                    $r_fisik[$key]= "" ;
                    $d_fisik[$key]    = "" ;

                    $rea[$key]    = "" ;
                    $d_keu[$key]    = "" ;
                }
            }



            foreach ($sync_sebelumnya as $key => $value) {
                
                $fisik_sebelumnya[$key]   = (float) round($value->target_fisik,2 ) ;
                $keu_sebelumnya[$key]     = (float) round($value->target_keuangan,2 ) ;
                // if($bulan_aktif>=$value->bulan){

                    $r_fisik_sebelumnya[$key] = (float) round($value->realisasi_fisik,2 ) ;
                    $d_fisik_sebelumnya[$key]     = round( (float) round($value->realisasi_fisik,2 ) -  (float) round($value->target_fisik,2 ) ,2) ;

                    $rea_sebelumnya[$key]     = (float) round($value->realisasi_keuangan,2 ) ;
                    $d_keu_sebelumnya[$key]     =round( (float) round($value->realisasi_keuangan,2 ) -  (float) round($value->target_keuangan,2 ) ,2) ;
                // }else{
                //     $r_fisik_sebelumnya[$key]= "" ;
                //     $d_fisik_sebelumnya[$key]    = "" ;

                //     $rea_sebelumnya[$key]    = "" ;
                //     $d_keu_sebelumnya[$key]    = "" ;
                // }
            }




            // $fisik[] = (float) $sync->tf_jan;
            // $fisik[] = (float) $sync->tf_feb;
            // $fisik[] = (float) $sync->tf_mar;
            // $fisik[] = (float) $sync->tf_apr;
            // $fisik[] = (float) $sync->tf_mei;
            // $fisik[] = (float) $sync->tf_jun;
            // $fisik[] = (float) $sync->tf_jul;
            // $fisik[] = (float) $sync->tf_agu;
            // $fisik[] = (float) $sync->tf_sep;
            // $fisik[] = (float) $sync->tf_okt;
            // $fisik[] = (float) $sync->tf_nov;
            // $fisik[] = (float) $sync->tf_des;

            // $keu[] = (float) $sync->tk_jan;
            // $keu[] = (float) $sync->tk_feb;
            // $keu[] = (float) $sync->tk_mar;
            // $keu[] = (float) $sync->tk_apr;
            // $keu[] = (float) $sync->tk_mei;
            // $keu[] = (float) $sync->tk_jun;
            // $keu[] = (float) $sync->tk_jul;
            // $keu[] = (float) $sync->tk_agu;
            // $keu[] = (float) $sync->tk_sep;
            // $keu[] = (float) $sync->tk_okt;
            // $keu[] = (float) $sync->tk_nov;
            // $keu[] = (float) $sync->tk_des;

            // $r_fisik[] = (float) $sync->rf_jan > 0 ? (float) $sync->rf_jan : 0;
            // $r_fisik[] = (float) $sync->rf_feb > 0 ? (float) $sync->rf_feb : 0;
            // $r_fisik[] = (float) $sync->rf_mar > 0 ? (float) $sync->rf_mar : 0;
            // $r_fisik[] = (float) $sync->rf_apr > 0 ? (float) $sync->rf_apr : 0;
            // $r_fisik[] = (float) $sync->rf_mei > 0 ? (float) $sync->rf_mei : 0;
            // $r_fisik[] = (float) $sync->rf_jun > 0 ? (float) $sync->rf_jun : 0;
            // $r_fisik[] = (float) $sync->rf_jul > 0 ? (float) $sync->rf_jul : 0;
            // $r_fisik[] = (float) $sync->rf_agu > 0 ? (float) $sync->rf_agu : 0;
            // $r_fisik[] = (float) $sync->rf_sep > 0 ? (float) $sync->rf_sep : 0;
            // $r_fisik[] = (float) $sync->rf_okt > 0 ? (float) $sync->rf_okt : 0;
            // $r_fisik[] = (float) $sync->rf_nov > 0 ? (float) $sync->rf_nov : 0;
            // $r_fisik[] = (float) $sync->rf_des > 0 ? ((float) $sync->rf_des > 100 ? 100 : (float) $sync->rf_des) : '';

            // $rea[] = (float) $sync->rk_jan > 0 ? (float) $sync->rk_jan : 0;
            // $rea[] = (float) $sync->rk_feb > 0 ? (float) $sync->rk_feb : $rea[0];
            // $rea[] = (float) $sync->rk_mar > 0 ? (float) $sync->rk_mar : $rea[1];
            // $rea[] = (float) $sync->rk_apr > 0 ? (float) $sync->rk_apr : $rea[2];
            // $rea[] = (float) $sync->rk_mei > 0 ? (float) $sync->rk_mei : $rea[3];
            // $rea[] = (float) $sync->rk_jun > 0 ? (float) $sync->rk_jun : $rea[4];
            // $rea[] = (float) $sync->rk_jul > 0 ? (float) $sync->rk_jul : $rea[5];
            // $rea[] = (float) $sync->rk_agu > 0 ? (float) $sync->rk_agu : $rea[6];
            // $rea[] = (float) $sync->rk_sep > 0 ? (float) $sync->rk_sep : $rea[7];
            // $rea[] = (float) $sync->rk_okt > 0 ? (float) $sync->rk_okt : $rea[8];
            // $rea[] = (float) $sync->rk_nov > 0 ? (float) $sync->rk_nov : $rea[9];
            // $rea[] = (float) $sync->rk_des > 0 ? (float) $sync->rk_des : $rea[10];
        }

        $output = [];
        $output['tahun_ini'] = $tahun;
        $output['tahun_sebelumnya'] = $tahun_sebelumnya;
        $output['fisik'] = $fisik;
        $output['keu']   = $keu;
        $output['r_fis'] = $r_fisik;
        $output['r_keu'] = $rea;
        $output['d_keu'] = $d_keu;
        $output['d_fisik'] = $d_fisik;

        $output['fisik_sebelumnya'] = $fisik_sebelumnya;
        $output['keu_sebelumnya']   = $keu_sebelumnya;
        $output['r_fis_sebelumnya'] = $r_fisik_sebelumnya;
        $output['r_keu_sebelumnya'] = $rea_sebelumnya;
        $output['d_keu_sebelumnya'] = $d_keu_sebelumnya;
        $output['d_fisik_sebelumnya'] = $d_fisik_sebelumnya;


        $output['bulan_laporan'] = bulan_aktif();
        $output['opd'] = $nama_instansi;
        $output['tahapan_apbd'] = pilihan_nama_tahapan($tahap).' '.$tahun;

        if ($result == '') :
            echo json_encode($output);
        else :
            return $output;
        endif;
    }
    public function show_chart_2_tahun_terakhir_asisten($result = '')
    {
        if ($this->session->userdata('id_group')==5) {
            $id_instansi = id_instansi();
        }else{
            $id_instansi = $this->input->get('id_instansi');
        }

        $nama_instansi = nama_instansi($id_instansi);
        $level = $this->input->get('id_group');
        $kategori = $this->input->get('kategori');
        $tahun = tahun_anggaran();
        $tahun_sebelumnya = $tahun -1;
        $tahap = tahapan_apbd();
        $tahap_sebelumnya = 4;
        $bulan_aktif = bulan_aktif();
        $fisik   = [];
        $r_fisik = [];
        $d_fisik = [];
        $keu     = [];
        $rea     = [];
        $d_keu     = [];

        $fisik_sebelumnya   = [];
        $r_fisik_sebelumnya = [];
        $d_fisik_sebelumnya = [];
        $keu_sebelumnya     = [];
        $rea_sebelumnya     = [];
        $d_keu_sebelumnya     = [];
        $asisten = $this->input->get('asisten');


            if ($kategori=='Akumulasi') {
                 $sync    = $this->dashboard_model->get_grafik_total_akumulasi($tahun, $tahap, $asisten)->result();
                 $sync_sebelumnya    = $this->dashboard_model->get_grafik_total_akumulasi($tahun_sebelumnya, $tahap_sebelumnya, $asisten)->result();
            }else{
                 $sync    = $this->dashboard_model->get_grafik_total_bulanan($tahun, $tahap)->result();
                 $sync_sebelumnya    = $this->dashboard_model->get_grafik_total_bulanan($tahun_sebelumnya, $tahap_sebelumnya)->result();
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

            foreach ($sync_sebelumnya as $key => $value) {
                $fisik_sebelumnya[$key]   = (float) round($value->target_fisik,2 ) ;
                $keu_belumnya[$key]     = (float) round($value->target_keuangan,2 ) ;


                    $r_fisik_sebelumnya[$key] = (float) round($value->realisasi_fisik,2 ) ;
                    $d_fisik_sebelumnya[$key]     =round( (float) round($value->realisasi_fisik,2 ) -  (float) round($value->target_fisik,2 ) ,2 ) ;

                    $rea_sebelumnya[$key]     = (float) round($value->realisasi_keuangan,2 ) ;
                    $d_keu_sebelumnya[$key]     = round( (float) round($value->realisasi_keuangan,2 ) -  (float) round($value->target_keuangan,2 ) ,2) ;
              
            }






        $output = [];
        $output['tahun_ini'] = $tahun;
        $output['tahun_sebelumnya'] = $tahun_sebelumnya;
        // $output['fisik'] = $fisik;
        // $output['keu']   = $keu;
        // $output['r_fis'] = $r_fisik;
        // $output['r_keu'] = $rea;
        // $output['d_keu'] = $d_keu;
        // $output['d_fisik'] = $d_fisik;

        // $output['fisik_sebelumnya'] = $fisik_sebelumnya;
        // $output['keu_sebelumnya']   = $keu_sebelumnya;
        // $output['r_fis_sebelumnya'] = $r_fisik_sebelumnya;
        // $output['r_keu_sebelumnya'] = $rea_sebelumnya   ;
        // $output['d_keu_sebelumnya'] = $d_keu_sebelumnya;
        // $output['d_fisik_sebelumnya'] = $d_fisik_sebelumnya;


        if ($asisten==1) {
            
            $output['r_fis'] = [4.07, 13.74, 30, 36.06, 44.19, 49.99,60.31, '','','','','', ];
            $output['r_keu'] = [2.79,6.34, 14.46, 18.56, 24.33,33.84,  43.43, '','','','','', ];
            $output['r_fis_sebelumnya'] = [3.02, 11.81,15.07,17.5, 35.19, 43.68,49.89,62.82, 68.94 , 71.63,82.46, 98.15];
            $output['r_keu_sebelumnya'] = [0.85, 5.54,10.63, 17.18, 24.65,35.15, 41.66,54.39, 59.74, 65.46, 79.93,94.59];
        }
        elseif ($asisten==2) {
            $output['r_fis'] = [2.3, 7.21, 11.88, 23.26, 30.4, 38.09,43.2, '','','','','', ];
            $output['r_keu'] = [0.95,2.95,10.94, 15.56, 21.29, 29.6, 37.24, '','','','','',];
            $output['r_fis_sebelumnya'] = [1.73, 6.23, 12.73, 20.19, 28.53,36.72,44.59, 52.46, 59.68, 67.23, 76.26, 99.13];
            $output['r_keu_sebelumnya'] = [0.76,3.35, 7.98, 14.78,21.39,29.41, 36.5, 46.04, 53.6, 62.74, 74.59, 93.16];
            # code...
        }elseif ($asisten==3) {
            $output['r_fis'] = [0.59, 3.87, 5.55,8.7,37.69, 52.23,55.54, '','','','','', ];
            $output['r_keu'] = [0.43, 2.2, 4.31,7.03,17.63,28.66, 31.97, '','','','','',];
            $output['r_fis_sebelumnya'] = [0.59, 3.08, 5.25, 8.57, 51.35,55.45,58.8, 60.66, 74.88, 77.15, 91.89, 99.96];
            $output['r_keu_sebelumnya'] = [0.32, 1.63,3.4, 7.19,25.47,27.93, 37.01, 43.5, 46.24, 53.44,75.64, 88.82];

        }else{
            $output['r_fis'] = $r_fisik;
            $output['r_keu'] = $rea;
            $output['r_fis_sebelumnya'] = $r_fisik_sebelumnya;
            $output['r_keu_sebelumnya'] = $rea_sebelumnya   ;
        }


        $output['bulan_laporan'] = bulan_aktif();
        $output['opd'] = $nama_instansi;
        $output['tahapan_apbd'] = pilihan_nama_tahapan($tahap).' '.$tahun;

        if ($result == '') :
            echo json_encode($output);
        else :
            return $output;
        endif;
    }
}
