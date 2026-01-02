<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/
?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <?php echo $this->session->flashdata('pesan'); ?>
        <div class="main-card mb-3 card">
            <div class="card-body">
               
                <table class="display" border="1" style="border-collapse:collapse; width:100%">
                    <thead>
                        <tr>
                            <th style="width:1%">No</th>
                            <th>TAHUN</th>
                            <th>KODE URUSAN</th>
                            <th>NAMA URUSAN</th>
                            <th>KODE SKPD</th>
                            <th>NAMA SKPD</th>
                            <th>KODE SUB UNIT</th>
                            <th>NAMA SUB UNIT</th>
                            <th>KODE BIDANG URUSAN</th>
                            <th>NAMA BIDANG URUSAN</th>
                            <th>KODE PROGRAM</th>
                            <th>NAMA PROGRAM</th>
                            <th>KODE KEGIATAN</th>
                            <th>NAMA KEGIATAN</th>
                            <th>KODE SUB KEGIATAN</th>
                            <th>NAMA SUB KEGIATAN</th>
                            <th>KODE SUMBER DANA</th>
                            <th>NAMA SUMBER DANA</th>
                            <th>PAGU</th>
                            <th>PAGU VALIDASI</th>
                            <th>RINCIAN</th>
                            <th>LABEL SUB KEGIATAN</th>

							
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($query as $k => $v) { ?>
                            <tr>
                                <td><?php echo $k+1 ?></td>
                                <!-- <td><?php echo $v['no'] ?></td> -->
                                <td><?php echo $v['tahun'] ?></td>
                                <td><?php echo $v['kode_urusan'] ?></td>
                                <td><?php echo $v['nama_urusan'] ?></td>
                                <td><?php echo $v['kode_skpd'] ?></td>
                                <td><?php echo $v['nama_skpd'] ?></td>
                                <td><?php echo $v['kode_sub_unit'] ?></td>
                                <td><?php echo $v['nama_sub_unit'] ?></td>
                                <td><?php echo $v['kode_bidang_urusan'] ?></td>
                                <td><?php echo $v['nama_bidang_urusan'] ?></td>
                                <td><?php echo $v['kode_program'] ?></td>
                                <td><?php echo $v['nama_program'] ?></td>
                                <td><?php echo $v['kode_kegiatan'] ?></td>
                                <td><?php echo $v['nama_kegiatan'] ?></td>
                                <td><?php echo $v['kode_sub_kegiatan'] ?></td>
                                <td><?php echo $v['nama_sub_kegiatan'] ?></td>
                                <td><?php echo $v['kode_sumber_dana'] ?></td>
                                <td><?php echo $v['nama_sumber_dana'] ?></td>
                                <td><?php echo $v['pagu'] ?></td>
                                <td><?php echo $v['pagu_validasi'] ?></td>
                                <td><?php echo $v['rincian'] ?></td>
                                <td><?php echo $v['label_sub_kegiatan'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
