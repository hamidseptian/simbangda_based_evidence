<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/
?>



                    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                        <li class="nav-item">
                            <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#master_user">
                                <span>Master User Simangda</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#akses_chatbot">
                                <span>Akses Chatbot</span>
                            </a>
                        </li>
                      
                    </ul>





                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="master_user" role="tabpanel">
                            <div class="row">
                                

                                  <div class="col-md-12 col-lg-12">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <div class="notifikasi"></div>
                                                <?php   if ($id_kedudukan=='') { ?>
                                                    <button type="button" class="btn btn-primary" id="addMasterUser" onclick="addMasterUser()">Tambah User</button>
                                                <?php }else{ ?>
                                                    <button type="button" class="btn btn-outline-danger" id="" onclick="Swal.fire('Terkunci','Penambahan user Operator hanya dapat dilakukan Operator Utama','warning')">Tambah User</button>

                                                <?php } ?>
                                            <hr>
                                            <table id="table-master-user" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Instansi</th>

                                                        <th>Group</th>
                                                        <th>Username</th>
                                                        <th>Full Name</th>
                                                        <th>E-Mail</th>
                                                        <th>Active</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>

                        <div class="tab-pane tabs-animation fade show" id="akses_chatbot" role="tabpanel">
                            <div class="row">
                                



                                  <div class="col-md-12 col-lg-12">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <div class="notifikasi"></div>
                                                    <button type="button" class="btn btn-primary" id="add_user_chatbot" onclick="add_user_chatbot()">Daftarkan WA Untuk Chatbot</button>
                                             
                                            <hr>
                                            <div class="alert alert-danger">Bagian simpan edit chatbot belum berfungsi</div>
                                            <table id="table-master-user-chatbot" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Instansi</th>

                                                        <th>Nama</th>
                                                        <th>No HP</th>
                                                        <th>Hak Akses</th>
                                                      
                                                        <th>Active</th>
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

<div class="row">
  
</div>
