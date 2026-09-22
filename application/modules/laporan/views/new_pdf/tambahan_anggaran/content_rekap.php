 
        <table class="font_laporan border table"> 
          <thead class="header"> 
             <tr>
      <th rowspan="3">No</th>
      <th rowspan="3">SKPD</th>
      <th colspan="4">APBD</th>
      <th colspan="4">TKD</th>
      <th colspan="4">Total</th>
    </tr>
    <tr>
      <th>Pagu</th>
      <th colspan="2">Realisasi Keuangan</th>
      <th>Fisik</th>
      <th>Pagu</th>
      <th colspan="2">Realisasi Keuagan</th>
      <th>Fisik</th>
      <th>Pagu</th>
      <th colspan="2">Realisasi</th>
      <th>Fisik</th>
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
      <th>%</th>
    </tr>
    <tr>
      <th>1</th>
      <th>2</th>
      <th>3</th>
      <th>4</th>
      <th>5=(4/3)*100</th>
      <th>6</th>
      <th>7</th>
      <th>8</th>
      <th>9=(8/7)*100</th>
      <th>10</th>
      <th>11=3+7</th>
      <th>12=4+8</th>
      <th>13=(12/11)*100</th>
      <th>14=?</th>
    </tr>

</thead>
<tbody>
  
         <?php 
         $no=1;

         $total_pagu =0;
         $total_pagu_tambahan =0;
         $total_rp_rk =0;
         $total_rp_rk_tambahan =0;

         $total_bobot =0;
         $total_rf =0;
         $total_rf_tambahan =0;
         foreach ($grafik as $k => $v) { 


         $total_pagu +=$v['pagu_total'];
         $total_rp_rk +=$v['rp_realisasi_keuangan'];
         $total_rf +=$v['realisasi_fisik'];

          ?>

          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $v['nama_instansi'] ?></td>
            <td align="right"><?php echo number_format($v['pagu_total']) ?></td>
            <td align="right"><?php echo number_format($v['rp_realisasi_keuangan']) ?></td>
            <td align="center"><?php echo $v['realisasi_keuangan'] ?></td>
            <td align="center"><?php echo $v['realisasi_fisik'] ?></td>

            <?php if ($v['pagu_total_tambahan']> 0 ) { 
              $total_pagu_rekap = $v['pagu_total'] + $v['pagu_total_tambahan'];
              $total_rk_rekap = $v['rp_realisasi_keuangan'] + $v['rp_realisasi_keuangan_tambahan'];
              $rk_rekap = ($total_rk_rekap / $total_pagu_rekap) * 100;

              $total_pagu_tambahan += $v['pagu_total_tambahan'];
             $total_rp_rk_tambahan +=$v['rp_realisasi_keuangan_tambahan'];
             $total_rf_tambahan +=$v['realisasi_fisik_tambahan'];

              ?>
              <td align="right"><?php echo number_format($v['pagu_total_tambahan']) ?></td>
              <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_tambahan']) ?></td>
              <td align="center"><?php echo $v['realisasi_keuangan_tambahan'] ?></td>
              <td align="center"><?php echo $v['realisasi_fisik_tambahan'] ?></td>


            <td align="right"><?php echo number_format($total_pagu_rekap) ?></td>
            <td align="right"><?php echo number_format($total_rk_rekap) ?></td>
            <td align="center"><?php echo round($rk_rekap,2) ?></td>
            <td align="center"><?php echo $v['realisasi_fisik'] // masih menggunakan fisik APBD saja karena belum mendapatkan rumur yang cocok dan berakibat mernrunyaealisasi fisik ?></td>


            <?php }else{ ?>
              <td align="center"> - </td>
              <td align="center"> - </td>
              <td align="center"> - </td>
              <td align="center"> - </td>


            <td align="right"><?php echo number_format($v['pagu_total']) ?></td>
            <td align="right"><?php echo number_format($v['rp_realisasi_keuangan']) ?></td>
            <td align="center"><?php echo $v['realisasi_keuangan'] ?></td>
            <td align="center"><?php echo $v['realisasi_fisik'] ?></td>



            <?php } ?>



       
          </tr>

          <?php } ?>

  </tbody>


<tfoot>



  <tr>
    <td colspan="2" align="center">Total</td>
    
    <td align="right"><?php echo number_format($total_pagu) ?></td>
    <td align="right">  <?php echo number_format($total_rp_rk) ?> </td>
    
    <td> - </td>
    <td> <?php echo $total_rf ?> </td>
    <td align="right">  <?php echo number_format($total_pagu_tambahan) ?> </td>
    <td align="right">  <?php echo number_format($total_rp_rk_tambahan) ?> </td>
    <td> - </td>
    <td> <?php echo $total_rf_tambahan ?> </td>

      <td align="right">
      <?php 
      $pagu_total_semua = $total_pagu + $total_pagu_tambahan;
      $pagu_rp_rk_semua = $total_rp_rk + $total_rp_rk_tambahan;

      $persen_total_rk_apbd = ($total_rp_rk / $total_pagu) * 100;
      $persen_total_rk_tambahan = ($total_rp_rk_tambahan / $total_pagu_tambahan) * 100;

      $persen_total_rk_semua = ($pagu_rp_rk_semua / $pagu_total_semua) * 100;
      echo number_format($pagu_total_semua);
      ?>
        
      </td>

    

    <td align="right"><?php echo number_format($pagu_rp_rk_semua) ?></td>
     <td> - </td>
     <td> - </td>
   
  </tr>


  <?php 
  $persen_fisik_apbd = $total_rf / count($grafik);
  $persen_fisik_tambahan = $total_rf_tambahan / count($grafik_tambahan);
   ?>
  <tr >
       

    <td colspan="2" align="center"><b>Pencapaian</b></td>
.
    <th align="center">-</th>
    
    <th align="center" colspan="2"> <?php echo round($persen_total_rk_apbd,2) ?></th>
  
    
    <th align="center"><?php echo round($persen_fisik_apbd,2) ?></th>
    <th> - </th>
    <th align="center" colspan="2"> <?php echo round($persen_total_rk_tambahan,2) ?></th>
    <th > <?php echo round($persen_fisik_tambahan,2) ?></th>
    <th align="center">-</th>
    <th align="center" colspan="2"> <?php echo round($persen_total_rk_semua,2) ?></th>
    <th > ??? </th>

    
    
  </tr>
  

</tfoot>






</table>



<div>
  



</div>

</body>
