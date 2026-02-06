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

<table class="font_laporan border">
 <thead class="header">
    <tr>
    <th rowspan="2"  width="30px">No</th>
    <th colspan="5">Paket Pekerjaan</th>
  </tr>
  <tr>
    <th>Kecamatan <br></th>  
    <th>Sub Kegiatan <br></th>  
    <th width="50px">Jenis paket <br></th>  
    <th>Metode</th>
    <th>Pagu <br></th>  
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
    $tahap =tahapan_apbd();
    $no_ski = 0;
    $id_instansi = $v->id_instansi;
    $id_kab_kota = $v->id_kab_kota;
    $q_ski = $this->db->query("SELECT lpp.id_paket_pekerjaan as id_paket_pekerjaan,
      left join paket_pekerjaan on lpp.id_paket_pekerjaan = pp.id_paket_pekerjaan
      left join sub_kegiatan_instansi ski on pp.kode_rekening_sub_kegiatan = ski.kode_sub_kegiatan
    
      where lpp.id_instansi = '$id_instansi' and lpp.id_kab_kota='$id_kab_kota' and ski.tahun='$tahun'
      group by pp.kode_rekening_sub_kegiatan
      ");
    $j_ski = $q_ski->num_rows();
    $no++;

    ?>
      
      <tr class="skpd">
        <td ><b><?php echo $no ?></b></td>
        <td colspan="8"><b><?php echo $v->nama_instansi ?></b></td>
      </tr>
      <?php
      $n = 0; 
      foreach ($q_ski->result() as $key => $d_ski) {
        $no_ski ++;
        $kode_rekening_sub_kegiatan = $d_ski->kode_rekening_sub_kegiatan;
       
      $nama_sub_kegiatan = $d_ski->kategori=='Unit Pelaksana' ? $d_ski->nama_sub_kegiatan.'<br> ['.$d_ski->jenis_sub_kegiatan.' - '.$d_ski->keterangan.']': $d_ski->nama_sub_kegiatan;
       
        ?>
      <tr>
     
        <td><?php echo $no.'.'.$no_ski ?></td>
        <td><?php echo $d_ski->nama_kecamatan ?></td>
        <td><?php echo $nama_sub_kegiatan ?></td>
        <td align="right"><?php echo number_format($d_ski->pagu) ?></td>
         <td></td>
     </tr>
  <?php 

    $total_pagu +=$d_ski->pagu;
  $totalpaket_swa +=$swakelola;
  $totalpaket_penyedia_konstruksi +=$penyedia_kontruksi;
  $totalpaket_penyedia_non_konstruksi +=$penyedia_non_kontruksi;
  $totalpaket_semua +=$total_paket;
  $totalpagu_paket_semua +=$total_pagu_paket;
     }
    } //akhir foreach ($kab_kota as $k => $v) { 
?>
 </tbody>
 <tfoot>
   <tr>
     <td colspan="4">Total</td>
     <td align="right"><?php echo number_format($total_pagu) ?></td>
     <td align="center"><?php echo number_format($totalpaket_swa) ?></td>
     <td align="center"><?php echo number_format($totalpaket_penyedia_konstruksi) ?></td>
     <td align="center"><?php echo number_format($totalpaket_penyedia_non_konstruksi) ?></td>
     <td align="center"><?php echo number_format($totalpaket_semua) ?></td>
     <td align="right"><?php echo number_format($totalpagu_paket_semua) ?></td>
   </tr>
 </tfoot>

</table>
</body>