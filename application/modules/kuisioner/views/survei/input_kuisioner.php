<form action="<?php echo base_url('kuisioner/simpan_kuisioner') ?>" method="post">
<?php $responden = $this->session->userdata('responden');
$jk = ['L'=>"Laki laki" ,'P' =>'Perempuan'];
 ?>	

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
	            			<td><?php echo @$jk[$responden['jk']] ?></td>
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
	            	 <center>	<span id="caption_header"></span></center>
	            	<div class="card-body">
	            		<div  id="option"></div>
	            		<div  id="page" class="btn-group btn-block"></div>
	            	</div>




	            </div>
	        
	        </div>
	     
	    </div>

	</div>
</form>


    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script type="">
	pertanyaan(1);
	function pertanyaan(id){

				$('#option').attr('class','btn-group btn-block');
				$('#caption_header').html('Silahkan pilih salah satu jawaban di bawah ini');


		$.ajax({
			url:'<?php echo 	base_url() ?>kuisioner/api_option_pertanyaan',
			type : "POST",
			dataType: 'JSON',
			data : {
				token : '<?php echo $responden['token'] ?>',
				id: id
			},
			success : function(data){
				$('#pertanyaan').html(data.data.id + '. '+data.data.nama);
				$('#option').html('');
				$.each(data.data.unsur_detail, function(k,v){
					$('#option').append(`<button type="button" onclick="simpan_jawaban('`+v.unsur_id+`','`+v.nilai+`')" class="btn btn-outline-info btn-xl" > <img src="https://sepakat.sumbarprov.go.id/`+v.emoji+`" height="100px" alt="Logo" class="img-fluid"><br><b>`+v.jawaban+`</b></button>`);
				});

				var next = id+1 ;
				var prev = id-1 ;

				if (id==1) {
				$('#page').html(``);

				}else{
				$('#page').html(`<button type="button" onclick="next_prev(`+prev+`)" class="btn btn-outline-info btn-xl"><i class="fa fa-arrow-left"></i> Sebelumnya</button>`);

				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
			}
		 });
	}

	function simpan_jawaban(id_pertanyaan, nilai_jawaban){


		$.ajax({
			url:'<?php echo base_url() ?>kuisioner/api_simpan_jawaban',
			type : "POST",
			dataType: 'JSON',
			data : {
				token : '<?php echo $responden['token'] ?>',
				id: id_pertanyaan,
				nilai_jawaban: nilai_jawaban
			},
			success : function(data){
				// alert(data.message);

			},
			error: function (jqXHR, textStatus, errorThrown) {
			}
		 });


		var next = parseInt(id_pertanyaan) +1 ; 
		if (next==10) {

			
			aspirasi(next);

		}else{
			pertanyaan(next);

		}
	}
	function next_prev(id){
		pertanyaan(id);
	}

	function aspirasi(next){

				$('#caption_header').html('Silahkan isi aspirasi dan saran anda pada kolom komentar di bawah ini :');
		var prev = next-1;
				$('#option').attr('class','');
		var form_saran = `<br><textarea class="form-control" name="aspirasi" id="aspirasi" rows="10"></textarea><br>`;
				$('#pertanyaan').html('Aspirasi dan Saran');
				$('#option').html(form_saran);
					$('#page').html(`<button type="button" onclick="next_prev(`+prev+`)" class="btn btn-outline-info btn-xl"><i class="fa fa-arrow-left"></i> Sebelumnya</button> 
						<button type="button" class="btn btn-outline-info btn-xl" onclick="simpan_aspirasi()">Kirim</button>`);
	}
	function simpan_aspirasi(id_pertanyaan, nilai_jawaban){

		var aspirasi = $('#aspirasi').val();
		$.ajax({
			url:'<?php echo base_url() ?>kuisioner/api_kirim_aspirasi',
			type : "POST",
			dataType: 'JSON',
			data : {
				token : '<?php echo $responden['token'] ?>',
				aspirasi: aspirasi,
			},
			success : function(data){
				if (data.status==true) {
					simpan_pengisian_kuisioner();
				}else{
					Swal.fire('Gagal',data.message + "<br>Ada pertanyaan yang terlewatkan <br>Silahkan lakukan reload dan ulang lagi pengisian kuisioner",'error');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
			}
		 });


	}
	function simpan_pengisian_kuisioner(){

		$.ajax({
			url:'<?php echo base_url() ?>kuisioner/simpan_pengisian_kuisioner',
			type : "POST",
			dataType: 'JSON',
			data : {
				id_kuisioner : '<?php echo $responden['id_kuisioner']; ?>',
			},
			success : function(data){
				window.location.href = "<?php echo base_url() ?>kuisioner/selesai_pengisian/" + data.id_kuisioner;
			},
			error: function (jqXHR, textStatus, errorThrown) {
			}
		 });


	}
</script>