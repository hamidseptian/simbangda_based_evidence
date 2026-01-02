<div class="row">
  <div class="col-md-9">
    <div class="mb-3 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                   


<?php var_dump($_SERVER) ?>


                   <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Group</th>
                                        <th>User</th>
                                        <th>OPD</th>
                                        <th>Last Login</th>
                                        <th>Last Logout</th>
                                        <th>Last Hits</th>
                                        <th>Activity</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $no=0; 
                                    $pengunjunglogin =0;
                                    $bataswaktu = time() - 300;
                                    $user_online = 0 ;
                                    foreach ($visit as $key => $v) {
                                    $no++;


                                     if ($v['keterangan']=='Login') {
        # code...
                                        $pengunjunglogin++;
                                    }


                                      if ($v['online'] > $bataswaktu) {
                                        $css_keterangan = "style='background:#d5f5e3'";
                                        $keterangan = 'Online';
                                        $user_online++;
                                      }else{
                                        $css_keterangan = "style='background:#f8b2b2'";
                                        $keterangan = $v['keterangan'];

                                      }  

                                      ?>
                                      <tr>
                                          <td><?php echo $no ?></td>
                                          <?php if ($v['keterangan']!='Login') { ?>
                                            <td>PUBLIC</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                            <td><?php echo $v['last_hits'] ?></td></td>
                                            <td></td>
                                            <td></td>
                                          <?php }else{ ?>
                                          <td><?php echo $v['group_name'] ?></td>
                                          <td><?php echo $v['full_name'] ?></td>
                                          <td><?php echo $v['nama_instansi'] ?></td>
                                          <td><?php echo $v['last_login'] ?></td>
                                          <td><?php echo $v['last_logout'] ?></td>
                                          <td><?php echo $v['last_hits'] ?></td>
                                          <td><?php echo @$modul[$v['modules']] ?></td>
                                          <td <?php echo $css_keterangan ?>><?php echo $keterangan ?></td>
                                        <?php } ?>
                                         
                                      </tr>
                                      
                                    <?php } ?>
                                    </tbody>
                                  </table>






                </div>
            </div>
        </div>
    </div>

</div>

<div class="col-md-3">
                            <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-primary border-primary card">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-content">
                                        <div class="widget-title opacity-5 text-uppercase">User Online</div>
                                        <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                                            <div class="widget-chart-flex align-items-center">
                                                <div>
                                                   
                                                    <?php echo $user_online ?>
                                                </div>
                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-primary border-primary card">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-content">
                                        <div class="widget-title opacity-5 text-uppercase">User login</div>
                                        <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                                            <div class="widget-chart-flex align-items-center">
                                                <div>
                                                   
                                                    <?php echo $pengunjunglogin ?>
                                                </div>
                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-chart widget-chart2 text-left mb-3 card-btm-border card-shadow-primary border-primary card">
                                <div class="widget-chat-wrapper-outer">
                                    <div class="widget-chart-content">
                                        <div class="widget-title opacity-5 text-uppercase">User Today</div>
                                        <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                                            <div class="widget-chart-flex align-items-center">
                                                <div>
                                                   
                                                    <?php echo $no ?>
                                                </div>
                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
</div>
</div>