


<style>
  .font_laporan{
    font-size:11px;
    font-family: 'calibri';
  }
  .table {
    
    border-collapse: collapse;
    width:100%;
}
.table td, th {
    border: 0.01em solid ;
    padding:3px;
}
/*.table thead{
    top: 0;
   position: sticky;
   color: black;
}*/
.bekukan_row{
    top: 0;
   position: sticky;
   color: black;
    background: white;
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

<div class="row">
     <div class="col-md-12 col-lg-12">
        <?php echo $this->session->flashdata('pesan') ?>
    </div>
</div>










<?php 
$kumpul_program = [];
$no_program = 0 ;
foreach ($program as $key => $value) { 
    $no_program++;
    // $pagu_program += $value->pagu;
    $kegiatan = $this->realisasi_akumulasi_model->get_kegiatan($id_instansi, $value->kode_rekening_program, $value->kode_bidang_urusan)->result(); ?>
  
    <?php 
    $no_kegiatan=0;
    $kumpul_kegiatan = [];
 
    foreach ($kegiatan as $key => $value_kegiatan) {
    
      $no_kegiatan++;
      $no_sub_kegiatan = 0;
        $sub_kegiatan = $this->realisasi_akumulasi_model->get_sub_kegiatan($id_instansi, $value_kegiatan->kode_rekening_kegiatan, $value_kegiatan->kode_rekening_program, $value_kegiatan->kode_bidang_urusan);
    ?>
    
     <?php 
     $kumpul_sub_kegiatan = [];





        foreach ($sub_kegiatan->result() as $key => $value_sk) { 
            $krsk = $value_sk->kode_rekening_sub_kegiatan;
            $tahap = $value_sk->kode_tahap;
            $target = $this->db->query("SELECT  bulan,target_fisik,target_keuangan,target_fisik_bulanan,target_keuangan_bulanan from target_apbd where tahun='$tahun' and kode_tahap='$tahap' and kode_rekening_sub_kegiatan='$krsk' and id_instansi='$id_instansi' order by bulan asc")->result_array();

      $kategori_sub_kegiatan = $value_sk->kategori;
             if($kategori_sub_kegiatan =='Unit Pelaksana'){
                $nama_sub_kegiatan = $value_sk->nama_sub_kegiatan."<br>[".$value_sk->jenis_sub_kegiatan.' - '.$value_sk->keterangan."]";
               
              }else{
                $nama_sub_kegiatan = $value_sk->nama_sub_kegiatan;
              }


               $data_kumpul_sub_kegiatan = [
              'no'=> $no_program.'.'.$no_kegiatan.'.'.$no_sub_kegiatan,
              'nama_sub_kegiatan'=> $nama_sub_kegiatan,
              'kode_tahap'=> $value_sk->kode_tahap,
              'pagu'=> $value_sk->pagu,
              'kode_rekening_sub_kegiatan'=> $value_sk->kode_rekening_sub_kegiatan,
              'target'=> $target,
            
             ];
             array_push($kumpul_sub_kegiatan, $data_kumpul_sub_kegiatan);
           
        } // end foreach ($sub_kegiatan->result() as $key => $value_sk) { 

         $data_kegiatan = [
           'no'=>  $no_program.'.'.$no_kegiatan,
          'kode_rekening_kegiatan'=> $value_kegiatan->kode_rekening_kegiatan,
          'nama_kegiatan'=> $value_kegiatan->nama_kegiatan,
        
          'data_sub_kegiatan' =>$kumpul_sub_kegiatan,
        ];
       array_push($kumpul_kegiatan, $data_kegiatan);
    } // end  foreach ($kegiatan as $key => $value_kegiatan) {




$data_program = [
   'no'=> $no_program,
  'kode_rekening_program'=> $value->kode_rekening_program,
  'nama_program'=> $value->nama_program,

  'data_kegiatan' =>$kumpul_kegiatan,
];

array_push($kumpul_program, $data_program);




} 

?> 
 

<div class="mb-3 card">
                                        <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Data Taget APBD Per Bulan
                                            <div class="btn-actions-pane-right">
                                                <div role="group" class="btn-group-sm nav btn-group">
                                                <!--     <a data-toggle="tab" href="#tab-eg1-0" class="btn-shadow btn btn-primary active show">Download Perbulan</a>
                                                    <a data-toggle="tab" href="#tab-eg1-1" class="btn-shadow btn btn-primary show">Download Akumulasi Bulan</a>
                                                    <a data-toggle="tab" href="#tab-eg1-1" class="btn-shadow btn btn-primary show">Download Tri Wulan</a>
                                                    <a data-toggle="tab" href="#tab-eg1-1" class="btn-shadow btn btn-primary show">Download Semesteran</a> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="tab-eg1-0" role="tabpanel">
                                                    






<?php error_reporting(0); ?>








<table class="font_laporan border table" border="1">
 <thead class="header">
    <tr >
    <th rowspan="4"  width="30px" class="">No</th>
    <th rowspan="3"  colspan="4" class="">Program, Kegiatan, Sub Kegiatan</th>
    <!-- <th rowspan="3" style="width:80px">Pagu Anggaran</th> -->
    <th colspan="24" class="">Fisik / Bulan </th>
    <th colspan="48"  class="">Keuangan / Bulan </th>
 
  </tr>
  <tr>
    
    <?php for ($i=0; $i <12 ; $i++) { ?>
        <th style="width:35px" colspan="2" rowspan="2"><?php echo $i+1 ?></th>
    <?php } ?>
    <?php for ($i=0; $i <12 ; $i++) { ?>
        <th style="width:35px" colspan="4"><?php echo $i+1 ?></th>
    <?php } ?>
  
  </tr>
  <tr>
     <?php for ($i=0; $i <12 ; $i++) { ?>
        <th style="width:35px" colspan="2">Bulanan</th>
        <th style="width:35px" colspan="2">Akumulasi</th>
    <?php } ?>
      <?php for ($i=0; $i <12 ; $i++) { ?>
    <?php } ?>
  </tr>
  <tr>

<th  style="width:85px" rowspan="2">Tahapan APBD</th>
    <th  style="width:85px">Kode Rekening</th>
    <th>Uraian</th>
    <th>Pagu</th>
      <?php for ($i=0; $i <12 ; $i++) { ?>
        <th style="width:35px">% Bulanan</th>
        <th style="width:35px">% Akumulasi</th>
    <?php } ?>
      <?php for ($i=0; $i <24 ; $i++) { ?>
        <th style="width:35px">Rp</th>
        <th style="width:35px">%</th>
    <?php } ?>
  </tr>

 </thead>
 <tbody>
     <?php  foreach ($kumpul_program as $k_program => $v_program) {  ?>
         <tr style="background: #e8daef">
            <th align="left"> <?php echo $v_program['no'] ?></th>
            <th>-</th>
            <th align="left"> <?php echo $v_program['kode_rekening_program'] ?></th>
            <th align="left" colspan="74"> <?php echo $v_program['nama_program'] ?></th>
        </tr>
        <?php 
        foreach ($v_program['data_kegiatan'] as $k_kegiatan => $v_kegiatan) { ?>
            <tr style="background: #d6eaf8 ">
                <th align="left"> <?php echo $v_kegiatan['no'] ?></th>
                <th>-</th>
                <th align="left"> <?php echo $v_kegiatan['kode_rekening_kegiatan'] ?></th>
                <th align="left" colspan="74"> <?php echo $v_kegiatan['nama_kegiatan'] ?></th>
            </tr>
        <?php 
         foreach ($v_kegiatan['data_sub_kegiatan'] as $k_ski => $v_sub_kegiatan) { ?>
          <tr>
            <td> <?php echo $v_sub_kegiatan['no'] ?></td>
            <td> <?php echo pilihan_nama_tahapan($v_sub_kegiatan['kode_tahap']) ?></td>
            <td> <?php echo $v_sub_kegiatan['kode_rekening_sub_kegiatan'] ?></td>
            <td> <?php echo $v_sub_kegiatan['nama_sub_kegiatan'] ?></td>
            <td> <?php echo number_format($v_sub_kegiatan['pagu']) ?></td>
                  <?php for ($i=0; $i < 12 ; $i++) { ?>
            <td> <?php echo empty($v_sub_kegiatan['target'][$i]['target_fisik_bulanan']) ? ' - ' : $v_sub_kegiatan['target'][$i]['target_fisik_bulanan'] ?></td>
            <td> <?php echo empty($v_sub_kegiatan['target'][$i]['target_fisik']) ? ' - ' : $v_sub_kegiatan['target'][$i]['target_fisik'] ?></td>
            <?php } ?>
            <?php for ($i=0; $i < 12 ; $i++) { ?>
            <td align="right"> <?php echo empty($v_sub_kegiatan['target'][$i]['target_keuangan_bulanan']) ? ' - ' : number_format($v_sub_kegiatan['target'][$i]['target_keuangan_bulanan']) ?></td>
            <td> 
                <?php
                    $persen_tk =  $v_sub_kegiatan['pagu'] == 0 ? 0 : ($v_sub_kegiatan['target'][$i]['target_keuangan_bulanan'] / $v_sub_kegiatan['pagu'] * 100 );
                    echo round($persen_tk,2);
                    ?>
            </td>
            <td align="right"> <?php echo empty($v_sub_kegiatan['target'][$i]['target_keuangan']) ? ' - ' : number_format($v_sub_kegiatan['target'][$i]['target_keuangan']) ?></td>
            <td> 
                <?php
                    $persen_tk =  $v_sub_kegiatan['pagu'] == 0 ? 0 : ($v_sub_kegiatan['target'][$i]['target_keuangan'] / $v_sub_kegiatan['pagu'] * 100 );
                    echo round($persen_tk,2);
                    ?>
            </td>
            <?php } ?>
            <?php } //end foreach ($v_kegiatan['data_sub_kegiatan'] as $k_ski => $v_sub_kegiatan) { 
        } // end foreach ($v_program['data_kegiatan'] as $k_kegiatan => $v_kegiatan) { 
    } // end  foreach ($kumpul_program as $k_program => $v_program) {  ?>
 </tbody>
<tfoot>
</tfoot>
</table>





                                                </div>
                                                <div class="tab-pane show" id="tab-eg1-1" role="tabpanel">
                                                    <p>Like Aldus PageMaker including versions of Lorem. It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                                                    essentially unchanged. </p>
                                                </div>
                                                <div class="tab-pane show" id="tab-eg1-2" role="tabpanel">
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                                    type specimen book. It has
                                                    survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>