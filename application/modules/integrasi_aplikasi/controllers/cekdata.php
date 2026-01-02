
      public function api_sipedal_penyedia($token, $tahun, $id_opd){
                    $curl = curl_init();
                    $url = "https://sipedal.sumbarprov.go.id/api/v1/simbangda/rup_paket_penyedia?tahun=$tahun&instansi_id=D462&idsatker=$id_opd&order_col=namasatker&order_dir=desc";
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        // CURLOPT_HTTPHEADER => array(
                        //     // Set Here Your Requesred Headers
                        //     'Content-Type: application/json',
                        //    "Authorization: Bearer ".$token
                          
                        // ),
                        // CURLOPT_POST => true,
                        // CURLOPT_POSTFIELDS => http_build_query($a_params)
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $result = null;
                    if ($err) {
                        $result = "cURL Error #:" . $err;
                    } else {
                        $result = json_decode($response);
                    }
                        return $result;
            }