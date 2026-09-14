<style>
  .font_laporan{
    font-size:9px;
    font-family: 'calibri';
  }
  .laporan_asisten{
   
    border-collapse: collapse;
    width:100%;
  }
 
.table td, th {
    border: 0.01em solid ;
    padding:3px;

}

  .tabel_header{
    font-weight:bold;
    text-align : center;
    font-size:9px;

  }

  .rata_kanan{
    text-align : right;

  }
  .rata_tengah{
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
</style>

<?php 
  $total_peringatan_dev_fisik_merah = 0;
   $total_peringatan_dev_fisik_kuning = 0;
   $total_peringatan_dev_fisik_hijau = 0;
   $total_peringatan_dev_fisik_ungu = 0;
   $total_peringatan_dev_keu_merah = 0;
   $total_peringatan_dev_keu_kuning = 0;
   $total_peringatan_dev_keu_hijau = 0;
   $total_peringatan_dev_keu_ungu = 0;



  $total_peringatan_dev_fisik_merah_satu = 0;
   $total_peringatan_dev_fisik_kuning_satu = 0;
   $total_peringatan_dev_fisik_hijau_satu = 0;
   $total_peringatan_dev_fisik_ungu_satu = 0;
   $total_peringatan_dev_keu_merah_satu = 0;
   $total_peringatan_dev_keu_kuning_satu = 0;
   $total_peringatan_dev_keu_hijau_satu = 0;
   $total_peringatan_dev_keu_ungu_satu = 0;



  $total_peringatan_dev_fisik_merah_dua = 0;
   $total_peringatan_dev_fisik_kuning_dua = 0;
   $total_peringatan_dev_fisik_hijau_dua = 0;
   $total_peringatan_dev_fisik_ungu_dua = 0;
   $total_peringatan_dev_keu_merah_dua = 0;
   $total_peringatan_dev_keu_kuning_dua = 0;
   $total_peringatan_dev_keu_hijau_dua = 0;
   $total_peringatan_dev_keu_ungu_dua = 0;



  $total_peringatan_dev_fisik_merah_tiga = 0;
   $total_peringatan_dev_fisik_kuning_tiga = 0;
   $total_peringatan_dev_fisik_hijau_tiga = 0;
   $total_peringatan_dev_fisik_ungu_tiga = 0;
   $total_peringatan_dev_keu_merah_tiga = 0;
   $total_peringatan_dev_keu_kuning_tiga = 0;
   $total_peringatan_dev_keu_hijau_tiga = 0;
   $total_peringatan_dev_keu_ungu_tiga = 0;

   $total_data_skpd = 0;
   $total_data_skpd_satu = 0;
   $total_data_skpd_dua = 0;
   $total_data_skpd_tiga = 0;
    ?>
<div class="judul_laporan" style="margin-bottom:15px"><?php echo $judul_laporan ?></div> 
<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten table" style="background: #F0F9FF">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th rowspan="2">ASISTEN PEMERINTAHAN DAN KESRA</th>
        <th colspan="3">Fisik</th>
        <th colspan="3">Keuangan</th>
      </tr>
      <tr>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
      </tr>
    </thead>
    <tbody >
      <?php
          $tertimbang_satu       = 0;
          $total_t_fisik_satu    = 0;
          $total_t_keu_satu      = 0;
          $total_r_fisik_satu    = 0;
          $total_r_keu_satu      = 0;
          $total_tertimbang_satu = 0;
          $jml_skpd_satu         = 0;

          $total_pagu =0;
          $total_rp_t_keu = 0;  
          $total_rp_r_keu = 0;

          $total_pagu_satu =0;
          $total_rp_t_keu_satu = 0;  
          $total_rp_r_keu_satu = 0;

          $tf_ttb_1 = 0; 
          $rf_ttb_1 = 0; 
       foreach ($asisten_1 as $satu) { 

        $total_data_skpd +=1;
        $total_data_skpd_satu +=1;





            // $show_tf = $satu->target_fisik;
            // $show_rf = $satu->realisasi_fisik == '' ? 0 : $satu->realisasi_fisik;

            if ($satu->pagu_total_tambahan>0) {
              $pagu_semua = $satu->pagu_total + $satu->pagu_total_tambahan;
              $rp_target_keuangan = $satu->rp_target_keuangan + $satu->rp_target_keuangan_tambahan;
              $persen_tk = ($rp_target_keuangan / $pagu_semua) * 100;

              $rp_realisasi_keuangan = $satu->rp_realisasi_keuangan + $satu->rp_realisasi_keuangan_tambahan;
              $persen_rk = ($rp_realisasi_keuangan / $pagu_semua) * 100;
              $show_tk = $persen_tk;
              $show_rk = $persen_rk;// $pagu_semua;//$satu->realisasi_keuangan == '' ? 0 :  $satu->realisasi_keuangan;

              $bobot_apbd =($satu->pagu_total / $pagu_semua) * 100;
              $bobot_tambahan =($satu->pagu_total_tambahan / $pagu_semua) * 100;
              $ttb_tf_apbd = $satu->target_fisik * $bobot_apbd /100;
              $ttb_tf_tambahan = $satu->target_fisik_tambahan * $bobot_tambahan /100;

              $ttb_rf_apbd = $satu->realisasi_fisik * $bobot_apbd /100;
              $ttb_rf_tambahan = $satu->realisasi_fisik_tambahan * $bobot_tambahan /100;

              $target_fisik = $ttb_tf_apbd + $ttb_tf_tambahan;
              $realisasi_fisik = $ttb_rf_apbd + $ttb_rf_tambahan;


            // $show_tf =$target_fisik ;//$satu->target_fisik;
            // $show_rf =$realisasi_fisik ;//$satu->realisasi_fisik == '' ? 0 : $satu->realisasi_fisik;
            $show_tf =$satu->target_fisik;
            $show_rf =$satu->realisasi_fisik == '' ? 0 : $satu->realisasi_fisik;
            }else{
              $pagu_semua = $satu->pagu_total;
              $rp_target_keuangan = $satu->rp_target_keuangan;
              $rp_realisasi_keuangan = $satu->rp_realisasi_keuangan;

              $show_tk = $satu->target_keuangan;
              $show_rk = $satu->realisasi_keuangan == '' ? 0 :  $satu->realisasi_keuangan;


            $show_tf = $satu->target_fisik;
            $show_rf = $satu->realisasi_fisik == '' ? 0 : $satu->realisasi_fisik;

            }







        $dev_fisik = round($satu->realisasi_fisik -$satu->target_fisik ,2);
          $dev_keu = number_format($show_rk,2) - number_format($show_tk,2);


            if ($dev_fisik < -10) {
              $warna_peringatan_dev_fisik = 'background: #f8b2b2'; 
              $total_peringatan_dev_fisik_merah += 1; 
              $total_peringatan_dev_fisik_merah_satu += 1; 
            }
            elseif ($dev_fisik <-5  && $dev_fisik >=-10) {
              $warna_peringatan_dev_fisik = 'background: #fcf3cf';
              $total_peringatan_dev_fisik_kuning += 1; 
              $total_peringatan_dev_fisik_kuning_satu += 1; 
            }
            elseif ($dev_fisik <=0  && $dev_fisik >=-10) {
              $warna_peringatan_dev_fisik = 'background:#d5f5e3';
              $total_peringatan_dev_fisik_hijau += 1; 
              $total_peringatan_dev_fisik_hijau_satu += 1; 
            }else{
              $warna_peringatan_dev_fisik = 'background:#ff7cfd';
              $total_peringatan_dev_fisik_ungu += 1; 
              $total_peringatan_dev_fisik_ungu_satu += 1; 
            }

            if ($dev_keu < -10) {
              $warna_peringatan_dev_keu = 'background: #f8b2b2'; 
              $total_peringatan_dev_keu_merah += 1; 
              $total_peringatan_dev_keu_merah_satu += 1; 
            }
            elseif ($dev_keu <-5  && $dev_keu >=-10) {
              $warna_peringatan_dev_keu = 'background: #fcf3cf';
              $total_peringatan_dev_keu_kuning += 1; 
              $total_peringatan_dev_keu_kuning_satu += 1; 
            }
            elseif ($dev_keu <=0  && $dev_keu >=-10) {
              $warna_peringatan_dev_keu = 'background:#d5f5e3';
              $total_peringatan_dev_keu_hijau += 1; 
              $total_peringatan_dev_keu_hijau_satu += 1; 
            }else{
              $warna_peringatan_dev_keu = 'background:#ff7cfd';
              $total_peringatan_dev_keu_ungu += 1; 
              $total_peringatan_dev_keu_ungu_satu += 1; 
            }


            $total_t_fisik_satu    += $satu->target_fisik;
            $total_r_fisik_satu    += $satu->realisasi_fisik;
            $total_t_keu_satu      += $show_tk;
            $total_r_keu_satu      += $show_rk;
            $jml_skpd_satu++;


            $total_pagu +=$pagu_semua;
            $total_rp_t_keu +=$rp_target_keuangan;
            $total_rp_r_keu +=$rp_realisasi_keuangan;

            $total_pagu_satu +=$satu->pagu_total;
            $total_rp_t_keu_satu +=$rp_target_keuangan;
            $total_rp_r_keu_satu +=$rp_realisasi_keuangan;



            $bobot_2 = ($pagu_semua / $pagu_asisten_2) * 100;
            $tf_tertimbang_2 = $satu->target_fisik * $bobot_2 / 100;
            $tf_ttb_2 += $tf_tertimbang_2;
            $rf_tertimbang_2 = $satu->realisasi_fisik * $bobot_2 / 100;
            $rf_ttb_2 += $rf_tertimbang_2;




        


            // $show_tf = $satu->target_fisik;
            // $show_rf = $satu->realisasi_fisik == '' ? 0 : $satu->realisasi_fisik;

            // $show_tf = $satu->target_fisik_tambahan;
            // $show_rf = $satu->realisasi_fisik_tambahan == '' ? 0 : $satu->realisasi_fisik_tambahan;




          
             if ($show_tf<$show_tk) {
              $blok_tf = 'style="background: #ebdef0 "';
            }else{
              $blok_tf = '';
            }
             if ($show_rf<$show_rk) {
              $blok_rf = 'style="background: #ebdef0 "';
            }else{
              $blok_rf = '';
            }
        ?>
         <tr >
          <td><?php echo $satu->nama_instansi ?></td>
          <td class="rata_tengah" <?php echo $blok_tf ?>><?php echo number_format($show_tf,2) ?></td>
          <td class="rata_tengah" <?php echo $blok_rf ?>><?php echo number_format($show_rf,2) ?></td>
          <td class="rata_tengah" style="<?php echo $warna_peringatan_dev_fisik ?>"><?php echo number_format($dev_fisik,2) ?></td>
          <td class="rata_tengah"><?php echo number_format($show_tk,2) ?></td>
          <td class="rata_tengah"><?php echo number_format($show_rk,2) ?></td>
          <td class="rata_tengah" style="<?php echo $warna_peringatan_dev_keu ?>"><?php echo number_format($dev_keu,2) ?></td>
        
        </tr>


       <?php } 

       foreach ($asisten_1_belum_terekap as $satu) { 

        $total_data_skpd +=1;
        $total_data_skpd_satu +=1;

        $total_peringatan_dev_fisik_hijau+=1;
        $total_peringatan_dev_keu_hijau+=1;
        $total_peringatan_dev_fisik_hijau_satu+=1;
        $total_peringatan_dev_keu_hijau_satu+=1;


              $warna_peringatan_dev_fisik = 'background: #d5f5e3';
              $warna_peringatan_dev_keu = 'background: #d5f5e3';
            $jml_skpd_satu++;
        




           
        ?>
         <tr style="background: #dbe7fc ">
          <td><?php echo $satu->nama_instansi ?></td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
        
        </tr>


       <?php } //akhir foreach  ($asisten_1_belum_terekap as $satu) {

          @$ratarata_t_fisik_satu    =round($total_t_fisik_satu / $jml_skpd_satu, 2); 
          @$ratarata_r_fisik_satu   = round($total_r_fisik_satu / $jml_skpd_satu, 2); // $rf_ttb_1
          @$total_dev_fisik_satu = $ratarata_r_fisik_satu - $ratarata_t_fisik_satu ;


          @$ratarata_t_keu_satu   = $total_pagu_satu == 0 ? 0 : round((($total_rp_t_keu_satu / $total_pagu_satu) * 100),2) ;// round($total_t_keu_satu / $jml_skpd_satu, 2); 
          @$ratarata_r_keu_satu   =  $total_pagu_satu == 0 ? 0 : round((($total_rp_r_keu_satu / $total_pagu_satu) * 100),2) ;//round($total_r_keu_satu / $jml_skpd_satu, 2);
          @$total_dev_keu_satu = $ratarata_r_keu_satu - $ratarata_t_keu_satu ;



            if ($total_dev_fisik_satu < -10) {
              $warna_peringatan_total_dev_fisik = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_fisik_satu <-5  && $total_dev_fisik_satu >-10) {
              $warna_peringatan_total_dev_fisik = 'background: #fcf3cf';
            }
            elseif ($total_dev_fisik_satu <=0  && $total_dev_fisik_satu >=-5) {
              $warna_peringatan_total_dev_fisik = 'background: #d5f5e3';
            }else{
              $warna_peringatan_total_dev_fisik = 'background: #ff7cfd';
            }

            if ($total_dev_keu_satu < -10) {
              $warna_peringatan_total_dev_keu = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_keu_satu <-5  && $total_dev_keu_satu >=-10) {
              $warna_peringatan_total_dev_keu = 'background: #fcf3cf';
            }
            elseif ($total_dev_keu_satu <=0  && $total_dev_keu_satu >=-5) {
              $warna_peringatan_total_dev_keu = 'background: #d5f5e3';
            }else{
              $warna_peringatan_total_dev_keu = 'background: #ff7cfd';
            }



            $show_total_tf = $ratarata_t_fisik_satu;
            $show_total_rf = $ratarata_r_fisik_satu;
            $show_total_tk = $ratarata_t_keu_satu;
            $show_total_rk = $ratarata_r_keu_satu;


            $pisah_decimal_show_total_tf = explode('.', $show_total_tf);
            $pisah_decimal_show_total_tk = explode('.', $show_total_tk);
            $pisah_decimal_show_total_rf = explode('.', $show_total_rf);
            $pisah_decimal_show_total_rk = explode('.', $show_total_rk);

            $pisah_decimal_total_dev_fisik = explode('.', $total_dev_fisik_satu);
            $pisah_decimal_total_dev_keu = explode('.', $total_dev_keu_satu);

            $digit_show_total_tf = count($pisah_decimal_show_total_tf);
            $digit_show_total_tk = count($pisah_decimal_show_total_tk);
            $digit_show_total_rf = count($pisah_decimal_show_total_rf);
            $digit_show_total_rk = count($pisah_decimal_show_total_rk);

            $digit_total_dev_fisik = count($pisah_decimal_total_dev_fisik);
            $digit_total_dev_keu = count($pisah_decimal_total_dev_keu);



            if ($digit_show_total_tf>1) {
              $didepan_koma_total_tf = $pisah_decimal_show_total_tf[0] ; 
              $dibelakang_koma_total_tf = strlen($pisah_decimal_show_total_tf[1]) >1 ? $pisah_decimal_show_total_tf[1] : $pisah_decimal_show_total_tf[1].'0';
              $hasil_total_tf = $didepan_koma_total_tf.'.'.$dibelakang_koma_total_tf;
            }else{
              $hasil_total_tf = $show_total_tf.'.00';
            }

            if ($digit_show_total_rf>1) {
              $didepan_koma_total_rf = $pisah_decimal_show_total_rf[0] ; 
              $dibelakang_koma_total_rf = strlen($pisah_decimal_show_total_rf[1]) >1 ? $pisah_decimal_show_total_rf[1] : $pisah_decimal_show_total_rf[1].'0';
              $hasil_total_rf = $didepan_koma_total_rf.'.'.$dibelakang_koma_total_rf;
            }else{
              $hasil_total_rf = $show_total_rf.'.00';
            }

            if ($digit_total_dev_fisik>1) {
              $didepan_koma_total_dev_fisik = $pisah_decimal_total_dev_fisik[0] ; 
              $dibelakang_koma_total_dev_fisik = strlen($pisah_decimal_total_dev_fisik[1]) >1 ? $pisah_decimal_total_dev_fisik[1] : $pisah_decimal_total_dev_fisik[1].'0';
              $hasil_total_dev_fisik = $didepan_koma_total_dev_fisik.'.'.$dibelakang_koma_total_dev_fisik;
            }else{
              $hasil_total_dev_fisik = $total_dev_fisik_satu.'.00';
            }


            if ($digit_show_total_tk>1) {
              $didepan_koma_total_tk = $pisah_decimal_show_total_tk[0] ; 
              $dibelakang_koma_total_tk = strlen($pisah_decimal_show_total_tk[1]) >1 ? $pisah_decimal_show_total_tk[1] : $pisah_decimal_show_total_tk[1].'0';
              $hasil_total_tk = $didepan_koma_total_tk.'.'.$dibelakang_koma_total_tk;
            }else{
              $hasil_total_tk = $show_total_tk.'.00';
            }

            if ($digit_show_total_rk>1) {
              $didepan_koma_total_rk = $pisah_decimal_show_total_rk[0] ; 
              $dibelakang_koma_total_rk = strlen($pisah_decimal_show_total_rk[1]) >1 ? $pisah_decimal_show_total_rk[1] : $pisah_decimal_show_total_rk[1].'0';
              $hasil_total_rk = $didepan_koma_total_rk.'.'.$dibelakang_koma_total_rk;
            }else{
              $hasil_total_rk = $show_total_rk.'.00';
            }

            if ($digit_total_dev_keu>1) {
              $didepan_koma_total_dev_keu = $pisah_decimal_total_dev_keu[0] ; 
              $dibelakang_koma_total_dev_keu = strlen($pisah_decimal_total_dev_keu[1]) >1 ? $pisah_decimal_total_dev_keu[1] : $pisah_decimal_total_dev_keu[1].'0';
              $hasil_total_dev_keu = $didepan_koma_total_dev_keu.'.'.$dibelakang_koma_total_dev_keu;
            }else{
              $hasil_total_dev_keu = $total_dev_keu_satu.'.00';
            }






          ?>
    </tbody>
    <tfoot>
      <?php if (count($asisten_1)==0) { ?>
      <tr>
        <td colspan="7"><b>Belum Ada Data</b></td>
       
      </tr>
      <?php }else{ ?>
      <tr>
        <td><b>Rata - rata</b></td>
        <th><?php echo round($hasil_total_tf,2); ?></th>
        <th><?php echo round($hasil_total_rf,2); ?></th>
        <th style="<?php echo $warna_peringatan_total_dev_fisik ?>"><?php echo round($hasil_total_dev_fisik,2) ?></th>
        <th><?php echo round($hasil_total_tk,2) ?></th>
        <th><?php echo round($hasil_total_rk,2) ?></th>
       <th style="<?php echo $warna_peringatan_total_dev_keu ?>"><?php echo round($hasil_total_dev_keu,2) ?></th>
      </tr>
    <?php } ?>
    </tfoot>
   
  </table>
</div>

<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten table"  style="background:#F0FDF4">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th rowspan="2">ASISTEN PEREKONOMIAN DAN PEMBANGUNAN</th>
        <th colspan="3">Fisik</th>
        <th colspan="3">Keuangan</th>
      </tr>
      <tr>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
      </tr>
    </thead>
    <tbody >
      <?php
          $tertimbang_dua       = 0;
          $total_t_fisik_dua    = 0;
          $total_t_keu_dua      = 0;
          $total_r_fisik_dua    = 0;
          $total_r_keu_dua      = 0;
          $total_tertimbang_dua = 0;
          $jml_skpd_dua         = 0;



          $total_pagu_dua =0;
          $total_rp_t_keu_dua = 0;  
          $total_rp_r_keu_dua = 0;

          $tf_ttb_2 = 0 ;
          $rf_ttb_2 = 0 ;
       foreach ($asisten_2 as $dua) { 

        $total_data_skpd +=1;
        $total_data_skpd_dua +=1;





            // $show_tf = $dua->target_fisik;
            // $show_rf = $dua->realisasi_fisik == '' ? 0 : $dua->realisasi_fisik;

            if ($dua->pagu_total_tambahan>0) {
              $pagu_semua = $dua->pagu_total + $dua->pagu_total_tambahan;
              $rp_target_keuangan = $dua->rp_target_keuangan + $dua->rp_target_keuangan_tambahan;
              $persen_tk = ($rp_target_keuangan / $pagu_semua) * 100;

              $rp_realisasi_keuangan = $dua->rp_realisasi_keuangan + $dua->rp_realisasi_keuangan_tambahan;
              $persen_rk = ($rp_realisasi_keuangan / $pagu_semua) * 100;
              $show_tk = $persen_tk;
              $show_rk = $persen_rk;// $pagu_semua;//$dua->realisasi_keuangan == '' ? 0 :  $satu->realisasi_keuangan;

              $bobot_apbd =($dua->pagu_total / $pagu_semua) * 100;
              $bobot_tambahan =($dua->pagu_total_tambahan / $pagu_semua) * 100;
              $ttb_tf_apbd = $dua->target_fisik * $bobot_apbd /100;
              $ttb_tf_tambahan = $dua->target_fisik_tambahan * $bobot_tambahan /100;

              $ttb_rf_apbd = $dua->realisasi_fisik * $bobot_apbd /100;
              $ttb_rf_tambahan = $dua->realisasi_fisik_tambahan * $bobot_tambahan /100;

              $target_fisik = $ttb_tf_apbd + $ttb_tf_tambahan;
              $realisasi_fisik = $ttb_rf_apbd + $ttb_rf_tambahan;


            // $show_tf =$target_fisik ;//$dua->target_fisik;
            // $show_rf =$realisasi_fisik ;//$dua->realisasi_fisik == '' ? 0 : $dua->realisasi_fisik;
            $show_tf =$dua->target_fisik;
            $show_rf =$dua->realisasi_fisik == '' ? 0 : $dua->realisasi_fisik;
            }else{
              $pagu_semua = $dua->pagu_total;
              $rp_target_keuangan = $dua->rp_target_keuangan;
              $rp_realisasi_keuangan = $dua->rp_realisasi_keuangan;

              $show_tk = $dua->target_keuangan;
              $show_rk = $dua->realisasi_keuangan == '' ? 0 :  $dua->realisasi_keuangan;


            $show_tf = $dua->target_fisik;
            $show_rf = $dua->realisasi_fisik == '' ? 0 : $dua->realisasi_fisik;

            }







        $dev_fisik = round($dua->realisasi_fisik -$dua->target_fisik ,2);
          $dev_keu = number_format($show_rk,2) - number_format($show_tk,2);


            if ($dev_fisik < -10) {
              $warna_peringatan_dev_fisik = 'background: #f8b2b2'; 
              $total_peringatan_dev_fisik_merah += 1; 
              $total_peringatan_dev_fisik_merah_dua += 1; 
            }
            elseif ($dev_fisik <-5  && $dev_fisik >=-10) {
              $warna_peringatan_dev_fisik = 'background: #fcf3cf';
              $total_peringatan_dev_fisik_kuning += 1; 
              $total_peringatan_dev_fisik_kuning_dua += 1; 
            }
            elseif ($dev_fisik <=0  && $dev_fisik >=-10) {
              $warna_peringatan_dev_fisik = 'background:#d5f5e3';
              $total_peringatan_dev_fisik_hijau += 1; 
              $total_peringatan_dev_fisik_hijau_dua += 1; 
            }else{
              $warna_peringatan_dev_fisik = 'background:#ff7cfd';
              $total_peringatan_dev_fisik_ungu += 1; 
              $total_peringatan_dev_fisik_ungu_dua += 1; 
            }

            if ($dev_keu < -10) {
              $warna_peringatan_dev_keu = 'background: #f8b2b2'; 
              $total_peringatan_dev_keu_merah += 1; 
              $total_peringatan_dev_keu_merah_dua += 1; 
            }
            elseif ($dev_keu <-5  && $dev_keu >=-10) {
              $warna_peringatan_dev_keu = 'background: #fcf3cf';
              $total_peringatan_dev_keu_kuning += 1; 
              $total_peringatan_dev_keu_kuning_dua += 1; 
            }
            elseif ($dev_keu <=0  && $dev_keu >=-10) {
              $warna_peringatan_dev_keu = 'background:#d5f5e3';
              $total_peringatan_dev_keu_hijau += 1; 
              $total_peringatan_dev_keu_hijau_dua += 1; 
            }else{
              $warna_peringatan_dev_keu = 'background:#ff7cfd';
              $total_peringatan_dev_keu_ungu += 1; 
              $total_peringatan_dev_keu_ungu_dua += 1; 
            }


            $total_t_fisik_dua    += $dua->target_fisik;
            $total_r_fisik_dua    += $dua->realisasi_fisik;
            $total_t_keu_dua      += $show_tk;
            $total_r_keu_dua      += $show_rk;
            $jml_skpd_dua++;


            $total_pagu +=$pagu_semua;
            $total_rp_t_keu +=$rp_target_keuangan;
            $total_rp_r_keu +=$rp_realisasi_keuangan;

            $total_pagu_dua +=$dua->pagu_total;
            $total_rp_t_keu_dua +=$rp_target_keuangan;
            $total_rp_r_keu_dua +=$rp_realisasi_keuangan;



            $bobot_2 = ($pagu_semua / $pagu_asisten_2) * 100;
            $tf_tertimbang_2 = $dua->target_fisik * $bobot_2 / 100;
            $tf_ttb_2 += $tf_tertimbang_2;
            $rf_tertimbang_2 = $dua->realisasi_fisik * $bobot_2 / 100;
            $rf_ttb_2 += $rf_tertimbang_2;




        


            // $show_tf = $dua->target_fisik;
            // $show_rf = $dua->realisasi_fisik == '' ? 0 : $dua->realisasi_fisik;

            // $show_tf = $dua->target_fisik_tambahan;
            // $show_rf = $dua->realisasi_fisik_tambahan == '' ? 0 : $dua->realisasi_fisik_tambahan;




          
             if ($show_tf<$show_tk) {
              $blok_tf = 'style="background: #ebdef0 "';
            }else{
              $blok_tf = '';
            }
             if ($show_rf<$show_rk) {
              $blok_rf = 'style="background: #ebdef0 "';
            }else{
              $blok_rf = '';
            }
        ?>
         <tr >
          <td><?php echo $dua->nama_instansi ?></td>
          <td class="rata_tengah" <?php echo $blok_tf ?>><?php echo number_format($show_tf,2) ?></td>
          <td class="rata_tengah" <?php echo $blok_rf ?>><?php echo number_format($show_rf,2) ?></td>
          <td class="rata_tengah" style="<?php echo $warna_peringatan_dev_fisik ?>"><?php echo number_format($dev_fisik,2) ?></td>
          <td class="rata_tengah"><?php echo number_format($show_tk,2) ?></td>
          <td class="rata_tengah"><?php echo number_format($show_rk,2) ?></td>
          <td class="rata_tengah" style="<?php echo $warna_peringatan_dev_keu ?>"><?php echo number_format($dev_keu,2) ?></td>
        
        </tr>


       <?php } //akhir foreach  ($asisten_2 as $dua) {



       foreach ($asisten_2_belum_terekap as $dua) { 

        $total_data_skpd +=1;
        $total_data_skpd_dua +=1;

        $total_peringatan_dev_fisik_hijau+=1;
        $total_peringatan_dev_keu_hijau+=1;

        $total_peringatan_dev_fisik_hijau_dua+=1;
        $total_peringatan_dev_keu_hijau_dua+=1;


              $warna_peringatan_dev_fisik = 'background: #d5f5e3';
              $warna_peringatan_dev_keu = 'background: #d5f5e3';
            $jml_skpd_dua++;
        




           
        ?>
          <tr style="background: #dbe7fc ">
          <td><?php echo $dua->nama_instansi ?></td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
        
        </tr>


       <?php } //akhir foreach  ($asisten_1_belum_terekap as $satu) {
          @$ratarata_t_fisik_dua    =  round($total_t_fisik_dua / $jml_skpd_dua, 2);  // $tf_ttb_2 ;//
          @$ratarata_r_fisik_dua   =  round($total_r_fisik_dua / $jml_skpd_dua, 2);  // $rf_ttb_2 ;//
          @$total_dev_fisik_dua = $ratarata_r_fisik_dua - $ratarata_t_fisik_dua ;
          @$ratarata_t_keu_dua   =  $total_pagu_dua == 0 ? 0 :round((($total_rp_t_keu_dua / $total_pagu_dua) * 100),2);//round($total_t_keu_dua / $jml_skpd_dua, 2); 
          @$ratarata_r_keu_dua   =  $total_pagu_dua == 0 ? 0 :round((($total_rp_r_keu_dua / $total_pagu_dua) * 100),2);// round($total_r_keu_dua / $jml_skpd_dua, 2);
          @$total_dev_keu_dua = $ratarata_r_keu_dua - $ratarata_t_keu_dua ;



            if ($total_dev_fisik_dua < -10) {
              $warna_peringatan_total_dev_fisik = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_fisik_dua <-5  && $total_dev_fisik_dua >=-10) {
              $warna_peringatan_total_dev_fisik = 'background: #fcf3cf';
            }
            elseif ($total_dev_fisik_dua <=0  && $total_dev_fisik_dua >=-5) {
              $warna_peringatan_total_dev_fisik = 'background: #d5f5e3';
            }else{
              $warna_peringatan_total_dev_fisik = 'background: #ff7cfd';
            }

            if ($total_dev_keu_dua < -10) {
              $warna_peringatan_total_dev_keu = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_keu_dua <-5  && $total_dev_keu_dua >=-10) {
              $warna_peringatan_total_dev_keu = 'background: #fcf3cf';
            }
            elseif ($total_dev_keu_dua <=0  && $total_dev_keu_dua >=-5) {
              $warna_peringatan_total_dev_keu = 'background: #d5f5e3';
            }else{
              $warna_peringatan_total_dev_keu = 'background: #ff7cfd';
            }



            $show_total_tf = $ratarata_t_fisik_dua;
            $show_total_rf = $ratarata_r_fisik_dua;
            $show_total_tk = $ratarata_t_keu_dua;
            $show_total_rk = $ratarata_r_keu_dua;


            $pisah_decimal_show_total_tf = explode('.', $show_total_tf);
            $pisah_decimal_show_total_tk = explode('.', $show_total_tk);
            $pisah_decimal_show_total_rf = explode('.', $show_total_rf);
            $pisah_decimal_show_total_rk = explode('.', $show_total_rk);

            $pisah_decimal_total_dev_fisik = explode('.', $total_dev_fisik_dua);
            $pisah_decimal_total_dev_keu = explode('.', $total_dev_keu_dua);

            $digit_show_total_tf = count($pisah_decimal_show_total_tf);
            $digit_show_total_tk = count($pisah_decimal_show_total_tk);
            $digit_show_total_rf = count($pisah_decimal_show_total_rf);
            $digit_show_total_rk = count($pisah_decimal_show_total_rk);

            $digit_total_dev_fisik = count($pisah_decimal_total_dev_fisik);
            $digit_total_dev_keu = count($pisah_decimal_total_dev_keu);



            if ($digit_show_total_tf>1) {
              $didepan_koma_total_tf = $pisah_decimal_show_total_tf[0] ; 
              $dibelakang_koma_total_tf = strlen($pisah_decimal_show_total_tf[1]) >1 ? $pisah_decimal_show_total_tf[1] : $pisah_decimal_show_total_tf[1].'0';
              $hasil_total_tf = $didepan_koma_total_tf.'.'.$dibelakang_koma_total_tf;
            }else{
              $hasil_total_tf = $show_total_tf.'.00';
            }

            if ($digit_show_total_rf>1) {
              $didepan_koma_total_rf = $pisah_decimal_show_total_rf[0] ; 
              $dibelakang_koma_total_rf = strlen($pisah_decimal_show_total_rf[1]) >1 ? $pisah_decimal_show_total_rf[1] : $pisah_decimal_show_total_rf[1].'0';
              $hasil_total_rf = $didepan_koma_total_rf.'.'.$dibelakang_koma_total_rf;
            }else{
              $hasil_total_rf = $show_total_rf.'.00';
            }

            if ($digit_total_dev_fisik>1) {
              $didepan_koma_total_dev_fisik = $pisah_decimal_total_dev_fisik[0] ; 
              $dibelakang_koma_total_dev_fisik = strlen($pisah_decimal_total_dev_fisik[1]) >1 ? $pisah_decimal_total_dev_fisik[1] : $pisah_decimal_total_dev_fisik[1].'0';
              $hasil_total_dev_fisik = $didepan_koma_total_dev_fisik.'.'.$dibelakang_koma_total_dev_fisik;
            }else{
              $hasil_total_dev_fisik = $total_dev_fisik_dua.'.00';
            }


            if ($digit_show_total_tk>1) {
              $didepan_koma_total_tk = $pisah_decimal_show_total_tk[0] ; 
              $dibelakang_koma_total_tk = strlen($pisah_decimal_show_total_tk[1]) >1 ? $pisah_decimal_show_total_tk[1] : $pisah_decimal_show_total_tk[1].'0';
              $hasil_total_tk = $didepan_koma_total_tk.'.'.$dibelakang_koma_total_tk;
            }else{
              $hasil_total_tk = $show_total_tk.'.00';
            }

            if ($digit_show_total_rk>1) {
              $didepan_koma_total_rk = $pisah_decimal_show_total_rk[0] ; 
              $dibelakang_koma_total_rk = strlen($pisah_decimal_show_total_rk[1]) >1 ? $pisah_decimal_show_total_rk[1] : $pisah_decimal_show_total_rk[1].'0';
              $hasil_total_rk = $didepan_koma_total_rk.'.'.$dibelakang_koma_total_rk;
            }else{
              $hasil_total_rk = $show_total_rk.'.00';
            }

            if ($digit_total_dev_keu>1) {
              $didepan_koma_total_dev_keu = $pisah_decimal_total_dev_keu[0] ; 
              $dibelakang_koma_total_dev_keu = strlen($pisah_decimal_total_dev_keu[1]) >1 ? $pisah_decimal_total_dev_keu[1] : $pisah_decimal_total_dev_keu[1].'0';
              $hasil_total_dev_keu = $didepan_koma_total_dev_keu.'.'.$dibelakang_koma_total_dev_keu;
            }else{
              $hasil_total_dev_keu = $total_dev_keu_dua.'.00';
            }





          ?>
    </tbody>
      <tfoot>
      <?php if (count($asisten_2)==0) { ?>
      <tr>
        <td colspan="7"><b>Belum Ada Data</b></td>
       
      </tr>
      <?php }else{ ?>
       <tr>
        <td><b>Rata - rata</b></td>
        <th><?php echo round($hasil_total_tf,2); ?></th>
        <th><?php echo round($hasil_total_rf,2); ?></th>
        <th style="<?php echo $warna_peringatan_total_dev_fisik ?>"><?php echo round($hasil_total_dev_fisik,2) ?></th>
        <th><?php echo round($hasil_total_tk,2) ?></th>
        <th><?php echo round($hasil_total_rk,2) ?></th>
       <th style="<?php echo $warna_peringatan_total_dev_keu ?>"><?php echo round($hasil_total_dev_keu,2) ?></th>
      </tr>
    <?php } ?>
    </tfoot>
   
    
   
  </table>
</div>

<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten table"  style="background:#CBFBF1">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th rowspan="2">ASISTEN ADMINISTRASI UMUM</th>
        <th colspan="3">Fisik</th>
        <th colspan="3">Keuangan</th>
      </tr>
      <tr>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
      </tr>
    </thead>
    <tbody >
      <?php
          $tertimbang_tiga       = 0;
          $total_t_fisik_tiga    = 0;
          $total_t_keu_tiga      = 0;
          $total_r_fisik_tiga    = 0;
          $total_r_keu_tiga      = 0;
          $total_tertimbang_tiga = 0;
          $jml_skpd_tiga         = 0;




          $total_pagu_tiga =0;
          $total_rp_t_keu_tiga = 0;  
          $total_rp_r_keu_tiga = 0;
          $tf_ttb_3 = 0 ;
          $rf_ttb_3 = 0 ;
       foreach ($asisten_3 as $tiga) { 

        $total_data_skpd +=1;
        $total_data_skpd_tiga +=1;





            // $show_tf = $tiga->target_fisik;
            // $show_rf = $tiga->realisasi_fisik == '' ? 0 : $tiga->realisasi_fisik;

            if ($tiga->pagu_total_tambahan>0) {
              $pagu_semua = $tiga->pagu_total + $tiga->pagu_total_tambahan;
              $rp_target_keuangan = $tiga->rp_target_keuangan + $tiga->rp_target_keuangan_tambahan;
              $persen_tk = ($rp_target_keuangan / $pagu_semua) * 100;

              $rp_realisasi_keuangan = $tiga->rp_realisasi_keuangan + $tiga->rp_realisasi_keuangan_tambahan;
              $persen_rk = ($rp_realisasi_keuangan / $pagu_semua) * 100;
              $show_tk = $persen_tk;
              $show_rk = $persen_rk;// $pagu_semua;//$tiga->realisasi_keuangan == '' ? 0 :  $tiga->realisasi_keuangan;

              $bobot_apbd =($tiga->pagu_total / $pagu_semua) * 100;
              $bobot_tambahan =($tiga->pagu_total_tambahan / $pagu_semua) * 100;
              $ttb_tf_apbd = $tiga->target_fisik * $bobot_apbd /100;
              $ttb_tf_tambahan = $tiga->target_fisik_tambahan * $bobot_tambahan /100;

              $ttb_rf_apbd = $tiga->realisasi_fisik * $bobot_apbd /100;
              $ttb_rf_tambahan = $tiga->realisasi_fisik_tambahan * $bobot_tambahan /100;

              $target_fisik = $ttb_tf_apbd + $ttb_tf_tambahan;
              $realisasi_fisik = $ttb_rf_apbd + $ttb_rf_tambahan;


            // $show_tf =$target_fisik ;//$tiga->target_fisik;
            // $show_rf =$realisasi_fisik ;//$tiga->realisasi_fisik == '' ? 0 : $tiga->realisasi_fisik;
            $show_tf =$tiga->target_fisik;
            $show_rf =$tiga->realisasi_fisik == '' ? 0 : $tiga->realisasi_fisik;
            }else{
              $pagu_semua = $tiga->pagu_total;
              $rp_target_keuangan = $tiga->rp_target_keuangan;
              $rp_realisasi_keuangan = $tiga->rp_realisasi_keuangan;

              $show_tk = $tiga->target_keuangan;
              $show_rk = $tiga->realisasi_keuangan == '' ? 0 :  $tiga->realisasi_keuangan;


            $show_tf = $tiga->target_fisik;
            $show_rf = $tiga->realisasi_fisik == '' ? 0 : $tiga->realisasi_fisik;

            }







        $dev_fisik = round($tiga->realisasi_fisik -$tiga->target_fisik ,2);
          $dev_keu = number_format($show_rk,2) - number_format($show_tk,2);


            if ($dev_fisik < -10) {
              $warna_peringatan_dev_fisik = 'background: #f8b2b2'; 
              $total_peringatan_dev_fisik_merah += 1; 
              $total_peringatan_dev_fisik_merah_tiga += 1; 
            }
            elseif ($dev_fisik <-5  && $dev_fisik >=-10) {
              $warna_peringatan_dev_fisik = 'background: #fcf3cf';
              $total_peringatan_dev_fisik_kuning += 1; 
              $total_peringatan_dev_fisik_kuning_tiga += 1; 
            }
            elseif ($dev_fisik <=0  && $dev_fisik >=-10) {
              $warna_peringatan_dev_fisik = 'background:#d5f5e3';
              $total_peringatan_dev_fisik_hijau += 1; 
              $total_peringatan_dev_fisik_hijau_tiga += 1; 
            }else{
              $warna_peringatan_dev_fisik = 'background:#ff7cfd';
              $total_peringatan_dev_fisik_ungu += 1; 
              $total_peringatan_dev_fisik_ungu_tiga += 1; 
            }

            if ($dev_keu < -10) {
              $warna_peringatan_dev_keu = 'background: #f8b2b2'; 
              $total_peringatan_dev_keu_merah += 1; 
              $total_peringatan_dev_keu_merah_tiga += 1; 
            }
            elseif ($dev_keu <-5  && $dev_keu >=-10) {
              $warna_peringatan_dev_keu = 'background: #fcf3cf';
              $total_peringatan_dev_keu_kuning += 1; 
              $total_peringatan_dev_keu_kuning_tiga += 1; 
            }
            elseif ($dev_keu <=0  && $dev_keu >=-10) {
              $warna_peringatan_dev_keu = 'background:#d5f5e3';
              $total_peringatan_dev_keu_hijau += 1; 
              $total_peringatan_dev_keu_hijau_tiga += 1; 
            }else{
              $warna_peringatan_dev_keu = 'background:#ff7cfd';
              $total_peringatan_dev_keu_ungu += 1; 
              $total_peringatan_dev_keu_ungu_tiga += 1; 
            }


            $total_t_fisik_tiga    += $tiga->target_fisik;
            $total_r_fisik_tiga    += $tiga->realisasi_fisik;
            $total_t_keu_tiga      += $show_tk;
            $total_r_keu_tiga      += $show_rk;
            $jml_skpd_tiga++;


            $total_pagu +=$pagu_semua;
            $total_rp_t_keu +=$rp_target_keuangan;
            $total_rp_r_keu +=$rp_realisasi_keuangan;

            $total_pagu_tiga +=$tiga->pagu_total;
            $total_rp_t_keu_tiga +=$rp_target_keuangan;
            $total_rp_r_keu_tiga +=$rp_realisasi_keuangan;



            $bobot_2 = ($pagu_semua / $pagu_asisten_2) * 100;
            $tf_tertimbang_2 = $tiga->target_fisik * $bobot_2 / 100;
            $tf_ttb_2 += $tf_tertimbang_2;
            $rf_tertimbang_2 = $tiga->realisasi_fisik * $bobot_2 / 100;
            $rf_ttb_2 += $rf_tertimbang_2;




        


            // $show_tf = $tiga->target_fisik;
            // $show_rf = $tiga->realisasi_fisik == '' ? 0 : $tiga->realisasi_fisik;

            // $show_tf = $tiga->target_fisik_tambahan;
            // $show_rf = $tiga->realisasi_fisik_tambahan == '' ? 0 : $tiga->realisasi_fisik_tambahan;




          
             if ($show_tf<$show_tk) {
              $blok_tf = 'style="background: #ebdef0 "';
            }else{
              $blok_tf = '';
            }
             if ($show_rf<$show_rk) {
              $blok_rf = 'style="background: #ebdef0 "';
            }else{
              $blok_rf = '';
            }
        ?>
         <tr >
          <td><?php echo $tiga->nama_instansi ?></td>
          <td class="rata_tengah" <?php echo $blok_tf ?>><?php echo number_format($show_tf,2) ?></td>
          <td class="rata_tengah" <?php echo $blok_rf ?>><?php echo number_format($show_rf,2) ?></td>
          <td class="rata_tengah" style="<?php echo $warna_peringatan_dev_fisik ?>"><?php echo number_format($dev_fisik,2) ?></td>
          <td class="rata_tengah"><?php echo number_format($show_tk,2) ?></td>
          <td class="rata_tengah"><?php echo number_format($show_rk,2) ?></td>
          <td class="rata_tengah" style="<?php echo $warna_peringatan_dev_keu ?>"><?php echo number_format($dev_keu,2) ?></td>
        
        </tr>


       <?php }



       foreach ($asisten_3_belum_terekap as $tiga) { 

        $total_data_skpd +=1;
        $total_data_skpd_tiga +=1;

        $total_peringatan_dev_fisik_hijau+=1;
        $total_peringatan_dev_keu_hijau+=1;

        $total_peringatan_dev_fisik_hijau_tiga+=1;
        $total_peringatan_dev_keu_hijau_tiga+=1;


              $warna_peringatan_dev_fisik = 'background: #d5f5e3';
              $warna_peringatan_dev_keu = 'background: #d5f5e3';
            $jml_skpd_tiga++;
        




           
        ?>
          <tr style="background: #dbe7fc ">
          <td><?php echo $tiga->nama_instansi ?></td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
          <td class="rata_tengah">0.00</td>
        
        </tr>


       <?php } 

          @$ratarata_t_fisik_tiga    = round($total_t_fisik_tiga / $jml_skpd_tiga, 2);  // $tf_ttb_3 ;//
          @$ratarata_r_fisik_tiga   = round($total_r_fisik_tiga / $jml_skpd_tiga, 2);  // $rf_ttb_3 ;//
          @$total_dev_fisik_tiga = $ratarata_r_fisik_tiga - $ratarata_t_fisik_tiga ;
          @$ratarata_t_keu_tiga   = $total_pagu_tiga == 0 ? 0 : round(($total_rp_t_keu_tiga / $total_pagu_tiga * 100),2);
 ;//round($total_t_keu_tiga / $jml_skpd_tiga, 2); 
          @$ratarata_r_keu_tiga   =  $total_pagu_tiga == 0 ? 0 : round(($total_rp_r_keu_tiga / $total_pagu_tiga * 100),2);//round($total_r_keu_tiga / $jml_skpd_tiga, 2);
          @$total_dev_keu_tiga = $ratarata_r_keu_tiga - $ratarata_t_keu_tiga ;



            if ($total_dev_fisik_tiga < -10) {
              $warna_peringatan_total_dev_fisik = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_fisik_tiga <-5  && $total_dev_fisik_tiga >=-10) {
              $warna_peringatan_total_dev_fisik = 'background: #fcf3cf';
            }
            elseif ($total_dev_fisik_tiga <=0  && $total_dev_fisik_tiga >=-5) {
              $warna_peringatan_total_dev_fisik = 'background: #d5f5e3';
            }else{
              $warna_peringatan_total_dev_fisik = 'background: #ff7cfd';
            }

            if ($total_dev_keu_tiga < -10) {
              $warna_peringatan_total_dev_keu = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_keu_tiga <-5  && $total_dev_keu_tiga >=-10) {
              $warna_peringatan_total_dev_keu = 'background: #fcf3cf';
            }
            elseif ($total_dev_keu_tiga <=0  && $total_dev_keu_tiga >=-5) {
              $warna_peringatan_total_dev_keu = 'background: #d5f5e3';
            }else{
              $warna_peringatan_total_dev_keu = 'background: #ff7cfd';
            }



            $show_total_tf = $ratarata_t_fisik_tiga;
            $show_total_rf = $ratarata_r_fisik_tiga;
            $show_total_tk = $ratarata_t_keu_tiga;
            $show_total_rk = $ratarata_r_keu_tiga;


            $pisah_decimal_show_total_tf = explode('.', $show_total_tf);
            $pisah_decimal_show_total_tk = explode('.', $show_total_tk);
            $pisah_decimal_show_total_rf = explode('.', $show_total_rf);
            $pisah_decimal_show_total_rk = explode('.', $show_total_rk);

            $pisah_decimal_total_dev_fisik = explode('.', $total_dev_fisik_tiga);
            $pisah_decimal_total_dev_keu = explode('.', $total_dev_keu_tiga);

            $digit_show_total_tf = count($pisah_decimal_show_total_tf);
            $digit_show_total_tk = count($pisah_decimal_show_total_tk);
            $digit_show_total_rf = count($pisah_decimal_show_total_rf);
            $digit_show_total_rk = count($pisah_decimal_show_total_rk);

            $digit_total_dev_fisik = count($pisah_decimal_total_dev_fisik);
            $digit_total_dev_keu = count($pisah_decimal_total_dev_keu);



            if ($digit_show_total_tf>1) {
              $didepan_koma_total_tf = $pisah_decimal_show_total_tf[0] ; 
              $dibelakang_koma_total_tf = strlen($pisah_decimal_show_total_tf[1]) >1 ? $pisah_decimal_show_total_tf[1] : $pisah_decimal_show_total_tf[1].'0';
              $hasil_total_tf = $didepan_koma_total_tf.'.'.$dibelakang_koma_total_tf;
            }else{
              $hasil_total_tf = $show_total_tf.'.00';
            }

            if ($digit_show_total_rf>1) {
              $didepan_koma_total_rf = $pisah_decimal_show_total_rf[0] ; 
              $dibelakang_koma_total_rf = strlen($pisah_decimal_show_total_rf[1]) >1 ? $pisah_decimal_show_total_rf[1] : $pisah_decimal_show_total_rf[1].'0';
              $hasil_total_rf = $didepan_koma_total_rf.'.'.$dibelakang_koma_total_rf;
            }else{
              $hasil_total_rf = $show_total_rf.'.00';
            }

            if ($digit_total_dev_fisik>1) {
              $didepan_koma_total_dev_fisik = $pisah_decimal_total_dev_fisik[0] ; 
              $dibelakang_koma_total_dev_fisik = strlen($pisah_decimal_total_dev_fisik[1]) >1 ? $pisah_decimal_total_dev_fisik[1] : $pisah_decimal_total_dev_fisik[1].'0';
              $hasil_total_dev_fisik = $didepan_koma_total_dev_fisik.'.'.$dibelakang_koma_total_dev_fisik;
            }else{
              $hasil_total_dev_fisik = $total_dev_fisik_tiga.'.00';
            }


            if ($digit_show_total_tk>1) {
              $didepan_koma_total_tk = $pisah_decimal_show_total_tk[0] ; 
              $dibelakang_koma_total_tk = strlen($pisah_decimal_show_total_tk[1]) >1 ? $pisah_decimal_show_total_tk[1] : $pisah_decimal_show_total_tk[1].'0';
              $hasil_total_tk = $didepan_koma_total_tk.'.'.$dibelakang_koma_total_tk;
            }else{
              $hasil_total_tk = $show_total_tk.'.00';
            }

            if ($digit_show_total_rk>1) {
              $didepan_koma_total_rk = $pisah_decimal_show_total_rk[0] ; 
              $dibelakang_koma_total_rk = strlen($pisah_decimal_show_total_rk[1]) >1 ? $pisah_decimal_show_total_rk[1] : $pisah_decimal_show_total_rk[1].'0';
              $hasil_total_rk = $didepan_koma_total_rk.'.'.$dibelakang_koma_total_rk;
            }else{
              $hasil_total_rk = $show_total_rk.'.00';
            }

            if ($digit_total_dev_keu>1) {
              $didepan_koma_total_dev_keu = $pisah_decimal_total_dev_keu[0] ; 
              $dibelakang_koma_total_dev_keu = strlen($pisah_decimal_total_dev_keu[1]) >1 ? $pisah_decimal_total_dev_keu[1] : $pisah_decimal_total_dev_keu[1].'0';
              $hasil_total_dev_keu = $didepan_koma_total_dev_keu.'.'.$dibelakang_koma_total_dev_keu;
            }else{
              $hasil_total_dev_keu = $total_dev_keu_tiga.'.00';
            }





          ?>
    </tbody>
      <tfoot>
      <?php if (count($asisten_3)==0) { ?>
      <tr>
        <td colspan="7"><b>Belum Ada Data</b></td>
       
      </tr>
      <?php }else{ ?>
        <tr>
        <td><b>Rata - rata</b></td>
        <th><?php echo round($hasil_total_tf,2); ?></th>
        <th><?php echo round($hasil_total_rf,2); ?></th>
        <th style="<?php echo $warna_peringatan_total_dev_fisik ?>"><?php echo round($hasil_total_dev_fisik,2) ?></th>
        <th><?php echo round($hasil_total_tk,2) ?></th>
        <th><?php echo round($hasil_total_rk,2) ?></th>
       <th style="<?php echo $warna_peringatan_total_dev_keu ?>"><?php echo round($hasil_total_dev_keu,2) ?></th>
      </tr>
    <?php } ?>
    </tfoot>
   
  
  </table>


  <br>
  <table  class="font_laporan laporan_asisten table"  style="background:#ECFCCA">
    <?php 




            if ($inspektorat['pagu_total_tambahan']>0) {
               $pagu_inspektorat = $inspektorat['pagu_total'] + $inspektorat['pagu_total_tambahan'];
              $rp_target_keuangan = $inspektorat['rp_target_keuangan'] + $inspektorat['rp_target_keuangan_tambahan'];
              $persen_tk = ($rp_target_keuangan / $pagu_semua) * 100;

              $rp_realisasi_keuangan = $inspektorat['rp_realisasi_keuangan'] + $inspektorat['rp_realisasi_keuangan_tambahan'];
              $persen_rk = ($rp_realisasi_keuangan / $pagu_semua) * 100;
              $show_tk = $persen_tk;
              $show_rk = $persen_rk;// $pagu_semua;//$tiga->realisasi_keuangan == '' ? 0 :  $tiga->realisasi_keuangan;

              $bobot_apbd =($inspektorat['pagu_total'] / $pagu_semua) * 100;
              $bobot_tambahan =($inspektorat['pagu_total_tambahan'] / $pagu_semua) * 100;
              $ttb_tf_apbd = $inspektorat['target_fisik'] * $bobot_apbd /100;
              $ttb_tf_tambahan = $inspektorat['target_fisik_tambahan'] * $bobot_tambahan /100;

              $ttb_rf_apbd = $inspektorat['realisasi_fisik'] * $bobot_apbd /100;
              $ttb_rf_tambahan = $inspektorat['realisasi_fisik_tambahan'] * $bobot_tambahan /100;

              $target_fisik = $ttb_tf_apbd + $ttb_tf_tambahan;
              $realisasi_fisik = $ttb_rf_apbd + $ttb_rf_tambahan;


            // $show_tf =$target_fisik ;//$tiga->target_fisik;
            // $show_rf =$realisasi_fisik ;//$tiga->realisasi_fisik == '' ? 0 : $tiga->realisasi_fisik;
            $show_tf =$inspektorat['target_fisik'];
            $show_rf =$inspektorat['realisasi_fisik'] == '' ? 0 : $inspektorat['realisasi_fisik'];
            }else{
               $pagu_inspektorat = $inspektorat['pagu_total']; 
              $rp_target_keuangan = $inspektorat['rp_target_keuangan'];
              $rp_realisasi_keuangan = $inspektorat['rp_realisasi_keuangan'];

              $show_tk = $inspektorat['target_keuangan'];
              $show_rk = $inspektorat['realisasi_keuangan'] == '' ? 0 :  $inspektorat['realisasi_keuangan'];


            $show_tf = $inspektorat['target_fisik'];
            $show_rf = $inspektorat['realisasi_fisik'] == '' ? 0 : $inspektorat['realisasi_fisik'];

            }






 $dev_f_inspektorat = $show_rf - $show_tf;
           $dev_k_inspektorat = $show_rk - $show_tk;
        $total_pagu +=$pagu_inspektorat;
        $total_rp_t_keu += $rp_target_keuangan;
        $total_rp_r_keu += $rp_realisasi_keuangan;

            if ($dev_f_inspektorat < -10) {
              $warna_peringatan_total_dev_fisik_inspektorat = 'background: #f8b2b2'; 
            }
            elseif ($dev_f_inspektorat <-5  && $dev_f_inspektorat >=-10) {
              $warna_peringatan_total_dev_fisik_inspektorat = 'background: #fcf3cf';
            }
            elseif ($dev_f_inspektorat <=0  && $dev_f_inspektorat >=-5) {
              $warna_peringatan_total_dev_fisik_inspektorat = 'background: #d5f5e3';
            }else{
              $warna_peringatan_total_dev_fisik_inspektorat = 'background: #ff7cfd';
            }

            if ($dev_k_inspektorat < -10) {
              $warna_peringatan_total_dev_keu_inspektorat = 'background: #f8b2b2'; 
            }
            elseif ($dev_k_inspektorat <-5  && $dev_k_inspektorat >=-10) {
              $warna_peringatan_total_dev_keu_inspektorat = 'background: #fcf3cf';
            }
            elseif ($dev_k_inspektorat <=0  && $dev_k_inspektorat >=-5) {
              $warna_peringatan_total_dev_keu_inspektorat = 'background: #d5f5e3';
            }else{
              $warna_peringatan_total_dev_keu_inspektorat = 'background: #ff7cfd';
            } ?>




    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th rowspan="3"><?php echo $inspektorat['nama_instansi'] ?></th>
        <th colspan="3">Fisik</th>
        <th colspan="3">Keuangan</th>
      </tr>
      <tr>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
      </tr>
      <tr>
        <th><?php echo $inspektorat['target_fisik'] ?></th>
        <th><?php echo $inspektorat['realisasi_fisik'] ?></th>
        <th  style="<?php echo $warna_peringatan_total_dev_fisik_inspektorat ?>"> 
          <?php 
          
           echo $dev_f_inspektorat;
           ?> 
         </th>
        <th><?php echo $inspektorat['target_keuangan'] ?></th>
        <th><?php echo $inspektorat['realisasi_keuangan'] ?></th>
        <th   style="<?php echo $warna_peringatan_total_dev_keu_inspektorat ?>"> <?php echo $dev_k_inspektorat ?> </th>
      </tr>
    </thead>

  </table>
</div>

<div style="clear:both"></div>
<hr>


<div style="width:55%; float: left">
<span class="font_laporan">
  <b>
    <u>Statistika Data Deviasi SKPD :</u>
  </b>
</span>
<br><br>
<table class="font_laporan table" style="border-collapse: collapse; width:100%;">
 <thead>
    
    <tr>
      <th rowspan="2">Keterangan</th>
      <th colspan="2">ASISTEN PEMERINTAHAN DAN KESRA</th>
      <th colspan="2">ASISTEN PEREKONOMIAN DAN PEMBANGUNAN</th>
      <th colspan="2">ASISTEN ADMINISTRASI UMUM</th>
      <th colspan="2">Total</th>
    </tr>
    <tr>
      <th style="width:55px">Fisik</th>
      <th style="width:55px">Keuangan</th>
      <th style="width:55px">Fisik</th>
      <th style="width:55px">Keuangan</th>
      <th style="width:55px">Fisik</th>
      <th style="width:55px">Keuangan</th>
      <th style="width:55px">Fisik</th>
      <th style="width:55px">Keuangan</th>
    </tr>
    <tr style="background: #f8b2b2;">
      <td>Deviasi Diatas -10%</td>
      <td align="center"><?= $total_peringatan_dev_fisik_merah_satu; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_merah_satu; ?></td>
      <td align="center"><?= $total_peringatan_dev_fisik_merah_dua; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_merah_dua; ?></td>

      <td align="center"><?= $total_peringatan_dev_fisik_merah_tiga; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_merah_tiga; ?></td>
      <td align="center"><?= $total_peringatan_dev_fisik_merah?></td>
      <td align="center"><?= $total_peringatan_dev_keu_merah?></td>
    </tr>
    <tr style="background: #fcf3cf;">
      <td>Deviasi Antara 5% sampai 10%</td>
      <td align="center"><?= $total_peringatan_dev_fisik_kuning_satu; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_kuning_satu; ?></td>
      <td align="center"><?= $total_peringatan_dev_fisik_kuning_dua; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_kuning_dua; ?></td>

      <td align="center"><?= $total_peringatan_dev_fisik_kuning_tiga; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_kuning_tiga; ?></td>
      <td align="center"><?= $total_peringatan_dev_fisik_kuning?></td>
      <td align="center"><?= $total_peringatan_dev_keu_kuning?></td>
    </tr>
    <tr style="background: #d5f5e3;">
      <td>Deviasi Dibawah -5%</td>
      <td align="center"><?= $total_peringatan_dev_fisik_hijau_satu; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_hijau_satu; ?></td>
      <td align="center"><?= $total_peringatan_dev_fisik_hijau_dua; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_hijau_dua; ?></td>

      <td align="center"><?= $total_peringatan_dev_fisik_hijau_tiga; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_hijau_tiga; ?></td>
      <td align="center"><?= $total_peringatan_dev_fisik_hijau?></td>
      <td align="center"><?= $total_peringatan_dev_keu_hijau?></td>
    </tr>
    <tr style="background:#ff7cfd;">
      <td>Melebihi Target</td>
      <td align="center"><?= $total_peringatan_dev_fisik_ungu_satu; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_ungu_satu; ?></td>
      <td align="center"><?= $total_peringatan_dev_fisik_ungu_dua; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_ungu_dua; ?></td>

      <td align="center"><?= $total_peringatan_dev_fisik_ungu_tiga; ?></td>
      <td align="center"><?= $total_peringatan_dev_keu_ungu_tiga; ?></td>
      <td align="center"><?= $total_peringatan_dev_fisik_ungu?></td>
      <td align="center"><?= $total_peringatan_dev_keu_ungu?></td>
    </tr>
     <tr>
      <th align="left">Total Data</th>
      
      <th colspan="2"><?= $total_data_skpd_satu; ?></th>
      <th colspan="2"><?= $total_data_skpd_dua; ?></th>
      <th colspan="2"><?= $total_data_skpd_tiga; ?></th>
      <th colspan="2"><?= $total_data_skpd; ?></th>
    </tr>
 </thead>
  
</table>
</div>
<div style="width:22%; float:left; margin-left:50px">

    <span class="font_laporan">
      <b>
        <u>Pencapaiai / Rata Rata <?php echo $identitas['caption_ratarata_rekap_asisten'] ?> :</u>
      </b>
    </span>
    <br><br>
	<table class="font_laporan laporan_asisten table">
    <tr>
     
      <th colspan="3">Fisik</th>
      <th colspan="3">Keuangan</th>
    </tr>
    <tr>
      <th style="width:33px">T</th>
      <th style="width:33px">R</th>
      <th style="width:33px">D</th>
      <th style="width:33px">T</th>
      <th style="width:33px">R</th>
      <th style="width:33px">D</th>
    </tr>
    <tr>
  <?php 
    $semua_skpd = $jml_skpd_satu + $jml_skpd_dua + $jml_skpd_tiga +1 ;
    $semua_total_t_fisik = ($total_t_fisik_satu +$total_t_fisik_dua +$total_t_fisik_tiga + $inspektorat['target_fisik']) / $semua_skpd;
    $semua_total_r_fisik = ($total_r_fisik_satu +$total_r_fisik_dua +$total_r_fisik_tiga + $inspektorat['realisasi_fisik'])  / $semua_skpd ;
    $semua_total_dev_fisik = $semua_total_r_fisik - $semua_total_t_fisik  ;
    $semua_total_t_keu = $total_pagu == 0 ? 0 : ($total_rp_t_keu / $total_pagu) * 100 ;//($total_t_keu_satu +$total_t_keu_dua +$total_t_keu_tiga) / $semua_skpd;
    $semua_total_r_keu = $total_pagu == 0 ? 0 : ($total_rp_r_keu / $total_pagu) * 100 ;;//($total_r_keu_satu +$total_r_keu_dua +$total_r_keu_tiga) / $semua_skpd;
    $semua_total_dev_keu = $semua_total_r_keu - $semua_total_t_keu ;


    $show_total_tf = round($semua_total_t_fisik,2);
    $show_total_rf = round($semua_total_r_fisik,2);
    $show_total_tk = round($semua_total_t_keu,2);
    $show_total_rk = round($semua_total_r_keu,2);
    $show_semua_total_dev_fisik = $show_total_rf - $show_total_tf;
    $show_semua_total_dev_keu =  $show_total_rk - $show_total_tk;


    $pisah_decimal_show_total_tf = explode('.', $show_total_tf);
    $pisah_decimal_show_total_tk = explode('.', $show_total_tk);
    $pisah_decimal_show_total_rf = explode('.', $show_total_rf);
    $pisah_decimal_show_total_rk = explode('.', $show_total_rk);

    $pisah_decimal_total_dev_fisik = explode('.', $show_semua_total_dev_fisik);
    $pisah_decimal_total_dev_keu = explode('.', $show_semua_total_dev_keu);

    $digit_show_total_tf = count($pisah_decimal_show_total_tf);
    $digit_show_total_tk = count($pisah_decimal_show_total_tk);
    $digit_show_total_rf = count($pisah_decimal_show_total_rf);
    $digit_show_total_rk = count($pisah_decimal_show_total_rk);

    $digit_total_dev_fisik = count($pisah_decimal_total_dev_fisik);
    $digit_total_dev_keu = count($pisah_decimal_total_dev_keu);



            if ($digit_show_total_tf>1) {
              $didepan_koma_total_tf = $pisah_decimal_show_total_tf[0] ; 
              $dibelakang_koma_total_tf = strlen($pisah_decimal_show_total_tf[1]) >1 ? $pisah_decimal_show_total_tf[1] : $pisah_decimal_show_total_tf[1].'0';
              $hasil_total_tf = $didepan_koma_total_tf.'.'.$dibelakang_koma_total_tf;
            }else{
              $hasil_total_tf = $show_total_tf.'.00';
            }

            if ($digit_show_total_rf>1) {
              $didepan_koma_total_rf = $pisah_decimal_show_total_rf[0] ; 
              $dibelakang_koma_total_rf = strlen($pisah_decimal_show_total_rf[1]) >1 ? $pisah_decimal_show_total_rf[1] : $pisah_decimal_show_total_rf[1].'0';
              $hasil_total_rf = $didepan_koma_total_rf.'.'.$dibelakang_koma_total_rf;
            }else{
              $hasil_total_rf = $show_total_rf.'.00';
            }

            if ($digit_total_dev_fisik>1) {
              $didepan_koma_total_dev_fisik = $pisah_decimal_total_dev_fisik[0] ; 
              $dibelakang_koma_total_dev_fisik = strlen($pisah_decimal_total_dev_fisik[1]) >1 ? $pisah_decimal_total_dev_fisik[1] : $pisah_decimal_total_dev_fisik[1].'0';
              $hasil_total_dev_fisik = $didepan_koma_total_dev_fisik.'.'.$dibelakang_koma_total_dev_fisik;
            }else{
              $hasil_total_dev_fisik = $show_semua_total_dev_fisik.'.00';
            }


            if ($digit_show_total_tk>1) {
              $didepan_koma_total_tk = $pisah_decimal_show_total_tk[0] ; 
              $dibelakang_koma_total_tk = strlen($pisah_decimal_show_total_tk[1]) >1 ? $pisah_decimal_show_total_tk[1] : $pisah_decimal_show_total_tk[1].'0';
              $hasil_total_tk = $didepan_koma_total_tk.'.'.$dibelakang_koma_total_tk;
            }else{
              $hasil_total_tk = $show_total_tk.'.00';
            }

            if ($digit_show_total_rk>1) {
              $didepan_koma_total_rk = $pisah_decimal_show_total_rk[0] ; 
              $dibelakang_koma_total_rk = strlen($pisah_decimal_show_total_rk[1]) >1 ? $pisah_decimal_show_total_rk[1] : $pisah_decimal_show_total_rk[1].'0';
              $hasil_total_rk = $didepan_koma_total_rk.'.'.$dibelakang_koma_total_rk;
            }else{
              $hasil_total_rk = $show_total_rk.'.00';
            }

            if ($digit_total_dev_keu>1) {
              $didepan_koma_total_dev_keu = $pisah_decimal_total_dev_keu[0] ; 
              $dibelakang_koma_total_dev_keu = strlen($pisah_decimal_total_dev_keu[1]) >1 ? $pisah_decimal_total_dev_keu[1] : $pisah_decimal_total_dev_keu[1].'0';
              $hasil_total_dev_keu =  $didepan_koma_total_dev_keu.'.'.$dibelakang_koma_total_dev_keu;
            }else{
              $hasil_total_dev_keu = $show_semua_total_dev_keu.'.00';
            }



   ?>
        <td align="center"><?php echo $hasil_total_tf; ?></td>
        <td align="center"><?php echo $hasil_total_rf; ?></td>
        <td align="center"><?php echo $hasil_total_dev_fisik ?></td>
        <td align="center"><?php echo $hasil_total_tk ?></td>
        <td align="center"><?php echo $hasil_total_rk ?></td>
       <td align="center"><?php echo $hasil_total_dev_keu ?></td>
    </tr>
  </table>
</div>

<div style="width:15%; float:right; margin-left:50px;">

  <span class="font_laporan">
      <b>
        <u>Keterangan :</u>
      </b>
    </span>
    <br>
    <br>
  <table class="laporan_asisten font_laporan">
    <tr>
      <td>T</td>
      <td>:</td>
      <td>Target</td>
    </tr>
    <tr>
      <td>R</td>
      <td>:</td>
      <td>Realisasi</td>
    </tr>
    <tr>
      <td>D</td>
      <td>:</td>
      <td>Deviasi</td>
    </tr>
    <tr>
      <td><span style="background:#f8b2b2; color:#f8b2b2;">----</span></td>
      <td>:</td>
      <td>Deviasi diatas -10% </td>
    </tr>
    <tr>
      <td><span style="background:#fcf3cf; color:#fcf3cf;">----</span></td>
      <td>:</td>
      <td>Deviasi antara -5% sampai -10% </td>
    </tr>
    <tr>
      <td><span style="background:#d5f5e3; color:#d5f5e3;">----</span></td>
      <td>:</td>
      <td>Deviasi dibawah -5% </td>
    </tr>
    <tr>
      <td><span style="background:#ff7cfd; color:#ff7cfd;">----</span></td>
      <td>:</td>
      <td>Melebihi Target</td>
    </tr>
  <!--   <tr>
      <td>Pagu</td>
      <td>:</td>
      <td><?php echo $total_pagu ?></td>
    </tr>
    <tr>
      <td>Target</td>
      <td>:</td>
      <td><?php echo $total_rp_t_keu ?></td>
    </tr>
    <tr>
      <td>Realisasi</td>
      <td>:</td>
      <td><?php echo $total_rp_r_keu ?></td>
    </tr> -->
  </table>
   <div class="font_laporan">
    
 
        </div> 
  </div>
<div style="clear:both"></div>