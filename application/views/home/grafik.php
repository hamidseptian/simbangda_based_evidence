<div class="col-lg-12 col-md-6 ">
            <div class="card">

                <div class="card-header">
                    Realisasi Belanja OPD <?php echo $nama_tahap ?> tahun <?php echo $tahun_anggaran ?>
                </div>
                <div class="card-body">

                    <div class="tabs-animation">
                        <input type="hidden" class="form-control" id="id_instansi_grafik"
                            value="<?php echo id_instansi() ?>">
                        <div class="row">
                            <div class="col-lg-12 col-xl-6">
                                <div class="main-card card">
                                    <div class="card-body">
                                        <div id="pagu" name="pagu"></div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="main-card card">
                                    <div class="card-body">
                                        <div id="terealisasi" name="terealisasi"></div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tabs-animation">
                        <input type="hidden" class="form-control" id="id_instansi_grafik"
                            value="<?php echo id_instansi() ?>">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <div class="main-card mt-3 card">
                                    <div class="card-body">
                                        <div id="grafik_realisasi_skpd"></div>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <th colspan="2">
                                                    <center>Bulan / Keterangan</center>
                                                </th>
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
                                        <div class="btn-group btn-block">
                                            <button type="button"
                                                class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"
                                                onclick="grafik('Akumulasi')"><i class="fa fa-signal"> </i> Grafik
                                                Akumulasi</button>
                                            <button type="button"
                                                class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"
                                                onclick="grafik('Bulanan')"><i class="fa fa-signal"> </i> Grafik
                                                Bulanan</button>
                                            <button type="button"
                                                class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"
                                                onclick="data_per_opd()"><i class="fa fa-building"> </i> Lihat Per
                                                OPD</button>
                                           <!--  <button type="button"
                                                class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"
                                                onclick="infografis()"><i class="fa fa-building"> </i> Infografis</button> -->

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                </div>
            </div>
        </div>