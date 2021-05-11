<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin2 extends CI_Controller {

	function __construct(){
		parent:: __construct();
		$this->load->model('MasterData');
		$this->load->library('session');
		if ($this->session->userdata('level')!= "3") {
			redirect('login');
		}
		date_default_timezone_set('Asia/Jakarta');
    }

	public function index(){
		$login_id = $this->session->userdata('login_id');

		// Submitted
		###################################################################################################
		// $select = array(
		// 	'ais_barangmtang.brgmtang_kode',
		// 	'ais_barangmtang.brgmtang_name',
		// 	'SUM(detail_permintaan.jumlah_barang) AS jumlah_barang'
		// );
		// $table = array(
		// 	'detail_permintaan',
		// 	'master_permintaan',
		// 	'ais_barangmtang'
		// );
		// $where = "
		// 	detail_permintaan.kode_permintaan = master_permintaan.kode_permintaan AND
		//     detail_permintaan.kode_barang = ais_barangmtang.brgmtang_kode AND
		//     master_permintaan.ukerja_kode = '$ukerja_kode' AND
		//     date_format(date(master_permintaan.tgl_permintaan), '%m') = date_format(curdate(), '%m') AND
		//     detail_permintaan.status_barang = 'Diajukan'
		//     GROUP BY ais_barangmtang.brgmtang_kode
		// ";
		// $data ["ListSubmitted"] =$this->masterData->getWhereData($select,$table,$where);
		// $data ['Submitted'] = $this->masterData->getWhereData($select,$table,$where)->num_rows();
		###################################################################################################

		// Rejected
		###################################################################################################
		// $select = array(
		// 	'ais_barangmtang.brgmtang_kode',
		// 	'ais_barangmtang.brgmtang_name',
		// 	'SUM(detail_permintaan.jumlah_barang) AS jumlah_barang'
		// );
		// $table = array(
		// 	'detail_permintaan',
		// 	'master_permintaan',
		// 	'ais_barangmtang'
		// );
		// $where = "
		// 	detail_permintaan.kode_permintaan = master_permintaan.kode_permintaan AND
		//     detail_permintaan.kode_barang = ais_barangmtang.brgmtang_kode AND
		//     master_permintaan.ukerja_kode = '$ukerja_kode' AND
		//     date_format(date(master_permintaan.tgl_permintaan), '%m') = date_format(curdate(), '%m') AND
		//     detail_permintaan.status_barang = 'Ditolak'
		//     GROUP BY ais_barangmtang.brgmtang_kode
		// ";
		// $data ["ListRejected"] =$this->masterData->getWhereData($select,$table,$where);
		// $data ['Rejected'] = $this->masterData->getWhereData($select,$table,$where)->num_rows();
		###################################################################################################

		// Processed
		###################################################################################################
		// $select = array(
		// 	'ais_barangmtang.brgmtang_kode',
		// 	'ais_barangmtang.brgmtang_name',
		// 	'SUM(detail_permintaan.jumlah_barang) AS jumlah_barang'
		// );
		// $table = array(
		// 	'detail_permintaan',
		// 	'master_permintaan',
		// 	'ais_barangmtang'
		// );
		// $where = "
		// 	detail_permintaan.kode_permintaan = master_permintaan.kode_permintaan AND
		//     detail_permintaan.kode_barang = ais_barangmtang.brgmtang_kode AND
		//     master_permintaan.ukerja_kode = '$ukerja_kode' AND
		//     date_format(date(master_permintaan.tgl_permintaan), '%m') = date_format(curdate(), '%m') AND
		//     detail_permintaan.status_barang = 'Diproses'
		//     GROUP BY ais_barangmtang.brgmtang_kode
		// ";
		// $data ["ListProcessed"] =$this->masterData->getWhereData($select,$table,$where);
		// $data ['Processed'] = $this->masterData->getWhereData($select,$table,$where)->num_rows();
		###################################################################################################

		// Sent
		###################################################################################################
		// $select = array(
		// 	'detail_permintaan.kode_permintaan',
		// 	'ais_barangmtang.brgmtang_kode',
		// 	'ais_barangmtang.brgmtang_name',
		// 	'SUM(detail_permintaan.jumlah_barang) AS jumlah_barang'
		// );
		// $table = array(
		// 	'detail_permintaan',
		// 	'master_permintaan',
		// 	'ais_barangmtang'
		// );
		// $where = "
		// 	detail_permintaan.kode_permintaan = master_permintaan.kode_permintaan AND
		//     detail_permintaan.kode_barang = ais_barangmtang.brgmtang_kode AND
		//     master_permintaan.ukerja_kode = '$ukerja_kode' AND
		//     date_format(date(master_permintaan.tgl_permintaan), '%m') = date_format(curdate(), '%m') AND
		//     detail_permintaan.status_barang = 'Dikirim'
		//     GROUP BY ais_barangmtang.brgmtang_kode
		// ";
		// $data ["ListSent"] =$this->masterData->getWhereData($select,$table,$where);
		// $data ['Sent'] = $this->masterData->getWhereData($select,$table,$where)->num_rows();
		###################################################################################################

		$data['id_nav'] = 1;
		$this->load->view('admin/header');
		$this->load->view('admin/navigation', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer');
	}

	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('login');
	}
}
