<?php
$kumpul_program = [];
$jumlah_program =0;
$jumlah_kegiatan =0;
$jumlah_sub_kegiatan =0;
$total_pagu =0;


$kumpul_insert_ski = [];
$kumpul_insert_ask = [];
$kumpul_insert_sd = [];
foreach ($program as $k_program => $v_program) {
    $jumlah_program++;
    $kode_program = $v_program['kode_program'];
    $no_program = $k_program + 1;
    $q_kegiatan = $this->db->query("SELECT kode_kegiatan, nama_kegiatan FROM export_import_data_apbd_mentah WHERE id_instansi='$id_instansi' AND id_export_import_sipd ='$id_import' AND kode_program ='$kode_program' GROUP BY kode_kegiatan ORDER BY kode_kegiatan ASC")->result_array();
    $kumpul_kegiatan = [];
    $pagu_program =0;
    foreach ($q_kegiatan as $k_kegiatan => $v_kegiatan) {
        $jumlah_kegiatan++;
        $no_kegiatan = $k_kegiatan + 1;
        $kode_kegiatan = $v_kegiatan['kode_kegiatan'];
        $q_sub_kegiatan = $this->db->query("SELECT eid.kode_sub_kegiatan, eid.kode_bidang_urusan, eid.id_instansi, eid.tahun, eid.nama_sub_kegiatan, eid.kode_sub_unit, eid.kode_skpd, eid.nama_sub_unit, eid.kode_program, eid.kode_kegiatan, eid.nama_program, eid.nama_kegiatan,
            ipt.jenis_teknis, ipt.id_instansi_pembantu_teknis, ipt.nama_instansi_teknis
            FROM export_import_data_apbd_mentah eid
            left join instansi_pembantu_teknis ipt on eid.kode_sub_unit = ipt.integrasi_ikd_kode_sub_skpd
         WHERE eid.id_instansi='$id_instansi' AND eid.id_export_import_sipd ='$id_import' AND eid.kode_kegiatan ='$kode_kegiatan' GROUP BY eid.kode_sub_kegiatan, eid.kode_sub_unit  ORDER BY eid.kode_sub_kegiatan ASC")->result_array();
        $kumpul_sub_kegiatan = [];

        $kumpul_show_ski = [];
        $kumpul_show_ask = [];
        $kumpul_show_sd = [];




        $pagu_kegiatan =0;
        foreach ($q_sub_kegiatan as $k_ski => $v_ski) {
            $jumlah_sub_kegiatan++;
            $kode_sub_kegiatan = $v_ski['kode_sub_kegiatan'];
            $kode_sub_unit = $v_ski['kode_sub_unit'];
            $q_pagu = $this->db->query("SELECT kode_rekening, LEFT(kode_rekening, 6) AS kode_jenis_belanja, LEFT(kode_rekening, 3) AS kode_kelompok_jenis_belanja, nama_rekening, SUM(pagu) AS pagu FROM export_import_data_apbd_mentah WHERE id_instansi='$id_instansi' AND id_export_import_sipd ='$id_import' AND kode_sub_kegiatan ='$kode_sub_kegiatan' and kode_sub_unit='$kode_sub_unit'  group by kode_jenis_belanja ORDER BY kode_rekening ASC")->result_array();


            if ($v_ski['kode_skpd'] == $v_ski['kode_sub_unit']) {
                $nama_sub_kegiatan = $v_ski['nama_sub_kegiatan'];
                $kode_sub_kegiatan = $v_ski['kode_sub_kegiatan'];
                    $kategori_ski = 'Sub Kegiatan SKPD';
                    $keterangan = '';
                    $jenis_sub_kegiatan = '';
                    $tambahan_kode_sub_kegiatan = '';
            }else{
                if ($v_ski['kode_skpd']=='4.01.0.00.0.00.01.0000') {
                    $nama_sub_kegiatan = $v_ski['nama_sub_kegiatan'];
                    $kode_sub_kegiatan = $v_ski['kode_sub_kegiatan'];
                    $kategori_ski = 'Sub Kegiatan SKPD';
                    $keterangan = '';
                    $jenis_sub_kegiatan = '';
                    $tambahan_kode_sub_kegiatan = '';
                }else{
                    $nama_sub_kegiatan = $v_ski['nama_sub_kegiatan'].'<br>'.$v_ski['nama_sub_unit'];
                    $kode_sub_kegiatan = $v_ski['kode_sub_kegiatan'].'-'.$v_ski['kode_sub_unit'];
                    $kategori_ski = 'Unit Pelaksana';
                    $keterangan = $v_ski['nama_instansi_teknis'];
                    $jenis_sub_kegiatan = $v_ski['jenis_teknis'];
                    $tambahan_kode_sub_kegiatan = $v_ski['kode_sub_unit'];
                }
            }
            $kumpul_pagu = [];
            $pagu_sub_kegiatan = 0;

            $pagu_bo_bp =0;
            $pagu_bo_bbj =0;
            $pagu_bo_bs =0;
            $pagu_bo_bh =0;
            $pagu_bm_bmt =0;
            $pagu_bm_bmpm =0;
            $pagu_bm_bmgb =0;
            $pagu_bm_bmjji =0;
            $pagu_bm_bmatl =0;
            $pagu_btt =0;
            $pagu_bt_bbh =0;
            $pagu_bt_bbk  =0;
            foreach ($q_pagu as $k_pagu => $v_pagu) {
                $pagu_sub_kegiatan += $v_pagu['pagu'];
                
                if ($v_pagu['kode_jenis_belanja']=='5.1.01') {
                    $pagu_bo_bp+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.1.02') {
                    $pagu_bo_bbj+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.1.03') {
                    // $pagu_bo_bbj+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.1.04') {
                    $pagu_bo_bs+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.1.05') {
                    $pagu_bo_bh+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.1.06') {
                    // $pagu_bo_bh+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.2.01') {
                    $pagu_bm_bmt+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.2.02') {
                    $pagu_bm_bmpm+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.2.03') {
                    $pagu_bm_bmgb+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.2.04') {
                    $pagu_bm_bmjji+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.2.05') {
                    $pagu_bm_bmatl+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.2.06') {
                    // $pagu_bm_bmatl+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.3.01') {
                    $pagu_btt+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.4.01') {
                    $pagu_bt_bbh+=$v_pagu['pagu'];
                }
                elseif ($v_pagu['kode_jenis_belanja']=='5.4.02') {
                    $pagu_bt_bbk+=$v_pagu['pagu'];
                }

                $data_pagu = [
                    'kode_kelompok_jenis_belanja' => $v_pagu['kode_kelompok_jenis_belanja'],
                    'kode_jenis_belanja' => $v_pagu['kode_jenis_belanja'],
                    'kode_rekening' => $v_pagu['kode_rekening'],
                    'nama_rekening' => $v_pagu['nama_rekening'],
                    'pagu' => $v_pagu['pagu'],
                ];
                array_push($kumpul_pagu, $data_pagu);
            }


            $q_sumber_dana = $this->db->query("SELECT kode_sumber_dana, nama_sumber_dana, SUM(pagu) AS pagu FROM export_import_data_apbd_mentah WHERE id_instansi='$id_instansi' AND id_export_import_sipd ='$id_import' AND kode_sub_kegiatan ='$kode_sub_kegiatan' and kode_sub_unit='$kode_sub_unit'  group by kode_sumber_dana ORDER BY kode_rekening ASC")->result_array();
            $kumpul_sumber_dana =  [];
            $sumberdana_sub_kegiatan = 0;
            $pad = 0;
            $dau = 0;
            $dak = 0;
            $dbh = 0;
            $lainnya = 0;
            $kumpul_caption_lainnya = [];
            foreach ($q_sumber_dana as $k_sd => $v_sd) {

                if (preg_match("/PAD/", $v_sd['nama_sumber_dana'])) {
                    $pad += $v_sd['pagu'];
                }
                elseif (preg_match("/DAU/", $v_sd['nama_sumber_dana'])) {
                    $dau += $v_sd['pagu'];
                    array_push($kumpul_caption_lainnya, $v_sd['nama_sumber_dana']);
                }
                elseif (preg_match("/DAK/", $v_sd['nama_sumber_dana'])) {
                    $dak += $v_sd['pagu'];
                    array_push($kumpul_caption_lainnya, $v_sd['nama_sumber_dana']);
                }
                elseif (preg_match("/DBH/", $v_sd['nama_sumber_dana'])) {
                    $dbh += $v_sd['pagu'];
                    array_push($kumpul_caption_lainnya, $v_sd['nama_sumber_dana']);
                }
                else {
                    $lainnya += $v_sd['pagu'];
                    array_push($kumpul_caption_lainnya, $v_sd['nama_sumber_dana']);
                }


                $sumberdana_sub_kegiatan += $v_sd['pagu'];
                 $data_sd = [
                    'kode_sumber_dana' => $v_sd['kode_sumber_dana'],
                    'nama_sumber_dana' => $v_sd['nama_sumber_dana'],
                    'pagu' => $v_sd['pagu'],
                ];
                array_push($kumpul_sumber_dana, $data_sd);
            }

            $caption_lainnya = count($kumpul_caption_lainnya) > 0 ? join('<br>', $kumpul_caption_lainnya) : '' ; 

            $no_sub_kegiatan = $k_ski + 1;
            $no_sub_kegiatan = $no_program . '.' . $no_kegiatan . '.' . $no_sub_kegiatan;
            $data_sub_kegiatan = [
                'no_sub_kegiatan' => $no_sub_kegiatan,
                'kode_sub_kegiatan' => $v_ski['kode_sub_kegiatan'],
                'kode_sub_unit' => $v_ski['kode_sub_unit'],
                'kode_skpd' => $v_ski['kode_skpd'],
                'nama_sub_unit' => $v_ski['nama_sub_unit'],
                'nama_sub_kegiatan' => $nama_sub_kegiatan,
                'data_pagu' => $kumpul_pagu,
                'data_sumber_dana' => $kumpul_sumber_dana,
                'pagu_sub_kegiatan' => $pagu_sub_kegiatan,
                'sumberdana_sub_kegiatan' => $sumberdana_sub_kegiatan,
            ];
            array_push($kumpul_sub_kegiatan, $data_sub_kegiatan);
            $data_show_sub_kegiatan = [
                'no_sub_kegiatan' => $no_sub_kegiatan,
                'kode_sub_kegiatan'=>$kode_sub_kegiatan,
                'nama_sub_kegiatan'=>$v_ski['nama_sub_kegiatan'],
                'kode_kegiatan'=>$v_ski['kode_kegiatan'],
                'nama_kegiatan'=>$v_ski['nama_kegiatan'],
                'kode_program'=>$v_ski['kode_program'],
                'nama_program'=>$v_ski['nama_program'],
                'kode_bidang_urusan'=>$v_ski['kode_bidang_urusan'],
                'id_instansi'=>$v_ski['id_instansi'],
                'kode_tahap'=>$periode['kode_tahap'],
                'kategori'=>$kategori_ski,
                'tambahan_kode_sub_kegiatan'=>$tambahan_kode_sub_kegiatan,
                'input_by_tambahan_kode_sub_kegiatan'=>'Import Excel SIPD',
                'jenis_sub_kegiatan'=>$jenis_sub_kegiatan,
                'id_instansi_pembantu_teknis'=>$v_ski['id_instansi_pembantu_teknis'],
                'keterangan'=>$keterangan,
                'tahun'=>$v_ski['tahun'],
                'created_on'=>timestamp(),
                // 'updated_on'=>$xxxxxx,
                'created_by'=>id_user(),
                // 'updated_by'=>$xxxxxx,
                'input_by'=>'Import Excel SIPD',
                'status'=>'1'
            ];
            array_push($kumpul_show_ski, $data_show_sub_kegiatan);

            $data_insert_sub_kegiatan = [
                'kode_sub_kegiatan'=>$kode_sub_kegiatan,
                'nama_sub_kegiatan'=>$v_ski['nama_sub_kegiatan'],
                'kode_kegiatan'=>$v_ski['kode_kegiatan'],
                'kode_program'=>$v_ski['kode_program'],
                'kode_bidang_urusan'=>$v_ski['kode_bidang_urusan'],
                'id_instansi'=>$v_ski['id_instansi'],
                'kode_tahap'=>$periode['kode_tahap'],
                'kategori'=>$kategori_ski,
                'tambahan_kode_sub_kegiatan'=>$tambahan_kode_sub_kegiatan,
                'input_by_tambahan_kode_sub_kegiatan'=>'Import Excel SIPD',
                'jenis_sub_kegiatan'=>$jenis_sub_kegiatan,
                'id_instansi_pembantu_teknis'=>$v_ski['id_instansi_pembantu_teknis'],
                'keterangan'=>$keterangan,
                'tahun'=>$v_ski['tahun'],
                'created_on'=>timestamp(),
                // 'updated_on'=>$xxxxxx,
                'created_by'=>id_user(),
                // 'updated_by'=>$xxxxxx,
                'input_by'=>'Import Excel SIPD',
                'status'=>'1'
            ];
            array_push($kumpul_insert_ski, $data_insert_sub_kegiatan);


            $total_pagu_bo =$pagu_bo_bp + $pagu_bo_bbj + $pagu_bo_bs + $pagu_bo_bh;
            $total_pagu_bm =$pagu_bm_bmt + $pagu_bm_bmpm + $pagu_bm_bmgb + $pagu_bm_bmjji + $pagu_bm_bmatl;
            $total_pagu_btt =$pagu_btt;
            $total_pagu_bt =$pagu_bt_bbh + $pagu_bt_bbk;

            $realisasikan_bo = $total_pagu_bo > 0 ? 1 : 0;
            $realisasikan_bm = $total_pagu_bm > 0 ? 1 : 0;
            $realisasikan_btt = $total_pagu_btt > 0 ? 1 : 0;
            $realisasikan_bt = $total_pagu_bt > 0 ? 1 : 0;
            $data_shoe_anggaran_sub_kegiatan = [
                'kode_sub_kegiatan'=>$kode_sub_kegiatan,

                'no_sub_kegiatan' => $no_sub_kegiatan,
                'nama_sub_kegiatan' => $nama_sub_kegiatan,
                'kode_kegiatan'=>$v_ski['kode_kegiatan'],
                'kode_program'=>$v_ski['kode_program'],
                'kode_bidang_urusan'=>$v_ski['kode_bidang_urusan'],
                'id_instansi'=>$v_ski['id_instansi'],
                'kode_tahap'=>$periode['kode_tahap'],
                'bo_bp' =>$pagu_bo_bp, 
                'bo_bbj' =>$pagu_bo_bbj, 
                'bo_bs' =>$pagu_bo_bs, 
                'bo_bh' =>$pagu_bo_bh, 
                'bm_bmt' =>$pagu_bm_bmt, 
                'bm_bmpm' =>$pagu_bm_bmpm, 
                'bm_bmgb' =>$pagu_bm_bmgb, 
                'bm_bmjji' =>$pagu_bm_bmjji, 
                'bm_bmatl' =>$pagu_bm_bmatl, 
                'btt' =>$pagu_btt, 
                'bt_bbh' =>$pagu_bt_bbh, 
                'bt_bbk' =>$pagu_bt_bbk , 
                'realisasikan_bo' => $realisasikan_bo,
                'realisasikan_bm' => $realisasikan_bm,
                'realisasikan_btt' => $realisasikan_btt,
                'realisasikan_bt ' => $realisasikan_bt,
                'tahun'=>$v_ski['tahun'],
                'created_on'=>timestamp(),
                // 'updated_on'=>$xxxxxx,
                'created_by'=>id_user(),
                // 'updated_by'=>$xxxxxx,
                'input_by'=>'Import Excel SIPD',
                'status'=>'1'
            ];
            array_push($kumpul_show_ask, $data_shoe_anggaran_sub_kegiatan);


            $data_insert_anggaran_sub_kegiatan = [

                'kode_sub_kegiatan'=>$kode_sub_kegiatan,
                'kode_kegiatan'=>$v_ski['kode_kegiatan'],
                'kode_program'=>$v_ski['kode_program'],
                'kode_bidang_urusan'=>$v_ski['kode_bidang_urusan'],
                'id_instansi'=>$v_ski['id_instansi'],
                'kode_tahap'=>$periode['kode_tahap'],
                'bo_bp' =>$pagu_bo_bp, 
                'bo_bbj' =>$pagu_bo_bbj, 
                'bo_bs' =>$pagu_bo_bs, 
                'bo_bh' =>$pagu_bo_bh, 
                'bm_bmt' =>$pagu_bm_bmt, 
                'bm_bmpm' =>$pagu_bm_bmpm, 
                'bm_bmgb' =>$pagu_bm_bmgb, 
                'bm_bmjji' =>$pagu_bm_bmjji, 
                'bm_bmatl' =>$pagu_bm_bmatl, 
                'btt' =>$pagu_btt, 
                'bt_bbh' =>$pagu_bt_bbh, 
                'bt_bbk' =>$pagu_bt_bbk , 
                'realisasikan_bo' => $realisasikan_bo,
                'realisasikan_bm' => $realisasikan_bm,
                'realisasikan_btt' => $realisasikan_btt,
                'realisasikan_bt ' => $realisasikan_bt,
                'tahun'=>$v_ski['tahun'],
                'created_on'=>timestamp(),
                // 'updated_on'=>$xxxxxx,
                'created_by'=>id_user(),
                // 'updated_by'=>$xxxxxx,
                'input_by'=>'Import Excel SIPD',
                'status'=>'1'
            ];
            array_push($kumpul_insert_ask, $data_insert_anggaran_sub_kegiatan);

            $data_show_sumber_dana = [
                'kode_rekening_sub_kegiatan'=>$kode_sub_kegiatan,

                'no_sub_kegiatan' => $no_sub_kegiatan,
                'nama_sub_kegiatan' => $nama_sub_kegiatan,
                'kode_rekening_kegiatan'=>$v_ski['kode_kegiatan'],
                'kode_rekening_program'=>$v_ski['kode_program'],
                'kode_bidang_urusan'=>$v_ski['kode_bidang_urusan'],
                'id_instansi'=>$v_ski['id_instansi'],
                'kode_tahap'=>$periode['kode_tahap'],
                'tahun'=>$v_ski['tahun'],
                'pad'=>$pad,
                'dau'=>$dau,
                'dak'=>$dak,
                'dbh'=>$dbh,
                // 'id_jenis_sumber_dana'=>$xxxxxxxx,
                'lainnya'=>$lainnya,
                'nama_sumber_dana_lainnya'=>$caption_lainnya,
                'created_on'=>timestamp(),
                'created_by'=>id_user(),
                'input_by'=>'Import Excel SIPD',
                'status'=>'1'
            ];
            array_push($kumpul_show_sd, $data_show_sumber_dana);

            $data_insert_sumber_dana = [
                'kode_rekening_sub_kegiatan'=>$kode_sub_kegiatan,
                'kode_rekening_kegiatan'=>$v_ski['kode_kegiatan'],
                'kode_rekening_program'=>$v_ski['kode_program'],
                'kode_bidang_urusan'=>$v_ski['kode_bidang_urusan'],
                'id_instansi'=>$v_ski['id_instansi'],
                'kode_tahap'=>$periode['kode_tahap'],
                'tahun'=>$v_ski['tahun'],
                'pad'=>$pad,
                'dau'=>$dau,
                'dak'=>$dak,
                'dbh'=>$dbh,
                // 'id_jenis_sumber_dana'=>$xxxxxxxx,
                'lainnya'=>$lainnya,
                'nama_sumber_dana_lainnya'=>$caption_lainnya,
                'created_on'=>timestamp(),
                'created_by'=>id_user(),
                'input_by'=>'Import Excel SIPD',
                // 'status'=>'1'
            ];
            array_push($kumpul_insert_sd, $data_insert_sumber_dana);
            $pagu_kegiatan += $pagu_sub_kegiatan;
            $total_pagu+=$pagu_sub_kegiatan;
        }
        $data_kegiatan = [
            'no_kegiatan' => $no_program . '.' . $no_kegiatan,
            'kode_kegiatan' => $v_kegiatan['kode_kegiatan'],
            'nama_kegiatan' => $v_kegiatan['nama_kegiatan'],
            'data_sub_kegiatan_mentah' => $kumpul_sub_kegiatan,
            'data_ski' => $kumpul_show_ski,
            'data_ask' => $kumpul_show_ask,
            'data_sd' => $kumpul_show_sd,
            'pagu_kegiatan' => $pagu_kegiatan,
        ];
        array_push($kumpul_kegiatan, $data_kegiatan);
        $pagu_program  += $pagu_kegiatan;
    }
    $data_program = [
        'no_program' => $no_program,
        'kode_program' => $kode_program,
        'nama_program' => $v_program['nama_program'],
        'data_kegiatan' => $kumpul_kegiatan,
        'pagu_program' => $pagu_program,
    ];
    array_push($kumpul_program, $data_program);
}


$data_insert_all = [
    'ski'=>$kumpul_insert_ski,
    'ask'=>$kumpul_insert_ask,
    'sumberdana'=>$kumpul_insert_sd,
];

// echo json_encode($data_insert_all);
?>





<style type="text/css">
    .font_tbody{
        font-size:9px;
    }
    .font_thead{
        font-size:9px;
    }

  .tabel {
    border-collapse: collapse !important;
}

.tabel td, 
.tabel th {
    border: 1px solid #000 !important;
    vertical-align: top;
}

</style>


<div class="row">
                            <div class="col-lg-6 col-xl-3">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Periode</div>
                                            <h5 class="text-info"><b><?php echo pilihan_nama_tahapan($periode['kode_tahap']).' '.$periode['tahun'] ?></b></h5>
                                            <small>Diuploadkan oleh admin pada <?php echo  $periode['created_at'] ?></small>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-2">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Program</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success"><span><?php echo $jumlah_program ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-2">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total kegiatan</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-primary"><span><?php echo $jumlah_kegiatan ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-2">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Sub Kegiatan</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-warning"><span><?php echo $jumlah_sub_kegiatan ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Pagu</div>
                                            <h5 class="text-info"><b><?php echo number_format($total_pagu, 2, ',', '.'); ?></b></h5>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>



<div class="row">

    <div class="col-md-12 col-lg-12">
          

          <div class="mb-3 card">
                                        <div class="card-header-tab card-header">
                                            <div class="card-header-title">
                                                Data APBD SKPD <br>
                                                <?php echo $nama_instansi ?>
                                            </div>
                                            <ul class="nav">
                                                <li class="nav-item"><a data-toggle="tab" href="#mentah" class="nav-link active show">Data Mentah</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#ski" class="nav-link">Sub Kegiatan Instansi</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#ask" class="nav-link">Telah dikelompokan berdasarkan Anggaran</a></li>
                                                <li class="nav-item"><a data-toggle="tab" href="#sd" class="nav-link ">Telah dikelompokan berdasarkan Sumber Dana</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="mentah" role="tabpanel">
                                                    <table class="table-striped table-bordered tabel" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2">No</th>
                                                                <th colspan="2">Data APBD</th>
                                                                <th colspan="2">Pagu</th>
                                                                <th colspan="3">Sumber Dana</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Kode</th>
                                                                <th>Uraian</th>
                                                                <th>Pagu Per Jenis Belanja</th>
                                                                <th>Pagu Total</th>
                                                                <th>Sumber Dana</th>
                                                                <th>Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                             <?php foreach ($kumpul_program as $k_program => $v_program) { ?>
                                                                <tr  style="background:#c6d1fa">
                                                                    <td><?php echo $v_program['no_program'] ?></td>
                                                                    <td><?php echo $v_program['kode_program'] ?></td>
                                                                    <td><?php echo $v_program['nama_program'] ?></td>
                                                                    <td> - </td>
                                                                    <td> <?php echo number_format($v_program['pagu_program']) ?> </td>
                                                                    <td> - </td>
                                                                    <td> - </td>
                                                                </tr>
                                                                 <?php foreach ($v_program['data_kegiatan'] as $k_kegiatan => $v_kegiatan) { ?>
                                                                <tr  style="background:#c6faf8">
                                                                    <td><?php echo $v_kegiatan['no_kegiatan'] ?></td>
                                                                    <td><?php echo $v_kegiatan['kode_kegiatan'] ?></td>
                                                                    <td><?php echo $v_kegiatan['nama_kegiatan'] ?></td>
                                                                    <td> - </td>
                                                                    <td> <?php echo number_format($v_kegiatan['pagu_kegiatan']) ?> </td>
                                                                    <td> - </td>
                                                                    <td> - </td>
                                                                </tr>

                                                                 <?php foreach ($v_kegiatan['data_sub_kegiatan_mentah'] as $k_sub_kegiatan => $v_sub_kegiatan) {  ?>
                                                                <tr>
                                                                    <td><?php echo $v_sub_kegiatan['no_sub_kegiatan'] ?></td>
                                                                    <td><?php echo $v_sub_kegiatan['kode_sub_kegiatan'] ?></td>
                                                                    <td><?php echo $v_sub_kegiatan['nama_sub_kegiatan']; ?></td> 
                                                                    <td>
                                                                    <table style="border-collapse: collapse;" class="nontabel">
                                                                        <?php 
                                                                        $pagu_total = 0;
                                                                        foreach ($v_sub_kegiatan['data_pagu'] as $k_pagu => $v_pagu) { 
                                                                            $pagu_total += $v_pagu['pagu'];
                                                                            if ($v_pagu['kode_jenis_belanja']!='') { ?>
                                                                        <tr>
                                                                            <!-- <td><?php echo $v_pagu['kode_jenis_belanja'] ?></td> -->
                                                                            <td><?php echo jenis_belanja($v_pagu['kode_jenis_belanja']) ?></td>
                                                                            <!-- <td>:</td> -->
                                                                            <td><?php echo number_format($v_pagu['pagu']) ?></td>
                                                                        </tr>
                                                                        <?php 
                                                                            }
                                                                        }
                                                                     ?>
                                                                    </table> 
                                                                    </td>
                                                                    <td> <?php echo number_format($v_sub_kegiatan['pagu_sub_kegiatan']) ?>  </td>
                                                                    <td> 

                                                                    <table style="border-collapse: collapse;" border=1>
                                                                        <?php 
                                                                        $sumberdana_total = 0;
                                                                        foreach ($v_sub_kegiatan['data_sumber_dana'] as $k_sd => $v_sd) { 
                                                                            $sumberdana_total += $v_sd['pagu'];
                                                                            if ($v_sd['kode_sumber_dana']!='') { ?>
                                                                        <tr>
                                                                            <td><?php echo $v_sd['nama_sumber_dana'] ?></td>
                                                                            <!-- <td><?php //echo jenis_belanja($v_sd['kode_jenis_belanja']) ?></td> -->
                                                                            <!-- <td>:</td> -->
                                                                            <td><?php echo number_format($v_sd['pagu']) ?></td>
                                                                        </tr>
                                                                        <?php 
                                                                            }
                                                                        }
                                                                     ?>
                                                                    </table> 

                                                                     </td>
                                                                    <td> <?php echo number_format($v_sub_kegiatan['sumberdana_sub_kegiatan']) ?>  </td>
                                                                </tr>

                                                             <?php
                                                                     }
                                                                 }
                                                             } 
                                                             ?>

                                                        </tbody>
                                                    </table>








                                                </div>
                                                <div class="tab-pane" id="ski" role="tabpanel">

                                                  <table class="table-striped table-bordered tabel" width="100%">
                                                     <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kode</th>
                                                                <th>Sub Kegiatan</th>
                                                                <th>Kategori</th>
                                                                <th>Jenis Sub Kegiatan</th>
                                                                <th>Tambahan Kode Sub Kegiatan</th>
                                                                <th>Keterangan</th>
                                                            </tr>
                                                       
                                                        </thead>




                                                         <tbody>
                                                             <?php foreach ($kumpul_program as $k_program => $v_program) { ?>
                                                                <tr  style="background:#c6d1fa">
                                                                    <td><?php echo $v_program['no_program'] ?></td>
                                                                    <td><?php echo $v_program['kode_program'] ?></td>
                                                                    <td colspan="6"><?php echo $v_program['nama_program'] ?></td>
                                                                  
                                                                </tr>
                                                                 <?php foreach ($v_program['data_kegiatan'] as $k_kegiatan => $v_kegiatan) { ?>
                                                                <tr  style="background:#c6faf8">
                                                                    <td><?php echo $v_kegiatan['no_kegiatan'] ?></td>
                                                                    <td><?php echo $v_kegiatan['kode_kegiatan'] ?></td>
                                                                    <td colspan="6"><?php echo $v_kegiatan['nama_kegiatan'] ?></td>
                                                                   
                                                                </tr>

                                                                 <?php foreach ($v_kegiatan['data_ski'] as $k_sub_kegiatan => $v) {  ?>
                                                                <tr>
                                                                    <td><?php echo $v['no_sub_kegiatan'] ?></td>
                                                                       <td><?php echo $v['kode_sub_kegiatan'] ?></td>
                                                                    <td><?php echo $v['nama_sub_kegiatan'] ?></td>
                                                                    <td><?php echo $v['kategori'] ?></td>
                                                                    <td><?php echo $v['jenis_sub_kegiatan'] ?></td>
                                                                    <td><?php echo $v['tambahan_kode_sub_kegiatan'] ?></td>
                                                                    <td><?php echo $v['keterangan'] ?></td>
                                                                </tr>

                                                             <?php
                                                                     }
                                                                 }
                                                             } 
                                                             ?>

                                                        </tbody>

 
                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="ask" role="tabpanel">

                                                  <table class="table-striped table-bordered tabel" width="100%">
                                                     <thead>
                                                            <tr>
                                                                <th rowspan="3">No</th>
                                                                <th colspan="2" rowspan="2">Data APBD</th>
                                                                <th colspan="12">Pagu</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="4">Belanja Operasi</th>
                                                                <th colspan="5">Belanja Tidak Terduga</th>
                                                                <th rowspan="2">Belanja Tidak Terduga</th>
                                                                <th colspan="2">Belanja Transfer</th>

                                                            </tr>
                                                            <tr>
                                                                <th>Kode</th>
                                                                <th>Uraian</th>
                                                                <th>Belanja Pegawai</th>
                                                                <th>Belanja Barang Jasa</th>
                                                                <th>Belanja Subsidi</th>
                                                                <th>Belanja Hibah</th>
                                                                <th>Belanja Modal Tanah</th>
                                                                <th>Belanja Modal Peralatan dan Mesin</th>
                                                                <th>Belanja Modal Gedung & Bangunan</th>
                                                                <th>Belanja Modal Jalan, Jaringan, dan Irigasi</th>
                                                                <th>Belanja Modal dan Aset Tetap Lainnya</th>
                                                                <th>Belanja Bagi Hasil</th>
                                                                <th>Belanja Bantuan Keuangan</th>
                                                            </tr>
                                                        </thead>



                                                         <tbody>
                                                             <?php foreach ($kumpul_program as $k_program => $v_program) { ?>
                                                                <tr  style="background:#c6d1fa">
                                                                    <td><?php echo $v_program['no_program'] ?></td>
                                                                    <td><?php echo $v_program['kode_program'] ?></td>
                                                                    <td colspan="13"><?php echo $v_program['nama_program'] ?></td>
                                                                  
                                                                </tr>
                                                                 <?php foreach ($v_program['data_kegiatan'] as $k_kegiatan => $v_kegiatan) { ?>
                                                                <tr  style="background:#c6faf8">
                                                                    <td><?php echo $v_kegiatan['no_kegiatan'] ?></td>
                                                                    <td><?php echo $v_kegiatan['kode_kegiatan'] ?></td>
                                                                    <td colspan="13"><?php echo $v_kegiatan['nama_kegiatan'] ?></td>
                                                                   
                                                                </tr>

                                                                 <?php foreach ($v_kegiatan['data_ask'] as $k_sub_kegiatan => $v) {  ?>
                                                                <tr>
                                                                    <td><?php echo $v['no_sub_kegiatan'] ?></td>
                                                                    <td><?php echo $v['kode_sub_kegiatan'] ?></td>
                                                                    <td><?php echo $v['nama_sub_kegiatan'] ?></td>
                                                                    <td><?php echo number_format($v['bo_bp']) ?></td>
                                                                    <td><?php echo number_format($v['bo_bbj']) ?></td>
                                                                    <td><?php echo number_format($v['bo_bs']) ?></td>
                                                                    <td><?php echo number_format($v['bo_bh']) ?></td>
                                                                    <td><?php echo number_format($v['bm_bmt']) ?></td>
                                                                    <td><?php echo number_format($v['bm_bmpm']) ?></td>
                                                                    <td><?php echo number_format($v['bm_bmgb']) ?></td>
                                                                    <td><?php echo number_format($v['bm_bmjji']) ?></td>
                                                                    <td><?php echo number_format($v['bm_bmatl']) ?></td>
                                                                    <td><?php echo number_format($v['btt']) ?></td>
                                                                    <td><?php echo number_format($v['bt_bbh']) ?></td>
                                                                    <td><?php echo number_format($v['bt_bbk']) ?></td>
                                                                </tr>

                                                             <?php
                                                                     }
                                                                 }
                                                             } 
                                                             ?>

                                                        </tbody>




                                                    </table>

                                                </div>
                                                <div class="tab-pane" id="sd" role="tabpanel">

                                                  <table class="table-striped table-bordered tabel" width="100%">
                                                     <thead>
                                                            <tr>
                                                                <th rowspan="3">No</th>
                                                                <th colspan="2" rowspan="2">Data APBD</th>
                                                                <th colspan="6">Sumber Dana</th>
                                                            </tr>
                                                            <tr>
                                                                <th rowspan="2">PAD</th>
                                                                <th rowspan="2">DAU</th>
                                                                <th rowspan="2">DAK</th>
                                                                <th rowspan="2">DBH</th>
                                                                <th colspan="2">Lainnya</th>

                                                            </tr>
                                                            <tr>
                                                                <td>Kode</td>
                                                                <td>Uraian</td>
                                                                <th>Nilai</th>
                                                                <th>Keterangan</th>
                                                            </tr>
                                                        </thead>


                                                         <tbody>
                                                             <?php foreach ($kumpul_program as $k_program => $v_program) { ?>
                                                                <tr  style="background:#c6d1fa">
                                                                    <td><?php echo $v_program['no_program'] ?></td>
                                                                    <td><?php echo $v_program['kode_program'] ?></td>
                                                                    <td colspan="7"><?php echo $v_program['nama_program'] ?></td>
                                                                  
                                                                </tr>
                                                                 <?php foreach ($v_program['data_kegiatan'] as $k_kegiatan => $v_kegiatan) { ?>
                                                                <tr  style="background:#c6faf8">
                                                                    <td><?php echo $v_kegiatan['no_kegiatan'] ?></td>
                                                                    <td><?php echo $v_kegiatan['kode_kegiatan'] ?></td>
                                                                    <td colspan="7"><?php echo $v_kegiatan['nama_kegiatan'] ?></td>
                                                                   
                                                                </tr>

                                                                 <?php foreach ($v_kegiatan['data_sd'] as $k_sub_kegiatan => $v) {  ?>
                                                                <tr>
                                                                    <td><?php echo $v['no_sub_kegiatan'] ?></td>
                                                                    <td><?php echo $v['kode_rekening_sub_kegiatan'] ?></td>
                                                                    <td><?php echo $v['nama_sub_kegiatan'] ?></td>
                                                                    <td><?php echo number_format($v['pad']) ?></td>
                                                                    <td><?php echo number_format($v['dau']) ?></td>
                                                                    <td><?php echo number_format($v['dak']) ?></td>
                                                                    <td><?php echo number_format($v['dbh']) ?></td>
                                                                    <td><?php echo number_format($v['lainnya']) ?></td>
                                                                    <td><?php echo $v['nama_sumber_dana_lainnya'] ?></td>
                                                                </tr>

                                                             <?php
                                                                     }
                                                                 }
                                                             } 
                                                             
                                                         ?>

                                                        </tbody>
                                                    </table>

                                                  </div>
                                            </div>
                                            <br>
                                            <form method="post" action="<?php echo base_url('export_import/import_all_data_apbd') ?>" id="form_import">
                                                <input type="hidden" name="id_instansi" id="id_instansi" value="<?php echo $id_instansi ?>">
                                                <input type="hidden" name="kode_tahap" id="kode_tahap" value="<?php echo $periode['kode_tahap'] ?>">
                                                <input type="hidden" name="id_export_import" id="id_export_import" value="<?php echo $periode['id_export_import'] ?>">
                                                <input type="hidden" name="tahun" id="tahun" value="<?php echo $periode['tahun'] ?>">
                                                <textarea name="data_import" id="data_import" class="form-control" rows="20" style="display:none"><?php echo json_encode($data_insert_all) ?></textarea>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="btn-group btn-block">
                                                <?php if ($this->session->userdata('id_group')==2) { ?>
                                            <button class=" btn btn-outline-info" type="button" onclick="import_all_data_apbd()">Import Data APBD (Pilih Data APBD, Pagu Sub Kegiatan, Sumber dana Sub Kegiatan)</button>
                                        <?php } ?>
                                            <a class="btn btn-outline-info" href="<?php echo base_url('data_apbd/setting') ?>">Pilih Data APBD (Manual Input)</a>
                                            <!-- <button class="btn btn-block btn-info" onclick="alert('coming soon, sedang dalam pengembangan')" type="button">Import akan segera di aktifkan</button> -->
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>




    </div>


</div>

<style type="text/css">
    .table_confirm{
        text-align: left;
    }
</style>
<script type="text/javascript">
    function import_all_data_apbd_alert(){
        Swal.fire('Dilarang','Data hanya bisa di importkan oleh admin','error');
    }
    function import_all_data_apbd(){
        var form_data = $('#form_import').serialize();
        var id_instansi = $('#id_instansi').val();
        var id_export_import = $('#id_export_import').val();
        var kode_tahap = $('#kode_tahap').val();
        var tahun = $('#tahun').val();
        var data_import = $('#data_import').val();

        var table_confirm = `
            <table class="table_confirm">
                <tr>
                    <td>Jumlah Program</td>
                    <td>:</td>
                    <td><?php echo $jumlah_program ?></td>
                </tr>
                <tr>
                    <td>Jumlah Kegiatan</td>
                    <td>:</td>
                    <td><?php echo $jumlah_kegiatan ?></td>
                </tr>
                <tr>
                    <td>Jumlah Sub Kegiatan</td>
                    <td>:</td>
                    <td><?php echo $jumlah_sub_kegiatan ?></td>
                </tr>
                <tr>
                    <td>Total Pagu</td>
                    <td>:</td>
                    <td><b><?php echo number_format($total_pagu, 2, ',', '.'); ?></b></td>
                </tr>
            </table>`;



        Swal.fire({
          title: "Import data ke Data APBD SKPD",
          html : table_confirm  ,
          showCancelButton: true,
          confirmButtonText: "Import Data",
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire("Saved!", "", "success");
                $.ajax(
                {
                    url     : baseUrl('export_import/import_all_data_apbd/'),
                    dataType: 'JSON',
                    type    : 'POST',
                    data    : { 
                        
                        id_export_import : id_export_import,
                        id_instansi : id_instansi,
                        kode_tahap : kode_tahap,
                        tahun : tahun,
                        data_import : data_import
                    },
                    success : function(data)
                    {
                        // console.log(data.id_export_import);

                        // window.location.href=baseUrl('export_import/list_opd/' + data.id_export_import)  
                        
                    },
                    error : function(){
                        alert('érror');
                    }
                });
                



                


          } 
        });




    }
</script>