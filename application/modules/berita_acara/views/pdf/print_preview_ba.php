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
  
    $pagu_bo = 1234567890 ; //$grafik[0]['pagu_bo_bp'] + $grafik[0]['pagu_bo_bbj'] + $grafik[0]['pagu_bo_bs'] + $grafik[0]['pagu_bo_bh'];
    $pagu_bm = 1234567890 ; //$grafik[0]['pagu_bm_bmt'] + $grafik[0]['pagu_bm_bmpm'] + $grafik[0]['pagu_bm_bmgb'] + $grafik[0]['pagu_bm_bmjji'] + $grafik[0]['pagu_bm_bmatl'];
    $pagu_btt = 1234567890 ; //$grafik[0]['pagu_btt'];
    $pagu_bt = 1234567890 ; //$grafik[0]['pagu_bt_bbh'] + $grafik[0]['pagu_bt_bbk'] ;
    $pagu_total = 1234567890 ; //$grafik[0]['pagu_total'];
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

    <p style="font-style: italic">Keterangan * : Lihat di lembar DPPA rekapitulasi SKPD</p>
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
                <td  colspan="3"  style="text-align:center">999 Paket</td>
                <td  colspan="3"  style="text-align:center">999 Paket</td>
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

           <?php 
           for ($i=1; $i <= 12 ; $i++) {   ?>

             <tr>
                    <td></td>    
                    <td><?php echo bulan_global($i) ?></td>
                    <td align="center">0.00</td>
                    <td align="center">0.00</td>
                    <td align="center" style="background: #d5f5e3">0.00</td>
                    
                    <td align="center">0.00</td>
                    <td align="center">0.00</td>
                    <td align="center" style="background: #d5f5e3"> 0.00</td>
                    
                    
                </tr>


            <?php } 
         ?>

            

        </tbody>
    </table>

    <p style="font-weight: bold">D. Catatan</p>


    <table style="width: 100%; table-layout: fixed; border: none;" class="  table">
       
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