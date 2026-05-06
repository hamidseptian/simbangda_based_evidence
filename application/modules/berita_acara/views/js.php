
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatables/dataTables.min.js"></script>
<script>

<?php if ($method=='setting') { ?>
function tambah_berita_acara()
{
	$('#modal_tambah_ba').modal('show');
}


function simpan_setting_ba()
{
	
	var formdata  = $('#modal_tambah_ba').find('#form_edit_ba').serialize();
	$.ajax({
		url: baseUrl('berita_acara/simpan_setting_berita_acara/'),
		type: 'POST',
		dataType: 'JSON',
		data: formdata,	
		success: function (data)
		{
			
			if(data.success == true)
			{
				
					// Swal.fire('Disimpan','Data Instansi Diperbaharui','success');
				
				window.location.reload();
					

			}else{
				$.each(data.messages, function (key, value)
				{
					var element = $('#modal_tambah_ba').find('#' + key);
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
<?php }else{ ?>

function edit_berita_acara(id_ba)
{
	$('#modal_edit_ba').modal('show');
	$.ajax({
		url: baseUrl('berita_acara/get_berita_acara/'),
		type: 'POST',
		dataType: 'JSON',
		data: {
			'id_ba' : id_ba
		},
		success: function (data)
		{
			$('#modal_edit_ba').find('#keg').html(data.kegiatan);
			$('#modal_edit_ba').find('#ket').html(data.keterangan);
			$('#modal_edit_ba').find('#id_setting_ba').val(data.id_setting_berita_acara	);
			$('#modal_edit_ba').find('#lokasi').val(data.lokasi);
			$('#modal_edit_ba').find('#tgl_awal').val(data.tgl_mulai_pelaksanaan);
			$('#modal_edit_ba').find('#tgl_akhir').val(data.tgl_akhir_pelaksanaan);
			$('#modal_edit_ba').find('#tahap').val(data.kode_tahap).change();
			$('#modal_edit_ba').find('#tahun').val(data.tahun).change();
			
		},
		error: function (jqXHR, textStatus, errorThrown) {
			
		}
	});
}

function ganti_jadwal_ba(id_instansi, nama_instansi, id_ba, id_user, pimpinan, helpdesk)
{
	$('#modal_ganti_jadwal_ba').modal('show');
	$('#modal_ganti_jadwal_ba').find('#opd').val(nama_instansi);
	$('#modal_ganti_jadwal_ba').find('#id_instansi').val(id_instansi);
	$('#modal_ganti_jadwal_ba').find('#id_user').val(id_user);
	$('#modal_ganti_jadwal_ba').find('#pimpinan').val(pimpinan);
	$('#modal_ganti_jadwal_ba').find('#helpdesk').val(helpdesk);
	
}

function catatan_helpdesk(id_isi_ba, nama_instansi, helpdesk, catatan, solusi)
{
	$('#modal_catatan_helpdesk').modal('show');
	$('#modal_catatan_helpdesk').find('#catatan').val(catatan);
	$('#modal_catatan_helpdesk').find('#solusi').val(solusi);
	$('#modal_catatan_helpdesk').find('#opd').html('<b>'+nama_instansi+'</b>');
	$('#modal_catatan_helpdesk').find('#id_isi_ba').val(id_isi_ba);
	$('#modal_catatan_helpdesk').find('#helpdesk').html(helpdesk);
	
	
}

function setting_jadwal_asisten()
{
	$('#modal_ganti_jadwal_ba_asisten').modal('show');
}

function simpandit_setting_ba()
{
	
	var formdata  = $('#modal_edit_ba').find('#form_edit_ba').serialize();
	$.ajax({
		url: baseUrl('berita_acara/simpanedit_setting_berita_acara/'),
		type: 'POST',
		dataType: 'JSON',
		data: formdata,	
		success: function (data)
		{
			
			
			if(data.success == true)
			{
				
					// Swal.fire('Disimpan','Data Instansi Diperbaharui','success');
				
				window.location.reload();
					

			}else{
				$.each(data.messages, function (key, value)
				{
					var element = $('#modal_edit_ba').find('#' + key);
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

function simpandit_jadwal_instansi()
{
	
	var formdata  = $('#modal_ganti_jadwal_ba').find('#form_edit_ba').serialize();
	$.ajax({
		url: baseUrl('berita_acara/simpanedit_jadwal_berita_acara/'),
		type: 'POST',
		dataType: 'JSON',
		data: formdata,	
		success: function (data)
		{
					// Swal.fire('Disimpan','Data Instansi Diperbaharui','success');
			
		   	$('#table-instansi').DataTable().ajax.reload(null, false);
		   	$('#modal_ganti_jadwal_ba').modal('hide');
			
			
		},
		error: function (jqXHR, textStatus, errorThrown) {
			
		}
	});
	
}



function simpandit_catatan_helpdesk()
{
	
	var formdata  = $('#modal_catatan_helpdesk').find('#form_catatan').serialize();
	$.ajax({
		url: baseUrl('berita_acara/simpandit_catatan_helpdesk/'),
		type: 'POST',
		dataType: 'JSON',
		data: formdata,	
		success: function (data)
		{
					Swal.fire('Disimpan',data.pesan,'success');
			
		   	$('#table-instansi').DataTable().ajax.reload(null, false);
		   	$('#modal_catatan_helpdesk').modal('hide');
			
			
		},
		error: function (jqXHR, textStatus, errorThrown) {
			
		}
	});
	
}


function simpandit_jadwal_asisten()
{
	
	var formdata  = $('#modal_ganti_jadwal_ba_asisten').find('#form_edit_ba').serialize();
	$.ajax({
		url: baseUrl('berita_acara/simpanedit_jadwal_berita_acara_per_asisten/'),
		type: 'POST',
		dataType: 'JSON',
		data: formdata,	
		success: function (data)
		{
					Swal.fire('Disimpan',data.pesan,'success');
			
		   	$('#table-instansi').DataTable().ajax.reload(null, false);
		   	$('#modal_ganti_jadwal_ba_asisten').modal('hide');
			
			
			
		},
		error: function (jqXHR, textStatus, errorThrown) {
			
		}
	});
	
}


data_instansi();

function data_instansi()
	{
		
		var id_ba = '<?php echo $ba['id_setting_berita_acara'] ?>';

		$('#table-instansi').DataTable(
		{
	        processing	: true,
	        serverSide	: true,
	        bDestroy	: true,
	        responsive	: true,
	        ajax		: {
				          	url 	: baseUrl('berita_acara/jadwal_ba_instansi/'),
				            type 	: "POST",
				          	data 	: {
				          		id_ba : id_ba,
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

<?php } ?>




	function selesaikan(id, nama_instansi)
	{
		Swal.fire({
			  title: 'Warning',
			  text: 'Apakah anda ingin menyelesaikan berita acara : '+ nama_instansi+'.?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Selesaikan',
			  cancelButtonText: 'Batal'
			}).then((result) => {
			  if (result.isConfirmed) {
			  			$.ajax(
						{
				          	url 	: baseUrl('berita_acara/selesaikan/'),
							dataType: 'JSON',
							type    : 'POST',
							data    : { 
								id : id
							},
							success : function(data)
							{
								
								Swal.fire(
								      'Diselesaikan!',
								      data.messages,
								      'success'
								    );
								$('#table-instansi').DataTable().ajax.reload(null, false);
							},
							error : function(){
								alert(9);
							}
						});
			

			  
			  }
			});	
	}


	function reset_synchronize(id, id_setting_berita_acara,  id_instansi, nama_instansi)
	{
		Swal.fire({
			  title: 'Warning',
			  text: 'Reset synchronize berita acara : '+ nama_instansi+'.?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Selesaikan',
			  cancelButtonText: 'Batal'
			}).then((result) => {
			  if (result.isConfirmed) {
			  			$.ajax(
						{
				          	url 	: baseUrl('berita_acara/reset_synchronize/'),
							dataType: 'JSON',
							type    : 'POST',
							data    : { 
								id : id,
								id_instansi : id_instansi,
								id_setting_berita_acara : id_setting_berita_acara,
							},
							success : function(data)
							{
								
								Swal.fire(
								      'Direset!',
								      data.messages,
								      'success'
								    );
								$('#table-instansi').DataTable().ajax.reload(null, false);
							},
							error : function(){
								alert(9);
							}
						});
			

			  
			  }
			});	
	}



</script>