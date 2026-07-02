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
  <tr>
    <th rowspan="2">No</th>
    <th rowspan="2">Helpdesk</th>
    <th colspan="2">Total evidence di upload</th>
    <th colspan="2"  style="background:  #f1f5fe ">Total evidence belum di periksa</th>
    <th colspan="2">Total evidence di setujui</th>
    <th colspan="2">Total evidence di tolak</th>
  </tr>
  <tr >
    <th>OPD Wajib</th>
    <th>OPD Perbantuan</th>
    <th style="background:  #f1f5fe ">OPD Wajib</th>
    <th style="background:  #f1f5fe ">OPD Perbantuan</th>

    <th>OPD Wajib</th>
    <th>OPD Perbantuan</th>

    <th>OPD Wajib</th>
    <th>OPD Perbantuan</th>
  </tr>

<?php 
$total_evidence_diupload_pj_instansi = 0 ;
$total_evidence_diupload_bantuan =0;

$total_evidence_belum_validasi_pj_instansi = 0 ;
$total_evidence_belum_validasi_bantuan =0;

$total_evidence_sudah_validasi_pj_instansi =0;
$total_evidence_sudah_validasi_bantuan =0;
$total_evidence_ditolak_pj_instansi =0;
$total_evidence_ditolak_bantuan =0;

foreach ($helpdesk as $k => $v) { 

$total_evidence_diupload_pj_instansi += $v['total_evidence_diupload_pj_instansi'];
$total_evidence_diupload_bantuan += $v['total_evidence_diupload_bantuan'];
$total_evidence_belum_validasi_pj_instansi += $v['total_evidence_belum_validasi_pj_instansi'];
$total_evidence_belum_validasi_bantuan += $v['total_evidence_belum_validasi_bantuan'];

$total_evidence_sudah_validasi_pj_instansi += $v['total_evidence_sudah_validasi_pj_instansi'];
$total_evidence_sudah_validasi_bantuan += $v['total_evidence_sudah_validasi_bantuan'];
$total_evidence_ditolak_pj_instansi += $v['total_evidence_ditolak_pj_instansi'];
$total_evidence_ditolak_bantuan += $v['total_evidence_ditolak_bantuan'];






    if ($v['total_evidence_belum_validasi_pj_instansi']==0) {
      $background_wajib = 'style="background: #d5f5e3"';
    }
    elseif ($v['total_evidence_belum_validasi_pj_instansi']>100) {
      $background_wajib = 'style="background:#f8b2b2"';
    }else{
      $background_wajib = 'style="background:#fcf3cf"';
    }
    if ($v['total_evidence_belum_validasi_bantuan']==0) {
      $background_bantuan = 'style="background: #d5f5e3"';
    }
    elseif ($v['total_evidence_belum_validasi_bantuan']>100) {
      $background_bantuan = 'style="background:#f8b2b2"';
    }else{
      $background_bantuan = 'style="background:#fcf3cf"';
    }






  ?>
  <tr>
    <td align="center"><?php echo $k+1 ?></td>
    <td><?php echo $v['full_name'] ?></td>
    <td align="center"><?php echo $v['total_evidence_diupload_pj_instansi'] ?></td>
    <td align="center"><?php echo $v['total_evidence_diupload_bantuan'] ?></td>
    <td align="center" <?php echo $background_wajib ?> ><?php echo $v['total_evidence_belum_validasi_pj_instansi'] ?></td>
    <td align="center" <?php echo $background_bantuan ?> ><?php echo $v['total_evidence_belum_validasi_bantuan'] ?></td>
    <td align="center"><?php echo $v['total_evidence_sudah_validasi_pj_instansi'] ?></td>
    <td align="center"><?php echo $v['total_evidence_sudah_validasi_bantuan'] ?></td>
    <td align="center"><?php echo $v['total_evidence_ditolak_pj_instansi'] ?></td>
    <td align="center"><?php echo $v['total_evidence_ditolak_bantuan'] ?></td>
  </tr>
<?php } 



    if ($total_evidence_belum_validasi_pj_instansi==0) {
      $background_wajib = 'style="background: #d5f5e3"';
    }
    elseif ($total_evidence_belum_validasi_pj_instansi>500) {
      $background_wajib = 'style="background:#f8b2b2"';
    }else{
      $background_wajib = 'style="background:#fcf3cf"';
    }
    if ($total_evidence_belum_validasi_bantuan==0) {
      $background_bantuan = 'style="background: #d5f5e3"';
    }
    elseif ($total_evidence_belum_validasi_bantuan>500) {
      $background_bantuan = 'style="background:#f8b2b2"';
    }else{
      $background_bantuan = 'style="background:#fcf3cf"';
    }





    ?>
  <tfoot>
    <tr>
      <td colspan="2"><center>Total</center></td>
      <td align="center"><?php echo $total_evidence_diupload_pj_instansi ?></td>
      <td align="center"><?php echo $total_evidence_diupload_bantuan ?></td>
      <td align="center" <?php echo $background_wajib ?>><?php echo $total_evidence_belum_validasi_pj_instansi ?></td>
      <td align="center" <?php echo $background_bantuan ?>><?php echo $total_evidence_belum_validasi_bantuan ?></td>
      <td align="center"><?php echo $total_evidence_sudah_validasi_pj_instansi ?></td>
      <td align="center"><?php echo $total_evidence_sudah_validasi_bantuan ?></td>
      <td align="center"><?php echo $total_evidence_ditolak_pj_instansi ?></td>
      <td align="center"><?php echo $total_evidence_ditolak_bantuan ?></td>
    </tr>
  </tfoot>
</table>

</body>