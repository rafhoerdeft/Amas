<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(null);

class Service extends CI_Controller {

	function __construct(){
		parent:: __construct();
		date_default_timezone_set('Asia/Jakarta');
        header("Content-type:application/json");

        $this->pbb = $this->load->database('pbb', TRUE);
        $this->bphtb = $this->load->database('bphtb', TRUE);

		$this->load->helper('encrypt');
		$this->load->model('MasterData');
		$this->load->library('session');

    }

	public function index(){
		echo "404";
	}

	public function getPBBService() {

		$post = json_decode(file_get_contents('php://input'), true);

		$nop = $post['NOP'];
		$thn = $post['TAHUN'];

        if ($thn=='') {
            $thn = date('Y');
        }

        if ($nop=='' || $nop==null) {
            $res = array(
                'respon_code' => 'Data tidak ditemukan'
            );
            echo json_encode($res);
            exit();
        }

        if(strpos($nop,".") !== false){
            $np = explode(".", $nop);
            $KD_PROPINSI = $np[0];
            $KD_DATI2 = $np[1];
            $KD_KECAMATAN = $np[2];
            $KD_KELURAHAN = $np[3];
            $KD_BLOK = $np[4];
            $NO_URUT = $np[5];
            $KD_JNS_OP = $np[6];
        } else {
            $KD_PROPINSI = substr($nop,0,2);
            $KD_DATI2 = substr($nop,2,2);
            $KD_KECAMATAN = substr($nop,4,3);
            $KD_KELURAHAN = substr($nop,7,3);
            $KD_BLOK = substr($nop,10,3);
            $NO_URUT = substr($nop,13,4);
            $KD_JNS_OP = substr($nop,-1);
        }


        $query =    "SELECT
                        SPPT.NM_WP_SPPT NAMA,
                        SPPT.LUAS_BUMI_SPPT LUASTANAH,
                        SPPT.LUAS_BNG_SPPT LUASBANGUNAN,
                        SPPT.NJOP_BUMI_SPPT,
						SPPT.NJOP_BNG_SPPT,
                        SPPT.PBB_TERHUTANG_SPPT,
                        SPPT.PBB_YG_HARUS_DIBAYAR_SPPT,
                        SPPT.STATUS_PEMBAYARAN_SPPT,
                        (TO_CHAR(SPPT.TGL_JATUH_TEMPO_SPPT,'DD/MM/YYYY')) TGL_JATUH_TEMPO_SPPT,
                        SPPT.TOTALDENDA,
                        REF_DATI2.NM_DATI2 WILAYAH,
                        REF_KECAMATAN.NM_KECAMATAN KECAMATAN,
                        REF_KELURAHAN.NM_KELURAHAN KELURAHAN,
                        DAT_OBJEK_PAJAK.JALAN_OP JALAN_OP,
                        DAT_OBJEK_PAJAK.BLOK_KAV_NO_OP BLOK_KAV_NO_OP,
                        DAT_OBJEK_PAJAK.RT_OP RT_OP,
                        DAT_OBJEK_PAJAK.RW_OP RW_OP,
                        -- (DAT_OBJEK_PAJAK.JALAN_OP || ' ' || DAT_OBJEK_PAJAK.BLOK_KAV_NO_OP || ' RT. ' || DAT_OBJEK_PAJAK.RT_OP || ' RW. ' || DAT_OBJEK_PAJAK.RW_OP) ALAMAT,
                        PEMBAYARAN_SPPT.JML_SPPT_YG_DIBAYAR PEMBAYARAN,
                        (TO_CHAR(PEMBAYARAN_SPPT.TGL_PEMBAYARAN_SPPT,'DD/MM/YYYY')) TGL_PEMBAYARAN,
                        XS_SPPT_BAYAR_LURAH.TGL_BAYAR_LURAH TGL_BAYAR_LURAH,
                        XS_SPPT_BAYAR_LURAH.TGL_BAYAR_WP TGL_BAYAR_WP
                    FROM XS_VIEW_SPPT_SUMMARY_DENDA SPPT
                    LEFT JOIN REF_DATI2 ON REF_DATI2.KD_PROPINSI = SPPT.KD_PROPINSI AND REF_DATI2.KD_DATI2 = SPPT.KD_DATI2
                    LEFT JOIN REF_KECAMATAN ON REF_KECAMATAN.KD_PROPINSI = SPPT.KD_PROPINSI AND REF_KECAMATAN.KD_DATI2 = SPPT.KD_DATI2 AND REF_KECAMATAN.KD_KECAMATAN = SPPT.KD_KECAMATAN
                    LEFT JOIN REF_KELURAHAN ON REF_KELURAHAN.KD_PROPINSI = SPPT.KD_PROPINSI AND REF_KELURAHAN.KD_DATI2 = SPPT.KD_DATI2 AND REF_KELURAHAN.KD_KECAMATAN = SPPT.KD_KECAMATAN AND REF_KELURAHAN.KD_KELURAHAN = SPPT.KD_KELURAHAN
                    LEFT JOIN DAT_OBJEK_PAJAK ON DAT_OBJEK_PAJAK.KD_PROPINSI = SPPT.KD_PROPINSI AND DAT_OBJEK_PAJAK.KD_DATI2 = SPPT.KD_DATI2 AND DAT_OBJEK_PAJAK.KD_KECAMATAN = SPPT.KD_KECAMATAN AND DAT_OBJEK_PAJAK.KD_KELURAHAN = SPPT.KD_KELURAHAN AND DAT_OBJEK_PAJAK.KD_BLOK = SPPT.KD_BLOK AND DAT_OBJEK_PAJAK.NO_URUT = SPPT.NO_URUT AND DAT_OBJEK_PAJAK.KD_JNS_OP = SPPT.KD_JNS_OP
                    LEFT JOIN PEMBAYARAN_SPPT ON PEMBAYARAN_SPPT.KD_PROPINSI = SPPT.KD_PROPINSI AND PEMBAYARAN_SPPT.KD_DATI2 = SPPT.KD_DATI2 AND PEMBAYARAN_SPPT.KD_KECAMATAN = SPPT.KD_KECAMATAN AND PEMBAYARAN_SPPT.KD_KELURAHAN = SPPT.KD_KELURAHAN AND PEMBAYARAN_SPPT.KD_BLOK = SPPT.KD_BLOK AND PEMBAYARAN_SPPT.NO_URUT = SPPT.NO_URUT AND PEMBAYARAN_SPPT.KD_JNS_OP = SPPT.KD_JNS_OP AND PEMBAYARAN_SPPT.THN_PAJAK_SPPT = SPPT.THN_PAJAK_SPPT
                    LEFT JOIN XS_SPPT_BAYAR_LURAH ON XS_SPPT_BAYAR_LURAH.KD_PROPINSI = SPPT.KD_PROPINSI AND XS_SPPT_BAYAR_LURAH.KD_DATI2 = SPPT.KD_DATI2 AND XS_SPPT_BAYAR_LURAH.KD_KECAMATAN = SPPT.KD_KECAMATAN AND XS_SPPT_BAYAR_LURAH.KD_KELURAHAN = SPPT.KD_KELURAHAN AND XS_SPPT_BAYAR_LURAH.KD_BLOK = SPPT.KD_BLOK AND XS_SPPT_BAYAR_LURAH.NO_URUT = SPPT.NO_URUT AND XS_SPPT_BAYAR_LURAH.KD_JNS_OP = SPPT.KD_JNS_OP AND XS_SPPT_BAYAR_LURAH.THN_PAJAK_SPPT = SPPT.THN_PAJAK_SPPT
                    WHERE 
                        SPPT.KD_PROPINSI = ? AND
                        SPPT.KD_DATI2 = ? AND
                        SPPT.KD_KECAMATAN = ? AND
                        SPPT.KD_KELURAHAN = ? AND
                        SPPT.KD_BLOK = ? AND
                        SPPT.NO_URUT = ? AND
                        SPPT.THN_PAJAK_SPPT = ?

                    ";


        $data = $this->pbb->query($query, array($KD_PROPINSI, $KD_DATI2, $KD_KECAMATAN, $KD_KELURAHAN, $KD_BLOK, $NO_URUT, $thn));


        if ($data->num_rows() > 0) {   

            $row = $data->row_array();

            if($row['STATUS_PEMBAYARAN_SPPT'] == 0 && $row['TGL_BAYAR_WP'] == null && $row['TGL_BAYAR_LURAH'] == null){
                $status = "Belum Lunas";
            }else if($row['STATUS_PEMBAYARAN_SPPT'] == 0 && $row['TGL_BAYAR_WP'] != null && $row['TGL_BAYAR_LURAH'] == null){
                $status = "Pembayaran sedang diproses oleh kantor Kelurahan/Desa";
            }else if($row['STATUS_PEMBAYARAN_SPPT'] == 0 && $row['TGL_BAYAR_WP'] != null && $row['TGL_BAYAR_LURAH'] != null){
                $status = "Pembayaran Sudah dalam ID Billing";
            }else if($row['STATUS_PEMBAYARAN_SPPT'] == 1 && $row['TGL_BAYAR_WP'] != null && $row['TGL_BAYAR_LURAH'] != null){
                $status = "100% Lunas";
            }else if($row['STATUS_PEMBAYARAN_SPPT'] == 1 && $row['TGL_BAYAR_WP'] == null && $row['TGL_BAYAR_LURAH'] != null){
                $status = "100% Lunas";
            }else if($row['STATUS_PEMBAYARAN_SPPT'] == 1 && $row['TGL_BAYAR_WP'] == null && $row['TGL_BAYAR_LURAH'] == null){
                $status = "100% Lunas";
            }

            $alamat = $row['JALAN_OP'];
            if ($row['BLOK_KAV_NO_OP'] != null || $row['BLOK_KAV_NO_OP'] != '') {
                $alamat .= ' '.$row['BLOK_KAV_NO_OP'];
            }
            if ($row['RT_OP'] != null || $row['RT_OP'] != '') {
                $alamat .= ' RT. '.$row['RT_OP'];
            }
            if ($row['RW_OP'] != null || $row['RW_OP'] != '') {
                $alamat .= ' RW. '.$row['RW_OP'];
            }

            $arr = array(
                'NOP' => $nop,
                'NIK' => NULL,
                'NAMA_WP' => $row['NAMA'],
                'ALAMAT_OP' => $alamat,
                'KECAMATAN_OP' => $row['KECAMATAN'],
                'KELURAHAN_OP' => $row['KELURAHAN'],
                'KOTA_OP' => $row['WILAYAH'],
                'LUASTANAH_OP' => $row['LUASTANAH'],
                'LUASBANGUNAN_OP' => $row['LUASBANGUNAN'],
                'NJOP_TANAH_OP' => $row['NJOP_BUMI_SPPT'],
                'NJOP_BANGUNAN_OP' => $row['NJOP_BNG_SPPT'],
                // 'PEMBAYARAN' => $row['PEMBAYARAN'],
                'STATUS_TUNGGAKAN' => $status,
                // 'TANGGAL_PEMBAYARAN' => $row['TGL_PEMBAYARAN'],
                // 'NTPD' => NULL,
                // 'JENISBAYAR' => NULL,
                // 'RESPON_CODE' => 'OK',
            );  

            $res = array(
                'result' => $arr,
                'respon_code' => 'OK'
            );
        } else {
            $res = array(
                // 'result' => NULL,
                'respon_code' => 'Data tidak ditemukan'
            );
        }

        echo json_encode($res);
    }

    public function getBPHTBService($value='') {

        $post = json_decode(file_get_contents('php://input'), true);

        $user   = $post['USERNAME'];
        $pass   = $post['PASSWORD'];
        $nop    = $post['NOP'];
        $ntpd   = $post['NTPD'];
        $thn    = $post['TAHUN'];

        if ($thn=='') {
            $thn = date('Y');
        }

        if ($user != 'untukbpn' || $pass != 'kabmagelang') {
            $res = array(
                'respon_code' => 'Username atau password salah'
            );
            echo json_encode($res);
            exit();
        }

        if ($nop == '' || $nop == null || $ntpd == '' || $ntpd == null) {
            $res = array(
                'respon_code' => 'Data tidak ditemukan'
            );
            echo json_encode($res);
            exit();
        }

        if(strpos($nop,".") !== false){
            $np = explode(".", $nop);
            $KD_PROPINSI = $np[0];
            $KD_DATI2 = $np[1];
            $KD_KECAMATAN = $np[2];
            $KD_KELURAHAN = $np[3];
            $KD_BLOK = $np[4];
            $NO_URUT = $np[5];
            $KD_JNS_OP = $np[6];
        } else {
            $KD_PROPINSI = substr($nop,0,2);
            $KD_DATI2 = substr($nop,2,2);
            $KD_KECAMATAN = substr($nop,4,3);
            $KD_KELURAHAN = substr($nop,7,3);
            $KD_BLOK = substr($nop,10,3);
            $NO_URUT = substr($nop,13,4);
            $KD_JNS_OP = substr($nop,-1);
        }

        $Nop = $KD_PROPINSI.'.'.$KD_DATI2.'.'.$KD_KECAMATAN.'.'.$KD_KELURAHAN.'.'.$KD_BLOK.'.'.$NO_URUT.'.'.$KD_JNS_OP;

        $query =   "SELECT 
                            vs.t_idspt,
                            vs.t_tglprosesspt,
                            vs.t_periodespt,
                            vs.t_nopbphtbsppt,
                            vs.t_totalspt,
                            vs.t_nilaitransaksispt,
                            vs.t_namawppembeli,
                            vs.t_nikwppembeli,
                            vs.t_alamatwppembeli,
                            vs.t_rtwppembeli,
                            vs.t_rwwppembeli,
                            vs.t_kecamatanwppembeli,
                            vs.t_kelurahanwppembeli,
                            vs.t_kabkotawppembeli,
                            -- vs.t_kodeposwppembeli,
                            vs.t_luastanah,
                            -- vs.t_njoptanah,
                            vs.t_luasbangunan,
                            -- vs.t_njopbangunan,
                            vs.t_statusbayarspt,
                            vs.t_tanggalpembayaran,
                            vs.t_kodebayarbanksppt,
                            vs.t_nilaipembayaranspt
                    FROM view_sspd_pembayaran vs 
                    -- LEFT JOIN t_pembayaranspt tp ON vs.t_idspt = tp.t_idspt
                    WHERE vs.t_nopbphtbsppt = ? AND vs.t_kodebayarbanksppt = ?";
        $data = $this->bphtb->query($query, array($Nop, $ntpd));

        if ($data->num_rows() > 0) {   

            $row = $data->row_array();

            $alamat = $row['t_alamatwppembeli'];
            if ($row['t_rtwppembeli'] != null || $row['t_rtwppembeli'] != '') {
                $alamat .= ' RT. '.$row['t_rtwppembeli'];
            }
            if ($row['t_rwwppembeli'] != null || $row['t_rwwppembeli'] != '') {
                $alamat .= ' RW. '.$row['t_rwwppembeli'];
            }

            $status = ($row['t_statusbayarspt']!=true?'T':'Y');
            $jenisbayar = ($row['t_statusbayarspt']!=true?'H':'L');
            $t_luastanah = str_ireplace('.', '', $row['t_luastanah']);
            $t_luasbangunan = str_ireplace('.', '', $row['t_luasbangunan']);
            $luastanah = round(($t_luastanah / 100),2);
            $luasbangunan = round(($t_luasbangunan / 100),2);

            $arr = array(
                "NOP"                   => $nop, 
                "NIK"                   => $row['t_nikwppembeli'], 
                "NAMA"                  => $row['t_namawppembeli'], 
                "ALAMAT"                => $alamat, 
                "KELURAHAN_OP"          => $row['t_kelurahanwppembeli'], 
                "KECAMATAN_OP"          => $row['t_kecamatanwppembeli'], 
                "KOTA_OP"               => $row['t_kabkotawppembeli'], 
                "LUASTANAH"             => $luastanah, 
                "LUASBANGUNAN"          => $luasbangunan, 
                "PEMBAYARAN"            => $row['t_totalspt'], 
                "STATUS"                => $status, 
                "TANGGAL_PEMBAYARAN"    => date('d/m/Y', strtotime($row['t_tanggalpembayaran'])), 
                "NTPD"                  => $row['t_kodebayarbanksppt'], 
                "JENISBAYAR"            => $jenisbayar,
            );  

            $res = array(
                'result' => $arr,
                'respon_code' => 'OK'
            );
        } else {
            $queryNop =   "SELECT 
                            vs.t_nopbphtbsppt
                        FROM view_sspd_pembayaran vs 
                        WHERE vs.t_nopbphtbsppt = ?";

            $dataNop = $this->bphtb->query($queryNop, array($Nop))->row()->t_nopbphtbsppt;

            $queryNtpd =   "SELECT 
                            vs.t_kodebayarbanksppt
                        FROM view_sspd_pembayaran vs 
                        WHERE vs.t_kodebayarbanksppt = ?";

            $dataNtpd = $this->bphtb->query($queryNtpd, array($ntpd))->row()->t_kodebayarbanksppt;

            if (($dataNop == '' || $dataNop == null) && ($dataNtpd == '' || $dataNtpd == null)) {
                $res = array(
                    'respon_code' => 'Data tidak ditemukan'
                );
            } else {
                 if ($dataNop == '' || $dataNop == null) {
                    $res = array(
                        'respon_code' => 'NOP tidak ditemukan'
                    );
                } else if ($dataNtpd == '' || $dataNtpd == null) {
                    $res = array(
                        'respon_code' => 'NTPD tidak ditemukan'
                    );
                } else {
                    $res = array(
                        'respon_code' => 'Data tidak ditemukan'
                    );
                }
            }     
        }

        echo json_encode($res);

    }

}
