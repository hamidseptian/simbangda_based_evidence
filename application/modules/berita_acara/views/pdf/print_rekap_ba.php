<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>REKAP BERITA ACARA</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th,{ border: 1px solid #333; padding: 5px; text-align: center; }
        td { border: 1px solid #333; padding: 5px; text-align: left; }
        h2 { text-align: center }
        .font_laporan{
                font-size:9px;
                font-family: 'arial';
            }
        .text-danger{
            color:red;
        }
    </style>
</head>
<body>
    <p style="text-align: center; font-weight: bold; padding: 0; margin: 0">REKAP BERITA ACARA</p>
    <p style="text-align: center; font-weight: bold; padding: 0; margin: 0"><?php echo $template['kegiatan'] ?></p>
    <p style="text-align: center; font-weight: bold; padding: 0; margin: 0">TAHUN ANGGARAN <?php echo $template['tahun'] ?></p>

    

    <table class="font_laporan">
        <thead>
            <tr>
                <th>No</th>
                <th>OPD</th>
                <th>Pimpinan OPD</th>
                <th>Catatan</th>
                <th>Solusi</th>
                <th>Status</th>
                <th>Helpdesk</th>
                <th>Synchronize</th>
                <th>Jadwal</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            $no=1;
            foreach ($opd as $k => $v) { ?>
            <tr>
                <td valign="top"><?php echo $no++; ?></td>
                <td valign="top"><?php echo $v['nama_instansi']; ?></td>
                <td valign="top"><?php echo $v['pimpinan'].''.($v['jenis_pimpinan'] == '' ? '' : ' ('.$v['jenis_pimpinan'].')'); ?></td>
                <td valign="top"><?php echo $v['catatan']; ?></td>
                <td valign="top"><?php echo $v['solusi']; ?></td>
                <td valign="top"><?php echo $v['status']; ?></td>
                <td valign="top"><?php echo $v['helpdesk']; ?></td>
                <td valign="top"><?php echo $v['synchronize']=='' ?  '<span class="text-danger">Belum di Synchronize</span>' : $v['synchronize'] ; ?></td>
                <td valign="top"><?php echo $v['tgl_berita_acara'] == '' ? '<span class="text-danger">Jadwal belum ditentukan</span>' : balikkan_tanggal($v['tgl_berita_acara']); ?></td>
            </tr>
             <?php } ?>
        </tbody>
    </table>
   
</body>
</html>