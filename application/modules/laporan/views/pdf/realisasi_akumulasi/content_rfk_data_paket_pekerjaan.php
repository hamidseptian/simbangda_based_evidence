<?php

if ($kode_tahap == 4) {
    if ($kode_tahap == $tahap) {
        $data_paket = $this->db->query("SELECT * from v_paket where id_instansi='$id_instansi' and tahun='$tahun' and kode_rekening_sub_kegiatan='$krsk' and status='1'");
    } else {
        $data_paket = $this->db->query("SELECT * from v_paket where id_instansi='$id_instansi' and tahun='$tahun' and kode_rekening_sub_kegiatan='$krsk'");
    }
} else {
    $data_paket = $this->db->query("SELECT vp.* , (SELECT sum(nilai)as rf FROM realisasi_fisik WHERE id_paket_pekerjaan = vp.id_paket_pekerjaan and bulan<='$bulan') as rf from v_paket vp where id_instansi='$id_instansi' and tahun='$tahun' order by kode_rekening_sub_kegiatan asc")->result_array();
}

$grouped = [];
$hasil   = [];

$total_apbd =0 ;
$total_tkd = 0;

$hitung_rutin =0;
$hitung_swa =0;
$hitung_pen =0;
$hitung_paket =0;

foreach ($data_paket as $row) {
    $program      = $row['kode_rekening_program'];
    $kegiatan     = $row['kode_rekening_kegiatan'];
    $sub_kegiatan = $row['kode_rekening_sub_kegiatan'];
    $pagu         = (float) $row['pagu'];
    $pagu_tkd         = (float) $row['pagu_tkd'];
    $pagu_paket = $pagu + $pagu_tkd ;


$hitung_paket ++;
    if ($row['jenis_paket']=="SWAKELOLA") {
      $hitung_swa ++;
      # code...
    }
    else if ($row['jenis_paket']=="PENYEDIA") {
      $hitung_pen ++;
      # code...
    }
    else{
      $hitung_rutin ++;
      # code...
    }
    $total_apbd +=$pagu;
    $total_tkd +=$pagu_tkd;

    // PROGRAM
    if (!isset($hasil[$program])) {
        $hasil[$program] = [
            'kode_program' => $program,
            'nama_program' =>$master_program[$program],
            // 'total_pagu_apbd'   => 0,
            // 'total_pagu_tkd'   => 0,
            'kegiatan'     => []
        ];
    }
    $hasil[$program]['total_pagu_apbd'] += $pagu;
    $hasil[$program]['total_pagu_tkd'] += $pagu_tkd;
    $hasil[$program]['total_pagu_paket'] += $pagu_paket;

    // KEGIATAN
    if (!isset($hasil[$program]['kegiatan'][$kegiatan])) {
        $hasil[$program]['kegiatan'][$kegiatan] = [
            'kode_kegiatan' => $kegiatan,
            'nama_kegiatan' =>$master_kegiatan[$kegiatan],
              // 'total_pagu_apbd'    => 0,
              // 'total_pagu_tkd'    => 0,
            'sub_kegiatan'  => []
        ];
    }
    $hasil[$program]['kegiatan'][$kegiatan]['total_pagu_apbd'] += $pagu;
    $hasil[$program]['kegiatan'][$kegiatan]['total_pagu_tkd'] += $pagu_tkd;
    $hasil[$program]['kegiatan'][$kegiatan]['total_pagu_paket'] += $pagu_paket;

    // SUB KEGIATAN
    if (!isset($hasil[$program]['kegiatan'][$kegiatan]['sub_kegiatan'][$sub_kegiatan])) {
        $hasil[$program]['kegiatan'][$kegiatan]['sub_kegiatan'][$sub_kegiatan] = [
            'kode_sub_kegiatan' => $sub_kegiatan,
            'nama_sub_kegiatan' => $master_sub_kegiatan[$sub_kegiatan],
            'total_pagu_apbd'        => 0,
            'total_pagu_tkd'        => 0,
            'paket'             => []
        ];
    }

  $hasil[$program]['kegiatan'][$kegiatan]['sub_kegiatan'][$sub_kegiatan]['total_pagu_apbd'] += $pagu;
  $hasil[$program]['kegiatan'][$kegiatan]['sub_kegiatan'][$sub_kegiatan]['total_pagu_tkd'] += $pagu_tkd;
    // pagu program dan kegiatan

    // PAKET
    $hasil[$program]['kegiatan'][$kegiatan]['sub_kegiatan'][$sub_kegiatan]['paket'][] = $row;
}
?>
      

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
</style>

<head>
  <title><?php echo $title ?></title>
</head>


<body>

      
<table class="font_laporan border table">
 <thead class="header">
   


    <tr>
      <th rowspan="4">No</th>
      <th>Data APBD</th>
      <th colspan="14">Data Paket Pekerjaan</th>
      <th rowspan="4">Nilai Realisasi<br>Fisik</th>
    </tr>
    <tr>
      <th rowspan="3">Kode Rekening <hr>   Tahapan APBD Paket Ditambahkan Pada</th>
      <th rowspan="3">Keterangan Data APBD,<br>Nama Paket</th>
      <th rowspan="3">Jenis Paket</th>
      <th rowspan="3">Metode</th>
      <th colspan="3">Pagu Paket</th>
      <th rowspan="3">Volume<br>Pelaksanaan</th>
      <th rowspan="3">Lokasi<br>Pelaksanaan</th>
      <th colspan="6">Evidence</th>
    </tr>
    <tr>
      <th rowspan="2">APBD</th>
      <th rowspan="2">TKD</th>
      <th rowspan="2">Total</th>
      <th rowspan="2">Banyak<br>Beban</th>
      <th rowspan="2">Belum Di<br>Upload</th>
      <th colspan="3">Sudah Diupload</th>
      <th rowspan="2">Total</th>
    </tr>
    <tr>
      <th>Belum<br>Validasi</th>
      <th>Disetujui</th>
      <th>Ditolak</th>
    </tr>
    <tr class="num-row">
      <td>1</td>
      <td>2</td>
      <td>3</td>
      <td>4</td>
      <td>5</td>
      <td>6</td>
      <td>7</td>
      <td>8=6+7</td>
      <td>9</td>
      <td>10</td>
      <td>11</td>
      <td>12</td>
      <td>13</td>
      <td>14</td>
      <td>15</td>
      <td>16</td>
      <td>17</td>
    </tr>

 </thead>


 <tbody>
  <?php 
  $no_program = 0;
  foreach ($hasil as $k => $v) {
  $no_program++ ?>
   <tr  style="background: #e8daef">
    <td><?php echo $no_program ?></td>
    <td><b><?php echo $v['kode_program'] ?></b></td>
      <td colspan="3"><b> <?php echo $v['nama_program'] ?></b></td>
      <td align=" right"> <?php echo number_format($v['total_pagu_apbd'])   ?> </td>
      <td align=" right"> <?php echo number_format($v['total_pagu_tkd'])   ?> </td>
      <td align=" right"> <?php echo number_format($v['total_pagu_paket'])   ?> </td>
      
      <td colspan="8" align="center">-</td>
      <td>  ?? </td>
    </tr>
    <?php 
     $no_kegiatan = 0;
    foreach ($v['kegiatan'] as $k_k => $v_k) { 
      $no_kegiatan++;
      ?>

   <tr style="background: #d6eaf8 ">
    <td ><?php echo $no_program.'.'.$no_kegiatan ?></td>
    <td><b><?php echo $v_k['kode_kegiatan'] ?></b></td>
      <td colspan="3"><b> <?php echo $v_k['nama_kegiatan'] ?></b></td>
      <td align=" right"> <?php echo number_format($v_k['total_pagu_apbd'])   ?> </td>
      <td align=" right"> <?php echo number_format($v_k['total_pagu_tkd'])   ?> </td>
      <td align=" right"> <?php echo number_format($v_k['total_pagu_paket'])   ?> </td>

      <!-- <td> ?? </td> -->
      <td colspan="8" align="center">-</td>
      <td> ?? </td>
    </tr>
     <?php 
     $no_sub_kegiatan = 0;
     foreach ($v_k['sub_kegiatan'] as $k_sk => $v_sk) { 
      $no_sub_kegiatan++;
      ?>


   <tr >
    <td><?php echo $no_program.'.'.$no_kegiatan.'.'.$no_sub_kegiatan ?></td>
    <td><b><?php echo $v_sk['kode_sub_kegiatan'] ?></b></td>
    <td  colspan="6"><b> <?php echo $v_sk['nama_sub_kegiatan'] ?></b></td>
      <!-- <td></td> -->
      <td colspan="8"></td>
      <td> ?? </td>
    </tr>


     <?php 
     $no_paket = 0;
     foreach ($v_sk['paket'] as $k_p => $v_p) { 
      $no_paket++;
      ?>


   <tr>
    <td><?php echo $no_program.'.'.$no_kegiatan.'.'.$no_sub_kegiatan.'.'.$no_paket ?></td>
    <td style="color:blue"> <?php echo pilihan_nama_tahapan($v_p['kode_tahap']) ?></td>
    <td><?php echo $v_p['nama_paket'] ?></td>
    <td><?php echo $v_p['jenis_paket'] ?></td>
    <td><?php echo $v_p['metode'] ?></td>
    <td align="right"><?php echo number_format($v_p['pagu']) ?></td>
    <td align="right"><?php echo $v_p['pagu_tkd'] == '' ? '-' : number_format($v_p['pagu_tkd']) ?></td>
    <td><?php 
    $pagu_total_paket = $v_p['pagu'] + $v_p['pagu_tkd'];
    echo number_format($pagu_total_paket) ?></td>

  <td align="center"> <?php echo $v_p['volume'] ?></td>
  <td align="center"> <?php echo $v_p['banyak_lokasi'] ?></td>
  <td align="center"> <?php echo $v_p['beban_dokumen_diupload'] ?></td>
  <td align="center" >
    <?php 
    $belum_upload = $v_p['beban_dokumen_diupload'] - $v_p['evidence_diupload'];
    echo $belum_upload
     ?>
  </td>
  <td align="center" > <?php echo $v_p['belum_validasi'] ?></td>
  <td align="center" > <?php echo $v_p['sudah_validasi'] ?></td>
  <td align="center" > <?php echo $v_p['ditolak'] ?></td>
  <td align="center"> <?php echo $v_p['evidence_diupload'] ?></td>
  <td align="center"> <?php echo $v_p['rf'] ?></td>




    </tr>
<?php } ?>
     <?php } ?>
    <?php } ?>
  <?php } ?>
</tbody>
<tfoot>

    <tr class="total-row">
      <td colspan="5">Total</td>
      <td><?php echo number_format($total_apbd) ?> </td>
      <td><?php echo number_format($total_tkd) ?> </td>
      <td><?php 
        $total_pagu = $total_apbd + $total_tkd ;
      echo number_format($total_pagu) ?> </td>
      <td colspan="2">
      <?php echo $hitung_rutin ?> Rutin <br>  
      <?php echo $hitung_swa ?> Swakelola <br>  
      <?php echo $hitung_pen ?> Penyedia <br>  
       Total : <?php echo $hitung_paket ?> Paket <br>  


</td>
      <td> ?? </td>
      <td> ?? </td>
      <td> ?? </td>
      <td> ?? </td>
      <td> ?? </td>
      <td> ?? </td>
      <td> ?? </td>
    </tr>


  
</tfoot>
</table>
