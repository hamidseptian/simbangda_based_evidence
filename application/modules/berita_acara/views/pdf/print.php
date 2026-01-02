<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BERITA ACARA <?php echo  $template['nama_instansi']  ?></title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th,{ border: 1px solid #333; padding: 5px; text-align: center; }
        td { border: 1px solid #333; padding: 5px; text-align: left; }
        h2 { text-align: center }
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
    $pagu_bo = $grafik[0]['pagu_bo_bp'] + $grafik[0]['pagu_bo_bbj'] + $grafik[0]['pagu_bo_bs'] + $grafik[0]['pagu_bo_bh'];
    $pagu_bm = $grafik[0]['pagu_bm_bmt'] + $grafik[0]['pagu_bm_bmpm'] + $grafik[0]['pagu_bm_bmgb'] + $grafik[0]['pagu_bm_bmjji'] + $grafik[0]['pagu_bm_bmatl'];
    $pagu_btt = $grafik[0]['pagu_btt'];
    $pagu_bt = $grafik[0]['pagu_bt_bbh'] + $grafik[0]['pagu_bt_bbk'] ;
    $pagu_total = $grafik[0]['pagu_total'];
     ?>
    <table>
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
    <p style="font-style: italic">Keterangan * : Lihat di lembar DPPA rekapitulasi SKPD</p>
    <p style="font-weight: bold">C. Data Entri pada Aplikasi SBE</p>
        <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Uraian Perubahan</th>
                <th colspan="2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">1</td>
                <td rowspan="2">Jumlah Paket</td>
                <td>Paket Penyedia</td>
                <td>Paket Swakelola</td>
            </tr>
            <tr>
                <td><?php echo $paket_swakelola ?> Paket</td>
                <td><?php echo $paket_penyedia ?> Paket</td>
            </tr>
            <tr style="background-color: #93CDDC;">
                <td>2</td>    
                <td>Penetapan Target</td>
                <td>Fisik (%)</td>
                <td>Keuangan (%)</td>
            </tr>
            <?php if (count($grafik)==0) {  ?>
                <tr>
                    <td colspan="4"><span style="color:red">Data gagal ditampilkan <br>Silahkan di lakukan synchronize dulu</span></td>
                </tr>
            <?php }else{
                foreach ($grafik as $key => $v) { ?>
                <tr>
                    <td></td>    
                    <td><?php echo bulan_global($v['bulan']) ?></td>
                    <td align="center"><?php echo $v['target_fisik_akumulasi'] ?></td>
                    <td align="center"><?php echo $v['target_keuangan_akumulasi'] ?></td>
                </tr>
            <?php } 
        }?>

            

        </tbody>
    </table>

    <p style="font-weight: bold">D. Catatan</p>


    <table style="width: 100%; table-layout: fixed; border: none;">
       
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
                        echo "Direktur"; // Output: String 'dunia' ditemukan pada posisi: 5
                    } else {
                        echo "Kepala OPD";
                    }
                ?></th>
            </tr>
        </thead>
        <tbody>
            <tr >
                <td style="text-align: center; padding-top: 100px; border: none;"><b><?php echo "Ria Wijayanti, ST, M.Si";//$template['helpdesk'] ?></b></td>
                <td style="text-align: center; padding-top: 100px; border: none;"><b><?php echo $template['pimpinan']=='' ? '...................................' : $template['pimpinan'] ?></b></td>
            </tr>

        </tbody>
    </table>
    

</body>
</html>