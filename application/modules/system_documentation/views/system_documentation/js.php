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
<script src="<?php echo base_url('assets/select2/dist/js/select2.min.js') ?>"></script>
<script>
	let status_show_pptk = 'collapse';
	$(document).ready(function() {
		var js_menu = '<?php echo $js_menu ?>';
		if(js_menu=='dt_docs'){
			show_docs();
		}
		else if(js_menu=='detail_docs'){
			show_detail_docs();
		} 
	});

	/* Fungsi untuk menampilkan KPA */
	function show_docs() {
		$('#table-sbe-docs').DataTable({
			processing: true,
			serverSide: true,
			bDestroy: true,
			responsive: true,
			ajax: {
				url: baseUrl('system_documentation/dt_docs/'),
				type: "POST",
				data: {},
			},
			columnDefs: [{
					targets: [0, -1],
					orderable: false,
				},
				{
					width: "1%",
					targets: [0],
				},
				{
					className: "dt-center",
					targets: [-1],
				},
			],

		});
	}

	function show_detail_docs() {
		$('#table-sbe-detail-docs').DataTable({
			processing: true,
			serverSide: true,
			bDestroy: true,
			responsive: true,
			ajax: {
				url: baseUrl('system_documentation/dt_detail_docs/'),
				type: "POST",
				data: {
					id_docs : $('#id_docs').val()
				}
			},
			columnDefs: [{
					targets: [0, -1],
					orderable: false,
				},
				{
					width: "1%",
					targets: [0],
				},
				{
					className: "dt-center",
					targets: [-1],
				},
			],

		});
	}

	
	function daftar_dokumen(id_paket_pekerjaan) {
		$('#modal-daftar-dokumen').modal('show');

		$.ajax({
			url: baseUrl('realisasi/dokumen_realisasi/'),
			dataType: 'JSON',
			type: 'GET',
			data: {
				id_paket_pekerjaan: id_paket_pekerjaan
			},
			success: function(data) {
				
			}
		});

		
	}

	
</script>