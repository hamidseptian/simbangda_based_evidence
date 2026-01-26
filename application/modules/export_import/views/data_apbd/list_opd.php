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
               LIST OPD | Export - Import | Data APBD 
            </div>
            <div class="card-body">
                <div class="notifikasi"></div>
            
                <table class="table" id="data_tabel" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:1%">No</th>
							<th>Tahapan APBD</th>

							<th>Periode Export</th>
                            <th>Status</th>
                        
                            <th>Action</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $k => $v) { ?>
                            <tr>
                                <td><?php echo $k+1 ?></td>
                                <td><?php echo $v['nama_instansi'] ?></td>
                                <td><?php echo pilihan_nama_tahapan($data_export_import['kode_tahap']).'<br>Tahun '.$data_export_import['tahun'] ?></td>
                                <td><?php 
                                if (isset($log[$v['id_instansi']])) {
                                	echo "<span class='badge badge-success'>";
                                 	echo "Diimport Oleh  ".$log[$v['id_instansi']]['group'];
                                 	echo "<br>[".$log[$v['id_instansi']]['full_name'];
                                 	echo "]<br>Pada : ".$log[$v['id_instansi']]['tgl_import'];
                                	echo "</span>";
                                 }else{
                                	echo "<span class='badge badge-danger'>";
                                 	echo "Belum Mengimport";
                                	echo "</span>";
                                 } 
                                ?></td>
                             
                                <td>
                                        <a href="<?php echo base_url('export_import/kelola_import/'.$id_export_import.'/'.sbe_crypt($v['id_instansi'])) ?>" class="btn btn-outline-info btn-sm">Detail</a>
                                   
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