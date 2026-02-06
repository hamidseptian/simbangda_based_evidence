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


  .judul_laporan{
    margin-top:15px;
    text-align : center;
    font-family: 'arial';
    font-size:12px;
  }
  .skpd{
    font-size:15px;
  }
</style>

<head>
  <title><?php echo $title ?></title>
</head>


<body>
<?php echo  $title ?>
<table class="font_laporan border">
 <thead class="header">
    <tr>
    <th   width="30px">No</th>
    <th >Kabupaten <br></th>  
    <th >Kecamatan <br></th>  
    <th>SKPD</th>
    <th>Sub Kegiatan</th>
    <th>Paket Pekerjaan</th>
    <th>Jenis Paket</th>
    <th>Kategori</th>
    <th>Pagu paket</th>
  </tr>
 
 </thead>
 <tbody>
   <?php 
  $no   = 0;
  $total_pagu = 0;
  $totalpaket_swa = 0;
  $totalpaket_penyedia_konstruksi = 0;
  $totalpaket_penyedia_non_konstruksi = 0;
  $totalpaket_semua = 0;
  $totalpagu_paket_semua = 0;

  foreach ($lokasi_per_skpd as $k => $v) { 
    $tahap = 4;//tahapan_apbd();
    $no_ski = 0;
    $id_instansi = $v->id_instansi;
    $id_kab_kota = $v->id_kab_kota;
    $nama_sub_kegiatan = $v['kategori'] == 'Sub Kegiatan SKPD' ? $v['nama_sub_kegiatan'] : $v['nama_sub_kegiatan'].'<br>'.$v['jenis_sub_kegiatan'].' - '.$v['keterangan'];
    // $j_ski = $q_ski->num_rows();
    $no++;

    ?>
      
      <tr>
        <td ><?php echo $no ?></td>
        <td><?php echo $v['nama_kota'] ?></td>
        <td><?php echo $v['nama_kecamatan'] ?></td>
        <td><?php echo $v['nama_instansi'] ?></td>
        <td><?php echo $nama_sub_kegiatan ?></td>
        <td><?php echo $v['nama_paket'] ?></td>
        <td><?php echo $v['jenis_paket'] ?></td>
        <td><?php echo $v['kategori_penyedia'] ?></td>
        <td><?php echo number_format( $v['pagu']) ?></td>
      </tr>
      <?php
      $n = 0; 
  
  }
?>
 </tbody>
<!--  <tfoot>
   <tr>
     <td colspan="4">Total</td>
    
   </tr>
 </tfoot>
 -->
</table>
</body>