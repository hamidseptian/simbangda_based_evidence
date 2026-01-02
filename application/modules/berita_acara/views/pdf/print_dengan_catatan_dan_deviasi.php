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

    <p>Pada hari ini <?php echo $nama_hari.' '.$caption_jadwal ?>  bertempat <?php echo $template['lokasi'] ?> telah dilaksanakan Rapat Desk Entri Data <?php echo $nama_tahap.' '.$template['tahun'] ?> dengan hasil sebagai berikut :</p>
    
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
                foreach ($grafik as $key => $v) { 
                    $deviasi_fisik = $v['realisasi_fisik_akumulasi'] - $v['target_fisik_akumulasi'];
                    $deviasi_keuangan = $v['realisasi_keuangan_akumulasi'] - $v['target_fisik_akumulasi'];

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
                    <td><?php echo bulan_global($v['bulan']) ?></td>
                    <td align="center"><?php echo $v['target_fisik_akumulasi'] ?></td>
                    <td align="center"><?php echo $v['realisasi_fisik_akumulasi'] ?></td>
                    <td align="center" style="<?php echo $warna_dev_fisik ?>"> <?php echo  round($deviasi_fisik,2) ?> </td>
                    
                    <td align="center"><?php echo $v['target_keuangan_akumulasi'] ?></td>
                    <td align="center"><?php echo $v['realisasi_keuangan_akumulasi'] ?></td>
                    <td align="center" style="<?php echo $warna_dev_keuangan ?>"> <?php echo  round($deviasi_keuangan,2) ?> </td>
                    
                    
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
    



    <p>Demikian Berita Acara Rapat Desk Entri data  <?php echo $nama_tahap.' Tahun '.$template['tahun'] ?> ini dibuat untuk menjadi bahan seperlunya.</p>
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
                <td style="text-align: center; padding-top: 100px; border: none;"><b><?php echo "Ria Wijayanty, ST, M.Si";//$template['helpdesk'] ?></b></td>
                <td style="text-align: center; padding-top: 100px; border: none;"><b><?php echo $template['pimpinan']=='' ? '...................................' : $template['pimpinan'] ?></b></td>
            </tr>

        </tbody>
    </table>
    

</body>
</html>