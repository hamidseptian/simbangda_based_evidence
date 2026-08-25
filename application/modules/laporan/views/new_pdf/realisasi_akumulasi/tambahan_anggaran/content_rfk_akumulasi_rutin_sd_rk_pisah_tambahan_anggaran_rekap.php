        <?php   
$hasil = [];
// $total_pagu_opd = 0;
$total_bobot_ski = 0;
$total_tft_ski = 0;
$total_rft_ski = 0;

$total_bobot_ski_tambahan = 0;
$total_tft_ski_tambahan = 0;
$total_rft_ski_tambahan = 0;

$total_rp_tk =0;
$total_rp_rk =0;
$total_persen_tf = 0 ;
$total_persen_rf = 0 ;
$total_persen_tk = 0 ;
$total_persen_rk = 0 ;
$total_sisa_pagu = 0;

$total_rp_rk_tambahan = 0;
foreach ($sub_kegiatan as $row) {

    $program  = $row['kode_rekening_program'];
    $kegiatan = $row['kode_rekening_kegiatan'];
    $sub      = $row['kode_rekening_sub_kegiatan'];
    $pagu     = (int) $row['pagu']; // null jadi 0
    $pagu_tambahan     = (int) $row['pagu_tambahan']; // null jadi 0
    $pagu_total     =$pagu + $pagu_tambahan;
    // $total_pagu_opd	+= $pagu;


   
    $q_realisasi_keuangan = $this->realisasi_akumulasi_model->get_realisasi_keuangan($row['id_instansi'], $sub, $bulan, $ope,  $row['tahun'], $row['kode_tahap'])->row_array();
    $q_realisasi_keuangan_tambahan = $this->realisasi_akumulasi_model->get_realisasi_keuangan_tambahan($row['id_instansi'], $sub, $bulan, $ope,  $row['tahun'], $row['kode_tahap'],$id_tambahan_anggaran)->row_array();

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


    if ($row['id_tambahan_anggaran']=='') {
      $realisasi_keuangan_tambahan =0;
      $persen_realisasi_keuangan_tambahan =0;
      # code...
    }else{
      $realisasi_keuangan_tambahan =$q_realisasi_keuangan_tambahan['total_realisasi'];
      $total_rp_rk_tambahan +=$realisasi_keuangan_tambahan;
      $persen_realisasi_keuangan_tambahan = $pagu_tambahan ==0 ? 0 : ($q_realisasi_keuangan_tambahan['total_realisasi'] / $pagu_tambahan) * 100;
      
    }




    $realisasi_keuangan_total = $realisasi_keuangan_tambahan + $realisasi_keuangan;
    $persen_realisasi_keuangan_total = $pagu_total ==0 ? 0 : ($realisasi_keuangan_total / $pagu_total) * 100;
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



    
        $jenis_paket = $this->db->query("SELECT
                    id_paket_pekerjaan, jenis_paket
                  FROM
                    paket_pekerjaan pp 
                  WHERE
                    pp.kode_rekening_sub_kegiatan = '{$sub}'
                    AND pp.id_instansi = {$id_instansi}
                    AND pp.tahun='$tahun' 

                    AND pp.id_tambahan_anggaran='' 
                    $where_paket");

        $jlm_rutin = 0;
        $jlm_swakelola = 0;
        $jlm_penyedia = 0;
        $total_paket = 0;
        $kumpul_id_paket_swakelola = [];
        $kumpul_id_paket_penyedia = [];
        foreach ($jenis_paket->result_array() as $k_jp => $v_jp) {
          $total_paket++;
          if ($v_jp['jenis_paket']=='SWAKELOLA') {
            $jlm_swakelola++;
            array_push($kumpul_id_paket_swakelola, $v_jp['id_paket_pekerjaan']);
          }
          elseif ($v_jp=='PENYEDIA') {
            $jlm_penyedia++;
            array_push($kumpul_id_paket_penyedia, $v_jp['id_paket_pekerjaan']);
          }else{
            $jlm_rutin++;
          }
        }

    $swa = $this->realisasi_akumulasi_model->get_realisasi_fisik_new($id_instansi, $sub, $bulan, 'SWAKELOLA', $ope, $tahun,$row['kode_tahap'], $kumpul_id_paket_penyedia)->row_array();
    $pen = $this->realisasi_akumulasi_model->get_realisasi_fisik_new($id_instansi, $sub, $bulan, 'PENYEDIA', $ope, $tahun,$row['kode_tahap'], $kumpul_id_paket_penyedia)->row_array();
		$swa_tot  = !empty($swa['total']) ? $swa['total'] : 0;
		$pen_tot  = !empty($pen['total']) ? $pen['total'] : 0;
		$jumlah_fisik_per_sub_kegiatan = $total_paket > 0 ? ($swa_tot + $pen_tot ) / $total_paket : 0 ;
		$realisasi_fisik  = $jumlah_fisik_per_sub_kegiatan > 100 ? 100 : $jumlah_fisik_per_sub_kegiatan;
		$capaian_fisik = ($realisasi_fisik / $target_fisik) * 100;
		$deviasi_fisik = ($realisasi_fisik - $target_fisik);


		// mencari bobot dan tertimbang fisik
          $bobot_ski =( $pagu/$pagu_skpd)*100;
          $rft_ski =$realisasi_fisik * $bobot_ski /100;
           $total_bobot_ski += $bobot_ski;
          $total_rft_ski += $rft_ski;

          


// untuk Tambahan
$jenis_paket_tambahan = $this->db->query("SELECT
                    id_paket_pekerjaan, jenis_paket
                  FROM
                    paket_pekerjaan pp 
                  WHERE
                    pp.kode_rekening_sub_kegiatan = '{$sub}'
                    AND pp.id_instansi = {$id_instansi}
                    AND pp.tahun='$tahun' 
                    AND pp.id_tambahan_anggaran='$id_tambahan_anggaran' 
                    $where_paket");
        $jlm_rutin_tambahan = 0;
        $jlm_swakelola_tambahan = 0;
        $jlm_penyedia_tambahan = 0;
        $total_paket_tambahan = 0;
        $kumpul_id_paket_swakelola_tambahan = [];
        $kumpul_id_paket_penyedia_tambahan = [];
        foreach ($jenis_paket_tambahan->result_array() as $k_jp_tambahan => $v_jp_tambahan) {
          $total_paket_tambahan++;
          if ($v_jp_tambahan['jenis_paket']=='SWAKELOLA') {
            $jlm_swakelola_tambahan++;
            array_push($kumpul_id_paket_swakelola_tambahan, $v_jp_tambahan['id_paket_pekerjaan']);
          }
          elseif ($v_jp_tambahan=='PENYEDIA') {
            $jlm_penyedia_tambahan++;
            array_push($kumpul_id_paket_penyedia_tambahan, $v_jp_tambahan['id_paket_pekerjaan']);
          }else{
            $jlm_rutin_tambahan++;
          }
        }
    $swa_tambahan = $this->realisasi_akumulasi_model->get_realisasi_fisik_new($id_instansi, $sub, $bulan, 'SWAKELOLA', $ope, $tahun,$row['kode_tahap'], $kumpul_id_paket_penyedia_tambahan)->row_array();
    $pen_tambahan = $this->realisasi_akumulasi_model->get_realisasi_fisik_new($id_instansi, $sub, $bulan, 'PENYEDIA', $ope, $tahun,$row['kode_tahap'], $kumpul_id_paket_penyedia_tambahan)->row_array();
    $swa_tot_tambahan  = !empty($swa_tambahan['total']) ? $swa_tambahan['total'] : 0;
    $pen_tot_tambahan  = !empty($pen_tambahan['total']) ? $pen_tambahan['total'] : 0;
    $jumlah_fisik_per_sub_kegiatan_tambahan = $total_paket_tambahan > 0 ? ($swa_tot_tambahan + $pen_tot_tambahan ) / $total_paket_tambahan : 0 ;
    $realisasi_fisik_tambahan  = $jumlah_fisik_per_sub_kegiatan_tambahan > 100 ? 100 : $jumlah_fisik_per_sub_kegiatan_tambahan;
    $capaian_fisik_tambahan = ($realisasi_fisik_tambahan / $target_fisik) * 100;
    $deviasi_fisik_tambahan = ($realisasi_fisik_tambahan - $target_fisik);
    // mencari bobot dan tertimbang fisik
          $bobot_ski_tambahan =( $pagu_tambahan/$pagu_skpd_tambahan)*100;
          $rft_ski_tambahan =($realisasi_fisik_tambahan * $bobot_ski_tambahan) /100;
           $total_bobot_ski_tambahan += $bobot_ski_tambahan;
          $total_rft_ski_tambahan += $rft_ski_tambahan;
          




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
    $hasil[$program]['kegiatan'][$kegiatan]['total_pagu_tambahan'] += $pagu_tambahan;
    $hasil[$program]['kegiatan'][$kegiatan]['total_pagu_total'] += $pagu_total;
    $hasil[$program]['kegiatan'][$kegiatan]['rk_tambahan'] += $realisasi_keuangan_tambahan;
    $hasil[$program]['kegiatan'][$kegiatan]['rk_total'] += $realisasi_keuangan_total;


    $hasil[$program]['total_pagu'] += $pagu;
    $hasil[$program]['total_pagu_tambahan'] += $pagu_tambahan;
    $hasil[$program]['total_pagu_total'] += $pagu_total;
    $hasil[$program]['rk_tambahan'] += $realisasi_keuangan_tambahan;
    $hasil[$program]['rk_total'] += $realisasi_keuangan_total;
    


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
        'pagu_tambahan' => $pagu_tambahan,
        'pagu_total' => $pagu_total,
        'tf'=>$target_fisik,
        'rf'=>$realisasi_fisik,
        'rf_tambahan'=>$realisasi_fisik_tambahan,
        'tk'=>$target_keuangan,
        'persen_tk'=>$persen_tk,
        'rk'=>$realisasi_keuangan,
        'persen_rk'=>$persen_realisasi_keuangan,

        'realisasi_keuangan_tambahan'=>$realisasi_keuangan_tambahan,
        'persen_realisasi_keuangan_tambahan'=>$persen_realisasi_keuangan_tambahan,

        'realisasi_keuangan_total'=>$realisasi_keuangan_total,
        'persen_realisasi_keuangan_total'=>$persen_realisasi_keuangan_total,

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



    $total_bobot_program_tambahan = 0;
    $total_tf_ttb_program_tambahan = 0;
    $total_rf_ttb_program_tambahan = 0;
    $total_rp_tk_program_tambahan =0;
    $total_rp_rk_program_tambahan =0;

    $total_rp_tk_program_tambahan =0;
    $total_rp_rk_program_tambahan =0;

	foreach ($v_p['kegiatan'] as $k_k => $v_k) {
    $total_kegiatan++;
		$kumpul_sub_kegiatan = [];

		$total_bobot_kegiatan = 0;
		$total_tf_ttb_kegiatan = 0;
		$total_rf_ttb_kegiatan = 0;

		$total_rp_tk_kegiatan =0;
		$total_rp_rk_kegiatan =0;


    $total_bobot_kegiatan_tambahan = 0;
    $total_tf_ttb_kegiatan_tambahan = 0;
    $total_rf_ttb_kegiatan_tambahan = 0;
    $total_rp_tk_kegiatan_tambahan =0;
    $total_rp_rk_kegiatan_tambahan =0;
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




      $bobot_ski_kegiatan_tambahan =( $v_ski['pagu_tambahan']/$v_k['total_pagu_tambahan'])*100;
      $tft_ski_kegiatan_tambahan =($v_ski['tf_tambahan'] * $bobot_ski_kegiatan_tambahan) /100;
      $rft_ski_kegiatan_tambahan =($v_ski['rf_tambahan'] * $bobot_ski_kegiatan_tambahan) /100;
      $total_bobot_kegiatan_tambahan += $bobot_ski_kegiatan_tambahan ; 
      $total_tf_ttb_kegiatan_tambahan += $tft_ski_kegiatan_tambahan ; 
      $total_rf_ttb_kegiatan_tambahan += $rft_ski_kegiatan_tambahan ; 
      $total_rp_tk_kegiatan_tambahan += $v_ski['tk_tambahan'] ; 
      $total_rp_rk_kegiatan_tambahan += $v_ski['rk_tambahan'] ; 
      $bobot_ski_program_tambahan =( $v_ski['pagu_tambahan']/$v_p['total_pagu_tambahan'])*100;
      $tft_ski_program_tambahan =($v_ski['tf_tambahan'] * $bobot_ski_program_tambahan) /100;
      $rft_ski_program_tambahan =($v_ski['rf_tambahan'] * $bobot_ski_program_tambahan) /100;
      $total_bobot_program_tambahan += $bobot_ski_program_tambahan ; 
      $total_tf_ttb_program_tambahan += $tft_ski_program_tambahan ; 
      $total_rf_ttb_program_tambahan += $rft_ski_program_tambahan ; 
      $total_rp_tk_program_tambahan += $v_ski['tk_tambahan'] ; 
      $total_rp_rk_program_tambahan += $v_ski['rk_tambahan'] ;




			$data_sub_kegiatan = [
				'kode_sub_kegiatan'=>$v_ski['kode_sub_kegiatan'],
				'nama_sub_kegiatan'=>$v_ski['nama_sub_kegiatan'],
				'tahap_apbd'=>$v_ski['tahap_apbd'],
				'pagu'=>$v_ski['pagu'],
        'pagu_tambahan'=>$v_ski['pagu_tambahan'] == '' ? '-' : number_format($v_ski['pagu_tambahan']),
        'pagu_total'=>$v_ski['pagu_total'],
				'bobot'=>$bobot_ski_kegiatan,
				'tf'=>$v_ski['tf'],
				'rf'=>$v_ski['rf'],
        'rf_tambahan'=>$v_ski['pagu_tambahan'] == '' ? '-' : round($v_ski['rf_tambahan'],2), 
				'tk'=>$v_ski['tk'],
				'persen_tk'=>$v_ski['persen_tk'],
				'rk'=>$v_ski['rk'],
				'persen_rk'=>$v_ski['persen_rk'],
       
        'rk_tambahan'=> $v_ski['pagu_tambahan'] == '' ? '-' : number_format($v_ski['realisasi_keuangan_tambahan']),
        'persen_rk_tambahan'=>$v_ski['pagu_tambahan'] == '' ? '-' : round($v_ski['persen_realisasi_keuangan_tambahan'],2),
       
        'rk_total'=>$v_ski['realisasi_keuangan_total'],
        'persen_rk_total'=>$v_ski['persen_realisasi_keuangan_total'],
			
      	'capaian_keu'=>$v_ski['capaian_keu'],
				'capaian_fisik'=>$v_ski['capaian_fisik'],
				'sisa_anggaran'=>$v_ski['sisa_anggaran'],
				'deviasi_keuangan'=>$v_ski['deviasi_keuangan'],
				'deviasi_fisik'=>$v_ski['deviasi_fisik'],
				'warna_deviasi_fisik_ski'=>$v_ski['warna_deviasi_fisik_ski'],
				'warna_deviasi_keu_ski'=>$v_ski['warna_deviasi_keu_ski'],

			];
			array_push($kumpul_sub_kegiatan, $data_sub_kegiatan);

      

			
		}


		$persen_rk_kegiatan = ($total_rp_rk_kegiatan / $v_k['total_pagu']) * 100 ;
    $persen_rk_kegiatan_tambahan  = ($v_k['rk_tambahan'] / $v_k['total_pagu_tambahan']) * 100 ;
    $persen_rk_kegiatan_total  = ($v_k['rk_total'] / $v_k['total_pagu_total']) * 100 ;



 




		$data_kegiatan = [
			'kode_kegiatan'=>$v_k['kode_kegiatan'],
			'nama_kegiatan'=>$v_k['nama_kegiatan'],
			'pagu'=>$v_k['total_pagu'],
      'pagu_tambahan'=>$v_k['total_pagu_tambahan'] == '' ? '-' : number_format($v_k['total_pagu_tambahan']),
      // 'rf_tambahan'=>$v_k['total_pagu_tambahan'] == '' ? '-' : round($v_k['rf_tambahan'],2), 
      'pagu_total'=>$v_k['total_pagu_total'],
			'bobot'=>$total_bobot_kegiatan,
			'tf'=>$total_tf_ttb_kegiatan,
			'rf'=>$total_rf_ttb_kegiatan,
      'rf_tambahan'=>$total_rf_ttb_kegiatan_tambahan,
			'tk'=>$total_rp_tk_kegiatan,
			'persen_tk'=>$persen_tk_kegiatan,
			'rk'=>$total_rp_rk_kegiatan,
      'rk_tambahan'=> $v_k['total_pagu_tambahan'] == '' ? '-' : number_format($v_k['rk_tambahan']),
      'rk_total'=>$v_k['rk_total'],
			'sisa'=>$sisa_anggaran_kegiatan,
			'persen_rk'=>$persen_rk_kegiatan,
      'persen_rk_tambahan'=>$v_k['total_pagu_tambahan'] == '' ? '-' : round($persen_rk_kegiatan_tambahan,2),
      'persen_rk_total'=>$persen_rk_kegiatan_total,
			'dk'=>$dk_kegiatan,
			'data_sub_kegiatan' =>$kumpul_sub_kegiatan,

      'warna_deviasi_fisik_kegiatan'=>$warna_df_kegiatan,
      'warna_deviasi_keu_kegiatan'=>$warna_dk_kegiatan,

		];
		array_push($kumpul_kegiatan, $data_kegiatan);
		
	}


	$persen_rk_program = ($total_rp_rk_program / $v_p['total_pagu']) * 100 ;
  $persen_rk_program_tambahan = ($v_p['rk_tambahan'] / $v_p['total_pagu_tambahan']) * 100 ;
  $persen_rk_program_total = ($v_p['rk_total'] / $v_p['total_pagu_total']) * 100 ;







	$data_program = [
		'kode_program'=>$v_p['kode_program'],
		'nama_program'=>$v_p['nama_program'],
		'pagu'=>$v_p['total_pagu'],

    'total_pagu_tambahan'=>$v_p['total_pagu_tambahan'] == '' ? '-' : number_format($v_p['total_pagu_tambahan']),
    'total_pagu_total'=>$v_p['total_pagu_total'],
    'rk_tambahan'=> $v_p['total_pagu_tambahan'] == '' ? '-' : number_format($v_p['rk_tambahan']),
    'rk_total'=>$v_p['rk_total'],

		'bobot'=>$total_bobot_program,
		'tf'=>$total_tf_ttb_program,
		'rf'=>$total_rf_ttb_program,
    'rf_tambahan'=>$total_rf_ttb_program_tambahan,
		'tk'=>$total_rp_tk_program,
		'rk'=>$total_rp_rk_program,
		'persen_tk'=>$persen_tk_program,
		'df'=>$df_program,
		'sisa'=>$sisa_anggaran_program,
		'dk'=>$dk_program,
		'persen_rk'=>$persen_rk_program,
    'persen_rk_tambahan'=>$v_p['total_pagu_tambahan'] == '' ? '-' : round($persen_rk_program_tambahan,2),
    'persen_rk_total'=>$persen_rk_program_total,
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
      <th rowspan="3">No</th>
      <th colspan="3">Program, Kegiatan, Sub Kegiatan</th>
      <th colspan="4">APBD</th>
      <th colspan="4">TKD</th>
      <th colspan="3">Total</th>
    </tr>
    <tr>
      <th rowspan="2">Tahapan APBD</th>
      <th rowspan="2">Kode Rekening</th>
      <th rowspan="2">Uraian</th>
      <th>Pagu</th>
      <th colspan="2">Reasasi Keuangan</th>
      <th>Fisik</th>
      <th>Pagu</th>
      <th colspan="2">Relisasi Keuagan</th>
      <th>Fisik</th>
      <th>Pagu</th>
      <th>reaisasi</th>
      <th>%</th>
    </tr>
    <tr>
      <th>Rp</th>
      <th>Rp</th>
      <th>%</th>
      <th>%</th>
      <th>Rp</th>
      <th>Rp</th>
      <th>%</th>
      <th>%</th>
      <th>Rp</th>
      <th>Rp</th>
      <th>%</th>
    </tr>
    <tr>
      <th>1</th>
      <th>2</th>
      <th>3</th>
      <th>4</th>
      <th>5</th>
      <th>6</th>
      <th>7=(6/5)*100</th>
      <th>8</th>
      <th>9</th>
      <th>10</th>
      <th>11=(10/9)*100</th>
      <th>12</th>
      <th>13=5+9</th>
      <th>14=6+10</th>
      <th>15=(14/13)*100</th>
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
        <th align="right"><?php echo number_format($v_p['rk']) ?> </th>
      <th align="center"> <?php echo round($v_p['persen_rk'],2) ?> </th>
      <th align="center"> <?php echo round($v_p['rf'],2) ?> </th>
      <th align="right"><?php echo $v_p['total_pagu_tambahan'] ?></th>
      <th align="right"><?php echo $v_p['rk_tambahan'] ?></th>
      <th align="center"> <?php echo $v_p['persen_rk_tambahan'] ?> </th>
      <th align="center"> <?php echo round($v_p['rf_tambahan'],2) ?> </th>
      <th align="right"><?php echo number_format($v_p['total_pagu_total']) ?></th>
      <th align="right"><?php echo number_format($v_p['rk_total']) ?></th>
      <th align="center"> <?php echo round($v_p['persen_rk_total'],2) ?> </th>
	      <!-- <th align="center"> <?php echo round($v_p['capaian_keuangan'],2) ?> </th>
	      <th align="center"  style="<?php echo $v_p['warna_deviasi_keuangan_program'] ?>"> <?php echo round($v_p['dk'],2) ?> </th>
        <th align="right"><?php echo number_format($v_p['sisa']) ?> </th> -->
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
        <th align="right"><?php echo number_format($v_k['rk']) ?> </th>
	      <th align="center"> <?php echo round($v_k['persen_rk'],2) ?> </th>
	      <th align="center"> <?php echo round($v_k['rf'],2) ?> </th>
        <th align="right"><?php echo $v_k['pagu_tambahan'] ?> </th>
        <th align="right"><?php echo $v_k['rk_tambahan'] ?> </th>
        <th align="center"> <?php echo $v_k['persen_rk_tambahan'] ?> </th>
        <th align="center"> <?php echo round($v_k['rf_tambahan'],2) ?> </th>
        <th align="right"><?php echo number_format($v_k['pagu_total']) ?> </th>
        <th align="right"><?php echo number_format($v_k['rk_total']) ?> </th>
        <th align="center"> <?php echo round($v_k['persen_rk_total'],2) ?> </th>
        <!-- <th align="right"><?php echo number_format($v_k['sisa']) ?> </th> -->
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
        <td align="right"><?php echo number_format($v_ski['rk']) ?> </td>
        <td align="center"> <?php echo round($v_ski['persen_rk'],2) ?> </td>
        <td align="center"> <?php echo round($v_ski['rf'],2) ?> </td>
        <td align="right"><?php echo $v_ski['pagu_tambahan'] ?> </td>
        <td align="right"><?php echo $v_ski['rk_tambahan'] ?> </td>
        <td align="center"> <?php echo $v_ski['persen_rk_tambahan'] ?> </td>

      <td align="center"> <?php echo $v_ski['rf_tambahan'] ?> </td>
        <td align="right"><?php echo number_format($v_ski['pagu_total']) ?> </td>
        <td align="right"><?php echo number_format($v_ski['rk_total']) ?> </td>
        <td align="center"> <?php echo round($v_ski['persen_rk_total'],2) ?> </td>
        <!-- <td align="right"> <?php echo number_format($v_ski['sisa_anggaran']) ?> </td> -->
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
    <td align="right">  <?php echo number_format($total_rp_rk) ?> </td>
      <td align="right">
      <?php 
      $persen_total_rk = ($total_rp_rk / $pagu_skpd) * 100;
      echo round($persen_total_rk,2); ?>
        
      </td>
    <td align="center" align="center"> <?php echo '-';//round($total_persen_rf,2) ?> </td>
    

    <td align="right"><?php echo number_format($pagu_skpd_tambahan) ?></td>
    <td align="right"><?php echo number_format($total_rp_rk_tambahan) ?></td>
    <td align="right">
      <?php 
      $persen_total_rk_tambahan = ($total_rp_rk_tambahan / $pagu_skpd_tambahan) * 100;
      echo round($persen_total_rk_tambahan,2); ?>
        
      </td>
    <td align="center"> -- </td>
    <td align="right">
      <?php 
      $total_pagu_semua = $pagu_skpd + $pagu_skpd_tambahan ;
      $total_rk_semua = $total_rp_rk + $total_rp_rk_tambahan ;
      $persen_total_rk_semua = ($total_rk_semua / $total_pagu_semua) * 100;
      echo number_format($total_pagu_semua); ?>
        
      </td>
    <td align="right"> <?php echo number_format($total_rk_semua); ?> </td>
    <td align="center" > <?php echo round($persen_total_rk_semua,2) ?> </td>

  </tr>


  <?php 
   ?>
  <tr >
       

    <td colspan="4" align="center"><b>Pencapaian</b></td>
.
    <th align="center">-</th>
    
    <th align="center" colspan="2"> <?php echo round($persen_total_rk,2) ?></th>
    <th> <?php echo round($total_rft_ski,2) ?></th>
    
    <th align="center">-</th>
    <th align="center" colspan="2"> <?php echo round($persen_total_rk_tambahan,2) ?></th>
    <th > <?php echo round($total_rft_ski_tambahan,2) ?></th>
    <th align="center">-</th>
    <th align="center" colspan="2"> <?php echo round($persen_total_rk_semua,2) ?></th>

    
    
  </tr>
  

</tfoot>






</table>



<div>
  



</div>

</body>
