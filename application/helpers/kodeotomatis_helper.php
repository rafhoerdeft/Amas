<?php
if (!function_exists('kodeOtomatis')) {
    function kodeOtomatis($select = '', $table = '', $where = '', $kode_awal = '', $jml_kode = '') {
        $CI     = & get_instance();
        $CI->load->model('MasterData');
        
        $by     = $select;
        $order  = "DESC";
        $limit  = "1";
        $detail = $CI->MasterData->getWhereDataLimitOrder($select, $table, $where, $limit, $by, $order);
        $row    = $detail->row();
        if ($detail->num_rows() > 0) { // Check data
            $kode = substr($row->$select, 1, $jml_kode); // Mengambil string beberapa digit
            $code = (int) $kode; // Mengubah String jadi Integer
            $code++;
            $kodeOtomatis = $kode_awal . str_pad($code, $jml_kode, "0", STR_PAD_LEFT); // Kerangka Kode Otomatis = kode_pasar + 6 digit
        } else {
            $code = '';
            for ($i = 1; $i < $jml_kode; $i++) {
                $code .= '0';
            }
            $kodeOtomatis = $kode_awal . $code . '1';
        }

        return $kodeOtomatis;
    }
}