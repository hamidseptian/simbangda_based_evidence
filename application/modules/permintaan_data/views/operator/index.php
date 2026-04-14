<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Permintaan Data</div>
            <div class="card-body">
                <table class="table table-striped table-bordered datatable">
                    <thead> 
                        <tr>    
                            <th>No</th>
                            <th>Judul</th>
                            <th>Keterangan</th>
                            <th>Sasaran Permintaan</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php 
                        $no=1;
                         foreach ($permintaan_data as $k => $v) { ?>
                            <tr>   
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $v['judul'] ?></td>
                                <td><?php echo $v['keterangan'] ?></td>
                                <td><?php echo $group[$v['id_group']] ?></td>
                                <td><?php echo $v['status'].'<br>'.($v['file'] =='' ? '<span class="badge badge-danger">Belum Mengirimkan Data</span>' : '<span class="badge badge-success">Sudah Mengirim Data</span>') ?></td>
                                <td><a href="<?php echo base_url('permintaan_data/detail/'.sbe_crypt($v['id_permintaan_data'])) ?>" class="btn btn-info btn-sm">Detail</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
         
        </div>



    </div>
</div>