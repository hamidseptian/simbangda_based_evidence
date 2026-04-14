<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 */
?>
<!-- Datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script>
	// $('.datatable').DataTable();
function tambah_permintaan(){
	$('#modal-tambah-permintaan').modal('show');

	$('#modal-tambah-permintaan').find('#id_group').change(function(){
		var id_group = $('#modal-tambah-permintaan').find('#id_group').val();
		if (id_group=='7') {
			$('#modal-tambah-permintaan').find('#pengirim').html('Nama Kabupaten kota -');
		}else{
			$('#modal-tambah-permintaan').find('#pengirim').html('Nama OPD -');

		}


	});
}
function edit_permintaan(){
	$('#modal-edit-permintaan').modal('show');

	$('#modal-edit-permintaan').find('#id_group').change(function(){
		var id_group = $('#modal-edit-permintaan').find('#id_group').val();
		if (id_group=='7') {
			$('#modal-edit-permintaan').find('#pengirim').html('Nama Kabupaten kota - ');
		}else{
			$('#modal-edit-permintaan').find('#pengirim').html('Nama OPD -');

		}


	});
}

</script>