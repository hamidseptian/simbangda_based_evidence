




<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
		
<div style=" max-height:700px; width:100%;	overflow: scroll">
	<div class="app-inner-layout">
		<div class="app-inner-layout__header bg-heavy-rain">
                            <div class="app-page-title">
                                <div class="page-title-wrapper">
                                    <div class="page-title-heading">
                                    	 <div class="widget-content-left">
                                                    <div class="widget-heading text-dark opacity-7">
														<h6 class="menu-header-subtitle" id="nama_skpd">Data APBD pada aplikasi IKD</h6>
														<h5 class="menu-header-title" id="nama_helpdesk"><?php echo $nama_instansi ?></h5>
                                                    </div>
                                                    <div class="widget-subheading opacity-10">
                                                            <b>
                                                               Tahun : <?php echo $tahun ?> <br>                                                 
                                                            </b>
                                                    </div>
                                                </div>
                                    </div>
                                    </div>
                            </div>                
                        </div>
                    </div>


<div class="row">
	
                                <div class="col-md-12">
                                    <div class="mb-3 card">
                                        <div class="tabs-lg-alternate card-header">
                                            <ul class="nav nav-justified">
                                                <li class="nav-item">
                                                    <a data-toggle="tab" href="#tab-eg9-0" class="active nav-link">
                                                        <div class="widget-number">Sub kegiatan Instansi & Anggaran</div>
                                                        <div class="tab-subheading">
                                                            
                                                            Menampilkan Sub Kegiatan yang ada pada SKPD beserta Pagu Per Sub Kegiatan
                                                        </div>
                                                    </a></li>
                                                <li class="nav-item">
                                                    <a data-toggle="tab" href="#tab-eg9-1" class="nav-link">
                                                        <div class="widget-number">Target APBD</div>
                                                        <div class="tab-subheading">Menampilkan Target Per Sub Kegiatan</div>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a data-toggle="tab" href="#tab-eg9-2" class="nav-link">
                                                        <div class="widget-number text-danger">Realisasi Keuangan</div>
                                                        <div class="tab-subheading">
                                                            Menampilkan Realisasi Per Bulan
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-eg9-0" role="tabpanel">
                                                <div class="card-body">
                                                	<?php 	$this->load->view('integrasi_aplikasi/ikd/page/ski_ask',) ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane " id="tab-eg9-1" role="tabpanel">
                                                <div class="card-body">

                                                	<?php 	$this->load->view('integrasi_aplikasi/ikd/page/target_apbd',) ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane " id="tab-eg9-2" role="tabpanel">
                                                <div class="card-body">
                                                	<?php 	$this->load->view('integrasi_aplikasi/ikd/page/realisasi_apbd',) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
</div>



</div>


   <script type="text/javascript">
   	function import_ski(){
   		var ski = $('#data_import_ski').val();
   		var ask = $('#data_import_ask').val();

   		
		$.ajax({
			url: baseUrl('integrasi_aplikasi/import_ikd_ski'),
			type: 'POST',
			dataType: 'JSON',
			data: {
				// id_instansi : id_instansi,
				// tahun : tahun,
				// tahap : tahap,
				ask : ask,
				ski : ski,
			}	,
			success: function(data) {
				
				if (data.success==200) {
					window.location.href="<?php echo base_url('integrasi_aplikasi/cek_import_ikd/?id_opd='.sbe_crypt($id_instansi)) ?>"
				}else{
					// alert('error');
				}

			},
			error: function(jqXHR, textStatus, errorThrown) {
				Swal.fire('error','error','error')
				stop_loading();
			}
		});
	

   	}
   	function import_target(){
   		var target = $('#data_import_target').val();

		$.ajax({
			url: baseUrl('integrasi_aplikasi/import_ikd_target'),
			type: 'POST',
			dataType: 'JSON',
			data: {
				// id_instansi : id_instansi,
				// tahun : tahun,
				// tahap : tahap,
				target : target,
			}	,
			success: function(data) {
				
				if (data.success==200) {
					window.location.href="<?php echo base_url('integrasi_aplikasi/cek_import_ikd/?id_opd='.sbe_crypt($id_instansi)) ?>";
				}else{
					// alert('error');
				}

			},
			error: function(jqXHR, textStatus, errorThrown) {
				Swal.fire('error','error','error')
				stop_loading();
			}
		});
	

   	}


    function import_realisasi_keuangan(){
        var realisasi = $('#data_import_realisasi').val();

        $.ajax({
            url: baseUrl('integrasi_aplikasi/import_ikd_realisasi'),
            type: 'POST',
            dataType: 'JSON',
            data: {
                // id_instansi : id_instansi,
                // tahun : tahun,
                // tahap : tahap,
                realisasi : realisasi,
            }   ,
            success: function(data) {
                
                if (data.success==200) {
                    window.location.href="<?php echo base_url('integrasi_aplikasi/cek_import_ikd/?id_opd='.sbe_crypt($id_instansi)) ?>";
                }else{
                    // alert('error');
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire('error','error','error')
                stop_loading();
            }
        });
    

    }


$(document).ready( function () {
    $('#data_sipedal').DataTable();
    $('.datatabel').DataTable();
});


   </script>

   