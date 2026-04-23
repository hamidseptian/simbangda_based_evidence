
<!-- Datatables -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatables/dataTables.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/select2/dist/js/select2.min.js') ?>"></script>
<!-- Leaflet -->

<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="<?php echo base_url(); ?>assets/leaflet/leaflet.js"></script>
<script>

	function showAutoCurrency(){
		$('input.currency').number( true, 0 );
	}

	function tahap_apbd(kode){
		var arr = ['','','APBD AWAL','','APBD Perubahan'];
		return arr[kode];	
	}

showAutoCurrency();
	function anggaran_sub_kegiatan_ikd(kode_sub_kegiatan, id_instansi, tahun, kode_tahap){
		$('#view_anggaran_ski').modal('show');

  					$.ajax({
						url: baseUrl('integrasi_aplikasi/cek_import_ikd_detail_pagu'),
						type: 'POST',
						dataType: 'JSON',
						data: {
							kode_sub_kegiatan : kode_sub_kegiatan,
							tahun : tahun,
							kode_tahap : kode_tahap,
							id_instansi : id_instansi,
						},
						success: function(data) {
							$('#view_anggaran_ski').find('#rea_bo').val(data.rea_bo);
							$('#view_anggaran_ski').find('#rea_bm').val(data.rea_bm);
							$('#view_anggaran_ski').find('#rea_btt').val(data.rea_btt);
							$('#view_anggaran_ski').find('#rea_bt').val(data.rea_bt);
							$('#view_anggaran_ski').find('#bo_bp').val(number_format(data.bo_bp));
							$('#view_anggaran_ski').find('#bm_bmt').val(number_format(data.bm_bmt));
							$('#view_anggaran_ski').find('#btt').val(number_format(data.btt));
							$('#view_anggaran_ski').find('#bt_bbh').val(number_format(data.bt_bbh));
							$('#view_anggaran_ski').find('#bo_bbj').val(number_format(data.bo_bbj));
							$('#view_anggaran_ski').find('#bm_bmpm').val(number_format(data.bm_bmpm));
							$('#view_anggaran_ski').find('#bt_bbk').val(number_format(data.bt_bbk));
							$('#view_anggaran_ski').find('#bo_bs').val(number_format(data.bo_bs));
							$('#view_anggaran_ski').find('#bm_bmgb').val(number_format(data.bm_bmgb));
							$('#view_anggaran_ski').find('#bo_bh').val(number_format(data.bo_bh));
							$('#view_anggaran_ski').find('#bm_bmjji').val(number_format(data.bm_bmjji));
							$('#view_anggaran_ski').find('#bm_bmatl').val(number_format(data.bm_bmatl));

							$('#view_anggaran_ski').find('.kategori').html(data.kategori);
							$('#view_anggaran_ski').find('.kode_sub_kegiatan').html(data.kode_sub_kegiatan);
							$('#view_anggaran_ski').find('.nama_sub_kegiatan').html(data.nama_sub_kegiatan);
							$('#view_anggaran_ski').find('.tahapan_apbd').html(tahap_apbd(data.kode_tahap));

							var pagu_total = parseInt(data.bo_bp) + parseInt(data.bm_bmt) + parseInt(data.btt) + parseInt(data.bt_bbh) + parseInt(data.bo_bbj) + parseInt(data.bm_bmpm) + parseInt(data.bt_bbk) + parseInt(data.bo_bs) + parseInt(data.bm_bmgb) + parseInt(data.bo_bh) + parseInt(data.bm_bmjji) +parseInt( data.bm_bmatl) ; 
							$('#view_anggaran_ski').find('.pagu_tahapan_apbd').html(number_format(pagu_total));
							
						},
						error: function(jqXHR, textStatus, errorThrown) {
							alert('e');
						}
					});




	}
	var fetch_method = '<?php echo $fetch_method ?>';
	// if (fetch_method=='cek_import_ikd') {
	// 	var id_opd = '<?php echo @$id_opd ?>';
	// 	var tahun = '<?php echo $tahun ?>';
	// 	// kelola_import_ikd(id_opd, tahun);
	// }
	// // alert(fetch_method);
    $('#datatable_1').DataTable();
		$('#id_opd').select2(
		{
			placeholder : "Pilih OPD",
			allowClear	: false,
			width 		: 'style',
			theme 		: 'bootstrap4'
		});


	 function get_data_integrasi_ikd(){

    
	 	$('#searching_button').attr("disabled","disabled");
	 	// $('#loading').modal("show");
	 	$('#searching_button').html(`<i class="fa fa-cog fa-w-16 fa-spin"></i> Loading Data`);
		id_instansi =  $('#id_opd').val();
		tahun =  $('#tahun').val();
		tahap =  $('#kode_tahap').val();
		bulan =  $('#bulan').val();
		kategori_data =  $('#kategori_data').val();

		// start_loading('Mencari data di ikd');





		$.ajax({
			url: baseUrl('integrasi_aplikasi/get_data_ikd'),
			type: 'POST',
			// dataType: 'JSON',
			data: {
				id_instansi : id_instansi,
				tahun : tahun,
				tahap : tahap,
				bulan : bulan,
			}	,
			success: function(data) {

				// stop_loading();
					$('#searching_button').removeAttr("disabled","disabled");
				 	$('#searching_button').html(`Searching`);
				$('#show_data_sipd').html(data);

			},
			error: function(jqXHR, textStatus, errorThrown) {
				Swal.fire('error','error','error')
				stop_loading();
			}
		});
	


 }

	 function import_ikd_ke_sbe(link_api_penyedia, link_api_swakelola, belum_terimport, id_instansi, tahun, jenis){

		Swal.fire({
			  title: 'Warning',
			  html: 'Apakah anda akan melakukan import data di ikd ke Data Paket Pekerjaan, '+ belum_terimport+' data akan di importkan.?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonHtml: 'Import',
			  cancelButtonText: 'Batal'
			}).then((result) => {
			  if (result.isConfirmed) {
					$('#progres_import').modal('show');
					start_loading('Import data paket pekerjaan dari ikd ke Simbangda');
					
  					$.ajax({
						url: baseUrl('integrasi_aplikasi/import_ikd_ke_sbe'),
						type: 'POST',
						dataType: 'JSON',
						data: {
							link_api_penyedia : link_api_penyedia,
							link_api_swakelola : link_api_swakelola,
							tahun : tahun,
							id_instansi : id_instansi,
							jenis : jenis
						},
						success: function(data) {
							stop_loading();
							Swal.fire(data.instruksi, data.message,data.swal_code);
							if (data.success==true) {
								var id_opd = data.id_opd ; 
								window.location.href= baseUrl('integrasi_aplikasi/cek_import_ikd?id_opd='+id_opd+'&tahun=' + tahun+'&jumlah_ikd=' + data.jumlah_data_ikd);
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {
							alert('e');
						}
					});
			  }
			});




	


 }
	



	function kelola_import_ikd(id_instansi, tahun)
	{
		$('#list_paket_import_ikd').DataTable(
		{
	        processing	: true,
	        serverSide	: true,
	        bDestroy	: true,
	        responsive	: true,
	        ajax		: {
				          	url 	: baseUrl('integrasi_aplikasi/dt_paket_import_integrasi_ikd/'),
				            type 	: "POST",
				          	data 	: {
				          		id_instansi : id_instansi,
				          		tahun : tahun,
				          	}
	        			  },
	        columnDefs  : [
						  	{
						    	targets	 	: [ 0, -1 ],
						    	orderable 	: false,
						    },
						    {
								width		: "1%",
								targets		: [ 0 ],
							},
							{
								className	: "dt-center",
								targets		: [ -1 ],
							},
	        			  ],
	    
	     //    fnRowCallback : function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		    //    var index = iDisplayIndex +1;
		    //    $('td:eq(0)',nRow).html(index);
		    //    return nRow;
		    // }

    	});
	}



	function edit_sub_kegiatan_import_ikd(kode_sub_kegiatan, id_paket_pekerjaan)
	{
		$('#edit_sub_kegiatan_import_ikd').modal('show');
		$('#edit_sub_kegiatan_import_ikd').find('#kode_sub_kegiatan').val(kode_sub_kegiatan);
		$('#edit_sub_kegiatan_import_ikd').find('#id_paket_pekerjaan').val(id_paket_pekerjaan);




		$.ajax(
        {
            url     : baseUrl('paket_pekerjaan/get_paket_pekerjaan/'),
            dataType: 'JSON',
            type    : 'POST',
            data    : { 
            	id_paket_pekerjaan : id_paket_pekerjaan,
            	jenis_input :' jenis_input' 
            },
            success : function(data)
            {
				
				$('#edit_sub_kegiatan_import_ikd').find('#nama_paket').html(data.data.nama_paket);
				$('#edit_sub_kegiatan_import_ikd').find('#jenis_paket').html(data.data.jenis_paket);
				$('#edit_sub_kegiatan_import_ikd').find('#pagu_paket').html(data.data.pagu);
				$('#edit_sub_kegiatan_import_ikd').find('.nama_sub_kegiatan').html(data.data.nama_sub_kegiatan);
				$('#edit_sub_kegiatan_import_ikd').find('.kode_sub_kegiatan').html(data.data.kode_rekening_sub_kegiatan);
				$('#edit_sub_kegiatan_import_ikd').find('.nama_metode').html(data.data.nama_metode);
            }
        });
	
	}

	function edit_kategori_import_ikd(id_paket_pekerjaan)
	{
		$('#edit_kategori_import_ikd').modal('show');
		$('#edit_kategori_import_ikd').find('#id_paket_pekerjaan').val(id_paket_pekerjaan);




		$.ajax(
        {
            url     : baseUrl('paket_pekerjaan/get_paket_pekerjaan/'),
            dataType: 'JSON',
            type    : 'POST',
            data    : { 
            	id_paket_pekerjaan : id_paket_pekerjaan,
            	jenis_input :' jenis_input' 
            },
            success : function(data)
            {
				
				$('#edit_kategori_import_ikd').find('#nama_paket').html(data.data.nama_paket);
				$('#edit_kategori_import_ikd').find('#jenis_paket').html(data.data.jenis_paket);
				$('#edit_kategori_import_ikd').find('#pagu_paket').html(data.data.pagu);
				var kategori = data.data.kategori =='' ? 'Belum Ditentukan' : data.data.kategori;
				$('#edit_kategori_import_ikd').find('#kategori').html(kategori);
            }
        });
	
	}

	function simpanedit_sub_kegiatan_import_ikd(kode_sub_kegiatan, kode_kegiatan, kode_program, kode_bu)
	{
		var id_paket_pekerjaan = $('#edit_sub_kegiatan_import_ikd').find('#id_paket_pekerjaan').val();

		


		$.ajax({
			url: baseUrl('integrasi_aplikasi/simpanedit_sub_kegiatan_import_ikd'),
			type: 'POST',
			dataType: 'JSON',
			data: {
				id_paket : id_paket_pekerjaan, 
				kode_sub_kegiatan : kode_sub_kegiatan,
				kode_kegiatan : kode_kegiatan,
				kode_program : kode_program,
				kode_bu : kode_bu,
			},
			success: function (data)
			{
				

		$('#edit_sub_kegiatan_import_ikd').modal('hide');
				$('#list_paket_import_ikd').DataTable().ajax.reload(null, false);
			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});
	
	}
	function simpanedit_kategori_import_ikd()
	{
		var id_paket_pekerjaan = $('#edit_kategori_import_ikd').find('#id_paket_pekerjaan').val();
		var kategori = $('#edit_kategori_import_ikd').find('#option_kategori').val();

		

		$.ajax({
			url: baseUrl('integrasi_aplikasi/simpanedit_kategori_import_ikd'),
			type: 'POST',
			dataType: 'JSON',
			data: {
				id_paket : id_paket_pekerjaan, 
				kategori : kategori, 
			
			},
			success: function (data)
			{
				

		$('#edit_kategori_import_ikd').modal('hide');
				$('#list_paket_import_ikd').DataTable().ajax.reload(null, false);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				

			}
		});
	
	}

	function sinkron_lokasi_import_ikd()
	{
		
		start_loading('Sinkronisasi Lokasi ikd ke Simbangda');
		// Swal.fire('Development', 'Jika sukses di redirect langsung ke halaman pengelolaan','info');
		$.ajax({
			url: baseUrl('integrasi_aplikasi/sinkron_lokasi_import_ikd'),
			type: 'POST',
			dataType: 'JSON',
			data: {
				
			
			},
			success: function (data)
			{
				stop_loading();
				$('#list_paket_import_ikd').DataTable().ajax.reload(null, false);
				$('#tombol_sinkron_lokasi').attr('hidden','true');
							// if (data.success==true) {
							// 	var id_opd = data.id_opd ; 
							// 	window.location.href= baseUrl('integrasi_aplikasi/cek_import_ikd?id_opd='+id_opd+'&tahun=' + tahun);
							// }
							// // get_data_integrasi_ikd();
							// // $('#progres_import').modal('hide');
				Swal.fire(data.instruksi, data.message,data.swal_code);


			},
			error: function (jqXHR, textStatus, errorThrown) {
				

			}
		});
	
	}


function number_format(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}

function ambil_data_pagu(x){
	var nilai = $(x).parents('tr').find('#data_pagu_get').val();
	$('#view_anggaran_ski_belum_import').modal('show');
	var parse = JSON.parse(nilai);
	$('#view_anggaran_ski_belum_import').find('.kategori').html(parse.kategori);
	$('#view_anggaran_ski_belum_import').find('.nama_sub_kegiatan').html(parse.kode_sub_kegiatan);
	$('#view_anggaran_ski_belum_import').find('.pagu_tahapan_apbd').html(number_format(parse.pagu_total));
	$('#view_anggaran_ski_belum_import').find('#bo_bp').val(number_format(parse.bo_bp));
	$('#view_anggaran_ski_belum_import').find('#bm_bmt').val(number_format(parse.bm_bmt));
	$('#view_anggaran_ski_belum_import').find('#btt').val(number_format(parse.btt));
	$('#view_anggaran_ski_belum_import').find('#bt_bbh').val(number_format(parse.bt_bbh));
	$('#view_anggaran_ski_belum_import').find('#bo_bbj').val(number_format(parse.bo_bbj));
	$('#view_anggaran_ski_belum_import').find('#bm_bmpm').val(number_format(parse.bm_bmpm));
	$('#view_anggaran_ski_belum_import').find('#bt_bbk').val(number_format(parse.bt_bbk));
	$('#view_anggaran_ski_belum_import').find('#bo_bs').val(number_format(parse.bo_bs));
	$('#view_anggaran_ski_belum_import').find('#bm_bmgb').val(number_format(parse.bm_bmgb));
	$('#view_anggaran_ski_belum_import').find('#bo_bh').val(number_format(parse.bo_bh));
	$('#view_anggaran_ski_belum_import').find('#bm_bmjji').val(number_format(parse.bm_bmjji));
	$('#view_anggaran_ski_belum_import').find('#bm_bmatl').val(number_format(parse.bm_bmatl));

}
function ambil_data_target(x){
	var nilai = $(x).parents('tr').find('#data_target_get').val();
	$('#view_target').modal('show');
	var parse = JSON.parse(nilai);
	$('#view_target').find('.kode_sub_kegiatan').html(parse.kode_rekening_sub_kegiatan);
	$('#view_target').find('#nama_sub_kegiatan').html(parse.nama_sub_kegiatan);
	$('#view_target').find('#pagu_sub_kegiatan').html(parse.pagu_sub_kegiatan);
	$('#view_target').find('#target-apbd').html('');
	
	$.each(parse.data, function(k,v){
		$('#view_target').find('#target-apbd').append(`
			<tr>
			<td>`+(k+1)+`</td>
			<td>`+nama_bulan(v.bulan)+`</td>
			<td>`+v.target_fisik_bulanan.toFixed(2)+`</td>
			<td>`+v.target_fisik.toFixed(2)+`</td>
			<td>`+v.persen_target_keuangan_bulanan.toFixed(2)+`</td>
			<td>`+v.persen_target_keuangan.toFixed(2)+`</td>
			<td>`+number_format(v.target_keuangan_bulanan)+`</td>
			<td>`+number_format(v.target_keuangan)+`</td>
		
			</tr>
			`);

	});
		$('#view_target').find('#target-apbd').append(`
			<tr>
			<td colspan="8">
			Note : <br>
			Target fisik mengikuti nilai persentasi target realisasi keuangan
			</td>
		
			</tr>
			`);
}
function ambil_data_realisasi(x, jenis){

        
		// var nilai = $(x).parents('tr').find('#data_realisasi_get').val();
		$('#modal-realisasi-keuangan').modal('show');
		// var parse = JSON.parse(nilai);

        $('#modal-realisasi-keuangan').find('#bulan_ini_bo_total').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bo_bbj').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bo_bs').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bo_bh').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bm_bmt').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bm_total').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bm_bmpm').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bm_bmgb').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bm_bmjji').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bm_bmatl').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_btt').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bt_bbh').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bt_total').html(jenis);
        $('#modal-realisasi-keuangan').find('#bulan_ini_bt_bbk').html(jenis);



}
function nama_bulan(x){
	var bulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','Sep','Okt','Nov','Des'];
	return bulan[x];
}

</script>