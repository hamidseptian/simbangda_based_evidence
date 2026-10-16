<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BERITA ACARA <?php echo  $template['nama_instansi']  ?></title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th,{ border: 1px solid #333; padding: 5px; text-align: center; }
        .table td { border: 1px solid #333; padding: 5px; text-align: left; }
        .h2 { text-align: center }


    </style>
</head>
<body>
    <p style="text-align: center; font-weight: bold; padding: 0; margin: 0">BERITA ACARA</p>
    <p style="text-align: center; font-weight: bold; padding: 0; margin: 0"><?php echo $template['kegiatan'] ?></p>
    <p style="text-align: center; font-weight: bold; padding: 0; margin: 0">TAHUN ANGGARAN <?php echo $template['tahun'] ?></p>

    <p>Pada hari ini <?php echo $nama_hari.' '.$caption_jadwal ?>  bertempat <?php echo $template['lokasi'] ?> telah dilaksanakan <?php echo $template['kegiatan'] ?> dengan hasil sebagai berikut :</p>
    
    <p style="font-weight: bold">A. Nama OPD : <?php echo $template['nama_instansi'] ?></p>
    <p style="font-weight: bold">B. Jumlah Pagu Anggaran OPD</p>

    <?php 
    if (count($grafik)==0) { ?>
        <span style="color:red">Data gagal ditampilkan <br>Silahkan di lakukan synchronize dulu</span>
    <?php }else{ 
    $pagu_bo = $statistika['pagu_bo'];
    $pagu_bm = $statistika['pagu_bm'];
    $pagu_total = $statistika['pagu_total'];
     ?>
   
    <?php if ($grafik_tambahan->num_rows()) { 
    $tkd = $grafik_tambahan->row_array();

       $pagu_bo_tambahan                = $tkd['pagu_bo_bp'] + $tkd['pagu_bo_bbj'] + $tkd['pagu_bo_bs'] + $tkd['pagu_bo_bh'] + $tkd['pagu_bo_bbs'];
            $pagu_bm_tambahan                = $tkd['pagu_bm_bmt'] + $tkd['pagu_bm_bmpm'] + $tkd['pagu_bm_bmgb'] + $tkd['pagu_bm_bmjji'] + $tkd['pagu_bm_bmatl'] + $tkd['pagu_bm_bmatb'];
            $pagu_btt_tambahan                = $tkd['pagu_btt'];
            $pagu_bt_tambahan                = $tkd['pagu_bt_bbk'] + $tkd['pagu_bt_bbh'];
            $pagu_total_tambahan                = $pagu_bo_tambahan + $pagu_bm_tambahan + $pagu_btt_tambahan + $pagu_bt_tambahan;


        $pagu_bo_total = $pagu_bo + $pagu_bo_tambahan;
        $pagu_bm_total = $pagu_bm + $pagu_bm_tambahan;
        // $pagu_btt_total = $pagu_btt + $pagu_btt_tambahan;
        // $pagu_bt_total = $pagu_bt + $pagu_bt_tambahan;
        $pagu_total_total = $pagu_total + $pagu_total_tambahan;
             ?>
   

    <table class="table">
        <thead>
            <tr>
                <th rowspan="2">Uraian</th>
                <th colspan="3">Pagu</th>
            </tr>
            <tr>
                <th>APBD</th>
                <th>TKD</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Belanja Operasi</td>
                <td style="text-align: right"><?php echo number_format($pagu_bo) ?></td>
                <td style="text-align: right"><?php echo number_format($pagu_bo_tambahan) ?></td>
                <td style="text-align: right"><?php echo number_format($pagu_bo_total) ?></td>
                
            </tr>
            <tr>
                <td>Belanja Modal</td>
                <td style="text-align: right"><?php echo number_format($pagu_bm) ?></td>
                <td style="text-align: right"><?php echo number_format($pagu_bm_tambahan) ?></td>
                <td style="text-align: right"><?php echo number_format($pagu_bm_total) ?></td>
                
            </tr>
          <!--   <tr>
                <td>Belanja Tidak Terduga</td>
                <td style="text-align: right">0</td>
                <td style="text-align: right"><?php echo number_format($pagu_btt_tambahan) ?></td>
                <td style="text-align: right"><?php echo number_format($pagu_btt_tambahan) ?></td>
                
            </tr> -->
           <!--  <tr>
                <td>Belanja Transfer</td>
                <td style="text-align: right">0</td>
                <td style="text-align: right"><?php echo number_format($pagu_bt_tambahan) ?></td>
                <td style="text-align: right"><?php echo number_format($pagu_bt_tambahan) ?></td>
                
            </tr> -->
            <tr>
                <td>Total Pagu</td>
                <td style="text-align: right"><?php echo number_format($pagu_total) ?></td>
                <td style="text-align: right"><?php echo number_format($pagu_total_tambahan) ?></td>
                <td style="text-align: right"><?php echo number_format($pagu_total_total) ?></td>
                
            </tr>
        </tbody>
    </table>


<?php }else{ ?>

    <table class="table">
        <thead>
            <tr>
                <th>Uraian</th>
                <th>Pagu Anggaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Belanja Operasi</td>
                <td style="text-align: right"><?php echo number_format($pagu_bo) ?></td>
            </tr>
            <tr>
                <td>Belanja Modal</td>
                <td style="text-align: right"><?php echo number_format($pagu_bm) ?></td>
            </tr>
            <tr>
                <td>Total Pagu</td>
                <td style="text-align: right"><?php echo number_format($pagu_total) ?></td>
            </tr>
        </tbody>
    </table>
<?php } ?>
<?php } ?>
   
 <p style="font-style: italic; float:left">Keterangan * : Lihat di lembar DPPA rekapitulasi SKPD</p>

    <p style="font-weight: bold">C. Data Entri pada Aplikasi SBE</p>
        <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Uraian Perubahan</th>
                <th colspan="6">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">1</td>
                <td rowspan="2">Jumlah Paket</td>
                <td colspan="3" style="text-align:center">Paket Penyedia</td>
                <td colspan="3" style="text-align:center">Paket Swakelola</td>
            </tr>
            <tr>
                <td  colspan="3"  style="text-align:center"><?php echo $paket_penyedia ?> Paket</td>
                <td  colspan="3"  style="text-align:center"><?php echo $paket_swakelola ?> Paket</td>
            </tr>
            <tr style="background-color: #93CDDC;">
                <td>2</td>    
                <td >Capaian OPD</td>
                <td colspan="3" style="text-align:center">Fisik (%)</td>
                <td colspan="3" style="text-align:center">Keuangan (%)</td>
            </tr>
            <tr style="text-align:center">
                <td></td>
                <td>Bulan</td>
                <td style="text-align:center">Target</td>
                <td style="text-align:center">Realisasi</td>
                <td style="text-align:center">Deviasi</td>
                <td style="text-align:center">Target</td>
                <td style="text-align:center">Realisasi</td>
                <td style="text-align:center">Deviasi</td>
            </tr>
            <?php if (count($grafik)==0) {  ?>
                <tr>
                    <td colspan="8"><span style="color:red">Data gagal ditampilkan <br>Silahkan di lakukan synchronize dulu</span></td>
                </tr>
            <?php }else{

                $data_grafik_tambahan = $grafik_tambahan->result_array();

                foreach ($grafik as $key => $v) { 
                    $deviasi_fisik = $v['realisasi_fisik_akumulasi'] - $v['target_fisik_akumulasi'];
                    $deviasi_keuangan = $v['realisasi_keuangan_akumulasi'] - $v['target_keuangan_akumulasi'];


                    // $deviasi_fisik = $v['realisasi_fisik_akumulasi'] - $v['target_fisik_akumulasi'];




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




                    ?>
                <tr>
                    <td></td>    
                  
                    <?php if ($grafik_tambahan->num_rows()) { 



                    $rp_target_keuangan_total = $data_grafik_tambahan[$key]['rp_target_keuangan_akumulasi'] +$v['rp_target_keuangan_akumulasi'];
                    $rp_realisasi_keuangan_total = $data_grafik_tambahan[$key]['rp_realisasi_keuangan_akumulasi'] +$v['rp_realisasi_keuangan_akumulasi'];
                    $rp_pagu_total = $data_grafik_tambahan[$key]['pagu_total'] +$v['pagu_total'];


                    $persen_tk = $rp_target_keuangan_total / $rp_pagu_total * 100;
                    $persen_rk = $rp_realisasi_keuangan_total / $rp_pagu_total * 100;
                    $deviasi_keuangan_tambahan = $persen_rk - $persen_tk;



                       if ($deviasi_keuangan_tambahan < -10) {
                          $warna_dev_keuangan_tambahan = 'background: #f8b2b2'; 
                        }
                        elseif ($deviasi_keuangan_tambahan <=-5  && $deviasi_keuangan_tambahan >=-10) {
                          $warna_dev_keuangan_tambahan = 'background: #fcf3cf';
                        }
                        elseif ($deviasi_keuangan_tambahan <=0  && $deviasi_keuangan_tambahan >=-5) {
                          $warna_dev_keuangan_tambahan = 'background: #d5f5e3';
                        }else{
                          $warna_dev_keuangan_tambahan = 'background: #ff7cfd';
                        }



                    if ($v['bulan']<=bulan_aktif()) {
                        $realisasi_fisik = $v['realisasi_fisik_akumulasi'];
                        $realisasi_keuangan = round($persen_rk,2);
                        $deviasi_fisik = round($deviasi_fisik,2);
                        $deviasi_keuangan = round($deviasi_keuangan_tambahan,2);
                        $warna_deviasi_fisik = $warna_dev_fisik;
                        $warna_deviasi_keuangan = $warna_dev_keuangan_tambahan;
                    }else{
                        $realisasi_fisik = '-';
                        $realisasi_keuangan = '-';
                        $deviasi_fisik = '-';
                        $deviasi_keuangan = '-';
                        $warna_deviasi_fisik = '-';
                        $warna_deviasi_keuangan = '-';

                    }





                        ?>

                    <td><?php echo bulan_global($v['bulan']) ?></td>
                    <td align="center"><?php echo $v['target_fisik_akumulasi'] ?></td>
                    <td align="center"><?php echo $realisasi_fisik ?></td>
                    <td align="center" style="<?php echo $warna_deviasi_fisik ?>"> <?php echo  $deviasi_fisik ?> </td>
                        <td align="center"><?php echo round($persen_tk,2) ?></td>
                    <td align="center"><?php echo $realisasi_keuangan ?></td>
                    <td align="center" style="<?php echo $warna_deviasi_keuangan ?>"> <?php echo $deviasi_keuangan?> </td>
                    
                    <?php } else{ 


                    if ($v['bulan']<=bulan_aktif()) {      
                        $realisasi_fisik = $v['realisasi_fisik_akumulasi'];
                        $realisasi_keuangan = $v['realisasi_keuangan_akumulasi'];
                        $deviasi_fisik = round($deviasi_fisik,2);
                        $deviasi_keuangan = round($deviasi_keuangan,2);
                        $warna_deviasi_fisik = $warna_dev_fisik;
                        $warna_deviasi_keuangan = $warna_dev_keuangan;
                    }else{
                        $realisasi_fisik = '-';
                        $realisasi_keuangan = '-';
                        $deviasi_fisik = '-';
                        $deviasi_keuangan = '-';
                        $warna_deviasi_fisik = '-';
                        $warna_deviasi_keuangan = '-';

                    }


?>

                    <td><?php echo bulan_global($v['bulan']) ?></td>
                    <td align="center"><?php echo $v['target_fisik_akumulasi'] ?></td>
                    <td align="center"><?php echo $realisasi_fisik ?></td>
                    <td align="center" style="<?php echo $warna_deviasi_fisik ?>"> <?php echo  $deviasi_fisik ?> </td>
                    <td align="center"><?php echo $v['target_keuangan_akumulasi'] ?></td>
                    <td align="center"><?php echo $realisasi_keuangan ?></td>
                    <td align="center" style="<?php echo $warna_deviasi_keuangan ?>"> <?php echo  $deviasi_keuangan ?> </td>
                    <?php } ?>
                  
                    
                    
                </tr>
            <?php } 
        }?>

            

        </tbody>
    </table>

    <p style="font-weight: bold">D. Catatan</p>


    <table style="width: 100%; table-layout: fixed; border: none;" class="table">
       
            <tr>
                <td width="50%" valign="top"><b>Permasalahan</b> : <br>   <?php echo $template['catatan'] == '' ? '-' : $template['catatan'];  ?></td>
                <td width="50%" valign="top"><b>Solusi</b> : <br>   <?php echo $template['solusi'] == '' ? '-' : $template['solusi'];  ?></td>
            </tr>
          
    </table>
    



    <p>Demikian Berita Acara <?php echo $template['kegiatan'] ?> ini dibuat untuk menjadi bahan seperlunya.</p>
    <table style="width: 100%; table-layout: fixed; border: none;">
        <thead>
            <tr>
                <th style="border: none;"></th>
                <td style="border: none;" align="center">Padang, <?php echo $tgl_ttd ?></td>
            </tr>
            <tr>
                <th style="border: none;">Biro Administrasi Pembangunan</th>
                <th style="border: none;"> <?php 
                $pos = strpos($template['nama_instansi'], "RUMAH SAKIT");
                 if ($pos !== false) {
                            echo $template['jenis_pimpinan'] == '' ? "Direktur" : $template['jenis_pimpinan'].' Direktur';
                    } else {
                        echo $template['jenis_pimpinan'] == '' ? "Kepala OPD" : $template['jenis_pimpinan'].' Kepala OPD';
                    }
                ?></th>
            </tr>
        </thead>
        <tbody>
            <tr >
                <td style="text-align: center; padding-top: 100px; border: none;"><b><?php echo "Dr. Ria Wijayanty, ST, M.Si";//$template['helpdesk'] ?></b></td>
                <td style="text-align: center; padding-top: 100px; border: none;"><b><?php echo $template['pimpinan']=='' ? '...................................' : $template['pimpinan'] ?></b></td>
            </tr>

        </tbody>
    </table>
    

</body>
</html>