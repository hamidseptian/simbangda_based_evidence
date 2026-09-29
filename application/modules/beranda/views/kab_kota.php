<hr>  
<div class="col-lg-12 col-md-6">
            <div class="card">

                <div class="card-header">
                    Realisasi Belanja Kabupaten Kota <?php echo $nama_tahap ?> tahun <?php echo $tahun_anggaran ?>
                </div>
                <div class="card-body">

                    <div class="tabs-animation">
                        <input type="hidden" class="form-control" id="id_instansi_grafik"
                            value="<?php echo id_instansi() ?>">
                        <div class="row">
                            <?php 
        $id_provinsi    = 13;

        $model_realisasi_gabungan          = $this->realisasi_gabungan_per_kab_kota;


  $no=0;
    $hitung_realisasi_bo =0;
  $hitung_realisasi_bm =0;
  $hitung_realisasi_btt =0;
  $hitung_realisasi_bt =0;

  $total_pagu_bo_semua = 0;
  $total_pagu_bm_semua = 0;
  $total_pagu_btt_semua = 0;
  $total_pagu_bt_semua = 0;

  $total_rk_bo_semua = 0;
  $total_rk_bm_semua = 0;
  $total_rk_btt_semua = 0;
  $total_rk_bt_semua = 0;

  $total_rf_bo_semua = 0;
  $total_rf_bm_semua = 0;
  $total_rf_btt_semua = 0;
  $total_rf_bt_semua = 0;
  $total_rf_semua = 0;

  $jumlah_kab_kota = 0;
        $list_kota = $this->db->query("SELECT ckk.id_kota, k.nama_kota, ckk.logo from config_kab_kota ckk 
                    left join kota k on ckk.id_kota = k.id_kota")->result();
                    foreach ($list_kota as $k => $v) { 

  $jumlah_kab_kota ++;
                          $id_kota = $v->id_kota;
    $pagu = $model_realisasi_gabungan->pagu_kota($id_kota, $tahap, $tahun);
    $pagu_bo = $pagu->total_pagu_bo=='' ? 0 : $pagu->total_pagu_bo;
    $pagu_bm = $pagu->total_pagu_bm=='' ? 0 : $pagu->total_pagu_bm;
    $pagu_btt = $pagu->total_pagu_btt=='' ? 0 : $pagu->total_pagu_btt;
    $pagu_bt = $pagu->total_pagu_bt=='' ? 0 : $pagu->total_pagu_bt;




    $total_pagu_bo_semua += $pagu_bo ;
    $total_pagu_bm_semua += $pagu_bm ;
    $total_pagu_btt_semua += $pagu_btt ;
    $total_pagu_bt_semua += $pagu_bt ;
    $pagu_total = $pagu_bo + $pagu_bm + $pagu_btt + $pagu_bt ;






              $realisasi_dipilih = $model_realisasi_gabungan->cek_realisasi_dipilih($tahap, $tahun, $id_kota)->row_array();

              if ($realisasi_dipilih['realisasikan_bo']>0) {
                $hitung_realisasi_bo +=1;
              }
              if ($realisasi_dipilih['realisasikan_bm']>0) {
                $hitung_realisasi_bm +=1;
              }
              if ($realisasi_dipilih['realisasikan_btt']>0) {
                $hitung_realisasi_btt +=1;
              }
              if ($realisasi_dipilih['realisasikan_bt']>0) {
                $hitung_realisasi_bt +=1;
              }


  $realisasi_bo = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bo')->row_array()['realisasi_bo'];
  $realisasi_bm = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bm')->row_array()['realisasi_bm'];
  $realisasi_btt = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_btt')->row_array()['realisasi_btt'];
  $realisasi_bt = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bt')->row_array()['realisasi_bt'];
  // fusuk
  $realisasi_bo_rf = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bo')->row_array()['realisasi_bo_rf'];
  $realisasi_bm_rf = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bm')->row_array()['realisasi_bm_rf'];
  $realisasi_btt_rf = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_btt')->row_array()['realisasi_btt_rf'];
  $realisasi_bt_rf = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_bt')->row_array()['realisasi_bt_rf'];
  $realisasi_rf_total = $model_realisasi_gabungan->total_realisasi_perjenis($bulan, $tahap,$tahun, $id_kota, 'realisasikan_rf_total')->row_array()['realisasi_rt_total'];


  $pembagi_bo  = $model_realisasi_gabungan->banyak_realisasikan($tahun , $tahap, $id_kota, 'realisasikan_bo')->row_array()['banyak_realisasikan_bo'];
  $pembagi_bm  = $model_realisasi_gabungan->banyak_realisasikan($tahun , $tahap, $id_kota, 'realisasikan_bm')->row_array()['banyak_realisasikan_bm'];
  $pembagi_btt  = $model_realisasi_gabungan->banyak_realisasikan($tahun , $tahap, $id_kota, 'realisasikan_btt')->row_array()['banyak_realisasikan_btt'];
  $pembagi_bt  = $model_realisasi_gabungan->banyak_realisasikan($tahun , $tahap, $id_kota, 'realisasikan_bt')->row_array()['banyak_realisasikan_bt'];

  $pembagi_rf_total = $model_realisasi_gabungan->total_skpd_kab_kota($id_kota)->num_rows();


  $jumlah_realisasi_bo = $realisasi_bo =='' ? 0 : $realisasi_bo;
  $jumlah_realisasi_bm = $realisasi_bm =='' ? 0 : $realisasi_bm;
  $jumlah_realisasi_btt = $realisasi_btt =='' ? 0 : $realisasi_btt;
  $jumlah_realisasi_bt = $realisasi_bt =='' ? 0 : $realisasi_bt;
  // fisik

@$ratarata_bo_rf = ($realisasi_bo_rf > 0 && $pagu_bo) ? ($realisasi_bo_rf / $pembagi_bo) : 0 ;
@$ratarata_bm_rf = ($realisasi_bm_rf > 0 && $pagu_bm) ? ($realisasi_bm_rf / $pembagi_bm) : 0 ;
@$ratarata_btt_rf = ($realisasi_btt_rf > 0 && $pagu_btt) ? ($realisasi_btt_rf / $pembagi_btt) : 0 ;
@$ratarata_bt_rf = ($realisasi_bt_rf > 0 && $pagu_bt) ? ($realisasi_bt_rf / $pembagi_bt) : 0 ;
@$ratarata_rf_total = ($realisasi_rf_total > 0 && $pagu_total) ? ($realisasi_rf_total  / $pembagi_rf_total) : 0 ;


  $jumlah_realisasi_bo_rf = $realisasi_bo_rf =='' ? 0 : round($ratarata_bo_rf, 2);
  $jumlah_realisasi_bm_rf = $realisasi_bm_rf =='' ? 0 : round($ratarata_bm_rf, 2);
  $jumlah_realisasi_btt_rf = $realisasi_btt_rf =='' ? 0 : round($ratarata_btt_rf, 2);
  $jumlah_realisasi_bt_rf = $realisasi_bt_rf =='' ? 0 : round($ratarata_bt_rf, 2);
  $jumlah_realisasi_rf_total = $realisasi_rf_total =='' ? 0 : round($ratarata_rf_total, 2);





$nilai_rk_kota_bo  =  $realisasi_dipilih['realisasikan_bo']==0 ? 0 : $jumlah_realisasi_bo;
               $nilai_rk_kota_bm  =  $realisasi_dipilih['realisasikan_bm']==0 ? 0 : $jumlah_realisasi_bm;
               $nilai_rk_kota_btt  =  $realisasi_dipilih['realisasikan_btt']==0 ? 0 : $jumlah_realisasi_btt;
               $nilai_rk_kota_bt  =  $realisasi_dipilih['realisasikan_bt']==0 ? 0 : $jumlah_realisasi_bt;

               // $nilai_rk_kota_total = $nilai_rk_kota_bo +$nilai_rk_kota_bm +$nilai_rk_kota_btt +$nilai_rk_kota_bt ;
               $nilai_rf_kota_total =  $jumlah_realisasi_rf_total;
               // $nilai_rf_kota_total = $jumlah_realisasi_bo_rf + $jumlah_realisasi_bm_rf + $jumlah_realisasi_btt_rf + $jumlah_realisasi_bt_rf;
               $pembagi_nilai_rf_total = $realisasi_dipilih['realisasikan_bo'] + $realisasi_dipilih['realisasikan_bm'] + $realisasi_dipilih['realisasikan_btt'] + $realisasi_dipilih['realisasikan_bt'];
               @$show_nilai_rf_kota_total = $nilai_rf_kota_total ;// $pembagi_nilai_rf_total ;
               // @$show_nilai_rf_kota_total = $nilai_rf_kota_total / $pembagi_nilai_rf_total ;


              @$persen_rk_kota_bo = ($nilai_rk_kota_bo / $pagu_bo ) * 100; 
              @$persen_rk_kota_bm = ($nilai_rk_kota_bm / $pagu_bm ) * 100; 
              @$persen_rk_kota_btt = ($nilai_rk_kota_btt / $pagu_btt ) * 100; 
              @$persen_rk_kota_bt = ($nilai_rk_kota_bt / $pagu_bt ) * 100; 

              $show_persen_rk_kota_bo = $persen_rk_kota_bo >0 ? $persen_rk_kota_bo : 0 ;
              $show_persen_rk_kota_bm = $persen_rk_kota_bm >0 ? $persen_rk_kota_bm : 0 ;
              $show_persen_rk_kota_btt = $persen_rk_kota_btt >0 ? $persen_rk_kota_btt : 0 ;
              $show_persen_rk_kota_bt = $persen_rk_kota_bt >0 ? $persen_rk_kota_bt : 0 ;


              // $show_persen_rk_kota_bo = $show_persen_rk_kota_bo == INF ? 0 : $show_persen_rk_kota_bo;
              // $show_persen_rk_kota_bm = $show_persen_rk_kota_bm == INF ? 0 : $show_persen_rk_kota_bm;
              // $show_persen_rk_kota_btt = $show_persen_rk_kota_btt == INF ? 0 : $show_persen_rk_kota_btt;
              // $show_persen_rk_kota_bt = $show_persen_rk_kota_bt == INF ? 0 : $show_persen_rk_kota_bt;
              $show_persen_rk_kota_bo = $show_persen_rk_kota_bo == INF ? 0 : $show_persen_rk_kota_bo;
              $show_persen_rk_kota_bm = $show_persen_rk_kota_bm == INF ? 0 : $show_persen_rk_kota_bm;
              $show_persen_rk_kota_btt = $show_persen_rk_kota_btt == INF ? 0 : $show_persen_rk_kota_btt;
              $show_persen_rk_kota_bt = $show_persen_rk_kota_bt == INF ? 0 : $show_persen_rk_kota_bt;
               @$persen_rk_kota_bo  =  $realisasi_dipilih['realisasikan_bo']==0 ? '-' : $show_persen_rk_kota_bo;
               @$persen_rk_kota_bm  =  $realisasi_dipilih['realisasikan_bm']==0 ? '-' : $show_persen_rk_kota_bm;
               @$persen_rk_kota_btt  =  $realisasi_dipilih['realisasikan_btt']==0 ? '-' : $show_persen_rk_kota_btt;
               @$persen_rk_kota_bt  =  $realisasi_dipilih['realisasikan_bt']==0 ? '-' : $show_persen_rk_kota_bt;
               @$persen_rk_kota_total  =  $nilai_rk_kota_total / $v->pagu_total; 



$total_rk_bo_semua += $jumlah_realisasi_bo;
$total_rk_bm_semua += $jumlah_realisasi_bm;
$total_rk_btt_semua += $jumlah_realisasi_btt;
$total_rk_bt_semua += $jumlah_realisasi_bt;

$total_rf_bo_semua += $jumlah_realisasi_bo_rf;
$total_rf_bm_semua += $jumlah_realisasi_bm_rf;
$total_rf_btt_semua += $jumlah_realisasi_btt_rf;
$total_rf_bt_semua += $jumlah_realisasi_bt_rf;
$total_rf_semua += $jumlah_realisasi_rf_total ;



  $tampil_nilai_rk_kota_bo  =  $realisasi_dipilih['realisasikan_bo']==0 ? '-' : number_format($jumlah_realisasi_bo);
  $tampil_nilai_rk_kota_bm  =  $realisasi_dipilih['realisasikan_bm']==0 ? '-' : number_format($jumlah_realisasi_bm);
  $tampil_nilai_rk_kota_btt  =  $realisasi_dipilih['realisasikan_btt']==0 ? '-' : number_format($jumlah_realisasi_btt);
  $tampil_nilai_rk_kota_bt  =  $realisasi_dipilih['realisasikan_bt']==0 ? '-' : number_format($jumlah_realisasi_bt);
  // fisik
  $tampil_nilai_rk_kota_bo_rf  =  $realisasi_dipilih['realisasikan_bo']==0 ? '-' : $jumlah_realisasi_bo_rf;
  $tampil_nilai_rk_kota_bm_rf  =  $realisasi_dipilih['realisasikan_bm']==0 ? '-' : $jumlah_realisasi_bm_rf;
  $tampil_nilai_rk_kota_btt_rf  =  $realisasi_dipilih['realisasikan_btt']==0 ? '-' : $jumlah_realisasi_btt_rf;
  $tampil_nilai_rk_kota_bt_rf  =  $realisasi_dipilih['realisasikan_bt']==0 ? '-' : $jumlah_realisasi_bt_rf;

  $banyak_skpd_kab_kota = $this->db->query("SELECT * from master_instansi_kab_kota where id_kota='$id_kota'")->num_rows();
  @$persen_rf_total = $nilai_rf_kota_total /  $banyak_skpd_kab_kota ;
  // $nilai_rf_kota_ratarata = $persen_rf_total > 0 ? $persen_rf_total : 0 ;

  $pembagi_fisik_bo_total = $pagu_bo == 0 ? 0 : 1;
  $pembagi_fisik_bm_total = $pagu_bm == 0 ? 0 : 1;
  $pembagi_fisik_btt_total = $pagu_btt == 0 ? 0 : 1;
  $pembagi_fisik_bt_total = $pagu_bt == 0 ? 0 : 1;

  $pembagi_fisik_total = $pembagi_fisik_bo_total + $pembagi_fisik_bm_total + $pembagi_fisik_btt_total + $pembagi_fisik_bt_total;
  $nilai_rf_total = $jumlah_realisasi_bo_rf + $jumlah_realisasi_bm_rf + $jumlah_realisasi_btt_rf + $jumlah_realisasi_bt_rf;
  @$persen_rf_total = $nilai_rf_total /  $pembagi_fisik_total ;
  $nilai_rf_kota_ratarata =  $realisasi_rf_total > 0 ? $jumlah_realisasi_rf_total : 0 ;


  $nilai_rk_kota_total = $nilai_rk_kota_bo +$nilai_rk_kota_bm +$nilai_rk_kota_btt +$nilai_rk_kota_bt ; 
  @$persen_rk_instansi_total  =  $nilai_rk_instansi_total / $pagu_total; 
  @$persen_rk_total = (($nilai_rk_kota_total / $pagu_total) * 100);
  $show_persen_rk_total = $persen_rk_total >0 ? $persen_rk_total : 0;



  $banyak_skpd_kab_kota = $this->db->query("SELECT * from master_instansi_kab_kota where id_kota='$id_kota'")->num_rows();
  @$persen_rf_total = $nilai_rf_kota_total /  $banyak_skpd_kab_kota ;
  // $nilai_rf_kota_ratarata = $persen_rf_total > 0 ? $persen_rf_total : 0 ;

  $pembagi_fisik_bo_total = $pagu_bo == 0 ? 0 : 1;
  $pembagi_fisik_bm_total = $pagu_bm == 0 ? 0 : 1;
  $pembagi_fisik_btt_total = $pagu_btt == 0 ? 0 : 1;
  $pembagi_fisik_bt_total = $pagu_bt == 0 ? 0 : 1;

  $pembagi_fisik_total = $pembagi_fisik_bo_total + $pembagi_fisik_bm_total + $pembagi_fisik_btt_total + $pembagi_fisik_bt_total;
  $nilai_rf_total = $jumlah_realisasi_bo_rf + $jumlah_realisasi_bm_rf + $jumlah_realisasi_btt_rf + $jumlah_realisasi_bt_rf;
  @$persen_rf_total = $nilai_rf_total /  $pembagi_fisik_total ;
  $nilai_rf_kota_ratarata =  $realisasi_rf_total > 0 ? $jumlah_realisasi_rf_total : 0 ;


  $nilai_rk_kota_total = $nilai_rk_kota_bo +$nilai_rk_kota_bm +$nilai_rk_kota_btt +$nilai_rk_kota_bt ; 
  @$persen_rk_instansi_total  =  $nilai_rk_instansi_total / $pagu_total; 
  @$persen_rk_total = (($nilai_rk_kota_total / $pagu_total) * 100);
  $show_persen_rk_total = $persen_rk_total >0 ? $persen_rk_total : 0;

    ?>

                            <div class="col-lg-3 col-xl-3">
                                <div class="main-card mb-3 card ">
                                    <div class="card-body border border-secondary">
                                        <div class="row">
                                            <div class="col-md-4"><img
                                                    src="<?php echo base_url('assets/logo_kab_kota/'.$v->logo) ?>"
                                                    width="100%" height="130px"></div>
                                            <div class="col-md-8">
                                                <h5 class="card-title"><?php echo $v->nama_kota ?></h5>
                                                <table class="table">
                                                    <tr>
                                                        <td>Pagu</td>
                                                        <td>:</td>
                                                        <td><?php echo number_format($pagu_total) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Realisasi Keuangan</td>
                                                        <td>:</td>
                                                        <td><?php echo number_format($nilai_rk_kota_total) ?>
                                                            <br>[<?php echo round($show_persen_rk_total,2) ?>%]
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Realisasi Fisik</td>
                                                        <td>:</td>
                                                        <td><?php echo round($nilai_rf_kota_ratarata,2) ?>%</td>
                                                    </tr>
                                                </table>
                                          



                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                            <?php } 

        $show_total_rk_bo_semua =  $total_pagu_bo_semua > 0 ? $total_rk_bo_semua : 0;
    $show_total_rk_bm_semua =  $total_pagu_bm_semua > 0 ? $total_rk_bm_semua : 0;
    $show_total_rk_btt_semua =  $total_pagu_btt_semua > 0 ? $total_rk_btt_semua : 0;
    $show_total_rk_bt_semua =  $total_pagu_bt_semua > 0 ? $total_rk_bt_semua : 0;


    $total_pagu_semuanya = $total_pagu_bo_semua + $total_pagu_bm_semua + $total_pagu_btt_semua + $total_pagu_bt_semua;
    $total_rk_semuanya = $total_rk_bo_semua + $total_rk_bm_semua + $total_rk_btt_semua + $total_rk_bt_semua;


    @$persen_total_rk_bo_semua = ($total_rk_bo_semua / $total_pagu_bo_semua) * 100 ;
    @$persen_total_rk_bm_semua = ($total_rk_bm_semua / $total_pagu_bm_semua) * 100 ;
    @$persen_total_rk_btt_semua = ($total_rk_btt_semua / $total_pagu_btt_semua) * 100 ;
    @$persen_total_rk_bt_semua = ($total_rk_bt_semua / $total_pagu_bt_semua) * 100 ;
    @$persen_total_rk_semuanya = ($total_rk_semuanya / $total_pagu_semuanya) * 100 ;

    $show_persen_rk_bo_semua =  $total_pagu_bo_semua > 0 ? $persen_total_rk_bo_semua : 0;
    $show_persen_rk_bm_semua =  $total_pagu_bm_semua > 0 ? $persen_total_rk_bm_semua : 0;
    $show_persen_rk_btt_semua =  $total_pagu_btt_semua > 0 ? $persen_total_rk_btt_semua : 0;
    $show_persen_rk_bt_semua =  $total_pagu_bt_semua > 0 ? $persen_total_rk_bt_semua : 0;
    $show_persen_rk_semuanya =  $total_pagu_semuanya > 0 ? $persen_total_rk_semuanya : 0;


@$show_total_bo_rf_semua = $total_rf_bo_semua / $hitung_realisasi_bo ; 
@$show_total_bm_rf_semua = $total_rf_bm_semua / $hitung_realisasi_bm ; 
@$show_total_btt_rf_semua = $total_rf_btt_semua / $hitung_realisasi_btt ; 
@$show_total_bt_rf_semua = $total_rf_bt_semua / $hitung_realisasi_bt ; 

$total_rf_semuannya = $show_total_bo_rf_semua + $show_total_bm_rf_semua + $show_total_btt_rf_semua + $show_total_bt_rf_semua;
$show_total_rf_semuanya = $total_rf_semua / $jumlah_kab_kota;



?>

                            <div class="col-lg-3 col-xl-3">
                                <div class="main-card mb-3 card ">
                                    <div class="card-body border border-secondary">
                                        <div class="row">
                                            <div class="col-md-4"><img
                                                    src="<?php echo base_url('assets/sbe/image/logo.png') ?>"
                                                    width="100%" height="130px"></div>
                                            <div class="col-md-8">
                                                <h5 class="card-title">Total</h5>
                                                <table class="table">
                                                    <tr>
                                                        <td>Pagu</td>
                                                        <td>:</td>
                                                        <td><?php echo number_format($total_pagu_semuanya); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Realisasi Keuangan</td>
                                                        <td>:</td>
                                                        <td><?php echo number_format($total_rk_semuanya) ?>
                                                            <br>[<?php echo round($show_persen_rk_semuanya,2); ?>%]
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Realisasi Fisik</td>
                                                        <td>:</td>
                                                        <td><?php echo round($show_total_rf_semuanya,2) ?>%</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>

