<?php
$nama_tahap = [
    2=>'APBD AWAL',4=>'APBD PERUBAHAN'
];
?>
<div class="mb-3 card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-2">
                <div class="form-group">
                    <label for="tahun"><strong>Tahun Anggaran</strong></label>
                    <select name="tahun" id="tahun" class="form-control">
                        <?php foreach ($config as $k => $v) { ?>
                            <option value="<?php echo $v['tahun_anggaran'] ?>" <?php if($v['tahun_anggaran']==tahun_anggaran()){echo "selected";} ?>><?php echo $v['tahun_anggaran'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tahap"><strong>Tahapan APBD</strong></label>
                    <select name="tahap" id="tahap" class="form-control">
                        <?php foreach ($nama_tahap as $k_t => $v) { ?>
                            <option value="<?php echo $k_t ?>" <?php if($k_t==tahapan_apbd()){echo "selected";} ?>><?php echo $v ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tahap"><strong>Kategori</strong></label>
                    <select name="kategori" id="kategori" class="form-control" >
                      <option></option>
                      <option value="Akumulasi" selected>Akumulasi</option>
                      <option value="Bulanan">Per Bulan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="tahap"><strong>Periode Data</strong></label>
                    <select name="data" id="data" class="form-control" >
                      <option></option>
                      <!-- <option value="Pertahun" selected>Pertahun</option> -->
                      <option value="Semester 1" selected>Semester 1</option>
                      <option value="Semester 2">Semester 2</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tahap"><strong>OPD Yang Ditampilkan</strong></label>
                    <select name="asisten" id="asisten" class="form-control" >
                    
                      <option value="semua" selected>Semua OPD</option>
                      <option value="1">Asisten 1</option>
                      <option value="2">Asisten 2</option>
                      <option value="3">Asisten 3</option>
                      <option value="inspektorat">Inspektorat 3</option>
                    </select>
                </div>
            </div>
      <div class="col-md-12">
        <div class="form-group">
          <button class="btn btn-info btn-block" onclick="show_laporan()">Searching</button>
        </div>
      </div>
    </div>
    <div class="row">
      <iframe id="tampil_pdf" style="display: none;" src="" width="100%" height="768px"></iframe>
    </div>
  </div>
</div>