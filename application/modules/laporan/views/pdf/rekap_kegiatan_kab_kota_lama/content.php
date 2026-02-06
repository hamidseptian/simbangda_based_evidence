
    <?php 
$q_msk = $this->db->query("SELECT kode_sub_kegiatan, nama_sub_kegiatan from master_sub_kegiatan")->result_array();

$kumpul_msk = [];
foreach ($q_msk as $k => $v) {
  $kumpul_msk[$v['kode_sub_kegiatan']] = $v['nama_sub_kegiatan'];
}



    $kumpul = [];
      foreach ($lokasi_per_skpd as $key => $v) {
        $pecah_krsk = explode('.', $v['kode_rekening_sub_kegiatan']);
        $krsk = $pecah_krsk[0].'.'.$pecah_krsk[1].'.'.$pecah_krsk[2].'.'.$pecah_krsk[3].'.'.$pecah_krsk[4].'.'.$pecah_krsk[5];
        $data = [
          'id_instansi'=>$v['id_instansi'],
          'nama_instansi'=>$v['nama_instansi'],
          'id_kecamatan'=>$v['id_kecamatan'],
          'kode_ski'=>$v['kode_rekening_sub_kegiatan'],
          'krsk'=>$krsk,
          'nama_ski'=>$kumpul_msk[$krsk],
          'id_paket_pekerjaan'=>$v['id_paket_pekerjaan'],
          'nama_paket'=>$v['nama_paket'],
        ];

       array_push($kumpul, $data);
      }

      // echo json_encode($kumpul);
$cleaned = array_values($kumpul);

$grouped = [];
foreach ($cleaned as $k => $item) {

    $group_ski = [];
    $kumpul_ski = [];
    foreach ($item as $k_item => $v_item) {
      $data_ski = [
        'kode_sub_kegiatan'=>$item['kode_ski'],
        'nama_ski' =>$item['nama_ski'],
        'data_paket' =>[]
      ];

      $kumpul_ski[$k_item] =12;//$data_ski;
      // array_push($kumpul_ski, $data);

      // $group_ski[$v_item['kode_rekening_sub_kegiatan']]= $data;
      // $grouped[$item['id_instansi']]['kork'] = $data;
    }

    $cleaner_ski = array_values($kumpul_ski); 
    $grouped[$item['id_kecamatan']][] = $item;
}


echo json_encode($grouped);
header('Content-Type: application/json'); ?>
