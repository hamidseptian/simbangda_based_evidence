<?php

/**
 * Author     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 */
?>
<!-- Select2 -->
<script src="<?php echo base_url('assets/select2/select2.min.js') ?>"></script>
<!-- Script -->
<script>
	$(document).ready(function() {
		show_select2();
	});

	function show_select2() {
		$('#kategori').select2({
			placeholder: "Pilih Kategori",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
		$('#tahun').select2({
			placeholder: "Pilih Tahun Anggaran",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
		$('#tahap').select2({
			placeholder: "Pilih Tahapan APBD",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
		$('#bulan').select2({
			placeholder: "Pilih Bulan",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
		$('#kpa').select2({
			placeholder: "Pilih KPA",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
		$('#pptk').select2({
			placeholder: "Pilih PPTK",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
		$('#id_opd').select2({
			placeholder: "Pilih OPD",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
		$('#kategori_laporan').select2({
			placeholder: "Pilih Data Yang Akan Ditampilkan",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
		$('#jenis_sumber_dana').select2({
			placeholder: "Pilih Sumber Dana",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
	}

	$('#kategori_laporan').change(function(){
		var penampilan_data = $('#kategori_laporan').val();
		if (penampilan_data=='rfk_data_sumber_dana') {
			$('#f_kategori').hide();
			$('#f_jenis_submer_dana').hide();
			$('#f_bulan').hide();
			$('#f_kpa').hide();
			$('#f_pptk').hide();

			$('#f_instansi_pembantu').hide();
		}else if (penampilan_data=='rfk_berdasarkan_data_sumber_dana') {
			$('#f_kategori').show();
			$('#f_bulan').show();
			$('#f_jenis_submer_dana').show();
			$('#f_kpa').hide();
			$('#f_pptk').hide();

			$('#f_instansi_pembantu').hide();

		}else if (penampilan_data=='rfk_akumulasi_struktur_instansi') {


			$('#f_kategori').show();
			$('#f_bulan').show();
			$('#f_jenis_submer_dana').hide();
			$('#f_kpa').show();
			$('#f_pptk').show();
			$('#f_instansi_pembantu').hide();

		
		}else if (penampilan_data=='rfk_akumulasi_instansi_pembantu') {


			$('#f_kategori').show();
			$('#f_bulan').show();
			$('#f_jenis_submer_dana').hide();
			$('#f_kpa').hide();
			$('#f_pptk').hide();
			$('#f_instansi_pembantu').show();

		}else{
			$('#f_kategori').show();
			$('#f_bulan').show();
			$('#f_jenis_submer_dana').hide();

			$('#f_kpa').hide();
			$('#f_pptk').hide();

			$('#f_instansi_pembantu').hide();

		}
	});



	var id_group = '<?php echo $this->session->userdata('id_group') ?>';
	if (id_group==5) {
		$('#kpa').html('<option value="">Pilih KPA</option>');
			$.ajax({
				url: baseUrl('laporan/daftar_kpa'),
				type: 'POST',
				dataType: 'JSON',
				data: {
					id_instansi : $('#id_opd').val(),
				},
				success: function (datanya)
				{	
					if(datanya.status == true)
					{
							console.log(datanya);
						$.each(datanya.data, function(k,v){
							$('#kpa').append('<option value="'+v.id_user+'">' + v.full_name + " [" + v.nama_sub_instansi+']</option>');
						});
					}else{
						
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					
				}
			});
			
	}
	else{

		$('#id_opd').change(function(){

			$('#kpa').html('<option value="">Pilih KPA</option>');
			$('#instansi_pembantu').html('<option value="">Pilih Instansi Pembantu</option>');
			$.ajax({
				url: baseUrl('laporan/daftar_kpa'),
				type: 'POST',
				dataType: 'JSON',
				data: {
					id_instansi : $('#id_opd').val(),
				},
				success: function (datanya)
				{	
					if(datanya.status == true)
					{
						$.each(datanya.data, function(k,v){
							$('#kpa').append('<option value="'+v.id_user+'">' + v.full_name + " [" + v.nama_sub_instansi+']</option>');
						});
					}else{
						
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					
				}
			});

			$.ajax({
				url: baseUrl('laporan/daftar_instansi_pembantu'),
				type: 'POST',
				dataType: 'JSON',
				data: {
					id_instansi : $('#id_opd').val(),
				},
				success: function (datanya)
				{	
					
					if(datanya.status == true)
					{

						$('#instansi_pembantu').html('<option value="">Pilih Instansi Pembantu</option>');
						$.each(datanya.data, function(k,v){

							$('#instansi_pembantu').append('<option value="'+v.id_instansi_pembantu_teknis+'">'+v.nama_instansi_teknis+'</option>');
						});
					}else{
						
							$('#instansi_pembantu').html('<option value="">Tidak ada data instansi pembantu</option>');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					
				}
			});
		});

		}
	$('#kpa').change(function(){

		$.ajax({
			url: baseUrl('laporan/daftar_pptk'),
			type: 'POST',
			dataType: 'JSON',
			data: {
				id_instansi : $('#id_opd').val(),
				id_kpa : $('#kpa').val(),
			},
			success: function (datanya)
			{	
				if(datanya.status == true)
				{
					$('#pptk').html('<option value="semua_pptk">Semua PPTK</option>');
					$.each(datanya.data, function(k,v){
						$('#pptk').append('<option value="'+v.id_user+'">' + v.full_name + " [" + v.nama_sub_instansi+']</option>');
					});
				}else{
					$('#pptk').html('<option disabled>Data PPTK Tidak Ada</option>');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				
			}
		});
	});

	function bulan() {
		// $('#bulan').val('').trigger("change");
		$('#tampil_pdf').hide();
	}

	function show_laporan() {
		// Swal.showLoading();
		// start_loading('Mengambil data laporan');

		// checkIframeLoaded();


		let bulan = $('#bulan').val();
		let id_opd = $('#id_opd').val();
		let tahun = $('#tahun').val();
		let tahap = $('#tahap').val();
		let instansi_pembantu = $('#instansi_pembantu').val();
		let kpa = $('#kpa').val();
		let pptk = $('#pptk').val();
		let kategori = $('#kategori').val();
		let kategori_laporan = $('#kategori_laporan').val();
		let jenis_sumber_dana = $('#jenis_sumber_dana').val();
		let warning_semua_opd = "Tidak bisa semua OPD. Semua OPD hanya bisa di gunakan pada Realisasi Fisik Dan Keuangan Akumulasi berdasarkan Sumber Dana Kegiatan SKPD";


		 if (kategori_laporan=='') {
			Swal.fire('Error','Harap Pilih Data Yang Ditampilkan','error');
			return false;
		}
		
		else{


			if (kategori_laporan=='rfk_akumulasi' || kategori_laporan=='rfk_berdasarakan_kelompok_jenis_belanja' ) {
				if (id_opd=='semua_opd') {
					Swal.fire('Error',warning_semua_opd,'error');
					return false;
				}
				else if (tahun=='') {
					Swal.fire('Error','Harap Pilih Tahun','error');
					return false;
				}
				else if (tahap=='') {
					Swal.fire('Error','Harap Pilih Tahapan APBD','error');
					return false;
				}
				else if (kategori=='') {
					Swal.fire('Error','Harap Pilih Kategori','error');
					return false;
				}
				else if (bulan=='') {
					Swal.fire('Error','Harap Pilih Bulan','error');
					return false;
				}
				else{
					$('#tampil_pdf').show();
					$('#tampil_pdf').attr('src', baseUrl('laporan/pdf_laporan_realisasi_akumulasi?id_opd=') + id_opd + '&kategori_penampilan_data=' + kategori_laporan +'&kategori=' + kategori + '&tahun=' + tahun + '&tahap=' + tahap + '&bulan=' + bulan + '&jenis_sumber_dana=' + jenis_sumber_dana + '#view=FitH');
				}
				
			}
			else if (kategori_laporan=='rfk_akumulasi_struktur_instansi') {
				if (id_opd=='semua_opd') {
					Swal.fire('Error',warning_semua_opd,'error');
					return false;
				}
				else if (tahun=='') {
					Swal.fire('Error','Harap Pilih Tahun','error');
					return false;
				}
				else if (tahap=='') {
					Swal.fire('Error','Harap Pilih Tahapan APBD','error');
					return false;
				}
				else if (kpa=='') {
					Swal.fire('Error','Harap Pilih KPA','error');
					return false;
				}
				else if (pptk=='') {
					Swal.fire('Error','Harap Pilih PPTK','error');
					return false;
				}
				else if (kategori=='') {
					Swal.fire('Error','Harap Pilih Kategori','error');
					return false;
				}
				else if (bulan=='') {
					Swal.fire('Error','Harap Pilih Bulan','error');
					return false;
				}
				else{
					$('#tampil_pdf').show();
					$('#tampil_pdf').attr('src', baseUrl('laporan/pdf_laporan_realisasi_akumulasi?id_opd=') + id_opd + '&kategori_penampilan_data=' + kategori_laporan +'&kategori=' + kategori + '&tahun=' + tahun + '&tahap=' + tahap + '&bulan=' + bulan + '&id_user_kpa=' + kpa + '&id_user_pptk=' + pptk + '#view=FitH');
				}
				
			}
			else if (kategori_laporan=='rfk_akumulasi_instansi_pembantu') {

				if (id_opd=='semua_opd') {
					Swal.fire('Error',warning_semua_opd,'error');
					return false;
				}
				else if (tahun=='') {
					Swal.fire('Error','Harap Pilih Tahun','error');
					return false;
				}
				else if (tahap=='') {
					Swal.fire('Error','Harap Pilih Tahapan APBD','error');
					return false;
				}
				
				else if (instansi_pembantu=='') {

					Swal.fire('Error','Harap Pilih Instansi Pembantu','error');
					return false;
				}
				else if (kategori=='') {
					Swal.fire('Error','Harap Pilih Kategori','error');
					return false;
				}
				else if (bulan=='') {
					Swal.fire('Error','Harap Pilih Bulan','error');
					return false;
				}
				else{
					$('#tampil_pdf').show();
					$('#tampil_pdf').attr('src', baseUrl('laporan/pdf_laporan_realisasi_akumulasi?id_opd=') + id_opd + '&kategori_penampilan_data=' + kategori_laporan +'&kategori=' + kategori + '&tahun=' + tahun + '&tahap=' + tahap + '&bulan=' + bulan + '&id_instansi_pembantu=' + instansi_pembantu);
				}
				
			}else if (kategori_laporan=='rfk_berdasarkan_data_sumber_dana') { 
				if (jenis_sumber_dana=='') {
					Swal.fire('Error','Harap pilih jenis sumber dana','error');
					return false;
				}
				else if (tahun=='') {
					Swal.fire('Error','Harap Pilih Tahun','error');
					return false;
				}
				else if (tahap=='') {
					Swal.fire('Error','Harap Pilih Tahapan APBD','error');
					return false;
				}
				else if (kategori=='') {
					Swal.fire('Error','Harap Pilih Kategori','error');
					return false;
				}
				else if (bulan=='') {
					Swal.fire('Error','Harap Pilih Bulan','error');
					return false;
				}else{
				
				$('#tampil_pdf').show();
				$('#tampil_pdf').attr('src', baseUrl('laporan/pdf_laporan_realisasi_akumulasi?id_opd=') + id_opd + '&kategori_penampilan_data=' + kategori_laporan +'&kategori=' + kategori + '&tahun=' + tahun + '&tahap=' + tahap + '&bulan=' + bulan +  '&jenis_sumber_dana=' + jenis_sumber_dana + '#view=FitH');
				}
			}else{
				if (id_opd=='semua_opd') {
					Swal.fire('Error',warning_semua_opd,'error');
					return false;
				}
				else if (tahun=='') {
					Swal.fire('Error','Harap Pilih Tahun','error');
					return false;
				}
				else if (tahap=='') {
					Swal.fire('Error','Harap Pilih Tahapan APBD','error');
					return false;
				}
				else if (kategori=='') {
					Swal.fire('Error','Harap Pilih Kategori','error');
					return false;
				}
				else if (bulan=='') {
					Swal.fire('Error','Harap Pilih Bulan','error');
					return false;
				}
				else{
					$('#tampil_pdf').show();
					$('#tampil_pdf').attr('src', baseUrl('laporan/pdf_laporan_realisasi_akumulasi?id_opd=') + id_opd + '&kategori_penampilan_data=' + kategori_laporan +'&kategori=' + kategori + '&tahun=' + tahun + '&tahap=' + tahap + '&bulan=' + bulan + '&jenis_sumber_dana=' + jenis_sumber_dana + '#view=FitH');
				}
			}

		}



	}







	function download_laporan_excel() {
		// Swal.showLoading();
		
		let bulan = $('#bulan').val();
		let id_opd = $('#id_opd').val();
		let tahun = $('#tahun').val();
		let tahap = $('#tahap').val();
		let kategori = $('#kategori').val();
		let kategori_laporan = $('#kategori_laporan').val();

		if (kategori_laporan=='rfk_berdasarakan_jenis_belanja_detail') {
			var url =  baseUrl('laporan/download_laporan_excel_data_apbd_jenis_belanja?id_opd=') + id_opd  +'&kategori=' + kategori + '&tahun=' + tahun +  '&tahap=' + tahap + '&bulan=' + bulan;
			window.location = url;
		}
		else if (kategori_laporan=='rfk_akumulasi') {
			if (tahun>2022) {
				var url =  baseUrl('laporan/download_laporan_excel_realisasi_akumulasi?id_opd=') + id_opd  +'&kategori=' + kategori + '&tahun=' + tahun +  '&tahap=' + tahap + '&bulan=' + bulan;
			}else{
				var url =  baseUrl('laporan/download_laporan_excel_realisasi_akumulasi?id_opd=') + id_opd  +'&kategori=' + kategori + '&tahun=' + tahun +  '&tahap=' + tahap + '&bulan=' + bulan;
			}
			window.location = url;
		}else{
			Swal.fire('Akses Terbatas','Fitur ini hanya tersedia pada jenis data ditampilkan Realisasi Fisik Dan Keuangan Berdasarkan Detail Jenis Belanja','error');
		}


	}




function checkIframeLoaded() {
var myIframe = document.getElementById('tampil_pdf');
  var isLoaded = myIframe.prop('data-isloaded');
  if(isLoaded != '1')
  {
    alert('iframe failed to load');
  } else {
    alert('iframe loaded');
  }
}

function afterLoading(){
	alert("I am here");
    // stop_loading();
}



</script>