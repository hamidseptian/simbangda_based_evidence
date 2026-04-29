<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Paket_pekerjaan.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Data_apbd_kab_kota extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->form_validation->CI = &$this;
        $this->load->model([
            'data_apbd_kab_kota/data_apbd_kab_kota_model'      => 'data_apbd_kab_kota_model',

            'instansi/instansi_model' => 'instansi_model',
            'datatables_model'                         => 'datatables_model'
        ]);
    }

    public function anggaran_instansi_kab_kota()
    {
        $breadcrumbs    = $this->breadcrumbs;
            $instansi       = $this->instansi_model;

            $breadcrumbs->add('Home', base_url());
            $breadcrumbs->add('Data APBD', base_url($this->router->fetch_class()));
            $breadcrumbs->render();
            $tahap = tahapan_apbd();
            $namatahap =pilihan_nama_tahapan($tahap);
            $data['tahap']          = $namatahap;
            $data['title']          = "Data APBD ";
            $data['icon']           = "metismenu-icon pe-7s-culture";
            $data['description']    = "Menampilkan Data APBD Lingkut Kabupaten / Kota";
            $data['breadcrumbs']    = '';

         $data['dropdown_option']                      = [
            ['tipe'=>'link', 'caption'=>'Ambil data Integrasi', 'fa'=>'fa fa-bars', 'onclick'=>'/data_apbd_kab_kota/get_anggaran_instansi_kab_kota_integrasi', 'elemen_tambahan'=>'data-toggle="tooltip" title="Ganti tahun dan periode"'],
           
        ];
            $page                   = 'data_apbd_kab_kota/anggaran_instansi_kab_kota/index';
            $data['link']           = $this->router->fetch_method();
            $data['menu']           = $this->load->view('layout/menu', $data, true);
            $data['extra_css']      = $this->load->view('data_apbd_kab_kota/anggaran_instansi_kab_kota/css', $data, true);
            $data['extra_js']       = $this->load->view('data_apbd_kab_kota/anggaran_instansi_kab_kota/js', $data, true);
            $data['modal']      = $this->load->view('data_apbd_kab_kota/anggaran_instansi_kab_kota/modal', $data, true);
            $this->template->load('backend_template', $page, $data);
    }


    public function get_anggaran_instansi_kab_kota_integrasi()
    {
        $breadcrumbs    = $this->breadcrumbs;
            $instansi       = $this->instansi_model;

            $breadcrumbs->add('Home', base_url());
            $breadcrumbs->add('Data APBD', base_url($this->router->fetch_class()));
            $breadcrumbs->render();
            $tahap = tahapan_apbd();
            $namatahap =pilihan_nama_tahapan($tahap);
            $data['tahap']          = $namatahap;
            $data['title']          = "Data APBD ";
            $data['icon']           = "metismenu-icon pe-7s-culture";
            $data['description']    = "Menampilkan Data APBD Lingkut Kabupaten / Kota";
            $data['breadcrumbs']    = '';

         $data['dropdown_option']                      = [
            ['tipe'=>'link', 'caption'=>'Ambil data Integrasi', 'fa'=>'fa fa-bars', 'onclick'=>'/data_apbd_kab_kota/get_anggaran_instansi_kab_kota_integrasi', 'elemen_tambahan'=>'data-toggle="tooltip" title="Ganti tahun dan periode"'],
           
        ];
            $page                   = 'data_apbd_kab_kota/anggaran_instansi_kab_kota/index';
            $data['link']           = $this->router->fetch_method();
            $data['menu']           = $this->load->view('layout/menu', $data, true);
            $data['extra_css']      = $this->load->view('data_apbd_kab_kota/anggaran_instansi_kab_kota/css', $data, true);
            $data['extra_js']       = $this->load->view('data_apbd_kab_kota/anggaran_instansi_kab_kota/js', $data, true);
            $data['modal']      = $this->load->view('data_apbd_kab_kota/anggaran_instansi_kab_kota/modal', $data, true);
            $this->template->load('backend_template', $page, $data);
    }



    public function data_anggaran_instansi_kab_kota()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {       

            $tahap = tahapan_apbd();
            $tahun_anggaran = tahun_anggaran();
                $id_kota = $this->session->userdata('id_kota') ;    
                $where          = ['kategori'=>'OPD', 'id_kota'=>$id_kota];
            
         $no             = $_POST['start'];
  
         $start = $no;
         $length             = $_POST['length'];
         $key = $_POST['search']['value'];
         $tgls = date('Y-m-d');
        $data = [];
         if ($key) {
            $q_instansi = $this->db->query("SELECT mi.nama_instansi, mi.id_instansi 
                  

                    from master_instansi_kab_kota mi where mi.kategori='OPD' and mi.id_kota='$id_kota'  
                     and mi.nama_instansi like '%$key%'
                    and
                   ( CASE 
                                       WHEN is_active = '0' THEN  tmt_mulai < '$tgls' and (tmt_selesai >= '$tgls' or tmt_selesai = 'Sedang Aktif')
                                       ELSE is_active = '1'
                                       END)
                   
                    limit $start, $length
                ")->result_array();
            
         }else{
            $q_instansi = $this->db->query("SELECT nama_instansi, id_instansi 
                   
                    from master_instansi_kab_kota mi where mi.kategori='OPD' and mi.id_kota='$id_kota' and 
                    CASE 
                    WHEN is_active = '0' THEN  tmt_mulai < '$tgls' and (tmt_selesai >= '$tgls' or tmt_selesai = 'Sedang Aktif')
                    ELSE is_active = '1'
                    END
                    limit $start, $length
                ")->result_array();
         }
         
            $count_data = $this->db->query("SELECT id_instansi from master_instansi_kab_kota mi where mi.kategori='OPD' and mi.id_kota='$id_kota' and 
                    CASE 
                    WHEN is_active = '0' THEN  tmt_mulai < '$tgls' and (tmt_selesai >= '$tgls' or tmt_selesai = 'Sedang Aktif')
                    ELSE is_active = '1'
                    END
                ")->num_rows();




            foreach ($q_instansi as $k => $v) {

                $id_instansi  = $v['id_instansi'];
                $q_pagu = $this->db->query("SELECT  pergeseran_ke, bo_bp, bo_bbj, bo_bs, bo_bh, bo_bbs, bm_bmt, bm_bmpm, bm_bmgb, bm_bmjji, bm_bmatl, bm_bmatb, btt, bt_bbh, bt_bbk from anggaran_instansi_kab_kota where id_instansi = '$id_instansi' and pergeseran_ke !='' and tahun = '$tahun_anggaran' and kode_tahap = '$tahap'");
                if ($q_pagu->num_rows()>0 ) {
                    $d_pagu = $q_pagu->row_array();
                    $caption_apbd = pilihan_nama_tahapan($tahap).'<br>Pergeseran ke-'.$d_pagu['pergeseran_ke'];
                    $pergeseran_ke = $d_pagu['pergeseran_ke'];

                }else{
                    $q_pagu_pergeseran = $this->db->query("SELECT  pergeseran_ke, bo_bp, bo_bbj, bo_bs, bo_bh, bo_bbs, bm_bmt, bm_bmpm, bm_bmgb, bm_bmjji, bm_bmatl, bm_bmatb, btt, bt_bbh, bt_bbk from anggaran_instansi_kab_kota where id_instansi = '$id_instansi' and tahun = '$tahun_anggaran' and kode_tahap = '$tahap'");
                    $d_pagu = $q_pagu_pergeseran->row_array();
                    $caption_apbd = pilihan_nama_tahapan($tahap);
                    $pergeseran_ke = '';

                }
                $row    = [];
                $no++;
                $row[]     = $no;
                $pagu_bo = $d_pagu['bo_bp'] + $d_pagu['bo_bbj'] + $d_pagu['bo_bs'] + $d_pagu['bo_bh'] + $d_pagu['bo_bbs'];
                $pagu_bm = $d_pagu['bm_bmt'] + $d_pagu['bm_bmpm'] + $d_pagu['bm_bmgb'] + $d_pagu['bm_bmjji'] + $d_pagu['bm_bmatl'] + $d_pagu['bm_bmatb'];
                $pagu_btt =$d_pagu['btt'] ;
                $pagu_bt = $d_pagu['bt_bbh'] + $d_pagu['bt_bbk'] ;
                $pagu_total =  $pagu_bo + $pagu_bm + $pagu_btt+$pagu_bt;
                $row[]     = $v['nama_instansi'];
                $row[]     = $caption_apbd;
                $row[]     = number_format($pagu_bo);
                $row[]     = number_format($pagu_bm);
                $row[]     = number_format($pagu_btt);
                $row[]     = number_format($pagu_bt);
                $row[]     = number_format($pagu_total);


                $onclick3 = "get_target_kab_kota('".$v['nama_instansi']."','".$v['id_instansi']."','".$id_kota."','".tahapan_apbd()."','".tahun_anggaran()."','".$pagu_total."')";
                $tomboltarget = ' <button class="btn btn-outline-info btn-xs"  title="Input target realisasi  '.$v['nama_instansi'].'"  onclick="'.$onclick3.'"><i class="fas fa-crosshairs"></i></button> ';
                $tomboltarget_forbidden = ' <button class="btn btn-outline-danger btn-xs"  title="Input target realisasi  '.$v['nama_instansi'].'"  onclick="input_target_forbidden('."'".$v['nama_instansi']."'".')"><i class="fas fa-crosshairs"></i></button> ';



                $tombol_edit = '<button class="btn btn-outline-info btn-xs"  title="Input / Edit Pagu Instansi '.$v['nama_instansi'].'"  onclick="input_pagu_instansi('."'".sbe_crypt($v['id_instansi'], 'E')."'".','.$tahap.','.$tahun_anggaran.','.$pergeseran_ke.')"><i class="fas fa-money-bill"></i></button>';

                $tombol_copy = ' <button class="btn btn-outline-info btn-xs"  title="Copu Pagu  APBD AWAL Instansi '.$v['nama_instansi'].'"  onclick="copy_pagu_instansi('."'".sbe_crypt($v['id_instansi'], 'E')."'".','.$tahap.', '."'".$v['nama_instansi']."'".')"><i class="fas fa-copy"></i></button>';

                if ($pagu_total >0) {
                    $show_tombol_target = $tomboltarget;
                }else{
                    $show_tombol_target = $tomboltarget_forbidden;

                }
                
                if ($tahap==4 && $pagu_total==0) {
                    $row[]  = $tombol_edit.$tombol_copy;
                    # code...
                }else{
                    $row[]  = $tombol_edit.$show_tombol_target;

                }



                $data[] = $row;
            }


            
             $output = [
                "draw"              => $_POST['draw'],
                "recordsTotal"      => $count_data,//$this->datatables_model->count_all('master_instansi_kab_kota', $where),
                "recordsFiltered"   => $count_data,//$this->datatables_model->count_filtered('master_instansi_kab_kota', $column_order, $column_search, $order, $where),
                "data"              => $data,
            ];



            echo json_encode($output);
        }
    }




    public function get_anggaran_instansi_kab_kota()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'    => false,
                'data'      => [],
                'volume'    => [],
                'lokasi'    => []
            ];

           
            $id_instansi = sbe_crypt($this->input->post('id_instansi'),'D');
            $tahap = $this->input->post('tahap');
            $pergeseran_ke = $this->input->post('pergeseran_ke');
            $tahun = tahun_anggaran();
            if ($pergeseran_ke) {
                $where = [ 'kode_tahap'=>$tahap,'tahun'=>$tahun,'id_instansi' =>$id_instansi ,'pergeseran_ke' =>$pergeseran_ke];
                $pagu    = $this->db->get_where('anggaran_instansi_kab_kota', $where);
                $value = $pagu->row(); 
                $caption_apbd =   "APBD AWAL<br>Pergeseran Ke-".$pergeseran_ke.'<br>'.'<div id="edit_pergeseran_ke"><button type="button" class="btn btn-outline-info btn-sm" onclick="edit_pergeseran_ke('."'".$pergeseran_ke."'".')">Edit Pergeseran Ke</button></div>';    
                # code...
            }else{
                $where = ['kode_tahap'=>$tahap,'tahun'=>$tahun,   'id_instansi' =>$id_instansi ];
                $pagu    = $this->db->get_where('anggaran_instansi_kab_kota', $where);
                $value = $pagu->row(); 
                $caption_apbd =  "APBD AWAL".'<br>'.'<button type="button" class="btn btn-outline-info btn-sm" onclick="lakukan_pergeseran('."'".$value->id_anggaran_instansi_kab_kota ."'".')">Lakukan Pergeseran</button>';

            }

            $identitas_instansi        = $this->db->query("SELECT nama_instansi from v_instansi_kab_kota where id_instansi='$id_instansi'")->row();
                $output['data']['nama_instansi']                  =  $identitas_instansi->nama_instansi ;
                $output['data']['caption_apbd']                  =  $caption_apbd;
                $pagu_total  = $value->bo_bp + $value->bo_bbj + $value->bo_bs + $value->bo_bh + $value->bo_bbs + $value->bm_bmt + $value->bm_bmpm + $value->bm_bmgb + $value->bm_bmjji + $value->bm_bmatl + $value->bm_bmatb + $value->btt + $value->bt_bbh + $value->bt_bbk ;
                $output['data']['pagu_total']            = number_format($pagu_total) ;
    


            
                    $output['data']['bo_bp']                  = $value->bo_bp;
                    $output['data']['bo_bbj']                  = $value->bo_bbj;
                    $output['data']['bo_bs']                  = $value->bo_bs;
                    $output['data']['bo_bh']                  = $value->bo_bh;
                    $output['data']['bo_bbs']                  = $value->bo_bbs;
                    $output['data']['bm_bmt']                  = $value->bm_bmt;
                    $output['data']['bm_bmpm']                  = $value->bm_bmpm;
                    $output['data']['bm_bmgb']                  = $value->bm_bmgb;
                    $output['data']['bm_bmjji']                  = $value->bm_bmjji;
                    $output['data']['bm_bmatl']                  = $value->bm_bmatl;
                    $output['data']['bm_bmatb']                  = $value->bm_bmatb;
                    $output['data']['btt']                  = $value->btt;
                    $output['data']['bt_bbh']                  = $value->bt_bbh;
                    $output['data']['bt_bbk']                  = $value->bt_bbk ;
                    $output['data']['rea_bo']                  = $value->realisasikan_bo ;
                    $output['data']['rea_bm']                  = $value->realisasikan_bm ;
                    $output['data']['rea_btt']                  = $value->realisasikan_btt ;
                    $output['data']['rea_bt']                  = $value->realisasikan_bt ;
                

                $output['status'] = true;
           
                  
                    $output['data']['rea_bo']                  = 0;
                    $output['data']['rea_bm']                  = 0;
                    $output['data']['rea_btt']                  = 0;
                    $output['data']['rea_bt']                  = 0;
           

            echo json_encode($output);
        }
    }



    public function simpanedit_pergeseran_ke()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output    = [
                'success' => false,
                'messages' => []
            ];

            $this->db->trans_start();
            $pergeseran_ke_sebelumnya = $this->input->post('pergeseran_ke_sebelumnya');
            $id_instansi = sbe_crypt($this->input->post('id_instansi'),'D');
            $input_pergeseran_ke = $this->input->post('input_pergeseran_ke');
            $nama_skpd = $this->input->post('nama_skpd');
            $tahap = $this->input->post('tahap');
            $tahun = $this->input->post('tahun');
             $where = ['id_instansi' => $id_instansi, 'pergeseran_ke'=>$pergeseran_ke_sebelumnya,'kode_tahap'=>$tahap,  'tahun'=>$tahun];
             $where_target = ['pergeseran_ke'=>$pergeseran_ke_sebelumnya,'kode_tahap'=>$tahap,  'tahun'=>$tahun,   'id_instansi' => $id_instansi];
             $data = ['pergeseran_ke' =>$input_pergeseran_ke];
             // $this->db->update('sub_kegiatan_instansi', $data, $where);
             $this->db->update('anggaran_instansi_kab_kota', $data, $where);
             $this->db->update('target_apbd_kab_kota', $data, $where_target);


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $output['success'] = false;
                $output['swal_caption'] = 'Data Pergeseran gagal disimpan';
            } else {
                $this->db->trans_commit();
                $output['swal_caption'] = 'Tahapan APBD pada sub kegiatan '.$nama_skpd.' diperbaharui ke pergeseran ke-'.$input_pergeseran_ke;
                $output['success'] = true;
            }

        echo json_encode($output);     
        }
    }



  public function insert_pergeseran()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'    => false,
                'data'      => [],
            ];

            $id_aikk = $this->input->post('id_aikk');
            $skpd = $this->input->post('skpd');
         
            // $ski = $this->db->get_where('anggaran_instansi_kab_kota', ['id_anggaran_instansi_kab_kota'=>$id_aikk])->row_array();
            $anggaran_awal                 = $this->db->get_where('anggaran_instansi_kab_kota', ['id_anggaran_instansi_kab_kota'=>$id_aikk]);
            $anggaran_apbd_awal = $anggaran_awal->row_array();
          
            $tahun = $anggaran_apbd_awal['tahun'];
            $kode_tahap = $anggaran_apbd_awal['kode_tahap'];
            $id_instansi = $anggaran_apbd_awal['id_instansi'];


            $this->db->trans_begin();

        


            $where_awal = [
                'kode_tahap' => 2,
                'id_instansi' => $id_instansi,
                'tahun'=>$tahun
            ];



            $target                 = $this->db->order_by('bulan', 'ASC')->get_where('target_apbd_kab_kota', $where_awal);
            // $realisasi_keuangan          = $this->db->order_by('bulan', 'ASC')->get_where('realisasi_keuangan', $where_pagu_awal);


            // var_dump($anggaran_apbd_awal);
 $data_pagu = [
                // 'kode_sub_kegiatan'=>$anggaran_apbd_awal['kode_sub_kegiatan'],
                // 'kode_kegiatan'=>$anggaran_apbd_awal['kode_kegiatan'],
                'id_provinsi'=>$anggaran_apbd_awal['id_provinsi'],
                'id_kota'=>$anggaran_apbd_awal['id_kota'],

                'id_instansi'=>$anggaran_apbd_awal['id_instansi'],
                'kode_tahap'=>$kode_tahap,
                'pergeseran_ke'=>1,
                'bo_bp'=>$anggaran_apbd_awal['bo_bp'],
                'bo_bbj'=>$anggaran_apbd_awal['bo_bbj'],
                'bo_bs'=>$anggaran_apbd_awal['bo_bs'],
                'bo_bh'=>$anggaran_apbd_awal['bo_bh'],
                'bo_bbs'=>$anggaran_apbd_awal['bo_bbs'],
                'bm_bmt'=>$anggaran_apbd_awal['bm_bmt'],
                'bm_bmpm'=>$anggaran_apbd_awal['bm_bmpm'],
                'bm_bmgb'=>$anggaran_apbd_awal['bm_bmgb'],
                'bm_bmjji'=>$anggaran_apbd_awal['bm_bmjji'],
                'bm_bmatl'=>$anggaran_apbd_awal['bm_bmatl'],
                'bm_bmatb'=>$anggaran_apbd_awal['bm_bmatb'],
                'btt'=>$anggaran_apbd_awal['btt'],
                'bt_bbh'=>$anggaran_apbd_awal['bt_bbh'],
                'bt_bbk'=>$anggaran_apbd_awal['bt_bbk'],
                'realisasikan_bo'=>$anggaran_apbd_awal['realisasikan_bo'],
                'realisasikan_bm'=>$anggaran_apbd_awal['realisasikan_bm'],
                'realisasikan_btt'=>$anggaran_apbd_awal['realisasikan_btt'],
                'realisasikan_bt'=>$anggaran_apbd_awal['realisasikan_bt'],
                'tahun'=>$anggaran_apbd_awal['tahun'],
                'created_on'=>timestamp(),
                'created_by'=>id_user(),
                'input_by '=>'Pengalihan Pergeseran',
                // 'status '=>'1',
               ];

            $kumpul_target_baru = [];
            foreach ($target->result_array() as $k => $v) {
                 $data_target = [
                    // 'kode_bidang_urusan'=>$v['kode_bidang_urusan'],
                    // 'kode_rekening_program'=>$v['kode_rekening_program'],
                    // 'kode_rekening_kegiatan'=>$v['kode_rekening_kegiatan'],

                    'id_kota'=>$v['id_kota'],
                    'bulan'=>$v['bulan'],
                    'id_instansi'=>$v['id_instansi'],
                    'kode_tahap'=>$kode_tahap,
                    'pergeseran_ke'=>1,
                    'target_fisik'=>$v['target_fisik'],
                    'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
                    'target_keuangan'=>$v['target_keuangan'],
                    'target_keuangan_bulanan'=>$v['target_keuangan_bulanan'],
                    'tahun'=>$v['tahun'],
                    'created_on'=>timestamp(),
                'input_by '=>'Pengalihan Pergeseran',
                    'created_by'=>$v['created_by'],
                 
                   ];
                   array_push($kumpul_target_baru, $data_target);
            }


                $this->db->insert('anggaran_instansi_kab_kota', $data_pagu);
                if ($target->num_rows()>0) {
                    $this->db->insert_batch('target_apbd_kab_kota', $kumpul_target_baru);
                }
                // $this->db->update('sub_kegiatan_instansi', ['pergeseran_ke'=>$ke], ['id_sub_kegiatan_instansi'=>$id_ski]);





            

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $output['status'] = false;
            } else {
                $this->db->trans_commit();
                $output['data']['tahun'] = $tahun;
                $output['data']['tahap'] = $kode_tahap;
                $output['data']['id_instansi'] = sbe_crypt($id_instansi);
                $output['data']['swal_caption'] = $skpd.' sudah dialihkan ke APBD pergeseran ke-1<br>Silahkan sesuaikan kembali Pagu dan target pada SKPD  ini';
                $output['status'] = true;
            }



            // $output['data'] = $data_ski_baru ;


            echo json_encode($output);
        }
    }







    public function get_anggaran_total_kab_kota()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'    => true,
                'data'      => [],
              
            ];

           
            $id_kota = $this->session->userdata('id_kota');
            $data_apbd_kab_kota_model = $this->data_apbd_kab_kota_model;
            $tahap = tahapan_apbd();
            $tahun = tahun_anggaran();
            $where = [ 'kode_tahap'=>$tahap,'tahun'=>$tahun,   'id_kota' =>$id_kota];

            $pagu    = $data_apbd_kab_kota_model->anggaran_total_kab_kota($id_kota, $tahun, $tahap);
           

                    $output['data']['bo']                  = $pagu['bo'];
                    $output['data']['bm']                  = $pagu['bm'];
                    $output['data']['btt']                  = $pagu['btt'];
                    $output['data']['bt']                  = $pagu['bt'];
                    $output['data']['total']                  = $pagu['total'];
                    $output['data']['periode']                  = 'Total Pagu '.pilihan_nama_tahapan($tahap).' Tahun '.$tahun;
             

            echo json_encode($output);
        }
    }



 public function rule_pagu_instansi_kab_kota()
    {
        
        return [
            [
                'field' => 'bo_bp',
                'label' => 'Belanja Pegawai',
                'rules' => 'required'
            ],
            [
                'field' => 'bm_bmt',
                'label' => 'Belanja Modal Tanah',
                'rules' => 'required'
            ],
            [
                'field' => 'btt',
                'label' => 'Belanja Tidak Terduga',
                'rules' => 'required'
            ],
            [
                'field' => 'bt_bbh',
                'label' => 'Belanja Bagi Hasil',
                'rules' => 'required'
            ],
            [
                'field' => 'bo_bbj',
                'label' => 'Belanja Barang Jasa',
                'rules' => 'required'
            ],
            [
                'field' => 'bm_bmpm',
                'label' => 'Belanja Modal Peralatan Dan Mesin',
                'rules' => 'required'
            ],
            [
                'field' => 'bt_bbk',
                'label' => 'Belanja Bantuan Keuangan',
                'rules' => 'required'
            ],
            [
                'field' => 'bo_bs',
                'label' => 'Belanja Subsidi',
                'rules' => 'required'
            ],
            [
                'field' => 'bm_bmgb',
                'label' => 'Belanja Modal Gedung dan Bangunan',
                'rules' => 'required'
            ],
            [
                'field' => 'bo_bh',
                'label' => 'Belanja Hibah',
                'rules' => 'required'
            ],
            [
                'field' => 'bm_bmjji',
                'label' => 'Belanja Modal Jalan, Jaringan, dan Irigasi',
                'rules' => 'required'
            ],
            [
                'field' => 'bm_bmatl',
                'label' => 'Belanja Modal dan Aset Tetap Lainnya',
                'rules' => 'required'
            ],
            
        ];
    }


    public function save_anggaran_instansi_kab_kota()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output    = [
                'success' => false,
                'messages' => []
            ];
            $data_group     = [];
            $data_apbd_kab_kota_model     = $this->data_apbd_kab_kota_model;
            $validation     = $this->form_validation;
            $validation->set_rules($this->rule_pagu_instansi_kab_kota());
            $validation->set_error_delimiters('<p class="text-danger">', '</p>');


                $tahap = $this->input->post('tahap');
                $tahun = tahun_anggaran();
                $id_instansi = sbe_crypt($this->input->post('id_instansi'), 'D');
                $pergeseran_ke = $this->input->post('pergeseran_ke');
                if ($this->input->post('pergeseran_ke')) {
                    $where = ['kode_tahap'=>$tahap,   'id_instansi' => $id_instansi,  'tahun' => $tahun, 'pergeseran_ke'=>$pergeseran_ke];
                }else{
                    $where = ['kode_tahap'=>$tahap,   'id_instansi' => $id_instansi,  'tahun' => $tahun];

                }

            if ($validation->run($this)) {
                

                $pagu_instansi_kab_kota    = $this->db->get_where('anggaran_instansi_kab_kota', $where);
                if ($pagu_instansi_kab_kota->num_rows()>0) {
                    $id_paket_pekerjaan = $data_apbd_kab_kota_model->saveedit_anggaran_instansi_kab_kota($where);
                    
                }else{
                    $id_paket_pekerjaan = $data_apbd_kab_kota_model->save_anggaran_instansi_kab_kota();
                }


                    $output['success']     = true;
                    $output['messages'] = "Pagu berhasil di simpan";
                    $output['cek'] = $where;
                
            } else {
                $output['success'] = false;
                foreach ($_POST as $key => $value) {
                    $output['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($output);
        }
    }




    
    public function update_target_fisik($id_instansi)
    {
        $id_target_apbd = sbe_crypt($this->input->post('pk'), 'D');
        $target_fisik   = $this->input->post('value');
        $target         = $this->db->get_where('target_apbd_kab_kota', ['id_target_apbd_kab_kota' => $id_target_apbd])->row_array();
        $target_lalu    = $this->db->get_where('target_apbd_kab_kota', ['id_instansi' => $id_instansi, 'bulan' => $target['bulan'] - 1, 'kode_tahap' => tahapan_apbd(),'tahun' => tahun_anggaran()])->row_array();

        if ($target['bulan'] == 1) {
            $nilai = $target_fisik;
        } elseif ($target['bulan'] > 1 && $target['bulan'] <= 12) {
            $nilai = $target_fisik + $target_lalu['target_fisik'];
        }

        if ($nilai >= 100) {
            for ($i = $target['bulan']; $i <= 12; $i++) {
                if ($i==$target['bulan']) {
                    $target_fisik_otomatis = 100 - $target_lalu['target_fisik'];
                    $this->db->update('target_apbd_kab_kota', ['target_fisik' => 100,'target_fisik_bulanan' => $target_fisik_otomatis], ['id_instansi' => $id_instansi, 'bulan' => $i,  'id_instansi'=>$id_instansi]);
                }else{
                    $this->db->update('target_apbd_kab_kota', ['target_fisik' => 100, 'target_fisik_bulanan' => 0], ['id_instansi' => $id_instansi, 'bulan' => $i,  'id_instansi'=>$id_instansi]);
                }
            }
        } else {
            $this->db->update('target_apbd_kab_kota', ['target_fisik' => $nilai,'target_fisik_bulanan' => $target_fisik], ['id_target_apbd_kab_kota' => $id_target_apbd]);
        }
    }


    
    public function update_target_keuangan($id_instansi, $pagu)
    {
        $id_target_apbd = sbe_crypt($this->input->post('pk'), 'D');
        $t_keu   = $this->input->post('value');
        $target_keu      =str_replace(".", "", $t_keu);
        $target         = $this->db->get_where('target_apbd_kab_kota', ['id_target_apbd_kab_kota' => $id_target_apbd])->row_array();
        $target_lalu    = $this->db->get_where('target_apbd_kab_kota', ['id_instansi' => $id_instansi, 'bulan' => $target['bulan'] - 1, 'kode_tahap' => tahapan_apbd() ,'tahun' => tahun_anggaran()])->row_array();
        // qski = query sub kegiatan instansi
        $tahap = tahapan_apbd();
        $tahun = tahun_anggaran();
        // $qski = $this->db->query("SELECT * from v_sub_kegiatan_apbd where kode_tahap='$tahap' and id_instansi='$id_instansi' and id_instansi='$id_instansi' and tahun='$tahun'")->row();
        //$pagu = 123456 ;//$qski->pagu =="" ? 0 : $qski->pagu;

        // qski error
        if ($target['bulan'] == 1) {
            $nilai = $target_keu;
        } elseif ($target['bulan'] > 1 && $target['bulan'] <= 12) {
            $nilai = $target_keu + $target_lalu['target_keuangan'];
        }

        if ($nilai >= $pagu) {
            for ($i = $target['bulan']; $i <= 12; $i++) {
                 if ($i==$target['bulan']) {
                    $target_keuangan_otomatis = $pagu - $target_lalu['target_keuangan'];
                    $update = $this->db->update('target_apbd_kab_kota', ['target_keuangan' => $pagu,'target_keuangan_bulanan' => $target_keuangan_otomatis], ['id_instansi' => $id_instansi, 'bulan' => $i]);
                }else{
                    $update = $this->db->update('target_apbd_kab_kota', ['target_keuangan' => $pagu, 'target_keuangan_bulanan' => 0], ['id_instansi' => $id_instansi, 'bulan' => $i]);
                }

            }
        } else {
            $update = $this->db->update('target_apbd_kab_kota', ['target_keuangan' => $nilai, 'target_keuangan_bulanan' => $target_keu], ['id_target_apbd_kab_kota' => $id_target_apbd]);
        }


        // echo json_encode($cek_pagu);
    }

   


 public function get_target()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output = [
                'status'    => false,
                'data'      => []
            ];
            $id_instansi = $this->input->post('id_instansi');
            $id_kota = $this->input->post('id_kota');
            $tahap = $this->input->post('tahap');
            $tahun = $this->input->post('tahun');
           
            $where = [
                'id_instansi' => $id_instansi, 
                'id_kota' => $id_kota, 
                'kode_tahap' => $tahap,
                'tahun' => $tahun,
                'id_instansi' => $id_instansi
            ];
            $target                 = $this->db->get_where('target_apbd_kab_kota', $where);
            // $subkeg                 = $this->db->query("SELECT nama_sub_kegiatan, kategori, jenis_sub_kegiatan, keterangan from v_sub_kegiatan_apbd where kode_rekening_sub_kegiatan='$kode_rekening_sub_kegiatan' and kode_tahap='$tahap' and id_instansi='$id_instansi' and tahun = '$tahun'")->row();
            // $nama_sub_kegiatan = $subkeg->kategori =='Sub Kegiatan SKPD' ? $subkeg->nama_sub_kegiatan : $subkeg->nama_sub_kegiatan.'<br>'.$subkeg->jenis_sub_kegiatan.' - '.$subkeg->keterangan;

            // $pecah = explode('.', $kode_rekening_sub_kegiatan);
            // $kode_sub_kegiatan = $pecah[0].'.'.$pecah[1].'.'.$pecah[2].'.'.$pecah[3].'.'.$pecah[4].'.'.$pecah[0];
            $output['totaldata']             = $target->num_rows();
            $output['kategori']              = '';//$subkeg->kategori;
            $output['nama_sub_kegiatan']     = '';//$nama_sub_kegiatan;
            $output['kode_sub_kegiatan']     = '';//$kode_sub_kegiatan;
            $output['nama_tahapan']  = nama_tahapan();
            if ($target->num_rows() > 0) {
                foreach ($target->result() as $key => $value) {
                    $output['data'][$key]['id']         = sbe_crypt($value->id_target_apbd_kab_kota, 'E');
                    $output['data'][$key]['bulan']      = $value->bulan;
                    $output['data'][$key]['t_fisik']    = $value->target_fisik;
                    $output['data'][$key]['t_fisik_bulanan']    = $value->target_fisik_bulanan;
                    $output['data'][$key]['t_keuangan'] = $value->target_keuangan;
                    $output['data'][$key]['t_keuangan_bulanan'] = $value->target_keuangan_bulanan;
                }

                $output['status']  = true;
            } else {
                for ($i=0; $i < 12; $i++) { 
                    $bulan = $i+1;
                    $wherenull = [
                        'id_instansi' => $id_instansi, 
                        'id_kota' => $id_kota, 
                        'kode_tahap' => $tahap,
                        'tahun' => $tahun,
                        'bulan' => $bulan,
                        'id_instansi' => id_instansi()
                    ];
                    $cek = $this->db->get_where('target_apbd_kab_kota', $wherenull);
                    if ($cek->num_rows()==0) {
                        $insert = [
                            'id_instansi'=>$id_instansi,
                            'id_kota'=>$id_kota,
                            'kode_tahap'=>$tahap,
                            'bulan'=>$bulan,
                            'target_fisik'=>0,
                            'target_keuangan'=>0,
                            'target_keuangan_bulanan'=>0,
                            'tahun'=>$tahun,
                            'created_on'=> timestamp(), 
                            'created_by'=>id_user()
                        ];
                        $this->db->insert('target_apbd_kab_kota', $insert);
                    }
                }
            }

            echo json_encode($output);
        }
    }




}
