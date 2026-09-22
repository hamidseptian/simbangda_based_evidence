


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
          width : 80px;
        }
        .skpd{
          float:right;
          margin-left:10px;
          
        }
        .clearfix{
          clear:both;
          
        }
        .kop{
          /*text-align:center;*/
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
          font-weight: 900;  
          font-size:16px;
        }
        .nama_instansi{
          font-size:22px;
          text-align: justify;
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
          /*text-align : center;*/
          font-family: 'arial';
          font-size:13px;
        }
        .nama_kegiatan{
          white-space:pre;
          left: 30px;
        }
      </style>

        <table class="font_laporan border table"> 





 <thead class="header">
          <tr>

          <th rowspan="4"  width="20px">No</th>
          <th rowspan="4">SKPD</th>
          <th rowspan="4" style="width:100px"> Pagu</th>
          <th colspan="4"> Fisik</th>
          <th colspan="6"> Keuangan</th>
          <th  rowspan="4">Last Update</th>
       

         
        </tr>



        <tr>  
          <th rowspan="2">Target</th>
          <th rowspan="2">Realisasi</th>
          <th rowspan="2">Capaian</th>
          <th rowspan="3">Deviasi</th>
          <th colspan="2">Target</th>
          <th colspan="3">Realisasi</th>
          <th rowspan="3">Deviasi</th>
        </tr>
        <tr>
         
          <th rowspan="2">Rp</th>
          <th rowspan="2">%</th>
          <th rowspan="2">Rp</th>
          <th rowspan="2">%</th>
          <th>Capaian</th>
        </tr>
        <tr>
          <th>%</th>
          <th>%</th>
          <th >%</th>
          <!-- <th >Ket</th> -->
          <th >%</th>
          <!-- <th >Ket</th> -->
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
        </tr>


       

       </thead>
       <tbody>
         <?php 
         $no=1;

         $total_pagu =0;
         $total_tk =0;
         $total_rk =0;

         $total_bobot =0;
         $total_tf =0;
         $total_rf =0;
         foreach ($grafik as $k => $v) { 
          $dev_fisik =  $v['realisasi_fisik'] -  $v['target_fisik'] ; 
          $capaian_fisik =  $v['realisasi_fisik'] / $v['target_fisik'] * 100; 
          $dev_keuangan =  $v['realisasi_keuangan'] -  $v['target_keuangan'] ; 
          $capaian_keuangan =  $v['realisasi_keuangan'] / $v['target_keuangan'] * 100; 

          $total_pagu += $v['pagu_total'];
          $total_tk += $v['rp_target_keuangan'];
          $total_rk += $v['rp_realisasi_keuangan'];

              $bobot_apbd = ($v['pagu_total'] / $total_pagu_apbd) * 100;
                $ttb_tf_apbd = $v['target_fisik'] * $bobot_apbd /100;
                $ttb_rf_apbd = $v['realisasi_fisik'] * $bobot_apbd /100;

         $total_bobot  += $bobot_apbd;
         $total_tf  += $v['target_fisik'];
         $total_rf  += $v['realisasi_fisik'];


      

        if ($dev_fisik <-10) {
          $hitung_dev_f_merah++;
              $warna_peringatan_dev_fisik = 'background: #f8b2b2'; 
            }
            elseif ($dev_fisik <-5  && $dev_fisik >=-10) {
              $hitung_dev_f_kuning++;
              $warna_peringatan_dev_fisik = 'background: #fcf3cf';
            }
            elseif ($dev_fisik <=0  && $dev_fisik >=-5) {
              $hitung_dev_f_hijau++;
              $warna_peringatan_dev_fisik = 'background: #d5f5e3';
            }else{
              $hitung_dev_f_ungu++;
              $warna_peringatan_dev_fisik = 'background: #ff7cfd';
            }

            if ($dev_keuangan <-10) {
              $hitung_dev_k_merah++;
              $warna_peringatan_dev_keu = 'background: #f8b2b2'; 
            }
            elseif ($dev_keuangan <-5  && $dev_keuangan >=-10) {
              $hitung_dev_k_kuning++;
              $warna_peringatan_dev_keu = 'background: #fcf3cf';
            }
            elseif ($dev_keuangan <=0  && $dev_keuangan >=-5) {
              $hitung_dev_k_hijau++;
              $warna_peringatan_dev_keu = 'background: #d5f5e3';
            }else{
              $hitung_dev_k_ungu++;
              $warna_peringatan_dev_keu = 'background: #ff7cfd';
            }



          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $v['nama_instansi'] ?></td>
            <td align="right"><?php echo number_format($v['pagu_total']) ?></td>
            <td align="center"><?php echo $v['target_fisik'] ?></td>
            <td align="center"><?php echo $v['realisasi_fisik'] ?></td>
            <td align="center"><?php echo number_format($capaian_fisik,2)  ?></td>
            <td align="center" style="<?php echo $warna_peringatan_dev_fisik ?>"><?php echo number_format($dev_fisik,2) ?></td>
            <td align="right"><?php echo number_format($v['rp_target_keuangan']) ?></td>
            <td><?php echo $v['target_keuangan'] ?></td>
            <td align="right"><?php echo number_format($v['rp_realisasi_keuangan']) ?></td>
            <td><?php echo $v['realisasi_keuangan'] ?></td>
            <td align="center"><?php echo number_format($capaian_keuangan,2)  ?></td>
            <td align="center" style="<?php echo $warna_peringatan_dev_keu ?>"><?php echo number_format($dev_keuangan,2) ?></td>
            <td><?php echo $v['last_update'] ?></td>
          </tr>
         <?php } 


         $ratarata_tf = $total_tf / count($grafik);
         $ratarata_rf = $total_rf / count($grafik);
         $capaian_f = $ratarata_rf / $ratarata_tf * 100;
         $deviasi_fisik_all = $ratarata_rf - $ratarata_tf;

         $ratarata_tk = ($total_tk / $total_pagu) * 100;
         $ratarata_rk = ($total_rk / $total_pagu) * 100;;
         $capaian_k = $ratarata_rk / $ratarata_tk * 100;
         $deviasi_keuangan_all = $ratarata_rk - $ratarata_tk;




        if ($deviasi_fisik_all <-10) {
          $hitung_dev_f_merah++;
              $warna_peringatan_deviasi_fisik_all = 'background: #f8b2b2'; 
            }
            elseif ($deviasi_fisik_all <-5  && $deviasi_fisik_all >=-10) {
              $hitung_dev_f_kuning++;
              $warna_peringatan_deviasi_fisik_all = 'background: #fcf3cf';
            }
            elseif ($deviasi_fisik_all <=0  && $deviasi_fisik_all >=-5) {
              $hitung_dev_f_hijau++;
              $warna_peringatan_deviasi_fisik_all = 'background: #d5f5e3';
            }else{
              $hitung_dev_f_ungu++;
              $warna_peringatan_deviasi_fisik_all = 'background: #ff7cfd';
            }

            if ($deviasi_keuangan_all <-10) {
              $hitung_dev_k_merah++;
              $warna_peringatan_deviasi_keu_all = 'background: #f8b2b2'; 
            }
            elseif ($deviasi_keuangan_all <-5  && $deviasi_keuangan_all >=-10) {
              $hitung_dev_k_kuning++;
              $warna_peringatan_deviasi_keu_all = 'background: #fcf3cf';
            }
            elseif ($deviasi_keuangan_all <=0  && $deviasi_keuangan_all >=-5) {
              $hitung_dev_k_hijau++;
              $warna_peringatan_deviasi_keu_all = 'background: #d5f5e3';
            }else{
              $hitung_dev_k_ungu++;
              $warna_peringatan_deviasi_keu_all = 'background: #ff7cfd';
            }




         ?>
       </tbody>

        <tfoot>
          <tr>
            <th colspan="2">Total</th>
            <td><?php echo number_format($total_pagu) ?></td>
            <td>-</td>
            <td> <?php echo round($total_rf,2) ?></td>
            <td> <?php echo round($total_rf,2) ?></td>
            <td> - </td>
            <td><?php echo number_format($total_tk) ?></td>
            <td> ??</td>
            <td><?php echo number_format($total_rk) ?></td>
            <td> ?? </td>
            <td> - </td>
            <td> - </td>
            <td> - </td>
          </tr>
          <tr>
            <th colspan="2">Pencapaian</th>
            <th>-</th>
            <th> <?php echo round($ratarata_tf,2) ?></th>
            <th> <?php echo round($ratarata_rf,2) ?></th>
            <th> <?php echo round($capaian_f,2) ?></th>
            <th style="<?php echo $warna_peringatan_deviasi_fisik_all ?>"> <?php echo round($deviasi_fisik_all,2) ?></th>
           
            <th colspan="2"> <?php echo round($ratarata_tk,2) ?></th>
            <th colspan="2"> <?php echo round($ratarata_rk,2) ?></th>
            <th> <?php echo round($capaian_k,2) ?></th>
            <th style="<?php echo $warna_peringatan_deviasi_keu_all ?>"> <?php echo round($deviasi_keuangan_all,2) ?></th>
            <th> - </th>
          </tr>
        </tfoot>
        </tfoot>


        </table>



</body>
