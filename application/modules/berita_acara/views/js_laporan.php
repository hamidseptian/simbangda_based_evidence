
<script src="<?php echo base_url('assets/select2/select2.min.js') ?>"></script>
<script>
	$('#id_opd').select2({
			placeholder: "Pilih OPD",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
	$('#periode').select2({
			placeholder: "Pilih Periode",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});

function show_laporan() {
		// Swal.showLoading();
		// start_loading('Mengambil data laporan');

		// checkIframeLoaded();


		let id_opd = $('#id_opd').val();
		let periode = $('#periode').val();
		let pengambilan = $('#pengambilan').val();



$('#tampil_pdf').show();
					$('#tampil_pdf').attr('src', baseUrl('berita_acara/pdf_berita_acara?id_opd=') + id_opd + '&id_periode=' + periode + '&pengambilan_data=' + pengambilan + '#view=FitH');
		



	}



function cek_synchronize(){
		let id_opd = $('#id_opd').val();
		let periode = $('#periode').val();

		$.ajax({
			url: baseUrl('berita_acara/cek_synchronize'),
			type: 'POST',
			dataType: 'JSON',
			data: {			
				id_opd :id_opd,
				periode : periode	
			},
			success: function(data) {
				// console.log(data.status);
				if (data.status==1) {
					synchronize()
				}else{
					Swal.fire('Tidak di izinkan',data.pesan,'warning');
				}
							
			},
			error: function(jqXHR, textStatus, errorThrown) {
				
			}
		});

}



function synchronize() {
		// Swal.showLoading();
		// start_loading('Mengambil data laporan');
		// toastr.success('3213');
		// checkIframeLoaded();

				// $('#tombol_action').html(`<button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" onclick="show_laporan()" disabled><i class="fa fa-search"> </i>Loading pengambilan data</button>`);

		let id_opd = $('#id_opd').val();
		let periode = $('#periode').val();


		$.ajax({
			url: baseUrl('berita_acara/synchronize'),
			type: 'POST',
			dataType: 'JSON',
			data: {			
				id_opd :id_opd,
				periode : periode,	
			},
			success: function(data) {
				Swal.fire('Selesai','Synchronize Selesai<br>Data berita acara anda sudah ditampilkan','success');
				// $('#tombol_action').html(`<button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" onclick="show_laporan()"><i class="fa fa-search"> </i>  Tampilkan Laporan (PDF)</button>`);
					show_laporan();		
			},
			error: function(jqXHR, textStatus, errorThrown) {
				
			}
		});



}





</script>