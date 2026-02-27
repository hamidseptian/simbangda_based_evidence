<form action="<?php echo base_url('kuisioner/simpan_kuisioner') ?>" method="post">
<?php $responden = $this->session->userdata('responden'); ?>	
	<div class="row">
	    <div class="col-md-4 col-lg-4">
	        <div class="main-card mb-3 card">
	            <div class="card-header">
	               Identitas Responden
	                			<input type="hidden" class="form-control" name="id_kuisioner" value="<?php echo $id_kuisioner ?>">
	            </div>
	            <div class="card-body">
	            	<table class="table">
	            		<tr>
	            			<td>Nama</td>
	            			<td>:</td>
	            			<td><?php echo $responden['nama'] ?></td>
	            		</tr>
	            		<tr>
	            			<td>Jenis kelamin</td>
	            			<td>:</td>
	            			<td><?php echo $responden['jk'] ?></td>
	            		</tr>
	            		<tr>
	            			<td>No HP</td>
	            			<td>:</td>
	            			<td><?php echo $responden['nohp'] ?></td>
	            		</tr>
	            	
	            		<tr>
	            			<td>Unit Kerja yang dinilai</td>
	            			<td>:</td>
	            			<td><?php echo $responden['unit_kerja'] ?></td>
	            		</tr>
	            		<tr>
	            			<td>Tokens</td>
	            			<td>:</td>
	            			<td><?php echo $responden['token'] ?></td>
	            		</tr>
	            	</table>
	            </div>
	        </div>
	    </div>
	    <div class="col-md-8 col-lg-8">
	        <div class="main-card mb-3 card">
	            <div class="card-header">
	               Kuisioner Survey
	                			<input type="hidden" class="form-control" name="id_kuisioner" value="<?php echo $id_kuisioner ?>">
	            </div>
	            <div class="card-body" style="max-height:700px; overflow-y: scroll">


	            	<?php foreach ($pertanyaan as $k => $v) {  ?>
	            			<div class="card-shadow-info border mb-3 card card-body border-info"   style="text-transform: capitalize;">
	            		<?php 
		            		$tanda_required = $v['required'] ==1 ? '*)' : '';
	            		 ?>
		            		<h5 class="card-title"  style="text-transform: capitalize;"><?php echo ($k+1).'. '.$v['pertanyaan'].' '.$tanda_required ?></h5> <br>
		            		<div class="card-body">
	            					<?php 
	            		$id_kuisioner_pertanyaan = $v['id_kuisioner_pertanyaan'];
	            		$required = $v['required'] ==1 ? 'required' : '';
	            		if ($v['bentuk_jawaban']=='radio') {
	            			$pilihan = $this->db->query("SELECT * from kuisioner_pilihan_jawaban_objektif where id_kuisioner_pertanyaan = '$id_kuisioner_pertanyaan'")->result_array();
	            			foreach ($pilihan as $k_j => $v_j) { ?>
	            				<input type="radio" name="jawaban_<?php echo $id_kuisioner_pertanyaan ?>" value="<?php echo $v_j['value'].'|'.$v_j['caption'] ?>" <?php echo $required ?>> <?php echo $v_j['caption'] ?> <br>
	            			<?php }
	            		}else if ($v['bentuk_jawaban']=='text') { ?>
	            			
	            			<input type="" class="form-control" name="jawaban_<?php echo $id_kuisioner_pertanyaan ?>" <?php echo $required ?>>
	            		<?php }else{ ?>
	            			<textarea class="form-control" name="jawaban_<?php echo $id_kuisioner_pertanyaan ?>" <?php echo $required ?>></textarea>
	            		<?php }
	            		?>
		            			
		            		</div>

	            		<?php 
	            		$id_kuisioner_pertanyaan = $v['id_kuisioner_pertanyaan'];
	            		if ($v['bentuk_jawaban']=='radio') {
	            			$pilihan = $this->db->query("SELECT * from kuisioner_pilihan_jawaban_objektif where id_kuisioner_pertanyaan = '$id_kuisioner_pertanyaan'")->result_array();
	            			foreach ($pilihan as $k_j => $v_j) { ?>
	            				<!-- <input type="radio" name="" value="<?php echo $v_j['value'] ?>"> <?php echo $v_j['caption'] ?> -->
	            			<?php }
	            		}else{

	            		}
	            		?>


		            	</div>




		    <?php } ?>
		    
		    <button class="btn btn-block btn-info">Submit Kuisioner</button>




	            </div>
	        
	        </div>
	     
	    </div>

	</div>
</form>