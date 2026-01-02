<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/
?>










<div class="mb-3 card">
                        <div class="tabs-lg-alternate card-header">
                            <ul class="nav nav-justified">
                                <li class="nav-item">
                                    <a href="#hd_opd" data-toggle="tab" class="nav-link active minimal-tab-btn-1">
                                        <div class="widget-number"><span id="helpdefffsk_4"><?php echo $jumlah_helpdesk ?></span></div>
                                        <div class="tab-subheading">
                                            <b>
                                                
                                            <span class="pr-2 opactiy-6">
                                            </span>
                                            Helpdesk - OPD
                                            </b>
                                           
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#opd_hd" data-toggle="tab" class="nav-link minimal-tab-btn-2">
                                        <div class="widget-number"><span id="helpdesk_8"><?php echo $jumlah_opd ?></span></div>
                                        <div class="tab-subheading">
                                            <b>
                                                
                                            <span class="pr-2 opactiy-6">
                                                <i class="fa fa-book"></i>
                                            </span>
                                            OPD - Helpdesk
                                            </b>
                                        </div>
                                    </a>
                                </li>
                             
                               
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="hd_opd">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="main-card mb-3 card">
                                                <div class="card-body">
                                                    <table id="table-helpdesk-fisik" class="display" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Instansi</th>

                                                                    <th>Group</th>
                                                                    <th>Username</th>
                                                                    <th>Full Name</th>
                                                                    <th>Banyak Instansi</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane " id="opd_hd">
                                <div class="card-body">
                                   
                                      <table id="table-skpd-helpdesk" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Instansi</th>
                                                <th>Jumlah Helpdesk</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        

                        </div>
                    </div>
















