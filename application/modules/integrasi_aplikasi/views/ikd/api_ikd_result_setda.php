<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
		
<div style=" max-height:700px;	overflow-x: scroll">
	<div class="app-inner-layout">
		<div class="app-inner-layout__header bg-heavy-rain">
                            <div class="app-page-title">
                                <div class="page-title-wrapper">
                                    <div class="page-title-heading">
                                    	 <div class="widget-content-left">
                                                    <div class="widget-heading text-dark opacity-7">
														<h6 class="menu-header-subtitle" id="nama_skpd">Data paket pada aplikasi IKD</h6>
														<h5 class="menu-header-title" id="nama_helpdesk">Sekretariat Daerah</h5>
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
	<div class="alert alert-info">
		Mohon maaf, untuk OPD lingkup Sekretariat daerah belum dapat di integrasikan <br>
		Silahkan melakukan penginputan manual pada menu Data APBD

	</div>
</div>


   <script type="text/javascript">
   	
$(document).ready( function () {
    $('#data_sipedal').DataTable();
} );
   </script>

   