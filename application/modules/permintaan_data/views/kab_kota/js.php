<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 */
?>
<!-- Datatables -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatables/dataTables.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/select2/select2.min.js') ?>"></script>
<script>
	$('.datatable').DataTable();


	function upload_file(){
		$('#modal_upload_file').modal('show');
	}
	function upload_file_ulang(){
		$('#modal_upload_file_ulang').modal('show');
	}
</script>