<style>
.font_laporan {
    font-size: 11px;
    font-family: 'arial';
}

th {
    text-align: center;

}
</style>

<div class="modal fade" id="modal_per_opd" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Per OPD <br>Akumulasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="mb-3 card">
                        <div class="card-header card-header-tab-animation">
                            <ul class="nav nav-justified">
                                <li class="nav-item" style="background:#f8b2b2"><a data-toggle="tab" href="#new_update"
                                        class="nav-link active show">New Update</a></li>
                                <li class="nav-item" style="background:#fcf3cf"><a data-toggle="tab"
                                        href="#berdasarkan_fisik" class="nav-link show">Perengkingan Berdasarkan
                                        Realisasi Fisik</a></li>
                                <li class="nav-item" style="background:#d5f5e3"><a data-toggle="tab"
                                        href="#berdasarkan_keuangan" class="nav-link">Perengkingan Berdasarkan Realisasi
                                        Keuangan</a></li>
                                <li class="nav-item" style="background:#ff7cfd"><a data-toggle="tab"
                                        href="#berdasarkan_deviasi" class="nav-link">Perengkingan Berdasarkan Deviasi
                                    </a></li>
                                <!-- <li class="nav-item" style="background:grey"><a data-toggle="tab" href="#pdf_rekap" class="nav-link">PDF Rekap Semua OPD <br> Per Asisten</a></li> -->
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="new_update" role="tabpanel"
                                    style="overflow-x:scroll">
                                    <table class="table table-striped table-bordered font_laporan">
                                        <thead class="header ">
                                            <tr>
                                                <th rowspan="3" width="20px">No</th>
                                                <th rowspan="3">SKPD</th>

                                                <th rowspan="3" style="width:100px"> Pagu</th>
                                                <th colspan="4"> Fisik</th>
                                                <th colspan="6"> Keuangan</th>


                                                <th rowspan="3">Last Update</th>

                                            </tr>


                                            <tr>
                                                <th>Target</th>
                                                <th>Realisasi</th>
                                                <th>Capaian</th>
                                                <th rowspan="2">Deviasi</th>
                                                <th colspan="2">Target</th>
                                                <th colspan="3">Realisasi</th>
                                                <th rowspan="2">Deviasi</th>
                                            </tr>
                                            <tr>
                                                <th>%</th>
                                                <th>%</th>
                                                <th>%</th>
                                                <th>Rp</th>
                                                <th>%</th>
                                                <th>Rp</th>
                                                <th>%</th>
                                                <th>% Capaian</th>
                                            </tr>
                                            <tr>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                                <th>6</th>
                                                <th>7=5-4</th>
                                                <th>8</th>
                                                <th>9=(8/3)*100</th>
                                                <th>10</th>
                                                <th>11=(10/3)*100</th>
                                                <th>12</th>
                                                <th>13=11-9</th>
                                                <th>14</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php  
														// var_dump($skpd);
														$no=0;
														foreach ($skpd as $v) { 
														$no++;
														 ?>
                                            <tr>
                                                <td align="center"><?php echo $no ?></td>
                                                <td><?php echo $v['nama_instansi'] ?></td>
                                                <td align="right"><?php echo number_format($v['pagu_total']) ?></td>

                                                <td align="center" <?php echo $v['blok_tf'] ?>><?php echo $v['tf'] ?>
                                                </td>
                                                <td align="center" <?php echo $v['blok_rf'] ?>><?php echo $v['rf'] ?>
                                                </td>
                                                <td align="center"><?php echo $v['cf'] ?></td>
                                                <td align="center" style="<?php echo $v['wf'] ?>"><?php echo $v['df'] ?>
                                                </td>
                                                <td align="right"><?php echo number_format($v['rp_target_keuangan']) ?>
                                                </td>
                                                <td align="center"><?php echo $v['tk'] ?></td>
                                                <td align="right">
                                                    <?php echo number_format($v['rp_realisasi_keuangan']) ?></td>
                                                <td align="center"><?php echo $v['rk'] ?></td>
                                                <td align="center"><?php echo $v['ck'] ?></td>
                                                <td align="center" style="<?php echo $v['wk'] ?>"><?php echo $v['dk'] ?>
                                                </td>

                                                <td><?php echo $v['last_update'] ?></td>
                                            </tr>


                                            <?php } ?>
                                        </tbody>







                                    </table>
                                </div>
                                <div class="tab-pane show" id="berdasarkan_fisik" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <table class="table table-striped table-bordered font_laporan">
                                                <thead class="header ">
                                                    <tr>
                                                        <th colspan="4" align="center">Tertinggi</th>
                                                    </tr>
                                                    <tr>
                                                        <th width="20px">No</th>
                                                        <th>SKPD</th>
                                                        <th> Fisik</th>
                                                        <th>Last Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
															// var_dump($skpd);
															$no=0;
															foreach (array_slice($fisik_tertinggi, 0,10, true) as $v) { 
															$no++;
															 ?>
                                                    <tr>
                                                        <td align="center"><?php echo $no ?></td>
                                                        <td><?php echo $v['nama_instansi'] ?></td>
                                                        <td align="center"><?php echo $v['rf'] ?></td>
                                                        <td><?php echo $v['last_update'] ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-striped table-bordered font_laporan">
                                                <thead class="header ">
                                                    <tr>
                                                        <th colspan="4" align="center">Terendah</th>
                                                    </tr>
                                                    <tr>
                                                        <th width="20px">No</th>
                                                        <th>SKPD</th>
                                                        <th> Fisik</th>
                                                        <th>Last Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
															// var_dump($skpd);
															$no=0;
															foreach (array_slice($fisik_terendah, 0,10, true) as $v) { 
															$no++;
															 ?>
                                                    <tr>
                                                        <td align="center"><?php echo $no ?></td>
                                                        <td><?php echo $v['nama_instansi'] ?></td>
                                                        <td align="center"><?php echo $v['rf'] ?></td>
                                                        <td><?php echo $v['last_update'] ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane" id="berdasarkan_keuangan" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <table class="table table-striped table-bordered font_laporan">
                                                <thead class="header ">
                                                    <tr>
                                                        <th colspan="4" align="center">Tertinggi</th>
                                                    </tr>
                                                    <tr>
                                                        <th width="20px">No</th>
                                                        <th>SKPD</th>
                                                        <th> Keuangan</th>
                                                        <th>Last Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
															// var_dump($skpd);
															$no=0;
															foreach (array_slice($keuangan_tertinggi, 0,10, true) as $v) { 
															$no++;
															 ?>
                                                    <tr>
                                                        <td align="center"><?php echo $no ?></td>
                                                        <td><?php echo $v['nama_instansi'] ?></td>
                                                        <td align="center"><?php echo $v['rk'] ?></td>
                                                        <td><?php echo $v['last_update'] ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-striped table-bordered font_laporan">
                                                <thead class="header ">
                                                    <tr>
                                                        <th colspan="4" align="center">Terendah</th>
                                                    </tr>
                                                    <tr>
                                                        <th width="20px">No</th>
                                                        <th>SKPD</th>
                                                        <th> Keuangan</th>
                                                        <th>Last Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
															// var_dump($skpd);
															$no=0;
															foreach (array_slice($keuangan_terendah, 0,10, true) as $v) { 
															$no++;
															 ?>
                                                    <tr>
                                                        <td align="center"><?php echo $no ?></td>
                                                        <td><?php echo $v['nama_instansi'] ?></td>
                                                        <td align="center"><?php echo $v['rk'] ?></td>
                                                        <td><?php echo $v['last_update'] ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="berdasarkan_deviasi" role="tabpanel">

                                    <div class="row">
                                        <div class="col-md-6">

                                            <table class="table table-striped table-bordered font_laporan">
                                                <thead class="header ">
                                                    <tr>
                                                        <th colspan="4" align="center">Tertinggi</th>
                                                    </tr>
                                                    <tr>
                                                        <th width="20px">No</th>
                                                        <th>SKPD</th>
                                                        <th> Deviasi Keuangan</th>
                                                        <th>Last Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
															// var_dump($skpd);
															$no=0;
															foreach (array_slice($deviasi_keu_tertinggi, 0,10, true) as $v) { 
															$no++;
															 ?>
                                                    <tr>
                                                        <td align="center"><?php echo $no ?></td>
                                                        <td><?php echo $v['nama_instansi'] ?></td>
                                                        <td align="center"><?php echo $v['dk'] ?></td>
                                                        <td><?php echo $v['last_update'] ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-striped table-bordered font_laporan">
                                                <thead class="header ">
                                                    <tr>
                                                        <th colspan="4" align="center">Terendah</th>
                                                    </tr>
                                                    <tr>
                                                        <th width="20px">No</th>
                                                        <th>SKPD</th>
                                                        <th> Deviasi Keuangan</th>
                                                        <th>Last Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  
															// var_dump($skpd);
															$no=0;
															foreach (array_slice($deviasi_keu_terendah, 0,10, true) as $v) { 
															$no++;
															 ?>
                                                    <tr>
                                                        <td align="center"><?php echo $no ?></td>
                                                        <td><?php echo $v['nama_instansi'] ?></td>
                                                        <td align="center"><?php echo $v['dk'] ?></td>
                                                        <td><?php echo $v['last_update'] ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane" id="pdf_rekap" role="tabpanel">
                                                </div> -->
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



<div class="modal fade" id="modal_per_kab_kota" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Per Kab Kota <br>Nama Kota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center align-items-center" style="height: 150px;">
                        <img id="logo_kota_modal" src="" style="width: 80%; height: 150px; object-fit: contain;">
                    </div>


                    <div class="col-md-8">

                        <h5 id="nama_kota_modal" class="card-title">Nama Kota</h5>
                        <table class="table">
                            <tr>
                                <td>Pagu</td>
                                <td>:</td>
                                <td id="pagu"> ?? </td>
                            </tr>
                            <tr>
                                <td>Realisasi Keuangan</td>
                                <td>:</td>
                                <td> ??
                                    <br>[?? %]
                                </td>
                            </tr>
                            <tr>
                                <td>Realisasi Fisik</td>
                                <td>:</td>
                                <td> ?? %</td>
                            </tr>
                        </table>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12" style="overflow-x: scroll;">
                        <table class="table table-bordered align-midle">
                            <thead class="header">
                                <tr>
                                    <th rowspan="4" width="20px" class="align-middle">No</th>
                                    <th rowspan="4" class="align-middle">SKPD</th>
                                    <th colspan="5" class="align-middle"> Pagu</th>
                                    <th colspan="13" class="align-middle"> Realisasi</th>

                                </tr>
                                <tr>
                                    <th rowspan="3" class="align-middle">Belanja Operasi</th>
                                    <th rowspan="3" class="align-middle">Belanja Modal</th>
                                    <th rowspan="3" class="align-middle">Belanja <br>Tidak Terduga</th>
                                    <th rowspan="3" class="align-middle">Belanja Transfer</th>
                                    <th rowspan="3" class="align-middle">Total</th>
                                    <th colspan="10" class="align-middle">Keuangan</th>
                                    <th colspan="3" class="align-middle">Fisik</th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="align-middle">Belanja Operasi</th>
                                    <th colspan="2" class="align-middle">Belanja Modal</th>
                                    <th colspan="2" class="align-middle">Belanja Tidak Terduga</th>
                                    <th colspan="2" class="align-middle">Belanja Transfer</th>
                                    <th colspan="2" class="align-middle">Total</th>
                                    <th class="align-middle">Bobot</th>
                                    <th class="align-middle">Realisasi</th>
                                    <th class="align-middle">Tertimbang</th>
                                </tr>
                                <tr>
                                    <?php for ($i=0; $i < 5; $i++) {  ?>
                                    <th>Rp.</th>
                                    <th width="10px">%</th>
                                    <?php } ?>
                                    <th>%</th>
                                    <th>%</th>
                                    <th>%</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7=3+4+5+6</td>
                                    <td>8</td>
                                    <td>9=8/3*100</td>
                                    <td>10</td>
                                    <td>11=10/4*100</td>
                                    <td>12</td>
                                    <td>13=12/5*100</td>
                                    <td>14</td>
                                    <td>15=14/6*100</td>
                                    <td>16</td>
                                    <td>17=16/7*100</td>
                                    <td>18=7/PT*100</td>
                                    <td>19</td>
                                    <td>20=19*18/100</td>

                                </tr>
                            </thead>
                            <tbody id="list_opd"></tbody>
                        </table>

                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>