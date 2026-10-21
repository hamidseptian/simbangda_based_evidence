<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Realisasi Belanja Fisik & Keuangan — Sumatera Barat</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Felipa&family=Mogra&display=swap" rel="stylesheet">



<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<style>


.felipa-regular {
  font-family: "Felipa", serif;
  font-weight: 400;
  font-style: normal;
}

.mogra-regular {
  font-family: "Mogra", system-ui;
  font-weight: 400;
  font-style: normal;
}

  :root{
    --hijau-tua:#063f42;
    --hijau:#0a6e74;
    --hijau-terang:#14b8c4;
    --emas:#c9962c;
    --emas-terang:#e0b34a;
    --krem:#faf6ec;
    --merah:#c0392b;
    --biru:#0891b2;
    --abu:#8a8f87;

    /* Transparansi background BERSAMA untuk kotak TOP 10 & panel ANALISIS DEVIASI.
       Ubah SATU angka ini saja -> otomatis berubah di keduanya. */
    --bg-transparan-warna:160, 227, 141;   /* warna dasar (format R,G,B) aqua */
    --bg-transparan-opacity:0.35;       /* 0 = sepenuhnya transparan/putih, 1 = solid pekat */
  }
  *{box-sizing:border-box;}
  html, body{
    margin:0;
    /*font-family:'Segoe UI', Roboto, Arial, sans-serif;*/
    
  font-family: "Mogra", system-ui;
    color:#22301f;
    overflow-x:hidden;
    background-color:#063f42;
    background-image:url("<?php echo base_url('assets/infografis/banner.png') ?>");
    background-size:cover;
    background-position:center top;
    background-repeat:no-repeat;
  }
  #scaleWrapper{
    position:relative;
    width:100%;
    overflow:hidden;
  }
  .container{
    width:1200px;
    padding:0 14px 14px 14px;
    position:absolute;
    top:0;
    left:0;
    transform-origin:top left;
  }

  .app-header{margin-bottom:16px;}
  .app-content{display:flex;flex-direction:column;gap:16px;}
  .app-footer{margin-top:16px;}

  .grid{display:grid;gap:16px;}
  .flex{display:flex;}
  .flex-col{display:flex;flex-direction:column;}
  .items-center{align-items:center;}
  .gap-2{gap:8px;}
  .gap-3{gap:12px;}
  .text-center{text-align:center;}
  .mt-auto{margin-top:auto;}
  .w-100{width:100%;}

  .header-band{
    background:linear-gradient(120deg, rgba(6,63,66,0.25) 55%, rgba(10,110,116,0.25) 100%);
    color:#fff;
    border-radius:0 0 18px 18px;
    padding:24px;
    display:flex;
    align-items:center;
    gap:20px;
    flex-wrap:wrap;
  }
  .logo-box{
    width:74px;height:74px;background:#c0392b;border-radius:10px;
    display:flex;align-items:center;justify-content:center;font-size:1.8rem;
    flex-shrink:0;
  }
  .header-band h1{
    font-weight:800;
    font-size:2.1rem;
    letter-spacing:.5px;
    margin:0;
    color:#fff;
  }
  .header-band h1.sub{
    color:var(--emas-terang);
    font-size:2rem;
  }
  .header-tanggal{margin-top:6px;font-size:.95rem;font-weight:600;}
  .header-tag{
    display:inline-block;
    background:rgba(255,255,255,.12);
    border:1px solid rgba(255,255,255,.35);
    padding:4px 14px;
    border-radius:20px;
    font-size:.85rem;
    letter-spacing:.5px;
    margin-top:8px;
  }
  .header-icon{font-size:3rem;margin-left:auto;}

  .stat-strip{
    background:#fff;
    border-radius:16px;
    box-shadow:0 4px 18px rgba(6,63,66,.08);
    border:1px solid #eee2c8;
    padding:18px;
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:16px;
    align-items:center;
  }
  .icon-circle{
    width:56px;height:56px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-size:1.5rem;color:#fff;flex-shrink:0;
  }
  .bg-hijau{background:var(--hijau-terang);}
  .bg-emas{background:var(--emas);}
  .bg-biru{background:var(--biru);}
  .big-number{font-weight:800;font-size:1.9rem;line-height:1;}
  .label-kecil{font-size:.72rem;font-weight:700;letter-spacing:.3px;color:#5a5f55;}
  .mini-badge{
    font-size:.7rem;font-weight:700;border-radius:8px;padding:3px 8px;
    display:block;margin-bottom:5px;text-align:center;
  }
  .mini-badge.hijau{background:#e6f4ea;color:var(--hijau);}
  .mini-badge.merah{background:#fbe9e7;color:var(--merah);}

  .pagu-bar{
    background:#fff;
    border-radius:16px;
    box-shadow:0 4px 18px rgba(6,63,66,.08);
    border:1px solid #eee2c8;
    padding:18px 24px;
    display:flex;
    align-items:center;
    gap:20px;
  }
  .pagu-main{flex:1;}
  .pagu-number{
    font-weight:800;
    font-size:1.7rem;
    color:var(--hijau-tua);
    line-height:1.15;
  }
  .pagu-divider{
    width:1px;
    align-self:stretch;
    background:#e2dcc7;
  }
  .pagu-sub{min-width:170px;}
  .pagu-sub-value{
    font-weight:800;
    font-size:1.15rem;
    color:var(--emas);
  }

  .pagu-bar{position:relative;overflow:hidden;}

  .pagu-bg-uang-1::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:url("<?php echo base_url('assets/sbe/infografis/pagu_1.png') ?>");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    opacity:0.8;
    pointer-events:none;
    z-index:0;
  }

  .pagu-bg-uang-2::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:url("<?php echo base_url('assets/sbe/infografis/pagu_2.png') ?>");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    opacity:0.8;
    pointer-events:none;
    z-index:0;
  }
  .pagu-bar > *{position:relative;z-index:1;}

  .target-card-fisik{position:relative;overflow:hidden;}
  .target-card-fisik::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:url("<?php echo base_url('assets/sbe/infografis/fisik.jpeg') ?>");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    opacity:0.8;
    pointer-events:none;
    z-index:0;
  }
  .target-card-fisik > *{position:relative;z-index:1;}

  .target-card-keuangan{position:relative;overflow:hidden;}
  .target-card-keuangan::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:url("<?php echo base_url('assets/sbe/infografis/keuangan.jpeg') ?>");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    opacity:0.7;
    pointer-events:none;
    z-index:0;
  }
  .target-card-keuangan > *{position:relative;z-index:1;}

  .target-card{
    background:#fff;
    border-radius:16px;
    box-shadow:0 4px 14px rgba(6,63,66,.06);
    border:1px solid #eee2c8;
    padding:18px;
  }
  .target-card-title{
    font-weight:800;
    font-size:1.05rem;
    letter-spacing:.5px;
    margin-bottom:12px;
  }
  .target-card-title.hijau{color:var(--hijau-terang);}
  .target-card-title.biru{color:var(--biru);}
  .capaian-table{width:100%;margin-bottom:12px;}
  .capaian-table .cap-row{
    display:grid;
    grid-template-columns:1.5fr 1fr 1fr 1fr;
    align-items:center;
    gap:4px;
    padding:8px 10px;
    border-radius:10px;
  }
  .capaian-table .cap-row + .cap-row{margin-top:4px;}
  .capaian-table .cap-head{
    font-size:.66rem;
    font-weight:700;
    letter-spacing:.4px;
    color:#5a5f55;
    padding:0 10px 4px;
  }
  .capaian-table .cap-head > div{text-align:center;}
  .capaian-table .cap-head > div:first-child{text-align:left;}
  .capaian-table .cap-row:not(.cap-head):nth-of-type(2){background:#f7fbf8;}
  .capaian-table .cap-row:not(.cap-head):nth-of-type(3){background:#eef8f9;}
  .capaian-table .cap-label{font-weight:700;font-size:.78rem;color:#22301f;text-align:left;}
  .capaian-table .cap-val{font-weight:800;font-size:1.05rem;text-align:center;color:var(--hijau-tua);}
  .capaian-table .cap-val.deviasi-neg{color:var(--merah);}
  .capaian-table .cap-val.deviasi-pos{color:var(--hijau);}
  .badge-row{display:flex;gap:8px;}
  .badge-row .mini-badge{flex:1;margin-bottom:0;}

  .card-panel{
    background:#fff;
    border-radius:16px;
    box-shadow:0 4px 14px rgba(6,63,66,.06);
    border:1px solid #eee2c8;
    padding:16px;
    height:100%;
  }
  .panel-transparan{
    background:rgba(var(--bg-transparan-warna), var(--bg-transparan-opacity)) !important;
    border:2px solid rgba(var(--bg-transparan-warna), calc(var(--bg-transparan-opacity) + 0.25)) !important;
    box-shadow:none !important;
  }

  /* ---------- DUA SUB-PANEL ANALISIS DEVIASI (Fisik di atas, Keuangan di bawah) ---------- */
  .deviasi-sub-fisik{border-top:4px solid var(--hijau-terang);}
  .deviasi-sub-keuangan{border-top:4px solid var(--biru);}

  .panel-dark{
    background:var(--hijau-tua);
    color:#fff;
    border-radius:16px;
    padding:16px;
    height:100%;
  }
  .panel-title{
    font-weight:800;
    font-size:1.05rem;
    color:var(--hijau-tua);
  }
  .panel-title.on-dark{color:#fff;}
  .accent-title{color:var(--emas-terang);font-style:italic;font-weight:700;margin-bottom:16px;}

  .metric-label{
    font-size:.78rem;font-weight:700;color:#4a4f45;
    display:flex;align-items:center;gap:6px;
  }
  .metric-value{font-size:1.6rem;font-weight:800;}
  .metric-value.hijau{color:var(--hijau-terang);}
  .metric-value.merah{color:var(--merah);}
  .metric-value.biru{color:var(--biru);}
  .dot{width:9px;height:9px;border-radius:50%;display:inline-block;}
  .dot-hijau{background:var(--hijau-terang);}
  .dot-merah{background:var(--merah);}
  .dot-biru{background:var(--biru);}

  .metric-card{
    background:#fff;color:#22301f;border-radius:10px;padding:14px;margin-bottom:14px;
  }
  .metric-card-title{
    display:flex;align-items:center;gap:8px;margin-bottom:10px;font-weight:700;font-size:.85rem;
  }

  .performa-horizontal{
    display:flex;
    align-items:stretch;
    gap:20px;
  }
  .performa-title-block{
    display:flex;
    flex-direction:column;
    justify-content:center;
    min-width:120px;
    flex-shrink:0;
  }
  .performa-metric{
    flex:1;
    margin-bottom:0;
  }
  .performa-metric-row{
    display:flex;
    gap:24px;
  }
  .performa-quote{
    flex:0 0 240px;
    display:flex;
    align-items:center;
    margin-bottom:0;
  }

  .quote-box{
    background:rgba(255,255,255,.08);
    border-left:3px solid var(--emas-terang);
    border-radius:8px;
    padding:12px 14px;
    font-style:italic;
    font-size:.85rem;
    color:var(--emas-terang);
  }
  .quote-box.light{
    background:#faf3e0;
    border-left:3px solid var(--emas);
    color:#6b5620;
  }

  table{
    width:100%;
    border-collapse:collapse;
    font-size:.82rem;
  }
  /* Padding tabel diperkecil (sebelumnya .4rem .55rem) supaya lebih rapat/compact */
  thead th{
    background:var(--hijau-tua);
    color:#fff;
    font-size:.72rem;
    font-weight:700;
    letter-spacing:.3px;
    border:none;
    padding:.25rem .4rem;
    text-align:left;
  }
  thead th:last-child{text-align:right;}
  table.top thead th{background:var(--biru);}
  table.low thead th{background:var(--merah);}
  td{padding:.22rem .4rem;vertical-align:middle;}
  tbody tr:nth-child(even){background:#f7f4e9;}
  .rank-num{
    width:20px;height:20px;border-radius:50%;
    background:var(--hijau-tua);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;
    font-size:.66rem;font-weight:700;
  }
  table.low .rank-num{background:var(--merah);}
  table.top .rank-num{background:var(--biru);}
  .val-cell{font-weight:800;color:var(--hijau-tua);text-align:right;}
  table.low .val-cell{color:var(--merah);}
  table.top .val-cell{color:var(--biru);}
  .text-end{text-align:right;}

  .trophy-header{
    display:flex;align-items:center;gap:8px;font-weight:800;color:var(--hijau-tua);
    margin-bottom:8px;
  }
  .trophy-header.blue{color:var(--biru);}
  .trophy-icon{font-size:1.3rem;}
  .table-title-low{
    font-weight:700;margin-bottom:8px;font-size:.9rem;color:var(--merah);
  }

  .deviasi-row{
    background:#f7f4e9;
    border-radius:12px;
    padding:10px 14px;
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:10px;
  }
  .deviasi-icon{
    width:40px;height:40px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-weight:800;font-size:1.1rem;color:#fff;flex-shrink:0;
  }
  .deviasi-num{font-weight:800;font-size:1.4rem;color:var(--hijau-tua);}
  .deviasi-label{font-size:.72rem;font-weight:700;color:#4a4f45;}

  .deviasi-grid-2col{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:10px;
  }
  .deviasi-item{
    background:#f7f4e9;
    border-radius:12px;
    padding:12px 8px;
    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
    gap:4px;
  }

  .performa-section{
    position:relative;
    overflow:hidden;
    background-color:#d9f4f2;
    border-radius:16px;
    padding:18px;
  }
  .performa-section::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:url("<?php echo base_url('assets/infografis/performa-bg.jpg') ?>");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    opacity:0.25;
    z-index:0;
  }
  .performa-section > *{position:relative;z-index:1;}
  .performa-section-title{
    font-weight:800;
    font-size:1.6rem;
    letter-spacing:.3px;
    color:var(--hijau-tua);
    margin-bottom:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
  }
  /* Semua isi kartu Sekilas Performa dibuat rata tengah */
  .metric-card-light{text-align:center;}
  .metric-card-light .metric-card-title{justify-content:center;gap:12px;}
  .metric-card-light .performa-metric-row{justify-content:center;}
  .metric-card-light .metric-label{justify-content:center;}
  .performa-section-title::before{
    content:"";
    width:6px;
    height:28px;
    background:var(--emas);
    border-radius:4px;
    display:inline-block;
  }
  .performa-horizontal-light{
    display:flex;
    gap:16px;
  }
  .metric-card-light{
    flex:1;
    background:#fff;
    border:2px solid var(--hijau-terang);
    border-radius:12px;
    padding:14px;
  }

  .skpd-table{
    width:100%;
    border-collapse:collapse;
    font-size:.72rem;
    min-width:760px;
  }
  .skpd-table th, .skpd-table td{
    border:1px solid #eee2c8;
    padding:.3rem .45rem;
    text-align:center;
  }
  .skpd-table thead th{
    background:var(--hijau-tua);
    color:#fff;
    font-weight:700;
  }
  .skpd-table td:first-child, .skpd-table td:nth-child(2){
    text-align:left;
    font-weight:700;
  }
  .skpd-table tbody tr:nth-child(4n+1) td,
  .skpd-table tbody tr:nth-child(4n+2) td{background:#f7fbf8;}

  .footer-band{
    background:var(--hijau-tua);
    color:#fff;
    border-radius:16px 16px 0 0;
    padding:16px;
    display:flex;
    flex-wrap:wrap;
    align-items:center;
    justify-content:space-between;
    gap:10px;
  }
  .footer-band .pill{
    background:rgba(255,255,255,.1);
    border-radius:20px;
    padding:6px 16px;
    font-size:.8rem;
    font-weight:700;
  }
  .section-title-chip{
    font-weight:800;color:var(--hijau-tua);margin-bottom:10px;
  }
  .chart-wrap{max-width:140px;margin:0 auto;}
  .focus-list{list-style:none;margin:0 0 16px 0;padding:0;}
  .focus-list li{
    display:flex;gap:10px;align-items:flex-start;
    font-size:.85rem;margin-bottom:10px;
  }
  .focus-check{color:var(--hijau-terang);font-weight:900;flex-shrink:0;}

  .main-grid{
    grid-template-columns:1fr 2fr 1fr;
  }
  .top-tables{grid-template-columns:1fr 1fr;margin-bottom:16px;}
  .low-tables{grid-template-columns:1fr 1fr;}

  .tables-wrapper{
    border-radius:18px;
    padding:0;
  }
  .tables-wrapper.panel-transparan{border-radius:18px;}
  .bottom-grid{grid-template-columns:1fr 1fr 2fr;}
  .donut-flex{display:flex;justify-content:space-around;margin-top:12px;}

/* Tidak ada @media query — tampilan dibuat fixed, tidak menyesuaikan ukuran layar */

#btnDownload{
  position:fixed;
  top:10px;
  right:10px;
  z-index:9999;
  background:#0a6e74;
  color:#fff;
  border:2px solid #fff;
  border-radius:24px;
  padding:8px 16px;
  font-size:13px;
  font-weight:700;
  cursor:pointer;
  box-shadow:0 2px 8px rgba(0,0,0,.3);
}
#btnDownload:hover{background:#14b8c4;}
#btnDownload:disabled{opacity:.7;cursor:wait;}
</style>
</head>
<body>

<button id="btnDownload" type="button" onclick="downloadInfografis()">⬇ Download Gambar</button>

<div id="scaleWrapper">
<div class="container" id="content">

  <div class="app-header">
  <div class="header-band">
    <img src="<?php echo base_url('assets/sbe/image/logo.png') ?>" width="100px">
    <div>
      <h1>REALISASI BELANJA</h1>
      <h1 class="sub">FISIK &amp; KEUANGAN</h1>
      <div class="header-tanggal">Penginputan <?php echo $penginputan ?></div>
      <span class="header-tag">DATA PEMBANGUNAN PROVINSI SUMATERA BARAT</span>
    </div>
  </div>
  </div>

  <div class="app-content">

  <div class="pagu-bar pagu-bg-uang-1">
    <!-- <div class="icon-circle bg-emas pagu-icon" style="width:60px;height:60px;font-size:1.7rem;"></div> -->
    <div class="pagu-main">
      <?php //var_dump($cek) ?>
      <div class="label-kecil">PAGU ANGGARAN</div>
      <div class="pagu-number">Rp. <?php echo number_format($pagu['pagu_total']) ?></div>
      <div class="label-kecil"><small>Dari <?php echo $pagu['opd_apbd'] ?> OPD</small></div>
    </div>
    <?php if ($pagu['opd_tkd']>0){ ?>
    <div class="pagu-divider"></div>
    <div class="pagu-sub">
      <div class="label-kecil">APBD</div>
      <div class="pagu-sub-value">Rp. <?php echo number_format($pagu['pagu']) ?></div>
      <div class="label-kecil"><small>Dari <?php echo $pagu['opd_apbd'] ?> OPD</small></div>
    </div>
    <div class="pagu-divider"></div>
    <div class="pagu-sub">
      <div class="label-kecil">TKD</div>
      <div class="pagu-sub-value">Rp. <?php echo number_format($pagu['pagu_tambahan']) ?></div>
      <div class="label-kecil"><small>Dari <?php echo $pagu['opd_tkd'] ?> OPD</small></div>
    </div>
  <?php } ?>
  </div>

  <div class="grid" style="grid-template-columns:1fr 1fr;">

    <div class="target-card target-card-fisik">
      <div class="target-card-title hijau">FISIK</div>

      <div class="capaian-table">
        <div class="cap-row cap-head">
          <div>Capaian</div><div>Target</div><div>Realisasi</div><div>Deviasi</div>
        </div>
        <div class="cap-row">
          <div class="cap-label">Bulan Ini</div>
          <div class="cap-val"><?php echo $pencapaian['fisik']['tf_b'] ?>%</div>
          <div class="cap-val"><?php echo $pencapaian['fisik']['rf_b'] ?>%</div>
          <div class="cap-val deviasi-neg"><?php echo $pencapaian['fisik']['df_b'] ?>%</div>
        </div>
        <div class="cap-row">
          <div class="cap-label">Akumulasi Bulan Ini</div>
          <div class="cap-val"><?php echo $pencapaian['fisik']['tf_a'] ?>%</div>
          <div class="cap-val"><?php echo $pencapaian['fisik']['rf_a'] ?>%</div>
          <div class="cap-val deviasi-neg"><?php echo $pencapaian['fisik']['df_a'] ?>%</div>
        </div>
      </div>

      <div class="badge-row">
        <span class="mini-badge hijau"><?php echo count($pencapaian['fisik']['diatas_ratarata']) ?> OPD DI ATAS RATA-RATA</span>
        <span class="mini-badge merah"><?php echo count($pencapaian['fisik']['dibawah_ratarata']) ?> OPD DI BAWAH RATA-RATA</span>
      </div>
    </div>

    <div class="target-card target-card-keuangan">
      <div class="target-card-title biru">KEUANGAN</div>

      <div class="capaian-table">
        <div class="cap-row cap-head">
          <div>Capaian</div><div>Target</div><div>Realisasi</div><div>Deviasi</div>
        </div>
        <div class="cap-row">
          <div class="cap-label">Bulan Ini</div>
          <div class="cap-val"><?php echo $pencapaian['keuangan']['tk_b'] ?>%</div>
          <div class="cap-val"><?php echo $pencapaian['keuangan']['rk_b'] ?>%</div>
          <div class="cap-val deviasi-neg"><?php echo $pencapaian['keuangan']['dk_b'] ?>%</div>
        </div>
        <div class="cap-row">
          <div class="cap-label">Akumulasi Bulan Ini</div>
          <div class="cap-val"><?php echo $pencapaian['keuangan']['tk_a'] ?>%</div>
          <div class="cap-val"><?php echo $pencapaian['keuangan']['rk_a'] ?>%</div>
          <div class="cap-val deviasi-neg"><?php echo $pencapaian['keuangan']['dk_a'] ?>%</div>
        </div>
      </div>

      <div class="badge-row">
        <span class="mini-badge hijau"><?php echo count($pencapaian['keuangan']['diatas_ratarata']) ?> OPD DI ATAS RATA-RATA</span>
        <span class="mini-badge merah"><?php echo count($pencapaian['keuangan']['dibawah_ratarata']) ?> OPD DI BAWAH RATA-RATA</span>
      </div>
    </div>
  </div>


  <div class="grid" style="grid-template-columns:2fr 1fr;align-items:stretch;">

    <div class="tables-wrapper">
      <div class="grid top-tables">
        <div class="card-panel panel-transparan">
          <div class="trophy-header"><span class="trophy-icon">🏆</span> TOP 10 REALISASI FISIK <span class="label-kecil">(%)</span></div>
          <table class="top">
            <thead><tr><th>NO</th><th>OPD</th><th>REALISASI</th></tr></thead>
            <tbody>
             <?php foreach ($pencapaian['fisik']['tertinggi'] as $k => $v) { 
              $no = $k+1;?>
              <tr>
                <td><span class="rank-num"><?php echo $no ?></span></td>
                <td><?php echo $v['nama'] ?></td>
                <td class="val-cell"><?php echo $v['nilai'] ?></td>
              </tr>
             <?php } ?>
             
            </tbody>
          </table>
        </div>


        <div class="card-panel panel-transparan">
          <div class="table-title-low">10 TERENDAH REALISASI FISIK (%)</div>
          <table class="low">
            <thead><tr><th>NO</th><th>OPD</th><th>REALISASI</th></tr></thead>
            <tbody>
             <?php foreach ($pencapaian['fisik']['terendah'] as $k => $v) { 
              $no = $k+1;?>
              <tr>
                <td><span class="rank-num"><?php echo $no ?></span></td>
                <td><?php echo $v['nama'] ?></td>
                <td class="val-cell"><?php echo $v['nilai'] ?></td>
              </tr>
             <?php } ?>
             
            </tbody>
          </table>
        </div>



      </div>

      <div class="grid low-tables">
        <div class="card-panel panel-transparan">
          <div class="trophy-header blue"><span class="trophy-icon">🏆</span> TOP 10 REALISASI KEUANGAN <span class="label-kecil">(%)</span></div>
          <table class="top">
            <thead><tr><th>NO</th><th>OPD</th><th>REALISASI</th></tr></thead>
            <tbody>
             <?php foreach ($pencapaian['keuangan']['tertinggi'] as $k => $v) { 
              $no = $k+1;?>
              <tr>
                <td><span class="rank-num"><?php echo $no ?></span></td>
                <td><?php echo $v['nama'] ?></td>
                <td class="val-cell"><?php echo $v['nilai'] ?></td>
              </tr>
             <?php } ?>
             
            </tbody>
          </table>
        </div>

        <div class="card-panel panel-transparan">
          <div class="table-title-low">10 TERENDAH REALISASI KEUANGAN (%)</div>
          <table class="low">
            <thead><tr><th>NO</th><th>OPD</th><th>REALISASI</th></tr></thead>
            <tbody>
             <?php foreach ($pencapaian['keuangan']['terendah'] as $k => $v) { 
              $no = $k+1;?>
              <tr>
                <td><span class="rank-num"><?php echo $no ?></span></td>
                <td><?php echo $v['nama'] ?></td>
                <td class="val-cell"><?php echo $v['nilai'] ?></td>
              </tr>
             <?php } ?>
             
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- KANAN (1/3): ANALISIS DEVIASI — 2 kotak terpisah: FISIK di atas, KEUANGAN di bawah -->
    <div class="flex-col" style="display:flex;gap:16px;">

      <div class="card-panel panel-transparan deviasi-sub-fisik" style="flex:1;display:flex;flex-direction:column;">
        <?php $this->load->view('beranda/grafik_lingkaran_dev_fisik') ?>
      </div>

      <div class="card-panel panel-transparan deviasi-sub-keuangan" style="flex:1;display:flex;flex-direction:column;">
        <?php $this->load->view('beranda/grafik_lingkaran_dev_keuangan') ?>
      </div>

    </div>
  </div>

  <div class="performa-section">
    <div class="performa-section-title felipa-regular">Sekilas Performa</div>
    <div class="performa-horizontal-light">
      <div class="metric-card-light">
        <div class="metric-card-title" style="color:var(--hijau-terang);">🎯 REALISASI FISIK</div>
        <div class="performa-metric-row">
          <div>
            <div class="metric-label"><span class="dot dot-hijau"></span>Tertinggi :</div>
            <div style="font-size:.8rem;font-weight:600;"><?php echo $pencapaian['fisik']['tertinggi'][0]['nama'] ?></div>
            <div class="metric-value hijau"><?php echo $pencapaian['fisik']['tertinggi'][0]['nilai'] ?>%</div>
          </div>
          <div>
            <div class="metric-label"><span class="dot dot-merah"></span>Terendah :</div>
            <div style="font-size:.8rem;font-weight:600;"><?php echo $pencapaian['fisik']['terendah'][0]['nama'] ?></div>
            <div class="metric-value merah"><?php echo $pencapaian['fisik']['terendah'][0]['nilai'] ?>%</div>
          </div>
        </div>
      </div>
      <div class="metric-card-light">
        <div class="metric-card-title" style="color:var(--biru);">💠 REALISASI KEUANGAN</div>
        <div class="performa-metric-row">
          <div>
            <div class="metric-label"><span class="dot dot-biru"></span>Tertinggi :</div>
            <div style="font-size:.8rem;font-weight:600;"><?php echo $pencapaian['keuangan']['tertinggi'][0]['nama'] ?></div>
            <div class="metric-value biru"><?php echo $pencapaian['keuangan']['tertinggi'][0]['nilai'] ?>%</div>
          </div>
          <div>
            <div class="metric-label"><span class="dot dot-merah"></span>Terendah :</div>
            <div style="font-size:.8rem;font-weight:600;"><?php echo $pencapaian['keuangan']['terendah'][0]['nama'] ?></div>
            <div class="metric-value merah"><?php echo $pencapaian['keuangan']['terendah'][0]['nilai'] ?>%</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card-panel">


          <?php $this->load->view('beranda/grafik_batang') ?>   
  </div>

  </div>

  <div class="app-footer">
  <div class="footer-band">
    <div>
      <div style="font-size:.85rem;">Powered By <strong>Biro Administrasi Pembangunan</strong></div>
      <div style="font-size:.75rem;opacity:.85;">Sekretariat Daerah Provinsi Sumatera Barat</div>
    </div>
    <div style="text-align:center;">
      <div class="label-kecil" style="color:#cfe9d8;">LAST UPDATE</div>
      <div style="font-weight:700;"><?php echo date('d') ?> <?php echo bulan_global(date('n')) ?> <?php echo  date('Y') ?></div>
    </div>
    <div style="text-align:center;">
      <div class="label-kecil" style="color:#cfe9d8;">TERINTEGRASI DENGAN</div>
      <div class="flex items-center gap-2" style="justify-content:center;margin-top:4px;">
        <span class="pill">Dashboard Pembangunan</span>
        <span class="pill">E TPP</span>
        <span class="pill">Sipedal</span>
      </div>
    </div>
  </div>
  </div>

</div>
</div>

<script>
function scaleContent(){
  var wrapper = document.getElementById('scaleWrapper');
  var content = document.getElementById('content');
  var scale = wrapper.clientWidth / 1200;
  content.style.transform = 'scale(' + scale + ')';
  wrapper.style.height = (content.offsetHeight * scale) + 'px';
}
window.addEventListener('load', scaleContent);
window.addEventListener('resize', scaleContent);
setTimeout(scaleContent, 300);

scaleContent();
function downloadInfografis(){
  var btn = document.getElementById('btnDownload');
  var wrapper = document.getElementById('scaleWrapper');
  var content = document.getElementById('content');
  var bs = getComputedStyle(document.body);

  var simpan = {
    transform: content.style.transform,
    wW: wrapper.style.width, wH: wrapper.style.height,
    bgC: wrapper.style.backgroundColor, bgI: wrapper.style.backgroundImage,
    bgS: wrapper.style.backgroundSize, bgP: wrapper.style.backgroundPosition,
    bgR: wrapper.style.backgroundRepeat
  };
  function pulihkan(){
    content.style.transform = simpan.transform;
    wrapper.style.width = simpan.wW; wrapper.style.height = simpan.wH;
    wrapper.style.backgroundColor = simpan.bgC; wrapper.style.backgroundImage = simpan.bgI;
    wrapper.style.backgroundSize = simpan.bgS; wrapper.style.backgroundPosition = simpan.bgP;
    wrapper.style.backgroundRepeat = simpan.bgR;
    scaleContent();
    btn.disabled = false;
    btn.textContent = '⬇ Download Gambar';
  }

  btn.disabled = true;
  btn.textContent = 'Membuat gambar...';

  content.style.transform = 'none';
  wrapper.style.width = '1200px';
  wrapper.style.height = content.offsetHeight + 'px';
  wrapper.style.backgroundColor = bs.backgroundColor;
  wrapper.style.backgroundImage = bs.backgroundImage;
  wrapper.style.backgroundSize = 'cover';
  wrapper.style.backgroundPosition = 'center top';
  wrapper.style.backgroundRepeat = 'no-repeat';

  html2canvas(wrapper, {
    scale: 2,
    useCORS: true,
    backgroundColor: null,
    width: 1200,
    height: content.offsetHeight,
    windowWidth: 1200
  }).then(function(canvas){
    var d = new Date();
    var namaFile = 'infografis-realisasi-' + d.getFullYear() + '-' +
      ('0'+(d.getMonth()+1)).slice(-2) + '-' + ('0'+d.getDate()).slice(-2) + '.png';
    var a = document.createElement('a');
    a.download = namaFile;
    a.href = canvas.toDataURL('image/png');
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
  }).catch(function(err){
    alert('Gagal membuat gambar: ' + err);
  }).then(pulihkan);
}
</script>

</body>
</html>