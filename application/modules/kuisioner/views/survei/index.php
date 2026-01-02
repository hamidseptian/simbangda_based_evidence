<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/
?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <?php echo $this->session->flashdata('pesan'); ?>
        <div class="main-card mb-3 card">
            <div class="card-header">
               LIST PERIODE  Export - Import | Data APBD 
            </div>
            <div class="card-body">
                <div class="notifikasi"></div>
                <?php if ($id_group==2) { ?>
                    <div class="btn-actions-pane-right">
                                               
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#export_sipd">Tambah Periode Export</button>
                                            </div>



                <hr>
                <?php } ?>
                <table class="table" id="data_tabel" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:1%">No</th>
							<th>Judul Kuisioner</th>

                            <th>Action</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $k => $v) { ?>
                            <tr>
                                <td><?php echo $k+1 ?></td>
                                <td><?php echo $v['judul_kuisioner'] ?></td>
                                <td>
                                    <a href="<?php echo base_url('kuisioner/survei/'.sbe_crypt($v['id_kuisioner'])) ?>" class="btn btn-outline-info btn-sm">Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


<script type="text/javascript">
    $(document).ready( function () {
        $('#data_tabel').DataTable();
    } );
</script> -->