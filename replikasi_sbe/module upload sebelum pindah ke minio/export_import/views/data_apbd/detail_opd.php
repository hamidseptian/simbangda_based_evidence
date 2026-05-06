<style type="text/css">
    .font_tbody{
        font-size:9px;
    }
    .font_thead{
        font-size:9px;
    }
</style>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <?php echo $this->session->flashdata('pesan'); ?>
        <div class="main-card mb-3 card">
            <div class="card-body">
               <h5>Data Mentah setelah di upload admin</h5>
                <table class="display" border="1" style="border-collapse:collapse; width:100%">
                    <thead class="font_thead">
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
                            <th>KODE REKENING</th>
                            <th>Nama Rekeing</th>
                            <th>PAGU</th>

							
                        </tr>
                    </thead>
                    <tbody class="font_tbody">
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
                                <td><?php echo $v['kode_rekening'] ?></td>
                                <td><?php echo $v['nama_rekening'] ?></td>
                                <td><?php echo number_format($v['pagu']=='' ? 0 : $v['pagu']) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <a href="<?php echo base_url('export_import/kelola_import/'.sbe_crypt($id_import)) ?>" class="btn btn-info btn-sm btn-block">Lihat Sudah Tersusun</a>
            </div>
        </div>
    </div>
</div>
