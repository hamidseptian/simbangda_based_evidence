<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/
?>
<!-- Modal input-->
<div class="modal fade" id="data_realisasi_fisik" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data realisasi fisik </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table">
                   <tr>
                       <th>No</th>
                       <th>SKPD</th>
                       <th>Singkatan SKPD</th>
                       <th>Realisasi Fisik</th>
                   </tr>
                   <?php 
                   $no_rf = 1;
                   foreach ($grafik_realisasi_fisik as $v) { ?>
                      <tr>
                           <td><?php echo $no_rf++ ?></td>
                           <td><?php echo $v['skpd'] ?></td>
                           <td><?php echo $v['singkatan_skpd'] ?></td>
                           <td><?php echo $v['rf'] ?></td>
                       </tr>
                   <?php } ?>
               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="data_realisasi_fisik_asisten_1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data realisasi fisik <br>Asisten 1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table">
                   <tr>
                       <th>No</th>
                       <th>SKPD</th>
                       <th>Singkatan SKPD</th>
                       <th>Realisasi Fisik</th>
                   </tr>
                   <?php 
                   $no_rf = 1;
                   foreach ($grafik_realisasi_fisik_asisten['asisten_1'] as $v) { ?>
                      <tr>
                           <td><?php echo $no_rf++ ?></td>
                           <td><?php echo $v['skpd'] ?></td>
                           <td><?php echo $v['singkatan_skpd'] ?></td>
                           <td><?php echo $v['rf'] ?></td>
                       </tr>
                   <?php } ?>
               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="data_realisasi_fisik_asisten_2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data realisasi fisik <br>Asisten 2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table">
                   <tr>
                       <th>No</th>
                       <th>SKPD</th>
                       <th>Singkatan SKPD</th>
                       <th>Realisasi Fisik</th>
                   </tr>
                   <?php 
                   $no_rf = 1;
                   foreach ($grafik_realisasi_fisik_asisten['asisten_2'] as $v) { ?>
                      <tr>
                           <td><?php echo $no_rf++ ?></td>
                           <td><?php echo $v['skpd'] ?></td>
                           <td><?php echo $v['singkatan_skpd'] ?></td>
                           <td><?php echo $v['rf'] ?></td>
                       </tr>
                   <?php } ?>
               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="data_realisasi_fisik_asisten_3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data realisasi fisik <br>Asisten 3</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table">
                   <tr>
                       <th>No</th>
                       <th>SKPD</th>
                       <th>Singkatan SKPD</th>
                       <th>Realisasi Fisik</th>
                   </tr>
                   <?php 
                   $no_rf = 1;
                   foreach ($grafik_realisasi_fisik_asisten['asisten_3'] as $v) { ?>
                      <tr>
                           <td><?php echo $no_rf++ ?></td>
                           <td><?php echo $v['skpd'] ?></td>
                           <td><?php echo $v['singkatan_skpd'] ?></td>
                           <td><?php echo $v['rf'] ?></td>
                       </tr>
                   <?php } ?>
               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>















<div class="modal fade" id="data_realisasi_keuangan_asisten_1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data realisasi keuangan <br>Asisten 1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table">
                   <tr>
                       <th>No</th>
                       <th>SKPD</th>
                       <th>Singkatan SKPD</th>
                       <th>Realisasi keuangan</th>
                   </tr>
                   <?php 
                   $no_rf = 1;
                   foreach ($grafik_realisasi_keuangan_asisten['asisten_1'] as $v) { ?>
                      <tr>
                           <td><?php echo $no_rf++ ?></td>
                           <td><?php echo $v['skpd'] ?></td>
                           <td><?php echo $v['singkatan_skpd'] ?></td>
                           <td><?php echo $v['rk'] ?></td>
                       </tr>
                   <?php } ?>
               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="data_realisasi_keuangan_asisten_2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data realisasi keuangan <br>Asisten 2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table">
                   <tr>
                       <th>No</th>
                       <th>SKPD</th>
                       <th>Singkatan SKPD</th>
                       <th>Realisasi keuangan</th>
                   </tr>
                   <?php 
                   $no_rf = 1;
                   foreach ($grafik_realisasi_keuangan_asisten['asisten_2'] as $v) { ?>
                      <tr>
                           <td><?php echo $no_rf++ ?></td>
                           <td><?php echo $v['skpd'] ?></td>
                           <td><?php echo $v['singkatan_skpd'] ?></td>
                           <td><?php echo $v['rk'] ?></td>
                       </tr>
                   <?php } ?>
               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="data_realisasi_keuangan_asisten_3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data realisasi keuangan <br>Asisten 3</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table">
                   <tr>
                       <th>No</th>
                       <th>SKPD</th>
                       <th>Singkatan SKPD</th>
                       <th>Realisasi keuangan</th>
                   </tr>
                   <?php 
                   $no_rf = 1;
                   foreach ($grafik_realisasi_keuangan_asisten['asisten_3'] as $v) { ?>
                      <tr>
                           <td><?php echo $no_rf++ ?></td>
                           <td><?php echo $v['skpd'] ?></td>
                           <td><?php echo $v['singkatan_skpd'] ?></td>
                           <td><?php echo $v['rk'] ?></td>
                       </tr>
                   <?php } ?>
               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>






<!-- Modal input-->
<div class="modal fade" id="data_realisasi_keuangan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data realisasi keuangan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table">
                   <tr>
                       <th>No</th>
                       <th>SKPD</th>
                       <th>Singkatan SKPD</th>
                       <th>Realisasi keuangan</th>
                   </tr>
                   <?php 
                   $no_rf = 1;
                   foreach ($grafik_realisasi_keuangan as $v) { ?>
                      <tr>
                           <td><?php echo $no_rf++ ?></td>
                           <td><?php echo $v['skpd'] ?></td>
                           <td><?php echo $v['singkatan_skpd'] ?></td>
                           <td><?php echo $v['rk'] ?></td>
                       </tr>
                   <?php } ?>
               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>


<!-- Modal input-->
<div class="modal fade" id="data_deviasi_keuangan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data deviasi keuangan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table">
                   <tr>
                       <th>No</th>
                       <th>SKPD</th>
                       <th>Singkatan SKPD</th>
                       <th>deviasi keuangan</th>
                   </tr>
                   <?php 
                   $no_rf = 1;
                   foreach ($grafik_deviasi_keuangan as $v) { ?>
                      <tr>
                           <td><?php echo $no_rf++ ?></td>
                           <td><?php echo $v['skpd'] ?></td>
                           <td><?php echo $v['singkatan_skpd'] ?></td>
                           <td><?php echo $v['dk'] ?></td>
                       </tr>
                   <?php } ?>
               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>


<!-- Modal input-->
<div class="modal fade" id="data_deviasi_fisik" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data deviasi fisik </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <table class="table">
                   <tr>
                       <th>No</th>
                       <th>SKPD</th>
                       <th>Singkatan SKPD</th>
                       <th>deviasi fisik</th>
                   </tr>
                   <?php 
                   $no_rf = 1;
                   foreach ($grafik_deviasi_fisik as $v) { ?>
                      <tr>
                           <td><?php echo $no_rf++ ?></td>
                           <td><?php echo $v['skpd'] ?></td>
                           <td><?php echo $v['singkatan_skpd'] ?></td>
                           <td><?php echo $v['df'] ?></td>
                       </tr>
                   <?php } ?>
               </table>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>



<!-- Modal input-->
<div class="modal fade" id="data_deviasi_fisik_lingkaran" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik Lingkaran Deviasi Fisik </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                              <div id="grafik_deviasi_fisik"></div>
                                            <?php 
                                            $persentasi_dev_f_hijau = ($grafik_deviasi['statistika_fisik']['hijau']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_f_ungu = ($grafik_deviasi['statistika_fisik']['ungu']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_f_kuning = ($grafik_deviasi['statistika_fisik']['kuning']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_f_merah = ($grafik_deviasi['statistika_fisik']['merah']/$grafik_deviasi['total_opd']) * 100; 
                                            ?>

                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Keterangan</td>
                                                    <td>Banyak OPD</td>
                                                    <td>Persentasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="background:#ff7cfd"></td>
                                                    <td>Deviasi Diluar Perencanaan</td>
                                                    <td><?php echo $grafik_deviasi['statistika_fisik']['ungu'] ?> OPD</td>
                                                    <td><?php echo round($persentasi_dev_f_ungu,2) ?>%</td>
                                                </tr>
                                                <tr>

                                                    <td style="background:#d5f5e3"></td>
                                                    <td>Deviasi dibawah -5%</td>
                                                    <td><?php echo $grafik_deviasi['statistika_fisik']['hijau'] ?> OPD</td>
                                                    <td><?php echo round($persentasi_dev_f_hijau,2) ?>%</td>
                                                </tr>
                                                <tr>

                                                    <td style="background:#fcf3cf"></td>
                                                    <td>Deviasi antara -5% s/d -10%</td>
                                                    <td><?php echo $grafik_deviasi['statistika_fisik']['kuning'] ?> OPD</td>
                                                    <td><?php echo round($persentasi_dev_f_kuning,2) ?>%</td>
                                                </tr>
                                                <tr>

                                                    <td style="background:#f8b2b2"></td>
                                                    <td>Deviasi diatas -10%</td>
                                                    <td><?php echo $grafik_deviasi['statistika_fisik']['merah'] ?> OPD</td>
                                                    <td><?php echo round($persentasi_dev_f_merah,2) ?>%</td>
                                                </tr>
                                            </table>
                                            <!-- bagian grafik fisik -->
 

                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#dev_f_merah" class="nav-link active show">Deviasi Fisik Diatas -10%</a></li>
                                                <li class="nav-item" style="background:#fcf3cf"><a data-toggle="tab" href="#dev_f_kuning" class="nav-link show">Deviasi Fisik Antara -5% s/d -10%</a></li>
                                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab" href="#dev_f_hijau" class="nav-link">Deviasi Fisik Dibawah -5%</a></li>
                                                <li class="nav-item" style="background:#ff7cfd"><a data-toggle="tab" href="#dev_f_ungu" class="nav-link">Deviasi Diluar Perencanaan</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="dev_f_merah" role="tabpanel">
                                                    <?php 
                                                    if ($grafik_deviasi['statistika_fisik']['merah']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                        <div class="card-header">
                                                        Data deviasi fisik diatas 10 %
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Deviasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_f_merah =1;
                                                            asort($grafik_deviasi['f_merah']);
                                                            asort($grafik_deviasi['f_kuninf']);
                                                            asort($grafik_deviasi['hijau']);
                                                            asort($grafik_deviasi['ungu']);
                                                            foreach ($grafik_deviasi['f_merah'] as $k_f_merah => $v_f_merah) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_f_merah++ ?></td>
                                                                    <td><?php echo $v_f_merah['skpd'] ?></td>
                                                                    <td><?php echo $v_f_merah['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v_f_merah['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v_f_merah['rf'] ?></td> -->
                                                                    <td><?php echo $v_f_merah['df'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane show" id="dev_f_kuning" role="tabpanel">
                                                      <?php 
                                                    if ($grafik_deviasi['statistika_fisik']['kuning']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data deviasi fisik antara -5 s/d -10 %
                                                         </div>
                                                        
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td> 
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Deviasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_f_kuning =1;
                                                            foreach ($grafik_deviasi['f_kuning'] as $k_f_kuning => $v_f_kuning) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_f_kuning++ ?></td>
                                                                    <td><?php echo $v_f_kuning['skpd'] ?></td>

                                                                    <td><?php echo $v_f_kuning['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v_f_kuning['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v_f_kuning['rf'] ?></td> -->
                                                                    <td><?php echo $v_f_kuning['df'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>


                                                </div>
                                                <div class="tab-pane" id="dev_f_hijau" role="tabpanel">
                                                   



                                                      <?php 
                                                    if ($grafik_deviasi['statistika_fisik']['hijau']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data deviasi fisik dibawah -5 %
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td> 
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Deviasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_f_hijau =1;
                                                            foreach ($grafik_deviasi['f_hijau'] as $k_f_hijau => $v_f_hijau) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_f_hijau++ ?></td>
                                                                    <td><?php echo $v_f_hijau['skpd'] ?></td>

                                                                    <td><?php echo $v_f_hijau['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v_f_hijau['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v_f_hijau['rf'] ?></td> -->
                                                                    <td><?php echo $v_f_hijau['df'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>




                                                </div>
                                                <div class="tab-pane" id="dev_f_ungu" role="tabpanel">
                                                   



                                                      <?php 
                                                    if ($grafik_deviasi['statistika_fisik']['ungu']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">

                                                          <div class="card-header">
                                                        Data deviasi diluar perencanaan (positif)
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan SKPD</td>
                                                                <!-- <td>T</td>
                                                                <td>R</td> -->
                                                                <td>Deviasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_f_hijau =1;
                                                            foreach ($grafik_deviasi['f_ungu'] as $k_f_hijau => $v_f_hijau) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_f_hijau++ ?></td>
                                                                    <td><?php echo $v_f_hijau['skpd'] ?></td>

                                                                    <td><?php echo $v_f_ungu['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v_f_hijau['tf'] ?></td>  
                                                                      <td><?php echo $v_f_hijau['rf'] ?></td> -->
                                                                    <td><?php echo $v_f_hijau['df'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>




                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>


                            </div>







                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>



<!-- Modal input-->
<div class="modal fade" id="data_deviasi_keuangan_lingkaran" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik Lingkaran Deviasi keuangan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                              <div id="grafik_deviasi_keuangan"></div>
                                            <?php 
                                            $persentasi_dev_k_hijau = ($grafik_deviasi['statistika_keuangan']['hijau']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_k_ungu = ($grafik_deviasi['statistika_keuangan']['ungu']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_k_kuning = ($grafik_deviasi['statistika_keuangan']['kuning']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_k_merah = ($grafik_deviasi['statistika_keuangan']['merah']/$grafik_deviasi['total_opd']) * 100; 
                                            ?>

                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Keterangan</td>
                                                    <td>Banyak OPD</td>
                                                    <td>Persentasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="background:#ff7cfd"></td>
                                                    <td>Deviasi Diluar Perencanaan</td>
                                                    <td><?php echo $grafik_deviasi['statistika_keuangan']['ungu'] ?> OPD</td>
                                                    <td><?php echo round($persentasi_dev_k_ungu,2) ?>%</td>
                                                </tr>
                                                <tr>

                                                    <td style="background:#d5f5e3"></td>
                                                    <td>Deviasi dibawah -5%</td>
                                                    <td><?php echo $grafik_deviasi['statistika_keuangan']['hijau'] ?> OPD</td>
                                                    <td><?php echo round($persentasi_dev_k_hijau,2) ?>%</td>
                                                </tr>
                                                <tr>

                                                    <td style="background:#fcf3cf"></td>
                                                    <td>Deviasi antara -5% s/d -10%</td>
                                                    <td><?php echo $grafik_deviasi['statistika_keuangan']['kuning'] ?> OPD</td>
                                                    <td><?php echo round($persentasi_dev_k_kuning,2) ?>%</td>
                                                </tr>
                                                <tr>

                                                    <td style="background:#f8b2b2"></td>
                                                    <td>Deviasi diatas -10%</td>
                                                    <td><?php echo $grafik_deviasi['statistika_keuangan']['merah'] ?> OPD</td>
                                                    <td><?php echo round($persentasi_dev_k_merah,2) ?>%</td>
                                                </tr>
                                            </table>
                                            <!-- bagian grafik keuangan -->
 

                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#dev_k_merah" class="nav-link active show">Deviasi keuangan Diatas -10%</a></li>
                                                <li class="nav-item" style="background:#fcf3cf"><a data-toggle="tab" href="#dev_k_kuning" class="nav-link show">Deviasi keuangan Antara -5% s/d -10%</a></li>
                                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab" href="#dev_k_hijau" class="nav-link">Deviasi keuangan Dibawah -5%</a></li>
                                                <li class="nav-item" style="background:#ff7cfd"><a data-toggle="tab" href="#dev_k_ungu" class="nav-link">Deviasi Diluar Perencanaan</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="dev_k_merah" role="tabpanel">
                                                    <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['merah']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                        <div class="card-header">
                                                        Data deviasi keuangan diatas 10 %
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Deviasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_k_merah =1;
                                                            asort($grafik_deviasi['k_merah']);
                                                            asort($grafik_deviasi['k_kuning']);
                                                            asort($grafik_deviasi['hijau']);
                                                            asort($grafik_deviasi['ungu']);
                                                            foreach ($grafik_deviasi['k_merah'] as $k_k_merah => $v_k_merah) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_k_merah++ ?></td>
                                                                    <td><?php echo $v_k_merah['skpd'] ?></td>
                                                                    <td><?php echo $v_k_merah['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v_k_merah['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v_k_merah['rf'] ?></td> -->
                                                                    <td><?php echo $v_k_merah['dk'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane show" id="dev_k_kuning" role="tabpanel">
                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['kuning']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data deviasi keuangan antara -5 s/d -10 %
                                                         </div>
                                                        
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td> 
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Deviasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_k_kuning =1;
                                                            foreach ($grafik_deviasi['k_kuning'] as $k_k_kuning => $v_k_kuning) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_k_kuning++ ?></td>
                                                                    <td><?php echo $v_k_kuning['skpd'] ?></td>

                                                                    <td><?php echo $v_k_kuning['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v_k_kuning['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v_k_kuning['rf'] ?></td> -->
                                                                    <td><?php echo $v_k_kuning['dk'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>


                                                </div>
                                                <div class="tab-pane" id="dev_k_hijau" role="tabpanel">
                                                   



                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['hijau']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data deviasi keuangan dibawah -5 %
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td> 
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Deviasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_k_hijau =1;
                                                            foreach ($grafik_deviasi['k_hijau'] as $k_k_hijau => $v_k_hijau) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_k_hijau++ ?></td>
                                                                    <td><?php echo $v_k_hijau['skpd'] ?></td>

                                                                    <td><?php echo $v_k_hijau['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v_k_hijau['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v_k_hijau['rf'] ?></td> -->
                                                                    <td><?php echo $v_k_hijau['dk'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>




                                                </div>
                                                <div class="tab-pane" id="dev_k_ungu" role="tabpanel">
                                                   



                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['ungu']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">

                                                          <div class="card-header">
                                                        Data deviasi diluar perencanaan (positif)
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan SKPD</td>
                                                                <!-- <td>T</td>
                                                                <td>R</td> -->
                                                                <td>Deviasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_k_hijau =1;
                                                            foreach ($grafik_deviasi['k_ungu'] as $k_k_hijau => $v_k_hijau) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_k_hijau++ ?></td>
                                                                    <td><?php echo $v_k_hijau['skpd'] ?></td>

                                                                    <td><?php echo $v_k_ungu['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v_k_hijau['tf'] ?></td>  
                                                                      <td><?php echo $v_k_hijau['rf'] ?></td> -->
                                                                    <td><?php echo $v_k_hijau['dk'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>




                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>


                            </div>







                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>










<!-- Modal input-->
<div class="modal fade" id="data_realisasi_fisik_lingkaran_semua" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik Lingkaran Realisasi Fisik </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                              <div id="grafik_realisasi_fisik_semua"></div>
                                            <?php 
                                            $persentasi_dev_k_hijau = ($grafik_deviasi['statistika_keuangan']['hijau']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_k_ungu = ($grafik_deviasi['statistika_keuangan']['ungu']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_k_kuning = ($grafik_deviasi['statistika_keuangan']['kuning']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_k_merah = ($grafik_deviasi['statistika_keuangan']['merah']/$grafik_deviasi['total_opd']) * 100; 
                                            ?>

                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Keterangan</td>
                                                    <td>Banyak OPD</td>
                                                    <td>Persentasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="background:#d5f5e3"></td>
                                                    <td>Diatas Rata-rata</td>
                                                    <td><?php echo count($eeeeeeeee['fisik']['data']['diatas_rata_rata']['semua']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['fisik']['persentasi']['diatas_rata_rata']['semua'],2) ?>%</td>
                                                   
                                                </tr>
                                               
                                                <tr>

                                                    <td style="background:#f8b2b2"></td>
                                                    <td>Dibawah Rata-rata%</td>
                                                    <td><?php echo count($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['semua']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['fisik']['persentasi']['dibawah_rata_rata']['semua'],2) ?>%</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab" href="#f_semua_diatas_ratarata" class="nav-link active show">Diatas Ratarata</a></li>
                                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#f_semua_dibawah_ratarata" class="nav-link show">Dibawah Ratarata</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="f_semua_diatas_ratarata" role="tabpanel">
                                                    <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['merah']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                    <div style="overflow-y: scroll; height: 540px">
                                                        <div class="card-header">
                                                        Data Realisasi Fisik Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_fisik_semua_diatas =1;
                                                            arsort($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['semua']);
                                                            arsort($eeeeeeeee['fisik']['data']['diatas_rata_rata']['semua']);
                                                            foreach ($eeeeeeeee['fisik']['data']['diatas_rata_rata']['semua'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_fisik_semua_diatas++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rf'] ?></td> -->
                                                                    <td><?php echo $v['rf'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane show" id="f_semua_dibawah_ratarata" role="tabpanel">
                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['kuning']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data Realisasi Fisik Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_fisik_semua_dibawah =1;
                                                            asort($grafik_deviasi['k_merah']);
                                                            asort($grafik_deviasi['k_kuning']);
                                                            asort($grafik_deviasi['hijau']);
                                                            asort($grafik_deviasi['ungu']);
                                                            foreach ($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['semua'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_fisik_semua_dibawah++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rf'] ?></td> -->
                                                                    <td><?php echo $v['rf'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>












<!-- Modal input-->
<div class="modal fade" id="data_realisasi_fisik_lingkaran_asisten_1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik Lingkaran Realisasi Fisik <br>Asisten 1 </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                              <div id="grafik_lingkaran_realisasi_fisik_asisten_1"></div>
                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Keterangan</td>
                                                    <td>Banyak OPD</td>
                                                    <td>Persentasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="background:#d5f5e3"></td>
                                                    <td>Diatas Rata-rata</td>
                                                    <td><?php echo count($eeeeeeeee['fisik']['data']['diatas_rata_rata']['asisten_1']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['fisik']['persentasi']['diatas_rata_rata']['asisten_1'],2) ?>%</td>
                                                   
                                                </tr>
                                               
                                                <tr>

                                                    <td style="background:#f8b2b2"></td>
                                                    <td>Dibawah Rata-rata%</td>
                                                    <td><?php echo count($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['asisten_1']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['fisik']['persentasi']['dibawah_rata_rata']['asisten_1'],2) ?>%</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab" href="#f_asisten_1_diatas_ratarata" class="nav-link active show">Diatas Ratarata</a></li>
                                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#f_asisten_1_dibawah_ratarata" class="nav-link show">Dibawah Ratarata</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="f_asisten_1_diatas_ratarata" role="tabpanel">
                                                    <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['merah']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                    <div style="overflow-y: scroll; height: 540px">
                                                        <div class="card-header">
                                                        Data Realisasi Fisik Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_fisik_asisten_1_diatas =1;
                                                            arsort($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['asisten_1']);
                                                            arsort($eeeeeeeee['fisik']['data']['diatas_rata_rata']['asisten_1']);
                                                            foreach ($eeeeeeeee['fisik']['data']['diatas_rata_rata']['asisten_1'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_fisik_asisten_1_diatas++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rf'] ?></td> -->
                                                                    <td><?php echo $v['rf'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane show" id="f_asisten_1_dibawah_ratarata" role="tabpanel">
                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['kuning']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data Realisasi Fisik Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_fisik_asisten_1_dibawah =1;
                                                            asort($grafik_deviasi['k_merah']);
                                                            asort($grafik_deviasi['k_kuning']);
                                                            asort($grafik_deviasi['hijau']);
                                                            asort($grafik_deviasi['ungu']);
                                                            foreach ($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['asisten_1'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_fisik_asisten_1_dibawah++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rf'] ?></td> -->
                                                                    <td><?php echo $v['rf'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>













<!-- Modal input-->
<div class="modal fade" id="data_realisasi_fisik_lingkaran_asisten_2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik Lingkaran Realisasi Fisik <br>Asisten 2 </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                              <div id="grafik_lingkaran_realisasi_fisik_asisten_2"></div>
                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Keterangan</td>
                                                    <td>Banyak OPD</td>
                                                    <td>Persentasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="background:#d5f5e3"></td>
                                                    <td>Diatas Rata-rata</td>
                                                    <td><?php echo count($eeeeeeeee['fisik']['data']['diatas_rata_rata']['asisten_2']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['fisik']['persentasi']['diatas_rata_rata']['asisten_2'],2) ?>%</td>
                                                   
                                                </tr>
                                               
                                                <tr>

                                                    <td style="background:#f8b2b2"></td>
                                                    <td>Dibawah Rata-rata%</td>
                                                    <td><?php echo count($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['asisten_2']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['fisik']['persentasi']['dibawah_rata_rata']['asisten_2'],2) ?>%</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab" href="#f_asisten_2_diatas_ratarata" class="nav-link active show">Diatas Ratarata</a></li>
                                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#f_asisten_2_dibawah_ratarata" class="nav-link show">Dibawah Ratarata</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="f_asisten_2_diatas_ratarata" role="tabpanel">
                                                    <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['merah']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                    <div style="overflow-y: scroll; height: 540px">
                                                        <div class="card-header">
                                                        Data Realisasi Fisik Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_fisik_asisten_2_diatas =1;
                                                            arsort($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['asisten_2']);
                                                            arsort($eeeeeeeee['fisik']['data']['diatas_rata_rata']['asisten_2']);
                                                            foreach ($eeeeeeeee['fisik']['data']['diatas_rata_rata']['asisten_2'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_fisik_asisten_2_diatas++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rf'] ?></td> -->
                                                                    <td><?php echo $v['rf'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane show" id="f_asisten_2_dibawah_ratarata" role="tabpanel">
                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['kuning']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data Realisasi Fisik Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_fisik_asisten_2_dibawah =1;
                                                            asort($grafik_deviasi['k_merah']);
                                                            asort($grafik_deviasi['k_kuning']);
                                                            asort($grafik_deviasi['hijau']);
                                                            asort($grafik_deviasi['ungu']);
                                                            foreach ($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['asisten_2'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_fisik_asisten_2_dibawah++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rf'] ?></td> -->
                                                                    <td><?php echo $v['rf'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>














<!-- Modal input-->
<div class="modal fade" id="data_realisasi_fisik_lingkaran_asisten_3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik Lingkaran Realisasi Fisik <br>Asisten 3 </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                              <div id="grafik_lingkaran_realisasi_fisik_asisten_3"></div>
                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Keterangan</td>
                                                    <td>Banyak OPD</td>
                                                    <td>Persentasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="background:#d5f5e3"></td>
                                                    <td>Diatas Rata-rata</td>
                                                    <td><?php echo count($eeeeeeeee['fisik']['data']['diatas_rata_rata']['asisten_3']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['fisik']['persentasi']['diatas_rata_rata']['asisten_3'],2) ?>%</td>
                                                   
                                                </tr>
                                               
                                                <tr>

                                                    <td style="background:#f8b2b2"></td>
                                                    <td>Dibawah Rata-rata%</td>
                                                    <td><?php echo count($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['asisten_3']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['fisik']['persentasi']['dibawah_rata_rata']['asisten_3'],2) ?>%</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab" href="#f_asisten_3_diatas_ratarata" class="nav-link active show">Diatas Ratarata</a></li>
                                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#f_asisten_3_dibawah_ratarata" class="nav-link show">Dibawah Ratarata</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="f_asisten_3_diatas_ratarata" role="tabpanel">
                                                    <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['merah']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                    <div style="overflow-y: scroll; height: 540px">
                                                        <div class="card-header">
                                                        Data Realisasi Fisik Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_fisik_asisten_3_diatas =1;
                                                            arsort($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['asisten_3']);
                                                            arsort($eeeeeeeee['fisik']['data']['diatas_rata_rata']['asisten_3']);
                                                            foreach ($eeeeeeeee['fisik']['data']['diatas_rata_rata']['asisten_3'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_fisik_asisten_3_diatas++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rf'] ?></td> -->
                                                                    <td><?php echo $v['rf'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane show" id="f_asisten_3_dibawah_ratarata" role="tabpanel">
                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['kuning']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data Realisasi Fisik Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_fisik_asisten_3_dibawah =1;
                                                            asort($grafik_deviasi['k_merah']);
                                                            asort($grafik_deviasi['k_kuning']);
                                                            asort($grafik_deviasi['hijau']);
                                                            asort($grafik_deviasi['ungu']);
                                                            foreach ($eeeeeeeee['fisik']['data']['dibawah_rata_rata']['asisten_3'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_fisik_asisten_3_dibawah++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rf'] ?></td> -->
                                                                    <td><?php echo $v['rf'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>









<!-- Modal input-->
<div class="modal fade" id="data_realisasi_keuangan_lingkaran_semua" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik Lingkaran Realisasi keuangan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                              <div id="grafik_lingkaran_realisasi_keuangan_semua"></div>
                                            <?php 
                                            $persentasi_dev_k_hijau = ($grafik_deviasi['statistika_keuangan']['hijau']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_k_ungu = ($grafik_deviasi['statistika_keuangan']['ungu']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_k_kuning = ($grafik_deviasi['statistika_keuangan']['kuning']/$grafik_deviasi['total_opd']) * 100; 
                                            $persentasi_dev_k_merah = ($grafik_deviasi['statistika_keuangan']['merah']/$grafik_deviasi['total_opd']) * 100; 
                                            ?>

                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Keterangan</td>
                                                    <td>Banyak OPD</td>
                                                    <td>Persentasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="background:#d5f5e3"></td>
                                                    <td>Diatas Rata-rata</td>
                                                    <td><?php echo count($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['semua']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['keuangan']['persentasi']['diatas_rata_rata']['semua'],2) ?>%</td>
                                                   
                                                </tr>
                                               
                                                <tr>

                                                    <td style="background:#f8b2b2"></td>
                                                    <td>Dibawah Rata-rata%</td>
                                                    <td><?php echo count($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['semua']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['keuangan']['persentasi']['dibawah_rata_rata']['semua'],2) ?>%</td>
                                                </tr>
                                            </table>
                                            <!-- bagian grafik keuangan -->
 

                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab" href="#k_semua_diatas_ratarata" class="nav-link active show">Diatas Ratarata</a></li>
                                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#k_semua_dibawah_ratarata" class="nav-link show">Dibawah Ratarata</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="k_semua_diatas_ratarata" role="tabpanel">
                                                    <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['merah']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                        <div class="card-header">
                                                        Data Realisasi keuangan Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_keuangan_semua_diatas =1;
                                                            arsort($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['semua']);
                                                            arsort($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['semua']);
                                                            foreach ($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['semua'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_keuangan_semua_diatas++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rf'] ?></td> -->
                                                                    <td><?php echo $v['rf'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane show" id="k_semua_dibawah_ratarata" role="tabpanel">
                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['kuning']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data Realisasi keuangan Diatas Ratarata
                                                         </div>
                                                        
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_keuangan_semua_dibawah =1;
                                                            asort($grafik_deviasi['k_merah']);
                                                            asort($grafik_deviasi['k_kuning']);
                                                            asort($grafik_deviasi['hijau']);
                                                            asort($grafik_deviasi['ungu']);
                                                            foreach ($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['semua'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_keuangan_semua_dibawah++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tf'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rf'] ?></td> -->
                                                                    <td><?php echo $v['rf'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                    </div>
                                                <?php } ?>


                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>


                            </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>









<!-- Modal input-->
<div class="modal fade" id="data_realisasi_keuangan_lingkaran_asisten_1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik Lingkaran Realisasi keuangan <br>Asisten 1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                              <div id="grafik_lingkaran_realisasi_keuangan_asisten_1"></div>

                                           
                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Keterangan</td>
                                                    <td>Banyak OPD</td>
                                                    <td>Persentasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="background:#d5f5e3"></td>
                                                    <td>Diatas Rata-rata</td>
                                                    <td><?php echo count($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['asisten_1']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['keuangan']['persentasi']['diatas_rata_rata']['asisten_1'],2) ?>%</td>
                                                   
                                                </tr>
                                               
                                                <tr>

                                                    <td style="background:#f8b2b2"></td>
                                                    <td>Dibawah Rata-rata%</td>
                                                    <td><?php echo count($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['asisten_1']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['keuangan']['persentasi']['dibawah_rata_rata']['asisten_1'],2) ?>%</td>
                                                </tr>
                                            </table>
                                            <!-- bagian grafik keuangan -->
 

                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab" href="#k_asisten_1_diatas_ratarata" class="nav-link active show">Diatas Ratarata</a></li>
                                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#k_asisten_1_dibawah_ratarata" class="nav-link show">Dibawah Ratarata</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="k_asisten_1_diatas_ratarata" role="tabpanel">
                                                    <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['merah']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                        <div class="card-header">
                                                        Data Realisasi keuangan Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_keuangan_asisten_1_diatas =1;
                                                            arsort($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['asisten_1']);
                                                            arsort($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['asisten_1']);
                                                            foreach ($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['asisten_1'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_keuangan_asisten_1_diatas++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tk'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rk'] ?></td> -->
                                                                    <td><?php echo $v['rk'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane show" id="k_asisten_1_dibawah_ratarata" role="tabpanel">
                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['kuning']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data Realisasi keuangan Diatas Ratarata
                                                         </div>
                                                        
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_keuangan_asisten_1_dibawah =1;
                                                            asort($grafik_deviasi['k_merah']);
                                                            asort($grafik_deviasi['k_kuning']);
                                                            asort($grafik_deviasi['hijau']);
                                                            asort($grafik_deviasi['ungu']);
                                                            foreach ($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['asisten_1'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_keuangan_asisten_1_dibawah++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tk'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rk'] ?></td> -->
                                                                    <td><?php echo $v['rk'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                    </div>
                                                <?php } ?>


                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>


                            </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>













<!-- Modal input-->
<div class="modal fade" id="data_realisasi_keuangan_lingkaran_asisten_2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik Lingkaran Realisasi keuangan <br>Asisten 2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                              <div id="grafik_lingkaran_realisasi_keuangan_asisten_2"></div>

                                           
                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Keterangan</td>
                                                    <td>Banyak OPD</td>
                                                    <td>Persentasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="background:#d5f5e3"></td>
                                                    <td>Diatas Rata-rata</td>
                                                    <td><?php echo count($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['asisten_2']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['keuangan']['persentasi']['diatas_rata_rata']['asisten_2'],2) ?>%</td>
                                                   
                                                </tr>
                                               
                                                <tr>

                                                    <td style="background:#f8b2b2"></td>
                                                    <td>Dibawah Rata-rata%</td>
                                                    <td><?php echo count($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['asisten_2']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['keuangan']['persentasi']['dibawah_rata_rata']['asisten_2'],2) ?>%</td>
                                                </tr>
                                            </table>
                                            <!-- bagian grafik keuangan -->
 

                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab" href="#k_asisten_2_diatas_ratarata" class="nav-link active show">Diatas Ratarata</a></li>
                                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#k_asisten_2_dibawah_ratarata" class="nav-link show">Dibawah Ratarata</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="k_asisten_2_diatas_ratarata" role="tabpanel">
                                                    <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['merah']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                        <div class="card-header">
                                                        Data Realisasi keuangan Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_keuangan_asisten_2_diatas =1;
                                                            arsort($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['asisten_2']);
                                                            arsort($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['asisten_2']);
                                                            foreach ($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['asisten_2'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_keuangan_asisten_2_diatas++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tk'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rk'] ?></td> -->
                                                                    <td><?php echo $v['rk'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane show" id="k_asisten_2_dibawah_ratarata" role="tabpanel">
                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['kuning']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data Realisasi keuangan Diatas Ratarata
                                                         </div>
                                                        
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_keuangan_asisten_2_dibawah =1;
                                                            asort($grafik_deviasi['k_merah']);
                                                            asort($grafik_deviasi['k_kuning']);
                                                            asort($grafik_deviasi['hijau']);
                                                            asort($grafik_deviasi['ungu']);
                                                            foreach ($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['asisten_2'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_keuangan_asisten_2_dibawah++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tk'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rk'] ?></td> -->
                                                                    <td><?php echo $v['rk'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                    </div>
                                                <?php } ?>


                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>


                            </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>














<!-- Modal input-->
<div class="modal fade" id="data_realisasi_keuangan_lingkaran_asisten_3" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik Lingkaran Realisasi keuangan <br>Asisten 3</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                              <div id="grafik_lingkaran_realisasi_keuangan_asisten_3"></div>

                                           
                                          
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3 card">
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Keterangan</td>
                                                    <td>Banyak OPD</td>
                                                    <td>Persentasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="background:#d5f5e3"></td>
                                                    <td>Diatas Rata-rata</td>
                                                    <td><?php echo count($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['asisten_3']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['keuangan']['persentasi']['diatas_rata_rata']['asisten_3'],2) ?>%</td>
                                                   
                                                </tr>
                                               
                                                <tr>

                                                    <td style="background:#f8b2b2"></td>
                                                    <td>Dibawah Rata-rata%</td>
                                                    <td><?php echo count($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['asisten_3']) ?> OPD</td>
                                                    <td><?php echo round($eeeeeeeee['keuangan']['persentasi']['dibawah_rata_rata']['asisten_3'],2) ?>%</td>
                                                </tr>
                                            </table>
                                            <!-- bagian grafik keuangan -->
 

                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="card-header card-header-tab-animation">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab" href="#k_asisten_3_diatas_ratarata" class="nav-link active show">Diatas Ratarata</a></li>
                                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#k_asisten_3_dibawah_ratarata" class="nav-link show">Dibawah Ratarata</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="k_asisten_3_diatas_ratarata" role="tabpanel">
                                                    <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['merah']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                        <div class="card-header">
                                                        Data Realisasi keuangan Diatas Ratarata
                                                         </div>
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_keuangan_asisten_3_diatas =1;
                                                            arsort($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['asisten_3']);
                                                            arsort($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['asisten_3']);
                                                            foreach ($eeeeeeeee['keuangan']['data']['diatas_rata_rata']['asisten_3'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_keuangan_asisten_3_diatas++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tk'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rk'] ?></td> -->
                                                                    <td><?php echo $v['rk'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <div class="tab-pane show" id="k_asisten_3_dibawah_ratarata" role="tabpanel">
                                                      <?php 
                                                    if ($grafik_deviasi['statistika_keuangan']['kuning']==0) {
                                                       echo "Tidak ada data";
                                                    }else{
                                                     ?>
                                                   
                                                    <div style="overflow-y: scroll; height: 540px">
                                                      <div class="card-header">
                                                        Data Realisasi keuangan Diatas Ratarata
                                                         </div>
                                                        
                                                        <table class="table">
                                                            <tr>
                                                                <td>No</td>
                                                                <td>SKPD</td>
                                                                <td>Singkatan </td>
                                                                <!-- <td>T</td> -->
                                                                <!-- <td>R</td> -->
                                                                <td>Realisasi</td>
                                                            </tr>
                                                            <?php 
                                                            $no_keuangan_asisten_3_dibawah =1;
                                                            asort($grafik_deviasi['k_merah']);
                                                            asort($grafik_deviasi['k_kuning']);
                                                            asort($grafik_deviasi['hijau']);
                                                            asort($grafik_deviasi['ungu']);
                                                            foreach ($eeeeeeeee['keuangan']['data']['dibawah_rata_rata']['asisten_3'] as $k => $v) { ?>
                                                                <tr>
                                                                    <td><?php echo $no_keuangan_asisten_3_dibawah++ ?></td>
                                                                    <td><?php echo $v['skpd'] ?></td>
                                                                    <td><?php echo $v['singkatan_skpd'] ?></td>
                                                                    <!-- <td><?php echo $v['tk'] ?></td> -->
                                                                    <!-- <td><?php echo $v['rk'] ?></td> -->
                                                                    <td><?php echo $v['rk'] ?></td>
                                                                
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                    </div>
                                                <?php } ?>


                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>


                            </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                
            </div>
        </div>
    </div>
</div>








