<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title; ?> - <?php echo $this->template->settings('app_name'); ?></title>
    <!-- Favico -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/sbe/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Alfikri" />
    <meta name="description" content="SIMBANGDA Based Evidence, simbangda based evidence, SIMBANGDA berbasis pembuktian, simbangda berbasis pembuktian, SIMBANGDA SUMBAR, simbangda sumbar, Sistem Informasi Manajemen Pembangunan Daerah, Sistem Informasi Manajemen Pembangunan Daerah Sumbar, Sumatera Barat" />
    <meta name="keywords" content="Simbangda based evidence, Sistem Informasi Manajemen Pembangunan Daerah, simbangda berbasis pembuktian, simbangda sumbar, Sumbar, Sumatera Barat, Pemprov Sumbar, Pemerintah Provinsi Sumatera Barat, Alfikri, Al, Fikri, alfikri, alfikri, alfikridotname" />
    <meta name="msapplication-tap-highlight" content="no">
    <!-- Bootstrap 4.3.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Architectui HTML FREE -->
    <link href="<?php echo base_url() ?>assets/architectui-html-pro/main.87c0748b313a1dda75f5.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>assets/fontawesome/css/all.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>assets/sweetalert/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/sweetalert/dist/sweetalert2.min.css">
    <?php echo $extra_css; ?>
</head>


<style>
  .font_laporan{
    font-size:8px;
    font-family: 'arial';
  }
  table {
    
    border-collapse: collapse;
    width:100%;
}
table td, th {
    padding:3px;
    border: 1px solid ;
}
table thead {
    position: sticky;
    top:0;
}





  .row_fixed{
     position: sticky;
    left:0;
    background:  #ebf5fb ;

  }

  .header_fixed{
    border: 1px solid ;
    border-color: black;
     position: sticky;
    left:0;
    background:  #ebf5fb ;
  }

  .header{
    font-weight:bold;
    text-align : center;

  }
  .ssssss{
    overflow-x: scroll;

  }

</style>
<div style="margin:15px">

  <div class="row">
    <div class="col-md-12">
      
      <div class="card" >
        <div class="card-body" >
        
<table class="font_laporan border">
 <thead class="header header_fixed" >
    <tr>
    <th rowspan="4"  width="20px">No</th>
    <th rowspan="4">SKPD</th>
    <th colspan="16"> Pagu</th>
    <th colspan="22"> Realisasi</th>
    <th rowspan="4">Last Update</th>
   
  </tr>
  <tr>
    <th colspan="5">Belanja Operasi</th>
    <th colspan="6">Belanja Modal</th>
    <th>Belanja Tidak Terduga</th>
    <th colspan="3">Belanja Transfer</th>
    <th rowspan="3">Total</th>
    <th colspan="21">Keu</th>
    <th rowspan="3">Fisik</th>
  </tr>
  <tr>
    <th rowspan="2">Belanja Pegawai</th>
    <th rowspan="2">Belanja Barang Jasa</th>
    <th rowspan="2">Belanja Subsidi</th>
    <th rowspan="2">Belanja Hibah </th>
    <th rowspan="2">Belanja Operasi total</th>
    <th rowspan="2">Belanja Modal Tanah</th>
    <th rowspan="2">Belanja Modal Peralatan Dan Mesin</th>
    <th rowspan="2">Belanja Modal Gedung dan Bangunan</th>
    <th rowspan="2">Belanja Modal Jalan, Jaringan, dan Irigasi</th>
    <th rowspan="2">Belanja Modal dan Aset Tetap Lainnya </th>
    <th rowspan="2">Belaja Modal total</th>
    <th rowspan="2">Belanja Tidak Terduga</th>
    <th rowspan="2">Belanja Bagi Hasil</th>
    <th rowspan="2">Belanja Bantuan Keuangan </th>
    <th rowspan="2">Belanja Transfer  total</th>
    <th colspan="6">Belanja Operasi</th>
    <th colspan="7">Belanja Modal</th>
    <th colspan="2">Belanja Tidak Terduga</th>
    <th colspan="4">Belanja Transfer</th>
    <th colspan="2">Total</th>

  </tr>
  <tr>
    <th>Bo 1</th>
    <th>Bo 2</th>
    <th>Bo 3</th>
    <th>Bo 4</th>
    <th>Bo total</th>
    <th>Bo total %</th>
    <th>BM 1</th>
    <th>BM 2</th>
    <th>BM 3</th>
    <th>BM 4</th>
    <th>BM 5</th>
    <th>BM total</th>
    <th>BM total %</th>
    <th>BTT</th>
    <th>BTT %</th>
    <th>BT 1</th>
    <th>BT 2</th>
    <th>BT  total</th>
    <th>BT  total %</th>
    <th>Rp</th>
    <th>%</th>
  
  </tr>
  <tr>
    <th>1</th>
    <th>2</th>
    <th>3</th>
    <th>4</th>
    <th>5</th>
    <th>6</th>
    <th>7</th>
    <th>8</th>
    <th>9</th>
    <th>10</th>
    <th>11</th>
    <th>12</th>
    <th>13</th>
    <th>14</th>
    <th>15</th>
    <th>16</th>
    <th>17</th>
    <th>18</th>
    <th>19</th>
    <th>20</th>
    <th>21</th>
    <th>22</th>
    <th>23</th>
    <th>24</th>
    <th>25</th>
    <th>26</th>
    <th>27</th>
    <th>28</th>
    <th>29</th>
    <th>30</th>
    <th>31</th>
    <th>32</th>
    <th>33</th>
    <th>34</th>
    <th>35</th>
    <th>36</th>
    <th>37</th>
    <th>38</th>
    <th>39</th>
    <th>40</th>
    <th>41</th>
  </tr>

 </thead>
 <tbody>
   <?php 
      $total_pagu_bo_bp=0;
      $total_pagu_bo_bbj=0;
      $total_pagu_bo_bs=0;
      $total_pagu_bo_bh=0;
      $total_pagu_bm_bmt=0;
      $total_pagu_bm_bmpm=0;
      $total_pagu_bm_bmgb=0;
      $total_pagu_bm_bmjji=0;
      $total_pagu_bm_bmatl=0;
      $total_pagu_btt=0;
      $total_pagu_bt_bbh=0;
      $total_pagu_bt_bbk=0;

      $total_pagu_bo_semua = 0 ; 
      $total_pagu_bm_semua = 0 ; 
      $total_pagu_btt_semua = 0 ; 
      $total_pagu_bt_semua = 0 ; 
      $total_pagu_total_semua = 0 ; 
      $cap_arr = $kategori =='Akumulasi' ? 'akumulasi' : 'bulanan';



      $total_rp_realisasi_keuangan_akumulasi_bo_bp =0;
      $total_rp_realisasi_keuangan_akumulasi_bo_bbj =0;
      $total_rp_realisasi_keuangan_akumulasi_bo_bs =0;
      $total_rp_realisasi_keuangan_akumulasi_bo_bh =0;
      $total_rp_realisasi_keuangan_akumulasi_bm_bmt =0;
      $total_rp_realisasi_keuangan_akumulasi_bm_bmpm =0;
      $total_rp_realisasi_keuangan_akumulasi_bm_bmgb =0;
      $total_rp_realisasi_keuangan_akumulasi_bm_bmjji =0;
      $total_rp_realisasi_keuangan_akumulasi_bm_bmatl =0;
      $total_rp_realisasi_keuangan_akumulasi_btt =0;
      $total_rp_realisasi_keuangan_akumulasi_bt_bbh =0;
      $total_rp_realisasi_keuangan_akumulasi_bt_bbk =0;

      $total_realisasi_bo_akumulasi_total = 0;
      $total_realisasi_bm_akumulasi_total = 0;
      $total_realisasi_btt_akumulasi_total = 0;
      $total_realisasi_bt_akumulasi_total = 0;
      $total_realisasi_total_akumulasi_total = 0;

      $total_rp_realisasi_keuangan_bulanan_bo_bp =0;
      $total_rp_realisasi_keuangan_bulanan_bo_bbj =0;
      $total_rp_realisasi_keuangan_bulanan_bo_bs =0;
      $total_rp_realisasi_keuangan_bulanan_bo_bh =0;
      $total_rp_realisasi_keuangan_bulanan_bm_bmt =0;
      $total_rp_realisasi_keuangan_bulanan_bm_bmpm =0;
      $total_rp_realisasi_keuangan_bulanan_bm_bmgb =0;
      $total_rp_realisasi_keuangan_bulanan_bm_bmjji =0;
      $total_rp_realisasi_keuangan_bulanan_bm_bmatl =0;
      $total_rp_realisasi_keuangan_bulanan_btt =0;
      $total_rp_realisasi_keuangan_bulanan_bt_bbh =0;
      $total_rp_realisasi_keuangan_bulanan_bt_bbk =0;

      $total_realisasi_bo_bulanan_total = 0;
      $total_realisasi_bm_bulanan_total = 0;
      $total_realisasi_btt_bulanan_total = 0;
      $total_realisasi_bt_bulanan_total = 0;
      $total_realisasi_total_bulanan_total = 0;


      $total_fisik_akumulasi = 0;
      $total_fisik_bulanan = 0;

foreach ($skpd as $key => $v) { 

    $total_pagu_bo = $v['pagu_bo_bp'] + $v['pagu_bo_bbj'] + $v['pagu_bo_bs'] + $v['pagu_bo_bh'];
    $total_pagu_bm = $v['pagu_bm_bmt'] + $v['pagu_bm_bmpm'] + $v['pagu_bm_bmgb'] + $v['pagu_bm_bmjji'] + $v['pagu_bm_bmatl'];
    $total_pagu_btt = $v['pagu_btt'];
    $total_pagu_bt = $v['pagu_bt_bbh'] + $v['pagu_bt_bbk'];
    $total_pagu_total = $total_pagu_bo + $total_pagu_bm + $total_pagu_btt + $total_pagu_bt;


    $total_pagu_bo_semua +=$total_pagu_bo;
$total_pagu_bm_semua +=$total_pagu_bm;
$total_pagu_btt_semua +=$total_pagu_btt;
$total_pagu_bt_semua +=$total_pagu_bt;
$total_pagu_total_semua +=$total_pagu_total;


      $total_pagu_bo_bp += $v['pagu_bo_bp'];
      $total_pagu_bo_bbj += $v['pagu_bo_bbj'];
      $total_pagu_bo_bs += $v['pagu_bo_bs'];
      $total_pagu_bo_bh += $v['pagu_bo_bh'];
      $total_pagu_bm_bmt += $v['pagu_bm_bmt'];
      $total_pagu_bm_bmpm += $v['pagu_bm_bmpm'];
      $total_pagu_bm_bmgb += $v['pagu_bm_bmgb'];
      $total_pagu_bm_bmjji += $v['pagu_bm_bmjji'];
      $total_pagu_bm_bmatl += $v['pagu_bm_bmatl'];
      $total_pagu_btt += $v['pagu_btt'];
      $total_pagu_bt_bbh += $v['pagu_bt_bbh'];
      $total_pagu_bt_bbk += $v['pagu_bt_bbk'];





    $total_realisasi_bo = $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bp'] + $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bbj'] + $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bs'] + $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bh'];
    $total_realisasi_bm = $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmt'] + $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmpm'] + $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmgb'] + $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmjji'] + $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmatl'];
    $total_realisasi_btt = $v['rp_realisasi_keuangan_'.$cap_arr.'_btt'];
    $total_realisasi_bt = $v['rp_realisasi_keuangan_'.$cap_arr.'_bt_bbh'] + $v['rp_realisasi_keuangan_'.$cap_arr.'_bt_bbk'];
    $total_realisasi_total = $total_realisasi_bo + $total_realisasi_bm + $total_realisasi_btt + $total_realisasi_bt;



      $persen_realisasi_bo = $total_pagu_bo == 0 ? 0 : ($total_realisasi_bo / $total_pagu_bo) * 100 ;
      $persen_realisasi_bm = $total_pagu_bm == 0 ? 0 : ($total_realisasi_bm / $total_pagu_bm) * 100 ;
      $persen_realisasi_btt = $total_pagu_btt == 0 ? 0 : ($total_realisasi_btt / $total_pagu_btt) * 100 ;
      $persen_realisasi_bt = $total_pagu_bt == 0 ? 0 : ($total_realisasi_bt / $total_pagu_bt) * 100 ;
      $persen_realisasi_total = $total_pagu_total == 0 ? 0 : ($total_realisasi_total / $total_pagu_total) * 100 ;


      if ($kategori =='Akumulasi') {   
        $total_rp_realisasi_keuangan_akumulasi_bo_bp += $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bp'];
        $total_rp_realisasi_keuangan_akumulasi_bo_bbj += $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bbj'];
        $total_rp_realisasi_keuangan_akumulasi_bo_bs += $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bs'];
        $total_rp_realisasi_keuangan_akumulasi_bo_bh += $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bh'];
        $total_rp_realisasi_keuangan_akumulasi_bm_bmt += $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmt'];
        $total_rp_realisasi_keuangan_akumulasi_bm_bmpm += $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmpm'];
        $total_rp_realisasi_keuangan_akumulasi_bm_bmgb += $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmgb'];
        $total_rp_realisasi_keuangan_akumulasi_bm_bmjji += $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmjji'];
        $total_rp_realisasi_keuangan_akumulasi_bm_bmatl += $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmatl'];
        $total_rp_realisasi_keuangan_akumulasi_btt += $v['rp_realisasi_keuangan_'.$cap_arr.'_btt'];
        $total_rp_realisasi_keuangan_akumulasi_bt_bbh += $v['rp_realisasi_keuangan_'.$cap_arr.'_bt_bbh'];
        $total_rp_realisasi_keuangan_akumulasi_bt_bbk += $v['rp_realisasi_keuangan_'.$cap_arr.'_bt_bbk'];

         $total_realisasi_bo_akumulasi_total += $total_realisasi_bo;
        $total_realisasi_bm_akumulasi_total += $total_realisasi_bm;
        $total_realisasi_btt_akumulasi_total += $total_realisasi_btt;
        $total_realisasi_bt_akumulasi_total += $total_realisasi_bt;
        $total_realisasi_total_akumulasi_total += $total_realisasi_total;
        $total_fisik_akumulasi  += $v['realisasi_fisik'];
      }else{
        $total_fisik_bulanan  += $v['realisasi_fisik'];
        $total_rp_realisasi_keuangan_bulanan_bo_bp += $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bp'];
        $total_rp_realisasi_keuangan_bulanan_bo_bbj += $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bbj'];
        $total_rp_realisasi_keuangan_bulanan_bo_bs += $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bs'];
        $total_rp_realisasi_keuangan_bulanan_bo_bh += $v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bh'];
        $total_rp_realisasi_keuangan_bulanan_bm_bmt += $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmt'];
        $total_rp_realisasi_keuangan_bulanan_bm_bmpm += $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmpm'];
        $total_rp_realisasi_keuangan_bulanan_bm_bmgb += $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmgb'];
        $total_rp_realisasi_keuangan_bulanan_bm_bmjji += $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmjji'];
        $total_rp_realisasi_keuangan_bulanan_bm_bmatl += $v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmatl'];
        $total_rp_realisasi_keuangan_bulanan_btt += $v['rp_realisasi_keuangan_'.$cap_arr.'_btt'];
        $total_rp_realisasi_keuangan_bulanan_bt_bbh += $v['rp_realisasi_keuangan_'.$cap_arr.'_bt_bbh'];
        $total_rp_realisasi_keuangan_bulanan_bt_bbk += $v['rp_realisasi_keuangan_'.$cap_arr.'_bt_bbk'];

         $total_realisasi_bo_bulanan_total += $total_realisasi_bo;
        $total_realisasi_bm_bulanan_total += $total_realisasi_bm;
        $total_realisasi_btt_bulanan_total += $total_realisasi_btt;
        $total_realisasi_bt_bulanan_total += $total_realisasi_bt;
        $total_realisasi_total_bulanan_total += $total_realisasi_total;
      }

    ?>
     <tr>
       <td><?php echo $key+1 ?></td>
       <td class="row_fixed"><?php echo $v['nama_instansi'] ?></td>
       <td align="right"><?php echo number_format($v['pagu_bo_bp']) ?></td>
       <td align="right"><?php echo number_format($v['pagu_bo_bbj']) ?></td>
       <td align="right"><?php echo number_format($v['pagu_bo_bs']) ?></td>
       <td align="right"><?php echo number_format($v['pagu_bo_bh']) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bo) ?></td>
       <td align="right"><?php echo number_format($v['pagu_bm_bmt']) ?></td>
       <td align="right"><?php echo number_format($v['pagu_bm_bmpm']) ?></td>
       <td align="right"><?php echo number_format($v['pagu_bm_bmgb']) ?></td>
       <td align="right"><?php echo number_format($v['pagu_bm_bmjji']) ?></td>
       <td align="right"><?php echo number_format($v['pagu_bm_bmatl']) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bm) ?></td>
       <td align="right"><?php echo number_format($v['pagu_btt']) ?></td>
       <td align="right"><?php echo number_format($v['pagu_bt_bbh']) ?></td>
       <td align="right"><?php echo number_format($v['pagu_bt_bbk']) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bt) ?></td>
       <td align="right"><?php echo number_format($total_pagu_total) ?></td>


       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bp']) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bbj']) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bs']) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bo_bh']) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_bo) ?></td>
       <td align="right"><?php echo round($persen_realisasi_bo,2) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmt']) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmpm']) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmgb']) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmjji']) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bm_bmatl']) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_bm) ?></td>
       <td align="right"><?php echo round($persen_realisasi_bm,2) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_btt']) ?></td>
       <td align="right"><?php echo round($persen_realisasi_btt,2) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bt_bbh']) ?></td>
       <td align="right"><?php echo number_format($v['rp_realisasi_keuangan_'.$cap_arr.'_bt_bbk']) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_bt) ?></td>
       <td align="right"><?php echo round($persen_realisasi_bt,2) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_total) ?></td>
       <td align="right"><?php echo round($persen_realisasi_total,2) ?></td>
       <td align="right"><?php echo $v['realisasi_fisik'] ?></td>
      
       <td><?php echo $v['last_update'] ?></td>
     </tr>
   <?php } ?>
 </tbody>
 <tfoot>
    <tr>
       <td colspan="2" align="center">Total</td>
       <td align="right"><?php echo number_format($total_pagu_bo_bp) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bo_bbj) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bo_bs) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bo_bh) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bo_semua) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bm_bmt) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bm_bmpm) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bm_bmgb) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bm_bmjji) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bm_bmatl) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bm_semua) ?></td>
       <td align="right"><?php echo number_format($total_pagu_btt_semua) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bt_bbh) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bt_bbk) ?></td>
       <td align="right"><?php echo number_format($total_pagu_bt_semua) ?></td>
       <td align="right"><?php echo number_format($total_pagu_total_semua) ?></td>

      <?php if ($kategori=='Akumulasi') { 

      $persen_realisasi_bo_semua = $total_pagu_bo_semua == 0 ? 0 : ($total_realisasi_bo_akumulasi_total / $total_pagu_bo_semua) * 100 ;
      $persen_realisasi_bm_semua = $total_pagu_bm_semua == 0 ? 0 : ($total_realisasi_bm_akumulasi_total / $total_pagu_bm_semua) * 100 ;
      $persen_realisasi_btt_semua = $total_pagu_btt_semua == 0 ? 0 : ($total_realisasi_btt / $total_pagu_btt_semua) * 100 ;
      $persen_realisasi_bt_semua = $total_pagu_bt_semua == 0 ? 0 : ($total_realisasi_bt_akumulasi_total / $total_pagu_bt_semua) * 100 ;
      $persen_realisasi_total_semua = $total_pagu_total_semua == 0 ? 0 : ($total_realisasi_total_akumulasi_total / $total_pagu_total_semua) * 100 ;

      $fisik_akumulasi = $total_fisik_akumulasi  / count($skpd);

      ?>
           <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bo_bp) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bo_bbj) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bo_bs) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bo_bh) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_bo_akumulasi_total) ?></td>
       <td align="right"><?php echo round($persen_realisasi_bo_semua,2) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bm_bmt) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bm_bmpm) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bm_bmgb) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bm_bmjji) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bm_bmatl) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_bm_akumulasi_total) ?></td>
       <td align="right"><?php echo round($persen_realisasi_bm_semua,2) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_btt) ?></td>
       <td align="right"><?php echo round($persen_realisasi_btt_semua,2) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bt_bbh) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_akumulasi_bt_bbk) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_bt_akumulasi_total) ?></td>
       <td align="right"><?php echo round($persen_realisasi_bt_semua,2) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_total_akumulasi_total) ?></td>
       <td align="right"><?php echo round($persen_realisasi_total_semua,2) ?></td>
       <td> <?php echo  round($fisik_akumulasi,2) ?>   </td>
          
      <?php }else{ 

      $persen_realisasi_bo_semua = $total_pagu_bo_semua == 0 ? 0 : ($total_realisasi_bo_bulanan_total / $total_pagu_bo_semua) * 100 ;
      $persen_realisasi_bm_semua = $total_pagu_bm_semua == 0 ? 0 : ($total_realisasi_bm_bulanan_total / $total_pagu_bm_semua) * 100 ;
      $persen_realisasi_btt_semua = $total_pagu_btt_semua == 0 ? 0 : ($total_realisasi_btt / $total_pagu_btt_semua) * 100 ;
      $persen_realisasi_bt_semua = $total_pagu_bt_semua == 0 ? 0 : ($total_realisasi_bt_bulanan_total / $total_pagu_bt_semua) * 100 ;
      $persen_realisasi_total_semua = $total_pagu_total_semua == 0 ? 0 : ($total_realisasi_total_bulanan_total / $total_pagu_total_semua) * 100 ;

      $fisik_bulanan = $total_fisik_bulanan  / count($skpd);

      ?>
           <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bo_bp) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bo_bbj) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bo_bs) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bo_bh) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_bo_bulanan_total) ?></td>
       <td align="right"><?php echo round($persen_realisasi_bo_semua,2) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bm_bmt) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bm_bmpm) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bm_bmgb) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bm_bmjji) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bm_bmatl) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_bm_bulanan_total) ?></td>
       <td align="right"><?php echo round($persen_realisasi_bm_semua,2) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_btt) ?></td>
       <td align="right"><?php echo round($persen_realisasi_btt_semua,2) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bt_bbh) ?></td>
       <td align="right"><?php echo number_format($total_rp_realisasi_keuangan_bulanan_bt_bbk) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_bt_bulanan_total) ?></td>
       <td align="right"><?php echo round($persen_realisasi_bt_semua,2) ?></td>
       <td align="right"><?php echo number_format($total_realisasi_total_bulanan_total) ?></td>
       <td align="right"><?php echo round($persen_realisasi_total_semua,2) ?></td>
       <td> <?php echo  round($fisik_bulanan,2) ?>   </td>

      <?php } ?>

      
       <td> - </td>
     </tr>


 </tfoot>
</table>




        </div>
      </div>                          
    </div>
          



  </div>
   

</div>
