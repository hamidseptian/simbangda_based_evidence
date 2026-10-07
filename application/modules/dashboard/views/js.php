

<script src="<?php echo base_url('assets/') ?>highchart/code/highcharts.js"></script>

<script type="text/javascript">

	var pesan_warning = `
    Anda berada pada penginputan data di <?php echo nama_tahapan().' '.tahun_anggaran() ?><br>
    Mohon periksa konfigurasi penginputan anda jika ingin mengubah tahapan APBD dan tahun anggaran <br>
    Data `;
  
    Swal.fire({
        html: pesan_warning ,
        title: 'Warning',
        icon: 'warning',
               
      // customClass: {
      //   popup: 'format-pre'
      // }
    });





	


	function sync(id_instansi) {
		$('#tombol_sync').text('Loading...').attr('disabled', true);
		start_loading('Synchronize..');

		var tahapan_apbd = '<?php echo tahapan_apbd() ?>';
		var menerima_tkd = '<?php echo $menerima_tkd ?>';
		var tahun = '<?php echo tahun_anggaran() ?>';

			if(tahun<=2022){

				$.ajax({
					url: baseUrl('synchronize/sync'),
					type: 'POST',
					dataType: 'JSON',
					data: {
						id_instansi: id_instansi,
						tahapan_apbd : tahapan_apbd
					},
					success: function(data) {
						
						if (data.status == true) {
							window.location.href = "<?php echo base_url(); ?>dashboard";
						}
					stop_loading();
					if (menerima_tkd=='1') {
							sync_tkd(id_instansi,tahapan_apbd,tahun) ; 

					}
				},
				error : function(){
					
					stop_loading();
					$('#tombol_sync').text('Reload Page').attr('disabled', false);
					$('#tombol_sync').attr('onclick', "reload()");
				}
			});
		}else{

			$.ajax({
					url: baseUrl('synchronize/synch_baru_2026/' + tahun + '/' + tahapan_apbd + '/' + id_instansi),
				type: 'GET',
				dataType: 'JSON',
				data: {
					
				},
				success: function(data) {
					
					
					if (data.responcode == 200) {
						// window.location.href = "<?php echo base_url(); ?>dashboard";
						// stop_loading();
						// Swal.fire(data.synchronize, data.message,data.status);
						if (menerima_tkd=='1') {
							sync_tkd(id_instansi,tahapan_apbd,tahun) ; 

							}else{
								synch_to_dashboard(data.author,id_instansi);

							}
					}
					else{
						stop_loading();
						Swal.fire(data.synchronize, data.message,data.status);
						$('#tombol_sync').text('Reload Page').attr('disabled', false);
						$('#tombol_sync').attr('onclick', "reload()");
					}

				},
				error : function(){
					stop_loading();
						Swal.fire('Error', 'Terjadi Kesalahan','error');
						$('#tombol_sync').text('Reload Page').attr('disabled', false);
						$('#tombol_sync').attr('onclick', "reload()");
					
				}
			});

		}
}





	function sync_tkd(id_instansi, tahapan_apbd, tahun) {
		
		start_loading('Synchronize..<br>Synchronize TKD Tambahan');
		var banyak_instansi = $('.hitung_intansi').length; 
		gagal_synch = 0;
		berhasil_synch = 0;

		$('#tahap-2'+ '-' + id_instansi).html('<i class="fa fa-plus fa-w-3 fa-spin"></i>').attr('disabled', true);
		$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-info">Loading Synch TKD</span>');

		


			$.ajax({
				url: baseUrl('synchronize/synch_tkd/' +tahun+ '/' +tahapan_apbd+'/'+id_instansi),
				type: 'GET',
				dataType: 'JSON',
				data: {
					id_instansi : id_instansi,
					tahap : tahapan_apbd,
					tahun : tahun
				},
				success: function(data) {
					
					


					if (data.responcode == 200) {

								synch_to_dashboard(data.author,id_instansi);
					
					}
					else{
						
					
					}

				},
				error : function(){
					
					$('#tahap-2'+ '-' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
					$('#tahap-2'+ '-' + id_instansi).find('i').attr('class', 'ion ion-checkmark');
					
						$('#cek_status_progress_' + id_instansi).html('<span class="badge badge-danger">Synchronize Error TKD</span>');
						$('#keterangan_status_progress_' + id_instansi).html('Error pada Aplikasi');
					var selesai = $('.selesai_sinkron').length; 
					$('#banyak_selesai').html(selesai);
					if (selesai==banyak_instansi) {
							$('#synchronize_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
						}

							$('#cek_status_progress_' + id_instansi).attr('class', 'gagal_sinkron');
						var gagal_synch = $('.gagal_sinkron').length; 
							$('#jumlah_selesai_synchronize').html(selesai+" OPD");
							$('#jumlah_synchronize_gagal').html(gagal_synch+" OPD");

					
				}
			});
		


	}

	function synch_to_dashboard(author, id_instansi) {
		$('#tombol_sync').text('Loading...').attr('disabled', true);
		start_loading('Synchronize..<br>Mengirim data ke dashboard pembangunan');

		var tahapan_apbd = '<?php echo tahapan_apbd() ?>';
		var tahun = '<?php echo tahun_anggaran() ?>';

		if(tahun<=2022){

			Swal.fire('Gagal','Data tahun '+tahun+'tidak bisa di integrasikan ke dashboard','error');
		
		}else{

			$.ajax({
					url: baseUrl('synchronize/synch_dashboard_pembangunan/' + author +  '/' + id_instansi),
				type: 'GET',
				// dataType: 'JSON',
				data: {
					
				},
				success: function(data) {
						// stop_loading();
						// if (data.message=='Berhasil') {
						Swal.fire('Berhasil', 'Data telah dikirimkan ke dashboard pembangunan','success');
						window.location.href = "<?php echo base_url(); ?>dashboard";

						// }else{
						// 	Swal.fire('Gagal', 'Data gagal dikirimkan ke dashboard pembangunan','error');

						// }


				

				},
				error : function(){
					// stop_loading();
						Swal.fire('Error', 'Terjadi Kesalahan pada dashboard','error');
						$('#tombol_sync').text('Reload Page').attr('disabled', false);
						$('#tombol_sync').attr('onclick', "reload()");
					
				}
			});

		}
}

	function reload(){
		window.location.href = "<?php echo base_url(); ?>dashboard";
	}
</script>