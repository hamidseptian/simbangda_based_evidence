<?php 
$nama_tahap = [
	2=>'APBD AWAL',4=>'APBD PERUBAHAN'
];
 ?>

<div class="mb-3 card">
	<div class="card-body">
		<div class="row">

			<div class="col-md-4">
				<div class="form-group">
					<label for="id_opd"><strong>OPD</strong></label>
					<select name="id_opd" id="id_opd" class="form-control" >
						<?php if ($this->session->userdata('group_name') == "ADMIN" or $this->session->userdata('group_name') == "SUPER ADMIN") : ?>
						<?php endif; ?>
						<?php foreach ($instansi as $key => $value) : ?>
							<option value="<?= sbe_crypt($value['id_instansi'], 'E'); ?>"><?= $value['nama_instansi']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="tahun"><strong>Periode</strong></label>
					<select name="periode" id="periode" class="form-control" >
						<?php foreach ($ba as $k => $v) { ?>
							<option value="<?php echo $v['id_setting_berita_acara'] ?>" <?php if($v['kegiatan']==tahun_anggaran()){echo "selected";} ?>><?php echo $v['kegiatan'].' | '.$v['lokasi'].' tanggal '.$v['tgl_mulai_pelaksanaan'].' s.d. '.$v['tgl_akhir_pelaksanaan'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			
			<div class="col-md-4">
				<div class="form-group">
					<label for="tahun"><strong>Pengambilan Data</strong></label>
					<select name="pengambilan" id="pengambilan" class="form-control" >
						<option>Dengan Catatan</option>
						<option>Tanpa Catatan</option>
					</select>
				</div>
			</div>
			
			<div class="col-md-12">
				<div class="btn-group btn-block" id="tombol_action">
                       <button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" onclick="show_laporan()"><i class="fa fa-search"> </i>  Tampilkan Laporan (PDF)</button>
                       <button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" onclick="cek_synchronize()"><i class="fa fa-search"> </i>  Synchronize</button>

                                </div> <br><br>		



			</div>


		
		</div>
		<div class="row">
			<div id="loading"  style="display: none;">
				
				<div class="font-icon-wrapper float-left mr-3 mb-3">
				    <div class="loader-wrapper d-flex justify-content-center align-items-center">
				        <div class="loader">
				            <div class="ball-rotate">
				                <div></div>
				            </div>
				        </div>
				    </div>
				 
				</div>
			</div>
			<iframe id="tampil_pdf" style="display: none;" src="" width="100%" height="768px"></iframe>
		</div>
	</div>
</div>