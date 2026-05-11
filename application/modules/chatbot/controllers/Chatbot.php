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



    
    public function index()
    {
        $thns = date('Y');
        $blns = date('m');
        $show = $this->api_dashboard_pembangunan();
        $output = [
            'modules' =>'dashboard_pembangunan',
            'result' =>$show,
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


}
