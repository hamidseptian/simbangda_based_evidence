<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : Laporan.php
 */
defined('BASEPATH') or exit('No direct script access allowed');
class Laporan_public extends MY_Controller { 


	public function __construct() {
	parent::__construct(); 
	$this->load->model([
	'realisasi/realisasi_fisik_keuangan_model'    => 'realisasi_fisik_keuangan_model',
	'realisasi/realisasi_keuangan_model'    => 'realisasi_keuangan_model',


	'Laporan/realisasi_akumulasi_model'		=> 'realisasi_akumulasi_model',
	'Laporan/rekap_asisten_model'					=> 'rekap_asisten_model',
	'Laporan/ratarata_fisik_keuangan'					=> 'ratarata_fisik_keuangan',
	'Laporan/rekap_realisasi_total_model'	=> 'rekap_realisasi_total_model',
	'Laporan/jumlah_aktivitas_model'	=> 'jumlah_aktivitas_model',
	'Laporan/rekap_kegiatan_kab_kota'	=> 'rekap_kegiatan_kab_kota',
	'Laporan/lap_realisasi_fisik_keu'	=> 'lap_realisasi_fisik_keu',
	'Laporan/realisasi_per_kab_kota'	=> 'realisasi_per_kab_kota',
	'Laporan/realisasi_gabungan_per_kab_kota'	=> 'realisasi_gabungan_per_kab_kota',
	'Laporan/target_realisasi_model'	=> 'target_realisasi_model',
	'Laporan/rekap_permasalahan_model'	=> 'rekap_permasalahan_model',


	'register_kontrak/daftar_kontrak_model' => 'daftar_kontrak_model',


	'laporan/statistika_model' => 'statistika_model',
	'config/config_model' => 'config_model',
	'data_apbd/data_apbd_model'      => 'data_apbd_model',
			]);
	error_reporting(0);
		}

	
	public function bulan_global($ke){
		$bulan = [
			1=>'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember',
		];
		return $bulan[$ke];
	}
	
	

	public function pdf_laporan_gabungan_realisasi_per_kab_kota()
	{
		$mpdf = new \Mpdf\Mpdf([
		    'mode' => 'utf-8',
		    'format' => [210,330],
		    'orientation' => 'L',
		    'tempDir' => '/tmp'
		]);


		// $mpdf->setFooter('Page {PAGENO}');
		global $id_instansi;
		global $kategori;
		global $bulan;

		
		$id_provinsi 	= 13;//$this->input->get('id_provinsi');
		$wilayah 	= $this->input->get('wilayah');
		$tahap 	= $this->input->get('tahap');
		$tahun 	= $this->input->get('tahun');

		$kategori 		= $this->input->get('kategori');
		$bulan 				= $this->input->get('bulan');
		$fisik_keuangan       = $this->realisasi_fisik_keuangan_model;
		$model_realisasi_gabungan	       = $this->realisasi_gabungan_per_kab_kota;
		// $tahap = $tahap = config_kab_kota()->tahapan_apbd;
		$nama_tahap = [2=>'APBD AWAL',4=>'APBD PERUBAHAN'];
		$show_nama_tahap=$nama_tahap[$tahap];	

		if ($wilayah=='semua') {
		    $list_kota = $this->db->get_where('kota',['id_provinsi'=>$id_provinsi])->result();
		    $nama_wilayah = "";
		}else{
		    $list_kota = $this->db->query("SELECT ckk.id_kota, k.nama_kota from config_kab_kota ckk 
		    	left join kota k on ckk.id_kota = k.id_kota where ckk.wilayah='$wilayah'")->result();
		    $nama_wilayah = "<br>Wilayah ".$wilayah;

		}


		switch ($kategori) {
			case 'akumulasi':
				$ope = '<=';
				$judul_laporan = "Rekapitulasi <br>Laporan realisasi Fisik dan Keuangan (RFK) Kabupaten / kota se sumatera barat [".$show_nama_tahap."]".$nama_wilayah." <br>sampai dengan bulan ".bulan_global($bulan).' '.$tahun;
				break;
			default:
				$ope = '=';
				$judul_laporan = "Rekapitulasi <br>Laporan realisasi Fisik dan Keuangan (RFK) Kabupaten / kota se sumatera barat [".$show_nama_tahap."]".$nama_wilayah."<br>bulan ".bulan_global($bulan).' '.$tahun;
				break;
		}

		
	    $data['list_kota']=$list_kota;	
	    $data['tahap']=$tahap;	
	    $data['tahun']=$tahun;	
	    $data['nama_tahap']=$nama_tahap[$tahap];	
	    $data['model_realisasi_gabungan']=$model_realisasi_gabungan;	
	    $data['bulan']=$bulan;	
	    $data['judul_laporan']=strtoupper($judul_laporan);	
	    $data['title']=str_replace('<br>', ' ', $judul_laporan);

	    $tanggal_penarikan = date('d').' '.bulan_global(date('n')).' '.date('Y').' - '.date('H:i:s');	
	    $data['tanggal_penarikan']=$tanggal_penarikan;
	  
	    $html =  $this->load->view('laporan/pdf/realisasi_gabungan_per_kab_kota/content', $data, true);

	    $header =  $this->load->view('laporan/pdf/realisasi_gabungan_per_kab_kota/header', $data, true);
	    $footer =  $this->load->view('laporan/pdf/realisasi_gabungan_per_kab_kota/footer', $data, true);

	    if ($wilayah=='semua') {
		    $mpdf->SetMargins(0, 0, 48);
		}else{
		    $mpdf->SetMargins(0, 0, 52);
		}

		$mpdf->SetHTMLHeader($header);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->WriteHTML($html);
		$mpdf->Output($judul_laporan.' - '.$nama_instansi.'.pdf', 'I');
	}































	public function pdf_laporan_rekap_asisten()
	{
		$mpdf = new \Mpdf\Mpdf([
		    'mode' => 'utf-8',
		    'format' => 'legal',
		    'orientation' => 'L',
		    'tempDir' => '/tmp',

		]);


		
		global $bulan;
		$bulan 				= $this->input->get('bulan');
		$tahap 				= $this->input->get('tahap');
		$tahun 				= $this->input->get('tahun');
		$kategori 				= $this->input->get('kategori');
		$perhitungan 				= 'Akuntansi'; //$this->input->get('perhitungan');
		$cara_hitung = $perhitungan	;


	    

		$identitas = $this->db->get('identitas')->row_array();
			
		if ($kategori=='Bulanan') {
			$deskripsi_bulan = 'kondisi realisasi bulan '.bulan_global($bulan) . ' ' . $tahun;
		}else{
	       if ($bulan==date('n') && tahun_anggaran()==date('Y')) {
			   $deskripsi_bulan = 'kondisi realisasi sampai ' . (date('d')). ' ' . bulan_global($bulan) . ' ' . $tahun;
	       }else{
		       $deskripsi_bulan = 'kondisi realisasi sampai ' . jml_hari_dalam_bulan($bulan, $tahun) . ' ' . bulan_global($bulan) . ' ' .$tahun;
	       }
		}


	    $data['desc_bulan']=$deskripsi_bulan;

	    $asisten_1 = $this->rekap_asisten_model->get_opd_asisten(204, $bulan, $cara_hitung, $kategori)->result();
		$asisten_2 = $this->rekap_asisten_model->get_opd_asisten(205, $bulan, $cara_hitung, $kategori)->result();
		$asisten_3 = $this->rekap_asisten_model->get_opd_asisten(206, $bulan, $cara_hitung, $kategori)->result();
		$asisten_1_belum_terekap = $this->rekap_asisten_model->get_opd_asisten_belum_terekap(204, $bulan)->result();
		$asisten_2_belum_terekap = $this->rekap_asisten_model->get_opd_asisten_belum_terekap(205, $bulan)->result();
		$asisten_3_belum_terekap = $this->rekap_asisten_model->get_opd_asisten_belum_terekap(206, $bulan)->result();




	    $judul_file="Rekapitulasi SIMBANGDA Based Evidence Per SKPD ". $deskripsi_bulan;
	    $data['judul_laporan']= "Laporan Rekap Realisasi Fisik Dan Keuangan Per SKPD <br>".$deskripsi_bulan;
	    $data['identitas']=$identitas;
	    $data['asisten_1']=$asisten_1;
	    $data['asisten_1_belum_terekap']=$asisten_1_belum_terekap;
	    $data['asisten_2']=$asisten_2;
	    $data['asisten_2_belum_terekap']=$asisten_2_belum_terekap;
	    $data['asisten_3']=$asisten_3;
	    $data['asisten_3_belum_terekap']=$asisten_3_belum_terekap;
	    $data['periode']=pilihan_nama_tahapan($tahap).' Tahun '.$tahun;
	    $tanggal_penarikan = date('d').' '.bulan_global(date('n')).' '.date('Y').' - '.date('H:i:s');
        $data['tanggal_penarikan'] = $tanggal_penarikan ;

	    $html =  $this->load->view('laporan/pdf/realisasi_asisten/content', $data, true);

	    $header =  $this->load->view('laporan/pdf/realisasi_asisten/header', $data, true);
	    $footer =  $this->load->view('laporan/pdf/realisasi_asisten/footer', $data, true);

	    $mpdf->SetMargins(0, 0, 28);

		$mpdf->SetHTMLHeader($header);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->WriteHTML($html);


		// $mpdf->AddPage();

		// $cek_instansi_yang_sudah = $this->db->query("SELECT id_instansi from grafik g
		// 	where  g.kode_tahap = '$tahap'
  //                                 and g.tahun = '$tahun'
  //                                 AND g.bulan = {$bulan}
  //                                 ");
		// $kumpul_instansi_sudah = [];
		// foreach ($cek_instansi_yang_sudah->result_array() as $k => $v) {
		// 	array_push($kumpul_instansi_sudah, $v['id_instansi']);
		// }

		// $id_instansi_yang_sudah = join(",",$kumpul_instansi_sudah);
		// $instansi_yang_belum = $this->db->query("SELECT nama_instansi from master_instansi where 
		// 	is_active=1 
		// 	and id_instansi not in ($id_instansi_yang_sudah) ")->result_array();

		// // $mpdf->WriteHTML(json_encode($instansi_yang_belum));
		$mpdf->Output($judul_file.' - '.str_replace(':', '.', $tanggal_penarikan).'.pdf', 'I');
	}



	public function pdf_laporan_ratarata_realisasi()
	{
		$mpdf = new \Mpdf\Mpdf([
		    'mode' => 'utf-8',
		    'format' => 'legal',
		    'orientation' => 'L',
		    'tempDir' => '/tmp'
		]);


		$bulan 				= $this->input->get('bulan');
		$filter 				= $this->input->get('filter');
		$realisasi 				= $this->input->get('realisasi');
		$tahap 				= $this->input->get('tahap');
		$tahun 				= $this->input->get('tahun');
		$nomenklatur 				= 'baru';//$this->input->get('nomenklatur');
		$kategori_penampilan_laporan 	= $this->input->get('kategori_penampilan_data');

		$kategori 				= $this->input->get('kategori');
		$perhitungan 				= 'Akuntansi';//$this->input->get('perhitungan');
		$cara_hitung = $perhitungan	;

		$identitas = $this->db->get('identitas')->row_array();







		if ($kategori=='Bulanan') {
			$deskripsi_bulan = 'Realisasi bulan '.bulan_global($bulan) . ' ' . tahun_anggaran();
		}else{
	       if ($bulan==date('n') && tahun_anggaran()==date('Y')) {
			   $deskripsi_bulan = 'kondisi realisasi sampai ' . (date('d')). ' ' . bulan_global($bulan) . ' ' . tahun_anggaran();
	       }else{
		       $deskripsi_bulan = 'kondisi realisasi sampai ' . jml_hari_dalam_bulan($bulan, tahun_anggaran()) . ' ' . bulan_global($bulan) . ' ' . tahun_anggaran();
	       }
		}
	    

	    $asisten = [
	    	'semua'=>'Semua SKPD',
	    	'204'=>'SKPD lingkup Asisten Pemerintahan Dan Kesra',
	    	'205'=>'SKPD lingkup Asisten Perekonomian Dan Pembangunan',
	    	'206'=>'SKPD lingkup Asisten Administrasi Umum',
	    ];

	    $skpd = $this->ratarata_fisik_keuangan->skpd($filter, $bulan, $realisasi, $nomenklatur, $cara_hitung, $kategori)->result();
	    $skpd_belum_terekap = $this->ratarata_fisik_keuangan->skpd_belum_terekap($filter, $bulan)->result_array();
	    $kelompok = $asisten[$filter];
	
	    $skpd_terurut = [];
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
            	# code...
            }else{
            	$rp_target_keuangan = $v->rp_target_keuangan_bulanan;
            	$rp_realisasi_keuangan = $v->rp_realisasi_keuangan_bulanan;
            }

            $capaian_fisik = $v->realisasi_fisik == '' ? 0 : $v->realisasi_fisik / $v->target_fisik * 100;
            $capaian_keuangan = $v->realisasi_keuangan == '' ? 0 : $v->realisasi_keuangan / $v->target_keuangan * 100;


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


	    	$data = [
	    		'nama_instansi' => $v->nama_instansi,
	    		'pagu_total' => $v->pagu_total,

	    		// 'pagu_bo' => $v->pagu_bo,
	    		// 'pagu_bm' => $v->pagu_bm,
	    		// 'pagu_btt' => $v->pagu_btt,
	    		// 'pagu_bt' => $v->pagu_bt,

	    		// 'rp_realisasi_keuangan_bo' => $v->rp_realisasi_keuangan_bo,
	    		// 'rp_realisasi_keuangan_bm' => $v->rp_realisasi_keuangan_bm,
	    		// 'rp_realisasi_keuangan_btt' => $v->rp_realisasi_keuangan_btt,
	    		// 'rp_realisasi_keuangan_bt' => $v->rp_realisasi_keuangan_bt,

	    		
	    		'rp_realisasi_keuangan' => $rp_realisasi_keuangan,
	    		'rp_target_keuangan' => $rp_target_keuangan	,
	    		'last_update' => $v->last_update	,
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
	    	array_push($skpd_terurut, $data);

	    	// echo $dev_fisik." - ".$warna_peringatan_dev_fisik.'<br>';
	    }



	    if ($realisasi=='fisik_tertinggi') {
	      $caption_realisasi = "Berdasarkan Realisasi Fisik Tertinggi";
	    }
	    elseif ($realisasi=='fisik_terendah') {
	      $caption_realisasi = "Berdasarkan Realisasi Fisik Terendah";
	    }
	    elseif ($realisasi=='keu_tertinggi') {
	      $caption_realisasi = "Berdasarkan Realisasi Keuangan Tertinggi";
	    }
	    elseif ($realisasi=='keu_terendah') {
	      $caption_realisasi = "Berdasarkan Realisasi Keuangan Terendah";
	    }
	    elseif ($realisasi=='dev_fisik_tertinggi') {
	      $caption_realisasi = "Berdasarkan Deviasi Fisik Tertinggi";
	    }
	    elseif ($realisasi=='dev_keu_tertinggi') {
	      $caption_realisasi = "Berdasarkan Deviasi Keuangan Tertinggi";
	    }
	    elseif ($realisasi=='dev_fisik_terendah') {
	      $caption_realisasi = "Berdasarkan Deviasi Fisik Terendah";
	    }
	    elseif ($realisasi=='dev_keu_terendah') {
	      $caption_realisasi = "Berdasarkan Deviasi Keuangan Terendah";
	    }else{
	      $caption_realisasi = "";

	    }

	     "Laporan ".$kategori." Realisasi Fisik Dan Keuangan Per SKPD ";
	    


	    $judul_file="Rekapitulasi SIMBANGDA Based Evidence Per SKPD ". $deskripsi_bulan;
	    $data['judul_laporan']= "Laporan ".$kategori." Realisasi Fisik Dan Keuangan <br> ".$kelompok.'<br>'.$caption_realisasi." <br> ".$deskripsi_bulan." ";
	    $data['kategori']=$kategori;
	    $data['skpd_belum_terekap']=$skpd_belum_terekap;
	    $data['cara_hitung']=$cara_hitung;
	    $data['identitas']=$identitas;
	    $data['skpd']=$skpd_terurut;
	    $data['tahun']=$tahun;
	    $data['tahap']=$tahap;
	    $data['kelompok']=$kelompok;
	    $data['periode']=pilihan_nama_tahapan($tahap) .' Tahun '.$tahun;
	    $data['caption_realisasi']=$caption_realisasi;
	    $data['realisasi']=$realisasi;
	  	$tanggal_penarikan = date('d').' '.bulan_global(date('n')).' '.date('Y').' - '.date('H:i:s');
        $data['tanggal_penarikan'] = $tanggal_penarikan ;
	  

	     if ($kategori_penampilan_laporan=='perengkingan_dengan_deviasi') {
		  	$data['desc_bulan']= $deskripsi_bulan;
	     	$judul_laporan="Rekapitulasi SIMBANGDA Based Evidence Per SKPD ". $deskripsi_bulan.' '.$kelompok.' '.$caption_realisasi ;
        	$judul_penampilan_laporan = "Penampilan data berdasarkan Sumber Dana, Target, Realisasi, Dan Deviasi";
		    $html =  $this->load->view('laporan/pdf/ratarata_fisik_keuangan/content_perengkingan', $data, true);
        	# code...
        }
        elseif ($kategori_penampilan_laporan=='pagu_dan_realisasi_skpd_per_jenis_belanja_bulanan') {
		  	$data['desc_bulan']= "Kondisi Realisasi Bulan ".bulan_global($bulan) . ' ' . tahun_anggaran();
        	$judul_penampilan_laporan = $judul_laporan.'<br>'."Penampilan data Pagu dan Realisasi Keuangan berdasarkan kelompok jenis belanja";
		    $html =  $this->load->view('laporan/pdf/ratarata_fisik_keuangan/content_skpd_jenis_pelanja', $data, true);
        	# code...
        }
        elseif ($kategori_penampilan_laporan=='pagu_dan_realisasi_skpd_per_jenis_belanja_akumulasi') {
		  	$data['desc_bulan']= "Kondisi Realisasi Sampai Bulan ".bulan_global($bulan) . ' ' . tahun_anggaran();
        	$judul_penampilan_laporan = $judul_laporan.'<br>'."Penampilan data Pagu dan Realisasi Keuangan berdasarkan kelompok jenis belanja";
		    $html =  $this->load->view('laporan/pdf/ratarata_fisik_keuangan/content_skpd_jenis_pelanja', $data, true);
        	# code...
        }



	    $header =  $this->load->view('laporan/pdf/ratarata_fisik_keuangan/header', $data, true);
	    $footer =  $this->load->view('laporan/pdf/ratarata_fisik_keuangan/footer', $data, true);

	    $mpdf->SetMargins(0, 0, 42);

		$mpdf->SetHTMLHeader($header);
		$mpdf->SetHTMLFooter($footer);
		$mpdf->WriteHTML($html);
		$mpdf->Output($judul_laporan.' - '.str_replace(':', '.', $tanggal_penarikan).'.pdf', 'I');
	}


}
