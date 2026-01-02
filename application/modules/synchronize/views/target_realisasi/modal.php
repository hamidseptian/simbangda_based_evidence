<div class="modal fade" id="modal_grafik_skpd" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik <span id="nama_skpd"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tabs-animation">
                 <input type="hidden" class="form-control" id="id_instansi_grafik" value="<?php echo id_instansi() ?>">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                   <div id="grafik_realisasi_skpd"></div>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th colspan="2"><center>Bulan / Keterangan</center></th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>Mei</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Agu</th>
                                        <th>Sep</th>
                                        <th>Okt</th>
                                        <th>Nov</th>
                                        <th>Des</th>
                                    </thead>
                                    <tbody>
                                      
                                       
                                        <tr id="tfisik">
                                            <td rowspan="3" align="center">Fisik</td>
                                        </tr>
                                        <tr id="rfisik">
                                        </tr>
                                        <tr id="dfisik">
                                        </tr>
                                          <tr id="tkeu">
                                            <td rowspan="3" align="center">Keuangan</td>
                                        </tr>
                                        <tr id="rkeu">
                                        </tr>
                                        <tr id="dkeu">
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-group btn-block" id="tombol_pilihan_grafik">
                                       
                               
                                </div>




                <!-- 








                                <div class="card-body"><h5 class="card-title">Outline 2x Shadow Linecons Icons</h5>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"><i class="lnr-store btn-icon-wrapper"> </i>Primary</button>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-secondary"><i class="lnr-book btn-icon-wrapper"> </i>Secondary</button>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-success"><i class="lnr-user btn-icon-wrapper"> </i>Success</button>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-info"><i class="lnr-paperclip btn-icon-wrapper"> </i>Info</button>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-warning"><i class="lnr-screen btn-icon-wrapper"> </i>Warning</button>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger"><i class="lnr-smartphone btn-icon-wrapper"> </i>Danger</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-focus"><i class="lnr-phone btn-icon-wrapper"> </i>Focus</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-alternate"><i class="lnr-keyboard btn-icon-wrapper"> </i>Alt</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-light"><i class="lnr-dinner btn-icon-wrapper"> </i>Light</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-dark"><i class="lnr-earth btn-icon-wrapper"> </i>Dark</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-link"><i class="lnr-car btn-icon-wrapper"> </i>link</button>
                                        </div>

 -->






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


<div class="modal fade" id="modal_grafik_skpd_2_tahun_terakhir" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Grafik <span id="nama_skpd"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tabs-animation">
                 <input type="hidden" class="form-control" id="id_instansi_grafik" value="<?php echo id_instansi() ?>">
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                   <div id="grafik_realisasi_skpd_2_tahun_terakhir"></div>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th colspan="2"><center> Keterangan / Bulan / Tahun</center></th>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>Mei</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Agu</th>
                                        <th>Sep</th>
                                        <th>Okt</th>
                                        <th>Nov</th>
                                        <th>Des</th>
                                    </thead>
                                    <tbody>
                                      
                                       
                                        <tr id="tfisik">
                                            <td rowspan="3" align="center">Fisik</td>
                                        </tr>
                                        <tr id="rfisik">
                                        </tr>
                                        <tr id="dfisik">
                                        </tr>
                                          <tr id="tkeu">
                                            <td rowspan="3" align="center">Keuangan</td>
                                        </tr>
                                        <tr id="rkeu">
                                        </tr>
                                        <tr id="dkeu">
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-group btn-block" id="tombol_pilihan_grafik">
                                       
                               
                                </div>




                <!-- 








                                <div class="card-body"><h5 class="card-title">Outline 2x Shadow Linecons Icons</h5>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"><i class="lnr-store btn-icon-wrapper"> </i>Primary</button>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-secondary"><i class="lnr-book btn-icon-wrapper"> </i>Secondary</button>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-success"><i class="lnr-user btn-icon-wrapper"> </i>Success</button>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-info"><i class="lnr-paperclip btn-icon-wrapper"> </i>Info</button>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-warning"><i class="lnr-screen btn-icon-wrapper"> </i>Warning</button>
                                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger"><i class="lnr-smartphone btn-icon-wrapper"> </i>Danger</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-focus"><i class="lnr-phone btn-icon-wrapper"> </i>Focus</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-alternate"><i class="lnr-keyboard btn-icon-wrapper"> </i>Alt</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-light"><i class="lnr-dinner btn-icon-wrapper"> </i>Light</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-dark"><i class="lnr-earth btn-icon-wrapper"> </i>Dark</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-link"><i class="lnr-car btn-icon-wrapper"> </i>link</button>
                                        </div>

 -->






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




<div class="modal fade" id="modal_jadwal_synch" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jadwal Synchronize Sekaligus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <table id="penjadwalan_synch" class="display table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Tahapan APBD</td>
                            <td>Tahun Anggaran</td>
                            <td>Synchronize</td>
                            <td>Berhasil Synchronize</td>
                            <td>Gagal Synchronize</td>
                            <td>Total OPD Synchronize</td>
                            <td>Waktu Synchronize</td>
                            <td>Option</td>
                        </tr>
                    </thead>

                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


