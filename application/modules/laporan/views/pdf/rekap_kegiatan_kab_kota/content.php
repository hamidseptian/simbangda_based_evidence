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
<div class="judul_laporan"><?php echo $title ?></div>
<br>
<table class="font_laporan border">
 <thead class="header">
    <tr>
    <th rowspan="2"  width="30px">No</th>
    <th rowspan="2" >Kabupaten <br></th>  
    <th rowspan="2" >Kecamatan <br></th>  
    <th colspan="2">SKPD</th>
    <th colspan="4">Sub Kegiatan</th>
    <th colspan="4">Paket Pekerjaan</th>
 
  </tr>
  <tr>
       <th>Kode OPD</th>
       <th>Nama OPD</th>
       <th>Kode Sub Kegitan</th>
    <th>Nama Sub Kegiatan</th>
    <th>Pagu</th>
    <th>Sumber Dana</th>
    <th>Nama Paket</th>
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
 
    $no++;
 $nama_sub_kegiatan = $v['kategori'] == 'Sub Kegiatan SKPD' ? $v['nama_sub_kegiatan'] : $v['nama_sub_kegiatan'].'<br>'.$v['jenis_sub_kegiatan'].' - '.$v['keterangan'];
    ?>
      
      <tr>
        <td ><?php echo $no ?></td>
        <td><?php echo $v['nama_kota'] ?></td>
        <td><?php echo $v['nama_kecamatan'] ?></td>
        <td><?php echo $v['kode_opd'] ?></td>
        <td><?php echo $v['nama_instansi'] ?></td>
        <td><?php echo $v['kode_rekening_sub_kegiatan'] ?></td>
        <td><?php echo $nama_sub_kegiatan ?></td>
        <td><?php echo number_format( $v['pagu_sub_kegiatan']) ?></td>
        <td>
          <?php 
          $kumpul_sd = [];

          if ($v['pad']>0) {
            $pad = "PAD : ". number_format($v['pad']);
            array_push($kumpul_sd, $pad);
          }
          if ($v['dau']>0) {
            $dau = "DAU : ". number_format($v['dau']);
            array_push($kumpul_sd, $dau);
          }
          if ($v['dak']>0) {
            $dak = "DAK : ". number_format($v['dak']);
            array_push($kumpul_sd, $dak);
          }
          if ($v['dbh']>0) {
            $dbh = "DBH : ". number_format($v['dbh']);
            array_push($kumpul_sd, $dbh);
          }
          if ($v['lainnya']>0) {
            $lainnya = $v['nama_sumber_dana_lainnya']." : ". number_format($v['lainnya']);
            array_push($kumpul_sd, $lainnya);
          }


            echo "<ol>";
          foreach ($kumpul_sd as $k_sd => $v_sd) {
            echo "<li>".$v_sd."</li>";
          }
            echo "</ol>";
           ?>
        </td>
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