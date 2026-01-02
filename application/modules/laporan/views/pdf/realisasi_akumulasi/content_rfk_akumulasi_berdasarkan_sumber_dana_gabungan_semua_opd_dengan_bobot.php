<?php 
// ini_set('memory_limit', '1500000M');
//  ini_set("pcre.backtrack_limit", "3000000");
  $kumpul_skpd = [];
  $no_skpd = 0;

  $total_pagu = 0 ;
  $total_tf = 0 ;
  $total_tf_ttb = 0 ;
  $total_rf = 0 ;
  $total_rf_ttb = 0 ;
  $total_tk_rp = 0 ;
  $total_tk_persen = 0 ;
  $total_rk_rp = 0 ;
  $total_rk_persen = 0 ;
  $total_sisa_angaran = 0 ;

    $jenis_sumber_dana_terkolom = ['pad','dau','dak','dbh'];
  foreach ($daftar_skpd as $k_skpd => $v_skpd) {
    $total_pagu_ski_skpd = 0 ; 
    $total_tf_ski_skpd = 0 ; 
    $total_tf_ttb_ski_skpd = 0 ; 
    $total_rf_ski_skpd = 0 ; 
    $total_rf_ttb_ski_skpd = 0 ; 
    $total_tk_rp_ski_skpd = 0 ; 
    $total_tk_persen_ski_skpd = 0 ; 
    $total_rk_rp_ski_skpd = 0 ; 
    $total_rk_persen_ski_skpd = 0 ; 
    $total_sisa_pagu_ski_skpd = 0 ; 
    $no_skpd++;
    $id_skpd = $v_skpd->id_instansi;
    $id_instansi = $v_skpd->id_instansi;
    $kumpul_program = [];
    $no_program = 0;
    $program = $this->realisasi_akumulasi_model->get_program_berdasarkan_sumber_dana($id_skpd, $tahap, $tahun, $field_jenis_sumber_dana)->result();


    foreach ($program as $key => $value) { 
      $total_program +=1;
      $no_program++;
      // $pagu_program += $value->pagu;
      $kumpul_kegiatan = [];
      $no_kegiatan = 0;
      $kegiatan = $this->realisasi_akumulasi_model->get_kegiatan_berdasarkan_sumber_dana($id_skpd, $value->kode_rekening_program, $value->kode_bidang_urusan, $field_jenis_sumber_dana)->result(); 
      $total_pagu_program = 0; 
      foreach ($kegiatan as $key => $value_kegiatan) {
        $total_kegiatan +=1;
        $banyak_kegiatan +=1;
        $no_kegiatan++;
        $no_sub_kegiatan = 0;
        $kumpul_sub_kegiatan = [];
        $sub_kegiatan = $this->realisasi_akumulasi_model->get_sub_kegiatan_berdasarkan_sumber_dana($id_skpd, $value_kegiatan->kode_rekening_kegiatan, $value_kegiatan->kode_rekening_program, $value_kegiatan->kode_bidang_urusan,  $field_jenis_sumber_dana );


        $total_pagu_kegiatan = 0;

        foreach ($sub_kegiatan->result() as $key => $value_sk) {
          $no_sub_kegiatan++;
          $kategori_sub_kegiatan = $value_sk->kategori;
          $tahap = $value_sk->kode_tahap;
          $krsk = $value_sk->kode_rekening_sub_kegiatan;
              if($kategori_sub_kegiatan =='Unit Pelaksana'){
                $nama_sub_kegiatan = $value_sk->nama_sub_kegiatan."<br>[".$value_sk->jenis_sub_kegiatan.' - '.$value_sk->keterangan."]";
               
              }else{
                $nama_sub_kegiatan = $value_sk->nama_sub_kegiatan;
              }



               $q_pptk = $this->db->query("SELECT mu.full_name as pptk, mu2.full_name  as kpa from users_sub_kegiatan usk left join master_users mu on usk.id_user = mu.id_user and usk.id_instansi=mu.id_instansi
            left join sub_instansi si on mu.id_sub_instansi = si.id_sub_instansi 
            left join master_users  mu2 on si.id_kpa = mu2.id_sub_instansi and usk.id_instansi=mu2.id_instansi

              where usk.id_instansi = '$id_skpd' and usk.tahun_anggaran='$tahun' and usk.kode_tahap = '$tahap' and usk.status='1' and kode_rekening_sub_kegiatan ='$krsk'
            ")->row_array();
          $pptk= $q_pptk['pptk'];
          $kpa = $q_pptk['kpa'];


          $target = $this->realisasi_akumulasi_model->get_target($id_skpd, $value_sk->kode_rekening_sub_kegiatan, $bulan, $value_sk->kode_tahap, $value_sk->tahun)->row_array();
          $realisasi_keuangan = $this->realisasi_akumulasi_model->get_realisasi_keuangan($id_skpd, $value_sk->kode_rekening_sub_kegiatan, $bulan, $ope, $tahun, $tahap)->row_array();

          if ($ope=='=') {
            $target_fisik = $target['target_fisik_bulanan'];
            $target_keuangan = $target['target_keuangan_bulanan'];
            $nilai_persen_target_keuangan = ($target['target_keuangan_bulanan'] / $value_sk->pagu) * 100 ; 
            
          }else{
            $target_keuangan = $target['target_keuangan'];
            $target_fisik = $target['target_fisik'];
            $nilai_persen_target_keuangan = ($target['target_keuangan'] / $value_sk->pagu) * 100 ; 

          }

          $porsi_target_fisik = ($target_fisik / $angka_pembagi_fisik) * 100 ; 
          $total_porsi_target_fisik += $porsi_target_fisik ;
          // $target_fisik_bulanan = $target['target_fisik_bulanan'];

          // 
          if ($value_sk->pagu == 0) {
            $persen_target_keuangan   = 0;
            $persen_realisasi_keuangan  = 0;
          } else {
          $persen_target_keuangan = $nilai_persen_target_keuangan; 
            $persen_realisasi_keuangan  = round(($realisasi_keuangan['total_realisasi'] / $value_sk->pagu) * 100, 2);
          }





           $total_paket = $this->realisasi_akumulasi_model->get_total_paket($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $tahun, $tahap)->num_rows();
          $jenis_rutin = $this->realisasi_akumulasi_model->get_total_paket_perjenis($id_instansi, $value_sk->kode_rekening_sub_kegiatan, "RUTIN", $tahun, $tahap)->num_rows();
          $swa = $this->realisasi_akumulasi_model->get_realisasi_fisik($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $bulan, 'SWAKELOLA', $ope, $tahun, $tahap)->row_array();
          $pen = $this->realisasi_akumulasi_model->get_realisasi_fisik($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $bulan, 'PENYEDIA', $ope, $tahun, $tahap)->row_array();


          if ($ope=='=') {
            $total_target_fisik   += isset($target['target_fisik_bulanan']) ? $target['target_fisik_bulanan'] : 0;
            $total_angka_target_keuangan += $target['target_keuangan_bulanan'];
          }else{
            $total_target_fisik   += isset($target['target_fisik']) ? $target['target_fisik'] : 0;
            $total_angka_target_keuangan += $target['target_keuangan'];
          }

          $sisa_pagu = $value_sk->pagu -$realisasi_keuangan['total_realisasi'] ;





          $bulan_mulai = mulai_realisasi_instansi($id_instansi);
          $bulan_akhir = akhir_realisasi_instansi($id_instansi);
          $lama_realisasi = $bulan_akhir - $bulan_mulai +1;

          $realisasi_rutin_bulan = [];
          $ke = 0;
          for ($i=$bulan_mulai; $i <= $bulan_akhir ; $i++) { 
            $ke++;
            $bulan_realisasi = $bulan_mulai + $i;



            $push = [
              $i=>($ke / $lama_realisasi * 100)
            ];
            array_push($realisasi_rutin_bulan, $push);
            
          }
          
              $selisih_bulan = $bulan - $bulan_mulai;
            if ($bulan<$bulan_mulai) {
                $realisasi_rutin = 0;
            }
            elseif ($bulan>$bulan_akhir) {
                $realisasi_rutin = 100;
            }else{
              if ($ope=='=') {
                $realisasi_rutin = (1/$lama_realisasi) *100;
              }else{
                $realisasi_rutin = $realisasi_rutin_bulan[$selisih_bulan][$bulan];
              }
            }


          // $rut = $jenis_rutin > 0 ? ($jenis_rutin * $realisasi_rutin) : 0;
          $rut = $jenis_rutin > 0 ? $persen_realisasi_keuangan : 0;
          $swa_tot  = !empty($swa['total']) ? $swa['total'] : 0;
          $pen_tot  = !empty($pen['total']) ? $pen['total'] : 0;
          $rut_tot  = !empty($rut) ? $rut : 0;


         if ($total_paket != 0) {
            $total_fisik = ($swa_tot + $pen_tot + $rut_tot) / $total_paket;
          } else {
            $total_fisik = 0;
          }

          $total_realisasi_fisik    = $total_fisik > 100 ? 100 : $total_fisik;




           $dev_fisik = $total_realisasi_fisik - $target_fisik;
          $dev_keu = $persen_realisasi_keuangan - $persen_target_keuangan;





            if ($dev_fisik < -10) {
              $warna_peringatan_dev_fisik = 'background: #f8b2b2'; 
              // $total_peringatan_dev_fisik_merah += 1; 
            }
            elseif ($dev_fisik <-5  && $dev_fisik >=-10) {
              $warna_peringatan_dev_fisik = 'background: #fcf3cf';
              // $total_peringatan_dev_fisik_kuning += 1; 
            }
            elseif ($dev_fisik <=0  && $dev_fisik >=-5) {
              $warna_peringatan_dev_fisik = 'background: #d5f5e3';
              // $total_peringatan_dev_fisik_kuning += 1; 
            }else{
              $warna_peringatan_dev_fisik = 'background: #ff7cfd';
              // $total_peringatan_dev_fisik_hijau += 1; 
            }

            if ($dev_keu < -10) {
              $warna_peringatan_dev_keu = 'background: #f8b2b2'; 
              // $total_peringatan_dev_keu_merah += 1; 
            }
            elseif ($dev_keu <-5  && $dev_keu >=-10) {
              $warna_peringatan_dev_keu = 'background: #fcf3cf';
              // $total_peringatan_dev_keu_kuning += 1; 
            }
            elseif ($dev_keu <=0  && $dev_keu >=-5) {
              $warna_peringatan_dev_keu = 'background: #d5f5e3';
              // $total_peringatan_dev_keu_kuning += 1; 
            }else{
              $warna_peringatan_dev_keu = 'background: #ff7cfd';
              // $total_peringatan_dev_keu_hijau += 1; 
            }





        






            $total_pagu_kegiatan += $value_sk->pagu ; 
            $total_tf_ski_skpd += $target_fisik ; 
            $total_rf_ski_skpd += $total_realisasi_fisik ; 
            $total_rf_ttb_ski_skpd += $rft_ski ; 
            $total_tk_rp_ski_skpd += $target_keuangan ; 
            $total_tk_persen_ski_skpd += $persen_target_keuangan ; 
            $total_rk_rp_ski_skpd += $realisasi_keuangan['total_realisasi'] ; 
            $total_rk_persen_ski_skpd += $persen_realisasi_keuangan ; 
            $total_sisa_pagu_ski_skpd += $sisa_pagu ; 



          $data_sub_kegiatan = [
            'no_sub_kegiatan' => $no_skpd.'.'.$no_program.'.'.$no_kegiatan.".".$no_sub_kegiatan, 
            'nama_sub_kegiatan' => $nama_sub_kegiatan, 
            'tahapan_apbd' => pilihan_nama_tahapan($value_sk->kode_tahap), 
            'kode_sub_kegiatan' => $krsk, 
            'pagu' => $value_sk->pagu, 
            'kpa' =>  $kpa, 
            'pptk' =>  $pptk, 
            // 'bobot' =>  $bobot_ski, 
            'tf_persen' =>  $target_fisik, 
            // 'tf_ttb' =>  $tft_ski, 
            'rf_persen' =>  $total_realisasi_fisik, 
            // 'rf_ttb' =>  $rft_ski, 
            'df_persen' =>  $dev_fisik, 
            'df_warna' =>  $warna_peringatan_dev_fisik, 

            'tk_rp' =>  $target_keuangan, 
            'tk_persen' =>  $persen_target_keuangan, 
            'rk_rp' =>  $realisasi_keuangan['total_realisasi'], 
            'rk_persen' =>  $persen_realisasi_keuangan, 
            'dk_persen' =>  $dev_keu, 
            'dk_warna' =>  $warna_peringatan_dev_keu, 
            'sisa_pagu' =>  $sisa_pagu, 
            'jenis_sumber_dana'=> $value_sk->id_jenis_sumber_dana=='Lainnya' ? $value_sk->nama_sumber_dana_lainnya : $value_sk->jenis_sumber_dana,
          ];
          array_push($kumpul_sub_kegiatan, $data_sub_kegiatan);

        } // akhir foreach ($sub_kegiatan->result() as $key => $value_sk) {

          $total_pagu_program +=$total_pagu_kegiatan ; 
          $data_kegiatan = [

            'no_kegiatan' => $no_skpd.'.'.$no_program.'.'.$no_kegiatan, 
            'nama_kegiatan' => $value_kegiatan->nama_kegiatan,
            'data_sub_kegiatan' => $kumpul_sub_kegiatan,
            'pagu_kegiatan' => $total_pagu_kegiatan,
          ];
          array_push($kumpul_kegiatan, $data_kegiatan);
      } // akhir foreach ($kegiatan as $key => $value_kegiatan) {

      $total_pagu_ski_skpd += $total_pagu_program; 
        $data_program = [
          'no_program'=>$no_skpd.'.'.$no_program,
          'nama_program'=>$value->nama_program,
          'data_kegiatan'=>$kumpul_kegiatan,
          'pagu_program'=>$total_pagu_program
        ];
        array_push($kumpul_program, $data_program);

    } // ekhir foreach ($program as $key => $value) { 

      $data_skpd = [
        'no'=>$no_skpd,
        'id_skpd'=>$id_skpd,
        'nama_instansi'=>$v_skpd->nama_instansi,
        'total_pagu_ski_skpd'=>$total_pagu_ski_skpd, 
        'total_tf_ski_skpd'=>$total_tf_ski_skpd, 
        'total_tf_ttb_ski_skpd'=>$total_tf_ttb_ski_skpd, 
        'total_rf_ski_skpd'=>$total_rf_ski_skpd, 
        'total_rf_ttb_ski_skpd'=>$total_rf_ttb_ski_skpd, 
        'total_tk_rp_ski_skpd'=>$total_tk_rp_ski_skpd, 
        'total_tk_persen_ski_skpd'=>$total_tk_persen_ski_skpd, 
        'total_rk_rp_ski_skpd'=>$total_rk_rp_ski_skpd, 
        'total_rk_persen_ski_skpd'=>$total_rk_persen_ski_skpd, 
        'total_sisa_pagu_ski_skpd'=>$total_sisa_pagu_ski_skpd, 
        'data_program' =>$kumpul_program
      ];
      array_push($kumpul_skpd, $data_skpd);


  } // akhir foreach (daftar_skpd) {

 ?>
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

<head>
  <title><?php echo $title ?></title>
</head>





<body>

<table class="font_laporan border table">
 <thead class="header">
    <tr>
    <th rowspan="3"  width="30px"><?php echo $var ?></th>
    <th rowspan="2" colspan="6" >Program, Kegiatan, Sub Kegiatan</th>
    <th rowspan="2">Bobot</th>
    <!-- <th rowspan="3" style="width:80px">Pagu Anggaran</th> -->
    <th colspan="5">Fisik </th>
    <th colspan="5">Keuangan </th>
     <?php if ($ope=='<=') { 
      $colspan_deviasi_keuangan_semua = 7;
      ?>
        <th rowspan="2" style="width:80px">Sisa Anggaran</th>
    <?php }else{
      $colspan_deviasi_keuangan_semua = 5;

    }

     if (in_array($field_jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
      $colspan_program_kegiatan = 18;
      
    }else{ 
       $colspan_program_kegiatan = 19;
       ?>
    <th rowspan="3">Keterangan</th>
    <?php } 




    

     ?>
   

   
  </tr>
  <tr>
    <th colspan="2">Target</th>
    <th colspan="2">Realisasi</th>
    <th rowspan="2" style="width:35px;">Deviasi</th>
    <th colspan="2">Target</th>
    <th colspan="2">Realisasi</th>
    <th rowspan="2"  style="width:35px">Deviasi</th>
  </tr>
  <tr>
    <th  style="width:85px">Tahapan APBD</th>
    <th  style="width:85px">Kode Rekening</th>
    <th>Uraian</th>
    <th style="width:80px">Pagu</th>
    <th>KPA</th>
    <th>PPTK</th>
    <th style="width:35px">%</th>
    <th style="width:35px">%</th>
    <th style="width:35px">Ttb</th>
    <th style="width:35px">%</th>
    <th style="width:35px">Ttb</th>
    <th style="width:80px">Nilai (Rp.)</th>
    <th style="width:35px">%</th>
    <th style="width:80px">Nilai (Rp.)</th>
    <th style="width:35px">%</th>
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
    <th>8=5/PT*100</th>
    <th>9</th>
    <th>10=9*8/100</th>
    <th>11</th>
    <th>12=11*6/100</th>
    <th>13=11-9</th>
    <th>14</th>
    <th>15=(14/5)*100</th>
    <th>16</th>
    <th>17=(16/5)*100</th>
    <th>18=17-15</th>
     <?php if ($ope=='<=') { ?>
    <th>19=5-16d</th>
    <?php } 

    if (in_array($field_jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
      
    }else{ 
       ?>
    <th>20</th>
    <?php } ?>
  </tr>

 </thead>




 <tbody>
 
  <?php foreach ($kumpul_skpd as $k_skpd => $v_skpd) {
  $total_bobot_skpd =0; 
    $total_tft_skpd =0;
    $total_rft_skpd =0;
    ?>
  <tr style="background: aqua" >
    <td align="center"><?php echo $v_skpd['no'] ?></td>
    <td colspan="<?php echo $colspan_program_kegiatan ?>"><b><?php echo $v_skpd['nama_instansi'] ?></b></td>
  </tr>

  <?php foreach ($v_skpd['data_program'] as $k_program => $v_program) { 
  $total_bobot_program = 0; 
  $total_tft_program =0;
  $total_rft_program =0;
  ?>
   <tr style="background: #c6d1fa">
    <td align="center"><?php echo $v_program['no_program'] ?></td>
    <td colspan="<?php echo $colspan_program_kegiatan ?>"><?php echo $v_program['nama_program'] ?></td>

  </tr>


  <?php foreach ($v_program['data_kegiatan'] as $k_kegiatan => $v_kegiatan) { 
    $total_bobot_kegiatan = 0 ;
    $total_tft_kegiatan = 0 ;
    $total_rft_kegiatan = 0 ;
    ?>
   <tr style="background: #c6faf8">
    <td align="center"><?php echo $v_kegiatan['no_kegiatan'] ?></td>
    <td colspan="<?php echo $colspan_program_kegiatan ?>"><?php echo $v_kegiatan['nama_kegiatan'] ?></td>
  </tr>

  <?php foreach ($v_kegiatan['data_sub_kegiatan'] as $k_sub_kegiatan => $v_sub_kegiatan) { 




      $bobot_ski = $v_sub_kegiatan['pagu']/$v_skpd['total_pagu_ski_skpd']*100;
          $tft_ski = $v_sub_kegiatan['tf_persen'] * $bobot_ski/100 ; 
          $rft_ski = $v_sub_kegiatan['rf_persen']*$bobot_ski/100 ; 

          $total_bobot_kegiatan += $bobot_ski;
          $total_tft_kegiatan += $tft_ski;
          $total_rft_kegiatan += $rft_ski;




    $total_pagu += $v_sub_kegiatan['pagu'];
$total_tf += $v_sub_kegiatan['tf_persen'] ; 
$total_rf += $v_sub_kegiatan['rf_persen'] ; 
$total_rf_ttb += $rft_ski;//$v_sub_kegiatan['rf_ttb'] ; 
$total_tk_rp += $v_sub_kegiatan['tk_rp'] ; 
$total_tk_persen += $v_sub_kegiatan['tk_persen'] ; 
$total_rk_rp += $v_sub_kegiatan['rk_rp'] ; 
$total_rk_persen += $v_sub_kegiatan['rk_persen'] ; 
$total_sisa_angaran += $v_sub_kegiatan['sisa_pagu'] ; 

    ?>
   <tr>
    <td align="center"><?php echo $v_sub_kegiatan['no_sub_kegiatan'] ?></td>
    <td><?php echo $v_sub_kegiatan['tahapan_apbd'] ?></td>
    <td style="word-wrap:normal"><?php echo $v_sub_kegiatan['kode_sub_kegiatan'] ?></td>
    <td><?php echo $v_sub_kegiatan['nama_sub_kegiatan'] ?></td>
    <td align="right"><?php echo number_format($v_sub_kegiatan['pagu']) ?></td>
    <td><?php echo $v_sub_kegiatan['kpa'] ?></td>
    <td><?php echo $v_sub_kegiatan['pptk'] ?></td>
    <td align="center"><?php echo round($bobot_ski,2) ?></td>
    <td align="center"><?php echo round($v_sub_kegiatan['tf_persen'],2) ?></td>
    <td align="center"><?php echo round($tft_ski,2) ?></td>
    <td align="center"><?php echo round($v_sub_kegiatan['rf_persen'],2) ?></td>
    <td align="center"><?php echo round($rft_ski,2) ?></td>
    <td align="center" style="<?php echo $v_sub_kegiatan['df_warna'] ?>"><?php echo round($v_sub_kegiatan['df_persen'],2) ?></td>
    <td align="right"><?php echo number_format($v_sub_kegiatan['tk_rp']) ?></td>
    <td align="center"><?php echo round($v_sub_kegiatan['tk_persen'],2) ?></td>
    <td align="right"><?php echo number_format($v_sub_kegiatan['rk_rp']) ?></td>
    <td align="center"><?php echo round($v_sub_kegiatan['rk_persen'],2) ?></td>
    <td align="center" style="<?php echo $v_sub_kegiatan['dk_warna'] ?>"><?php echo round($v_sub_kegiatan['dk_persen'],2) ?></td>
    <td align="right"><?php echo number_format($v_sub_kegiatan['sisa_pagu']) ?></td>
     <?php if (in_array($field_jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
        
      }else{  ?>
        
          <td> <?php echo $v_sub_kegiatan['jenis_sumber_dana'] ?></td>
     
      <?php 
       } ?>


  </tr>
  
  <?php 
        } //end foreach ($v_kegiatan['data_sub_kegiatan'] as $k_sub_kegiatan => $v_sub_kegiatan) {

          $total_bobot_program += $total_bobot_kegiatan ; 
          $total_tft_program += $total_tft_kegiatan ; 
          $total_rft_program += $total_rft_kegiatan ; 
      } // end foreach ($v_program['data_kegiatan'] as $k_kegiatan => $v_kegiatan) { 
        $total_bobot_skpd += $total_bobot_program;
        $total_tft_skpd += $total_tft_program;
        $total_rft_skpd += $total_rft_program;
    } // end foreach ($v_skpd['data_program'] as $k_skpd => $v_skpd) {


$pencapaian_tk_persen = $v_skpd['total_tk_rp_ski_skpd'] / $v_skpd['total_pagu_ski_skpd'] * 100 ; 
$pencapaian_rk_persen = $v_skpd['total_rk_rp_ski_skpd'] / $v_skpd['total_pagu_ski_skpd'] * 100 ; 

    $dev_fisik_skpd =  $total_rft_skpd - $total_tft_skpd ;//$skpd_rf_ttb - $skpd_tf_ttb ;
        $dev_keuangan_skpd = $pencapaian_rk_persen - $pencapaian_tk_persen;

        if ($dev_fisik_skpd <-10) {
              $warna_peringatan_dev_fisik_skpd = 'background: #f8b2b2'; 
            }
            elseif ($dev_fisik_skpd <-5  && $dev_fisik_skpd >=-10) {
              $warna_peringatan_dev_fisik_skpd = 'background: #fcf3cf';
            }
            elseif ($dev_fisik_skpd <=0  && $dev_fisik_skpd >=-5) {
              $warna_peringatan_dev_fisik_skpd = 'background: #d5f5e3';
            }else{
              $warna_peringatan_dev_fisik_skpd = 'background: #ff7cfd';
            }

            if ($dev_keuangan_skpd <-10) {
              $warna_peringatan_dev_keu_skpd = 'background: #f8b2b2'; 
            }
            elseif ($dev_keuangan_skpd <-5  && $dev_keuangan_skpd >=-10) {
              $warna_peringatan_dev_keu_skpd = 'background: #fcf3cf';
            }
            elseif ($dev_keuangan_skpd <=0  && $dev_keuangan_skpd >=-5) {
              $warna_peringatan_dev_keu_skpd = 'background: #d5f5e3';
            }else{
              $warna_peringatan_dev_keu_skpd = 'background: #ff7cfd';
            }



          $total_tf_ttb += $total_tft_skpd;//
          $total_f_ttb += $total_ft_skpd;//

  ?>
  <tr style="background:  #e7dfea ">
    <th colspan="4">Total</th>
    <th align="right"><?php echo number_format($v_skpd['total_pagu_ski_skpd']) ?></th>
    <th>-</th>
    <th>-</th>
    <th><?php echo round($total_bobot_skpd,2) ?></th>
    <th colspan="2"><?php echo round($total_tft_skpd,2) ?></th>
    <th colspan="2"><?php echo round($total_rft_skpd,2) ?></th>
    <th style="<?php echo $warna_peringatan_dev_fisik_skpd ?>"><?php echo round($dev_fisik_skpd,2) ?></th>
    <th align="right"><?php echo number_format($v_skpd['total_tk_rp_ski_skpd']) ?></th>
    <th><?php echo round($pencapaian_tk_persen,2) ?></th>
    <th align="right"><?php echo number_format($v_skpd['total_rk_rp_ski_skpd']) ?></th>
    <th><?php echo round($pencapaian_rk_persen,2) ?></th>
    <th style="<?php echo $warna_peringatan_dev_keu_skpd ?>"><?php echo round($dev_keuangan_skpd,2) ?></th>
    <th align="right"><?php echo number_format($v_skpd['total_sisa_pagu_ski_skpd']) ?></th>
      <?php if (in_array($field_jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
        
      }else{  ?>
        
          <td>-</td>
     
      <?php 
       } ?>


  </tr>
 <?php  } // end foreach ($kumpul_skpd as $k_skpd => $v_skpd) {



    @$persen_tk_total = $total_tk_rp / $total_pagu * 100 ; 
    @$persen_rk_total = $total_rk_rp / $total_pagu * 100 ; 


    $pencapain_tf_total = $total_tf_ttb / $no_skpd ; 
    $pencapain_rf_total = $total_rf_ttb / $no_skpd ; 

    $dev_fisik_total =  $pencapain_rf_total - $pencapain_tf_total ;//$total_rf_ttb - $total_tf_ttb ;
        $dev_keuangan_total = $persen_rk_total - $persen_tk_total;

        if ($dev_fisik_total <-10) {
              $warna_peringatan_dev_fisik_total = 'background: #f8b2b2'; 
            }
            elseif ($dev_fisik_total <-5  && $dev_fisik_total >=-10) {
              $warna_peringatan_dev_fisik_total = 'background: #fcf3cf';
            }
            elseif ($dev_fisik_total <=0  && $dev_fisik_total >=-5) {
              $warna_peringatan_dev_fisik_total = 'background: #d5f5e3';
            }else{
              $warna_peringatan_dev_fisik_total = 'background: #ff7cfd';
            }

            if ($dev_keuangan_total <-10) {
              $warna_peringatan_dev_keu_total = 'background: #f8b2b2'; 
            }
            elseif ($dev_keuangan_total <-5  && $dev_keuangan_total >=-10) {
              $warna_peringatan_dev_keu_total = 'background: #fcf3cf';
            }
            elseif ($dev_keuangan_total <=0  && $dev_keuangan_total >=-5) {
              $warna_peringatan_dev_keu_total = 'background: #d5f5e3';
            }else{
              $warna_peringatan_dev_keu_total = 'background: #ff7cfd';
            }



  ?>
   
 </tbody>
 <tfoot>
   <tr>
    <th colspan="<?php echo $colspan_program_kegiatan+1 ?>"><hr></th>
  </tr>
   <tr>
     <th colspan="4">Total</th>
     <th align="right"><?php echo number_format($total_pagu) ?></th>
     <th>-</th>
     <th>-</th>
     <th>-</th>
     <th>-</th>
     <th><?php echo round($total_tf_ttb,2) ?></th>
     <th>-</th>
     <th><?php echo round($total_rf_ttb,2) ?></th>
     <th>-</th>
     <th align="right"><?php echo number_format($total_tk_rp) ?></th>
     <th><?php echo round($total_tk_persen,2) ?></th>
     <th align="right"><?php echo number_format($total_rk_rp) ?></th>
     <th><?php echo round($total_rk_persen,2) ?></th>
     <th>-</th>
     <th align="right"><?php echo number_format($total_sisa_angaran) ?></th>
      <?php if (in_array($field_jenis_sumber_dana, $jenis_sumber_dana_terkolom)) {
        
      }else{  ?>
        
          <th rowspan="2">-</th>
     
      <?php 
       } ?>
   </tr>
   <tr>
     <th colspan="4">Pencapaian</th>
     <th>-</th>
     <th>-</th>
     <th>-</th>
     <th>-</th>
     <th  colspan="2"><?php echo round($pencapain_tf_total,2) ?></th>
     <th  colspan="2"><?php echo round($pencapain_rf_total,2) ?></th>
     <th style="<?php echo $warna_peringatan_dev_fisik_total ?>">  <?php echo round($dev_fisik_total,2) ?> </th>
     <th  colspan="2"><?php echo round($persen_tk_total,2) ?></th>
     <th  colspan="2"><?php echo round($persen_rk_total,2) ?></th>
     <th style="<?php echo $warna_peringatan_dev_keu_total ?>"> <?php echo round($dev_keuangan_total,2) ?></th>
     <th> - </th>
   </tr>
 </tfoot>
</table>
