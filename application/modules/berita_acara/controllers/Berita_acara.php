<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Instansi.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_acara extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'berita_acara/berita_acara_model' => 'berita_acara_model',
            'datatables_model'                         => 'datatables_model'
		]);
	}

	public function setting()
	{
       
    		$breadcrumbs 	= $this->breadcrumbs;
    		$berita_acara  		= $this->berita_acara_model;
    		
            $id_group = $this->session->userdata('id_group');
            $id_user = $this->session->userdata('id_user');
    		$breadcrumbs->add('Home', base_url());
    		$breadcrumbs->add('berita_acara', base_url($this->router->fetch_class()));
    		$breadcrumbs->render();

            $method = $this->router->fetch_method();
            $data['method']           = $method;

    		$data['title']			= "Setting Berita Acara";
    		$data['icon']           = "metismenu-icon pe-7s-culture";
    		$data['description']	= "Menampilkan Setting Berita Acara untuk kebutuhan surat menyurat di Simbangda";
    		   if ($id_group==2) {
    		$data['breadcrumbs']	= '';
                $data['dropdown_option'] = [
                   
                      ['tipe'=>'button', 'caption'=>'Tambah Berita Acara', 'fa'=>'fa fa-plus', 'onclick'=>'tambah_berita_acara()', 'elemen_tambahan'=>'data-toggle="tooltip" title="Tambah Berita Acara"'], 
                  
            
                ];
    		   }else{

    		$data['breadcrumbs']	= '-';
    		   }


            $q = $this->db->query("SELECT id_setting_berita_acara, keterangan, kegiatan, kode_tahap, tahun, tgl_mulai_pelaksanaan, tgl_akhir_pelaksanaan, jam_mulai_pelaksanaan, jam_akhir_pelaksanaan, status, lokasi  from setting_berita_acara order by id_setting_berita_acara desc")->result_array();

            $data['ba']           = $q;
             $data['config']                 = $this->db->get('config')->result_array();
            $nama_tahap = [
                2=>'APBD AWAL',4=>'APBD PERUBAHAN'
            ];
            $data['nama_tahap']                 = $nama_tahap;

    		$page 					= 'berita_acara/index';
    		$data['link']           = $this->router->fetch_method();
    		$data['menu']           = $this->load->view('layout/menu', $data, true);
    		$data['extra_css']		= $this->load->view('berita_acara/css', $data, true);
    		$data['extra_js']		= $this->load->view('berita_acara/js', $data, true);
    		$data['modal']		= $this->load->view('berita_acara/modal', $data, true);
    		$this->template->load('backend_template', $page, $data);
        
	}

	public function laporan()
	{
       
    		$breadcrumbs 	= $this->breadcrumbs;
    		$berita_acara  		= $this->berita_acara_model;

    		$breadcrumbs->add('Home', base_url());
    		$breadcrumbs->add('berita_acara', base_url($this->router->fetch_class()));
    		$breadcrumbs->render();

    		$data['title']			= "Laporan Berita Acara";
    		$data['icon']           = "metismenu-icon pe-7s-culture";
    		$data['description']	= "Menampilkan Setting Berita Acara untuk kebutuhan surat menyurat di Simbangda";
    		$data['breadcrumbs']	= '';
                $data['dropdown_option'] = [
                   
                      ['tipe'=>'button', 'caption'=>'Tambah Setting', 'fa'=>'fa fa-plus', 'onclick'=>'pilih_dan_alihkan_data_apbd()', 'elemen_tambahan'=>'data-toggle="tooltip" title="Memilih data program kegiatan dan sub kegiatan SKPD"'], 
                  
            
                ];


            $q = $this->db->query("SELECT  id_setting_berita_acara, kegiatan, kode_tahap, tahun, tgl_mulai_pelaksanaan, tgl_akhir_pelaksanaan, jam_mulai_pelaksanaan, jam_akhir_pelaksanaan, status, lokasi  from setting_berita_acara order by id_setting_berita_acara desc")->result_array();

            $id_group = $this->session->userdata('id_group');
            $id_instansi = $this->session->userdata('id_instansi');
            if ($id_group ==5) {
                 $instansi = $this->db->query("SELECT  id_instansi, nama_instansi  from master_instansi where kategori='OPD' and is_active='1' and id_instansi = '$id_instansi' order by nama_instansi asc ")->result_array();
                # code...
            }else{
                 $instansi = $this->db->query("SELECT  id_instansi, nama_instansi  from master_instansi where kategori='OPD' and is_active='1' order by nama_instansi asc ")->result_array();

            }
            $data['ba']           = $q;
            $data['instansi']           = $instansi;

    		$page 					= 'berita_acara/laporan';
    		$data['link']           = $this->router->fetch_method();
    		$data['menu']           = $this->load->view('layout/menu', $data, true);
    		$data['extra_css']		= $this->load->view('berita_acara/css', $data, true);
    		$data['extra_js']		= $this->load->view('berita_acara/js_laporan', $data, true);
    		$data['modal']		= $this->load->view('berita_acara/modal', $data, true);
    		$this->template->load('backend_template', $page, $data);
        
	}



	public function pdf_berita_acara()
	{
		$mpdf = new \Mpdf\Mpdf([
		    'mode' => 'utf-8',
		    'format' => 'Legal',
		    'orientation' => 'P',
		    'tempDir' => '/tmp'
		]);
	

		$id_instansi 	= sbe_crypt($this->input->get('id_opd'), 'D');

		$periode 				= $this->input->get('id_periode');
        $pengambilan_data                = $this->input->get('pengambilan_data');
		$q_template = $this->db->query("SELECT iba.*,
			sba.kegiatan,	sba.kode_tahap,	sba.tahun,	sba.lokasi,
			mi.nama_instansi, mi.jenis_pimpinan
		 from isi_berita_acara iba
		 left join setting_berita_acara sba on iba.id_setting_berita_acara = sba.id_setting_berita_acara
			left join master_instansi mi on iba.id_instansi = mi.id_instansi
		 where iba.id_instansi ='$id_instansi' and iba.id_setting_berita_acara='$periode'")->row_array();
		$kode_tahap = $q_template['kode_tahap'];
		$tahun = $q_template['tahun'];
        if ($periode==1) {
            $q_grafik = $this->db->query("SELECT pagu_bo_bp, pagu_bo_bbj, pagu_bo_bs, pagu_bo_bh, pagu_bm_bmt, pagu_bm_bmpm, pagu_bm_bmgb, pagu_bm_bmjji, pagu_bm_bmatl, pagu_btt, pagu_bt_bbh, pagu_bt_bbk, pagu_total, 
                bulan, target_fisik_akumulasi, target_keuangan_akumulasi, 
                realisasi_fisik_akumulasi,realisasi_keuangan_akumulasi 
                from grafik where id_instansi = '$id_instansi' and kode_tahap='$kode_tahap' and tahun = '$tahun' order by bulan asc")->result_array();





            if ($kode_tahap == 2) {
                $q_paket = $this->db->query("SELECT status,jenis_paket from paket_pekerjaan where id_instansi = '$id_instansi' and tahun = '$tahun' and kode_tahap = 2")->result_array();
                # code...
            }else{
                $q_paket = $this->db->query("SELECT status,jenis_paket from paket_pekerjaan where id_instansi = '$id_instansi' and tahun = '$tahun' and status = '1'")->result_array();

            }
            $hitung_swakelola =0;
            $hitung_penyedia =0;
            foreach ($q_paket as $k => $v) {
                if ($kode_tahap==4) {
                    if ($v['status']==1) {
                        if ($v['jenis_paket']=='SWAKELOLA') {
                            $hitung_swakelola++;
                        }else{
                            $hitung_penyedia++;
                        }
                    }
                }else{
                        if ($v['jenis_paket']=='SWAKELOLA') {
                            $hitung_swakelola++;
                        }else{
                            $hitung_penyedia++;
                        }

                }
            }





             $data['tgl_sync']='';
        }else{
    		$q_grafik = $this->db->query("SELECT pagu_bo_bp, pagu_bo_bbj, pagu_bo_bs, pagu_bo_bh, pagu_bm_bmt, pagu_bm_bmpm, pagu_bm_bmgb, pagu_bm_bmjji, pagu_bm_bmatl, pagu_btt, pagu_bt_bbh, pagu_bt_bbk, pagu_total, 
                bulan, target_fisik_akumulasi, target_keuangan_akumulasi, 
                realisasi_fisik_akumulasi,realisasi_keuangan_akumulasi 
                from grafik_berita_acara where id_instansi = '$id_instansi' and kode_tahap='$kode_tahap' and tahun = '$tahun' and id_setting_berita_acara='$periode' order by bulan asc")->result_array();
    		$q_statistika = $this->db->query("SELECT  pagu_bo, pagu_bm, pagu_total, jumlah_paket_swakelola, jumlah_paket_penyedia, last_update  from  statistika_berita_acara  where id_instansi = '$id_instansi' and id_setting_berita_acara='$periode' ")->row_array();
    		$hitung_swakelola =$q_statistika['jumlah_paket_swakelola'];
    		$hitung_penyedia =$q_statistika['jumlah_paket_penyedia'];
             $data['statistika']=$q_statistika;
             $data['tgl_sync']='Di synchromize pada :'.timestamp_lengkap($q_statistika['last_update']);
        }

		if ($q_template['tgl_berita_acara']=='') {
            $data[''] = '';     
		    $html =  $this->load->view('berita_acara/pdf/error', $data, true);
		}else{

		 $hari = date('N', strtotime($q_template['tgl_berita_acara']));
             $nama_hari = nama_hari($hari);
            $pecah_tgl = explode('-', $q_template['tgl_berita_acara']);
            $tgl = terbilang($pecah_tgl[2]);
            $bln = nama_bulan($pecah_tgl[1]);
            $thn = terbilang($pecah_tgl[0]);
            $balik_tgl = $pecah_tgl[2].'-'.$pecah_tgl[1].'-'.$pecah_tgl[0].'';
            $caption_jadwal = ucwords('tanggal '.$tgl.' bulan '.$bln.' tahun '.$thn.' ('.$balik_tgl.')');


         $tgl_ttd = $pecah_tgl[2].' '.nama_bulan($pecah_tgl[1]).' '.$pecah_tgl[0];

         $data['paket_penyedia']= $q_template['tgl_berita_acara'];
         $data['paket_penyedia']= $hitung_penyedia;
         $data['paket_swakelola']= $hitung_swakelola;
         $data['tgl_ttd']= $tgl_ttd;
         $data['caption_jadwal']= $caption_jadwal;
         $data['nama_hari']=$nama_hari;
         $data['grafik']=$q_grafik;
         $data['cek']=$periode;
         $data['nama_tahap']=pilihan_nama_tahapan($q_template['kode_tahap']);
         $data['template']=$q_template;
         // $data['judul_laporan']=$judul_penampilan_laporan;

        if ($periode==1) {
         if ($pengambilan_data == 'Dengan Catatan') {
            $html =  $this->load->view('berita_acara/pdf/print_dengan_catatan_tanpa_deviasi', $data, true);
         }else{
            $html =  $this->load->view('berita_acara/pdf/print_tanpa_catatan_tanpa_deviasi', $data, true);

         }
        }else{


         if ($pengambilan_data == 'Dengan Catatan') {
            $html =  $this->load->view('berita_acara/pdf/print_dengan_catatan_dan_deviasi', $data, true);
             # code...
         }else{
    	    $html =  $this->load->view('berita_acara/pdf/print_tanpa_catatan_dengan_deviasi', $data, true);

         }
        }
		}


        $tanggal_penarikan = date('d').' '.bulan_global(date('n')).' '.date('Y').' - '.date('H:i:s');
        $data['tanggal_penarikan'] = $tanggal_penarikan ;
        $footer =  $this->load->view('berita_acara/pdf/footer', $data, true);

        $mpdf->SetHTMLFooter($footer);
		$mpdf->WriteHTML($html);
		$mpdf->Output('Berita Acara '.$q_template['kegiatan'].' - '.$q_template['nama_instansi'].'.pdf', 'I');
	}




    public function rekap_berita_acara()
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Legal',
            'orientation' => 'L',
            'tempDir' => '/tmp'
        ]);
    


        $periode                = sbe_crypt($this->input->get('id_periode'),'D');
        $q_data = $this->db->query("SELECT iba.*,
            mi.nama_instansi, mi.pimpinan, mi.jenis_pimpinan
         from master_instansi mi 
         left join isi_berita_acara iba on mi.id_instansi = iba.id_instansi and iba.id_setting_berita_acara='$periode'
         where mi.kategori='OPD' and mi.is_active='1' order by mi.nama_instansi asc")->result_array();

        $q_setting = $this->db->query("SELECT kegiatan, kode_tahap, tahun from setting_berita_acara where id_setting_berita_acara='$periode'")->row_array();

        $data['template'] = $q_setting ;
        $data['opd'] = $q_data ;


        $html =  $this->load->view('berita_acara/pdf/print_rekap_ba', $data, true);
        $tanggal_penarikan = date('d').' '.bulan_global(date('n')).' '.date('Y').' - '.date('H:i:s');
        $data['tanggal_penarikan'] = $tanggal_penarikan ;
        $footer =  $this->load->view('berita_acara/pdf/footer', $data, true);

        // $mpdf->SetHTMLFooter($footer);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Berita Acara '.$q_template['kegiatan'].' - '.$q_template['nama_instansi'].'.pdf', 'I');
    }



    public function preview_berita_acara()
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'Legal',
            'orientation' => 'P',
            'tempDir' => '/tmp'
        ]);
    


        $periode                = sbe_crypt($this->input->get('id_periode'),'D');

        $pengambilan_data                = $this->input->get('pengambilan_data');
        $q_template = $this->db->query("SELECT 
            sba.kegiatan,   sba.kode_tahap, sba.tahun,  sba.lokasi
         from setting_berita_acara sba 
         where sba.id_setting_berita_acara='$periode'")->row_array();
        $kode_tahap = $q_template['kode_tahap'];
        $tahun = $q_template['tahun'];




         $hari = date('N', strtotime(date('Y-m-d')));
         $nama_hari = nama_hari($hari);
         $data['nama_hari']=$nama_hari;

            $pecah_tgl = explode('-', date('Y-m-d'));
            $tgl = terbilang($pecah_tgl[2]);
            $bln = nama_bulan($pecah_tgl[1]);
            $thn = terbilang($pecah_tgl[0]);
            $balik_tgl = $pecah_tgl[2].'-'.$pecah_tgl[1].'-'.$pecah_tgl[0].'';
            $caption_jadwal = ucwords('tanggal '.$tgl.' bulan '.$bln.' tahun '.$thn.' ('.$balik_tgl.')');

         $data['caption_jadwal']= $caption_jadwal;


        $data['template'] = $q_setting ;


         $data['nama_tahap']=pilihan_nama_tahapan($q_template['kode_tahap']);


         $tgl_ttd = date('d').' '.nama_bulan(date('n')).' '.date('Y');

         $data['tgl_ttd']= $tgl_ttd;



        $html =  $this->load->view('berita_acara/pdf/print_preview_ba', $data, true);
        $tanggal_penarikan = date('d').' '.bulan_global(date('n')).' '.date('Y').' - '.date('H:i:s');
        $data['tanggal_penarikan'] = $tanggal_penarikan ;
        $footer =  $this->load->view('berita_acara/pdf/footer', $data, true);

        // $mpdf->SetHTMLFooter($footer);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Berita Acara '.$q_template['kegiatan'].' - '.$q_template['nama_instansi'].'.pdf', 'I');
    }





    public function detail_setting($id_berita_acara)
    {
            
            $id_berita_acara = sbe_crypt($id_berita_acara,'D');
            $breadcrumbs    = $this->breadcrumbs;

            $id_group = $this->session->userdata('id_group');
            $id_user = $this->session->userdata('id_user');
            $breadcrumbs->add('Home', base_url());
            $breadcrumbs->add('berita_acara', base_url($this->router->fetch_class()));
            $breadcrumbs->render();

            $method = $this->router->fetch_method();
            $data['title']          = "Setting Berita Acara";
            $data['icon']           = "metismenu-icon pe-7s-culture";
            $data['description']    = "Menampilkan Setting Berita Acara untuk kebutuhan surat menyurat di Simbangda";
            $data['breadcrumbs']    = '-';
                // $data['dropdown_option'] = [
                   
                //       ['tipe'=>'button', 'caption'=>'Tambah Setting', 'fa'=>'fa fa-plus', 'onclick'=>'pilih_dan_alihkan_data_apbd()', 'elemen_tambahan'=>'data-toggle="tooltip" title="Memilih data program kegiatan dan sub kegiatan SKPD"'], 
                  
            
                // ];


            $q = $this->db->query("SELECT * from setting_berita_acara where id_setting_berita_acara='$id_berita_acara'")->row_array();
            $tanggalMulai = $q['tgl_mulai_pelaksanaan'];
            $tanggalSelesai = $q['tgl_akhir_pelaksanaan'];

            // Konversi tanggal menjadi objek DateTime
            $tanggalMulaiObj = new DateTime($tanggalMulai);
            $tanggalSelesaiObj = new DateTime($tanggalSelesai);

            // Buat array untuk menyimpan tanggal
            $daftarTanggal = [];

            // Loop untuk menghasilkan daftar tanggal
            while ($tanggalMulaiObj <= $tanggalSelesaiObj) {
                $daftarTanggal[] = $tanggalMulaiObj->format('Y-m-d');
                $tanggalMulaiObj->modify('+1 day');
            }

          



            // Tanggal mulai dan tanggal selesai


            $data['method']           = $method;
            $data['ba']           = $q;
            $data['daftarTanggal']           = $daftarTanggal;

            $data['config']                 = $this->db->get('config')->result_array();
            $nama_tahap = [
                2=>'APBD AWAL',4=>'APBD PERUBAHAN'
            ];
            $data['nama_tahap']                 = $nama_tahap;
            $data['id_group']                 = $id_group;
            $data['id_user']                 = $id_user;
            $page                   = 'berita_acara/detail';
            $data['link']           = $this->router->fetch_method();
            $data['menu']           = $this->load->view('layout/menu', $data, true);
            $data['extra_css']      = $this->load->view('berita_acara/css', $data, true);
            $data['extra_js']       = $this->load->view('berita_acara/js', $data, true);
            $data['modal']      = $this->load->view('berita_acara/modal', $data, true);
            $this->template->load('backend_template', $page, $data);
        
    }
    public function get_berita_acara()
    {
            
        $id_berita_acara = $this->input->post('id_ba');
        $q = $this->db->query("SELECT * from setting_berita_acara where id_setting_berita_acara='$id_berita_acara'")->row_array();
        echo json_encode($q);

        
    }
    public function cek_synchronize()
    {
         if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $id_opd = $this->input->post('id_opd');
            $periode = $this->input->post('periode');
            $id_instansi = sbe_crypt($id_opd, 'D');
            $q = $this->db->query("SELECT  synchronize  from isi_berita_acara where id_setting_berita_acara='$periode' and id_instansi = '$id_instansi'");
            if ($q->num_rows()==0) {
                $output = [
                        'status' =>0,
                        'pesan' =>'Data jadwal berita acara tidak ditemukan.<br>Silahkan hubungi admin untuk membuat jadwal berita acara',
                    ];
            }else{
                $data = $q->row_array();
                if ($data['synchronize']=='') {
                    $output = [
                        'status' =>1,
                        'pesan' =>'',
                    ];
                }else{
                    $output = [
                        'status' =>0,
                        'pesan' =>'Anda sudah melakukan synchronize pada '.$data['synchronize'].'<br>Silahkan hubungi admin apabila mau melakukan synchronize ulang.!',
                    ];

                }
            }
            echo json_encode($output);
        }
        
    }

    public function selesaikan()
    {
            
        $id_berita_acara = $this->input->post('id');

            $output    = [
                'success' => false,
                'messages' => []
            ];


                $this->db->trans_start();
        $q = $this->db->query("UPDATE isi_berita_acara set status='Selesai' where id_isi_berita_acara='$id_berita_acara'");
        if($this->db->trans_status() === FALSE){// Check if transaction result successful
           $this->db->trans_rollback();
             $output['success']     = false;
            $output['messages'] = "Tidak bisa diselesaikan";
        }else{
            $this->db->trans_commit();
             $output['success'] = true;
            $output['messages'] = "Berita acara diselesaikan";
        }



        echo json_encode($output);

        
    }

    public function reset_synchronize()
    {
            
        $id_berita_acara = $this->input->post('id');
        $id_instansi = $this->input->post('id_instansi');
        $id_setting_berita_acara = $this->input->post('id_setting_berita_acara');

            $output    = [
                'success' => false,
                'messages' => []
            ];


                $this->db->trans_start();
        $this->db->query("UPDATE isi_berita_acara set synchronize='' where id_isi_berita_acara='$id_berita_acara'");
        $this->db->query("DELETE from grafik_berita_acara where id_setting_berita_acara='$id_setting_berita_acara' and id_instansi='$id_instansi'");
        $this->db->query("DELETE from statistika_berita_acara where id_setting_berita_acara='$id_setting_berita_acara' and id_instansi='$id_instansi'");
        if($this->db->trans_status() === FALSE){// Check if transaction result successful
           $this->db->trans_rollback();
             $output['success']     = false;
            $output['messages'] = "Synchronize telah direset. silahkan dilakukan sunchronizy ulang pada laporan berita acara";
        }else{
            $this->db->trans_commit();
             $output['success'] = true;
            $output['messages'] = "Synchronize gagal direset.";
        }



        echo json_encode($output);

        
    }


 public function rule_input_instansi()
    {
        
        return [
            
            [
                'field' => 'keg',
                'label' => 'Kegiatan',
                'rules' => 'required'
            ],
            [
                'field' => 'lokasi',
                'label' => 'Lokasi Pelaksanaan',
                'rules' => 'required'
            ],
            
        ];
    }


    public function simpan_setting_berita_acara()
    {
            
       




 if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output    = [
                'success' => false,
                'messages' => []
            ];
            $validation     = $this->form_validation;
           
            $validation->set_rules($this->rule_input_instansi());
            $validation->set_error_delimiters('<p class="text-danger">', '</p>');
        

           



            if ($validation->run($this)) {
                


                 $id_setting_ba = $this->input->post('id_setting_ba');
                $keg = $this->input->post('keg');
                $ket = $this->input->post('ket');
                $lokasi = $this->input->post('lokasi');
                $tgl_awal = $this->input->post('tgl_awal');
                $tgl_akhir = $this->input->post('tgl_akhir');
                $tahap = $this->input->post('tahap');
                $tahun = $this->input->post('tahun');
                $jam_awal = '08:00:00';
                $jam_akhir = '16:00:00';
                $data = [
                    'kegiatan'=>$keg,
                    'kode_tahap'=>$tahap,
                    'tahun'=>$tahun,
                    'tgl_mulai_pelaksanaan'=>$tgl_awal,
                    'tgl_akhir_pelaksanaan'=>$tgl_akhir,
                    'jam_mulai_pelaksanaan'=>$jam_awal,
                    'jam_akhir_pelaksanaan'=>$jam_akhir,
                    'keterangan'=>$ket,
                    'status'=>1,
                    'lokasi'=>$lokasi,
                ];
                $where = ['id_setting_berita_acara'=>$id_setting_ba];

                $this->session->set_flashdata('pesan','<div class="alert alert-info">Setting berita acara ditambahka</div>');
        $this->db->insert('setting_berita_acara', $data, $where);


                    $output['success']     = true;
                    $output['messages'] = "SKPD berhasil di Perbaharui";
                
            } else {
                $output['success'] = false;
                foreach ($_POST as $key => $value) {
                    $output['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($output);
        }







        
    }






    public function simpanedit_setting_berita_acara()
    {
            
       




 if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $output    = [
                'success' => false,
                'messages' => []
            ];
            $validation     = $this->form_validation;
           
            $validation->set_rules($this->rule_input_instansi());
            $validation->set_error_delimiters('<p class="text-danger">', '</p>');
        

           



            if ($validation->run($this)) {
                


                 $id_setting_ba = $this->input->post('id_setting_ba');
                $keg = $this->input->post('keg');
                $ket = $this->input->post('ket');
                $lokasi = $this->input->post('lokasi');
                $tgl_awal = $this->input->post('tgl_awal');
                $tgl_akhir = $this->input->post('tgl_akhir');
                $tahap = $this->input->post('tahap');
                $tahun = $this->input->post('tahun');
                $jam_awal = '08:00:00';
                $jam_akhir = '16:00:00';
                $data = [
                    'kegiatan'=>$keg,
                    'kode_tahap'=>$tahap,
                    'tahun'=>$tahun,
                    'tgl_mulai_pelaksanaan'=>$tgl_awal,
                    'tgl_akhir_pelaksanaan'=>$tgl_akhir,
                    'jam_mulai_pelaksanaan'=>$jam_awal,
                    'jam_akhir_pelaksanaan'=>$jam_akhir,
                    'keterangan'=>$ket,
                    'status'=>1,
                    'lokasi'=>$lokasi,
                ];
                $where = ['id_setting_berita_acara'=>$id_setting_ba];

                $this->session->set_flashdata('pesan','<div class="alert alert-info">Setting berita acara diperbaharui</div>');
        $this->db->update('setting_berita_acara', $data, $where);


                    $output['success']     = true;
                    $output['messages'] = "SKPD berhasil di Perbaharui";
                
            } else {
                $output['success'] = false;
                foreach ($_POST as $key => $value) {
                    $output['messages'][$key] = form_error($key);
                }
            }
            echo json_encode($output);
        }







        
    }






    public function simpanedit_jadwal_berita_acara()
    {
		 if (!$this->input->is_ajax_request()) {
		            show_404();
		        } else {
		            $output    = [
		                'success' => false,
		                'messages' => []
		            ];
		           
		                 $id_instansi = $this->input->post('id_instansi');
		                 $id_user = $this->input->post('id_user');
		                 $pimpinan = $this->input->post('pimpinan');
		                 $id_setting_ba = $this->input->post('id_setting_ba');
		                 $helpdesk = $this->input->post('helpdesk');
		                 $tgl = $this->input->post('tgl');
		            

		                    $where = ['id_setting_berita_acara'=>$id_setting_ba, 'id_instansi'=>$id_instansi];
		                $cek = $this->db->get_where('isi_berita_acara', $where)->num_rows();
		                if ($cek ==0) {
		                    $data = [
		                        'tgl_berita_acara'=>$tgl,
		                        'id_setting_berita_acara'=>$id_setting_ba,
		                        'id_instansi'=>$id_instansi,
		                        'id_helpdesk'=>$id_user,
		                        'helpdesk'=>$helpdesk,
		                        'pimpinan'=>$pimpinan,
		                    ];
		                    $this->db->insert('isi_berita_acara', $data);

		                }else{
		                    $data = [
		                        'helpdesk'=>$helpdesk,
                                'setting_at'=>'Instansi',
		                        'tgl_berita_acara'=>$tgl,
		                    ];
		                    $where = ['id_setting_berita_acara'=>$id_setting_ba, 'id_instansi'=>$id_instansi];
		                    $this->db->update('isi_berita_acara', $data, $where);
		                }
		                $this->session->set_flashdata('pesan','<div class="alert alert-info">Setting berita acara diperbaharui</div>');

		            echo json_encode($output);
		        }
    }


    public function simpandit_catatan_helpdesk()
    {
		 if (!$this->input->is_ajax_request()) {
		            show_404();
		        } else {
		            $output    = [
		                'success' => false,
		                'messages' => []
		            ];
		           
		                 $id_isi_ba = $this->input->post('id_isi_ba');
		                 $catatan = $this->input->post('catatan');
                         $solusi = $this->input->post('solusi');
		               

		                    $where = ['id_isi_berita_acara'=>$id_isi_ba];
		                    $data = [
		                        'catatan'=>nl2br($catatan),
                                'solusi'=>nl2br($solusi),
		                    ];
		                    $this->db->update('isi_berita_acara', $data, $where);
		            
		                // $this->session->set_flashdata('pesan','<div class="alert alert-info">Setting berita acara diperbaharui</div>');
		                $output    = [
		                'success' => false,
		                'pesan' => 'Catatan berita acara diperbaharui',
		            ];

		            echo json_encode($output);
		        }
    }



    public function synchronize()
    {
         if (!$this->input->is_ajax_request()) {
                    show_404();
                } else {
                    $output    = [
                        'success' => false,
                        'messages' => []
                    ];
                   
                         $id_opd = $this->input->post('id_opd');
                         $id_instansi = sbe_crypt($id_opd,'D');
                         $periode = $this->input->post('periode');
                        
                        $tgls = date('Y-m-d H:i:s');
                         $q = $this->db->query("SELECT kode_tahap, tahun from setting_berita_acara where id_setting_berita_acara='$periode'")->row_array();
                         $tahap = $q['kode_tahap'];
                         $tahun = $q['tahun'];

                         $q_grafik = $this->db->query("SELECT bulan, 
                            target_fisik_akumulasi,target_keuangan_akumulasi,target_fisik_bulanan,target_keuangan_bulanan,
                            realisasi_fisik_akumulasi,realisasi_keuangan_akumulasi,realisasi_fisik_bulanan,realisasi_keuangan_bulanan,
                         pagu_bo_bp, pagu_bo_bbj, pagu_bo_bs, pagu_bo_bh, pagu_bm_bmt, pagu_bm_bmpm, pagu_bm_bmgb, pagu_bm_bmjji, pagu_bm_bmatl, pagu_total
                          from grafik where id_instansi='$id_instansi' and tahun = '$tahun' and kode_tahap = '$tahap'");
                         $where = ['id_setting_berita_acara'=>$periode, 'id_instansi'=>$id_instansi, 'kode_tahap'=>$tahap, 'tahun'=>$tahun];
                         $kumpul_grafik = [];
                         if (count($q_grafik->result_array()) > 0 ) {
                             foreach ($q_grafik->result_array() as $k => $v) {
                                $data = [
                                'kode_tahap'=>$tahap,
                                'tahun'=>$tahun,
                                'id_setting_berita_acara'=>$periode,
                                'id_instansi'=>$id_instansi,
                                'bulan'=>$v['bulan'],
                                'target_fisik_akumulasi'=>$v['target_fisik_akumulasi'],
                                'target_keuangan_akumulasi'=>$v['target_keuangan_akumulasi'],
                                'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
                                'target_keuangan_bulanan'=>$v['target_keuangan_bulanan'],
                                'realisasi_fisik_akumulasi'=>$v['realisasi_fisik_akumulasi'],
                                'realisasi_keuangan_akumulasi'=>$v['realisasi_keuangan_akumulasi'],
                                'realisasi_fisik_bulanan'=>$v['realisasi_fisik_bulanan'],
                                'realisasi_keuangan_bulanan'=>$v['realisasi_keuangan_bulanan'],
                                'last_update'=>timestamp()
                            ];
                            array_push($kumpul_grafik, $data);
                             }
                             $this->db->delete('grafik_berita_acara', $where);
                             $this->db->insert_batch('grafik_berita_acara', $kumpul_grafik);
                        if ($tahap = 2) {
                            $q_paket = $this->db->query("SELECT status,jenis_paket from paket_pekerjaan where id_instansi = '$id_instansi' and tahun = '$tahun' and kode_tahap = 2")->result_array();
                            # code...
                        }else{
                            $q_paket = $this->db->query("SELECT status,jenis_paket from paket_pekerjaan where id_instansi = '$id_instansi' and tahun = '$tahun' and status = '1'")->result_array();

                        }
                        $hitung_swakelola =0;
                        $hitung_penyedia =0;
                        foreach ($q_paket as $k => $v) {
                            if ($tahap==4) {
                                if ($v['status']==1) {
                                    if ($v['jenis_paket']=='SWAKELOLA') {
                                        $hitung_swakelola++;
                                    }else{
                                        $hitung_penyedia++;
                                    }
                                }
                            }else{
                                    if ($v['jenis_paket']=='SWAKELOLA') {
                                        $hitung_swakelola++;
                                    }else{
                                        $hitung_penyedia++;
                                    }

                            }
                        }

                        $data_pagu = $q_grafik->row_array();
                        if ($q_grafik->num_rows()>0) {
                            $pagu_bo = $data_pagu['pagu_bo_bp'] + $data_pagu['pagu_bo_bbj'] + $data_pagu['pagu_bo_bs'] + $data_pagu['pagu_bo_bh'];
                            $pagu_bm = $data_pagu['pagu_bm_bmt'] + $data_pagu['pagu_bm_bmpm'] + $data_pagu['pagu_bm_bmgb'] + $data_pagu['pagu_bm_bmjji'] + $data_pagu['pagu_bm_bmatl'];
                            $pagu_total = $data_pagu['pagu_total'];
                        }else{

                            $pagu_bo =0;
                            $pagu_bm =0;
                            $pagu_total =0;
                        }
                        $data_statistik = [
                            'id_instansi'=>$id_instansi ,
                            'id_setting_berita_acara'=>$periode,
                            'pagu_bo'=>$pagu_bo,
                            'pagu_bm'=>$pagu_bm,
                            'pagu_total'=>$pagu_total,
                            'kode_tahap'=>$tahap,
                            'tahun'=>$tahun,
                            'jumlah_paket_swakelola'=>$hitung_swakelola,
                            'jumlah_paket_penyedia'=>$hitung_penyedia,
                            'last_update '=>timestamp()
                        ];
                        $this->db->delete('statistika_berita_acara', $where);
                        $this->db->insert('statistika_berita_acara', $data_statistik);

                        $data_iba = ['synchronize'=>$tgls];

                         $where_iba = ['id_setting_berita_acara'=>$periode, 'id_instansi'=>$id_instansi];
                        $this->db->update('isi_berita_acara', $data_iba, $where_iba);






                          $output    = [
                                'success' => true,
                                'pesan' => 'Catatan berita acara diperbaharui',
                            ];


                         }else{
                                $output    = [
                                'success' => false,
                                'pesan' => 'Catatan berita acara diperbaharui',
                            ];

                         }

                           

                    echo json_encode($output);
                }
    }




    public function simpanedit_jadwal_berita_acara_per_asisten()
    {
		 if (!$this->input->is_ajax_request()) {
		            show_404();
		        } else {
		            $output    = [
		                'success' => false,
		                'messages' => []
		            ];
		           
		                 $asisten = $this->input->post('asisten');
		                 $caption_asisten = [204 =>'ASISTEN PEMERINTAHAN DAN KESRA','ASISTEN PEREKONOMIAN DAN PEMBANGUNAN','ASISTEN ADMINISTRASI UMUM'];
		                 $id_setting_ba = $this->input->post('id_setting_ba');
		                 $tgl = $this->input->post('tgl');
		            

		            $instansi = $this->db->query("SELECT mi.id_instansi, mi.nama_pimpinan, hi.id_user, mu.full_name as helpdesk from master_instansi mi 
		            	left join helpdesk_instansi hi on mi.id_instansi = hi.id_instansi
		            	left join master_users mu on hi.id_user = mu.id_user
		             where mi.kategori='OPD' and mi.is_active='1' and mi.id_parent='$asisten'")->result_array();
		            $kumpul_instansi = [];
		            $kumpul_id_instansi = [];
 					foreach ($instansi as $k => $v) {
 						$data = [
 							'tgl_berita_acara'=>$tgl,
 							'id_setting_berita_acara'=>$id_setting_ba,
 							'id_instansi'=>$v['id_instansi'],
 							'id_helpdesk'=>$v['id_user'],
 							'helpdesk'=>$v['helpdesk'],
 							'pimpinan'=>$v['nama_pimpinan'],
                            'setting_at'=>'Asisten'
 						];

 						$kumpul_id_instansi[] = $v['id_instansi'];
 						array_push($kumpul_instansi, $data);
 					}
 						$countdata = count($instansi);
 						$where_id_instansi = join(',', $kumpul_id_instansi);
 						$q_cek = $this->db->query("SELECT id_setting_berita_acara from isi_berita_acara where id_instansi in ($where_id_instansi) and id_setting_berita_acara='$id_setting_ba' and setting_at='Asisten'")->num_rows();
                        if ($q_cek==0) {
     						$this->db->insert_batch('isi_berita_acara', $kumpul_instansi);
                        }else{
                            $q = $this->db->query("UPDATE  isi_berita_acara set tgl_berita_acara='$tgl', setting_at='Asisten' where id_instansi in ($where_id_instansi) and id_setting_berita_acara='$id_setting_ba' and setting_at='Asisten'");
                        }
 						// $q = $this->db->query("DELETE from isi_berita_acara  where id_instansi in ($where_id_instansi) and id_setting_berita_acara='$id_setting_ba'");
 						$output = ['pesan'=>"Jadwal OPD lingkup ".$asisten." diperbaharui"];
		                //     $where = ['id_setting_berita_acara'=>$id_setting_ba];
		                // $cek = $this->db->get_where('isi_berita_acara', $where)->num_rows();
		                // if ($cek ==0) {
		                //     $data = [
		                //         'tgl_berita_acara'=>$tgl,
		                //         'id_setting_berita_acara'=>$id_setting_ba,
		                //         'id_instansi'=>$id_instansi
		                //     ];
		                //     $this->db->insert('isi_berita_acara', $data);

		                // }else{
		                //     $data = [
		                //         'tgl_berita_acara'=>$tgl,
		                //     ];
		                //     $where = ['id_setting_berita_acara'=>$id_setting_ba, 'id_instansi'=>$id_instansi];
		                //     $this->db->update('isi_berita_acara', $data, $where);
		                // }
		                // $this->session->set_flashdata('pesan','<div class="alert alert-info">Setting berita acara diperbaharui</div>');

		            echo json_encode($output);
		        }
    }






    public function jadwal_ba_instansi()
    {
        $data = [];
         $no             = $_POST['start'];
         $start = $no;
         $length             = $_POST['length'];
         $key = $_POST['search']['value'];
         $id_ba = $this->input->post('id_ba');

            $id_group = $this->session->userdata('id_group');
            $id_user = $this->session->userdata('id_user');
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
            0=>'mi.id_instansi',
         ];

         if (!isset($valid_columns[$col])) {
             $order= null;
         }else{
            $order = $valid_columns[$col];
         }

         if ($order!=null) {
             $order_by = "order by mi.id_instansi asc, $order $dir";
             # code...
         }else{
             $order_by = "";

         }
         // untuk order by


         if ($id_group==2) {
         	$where_user = "";
         }else{
         	$where_user = " and iba.id_helpdesk = '$id_user'";

         }



         if ($key) {
         	 $q = $this->db->query("SELECT  mi.nama_instansi, mi.id_instansi, mi.nama_pimpinan, 
	            	iba.id_isi_berita_acara, iba.tgl_berita_acara, iba.id_setting_berita_acara, iba.pimpinan, iba.catatan, iba.solusi, iba.status, iba.synchronize,
	            	hi.id_user, mu.full_name as helpdesk
	            	from master_instansi mi left join isi_berita_acara iba on mi.id_instansi = iba.id_instansi
	            	left join helpdesk_instansi hi on mi.id_instansi = hi.id_instansi
	            	left join master_users mu on hi.id_user = mu.id_user 
	                where kategori='OPD' and mi.is_active='1' and (nama_instansi like'%$key%' )  and  iba.id_setting_berita_acara='$id_ba' $where_user
	             $order_by limit $start, $length ")->result_array();
         }else{
         	
         		 $q = $this->db->query("SELECT  mi.nama_instansi, mi.id_instansi, mi.nama_pimpinan, 
	            	iba.id_isi_berita_acara, iba.tgl_berita_acara, iba.id_setting_berita_acara, iba.pimpinan, iba.catatan, iba.solusi, iba.status, iba.synchronize,
	            	hi.id_user, mu.full_name as helpdesk
	            	from isi_berita_acara iba  
                    left join master_instansi mi on iba.id_instansi = mi.id_instansi 
	            	left join helpdesk_instansi hi on mi.id_instansi = hi.id_instansi
	            	left join master_users mu on hi.id_user = mu.id_user 
	                where iba.id_setting_berita_acara='$id_ba' $where_user 
	             $order_by limit $start, $length ")->result_array();
         	
         }
         $all_data = $this->db->query("SELECT id_isi_berita_acara from isi_berita_acara iba  where iba.id_setting_berita_acara='$id_ba'  $where_user")->num_rows();

        foreach ($q as $k => $v) {
            $no++;

             $hari = date('N', strtotime($v['tgl_berita_acara']));
             $nama_hari = nama_hari($hari);
            $row    = [];
            $row[]  = $no;
            $row[]  = $v['nama_instansi'];
            $row[]  = $v['pimpinan'];
            $row[]  = $v['helpdesk'];
            $jadwal = $v['tgl_berita_acara'] =='' ? 'Belum Ditentukan' : $nama_hari.', '.balikkan_tanggal($v['tgl_berita_acara']);
            if ($id_group==2) {
            $row[]  = '<a href="javascript:void(0)" onclick="ganti_jadwal_ba('."'".$v['id_instansi']."', '".$v['nama_instansi']."', '".$v['id_setting_berita_acara']."', '".$v['id_user']."', '".$v['nama_pimpinan']."', '".$v['helpdesk']."'".')">'.$jadwal.'</a>';
            	# code...
            }else{
            $row[]  = $jadwal;

            }



            if ($jadwal=='Belum Ditentukan') {
            	if ($id_group==2) {
		            $row[]  = '<a href="javascript:void(0)" onclick="Swal.fire(`Error`,`Jadwal berita acara belum ditentukan`,`error`)" style="color:red">Belum ada catatan</a>';
            	}else{
		            $row[]  = '<a href="javascript:void(0)" onclick="Swal.fire(`Error`,`Jadwal berita acara belum ditentukan <br>SIlahkan hubungi admin untuk menginputkan jadwal berita acara`,`error`)" style="color:red">Belum ada catatan</a>';

            	}
            }else{
            	$catatan = str_replace('<br />', '', $v['catatan']);
                $show_catatan = $catatan=='' ? 'Belum ada catatan' : $catatan;
                $solusi = str_replace('<br />', '', $v['solusi']);
                $show_solusi = $solusi=='' ? 'Belum ada solusi' : $solusi;

                if ($v['status']=='Selesai') {
                $row[]  = '<a href="javascript:void(0)" onclick="catatan_helpdesk('."'".$v['id_isi_berita_acara']."', '".$v['nama_instansi']."', '".$v['helpdesk']."', `".$catatan."`, `".$solusi."`".')">'.$show_catatan.'</a>';
                $row[]  = '<a href="javascript:void(0)" onclick="catatan_helpdesk('."'".$v['id_isi_berita_acara']."', '".$v['nama_instansi']."', '".$v['helpdesk']."', `".$catatan."`, `".$solusi."`".')">'.$show_solusi.'</a>';
                    // $row[]  = $show_catatan;
                if ($v['synchronize']=='') {
                    $row[]  = '<span class="badge badge-danger">Belum Synchronize</span>';
                    # code...
                }else{
                    $row[]  = '<span class="badge badge-success">Sudah Synchronize pada <br>'.$v['synchronize'].'</span>';
                }
                $row[]  = $v['status'];
                $row[]  = '
<div class="btn btn-group">
            <a href="javascript:void(0)" onclick="reset_synchronize('."'".$v['id_isi_berita_acara']."','".$v['id_setting_berita_acara']."','".$v['id_instansi']."','".$v['nama_instansi']."'".')"  class="btn btn-outline-info btn-sm">Reset Synchronize</a>
                </div>';
                    # code...
                }else{
	            $row[]  = '<a href="javascript:void(0)" onclick="catatan_helpdesk('."'".$v['id_isi_berita_acara']."', '".$v['nama_instansi']."', '".$v['helpdesk']."', `".$catatan."`, `".$solusi."`".')">'.$show_catatan.'</a>';
                $row[]  = '<a href="javascript:void(0)" onclick="catatan_helpdesk('."'".$v['id_isi_berita_acara']."', '".$v['nama_instansi']."', '".$v['helpdesk']."', `".$catatan."`, `".$solusi."`".')">'.$show_solusi.'</a>';
                  if ($v['synchronize']=='') {
                    $row[]  = '<span class="badge badge-danger">Belum Synchronize</span>';
                    # code...
                }else{
                    $row[]  = '<span class="badge badge-success">Sudah Synchronize pada <br>'.$v['synchronize'].'</span>';
                }
                $row[]  = '<a href="javascript:void(0)" onclick="selesaikan('."'".$v['id_isi_berita_acara']."', '".$v['nama_instansi']."', '".$v['helpdesk']."', `".$catatan."`".')">'.$v['status'].'</a>';
                $row[]  = '
<div class="btn btn-group">

                <a href="javascript:void(0)" onclick="selesaikan('."'".$v['id_isi_berita_acara']."', '".$v['nama_instansi']."', '".$v['helpdesk']."', `".$catatan."`".')" class="btn btn-outline-info btn-sm">Selesaikan</a> <a href="javascript:void(0)" onclick="reset_synchronize('."'".$v['id_isi_berita_acara']."','".$v['id_setting_berita_acara']."','".$v['id_instansi']."','".$v['nama_instansi']."'".')"  class="btn btn-outline-info btn-sm">Reset Synchronize</a>
                </div>';

                }
            }


                $data[] = $row;
            # code...
        }

           
            $output = [
                        "draw"              => $_POST['draw'],
                        "recordsTotal"      => $all_data,
                        "recordsFiltered"   => $all_data,
                        "data"              => $data,
                      ];

            echo json_encode($output);
        
    }





}
