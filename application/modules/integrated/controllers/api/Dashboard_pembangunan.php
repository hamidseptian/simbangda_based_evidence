<?php

/**
 * androidor     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : android.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_pembangunan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->sumber_data = "Sumber Data : ???";
        $this->sumber_data_kab_kota = "???";
        $this->load->model('android/android_model', 'android_model');


            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: *");

        $this->load->model([

            'Laporan/realisasi_akumulasi_model'     => 'realisasi_akumulasi_model',
            'integrated/Integrasi_dashboard_pembangunan_model'       => 'dashboard_pembangunan_model',
            'dashboard/dashboard_model'       => 'dashboard_model',
        ]);
    }

    public function tahapan_apbd_aktif()
    {
        $tahap = tahapan_apbd();
            $output = [
             'kode_tahap'=>$tahap,
          
        ];

            header('Content-Type: application/json');
        echo json_encode($output);
    }
    public function index()
    {
        
        $dashboard_pembangunan    = $this->dashboard_pembangunan_model;
        $bulan_parameter = $this->input->get('bulan');
        $tahun_parameter = $this->input->get('tahun');
        $tahap_parameter = $this->input->get('tahap');
    	$tahun_aktif = tahun_anggaran();
       
        if ($tahun_parameter) {
        	if ($tahun_aktif >$tahun_parameter) {
		        $bulan = 12;
		        $bulan_filter= 12;
				 if ($bulan_parameter) {
			        $bulan = $bulan_parameter;
		        }else{
			        $bulan = $bulan_filter;
		        }
        	}else{
		        $bulan = bulan_aktif();
		        $bulan_filter = $bulan;
				 if ($bulan_parameter) {
			        $bulan = $bulan_parameter;
		        }else{
			        $bulan = $bulan_filter;//bulan_aktif();
		        }
        		
        	}
	        
	        $tahun = $tahun_parameter;


        }else{
	        $tahun = tahun_anggaran();
	        $bulan_parameter = $this->input->get('bulan');
	        if ($bulan_parameter) {
		        $bulan = $bulan_parameter;
	        }else{
		        $bulan = bulan_aktif();
	        }
        }


        if ($tahap_parameter) {
	        $tahap = $tahap_parameter;
        }else{
        	if ($tahun_parameter) {
	        	if ($tahun_aktif >$tahun_parameter) {
		          $tahap = 4;
			     }else{
		          $tahap = tahapan_apbd();
			     }
	          // $tahap = 4;
		    }else{
	          $tahap = tahapan_apbd();
		    }
        }




         $q_total = $dashboard_pembangunan->total_dashboard($tahun, $tahap, $bulan)->row_array();

        $pagu_total = $q_total['total_pagu'];

        if ($pagu_total==0) {
          
            $persen_target_keuangan_total =0;
            $persen_target_keuangan_bulanan_total =0;

            $persen_realisasi_keuangan =0;
            $total_target_keuangan =0;
            $total_target_keuangan_bulanan =0;
            $total_realisasi_keuangan =0;
            $total_realisasi_keuangan_bulanan =0;

            $target_fisik_akumulasi =0;
            $target_fisik_bulanan =0;
            $realisasi_fisik_akumulasi =0;
            $realisasi_fisik_bulanan =0;


        }else{
          $persen_target_keuangan_total = ($q_total['total_target_keuangan'] / $q_total['total_pagu']) * 100; 
          $persen_target_keuangan_bulanan_total = ($q_total['total_target_keuangan_bulanan'] / $q_total['total_pagu']) * 100; 

          $persen_realisasi_keuangan = ($q_total['total_realisasi_keuangan'] / $q_total['total_pagu']) * 100; 
          $total_target_keuangan =  $q_total['total_target_keuangan'];
          $total_target_keuangan_bulanan =  $q_total['total_target_keuangan_bulanan'];
          $total_realisasi_keuangan =  $q_total['total_realisasi_keuangan'];
          $total_realisasi_keuangan_bulanan =  $q_total['total_realisasi_keuangan_bulanan'];

          $target_fisik_akumulasi = $q_total['target_fisik'] / $q_total['banyak_opd'];
          $target_fisik_bulanan = $q_total['target_fisik_bulanan'] / $q_total['banyak_opd'];
          $realisasi_fisik_akumulasi = $q_total['realisasi_fisik'] / $q_total['banyak_opd'];
          $realisasi_fisik_bulanan = $q_total['realisasi_fisik_bulanan'] / $q_total['banyak_opd'];

        }


        $grafik_akumulasi    = $this->dashboard_model->get_grafik_total_akumulasi($tahun, $tahap)->result_array();
        //  $grafik_bulanan    = $this->dashboard_model->get_grafik_total_bulanan($tahun, $tahap)->result_array();

        $kumpul_grafik_akumulasi = [];
        foreach($grafik_akumulasi as $k =>$v){
            $deviasi_fisik = round($v['realisasi_fisik'],2) - round($v['target_fisik'],2);
            $deviasi_keuangan = round($v['realisasi_keuangan'],2) - round($v['target_keuangan'],2);
            $data_grafik_akumulasi = [
                'bulan'=>($k + 1),
                'target_fisik'=>round($v['target_fisik'],2),
                'realisasi_fisik'=>round($v['realisasi_fisik'],2),
                'deviasi_fisik'=>round($deviasi_fisik,2),
                'target_keuangan'=>round($v['target_keuangan'],2),
                'realisasi_keuangan'=>round($v['realisasi_keuangan'],2),
                'deviasi_keuangan'=>round($deviasi_keuangan,2),
            ];
                array_push($kumpul_grafik_akumulasi, $data_grafik_akumulasi);

            } 

        // $pencapaian_opd = [
        //     'pagu'=>$pagu_total,
        //     'rp_target_keuangan'=>$total_target_keuangan,
        //     'persen_target_keuangan'=>round($persen_target_keuangan_total,2),
        //     'rp_realisasi_keuangan'=>$total_realisasi_keuangan,
        //     'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan_total,2),

        //     'target_fisik_akumulasi'=>round($target_fisik_akumulasi,2),
        //     'realisasi_fisik_akumulasi'=>round($realisasi_fisik_akumulasi,2),
        //     // 'deviasi_fisik_akumulasi'=>0,

        //     'target_fisik_bulanan'=>$target_fisik_bulanan,
        //     'target_keuangan_bulanan'=>$total_target_keuangan_bulanan,
        //     'persen_target_keuangan_bulanan'=>$total_realisasi_keuangan_bulanan,
        //     // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
        //     // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
        //     // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),

        //     // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'].'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
        // ];

        $output = [
             'status'=>'success',
            'message'=>'Success',
            // 'bulan'=>$bulan,
            'data'=> [
                'tahun'=>$tahun,
                'tahun_aktif'=>$tahun_aktif,
                'tahap'=>$tahap,
                'pagu_total'=>$q_total['total_pagu'],
                'rp_target_keuangan_total'=>$total_target_keuangan,
                'rp_realisasi_keuangan_total'=>$total_realisasi_keuangan,
                // 'persen_target_keuangan_total'=>round($persen_target_keuangan_total,2),
                // 'persen_realisasi_keuangan_total'=>round($persen_realisasi_keuangan_total,2),
                'persen_realisasi'=>round($persen_realisasi_keuangan,2),
                'grafik_akumulasi'=>$kumpul_grafik_akumulasi,
            
            ]
        ];

            header('Content-Type: application/json');
        echo json_encode($output);

    }


    public function data_opd()
    {
        
        $dashboard_pembangunan    = $this->dashboard_pembangunan_model;

        
        $bulan_parameter = $this->input->get('bulan');
        $tahun_parameter = $this->input->get('tahun');
        $tahap_parameter = $this->input->get('tahap');
        $bulan = $bulan_parameter ? $bulan_parameter : bulan_aktif();
       
        if ($tahun_parameter) {
        	$tahun_aktif = tahun_anggaran();
        	if ($tahun_aktif >$tahun_parameter) {
		        $bulan = 12;
		        $bulan_filter= 12;
				 if ($bulan_parameter) {
			        $bulan = $bulan_parameter;
		        }else{
			        $bulan = $bulan_filter;
		        }
        	}else{
		        $bulan = bulan_aktif();
		        $bulan_filter = $bulan;
				 if ($bulan_parameter) {
			        $bulan = $bulan_parameter;
		        }else{
			        $bulan = $bulan_filter;//bulan_aktif();
		        }
        		
        	}
	        
	        $tahun = $tahun_parameter;


        }else{
	        $tahun = tahun_anggaran();
        }
        

        

        
        if ($tahap_parameter) {
	        $tahap = $tahap_parameter;
        }else{
        	if ($tahun_parameter) {
	        	if ($tahun_aktif >$tahun_parameter) {
		          $tahap = 4;
			     }else{
		          $tahap = tahapan_apbd();
			     }
	          // $tahap = 4;
		    }else{
	          $tahap = tahapan_apbd();
		    }
        }



        // $q = $dashboard_pembangunan->laporan_opd($tahun, $tahap, $bulan);
        $q = $dashboard_pembangunan->laporan_opd($tahun, $tahap, $bulan, '', 'tertinggi', 'deviasi_keuangan');

        $data_opd = [];
        foreach ($q->result_array() as $k => $v) {
            $deviasi_fisik_akumulasi = $v['realisasi_fisik_akumulasi'] - $v['target_fisik_akumulasi'] ;
            $deviasi_fisik_bulanan = $v['realisasi_fisik_bulanan'] - $v['target_fisik_bulanan'] ;


            $persen_target_keuangan = $v['pagu_total'] == 0 ? 0 : ($v['rp_target_keuangan_akumulasi'] / $v['pagu_total']) * 100; 
            $persen_realisasi_keuangan = $v['pagu_total'] == 0 ? 0 : ($v['rp_realisasi_keuangan_akumulasi'] / $v['pagu_total']) * 100; 
            $deviasi_keuangan_akumulasi = $persen_realisasi_keuangan - $persen_target_keuangan ; 

            $persen_target_keuangan_bulanan =  $v['pagu_total'] == 0 ? 0 : ($v['rp_target_keuangan_bulanan'] / $v['pagu_total']) * 100; 
            $persen_realisasi_keuangan_bulanan =  $v['pagu_total'] == 0 ? 0 : ($v['rp_realisasi_keuangan_bulanan'] / $v['pagu_total']) * 100; 
            $deviasi_keuangan_bulanan = $persen_realisasi_keuangan_bulanan - $persen_target_keuangan_bulanan ; 
            $data_push = [
                'urutan'=>($k + 1),
                'skpd'=>$v['nama_instansi'],
                'id_parent'=>$v['id_parent'],
                'singkatan_skpd'=>$v['singkatan_nama_instansi'],
                'pagu'=>$v['pagu_total'],

                'target_fisik_akumulasi'=>$v['target_fisik_akumulasi'],
                'realisasi_fisik_akumulasi'=>$v['realisasi_fisik_akumulasi'],
                'deviasi_fisik_akumulasi'=>round($deviasi_fisik_akumulasi,2),

                'rp_target_keuangan'=>$v['rp_target_keuangan_akumulasi'],
                'persen_target_keuangan'=>round($persen_target_keuangan,2),
                'rp_realisasi_keuangan'=>$v['rp_realisasi_keuangan_akumulasi'],
                'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan,2),
                'deviasi_realisasi_keuangan'=>round($deviasi_keuangan_akumulasi,2),


                'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
                'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
                'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),
                


                'rp_target_keuangan_bulanan'=>$v['rp_target_keuangan_bulanan'],
                'persen_target_keuangan_bulanan'=>round($persen_target_keuangan_bulanan,2),
                'rp_realisasi_keuangan_bulanan'=>$v['rp_realisasi_keuangan_bulanan'],
                'persen_realisasi_keuangan_bulanan'=>round($persen_realisasi_keuangan_bulanan,2),
                'deviasi_realisasi_keuangan_bulanan'=>round($deviasi_keuangan_bulanan,2),

                // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
       
                'detail'=> [
                    'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'].'?tahun='.$tahun.'&tahap='.$tahap, //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
                	// 'url' =>base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/',
                	'id_instansi'=> $v['id_instansi'] , 
                	'id_satker'=> $v['integrasi_sipedal_id_instansi'] , 
                	'tahun'=> $v['tahun'] , 
                	'kode_tahap'=> $v['kode_tahap'] , 
                	'bulan'=> $v['bulan'] , 
                ]
            ];
            array_push($data_opd,$data_push);
        }



        $q_opd_belum_ada_data = $dashboard_pembangunan->opd_belum_ada_data($tahun, $tahap, $bulan);
         foreach ($q_opd_belum_ada_data->result_array() as $k => $v) {
            $persen_target_keuangan = 0;
            $persen_realisasi_keuangan = 0;


            $deviasi_fisik_akumulasi = 0;
            $deviasi_fisik_bulanan = 0;
            $pagu_total = $v['pagu_total'] =='' ? 0 : $v['pagu_total'] ;

               $data_push = [
                'skpd'=>$v['nama_instansi'],
                'id_parent'=>@$v['id_parent'],
                  'pagu'=>$pagu_total,

                'target_fisik_akumulasi'=>0,//$v['target_fisik_akumulasi'],
                'realisasi_fisik_akumulasi'=>0,//$v['realisasi_fisik_akumulasi'],
                'deviasi_fisik_akumulasi'=>0,//round($deviasi_fisik_akumulasi,2),

                'rp_target_keuangan'=>0,//$v['rp_target_keuangan_akumulasi'],
                'persen_target_keuangan'=>0,//round($persen_target_keuangan,2),
                'rp_realisasi_keuangan'=>0,//$v['rp_realisasi_keuangan_akumulasi'],
                'persen_realisasi_keuangan'=>0,//round($persen_realisasi_keuangan,2),
                'deviasi_realisasi_keuangan'=>0,//round($deviasi_keuangan_akumulasi,2),


                // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
                // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
                // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),
                // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
       
                'detail'=> [
                    'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'].'?tahun='.$tahun.'&tahap='.$tahap, //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
                		// 'url' =>base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/',
                	'id_instansi'=> $v['id_instansi'] , 
                	'id_satker'=> $v['integrasi_sipedal_id_instansi'] , 
                	'tahun'=> $tahun, 
                	'kode_tahap'=> $tahap, 
                	'bulan'=> $bulan, 
                ]
            ];


            array_push($data_opd,$data_push);
        }



     

        $q_total = $dashboard_pembangunan->total_dashboard($tahun, $tahap, $bulan)->row_array();

        $pagu_total = $q_total['total_pagu'];

        if ($pagu_total==0) {
          
            $persen_target_keuangan_total =0;
            $persen_target_keuangan_bulanan_total =0;

            $persen_realisasi_keuangan_total =0;
            $persen_realisasi =0;
            $total_target_keuangan =0;
            $total_target_keuangan_bulanan =0;
            $total_realisasi_keuangan =0;
            $total_realisasi_keuangan_bulanan =0;

            $target_fisik_akumulasi =0;
            $target_fisik_bulanan =0;
            $realisasi_fisik_akumulasi =0;
            $realisasi_fisik_bulanan =0;


        }else{
          $persen_target_keuangan_total = ($q_total['total_target_keuangan'] / $q_total['total_pagu']) * 100; 
          $persen_target_keuangan_bulanan_total = ($q_total['total_target_keuangan_bulanan'] / $q_total['total_pagu']) * 100; 

          $persen_realisasi_keuangan_total = ($q_total['total_realisasi_keuangan'] / $q_total['total_pagu']) * 100; 
          $persen_realisasi = ($q_total['total_realisasi_keuangan'] / $q_total['total_pagu']) * 100; 
          $total_target_keuangan =  $q_total['total_target_keuangan'];
          $total_target_keuangan_bulanan =  $q_total['total_target_keuangan_bulanan'];
          $total_realisasi_keuangan =  $q_total['total_realisasi_keuangan'];
          $total_realisasi_keuangan_bulanan =  $q_total['total_realisasi_keuangan_bulanan'];

          $target_fisik_akumulasi = $q_total['target_fisik'] / $q_total['banyak_opd'];
          $target_fisik_bulanan = $q_total['target_fisik_bulanan'] / $q_total['banyak_opd'];
          $realisasi_fisik_akumulasi = $q_total['realisasi_fisik'] / $q_total['banyak_opd'];
          $realisasi_fisik_bulanan = $q_total['realisasi_fisik_bulanan'] / $q_total['banyak_opd'];

        }


        $grafik_akumulasi    = $this->dashboard_model->get_grafik_total_akumulasi($tahun, $tahap)->result_array();
        //  $grafik_bulanan    = $this->dashboard_model->get_grafik_total_bulanan($tahun, $tahap)->result_array();

        $kumpul_grafik_akumulasi = [];
        foreach($grafik_akumulasi as $k_grafik =>$v_grafik){
            $deviasi_fisik = round($v_grafik['realisasi_fisik'],2) - round($v_grafik['target_fisik'],2);
            $deviasi_keuangan = round($v_grafik['realisasi_keuangan'],2) - round($v_grafik['target_keuangan'],2);
            $data_grafik_akumulasi = [
                'bulan'=>($k_grafik + 1),
                'target_fisik'=>round($v_grafik['target_fisik'],2),
                'realisasi_fisik'=>round($v_grafik['realisasi_fisik'],2),
                'deviasi_fisik'=>round($deviasi_fisik,2),
                'target_keuangan'=>round($v_grafik['target_keuangan'],2),
                'realisasi_keuangan'=>round($v_grafik['realisasi_keuangan'],2),
                'deviasi_keuangan'=>round($deviasi_keuangan,2),
            ];
                array_push($kumpul_grafik_akumulasi, $data_grafik_akumulasi);

            } 


        $pencapaian_opd = [
            'pagu'=>$pagu_total,
            'rp_target_keuangan'=>$total_target_keuangan,
            'persen_target_keuangan'=>round($persen_target_keuangan_total,2),
            'rp_realisasi_keuangan'=>$total_realisasi_keuangan,
            'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan_total,2),

            'target_fisik_akumulasi'=>round($target_fisik_akumulasi,2),
            'realisasi_fisik_akumulasi'=>round($realisasi_fisik_akumulasi,2),
            // 'deviasi_fisik_akumulasi'=>0,

            'target_fisik_bulanan'=>round($target_fisik_bulanan,2),
            'target_keuangan_bulanan'=>$total_target_keuangan_bulanan,
            'persen_target_keuangan_bulanan'=>round($persen_target_keuangan_bulanan_total,2),
            // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
            // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
            // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),

            // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'].'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
        ];


        $output = [
            'status'=>'success',
            'message'=>'Success',
            'bulan'=> $bulan,
            'pencapaian_opd'=> $pencapaian_opd,
            'data'=> $data_opd,
            'grafik_akumulasi' => $kumpul_grafik_akumulasi
        ];

            header('Content-Type: application/json');
        echo json_encode($output);

    }







    // untuk aplikasi tpp
    public function data_opd_tpp($tahun_url = '', $tahap_url='', $bulan_url='')
    {
        
        
        $dashboard_pembangunan    = $this->dashboard_pembangunan_model;
        $tahun = tahun_anggaran();
        $tahap = tahapan_apbd();
        $bulan_parameter = $this->input->get('bulan');
        if ($bulan_parameter) {
            $bulan = $bulan_parameter;
        }else{
            $bulan = bulan_aktif();
        }
        // $q = $dashboard_pembangunan->laporan_opd($tahun, $tahap, $bulan);
        $q = $dashboard_pembangunan->laporan_opd($tahun, $tahap, $bulan, '', 'tertinggi', 'keuangan');

        $data_opd = [];
        foreach ($q->result_array() as $k => $v) {
            $deviasi_fisik_akumulasi = $v['realisasi_fisik_akumulasi'] - $v['target_fisik_akumulasi'] ;
            $deviasi_fisik_bulanan = $v['realisasi_fisik_bulanan'] - $v['target_fisik_bulanan'] ;


            $persen_target_keuangan = ($v['rp_target_keuangan_akumulasi'] / $v['pagu_total']) * 100; 
            $persen_realisasi_keuangan = ($v['rp_realisasi_keuangan_akumulasi'] / $v['pagu_total']) * 100; 
            $deviasi_keuangan_akumulasi = $persen_realisasi_keuangan - $persen_target_keuangan ; 

            $persen_target_keuangan_bulanan = ($v['rp_target_keuangan_bulanan'] / $v['pagu_total']) * 100; 
            $persen_realisasi_keuangan_bulanan = ($v['rp_realisasi_keuangan_bulanan'] / $v['pagu_total']) * 100; 
            $deviasi_keuangan_bulanan = $persen_realisasi_keuangan_bulanan - $persen_target_keuangan_bulanan ; 
            $data_push = [
                'skpd'=>$v['nama_instansi'],
                'singkatan_skpd'=>$v['singkatan_nama_instansi'],
                'pagu'=>$v['pagu_total'],

                'target_fisik_akumulasi'=>$v['target_fisik_akumulasi'],
                'realisasi_fisik_akumulasi'=>$v['realisasi_fisik_akumulasi'],
                'deviasi_fisik_akumulasi'=>round($deviasi_fisik_akumulasi,2),

                'rp_target_keuangan'=>$v['rp_target_keuangan_akumulasi'],
                'persen_target_keuangan'=>round($persen_target_keuangan,2),
                'rp_realisasi_keuangan'=>$v['rp_realisasi_keuangan_akumulasi'],
                'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan,2),
                'deviasi_realisasi_keuangan'=>round($deviasi_keuangan_akumulasi,2),


                'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
                'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
                'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),
                


                'rp_target_keuangan_bulanan'=>$v['rp_target_keuangan_bulanan'],
                'persen_target_keuangan_bulanan'=>round($persen_target_keuangan_bulanan,2),
                'rp_realisasi_keuangan_bulanan'=>$v['rp_realisasi_keuangan_bulanan'],
                'persen_realisasi_keuangan_bulanan'=>round($persen_realisasi_keuangan_bulanan,2),
                'deviasi_realisasi_keuangan_bulanan'=>round($deviasi_keuangan_bulanan,2),

                // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
       
                'detail'=> [
                    'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan_tpp/'.$v['id_instansi'].'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
                    // 'url' =>base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/',
                    'id_instansi'=> $v['id_instansi'] , 
                    'id_satker'=> $v['integrasi_sipedal_id_instansi'] , 
                    'tahun'=> $v['tahun'] , 
                    'kode_tahap'=> $v['kode_tahap'] , 
                    'bulan'=> $v['bulan'] , 
                ]
            ];
            array_push($data_opd,$data_push);
        }



        $q_opd_belum_ada_data = $dashboard_pembangunan->opd_belum_ada_data($tahun, $tahap, $bulan);
         foreach ($q_opd_belum_ada_data->result_array() as $k => $v) {
            $persen_target_keuangan = 0;
            $persen_realisasi_keuangan = 0;


            $deviasi_fisik_akumulasi = 0;
            $deviasi_fisik_bulanan = 0;
            $pagu_total = $v['pagu_total'] =='' ? 0 : $v['pagu_total'] ;

               $data_push = [
                'skpd'=>$v['nama_instansi'],
                  'pagu'=>$pagu_total,

                'target_fisik_akumulasi'=>0,//$v['target_fisik_akumulasi'],
                'realisasi_fisik_akumulasi'=>0,//$v['realisasi_fisik_akumulasi'],
                'deviasi_fisik_akumulasi'=>0,//round($deviasi_fisik_akumulasi,2),

                'rp_target_keuangan'=>0,//$v['rp_target_keuangan_akumulasi'],
                'persen_target_keuangan'=>0,//round($persen_target_keuangan,2),
                'rp_realisasi_keuangan'=>0,//$v['rp_realisasi_keuangan_akumulasi'],
                'persen_realisasi_keuangan'=>0,//round($persen_realisasi_keuangan,2),
                'deviasi_realisasi_keuangan'=>0,//round($deviasi_keuangan_akumulasi,2),


                // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
                // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
                // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),
                // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
       
                'detail'=> [
                    'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'].$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
                    // 'url' =>base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/',
                    'id_instansi'=> $v['id_instansi'] , 
                    'id_satker'=> $v['integrasi_sipedal_id_instansi'] , 
                    'tahun'=> $tahun, 
                    'kode_tahap'=> $tahap, 
                    'bulan'=> $bulan, 
                ]
            ];


            array_push($data_opd,$data_push);
        }



     

        $q_total = $dashboard_pembangunan->total_dashboard($tahun, $tahap, $bulan)->row_array();

        $pagu_total = $q_total['total_pagu'];

        if ($pagu_total==0) {
          
            $persen_target_keuangan_total =0;
            $persen_target_keuangan_bulanan_total =0;

            $persen_realisasi_keuangan_total =0;
            $persen_realisasi =0;
            $total_target_keuangan =0;
            $total_target_keuangan_bulanan =0;
            $total_realisasi_keuangan =0;
            $total_realisasi_keuangan_bulanan =0;

            $target_fisik_akumulasi =0;
            $target_fisik_bulanan =0;
            $realisasi_fisik_akumulasi =0;
            $realisasi_fisik_bulanan =0;


        }else{
          $persen_target_keuangan_total = ($q_total['total_target_keuangan'] / $q_total['total_pagu']) * 100; 
          $persen_target_keuangan_bulanan_total = ($q_total['total_target_keuangan_bulanan'] / $q_total['total_pagu']) * 100; 

          $persen_realisasi_keuangan_total = ($q_total['total_realisasi_keuangan'] / $q_total['total_pagu']) * 100; 
          $persen_realisasi = ($q_total['total_realisasi_keuangan'] / $q_total['total_pagu']) * 100; 
          $total_target_keuangan =  $q_total['total_target_keuangan'];
          $total_target_keuangan_bulanan =  $q_total['total_target_keuangan_bulanan'];
          $total_realisasi_keuangan =  $q_total['total_realisasi_keuangan'];
          $total_realisasi_keuangan_bulanan =  $q_total['total_realisasi_keuangan_bulanan'];

          $target_fisik_akumulasi = $q_total['target_fisik'] / $q_total['banyak_opd'];
          $target_fisik_bulanan = $q_total['target_fisik_bulanan'] / $q_total['banyak_opd'];
          $realisasi_fisik_akumulasi = $q_total['realisasi_fisik'] / $q_total['banyak_opd'];
          $realisasi_fisik_bulanan = $q_total['realisasi_fisik_bulanan'] / $q_total['banyak_opd'];

        }


        $grafik_akumulasi    = $this->dashboard_model->get_grafik_total_akumulasi($tahun, $tahap)->result_array();
        //  $grafik_bulanan    = $this->dashboard_model->get_grafik_total_bulanan($tahun, $tahap)->result_array();

        $kumpul_grafik_akumulasi = [];
        foreach($grafik_akumulasi as $k_grafik =>$v_grafik){
            $deviasi_fisik = round($v_grafik['realisasi_fisik'],2) - round($v_grafik['target_fisik'],2);
            $deviasi_keuangan = round($v_grafik['realisasi_keuangan'],2) - round($v_grafik['target_keuangan'],2);
            $data_grafik_akumulasi = [
                'bulan'=>($k_grafik + 1),
                'target_fisik'=>round($v_grafik['target_fisik'],2),
                'realisasi_fisik'=>round($v_grafik['realisasi_fisik'],2),
                'deviasi_fisik'=>round($deviasi_fisik,2),
                'target_keuangan'=>round($v_grafik['target_keuangan'],2),
                'realisasi_keuangan'=>round($v_grafik['realisasi_keuangan'],2),
                'deviasi_keuangan'=>round($deviasi_keuangan,2),
            ];
                array_push($kumpul_grafik_akumulasi, $data_grafik_akumulasi);

            } 


        $pencapaian_opd = [
            'pagu'=>$pagu_total,
            'rp_target_keuangan'=>$total_target_keuangan,
            'persen_target_keuangan'=>round($persen_target_keuangan_total,2),
            'rp_realisasi_keuangan'=>$total_realisasi_keuangan,
            'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan_total,2),

            'target_fisik_akumulasi'=>round($target_fisik_akumulasi,2),
            'realisasi_fisik_akumulasi'=>round($realisasi_fisik_akumulasi,2),
            // 'deviasi_fisik_akumulasi'=>0,

            'target_fisik_bulanan'=>round($target_fisik_bulanan,2),
            'target_keuangan_bulanan'=>$total_target_keuangan_bulanan,
            'persen_target_keuangan_bulanan'=>round($persen_target_keuangan_bulanan_total,2),
            // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
            // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
            // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),

            // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'].'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
        ];


        $output = [
            'status'=>'success',
            'message'=>'Success',
            'bulan'=> $bulan,
            'pencapaian_opd'=> $pencapaian_opd,
            'data'=> $data_opd,
            'grafik_akumulasi' => $kumpul_grafik_akumulasi
        ];

            header('Content-Type: application/json');
        echo json_encode($output);

    }
    public function detail_data_opd($id_instansi, $tahun, $tahap, $bulan)
    {
        
        $dashboard_pembangunan    = $this->dashboard_pembangunan_model;
        $q = $dashboard_pembangunan->laporan_sub_kegiatan_opd_gabungan($id_instansi, $tahun, $tahap, $bulan);
        $q_pencapaian_opd = $dashboard_pembangunan->laporan_opd($tahun, $tahap, $bulan, $id_instansi)->row_array();


		$persen_target_keuangan = ($q_pencapaian_opd['rp_target_keuangan_akumulasi'] / $q_pencapaian_opd['pagu_total']) * 100; 
		$persen_target_keuangan_bulanan = ($q_pencapaian_opd['rp_target_keuangan_bulanan'] / $q_pencapaian_opd['pagu_total']) * 100; 
		$persen_realisasi_keuangan = ($q_pencapaian_opd['rp_realisasi_keuangan_akumulasi'] / $q_pencapaian_opd['pagu_total']) * 100; 


		$deviasi_fisik_akumulasi = $q_pencapaian_opd['realisasi_fisik_akumulasi'] - $q_pencapaian_opd['target_fisik_akumulasi'] ;
		$deviasi_fisik_bulanan = $q_pencapaian_opd['realisasi_fisik_bulanan'] - $q_pencapaian_opd['target_fisik_bulanan'] ;
		$pencapaian_opd = [
			'skpd'=>$q_pencapaian_opd['nama_instansi'],
			'pagu'=>$q_pencapaian_opd['pagu_total'],
			'rp_target_keuangan'=>$q_pencapaian_opd['rp_target_keuangan_akumulasi'],
			'persen_target_keuangan'=>round($persen_target_keuangan,2),
			'rp_realisasi_keuangan'=>$q_pencapaian_opd['rp_realisasi_keuangan_akumulasi'],
			'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan,2),

			'target_fisik_akumulasi'=>$q_pencapaian_opd['target_fisik_akumulasi'],
			'realisasi_fisik_akumulasi'=>$q_pencapaian_opd['realisasi_fisik_akumulasi'],
			'deviasi_fisik_akumulasi'=>round($deviasi_fisik_akumulasi,2),

			'target_fisik_bulanan'=>$q_pencapaian_opd['target_fisik_bulanan'],
			'target_keuangan_bulanan'=>$q_pencapaian_opd['rp_target_keuangan_bulanan'],
			'persen_target_keuangan_bulanan'=>$persen_target_keuangan_bulanan,
			// 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
			// 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
			// 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),

			// 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'].'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
		];





        $data_opd = [];
        foreach ($q->result_array() as $k => $v) {
            // $deviasi_fisik_bulanan = $v['realisasi_fisik_bulanan'] - $v['target_fisik_bulanan'];


            $fisik_persen_target = $v['target_fisik_akumulasi'] =='' ? 0 : $v['target_fisik_akumulasi'];
            $fisik_persen_realisasi = $v['realisasi_fisik_akumulasi'] =='' ? 0 : $v['realisasi_fisik_akumulasi'];
            $deviasi_fisik_akumulasi = $v['realisasi_fisik_akumulasi'] - $v['target_fisik_akumulasi'];

            $rp_target_keuangan_akumulasi = $v['rp_target_keuangan_akumulasi'] =='' ? 0 : $v['rp_target_keuangan_akumulasi'];
            $persen_target_keuangan_akumulasi = $v['target_keuangan_akumulasi'] =='' ? 0 : $v['target_keuangan_akumulasi'];
            $rp_realisasi_keuangan_akumulasi = $v['rp_realisasi_keuangan_akumulasi'] =='' ? 0 : $v['rp_realisasi_keuangan_akumulasi'];
            $persen_realisasi_keuangan_akumulasi = $v['realisasi_keuangan_akumulasi'] =='' ? 0 : $v['realisasi_keuangan_akumulasi'];
            $deviasi_keuangan_akumulasi = $v['realisasi_keuangan_akumulasi'] - $v['target_keuangan_akumulasi'];


            $data_push = [
                   'nama_sub_kegiatan'=>$v['nama_sub_kegiatan'],
                        'pptk'=>$v['nama_sub_kegiatan'],
                        'pagu'=>$v['pagu_total'],
                        'persen_target_fisik'=>round($fisik_persen_target,2),
                        'persen_realisasi_fisik'=>round($fisik_persen_realisasi,2),
                        'deviasi_fisik'=>round($deviasi_fisik_akumulasi,2),

                        'rp_target_keuangan'=>$rp_target_keuangan_akumulasi,
                        'rp_realisasi_keuangan'=>$rp_realisasi_keuangan_akumulasi,
                        'persen_target_keuangan'=>round($persen_target_keuangan_akumulasi,2),
                        'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan_akumulasi,2),
                        'deviasi_keuangan'=>round($deviasi_keuangan_akumulasi,2),
                // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd/'.$v['id_instansi'].'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
            ];
            array_push($data_opd,$data_push);
        }





        $output = [
            'status'=>'success',
            'message'=>'Success',
            'bulan'=>$bulan,
            'pencapaian_opd'=>$pencapaian_opd,
            'data'=> $data_opd,
        ];

            header('Content-Type: application/json');
        echo json_encode($output);

    }



    // public function detail_data_opd_pengelompokan($id_instansi, $tahun, $tahap, $bulan)
    public function detail_data_opd_pengelompokan($id_instansi)
    {
		// $id_instansi = $this->input->get('id_instansi');

		$bulan_parameter = $this->input->get('bulan');
        $tahun_parameter = $this->input->get('tahun');
        $tahap_parameter = $this->input->get('tahap');
       
        if ($tahun_parameter) {
        	$tahun_aktif = tahun_anggaran();
        	if ($tahun_aktif >$tahun_parameter) {
		        $bulan = 12;
		        $bulan_filter= 12;
				 if ($bulan_parameter) {
			        $bulan = $bulan_parameter;
		        }else{
			        $bulan = $bulan_filter;
		        }
        	}else{
		        $bulan = bulan_aktif();
		        $bulan_filter = $bulan;
				 if ($bulan_parameter) {
			        $bulan = $bulan_parameter;
		        }else{
			        $bulan = $bulan_filter;//bulan_aktif();
		        }
        		
        	}
	        
	        $tahun = $tahun_parameter;


        }else{
	        $tahun = tahun_anggaran();
        }
        

        

        
        if ($tahap_parameter) {
	        $tahap = $tahap_parameter;
        }else{
        	if ($tahun_parameter) {
	        	if ($tahun_aktif >$tahun_parameter) {
		          $tahap = 4;
			     }else{
		          $tahap = tahapan_apbd();
			     }
	          // $tahap = 4;
		    }else{
	          $tahap = tahapan_apbd();
		    }
        }


        $kode_tahap = $tahap ; 
		
        
        $dashboard_pembangunan    = $this->dashboard_pembangunan_model;

        if ($tahap ==4 ) {
           $q_pagu_opd = "total_anggaran_skpd_perubahan(id_instansi , $tahun) as pagu_total";
        }else{
           $q_pagu_opd = "total_anggaran_skpd_awal(id_instansi , $tahun) as pagu_total";

        }
        $q_opd = $this->db->query("SELECT id_instansi, nama_instansi , $q_pagu_opd from master_instansi where id_instansi='$id_instansi'")->row_array(); 
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
             if ($tahap==4) {
                  $q_pagu = $this->db->query("SELECT sum( bo_bp + bo_bbj + bo_bs + bo_bh + bm_bmt + bm_bmpm + bm_bmgb + bm_bmjji + bm_bmatl + btt + bt_bbh + bt_bbk ) as total_anggaran FROM anggaran_sub_kegiatan where tahun = '$tahun' and id_instansi='$id_instansi' and kode_program='$kode_program' and kode_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where tahun='$tahun' and kode_program='$kode_program' and id_instansi='$id_instansi' and status=1)
                      and status =1")->row_array();
                  $pagu_program = $q_pagu['total_anggaran'] =='' ? 0 : $q_pagu['total_anggaran'];
              }else{
                  $q_pagu = $this->db->query("SELECT total_anggaran_program($kode_tahap,$id_instansi,'$kode_program',$tahun) as pagu ")->row_array();
                  $pagu_program = $q_pagu['pagu'] =='' ? 0 : $q_pagu['pagu'];
              }




            $q_kegiatan = $dashboard_pembangunan->laporan_kegiatan_opd($id_instansi, $tahun, $tahap, $bulan, $kode_program)->result_array();
            $kumpul_kegiatan = [];


            $total_pagu_program = 0;
            $persen_target_fisik_program = 0;
            $persen_realisasi_fisik_program = 0;
            $totalkegiatan_rp_target_keuangan_akumulasi = 0;
            $totalkegiatan_rp_realisasi_keuangan_akumulasi = 0;


            $total_bobot_ski_per_program =0;
            $total_tft_ski_per_program=0;
            $total_rft_ski_per_program=0;
            foreach ($q_kegiatan as $k_kegiatan => $v_kegiatan) {
                $kode_kegiatan = $v_kegiatan['kode_kegiatan'];
                $q_sub_kegiatan = $dashboard_pembangunan->laporan_sub_kegiatan_opd($id_instansi, $tahun, $tahap, $bulan, $kode_kegiatan)->result_array();
                $kumpul_sub_kegiatan = [];
                $total_sub_kegiatan_persen_target_fisik_akumulasi = 0;
                $total_sub_kegiatan_persen_realisasi_fisik_akumulasi = 0;
                $total_sub_kegiatan_rp_target_keuangan_akumulasi = 0;
                $total_sub_kegiatan_rp_realisasi_keuangan_akumulasi = 0;
                $total_pagu_kegiatan= 0;

                 if ($kode_tahap==4) {
                  $q_pagu = $this->db->query("SELECT sum( bo_bp + bo_bbj + bo_bs + bo_bh + bm_bmt + bm_bmpm + bm_bmgb + bm_bmjji + bm_bmatl + btt + bt_bbh + bt_bbk ) as total_anggaran FROM anggaran_sub_kegiatan where tahun='$tahun' and  id_instansi='$id_instansi' and kode_kegiatan='$kode_kegiatan' and kode_sub_kegiatan in (SELECT kode_sub_kegiatan from sub_kegiatan_instansi where tahun='$tahun' and kode_kegiatan='$kode_kegiatan' and id_instansi='$id_instansi' and status=1)
                      and status=1")->row_array();
                  $pagu_kegiatan = $q_pagu['total_anggaran'] =='' ? 0 : $q_pagu['total_anggaran'];
              }else{
                 $q_pagu = $this->db->query("SELECT total_anggaran_kegiatan($kode_tahap,$id_instansi,'$kode_kegiatan',$tahun) as pagu ")->row_array();
                  $pagu_kegiatan = $q_pagu['pagu'] =='' ? 0 : $q_pagu['pagu'];
              }


                $total_bobot_ski_per_kegiatan =0;
                $total_tft_ski_per_kegiatan=0;
                $total_rft_ski_per_kegiatan=0;
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

                     $pecah_kode = explode('.', $value_sk['kode_sub_kegiatan']);
                     @$kode_sub_kegiatan_asli = $pecah_kode[0].'.'.$pecah_kode[1].'.'.$pecah_kode[2].'.'.$pecah_kode[3].'.'.$pecah_kode[4].'.'.$pecah_kode[5];




          $bobot_ski_per_kegiatan = $pagu_total == 0 ? 0 : ($pagu_total/$pagu_kegiatan)*100;
          $tft_ski_per_kegiatan = $persen_target_fisik_akumulasi * $bobot_ski_per_kegiatan /100;
          $rft_ski_per_kegiatan = $persen_realisasi_fisik_akumulasi * $bobot_ski_per_kegiatan /100;
          $total_bobot_ski_per_kegiatan += $bobot_ski_per_kegiatan;
          $total_tft_ski_per_kegiatan += $tft_ski_per_kegiatan;
          $total_rft_ski_per_kegiatan += $rft_ski_per_kegiatan;

          $bobot_ski_per_program =  $pagu_total == 0 ? 0 : ($pagu_total/$pagu_program)*100;
          $tft_ski_per_program = $persen_target_fisik_akumulasi * $bobot_ski_per_program /100;
          $rft_ski_per_program = $persen_realisasi_fisik_akumulasi * $bobot_ski_per_program /100;
          $total_bobot_ski_per_program += $bobot_ski_per_program;
          $total_tft_ski_per_program += $tft_ski_per_program;
          $total_rft_ski_per_program += $rft_ski_per_program;




                    $data_sub_kegiatan = [
                        'kode_sub_kegiatan'=>$value_sk['kode_sub_kegiatan'],
                        'kode_sub_kegiatan_asli'=>$kode_sub_kegiatan_asli,
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
                $persen_target_fisik_kegiatan =  $total_tft_ski_per_kegiatan;//$total_sub_kegiatan_persen_target_fisik_akumulasi / $banyak_sub_kegiatan;
                $persen_realisasi_fisik_kegiatan = $total_rft_ski_per_kegiatan;//$total_sub_kegiatan_persen_realisasi_fisik_akumulasi / $banyak_sub_kegiatan;
                $deviasi_fisik_kegiatan = $persen_realisasi_fisik_kegiatan - $persen_target_fisik_kegiatan ; 

                if ($total_pagu_kegiatan>0) {

                    $persen_target_keuangan_kegiatan = ($total_sub_kegiatan_rp_target_keuangan_akumulasi / $total_pagu_kegiatan) * 100 ;
                    $persen_realisasi_keuangan_kegiatan = ($total_sub_kegiatan_rp_realisasi_keuangan_akumulasi / $total_pagu_kegiatan) * 100 ;
                }else{
                    $persen_target_keuangan_kegiatan = 0;//($total_sub_kegiatan_rp_target_keuangan_akumulasi / $total_pagu_kegiatan) * 100 ;
                    $persen_realisasi_keuangan_kegiatan = 0;//($total_sub_kegiatan_rp_realisasi_keuangan_akumulasi / $total_pagu_kegiatan) * 100 ;

                }
                $deviasi_keuangan_kegiatan = $persen_realisasi_keuangan_kegiatan - $persen_target_keuangan_kegiatan;



                $total_pagu_program +=$total_pagu_kegiatan;
                $persen_target_fisik_program +=$persen_target_fisik_kegiatan;
                $persen_realisasi_fisik_program +=$persen_realisasi_fisik_kegiatan;
                $totalkegiatan_rp_target_keuangan_akumulasi +=$total_sub_kegiatan_rp_target_keuangan_akumulasi;
                $totalkegiatan_rp_realisasi_keuangan_akumulasi +=$total_sub_kegiatan_rp_realisasi_keuangan_akumulasi;


                $data_kegiatan = [
                    'kode_kegiatan'=>$v_kegiatan['kode_kegiatan'], 
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
            $persen_target_fisik_program = $total_tft_ski_per_program;// $persen_target_fisik_program / $banyak_kegiatan;
            $persen_realisasi_fisik_program = $total_rft_ski_per_program;// $persen_realisasi_fisik_program / $banyak_kegiatan;
            $deviasi_fisik_program = $persen_realisasi_fisik_program - $persen_target_fisik_program;
            $persen_target_keuangan_program =  $total_pagu_program == 0 ? 0 : ($totalkegiatan_rp_target_keuangan_akumulasi / $total_pagu_program) * 100 ;
            $persen_realisasi_keuangan_program =  $total_pagu_program == 0 ? 0 : ($totalkegiatan_rp_realisasi_keuangan_akumulasi / $total_pagu_program) * 100 ;
            $deviasi_keuangan_program = $persen_realisasi_keuangan_program - $persen_target_keuangan_program;


            $data_program = [
                'kode_program'=>$v_program['kode_program'],
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





// untuk aplikasi tpp

     public function detail_data_opd_pengelompokan_tpp($id_instansi, $tahun, $tahap, $bulan)
    {
        // $id_instansi = $this->input->get('id_instansi');
        // $tahun = $tahun ;//tahun_anggaran();//$this->input->get('tahun');
        // $tahap = $tahap ;//tahapan_apbd();//$this->input->get('tahap');
        // $bulan = $bulan ;//bulan_aktif();//$this->input->get('bulan');
        // $tahun = tahun_anggaran();//$this->input->get('tahun');
        // $tahap = tahapan_apbd();//$this->input->get('tahap');
        // $bulan = bulan_aktif();//$this->input->get('bulan');
        $dashboard_pembangunan    = $this->dashboard_pembangunan_model;

          if ($tahap ==4 ) {
           $q_pagu_opd = "total_anggaran_skpd_perubahan(id_instansi , $tahun) as pagu_total";
        }else{
           $q_pagu_opd = "total_anggaran_skpd_awal(id_instansi , $tahun) as pagu_total";

        }
        $q_opd = $this->db->query("SELECT id_instansi, nama_instansi , $q_pagu_opd from master_instansi where id_instansi='$id_instansi'")->row_array(); 

      
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

                        'tahapan_apbd'=>pilihan_nama_tahapan($value_sk['kode_tahap']),
                        'kode_sub_kegiatan'=>$value_sk['kode_sub_kegiatan'],
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

                if ($total_pagu_kegiatan>0) {

                    $persen_target_keuangan_kegiatan = ($total_sub_kegiatan_rp_target_keuangan_akumulasi / $total_pagu_kegiatan) * 100 ;
                    $persen_realisasi_keuangan_kegiatan = ($total_sub_kegiatan_rp_realisasi_keuangan_akumulasi / $total_pagu_kegiatan) * 100 ;
                }else{
                    $persen_target_keuangan_kegiatan = 0;//($total_sub_kegiatan_rp_target_keuangan_akumulasi / $total_pagu_kegiatan) * 100 ;
                    $persen_realisasi_keuangan_kegiatan = 0;//($total_sub_kegiatan_rp_realisasi_keuangan_akumulasi / $total_pagu_kegiatan) * 100 ;

                }
                $deviasi_keuangan_kegiatan = $persen_realisasi_keuangan_kegiatan - $persen_target_keuangan_kegiatan;



                $total_pagu_program +=$total_pagu_kegiatan;
                $persen_target_fisik_program +=$persen_target_fisik_kegiatan;
                $persen_realisasi_fisik_program +=$persen_realisasi_fisik_kegiatan;
                $totalkegiatan_rp_target_keuangan_akumulasi +=$total_sub_kegiatan_rp_target_keuangan_akumulasi;
                $totalkegiatan_rp_realisasi_keuangan_akumulasi +=$total_sub_kegiatan_rp_realisasi_keuangan_akumulasi;


                $data_kegiatan = [
                    'kode_kegiatan'=>$v_kegiatan['kode_kegiatan'],
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
            $persen_target_keuangan_program = $total_pagu_program == 0 ? 0 : ($totalkegiatan_rp_target_keuangan_akumulasi / $total_pagu_program) * 100 ;
            $persen_realisasi_keuangan_program = $total_pagu_program == 0 ? 0 : ($totalkegiatan_rp_realisasi_keuangan_akumulasi / $total_pagu_program) * 100 ;
            $deviasi_keuangan_program = $persen_realisasi_keuangan_program - $persen_target_keuangan_program;


            $data_program = [
                'kode_program'=>$v_program['kode_program'],
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
        
        $bulan_parameter = $this->input->get('bulan');
        $tahun_parameter = $this->input->get('tahun');
        $tahap_parameter = $this->input->get('tahap');
        	$tahun_aktif = tahun_anggaran();
       
        
       if ($tahun_parameter) {
        	if ($tahun_aktif >$tahun_parameter) {
		        $bulan = 12;
		        $bulan_filter= 12;
				 if ($bulan_parameter) {
			        $bulan = $bulan_parameter;
		        }else{
			        $bulan = $bulan_filter;
		        }
        	}else{
		        $bulan = bulan_aktif();
		        $bulan_filter = $bulan;
				 if ($bulan_parameter) {
			        $bulan = $bulan_parameter;
		        }else{
			        $bulan = $bulan_filter;//bulan_aktif();
		        }
        		
        	}
	        
	        $tahun = $tahun_parameter;


        }else{
	        $tahun = tahun_anggaran();
	        $bulan_parameter = $this->input->get('bulan');
	        if ($bulan_parameter) {
		        $bulan = $bulan_parameter;
	        }else{
		        $bulan = bulan_aktif();
	        }
        }


        
        if ($tahap_parameter) {
	        $tahap = $tahap_parameter;
        }else{
        	if ($tahun_parameter) {
	        	if ($tahun_aktif >$tahun_parameter) {
		          $tahap = 4;
			     }else{
		          $tahap = tahapan_apbd();
			     }
	          // $tahap = 4;
		    }else{
	          $tahap = tahapan_apbd();
		    }
        }


$bulan_aktif = $bulan;







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
                    'tahun' => $tahun,
                    'tahap' => $tahap,
                    'data' =>$kumpul_grafik_akumulasi
                ];

                
                header('Content-Type: application/json');
               echo json_encode($output);
        
        
        
        
    }






    public function ranking_opd()
    {
        
        $dashboard_pembangunan    = $this->dashboard_pembangunan_model;
        $tahun = tahun_anggaran();
        $tahap = tahapan_apbd();
        $bulan = bulan_aktif();

        $urutan_ranking = 'tertinggi';
        $ranking_berdasarkan = 'keuangan';
        
        // $ranking_berdasarkan = 'deviasi_keuangan';
        $q = $dashboard_pembangunan->laporan_opd($tahun, $tahap, $bulan, '', $urutan_ranking, $ranking_berdasarkan);

        $data_opd = [];
        foreach ($q->result_array() as $k => $v) {
            $deviasi_fisik_akumulasi = $v['realisasi_fisik_akumulasi'] - $v['target_fisik_akumulasi'] ;
            $deviasi_fisik_bulanan = $v['realisasi_fisik_bulanan'] - $v['target_fisik_bulanan'] ;


            $persen_target_keuangan = ($v['rp_target_keuangan_akumulasi'] / $v['pagu_total']) * 100; 
            $persen_realisasi_keuangan = ($v['rp_realisasi_keuangan_akumulasi'] / $v['pagu_total']) * 100; 
            $deviasi_keuangan_akumulasi = $persen_realisasi_keuangan - $persen_target_keuangan ; 
            $data_push = [
                'urutan'=>($k + 1),
                'skpd'=>$v['nama_instansi'],
                'singkatan_skpd'=>$v['singkatan_nama_instansi'],
                'pagu'=>$v['pagu_total'],

                'target_fisik_akumulasi'=>$v['target_fisik_akumulasi'],
                'realisasi_fisik_akumulasi'=>$v['realisasi_fisik_akumulasi'],
                'deviasi_fisik_akumulasi'=>round($deviasi_fisik_akumulasi,2),

                'rp_target_keuangan'=>$v['rp_target_keuangan_akumulasi'],
                'persen_target_keuangan'=>round($persen_target_keuangan,2),
                'rp_realisasi_keuangan'=>$v['rp_realisasi_keuangan_akumulasi'],
                'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan,2),
                'deviasi_realisasi_keuangan'=>round($deviasi_keuangan_akumulasi,2),


                // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
                // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
                // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),
                // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
       
                'detail'=> [
                    'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
                    // 'url' =>base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/',
                    'id_instansi'=> $v['id_instansi'] , 
                    'id_satker'=> $v['integrasi_sipedal_id_instansi'] , 
                    'tahun'=> $v['tahun'] , 
                    'kode_tahap'=> $v['kode_tahap'] , 
                    'bulan'=> $v['bulan'] , 
                ]
            ];
            array_push($data_opd,$data_push);
        }



        $q_opd_belum_ada_data = $dashboard_pembangunan->opd_belum_ada_data($tahun, $tahap, $bulan);
         foreach ($q_opd_belum_ada_data->result_array() as $k => $v) {
            $persen_target_keuangan = 0;
            $persen_realisasi_keuangan = 0;


            $deviasi_fisik_akumulasi = 0;
            $deviasi_fisik_bulanan = 0;
            $pagu_total = $v['pagu_total'] =='' ? 0 : $v['pagu_total'] ;

               $data_push = [
                'skpd'=>$v['nama_instansi'],
                  'pagu'=>$pagu_total,

                'target_fisik_akumulasi'=>0,//$v['target_fisik_akumulasi'],
                'realisasi_fisik_akumulasi'=>0,//$v['realisasi_fisik_akumulasi'],
                'deviasi_fisik_akumulasi'=>0,//round($deviasi_fisik_akumulasi,2),

                'rp_target_keuangan'=>0,//$v['rp_target_keuangan_akumulasi'],
                'persen_target_keuangan'=>0,//round($persen_target_keuangan,2),
                'rp_realisasi_keuangan'=>0,//$v['rp_realisasi_keuangan_akumulasi'],
                'persen_realisasi_keuangan'=>0,//round($persen_realisasi_keuangan,2),
                'deviasi_realisasi_keuangan'=>0,//round($deviasi_keuangan_akumulasi,2),


                // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
                // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
                // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),
                // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
       
                'detail'=> [
                    'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
                    // 'url' =>base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/',
                    'id_instansi'=> $v['id_instansi'] , 
                    'id_satker'=> $v['integrasi_sipedal_id_instansi'] , 
                    'tahun'=> $tahun, 
                    'kode_tahap'=> $tahap, 
                    'bulan'=> $bulan, 
                ]
            ];


            array_push($data_opd,$data_push);
        }



     

        $q_total = $dashboard_pembangunan->total_dashboard($tahun, $tahap, $bulan)->row_array();

        $pagu_total = $q_total['total_pagu'];

        if ($pagu_total==0) {
          
            $persen_target_keuangan_total =0;
            $persen_target_keuangan_bulanan_total =0;

            $persen_realisasi_keuangan_total =0;
            $persen_realisasi =0;
            $total_target_keuangan =0;
            $total_target_keuangan_bulanan =0;
            $total_realisasi_keuangan =0;
            $total_realisasi_keuangan_bulanan =0;

            $target_fisik_akumulasi =0;
            $target_fisik_bulanan =0;
            $realisasi_fisik_akumulasi =0;
            $realisasi_fisik_bulanan =0;


        }else{
          $persen_target_keuangan_total = ($q_total['total_target_keuangan'] / $q_total['total_pagu']) * 100; 
          $persen_target_keuangan_bulanan_total = ($q_total['total_target_keuangan_bulanan'] / $q_total['total_pagu']) * 100; 

          $persen_realisasi_keuangan_total = ($q_total['total_realisasi_keuangan'] / $q_total['total_pagu']) * 100; 
          $persen_realisasi = ($q_total['total_realisasi_keuangan'] / $q_total['total_pagu']) * 100; 
          $total_target_keuangan =  $q_total['total_target_keuangan'];
          $total_target_keuangan_bulanan =  $q_total['total_target_keuangan_bulanan'];
          $total_realisasi_keuangan =  $q_total['total_realisasi_keuangan'];
          $total_realisasi_keuangan_bulanan =  $q_total['total_realisasi_keuangan_bulanan'];

          $target_fisik_akumulasi = $q_total['target_fisik'] / $q_total['banyak_opd'];
          $target_fisik_bulanan = $q_total['target_fisik_bulanan'] / $q_total['banyak_opd'];
          $realisasi_fisik_akumulasi = $q_total['realisasi_fisik'] / $q_total['banyak_opd'];
          $realisasi_fisik_bulanan = $q_total['realisasi_fisik_bulanan'] / $q_total['banyak_opd'];

        }


        $grafik_akumulasi    = $this->dashboard_model->get_grafik_total_akumulasi($tahun, $tahap)->result_array();
        //  $grafik_bulanan    = $this->dashboard_model->get_grafik_total_bulanan($tahun, $tahap)->result_array();

        $kumpul_grafik_akumulasi = [];
        foreach($grafik_akumulasi as $k_grafik =>$v_grafik){
            $deviasi_fisik = round($v_grafik['realisasi_fisik'],2) - round($v_grafik['target_fisik'],2);
            $deviasi_keuangan = round($v_grafik['realisasi_keuangan'],2) - round($v_grafik['target_keuangan'],2);
            $data_grafik_akumulasi = [
                'bulan'=>($k_grafik + 1),
                'target_fisik'=>round($v_grafik['target_fisik'],2),
                'realisasi_fisik'=>round($v_grafik['realisasi_fisik'],2),
                'deviasi_fisik'=>round($deviasi_fisik,2),
                'target_keuangan'=>round($v_grafik['target_keuangan'],2),
                'realisasi_keuangan'=>round($v_grafik['realisasi_keuangan'],2),
                'deviasi_keuangan'=>round($deviasi_keuangan,2),
            ];
                array_push($kumpul_grafik_akumulasi, $data_grafik_akumulasi);

            } 


        $pencapaian_opd = [
            'pagu'=>$pagu_total,
            'rp_target_keuangan'=>$total_target_keuangan,
            'persen_target_keuangan'=>round($persen_target_keuangan_total,2),
            'rp_realisasi_keuangan'=>$total_realisasi_keuangan,
            'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan_total,2),

            'target_fisik_akumulasi'=>round($target_fisik_akumulasi,2),
            'realisasi_fisik_akumulasi'=>round($realisasi_fisik_akumulasi,2),
            // 'deviasi_fisik_akumulasi'=>0,

            'target_fisik_bulanan'=>round($target_fisik_bulanan,2),
            'target_keuangan_bulanan'=>$total_target_keuangan_bulanan,
            'persen_target_keuangan_bulanan'=>round($persen_target_keuangan_bulanan_total,2),
            // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
            // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
            // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),

            // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'].'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
        ];


        $output = [
            'status'=>'success',
            'message'=>'Success',
            'bulan'=> $bulan,
            'pencapaian_opd'=> $pencapaian_opd,
            'data'=> $data_opd,
            'grafik_akumulasi' => $kumpul_grafik_akumulasi
        ];

            header('Content-Type: application/json');
        echo json_encode($output);

    }




    public function ranking_opd_deviasi()
    {
        
        $dashboard_pembangunan    = $this->dashboard_pembangunan_model;
        $tahun = tahun_anggaran();
        $tahap = tahapan_apbd();
        $bulan = bulan_aktif();

        $urutan_ranking = 'tertinggi';
        $ranking_berdasarkan = 'deviasi_keuangan';
        $q = $dashboard_pembangunan->laporan_opd($tahun, $tahap, $bulan, '', $urutan_ranking, $ranking_berdasarkan);

        $data_opd = [];
        foreach ($q->result_array() as $k => $v) {
            $deviasi_fisik_akumulasi = $v['realisasi_fisik_akumulasi'] - $v['target_fisik_akumulasi'] ;
            $deviasi_fisik_bulanan = $v['realisasi_fisik_bulanan'] - $v['target_fisik_bulanan'] ;


            $persen_target_keuangan = ($v['rp_target_keuangan_akumulasi'] / $v['pagu_total']) * 100; 
            $persen_realisasi_keuangan = ($v['rp_realisasi_keuangan_akumulasi'] / $v['pagu_total']) * 100; 
            $deviasi_keuangan_akumulasi = $persen_realisasi_keuangan - $persen_target_keuangan ; 
            $data_push = [
                'skpd'=>$v['nama_instansi'],
                'singkatan_skpd'=>$v['singkatan_nama_instansi'],
                'pagu'=>$v['pagu_total'],

                'target_fisik_akumulasi'=>$v['target_fisik_akumulasi'],
                'realisasi_fisik_akumulasi'=>$v['realisasi_fisik_akumulasi'],
                'deviasi_fisik_akumulasi'=>round($deviasi_fisik_akumulasi,2),

                'rp_target_keuangan'=>$v['rp_target_keuangan_akumulasi'],
                'persen_target_keuangan'=>round($persen_target_keuangan,2),
                'rp_realisasi_keuangan'=>$v['rp_realisasi_keuangan_akumulasi'],
                'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan,2),
                'deviasi_realisasi_keuangan'=>round($deviasi_keuangan_akumulasi,2),


                // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
                // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
                // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),
                // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
       
                'detail'=> [
                    'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
                    // 'url' =>base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/',
                    'id_instansi'=> $v['id_instansi'] , 
                    'id_satker'=> $v['integrasi_sipedal_id_instansi'] , 
                    'tahun'=> $v['tahun'] , 
                    'kode_tahap'=> $v['kode_tahap'] , 
                    'bulan'=> $v['bulan'] , 
                ]
            ];
            array_push($data_opd,$data_push);
        }



        $q_opd_belum_ada_data = $dashboard_pembangunan->opd_belum_ada_data($tahun, $tahap, $bulan);
         foreach ($q_opd_belum_ada_data->result_array() as $k => $v) {
            $persen_target_keuangan = 0;
            $persen_realisasi_keuangan = 0;


            $deviasi_fisik_akumulasi = 0;
            $deviasi_fisik_bulanan = 0;
            $pagu_total = $v['pagu_total'] =='' ? 0 : $v['pagu_total'] ;

               $data_push = [
                'urutan'=>($k + 1),
                'skpd'=>$v['nama_instansi'],
                  'pagu'=>$pagu_total,

                'target_fisik_akumulasi'=>0,//$v['target_fisik_akumulasi'],
                'realisasi_fisik_akumulasi'=>0,//$v['realisasi_fisik_akumulasi'],
                'deviasi_fisik_akumulasi'=>0,//round($deviasi_fisik_akumulasi,2),

                'rp_target_keuangan'=>0,//$v['rp_target_keuangan_akumulasi'],
                'persen_target_keuangan'=>0,//round($persen_target_keuangan,2),
                'rp_realisasi_keuangan'=>0,//$v['rp_realisasi_keuangan_akumulasi'],
                'persen_realisasi_keuangan'=>0,//round($persen_realisasi_keuangan,2),
                'deviasi_realisasi_keuangan'=>0,//round($deviasi_keuangan_akumulasi,2),


                // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
                // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
                // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),
                // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
       
                'detail'=> [
                    'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'], //.'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
                    // 'url' =>base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/',
                    'id_instansi'=> $v['id_instansi'] , 
                    'id_satker'=> $v['integrasi_sipedal_id_instansi'] , 
                    'tahun'=> $tahun, 
                    'kode_tahap'=> $tahap, 
                    'bulan'=> $bulan, 
                ]
            ];


            array_push($data_opd,$data_push);
        }



     

        $q_total = $dashboard_pembangunan->total_dashboard($tahun, $tahap, $bulan)->row_array();

        $pagu_total = $q_total['total_pagu'];

        if ($pagu_total==0) {
          
            $persen_target_keuangan_total =0;
            $persen_target_keuangan_bulanan_total =0;

            $persen_realisasi_keuangan_total =0;
            $persen_realisasi =0;
            $total_target_keuangan =0;
            $total_target_keuangan_bulanan =0;
            $total_realisasi_keuangan =0;
            $total_realisasi_keuangan_bulanan =0;

            $target_fisik_akumulasi =0;
            $target_fisik_bulanan =0;
            $realisasi_fisik_akumulasi =0;
            $realisasi_fisik_bulanan =0;


        }else{
          $persen_target_keuangan_total = ($q_total['total_target_keuangan'] / $q_total['total_pagu']) * 100; 
          $persen_target_keuangan_bulanan_total = ($q_total['total_target_keuangan_bulanan'] / $q_total['total_pagu']) * 100; 

          $persen_realisasi_keuangan_total = ($q_total['total_realisasi_keuangan'] / $q_total['total_pagu']) * 100; 
          $persen_realisasi = ($q_total['total_realisasi_keuangan'] / $q_total['total_pagu']) * 100; 
          $total_target_keuangan =  $q_total['total_target_keuangan'];
          $total_target_keuangan_bulanan =  $q_total['total_target_keuangan_bulanan'];
          $total_realisasi_keuangan =  $q_total['total_realisasi_keuangan'];
          $total_realisasi_keuangan_bulanan =  $q_total['total_realisasi_keuangan_bulanan'];

          $target_fisik_akumulasi = $q_total['target_fisik'] / $q_total['banyak_opd'];
          $target_fisik_bulanan = $q_total['target_fisik_bulanan'] / $q_total['banyak_opd'];
          $realisasi_fisik_akumulasi = $q_total['realisasi_fisik'] / $q_total['banyak_opd'];
          $realisasi_fisik_bulanan = $q_total['realisasi_fisik_bulanan'] / $q_total['banyak_opd'];

        }


        $grafik_akumulasi    = $this->dashboard_model->get_grafik_total_akumulasi($tahun, $tahap)->result_array();
        //  $grafik_bulanan    = $this->dashboard_model->get_grafik_total_bulanan($tahun, $tahap)->result_array();

        $kumpul_grafik_akumulasi = [];
        foreach($grafik_akumulasi as $k_grafik =>$v_grafik){
            $deviasi_fisik = round($v_grafik['realisasi_fisik'],2) - round($v_grafik['target_fisik'],2);
            $deviasi_keuangan = round($v_grafik['realisasi_keuangan'],2) - round($v_grafik['target_keuangan'],2);
            $data_grafik_akumulasi = [
                'bulan'=>($k_grafik + 1),
                'target_fisik'=>round($v_grafik['target_fisik'],2),
                'realisasi_fisik'=>round($v_grafik['realisasi_fisik'],2),
                'deviasi_fisik'=>round($deviasi_fisik,2),
                'target_keuangan'=>round($v_grafik['target_keuangan'],2),
                'realisasi_keuangan'=>round($v_grafik['realisasi_keuangan'],2),
                'deviasi_keuangan'=>round($deviasi_keuangan,2),
            ];
                array_push($kumpul_grafik_akumulasi, $data_grafik_akumulasi);

            } 


        $pencapaian_opd = [
            'pagu'=>$pagu_total,
            'rp_target_keuangan'=>$total_target_keuangan,
            'persen_target_keuangan'=>round($persen_target_keuangan_total,2),
            'rp_realisasi_keuangan'=>$total_realisasi_keuangan,
            'persen_realisasi_keuangan'=>round($persen_realisasi_keuangan_total,2),

            'target_fisik_akumulasi'=>round($target_fisik_akumulasi,2),
            'realisasi_fisik_akumulasi'=>round($realisasi_fisik_akumulasi,2),
            // 'deviasi_fisik_akumulasi'=>0,

            'target_fisik_bulanan'=>round($target_fisik_bulanan,2),
            'target_keuangan_bulanan'=>$total_target_keuangan_bulanan,
            'persen_target_keuangan_bulanan'=>round($persen_target_keuangan_bulanan_total,2),
            // 'target_fisik_bulanan'=>$v['target_fisik_bulanan'],
            // 'realisasi_fisik_bulanan '=>$v['realisasi_fisik_bulanan'],
            // 'deviasi_fisik_bulanan'=>round($deviasi_fisik_akumulasi,2),

            // 'url'=> base_url().'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$v['id_instansi'].'/'.$v['tahun'].'/'.$v['kode_tahap'].'/'.$v['bulan'].'/',
        ];


        $output = [
            'status'=>'success',
            'message'=>'Success',
            'bulan'=> $bulan,
            'pencapaian_opd'=> $pencapaian_opd,
            'data'=> $data_opd,
            'grafik_akumulasi' => $kumpul_grafik_akumulasi
        ];

            header('Content-Type: application/json');
        echo json_encode($output);

    }


 // integrasi replikasi
    public function daftar_opd(){
        $opd = $this->db->query("SELECT id_instansi, kode_opd, nama_instansi, is_active from master_instansi where is_active = 1 and kategori='OPD'")->result_array();
        $output = ['opd'=>$opd];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function get_rfk_opd_replikasi($id_instansi=''){
        $tahun = $this->input->get('tahun');
        $tahap = $this->input->get('tahap');
        $bulan = $this->input->get('bulan');

        if ($id_instansi=='') {
            $opd = $this->db->query("SELECT mi.nama_instansi, mi.is_active, mi.kode_opd, g.*  from grafik g
            left join master_instansi mi on g.id_instansi = mi.id_instansi
            where mi.is_active = 1 and mi.kategori='OPD' and g.tahun='$tahun' and g.kode_tahap='$tahap' and bulan='$bulan'")->result_array();
        }else{
            $opd = $this->db->query("SELECT mi.nama_instansi, mi.is_active, mi.kode_opd, g.*  from grafik g
            left join master_instansi mi on g.id_instansi = mi.id_instansi
            where mi.is_active = 1 and mi.kategori='OPD' and g.tahun='$tahun' and g.kode_tahap='$tahap' and bulan='$bulan' and g.id_instansi='$id_instansi'")->row_array();
        }
        $output = ['opd'=>$opd];
        header('Content-Type: application/json');
        echo json_encode($output);
    }





}
