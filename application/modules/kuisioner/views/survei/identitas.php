<?php echo $this->session->flashdata('pesan'); ?>
<hr><form action="<?php echo base_url('kuisioner/simpan_identitas_responden') ?>" method="post">
	
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
	                				<option value="L">Laki laki</option>
	                				<option value="P">Perempuan</option>
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
	                				<option value="Pilih Usia"></option>
	                				<?php foreach ($select['usia'] as $k => $v) { ?>
	                				<option value="<?php echo $v->id ?>"><?php echo $v->rentang ?></option>
	                				<?php } ?>
	            					
	                			</select>
	                		</div>
	                		<div class="form-group">
	                			<label>Email</label>
	                			<input type="text" class="form-control" name="email">
	                		</div>
	                		<div class="form-group">
	                			<label>Pendidikan</label>
	                			<select class="form-control" name="pendidikan">
	                				<?php foreach ($select['pendidikan'] as $k => $v) { ?>
	                				<option value="<?php echo $v->id ?>"><?php echo $v->nama ?></option>
	                				<?php } ?>
	            				
	                			</select>
	                			
	                		</div>
	                	</div>
	                	<div class="col-md-4">
	                		<div class="form-group">
	                			<label>pekerjaan</label>
	                			<select class="form-control" name="pekerjaan">
	                				<?php foreach ($select['pekerjaan'] as $k => $v) { ?>
	                				<option value="<?php echo $v->id ?>"><?php echo $v->nama ?></option>
	                				<?php } ?>
	            				
	                			</select>
	                			
	                		</div>
	                		<div class="form-group">
	                			<label>Unit Kerja yang dinilai</label>
	                			<select class="form-control" name="unit_kerja">
	                				<option value="<?php echo $select['unit_kerja'][5]->id ?>"><?php echo $select['unit_kerja'][5]->nama ?></option>
	                			
	                			</select>
	                		</div>

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