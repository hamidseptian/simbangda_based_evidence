        <?php 

    if ($config_kab_kota['integrasi_replikasi']==1) {

        $kumpul_opd_replikasi = [];
        $api_opd_replikasi = [];
        $skpd_replikasi_berkode = 0;
           foreach ($data_opd_replikasi->opd as $k => $v) {
            // echo $v->kode_opd;
            if ($v->kode_opd!='') {
                $skpd_replikasi_berkode++;
                $api_opd_replikasi[$v->kode_opd] = 
                [
                    'nama_instansi' =>$v->nama_instansi,
                    'is_active' =>$v->is_active,
                    'kode_opd' =>$v->kode_opd,
                ];


                // $data = [
                //     'kode_opd' =>$v->kode_opd,
                //     'detail' => 
                //     [
                //         'nama_instansi' =>$v->nama_instansi,
                //         'is_active' =>$v->is_active,
                //         'kode_opd' =>$v->kode_opd,
                //     ]
                // ];

                array_push($kumpul_opd_replikasi, $v->kode_opd);
            }

        };



         ?>
         <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                                   
                                    <ul class="list-group list-group-flush">

                                        <li class="bg-warm-flame list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading text-dark opacity-7">Progress Replikasi Simbangda Based Evidence</div>
                                                    <div class="widget-subheading opacity-10">
                                                        
                                                        <span class="pr-2">
                                                            <b class="text-primary">
                                                            <?php echo $tahap_replikasi[$config_kab_kota['replikasi']] ?>                                                           
                                                            </b>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="widget-heading text-dark opacity-7"><b> Terintegrasikan</b></div>
                                                    <div class="widget-subheading opacity-10">
                                                        
                                                        <span class="pr-2" style="text-align: right">
                                                            <b class="text-success" >
                                                            <?php echo $terintegrasikan[$config_kab_kota['integrasi_replikasi']] ?>                                                                
                                                            </b>
                                                        </span>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </li>

                                   
                                        <li class="p-0 list-group-item">
                                            <div class="widget-content">
                                                <div class="row">
                                                    
                                                    <div class="col-md-6 col-xl-3">
                                                        Link Replikasi : <a href="<?php echo $config_kab_kota['url_replikasi'] ?>" target="_blank"><?php echo $config_kab_kota['url_replikasi'] ?></a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>

                                        
                                        
                                    </ul>

                                </div>






<?php 
$show_data ='<div class="mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Daftar SKPD Aktif pada <?php echo $nama_kota  ?> yang di integrasikan dengan replikasi Simbangda Kota Padang</h5>

                                    <table class="mb-0 table table-bordered table-striped" id="datatable">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama OPD</th>
                                            <th>Kode OPD </th>
                                            <th>Ditemukan Pada Replikasi</th>
                                            <th>Kode OPD Replikasi</th>
                                            <th>Nama OPD Replikasi</th>
                                        </tr>
                                        </thead>
                                        <tbody>';
                                           
                                            $no=0;
                                            $hitung_kode_opd_provinsi = 0;
                                            $hitung_kode_opd_replikasi = 0;
                                            foreach ($data_opd as $k => $v) { 

                                                if ($v['kode_opd']!='') {
                                                    $hitung_kode_opd_provinsi++;
                                                    # code...
                                                }
                                                $no++;

                                                if (in_array($v['kode_opd'], $kumpul_opd_replikasi)) {
                                            $hitung_kode_opd_replikasi++;
                                                
                                        $show_data .='<tr style="background:#d5f5e3">
                                            <th scope="row">'.$no.'</th>
                                            <td>'.$v['nama_instansi'].'</td>
                                            <td>'.$v['kode_opd'].'</td>
                                            <td>Ditemukan / Terintegrasi</td>
                                            <td>'.$api_opd_replikasi[$v['kode_opd']]['kode_opd'].'</td>
                                            <td>'.$api_opd_replikasi[$v['kode_opd']]['nama_instansi'].'</td>
                                            
                                              
                                            
                                        </tr>';
                                     }else{ 
                                         $show_data .='<tr style="background:#f8b2b2">
                                            <th scope="row">'.$no.'</th>
                                            <td>'.$v['nama_instansi'].'</td>
                                            <td>'.$v['kode_opd'].'</td>
                                            <td>Tidak Ditemukan</td>
                                            <td>-</td>
                                            <td>-</td>
                                             
                                        </tr>';
                                         }
                                     } 
                                     
                                        $show_data .='</tbody>
                                    </table>
                                </div>
</div>';
?>


                                    <div class="main-card mb-3 card ">
                                        <div class="row">
                                            
                                            <div class="col-lg-6">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Data OPD <?php echo $nama_kota ?></div>
                                                                    <div class="widget-subheading">Pada Simbangda Provinsi</div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="badge badge-info"><?php echo count($data_opd) ?> OPD</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Banyak OPD <?php echo $nama_kota ?> </div>
                                                                    <div class="widget-subheading">Pada Simbangda Replikasi</div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="badge badge-info"><?php echo count($data_opd_replikasi->opd) ?> OPD</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Data Kode OPD <?php echo $nama_kota ?></div>
                                                                    <div class="widget-subheading">Untuk Penghubung Integrasi</div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="badge badge-info"><?php echo $hitung_kode_opd_provinsi ?> Data Provinsi</div><br>
                                                                    <div class="badge badge-info"><?php echo $hitung_kode_opd_replikasi ?> Data Replikasi</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                   
                                                </ul>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <ul class="list-group list-group-flush">
                                                    

                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Kecocokan kode OPD</div>
                                                                    <div class="widget-subheading">Antara data OPD di Simbangda Provinsi dengan Simbangda Replikasi</div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="badge badge-info"><?php echo $hitung_kode_opd_replikasi ?> OPD</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Pengambilan Data Integrasi</div>
                                                                    <?php if ($hitung_kode_opd_replikasi==$hitung_kode_opd_provinsi && $hitung_kode_opd_replikasi ==count($data_opd)) { 
                                                                        $tombol_ambil_data_replikasi = '<a href="'.base_url().'integrated/api/replikasi_sbe/preview_data_replikasi" class="btn btn-success btn-lg" >Preview data Replikasi</a>';
                                                                        ?>
                                                                    <div class="widget-subheading">Etiam sit amet orci eget eros faucibus</div>
                                                                   <?php }else{
                                                                        $tombol_ambil_data_replikasi = '<button class="btn btn-danger btn-lg" onclick="Swal.fire(`Tidak diizinkan`,`Harap lengkapu dulu data kode OPD dan harus sama antara simbangda provinsi dengan simbangda`,`error`)">Preview data Replikasi</button>'.' <a href="'.base_url().'integrated/api/replikasi_sbe/preview_data_replikasi" class="btn btn-success btn-lg" >Preview data Replikasi (Sementara)</a>';
                                                                    ?>
                                                                    <div class="widget-subheading">Tidak di izinkan melakukan penarikan data <br>Harap lengkapi dulu kode OPD dan cocok antara data OPD Provinsi dengan data OPD Replikasi</div>

                                                                   <?php } ?>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </li>
                                                   
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-block text-right card-footer">
                                            <?php echo $tombol_ambil_data_replikasi ?>
                                            
                                        </div>
                                    </div>

<?php echo $show_data ?>
<?php }else{ ?>
<div class="card-shadow-primary card-border mb-3 profile-responsive card">
                                   
                                    <ul class="list-group list-group-flush">

                                        <li class="bg-warm-flame list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading text-dark opacity-7">Progress Replikasi Simbangda Based Evidence</div>
                                                    <div class="widget-subheading opacity-10">
                                                        
                                                        <span class="pr-2">
                                                            <b class="text-primary">
                                                            <?php echo $tahap_replikasi[$config_kab_kota['replikasi']] ?>                                                           
                                                            </b>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="widget-heading text-dark opacity-7"><b> Terintegrasikan</b></div>
                                                    <div class="widget-subheading opacity-10">
                                                        
                                                        <span class="pr-2" style="text-align: right">
                                                            <b class="text-danger" >
                                                            <?php echo $terintegrasikan[$config_kab_kota['integrasi_replikasi']] ?>                                                                
                                                            </b>
                                                        </span>
                                                    </div>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </li>

                                   
                                        <li class="p-0 list-group-item">
                                            <div class="widget-content">
                                                <div class="row">
                                                    
                                                    <div class="col-md-6 col-xl-3">
                                                        Aplikasi anda belum terintegrasi <br>
                                                        Silahkan hubungi Admin untuk mengaktifkan integrasi
                                                    </div>
                                                </div>

                                            </div>
                                        </li>

                                        
                                        
                                    </ul>

                                </div>



<?php } ?>