<?php 
$nama_tahap = [
	2=>'APBD AWAL',4=>'APBD PERUBAHAN'
];
$data_ditampilkan = [
	'ski_ask'=>'Sub Kegiatn Instansi dan Pagu Sub Kegiatan'
];
 ?>

<div class="mb-3 card" style="display:block">
	<div class="card-body">
		<div class="row">
			<form>	
			</form>
			<div class="col-md-3	">
				<div class="form-group">
					<label for="id_opd"><strong>OPD</strong></label>
					<select name="id_opd" id="id_opd" class="form-control" >
						<?php if ($this->session->userdata('id_group')==5) { ?>
						<?php } ?>
						<?php foreach ($opd->result() as $key => $value) : ?>
							<option value="<?= sbe_crypt($value->integrasi_ikd_id_instansi, 'E'); ?>"><?= $value->nama_instansi; ?></option>
						<?php endforeach; ?>
							<!-- <option value="semua_opd">Semua OPD</option> -->
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="tahun"><strong>Tahun Anggaran</strong></label>
					<select name="tahun" id="tahun" class="form-control" >
						<option>2025</option>
					
					</select>
				</div> 
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="tahun"><strong>Tahun Anggaran</strong></label>
					<select name="kode_tahap" id="kode_tahap" class="form-control" >
						<option value="2">APBD AWAL</option>
						
					</select>
				</div> 
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="tahun"><strong>Ambil data realisasi Bulan</strong></label>
					<select name="bulan" id="bulan" class="form-control" >
						<?php foreach (pilihan_bulan() as $k => $v): ?>
							<option value="<?php echo $k ?>"><?php echo $v ?></option>
						<?php endforeach ?>
						
					</select>
				</div> 
			</div>
			<!-- f -->
		
			<div class="col-md-12">
				<div class="form-group">
					<button class="btn btn-info btn-block" onclick="get_data_integrasi_ikd()" type="button" id="searching_button">Searching</button>
				</div>
			</div>
		</div>

		<div class="row">

			<div class="col-md-12" style="border: solid; border-width: 1px">
				<div id="show_data_sipd">
					
				</div>
				
			</div>
			
		
		</div>
	</div>
</div>


<script src="<?php echo base_url('assets/architectui-html-pro/') ?>assets/js/vendors/blockui.js"></script>
<script src="<?php echo base_url('assets/architectui-html-pro/') ?>assets/js/scripts-init/blockui.js"></script>