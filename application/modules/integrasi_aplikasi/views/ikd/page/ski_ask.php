    <?php 
    $kumpul_sub_kegiatan = [];
    $total_program = 0;
    $total_kegiatan =0;
    $total_sub_kegiatan = 0;
    
    $kumpul_import_ski = [];
    $sudah_import = 0;
    $kumpul_import_ask = [];

    $kumpul_kode_sub_kegiatan= [];
    foreach ($ski->result as $k_ski => $v_ski) { 
        if ($v_ski->kategori=='Unit Pelaksana') {
        // var_dump($kumpul_ipt[$v_ski      ->kode_sub_skpd]['nama_instansi_teknis']);

        // echo "   <br>";
        // echo $v_ski->kode_sub_skpd;
        // echo "   <hr>";
            $kategori = 'Unit Pelaksana';
            $tambahan_kode_sub_kegiatan = @$kumpul_ipt[$v_ski->kode_sub_skpd]['kode_instansi_teknis'];
            $input_by_tambahan_kode_sub_kegiatan = 'Integrasi IKD';
            $jenis_sub_kegiatan = @$kumpul_ipt[$v_ski->kode_sub_skpd]['jenis_teknis'];
            $id_instansi_pembantu_teknis = @$kumpul_ipt[$v_ski->kode_sub_skpd]['id_instansi_pembantu_teknis'];
            $keterangan  = @$kumpul_ipt[$v_ski->kode_sub_skpd]['nama_instansi_teknis'];
            $kode_sub_kegiatan_disimpan = $v_ski->kode_sub_kegiatan.'.'.$tambahan_kode_sub_kegiatan;
            $nama_sub_kegiatan = $v_ski->nama_sub_kegiatan.'<br>'.$jenis_sub_kegiatan.' - '.$keterangan ;
            $input_by_tambahan_kode_sub_kegiatan ='Manual Input (Convert ID IPT)';
        }else{
            $kategori = 'Sub Kegiatan SKPD';
            $tambahan_kode_sub_kegiatan = '';
            $input_by_tambahan_kode_sub_kegiatan = '';
            $jenis_sub_kegiatan = '';
            $id_instansi_pembantu_teknis = '';
            $keterangan  = '';
            $kode_sub_kegiatan_disimpan = $v_ski->kode_sub_kegiatan;
            $nama_sub_kegiatan = $v_ski->nama_sub_kegiatan;
            $input_by_tambahan_kode_sub_kegiatan ='';

        }

        // cek telah di inputkan 


        $pecah = explode('.', $v_ski->kode_sub_kegiatan);
        $kode_bidang_urusan = $pecah[0].'.'.$pecah[1];


        $data_ski = [
            'kode_sub_kegiatan'=>$kode_sub_kegiatan_disimpan,
            'nama_sub_kegiatan'=>$nama_sub_kegiatan,
            'kode_kegiatan'=>$v_ski->kode_kegiatan,
            'kode_program'=>$v_ski->kode_program,
            'kode_bidang_urusan'=>$kode_bidang_urusan,
            'id_instansi'=>$id_instansi,
            'kode_tahap'=>$kode_tahap,
            'kategori'=>$kategori,
            'tambahan_kode_sub_kegiatan'=>$tambahan_kode_sub_kegiatan,
            'input_by_tambahan_kode_sub_kegiatan'=>$input_by_tambahan_kode_sub_kegiatan,
            'jenis_sub_kegiatan'=>$jenis_sub_kegiatan,
            'id_instansi_pembantu_teknis'=>$id_instansi_pembantu_teknis ,
            'keterangan'=>$keterangan,
            'tahun'=>$tahun,
            'created_on'=>timestamp(),
            'updated_on'=>'',
            'created_by'=>id_user(),
            'updated_by'=>'',
            'input_by'=>'Integrasi IKD',
            'status '=>'1',
            ];

            $total_bo = $v_ski->bo_bp+$v_ski->bo_bbj+$v_ski->bo_bs+$v_ski->bo_bh;
            $total_bm = $v_ski->bm_bmt+$v_ski->bm_bmpm+$v_ski->bm_bmgb+$v_ski->bm_bmjji+$v_ski->bm_bmatl;
            $total_btt = $v_ski->btt;
            $total_bt = $v_ski->bt_bbh+$v_ski->bt_bbk;

            $realisasikan_bo = $total_bo > 0 ? 1 : 0 ; 
            $realisasikan_bm = $total_bm > 0 ? 1 : 0 ; 
            $realisasikan_btt = $total_btt > 0 ? 1 : 0 ; 
            $realisasikan_bt = $total_bt > 0 ? 1 : 0 ; 
        $pagu_ski = [
            'kode_sub_kegiatan'=>$kode_sub_kegiatan_disimpan,
            'kode_kegiatan'=>$v_ski->kode_kegiatan,
            'kode_program'=>$v_ski->kode_program,
            'kode_bidang_urusan'=>$kode_bidang_urusan,
            'id_instansi'=>$id_instansi,
            'kode_tahap'=>$kode_tahap,
            'bo_bp'=>$v_ski->bo_bp,
            'bo_bbj'=>$v_ski->bo_bbj,
            'bo_bs'=>$v_ski->bo_bs,
            'bo_bh'=>$v_ski->bo_bh,
            'bm_bmt'=>$v_ski->bm_bmt,
            'bm_bmpm'=>$v_ski->bm_bmpm,
            'bm_bmgb'=>$v_ski->bm_bmgb,
            'bm_bmjji'=>$v_ski->bm_bmjji,
            'bm_bmatl'=>$v_ski->bm_bmatl,
            'btt'=>$v_ski->btt,
            'bt_bbh'=>$v_ski->bt_bbh,
            'bt_bbk'=>$v_ski->bt_bbk,
            'realisasikan_bo'=>$realisasikan_bo,
            'realisasikan_bm'=>$realisasikan_bm,
            'realisasikan_btt'=>$realisasikan_btt,
            'realisasikan_bt'=>$realisasikan_bt,
            'tahun'=>$tahun,
            'created_on'=>timestamp(),
            'updated_on'=>'',
            'created_by'=>id_user(),
            'updated_by'=>'',
            'input_by'=>'Integrasi IKD',
            'status '=>'1',
        ];



        if (in_array($kode_sub_kegiatan_disimpan, $kumpul_ski)) {
            if (in_array($kode_sub_kegiatan_disimpan, $kumpul_ask)) {
            $keterangan_import = '<span class="badge badge-success">Data Sub Kegiatan dan pagu sudah Di inputkan<span>';
            $sudah_import++;

            }else{
            $keterangan_import = '<span class="badge badge-warning">Data sub kegiatan sudah di inputkan<br>data pagu belum di inputkan<span>';
            array_push($kumpul_import_ask, $pagu_ski);
            array_push($kumpul_kode_sub_kegiatan, $kode_sub_kegiatan_disimpan);

            }
        }else{
            $keterangan_import = '<span class="badge badge-danger">Data Sub kegiatan dan pagu belum di inputkan<span>';
            array_push($kumpul_import_ask, $pagu_ski);
            array_push($kumpul_import_ski, $data_ski);

        }

        $total_sub_kegiatan++;
        $data = [
                        'kode_program'=>$v_ski->kode_program,
                        'nama_program'=>@$kumpul_master_program[$v_ski->kode_program],

                        'kode_kegiatan'=>$v_ski->kode_kegiatan,
                        'nama_kegiatan'=>@$kumpul_master_kegiatan[$v_ski->kode_kegiatan],


                        'kode_sub_kegiatan'=>$kode_sub_kegiatan_disimpan,
                        'nama_sub_kegiatan'=>$nama_sub_kegiatan,

                        'kategori'=> $v_ski->kategori,
                        'keterangan'=> $keterangan_import,

                        'pagu'=>[
                            'bo_bp'=>$v_ski->bo_bp,
                            'bo_bbj'=>$v_ski->bo_bbj,
                            'bo_bs'=>$v_ski->bo_bs,
                            'bo_bh'=>$v_ski->bo_bh,
                            'bm_bmt'=>$v_ski->bm_bmt,
                            'bm_bmpm'=>$v_ski->bm_bmpm,
                            'bm_bmgb'=>$v_ski->bm_bmgb,
                            'bm_bmjji'=>$v_ski->bm_bmjji,
                            'bm_bmatl'=>$v_ski->bm_bmatl,
                            'btt'=>$v_ski->btt,
                            'bt_bbh'=>$v_ski->bt_bbh,
                            'bt_bbk'=>$v_ski->bt_bbk,
                            'pagu_total'=>$v_ski->pagu,
                        ],
                        'pagu_sbe' => @$data_ask[$kode_sub_kegiatan_disimpan]
                        // 'anggaran_sub_kegiatan'=>$v_ski->anggaran,
                        // 'kode_kegiatan'=>$v_k->kode_kegiatan,
                        // 'nama_kegiatan'=>$v_k->nama_kegiatan,
                        // 'kode_program'=>$v_p->kode_program,
                        // 'nama_program'=>$v_p->nama_program,
                    ];
                    array_push($kumpul_sub_kegiatan, $data);
       }


// arsort($kumpul_sub_kegiatan);

      var_dump($data_ask['1.02.01.1.02.0001']);
                ?>

        <table class='table table-striped table-bordered' style='margin-top:10px; font-size: 12px;border-collapse: collapse;' border="1"  id="data_sipedal">
               <thead>
               
                <tr>
                   <th>No</th>
                   <th>Progam</th>
                   <th>Kegiatan</th>
                   <th>Sub Kegiatan</th>
                   <th>Kategori</th>
                   <th>Pagu IKD</th>
                   <th>Pagu SBE</th>
                   <th>Keterangan</th>
               </tr>
             
            
               </thead>
                <tbody>
                    <?php 
                    $total_pagu = 0;
                    $no=1;
                    foreach ($kumpul_sub_kegiatan as $k => $v) { 
                        $total_pagu_bo = $v['pagu']['bo_bp'] + $v['pagu']['bo_bbj'] + $v['pagu']['bo_bs'] + $v['pagu']['bo_bh'] ;
                        $total_pagu_bm = $v['pagu']['bm_bmt'] + $v['pagu']['bm_bmpm'] + $v['pagu']['bm_bmgb'] + $v['pagu']['bm_bmjji'] + $v['pagu']['bm_bmatl'] ;
                        $total_pagu_btt = $v['pagu']['btt'] ;
                        $total_pagu_bt = $v['pagu']['bt_bbh'] + $v['pagu']['bt_bbk']  ;
                        $total_pagu += $v['pagu']['pagu_total'];


                        $data_pagu = [
                            'total_pagu_bo' => $total_pagu_bo,
                            'total_pagu_bm' => $total_pagu_bm,
                            'total_pagu_btt' => $total_pagu_btt,
                            'total_pagu_bt' => $total_pagu_bt,
                            'bo_bp' => $v['pagu']['bo_bp'],
                            'bo_bbj' => $v['pagu']['bo_bbj'],
                            'bo_bs' => $v['pagu']['bo_bs'],
                            'bo_bh' => $v['pagu']['bo_bh'],
                            'bm_bmt' => $v['pagu']['bm_bmt'],
                            'bm_bmpm' => $v['pagu']['bm_bmpm'],
                            'bm_bmgb' => $v['pagu']['bm_bmgb'],
                            'bm_bmjji' => $v['pagu']['bm_bmjji'],
                            'bm_bmatl' => $v['pagu']['bm_bmatl'],
                            'btt' => $v['pagu']['btt'],
                            'bt_bbh' => $v['pagu']['bt_bbh'],
                            'bt_bbk' => $v['pagu']['bt_bbk'],
                            'pagu_total' => $v['pagu']['pagu_total'],
                            'kode_program'=>$v['kode_program'].'<br>'.$v['nama_program'] ,
                            'kode_kegiatan'=>$v['kode_kegiatan'].'<br>'.$v['nama_kegiatan'] ,
                            'kode_sub_kegiatan'=>$v['kode_sub_kegiatan'].'<br>'.$v['nama_sub_kegiatan'] ,
                            'kategori'=>$v['kategori'],
                        ];


                        if ($v['pagu_sbe']==$v['pagu']['pagu_total']) {
                            $warna = 'style="background:#d2fbb9"';
                        }else{
                            $warna = 'style="background:#fbc9b9"';

                        }
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $v['kode_program'].'<br>'.$v['nama_program']  ?></td>
                            <td><?php echo $v['kode_kegiatan'].'<br>'.$v['nama_kegiatan']  ?></td>
                            <td><?php echo $v['kode_sub_kegiatan'].'<br>'.$v['nama_sub_kegiatan']  ?></td>
                            <td><?php echo $v['kategori'] ?></td>
                          <!--   <td align="right"><?php echo number_format($v['pagu']['bo_bp']) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['bo_bbj']) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['bo_bs']) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['bo_bh']) ?></td>
                           <td align="right"><?php echo number_format($total_pagu_bo) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['bm_bmt']) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['bm_bmpm']) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['bm_bmgb']) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['bm_bmjji']) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['bm_bmatl']) ?></td>
                           <td align="right"><?php echo number_format($total_pagu_bm) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['btt']) ?></td>
                           <td align="right"><?php echo number_format($total_pagu_btt) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['bt_bbh']) ?></td>
                            <td align="right"><?php echo number_format($v['pagu']['bt_bbk']) ?></td>
                           <td align="right"><?php echo number_format($total_pagu_bt) ?></td> -->
                            <td align="right">
                               
                                      <textarea style="display:none" id="data_pagu_get"><?php echo json_encode($data_pagu) ?></textarea>
                        <a href="javascript:void(0)" data-toggle="tooltip" title="Liat Detail" onclick="ambil_data_pagu(this)" > <?php echo number_format($v['pagu']['pagu_total']) ?></a>
                            </td>
                            <td <?php echo $warna ?>><?php echo number_format($v['pagu_sbe']) ?></td>
                            <td><?php echo $v['keterangan'] ?></td>
                        
                            
                        </tr>
                    
                <?php } ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total Pagu</td>
                        <td><?php echo number_format($total_pagu) ?></td>
                    </tr>
                </tfoot>

           </table>

           Total Program : <?php echo $total_program ?> <br>
           Total Kegiatan : <?php echo $total_kegiatan ?> <br>
           Total Sub Kegiatan : <?php echo $total_sub_kegiatan ?> <br>

           belum ada pagu : <?php echo count($kumpul_import_ask) ?> <br>
          belum input : <?php echo count($kumpul_import_ski) ?> <br>
          sudah imput : <?php echo $sudah_import ?> <br>


          <textarea style=" display:none" id="data_import_ski"><?php echo json_encode($kumpul_import_ski) ?></textarea>
          <textarea style=" display:none"  id="data_import_ask"><?php echo json_encode($kumpul_import_ask) ?></textarea>
          <a href="javascript:void(0);" class="btn btn-info btn-sm mt-3 mb-3"  onclick="import_ski()" >Import Sub Kegiatan Beserta Pagu
                    </a>

