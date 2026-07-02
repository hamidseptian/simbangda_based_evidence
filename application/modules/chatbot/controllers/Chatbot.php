<?php

/**
 * androidor     : Alfikri, M.Kom
 * Created By : Alfikri, M.Kom
 * E-Mail     : alfikri.name@gmail.com
 * No HP      : 081277337405
 * Class      : android.php
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Chatbot extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json; charset=utf-8');
    }


private $instansi = null;

private function get_master_instansi($force_refresh = false) {
    if ($this->instansi !== null && !$force_refresh) {
        return $this->instansi;
    }

    $cache_file = APPPATH . 'cache/master_instansi.json';

    if (!$force_refresh && file_exists($cache_file)) {
        $this->instansi = json_decode(file_get_contents($cache_file), true);
        return $this->instansi;
    }

   $data = $this->db->select('id_instansi, nama_instansi, singkatan_nama_instansi')
                 ->get_where('master_instansi', ['is_active'=>1, 'kategori'=>'OPD'])
                 ->result_array();

    if (empty($data)) {
        if (file_exists($cache_file)) {
            $this->instansi = json_decode(file_get_contents($cache_file), true);
            return $this->instansi;
        }
        return [];
    }

    file_put_contents($cache_file, json_encode($data, JSON_UNESCAPED_UNICODE));
    $this->instansi = $data;
    return $this->instansi;
}



    public function searching_opd($keyword){
            $keyword = urldecode($keyword); // decode %20 jadi spasi
            // echo $keyword;
            // die;
            $opd = $this->get_master_instansi();
            // $keyword = "Biro Administrasi";
            $bulan = bulan_aktif();
            $hasil = array_filter($opd, function($item) use ($keyword) {
                return stripos($item['nama_instansi'], $keyword) !== false || stripos($item['singkatan_nama_instansi'], $keyword) !== false;
            });

            $id_saja = array_column(array_values($hasil), 'id_instansi');

            $show_hasil = array_map(function($item) {
                $item['id_instansi'] = sbe_crypt($item['id_instansi']);
                return $item;
            }, array_values($hasil));




            if (count($hasil)==0) {
               // echo "Data tidak ditemukan";
            }else if(count($hasil)>1) {
                // echo json_encode(array_values($hasil));
            }else{
                $id_instansi = $id_saja[0];
                // echo $id_instansi;
            }

            $output = [
                'modules'=>'chatbot',
                'bulan'=>$bulan,
                'found'=>count($hasil),
                'data'=>$show_hasil,
            ];
            echo json_encode($output);
    }
        
    public function index()
    {
        $thns = date('Y');
        $blns = date('n');
        $dashboard_pembangunan   = $this->api_dashboard_pembangunan();
        $get_data = $dashboard_pembangunan['data']->data ;
        $index_grafik = $blns-1;
        $get_data_grafik = $dashboard_pembangunan['data']->data->grafik_akumulasi[$index_grafik] ;
        $dev_fisik = $get_data_grafik->deviasi_fisik;
        if ($dev_fisik < -10) {
          $icon_dev_fisik = '🟥'; 
        }
        elseif ($dev_fisik <=-5  && $dev_fisik >=-10) {
          $icon_dev_fisik = '🟨';
        }
        elseif ($dev_fisik <=0  && $dev_fisik >=-5) {
          $icon_dev_fisik = '🟩';
        }else{
          $icon_dev_fisik = '🟪';
        }

        $dev_keuangan = $get_data_grafik->deviasi_keuangan;
        if ($dev_keuangan < -10) {
          $icon_dev_keuangan = '🟥'; 
        }
        elseif ($dev_keuangan <=-5  && $dev_keuangan >=-10) {
          $icon_dev_keuangan = '🟨';
        }
        elseif ($dev_keuangan <=0  && $dev_keuangan >=-5) {
          $icon_dev_keuangan = '🟩';
        }else{
          $icon_dev_keuangan = '🟪';
        }
        $hasil = [
            'tahun'=>$get_data->tahun,
            'nama_tahap'=>pilihan_nama_tahapan($get_data->tahap),
            'tahap'=>$get_data->tahap,
            'pagu'=>number_format($get_data->pagu_total),
            'rp_target_keuangan'=>number_format($get_data->rp_target_keuangan_total),
            'rp_realisasi_keuangan'=>number_format($get_data->rp_realisasi_keuangan_total),
            'persen_target_keuangan'=>$get_data_grafik->target_keuangan,
            'persen_realisasi_keuangan'=>$get_data_grafik->realisasi_keuangan,
            // 'realisasi_keuangan'=>$get_data_grafik->realisasi_keuangan,
            'realisasi_fisik'=>$get_data_grafik->realisasi_fisik,
            'target_fisik'=>$get_data_grafik->target_fisik,
            'deviasi_fisik'=>$get_data_grafik->deviasi_fisik,
            'icon_deviasi_fisik'=>$icon_dev_fisik,
            'deviasi_keuangan'=>$get_data_grafik->deviasi_keuangan,
            'icon_deviasi_keuangan'=>$icon_dev_keuangan,
            'nama_bulan'=>bulan_global($get_data_grafik->bulan),
            'bulan'=>$get_data_grafik->bulan,
        ];
        $output = [
            'modules' =>'dashboard_pembangunan',
            'result' =>$hasil,
            'data' =>$get_data_grafik,
        ];
        echo json_encode($output);

    }

    public function realisasi_opd()
    {
        // $thns = date('Y');
        // $blns = date('n');
        $tahap = tahapan_apbd();
        $tahun = tahun_anggaran();
        $id_instansi = sbe_crypt($this->input->get('id_instansi'),'D');
        $bulan = $this->input->get('bulan');
        $dashboard_pembangunan   = $this->api_dashboard_pembangunan_data_opd($id_instansi, $tahap, $tahun, $bulan);
        $get_data = $dashboard_pembangunan;
        // $index_grafik = $blns-1;
        // $get_data_grafik = $dashboard_pembangunan['data']->data->grafik_akumulasi[$index_grafik] ;
        $deviasi_keuangan = $get_data['data']->pencapaian_opd->persen_realisasi_keuangan - $get_data['data']->pencapaian_opd->persen_target_keuangan;
        $hasil = [
            'id_instansi'=>sbe_crypt($id_instansi),
            'skpd'=>$get_data['data']->pencapaian_opd->skpd,
            'tahun'=>$tahun,
            'nama_bulan'=>bulan_global($get_data['data']->bulan),
            'bulan'=>$get_data['data']->bulan,
            'nama_tahap'=>pilihan_nama_tahapan($tahap),
            'kode_tahap'=>$tahap,
            'pagu'=>number_format($get_data['data']->pencapaian_opd->pagu),
            'rp_target_keuangan_total'=>number_format($get_data['data']->pencapaian_opd->rp_target_keuangan),
            'persen_target_keuangan'=>$get_data['data']->pencapaian_opd->persen_target_keuangan,
            'rp_realisasi_keuangan_total'=>number_format( $get_data['data']->pencapaian_opd->rp_realisasi_keuangan),
            'persen_realisasi_keu'=>$get_data['data']->pencapaian_opd->persen_realisasi_keuangan,
            'deviasi_keuangan_akumulasi'=>round($deviasi_keuangan,2),

            'persen_terget_fisik'=>$get_data['data']->pencapaian_opd->target_fisik_akumulasi,
            'persen_realisasi_fisik'=>$get_data['data']->pencapaian_opd->realisasi_fisik_akumulasi,
            'deviasi_fisik_akumulasi'=>$get_data['data']->pencapaian_opd->deviasi_fisik_akumulasi,
        ];
        $output = [
            'modules' =>'dashboard_pembangunan',
            'data' =>$hasil,
            // 'result' =>$get_data['data']->pencapaian_opd,
        ];
        echo json_encode($output);

    }



    public function api_dashboard_pembangunan(){
                // $token = 'Hamid@01#2026';
                $curl = curl_init();
                $link = 'integrated/api/dashboard_pembangunan/';
                $url = base_url().$link;
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,// your preferred link
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_HTTPHEADER => array(
                        // Set Here Your Requesred Headers
                       //  'Content-Type: application/json',
                       // "Bapenda-Key: ".$token,
                      
                    ),
                    // CURLOPT_POST => true,
                    // CURLOPT_POSTFIELDS => http_build_query($a_params)
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $result = null;
                if ($err) {
                    $result = "cURL Error #:" . $err;
                    $responcode = 500;
                } else {
                    $result = json_decode($response);
                    $responcode = 200;
                }
                    
                    return ['responcode'=>$responcode, 'data'=>$result];


        }


    public function api_dashboard_pembangunan_data_opd($id_instansi, $tahap, $tahun, $bulan){
                // $token = 'Hamid@01#2026';
                $curl = curl_init();
                $link = 'integrated/api/dashboard_pembangunan/detail_data_opd_pengelompokan/'.$id_instansi.'?tahun='.$tahun.'&tahap='.$tahap.'&bulan='.$bulan;
                $url = base_url().$link;
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,// your preferred link
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_HTTPHEADER => array(
                        // Set Here Your Requesred Headers
                       //  'Content-Type: application/json',
                       // "Bapenda-Key: ".$token,
                      
                    ),
                    // CURLOPT_POST => true,
                    // CURLOPT_POSTFIELDS => http_build_query($a_params)
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $result = null;
                if ($err) {
                    $result = "cURL Error #:" . $err;
                    $responcode = 500;
                } else {
                    $result = json_decode($response);
                    $responcode = 200;
                }
                    
                    return ['responcode'=>$responcode, 'data'=>$result];


        }





    public function check_no_hp(){
        $no_hp = $this->input->get('nohp');
        $q = $this->db->query("SELECT ac.no_hp, mi.nama_instansi, ac.id_hak_akses, ha.nama_hak_akses from akses_chatbot ac
            left join master_instansi mi on ac.id_instansi = mi.id_instansi
            left join hak_akses_chatbot ha on ac.id_hak_akses =ha.id_hak_akses
         where ac.no_hp='$no_hp'");
        $found = $q->num_rows();
        if ($found==0) {
            $output = [
                'modules'=>'chatbot',
                'terdaftar'=>false,
                'data'=>'',
            ];
        }else{
            $output = [
                'modules'=>'chatbot',
                'terdaftar'=>true,
                'data'=>$q->row_array(),
            ];

        }

         

       

            echo json_encode($output);
    }
        
}
