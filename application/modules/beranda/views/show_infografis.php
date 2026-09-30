<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Realisasi Belanja Fisik & Keuangan — Sumatera Barat</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<style>
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
  }
  *{box-sizing:border-box;}
  html, body{
    margin:0;
    font-family:'Segoe UI', Roboto, Arial, sans-serif;
    color:#22301f;
    overflow-x:hidden;

    /* =====================================================
       TEMPEL GAMBAR BACKGROUND ANDA DI SINI
       Cara pakai (pilih salah satu):
       1) Gambar online   -> background-image:url("https://alamat-gambar-anda.jpg");
       2) Gambar lokal     -> taruh file gambar satu folder dengan HTML ini,
                              lalu -> background-image:url("nama-file-anda.jpg");
       Baris di bawah sengaja dikosongkan / dinonaktifkan dulu.
       ===================================================== */
    background-color:#063f42;
    background-image:url("<?php echo base_url('assets/infografis/banner.png') ?>");
    background-size:cover;
    background-position:center top;
    background-repeat:no-repeat;
  }
  /* Wrapper yang mengikuti lebar iframe/parent, tingginya diatur oleh JS
     mengikuti hasil skala supaya tidak ada ruang kosong */
  #scaleWrapper{
    position:relative;
    width:100%;
    overflow:hidden;
  }
  /* Konten aslinya tetap fixed 1200px, tidak pernah reflow.
     Yang berubah hanya skala (transform) mengikuti lebar wrapper.
     Tinggi dibiarkan otomatis (menyesuaikan isi) seperti semula —
     class app-header / app-content / app-footer di sini hanya untuk
     pengelompokan struktur, bukan untuk memaksa rasio tinggi. */
  .container{
    width:1200px;
    padding:0 14px 14px 14px;
    position:absolute;
    top:0;
    left:0;
    transform-origin:top left;
  }

  /* ---------- 3 BAGIAN UTAMA (pengelompokan saja) ---------- */
  .app-header{margin-bottom:16px;}
  .app-content{display:flex;flex-direction:column;gap:16px;}
  .app-footer{margin-top:16px;}

  /* ---------- LAYOUT HELPERS ---------- */
  .grid{display:grid;gap:16px;}
  .flex{display:flex;}
  .flex-col{display:flex;flex-direction:column;}
  .items-center{align-items:center;}
  .gap-2{gap:8px;}
  .gap-3{gap:12px;}
  .text-center{text-align:center;}
  .mt-auto{margin-top:auto;}
  .w-100{width:100%;}

  /* ---------- HEADER ---------- */
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

  /* ---------- STAT STRIP ---------- */
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

  /* ---------- BAGIAN 1: PAGU / APBD / TKD ---------- */
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


  /* =====================================================
     BACKGROUND GAMBAR: PAGU, FISIK, KEUANGAN
     Cara kerjanya sama seperti background body / Sekilas Performa:
     gambar diambil dari folder assets lewat base_url().
     Upload gambar Anda ke lokasi berikut (nama file bisa diganti
     di baris background-image masing-masing):

       Pagu atas   -> assets/infografis/gambar_uang_1.jpg
       Pagu bawah  -> assets/infografis/gambar_uang_2.jpg
       Fisik    -> assets/infografis/fisik-bg.jpg
       Keuangan -> assets/infografis/keuangan-bg.jpg

     Untuk mengatur transparansi, ubah angka "opacity" di tiap blok
     (0 = tidak terlihat sama sekali, 1 = sepenuhnya pekat).
     Teks di atas gambar tetap 100% jelas.
     ===================================================== */

  /* -- PAGU ANGGARAN: 2 kartu dengan gambar berbeda -- */
  .pagu-bar{position:relative;overflow:hidden;}

  /* Kartu ATAS (Pagu Anggaran)  -> assets/infografis/gambar_uang_1.jpg */
  .pagu-bg-uang-1::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:url("<?php echo base_url('assets/sbe/infografis/pagu_1.png') ?>");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    opacity:0.8;   /* <== UBAH ANGKA INI untuk transparansi gambar PAGU (kartu atas) */
    pointer-events:none;
    z-index:0;
  }

  /* Kartu BAWAH (APBD / TKD)    -> assets/infografis/gambar_uang_2.jpg */
  .pagu-bg-uang-2::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:url("<?php echo base_url('assets/sbe/infografis/pagu_2.png') ?>");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    opacity:0.8;   /* <== UBAH ANGKA INI untuk transparansi gambar APBD/TKD (kartu bawah) */
    pointer-events:none;
    z-index:0;
  }
  .pagu-bar > *{position:relative;z-index:1;}

  /* -- FISIK -- */
  .target-card-fisik{position:relative;overflow:hidden;}
  .target-card-fisik::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:url("<?php echo base_url('assets/sbe/infografis/fisik.jpeg') ?>");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    opacity:0.8;   /* <== UBAH ANGKA INI untuk transparansi gambar FISIK */
    pointer-events:none;
    z-index:0;
  }
  .target-card-fisik > *{position:relative;z-index:1;}

  /* -- KEUANGAN -- */
  .target-card-keuangan{position:relative;overflow:hidden;}
  .target-card-keuangan::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:url("<?php echo base_url('assets/sbe/infografis/keuangan.jpeg') ?>");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    opacity:0.7;   /* <== UBAH ANGKA INI untuk transparansi gambar KEUANGAN */
    pointer-events:none;
    z-index:0;
  }
  .target-card-keuangan > *{position:relative;z-index:1;}

  /* ---------- BAGIAN 2 & 3: KARTU FISIK / KEUANGAN ---------- */
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
  /* Target / Realisasi / Deviasi: gaya "tabel tanpa garis" (baris Bulan Ini & Akumulasi) */
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

  /* ---------- PANELS ---------- */
  .card-panel{
    background:#fff;
    border-radius:16px;
    box-shadow:0 4px 14px rgba(6,63,66,.06);
    border:1px solid #eee2c8;
    padding:16px;
    height:100%;
  }
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

  /* ---------- PERFORMA MENDATAR ---------- */
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

  /* ---------- TABLES ---------- */
  table{
    width:100%;
    border-collapse:collapse;
    font-size:.82rem;
  }
  thead th{
    background:var(--hijau-tua);
    color:#fff;
    font-size:.72rem;
    font-weight:700;
    letter-spacing:.3px;
    border:none;
    padding:.4rem .55rem;
    text-align:left;
  }
  thead th:last-child{text-align:right;}
  table.top thead th{background:var(--biru);}
  table.low thead th{background:var(--merah);}
  td{padding:.4rem .55rem;vertical-align:middle;}
  tbody tr:nth-child(even){background:#f7f4e9;}
  .rank-num{
    width:24px;height:24px;border-radius:50%;
    background:var(--hijau-tua);color:#fff;
    display:inline-flex;align-items:center;justify-content:center;
    font-size:.7rem;font-weight:700;
  }
  table.low .rank-num{background:var(--merah);}
  table.top .rank-num{background:var(--biru);}
  .val-cell{font-weight:800;color:var(--hijau-tua);text-align:right;}
  table.low .val-cell{color:var(--merah);}
  table.top .val-cell{color:var(--biru);}
  .text-end{text-align:right;}

  .trophy-header{
    display:flex;align-items:center;gap:8px;font-weight:800;color:var(--hijau-tua);
    margin-bottom:10px;
  }
  .trophy-header.blue{color:var(--biru);}
  .trophy-icon{font-size:1.3rem;}
  .table-title-low{
    font-weight:700;margin-bottom:10px;font-size:.9rem;color:var(--merah);
  }

  /* ---------- DEVIASI ---------- */
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

  /* ---------- ANALISIS DEVIASI GRID 2 KOLOM ---------- */
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

  /* ---------- SEKILAS PERFORMA (light, di bawah) ---------- */
  /* Gambar background diambil dari folder assets, PERSIS seperti cara
     background body diatur di atas (base_url). Jika file belum ada,
     tinggal upload gambar ke folder tersebut dengan nama yang sama:
     assets/infografis/performa-bg.jpg
     Efek transparan diatur lewat elemen ::before + opacity di bawah
     (angka "opacity" itu yang diubah untuk mengatur transparansinya:
     0 = tidak terlihat sama sekali, 1 = sepenuhnya solid/pekat). */
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
    opacity:0.25;   /* <== UBAH ANGKA INI untuk transparansi gambar Sekilas Performa */
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
    gap:10px;
  }
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

  /* ---------- TABEL PENCAPAIAN SKPD ---------- */
  .skpd-table{
    width:100%;
    border-collapse:collapse;
    font-size:.72rem;
    min-width:760px;
  }
  .skpd-table th, .skpd-table td{
    border:1px solid #eee2c8;
    padding:.35rem .5rem;
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

  /* ---------- FOOTER ---------- */
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

  /* ---------- GRID LAYOUTS ---------- */
  .main-grid{
    grid-template-columns:1fr 2fr 1fr;
  }
  .top-tables{grid-template-columns:1fr 1fr;margin-bottom:16px;}
  .low-tables{grid-template-columns:1fr 1fr;}

  /* ---------- KOTAK INDUK AREA TABEL (biru transparan 60%) ---------- */
  .tables-wrapper{
    background:rgba(20,184,196,0.35);  /* aqua, transparan 65% */
    border:2px solid rgba(20,184,196,0.6);
    border-radius:18px;
    padding:0;
  }
  .bottom-grid{grid-template-columns:1fr 1fr 2fr;}
  .donut-flex{display:flex;justify-content:space-around;margin-top:12px;}

/* Tidak ada @media query — tampilan dibuat fixed, tidak menyesuaikan ukuran layar */

/* ---------- TOMBOL DOWNLOAD GAMBAR ---------- */
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

  <!-- ============ BAGIAN 1: HEADER (15%) ============ -->
  <div class="app-header">
  <div class="header-band">
    <img src="<?php echo base_url('assets/sbe/image/logo.png') ?>" width="100px">
    <div>
      <h1>REALISASI BELANJA</h1>
      <h1 class="sub">FISIK &amp; KEUANGAN</h1>
      <div class="header-tanggal">PENGINPUTAN S.D 31 JULI 2026</div>
      <span class="header-tag">DATA PEMBANGUNAN PROVINSI SUMATERA BARAT</span>
    </div>
  </div>
  </div>
  <!-- ============ /HEADER ============ -->

  <!-- ============ BAGIAN 2: KONTEN (80%) ============ -->
  <div class="app-content">

  <!-- ============ BAGIAN 1: PAGU / APBD / TKD (1 baris) ============ -->
  <div class="pagu-bar pagu-bg-uang-1">
    <div class="icon-circle bg-emas pagu-icon" style="width:60px;height:60px;font-size:1.7rem;">🏛️</div>
    <div class="pagu-main">
      <div class="label-kecil">PAGU ANGGARAN</div>
      <div class="pagu-number">Rp. <?php echo number_format($pagu['pagu_total']) ?></div>
      <div class="label-kecil"><small>Dari <?php echo $pagu['opd_apbd'] ?> OPD</small></div>
    </div>
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
  </div>

  <!-- ============ BAGIAN 2 & 3: KARTU FISIK & KEUANGAN ============ -->
  <div class="grid" style="grid-template-columns:1fr 1fr;">

    <!-- BAGIAN 2: FISIK -->
    <div class="target-card target-card-fisik">
      <div class="target-card-title hijau">FISIK</div>

      <!-- Capaian Target/Realisasi/Deviasi: ganti angka di bawah sesuai data asli -->
      <div class="capaian-table">
        <div class="cap-row cap-head">
          <div>Capaian</div><div>Target</div><div>Realisasi</div><div>Deviasi</div>
        </div>
        <div class="cap-row">
          <div class="cap-label">Bulan Ini</div>
          <div class="cap-val">7%</div>
          <div class="cap-val">5%</div>
          <div class="cap-val deviasi-neg">-2%</div>
        </div>
        <div class="cap-row">
          <div class="cap-label">Akumulasi Bulan Ini</div>
          <div class="cap-val">7%</div>
          <div class="cap-val">5%</div>
          <div class="cap-val deviasi-neg">-2%</div>
        </div>
      </div>

      <div class="badge-row">
        <span class="mini-badge hijau">29 OPD DI ATAS RATA-RATA</span>
        <span class="mini-badge merah">23 OPD DI BAWAH RATA-RATA</span>
      </div>
    </div>

    <!-- BAGIAN 3: KEUANGAN -->
    <div class="target-card target-card-keuangan">
      <div class="target-card-title biru">KEUANGAN</div>

      <!-- Capaian Target/Realisasi/Deviasi: ganti angka di bawah sesuai data asli -->
      <div class="capaian-table">
        <div class="cap-row cap-head">
          <div>Capaian</div><div>Target</div><div>Realisasi</div><div>Deviasi</div>
        </div>
        <div class="cap-row">
          <div class="cap-label">Bulan Ini</div>
          <div class="cap-val">10%</div>
          <div class="cap-val">5%</div>
          <div class="cap-val deviasi-neg">-5%</div>
        </div>
        <div class="cap-row">
          <div class="cap-label">Akumulasi Bulan Ini</div>
          <div class="cap-val">10%</div>
          <div class="cap-val">5%</div>
          <div class="cap-val deviasi-neg">-5%</div>
        </div>
      </div>

      <div class="badge-row">
        <span class="mini-badge hijau">15 OPD DI ATAS RATA-RATA</span>
        <span class="mini-badge merah">20 OPD DI BAWAH RATA-RATA</span>
      </div>
    </div>
  </div>


  <!-- TOP 10 & TERENDAH (2/3) + ANALISIS DEVIASI (1/3) -->
  <div class="grid" style="grid-template-columns:2fr 1fr;align-items:stretch;">

    <!-- KIRI (2/3): TOP 10 & TERENDAH -->
    <div class="tables-wrapper">
      <div class="grid top-tables">
        <div class="card-panel">
          <div class="trophy-header"><span class="trophy-icon">🏆</span> TOP 10 REALISASI FISIK <span class="label-kecil">(%)</span></div>
          <table class="top">
            <thead><tr><th>NO</th><th>OPD</th><th>REALISASI</th></tr></thead>
            <tbody>
              <tr><td><span class="rank-num">1</span></td><td>RSAM BUKITTINGGI</td><td class="val-cell">76,23</td></tr>
              <tr><td><span class="rank-num">2</span></td><td>RSJ HB SAANIN</td><td class="val-cell">75,13</td></tr>
              <tr><td><span class="rank-num">3</span></td><td>DISPORA</td><td class="val-cell">74,25</td></tr>
              <tr><td><span class="rank-num">4</span></td><td>RO PEMOTDA</td><td class="val-cell">70,14</td></tr>
              <tr><td><span class="rank-num">5</span></td><td>DINAS SATPOL PP</td><td class="val-cell">69,30</td></tr>
              <tr><td><span class="rank-num">6</span></td><td>DISDUKCAPIL</td><td class="val-cell">67,37</td></tr>
              <tr><td><span class="rank-num">7</span></td><td>BALITBANG</td><td class="val-cell">65,92</td></tr>
              <tr><td><span class="rank-num">8</span></td><td>RO HUKUM</td><td class="val-cell">65,66</td></tr>
              <tr><td><span class="rank-num">9</span></td><td>DISKOMINFOTIK</td><td class="val-cell">64,54</td></tr>
              <tr><td><span class="rank-num">10</span></td><td>RSUD Prof. M Yamin</td><td class="val-cell">64,26</td></tr>
            </tbody>
          </table>
        </div>

        <div class="card-panel">
          <div class="trophy-header blue"><span class="trophy-icon">🏆</span> TOP 10 REALISASI KEUANGAN <span class="label-kecil">(%)</span></div>
          <table class="top">
            <thead><tr><th>NO</th><th>OPD</th><th>REALISASI</th></tr></thead>
            <tbody>
              <tr><td><span class="rank-num">1</span></td><td>RSAM BUKITTINGGI</td><td class="val-cell">73,92</td></tr>
              <tr><td><span class="rank-num">2</span></td><td>RSJ HB SAANIN</td><td class="val-cell">59,81</td></tr>
              <tr><td><span class="rank-num">3</span></td><td>RO PEMOTDA</td><td class="val-cell">52,79</td></tr>
              <tr><td><span class="rank-num">4</span></td><td>DISPORA</td><td class="val-cell">50,86</td></tr>
              <tr><td><span class="rank-num">5</span></td><td>RO HUKUM</td><td class="val-cell">49,09</td></tr>
              <tr><td><span class="rank-num">6</span></td><td>DINAS KEARSIPAN</td><td class="val-cell">48,51</td></tr>
              <tr><td><span class="rank-num">7</span></td><td>RO UMUM</td><td class="val-cell">46,03</td></tr>
              <tr><td><span class="rank-num">8</span></td><td>DISDUKCAPIL</td><td class="val-cell">45,75</td></tr>
              <tr><td><span class="rank-num">9</span></td><td>RSUD Prof. M Yamin</td><td class="val-cell">44,60</td></tr>
              <tr><td><span class="rank-num">10</span></td><td>BPKAD</td><td class="val-cell">43,61</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="grid low-tables">
        <div class="card-panel">
          <div class="table-title-low">10 TERENDAH REALISASI FISIK (%)</div>
          <table class="low">
            <thead><tr><th>NO</th><th>OPD</th><th>REALISASI</th></tr></thead>
            <tbody>
              <tr><td><span class="rank-num">43</span></td><td>DKP</td><td class="val-cell">41,92</td></tr>
              <tr><td><span class="rank-num">44</span></td><td>BPBD</td><td class="val-cell">36,69</td></tr>
              <tr><td><span class="rank-num">45</span></td><td>DBMCKTR</td><td class="val-cell">32,86</td></tr>
              <tr><td><span class="rank-num">46</span></td><td>DISHUB</td><td class="val-cell">29,91</td></tr>
              <tr><td><span class="rank-num">47</span></td><td>DISPERKIMTAN</td><td class="val-cell">24,50</td></tr>
              <tr><td><span class="rank-num">48</span></td><td>DSDABK</td><td class="val-cell">18,58</td></tr>
              <tr><td><span class="rank-num">49</span></td><td>BPKAD (PPKD)</td><td class="val-cell">10,00</td></tr>
            </tbody>
          </table>
        </div>

        <div class="card-panel">
          <div class="table-title-low">10 TERENDAH REALISASI KEUANGAN (%)</div>
          <table class="low">
            <thead><tr><th>NO</th><th>OPD</th><th>REALISASI</th></tr></thead>
            <tbody>
              <tr><td><span class="rank-num">43</span></td><td>BAPENDA</td><td class="val-cell">19,82</td></tr>
              <tr><td><span class="rank-num">44</span></td><td>DISHUT</td><td class="val-cell">19,09</td></tr>
              <tr><td><span class="rank-num">45</span></td><td>DPMPTSP</td><td class="val-cell">18,44</td></tr>
              <tr><td><span class="rank-num">46</span></td><td>DKP</td><td class="val-cell">18,40</td></tr>
              <tr><td><span class="rank-num">47</span></td><td>DISBUNTANHOR</td><td class="val-cell">17,10</td></tr>
              <tr><td><span class="rank-num">48</span></td><td>DSDABK</td><td class="val-cell">16,36</td></tr>
              <tr><td><span class="rank-num">49</span></td><td>DBMCKTR</td><td class="val-cell">16,23</td></tr>
              <tr><td><span class="rank-num">50</span></td><td>DISHUB</td><td class="val-cell">16,05</td></tr>
              <tr><td><span class="rank-num">51</span></td><td>BPBD</td><td class="val-cell">14,09</td></tr>
              <tr><td><span class="rank-num">52</span></td><td>DISPERKIMTAN</td><td class="val-cell">12,69</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- KANAN (1/3): ANALISIS DEVIASI (grid 2 kolom) + PERBANDINGAN RATA-RATA -->
    <div class="flex-col" style="display:flex;gap:16px;">

      <div class="card-panel">
        <div class="panel-title" style="margin-bottom:14px;">
          ANALISIS DEVIASI<br>REALISASI FISIK<br>
          <span style="font-size:.85rem;color:#5a5f55;font-weight:600;">TERHADAP TARGET</span>
        </div>

        <div class="deviasi-grid-2col">
          <div class="deviasi-item">
            <div class="deviasi-icon" style="background:var(--hijau-terang);">▲</div>
            <div class="deviasi-num">17 <span style="font-size:.65rem;">OPD</span></div>
            <div class="deviasi-label">DEVIASI POSITIF<br>(≥ +10%)</div>
          </div>
          <div class="deviasi-item">
            <div class="deviasi-icon" style="background:#7bc47f;">▲</div>
            <div class="deviasi-num">14 <span style="font-size:.65rem;">OPD</span></div>
            <div class="deviasi-label">DEVIASI POSITIF<br>(0% s.d &lt; +10%)</div>
          </div>
          <div class="deviasi-item">
            <div class="deviasi-icon" style="background:var(--emas);">=</div>
            <div class="deviasi-num">1 <span style="font-size:.65rem;">OPD</span></div>
            <div class="deviasi-label">SESUAI TARGET<br>(-0% s.d 0%)</div>
          </div>
          <div class="deviasi-item">
            <div class="deviasi-icon" style="background:#e08a3c;">▼</div>
            <div class="deviasi-num">11 <span style="font-size:.65rem;">OPD</span></div>
            <div class="deviasi-label">DEVIASI NEGATIF<br>(-10% s.d -20%)</div>
          </div>
          <div class="deviasi-item">
            <div class="deviasi-icon" style="background:var(--merah);">▼</div>
            <div class="deviasi-num">9 <span style="font-size:.65rem;">OPD</span></div>
            <div class="deviasi-label">DEVIASI NEGATIF<br>(&lt; -20%)</div>
          </div>
          <div class="deviasi-item" style="background:#faf3e0;">
            <div style="font-size:1.4rem;">📊</div>
            <div class="quote-box light" style="margin:0;font-size:.7rem;padding:8px;">
              "Pengendalian yang baik berawal dari data yang tepat dan terupdate"
            </div>
          </div>
        </div>
      </div>

      <div class="card-panel">

          <?php $this->load->view('beranda/grafik_lingkaran') ?>   
      
      </div>

    </div>
  </div>

  <!-- SEKILAS PERFORMA (dipindah ke bawah, full width) -->
  <div class="performa-section">
    <div class="performa-section-title">Sekilas Performa</div>
    <div class="performa-horizontal-light">
      <div class="metric-card-light">
        <div class="metric-card-title" style="color:var(--hijau-terang);">🎯 REALISASI FISIK</div>
        <div class="performa-metric-row">
          <div>
            <div class="metric-label"><span class="dot dot-hijau"></span>Tertinggi :</div>
            <div style="font-size:.8rem;font-weight:600;">RSAM BUKITTINGGI</div>
            <div class="metric-value hijau">76,23%</div>
          </div>
          <div>
            <div class="metric-label"><span class="dot dot-merah"></span>Terendah :</div>
            <div style="font-size:.8rem;font-weight:600;">BPKAD (PPKD)</div>
            <div class="metric-value merah">10,00%</div>
          </div>
        </div>
      </div>
      <div class="metric-card-light">
        <div class="metric-card-title" style="color:var(--biru);">💠 REALISASI KEUANGAN</div>
        <div class="performa-metric-row">
          <div>
            <div class="metric-label"><span class="dot dot-biru"></span>Tertinggi :</div>
            <div style="font-size:.8rem;font-weight:600;">RSAM BUKITTINGGI</div>
            <div class="metric-value biru">73,92%</div>
          </div>
          <div>
            <div class="metric-label"><span class="dot dot-merah"></span>Terendah :</div>
            <div style="font-size:.8rem;font-weight:600;">DISPERKIMTAN</div>
            <div class="metric-value merah">12,69%</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PENCAPAIAN TOTAL SKPD (chart bulanan + tabel) -->
  <div class="card-panel">


          <?php $this->load->view('beranda/grafik_batang') ?>   
  </div>

  </div>
  <!-- ============ /KONTEN ============ -->

  <!-- ============ BAGIAN 3: FOOTER (5%) ============ -->
  <div class="app-footer">
  <div class="footer-band">
    <div>
      <div style="font-size:.85rem;">Powered By <strong>Biro Administrasi Pembangunan</strong></div>
      <div style="font-size:.75rem;opacity:.85;">Sekretariat Daerah Provinsi Sumatera Barat</div>
    </div>
    <div style="text-align:center;">
      <div class="label-kecil" style="color:#cfe9d8;">LAST UPDATE</div>
      <div style="font-weight:700;">23 September 2026</div>
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
  <!-- ============ /FOOTER ============ -->

</div>
</div>

<script>
// ====== SCALING: konten tetap 1200px, hanya ditampilkan mengecil/membesar
// mengikuti lebar iframe/parent, tanpa mengubah susunan layout ======
function scaleContent(){
  var wrapper = document.getElementById('scaleWrapper');
  var content = document.getElementById('content');
  var scale = wrapper.clientWidth / 1200;
  content.style.transform = 'scale(' + scale + ')';
  wrapper.style.height = (content.offsetHeight * scale) + 'px';
}
window.addEventListener('load', scaleContent);
window.addEventListener('resize', scaleContent);
// Jaga-jaga jika chart/gambar membuat tinggi berubah setelah render
setTimeout(scaleContent, 300);

scaleContent();
// ====== DOWNLOAD INFOGRAFIS SEBAGAI GAMBAR (PNG) ======
// Nama file hasil download bisa diubah di variabel "namaFile".
// Kualitas/ukuran: ubah angka "scale" (2 = resolusi 2x lebih tajam).
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

  // tampilkan ukuran asli (1200px, tanpa scaling) + sertakan background body
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