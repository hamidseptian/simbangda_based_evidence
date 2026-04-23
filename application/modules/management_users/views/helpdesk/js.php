
<script type="text/javascript" src="<?php echo base_url() ?>assets/datatables/dataTables.min.js"></script>		
<script src="<?php echo base_url() ?>assets/select2/dist/js/select2.min.js"></script>
<!-- Function -->
<script>
	/* Global Variable */

	$(document).ready(function()
	{

	   select2();
	   data_opd();
	   data_helpdesk_opd();
	   data_opd_helpdesk();
	
	   statistika_helpdesk();
	});




function data_helpdesk_opd() {
		// $("#table-kegiatan-apbd").hide();
		// $("#table-kegiatan-apbd").slideUp( 1 ).delay( 1 ).fadeIn( 1 );
		$('#table-helpdesk-fisik').DataTable({
			// processing	: true,
			serverSide: true,
			bDestroy: true,
			responsive: true,
			ajax: {
				url: baseUrl('management_users/dt_helpdesk/'),
				type: "POST",
				data: {
					id_group : 4
				},
			},
			columnDefs: [{
					targets: [0, -1, -2],
					orderable: false,
				},
				{
					width: "1%",
					targets: [-1, -2],
				},
				{
					className: "dt-center",
					targets: [-1, -2],
				},
				{
					className: "dt-right",
					targets: [2, 3, 4, 5],
				},
			],

		});
	}	
function data_opd_helpdesk() {
		// $("#table-kegiatan-apbd").hide();
		// $("#table-kegiatan-apbd").slideUp( 1 ).delay( 1 ).fadeIn( 1 );
		$('#table-skpd-helpdesk').DataTable({
			// processing	: true,
			serverSide: true,
			bDestroy: true,
			responsive: true,
			ajax: {
				url: baseUrl('management_users/dt_opd_helpdesk/'),
				type: "POST",
				data: {
					id_group : 8
				},
			},
			columnDefs: [{
					targets: [0, -1, -2],
					orderable: false,
				},
				{
					width: "1%",
					targets: [-1, -2],
				},
				// {
				// 	className: "dt-center",
				// 	targets: [-1, -2],
				// },
				
			],

		});
	}
function data_helpdesk_penyedia() {
		// $("#table-kegiatan-apbd").hide();
		// $("#table-kegiatan-apbd").slideUp( 1 ).delay( 1 ).fadeIn( 1 );
		$('#table-helpdesk-penyedia').DataTable({
			// processing	: true,
			serverSide: true,
			bDestroy: true,
			responsive: true,
			ajax: {
				url: baseUrl('management_users/dt_helpdesk_progul/'),
				type: "POST",
				data: {
					id_group : 9
				},
			},
			columnDefs: [{
					targets: [0, -1, -2],
					orderable: false,
				},
				{
					width: "1%",
					targets: [-1, -2],
				},
				{
					className: "dt-center",
					targets: [-1, -2],
				},
				{
					className: "dt-right",
					targets: [2, 3, 4],
				},
			],

		});
	}	







	function statistika_helpdesk()
	{
		$.ajax({
	    	url 	 : baseUrl('management_users/statistika_helpdesk/'),
	    	type 	 : "GET",
	    	dataType : "JSON",
	    	data 	 : {},
	    	success  : function(data)
	    	{
				$.each(data.data, function(k, v){
				
						$('#helpdesk_' + v.id_group).html(v.jml_data);
					});
	    	}
	    });
	}

	function data_opd()
	{
		$.ajax({
	    	url 	 : baseUrl('management_users/get_opd/'),
	    	type 	 : "GET",
	    	dataType : "JSON",
	    	data 	 : {},
	    	success  : function(data)
	    	{
				if(data.status == true)
				{
					$('#id_instansi').html('');
					$('#id_instansi').append('<option value=""></option>');

					$.each(data.data, function(k, v){
						$('#id_instansi').append('<option value="'+ v.id_instansi +'">'+ v.nama_instansi +'</option>');
					});
				}
			}
		});
	}
	function data_helpdesk_skpd(id_instansi)
	{
		$.ajax({
	    	url 	 : baseUrl('management_users/get_helpdesk_skpd/'),
	    	type 	 : "POST",
	    	dataType : "JSON",
	    	data 	 : {
	    		id_instansi : id_instansi
	    	},
	    	success  : function(data)
	    	{
				if(data.status == true)
				{
					$('#id_helpdesk').html('');
					$('#id_helpdesk').append('<option value=""></option>');

					$.each(data.data, function(k, v){
						$('#id_helpdesk').append('<option value="'+ v.id_user +'">'+ v.full_name +'</option>');
					});
				}
			},
			error : function(){
				
			}
		});
	}

	function tampil_opd(id_user,prop)
	{
		
		let parent  = $(prop).closest('.list-group-item').attr('id');
		
		$('.lg-item').removeClass('list-group-item-info');
		$('#'+ parent).addClass('list-group-item-info');

		$('#id_user').val(id_user);
		id_user ? $('#data-instansi').show() : $('#data-instansi').hide();
		$('#table-opd').DataTable(
		{
	        processing	: true,
	        serverSide	: true,
	        bDestroy	: true,
	        responsive	: true,
	        ajax		: {
				          	url 	: baseUrl('management_users/dt_opd/'),
				            type 	: "POST",
				          	data 	: { id_user : id_user },
	        			  },
	        columnDefs  : [
						  	{
						    	targets	 	: [ 0, -1 ],
						    	orderable 	: false,
						    },
						    {
								width		: "1%",
								targets		: [ 0, 2 ],
							},
							{
								className	: "dt-center",
								targets		: [ -1 ],
							},
	        			  ],

    	});
	}

	function show_opd(id_user)
	{
		
		$('#modal_helpdesk_skpd').modal('show');
		$('#modal_helpdesk_skpd').find('#id_user').val(id_user);

		$.ajax({
	    	url 	 : baseUrl('management_users/identitas_user/'),
	    	type 	 : "POST",
	    	dataType : "JSON",
	    	data 	 : { id_user : id_user},
	    	success  : function(data)
	    	{
				$('#modal_helpdesk_skpd').find('.nama_helpdesk').html(data.data.full_name);
				$('#modal_helpdesk_skpd').find('.username').html(data.data.username);
	    		
				if(data.status == true)
				{
					data_opd();
					tampil_opd(id_user);
				}
			}
		});

		$('#table-opd').DataTable(
		{
	        processing	: true,
	        serverSide	: true,
	        bDestroy	: true,
	        responsive	: true,
	        ajax		: {
				          	url 	: baseUrl('management_users/dt_opd/'),
				            type 	: "POST",
				          	data 	: { id_user : id_user },
	        			  },
	        columnDefs  : [
						  	{
						    	targets	 	: [ 0, -1 ],
						    	orderable 	: false,
						    },
						    {
								width		: "1%",
								targets		: [ 0, 2 ],
							},
							{
								className	: "dt-center",
								targets		: [ -1 ],
							},
	        			  ],

    	});
	}


	function show_helpdesk(id_instansi, nama_instansi)
	{
		
		$('#modal_skpd_helpdesk').modal('show');
		$('#modal_skpd_helpdesk').find('#id_instansi').val(id_instansi);
				$('#modal_skpd_helpdesk').find('.nama_skpd').html(nama_instansi	);


					data_helpdesk_skpd(id_instansi);



		$('#table-helpdesk-opd').DataTable(
		{
	        processing	: true,
	        serverSide	: true,
	        bDestroy	: true,
	        responsive	: true,
	        ajax		: {
				          	url 	: baseUrl('management_users/dt_opd_helpdesk_detail/'),
				            type 	: "POST",
				          	data 	: { id_instansi : id_instansi },
	        			  },
	      //   columnDefs  : [
						 //  	{
						 //    	targets	 	: [ 0, -1 ],
						 //    	orderable 	: false,
						 //    },
						 //    {
							// 	width		: "1%",
							// 	targets		: [ 0, 2 ],
							// },
							// {
							// 	className	: "dt-center",
							// 	targets		: [ -1 ],
							// },
	      //   			  ],

    	});
	}

	function select2()
	{
		showSelect2('id_instansi','Pilih Instansi');
		showSelect2('id_helpdesk','Pilih Helpdesk');
	}

	function tambah()
	{
		let id_user 	= $('#modal_helpdesk_skpd').find('#id_user').val();
		let id_instansi	= $('#modal_helpdesk_skpd').find('#id_instansi').val();
	

		if (id_instansi==null || id_instansi=='') {
			Swal.fire('Error','Harap Pilih Instansi','error');
		}else{
		
			$.ajax({
		    	url 	 : baseUrl('management_users/save/'),
		    	type 	 : "POST",
		    	dataType : "JSON",
		    	data 	 : { id_user : id_user, id_instansi : id_instansi },
		    	success  : function(data)
		    	{
					if(data.status == true)
					{
						data_opd();
						// statistika_helpdesk();
						$('#table-helpdesk-fisik').DataTable().ajax.reload(null, false);
						$('#table-opd').DataTable().ajax.reload(null, false);
						let id_instansi	= $('#modal_helpdesk_skpd').find('#id_instansi').val('').change();
						// tampil_opd(id_user);
					}
				}
			});
		}
	}


	function tambah_helpdesk_opd()
	{
		let id_helpdesk	= $('#modal_skpd_helpdesk').find('#id_helpdesk').val();
		let id_instansi	= $('#modal_skpd_helpdesk').find('#id_instansi').val();
	

		if (id_helpdesk==null || id_helpdesk=='') {
			Swal.fire('Error','Harap Pilih Helpdesk','error');
		}else{
		
			$.ajax({
		    	url 	 : baseUrl('management_users/save_helpdesk_skpd/'),
		    	type 	 : "POST",
		    	dataType : "JSON",
		    	data 	 : { id_helpdesk : id_helpdesk, id_instansi : id_instansi },
		    	success  : function(data)
		    	{
					if(data.status == true)
					{
						
						data_helpdesk_skpd(id_instansi);
						// statistika_helpdesk();
						$('#table-skpd-helpdesk').DataTable().ajax.reload(null, false);
						$('#table-helpdesk-opd').DataTable().ajax.reload(null, false);
						// tampil_opd(id_user);
					}
				}
			});
		}
	}

	function hapus_opd(id_helpdesk_instansi, id_user)
	{
		$.ajax({
	    	url 	 : baseUrl('management_users/delete_helpdesk_instansi/'),
	    	type 	 : "POST",
	    	dataType : "JSON",
	    	data 	 : { id_helpdesk_instansi : id_helpdesk_instansi },
	    	success  : function(data)
	    	{
				if(data.status == true)
				{
					data_opd();
					$('#table-helpdesk-fisik').DataTable().ajax.reload(null, false);
					$('#table-opd').DataTable().ajax.reload(null, false);
				}
			}
		});
	}

	function hapus_helpdesk_opd(id_helpdesk_instansi, id_instansi)
	{
		$.ajax({
	    	url 	 : baseUrl('management_users/delete_helpdesk_pada_instansi/'),
	    	type 	 : "POST",
	    	dataType : "JSON",
	    	data 	 : { 
	    		id_helpdesk_instansi : id_helpdesk_instansi, 
	    		id_instansi : id_instansi },
	    	success  : function(data)
	    	{
				if(data.status == true)
				{
					// data_opd();

					
						$('#table-skpd-helpdesk').DataTable().ajax.reload(null, false);
						$('#table-helpdesk-opd').DataTable().ajax.reload(null, false);
				}
			}
		});
	}
	function jadikan_helpdesk_utama(id_helpdesk_instansi, id_instansi)
	{
		$.ajax({
	    	url 	 : baseUrl('management_users/jadikan_helpdesk_instansi/'),
	    	type 	 : "POST",
	    	dataType : "JSON",
	    	data 	 : { 
	    		id_helpdesk_instansi : id_helpdesk_instansi, 
	    		id_instansi : id_instansi },
	    	success  : function(data)
	    	{
				if(data.status == true)
				{
					// data_opd();

					
						$('#table-skpd-helpdesk').DataTable().ajax.reload(null, false);
						$('#table-helpdesk-opd').DataTable().ajax.reload(null, false);
				}
			}
		});
	}
</script>
