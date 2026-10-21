<hr>  
<div class="col-lg-12 col-md-6">
            <!-- <div class="card"> -->

                 <div class="main-card mb-3 card">
                                        <div class="card-header">
   <div role="group" class="btn-group-sm btn-group btn-block">
                                                    <a data-toggle="tab" href="#grafik_realisasi" class="btn-shadow  btn btn-primary">Grafik Realisasi Belanja</a>
                                                    <a data-toggle="tab" href="#Infografisss" class="btn-shadow active btn btn-primary">Infografis</a>
                                                </div>

                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane" id="grafik_realisasi" role="tabpanel">
                                                
                                                        <?php $this->load->view('beranda/grafik') ?>   
                                                </div>
                                                <div class="tab-pane active" id="Infografisss" role="tabpanel">

                                                    <iframe 
    id="iframeInfografis"
    src="<?php echo base_url('beranda/show_infografis') ?>"
    width="100%"
    style="border:0; display:block;"
    scrolling="no">
</iframe>

<script>
const iframe = document.getElementById('iframeInfografis');

function resizeIframe() {
    const doc = iframe.contentWindow.document;

    iframe.style.height = doc.documentElement.scrollHeight + 'px';
}

iframe.addEventListener('load', function () {
    resizeIframe();

    // Cek kembali setelah konten selesai dirender
    setTimeout(resizeIframe, 300);
    setTimeout(resizeIframe, 1000);
});
</script>


                                                        
                                                </div>
                                             
                                            </div>
                                        </div>
                                        <div class="d-block text-right card-footer">
                                            <a href="javascript:void(0);" class="btn-wide btn btn-success">Save</a>
                                        </div>
                                    </div>
            <!-- </div> -->
        </div>

