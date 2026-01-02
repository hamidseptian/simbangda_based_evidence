<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/
	// echo $controller;
?>

<!-- Datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<!-- Leaflet -->

<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="<?php echo base_url(); ?>assets/leaflet/leaflet.js"></script>
<script type="text/javascript">
</script>
<script>
	let status_show_kegiatan 		= 'collapse';
	let status_show_kegiatan_all 		= 'collapse';
	
	$(document).ready(function()
	{
    $('#tesss').html('32');
		select2();
	  


	});
	function select2()
	{
		$('#tahun').select2(
		{
			placeholder : "Pilih Tahun Anggaran",
			allowClear	: false,
			width 		: 'style',
			theme 		: 'bootstrap4'
		});
		$('#tahap').select2(
		{
			placeholder : "Pilih Tahapan APBD",
			allowClear	: false,
			width 		: 'style',
			theme 		: 'bootstrap4'
		});


		// $('#tahun').select2({
		// 	placeholder: "Pilih Tahun Anggaran",
		// 	allowClear: false,
		// 	width: 'style',
		// 	theme: 'bootstrap4'
		// });
		// $('#tahap').select2({
		// 	placeholder: "Pilih Tahapan APBD",
		// 	allowClear: false,
		// 	width: 'style',
		// 	theme: 'bootstrap4'
		// });
		$('#kategori').select2({
			placeholder: "Pilih Kategori",
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
		


	}
</script>

<!-- jd bagian integrasi -->

<script>
 function show_laporan() {
    var bulan = $('#bulan').val();
    var tahun = $('#tahun').val();
    var tahap = $('#tahap').val();
    var kategori = $('#kategori').val();
    var perhitungan = $('#perhitungan').val();
    



   if (tahun=='') {
      Swal.fire('Error','Harap Pilih Tahun Anggaran','error');
      return false;
    }
    else if (tahap=='') {
      Swal.fire('Error','Harap Pilih Tahapan APBD','error');
      return false;
    }
    else if (bulan=='') {
      Swal.fire('Error','Harap Pilih Bulan','error');
      return false;
    }
    else if (kategori=='') {
      Swal.fire('Error','Harap Pilih Bulan','error');
      return false;
    }
  
    else{
      
		$.ajax(
        {
            url     : baseUrl('integrated/api/replikasi_sbe/get_data/'),
            // dataType: 'JSON',
            type    : 'POST',
            data    : { 
            	tahun : tahun,
            	tahap : tahap ,
            	bulan : bulan ,
            	kategori : kategori ,

            	action : 'show' 
            },
            success : function(data)
            {

            	$('#hasil_penarikan_data').html(data);



            },
            error : function(){
            	console.log('3');

            }
        });

      // $('#tampil_pdf').show();
      // $('#tampil_pdf').attr('src', baseUrl('laporan/pdf_laporan_rekap_asisten?bulan=') + bulan + '&tahun=' + tahun + '&tahap=' +tahap + '&kategori=' +kategori + '&perhitungan=' +perhitungan + '#view=FitH');
    }

  }



 function import_data_replikasi() {
    var bulan = $('#bulan').val();
    var tahun = $('#tahun').val();
    var tahap = $('#tahap').val();
    var kategori = $('#kategori').val();
    var perhitungan = $('#perhitungan').val();
    
    start_loading("Mengimport Data");

		$.ajax(
        {
            url     : baseUrl('integrated/api/replikasi_sbe/get_data/'),
            // dataType: 'JSON',
            type    : 'POST',
            data    : { 
            	tahun : tahun,
            	tahap : tahap ,
            	bulan : bulan ,
            	kategori : kategori ,
            	action : 'import' 
            },
            success : function(data)
            {

            	stop_loading();
            	console.log(data);



            },
            error : function(){
            	console.log('3');

            }
        });

      // $('#tampil_pdf').show();
      // $('#tampil_pdf').attr('src', baseUrl('laporan/pdf_laporan_rekap_asisten?bulan=') + bulan + '&tahun=' + tahun + '&tahap=' +tahap + '&kategori=' +kategori + '&perhitungan=' +perhitungan + '#view=FitH');
    

  }



	function warning_import_data_replikasi_all() {
		
    Swal.fire({
        title: 'Warning',
        text: 'Data yang di importkan akan menimpa data yang sudah ada sebelumnya. Lanjutkan .?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
        import_data_replikasi_all();
        }
      }); 
	}





  function import_data_replikasi_all() {
    $('.import_replikasi').trigger('click');
    Swal.fire('Info','Selanjutnya buat untuk import replikasi berdasarkan referensi synchronize_all')
    $('#div_import_all').html(`

               <div style="text-align: center;"><b>Import data replikasi ke Simbangda Provinsi</b></div>
          <div class="progress" style="margin-top:6px">
                      <div class="progress-bar progress-bar-animated bg-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                          <img src="<?php echo base_url() ?>assets/sbe/image/loading_line.gif" width="100%">
                      </div>
                </div>`);
    // $('#import_all').html("Loading....").attr('disabled', true);
  }







 function tes_import_data_replikasi(id_instansi, id_instansi_api, tahap, tahun, bulan) {


    $('#opd_terintegrasi_' + id_instansi).html('<i class="fa fa-cog fa-w-3 fa-spin"></i>').attr('disabled', true);

    $('#cek_status_progress_' + id_instansi).html('<span class="badge badge-info">Loading</span>');
    var banyak_instansi = $('.import_replikasi').length; 
   $.ajax({
        url: baseUrl('integrated/api/replikasi_sbe/import_data/'+id_instansi_api),
        type: 'POST',
        dataType: 'JSON',
        data: {
          id_instansi : id_instansi,
          tahap : tahap,
          tahun : tahun,
          bulan : bulan,
        },
        success: function(data) {
          if (data.status == true) {
            $('#opd_terintegrasi_' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
            $('#opd_terintegrasi_' + id_instansi).find('i').attr('class', 'ion ion-checkmark');
            var selesai = $('.selesai_sinkron').length; 
            $('#jumlah_selesai_synchronize').html(selesai+" OPD");
            if (selesai==banyak_instansi) {
                $('#div_import_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
              // $('#tombol_sync_all').html("Selesai Sinkronisasi").attr('class', 'btn btn-success btn-sm');
            }
            $('#cek_status_progress_' + id_instansi).html('<span class="badge badge-success">Import Selesai</span>');
          }
        },
        error : function(){

          // $('#tahap-2'+ '-' + id_instansi).attr('class', 'btn btn-sm btn-success selesai_sinkron');
          // $('#tahap-2'+ '-' + id_instansi).find('i').attr('class', 'ion ion-checkmark');
          // var selesai = $('.selesai_sinkron').length; 
          // $('#jumlah_selesai_synchronize').html(selesai+" OPD");
          // if (selesai==banyak_instansi) {
          //     $('#synchronize_all').html(`<div style="text-align: center;" class='alert alert-success'><b>Sinkronisasi Selesai</b></div>`);
          //   }
          //   $('#cek_status_progress_' + id_instansi).html('<span class="badge badge-danger">Synchronize Error</span>');

          
        }
      });
		// $('#opd_terintegrasi_'+ id_instansi).html('<i class="fa fa-cog fa-w-3 fa-spin"></i>').attr('disabled', true);
    console.log(tahap);

  }

 function detail_replikasi_opd(id_instansi,nama_instansi, id_instansi_api, tahap, tahun, bulan) {

  $('#modal_detail_rfk_replikasi').modal('show');
  $.ajax(
        {
            url     : baseUrl('integrated/api/replikasi_sbe/get_data_per_opd/'),
            dataType: 'JSON',
            type    : 'POST',
            data    : { 
              tahun : tahun,
              id_instansi_api : id_instansi_api ,
              id_instansi : id_instansi ,
              tahap : tahap ,
              bulan : bulan ,
              // kategori : kategori ,
              // action : 'import' 
            },
            success : function(data)
            {

              // stop_loading();
              // console.log(data);
              console.log(data.data.opd);

              $('#modal_detail_rfk_replikasi').find('.skpd').html(nama_instansi);
              $('#modal_detail_rfk_replikasi').find('.skpd_replikasi').html(data.data.opd.nama_instansi);
              $('#modal_detail_rfk_replikasi').find('.tahapan_apbd').html(data.tahap);
              $('#modal_detail_rfk_replikasi').find('.pagu_tahapan_apbd').html(data.data.opd.pagu_total);



            },
            error : function(){
              console.log('3');

            }
        });
  }
</script>
