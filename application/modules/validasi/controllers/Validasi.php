<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Validasi.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Validasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'validasi/validasi_fisik_model' => 'validasi_fisik_model',
            'datatables_model'              => 'datatables_model'
        ]);
        $this->load->library('encryption');
        $this->load->library('minio_client');
    }

    public function fisik()
    {
        $breadcrumbs    = $this->breadcrumbs;
        $validasi_fisik = $this->validasi_fisik_model;
        $tahun = tahun_anggaran();

        $breadcrumbs->add('Home', base_url());
        $breadcrumbs->add('Validasi', base_url($this->router->fetch_class()));
        $breadcrumbs->add('Fisik', base_url());
        $breadcrumbs->render();

        $data['title']                 = "Validasi Fisik";
        $data['icon']                  = "metismenu-icon fa fa-check-square";
        $data['description']           = "Validasi Fisik";
        $data['breadcrumbs']           = $breadcrumbs->render();
        $data['config']                = $this->db->get('config')->result_array();
        $page                          = 'validasi/fisik/index';
        $id_group = $this->session->userdata('id_group');
            $id_user = id_user();
        if ($id_group==5) {
            $id_instansi = id_instansi();
              $q = $this->db->query("SELECT hi.id_instansi, hi.id_user from helpdesk_instansi hi 
                where hi.id_instansi = '$id_instansi' order by id_helpdesk_instansi asc limit 1")->row_array();
            $id_helpdesk = $q['id_user'];


            $q_instansi = $this->db->query("SELECT mi.nama_instansi, hi.id_instansi, hi.utama as id_helpdesk_utama from helpdesk_instansi hi 
                left join master_instansi mi on hi.id_instansi = mi.id_instansi
                where hi.id_instansi = '$id_instansi' order by id_helpdesk_instansi asc")->result_array();

        }
        elseif ($id_group==4) {
            $q = $this->db->query("SELECT hi.id_instansi, hi.id_user from helpdesk_instansi hi 
                left join master_instansi mi on hi.id_instansi = mi.id_instansi
                where hi.id_user = '$id_user' order by id_helpdesk_instansi asc limit 1")->row_array();
            $id_instansi = $q['id_instansi'];
            $id_helpdesk = $q['id_user'];



            $q_instansi = $this->db->query("SELECT mi.nama_instansi, hi.id_instansi, mu.full_name, hi.id_user as id_helpdesk_utama, hi.utama,

            evidence_belum_validasi_per_skpd(mi.id_instansi, $tahun) AS evidence_belum_validasi, evidence_ditolak_per_skpd(mi.id_instansi) AS evidence_ditolak
             from helpdesk_instansi hi 
                left join master_instansi mi on hi.id_instansi = mi.id_instansi
                left join master_users mu on hi.id_user = mu.id_user
                where hi.id_user = '$id_user' order by id_helpdesk_instansi asc")->result_array();


        }else{
            $q = $this->db->query("SELECT mi.id_instansi, hi.id_user from master_instansi mi left join helpdesk_instansi hi on mi.id_instansi = hi.id_instansi where mi.is_active = '1' and mi.kategori='OPD' order by mi.nama_instansi asc limit 1")->row_array();
            $id_instansi = $q['id_instansi'];
            $id_helpdesk = $q['id_user'];


            $q_instansi = $this->db->query("SELECT mi.nama_instansi, mi.id_instansi,  hi.id_user as id_helpdesk_utama, hi.utama,
            evidence_belum_validasi_per_skpd(mi.id_instansi, $tahun) AS evidence_belum_validasi, evidence_ditolak_per_skpd(mi.id_instansi) AS evidence_ditolak
             from  master_instansi mi 
             left join helpdesk_instansi hi on mi.id_instansi = hi.id_instansi and hi.utama='1'
                where mi.kategori = 'OPD' and mi.is_active='1' order by nama_instansi asc")->result_array();


        }
        $data['link']                  = $this->router->fetch_method();
        $data['id_group']                  = $id_group;
        $data['q_instansi']                  = $q_instansi;
        $data['id_instansi']                  = sbe_crypt($id_instansi, 'E');
        $data['id_helpdesk']                  = sbe_crypt($id_helpdesk, 'E');
        $data['total_paket']           = $validasi_fisik->total_paket_pekerjaan();
        $data['total_paket_rutin']     = $validasi_fisik->total_paket_rutin();
        $data['total_paket_swakelola'] = $validasi_fisik->total_paket_swakelola();
        $data['total_paket_penyedia']  = $validasi_fisik->total_paket_penyedia();
        $data['menu']                  = $this->load->view('layout/menu', $data, true);
        $data['extra_css']             = $this->load->view('validasi/fisik/css', $data, true);
        $data['extra_js']              = $this->load->view('validasi/fisik/js', $data, true);
        $data['modal']                 = $this->load->view('validasi/fisik/modal', $data, true);
        $this->template->load('backend_template', $page, $data);
    }


   
    public function dt_list_skpd()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $id_group = $this->session->userdata('id_group');
            $id_user = id_user();
            if ($id_group==2) {
                $where          = ['kategori'=>'OPD', 'is_active'=>1];
                $column_order   = ['', 'nama_instansi'];
                $column_search  = ['nama_instansi', 'is_active'=>1];
                $order          = ['nama_instansi' => 'ASC'];
                $tabel = 'v_instansi';
            }  else{
                $where          = ['id_user'=>$id_user];
                $column_order   = ['', 'nama_instansi'];
                $column_search  = ['nama_instansi'];
                $order          = ['nama_instansi' => 'ASC'];
                $tabel = 'v_helpdesk_instansi';
            }          
            $list           = $this->datatables_model->get_datatables($tabel, $column_order, $column_search, $order, $where);
            $data           = [];
            $no             = $_POST['start'];
            $status = ['Tidak Aktif','Aktif'];
            foreach ($list as $lists) {
                $no++;
               
                $row    = [];
                $row[]     = $no;
                $row[]  = $lists->nama_instansi;
                $row[]  = $lists->helpdesk;
                $row[]  = $lists->evidence_belum_validasi;
                $row[]  = $lists->evidence_ditolak ;
      
                $tombol = '<button class="btn btn-outline-info btn-xs"  title="Pilih SKPD'.$lists->nama_instansi.'"  onclick="tetapkan_skpd('."'".sbe_crypt($lists->id_instansi, 'E')."','".sbe_crypt($lists->id_user, 'E')."'".')"><i class="fas fa-check"></i></button>';
                $row[]  = $tombol;


                $data[] = $row;
            }

            $output = [
                "draw"              => $_POST['draw'],
                "recordsTotal"      => $this->datatables_model->count_all($tabel, $where),
                "recordsFiltered"   => $this->datatables_model->count_filtered($tabel, $column_order, $column_search, $order, $where),
                "data"              => $data,
            ];

            echo json_encode($output);
        }
    }

    public function get_instansi()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'  => false,
                'data'    => [],
                'message' => ''
            ];

            if ($this->sbe_group_name() == 'OPERATOR') {
                $instansi = $this->validasi_fisik_model->get_instansi_by_id();
            } elseif ($this->sbe_group_name() == 'HELPDESK') {
                $instansi = $this->validasi_fisik_model->get_instansi();
            } elseif ($this->sbe_group_name() == 'ADMIN') {
                $instansi = $this->validasi_fisik_model->get_all_instansi();
            }

            $output['banyak_skpd'] = $instansi->num_rows();
            if ($instansi->num_rows() > 0) {
                foreach ($instansi->result() as $key => $value) {
                    $output['data'][$key]['id_instansi']        = sbe_crypt($value->id_instansi, 'E');
                    $output['data'][$key]['nama_instansi']      = $value->nama_instansi;
                    $output['data'][$key]['is_active']      = $value->is_active;
                    // $output['data'][$key]['jml_paket']          = 'Total evidence belum di periksa';
                    // $output['data'][$key]['approve']          = 'Total evidence di approve';
                    // $output['data'][$key]['reject']          = 'Total evidence di reject';
                    // $output['data'][$key]['total_evidence_diupload']          = 'Total evidence di upload';
                    $output['data'][$key]['belum_validasi']     = $value->belum_validasi;
                    $output['data'][$key]['belum_validasi_swa'] = $value->belum_validasi_swakelola;
                    $output['data'][$key]['belum_validasi_pen'] = $value->belum_validasi_penyedia;
                }

                $output['status'] = true;
            }

            echo json_encode($output);
        }
    }

    public function dt_paket_rutin()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $tahun = $this->input->post('tahun');
            $id_instansi    = sbe_crypt($this->input->post('id_instansi'), 'D');
            if (tahapan_apbd()==4) {
                $where          = "id_instansi='$id_instansi' and tahun='$tahun' and status='1' and kode_rekening_sub_kegiatan  in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and status='1')";//array('id_instansi' => $id_instansi, 'tahun'=>$tahun, 'status'=>1);
                # code...
            }else{

                $where          = "id_instansi='$id_instansi' and tahun='$tahun' and status='1' and kode_rekening_sub_kegiatan  in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and kode_tahap='2')";//array('id_instansi' => $id_instansi, 'tahun'=>$tahun, 'status'=>1);
                // $where          = array('id_instansi' => $id_instansi, 'tahun'=>$tahun, 'kode_tahap'=>2);

            }
            $column_order   = array('', 'nama_paket');
            $column_search  = array('nama_paket','nilai');
            $order = array('nama_paket' => 'ASC');
            $list = $this->datatables_model->get_datatables('v_paket_rutin', $column_order, $column_search, $order, $where);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $lists) {
                $no++;
                $id_paket =  $lists->id_paket_pekerjaan;
                $nilai_paket = $this->validasi_fisik_model->nilai_paket($id_paket)->totalnilai > 0 ? $this->validasi_fisik_model->nilai_paket($id_paket)->totalnilai : 0;
                $diperiksa = $this->db->query("SELECT id_realisasi_fisik from realisasi_fisik where id_paket_pekerjaan='$id_paket' and status in ('Sudah Validasi', 'Ditolak')")->num_rows();
                $banyak_evidence = $this->db->query("SELECT id_realisasi_fisik from realisasi_fisik where id_paket_pekerjaan='$id_paket'")->num_rows();

                $row   = array();
                $row[] = $no;

                $warna_tombol = $banyak_evidence == 0 ? 'btn-outline-info' :$this->validasi_fisik_model->get_status_validasi_paket($lists->id_instansi, $lists->id_paket_pekerjaan, $lists->dok);


                $tombol_action = '<button class="btn ' . $warna_tombol . ' btn-sm view_evidence_'.$id_paket.'" id="detail-realisasi-fisik" status="collapse" id-instansi="' . $lists->id_instansi . '" id-paket-pekerjaan="' . $lists->id_paket_pekerjaan . '" nama-kpa="' . $this->validasi_fisik_model->get_kpa($lists->id_sub_instansi)['full_name'] . '" nama-pptk="' . $lists->full_name . '" nama-program="' . $this->validasi_fisik_model->get_program_kegiatan($lists->kode_rekening_sub_kegiatan)['nama_program'] . '" nama-kegiatan="' . $this->validasi_fisik_model->get_program_kegiatan($lists->kode_rekening_sub_kegiatan)['nama_kegiatan'] . '" vol="' . $this->vol($lists->id_paket_pekerjaan) . '" banyak_evidence="'.$banyak_evidence.'" nama_paket="'.$lists->nama_paket.'"><i class="fa fa-plus"></i></button>';

                $tombol_open = '<button class="btn ' . $warna_tombol . ' btn-sm" onclick="identitas_paket('.$id_paket.')"><i class="fa fa-folder-open"></i></button>';

                $kode_sub_kegiatan = $lists->kode_rekening_sub_kegiatan;
                $pecah = explode('.', $kode_sub_kegiatan);
                $krsk = $pecah[0].'.'.$pecah[1].'.'.$pecah[2].'.'.$pecah[3].'.'.$pecah[4].'.'.$pecah[5];
                
                $q_ski = $this->db->query("SELECT * from sub_kegiatan_instansi where kode_sub_kegiatan='$kode_sub_kegiatan' and id_instansi='$id_instansi'")->row_array();

                $uptd  = $q_ski['kategori']=='Sub Kegiatan SKPD' ? '' : '<br>'.$q_ski['jenis_sub_kegiatan'].' - '.$q_ski['keterangan'];
                
               
                $row[] = $lists->nama_paket;
                $row[] = $lists->beban_dokumen_diupload;
                $row[] = $lists->evidence_diupload;
                $row[] = $lists->beban_dokumen_diupload - $lists->evidence_diupload;
                $row[] = $lists->belum_validasi;
                $row[] = $lists->nilai==''? 0 : round($lists->nilai,2);
                $row[] = $tombol_open;

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->datatables_model->count_all('v_paket_swakelola', $where),
                "recordsFiltered" => $this->datatables_model->count_filtered('v_paket_swakelola', $column_order, $column_search, $order, $where),
                "data" => $data,
            );

            echo json_encode($output);
        }
    }

    public function dt_paket_swakelola()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $tahun = $this->input->post('tahun');
            $id_instansi    = sbe_crypt($this->input->post('id_instansi'), 'D');
            if (tahapan_apbd()==4) {
                $where          = "id_instansi='$id_instansi' and tahun='$tahun' and status='1' and kode_rekening_sub_kegiatan  in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and status='1')";//array('id_instansi' => $id_instansi, 'tahun'=>$tahun, 'status'=>1);
                # code...
            }else{

                $where          = "id_instansi='$id_instansi' and tahun='$tahun' and status='1' and kode_rekening_sub_kegiatan  in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and kode_tahap='2')";//array('id_instansi' => $id_instansi, 'tahun'=>$tahun, 'status'=>1);
                // $where          = array('id_instansi' => $id_instansi, 'tahun'=>$tahun, 'kode_tahap'=>2);

            }
            $tahap    =tahapan_apbd();
            $list_ski = list_sub_kegiatan_opd($id_instansi, $tahun, $tahap);
            $column_order   = array('', 'nama_paket');
            $column_search  = array('nama_paket','nilai', 'kode_rekening_sub_kegiatan');
            $order = array('nama_paket' => 'ASC');
            $list = $this->datatables_model->get_datatables('v_paket_swakelola', $column_order, $column_search, $order, $where);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $lists) {
                $no++;
                $id_paket =  $lists->id_paket_pekerjaan;
                $nilai_paket = $this->validasi_fisik_model->nilai_paket($id_paket)->totalnilai > 0 ? $this->validasi_fisik_model->nilai_paket($id_paket)->totalnilai : 0;
                $diperiksa = $this->db->query("SELECT id_realisasi_fisik from realisasi_fisik where id_paket_pekerjaan='$id_paket' and status in ('Sudah Validasi', 'Ditolak')")->num_rows();
                $banyak_evidence = $this->db->query("SELECT id_realisasi_fisik from realisasi_fisik where id_paket_pekerjaan='$id_paket'")->num_rows();

                $row   = array();
                $row[] = $no;

                $warna_tombol = $banyak_evidence == 0 ? 'btn-outline-info' :$this->validasi_fisik_model->get_status_validasi_paket($lists->id_instansi, $lists->id_paket_pekerjaan, $lists->dok);


                $tombol_action = '<button class="btn ' . $warna_tombol . ' btn-sm view_evidence_'.$id_paket.'" id="detail-realisasi-fisik" status="collapse" id-instansi="' . $lists->id_instansi . '" id-paket-pekerjaan="' . $lists->id_paket_pekerjaan . '" nama-kpa="' . $this->validasi_fisik_model->get_kpa($lists->id_sub_instansi)['full_name'] . '" nama-pptk="' . $lists->full_name . '" nama-program="' . $this->validasi_fisik_model->get_program_kegiatan($lists->kode_rekening_sub_kegiatan)['nama_program'] . '" nama-kegiatan="' . $this->validasi_fisik_model->get_program_kegiatan($lists->kode_rekening_sub_kegiatan)['nama_kegiatan'] . '" vol="' . $this->vol($lists->id_paket_pekerjaan) . '" banyak_evidence="'.$banyak_evidence.'" nama_paket="'.$lists->nama_paket.'"><i class="fa fa-plus"></i></button>';

                $tombol_open = '<button class="btn ' . $warna_tombol . ' btn-sm" onclick="identitas_paket('.$id_paket.')"><i class="fa fa-folder-open"></i></button>';



                $row[] = $lists->kode_rekening_sub_kegiatan.'<br>'.$list_ski[$lists->kode_rekening_sub_kegiatan];
               
                $row[] = $lists->nama_paket;
                $row[] = $lists->beban_dokumen_diupload;
                $row[] = $lists->evidence_diupload;
                $row[] = $lists->beban_dokumen_diupload - $lists->evidence_diupload;
                $row[] = $lists->belum_validasi;
                $row[] = $lists->nilai==''? 0 : round($lists->nilai,2);
                $row[] = $tombol_open;

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->datatables_model->count_all('v_paket_swakelola', $where),
                "recordsFiltered" => $this->datatables_model->count_filtered('v_paket_swakelola', $column_order, $column_search, $order, $where),
                "data" => $data,
            );

            echo json_encode($output);
        }
    }

    public function dt_paket_belum_validasi()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $tahun    = $this->input->post('tahun');
            $tahap    =tahapan_apbd();
            $id_helpdesk    = sbe_crypt($this->input->post('id_helpdesk'), 'D');
            $id_instansi    = sbe_crypt($this->input->post('id_instansi'), 'D');
            $where          = array('id_instansi' => $id_instansi, 'belum_validasi > '=>0, 'tahun'=>$tahun);
            $column_order   = array('', 'nama_paket');
            $column_search  = array('nama_paket','nilai','belum_validasi','kode_rekening_sub_kegiatan');
            $order = array('nama_paket' => 'ASC');
            $list = $this->datatables_model->get_datatables('v_paket', $column_order, $column_search, $order, $where);
            $data = array();
            $no = $_POST['start'];

            $list_ski = list_sub_kegiatan_opd($id_instansi, $tahun, $tahap);
            foreach ($list as $lists) {
                $no++;
                $id_paket =  $lists->id_paket_pekerjaan;
                $nilai_paket = $this->validasi_fisik_model->nilai_paket($id_paket)->totalnilai > 0 ? $this->validasi_fisik_model->nilai_paket($id_paket)->totalnilai : 0;

                $row   = array();
                $row[] = $no;
                $tombol_open = '<button class="btn btn-outline-warning btn-sm" onclick="identitas_paket('.$id_paket.')"><i class="fa fa-folder-open"></i></button>';

               
                $row[] = $lists->kode_rekening_sub_kegiatan.'<br>'.$list_ski[$lists->kode_rekening_sub_kegiatan];
                $row[] = $lists->nama_paket;
                $row[] = $lists->jenis_paket;
                $row[] = $lists->belum_validasi;
                $row[] = $lists->nilai==''? 0 : round($lists->nilai,2);
                $row[] = $tombol_open;

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->datatables_model->count_all('v_paket', $where),
                "recordsFiltered" => $this->datatables_model->count_filtered('v_paket', $column_order, $column_search, $order, $where),
                "data" => $data,
            );

            echo json_encode($output);
        }
    }





    public function dt_paket_belum_validasi_perbantuan()
    {
        $data = [];
         $no             = $_POST['start'];

            $id_helpdesk    = sbe_crypt($this->input->post('id_user'), 'D');
            $tahun = $this->input->post('tahun');
            // echo $id_helpdesk.'<hr>';
         $start = $no;
         $length             = $_POST['length'];
         $key = $_POST['search']['value'];
         // untuk order by
         $order = $_POST['order'];
         $col =0; 
         $dir = "";
         if (!empty($order)) {
             foreach ($order as $o) {
                 $col = $o['column'];
                 $dir = $o['dir'];
             }
         }

         if ($dir!='asc' && $dir!='desc') {
             $dir='desc';
         }
         $valid_columns = [
            0=>'p.id_paket_pekerjaan',
            // 'tahun',
            // 'judul_file',
            // 'bagian',
            // 'publikasikan'
         ];

         if (!isset($valid_columns[$col])) {
             $order= null;
         }else{
            $order = $valid_columns[$col];
         }

         if ($order!=null) {
             $order_by = "order by $order $dir";
             # code...
         }else{
             $order_by = "";

         }
         // untuk order by
         if ($key) {
            $q = $this->db->query("SELECT distinct rfisik.id_paket_pekerjaan, p.nama_paket, p.jenis_paket, mi.nama_instansi, 
                total_nilai_evidence(p.id_paket_pekerjaan) AS nilai,evidence_belum_validasi(p.id_paket_pekerjaan) AS belum_validasi

             from realisasi_fisik rfisik 
             left join paket_pekerjaan p on rfisik.id_paket_pekerjaan = p.id_paket_pekerjaan
             left join master_instansi mi on rfisik.id_instansi = mi.id_instansi
             where rfisik.status='Belum Validasi' and rfisik.tahun='$tahun' and rfisik.id_helpdesk='$id_helpdesk' and p.nama_paket like '%$key%' limit $start, $length")->result_array();
         }else{
            $q = $this->db->query("SELECT distinct rfisik.id_paket_pekerjaan, p.nama_paket, p.jenis_paket, mi.nama_instansi, 
                total_nilai_evidence(p.id_paket_pekerjaan) AS nilai,evidence_belum_validasi(p.id_paket_pekerjaan) AS belum_validasi

             from realisasi_fisik rfisik 
             left join paket_pekerjaan p on rfisik.id_paket_pekerjaan = p.id_paket_pekerjaan
             left join master_instansi mi on rfisik.id_instansi = mi.id_instansi
             where rfisik.status='Belum Validasi' and rfisik.tahun='$tahun' and rfisik.id_helpdesk='$id_helpdesk'  $order_by limit $start, $length ")->result_array();
         }
            $q_count = $this->db->query("SELECT id_paket_pekerjaan from realisasi_fisik where id_helpdesk='$id_helpdesk'  and tahun='$tahun' and status='Belum Validasi' group by id_paket_pekerjaan")->num_rows();
         $all_data = $q_count;

        foreach ($q as $k => $v) {
            $no++;
            $row    = [];
            $row[]  = $no;
            $row[]  = @$v['nama_instansi'];
            $row[]  = $v['nama_paket'];
            $row[]  = $v['jenis_paket'];
            $row[]  = $v['belum_validasi'];
            $row[]  = $v['nilai'] == '' ? 0 : round($v['nilai'],2);
        

           $tombol_open = '<button class="btn btn-outline-warning btn-sm" onclick="identitas_paket('.$v['id_paket_pekerjaan'].')"><i class="fa fa-folder-open"></i></button>';
            $row[]  = $tombol_open;






                $data[] = $row;
        }
           
           
            $output = [
                        "draw"              => $_POST['draw'],
                        "recordsTotal"      => $all_data,
                        "recordsFiltered"   => $all_data,
                        "data"              => $data,
                      ];

            echo json_encode($output);
        
    }






    public function dt_paket_evidence_ditolak()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $tahun    = $this->input->post('tahun');
            $id_instansi    = sbe_crypt($this->input->post('id_instansi'), 'D');
            $where          = array('id_instansi' => $id_instansi, 'ditolak > '=>0, 'tahun'=>$tahun);
            $column_order   = array('', 'nama_paket');
            $column_search  = array('nama_paket','nilai','ditolak');
            $order = array('nama_paket' => 'ASC');
            $list = $this->datatables_model->get_datatables('v_paket', $column_order, $column_search, $order, $where);
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $lists) {
                $no++;
                $id_paket =  $lists->id_paket_pekerjaan;
                $nilai_paket = $this->validasi_fisik_model->nilai_paket($id_paket)->totalnilai > 0 ? $this->validasi_fisik_model->nilai_paket($id_paket)->totalnilai : 0;
                $diperiksa = $this->db->query("SELECT id_realisasi_fisik from realisasi_fisik where id_paket_pekerjaan='$id_paket' and status in ('Sudah Validasi', 'Ditolak')")->num_rows();
                $banyak_evidence = $this->db->query("SELECT id_realisasi_fisik from realisasi_fisik where id_paket_pekerjaan='$id_paket'")->num_rows();

                $row   = array();
                $row[] = $no;

              


            

                $tombol_open = '<button class="btn btn-outline-warning btn-sm" onclick="identitas_paket('.$id_paket.')"><i class="fa fa-folder-open"></i></button>';

                $kode_sub_kegiatan = $lists->kode_rekening_sub_kegiatan;
                $pecah = explode('.', $kode_sub_kegiatan);
                $krsk = $pecah[0].'.'.$pecah[1].'.'.$pecah[2].'.'.$pecah[3].'.'.$pecah[4].'.'.$pecah[5];
                
                $q_ski = $this->db->query("SELECT * from sub_kegiatan_instansi where kode_sub_kegiatan='$kode_sub_kegiatan' and id_instansi='$id_instansi'")->row_array();

                $uptd  = $q_ski['kategori']=='Sub Kegiatan SKPD' ? '' : '<br>'.$q_ski['jenis_sub_kegiatan'].' - '.$q_ski['keterangan'];
                
               
                $row[] = $lists->nama_paket;
                $row[] = $lists->jenis_paket;
                $row[] = $lists->ditolak;
                $row[] = $lists->nilai==''? 0 : round($lists->nilai,2);
                $row[] = $tombol_open;

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->datatables_model->count_all('v_paket', $where),
                "recordsFiltered" => $this->datatables_model->count_filtered('v_paket', $column_order, $column_search, $order, $where),
                "data" => $data,
            );

            echo json_encode($output);
        }
    }



    public function dt_paket_penyedia()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $tahun    = $this->input->post('tahun');
            $id_instansi    = sbe_crypt($this->input->post('id_instansi'), 'D');
             if (tahapan_apbd()==4) {
                 $where          = "id_instansi='$id_instansi' and tahun='$tahun' and status='1' and kode_rekening_sub_kegiatan  in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and status='1')";//array('id_instansi' => $id_instansi, 'tahun'=>$tahun, 'status'=>1);
            }else{
                 $where          = "id_instansi='$id_instansi' and tahun='$tahun' and status='1' and kode_rekening_sub_kegiatan  in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and kode_tahap='2')";//array('id_instansi' => $id_instansi, 'tahun'=>$tahun, 'status'=>1);
                // $where          = array('id_instansi' => $id_instansi, 'tahun'=>$tahun, 'kode_tahap'=>2);

            }
            
            $column_order   = array('', 'nama_paket');
            $column_search  = array('nama_paket','kode_rekening_sub_kegiatan');
            $order = array('nama_paket' => 'ASC');
            $list = $this->datatables_model->get_datatables('v_paket_penyedia', $column_order, $column_search, $order, $where);
            $data = array();
            $no = $_POST['start'];
            $tahap    =tahapan_apbd();
            $list_ski = list_sub_kegiatan_opd($id_instansi, $tahun, $tahap);

            foreach ($list as $lists) {
                $no++;
                $id_paket =  $lists->id_paket_pekerjaan;
                $nilai_paket = $this->validasi_fisik_model->nilai_paket($id_paket)->totalnilai > 0 ? $this->validasi_fisik_model->nilai_paket($id_paket)->totalnilai : 0;
                $diperiksa = $this->db->query("SELECT id_realisasi_fisik from realisasi_fisik where id_paket_pekerjaan='$id_paket' and status in ('Sudah Validasi', 'Ditolak')")->num_rows();
                $banyak_evidence = $this->db->query("SELECT id_realisasi_fisik from realisasi_fisik where id_paket_pekerjaan='$id_paket'")->num_rows();

                $row   = array();
                $row[] = $no;

                $warna_tombol = $banyak_evidence == 0 ? 'btn-outline-info' :$this->validasi_fisik_model->get_status_validasi_paket($lists->id_instansi, $lists->id_paket_pekerjaan, $lists->dok);


                $tombol_action = '<button class="btn ' . $warna_tombol . ' btn-sm view_evidence_'.$id_paket.'" id="detail-realisasi-fisik" status="collapse" id-instansi="' . $lists->id_instansi . '" id-paket-pekerjaan="' . $lists->id_paket_pekerjaan . '" nama-kpa="' . $this->validasi_fisik_model->get_kpa($lists->id_sub_instansi)['full_name'] . '" nama-pptk="' . $lists->full_name . '" nama-program="' . $this->validasi_fisik_model->get_program_kegiatan($lists->kode_rekening_sub_kegiatan)['nama_program'] . '" nama-kegiatan="' . $this->validasi_fisik_model->get_program_kegiatan($lists->kode_rekening_sub_kegiatan)['nama_kegiatan'] . '" vol="' . $this->vol($lists->id_paket_pekerjaan) . '" banyak_evidence="'.$banyak_evidence.'" nama_paket="'.$lists->nama_paket.'"><i class="fa fa-plus"></i></button>';

                $tombol_open = '<button class="btn ' . $warna_tombol . ' btn-sm" onclick="identitas_paket('.$id_paket.')"><i class="fa fa-folder-open"></i></button>';

 
               
                $row[] = $lists->kode_rekening_sub_kegiatan.'<br>'.$list_ski[$lists->kode_rekening_sub_kegiatan];
                $row[] = $lists->nama_paket;
                $row[] = $lists->beban_dokumen_diupload;
                $row[] = $lists->evidence_diupload;
                
                $row[] = $lists->beban_dokumen_diupload - $lists->evidence_diupload;
                $row[] = $lists->belum_validasi;
                $row[] = $lists->nilai==''? 0 : round($lists->nilai,2);
                $row[] = $tombol_open;

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->datatables_model->count_all('v_paket_penyedia', $where),
                "recordsFiltered" => $this->datatables_model->count_filtered('v_paket_penyedia', $column_order, $column_search, $order, $where),
                "data" => $data,
            );

            echo json_encode($output);
        }
    }


    public function statistika()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'    => false,
                'data'      => [],
                'message'   => ''
            ];
            $tahun = $this->input->post('tahun');
            $id_instansi        = sbe_crypt($this->input->post('id_instansi'), 'D') ;
            $value      = $this->validasi_fisik_model->statistika($id_instansi, $tahun)->row();
            $output['data']['id_instansi'] = $value->id_instansi;
            $output['data']['nama_tahap'] = nama_tahapan();
            $output['data']['nama_instansi'] = $value->nama_instansi;
            $output['data']['helpdesk'] = $value->helpdesk == '' ? 'Belum Ditentukan' : $value->helpdesk;
            $output['data']['nohp'] = $value->nohp == '' ? '' : $value->nohp;;
            $output['data']['total_paket'] = $value->total_paket;
            $output['data']['total_paket_swakelola'] = $value->total_paket_swakelola;
            $output['data']['total_evidence_rutin'] = $value->total_evidence_rutin;
            $output['data']['total_evidence_swakelola'] = $value->total_evidence_swakelola;
            $output['data']['total_evidence_penyedia'] = $value->total_evidence_penyedia;
            $output['data']['total_paket_penyedia'] = $value->total_paket_penyedia;
            $output['data']['total_paket_rutin'] = $value->total_paket_rutin;
            $output['data']['total_program'] = $value->total_program;
            $output['data']['total_kegiatan'] = $value->total_kegiatan;
            $output['data']['total_sub_kegiatan'] = $value->total_sub_kegiatan;
            $output['data']['total_evidence_diupload'] = $value->total_evidence_diupload;
            $output['data']['total_evidence_belum_validasi'] = $value->total_evidence_belum_validasi;
            $output['data']['total_evidence_belum_validasi_bantuan'] = $value->total_evidence_belum_validasi_bantuan;
            $output['data']['total_evidence_belum_validasi_rutin'] = $value->total_evidence_belum_validasi_rutin;
            $output['data']['total_evidence_belum_validasi_swakelola'] = $value->total_evidence_belum_validasi_swakelola;
            $output['data']['total_evidence_belum_validasi_penyedia'] = $value->total_evidence_belum_validasi_penyedia;
            $output['data']['total_evidence_approve'] = $value->total_evidence_approve;
            $output['data']['total_evidence_reject'] = $value->total_evidence_reject;
            $output['data']['tahun'] = $tahun;

            $helpdesk      = $this->validasi_fisik_model->helpdesk_skpd($id_instansi)->result_array();
            $list_helpdesk = '';
            foreach ($helpdesk as $k => $v) {
            $list_helpdesk .= $v['full_name'].' - '.$v['nohp'].'<br> ';
                # code...
            }
            $output['data']['helpdesk'] = $list_helpdesk == '' ? 'Belum Ditentukan' : $list_helpdesk;

            echo json_encode($output);
        }
    }
    public function ratakan_evidence_paket_validasi()
    {
        if ($this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'    => false,
                'data'      => [],
                'message'   => ''
            ];
            $tahun = tahun_anggaran();
            $helpdesk = $this->db->query("SELECT id_user FROM users_groups WHERE id_group = '4'");
            $paket = $this->db->query("SELECT * from realisasi_fisik rfisik  join paket_pekerjaan pkt on rfisik.id_paket_pekerjaan = pkt.id_paket_pekerjaan where rfisik.status='Belum Validasi' and rfisik.tahun='$tahun' group by rfisik.id_paket_pekerjaan")->result_array();

            $chunk = array_chunk($paket,$helpdesk->num_rows());

            $data_helpdesk = $helpdesk->result_array();

                foreach ($chunk as $k_chunk => $v_chunk) {
                    foreach ($v_chunk as $k => $v) {
                        $id_paket_pekerjaan = $v['id_paket_pekerjaan'];
                        $id_helpdesk_terpilih = $data_helpdesk[$k]['id_user'];
                        $update = $this->db->update('paket_pekerjaan', ['id_helpdesk_pembantu'=>$id_helpdesk_terpilih], ['id_paket_pekerjaan'=>$id_paket_pekerjaan]);
                    }
                }
                $this->session->set_flashdata('pesan','<div class="alert alert-info">Evidence diratakan</div>');
                redirect('validasi/fisik');
            // echo count($paket);
            // var_dump($chunk);
            // $paket = 
            // header('Content-Type: application/json; charset=utf-8');
            // echo json_encode($chunk);

        }
    }
    public function identitas_paket()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'    => false,
                'data'      => [],
                'evidence'      => [],
                'message'   => ''
            ];

            $id_paket        = $this->input->post('id_paket');
            $q = $this->db->query("
                SELECT pp.*, total_nilai_evidence(pp.id_paket_pekerjaan) as nilai_paket,
                mp.kode_program, mp.nama_program,
                mk.kode_kegiatan, mk.nama_kegiatan,
                ski.kode_sub_kegiatan, ski.jenis_sub_kegiatan, ski.keterangan, ski.kategori as kategori_ski, ski.tahun, pp.id_instansi,
                m.metode,
                mi.nama_instansi,
                (SELECT count(id_paket_pekerjaan) from vol_pelaksanaan_pekerjaan vpp where vpp.id_paket_pekerjaan=pp.id_paket_pekerjaan) as volume_paket,
                (SELECT count(id_paket_pekerjaan) from realisasi_fisik rf where rf.id_paket_pekerjaan=pp.id_paket_pekerjaan) as evidence_diupload,
                (SELECT count(id_paket_pekerjaan) from realisasi_fisik rf where rf.id_paket_pekerjaan=pp.id_paket_pekerjaan and status='Belum Validasi') as belum_diperiksa
                 from paket_pekerjaan pp 
                 left join metode m on pp.id_metode = m.id_metode
                left join sub_kegiatan_instansi ski on pp.kode_rekening_sub_kegiatan = ski.kode_sub_kegiatan and pp.tahun=ski.tahun
                left join master_kegiatan mk on pp.kode_rekening_kegiatan= mk.kode_kegiatan
                left join master_program mp on pp.kode_rekening_program= mp.kode_program
                left join users_sub_kegiatan usk on pp.kode_rekening_sub_kegiatan = usk.kode_rekening_sub_kegiatan and pp.id_instansi = usk.id_instansi  and pp.tahun=usk.tahun_anggaran and usk.status=1
                left join master_users mu on usk.id_user = mu.id_user
                left join master_instansi mi on pp.id_instansi = mi.id_instansi
                left join sub_instansi si on mu.id_sub_instansi = si.id_sub_instansi
                where pp.id_paket_pekerjaan = '$id_paket'
                ")->row_array();
            $kode_sub_kegiatan = $q['kode_sub_kegiatan'] ; 
            $q_msk = $this->db->query("SELECT nama_sub_kegiatan from master_sub_kegiatan where kode_sub_kegiatan='$kode_sub_kegiatan'")->row_array();
            $nama_sub_kegiatan = $q['kategori_ski'] =='Sub Kegiatan SKPD' ? $q_msk['nama_sub_kegiatan'] : $q_msk['nama_sub_kegiatan'].'<br>'.$q['jenis_sub_kegiatan'].' - '.$q['keterangan'];

            $id_instansi = $q['id_instansi'];
            $q_helpdesk_utama = $this->db->query("SELECT id_user from helpdesk_instansi where id_instansi ='$id_instansi' and utama='1'")->row_array();


            $kode_sub_kegiatan = $q['kode_rekening_sub_kegiatan'];
            $tahun = $q['tahun'];
            $q_pptk = $this->db->query("SELECT 
                mu.full_name as nama_pptk, si.nama_sub_instansi
             from 
                    users_sub_kegiatan usk left join master_users mu on usk.id_user = mu.id_user
                left join sub_instansi si on mu.id_sub_instansi = si.id_sub_instansi
                where
                 usk.kode_rekening_sub_kegiatan='$kode_sub_kegiatan' and usk.tahun_anggaran='$tahun' and usk.id_instansi='$id_instansi' and usk.status='1'

                 ");


                if ($q_pptk->num_rows() ==0) {
                    $pptk_ski = '<span class="text-danger">PPTK Belum ditentukan</span>';
                    # code...
                }else if($q_pptk->num_rows()==1){
                    $v_pptk = $q_pptk->row_array();
                    $pptk_ski = $v_pptk['nama_pptk'].'<br>'.$v_pptk['nama_sub_instansi'];

                }else{
                    $list_pptk = $q_pptk->result_array();
                    $shoe_pptk = '<ol>';
                    foreach ($list_pptk as $k_pptk => $v_pptk) {
                    $shoe_pptk .= '<li>'.$v_pptk['nama_pptk'].' ['.$v_pptk['nama_sub_instansi'].']</li>';
                        # code...
                    }
                    $shoe_pptk .= '<ol>';
                    $pptk_ski = $shoe_pptk;
                }




            $output['data']['tahun'] = $q['tahun'];
            $output['data']['nama_instansi'] = $q['nama_instansi'];
            $output['data']['nama_program'] = $q['nama_program'];
            $output['data']['nama_kegiatan'] = $q['nama_kegiatan'];
            $output['data']['kode_sub_kegiatan'] = $q['kode_rekening_sub_kegiatan'];
            $output['data']['nama_sub_kegiatan'] = $nama_sub_kegiatan;
            $output['data']['nama_pptk'] = $pptk_ski;
            $output['data']['volume_paket'] = $q['volume_paket'];
            $output['data']['evidence_diupload'] = $q['evidence_diupload'];
            $output['data']['belum_diperiksa'] = $q['belum_diperiksa'];
            $output['data']['nama_paket'] = $q['nama_paket'];
            $output['data']['jenis_paket'] = $q['jenis_paket'].'<br>'.$q['kategori'];
            $output['data']['nilai_paket'] = $q['nilai_paket'];
            $output['data']['metode'] = $q['metode'];
            $output['data']['id_group'] = $this->session->userdata('id_group');
            $output['data']['id_user'] = $this->session->userdata('id_user');
            $output['data']['id_helpesk_utama'] = $q_helpdesk_utama['id_user'];

            $dok_realisasi      = $this->validasi_fisik_model->get_dok_realisasi($id_paket);
            $primary_folder     = 'evience/';
            $directory          = [
                'evidence',
                $q['tahun'],
                $q['id_instansi'],
                'REALISASI-FISIK',
                $id_paket,
            ];
            $list_directory     = implode('/', $directory);//$this->sbe_directory($primary_folder, $directory);
            foreach ($dok_realisasi->result_array() as $key => $value) {

            $id_vol_pelaksanaan_pekerjaan = $value['id_vol_pelaksanaan_pekerjaan'];
            $dokumen_evidence = $value['id_vol_pelaksanaan_pekerjaan']=='' ? explode('_', $value['dokumen'])[0] : explode('_', $value['dokumen'])[0].' | '.$value['nama_pelaksanaan'];


                    $output['evidence'][$key]['auto_evidence'] = $value['auto_evidence'];

                    $output['evidence'][$key]['id_realisasi_fisik'] = $value['id_realisasi_fisik'];
                    $output['evidence'][$key]['id_helpdesk'] = $value['id_helpdesk'];
                    $output['evidence'][$key]['id_realisasi_fisik_enc'] = sbe_crypt($value['id_realisasi_fisik'], 'E');
                    $output['evidence'][$key]['dokumen']            = $this->split($value['dokumen']);
                    $output['evidence'][$key]['dokumen_evidence']            =$dokumen_evidence;
                    $output['evidence'][$key]['jenis_paket']            = $this->split($value['jenis_paket']);
                    $output['evidence'][$key]['id_metode']            = $this->split($value['id_metode']);
                    $output['evidence'][$key]['jenis_paket']            = $this->split($value['jenis_paket']);

                    if ($value['auto_evidence']==1) {
                        $file_url = $value['file_dokumen'];
                        header('X-Frame-Options: SAMEORIGIN');

                        $output['evidence'][$key]['file_dokumen']       = $file_url;
                        # code...
                    }else{
                        $file_url = $list_directory.'/'.$value['file_dokumen'];
                        // $sourceminio = $_ENV['MINIO_ENDPOINT'] . '/'. $_ENV['MINIO_BUCKET'] . '/' .$file_url;

                        $encrypted = $this->encryption->encrypt($file_url);
                        $encoded   = urlencode(base64_encode($encrypted));
                        $output['evidence'][$key]['file_dokumen']       = $encoded;

                    }
                    $output['evidence'][$key]['nilai']              = $value['nilai'];
                    $output['evidence'][$key]['mode_penilaian']              = $value['mode_penilaian'];
                    $output['evidence'][$key]['tahun']              = $value['tahun'];
                    $output['evidence'][$key]['status']              = $value['status'];
                    $output['evidence'][$key]['jadwal_upload']              = $value['updated_on']=='' ? $value['created_on'] : $value['updated_on'] ;
                    $output['evidence'][$key]['masalah']              = $value['status']=='Ditolak' ? "Masalah : ".$value['masalah'].'<br>Solusi : '.$value['solusi'] : '' ;
                    $output['evidence'][$key]['warna_jadwal_upload']              = $value['updated_on']=='' ? "style='background: #dffecb '" : "style='background:#fef8cb'" ;
                    $output['evidence'][$key]['pelaksanaan']              = $value['id_vol_pelaksanaan_pekerjaan'] =='' ? '' : $value['pelaksanaan_ke'] .' | '.$value['nama_pelaksanaan'];
                    //   $output['data'][$key]['jenis_paket']        = $value['jenis_paket'];
                    // $output['data'][$key]['id_metode']          = $value['id_metode'];
                    $jumlah_pelaksanaan = $this->validasi_fisik_model->total_volume($id_paket)->total_volume;

                    $pelaksanaan_terakhir = $this->validasi_fisik_model->pelaksanaan_terakhir($id_paket);
                    $id_pelaksanaan_terakhir = $pelaksanaan_terakhir['id_vol_pelaksanaan_pekerjaan'];

                     $bobot = $this->validasi_fisik_model->bobot($value['jenis_paket'],$value['id_metode'], $value['dokumen']);
                    if ($value['jenis_paket']=="SWAKELOLA" || $value['jenis_paket']=="RUTIN") {
                        if ($jumlah_pelaksanaan==0) {
                           $nilai_pelaksanaan = 0;//round( 75 / $jumlah_pelaksanaan, 2);
                        }else{
                            $nilai_pelaksanaan_satuan = round( 75 / $jumlah_pelaksanaan, 2);
                           if ($value['id_vol_pelaksanaan_pekerjaan']==$id_pelaksanaan_terakhir) {
                                $nilai_paket_sama_akan_divalidasi = $q['nilai_paket']  + $nilai_pelaksanaan_satuan;
                                if ($nilai_paket_sama_akan_divalidasi<100) {
                                    $nilai_pelaksanaan_terakhir = $nilai_pelaksanaan_satuan * ($jumlah_pelaksanaan -1);
                                    if ($jumlah_pelaksanaan==1) {
                                       $nilai_pelaksanaan = 75 ;
                                    }else{
                                        $total_nilai_pelaksanaan = $this->db->query("SELECT sum(nilai) as nilai from realisasi_fisik where id_paket_pekerjaan='$id_paket' and id_vol_pelaksanaan_pekerjaan!='' and id_vol_pelaksanaan_pekerjaan!='$id_vol_pelaksanaan_pekerjaan'")->row_array();
                                        if ($total_nilai_pelaksanaan['nilai']==0) {
                                           $nilai_pelaksanaan = $nilai_pelaksanaan_satuan;
                                        }else{
                                           $nilai_pelaksanaan = 75 - $total_nilai_pelaksanaan['nilai'] ;// - $nilai_pelaksanaan_terakhir + $nilai_pelaksanaan_satuan  ;
                                        }
                                    }
                                }
                            }else{
                               $nilai_pelaksanaan = $nilai_pelaksanaan_satuan;
                            }
                        }
                    }else{
                       if ($jumlah_pelaksanaan==0) {
                           $nilai_pelaksanaan = 0;//round( 75 / $jumlah_pelaksanaan, 2);
                        }else{
                            $nilai_pelaksanaan_satuan = round( 70 / $jumlah_pelaksanaan, 2);
                           if ($value['id_vol_pelaksanaan_pekerjaan']==$id_pelaksanaan_terakhir) {
                                $nilai_paket_sama_akan_divalidasi = $q['nilai_paket']  + $nilai_pelaksanaan_satuan;
                                if ($nilai_paket_sama_akan_divalidasi<100) {
                                    $nilai_pelaksanaan_terakhir = $nilai_pelaksanaan_satuan * ($jumlah_pelaksanaan -1);
                                    if ($jumlah_pelaksanaan==1) {
                                       $nilai_pelaksanaan = 70 ;
                                    }else{
                                        $total_nilai_pelaksanaan = $this->db->query("SELECT sum(nilai) as nilai from realisasi_fisik where id_paket_pekerjaan='$id_paket' and id_vol_pelaksanaan_pekerjaan!='' and id_vol_pelaksanaan_pekerjaan!='$id_vol_pelaksanaan_pekerjaan'")->row_array();
                                        if ($total_nilai_pelaksanaan['nilai']==0) {
                                           $nilai_pelaksanaan = $nilai_pelaksanaan_satuan;
                                        }else{
                                           $nilai_pelaksanaan = 70 - $total_nilai_pelaksanaan['nilai'] ;// - $nilai_pelaksanaan_terakhir + $nilai_pelaksanaan_satuan  ;
                                        }
                                    }
                                }
                            }else{
                               $nilai_pelaksanaan = $nilai_pelaksanaan_satuan;
                            }
                        }
                    }
                    $output['evidence'][$key]['nilai_pelaksanaan']              = $value['id_vol_pelaksanaan_pekerjaan'] =='' ? '' : $nilai_pelaksanaan;
                    
                    
                }

            $output['data']['id_paket_pekerjaan'] = $id_paket;

            // header('Content-Type: application/json; charset=utf-8');
            echo json_encode($output);
        }
    }



public function view($encoded = null)
{
    if (!$encoded) {
        show_404();
    }

    // WAJIB: decode URL dulu
    $encoded = urldecode($encoded);

    // Decrypt object key


        $decoded = base64_decode(urldecode($encoded));
        $object_key = $this->encryption->decrypt($decoded);
        $filename = basename($object_key); 
        $filename = preg_replace('/^[a-z0-9]{8,}_/', '', $filename);


    // $object_key = sbe_crypt($encoded, 'D');
    if (!$object_key) {
        show_404();
    }
  

    // Ambil nama file
    // $filename = basename($object_key);
    // $filename = preg_replace('/^[a-z0-9]{8,}_/', '', $filename);

    // Ambil presigned URL MinIO
    $url = $this->minio_client->get_file_url($object_key);
    if (!$url) {
        show_404();
    }

    // Ambil konten file
    $file_content = @file_get_contents($url);
    if ($file_content === false) {
        show_404();
    }

    // Deteksi MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_buffer($finfo, $file_content);
    finfo_close($finfo);

    // Kirim ke browser
    header('Content-Type: ' . $mimeType);
    header('Content-Disposition: inline; filename="'.$filename.'"');
    header('Content-Length: ' . strlen($file_content));

    echo $file_content;
    exit;
}





    private function vol($id_paket_pekerjaan)
    {
        return $this->db->get_where('vol_pelaksanaan_pekerjaan', [
            'id_paket_pekerjaan' => $id_paket_pekerjaan
        ])->num_rows();
    }

    public function get_dok_realisasi()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'    => false,
                'data'      => [],
                'message'   => ''
            ];

            $id_instansi        = $this->input->post('id_instansi');
            $id_paket_pekerjaan = $this->input->post('id_paket_pekerjaan');
            $dok_realisasi      = $this->validasi_fisik_model->get_dok_realisasi($id_paket_pekerjaan);
            $primary_folder     = 'sbe_files_data/';
            $directory          = [
                $this->sbe_tahun_anggaran(),
                $id_instansi,
                'REALISASI-FISIK',
                $id_paket_pekerjaan,
            ];
            $list_directory     = $this->sbe_directory($primary_folder, $directory);
            if ($dok_realisasi->num_rows() > 0) {
                foreach ($dok_realisasi->result() as $key => $value) {
                    $output['data'][$key]['id_realisasi_fisik'] = $value->id_realisasi_fisik;
                    $output['data'][$key]['jenis_paket']        = $value->jenis_paket;
                    $output['data'][$key]['id_metode']          = $value->id_metode;
                    $output['data'][$key]['dokumen']            = $this->split($value->dokumen);
                    $output['data'][$key]['file_dokumen']       = $list_directory . $value->file_dokumen;
                    $output['data'][$key]['nilai']              = $value->nilai;
                    $output['data'][$key]['tahun']              = $value->tahun;
                    $output['data'][$key]['pelaksanaan']              = $value->id_vol_pelaksanaan_pekerjaan =='' ? '' : $value->pelaksanaan_ke .' | '.$value->nama_pelaksanaan.'';
                    
                    $jumlah_pelaksanaan = $this->validasi_fisik_model->total_volume($id_paket_pekerjaan)->total_volume;
                    if ($value->jenis_paket=="SWAKELOLA") {
                       $nilai_pelaksanaan = round( 75 / $jumlah_pelaksanaan, 2);
                    }else{
                       $nilai_pelaksanaan = round( 70 / $jumlah_pelaksanaan, 2);
                    }
                    $output['data'][$key]['nilai_pelaksanaan']              = $value->id_vol_pelaksanaan_pekerjaan =='' ? '' : $nilai_pelaksanaan;
                    $output['data'][$key]['status']             = $this->status_validasi($value->status);
                }

                $output['status'] = true;
            }

            echo json_encode($output);
        }
    }

    public function split($dokumen)
    {
        $split = explode('_', $dokumen);
        $split = explode('-', $dokumen);

        return $split[0];
    }

    public function status_validasi($status)
    {
        switch ($status) {
            case 'Belum Validasi':
                $stts = 'Not Valid';
                break;
            case 'Sudah Validasi':
                $stts = 'Approved';
                break;
            case 'Ditolak':
                $stts = 'Rejected';
                break;
        }

        return $stts;
    }

    public function update_nilai()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'    => false,
                'data'      => '',
                'message'   => ''
            ];

            $post = $this->input->post();
            $id_realisasi_fisik = $this->input->post('id_realisasi_fisik');
            $id_paket_pekerjaan = $this->input->post('id_paket_pekerjaan');
            $id_instansi = sbe_crypt($this->input->post('id_instansi'),'D');
            $jenis_paket = $this->input->post('jenis_paket');
            $nilai = $this->input->post('nilai');
            $tahun = tahun_anggaran();
            $dokumen = $this->input->post('dokumen');
            if ($dokumen=='PELAKSANAAN') {
                 $jumlah_pelaksanaan = $this->validasi_fisik_model->total_volume($id_paket_pekerjaan)->total_volume;
                    $bobot = $this->validasi_fisik_model->bobot($post['jenis_paket'], $post['id_metode'], $post['dokumen']);
                    if ($jenis_paket=="SWAKELOLA" || $jenis_paket=="RUTIN") {
                       $nilai_pelaksanaan = round( 75 / $jumlah_pelaksanaan, 2);
                    }else{
                       $nilai_pelaksanaan = round( 70 / $jumlah_pelaksanaan, 2);
                    }
                    $data_udate_vol = ['nilai'=>$nilai_pelaksanaan,'mode_penilaian'=>'Otomatis'];
                    $where_udate_vol = [
                        'id_paket_pekerjaan'=>$id_paket_pekerjaan, 
                        'id_vol_pelaksanaan_pekerjaan !='=>'',
                        'dokumen like'=>'%'.$dokumen.'%',
                        'mode_penilaian ='=>'Otomatis',
                        'status'=>'Sudah Validasi'
                    ];
                    if ($nilai_pelaksanaan ==$nilai) {
                        $mode_penilaian = 'Otomatis - Validasi';
                        $this->db->update('realisasi_fisik',$data_udate_vol, $where_udate_vol);
                    }else{
                        $mode_penilaian = 'Manual';
                    }
            }else{
                        $mode_penilaian = 'Otomatis';
            }

            // $nilai = $this->db->query("SELECT total_nilai_evidence($id_paket_pekerjaan) as nilai; ")->row_array();
            // $nilai_sementara = $nilai['nilai'];
            // if ($jenis_paket=='SWAKELOLA') {
            //     if ($dokumen=='LAPORAN') {
            //         if ($nilai_sementara>95) {
            //              $output['status']   = false;
            //             $output['message']     = "Validasi gagal. Nilai lebih setelah di validasi akan menjadi lebih dari 100. Harap periksa kembali nilai / perbaharui nilai pada bagian evidence pelaksanan ";
            //         }
            //         elseif ($nilai_sementara<95) {
            //              $output['status']   = false;
            //             $output['message']     = "Validasi gagal. Nilai lebih setelah di validasi akan menjadi kurang dari 100. Harap periksa kembali nilai / perbaharui nilai pada bagian evidence pelaksanan";
            //         }else{
            //             $update = $this->validasi_fisik_model->update_nilai();
            //              $output['status']   = true;
            //             $output['data']     = $this->validasi_fisik_model->get_id_instansi($id_realisasi_fisik);
            //         }
            //     }else{
            //         $update = $this->validasi_fisik_model->update_nilai();
            //          $output['status']   = true;
            //         $output['data']     = $this->validasi_fisik_model->get_id_instansi($id_realisasi_fisik);
            //     }
            // }else{
            //      if ($dokumen=='FHO') {
            //         if ($nilai_sementara>100) {
            //              $output['status']   = false;
            //             $output['message']     = "Validasi gagal. Nilai lebih setelah di validasi akan menjadi lebih dari 100. Harap periksa kembali nilai / perbaharui nilai pada bagian evidence pelaksanan ";
            //         }
            //         elseif ($nilai_sementara<100) {
            //              $output['status']   = false;
            //             $output['message']     = "Validasi gagal. Nilai lebih setelah di validasi akan menjadi kurang dari 100. Harap periksa kembali nilai / perbaharui nilai pada bagian evidence pelaksanan";
            //         }else{
            //             $update = $this->validasi_fisik_model->update_nilai();
            //              $output['status']   = true;
            //             $output['data']     = $this->validasi_fisik_model->get_id_instansi($id_realisasi_fisik);
            //         }
            //     }else{
            //         $update = $this->validasi_fisik_model->update_nilai();
            //         $output['status']   = true;
            //         $output['data']     = $this->validasi_fisik_model->get_id_instansi($id_realisasi_fisik);
            //     }

            // }


            $update = $this->validasi_fisik_model->update_nilai($mode_penilaian);

            $cek_evidence = $this->db->query("SELECT count(IF( status ='Belum Validasi', id_paket_pekerjaan, NULL)) as evidence_belum_validasi,
            count(IF( status ='Ditolak', id_paket_pekerjaan, NULL)) as evidence_ditolak
            from realisasi_fisik where id_instansi = $id_instansi and tahun = '$tahun'
            ")->row_array();
                    $output['status']   = true;
                    // $output['data']     = $this->validasi_fisik_model->get_id_instansi($id_realisasi_fisik);
                    $output['id_instansi']     = $id_instansi;
                    $output['evidence']     = $cek_evidence;
          

            echo json_encode($output);
        }
    }


    public function simpan_ganti_tahun_anggaran()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'    => false,
                'data'      => '',
                'message'   => ''
            ];

            $id_instansi = sbe_crypt($this->input->post('id_instansi'), 'D');

            $tahun = $this->input->post('tahun');
            $update = ['tahun'=>$tahun];
            $where = ['id_instansi'=>$id_instansi];
            $this->db->update('helpdesk_instansi', $update, $where);
            $output['status']   = true;

                 

            echo json_encode($output);
        }
    }



    public function pdf_rekap_statistika($bulan_awal, $bulan_akhir, $tahun)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Legal',
            'orientation' => 'P',
            'tempDir' => '/tmp'
        ]);
            // $tahun = tahun_anggaran();

        // $mpdf->setFooter('Page {PAGENO}');
        

            if ($this->sbe_group_name() == 'OPERATOR') { 
                $instansi = $this->validasi_fisik_model->get_instansi_by_id(); 
            } elseif ($this->sbe_group_name() == 'HELPDESK') { 
                $instansi = $this->validasi_fisik_model->get_instansi(); 
            } elseif ($this->sbe_group_name() == 'ADMIN') { 
                $instansi =$this->db->query("SELECT id_instansi, nama_instansi, is_active from
            master_instansi where kategori='OPD' and is_active='1' order by nama_instansi asc"); 
            }
      
               $skpd = [];
                foreach ($instansi->result() as $key => $value) {
                    $id_instansi = $value->id_instansi;



        $tahap = tahapan_apbd();    
        if (tahapan_apbd()==4) {
            $where_paket = "and status=1  and kode_rekening_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and status='1')";
            $where_paket_2 = "and pp.status=1  and pp.kode_rekening_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and status='1')";
        }else{
            $where_paket = "and kode_tahap=2  and kode_rekening_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and kode_tahap='2')";
            $where_paket_2 = "and pp.kode_tahap=2  and pp.kode_rekening_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where id_instansi='$id_instansi' and tahun='$tahun' and kode_tahap='2')";

        }





                    // if ($value->is_active=='1') {
                    // $statistika = $this->validasi_fisik_model->statistika($value->id_instansi, $tahun, $bulan_awal, $bulan_akhir)->row();
                    $helpdesk = $this->db->query("SELECT mu.full_name, hi.utama from helpdesk_instansi hi left join master_users mu on  hi.id_user = mu.id_user where hi.id_instansi = '$id_instansi'")->result_array();

                    $evidence  = $this->db->query("SELECT   

            (SELECT count(id_paket_pekerjaan) from paket_pekerjaan where id_instansi = '$id_instansi' and tahun='$tahun' $where_paket) as total_paket, 
            (SELECT count(id_paket_pekerjaan) from realisasi_fisik where id_instansi = '$id_instansi' and tahun='$tahun' and bulan between $bulan_awal and $bulan_akhir) as total_evidence_diupload,

                        (SELECT count(id_paket_pekerjaan) from realisasi_fisik where id_instansi = '$id_instansi'  and tahun='$tahun' and  status='Sudah Validasi' and bulan between $bulan_awal and $bulan_akhir) as total_evidence_approve,

            (SELECT count(id_paket_pekerjaan) from realisasi_fisik where id_instansi ='$id_instansi' and  status='Ditolak'  and tahun='$tahun' and bulan between $bulan_awal and $bulan_akhir) as total_evidence_reject,

            (SELECT count(rf.id_paket_pekerjaan) from realisasi_fisik rf left join paket_pekerjaan pp on rf.id_paket_pekerjaan = pp.id_paket_pekerjaan where rf.id_instansi = '$id_instansi' and rf.status='Belum Validasi' and pp.jenis_paket='SWAKELOLA'  and rf.tahun='$tahun' and rf.bulan between $bulan_awal and $bulan_akhir $where_paket_2) as total_evidence_belum_validasi_swakelola,
            (SELECT count(rf.id_paket_pekerjaan) from realisasi_fisik rf left join paket_pekerjaan pp on rf.id_paket_pekerjaan = pp.id_paket_pekerjaan where rf.id_instansi = '$id_instansi' and rf.status='Belum Validasi' and pp.jenis_paket='PENYEDIA'  and rf.tahun='$tahun' and rf.bulan between $bulan_awal and $bulan_akhir $where_paket_2) as total_evidence_belum_validasi_penyedia




            ")->row_array();
                    $data_skpd = [
                        'is_active'=>$value->is_active,
                        'nama_instansi'=>$value->nama_instansi,
                        'helpdesk'=>$helpdesk,
                        'total_paket'=>$evidence['total_paket'],
                        'total_evidence_diupload'=>$evidence['total_evidence_diupload'],
                        // 'total_evidence_belum_validasi'=>$statistika->total_evidence_belum_validasi,
                        'total_evidence_belum_validasi_swakelola'=>$evidence['total_evidence_belum_validasi_swakelola'],
                        'total_evidence_belum_validasi_penyedia'=>$evidence['total_evidence_belum_validasi_penyedia'],
                        'total_evidence_approve'=>$evidence['total_evidence_approve'],
                        'total_evidence_reject'=>$evidence['total_evidence_reject'],
                        ];
                    array_push($skpd, $data_skpd);
                        # code...
                    // }
                }

               


        $data['skpd'] = $skpd ; 
        $data['tahun'] = $tahun ; 
        if ($bulan_awal==$bulan_akhir) {
            $caption_bulan = bulan_global($bulan_awal);
        }else{
            $caption_bulan = bulan_global($bulan_awal).' sampai '.bulan_global($bulan_akhir);

        }

        $judul_laporan = "Statistika evidence";
        $tanggal_penarikan = date('d').' '.bulan_global(date('n')).' '.date('Y').' - '.date('H:i:s');
        $data['tanggal_penarikan'] = $tanggal_penarikan ;
        $data['judul_laporan'] = $judul_laporan.'<br><small>'.$caption_bulan.' <br>Tahun '.$tahun.'</small>'; 


        $html =  $this->load->view('validasi/pdf/rekap_statistika/content', $data, true);

        $header =  $this->load->view('validasi/pdf/rekap_statistika/header', $data, true);
        $footer =  $this->load->view('validasi/pdf/rekap_statistika/footer', $data, true);

        $mpdf->SetMargins(0, 0, 25);

        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);
        $mpdf->WriteHTML($html);
        $mpdf->Output($judul_laporan.' - '.str_replace(':', '.', $tanggal_penarikan).'.pdf', 'I');
    }




    public function pdf_rekap_statistika_helpdesk($bulan_awal, $bulan_akhir, $tahun)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Legal',
            'orientation' => 'P',
            'tempDir' => '/tmp'
        ]);

            $id_user = $this->session->userdata('id_user');
            if ($this->sbe_group_name() == 'HELPDESK') { 
                $where = "and  ug.id_user='$id_user'";
            } elseif ($this->sbe_group_name() == 'ADMIN') { 
                $where = "";
            }


            $helpdesk = $this->db->query("SELECT ug.id_user, mu.full_name, 
                (SELECT count(rfisik.id_paket_pekerjaan) from realisasi_fisik rfisik where  rfisik.id_helpdesk= ug.id_user  and rfisik.status='Belum Validasi' and rfisik.tahun='$tahun' and rfisik.bulan between $bulan_awal and $bulan_akhir) as total_evidence_belum_validasi_bantuan, 
                (SELECT count(rfisik.id_paket_pekerjaan) from realisasi_fisik rfisik where rfisik.id_instansi in (SELECT hi.id_instansi from helpdesk_instansi hi where hi.id_user=ug.id_user  and hi.utama='1') and  rfisik.status='Belum Validasi' and rfisik.tahun='$tahun' and rfisik.bulan between $bulan_awal and $bulan_akhir) as total_evidence_belum_validasi_pj_instansi,

                  (SELECT count(rfisik.id_paket_pekerjaan) from realisasi_fisik rfisik where  rfisik.id_helpdesk= ug.id_user  and rfisik.tahun='$tahun' and rfisik.bulan between $bulan_awal and $bulan_akhir) as total_evidence_diupload_bantuan, 
                (SELECT count(rfisik.id_paket_pekerjaan) from realisasi_fisik rfisik where rfisik.id_instansi in (SELECT id_instansi from helpdesk_instansi where id_user=ug.id_user and utama='1') and rfisik.tahun='$tahun' and rfisik.bulan between $bulan_awal and $bulan_akhir) as total_evidence_diupload_pj_instansi,


                (SELECT count(rfisik.id_paket_pekerjaan) from realisasi_fisik rfisik where  rfisik.id_helpdesk= ug.id_user  and rfisik.status='Sudah Validasi' and rfisik.tahun='$tahun' and rfisik.bulan between $bulan_awal and $bulan_akhir) as total_evidence_sudah_validasi_bantuan, 
                (SELECT count(rfisik.id_paket_pekerjaan) from realisasi_fisik rfisik where rfisik.id_instansi in (SELECT hi.id_instansi from helpdesk_instansi hi where hi.id_user=ug.id_user and hi.utama='1') and  rfisik.status='Sudah Validasi' and rfisik.tahun='$tahun' and rfisik.bulan between $bulan_awal and $bulan_akhir) as total_evidence_sudah_validasi_pj_instansi,


                (SELECT count(rfisik.id_paket_pekerjaan) from realisasi_fisik rfisik where  rfisik.id_helpdesk= ug.id_user  and rfisik.status='Ditolak' and rfisik.tahun='$tahun' and rfisik.bulan between $bulan_awal and $bulan_akhir) as total_evidence_ditolak_bantuan, 
                (SELECT count(rfisik.id_paket_pekerjaan) from realisasi_fisik rfisik where rfisik.id_instansi in (SELECT hi.id_instansi from helpdesk_instansi hi where hi.id_user=ug.id_user and hi.utama='1') and  rfisik.status='Ditolak' and rfisik.tahun='$tahun' and rfisik.bulan between $bulan_awal and $bulan_akhir) as total_evidence_ditolak_pj_instansi
             FROM users_groups ug 

            left join master_users mu on ug.id_user = mu.id_user 
            WHERE ug.id_group = '4' $where")->result_array();

        $judul_laporan = "Statistika evidence";


        if ($bulan_awal==$bulan_akhir) {
            $caption_bulan = bulan_global($bulan_awal);
        }else{
            $caption_bulan = bulan_global($bulan_awal).' sampai '.bulan_global($bulan_akhir);

        }


        $tanggal_penarikan = date('d').' '.bulan_global(date('n')).' '.date('Y').' - '.date('H:i:s');
        $data['tanggal_penarikan'] = $tanggal_penarikan ;
        $data['judul_laporan'] = $judul_laporan.'<br><small>'.$caption_bulan.' <br>Tahun '.$tahun.'</small>'; 
        $data['helpdesk'] = $helpdesk;//.'<br><small>'.$caption_bulan.' <br>Tahun '.$tahun.'</small>'; 


        $html =  $this->load->view('validasi/pdf/rekap_statistika/content_helpdesk', $data, true);

        $header =  $this->load->view('validasi/pdf/rekap_statistika/header', $data, true);
        $footer =  $this->load->view('validasi/pdf/rekap_statistika/footer', $data, true);

        $mpdf->SetMargins(0, 0, 25);

        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);
        $mpdf->WriteHTML($html);
        $mpdf->Output($judul_laporan.' - '.str_replace(':', '.', $tanggal_penarikan).'.pdf', 'I');
    }


    public function pdf_rekap_statistika_total()
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Legal',
            'orientation' => 'P',
            'tempDir' => '/tmp'
        ]);
            $tahun = tahun_anggaran();

        // $mpdf->setFooter('Page {PAGENO}');
        

            if ($this->sbe_group_name() == 'OPERATOR') { 
                $instansi = $this->validasi_fisik_model->get_instansi_by_id(); 
            } elseif ($this->sbe_group_name() == 'HELPDESK') { 
                $instansi = $this->validasi_fisik_model->get_instansi(); 
            } elseif ($this->sbe_group_name() == 'ADMIN') { 
                $instansi =$this->db->query("SELECT id_instansi, nama_instansi, is_active from
            master_instansi where kategori='OPD' and is_active='1' order by nama_instansi asc"); 
            }
      
               $skpd = [];
                foreach ($instansi->result() as $key => $value) {
                    // if ($value->is_active=='1') {
                    $id_instansi = $value->id_instansi;
                    $statistika = $this->validasi_fisik_model->statistika($value->id_instansi, $tahun)->row();
                    $q_pagu = $this->db->query("SELECT sum(bo_bp + 
bo_bbj + 
bo_bs + 
bo_bh + 
bm_bmt + 
bm_bmpm + 
bm_bmgb + 
bm_bmjji + 
bm_bmatl + 
btt + 
bt_bbh + 
bt_bbk) as total_pagu from anggaran_sub_kegiatan  where 
id_instansi = '$id_instansi' and tahun = '$tahun'
")->row_array();
                    $data_skpd = [
                        'is_active'=>$value->is_active,
                        'nama_instansi'=>$statistika->nama_instansi,
                        'helpdesk'=>$statistika->helpdesk,
                        'total_program'=>$statistika->total_program,
                        'total_kegiatan'=>$statistika->total_kegiatan,
                        'total_sub_kegiatan'=>$statistika->total_sub_kegiatan,
                        'total_pagu'=>number_format($q_pagu['total_pagu']),
                        'total_paket'=>$statistika->total_paket,
                        'total_evidence_diupload'=>$statistika->total_evidence_diupload,
                        'total_evidence_belum_validasi'=>$statistika->total_evidence_belum_validasi,
                        'total_evidence_belum_validasi_swakelola'=>$statistika->total_evidence_belum_validasi_swakelola,
                        'total_evidence_belum_validasi_penyedia'=>$statistika->total_evidence_belum_validasi_penyedia,
                        'total_evidence_approve'=>$statistika->total_evidence_approve,
                        'total_evidence_reject'=>$statistika->total_evidence_reject,
                        ];
                    array_push($skpd, $data_skpd);
                        # code...
                    // }
                }

               


        $data['skpd'] = $skpd ; 
        $data['tahun'] = $tahun ; 
        $judul_laporan = "Statistika evidence";
        $tanggal_penarikan = date('d').' '.bulan_global(date('n')).' '.date('Y').' - '.date('H:i:s');
        $data['tanggal_penarikan'] = $tanggal_penarikan ;
        $data['judul_laporan'] = $judul_laporan.'<br><small>Tahun '.$tahun.'</small>'; 


        $html =  $this->load->view('validasi/pdf/rekap_statistika/content_total', $data, true);

        $header =  $this->load->view('validasi/pdf/rekap_statistika/header', $data, true);
        $footer =  $this->load->view('validasi/pdf/rekap_statistika/footer', $data, true);

        $mpdf->SetMargins(0, 0, 20);

        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);
        $mpdf->WriteHTML($html);
        $mpdf->Output($judul_laporan.' - '.str_replace(':', '.', $tanggal_penarikan).'.pdf', 'I');
    }


}
