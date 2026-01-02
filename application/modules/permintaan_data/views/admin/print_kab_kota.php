<style>
  .font_laporan{
    font-size:10px;
    font-family: 'calibri';
  }
  .laporan_asisten{
   
    border-collapse: collapse;
    width:100%;
  }
 
.table td, th {
    border: 0.01em solid ;
    padding:3px;

}

  .tabel_header{
    font-weight:bold;
    text-align : center;
    font-size:9px;

  }

  .rata_kanan{
    text-align : right;

  }
  .rata_tengah{
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
</style>







<div>

  <span class="font_laporan">
      <b>
        Rekap data yang sudah mengirimkan permintaan data <br>  <?php echo $data_permintaan['judul'] ?>
      </b>
    </span>
    <br>
    <br>

  </div>
<div style="clear:both"></div>





<span class="font_laporan">
    Sudah Memberikan data

</span>
<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten table">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th colspan="3">Asisten Pemerintahan dan Kesejahteraan Rakyat</th>
      </tr>   
      <tr class="tabel_header">
        <th width="45px">No</th>
        <th>OPD</th>
        <th width="103px">Waktu Upoad</th>
      </tr>
    </thead>
      <?php 
        if (count($data_file_permintaan['wilayah_1_sudah'])==0) { ?>
            <tr>
                <td colspan="3">Belum ada data</td>
            </tr>
        <?php }else{
          foreach ($data_file_permintaan['wilayah_1_sudah'] as $k => $v) { ?>
            <tr>
                <td align="center"><?php echo $k+1 ?></td>
                <td align=""><?php echo $v['nama_kota'] ?></td>
                <td align=""><?php echo $v['waktu_upload'] ?></td>
            </tr>
          <?php } 
      }?>
  </table>
</div>

<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten table">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th colspan="3">Asisten Perekonomian Dan Pembangunan</th>
      </tr>   
      <tr class="tabel_header">
        <th width="45px">No</th>
        <th>OPD</th>
        <th width="103px">Waktu Upoad</th>
      </tr>
    </thead>
      <?php 
        if (count($data_file_permintaan['wilayah_2_sudah'])==0) { ?>
            <tr>
                <td colspan="3">Belum ada data</td>
            </tr>
        <?php }else{
          foreach ($data_file_permintaan['wilayah_2_sudah'] as $k => $v) { ?>
            <tr>
                <td align="center"><?php echo $k+1 ?></td>
                <td align=""><?php echo $v['nama_kota'] ?></td>
                <td align=""><?php echo $v['waktu_upload'] ?></td>
            </tr>
          <?php } 
      }?>
  </table>
</div>

<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten table">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th colspan="3">Asisten Administrasi Umum</th>
      </tr>   
      <tr class="tabel_header">
        <th width="45px">No</th>
        <th>OPD</th>
        <th width="103px">Waktu Upoad</th>
      </tr>
    </thead>
      <?php 
        if (count($data_file_permintaan['wilayah_3_sudah'])==0) { ?>
            <tr>
                <td colspan="3">Belum ada data</td>
            </tr>
        <?php }else{
          foreach ($data_file_permintaan['wilayah_3_sudah'] as $k => $v) { ?>
            <tr>
                <td align="center"><?php echo $k+1 ?></td>
                <td align=""><?php echo $v['nama_kota'] ?></td>
                <td align=""><?php echo $v['waktu_upload'] ?></td>
            </tr>
          <?php } 
      }?>
  </table>
</div>



<div style="clear:both"></div>


<hr>


<span class="font_laporan">
    Belum Memberikan data
    
</span>
<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten table">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th colspan="2">Asisten Pemerintahan dan Kesejahteraan Rakyat</th>
      </tr>   
      <tr class="tabel_header">
        <th width="45px">No</th>
        <th>OPD</th>
      
      </tr>
    </thead>
      <?php 
        if (count($data_file_permintaan['wilayah_1_belum'])==0) { ?>
            <tr>
                <td colspan="2">Semua OPD lingkup Asisten Pemerintahan dan Kesejahteraan Rakyat mengirimkan Semua</td>
            </tr>
        <?php }else{
          foreach ($data_file_permintaan['wilayah_1_belum'] as $k => $v) { ?>
            <tr>
                <td align="center"><?php echo $k+1 ?></td>
                <td align=""><?php echo $v['nama_kota'] ?></td>
               
            </tr>
          <?php } 
      }?>
  </table>
</div>

<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten table">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th colspan="2">Asisten Perekonomian Dan Pembangunan</th>
      </tr>   
      <tr class="tabel_header">
        <th width="45px">No</th>
        <th>OPD</th>
      
      </tr>
    </thead>
      <?php 
        if (count($data_file_permintaan['wilayah_2_belum'])==0) { ?>
            <tr>
                <td colspan="2">Semua OPD lingkup Asisten Perekonomian Dan Pembangunan mengirimkan Semua</td>
            </tr>
        <?php }else{
          foreach ($data_file_permintaan['wilayah_2_belum'] as $k => $v) { ?>
            <tr>
                <td align="center"><?php echo $k+1 ?></td>
                <td align=""><?php echo $v['nama_kota'] ?></td>
               
            </tr>
          <?php } 
      }?>
  </table>
</div>

<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten table">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th colspan="2">Asisten Administrasi Umum</th>
      </tr>   
      <tr class="tabel_header">
        <th width="45px">No</th>
        <th>OPD</th>
      
      </tr>
    </thead>
      <?php 
        if (count($data_file_permintaan['wilayah_3_belum'])==0) { ?>
            <tr>
                <td colspan="2">Semua OPD lingkup Asisten Administrasi Umum mengirimkan Semua</td>
            </tr>
        <?php }else{
          foreach ($data_file_permintaan['wilayah_3_belum'] as $k => $v) { ?>
            <tr>
                <td align="center"><?php echo $k+1 ?></td>
                <td align=""><?php echo $v['nama_kota'] ?></td>
               
            </tr>
          <?php } 
      }?>
  </table>
</div>


<div style="clear:both"></div>