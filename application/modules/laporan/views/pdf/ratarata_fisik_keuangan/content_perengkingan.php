  <style>
    .font_laporan{
      font-size:9px;
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
  </style>

  <?php 
    // $total_peringatan_dev_fisik_merah = 0;
    //  $total_peringatan_dev_fisik_kuning = 0;
    //  $total_peringatan_dev_fisik_hijau = 0;
    //  $total_peringatan_dev_keu_merah = 0;
    //  $total_peringatan_dev_keu_kuning = 0;
    //  $total_peringatan_dev_keu_hijau = 0;

   $bg_rea_fisik =  '';//$realisasi=='fisik' ? 'background: #e5e8e8 ' :'';
          $bg_rea_keuangan = '';// $realisasi=='keu' ? 'background: #e5e8e8 ' :'';

      ?>



    <table class="font_laporan table">
       <thead class="header">
          <tr>

          <?php if ($realisasi=='tidak_ada') { ?>
          <th rowspan="4"  width="20px">No</th>
          <th rowspan="4">SKPD</th>
          <th rowspan="4" style="width:100px"> Pagu</th>
          <th colspan="5"> Fisik</th>
          <th colspan="7"> Keuangan</th>
          <th  rowspan="4">Last Update</th>
        <?php }
        elseif ($realisasi=='fisik_tertinggi' || $realisasi=='fisik_terendah' || $realisasi=='dev_fisik_tertinggi' || $realisasi=='dev_fisik_terendah') { ?>
          <th rowspan="3"  width="20px">No</th>
          <th rowspan="3">SKPD</th>
          <th rowspan="3" style="width:100px"> Pagu</th>
          <th colspan="5"> Fisik</th>
          <th  rowspan="3">Last Update</th>
        <?php }else{ ?>
          <th rowspan="4"  width="20px">No</th>
          <th rowspan="4">SKPD</th>
          <th rowspan="4">Pagu</th>
          <th colspan="7">Keuangan</th>
          <th  rowspan="4">Last Update</th>

        <?php } ?>  

         
        </tr>



        <?php if ($realisasi=='tidak_ada') { ?>
        <tr>  
          <th rowspan="2">Target</th>
          <th rowspan="2">Realisasi</th>
          <th colspan="2" rowspan="2">Capaian</th>
          <th rowspan="3">Deviasi</th>
          <th colspan="2">Target</th>
          <th colspan="4">Realisasi</th>
          <th rowspan="3">Deviasi</th>
        </tr>
        <tr>
         
          <th rowspan="2">Rp</th>
          <th rowspan="2">%</th>
          <th rowspan="2">Rp</th>
          <th rowspan="2">%</th>
          <th colspan="2">Capaian</th>
        </tr>
        <tr>
          <th>%</th>
          <th>%</th>
          <th >%</th>
          <th >Ket</th>
          <th >%</th>
          <th >Ket</th>
        </tr>
        <tr>
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
          <th>6</th>
          <th>7</th>
          <th>8=5-4</th>
          <th>9</th>
          <th>10=(9/3)*100</th>
          <th>11</th>
          <th>12=(11/3)*100</th>
          <th>13</th>
          <th>14</th>
          <th>15=12-10</th>
          <th>16</th>
        </tr>



        <?php }
        elseif ($realisasi=='fisik_tertinggi' || $realisasi=='fisik_terendah' || $realisasi=='dev_fisik_tertinggi' || $realisasi=='dev_fisik_terendah') { ?>
          <tr>
          <th>Target</th>
          <th>Realisasi</th>
          <th colspan="2">Capaian</th>
          <th>Deviasi</th>
          
          </tr>
         
          <tr>
            <th>%</th>
            <th>%</th>
            <th>%</th>
            <th>Ket</th>
            <th>%</th>
          </tr>
          <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6=5/4*100</th>
            <th>7</th>
            <th>8=5-4</th>
            <th>9</th>
          </tr>

        <?php }else{ ?>
           <tr>
            <th colspan="2">Target</th>
            <th colspan="4">Realisasi</th>
            <th rowspan="3">Deviasi</th>
          </tr>
          <tr>
            <th rowspan="2">Rp</th>
            <th rowspan="2">%</th>
            <th rowspan="2">Rp</th>
            <th rowspan="2">%</th>
            <th colspan="2">Capaian</th>
           
            
          </tr>
          <tr>
            <th>%</th>
            <th>Ket</th>
          </tr>
          <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5=(4/3)*100</th>
            <th>6</th>
            <th>7=(6/3)*100</th>
            <th>8</th>
            <th>9</th>
            <th>10=7-5</th>
            <th>11</th>
          </tr>

        <?php }

  // if ($realisasi=='tidak_ada' || $realisasi=='fisik_tertinggi' || $realisasi=='keu_tertinggi' ||$realisasi=='dev_fisik_tertinggi' || $realisasi=='dev_keu_tertinggi') {

  //     $perulangan_atas = $skpd ; 
  //     $perulangan_bawah = $skpd_belum_terekap ; 
  // }else{
  //     $perulangan_atas = $skpd_belum_terekap ; 
  //     $perulangan_bawah = $skpd ; 

  // }

   ?>  
       

       </thead>

      <tbody >
        <?php
          $no = 0;
         
            $total_t_fisik_satu    = 0;
            $total_t_keu_satu      = 0;
            $total_r_fisik_satu    = 0;
            $total_r_keu_satu      = 0;
            $total_tertimbang_satu = 0;
            $jml_skpd_satu         = 0;

            $total_pagu = 0;
            $total_rk_rp = 0;
            $total_tk_rp = 0;




         foreach ($skpd as $v) { 
            $total_t_fisik_satu    += $v['tf'];
              $total_t_keu_satu      += $v['tk'];
              $total_r_fisik_satu    += $v['rf'];
              $total_r_keu_satu      += $v['rk'];
              $total_pagu      += $v['pagu_total'];
              $total_rk_rp      += $v['rp_realisasi_keuangan'];
              $total_tk_rp      += $v['rp_target_keuangan'];
              $jml_skpd_satu++;


              if ($v['rp_target_keuangan'] > $v['pagu_total']) {
                $warning = 'style="background:pink"';
              }else{
                $warning = '';

              }
              $dk = $v['rk'] - $v['tk'];

          $no++;
          ?>
           <tr <?php echo $warning ?>>
            <td align="center"><?php echo $no ?></td>
            <td><?php echo $v['nama_instansi'] ?></td>
            <td align="right"><?php echo number_format($v['pagu_total']) ?></td>
            
             <?php if ($realisasi=='tidak_ada') { ?>
              
              <td align="center" <?php echo $v['blok_tf'] ?>><?php echo $v['tf'] ?></td>
            <td align="center" <?php echo $v['blok_rf'] ?>><?php echo $v['rf'] ?></td>
              <td align="center"><?php echo $v['cf'] ?></td>
              <td align="center"  style="<?php echo $v['wcf'] ?>"> <?php echo $v['kcf'] ?> </td>
            <td align="center" style="<?php echo $v['wf'] ?>"><?php echo round($v['df'],2) ?></td>
            <td align="right"><?php echo number_format($v['rp_target_keuangan']) ?></td>
            <td align="center"><?php echo $v['tk'] ?></td>
            <td align="right"><?php echo number_format($v['rp_realisasi_keuangan']) ?></td>
            <td align="center" ><?php echo $v['rk'] ?></td>
              <td align="center"><?php echo $v['ck'] ?></td>
              <td align="center"  style="<?php echo $v['wck'] ?>"> <?php echo $v['kck'] ?> </td>
            <td align="center" style="<?php echo $v['wk'] ?>"><?php echo round($v['dk'],2) ?></td>
          <?php   }
          elseif ($realisasi=='fisik_tertinggi' || $realisasi=='fisik_terendah' || $realisasi=='dev_fisik_tertinggi' || $realisasi=='dev_fisik_terendah') { ?>
               <td align="center"><?php echo $v['tf'] ?></td>
            <td align="center" style="<?php echo $bg_rea_fisik ?>"><?php echo $v['rf'] ?></td>
              <td align="center"><?php echo $v['cf'] ?></td>
              <td align="center"  style="<?php echo $v['wcf'] ?>"> <?php echo $v['kcf'] ?> </td>
            <td align="center" style="<?php echo $v['wf'] ?>"><?php echo round($v['df'],2) ?></td>
          <?php   }else{ ?>
            <td align="right"><?php echo number_format($v['rp_target_keuangan']) ?></td>
            <td align="center"><?php echo $v['tk'] ?></td>
            <td align="right"><?php echo number_format($v['rp_realisasi_keuangan']) ?></td>
            <td align="center" style="<?php echo $bg_rea_keuangan ?>"><?php echo $v['rk'] ?></td>
              <td align="center"><?php echo $v['ck'] ?></td>
              <td align="center"  style="<?php echo $v['wck'] ?>"> <?php echo $v['kck'] ?> </td>
            <td align="center" style="<?php echo $v['wk'] ?>"><?php echo round($v['dk'],2) ?></td>
              <?php   } ?>
          
            
           
            <td><?php echo $v['last_update'] ?></td>
          </tr>
         <?php }





         foreach ($skpd_belum_terekap as $key => $value) {
          $id_instansi = $value['id_instansi'];


          if ($tahap==4) {
            $pagu_skpd = $this->db->query("SELECT total_anggaran_skpd_perubahan($id_instansi, $tahun) as pagu_skpd")->row_array()['pagu_skpd'];
            # code...
          }else{
            $pagu_skpd = $this->db->query("SELECT total_anggaran_skpd_awal($id_instansi, $tahun) as pagu_skpd")->row_array()['pagu_skpd'];

          }
          $jml_skpd_satu++;
         $no++;
          $total_pagu += $pagu_skpd;

          ?>

            <tr style="background: #dbe7fc ">
              <td align="center"><?php echo $no ?></td>
              <td><?php echo $value['nama_instansi'] ?></td>
              <td style="text-align:right"> <?php echo number_format($pagu_skpd) ?> </td>
                <?php if ($realisasi=='tidak_ada') { ?>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
  <?php   } elseif ($realisasi=='fisik_tertinggi' || $realisasi=='fisik_terendah' || $realisasi=='dev_fisik_tertinggi' || $realisasi=='dev_fisik_terendah') { ?>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
  <?php   }else{ ?>
              <td align="right">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="right">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
              <td align="center">0</td>
   <?php   } ?>
             <td>Belum Synchronize</td>
            </tr>
         <?php  } 




            $hasil_akuntansi_t_keu = $total_pagu == 0 ? 0 : ($total_tk_rp / $total_pagu) * 100;
            $hasil_akuntansi_r_keu = $total_pagu == 0 ? 0 : ($total_rk_rp / $total_pagu) * 100;
            $deviasi_akuntansi_keu = round($hasil_akuntansi_r_keu,2) - round($hasil_akuntansi_t_keu,2);
            if ($deviasi_akuntansi_keu <-10) {
              $warna_peringatan_deviasi_akuntansi_keu = 'background: #f8b2b2'; 
            }
            elseif ($deviasi_akuntansi_keu <-5  && $deviasi_akuntansi_keu >-10) {
              $warna_peringatan_deviasi_akuntansi_keu = 'background: #fcf3cf';
            }else{
              $warna_peringatan_deviasi_akuntansi_keu = 'background: #d5f5e3';
            }




            @$ratarata_t_fisik_satu    =  round($total_t_fisik_satu / $jml_skpd_satu, 2); 
            @$ratarata_r_fisik_satu   =  round($total_r_fisik_satu / $jml_skpd_satu, 2); 
            @$total_dev_fisik_satu = $ratarata_r_fisik_satu - $ratarata_t_fisik_satu ;
            @$pencapaian_fisik_satu = $ratarata_t_fisik_satu ==0 ? 0 : ($ratarata_r_fisik_satu / $ratarata_t_fisik_satu) * 100 ;
            if ($total_dev_fisik_satu <-10) {
                $warna_peringatan_total_dev_fisik = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_fisik_satu <-5  && $total_dev_fisik_satu >-10) {
              $warna_peringatan_total_dev_fisik = 'background: #fcf3cf';
            }else{
              $warna_peringatan_total_dev_fisik = 'background: #d5f5e3';
            }


            @$ratarata_t_keu_satu   =  $total_pagu == 0 ? 0 :  round((($total_tk_rp / $total_pagu) * 100),2);//round($total_t_keu_satu / $jml_skpd_satu, 2); 
            @$ratarata_r_keu_satu   =  $total_pagu == 0 ? 0 :  round((($total_rk_rp / $total_pagu) * 100),2);//round($total_r_keu_satu / $jml_skpd_satu, 2);
            @$deviasi_ratarata_keu = $ratarata_r_keu_satu - $ratarata_t_keu_satu ;
            @$pencapaian_keu_satu = $ratarata_t_keu_satu == 0 ? 0 : ($ratarata_r_keu_satu / $ratarata_t_keu_satu) * 100 ;


            if ($deviasi_ratarata_keu <-10) {
                $warna_peringatan_deviasi_ratarata_keu = 'background: #f8b2b2'; 
            }
            elseif ($deviasi_ratarata_keu <-5  && $deviasi_ratarata_keu >-10) {
              $warna_peringatan_deviasi_ratarata_keu = 'background: #fcf3cf';
            }else{
              $warna_peringatan_deviasi_ratarata_keu = 'background: #d5f5e3';
            }





            



        if ($pencapaian_fisik_satu>90) {
            
            $ketcap_f = 'ST';
            $warcap_f = 'background: #7BF1A8';
          }
          else if ($pencapaian_fisik_satu<=90 && $pencapaian_fisik_satu>80) {
            
            $ketcap_f = 'T';
            $warcap_f = 'background:#DCFCE7';
          }
          else if ($pencapaian_fisik_satu<=80 && $pencapaian_fisik_satu>60) {
            
            $ketcap_f = 'S';
            $warcap_f = 'background:#FEF9C2';
          }
          else if ($pencapaian_fisik_satu<=60 && $pencapaian_fisik_satu>50) {
            
            $ketcap_f = 'R';
            $warcap_f = 'background:#FFE2E2';
          }else{
            
            $ketcap_f = 'SR';
            $warcap_f = 'background:#FFA2A2';
          }



        if ($pencapaian_keu_satu>90) {
            $hitung_ketcap_k_ST++;
            $ketcap_k = 'ST';
            $warcap_k = 'background: #7BF1A8';
          }
          else if ($pencapaian_keu_satu<=90 && $pencapaian_keu_satu>80) {
            $hitung_ketcap_k_T++;
            $ketcap_k = 'T';
            $warcap_k = 'background:#DCFCE7';
          }
          else if ($pencapaian_keu_satu<=80 && $pencapaian_keu_satu>60) {
            $hitung_ketcap_k_S++;
            $ketcap_k = 'S';
            $warcap_k = 'background:#FEF9C2';
          }
          else if ($pencapaian_keu_satu<=60 && $pencapaian_keu_satu>50) {
            $hitung_ketcap_k_R++;
            $ketcap_k = 'R';
            $warcap_k = 'background:#FFE2E2';
          }else{
            $hitung_ketcap_k_SR++;
            $ketcap_k = 'SR';
            $warcap_k = 'background:#FFA2A2';
          }







              
            ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"><b>Total </b></td>
          <td align="right"><?php echo number_format($total_pagu) ?></td>
              <?php if ($realisasi=='tidak_ada') { ?>
           <td align="center"><?php echo $total_t_fisik_satu; ?></td>
          <td align="center"><?php echo $total_r_fisik_satu; ?></td>
          <td align="center">-</td>
          <td align="center">-</td>
          <td align="center">-</td>
          <td align="right"><?php echo number_format($total_tk_rp) ?></td>
          <td align="center"><?php echo $total_t_keu_satu; ?></td>
          <td align="right"><?php echo number_format($total_rk_rp) ?></td>
          <td align="center"><?php echo $total_r_keu_satu?></td>
          <td align="center">-</td>
          <td align="center">-</td>
          <td align="center">-</td>
          <?php  }
          elseif ($realisasi=='fisik_tertinggi' || $realisasi=='fisik_terendah' || $realisasi=='dev_fisik_tertinggi' || $realisasi=='dev_fisik_terendah') { ?>
          <td align="center"><?php echo $total_t_fisik_satu; ?></td>
          <td align="center"><?php echo $total_r_fisik_satu; ?></td>
          <td align="center">-</td>
          <td align="center">-</td>
          <td align="center">-</td>
          <?php  }else{ ?>
          <td align="right"><?php echo number_format($total_tk_rp) ?></td>
          <td align="center"><?php echo $total_t_keu_satu; ?></td>
          <td align="right"><?php echo number_format($total_rk_rp) ?></td>
          <td align="center"><?php echo $total_r_keu_satu?></td>
          <td align="center">-</td>
          <td align="center">-</td>
          <td align="center">-</td>
           <?php  } ?>
          <td align="center">-</td>
        </tr>
      <!--   <tr>
          <td colspan="2"><b>Pencapaian (Secara Akuntansi)  <sup>*)</sup></b></td>
          <td align="center">-</td>
            
          <td align="center">-</td>
          <td align="center">-</td>
          <td align="center">-</td>
          <td align="center" colspan="2"><?php echo round($hasil_akuntansi_t_keu,2); ?></td>
          <td align="center" colspan="2"><?php echo round($hasil_akuntansi_r_keu,2); ?></td>
          <td align="center" style="<?php echo $warna_peringatan_deviasi_akuntansi_keu ?>"><?php echo $deviasi_akuntansi_keu; ?></td>
        </tr> -->
        <tr>
          <td colspan="2"><b>Pencapaian <!-- (Secara Ratarata)  <sup>**)</sup> --></b></td>
          <td align="center">-</td>
          <?php if ($realisasi=='tidak_ada') { ?>
            <td align="center"><?php echo $ratarata_t_fisik_satu; ?></td>
          <td align="center"><?php echo $ratarata_r_fisik_satu; ?></td>
          <td align="center"><?php echo round($pencapaian_fisik_satu,2); ?></td>
          <td align="center" style="<?php  echo $warcap_f ?>"> <?php echo $ketcap_f ?> </td>
          <td align="center" style="<?php  echo $warna_peringatan_total_dev_fisik ?>"><?php echo round($total_dev_fisik_satu,2); ?></td>

          <td align="center" colspan="2"><?php echo $ratarata_t_keu_satu; ?></td>
          <td align="center" colspan="2"><?php echo $ratarata_r_keu_satu ?></td>

          <td align="center"><?php echo round($pencapaian_keu_satu,2); ?></td>
          <td align="center" style="<?php  echo $warcap_k ?>"> <?php echo $ketcap_k ?> </td>
          <td align="center" style="<?php echo  $warna_peringatan_deviasi_ratarata_keu ?>"><?php echo round($deviasi_ratarata_keu,2); ?></td>
            <?php   }
            elseif ($realisasi=='fisik_tertinggi' || $realisasi=='fisik_terendah' || $realisasi=='dev_fisik_tertinggi' || $realisasi=='dev_fisik_terendah') { ?>
          <td align="center"><?php echo $ratarata_t_fisik_satu; ?></td>
          <td align="center"><?php echo $ratarata_r_fisik_satu; ?></td>
          <td align="center"><?php echo round($pencapaian_fisik_satu,2); ?></td>
          <td align="center" style="<?php  echo $warcap_f ?>"> <?php echo $ketcap_f ?> </td>
          <td align="center" style="<?php  echo $warna_peringatan_total_dev_fisik ?>"><?php echo round($total_dev_fisik_satu,2); ?></td>
            <?php   }else{ ?>

          <td align="center" colspan="2"><?php echo $ratarata_t_keu_satu; ?></td>
          <td align="center" colspan="2"><?php echo $ratarata_r_keu_satu ?></td>
          <td align="center"><?php echo round($pencapaian_keu_satu,2); ?></td>
          <td align="center" style="<?php  echo $warcap_k ?>"> <?php echo $ketcap_k ?> </td>
          <td align="center" style="<?php echo  $warna_peringatan_deviasi_ratarata_keu ?>"><?php echo round($deviasi_ratarata_keu,2); ?></td>
             <?php   } ?>
             <td align="center">-</td>
        </tr>
      </tfoot>
     
    </table>



  <br>

<br>




<?php if ($realisasi=='tidak_ada') { ?>



    <div style="width:35%; float: left">
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
          <th colspan="2">Total</th>
        </tr>
        <tr>
          <th style="width:55px">Fisik</th>
          <th style="width:55px">Keuangan</th>
        </tr>
        <tr style="background: #f8b2b2;">
          <td>Deviasi Diatas -10%</td>
          <td align="center"><?php echo $statistik['hitung_dev_f_merah'] ?></td>
          <td align="center"><?php echo $statistik['hitung_dev_k_merah'] ?></td>
        </tr>
        <tr style="background: #fcf3cf;">
          <td>Deviasi Antara 5% sampai 10%</td>
          <td align="center"><?php echo $statistik['hitung_dev_f_kuning'] ?></td>
          <td align="center"><?php echo $statistik['hitung_dev_k_kuning'] ?></td>
        </tr>
        <tr style="background: #d5f5e3;">
          <td>Deviasi Dibawah -5%</td>
          <td align="center"><?php echo $statistik['hitung_dev_f_hijau'] ?></td>
          <td align="center"><?php echo $statistik['hitung_dev_k_hijau'] ?></td>
        </tr>
        <tr style="background:#ff7cfd;">
          <td>Melebihi Target</td>
          <td align="center"><?php echo $statistik['hitung_dev_f_ungu'] ?></td>
          <td align="center"><?php echo $statistik['hitung_dev_k_ungu'] ?></td>
        </tr>
         <tr>
          <th align="left">Total Data</th>
          
          <th colspan="2"><?php echo $no ?></th>
        </tr>
     </thead>
      
    </table>
    </div>
    <div style="width:35%; float: left; margin-left:10px">
    <span class="font_laporan">
      <b>
        <u>Statistika Capaian Realisasi SKPD :</u>
      </b>
    </span>
    <br><br>
    <table class="font_laporan table" style="border-collapse: collapse; width:100%;">
     <thead>
        
        <tr>
          <th rowspan="2">Kode</th>
          <th rowspan="2">Keterangan</th>
          <th colspan="2">Total</th>
        </tr>
        <tr>
          <th style="width:55px">Fisik</th>
          <th style="width:55px">Keuangan</th>
        </tr>
        <tr style="background:#7BF1A8">
          <td>ST</td>
          <td>Sangat Tinggi </td>
          <td align="center"><?php echo $statistik['hitung_ketcap_f_ST'] ?></td>
          <td align="center"><?php echo $statistik['hitung_ketcap_k_ST'] ?></td>
        </tr>
        <tr style="background:#DCFCE7">
          <td>T</td>
          <td>Tinggi</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_f_T'] ?></td><
          <td align="center"><?php echo $statistik['hitung_ketcap_k_T'] ?></td><
          
        </tr>
        <tr style="background:#FEF9C2">
          <td>S</td>
          <td>Sedang</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_f_S'] ?></td><
          <td align="center"><?php echo $statistik['hitung_ketcap_k_S'] ?></td><
          
        </tr>
        <tr style="background:#FFE2E2">
          <td>R</td>
          <td>Rendah</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_f_R'] ?></td><
          <td align="center"><?php echo $statistik['hitung_ketcap_k_R'] ?></td><
          
        </tr>
        <tr style="background:#FFA2A2">
          <td>SR</td>
          <td>Sangat Rendah</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_f_SR'] ?></td><
          <td align="center"><?php echo $statistik['hitung_ketcap_k_SR'] ?></td><
          
        </tr>
         <tr>
          <th colspan="2" align="left">Total Data</th>
          
          <th colspan="2"><?php echo $no ?></th>
        </tr>
     </thead>
      
    </table>
    </div>


<?php }
elseif ($realisasi=='fisik_tertinggi' || $realisasi=='fisik_terendah' || $realisasi=='dev_fisik_tertinggi' || $realisasi=='dev_fisik_terendah') { ?>





    <div style="width:35%; float: left">
    <span class="font_laporan">
      <b>
        <u>Statistika Data Deviasi SKPD :</u>
      </b>
    </span>
    <br><br>
    <table class="font_laporan table" style="border-collapse: collapse; width:100%;">
     <thead>
        
        <tr>
          <th>Keterangan</th>
          <th style="width:55px">Fisik</th>
        </tr>
        <tr style="background: #f8b2b2;">
          <td>Deviasi Diatas -10%</td>
          <td align="center"><?php echo $statistik['hitung_dev_f_merah'] ?></td>
        </tr>
        <tr style="background: #fcf3cf;">
          <td>Deviasi Antara 5% sampai 10%</td>
          <td align="center"><?php echo $statistik['hitung_dev_f_kuning'] ?></td>
        </tr>
        <tr style="background: #d5f5e3;">
          <td>Deviasi Dibawah -5%</td>
          <td align="center"><?php echo $statistik['hitung_dev_f_hijau'] ?></td>
        </tr>
        <tr style="background:#ff7cfd;">
          <td>Melebihi Target</td>
          <td align="center"><?php echo $statistik['hitung_dev_f_ungu'] ?></td>
        </tr>
         <tr>
          <th align="left">Total Data</th>
          
          <th><?php echo $no ?></th>
        </tr>
     </thead>
      
    </table>
    </div>
    <div style="width:35%; float: left; margin-left:10px">
    <span class="font_laporan">
      <b>
        <u>Statistika Capaian Realisasi SKPD :</u>
      </b>
    </span>
    <br><br>
    <table class="font_laporan table" style="border-collapse: collapse; width:100%;">
     <thead>
        
        <tr>
          <th rowspan="2">Kode</th>
          <th rowspan="2">Keterangan</th>
          <th>Total</th>
        </tr>
        <tr>
          <th style="width:55px">Fisik</th>
        </tr>
        <tr style="background:#7BF1A8">
          <td>ST</td>
          <td>Sangat Tinggi </td>
          <td align="center"><?php echo $statistik['hitung_ketcap_f_ST'] ?></td>
        </tr>
        <tr style="background:#DCFCE7">
          <td>T</td>
          <td>Tinggi</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_f_T'] ?></td><
          
        </tr>
        <tr style="background:#FEF9C2">
          <td>S</td>
          <td>Sedang</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_f_S'] ?></td><
          
        </tr>
        <tr style="background:#FFE2E2">
          <td>R</td>
          <td>Rendah</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_f_R'] ?></td><
          
        </tr>
        <tr style="background:#FFA2A2">
          <td>SR</td>
          <td>Sangat Rendah</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_f_SR'] ?></td><
          
        </tr>
         <tr>
          <th colspan="2" align="left">Total Data</th>
          
          <th><?php echo $no ?></th>
        </tr>
     </thead>
      
    </table>
    </div>






<?php }else{ ?>





    <div style="width:35%; float: left">
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
          <th>Total</th>
        </tr>
        <tr>
          <th style="width:55px">Keuangan</th>
        </tr>
        <tr style="background: #f8b2b2;">
          <td>Deviasi Diatas -10%</td>
          <td align="center"><?php echo $statistik['hitung_dev_k_merah'] ?></td>
        </tr>
        <tr style="background: #fcf3cf;">
          <td>Deviasi Antara 5% sampai 10%</td>
          <td align="center"><?php echo $statistik['hitung_dev_k_kuning'] ?></td>
        </tr>
        <tr style="background: #d5f5e3;">
          <td>Deviasi Dibawah -5%</td>
          <td align="center"><?php echo $statistik['hitung_dev_k_hijau'] ?></td>
        </tr>
        <tr style="background:#ff7cfd;">
          <td>Melebihi Target</td>
          <td align="center"><?php echo $statistik['hitung_dev_k_ungu'] ?></td>
        </tr>
         <tr>
          <th align="left">Total Data</th>
          
          <th><?php echo $no ?></th>
        </tr>
     </thead>
      
    </table>
    </div>
    <div style="width:35%; float: left; margin-left:10px">
    <span class="font_laporan">
      <b>
        <u>Statistika Capaian Realisasi SKPD :</u>
      </b>
    </span>
    <br><br>
    <table class="font_laporan table" style="border-collapse: collapse; width:100%;">
     <thead>
        
        <tr>
          <th rowspan="2">Kode</th>
          <th rowspan="2">Keterangan</th>
          <th>Total</th>
        </tr>
        <tr>
          <th style="width:55px">Keuangan</th>
        </tr>
        <tr style="background:#7BF1A8">
          <td>ST</td>
          <td>Sangat Tinggi </td>
          <td align="center"><?php echo $statistik['hitung_ketcap_k_ST'] ?></td>
        </tr>
        <tr style="background:#DCFCE7">
          <td>T</td>
          <td>Tinggi</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_k_T'] ?></td><
          
        </tr>
        <tr style="background:#FEF9C2">
          <td>S</td>
          <td>Sedang</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_k_S'] ?></td><
          
        </tr>
        <tr style="background:#FFE2E2">
          <td>R</td>
          <td>Rendah</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_k_R'] ?></td><
          
        </tr>
        <tr style="background:#FFA2A2">
          <td>SR</td>
          <td>Sangat Rendah</td>
          <td align="center"><?php echo $statistik['hitung_ketcap_k_SR'] ?></td><
          
        </tr>
         <tr>
          <th colspan="2" align="left">Total Data</th>
          
          <th><?php echo $no ?></th>
        </tr>
     </thead>
      
    </table>
    </div>






<?php } ?> 



