

          <h3>Target APBD</h3>

          <?php if ($target['responcode']==500) { ?>
              <div class="alert alert-info">Gagal meload API. Silahkan dicoba kembali</div>
          <?php }else{ ?>
          <table border="1" class="datatabel table table-bordered table-striped" width="100%" >
           <thead>  
            <tr>
                <td>No</td>
                <td>Kode Rekening</td>
                <td>Nama Sub Kegiatan</td>
                <td>Pagu</td>
                <td>Target APBD / Bulan</td>
                <td>Keterangan</td>
            </tr>
        </thead>
          
            <?php 
            $target_sudah_import = 0;
            $kumpul_import_target = [];
            foreach ($target['result']->data as $k => $v) { 


        if (in_array($v->kode_sub_kegiatan, $kumpul_target)) {
            $keterangan_import = '<span class="badge badge-success">Data Target APBD sudah Di inputkan<span>';
            $target_sudah_import++;

        }else{

                            // if (in_array($v->kode_sub_kegiatan, $kumpul_kode_sub_kegiatan)) {
            if (in_array($v->kode_sub_kegiatan, $kumpul_ski)) {
                $keterangan_import = '<span class="badge badge-info">Data Target APBD belum di inputkan<span>';
            }else{
                $keterangan_import = '<span class="badge badge-danger">Data Sub Kgiatan belum terdeteksi<span>';
                
            }



            // array_push($kumpul_import_target, 0);

        }




                ?>
                <tr>
                    <td><?php echo $k+1 ?></td>
                    <td><?php echo $v->kode_sub_kegiatan ?></td>
                    <td><?php echo $v->nama_sub_kegiatan ?></td>
                    <td align="right"><?php echo number_format($v->pagu_sub_kegiatan) ?></td>
                    <?php 
                    $target_per_sub_kegiatan = [
                        // 'id_instansi'=>$id_instansi,
                        // 'kode_tahap'=>$kode_tahap,

                        // 'tahun'=>$tahun,


                        // 'kode_bidang_urusan' =>$kode_bidang_urusan,
                        'nama_sub_kegiatan' =>$v->nama_sub_kegiatan,
                        'pagu_sub_kegiatan' =>$v->pagu_sub_kegiatan,
                        'kode_rekening_sub_kegiatan' =>$v->kode_sub_kegiatan,
                        'data' =>[],
                    ];
                    foreach ($v->target_apbd as $k_target => $v_target){  

        $pecah = explode('.', $v->kode_sub_kegiatan);
        $kode_bidang_urusan = $pecah[0].'.'.$pecah[1];
        $target_keuangan = $v->pagu_sub_kegiatan == 0 ? 0 : ( ($v_target->target_keuangan / $v->pagu_sub_kegiatan) * 100 ); 
        $target_keuangan_bulanan =  $v->pagu_sub_kegiatan == 0 ? 0 : ( ($v_target->target_keuangan_bulanan / $v->pagu_sub_kegiatan) * 100 ); 

                        $data_target = [
                        'id_instansi'=>$id_instansi,
                        'kode_tahap'=>$kode_tahap,

                        'tahun'=>$tahun,


                        'kode_bidang_urusan' =>$kode_bidang_urusan,
                        'kode_rekening_program' =>$v->kode_program,
                        'kode_rekening_kegiatan' =>$v->kode_kegiatan,
                        'kode_rekening_sub_kegiatan' =>$v->kode_sub_kegiatan,
                        'bulan' =>$v_target->bulan,
                        'target_fisik' =>$target_keuangan,
                        'target_keuangan' =>$v_target->target_keuangan,
                        'persen_target_keuangan' =>$v_target->persen_target_keuangan,
                        'target_fisik_bulanan' =>$target_keuangan_bulanan,
                        'target_keuangan_bulanan' =>$v_target->target_keuangan_bulanan,
                        'persen_target_keuangan_bulanan' =>$v_target->persen_target_keuangan_bulanan,
                        'input_by' =>'Integrasi IKD',
                        'keuangan' =>'',
                        'created_on' =>timestamp(),
                        'created_by' =>id_user()];



                        if (in_array($v->kode_sub_kegiatan, $kumpul_target)) {
                            // $tipe_input_target = '<span class="badge badge-success">Manual Input<span>';
                        }else{
                            // if (in_array($v->kode_sub_kegiatan, $kumpul_kode_sub_kegiatan)) {
                            if (in_array($v->kode_sub_kegiatan, $kumpul_ski)) {
                                if (in_array($v->kode_sub_kegiatan, $kumpul_ask)) {
                                array_push($kumpul_import_target, $data_target);
                                }
                            }else{
                                // $tipe_input_target = '<span class="badge badge-info">Data Target APBD belum di inputkan<span>';
                            }
                        }



                        $data_target_show = [
                            'bulan' =>$v_target->bulan,
                            'target_fisik' =>$target_keuangan,
                            'target_keuangan' =>$v_target->target_keuangan,
                            'persen_target_keuangan' =>$v_target->persen_target_keuangan,
                            'target_fisik_bulanan' =>$target_keuangan_bulanan,
                            'target_keuangan_bulanan' =>$v_target->target_keuangan_bulanan,
                            'persen_target_keuangan_bulanan' =>$v_target->persen_target_keuangan_bulanan,
                        ];


                    array_push($target_per_sub_kegiatan['data'], $data_target_show);




                        ?>
                    
                        
                    <?php } ?>
                        <td align="center">
                        <textarea style="display:none" id="data_target_get"><?php echo json_encode($target_per_sub_kegiatan) ?></textarea>
                        <a href="javascript:void(0)" onclick="ambil_data_target(this)" >Lihat Target</a>
                    </td>
                        <td><?php echo $keterangan_import ?></td>


                </tr>
            <?php } ?>
            
          </table>

<?php   } ?>

          <textarea id="data_import_target" style="display:none"><?php echo json_encode($kumpul_import_target) ?></textarea>
          <a href="javascript:void(0);" class="btn btn-info btn-sm mt-3 mb-3"  onclick="import_target()" >Import Rencana Aliran Kas
                    </a>
<?php echo json_encode($kumpul_import_target) ?>