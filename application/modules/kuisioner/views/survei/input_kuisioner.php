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
	            	<h5 class="card-title text-center"  style="text-transform: capitalize;" id="pertanyaan"></h5> 
	            	<div class="card-body">
	            		<div  id="option" class="btn-group btn-block"></div>
	            		<div  id="page" class="btn-group btn-block"></div>
	            	</div>




	            </div>
	        
	        </div>
	     
	    </div>

	</div>
</form>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script type="">
	pertanyaan(3);
	function pertanyaan(id){


		$.ajax({
			url:'<?php echo 	base_url() ?>kuisioner/api_option_pertanyaan',
			type : "POST",
			dataType: 'JSON',
			data : {
				token : '<?php echo $responden['token'] ?>',
				id: id
			},
			success : function(data){
				console.log(data.data.unsur_detail);
				$('#pertanyaan').html(data.data.nama);
				$('#option').html('');
				$.each(data.data.unsur_detail, function(k,v){
					$('#option').append(`<button type="button" onclick="simpan_jawaban('`+v.unsur_id+`','`+v.nilai+`')" class="btn btn-outline-info btn-xl" >`+v.jawaban+` </button>`);
				})
				$('#option').html(`<button type="button" onclick="simpan_jawaban('`+v.unsur_id+`','`+v.nilai+`')" class="btn btn-outline-info btn-xl" >`+v.jawaban+` </button><button type="button" onclick="simpan_jawaban('`+v.unsur_id+`','`+v.nilai+`')" class="btn btn-outline-info btn-xl" >`+v.jawaban+` </button>`);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log('error');
			}
		 });
	}

	function simpan_jawaban(id_pertanyaan, nilai_jawaban){
		var next = parseInt(id_pertanyaan) +1 ; 
		if (next==10) {
			alert('habis');

		}else{
			pertanyaan(next);

		}
	}
</script>