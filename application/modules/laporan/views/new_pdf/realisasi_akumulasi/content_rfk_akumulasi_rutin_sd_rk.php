


      <style>
        .font_laporan{
          font-size:9px;
          font-family: 'arial';
        }
        .table {
          
          border-collapse: collapse;
          width:100%;
        }
        .table td, th {
          border: 0.01em solid ;
          padding:3px;
        }

        .header{
          font-weight:bold;
          text-align : center;
        }


        .logo{
          float:left;
          width : 60px;
        }
        .skpd{
          float:right;
          
        }
        .clearfix{
          clear:both;
          
        }
        .kop{
          text-align:center;
          font-family: 'arial';
        }
        .penutup{
          font-size:6px;
        }
        .copyright{
          font-size:7px;
          float:left;
        }
        .page{
          float:right;
          font-size:7px;
        }
        .pemprov_sumbar{
          font-size:20px;
        }
        .garis_kop1{
          margin-top:5px;
          border-width: 1.6px;
          border-style: solid;
        }
        .garis_kop2{
          margin-top:1px;
          border-width: 1px;
          border-style: solid;
        }
        .judul_laporan{
          margin-top:15px;
          text-align : center;
          font-family: 'arial';
          font-size:10px;
        }
        .nama_kegiatan{
          white-space:pre;
          left: 30px;
        }
      </style>

        <?php   
$hasil = [];
// $total_pagu_opd = 0;
$total_bobot_ski = 0;
$total_tft_ski = 0;
$total_rft_ski = 0;

$total_rp_tk =0;
$total_rp_rk =0;
$total_persen_tf = 0 ;
$total_persen_rf = 0 ;
$total_persen_tk = 0 ;
$total_persen_rk = 0 ;
$total_sisa_pagu = 0;
foreach ($sub_kegiatan as $row) {

    $program  = $row['kode_rekening_program'];
    $kegiatan = $row['kode_rekening_kegiatan'];
    $sub      = $row['kode_rekening_sub_kegiatan'];
    $pagu     = (int) $row['pagu']; // null jadi 0
    // $total_pagu_opd	+= $pagu;


   
    $q_realisasi_keuangan = $this->realisasi_akumulasi_model->get_realisasi_keuangan($row['id_instansi'], $sub, $bulan, $ope,  $row['tahun'], $row['kode_tahap'])->row_array();

    if ($kode_tahap==2) {
      $target = $this->realisasi_akumulasi_model->get_target($row['id_instansi'], $sub, $bulan, $row['kode_tahap'], $row['tahun'])->row_array();
      $nama_tahap = pilihan_nama_tahapan($row['kode_tahap']);
      $where_paket = "AND pp.kode_tahap = 2";
    }else if($kode_tahap ==3){
      $where_paket = "AND pp.kode_tahap = 2";
      if (empty($row['pergeseran_ke'])) {
          $target = $this->realisasi_akumulasi_model->get_target($row['id_instansi'], $sub, $bulan, $row['kode_tahap'], $row['tahun'])->row_array();
          $nama_tahap = "APBD AWAL";
      } else {
          $target = $this->realisasi_akumulasi_model->get_target_pergeseran($row['id_instansi'], $sub, $row['pergeseran_ke'], $bulan, $row['kode_tahap'], $row['tahun'])->row_array();
          $nama_tahap = "APBD AWAL<br>Pergeseran ke-" . $row['pergeseran_ke'];
      }
    }else{

          $target = $this->realisasi_akumulasi_model->get_target($row['id_instansi'], $sub, $bulan, $row['kode_tahap'], $row['tahun'])->row_array();
      $where_paket = "AND pp.status = 1";
      if ($row['kode_tahap']==4) {
        $nama_tahap = "APBD PERUBAHAN";
        # code...
      }else{
        if ($row['pergeseran_ke']=='') {
          $nama_tahap = "APBD AWAL";
          # code...
        }else{
          $nama_tahap = "APBD AWAL<br>Pergeseran ke-".$row['pergeseran_ke'];

        }

      }
    }

    $realisasi_keuangan =$q_realisasi_keuangan['total_realisasi'];
    $persen_realisasi_keuangan = $pagu ==0 ? 0 : ($q_realisasi_keuangan['total_realisasi'] / $pagu) * 100;
    if ($kategori=='akumulasi') {
      $target_fisik = $target['target_fisik'];
      $target_keuangan = $target['target_keuangan'];
      $persen_tk = $pagu == 0 ? 0 : ($target_keuangan / $pagu) * 100;
    }else{
      $target_fisik = $target['target_fisik_bulanan'];
      $target_keuangan = $target['target_keuangan_bulanan'];
      $persen_tk = $pagu == 0 ? 0 : ($target_keuangan / $pagu) * 100;
    }


    $capaian_keu = $persen_tk == 0 ? 0 : ($persen_realisasi_keuangan / $persen_tk)  * 100;
    $sisa_anggaran = $pagu - $realisasi_keuangan ; 
    $deviasi_keuangan = $persen_realisasi_keuangan - $persen_tk;



        $total_paket = $this->realisasi_akumulasi_model->get_total_paket($id_instansi, $sub, $row['tahun'], $row['kode_tahap'])->num_rows();
        $jenis_paket = $this->db->query("SELECT
                    id_paket_pekerjaan, jenis_paket
                  FROM
                    paket_pekerjaan pp 
                  WHERE
                    pp.kode_rekening_sub_kegiatan = '{$sub}'
                    AND pp.id_instansi = {$id_instansi}
                    AND pp.tahun='$tahun' 
                    $where_paket");

       	$jlm_rutin = 0;
       	$jlm_swakelola = 0;
       	$jlm_penyedia = 0;
       	$total_paket = 0;
       	foreach ($jenis_paket->result_array() as $k_jp => $v_jp) {
	       	$total_paket++;
       		if ($v_jp['jenis_paket']=='SWAKELOLA') {
       			$jlm_swakelola++;
       		}
       		elseif ($v_jp=='PENYEDIA') {
       			$jlm_penyedia++;
       		}else{
       			$jlm_rutin++;
       		}
       	}

		$swa = $this->realisasi_akumulasi_model->get_realisasi_fisik($id_instansi, $sub, $bulan, 'SWAKELOLA', $ope, $tahun, $tahap)->row_array();
		$pen = $this->realisasi_akumulasi_model->get_realisasi_fisik($id_instansi, $sub, $bulan, 'PENYEDIA', $ope, $tahun, $tahap)->row_array();
		$swa_tot  = !empty($swa['total']) ? $swa['total'] : 0;
		$pen_tot  = !empty($pen['total']) ? $pen['total'] : 0;
		$jumlah_fisik_per_sub_kegiatan = $total_paket > 0 ? ($swa_tot + $pen_tot ) / $total_paket : 0 ;
		$realisasi_fisik  = $jumlah_fisik_per_sub_kegiatan > 100 ? 100 : $jumlah_fisik_per_sub_kegiatan;
		$capaian_fisik = ($realisasi_fisik / $target_fisik) * 100;
		$deviasi_fisik = ($realisasi_fisik - $target_fisik);


		// mencari bobot dan tertimbang fisik
          $bobot_ski =( $pagu/$pagu_skpd)*100;
          $tft_ski =$target_fisik * $bobot_ski /100;
          $rft_ski =$realisasi_fisik * $bobot_ski /100;
           $total_bobot_ski += $bobot_ski;
          $total_tft_ski += $tft_ski;
          $total_rft_ski += $rft_ski;

          





          if ($deviasi_fisik < -10) {
          	$warna_dev_fisik_ski = 'background:#f8b2b2'; 
          	$total_peringatan_dev_fisik_merah += 1; 
          }
          elseif ($deviasi_fisik <-5  && $deviasi_fisik >=-10) {
          	$warna_dev_fisik_ski = 'background:#fcf3cf';
          	$total_peringatan_dev_fisik_kuning += 1; 
          }
          elseif ($deviasi_fisik <=0  && $deviasi_fisik >=-5) {
          	$warna_dev_fisik_ski = 'background:#d5f5e3';
          	$total_peringatan_dev_fisik_hijau += 1; 
          }else{
          	$warna_dev_fisik_ski = 'background:#ff7cfd';
          	$total_peringatan_dev_fisik_ungu += 1; 
          }

          if ($deviasi_keuangan < -10) {
          	$warna_dev_keu_ski = 'background:#f8b2b2'; 
          	$total_peringatan_dev_keu_merah += 1; 
          }
          elseif ($deviasi_keuangan <-5  && $deviasi_keuangan >=-10) {
          	$warna_dev_keu_ski = 'background:#fcf3cf';
          	$total_peringatan_dev_keu_kuning += 1; 
          }
          elseif ($deviasi_keuangan <=0  && $deviasi_keuangan >=-5) {
          	$warna_dev_keu_ski = 'background:#d5f5e3';
          	$total_peringatan_dev_keu_hijau += 1; 
          }else{
          	$warna_dev_keu_ski = 'background:#ff7cfd';
          	$total_peringatan_dev_keu_ungu += 1; 
          }

          







// -----------------------------------------------------------------------------------------------
    // PROGRAM
    if (!isset($hasil[$program])) {
        $hasil[$program] = [
            'kode_program' => $program,
            'nama_program' =>$master_program[$program],
            'total_pagu' => 0,
            'kegiatan' => []
        ];
    }

    // KEGIATAN
    if (!isset($hasil[$program]['kegiatan'][$kegiatan])) {
        $hasil[$program]['kegiatan'][$kegiatan] = [
            'kode_kegiatan' => $kegiatan,
            'nama_kegiatan' =>$master_kegiatan[$kegiatan],
            'total_pagu' => 0,
            'sub_kegiatan' => []
        ];
    }

    // JUMLAHKAN
    $hasil[$program]['kegiatan'][$kegiatan]['total_pagu'] += $pagu;
    $hasil[$program]['total_pagu'] += $pagu;
    


    // list sub kegiatan

    $total_persen_tf += $target_fisik;
    $total_persen_rf += $realisasi_fisik;
    $total_persen_tk += $persen_tk;
    $total_persen_rk += $persen_realisasi_keuangan;
	$total_rp_tk += $target_keuangan;
	$total_rp_rk += $realisasi_keuangan;
	$total_sisa_pagu += $sisa_anggaran;
  if ($row['kategori']=='Unit Pelaksana') {
    $nama_sub_kegiatan = $row['nama_sub_kegiatan'].'<br>'.$row['jenis_sub_kegiatan'].' - '.$row['keterangan'];
    $pecah_kode_ski = explode('-', $row['kode_rekening_sub_kegiatan']);
    $kode_sub_kegiatan = $pecah_kode_ski[0].'<br>'.$pecah_kode_ski[1];
    # code...
  }else{
    $nama_sub_kegiatan = $row['nama_sub_kegiatan'];
    $kode_sub_kegiatan = $row['kode_rekening_sub_kegiatan'];

  }
    $hasil[$program]['kegiatan'][$kegiatan]['sub_kegiatan'][] = [
        'kode_sub_kegiatan' => $kode_sub_kegiatan,
        'nama_sub_kegiatan' => $nama_sub_kegiatan,
        'tahap_apbd' => $nama_tahap,
        'pagu' => $pagu,
        'tf'=>$target_fisik,
        'rf'=>$realisasi_fisik,
        'tk'=>$target_keuangan,
        'persen_tk'=>$persen_tk,
        'rk'=>$realisasi_keuangan,
        'persen_rk'=>$persen_realisasi_keuangan,
        'capaian_keu'=>$capaian_keu ,
        'capaian_fisik'=>$capaian_fisik ,
        'sisa_anggaran'=>$sisa_anggaran ,
        'deviasi_keuangan'=>$deviasi_keuangan ,
        'deviasi_fisik'=>$deviasi_fisik ,
        'warna_deviasi_fisik_ski'=>$warna_dev_fisik_ski ,
        'warna_deviasi_keu_ski'=>$warna_dev_keu_ski ,
    ];

}




$show_data = [];


  $total_def_f_program_ungu = 0;
  $total_def_k_program_ungu = 0;
  $total_def_f_kegiatan_ungu = 0;
  $total_def_k_kegiatan_ungu = 0;
  $total_def_f_subkeg_ungu = 0;
  $total_def_k_subkeg_ungu = 0;

  $total_def_f_program_hijau = 0;
  $total_def_k_program_hijau = 0;
  $total_def_f_kegiatan_hijau = 0;
  $total_def_k_kegiatan_hijau = 0;
  $total_def_f_subkeg_hijau = 0;
  $total_def_k_subkeg_hijau = 0;

  $total_def_f_program_kuning = 0;
  $total_def_k_program_kuning = 0;
  $total_def_f_kegiatan_kuning = 0;
  $total_def_k_kegiatan_kuning = 0;
  $total_def_f_subkeg_kuning = 0;
  $total_def_k_subkeg_kuning = 0;

  $total_def_f_program_merah = 0;
  $total_def_k_program_merah = 0;
  $total_def_f_kegiatan_merah = 0;
  $total_def_k_kegiatan_merah = 0;
  $total_def_f_subkeg_merah = 0;
  $total_def_k_subkeg_merah = 0;

  $total_program = 0;
  $total_kegiatan = 0;
  $total_sub_keg = 0;

foreach ($hasil as $k_p => $v_p) {
  $total_program++;
	$kumpul_kegiatan = [];


		$total_bobot_program = 0;
		$total_tf_ttb_program = 0;
		$total_rf_ttb_program = 0;
		$total_rp_tk_program =0;
		$total_rp_rk_program =0;


		$total_rp_tk_program =0;
		$total_rp_rk_program =0;

	foreach ($v_p['kegiatan'] as $k_k => $v_k) {
    $total_kegiatan++;
		$kumpul_sub_kegiatan = [];

		$total_bobot_kegiatan = 0;
		$total_tf_ttb_kegiatan = 0;
		$total_rf_ttb_kegiatan = 0;

		$total_rp_tk_kegiatan =0;
		$total_rp_rk_kegiatan =0;
		foreach ($v_k['sub_kegiatan'] as $k_ski => $v_ski) {

      $total_sub_keg++;
			$bobot_ski_kegiatan =( $v_ski['pagu']/$v_k['total_pagu'])*100;
			$tft_ski_kegiatan =($v_ski['tf'] * $bobot_ski_kegiatan) /100;
			$rft_ski_kegiatan =($v_ski['rf'] * $bobot_ski_kegiatan) /100;
			$total_bobot_kegiatan += $bobot_ski_kegiatan ; 
			$total_tf_ttb_kegiatan += $tft_ski_kegiatan ; 
			$total_rf_ttb_kegiatan += $rft_ski_kegiatan ; 
			$total_rp_tk_kegiatan += $v_ski['tk'] ; 
			$total_rp_rk_kegiatan += $v_ski['rk'] ; 

			$bobot_ski_program =( $v_ski['pagu']/$v_p['total_pagu'])*100;
			$tft_ski_program =($v_ski['tf'] * $bobot_ski_program) /100;
			$rft_ski_program =($v_ski['rf'] * $bobot_ski_program) /100;
			$total_bobot_program += $bobot_ski_program ; 
			$total_tf_ttb_program += $tft_ski_program ; 
			$total_rf_ttb_program += $rft_ski_program ; 
			$total_rp_tk_program += $v_ski['tk'] ; 
			$total_rp_rk_program += $v_ski['rk'] ; 




			$data_sub_kegiatan = [
				'kode_sub_kegiatan'=>$v_ski['kode_sub_kegiatan'],
				'nama_sub_kegiatan'=>$v_ski['nama_sub_kegiatan'],
				'tahap_apbd'=>$v_ski['tahap_apbd'],
				'pagu'=>$v_ski['pagu'],
				'bobot'=>$bobot_ski_kegiatan,
				'tf'=>$v_ski['tf'],
				'rf'=>$v_ski['rf'],
				'tk'=>$v_ski['tk'],
				'persen_tk'=>$v_ski['persen_tk'],
				'rk'=>$v_ski['rk'],
				'persen_rk'=>$v_ski['persen_rk'],
				'capaian_keu'=>$v_ski['capaian_keu'],
				'capaian_fisik'=>$v_ski['capaian_fisik'],
				'sisa_anggaran'=>$v_ski['sisa_anggaran'],
				'deviasi_keuangan'=>$v_ski['deviasi_keuangan'],
				'deviasi_fisik'=>$v_ski['deviasi_fisik'],
				'warna_deviasi_fisik_ski'=>$v_ski['warna_deviasi_fisik_ski'],
				'warna_deviasi_keu_ski'=>$v_ski['warna_deviasi_keu_ski'],

			];
			array_push($kumpul_sub_kegiatan, $data_sub_kegiatan);

      

          if ($v_ski['deviasi_fisik'] < -10) {
            $total_def_f_subkeg_merah++; 
          }
          elseif ($v_ski['deviasi_fisik'] <-5  && $v_ski['deviasi_fisik'] >=-10) {
            $total_def_f_subkeg_kuning++; 
          }
          elseif ($v_ski['deviasi_fisik'] <=0  && $v_ski['deviasi_fisik'] >=-5) {
            $total_def_f_subkeg_hijau++; 
          }else{
            $total_def_f_subkeg_ungu++; 
          }

          if ($v_ski['deviasi_keuangan'] < -10) {
            $total_def_k_subkeg_merah++; 
          }
          elseif ($v_ski['deviasi_keuangan'] <-5  && $v_ski['deviasi_keuangan'] >=-10) {
            $total_def_k_subkeg_kuning++; 
          }
          elseif ($v_ski['deviasi_keuangan'] <=0  && $v_ski['deviasi_keuangan'] >=-5) {
            $total_def_k_subkeg_hijau++; 
          }else{
            $total_def_k_subkeg_ungu++; 
          }

			
		}


		$persen_tk_kegiatan = ($total_rp_tk_kegiatan / $v_k['total_pagu']) * 100 ;
		$persen_rk_kegiatan = ($total_rp_rk_kegiatan / $v_k['total_pagu']) * 100 ;

		$df_kegiatan = $total_rf_ttb_kegiatan - $total_tf_ttb_kegiatan ; 
		$capaian_f_kegiatan = ($total_rf_ttb_kegiatan / $total_tf_ttb_kegiatan) * 100 ; 
		$dk_kegiatan = $persen_rk_kegiatan - $persen_tk_kegiatan ; 
		$capaian_k_kegiatan = ($persen_rk_kegiatan / $persen_tk_kegiatan) * 100 ; 
		$sisa_anggaran_kegiatan =$v_k['total_pagu'] - $total_rp_rk_kegiatan;



          if ($df_kegiatan < -10) {
            $total_def_f_kegiatan_merah++; 
            $warna_df_kegiatan = 'background:#f8b2b2'; 
          }
          elseif ($df_kegiatan <-5  && $df_kegiatan >=-10) {
            $total_def_f_kegiatan_kuning++;
            $warna_df_kegiatan = 'background:#fcf3cf'; 
          }
          elseif ($df_kegiatan <=0  && $df_kegiatan >=-5) {
            $total_def_f_kegiatan_hijau++; 
            $warna_df_kegiatan = 'background:#d5f5e3';
          }else{
            $total_def_f_kegiatan_ungu++; 
            $warna_df_kegiatan = 'background:#ff7cfd';
          }

          if ($dk_kegiatan < -10) {
            $total_def_k_kegiatan_merah++; 
            $warna_dk_kegiatan = 'background:#f8b2b2'; 
          }
          elseif ($dk_kegiatan <-5  && $dk_kegiatan >=-10) {
            $total_def_k_kegiatan_kuning++; 
            $warna_dk_kegiatan = 'background:#fcf3cf'; 
          }
          elseif ($dk_kegiatan <=0  && $dk_kegiatan >=-5) {
            $total_def_k_kegiatan_hijau++;
            $warna_dk_kegiatan = 'background:#d5f5e3'; 
          }else{
            $total_def_k_kegiatan_ungu++; 
            $warna_dk_kegiatan = 'background:#ff7cfd';
          }





		$data_kegiatan = [
			'kode_kegiatan'=>$v_k['kode_kegiatan'],
			'nama_kegiatan'=>$v_k['nama_kegiatan'],
			'pagu'=>$v_k['total_pagu'],
			'bobot'=>$total_bobot_kegiatan,
			'tf'=>$total_tf_ttb_kegiatan,
			'rf'=>$total_rf_ttb_kegiatan,
			'df'=>$df_kegiatan,
			'capaian_fisik'=>$capaian_f_kegiatan,
			'capaian_keuangan'=>$capaian_k_kegiatan,
			'tk'=>$total_rp_tk_kegiatan,
			'persen_tk'=>$persen_tk_kegiatan,
			'rk'=>$total_rp_rk_kegiatan,
			'sisa'=>$sisa_anggaran_kegiatan,
			'persen_rk'=>$persen_rk_kegiatan,
			'dk'=>$dk_kegiatan,
			'data_sub_kegiatan' =>$kumpul_sub_kegiatan,

      'warna_deviasi_fisik_kegiatan'=>$warna_df_kegiatan,
      'warna_deviasi_keu_kegiatan'=>$warna_dk_kegiatan,

		];
		array_push($kumpul_kegiatan, $data_kegiatan);
		
	}


	$persen_tk_program = ($total_rp_tk_program / $v_p['total_pagu']) * 100 ;
	$persen_rk_program = ($total_rp_rk_program / $v_p['total_pagu']) * 100 ;

	$df_program = $total_rf_ttb_program - $total_tf_ttb_program ; 
	$capaian_f_program = ($total_rf_ttb_program / $total_tf_ttb_program) * 100 ; 
	$dk_program = $persen_rk_program - $persen_tk_program ; 
	$capaian_k_program = ($persen_rk_program / $persen_tk_program) * 100 ; 
	$sisa_anggaran_program =$v_k['total_pagu'] - $total_rp_rk_program;



          if ($df_program < -10) {
            $total_def_f_program_merah++; 
            $warna_df_program = 'background:#f8b2b2'; 
          }
          elseif ($df_program <-5  && $df_program >=-10) {
            $total_def_f_program_kuning++;
            $warna_df_program = 'background:#fcf3cf'; 
          }
          elseif ($df_program <=0  && $df_program >=-5) {
            $total_def_f_program_hijau++; 
            $warna_df_program = 'background:#d5f5e3';
          }else{
            $total_def_f_program_ungu++; 
            $warna_df_program = 'background:#ff7cfd';
          }

          if ($dk_program < -10) {
            $total_def_k_program_merah++; 
            $warna_dk_program = 'background:#f8b2b2'; 
          }
          elseif ($dk_program <-5  && $dk_program >=-10) {
            $total_def_k_program_kuning++; 
            $warna_dk_program = 'background:#fcf3cf'; 
          }
          elseif ($dk_program <=0  && $dk_program >=-5) {
            $total_def_k_program_hijau++;
            $warna_dk_program = 'background:#d5f5e3'; 
          }else{
            $total_def_k_program_ungu++; 
            $warna_dk_program = 'background:#ff7cfd';
          }







	$data_program = [
		'kode_program'=>$v_p['kode_program'],
		'nama_program'=>$v_p['nama_program'],
		'pagu'=>$v_p['total_pagu'],
		'bobot'=>$total_bobot_program,
		'tf'=>$total_tf_ttb_program,
		'rf'=>$total_rf_ttb_program,
		'tk'=>$total_rp_tk_program,
		'rk'=>$total_rp_rk_program,
		'persen_tk'=>$persen_tk_program,
		'df'=>$df_program,
		'sisa'=>$sisa_anggaran_program,
		'dk'=>$dk_program,
		'persen_rk'=>$persen_rk_program,
		'capaian_fisik'=>$capaian_f_program,
		'capaian_keuangan'=>$capaian_k_program,
		'data_kegiatan' =>$kumpul_kegiatan,
    'warna_deviasi_fisik_program'=>$warna_df_program,
    'warna_deviasi_keu_program'=>$warna_dk_program,
	];
	array_push($show_data, $data_program);
}

 ?>

        <table class="font_laporan border table"> 
          <thead class="header"> 
            <tr> 
              <th rowspan="3"  width="30px"><?php echo $var ?></th> <th rowspan="2" colspan="4">Program, Kegiatan, Sub Kegiatan</th>
              <!-- <th rowspan="3" style="width:80px">Pagu Anggaran</th> --> 
              <th colspan="4">Fisik</th>
              <th colspan="6">Keuangan </th>
              <?php if ($ope=='<=') { 
                $colspan_deviasi_keuangan_semua = 7; ?> 
                <th rowspan="2" style="width:80px">Sisa Anggaran</th> 
              <?php }else{
      $colspan_deviasi_keuangan_semua = 5;
    }

    $colspan_program_kegiatan = $colspan_deviasi_keuangan_semua + 3 + 2 ;
    $colspan_perhitungan_deviasi_sub_kegiatan = $colspan_program_kegiatan +1 +1 ;
    $colspan_total_sub_kegiatan = $colspan_deviasi_keuangan_semua+ 3 +1;

    ?>
    

    
  </tr>
  <tr>
    <th>Target</th>
    <th colspan="2">Realisasi</th>
    <th rowspan="2" style="width:35px;">Deviasi</th>
    <th colspan="2">Target</th>
    <th colspan="3">Realisasi</th>
    <th rowspan="2"  style="width:35px">Deviasi</th>
  </tr>
  <tr>
    <th  style="width:75px">Tahapan APBD</th>
    <th  style="width:75px">Kode Rekening</th>
    <th>Uraian</th>
    <th style="width:75px">Pagu</th>
    <th style="width:35px">%</th>
    <th style="width:35px">%</th>
    <th style="width:35px">% Capaian</th>
    <th style="width:75px">Nilai (Rp.)</th>
    <th style="width:35px">%</th>
    <th style="width:75px">Nilai (Rp.)</th>
    <th style="width:35px">%</th>
    <th style="width:35px">% Capaian</th>
    <?php if ($ope=='<=') { ?>
      <th>Nilai (Rp.)</th>
    <?php } ?>
  </tr>
  <tr>
    <th>1</th>
    <th>2</th>
    <th>3</th>
    <th>4</th>
    <th>5</th>
    <th>6</th>
    <th>7</th>
    <th>8=(7/6)*100</th>
    <th>9=7-6</th>
    <th>10</th>
    <th>11=(10/5)*100</th>
    <th>12</th>
    <th>13=(12/5)*100</th>
    <th>14=(13/11)*100</th>
    <th>15=13-11</th>
    <?php if ($ope=='<=') { ?>
      <th>16=5-12</th>
    <?php } ?>
  </tr>

</thead>
<tbody>
  <?php 
  $no_program=0;


  foreach ($show_data as $k_p => $v_p) { 
    $no_program++;?>
    <tr  style="background: #c6d1fa ">  
      <th align="left"><?php echo $no_program ?></th>
      <th> - </th>
      <th align="left"><?php echo $v_p['kode_program'] ?></th>
      <th align="left"><?php echo $master_program[$v_p['kode_program']] ?></th>
      <th align="right"><?php echo number_format($v_p['pagu']) ?></th>
      <th align="center"> <?php echo round($v_p['tf'],2) ?> </th>
      <th align="center"> <?php echo round($v_p['rf'],2) ?> </th>
	      <th align="center"> <?php echo round($v_p['capaian_fisik'],2) ?> </th>
	      <th align="center" style="<?php echo $v_p['warna_deviasi_fisik_program'] ?>"> <?php echo round($v_p['df'],2) ?> </th>
        <th align="right"><?php echo number_format($v_p['tk']) ?> </th>
      <th align="center"> <?php echo round($v_p['persen_tk'],2) ?> </th>
        <th align="right"><?php echo number_format($v_p['rk']) ?> </th>
      <th align="center"> <?php echo round($v_p['persen_rk'],2) ?> </th>
	      <th align="center"> <?php echo round($v_p['capaian_keuangan'],2) ?> </th>
	      <th align="center"  style="<?php echo $v_p['warna_deviasi_keuangan_program'] ?>"> <?php echo round($v_p['dk'],2) ?> </th>
        <th align="right"><?php echo number_format($v_p['sisa']) ?> </th>
    </tr>
    <?php 
    $no_kegiatan = 0;
    foreach ($v_p['data_kegiatan'] as $k_k => $v_k) {
    $no_kegiatan++; ?>
      <tr style="background:#c6faf8;">
        <th align="left"><?php echo $no_program.'.'.$no_kegiatan ?></th>
        <th align="center"> - </th>
        <th align="left"><?php echo $v_k['kode_kegiatan'] ?></th>
        <th align="left"><?php echo $master_kegiatan[$v_k['kode_kegiatan']] ?></th>
        <th align="right"><?php echo number_format($v_k['pagu']) ?> </th>
	      <th align="center"> <?php echo round($v_k['tf'],2) ?> </th>
	      <th align="center"> <?php echo round($v_k['rf'],2) ?> </th>
	      <th align="center"> <?php echo round($v_k['capaian_fisik'],2) ?> </th>
	      <th align="center"  style="<?php echo $v_k['warna_deviasi_fisik_kegiatan'] ?>"> <?php echo round($v_k['df'],2) ?> </th>
        <th align="right"><?php echo number_format($v_k['tk']) ?> </th>
	      <th align="center"> <?php echo round($v_k['persen_tk'],2) ?> </th>
        <th align="right"><?php echo number_format($v_k['rk']) ?> </th>
	      <th align="center"> <?php echo round($v_k['persen_rk'],2) ?> </th>
	      <th align="center"> <?php echo round($v_k['capaian_keuangan'],2) ?> </th>
	      <th align="center"  style="<?php echo $v_k['warna_deviasi_keu_kegiatan'] ?>"> <?php echo round($v_k['dk'],2) ?> </th>
        <th align="right"><?php echo number_format($v_k['sisa']) ?> </th>
      </tr>
      <?php 
      $no_ski =0; 
      foreach ($v_k['data_sub_kegiatan'] as $k_ski => $v_ski) { 




		// mencari bobot dan tertimbang fisik
          $bobot_ski_kegiatan =( $v_ski['pagu']/$v_k['total_pagu'])*100;
          $tft_ski_kegiatan =$v_ski['tf'] * $bobot_ski_kegiatan /100;
          $rft_ski_kegiatan =$v_ski['rf'] * $bobot_ski_kegiatan /100;
          






        $no_ski++;?>
        <tr>
          <td><?php echo $no_program.'.'.$no_kegiatan.'.'.$no_ski ?></td>
          <td>
            <?php 
            if ($kode_tahap==2) {
              echo pilihan_nama_tahapan($kode_tahap);
              # code...
            }else{
              echo $v_ski['tahap_apbd'];
            }
             ?></td>
          <td><?php echo $v_ski['kode_sub_kegiatan'] ?></td>
          <td><?php echo $v_ski['nama_sub_kegiatan'] ?></td>
        <td align="right"><?php echo number_format($v_ski['pagu']) ?> </td>
        <td align="center"> <?php echo round($v_ski['tf'],2) ?> </td>
        <td align="center"> <?php echo round($v_ski['rf'],2) ?> </td>
        <td align="center"> <?php echo round($v_ski['capaian_fisik'],2) ?> </td>
        <td align="center"  style="<?php echo $v_ski['warna_deviasi_fisik_ski'] ?>"> <?php echo round($v_ski['deviasi_fisik'],2) ?> </td>
        <td align="right"> <?php echo number_format($v_ski['tk']) ?> </td>
        <td align="center"> <?php echo round($v_ski['persen_tk'],2) ?> </td>
        <td align="right"><?php echo number_format($v_ski['rk']) ?> </td>
        <td align="center"> <?php echo round($v_ski['persen_rk'],2) ?> </td>
        <td align="center"> <?php echo round($v_ski['capaian_keu'],2) ?> </td>
        <td align="center"  style="<?php echo $v_ski['warna_deviasi_keu_ski'] ?>"> <?php echo round($v_ski['deviasi_keuangan'],2) ?> </td>
        <td align="right"> <?php echo number_format($v_ski['sisa_anggaran']) ?> </td>
        </tr>
    <?php 
          }
        }
      }
   ?>
  </tbody>




<tfoot>



	<tr>
		<td colspan="4" align="center">Total</td>
		
		<td align="right"><?php echo number_format($pagu_skpd) ?></td>
		<td align="center" align="center"> <?php echo round($total_persen_tf,2) ?> </td>
		<td align="center" align="center"> <?php echo round($total_persen_rf,2) ?> </td>
		<td  align="center"> -- <?php //echo round($deviasi_total_fisik,2) ?> </td>
		<td  align="center"> -- <?php //echo round($deviasi_total_fisik,2) ?> </td>
		<td align="right">  <?php echo number_format($total_rp_tk) ?> </td>
		
		<td align="center" align="center"> <?php echo round($total_persen_tk,2) ?> </td>
		<td align="right">  <?php echo number_format($total_rp_rk) ?> </td>
		
		<td align="center" align="center"> <?php echo round($total_persen_rk,2) ?> </td>
		<td align="center"> --  <?php //echo round($deviasi_total_keuangan_akuntansi,2) ?> </td>
		<td align="center"> --  <?php //echo round($deviasi_total_keuangan_akuntansi,2) ?> </td>

		<?php if ($ope=='<=') { ?>
			<td align="right">  <?php echo number_format($total_sisa_pagu) ?> </td>
		<?php } ?>
	</tr>


	<?php 
	$tk_skpd = ($total_rp_tk / $pagu_skpd) * 100;
	$rk_skpd = ($total_rp_rk / $pagu_skpd) * 100;
	$capaian_fisik = ($total_rft_ski / $total_tft_ski) * 100;
	$capaian_keuangan = ($rk_skpd / $tk_skpd) * 100;

	$deviasi_fisik_opd = $total_rft_ski - $total_tft_ski ; 
	$deviasi_keuangan_opd = $rk_skpd - $tk_skpd ; 

		if ($deviasi_fisik_opd < -10) {
			$warna_deviasi_fisik_opd = 'background: #f8b2b2'; 
		}
		elseif ($deviasi_fisik_opd <-5  && $deviasi_fisik_opd >=-10) {
			$warna_deviasi_fisik_opd = 'background: #fcf3cf';
		}
		elseif ($deviasi_fisik_opd <=0  && $deviasi_fisik_opd >=-5) {
			$warna_deviasi_fisik_opd = 'background: #d5f5e3';
		}else{
			$warna_deviasi_fisik_opd = 'background: #ff7cfd';
		}

		if ($deviasi_keuangan_opd < -10) {
			$warna_deviasi_keuangan_opd = 'background: #f8b2b2'; 
		}
		elseif ($deviasi_keuangan_opd <-5  && $deviasi_keuangan_opd >=-10) {
			$warna_deviasi_keuangan_opd = 'background: #fcf3cf';
		}
		elseif ($deviasi_keuangan_opd <=0  && $deviasi_keuangan_opd >=-5) {
			$warna_deviasi_keuangan_opd = 'background: #d5f5e3';
		}else{
			$warna_deviasi_keuangan_opd = 'background: #ff7cfd';
		}



	 ?>
	<tr>
				<?php 


    if ($ope=='<=') {
      if ($total_rp_rk==$grafik['rp_realisasi_keuangan_akumulasi'] && $total_rp_tk==$grafik['rp_target_keuangan_akumulasi'] && round($total_tft_ski,2)==$grafik['target_fisik_akumulasi'] && round($total_rft_ski,2)==$grafik['realisasi_fisik_akumulasi']) {
        $status_synch = 'Terakhir synchronize pada '.timestamp_lengkap($grafik['last_update']);
      }else{
        $status_synch = 'Belum di synchronize | '.'Terakhir synchronize pada '.timestamp_lengkap($grafik['last_update']);
      }
            // $cek = $grafik['realisasi_fisik_akumulasi'];
    }else{
      if ($total_realisasi_keuangan==$grafik['rp_realisasi_keuangan_bulanan'] && $total_angka_target_keuangan==$grafik['rp_target_keuangan_bulanan']) {
        $status_synch = 'Terakhir synchronize pada '.timestamp_lengkap($grafik['last_update']);
      }else{
        $status_synch = 'Belum di synchronize | '.'Terakhir synchronize pada '.timestamp_lengkap($grafik['last_update']);
      }
            // $cek = $grafik['rp_realisasi_keuangan_bulanan'];
    }

     ?>

    <td colspan="4" align="center"><b>Pencapaian</b> <br> <?php echo $status_synch;?></td>
.
		<th align="center">-</th>
		
		<th> <?php echo round($total_tft_ski,2) ?></th>
		<th> <?php echo round($total_rft_ski,2) ?></th>
		<th align="center"><?php echo round($capaian_fisik,2) ?></th>
		<th align="center" style="<?php echo $warna_deviasi_fisik_opd ?>"> <?php echo round($deviasi_fisik_opd,2) ?> </th>

		<th colspan="2" align="center" style=""><?php echo round($tk_skpd,2) ?></th>
		<th colspan="2" align="center" style=""><?php echo round($rk_skpd,2) ?></th>
		<th align="center"><?php echo round($capaian_keuangan,2) ?></th>
		<th align="center" style="<?php echo $warna_deviasi_keuangan_opd ?>">  <?php echo round($deviasi_keuangan_opd,2) ?> </th>
		<?php if ($ope=='<=') { ?>
			<th align="center"> - </th>
		<?php } ?>
		
		
	</tr>
	

</tfoot>



</table>


<hr>

<div>
  

<table class="table font_laporan ">
  <thead>
    <tr>
      <th colspan="7">Statistika Data</th>
    </tr>
    <tr>
      <th rowspan="2">Keterangan</th>
      <th colspan="2">Program</th>
      <th colspan="2">Kegiatan</th>
      <th colspan="2">Sub Kegiatan</th>
    </tr>
    <tr>
      <th>Fisik</th>
      <th>Keuangan</th>
      <th>Fisik</th>
      <th>Keuangan</th>
      <th>Fisik</th>
      <th>Keuangan</th>
    </tr>
    <tr style="background: #f8b2b2;">
      <td>Deviasi Diatas -10%</td>
      <td align="center"> <?php echo $total_def_f_program_merah ?> </td>
      <td align="center"> <?php echo $total_def_k_program_merah ?> </td>
      <td align="center"> <?php echo $total_def_f_kegiatan_merah ?> </td>
      <td align="center"> <?php echo $total_def_k_kegiatan_merah ?> </td>
      <td align="center"> <?php echo $total_def_f_subkeg_merah ?> </td>
      <td align="center"> <?php echo $total_def_k_subkeg_merah ?> </td>
    </tr>
    <tr style="background: #fcf3cf;">
      <td>Deviasi Antara 5% sampai 10%</td>
      <td align="center"> <?php echo $total_def_f_program_kuning ?> </td>
      <td align="center"> <?php echo $total_def_k_program_kuning ?> </td>
      <td align="center"> <?php echo $total_def_f_kegiatan_kuning ?> </td>
      <td align="center"> <?php echo $total_def_k_kegiatan_kuning ?> </td>
      <td align="center"> <?php echo $total_def_f_subkeg_kuning ?> </td>
      <td align="center"> <?php echo $total_def_k_subkeg_kuning ?> </td>
    </tr>
    <tr style="background: #d5f5e3;">
      <td>Deviasi Dibawah -5%</td>
      <td align="center"> <?php echo $total_def_f_program_hijau ?> </td>
      <td align="center"> <?php echo $total_def_k_program_hijau ?> </td>
      <td align="center"> <?php echo $total_def_f_kegiatan_hijau ?> </td>
      <td align="center"> <?php echo $total_def_k_kegiatan_hijau ?> </td>
      <td align="center"> <?php echo $total_def_f_subkeg_hijau ?> </td>
      <td align="center"> <?php echo $total_def_k_subkeg_hijau ?> </td>
    </tr>
    <tr style="background:  #ff7cfd ;">
      <td>Melebihi Target</td>
      <td align="center"> <?php echo $total_def_f_program_ungu ?> </td>
      <td align="center"> <?php echo $total_def_k_program_ungu ?> </td>
      <td align="center"> <?php echo $total_def_f_kegiatan_ungu ?> </td>
      <td align="center"> <?php echo $total_def_k_kegiatan_ungu ?> </td>
      <td align="center"> <?php echo $total_def_f_subkeg_ungu ?> </td>
      <td align="center"> <?php echo $total_def_k_subkeg_ungu ?> </td>
    </tr>
    <tr>
      <th align="left">Total Data</th>
      <th colspan="2"><?php echo $total_program ?></th>
      <th colspan="2"><?php echo $total_kegiatan ?></th>
      <th colspan="2"> <?php echo $total_sub_keg ?> </th>
    </tr>
  </thead>
  
</table>




</div>

</body>
