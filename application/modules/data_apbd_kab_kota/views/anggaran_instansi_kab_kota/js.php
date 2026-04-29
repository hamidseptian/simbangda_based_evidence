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
<!-- Leaflet -->

<script src="https://cdn.jsdelivr.net/npm/x-editable-bs4@1.2.2/dist/bootstrap4-editable/js/bootstrap-editable.min.js"></script>
<script src="<?php echo base_url(); ?>assets/leaflet/leaflet.js"></script>
<script>
	
	$(document).ready(function()
	{
	   	anggaran_total_kab_kota();
	   	anggaran_instansi_kab_kota();
	   	show_select2();
	   	showAutoCurrency();
	});

	function showAutoCurrency(){
		$('input.currency').number( true, 0 );
	}


function bulan(x) {
		let bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		return bulan[x];
	}
function convert_to_rupiah(angka) {
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
		return rupiah.split('', rupiah.length - 1).reverse().join('');
	}


	function show_select2() {
		
		$('#status').select2({
			placeholder: "Pilih Status",
			allowClear: false,
			width: 'style',
			theme: 'bootstrap4'
		});
		
	}



	function anggaran_total_kab_kota()
	{
	
		$.ajax(
        {
            url     : baseUrl('data_apbd_kab_kota/get_anggaran_total_kab_kota/'),
            dataType: 'JSON',
            type    : 'POST',
            data    : { 
            	
            	
            },
            success : function(data)
            {
	        	$('#total_bo').html(convert_to_rupiah(data.data.bo));
	        	$('#total_bm').html(convert_to_rupiah(data.data.bm));
	        	$('#total_btt').html(convert_to_rupiah(data.data.btt));
	        	$('#total_bt').html(convert_to_rupiah(data.data.bt));
	        	$('#total_pagu').html(convert_to_rupiah(data.data.total));
	        	$('#periode').html(data.data.periode);
            	
            	
           
            },
            error : function(){
            	
            }
        });


	}




function anggaran_instansi_kab_kota()
	{
		
		

		$('#table-instansi').DataTable(
		{
	        processing	: true,
	        serverSide	: true,
	        bDestroy	: true,
	        responsive	: true,
	        ajax		: {
				          	url 	: baseUrl('data_apbd_kab_kota/data_anggaran_instansi_kab_kota/'),
				            type 	: "POST",
				          	data 	: {}
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












	function input_pagu_instansi(id_instansi, tahap, tahun, pergeseran_ke)
	{
		$('#modal_input_anggaran').modal('show');
		$('.form-control').removeClass('is-valid')
						  .removeClass('is-invalid');
	  $('#form_anggaran_sub_kegiatan')[0].reset();
        $('.text-danger').remove();
        $('#pesan_mnodal_paket').html('');
		$('#form_anggaran_sub_kegiatan').attr('style', '');
    	$('#tahap').val(tahap);
    	$('#id_instansi').val(id_instansi);

    	// $('#rea_bo').removeAttr('checked');
    	// $('#rea_bm').removeAttr('checked');
    	// $('#rea_btt').removeAttr('checked');
    	// $('#rea_bt').removeAttr('checked');
		$.ajax(
        {
            url     : baseUrl('data_apbd_kab_kota/get_anggaran_instansi_kab_kota/'),
            dataType: 'JSON',
            type    : 'POST',
            data    : { 
            	
            	id_instansi : id_instansi,
            	pergeseran_ke : pergeseran_ke,
            	tahap : tahap
            },
            success : function(data)
            {
            	
            	
            	$('#modal_input_anggaran').find('.instansi').html(data.data.nama_instansi);
            
                if(data.status == true)
                {
                	
                	
                	$('#bo_bp').val(data.data. bo_bp);
                	$('#bo_bbj').val(data.data.bo_bbj);
                	$('#bo_bs').val(data.data.bo_bs);
                	$('#bo_bh').val(data.data.bo_bh);
                	$('#bo_bbs').val(data.data.bo_bbs);
                	$('#bm_bmt').val(data.data.bm_bmt);
                	$('#bm_bmpm').val(data.data.bm_bmpm);
                	$('#bm_bmgb').val(data.data.bm_bmgb);
                	$('#bm_bmjji').val(data.data.bm_bmjji);
                	$('#bm_bmatl').val(data.data.bm_bmatl);
                	$('#bm_bmatb').val(data.data.bm_bmatb);
                	$('#btt').val(data.data.btt);
                	$('#bt_bbh').val(data.data.bt_bbh);
                	$('#bt_bbk').val(data.data.bt_bbk);
                	$('#pergeseran_ke').val(pergeseran_ke);
                	$('#tahun').val(tahun);
                	$('.tahapan').html(data.data.caption_apbd);
                	$('.show_pagu').html(data.data.pagu_total);
                }
                
                	data.data.rea_bo ==1 ? $('#rea_bo').attr('checked','checked') : $('#rea_bo').removeAttr('checked');
                	data.data.rea_bm ==1 ? $('#rea_bm').attr('checked','checked') : $('#rea_bm').removeAttr('checked');
                	data.data.rea_btt ==1 ? $('#rea_btt').attr('checked','checked') : $('#rea_btt').removeAttr('checked');
                	data.data.rea_bt ==1 ? $('#rea_bt').attr('checked','checked') : $('#rea_bt').removeAttr('checked');
            },
            error : function(){
            	
            }
        });


	}



function lakukan_pergeseran(id_aikk){
	var pengelompokan = $('#modal_input_anggaran').find('#pengelompokan').val();
	var skpd = $('#modal_input_anggaran').find('.instansi').html();
		$.ajax(
        {
            url     : baseUrl('data_apbd_kab_kota/insert_pergeseran/'),
            dataType: 'JSON',
            type    : 'POST',
            data    : { 
            	id_aikk : id_aikk,
            	skpd : skpd,
             
            },
            success : function(data)
            {
            	
            	if (data.status==true) {
            	Swal.fire('Digeser',data.data.swal_caption,'success');
            	// input_anggaran(kode_rekening_sub_kegiatan,tahap, tahun, pengelompokan)
            	 input_pagu_instansi(data.data.id_instansi, data.tahun, data.data.tahap, 1)
				$('#table-instansi').DataTable().ajax.reload(null, false);
            	}else{
            	Swal.fire('Error','Terjadi kesalahan','error');
            	}
            	
            }, error : function(){
            	Swal.fire('Error','error','error');
            }
        });
}


function edit_pergeseran_ke(ke){
	$('#modal_input_anggaran').find('#edit_pergeseran_ke').html(`
		<input type="" name="" class="form-control mb-1 currency" id="input_pergeseran_ke" onblur="if(value==''){value='0'}" >        
		<button class="btn btn-info btn-sm" onclick="cancel_edit_pergeseran_ke('`+ke+`')"  type="button">Cancel</button> 
		<button class="btn btn-info btn-sm" onclick="simpanedit_pergeseran_ke()" type="button">Simpan Perubahan Pergeseran</button> 

`);
}


function cancel_edit_pergeseran_ke(ke){
	$('#modal_input_anggaran').find('#edit_pergeseran_ke').html(`<button type="button" class="btn btn-outline-info btn-sm" onclick="edit_pergeseran_ke('`+ke+`')">Edit Pergeseran Ke</button></div>

`);
}



function simpanedit_pergeseran_ke(){
	var pergeseran_ke_sebelumnya = $('#modal_input_anggaran').find('#pergeseran_ke').val();
	var input_pergeseran_ke = $('#modal_input_anggaran').find('#input_pergeseran_ke').val();
	var id_instansi = $('#modal_input_anggaran').find('#id_instansi').val();
	var tahap = $('#modal_input_anggaran').find('#tahap').val();
	var tahun = $('#modal_input_anggaran').find('#tahun').val();
	var pengelompokan = $('#modal_input_anggaran').find('#pengelompokan').val();
            	console.log(tahun);

	var nama_sub_kegiatan = $('#modal_input_anggaran').find('.nama_sub_kegiatan').html();


	if (input_pergeseran_ke=='') {
		Swal.fire('Error','Harap mengisi pergeseran ke','error');
	}else{

	
		$.ajax(
        {
            url     : baseUrl('data_apbd_kab_kota/simpanedit_pergeseran_ke/'),
            dataType: 'JSON',
            type    : 'POST',
            data    : { 
				pergeseran_ke_sebelumnya : pergeseran_ke_sebelumnya , 
				id_instansi : id_instansi , 
				input_pergeseran_ke : input_pergeseran_ke , 
				nama_sub_kegiatan : nama_sub_kegiatan , 
				tahap : tahap , 
				tahun : tahun , 
            },
            success : function(data)
            {
            	if (data.success==true) {
	            	input_pagu_instansi(id_instansi,tahap, tahun, input_pergeseran_ke);
					$('#table-instansi').DataTable().ajax.reload(null, false);
					

            		Swal.fire('Disimpan',data.swal_caption,'success');
	            }else{
            		Swal.fire('Error','Error','error');

	            }
            	
            }, 
            error : function(){
            	alert('ee');
            }
        });

	}



}


function get_target_kab_kota(nama_instansi, id_instansi, id_kota, tahap, tahun, pagu)
	{	
		$('#modal-target').modal('show');
		$('.form-control').removeClass('is-valid')
						  .removeClass('is-invalid');
	 
        $('.text-danger').remove();
        
		

		$('#modal-target').find('.nama_instansi').html(nama_instansi);
		$('#modal-target').find('#id_instansi').val(id_instansi);
    	$('#modal-target').find('#tahap').val(tahap);
    	$('#modal-target').find('#tahun').val(tahun);
    	$('#modal-target').find('#id_kota').val(id_kota);
    	$('#modal-target').find('#pagu').val(pagu==''? 0: pagu);
    	$('#modal-target').find('.pagu').html(convert_to_rupiah(pagu));

		// var tahap = "<?php //echo tahapan_apbd() ?>";
		// if (tahap=='4') {
		// 	$('#modal-target').find('#btn_copy_target_awal').show();
		// }else{
		// 	$('#modal-target').find('#btn_copy_target_awal').hide();
		// }
		$.ajax(
        {
            url     : baseUrl('data_apbd_kab_kota/get_target/'),
            dataType: 'JSON',
            type    : 'POST',
            data    : { 
            	id_instansi : id_instansi,
            	id_kota : id_kota,
            	tahap : tahap,
            	tahun : tahun,
            },
            success : function(data)
            {
            	
				$('#modal-target').find('.kode_sub_kegiatan').html(data.kode_sub_kegiatan);
		    	$('#modal-target').find('#pagu_sub_kegiatan').html(convert_to_rupiah(pagu==''? 0 : pagu));
            	$('#modal-target').find('#exampleModalLabel').html("Setting Target APBD");
            	$('#modal-target').find('#nama_sub_kegiatan').html(data.nama_sub_kegiatan);
            	$('#modal-target').find('#kode_sub_kegiatan').html(id_instansi);
            	$('#modal-target').find('#nama_tahapan').html(data.nama_tahapan + "<br>Tahun "+ tahun);
            	if (data.totaldata == 0) {
            		get_target_kab_kota(nama_instansi,id_instansi, id_kota, tahap, tahun, pagu);
            	}else{

            	
					$('#target-apbd').html('');
	                if (data.status == true) {
						$.each(data.data, function(k, v) {
							$('#target-apbd').append(
								'<tr>' +
								'<td style="text-align: right;">' + (k + 1) + '</td>' +
								'<td style="text-align: right;">' + bulan(v.bulan) + '</td>' +
								'<td style="text-align: right;"><a href="#" id="target-fisik" id_instansi="' + id_instansi + '" nama_instansi="' + nama_instansi + '" id_kota="' + id_kota + '"  pagu="' + pagu + '"  tahap="' + tahap + '", tahun="' + tahun + '" pk="' + v.id + '" class="edit" data-type="text" onclick="edit_target_fisik(this)">' + v.t_fisik_bulanan + '</a></td>' +

								'<td style="text-align: right;">' + v.t_fisik + '</td>' +
								'<td style="text-align: right;">' + ((v.t_keuangan_bulanan / pagu) * 100).toFixed(2) + '</td>' +
								'<td style="text-align: right;">' + ((v.t_keuangan / pagu) * 100).toFixed(2) + '</td>' +
								'<td style="text-align: right;">' + '<a href="#" id="target-fisik" id_instansi="' + id_instansi + '" nama_instansi="' + nama_instansi + '" id_kota="' + id_kota + '" pagu="' + pagu + '"  tahap="' + tahap + '", tahun="' + tahun + '" pk="' + v.id + '" class="edit" data-type="text" onclick="edit_target_keuangan(this)">' + convert_to_rupiah(v.t_keuangan_bulanan) + '</a>'  + '</td>' +
								'<td>' + convert_to_rupiah(v.t_keuangan) + '</td>' +
								'</tr>'
							);
						});
					}
	            }
	        },
	        error : function (){
	        	
	        }
        });


	}


function edit_target_fisik(x) {
		$.fn.editableform.buttons = '<button type="submit" class="btn btn-primary btn-xs editable-submit">OK</button>' +
			'<button type="button" class="btn btn-default btn-xs editable-cancel">Batal</button>';

		let id = $(x).attr('pk');
		let id_instansi = $(x).attr('id_instansi');
		let nama_instansi = $(x).attr('nama_instansi');
		let id_kota = $(x).attr('id_kota');
		let pagu = $(x).attr('pagu');
		let tahap = $(x).attr('tahap');
		let tahun = $(x).attr('tahun');
		
		$(x).editable({
			mode: 'inline',
			pk: id,
			savenochange: true,
			url: baseUrl('data_apbd_kab_kota/update_target_fisik/' + id_instansi),
			success: function(c) {
				get_target_kab_kota(nama_instansi,id_instansi, id_kota, tahap, tahun, pagu);
			},
		});
	}
function edit_target_keuangan(x) {
		$.fn.editableform.buttons = '<button type="submit" class="btn btn-primary btn-xs editable-submit">OK</button>' +
			'<button type="button" class="btn btn-default btn-xs editable-cancel">Batal</button>';
		let id = $(x).attr('pk');
		let id_instansi = $(x).attr('id_instansi');
		let nama_instansi = $(x).attr('nama_instansi');
		let id_kota = $(x).attr('id_kota');
		let pagu = $(x).attr('pagu');
		let tahap = $(x).attr('tahap');
		let tahun = $(x).attr('tahun');
		
		
		$(x).editable({
			mode: 'inline',
			pk: id,
			savenochange: true,
			url: baseUrl('data_apbd_kab_kota/update_target_keuangan/' + id_instansi +'/'+ pagu),
			success: function(c) {
				
				get_target_kab_kota(nama_instansi,id_instansi, id_kota, tahap, tahun, pagu);
			},
		});
	}






	function copy_pagu_instansi(id_instansi, tahap, skpd)
	{

		Swal.fire({
			  title: 'Warning',
			  text: 'Apakah anda akan mencopy data pagu APBD AWAL pada SKPD ' + skpd,
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Copy',
			  cancelButtonText: 'Batal'
			}).then((result) => {
			  if (result.isConfirmed) {
			  		




			  		$.ajax(
			        {
			            url     : baseUrl('instansi/copy_anggaran_instansi_kab_kota/'),
			            dataType: 'JSON',
			            type    : 'POST',
			            data    : { 
			            	
			            	id_instansi : id_instansi,
			            	tahap : tahap,
			            	skpd : skpd,
			            },
			            success : function(data)
			            {
			            	
			            	if (data.status==true) {
				            	Swal.fire('Di Copy',data.messages, 'success');
			            	}else{
				            	Swal.fire('Tidak ada data',data.messages, 'error');

			            	}
			            	$('#table-instansi').DataTable().ajax.reload(null, false);
			            	
			            	
			            },
			            error : function(){
			            	
			            }
			        });
			

			  
			  }
			});








		


	}




	function save_anggaran_instansi_kab_kota()
	{
		let id_pptk 	= $('#id_pptk').val();
		//let id_table 	= $('#kode_rekening_kegiatan').val().split('.').join('-');

		$('.form-control').removeClass('is-valid')
						  .removeClass('is-invalid');
        $('.text-danger').remove();

		$.ajax({
			url: baseUrl('data_apbd_kab_kota/save_anggaran_instansi_kab_kota'),
			type: 'POST',
			dataType: 'JSON',
			data: $('#form_anggaran_sub_kegiatan').serialize(),
			success: function (datanya)
			{
				
				if(datanya.success == true)
				{
					
						$('#form_anggaran_sub_kegiatan')[0].reset();
						$('#modal_input_anggaran').modal('hide');

						$('#table-instansi').DataTable().ajax.reload(null, false);
						anggaran_total_kab_kota();

				}else{
					$.each(datanya.messages, function (key, value)
					{
						var element = $('#' + key);
						element.removeClass('is-invalid')
							.addClass(value.length > 0 ? 'is-invalid' : 'is-valid')
							.find('.text-danger')
							.remove();
						element.after(value);
					});
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				
			}
		});
	}


			
			

function ceklis_realisasi(id){
	$("#" + id).change(function(){

	  if ($(this).is('checked')) {
	      var nilai = 1;
	  } else {
	      var nilai = 0;
	  }       
	
	});
	
}


function input_target_forbidden(nama_instansi){
		Swal.fire(
		      'Error!',
		      'Anda tidak bisa menginputkan target karena tidak ada anggaran pada ' + nama_instansi+'. Target bisa di inputkan jika ada anggaran',
		      'error'
		    );
	}
</script>