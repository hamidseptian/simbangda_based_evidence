<form action="<?php echo base_url('kuisioner/simpan_identitas_responden') ?>" method="post">
	
	<div class="row">
	    <div class="col-md-12 col-lg-12">
	        <div class="main-card mb-3 card">
	            <div class="card-header">
	               Identitas Responden
	                			<input type="hidden" class="form-control" name="id_kuisioner" value="<?php echo $id_kuisioner ?>">
	            </div>
	            <div class="card-body">
	                <div class="row">
	                	<div class="col-md-4">
	                		<div class="form-group">
	                			<label>Nama</label>
	                			<input type="text" class="form-control" name="nama">
	                		</div>
	                		<div class="form-group">
	                			<label>Jenis Kelamin</label>
	                			<select class="form-control" name="jk">
	                				<option>Laki laki</option>
	                				<option>Perempuan</option>
	                			</select>
	                		</div>
	                		<div class="form-group">
	                			<label>No HP</label>
	                			<input type="text" class="form-control" name="nohp">
	                		</div>
	                	</div>
	                	<div class="col-md-4">
	                		<div class="form-group">
	                			<label>Usia</label>
	                			<select class="form-control" name="usia">
	                				<option><25 tahun</option>
	            					<option>25-35 tahun</option>
	            					<option>36-45 tahun</option>
	            					<option>46-55 tahun</option>
	            					<option>>56 tahun</option>
	                			</select>
	                		</div>
	                		<div class="form-group">
	                			<label>Pendidikan</label>
	                			<select class="form-control" name="pendidikan">
	                				<option>SD</option>
	            					<option>SMP</option>
	            					<option>SMA</option>
	            					<option selected>S1</option>
	            					<option>S2</option>
	            					<option>S3</option>
	                			</select>
	                			
	                		</div>
	                	</div>
	                	<div class="col-md-4">
	                		<div class="form-group">
	                			<label>SKPD</label>
	                			<input type="text" class="form-control" name="skpd" value="<?php echo nama_instansi() ?>" readonly>
	                		</div>
	                		<div class="form-group">
	                			<label>Unit Kerja</label>
	                			<input type="text" class="form-control" name="unit_kerja">
	                		</div>
	                		<div class="form-group">
	                			<label>Email</label>
	                			<input type="text" class="form-control" name="email">
	                		</div>
	                		<!-- <div class="form-group">
	                			<label>Status Kepegawaian</label>
	                			<input type="text" class="form-control" name="">
	                		</div> -->

	                		<div class="form-group">
	                		</div>
	                		
	                	</div>
	                	<div class="col-md-12">
	                		<?php 
	                		if (validation_errors()){ ?>
	                		<div class="alert alert-danger"><?php echo validation_errors(); ?></div>
	                		<?php } ?>
	                			<button class="btn btn-block btn-info">Isi Kuisioner</button>
	                		
	                	</div>
	                </div>
	            </div>
	        </div>
	    </div>

	</div>
</form>