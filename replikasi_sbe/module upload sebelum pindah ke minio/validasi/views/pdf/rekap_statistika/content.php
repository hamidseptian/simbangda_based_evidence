<style>
  .font_laporan{
    font-size:9px;
    font-family: 'arial';
  }
  table {
    
    border-collapse: collapse;
    width:100%;
}
table td, th {
    border: 0.01em solid ;
    padding:3px;
}

  .header{
    font-weight:bold;
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
    font-size:15px;
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
  .nama_kegiatan{
    white-space:pre;
    left: 30px;
  }

  .center{
    text-align: center;
  }
</style>

<head>
  <title><?php echo $judul_laporan ?></title>
</head>


<body>

<table class="font_laporan border">
  <thead>
  <tr>
      <th rowspan="3">No</th>
      <th rowspan="3">SKPD</th>
      <th rowspan="3">Helpdesk</th>
      <th rowspan="3">Total paket</th>
      <th colspan="5">Evidence</th>
    </tr>
    <tr>
      <th rowspan="2">Di Upload</th>
      <th colspan="2"  style="background:  #f1f5fe ">Belum Validasi</th>
      <th rowspan="2">Disetujui</th>
      <th rowspan="2">Ditolak</th>
    </tr>
    <tr  style="background:  #f1f5fe ">
      <th>Swakelola</th>
      <th>Penyedia</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no=1;
    $total_paket_semua  =0;
    $total_evidence_diupload_semua  =0;
    $total_evidence_belum_validasi_swakelola_semua  = 0;
    $total_evidence_belum_validasi_penyedia_semua  = 0;
    $total_evidence_approve_semua  =0;
    $total_evidence_reject_semua  =0;
    foreach ($skpd as $k => $v) { 
      $total_paket_semua += $v['total_paket'];
      $total_evidence_diupload_semua += $v['total_evidence_diupload'];
      $total_evidence_belum_validasi_swakelola_semua += $v['total_evidence_belum_validasi_swakelola'];
      $total_evidence_belum_validasi_penyedia_semua += $v['total_evidence_belum_validasi_penyedia'];
      $total_evidence_approve_semua += $v['total_evidence_approve'];
      $total_evidence_reject_semua += $v['total_evidence_reject'];




    if ($v['total_evidence_belum_validasi_swakelola']==0) {
      $background_swa = 'style="background: #d5f5e3"';
    }
    elseif ($v['total_evidence_belum_validasi_swakelola']>100) {
      $background_swa = 'style="background:#f8b2b2"';
    }else{
      $background_swa = 'style="background:#fcf3cf"';
    }
    if ($v['total_evidence_belum_validasi_penyedia']==0) {
      $background_pen = 'style="background: #d5f5e3"';
    }
    elseif ($v['total_evidence_belum_validasi_penyedia']>100) {
      $background_pen = 'style="background:#f8b2b2"';
    }else{
      $background_pen = 'style="background:#fcf3cf"';
    }




      ?>
      <tr>
        <td  align="center"><?php echo $no++ ?></td>
        <td><?php echo $v['nama_instansi'] ?></td>
        <td>
          <ol>
            
          <?php foreach ($v['helpdesk'] as $k_hd => $v_hd) { 
            if ($v_hd['utama']=='1') {
              $color = 'style="color:blue"';
            }else{
              $color = '';

            }
            ?>
            <li <?php echo $color ?>><?php echo $v_hd['full_name'] ?></li>
          <?php } ?>
          </ol>
        </td>
        <td align="center"><?php echo $v['total_paket'] ?></td>
        <td align="center"><?php echo $v['total_evidence_diupload'] ?></td>
        <td align="center"  <?php echo $background_swa ?> ><?php echo $v['total_evidence_belum_validasi_swakelola'] ?></td>
        <td align="center"  <?php echo $background_swa ?> ><?php echo $v['total_evidence_belum_validasi_penyedia'] ?></td>
        <td align="center"><?php echo $v['total_evidence_approve'] ?></td>
        <td align="center"><?php echo $v['total_evidence_reject'] ?></td>
      </tr>
    <?php } 



    if ($total_evidence_belum_validasi_swakelola_semua==0) {
      $background_swa_total = 'style="background: #d5f5e3"';
    }
    elseif ($total_evidence_belum_validasi_swakelola_semua>500) {
      $background_swa_total = 'style="background:#f8b2b2"';
    }else{
      $background_swa_total = 'style="background:#fcf3cf"';
    }
    if ($total_evidence_belum_validasi_penyedia_semua==0) {
      $background_pen_total = 'style="background: #d5f5e3"';
    }
    elseif ($total_evidence_belum_validasi_penyedia_semua>500) {
      $background_pen_total = 'style="background:#f8b2b2"';
    }else{
      $background_pen_total = 'style="background:#fcf3cf"';
    }

    ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3"  align="center">Total</td>
      <td align="center"><?php echo $total_paket_semua ?></td>
      <td align="center"><?php echo $total_evidence_diupload_semua ?></td>
      <td align="center" <?php echo $background_swa_total ?>><?php echo $total_evidence_belum_validasi_swakelola_semua ?></td>
      <td align="center" <?php echo $background_pen_total ?>><?php echo $total_evidence_belum_validasi_penyedia_semua ?></td>
      <td align="center"><?php echo $total_evidence_approve_semua ?></td>
      <td align="center"><?php echo $total_evidence_reject_semua ?></td>
    </tr>
  </tfoot>
</table>

</body>