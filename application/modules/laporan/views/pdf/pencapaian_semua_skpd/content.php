<style>
  .font_laporan{
    font-size:7.5px;
    font-family: 'arial';
  }
   .judul_laporan{
    margin-top:15px;
    text-align : center;
    font-family: 'arial';
    font-size:10px;
  }
  .table {
    
    border-collapse: collapse;
    width:100%;
}
.table td, th {
    border: 0.01em solid ;
    padding:3px;

}

  .rata_kanan{
    text-align : right;

  }

  .tabel_header{
    font-weight:bold;
    text-align : center;
    font-size:9px;

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


  .table tbody tr:nth-child(even) {
  background-color:#EDFCFC;
}
</style>

<?php 

$q_total_pagu = $this->db->query("SELECT sum(pagu_total) as total_pagu from grafik where  tahun ='$tahun' and kode_tahap = '$tahap' and bulan='1' $q_where_pagu_bobot")->row_array();
$pagu_total = $q_total_pagu['total_pagu'];
 ?>

<div class="judul_laporan" style="margin-bottom:15px"><?php echo $judul_laporan; ?></div> 
  <table class="font_laporan table">
     <thead class="header">
        <tr>
        <th  width="20px" rowspan="4">No</th>
        <th rowspan="4">SKPD</th>
        <th colspan="36">Bulan</th>
      </tr>
      <tr>
        <?php for ($i=$bulan_mulai; $i <=$bulan_selesai ; $i++) { ?>
          <th colspan="6"><?php echo bulan_global($i) ?></th>
        <?php } ?>
      </tr>
      <tr>
        <?php for ($i=$bulan_mulai; $i <=$bulan_selesai ; $i++) { ?>
          <th colspan="3">Fisik</th>
          <th colspan="3">Keuangan</th>
        <?php } ?>
      </tr>
      <tr>
        <?php 

        $kumpul_bulan = [];
        for ($i=$bulan_mulai; $i <=$bulan_selesai ; $i++) {
             $data = [
              'pagu' => [],
              'tk' => [],
              'rk' => [],
              'tf_ttb' => [],
              'rf_ttb' => [],
              'tf' => [],
              'rf' => [],

             ];
             $kumpul_bulan[$i] = $data;


              ?>


          <th>T</th>
          <th>R</th>
          <th>D</th>
          <th>T</th>
          <th>R</th>
          <th>D</th>
        <?php } ?>
      </tr>

     

     </thead>
    <tbody>
      <?php 
      $no = 0;
      $bobot_semua =0;
      $jumlah_opd = count($opd);
      foreach ($opd as $k => $v) { 
        $no++;
        $id_instansi = $v['id_instansi'];
        $q_grafik = $this->db->query("SELECT 
                   target_fisik_akumulasi as target_fisik,
                  realisasi_fisik_akumulasi as realisasi_fisik,
                  target_keuangan_akumulasi as target_keuangan,
                  realisasi_keuangan_akumulasi as realisasi_keuangan,
                  pagu_total  , bulan, 
                  rp_target_keuangan_akumulasi, rp_realisasi_keuangan_akumulasi
                  from grafik where id_instansi='$id_instansi' and tahun ='$tahun' and kode_tahap = '$tahap' and bulan between $bulan_mulai and $bulan_selesai order by bulan asc")->result_array();
        $pagu_satuan = $q_grafik[0]['pagu_total'];
        $bobot = $pagu_satuan / $pagu_total * 100 ; 
        ?>
        <tr>
          <td align="center"><?php echo $no ?></td>
          <!-- <td align="center"><?php echo $no ?></td> -->
          <td><?php echo $v['nama_instansi'] ?></td>
          <?php 



    $kumpul_pagu_perbulan = [];
    $index = 0;


    foreach ($q_grafik as $k_g => $v_g) { 
            $deviasi_fisik = $v_g['realisasi_fisik'] - $v_g['target_fisik'];
            $deviasi_keuangan = $v_g['realisasi_keuangan'] - $v_g['target_keuangan'];



                       if ($deviasi_fisik < -10) {
                          $warna_dev_fisik = 'background: #f8b2b2'; 
                        }
                        elseif ($deviasi_fisik <=-5  && $deviasi_fisik >=-10) {
                          $warna_dev_fisik = 'background: #fcf3cf';
                        }
                        elseif ($deviasi_fisik <=0  && $deviasi_fisik >=-5) {
                          $warna_dev_fisik = 'background: #d5f5e3';
                        }else{
                          $warna_dev_fisik = 'background: #ff7cfd';
                        }

                       if ($deviasi_keuangan < -10) {
                          $warna_dev_keuangan = 'background: #f8b2b2'; 
                        }
                        elseif ($deviasi_keuangan <=-5  && $deviasi_keuangan >=-10) {
                          $warna_dev_keuangan = 'background: #fcf3cf';
                        }
                        elseif ($deviasi_keuangan <=0  && $deviasi_keuangan >=-5) {
                          $warna_dev_keuangan = 'background: #d5f5e3';
                        }else{
                          $warna_dev_keuangan = 'background: #ff7cfd';
                        }

    $tf_ttb = ($v_g['target_fisik'] * $bobot) / 100;
    $rf_ttb = $v_g['realisasi_fisik'] * $bobot / 100;
   array_push($kumpul_bulan[$v_g['bulan']]['pagu'], $v_g['pagu_total']);
   array_push($kumpul_bulan[$v_g['bulan']]['tk'], $v_g['rp_target_keuangan_akumulasi']);
   array_push($kumpul_bulan[$v_g['bulan']]['rk'], $v_g['rp_realisasi_keuangan_akumulasi']);
   array_push($kumpul_bulan[$v_g['bulan']]['tf_ttb'], $tf_ttb);
   array_push($kumpul_bulan[$v_g['bulan']]['rf_ttb'], $rf_ttb);
   array_push($kumpul_bulan[$v_g['bulan']]['tf'], $v_g['target_fisik']);
   array_push($kumpul_bulan[$v_g['bulan']]['rf'], $v_g['realisasi_fisik']);




            ?>
            <td align="center"><?php echo $v_g['target_fisik'] ?></td>
            <td align="center"><?php echo $v_g['realisasi_fisik'] ?></td>
            <td align="center" style="<?php echo $warna_dev_fisik ?>"><?php echo round($deviasi_fisik,2) ?></td>
            <td align="center"><?php echo $v_g['target_keuangan'] ?></td>
            <td align="center"><?php echo $v_g['realisasi_keuangan'] ?></td>
            <td align="center"  style="<?php echo $warna_dev_keuangan ?>"><?php echo round($deviasi_keuangan,2) ?></td>
          <?php }

          $bobot_semua += $bobot;

           ?>
        </tr>
      <?php } ?>
     
    </tbody>
    <tfoot>
      <tr>
        <th colspan="2">Total</th>

        <?php for ($i=$bulan_mulai; $i <=$bulan_selesai ; $i++) { 
          $pagu_per_bulan = array_sum($kumpul_bulan[$i]['pagu']);
          $tk_per_bulan = array_sum($kumpul_bulan[$i]['tk']);
          $rk_per_bulan = array_sum($kumpul_bulan[$i]['rk']);


          if ($asisten=='semua') {
            
            $tf_per_bulan = array_sum($kumpul_bulan[$i]['tf']) / $jumlah_opd ;
            $rf_per_bulan = array_sum($kumpul_bulan[$i]['rf']) / $jumlah_opd ;
          }else{

            $tf_per_bulan = array_sum($kumpul_bulan[$i]['tf_ttb']) ;
            $rf_per_bulan = array_sum($kumpul_bulan[$i]['rf_ttb']) ;
          }
          // $tf_per_bulan = array_sum($kumpul_bulan[$i]['tf_ttb']);
          // $rf_per_bulan = array_sum($kumpul_bulan[$i]['rf_ttb']);

          $persen_tk_perbulan = ($tk_per_bulan / $pagu_per_bulan) * 100; 
          $persen_rk_perbulan = ($rk_per_bulan / $pagu_per_bulan) * 100; 
          $deviasi_keuangan_perbulan = $persen_rk_perbulan - $persen_tk_perbulan;
          $deviasi_fisik_perbulan = $rf_per_bulan - $tf_per_bulan;


                       if ($deviasi_fisik_perbulan < -10) {
                          $warna_dev_fisik_total = 'background: #f8b2b2'; 
                        }
                        elseif ($deviasi_fisik_perbulan <=-5  && $deviasi_fisik_perbulan >=-10) {
                          $warna_dev_fisik_total = 'background: #fcf3cf';
                        }
                        elseif ($deviasi_fisik_perbulan <=0  && $deviasi_fisik_perbulan >=-5) {
                          $warna_dev_fisik_total = 'background: #d5f5e3';
                        }else{
                          $warna_dev_fisik_total = 'background: #ff7cfd';
                        }

                       if ($deviasi_keuangan_perbulan < -10) {
                          $warna_dev_keuangan_total = 'background: #f8b2b2'; 
                        }
                        elseif ($deviasi_keuangan_perbulan <=-5  && $deviasi_keuangan_perbulan >=-10) {
                          $warna_dev_keuangan_total = 'background: #fcf3cf';
                        }
                        elseif ($deviasi_keuangan_perbulan <=0  && $deviasi_keuangan_perbulan >=-5) {
                          $warna_dev_keuangan_total = 'background: #d5f5e3';
                        }else{
                          $warna_dev_keuangan_total = 'background: #ff7cfd';
                        }



          ?>
          <th> <?php echo round($tf_per_bulan,2) ?> </th>
          <th> <?php echo round($rf_per_bulan,2) ?> </th>
          <th  align="center"  style="<?php echo $warna_dev_fisik_total ?>"> <?php echo round($deviasi_fisik_perbulan,2) ?> </th>
          <th> <?php echo round($persen_tk_perbulan,2) ?> </th>
          <th> <?php echo round($persen_rk_perbulan,2) ?> </th>
          <th  align="center"  style="<?php echo $warna_dev_keuangan_total ?>"> <?php echo round($deviasi_keuangan_perbulan,2) ?> </th>
        <?php } ?>
      </tr>
    </tfoot>
   

  </table>
  <hr>
   <table class="font_laporan table">
     <thead class="header">
        <tr>
        <th rowspan="4">Realisasi Saja</th>
        <th colspan="36">Bulan</th>
      </tr>
      <tr>
         <th colspan="18">Fisik</th>
         <th colspan="18">Keuangan</th>
        
      </tr>
      <tr>
        <?php for ($i=$bulan_mulai; $i <=$bulan_selesai ; $i++) { ?>
          <th colspan="3"><?php echo bulan_global($i) ?></th>
        <?php } ?>
     
        <?php for ($i=$bulan_mulai; $i <=$bulan_selesai ; $i++) { ?>
          <th colspan="3"><?php echo bulan_global($i) ?></th>
        <?php } ?>
      </tr>

     

     </thead>
     
      <tr>

        <?php for ($i=$bulan_mulai; $i <=$bulan_selesai ; $i++) { 
          $pagu_per_bulan = array_sum($kumpul_bulan[$i]['pagu']);
          $tk_per_bulan = array_sum($kumpul_bulan[$i]['tk']);
          $rk_per_bulan = array_sum($kumpul_bulan[$i]['rk']);


          if ($asisten=='semua') {
            
            $tf_per_bulan = array_sum($kumpul_bulan[$i]['tf']) / $jumlah_opd ;
            $rf_per_bulan = array_sum($kumpul_bulan[$i]['rf']) / $jumlah_opd ;
          }else{

            $tf_per_bulan = array_sum($kumpul_bulan[$i]['tf_ttb']) ;
            $rf_per_bulan = array_sum($kumpul_bulan[$i]['rf_ttb']) ;
          }
          // $tf_per_bulan = array_sum($kumpul_bulan[$i]['tf_ttb']);
          // $rf_per_bulan = array_sum($kumpul_bulan[$i]['rf_ttb']);

          $persen_tk_perbulan = ($tk_per_bulan / $pagu_per_bulan) * 100; 
          $persen_rk_perbulan = ($rk_per_bulan / $pagu_per_bulan) * 100; 
          $deviasi_keuangan_perbulan = $persen_rk_perbulan - $persen_tk_perbulan;
          $deviasi_fisik_perbulan = $rf_per_bulan - $tf_per_bulan;


                       if ($deviasi_fisik_perbulan < -10) {
                          $warna_dev_fisik_total = 'background: #f8b2b2'; 
                        }
                        elseif ($deviasi_fisik_perbulan <=-5  && $deviasi_fisik_perbulan >=-10) {
                          $warna_dev_fisik_total = 'background: #fcf3cf';
                        }
                        elseif ($deviasi_fisik_perbulan <=0  && $deviasi_fisik_perbulan >=-5) {
                          $warna_dev_fisik_total = 'background: #d5f5e3';
                        }else{
                          $warna_dev_fisik_total = 'background: #ff7cfd';
                        }

                       if ($deviasi_keuangan_perbulan < -10) {
                          $warna_dev_keuangan_total = 'background: #f8b2b2'; 
                        }
                        elseif ($deviasi_keuangan_perbulan <=-5  && $deviasi_keuangan_perbulan >=-10) {
                          $warna_dev_keuangan_total = 'background: #fcf3cf';
                        }
                        elseif ($deviasi_keuangan_perbulan <=0  && $deviasi_keuangan_perbulan >=-5) {
                          $warna_dev_keuangan_total = 'background: #d5f5e3';
                        }else{
                          $warna_dev_keuangan_total = 'background: #ff7cfd';
                        }



          ?>
          <th colspan="3"> <?php echo round($rf_per_bulan,2) ?> </th>
         
        <?php } ?>
        <?php for ($i=$bulan_mulai; $i <=$bulan_selesai ; $i++) { 
          $pagu_per_bulan = array_sum($kumpul_bulan[$i]['pagu']);
          $tk_per_bulan = array_sum($kumpul_bulan[$i]['tk']);
          $rk_per_bulan = array_sum($kumpul_bulan[$i]['rk']);


          if ($asisten=='semua') {
            
            $tf_per_bulan = array_sum($kumpul_bulan[$i]['tf']) / $jumlah_opd ;
            $rf_per_bulan = array_sum($kumpul_bulan[$i]['rf']) / $jumlah_opd ;
          }else{

            $tf_per_bulan = array_sum($kumpul_bulan[$i]['tf_ttb']) ;
            $rf_per_bulan = array_sum($kumpul_bulan[$i]['rf_ttb']) ;
          }
          // $tf_per_bulan = array_sum($kumpul_bulan[$i]['tf_ttb']);
          // $rf_per_bulan = array_sum($kumpul_bulan[$i]['rf_ttb']);

          $persen_tk_perbulan = ($tk_per_bulan / $pagu_per_bulan) * 100; 
          $persen_rk_perbulan = ($rk_per_bulan / $pagu_per_bulan) * 100; 
          $deviasi_keuangan_perbulan = $persen_rk_perbulan - $persen_tk_perbulan;
          $deviasi_fisik_perbulan = $rf_per_bulan - $tf_per_bulan;


                       if ($deviasi_fisik_perbulan < -10) {
                          $warna_dev_fisik_total = 'background: #f8b2b2'; 
                        }
                        elseif ($deviasi_fisik_perbulan <=-5  && $deviasi_fisik_perbulan >=-10) {
                          $warna_dev_fisik_total = 'background: #fcf3cf';
                        }
                        elseif ($deviasi_fisik_perbulan <=0  && $deviasi_fisik_perbulan >=-5) {
                          $warna_dev_fisik_total = 'background: #d5f5e3';
                        }else{
                          $warna_dev_fisik_total = 'background: #ff7cfd';
                        }

                       if ($deviasi_keuangan_perbulan < -10) {
                          $warna_dev_keuangan_total = 'background: #f8b2b2'; 
                        }
                        elseif ($deviasi_keuangan_perbulan <=-5  && $deviasi_keuangan_perbulan >=-10) {
                          $warna_dev_keuangan_total = 'background: #fcf3cf';
                        }
                        elseif ($deviasi_keuangan_perbulan <=0  && $deviasi_keuangan_perbulan >=-5) {
                          $warna_dev_keuangan_total = 'background: #d5f5e3';
                        }else{
                          $warna_dev_keuangan_total = 'background: #ff7cfd';
                        }



          ?>
          <th colspan="3"> <?php echo round($persen_rk_perbulan,2) ?> </th>
         
        <?php } ?>
      </tr>
   </table>

