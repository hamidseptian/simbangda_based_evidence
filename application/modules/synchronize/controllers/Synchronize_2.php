
<?php 


    public function synch_tkd($tahun, $tahap, $id_instansi, $input='manual')
    {
        // $tahun = $this->input->get('tahun');
        // $tahap = $this->input->get('tahap');
        // $id_instansi = $this->input->get('id_instansi');
          $q_opd = $this->db->query("SELECT nama_instansi, kode_opd from master_instansi where id_instansi='$id_instansi'")->row_array();
        $kode_opd = $q_opd['kode_opd'];
        $kode_tahap = $tahap;
        // $this->db->trans_begin();
        $synchronize    = $this->synchronize_model;
        $id_tambahan_anggaran = $this->db->query("SELECT id_tambahan_anggaran from tambahan_anggaran where status='1'")->row_array();
        $id_tambahan_anggaran = $id_tambahan_anggaran['id_tambahan_anggaran'];
        $sub_kegiatan = $synchronize->get_sub_kegiatan_new_tkd($id_instansi, $tahun, $tahap, $id_tambahan_anggaran);
        $bulan = 12;
        $ope = '<=';

        $total_sub_kegiatan = 0;
        $no_sub_kegiatan = 0;
        $total_pagu_sub_kegiatan_instansi=0;
        $kumpul_sub_kegiatan = [];



        $q_program = $this->db->query("SELECT kode_program, nama_program from master_program");
        $kumpul_program = [];
        foreach ($q_program->result_array() as $k_program => $v_program) {
            $kumpul_program[$v_program['kode_program']] = $v_program['nama_program'];
        }


        $kumpul_kegiatan = [];
        $q_kegiatan = $this->db->query("SELECT kode_kegiatan, nama_kegiatan from master_kegiatan");
        foreach ($q_kegiatan->result_array() as $k_kegiatan => $v_kegiatan) {
            $kumpul_kegiatan[$v_kegiatan['kode_kegiatan']] = $v_kegiatan['nama_kegiatan'];
        }


        $kumpul_pptk = [];
        $q_pptk = $this->db->query("SELECT mu.full_name, usk.kode_rekening_sub_kegiatan from users_sub_kegiatan usk
            left join master_users mu on usk.id_user = mu.id_user
            where usk.tahun_anggaran='$tahun' and usk.kode_tahap='$tahap' and usk.id_instansi='$id_instansi'
            ");
        foreach ($q_pptk->result_array() as $k_pptk => $v_pptk) {
            $kumpul_pptk[$v_pptk['kode_rekening_sub_kegiatan']] = $v_pptk['full_name'];
          }


          $kumpul_pagu = [];

          if($kode_tahap==2){

            $q_pagu = $this->db->query("SELECT kode_sub_kegiatan,
            bo_bp , bo_bbj , bo_bs , bo_bh , bm_bmt , bm_bmpm , bm_bmgb , bm_bmjji , bm_bmatl , btt , bt_bbh , bt_bbk , pergeseran_ke
            from anggaran_sub_kegiatan
            where tahun='$tahun' and kode_tahap='$tahap' and id_instansi='$id_instansi'
            ");
          }
         else{
            $q_pagu = $this->db->query("SELECT kode_sub_kegiatan,
            bo_bp , bo_bbj , bo_bs , bo_bh , bm_bmt , bm_bmpm , bm_bmgb , bm_bmjji , bm_bmatl , btt , bt_bbh , bt_bbk , pergeseran_ke
            from anggaran_sub_kegiatan_tambahan
            where tahun='$tahun' and status='1' and id_instansi='$id_instansi' and id_tambahan_anggaran='$id_tambahan_anggaran'
            ");
          }


        $total_pagu_semua = 0;
        foreach ($q_pagu->result_array() as $k_pagu => $v_pagu) {
            $pagu_total = $v_pagu['bo_bp'] + $v_pagu['bo_bbj'] + $v_pagu['bo_bs'] + $v_pagu['bo_bh'] + $v_pagu['bm_bmt'] + $v_pagu['bm_bmpm'] + $v_pagu['bm_bmgb'] + $v_pagu['bm_bmjji'] + $v_pagu['bm_bmatl'] + $v_pagu['btt'] + $v_pagu['bt_bbh'] + $v_pagu['bt_bbk'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bo_bp'] = $v_pagu['bo_bp'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bo_bbj'] = $v_pagu['bo_bbj'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bo_bs'] = $v_pagu['bo_bs'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bo_bh'] = $v_pagu['bo_bh'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bm_bmt'] = $v_pagu['bm_bmt'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bm_bmpm'] = $v_pagu['bm_bmpm'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bm_bmgb'] = $v_pagu['bm_bmgb'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bm_bmjji'] = $v_pagu['bm_bmjji'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bm_bmatl'] = $v_pagu['bm_bmatl'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['btt'] = $v_pagu['btt'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bt_bbh'] = $v_pagu['bt_bbh'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['bt_bbk'] = $v_pagu['bt_bbk'];
            $kumpul_pagu[$v_pagu['kode_sub_kegiatan']][$v_pagu['pergeseran_ke']]['pagu_total'] = $pagu_total;
          }


    foreach ($sub_kegiatan->result_array() as $key => $value_sk) {
            $total_pagu_semua += $value_sk['pagu'];
    }

    foreach ($sub_kegiatan->result() as $key => $value_sk) {
      $no_sub_kegiatan++;
      $kategori_sub_kegiatan = $value_sk->kategori;
      $tahap = $value_sk->kode_tahap;

      $total_pagu_sub_kegiatan_instansi +=$value_sk->pagu ;
          if($kategori_sub_kegiatan =='Unit Pelaksana'){
            $nama_sub_kegiatan = $value_sk->nama_sub_kegiatan."<br>[".$value_sk->jenis_sub_kegiatan.' - '.$value_sk->keterangan."]";
          }else{
            $nama_sub_kegiatan = $value_sk->nama_sub_kegiatan;
          }

        // $gagu_kegiatan = $synchronize->get_pagu($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $value_sk->kode_tahap, $value_sk->tahun)->result_array();
        $target = $synchronize->get_target_tambahan($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $value_sk->kode_tahap, $value_sk->tahun, $value_sk->pergeseran_ke, $id_tambahan_anggaran)->result_array();
        $realisasi_keuangan = $synchronize->get_realisasi_keuangan_Tambahan($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $tahun, $tahap, $id_tambahan_anggaran)->result_array();
        $kumpul_data_realisasi_keuangan = [];
        $kumpul_sum_realisasi_bo_bp = [];
        $kumpul_sum_realisasi_bo_bbj = [];
        $kumpul_sum_realisasi_bo_bs = [];
        $kumpul_sum_realisasi_bo_bh = [];
        $kumpul_sum_realisasi_bm_bmt = [];
        $kumpul_sum_realisasi_bm_bmpm = [];
        $kumpul_sum_realisasi_bm_bmgb = [];
        $kumpul_sum_realisasi_bm_bmjji = [];
        $kumpul_sum_realisasi_bm_bmatl = [];
        $kumpul_sum_realisasi_btt = [];
        $kumpul_sum_realisasi_bt_bbh = [];
        $kumpul_sum_realisasi_bt_bbk = [];
        $kumpul_sum_realisasi_total = [];
        foreach ($realisasi_keuangan as $k_rk => $v_rk) {
           $index_bulan = $v_rk['bulan']-1;
           $kumpul_data_realisasi_keuangan[$index_bulan]['bulan'] = $v_rk['bulan'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bo_bp'] = $v_rk['realisasi_bo_bp'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bo_bbj'] = $v_rk['realisasi_bo_bbj'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bo_bs'] = $v_rk['realisasi_bo_bs'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bo_bh'] = $v_rk['realisasi_bo_bh'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bm_bmt'] = $v_rk['realisasi_bm_bmt'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bm_bmpm'] = $v_rk['realisasi_bm_bmpm'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bm_bmgb'] = $v_rk['realisasi_bm_bmgb'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bm_bmjji'] = $v_rk['realisasi_bm_bmjji'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bm_bmatl'] = $v_rk['realisasi_bm_bmatl'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_btt'] = $v_rk['realisasi_btt'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bt_bbh'] = $v_rk['realisasi_bt_bbh'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_bt_bbk'] = $v_rk['realisasi_bt_bbk'];
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_bulanan_total'] = $v_rk['total_realisasi'];

           array_push($kumpul_sum_realisasi_bo_bp, $v_rk['realisasi_bo_bp']);
           array_push($kumpul_sum_realisasi_bo_bbj, $v_rk['realisasi_bo_bbj']);
           array_push($kumpul_sum_realisasi_bo_bs, $v_rk['realisasi_bo_bs']);
           array_push($kumpul_sum_realisasi_bo_bh, $v_rk['realisasi_bo_bh']);
           array_push($kumpul_sum_realisasi_bm_bmt, $v_rk['realisasi_bm_bmt']);
           array_push($kumpul_sum_realisasi_bm_bmpm, $v_rk['realisasi_bm_bmpm']);
           array_push($kumpul_sum_realisasi_bm_bmgb, $v_rk['realisasi_bm_bmgb']);
           array_push($kumpul_sum_realisasi_bm_bmjji, $v_rk['realisasi_bm_bmjji']);
           array_push($kumpul_sum_realisasi_bm_bmatl, $v_rk['realisasi_bm_bmatl']);
           array_push($kumpul_sum_realisasi_btt, $v_rk['realisasi_btt']);
           array_push($kumpul_sum_realisasi_bt_bbh, $v_rk['realisasi_bt_bbh']);
           array_push($kumpul_sum_realisasi_bt_bbk, $v_rk['realisasi_bt_bbk']);
           array_push($kumpul_sum_realisasi_total, $v_rk['total_realisasi']);

           $realisasi_akumulasi_bo_bp = array_sum($kumpul_sum_realisasi_bo_bp);
           $realisasi_akumulasi_bo_bbj = array_sum($kumpul_sum_realisasi_bo_bbj);
           $realisasi_akumulasi_bo_bs = array_sum($kumpul_sum_realisasi_bo_bs);
           $realisasi_akumulasi_bo_bh = array_sum($kumpul_sum_realisasi_bo_bh);
           $realisasi_akumulasi_bm_bmt = array_sum($kumpul_sum_realisasi_bm_bmt);
           $realisasi_akumulasi_bm_bmpm = array_sum($kumpul_sum_realisasi_bm_bmpm);
           $realisasi_akumulasi_bm_bmgb = array_sum($kumpul_sum_realisasi_bm_bmgb);
           $realisasi_akumulasi_bm_bmjji = array_sum($kumpul_sum_realisasi_bm_bmjji);
           $realisasi_akumulasi_bm_bmatl = array_sum($kumpul_sum_realisasi_bm_bmatl);
           $realisasi_akumulasi_btt = array_sum($kumpul_sum_realisasi_btt);
           $realisasi_akumulasi_bt_bbh = array_sum($kumpul_sum_realisasi_bt_bbh);
           $realisasi_akumulasi_bt_bbk = array_sum($kumpul_sum_realisasi_bt_bbk);
           $realisasi_akumulasi_total = array_sum($kumpul_sum_realisasi_total);

           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bo_bp'] = $realisasi_akumulasi_bo_bp;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bo_bbj'] = $realisasi_akumulasi_bo_bbj;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bo_bs'] = $realisasi_akumulasi_bo_bs;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bo_bh'] = $realisasi_akumulasi_bo_bh;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bm_bmt'] = $realisasi_akumulasi_bm_bmt;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bm_bmpm'] = $realisasi_akumulasi_bm_bmpm;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bm_bmgb'] = $realisasi_akumulasi_bm_bmgb;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bm_bmjji'] = $realisasi_akumulasi_bm_bmjji;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bm_bmatl'] = $realisasi_akumulasi_bm_bmatl;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_btt'] = $realisasi_akumulasi_btt;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bt_bbh'] = $realisasi_akumulasi_bt_bbh;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_bt_bbk'] = $realisasi_akumulasi_bt_bbk;
           $kumpul_data_realisasi_keuangan[$index_bulan]['rp_realisasi_keuangan_akumulasi_total'] = $realisasi_akumulasi_total;

        }

          $kumpultarget = [];
          $kumpul_realisasi_keuangan = [];
          $kumpul_realisasi_fisik = [];
          $total_paket = $synchronize->get_total_paket($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $tahun, $tahap, $id_tambahan_anggaran)->num_rows();
          $jenis_rutin = $synchronize->get_total_paket_perjenis($id_instansi, $value_sk->kode_rekening_sub_kegiatan, "RUTIN", $tahun, $tahap, $id_tambahan_anggaran)->num_rows();
          
          $kumpul_rp_realisasi_keuangan_bulanan_bo_bp = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_bo_bbj = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_bo_bs = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_bo_bh = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_bm_bmt = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_bm_bmpm = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_bm_bmgb = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_bm_bmjji = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_bm_bmatl = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_btt = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_bt_bbh = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_bt_bbk = [];      
          $kumpul_rp_realisasi_keuangan_bulanan_total = [];      
          
          for ($i=0; $i <12 ; $i++) { 
            $bulan =$i+1;
            @$bobot_ski = ($value_sk->pagu / $total_pagu_semua) *100;

            if (empty($target)) {
                $kumpultarget[$i]['target_fisik_akumulasi'] = 0;
                $rp_target_keuangan = 0 ; 
                $rp_target_keuangan_bulanan = 0 ; 
                $persen_target_keuangan = 0 ; 
                $persen_target_keuangan_bulanan = 0 ; 
                $target_fisik= 0 ;
                $target_fisik_bulanan= 0 ;
                $kumpultarget[$i]['target_fisik_akumulasi'] = 0;
                $kumpultarget[$i]['target_fisik_bulanan'] = 0;
                $kumpultarget[$i]['rp_target_keuangan_akumulasi'] = 0;
                $kumpultarget[$i]['persen_target_keuangan_akumulasi'] = 0;
                $kumpultarget[$i]['rp_target_keuangan_bulanan'] = 0;
                $kumpultarget[$i]['persen_target_keuangan_bulanan'] = 0;

                 $kumpultarget[$i]['bobot_target_fisik_akumulasi'] = 0;

                $kumpultarget[$i]['bobot_target_fisik_bulanan'] = 0;

             }else{
                $rp_target_keuangan = $target[$i]['target_keuangan']=='' ? 0 : $target[$i]['target_keuangan'] ; 
                $rp_target_keuangan_bulanan = $target[$i]['target_keuangan_bulanan']=='' ? 0 : $target[$i]['target_keuangan_bulanan'] ; 

                $hitung_persen_target_keuangan = $value_sk->pagu > 0 ? ($target[$i]['target_keuangan'] / $value_sk->pagu) * 100 : 0 ;
                $hitung_persen_target_keuangan_bulanan = $value_sk->pagu > 0 ? ($target[$i]['target_keuangan_bulanan'] / $value_sk->pagu) * 100 : 0 ;

                $persen_target_keuangan = $target[$i]['target_keuangan']=='' ? 0 : $hitung_persen_target_keuangan;
                $persen_target_keuangan_bulanan = $target[$i]['target_keuangan_bulanan']=='' ? 0 : $hitung_persen_target_keuangan_bulanan;   
                $kumpultarget[$i]['target_fisik_akumulasi'] = $target[$i]['target_fisik'];
                $kumpultarget[$i]['bobot_target_fisik_akumulasi'] = $target[$i]['target_fisik'] * $bobot_ski / 100;
                $kumpultarget[$i]['target_fisik_bulanan'] = $target[$i]['target_fisik_bulanan'];
                $kumpultarget[$i]['bobot_target_fisik_bulanan'] = $target[$i]['target_fisik_bulanan'] * $bobot_ski / 100;
                $kumpultarget[$i]['rp_target_keuangan_akumulasi'] = $rp_target_keuangan;
                $kumpultarget[$i]['persen_target_keuangan_akumulasi'] = $persen_target_keuangan;
                $kumpultarget[$i]['rp_target_keuangan_bulanan'] = $rp_target_keuangan_bulanan;
                $kumpultarget[$i]['persen_target_keuangan_bulanan'] = $persen_target_keuangan_bulanan;
                $target_fisik =  $kumpultarget[$i]['target_fisik_akumulasi'] ;//= $target[$i]['target_fisik'];
                $target_fisik_bulanan =  $kumpultarget[$i]['target_fisik_bulanan'] ;//= $target[$i]['target_fisik_bulanan'];
             }

             if (empty($realisasi_keuangan)) {
                  $kumpul_realisasi_keuangan[$i]['bulan'] = $bulan;

                    $rp_realisasi_keuangan_bulanan_bo_bp=0;
                    $rp_realisasi_keuangan_bulanan_bo_bbj=0;
                    $rp_realisasi_keuangan_bulanan_bo_bs=0;
                    $rp_realisasi_keuangan_bulanan_bo_bh=0;
                    $rp_realisasi_keuangan_bulanan_bm_bmt=0;
                    $rp_realisasi_keuangan_bulanan_bm_bmpm=0;
                    $rp_realisasi_keuangan_bulanan_bm_bmgb=0;
                    $rp_realisasi_keuangan_bulanan_bm_bmjji=0;
                    $rp_realisasi_keuangan_bulanan_bm_bmatl=0;
                    $rp_realisasi_keuangan_bulanan_btt=0;
                    $rp_realisasi_keuangan_bulanan_bt_bbh=0;
                    $rp_realisasi_keuangan_bulanan_bt_bbk=0;
                    $rp_realisasi_keuangan_bulanan_total=0;
                    $persen_realisasi_keuangan_bulanan_total = 0;

                    $rp_realisasi_keuangan_akumulasi_bo_bp=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bp'];
                    $rp_realisasi_keuangan_akumulasi_bo_bbj=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bbj'];
                    $rp_realisasi_keuangan_akumulasi_bo_bs=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bs'];
                    $rp_realisasi_keuangan_akumulasi_bo_bh=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bh'];
                    $rp_realisasi_keuangan_akumulasi_bm_bmt=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmt'];
                    $rp_realisasi_keuangan_akumulasi_bm_bmpm=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmpm'];
                    $rp_realisasi_keuangan_akumulasi_bm_bmgb=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmgb'];
                    $rp_realisasi_keuangan_akumulasi_bm_bmjji=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmjji'];
                    $rp_realisasi_keuangan_akumulasi_bm_bmatl=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmatl'];
                    $rp_realisasi_keuangan_akumulasi_btt=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_btt'];
                    $rp_realisasi_keuangan_akumulasi_bt_bbh=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bt_bbh'];
                    $rp_realisasi_keuangan_akumulasi_bt_bbk=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bt_bbh'];
                    $rp_realisasi_keuangan_akumulasi_total=0;//$kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bt_bbk'];
             }else{

                if (isset($kumpul_data_realisasi_keuangan[$i])) {
                    $kumpul_realisasi_keuangan[$i]['bulan'] = $kumpul_data_realisasi_keuangan[$i]['bulan'];
                    $rp_realisasi_keuangan_bulanan_bo_bp = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bo_bp'];
                    $rp_realisasi_keuangan_bulanan_bo_bbj = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bo_bbj'];
                    $rp_realisasi_keuangan_bulanan_bo_bs = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bo_bs'];
                    $rp_realisasi_keuangan_bulanan_bo_bh = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bo_bh'];
                    $rp_realisasi_keuangan_bulanan_bm_bmt = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bm_bmt'];
                    $rp_realisasi_keuangan_bulanan_bm_bmpm = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bm_bmpm'];
                    $rp_realisasi_keuangan_bulanan_bm_bmgb = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bm_bmgb'];
                    $rp_realisasi_keuangan_bulanan_bm_bmjji = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bm_bmjji'];
                    $rp_realisasi_keuangan_bulanan_bm_bmatl = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bm_bmatl'];
                    $rp_realisasi_keuangan_bulanan_btt = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_btt'];
                    $rp_realisasi_keuangan_bulanan_bt_bbh = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bt_bbh'];
                    $rp_realisasi_keuangan_bulanan_bt_bbk = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bt_bbk'];
                    $rp_realisasi_keuangan_bulanan_total = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_total'];


                    $rp_realisasi_keuangan_akumulasi_bo_bp = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bp'];
                    $rp_realisasi_keuangan_akumulasi_bo_bbj = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bbj'];
                    $rp_realisasi_keuangan_akumulasi_bo_bs = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bs'];
                    $rp_realisasi_keuangan_akumulasi_bo_bh = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bh'];
                    $rp_realisasi_keuangan_akumulasi_bm_bmt = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmt'];
                    $rp_realisasi_keuangan_akumulasi_bm_bmpm = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmpm'];
                    $rp_realisasi_keuangan_akumulasi_bm_bmgb = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmgb'];
                    $rp_realisasi_keuangan_akumulasi_bm_bmjji = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmjji'];
                    $rp_realisasi_keuangan_akumulasi_bm_bmatl = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmatl'];
                    $rp_realisasi_keuangan_akumulasi_btt = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_btt'];
                    $rp_realisasi_keuangan_akumulasi_bt_bbh = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bt_bbh'];
                    $rp_realisasi_keuangan_akumulasi_bt_bbk = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bt_bbk'];
                    $rp_realisasi_keuangan_akumulasi_total = $kumpul_data_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_total'];

                }else{
                    $kumpul_realisasi_keuangan[$i]['bulan'] = $bulan;
                    $rp_realisasi_keuangan_bulanan_bo_bp = 0;
                    $rp_realisasi_keuangan_bulanan_bo_bbj = 0;
                    $rp_realisasi_keuangan_bulanan_bo_bs = 0;
                    $rp_realisasi_keuangan_bulanan_bo_bh = 0;
                    $rp_realisasi_keuangan_bulanan_bm_bmt = 0;
                    $rp_realisasi_keuangan_bulanan_bm_bmpm = 0;
                    $rp_realisasi_keuangan_bulanan_bm_bmgb = 0;
                    $rp_realisasi_keuangan_bulanan_bm_bmjji = 0;
                    $rp_realisasi_keuangan_bulanan_bm_bmatl = 0;
                    $rp_realisasi_keuangan_bulanan_btt = 0;
                    $rp_realisasi_keuangan_bulanan_bt_bbh = 0;
                    $rp_realisasi_keuangan_bulanan_bt_bbk = 0;
                    $rp_realisasi_keuangan_bulanan_total = 0;
                    $persen_realisasi_keuangan_bulanan_total = 0;
                    # code...

                    $rp_realisasi_keuangan_akumulasi_bo_bp = 0;
                    $rp_realisasi_keuangan_akumulasi_bo_bbj = 0;
                    $rp_realisasi_keuangan_akumulasi_bo_bs = 0;
                    $rp_realisasi_keuangan_akumulasi_bo_bh = 0;
                    $rp_realisasi_keuangan_akumulasi_bm_bmt = 0;
                    $rp_realisasi_keuangan_akumulasi_bm_bmpm = 0;
                    $rp_realisasi_keuangan_akumulasi_bm_bmgb = 0;
                    $rp_realisasi_keuangan_akumulasi_bm_bmjji = 0;
                    $rp_realisasi_keuangan_akumulasi_bm_bmatl = 0;
                    $rp_realisasi_keuangan_akumulasi_btt = 0;
                    $rp_realisasi_keuangan_akumulasi_bt_bbh = 0;
                    $rp_realisasi_keuangan_akumulasi_bt_bbk = 0;
                    $rp_realisasi_keuangan_akumulasi_total = 0;
                    $persen_realisasi_keuangan_akumulasi_total = 0;

                }
            }
                    


                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bo_bp'] = $rp_realisasi_keuangan_bulanan_bo_bp;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bo_bbj'] = $rp_realisasi_keuangan_bulanan_bo_bbj;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bo_bs'] = $rp_realisasi_keuangan_bulanan_bo_bs;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bo_bh'] = $rp_realisasi_keuangan_bulanan_bo_bh;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bm_bmt'] = $rp_realisasi_keuangan_bulanan_bm_bmt;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bm_bmpm'] = $rp_realisasi_keuangan_bulanan_bm_bmpm;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bm_bmgb'] = $rp_realisasi_keuangan_bulanan_bm_bmgb;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bm_bmjji'] = $rp_realisasi_keuangan_bulanan_bm_bmjji;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bm_bmatl'] = $rp_realisasi_keuangan_bulanan_bm_bmatl;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_btt'] = $rp_realisasi_keuangan_bulanan_btt;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bt_bbh'] = $rp_realisasi_keuangan_bulanan_bt_bbh;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_bt_bbk'] = $rp_realisasi_keuangan_bulanan_bt_bbk;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_bulanan_total'] = $rp_realisasi_keuangan_bulanan_total;
                    $persen_realisasi_keuangan_bulanan_total = $value_sk->pagu > 0 ? $rp_realisasi_keuangan_bulanan_total / $value_sk->pagu * 100 : 0 ; 
                    $kumpul_realisasi_keuangan[$i]['persen_realisasi_keuangan_bulanan_total'] = $persen_realisasi_keuangan_bulanan_total;

                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bo_bp, $rp_realisasi_keuangan_bulanan_bo_bp);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bo_bbj, $rp_realisasi_keuangan_bulanan_bo_bbj);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bo_bs, $rp_realisasi_keuangan_bulanan_bo_bs);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bo_bh, $rp_realisasi_keuangan_bulanan_bo_bh);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bm_bmt, $rp_realisasi_keuangan_bulanan_bm_bmt);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bm_bmpm, $rp_realisasi_keuangan_bulanan_bm_bmpm);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bm_bmgb, $rp_realisasi_keuangan_bulanan_bm_bmgb);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bm_bmjji, $rp_realisasi_keuangan_bulanan_bm_bmjji);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bm_bmatl, $rp_realisasi_keuangan_bulanan_bm_bmatl);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_btt, $rp_realisasi_keuangan_bulanan_btt);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bt_bbh, $rp_realisasi_keuangan_bulanan_bt_bbh);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_bt_bbk, $rp_realisasi_keuangan_bulanan_bt_bbk);
                    array_push($kumpul_rp_realisasi_keuangan_bulanan_total, $rp_realisasi_keuangan_bulanan_total);

                    $rp_realisasi_keuangan_akumulasi_bo_bp = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bo_bp);
                    $rp_realisasi_keuangan_akumulasi_bo_bbj = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bo_bbj);
                    $rp_realisasi_keuangan_akumulasi_bo_bs = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bo_bs);
                    $rp_realisasi_keuangan_akumulasi_bo_bh = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bo_bh);
                    $rp_realisasi_keuangan_akumulasi_bm_bmt = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bm_bmt);
                    $rp_realisasi_keuangan_akumulasi_bm_bmpm = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bm_bmpm);
                    $rp_realisasi_keuangan_akumulasi_bm_bmgb = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bm_bmgb);
                    $rp_realisasi_keuangan_akumulasi_bm_bmjji = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bm_bmjji);
                    $rp_realisasi_keuangan_akumulasi_bm_bmatl = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bm_bmatl);
                    $rp_realisasi_keuangan_akumulasi_btt = array_sum($kumpul_rp_realisasi_keuangan_bulanan_btt);
                    $rp_realisasi_keuangan_akumulasi_bt_bbh = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bt_bbh);
                    $rp_realisasi_keuangan_akumulasi_bt_bbk = array_sum($kumpul_rp_realisasi_keuangan_bulanan_bt_bbk);
                    $rp_realisasi_keuangan_akumulasi_total = array_sum($kumpul_rp_realisasi_keuangan_bulanan_total);

                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bp'] = $rp_realisasi_keuangan_akumulasi_bo_bp;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bbj'] = $rp_realisasi_keuangan_akumulasi_bo_bbj;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bs'] = $rp_realisasi_keuangan_akumulasi_bo_bs;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bo_bh'] = $rp_realisasi_keuangan_akumulasi_bo_bh;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmt'] = $rp_realisasi_keuangan_akumulasi_bm_bmt;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmpm'] = $rp_realisasi_keuangan_akumulasi_bm_bmpm;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmgb'] = $rp_realisasi_keuangan_akumulasi_bm_bmgb;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmjji'] = $rp_realisasi_keuangan_akumulasi_bm_bmjji;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bm_bmatl'] = $rp_realisasi_keuangan_akumulasi_bm_bmatl;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_btt'] = $rp_realisasi_keuangan_akumulasi_btt;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bt_bbh'] = $rp_realisasi_keuangan_akumulasi_bt_bbh;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_bt_bbk'] = $rp_realisasi_keuangan_akumulasi_bt_bbk;
                    $kumpul_realisasi_keuangan[$i]['rp_realisasi_keuangan_akumulasi_total'] = $rp_realisasi_keuangan_akumulasi_total;
                    $persen_realisasi_keuangan_akumulasi_total = $value_sk->pagu > 0 ? $rp_realisasi_keuangan_akumulasi_total / $value_sk->pagu * 100 : 0 ; 
                    $kumpul_realisasi_keuangan[$i]['persen_realisasi_keuangan_akumulasi_total'] = $persen_realisasi_keuangan_akumulasi_total;

                    //  
                    $rp_realisasi_keuangan_akumulasi = $rp_realisasi_keuangan_akumulasi_bo_bp + $rp_realisasi_keuangan_akumulasi_bo_bbj + $rp_realisasi_keuangan_akumulasi_bo_bs + $rp_realisasi_keuangan_akumulasi_bo_bh + $rp_realisasi_keuangan_akumulasi_bm_bmt + $rp_realisasi_keuangan_akumulasi_bm_bmpm + $rp_realisasi_keuangan_akumulasi_bm_bmgb + $rp_realisasi_keuangan_akumulasi_bm_bmjji + $rp_realisasi_keuangan_akumulasi_bm_bmatl + $rp_realisasi_keuangan_akumulasi_btt + $rp_realisasi_keuangan_akumulasi_bt_bbh + $rp_realisasi_keuangan_akumulasi_bt_bbk;

                    $rp_realisasi_keuangan_bulanan = $rp_realisasi_keuangan_bulanan_bo_bp + $rp_realisasi_keuangan_bulanan_bo_bbj + $rp_realisasi_keuangan_bulanan_bo_bs + $rp_realisasi_keuangan_bulanan_bo_bh + $rp_realisasi_keuangan_bulanan_bm_bmt + $rp_realisasi_keuangan_bulanan_bm_bmpm + $rp_realisasi_keuangan_bulanan_bm_bmgb + $rp_realisasi_keuangan_bulanan_bm_bmjji + $rp_realisasi_keuangan_bulanan_bm_bmatl + $rp_realisasi_keuangan_bulanan_btt + $rp_realisasi_keuangan_bulanan_bt_bbh + $rp_realisasi_keuangan_bulanan_bt_bbk;

                    if($value_sk->pagu==0){
                        $persen_realisasi_keuangan_akumulasi = 0; 
                        $persen_realisasi_keuangan_bulanan = 0; 
                    }else{
                        $persen_realisasi_keuangan_akumulasi = $rp_realisasi_keuangan_akumulasi / $value_sk->pagu * 100 ; 
                        $persen_realisasi_keuangan_bulanan = $rp_realisasi_keuangan_bulanan / $value_sk->pagu * 100 ; 
                    }
             
             
                    $swa = $synchronize->get_realisasi_fisik_tambahan($id_instansi, $value_sk->kode_rekening_sub_kegiatan, 'SWAKELOLA', $tahun, $tahap , $bulan, $id_tambahan_anggaran);
                    $pen = $synchronize->get_realisasi_fisik_tambahan($id_instansi, $value_sk->kode_rekening_sub_kegiatan,'PENYEDIA', $tahun, $tahap , $bulan, $id_tambahan_anggaran);


                    $swa_akumulasi = $swa['akumulasi'];
                    $swa_bulanan = $swa['bulanan'];
                    $pen_akumulasi = $pen['akumulasi'];
                    $pen_bulanan = $pen['bulanan'];



                    $nilai_rf_rutin_akumulasi = $persen_realisasi_keuangan_akumulasi > 90 ? 100 : $persen_realisasi_keuangan_akumulasi;
                    $nilai_rf_rutin_bulanan = $persen_realisasi_keuangan_bulanan > 90 ? 100 : $persen_realisasi_keuangan_bulanan;


           if ($tahun==2023) {
               $nilai_rf_rutin_akumulasi = $persen_realisasi_keuangan_akumulasi > 90 ? 100 : $persen_realisasi_keuangan_akumulasi;
               $nilai_rf_rutin_bulanan = $persen_realisasi_keuangan_bulanan > 90 ? 100 : $persen_realisasi_keuangan_bulanan;
           }else{
                $f_rutin = $synchronize->get_realisasi_fisik_tambahan($id_instansi, $value_sk->kode_rekening_sub_kegiatan,'RUTIN', $tahun, $tahap , $bulan, $id_tambahan_anggaran);
                $nilai_rf_rutin_akumulasi = $f_rutin['akumulasi'];
                $nilai_rf_rutin_bulanan = $f_rutin['bulanan'];

           }


                    $rutin_akumulasi = $jenis_rutin > 0 ? $nilai_rf_rutin_akumulasi : 0;  
                    $rutin_bulanan = $jenis_rutin > 0 ?  $nilai_rf_rutin_bulanan : 0 ;

                    if($total_paket==0){
                        $fisik_kegiatan_akumulasi = 0;
                        $fisik_kegiatan_bulanan = 0;
                    }else{
                        $jumlah_fisik_per_kegiatan_akumulasi = ($swa_akumulasi + $pen_akumulasi + ($rutin_akumulasi * $jenis_rutin)) / $total_paket;
                        $fisik_kegiatan_akumulasi  = $jumlah_fisik_per_kegiatan_akumulasi > 100 ? 100 : $jumlah_fisik_per_kegiatan_akumulasi;
                        $jumlah_fisik_per_kegiatan_bulanan = ($swa_bulanan + $pen_bulanan + ($rutin_bulanan * $jenis_rutin)) / $total_paket;
                        $fisik_kegiatan_bulanan  = $jumlah_fisik_per_kegiatan_bulanan > 100 ? 100 : $jumlah_fisik_per_kegiatan_bulanan;
                    }





          // $total_realisasi_fisik    = $total_fisik > 100 ? 100 : $total_fisik;


                    $realisasi_fisik = [
                      'bulan'=>$bulan,
                      'total_paket'=>$total_paket,

                      'akumulasi'=>$fisik_kegiatan_akumulasi,
                      'bobot_akumulasi'=>($fisik_kegiatan_akumulasi * $bobot_ski) / 100,
                      'bulanan'=>$fisik_kegiatan_bulanan,
                      'bobot_bulanan'=>($fisik_kegiatan_bulanan * $bobot_ski) / 100,
                    ];
                     array_push($kumpul_realisasi_fisik, $realisasi_fisik);
        }
        // end for ($i=0; $i <12 ; $i++) { 
        // echo json_encode($kumpul_realisasi_fisik);

         $data_kumpul_sub_kegiatan = [
          'identitas'=> [
            'pt'=> $total_pagu_semua,
            'bobot'=> $bobot_ski,
            'id_instansi'=> $value_sk->id_instansi,
            'tahun'=> $value_sk->tahun,
            'bulan'=> $bulan,
            'kode_tahap'=> $value_sk->kode_tahap,
            'kode_kegiatan'=> $value_sk->kode_rekening_kegiatan,
            'nama_kegiatan'=> @$kumpul_kegiatan[$value_sk->kode_rekening_kegiatan],
            'kode_program'=> $value_sk->kode_rekening_program,
            'nama_program'=> @$kumpul_program[$value_sk->kode_rekening_program],
            'kode_sub_kegiatan'=> $value_sk->kode_rekening_sub_kegiatan,
            'nama_sub_kegiatan'=> $nama_sub_kegiatan,

            'kategori'=> $value_sk->kategori,
            'tambahan_kode_sub_kegiatan'=> $value_sk->tambahan_kode_sub_kegiatan,
            'input_by_tambahan_kode_sub_kegiatan'=> $value_sk->input_by_tambahan_kode_sub_kegiatan,
            'jenis_sub_kegiatan'=> $value_sk->jenis_sub_kegiatan,
            'id_instansi_pembantu_teknis'=> $value_sk->id_instansi_pembantu_teknis,
            'keterangan'=> $value_sk->keterangan,
            'status_sub_kegiatan'=> $value_sk->status,
            'pptk'=> @$kumpul_pptk[$value_sk->kode_rekening_sub_kegiatan],
          ],
          
          'pagu'=> @$kumpul_pagu[$value_sk->kode_rekening_sub_kegiatan],
          'pergeseran_ke'=>  $value_sk->pergeseran_ke,
          'target'=> $kumpultarget,
          'realisasi_keuangan'=> $kumpul_realisasi_keuangan,
          'realisasi_fisik'=> $kumpul_realisasi_fisik,
         ];
         array_push($kumpul_sub_kegiatan, $data_kumpul_sub_kegiatan);




        } // end foreach ($sub_kegiatan->result() as $key => $value_sk) {

     
        $pecahkan_kembali = [];
        $kumpul_laporan_akhir_opd = [];
        $banyak_sub_kegiatan = count($kumpul_sub_kegiatan);


        for ($i=0; $i < 12; $i++) { 
          $bulan = $i+1;
          $target_fisik_akumulasi = 0 ;
          $target_fisik_bulanan = 0 ;
          $realisasi_fisik_akumulasi = 0 ;
          $realisasi_fisik_bulanan = 0 ;
          $bobot_ski_total = 0;
          $bobot_tf_akumulasi_total = 0;
          $bobot_rf_akumulasi_total = 0;
          $bobot_tf_bulanan_total = 0;
          $bobot_rf_bulanan_total = 0;

          $target_keuangan_akumulasi = 0 ;
          $target_keuangan_bulanan = 0 ;
          $realisasi_keuangan_akumulasi = 0 ;
          $realisasi_keuangan_bulanan = 0 ;

          $pagu_bo_bp = 0 ;
          $pagu_bo_bbj = 0 ;
          $pagu_bo_bs = 0 ;
          $pagu_bo_bh = 0 ;
          $pagu_bo_bbs = 0 ;
          $pagu_bm_bmt = 0 ;
          $pagu_bm_bmpm = 0 ;
          $pagu_bm_bmgb = 0 ;
          $pagu_bm_bmjji = 0 ;
          $pagu_bm_bmatl = 0 ;
          $pagu_bm_bmatb = 0 ;
          $pagu_btt = 0 ;
          $pagu_bt_bbh = 0 ;
          $pagu_bt_bbk = 0 ;
              $pagu_total = 0 ;
              $rp_target_keuangan_akumulasi = 0 ;
          $rp_target_keuangan_bulanan = 0 ;
          $rp_realisasi_keuangan_akumulasi = 0 ;
          $rp_realisasi_keuangan_akumulasi_bo_bp = 0 ;
          $rp_realisasi_keuangan_akumulasi_bo_bbj = 0 ;
          $rp_realisasi_keuangan_akumulasi_bo_bs = 0 ;
          $rp_realisasi_keuangan_akumulasi_bo_bh = 0 ;
          $rp_realisasi_keuangan_akumulasi_bo_bbs = 0 ;
          $rp_realisasi_keuangan_akumulasi_bm_bmt = 0 ;
          $rp_realisasi_keuangan_akumulasi_bm_bmpm = 0 ;
          $rp_realisasi_keuangan_akumulasi_bm_bmgb = 0 ;
          $rp_realisasi_keuangan_akumulasi_bm_bmjji = 0 ;
          $rp_realisasi_keuangan_akumulasi_bm_bmatl = 0 ;
          $rp_realisasi_keuangan_akumulasi_bm_bmatb = 0 ;
          $rp_realisasi_keuangan_akumulasi_btt = 0 ;
          $rp_realisasi_keuangan_akumulasi_bt_bbh = 0 ;
          $rp_realisasi_keuangan_akumulasi_bt_bbk = 0 ;
          $rp_realisasi_keuangan_bulanan = 0 ;
          $rp_realisasi_keuangan_bulanan_bo_bp = 0 ;
          $rp_realisasi_keuangan_bulanan_bo_bbj = 0 ;
          $rp_realisasi_keuangan_bulanan_bo_bs = 0 ;
          $rp_realisasi_keuangan_bulanan_bo_bh = 0 ;
          $rp_realisasi_keuangan_bulanan_bo_bbs = 0 ;
          $rp_realisasi_keuangan_bulanan_bm_bmt = 0 ;
          $rp_realisasi_keuangan_bulanan_bm_bmpm = 0 ;
          $rp_realisasi_keuangan_bulanan_bm_bmgb = 0 ;
          $rp_realisasi_keuangan_bulanan_bm_bmjji = 0 ;
          $rp_realisasi_keuangan_bulanan_bm_bmatl = 0 ;
          $rp_realisasi_keuangan_bulanan_bm_bmatb = 0 ;
          $rp_realisasi_keuangan_bulanan_btt = 0 ;
          $rp_realisasi_keuangan_bulanan_bt_bbh = 0 ;
          $rp_realisasi_keuangan_bulanan_bt_bbk  = 0 ;




            // echo "Bulan : ".$bulan.'<br>';

            // echo "<table border =1 style='border-collapse:collapse'>";
            // echo "<tr>
            //     <td>Krsk</td>
            //     <td>Pagu</td>
            //     <td>Rp TK</td>
            //     <td>% TK</td>
            //     <td>Ditemukan</td>
            // </tr>";
          foreach($kumpul_sub_kegiatan as $k => $v){
            //    echo "<tr>
            //     <td>".$v['identitas']['kode_sub_kegiatan']."</td>
            //     <td align='right'>".number_format($v['pagu']['pagu_total'])."</td>
            //     <td align='right'>".number_format($v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_total'])."</td>
            //     <td align='right'>".$v['target'][$i]['persen_target_keuangan_akumulasi']."</td>
            //     <td align='right'>".($v['target'][$i]['persen_target_keuangan_akumulasi'] > 100 ? 'Lebih' : '')."</td>
            // </tr>";


              $data = [
                'id_instansi' => $id_instansi,
                'bulan' => $bulan,
                'kode_tahap' => $kode_tahap, //$v['identitas']['kode_tahap'],
                'tahun' => $v['identitas']['tahun'],
                'kode_sub_kegiatan' => $v['identitas']['kode_sub_kegiatan'],
                'nama_sub_kegiatan' => $v['identitas']['nama_sub_kegiatan'],
                'kode_kegiatan' => $v['identitas']['kode_kegiatan'],
                'nama_kegiatan' => $v['identitas']['nama_kegiatan'],
                'kode_program' => $v['identitas']['kode_program'],
                'nama_program' => $v['identitas']['nama_program'],
                'kategori' => $v['identitas']['kategori'],
                'tambahan_kode_sub_kegiatan' => $v['identitas']['tambahan_kode_sub_kegiatan'],
                'input_by_tambahan_kode_sub_kegiatan' => $v['identitas']['input_by_tambahan_kode_sub_kegiatan'],
                'jenis_sub_kegiatan' => $v['identitas']['jenis_sub_kegiatan'],
                'id_instansi_pembantu_teknis' => $v['identitas']['id_instansi_pembantu_teknis'],
                'keterangan' => $v['identitas']['keterangan'],
                'status_sub_kegiatan' => $v['identitas']['status_sub_kegiatan'],
                'pptk' => $v['identitas']['pptk'],


                'target_fisik_akumulasi' => $v['target'][$i]['target_fisik_akumulasi'],
                // 'bobot_target_fisik_akumulasi' => $v['target'][$i]['bobot_target_fisik_akumulasi'],
                'target_fisik_akumulasi_ratarata' => '????',
                'target_fisik_bulanan' => $v['target'][$i]['target_fisik_bulanan'],
                // 'bobot_target_fisik_bulanan' => $v['target'][$i]['bobot_target_fisik_bulanan'],
                'target_fisik_bulanan_ratarata' => '????',

                'realisasi_fisik_akumulasi' => $v['realisasi_fisik'][$i]['akumulasi'],
                // 'bobot_realisasi_fisik_akumulasi' => $v['realisasi_fisik'][$i]['akumulasi'],
                'realisasi_fisik_akumulasi_ratarata' => '????',
                'realisasi_fisik_bulanan' => $v['realisasi_fisik'][$i]['bulanan'],
                // 'bobot_realisasi_fisik_bulanan' => $v['realisasi_fisik'][$i]['akumulasi'],
                'realisasi_fisik_bulanan_ratarata' => '????',

                'target_keuangan_akumulasi' => $v['target'][$i]['persen_target_keuangan_akumulasi'],
                'target_keuangan_akumulasi_ratarata' => '????',
                'target_keuangan_bulanan' => $v['target'][$i]['persen_target_keuangan_bulanan'],
                'target_keuangan_bulanan_ratarata' => '????',

                'realisasi_keuangan_akumulasi' => $v['realisasi_keuangan'][$i]['persen_realisasi_keuangan_akumulasi_total'],
                'realisasi_keuangan_akumulasi_ratarata' => '????',
                'realisasi_keuangan_bulanan' => $v['realisasi_keuangan'][$i]['persen_realisasi_keuangan_bulanan_total'],
                'realisasi_keuangan_bulanan_ratarata' => '????',



                'pagu_bo_bp' => $v['pagu'][$v['pergeseran_ke']]['bo_bp'],
                'pagu_bo_bbj' => $v['pagu'][$v['pergeseran_ke']]['bo_bbj'],
                'pagu_bo_bs' => $v['pagu'][$v['pergeseran_ke']]['bo_bs'],
                'pagu_bo_bh' => $v['pagu'][$v['pergeseran_ke']]['bo_bh'],
                'pagu_bm_bmt' => $v['pagu'][$v['pergeseran_ke']]['bm_bmt'],
                'pagu_bm_bmpm' => $v['pagu'][$v['pergeseran_ke']]['bm_bmpm'],
                'pagu_bm_bmgb' => $v['pagu'][$v['pergeseran_ke']]['bm_bmgb'],
                'pagu_bm_bmjji' => $v['pagu'][$v['pergeseran_ke']]['bm_bmjji'],
                'pagu_bm_bmatl' => $v['pagu'][$v['pergeseran_ke']]['bm_bmatl'],
                'pagu_btt' => $v['pagu'][$v['pergeseran_ke']]['btt'],
                'pagu_bt_bbh' => $v['pagu'][$v['pergeseran_ke']]['bt_bbh'],
                'pagu_bt_bbk' => $v['pagu'][$v['pergeseran_ke']]['bt_bbk'],
                'pagu_total' => $v['pagu'][$v['pergeseran_ke']]['pagu_total'],


                'rp_target_keuangan_akumulasi' =>  $v['target'][$i]['rp_target_keuangan_akumulasi'],
                'rp_target_keuangan_bulanan' => $v['target'][$i]['rp_target_keuangan_bulanan'],

                'rp_realisasi_keuangan_akumulasi' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_total'],
                'rp_realisasi_keuangan_akumulasi_bo_bp' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bo_bp'],
                'rp_realisasi_keuangan_akumulasi_bo_bbj' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bo_bbj'],
                'rp_realisasi_keuangan_akumulasi_bo_bs' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bo_bs'],
                'rp_realisasi_keuangan_akumulasi_bo_bh' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bo_bh'],
                // 'rp_realisasi_keuangan_akumulasi_bo_bbs' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bo_bbs'],
                'rp_realisasi_keuangan_akumulasi_bm_bmt' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmt'],
                'rp_realisasi_keuangan_akumulasi_bm_bmpm' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmpm'],
                'rp_realisasi_keuangan_akumulasi_bm_bmgb' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmgb'],
                'rp_realisasi_keuangan_akumulasi_bm_bmjji' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmjji'],
                'rp_realisasi_keuangan_akumulasi_bm_bmatl' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmatl'],
                // 'rp_realisasi_keuangan_akumulasi_bm_bmatb' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmatb'],
                'rp_realisasi_keuangan_akumulasi_btt' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_btt'],
                'rp_realisasi_keuangan_akumulasi_bt_bbh' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bt_bbh'],
                'rp_realisasi_keuangan_akumulasi_bt_bbk' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bt_bbk'],

                'rp_realisasi_keuangan_bulanan' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_total'],
                'rp_realisasi_keuangan_bulanan_bo_bp' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bo_bp'],
                'rp_realisasi_keuangan_bulanan_bo_bbj' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bo_bbj'],
                'rp_realisasi_keuangan_bulanan_bo_bs' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bo_bs'],
                'rp_realisasi_keuangan_bulanan_bo_bh' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bo_bh'],
                // 'rp_realisasi_keuangan_bulanan_bo_bbs' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bo_bbs'],
                'rp_realisasi_keuangan_bulanan_bm_bmt' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmt'],
                'rp_realisasi_keuangan_bulanan_bm_bmpm' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmpm'],
                'rp_realisasi_keuangan_bulanan_bm_bmgb' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmgb'],
                'rp_realisasi_keuangan_bulanan_bm_bmjji' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmjji'],
                'rp_realisasi_keuangan_bulanan_bm_bmatl' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmatl'],
                // 'rp_realisasi_keuangan_bulanan_bm_bmatb' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmatb'],
                'rp_realisasi_keuangan_bulanan_btt' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_btt'],
                'rp_realisasi_keuangan_bulanan_bt_bbh' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bt_bbh'],
                'rp_realisasi_keuangan_bulanan_bt_bbk' => $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bt_bbk'],
                'last_update' => timestamp(),
                'synchronize' => $input,
                
              ];

              array_push($pecahkan_kembali, $data);
              
                $target_fisik_akumulasi += $v['target'][$i]['target_fisik_akumulasi'] ;
                $target_fisik_bulanan += $v['target'][$i]['target_fisik_bulanan'] ;
                $realisasi_fisik_akumulasi += $v['realisasi_fisik'][$i]['akumulasi'] ;
                $realisasi_fisik_bulanan += $v['realisasi_fisik'][$i]['bulanan'] ;

                $bobot_ski_total += $v['identitas']['bobot'];
                $bobot_tf_akumulasi_total += $v['target'][$i]['bobot_target_fisik_akumulasi'];
                $bobot_tf_bulanan_total += $v['target'][$i]['bobot_target_fisik_bulanan'];
                $bobot_rf_akumulasi_total += $v['realisasi_fisik'][$i]['bobot_akumulasi'];
                $bobot_rf_bulanan_total += $v['realisasi_fisik'][$i]['bobot_bulanan'];

                $target_keuangan_akumulasi += $v['realisasi_keuangan'][$i]['persen_realisasi_keuangan_akumulasi_total'] ;
                $target_keuangan_bulanan += $v['realisasi_keuangan'][$i]['persen_realisasi_keuangan_bulanan_total'] ;
                $realisasi_keuangan_akumulasi += $v['realisasi_keuangan'][$i]['persen_realisasi_keuangan_akumulasi_total'];
                $realisasi_keuangan_bulanan += $v['realisasi_keuangan'][$i]['persen_realisasi_keuangan_bulanan_total'];
                
                $pagu_bo_bp += $v['pagu'][$v['pergeseran_ke']]['bo_bp'] ;
                $pagu_bo_bbj += $v['pagu'][$v['pergeseran_ke']]['bo_bbj'] ;
                $pagu_bo_bs += $v['pagu'][$v['pergeseran_ke']]['bo_bs'] ;
                $pagu_bo_bh += $v['pagu'][$v['pergeseran_ke']]['bo_bh'] ;
                $pagu_bm_bmt += $v['pagu'][$v['pergeseran_ke']]['bm_bmt'] ;
                $pagu_bm_bmpm += $v['pagu'][$v['pergeseran_ke']]['bm_bmpm'] ;
                $pagu_bm_bmgb += $v['pagu'][$v['pergeseran_ke']]['bm_bmgb'] ;
                $pagu_bm_bmjji += $v['pagu'][$v['pergeseran_ke']]['bm_bmjji'] ;
                $pagu_bm_bmatl += $v['pagu'][$v['pergeseran_ke']]['bm_bmatl'] ;
                
                $pagu_btt += $v['pagu'][$v['pergeseran_ke']]['btt'] ;
                $pagu_bt_bbh += $v['pagu'][$v['pergeseran_ke']]['bt_bbh'] ;
                $pagu_bt_bbk += $v['pagu'][$v['pergeseran_ke']]['bt_bbk'] ;
                $pagu_total += $v['pagu'][$v['pergeseran_ke']]['pagu_total'] ;

                if ($v['pagu'][$v['pergeseran_ke']]['pagu_total']>0) {
                    $rp_target_keuangan_akumulasi += $v['target'][$i]['rp_target_keuangan_akumulasi'] ;
                    $rp_target_keuangan_bulanan += $v['target'][$i]['rp_target_keuangan_bulanan'] ;
                
                $rp_realisasi_keuangan_akumulasi_bo_bp += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bo_bp'];
                $rp_realisasi_keuangan_akumulasi_bo_bbj += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bo_bbj'];
                $rp_realisasi_keuangan_akumulasi_bo_bs += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bo_bs'];
                $rp_realisasi_keuangan_akumulasi_bo_bh += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bo_bh'];
                $rp_realisasi_keuangan_akumulasi_bm_bmt += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmt'];
                $rp_realisasi_keuangan_akumulasi_bm_bmpm += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmpm'];
                $rp_realisasi_keuangan_akumulasi_bm_bmgb += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmgb'];
                $rp_realisasi_keuangan_akumulasi_bm_bmjji += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmjji'];
                $rp_realisasi_keuangan_akumulasi_bm_bmatl += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bm_bmatl'];
                $rp_realisasi_keuangan_akumulasi_btt += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_btt'];
                $rp_realisasi_keuangan_akumulasi_bt_bbh += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bt_bbh'];
                $rp_realisasi_keuangan_akumulasi_bt_bbk += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_bt_bbk'];
                $rp_realisasi_keuangan_akumulasi += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_akumulasi_total'];

                $rp_realisasi_keuangan_bulanan += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_total'];
                $rp_realisasi_keuangan_bulanan_bo_bp += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bo_bp'];
                $rp_realisasi_keuangan_bulanan_bo_bbj += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bo_bbj'];
                $rp_realisasi_keuangan_bulanan_bo_bs += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bo_bs'];
                $rp_realisasi_keuangan_bulanan_bo_bh += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bo_bh'];
                $rp_realisasi_keuangan_bulanan_bm_bmt += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmt'];
                $rp_realisasi_keuangan_bulanan_bm_bmpm += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmpm'];
                $rp_realisasi_keuangan_bulanan_bm_bmgb += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmgb'];
                $rp_realisasi_keuangan_bulanan_bm_bmjji += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmjji'];
                $rp_realisasi_keuangan_bulanan_bm_bmatl += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bm_bmatl'];
                $rp_realisasi_keuangan_bulanan_btt += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_btt'];
                $rp_realisasi_keuangan_bulanan_bt_bbh += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bt_bbh'];
                $rp_realisasi_keuangan_bulanan_bt_bbk  += $v['realisasi_keuangan'][$i]['rp_realisasi_keuangan_bulanan_bt_bbk'];
                }

            }
            //   echo "<tr>
            //     <td>Total</td>
            //     <td>".number_format($total_pagu_semua)."</td>
            //     <td>".number_format($rp_realisasi_keuangan_akumulasi)."</td>
            //     <td>".($rp_realisasi_keuangan_akumulasi / $total_pagu_semua * 100)."</td>
            // </tr>";
            // echo "</table>";
            // echo "<hr>";

            if ($pagu_total>0) {
                $persen_target_fisik_akumulasi = $target_fisik_akumulasi / $banyak_sub_kegiatan ;
                $persen_target_fisik_bulanan = $target_fisik_bulanan / $banyak_sub_kegiatan ;
                $persen_realisasi_fisik_akumulasi = $realisasi_fisik_akumulasi / $banyak_sub_kegiatan ;
                $persen_realisasi_fisik_bulanan = $realisasi_fisik_bulanan / $banyak_sub_kegiatan ;
                $persen_target_keuangan_akumulasi = ( $rp_target_keuangan_akumulasi / $pagu_total) * 100 ;
                $persen_target_keuangan_bulanan = ( $rp_target_keuangan_bulanan / $pagu_total) * 100 ;
                $persen_realisasi_keuangan_akumulasi = ($rp_realisasi_keuangan_akumulasi / $pagu_total ) * 100 ;
                $persen_realisasi_keuangan_bulanan = ($rp_realisasi_keuangan_bulanan / $pagu_total ) * 100 ;




                $laporan_akhir_opd = [
                  'id_instansi'=> $id_instansi , 
                  'kode_opd'=> $kode_opd , 
                  'bulan'=> $bulan , 
                  'kode_tahap'=> $kode_tahap , 
                  'tahun'=> $tahun , 

                  // // Referensi 
                  // // 'bobot_ski_total'=> $bobot_ski_total , 
                  // 'target_fisik_akumulasi'=> $target_fisik_akumulasi , 
                  // // 'bobot_target_fisik_akumulasi'=> $bobot_tf_akumulasi_total , 
                  // 'target_fisik_bulanan'=> $target_fisik_bulanan , 
                  // // 'bobot_target_fisik_bulanan'=> $bobot_tf_bulanan_total , 
                  // 'realisasi_fisik_akumulasi'=> $realisasi_fisik_akumulasi , 
                  // // 'bobot_realisasi_fisik_akumulasi'=> $bobot_rf_akumulasi_total , 
                  // 'realisasi_fisik_bulanan'=> $realisasi_fisik_bulanan , 
                  // // 'bobot_realisasi_fisik_bulanan'=> $bobot_rf_bulanan_total , 

                  
                  // insert db 
                  'target_fisik_akumulasi'=> $bobot_tf_akumulasi_total , 
                  'target_fisik_bulanan'=> $bobot_tf_bulanan_total , 
                  'realisasi_fisik_akumulasi'=> $bobot_rf_akumulasi_total , 
                  'realisasi_fisik_bulanan'=> $bobot_rf_bulanan_total , 
                  
                  'target_keuangan_akumulasi'=> $persen_target_keuangan_akumulasi , 
                  'target_keuangan_bulanan'=> $persen_target_keuangan_bulanan , 
                  'realisasi_keuangan_akumulasi'=> $persen_realisasi_keuangan_akumulasi , 
                  'realisasi_keuangan_bulanan'=> $persen_realisasi_keuangan_bulanan , 


                  'pagu_bo_bp'=> $pagu_bo_bp, 
                  'pagu_bo_bbj'=> $pagu_bo_bbj, 
                  'pagu_bo_bs'=> $pagu_bo_bs, 
                  'pagu_bo_bh'=> $pagu_bo_bh, 
                  'pagu_bo_bbs'=> $pagu_bo_bbs, 
                  'pagu_bm_bmt'=> $pagu_bm_bmt, 
                  'pagu_bm_bmpm'=> $pagu_bm_bmpm, 
                  'pagu_bm_bmgb'=> $pagu_bm_bmgb, 
                  'pagu_bm_bmjji'=> $pagu_bm_bmjji, 
                  'pagu_bm_bmatl'=> $pagu_bm_bmatl, 
                  'pagu_bm_bmatb'=> $pagu_bm_bmatb, 
                  'pagu_btt'=> $pagu_btt, 
                  'pagu_bt_bbh'=> $pagu_bt_bbh, 
                  'pagu_bt_bbk'=> $pagu_bt_bbk, 
                  'pagu_total'=> $pagu_total, 
                  'rp_target_keuangan_akumulasi'=> $rp_target_keuangan_akumulasi , 
                  'rp_target_keuangan_bulanan'=> $rp_target_keuangan_bulanan , 
                  'rp_realisasi_keuangan_akumulasi'=> $rp_realisasi_keuangan_akumulasi , 
                  'rp_realisasi_keuangan_akumulasi_bo_bp'=> $rp_realisasi_keuangan_akumulasi_bo_bp , 
                  'rp_realisasi_keuangan_akumulasi_bo_bbj'=> $rp_realisasi_keuangan_akumulasi_bo_bbj , 
                  'rp_realisasi_keuangan_akumulasi_bo_bs'=> $rp_realisasi_keuangan_akumulasi_bo_bs , 
                  'rp_realisasi_keuangan_akumulasi_bo_bh'=> $rp_realisasi_keuangan_akumulasi_bo_bh , 
                  'rp_realisasi_keuangan_akumulasi_bo_bbs'=> $rp_realisasi_keuangan_akumulasi_bo_bbs , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmt'=> $rp_realisasi_keuangan_akumulasi_bm_bmt , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmpm'=> $rp_realisasi_keuangan_akumulasi_bm_bmpm , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmgb'=> $rp_realisasi_keuangan_akumulasi_bm_bmgb , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmjji'=> $rp_realisasi_keuangan_akumulasi_bm_bmjji , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmatl'=> $rp_realisasi_keuangan_akumulasi_bm_bmatl , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmatb'=> $rp_realisasi_keuangan_akumulasi_bm_bmatb , 
                  'rp_realisasi_keuangan_akumulasi_btt'=> $rp_realisasi_keuangan_akumulasi_btt , 
                  'rp_realisasi_keuangan_akumulasi_bt_bbh'=> $rp_realisasi_keuangan_akumulasi_bt_bbh , 
                  'rp_realisasi_keuangan_akumulasi_bt_bbk'=> $rp_realisasi_keuangan_akumulasi_bt_bbk , 
                  'rp_realisasi_keuangan_bulanan'=> $rp_realisasi_keuangan_bulanan , 
                  'rp_realisasi_keuangan_bulanan_bo_bp'=> $rp_realisasi_keuangan_bulanan_bo_bp , 
                  'rp_realisasi_keuangan_bulanan_bo_bbj'=> $rp_realisasi_keuangan_bulanan_bo_bbj , 
                  'rp_realisasi_keuangan_bulanan_bo_bs'=> $rp_realisasi_keuangan_bulanan_bo_bs , 
                  'rp_realisasi_keuangan_bulanan_bo_bh'=> $rp_realisasi_keuangan_bulanan_bo_bh , 
                  'rp_realisasi_keuangan_bulanan_bo_bbs'=> $rp_realisasi_keuangan_bulanan_bo_bbs , 
                  'rp_realisasi_keuangan_bulanan_bm_bmt'=> $rp_realisasi_keuangan_bulanan_bm_bmt , 
                  'rp_realisasi_keuangan_bulanan_bm_bmpm'=> $rp_realisasi_keuangan_bulanan_bm_bmpm , 
                  'rp_realisasi_keuangan_bulanan_bm_bmgb'=> $rp_realisasi_keuangan_bulanan_bm_bmgb , 
                  'rp_realisasi_keuangan_bulanan_bm_bmjji'=> $rp_realisasi_keuangan_bulanan_bm_bmjji , 
                  'rp_realisasi_keuangan_bulanan_bm_bmatl'=> $rp_realisasi_keuangan_bulanan_bm_bmatl , 
                  'rp_realisasi_keuangan_bulanan_bm_bmatb'=> $rp_realisasi_keuangan_bulanan_bm_bmatb , 
                  'rp_realisasi_keuangan_bulanan_btt'=> $rp_realisasi_keuangan_bulanan_btt , 
                  'rp_realisasi_keuangan_bulanan_bt_bbh'=> $rp_realisasi_keuangan_bulanan_bt_bbh , 
                  'rp_realisasi_keuangan_bulanan_bt_bbk'=> $rp_realisasi_keuangan_bulanan_bt_bbk  , 
                  'last_update '=> timestamp(),
                
                'synchronize' => $input,
                ];




            }else{

                $persen_target_fisik_akumulasi = 0;//$target_fisik_akumulasi / $banyak_sub_kegiatan ;
                $persen_target_fisik_bulanan = 0;//$target_fisik_bulanan / $banyak_sub_kegiatan ;
                $persen_realisasi_fisik_akumulasi = 0;//$realisasi_fisik_akumulasi / $banyak_sub_kegiatan ;
                $persen_realisasi_fisik_bulanan = 0;//$realisasi_fisik_bulanan / $banyak_sub_kegiatan ;
                $persen_target_keuangan_akumulasi = 0;//( $rp_target_keuangan_akumulasi / $pagu_total) * 100 ;
                $persen_target_keuangan_bulanan = 0;//( $rp_target_keuangan_bulanan / $pagu_total) * 100 ;
                $persen_realisasi_keuangan_akumulasi = 0;//($rp_realisasi_keuangan_akumulasi / $pagu_total ) * 100 ;
                $persen_realisasi_keuangan_bulanan = 0;//($rp_realisasi_keuangan_bulanan / $pagu_total ) * 100 ;

                $laporan_akhir_opd = [
                  'id_instansi'=> $id_instansi , 
                  'kode_opd'=> $kode_opd , 
                  'bulan'=> $bulan , 
                  'kode_tahap'=> $kode_tahap , 
                  'tahun'=> $tahun , 

                  // // Referensi 
                  // // 'bobot_ski_total'=> $bobot_ski_total , 
                  // 'target_fisik_akumulasi'=> $target_fisik_akumulasi , 
                  // // 'bobot_target_fisik_akumulasi'=> $bobot_tf_akumulasi_total , 
                  // 'target_fisik_bulanan'=> $target_fisik_bulanan , 
                  // // 'bobot_target_fisik_bulanan'=> $bobot_tf_bulanan_total , 
                  // 'realisasi_fisik_akumulasi'=> $realisasi_fisik_akumulasi , 
                  // // 'bobot_realisasi_fisik_akumulasi'=> $bobot_rf_akumulasi_total , 
                  // 'realisasi_fisik_bulanan'=> $realisasi_fisik_bulanan , 
                  // // 'bobot_realisasi_fisik_bulanan'=> $bobot_rf_bulanan_total , 

                  
                  // insert db 
                  'target_fisik_akumulasi'=> 0,//$bobot_tf_akumulasi_total , 
                  'target_fisik_bulanan'=> 0,//$bobot_tf_bulanan_total , 
                  'realisasi_fisik_akumulasi'=> 0,//$bobot_rf_akumulasi_total , 
                  'realisasi_fisik_bulanan'=> 0,//$bobot_rf_bulanan_total , 
                  
                  'target_keuangan_akumulasi'=> 0,//$persen_target_keuangan_akumulasi , 
                  'target_keuangan_bulanan'=> 0,//$persen_target_keuangan_bulanan , 
                  'realisasi_keuangan_akumulasi'=> 0,//$persen_realisasi_keuangan_akumulasi , 
                  'realisasi_keuangan_bulanan'=> 0,//$persen_realisasi_keuangan_bulanan , 


                  'pagu_bo_bp'=> $pagu_bo_bp, 
                  'pagu_bo_bbj'=> $pagu_bo_bbj, 
                  'pagu_bo_bs'=> $pagu_bo_bs, 
                  'pagu_bo_bh'=> $pagu_bo_bh, 
                  'pagu_bo_bbs'=> $pagu_bo_bbs, 
                  'pagu_bm_bmt'=> $pagu_bm_bmt, 
                  'pagu_bm_bmpm'=> $pagu_bm_bmpm, 
                  'pagu_bm_bmgb'=> $pagu_bm_bmgb, 
                  'pagu_bm_bmjji'=> $pagu_bm_bmjji, 
                  'pagu_bm_bmatl'=> $pagu_bm_bmatl, 
                  'pagu_bm_bmatb'=> $pagu_bm_bmatb, 
                  'pagu_btt'=> $pagu_btt, 
                  'pagu_bt_bbh'=> $pagu_bt_bbh, 
                  'pagu_bt_bbk'=> $pagu_bt_bbk, 
                  'pagu_total'=> $pagu_total, 
                  'rp_target_keuangan_akumulasi'=> $rp_target_keuangan_akumulasi , 
                  'rp_target_keuangan_bulanan'=> $rp_target_keuangan_bulanan , 
                  'rp_realisasi_keuangan_akumulasi'=> $rp_realisasi_keuangan_akumulasi , 
                  'rp_realisasi_keuangan_akumulasi_bo_bp'=> $rp_realisasi_keuangan_akumulasi_bo_bp , 
                  'rp_realisasi_keuangan_akumulasi_bo_bbj'=> $rp_realisasi_keuangan_akumulasi_bo_bbj , 
                  'rp_realisasi_keuangan_akumulasi_bo_bs'=> $rp_realisasi_keuangan_akumulasi_bo_bs , 
                  'rp_realisasi_keuangan_akumulasi_bo_bh'=> $rp_realisasi_keuangan_akumulasi_bo_bh , 
                  'rp_realisasi_keuangan_akumulasi_bo_bbs'=> $rp_realisasi_keuangan_akumulasi_bo_bbs , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmt'=> $rp_realisasi_keuangan_akumulasi_bm_bmt , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmpm'=> $rp_realisasi_keuangan_akumulasi_bm_bmpm , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmgb'=> $rp_realisasi_keuangan_akumulasi_bm_bmgb , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmjji'=> $rp_realisasi_keuangan_akumulasi_bm_bmjji , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmatl'=> $rp_realisasi_keuangan_akumulasi_bm_bmatl , 
                  'rp_realisasi_keuangan_akumulasi_bm_bmatb'=> $rp_realisasi_keuangan_akumulasi_bm_bmatb , 
                  'rp_realisasi_keuangan_akumulasi_btt'=> $rp_realisasi_keuangan_akumulasi_btt , 
                  'rp_realisasi_keuangan_akumulasi_bt_bbh'=> $rp_realisasi_keuangan_akumulasi_bt_bbh , 
                  'rp_realisasi_keuangan_akumulasi_bt_bbk'=> $rp_realisasi_keuangan_akumulasi_bt_bbk , 
                  'rp_realisasi_keuangan_bulanan'=> $rp_realisasi_keuangan_bulanan , 
                  'rp_realisasi_keuangan_bulanan_bo_bp'=> $rp_realisasi_keuangan_bulanan_bo_bp , 
                  'rp_realisasi_keuangan_bulanan_bo_bbj'=> $rp_realisasi_keuangan_bulanan_bo_bbj , 
                  'rp_realisasi_keuangan_bulanan_bo_bs'=> $rp_realisasi_keuangan_bulanan_bo_bs , 
                  'rp_realisasi_keuangan_bulanan_bo_bh'=> $rp_realisasi_keuangan_bulanan_bo_bh , 
                  'rp_realisasi_keuangan_bulanan_bo_bbs'=> $rp_realisasi_keuangan_bulanan_bo_bbs , 
                  'rp_realisasi_keuangan_bulanan_bm_bmt'=> $rp_realisasi_keuangan_bulanan_bm_bmt , 
                  'rp_realisasi_keuangan_bulanan_bm_bmpm'=> $rp_realisasi_keuangan_bulanan_bm_bmpm , 
                  'rp_realisasi_keuangan_bulanan_bm_bmgb'=> $rp_realisasi_keuangan_bulanan_bm_bmgb , 
                  'rp_realisasi_keuangan_bulanan_bm_bmjji'=> $rp_realisasi_keuangan_bulanan_bm_bmjji , 
                  'rp_realisasi_keuangan_bulanan_bm_bmatl'=> $rp_realisasi_keuangan_bulanan_bm_bmatl , 
                  'rp_realisasi_keuangan_bulanan_bm_bmatb'=> $rp_realisasi_keuangan_bulanan_bm_bmatb , 
                  'rp_realisasi_keuangan_bulanan_btt'=> $rp_realisasi_keuangan_bulanan_btt , 
                  'rp_realisasi_keuangan_bulanan_bt_bbh'=> $rp_realisasi_keuangan_bulanan_bt_bbh , 
                  'rp_realisasi_keuangan_bulanan_bt_bbk'=> $rp_realisasi_keuangan_bulanan_bt_bbk  , 
                  'last_update '=> timestamp(),
                
                'synchronize' => $input,
                ];
            }

            
            array_push($kumpul_laporan_akhir_opd, $laporan_akhir_opd);
        } 

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                
              $responcode = 500;
              $status_synch = 'error';
              $keterangan_synch = 'Synchronize Gagal. Ditemukan kesalahan pada aplikasi';
                 $output = [
                    'responcode'=>500,
                    'status'=>'error',
                      'author'=>$this->session->userdata('full_name'),
                    'message'=>'Synchronize Gagal. Ditemukan kesalahan pada aplikasi',
                ];
        }
        else
        {
            $where_delete = ['id_instansi'=>$id_instansi, 'tahun'=>$tahun, 'kode_tahap'=>$kode_tahap];
            $this->db->delete('grafik_tambahan', $where_delete);
            if ($banyak_sub_kegiatan>0) {
                if ($pagu_total>0) {
                    # code...
                  // $this->db->delete('laporan_sub_kegiatan_opd', $where_delete);

                  // $this->db->insert_batch('laporan_sub_kegiatan_opd', $pecahkan_kembali);
                  $this->db->insert_batch('grafik_tambahan', $kumpul_laporan_akhir_opd);

              
              $responcode = 200;
              $status_synch = 'success';
              $keterangan_synch = 'Synchronize Berhasil';
                  $output = [
                    'responcode'=>200,
                      'status'=>'success',
                      'author'=>$this->session->userdata('full_name'),
                      'badge'=>'success',
                      'synchronize'=>'Sukses',
                      'message'=>'Synchronize Berhasil',
                  ];

                    // if ($this->session->userdata('id_group')==5) {
                    //   $this->synch_dashboard_pembangunan($this->session->userdata('full_name'), $id_instansi);
                    // }
                }else{

                  $this->db->insert_batch('grafik_tambahan', $kumpul_laporan_akhir_opd);
              $responcode = 500;
              $status_synch = 'error';
              
              $keterangan_synch = 'Pagu Kosong';
                     $output = [
                    'responcode'=>500,
                      'status'=>'warning',
                      'author'=>$this->session->userdata('full_name'),
                      'badge'=>'warning',
                      'synchronize'=>'Gagal',
                      'message'=>'Pagu Kosong',
                  ];
                }
            }
            else{
                      // $this->db->delete('laporan_sub_kegiatan_opd', $where_delete);
                  

                  $this->db->insert_batch('grafik_tambahan', $kumpul_laporan_akhir_opd);
              
              $responcode = 500;
              $status_synch = 'error';
              $keterangan_synch = 'Tidak ada kegiatan skpd '.pilihan_nama_tahapan($tahap).' '.$tahun;

                 $output = [
                      'responcode'=>500,
                      'status'=>'error',
                      'author'=>$this->session->userdata('full_name'),
                      'badge'=>'warning',
                      'synchronize'=>'Gagal',
                      'message'=>$keterangan_synch,
                ];
            }
            $this->db->trans_commit();
          }
            
            if ($input=='manual') {
                $synch_by = $this->session->userdata('id_user');
                $user_synch = $this->session->userdata('full_name');
                $id_user_synch = id_user();
            }else{
                $synch_by = 'auto';
                $user_synch = 'system';
                $id_user_synch = '';

            }
            
                      $data_auto_synch = [
                        'id_instansi'=>$id_instansi,
                        'nama_instansi'=>$nama_instansi,
                        'tahun'=>$tahun,
                        'kode_tahap'=>$tahap,
                        'synchronize'=>$input,
                        'synchronize_by'=> $synch_by,
                        'user_synch'=> $user_synch,
                        'responcode'=>$responcode,
                        'status'=>$status_synch,
                        'keterangan'=>$keterangan_synch,
                        'waktu_synch'=>timestamp(),
                      ];
                      $this->db->insert('synch_detail', $data_auto_synch);

            // header('Content-Type: application/json');
            if($input=='manual'){
              
              echo json_encode($output);
            }else{

              return $output ; 
            }

    }


?>