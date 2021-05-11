<?php

    if (!function_exists('get_pajak')) {
        function get_pajak($post){
            
            $data = array(
                "tgl_awal"          => date('d-m-Y', strtotime(str_replace('/', '-', $post['tgl_awal']))),
                "tgl_akhir"         => date('d-m-Y', strtotime(str_replace('/', '-', $post['tgl_akhir']))),
                "status"            => $post['status'],
                "id_jenis_pajak"    => $post['id_jenis_pajak'],
                "search"            => $post['search'],
                "limit_start"       => $post['limit_start'],
                "limit_length"      => $post['limit_length'],
                "order_index"       => $post['order_index'],
                "order_short"       => $post['order_short'],
                "count"             => $post['count'],
            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL             => 'http://esptpd.magelangkab.go.id/rest/ServicePajak/getDataPajak',
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_ENCODING        => '',
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 0,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => 'POST',
                CURLOPT_POSTFIELDS      => json_encode($data),
                CURLOPT_HTTPHEADER      => array(
                    'KEY: b67637121b047df82bb7648804d5d2ae',
                    'USER: pajakkabmgl',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return json_decode($response, true);
        }
    }

    if (!function_exists('get_jenis_pajak')) {
        function get_jenis_pajak(){

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL             => 'http://esptpd.magelangkab.go.id/rest/ServicePajak/getDataJenisUsaha',
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_ENCODING        => '',
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 0,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => 'GET',
                CURLOPT_HTTPHEADER      => array(
                    'KEY: b67637121b047df82bb7648804d5d2ae',
                    'USER: pajakkabmgl',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return json_decode($response, true);
        }
    }

    if (!function_exists('get_status_pajak')) {
        function get_status_pajak(){

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL             => 'http://esptpd.magelangkab.go.id/rest/ServicePajak/getDataStatus',
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_ENCODING        => '',
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 0,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => 'GET',
                CURLOPT_HTTPHEADER      => array(
                    'KEY: b67637121b047df82bb7648804d5d2ae',
                    'USER: pajakkabmgl',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response, true);
        }
    }

    // ============================================

    if (!function_exists('get_ijin')) {
        function get_ijin($post){
            
            $data = array(
                "tahun"             => $post['tahun'],
                "bulan"             => $post['bulan'],
                "status"            => $post['status'],
                "izin"              => $post['izin'],
                "search"            => $post['search'],
                "limit_start"       => $post['limit_start'],
                "limit_length"      => $post['limit_length'],
                "order_index"       => $post['order_index'],
                "order_short"       => $post['order_short'],
                "count"             => $post['count'],
            );

            $curl = curl_init();                            

            curl_setopt_array($curl, array(
                CURLOPT_URL             => 'https://siprima.magelangkab.go.id/service/ServicePerizinan/getDataIjin',
                CURLOPT_SSL_VERIFYPEER  => false,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_ENCODING        => '',
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 0,           
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => 'POST',
                CURLOPT_POSTFIELDS      => json_encode($data),
                CURLOPT_HTTPHEADER      => array(
                  'KEY: b67637121b047df82bb7648804d5d2ae',
                  'USER: ijinkabmgl',
                  'Content-Type: application/json'
                ),
              ));

            $response = curl_exec($curl);

            curl_close($curl);
            return json_decode($response, true);
        }
    }

    if (!function_exists('get_status_ijin')) {
        function get_status_ijin(){

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL             => 'https://siprima.magelangkab.go.id/service/ServicePerizinan/getDataStatus',
                CURLOPT_SSL_VERIFYPEER  => false,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_ENCODING        => '',
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 0,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => 'GET',
                CURLOPT_HTTPHEADER      => array(
                    'KEY: b67637121b047df82bb7648804d5d2ae',
                    'USER: ijinkabmgl',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response, true);
        }
    }

    if (!function_exists('get_jenis_ijin')) {
        function get_jenis_ijin(){

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL             => 'https://siprima.magelangkab.go.id/service/ServicePerizinan/getDataJenisIjin',
                CURLOPT_SSL_VERIFYPEER  => false,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_ENCODING        => '',
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 0,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => 'GET',
                CURLOPT_HTTPHEADER      => array(
                    'KEY: b67637121b047df82bb7648804d5d2ae',
                    'USER: ijinkabmgl',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response, true);
        }
    }

    if (!function_exists('get_tahun_ijin')) {
        function get_tahun_ijin(){

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL             => 'https://siprima.magelangkab.go.id/service/ServicePerizinan/getDataTahun',
                CURLOPT_SSL_VERIFYPEER  => false,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_ENCODING        => '',
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 0,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => 'GET',
                CURLOPT_HTTPHEADER      => array(
                    'KEY: b67637121b047df82bb7648804d5d2ae',
                    'USER: ijinkabmgl',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response, true);
        }
    }

    if (!function_exists('get_bulan_ijin')) {
        function get_bulan_ijin(){

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL             => 'https://siprima.magelangkab.go.id/service/ServicePerizinan/getDataBulan',
                CURLOPT_SSL_VERIFYPEER  => false,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_ENCODING        => '',
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 0,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST   => 'GET',
                CURLOPT_HTTPHEADER      => array(
                    'KEY: b67637121b047df82bb7648804d5d2ae',
                    'USER: ijinkabmgl',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response, true);
        }
    }

?>

