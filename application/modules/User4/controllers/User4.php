<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(null);

class User4 extends Adm_Controller
{

    function __construct() {
        parent::__construct();

		$this->secure->auth('Sim_asset_User4');

        $this->head = array(
            assets_url . "app-assets/css/vendors.css",
            assets_url . "app-assets/css/app.css",
            assets_url . "app-assets/css/core/menu/menu-types/horizontal-menu.css",
            assets_url . "app-assets/css/core/colors/palette-gradient.css",
            assets_url . "app-assets/css/components.min.css",
            base_url('assets/css/loading.css'),
            // assets_url . "assets/css/style.css",
        );
        $this->foot = array(
            // assets_url . "app-assets/vendors/js/vendors.min.js",
            assets_url . "app-assets/js/core/app-menu.js",
            assets_url . "app-assets/js/core/app.js",
            assets_url . "app-assets/js/scripts/customizer.js",
            assets_url . "app-assets/vendors/js/ui/jquery.sticky.js",
            assets_url . "app-assets/js/scripts/footer.min.js",
        );

        $this->controller = $this->router->fetch_class();
    } 

    public function index()
    {
        $this->head[] = assets_url . "app-assets/fonts/simple-line-icons/style.css";
        $header['css'] = $this->head;
        $footer['js'] = $this->foot;
        $menu['active'] = '0';

        $data = array(
            'header' => $header,
            'menu'   => $menu,
            'konten' => 'dash',
            'footer' => $footer,
            // 'cont'   => $cont,
        );

        $this->load->view("view_master_admin", $data);
    }
    
    public function dashBoard()
    {
        $this->head[] = assets_url . "app-assets/fonts/simple-line-icons/style.css";
        $header['css'] = $this->head;
        $footer['js'] = $this->foot;
        $menu['active'] = '1';

        // JUMLAH BARANG MASUK
		$select = "IFNULL(SUM((SELECT SUM(sr.jml_barang) FROM tbl_so_rincian sr WHERE sr.id_so = so.id_so GROUP BY sr.id_so)), 0) jml_barang";
        $table = 'tbl_so so';
        $where = "MONTH(tgl_nota) = MONTH(now()) AND YEAR(tgl_nota) = YEAR(now())";
		$this_month = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_barang;
		$where = "tgl_nota > DATE_SUB(now(), INTERVAL 6 MONTH)";
        $last_6_month = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_barang;
        $where = "YEAR(tgl_nota) = YEAR(now())";
        $this_year = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_barang;

        $content = array(
            'this_month'    => $this_month,
            'last_6_month'  => $last_6_month,
            'this_year'     => $this_year,
        );

        $data = array(
            'header' => $header,
            'menu'   => $menu,
            'konten' => 'pages/dashboard',
            'footer' => $footer,
            'cont'   => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    // REKANAN ==============================================================

    public function dataRekanan() {

        $this->head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        // $this->head[] = assets_url . "app-assets/vendors/css/forms/selects/select2.min.css";
        $this->head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        // $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        // $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js";
        $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js";
        $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js";
        // $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        // $this->foot[] = assets_url . "app-assets/vendors/js/forms/select/select2.full.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        $this->foot[] = base_url('assets/js/data_table.js');
        $this->foot[] = base_url('assets/js/delete_data.js');
        // ================================================================
        $script[] = "showDataTable('Data Rekanan Diskominfo', '', '".date('dmY')."', [ 0, 2, 3, 4]);";
        // $script[] = "$('.date-range').datepicker({
        //                 autoclose: true,
        //                 todayHighlight: true,
        //                 format: 'dd/mm/yyyy',
        //                 toggleActive: true,
        //                 orientation: 'bottom left'
        //             });";
        // $script[] = '$(".select2").select2({ dropdownCssClass: "sizeFontSm" });';
        // ================================================================
        $header['css']      = $this->head;
        $footer['js']       = $this->foot;
        $footer['script']   = $script;
        $menu['active']     = '2';

        // ================================================================
        
        $dataRekanan = $this->MasterData->getWhereDataOrder('*', 'tbl_rekanan', "id_rekanan > 0", "id_rekanan", "DESC")->result();

        $content = array(
            'dataRekanan'   => $dataRekanan,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_rekanan',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function simpanDataRekanan() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $data = array(
                'nama_rekanan'   => $post['nama_rekanan'],  
                'alamat_rekanan' => $post['alamat_rekanan'],  
                'kota_rekanan'   => $post['kota_rekanan'],  
            );

            $input = $this->MasterData->inputData($data,'tbl_rekanan');

            if ($input) {
                alert_success('Data berhasil disimpan.');
                redirect(base_url() . $this->controller.'/dataRekanan');
            } else {
                alert_failed('Data gagal disimpan.');
                redirect(base_url() . $this->controller.'/dataRekanan');
            }
        }
    }

    public function updateDataRekanan() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $id = decode($post['id']);

            $data = array(
                'nama_rekanan'   => $post['nama_rekanan'],  
                'alamat_rekanan' => $post['alamat_rekanan'],  
                'kota_rekanan'   => $post['kota_rekanan'],  
            );

            $input = $this->MasterData->editData("id_rekanan = $id", $data, 'tbl_rekanan');

            if ($input) {
                alert_success('Data berhasil disimpan.');
                redirect(base_url() . $this->controller.'/dataRekanan');
            } else {
                alert_failed('Data gagal disimpan.');
                redirect(base_url() . $this->controller.'/dataRekanan');
            }
        }
    }

    public function deleteDataRekanan($value = '') {
        if ($this->input->POST()) {
            $id = decode($this->input->POST('id'));
            $where = "id_rekanan = $id";
            $delete = $this->MasterData->deleteData($where, 'tbl_rekanan');
            if ($delete) {
                alert_success('Data berhasil dihapus.');
                echo 'Success';
            } else {
                alert_failed('Data gagal dihapus.');
                echo 'Gagal';
            }
        } else {
            redirect(base_url($this->controller));
        }
    }

    // ======================================================================

    // BARANG MASUK =========================================================

    public function barangMasuk() {

        $this->head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/selects/select2.min.css";
        $this->head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/icheck.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/custom.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js";
        $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js";
        $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/select/select2.full.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        $this->foot[] = base_url('assets/js/icheck_config.js');
        $this->foot[] = base_url('assets/js/data_table.js');
        $this->foot[] = base_url('assets/js/cetak_excel.js');
        $this->foot[] = base_url('assets/js/delete_data.js');
        $this->foot[] = base_url('assets/js/delete_all_data.js');
        // ================================================================
        $script[] = "showDataTable('Data Nota Masuk', '', '".date('dmY')."', [ 0, 4, 5, 6, 7, 8]);";
        $script[] = "$('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy',
                        toggleActive: true,
                        orientation: 'bottom left'
                    });";
        $script[] = '$(".select2").select2();';
        // ================================================================
        $header['css']      = $this->head;
        $footer['js']       = $this->foot;
        $footer['script']   = $script;
        $menu['active']     = '3';

        // ================================================================
        $select = array(
            'so.*',
            "(SELECT rk.nama_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = so.id_rekanan) nama_rekanan",
            "(SELECT rk.alamat_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = so.id_rekanan) alamat_rekanan",
            "(SELECT rk.kota_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = so.id_rekanan) kota_rekanan",
            "(SELECT us.nama_user FROM tbl_user us WHERE us.id_user = so.id_user) nama_kasir",
            "(SELECT COUNT(rc.id_so) FROM tbl_so_rincian rc WHERE rc.id_so = so.id_so) jml_rincian",

            "(SELECT GROUP_CONCAT((SELECT br.harga_barang FROM tbl_barang br WHERE br.id_barang = rc.id_barang) * rc.jml_barang SEPARATOR ';') FROM tbl_so_rincian rc WHERE rc.id_so = so.id_so GROUP BY rc.id_so) harga_barang",

            "(SELECT GROUP_CONCAT((SELECT br.nama_barang FROM tbl_barang br WHERE br.id_barang = rc.id_barang) SEPARATOR ';') FROM tbl_so_rincian rc WHERE rc.id_so = so.id_so GROUP BY rc.id_so) nm_brg",
            "(SELECT GROUP_CONCAT((SELECT br.merk_barang FROM tbl_barang br WHERE br.id_barang = rc.id_barang) SEPARATOR ';') FROM tbl_so_rincian rc WHERE rc.id_so = so.id_so GROUP BY rc.id_so) merk_brg",
            "(SELECT GROUP_CONCAT((SELECT br.satuan_barang FROM tbl_barang br WHERE br.id_barang = rc.id_barang) SEPARATOR ';') FROM tbl_so_rincian rc WHERE rc.id_so = so.id_so GROUP BY rc.id_so) sat_brg",
            "(SELECT GROUP_CONCAT((SELECT br.harga_barang FROM tbl_barang br WHERE br.id_barang = rc.id_barang) SEPARATOR ';') FROM tbl_so_rincian rc WHERE rc.id_so = so.id_so GROUP BY rc.id_so) hrg_brg",
            "(SELECT GROUP_CONCAT(rc.jml_barang SEPARATOR ';') FROM tbl_so_rincian rc WHERE rc.id_so = so.id_so  GROUP BY rc.id_so) jml_brg",
            // "(SELECT SUM((SELECT br.harga_barang FROM tbl_barang br WHERE br.id_barang = rc.id_barang) * rc.jml_barang) FROM tbl_so_rincian rc WHERE rc.id_so = kt.id_so GROUP BY rc.id_so) tot_harga",
        );
        $dataNota = $this->MasterData->getWhereDataOrder($select, 'tbl_so so', "so.id_user = $this->id_user", "so.id_so", "DESC")->result();

        $dataRekanan = $this->MasterData->getSelectData('*', 'tbl_rekanan')->result();

        $content = array(
            'dataNota'   => $dataNota,
            'dataRekanan'   => $dataRekanan,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_barang_masuk',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function simpanBarangMasuk() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $data = array(
                'no_nota'        => $post['no_nota'],  
                'nilai_nota'     => str_replace('.', '', $post['nilai_nota']),  
                'id_rekanan'     => $post['id_rekanan'],  
                'id_user'        => $this->id_user,  
                'tgl_nota'       => date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_nota']))),   
            );

            $input = $this->MasterData->inputData($data,'tbl_so');

            if ($input) {
                alert_success('Data berhasil disimpan.');
                redirect(base_url() . $this->controller.'/barangMasuk');
            } else {
                alert_failed('Data gagal disimpan.');
                redirect(base_url() . $this->controller.'/barangMasuk');
            }
        }
    }

    public function updateBarangMasuk() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $id = decode($post['id']);

            $data = array(
                'no_nota'        => $post['no_nota'],  
                'nilai_nota'     => str_replace('.', '', $post['nilai_nota']),  
                'id_rekanan'     => $post['id_rekanan'],  
                'id_user'        => $this->id_user,  
                'tgl_nota'       => date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_nota']))),   
            );

            $input = $this->MasterData->editData("id_so = $id", $data, 'tbl_so');

            if ($input) {
                alert_success('Data berhasil disimpan.');
                redirect(base_url() . $this->controller.'/barangMasuk');
            } else {
                alert_failed('Data gagal disimpan.');
                redirect(base_url() . $this->controller.'/barangMasuk');
            }
        }
    }

    public function deleteBarangMasuk($value = '') {
        if ($this->input->POST()) {
            $id = decode($this->input->POST('id'));
            $where = "id_so = $id";
            $delete = $this->MasterData->deleteData($where, 'tbl_so');
            if ($delete) {
                alert_success('Data berhasil dihapus.');
                echo 'Success';
            } else {
                alert_failed('Data gagal dihapus.');
                echo 'Gagal';
            }
        } else {
            redirect(base_url($this->controller));
        }
    }

    // ======================================================================

    // RINCIAN BARANG MASUK =================================================

    public function rincianBarangMasuk($id = 0) {
        // $this->load->helper('kodeotomatis');

        $id_so = decode($id);

        $this->head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/selects/select2.min.css";
        $this->head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        // $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        // $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/icheck.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/custom.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js";
        $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js";
        $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js";
        // $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/select/select2.full.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        $this->foot[] = base_url('assets/js/icheck_config.js');
        $this->foot[] = base_url('assets/js/data_table.js');
        $this->foot[] = base_url('assets/js/delete_data.js');
        $this->foot[] = base_url('assets/js/delete_all_data.js');
        // ================================================================
        $script[] = "showDataTable('Rincian Barang Masuk', '', '".date('dmY')."', [ 0, 3, 4, 5, 6, 7, 8, 9]);";
       
        // $script[] = "$('.date-picker').datepicker({
        //                 autoclose: true,
        //                 todayHighlight: true,
        //                 format: 'dd/mm/yyyy',
        //                 toggleActive: true,
        //                 orientation: 'bottom left'
        //             });";
        $script[] = '$(".select2").select2();';
        // ================================================================
        $header['css']      = $this->head;
        $footer['js']       = $this->foot;
        $footer['script']   = $script;
        $menu['active']     = '3';

        // ================================================================

        $select = array(
            'so.*',
            "(SELECT rk.nama_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = so.id_rekanan) nama_rekanan",
        );
        
        $dataNota = $this->MasterData->getWhereData($select, 'tbl_so so', "so.id_so = $id_so")->row();

        $select_rincian = array(
            '*',
            // "(SELECT hst.lokasi_histori FROM tbl_aset_histori hst WHERE hst.id_aset = (SELECT rc.id_aset FROM tbl_aset_rincian rc WHERE rc.id_barang = br.id_barang) ORDER BY hst.tgl_histori DESC, hst.id_aset_histori DESC LIMIT 1) lokasi_aset",
        );
        $dataRincian = $this->MasterData->selectJoinOrder($select_rincian, 'tbl_so_rincian rc', 'tbl_barang br', "rc.id_barang = br.id_barang", "LEFT", "rc.id_so = $id_so", "rc.id_so_rincian", "DESC")->result();

        // $kodeBarang = kodeOtomatis('kode_barang', 'tbl_barang', "id_barang > 0", 'B', 5);

        $content = array(
            'dataRincian'   => $dataRincian,
            'dataNota'      => $dataNota,
            // 'kodeBarang'    => $kodeBarang,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_barang_masuk_rincian',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function simpanRincianBarangMasuk() {
        $this->load->helper('kodeotomatis');
        $post = html_escape($this->input->POST());

        if ($post) {

            $this->db->trans_begin();

            // for ($i=0; $i < (int)$post['jml_barang']; $i++) { 
                $kodeBarang = kodeOtomatis('kode_barang', 'tbl_barang', "id_barang > 0", 'B', 5);
                $data = array(
                    'kode_barang'     => $kodeBarang,
                    'nama_barang'     => $post['nama_barang'],   
                    'merk_barang'     => $post['merk_barang'], 
                    'sn_barang'       => $post['sn_barang'],    
                    'satuan_barang'   => $post['satuan_barang'],   
                    'harga_barang'    => str_replace('.', '', $post['harga_barang']),   
                    'tgl_masuk'       => $post['tgl_nota'],   
                );
    
                $this->MasterData->inputData($data,'tbl_barang');
    
                $id_barang = $this->db->insert_id();
    
                $data = array(
                    'id_so'       => decode($post['id_so']),   
                    'id_barang'   => $id_barang,   
                    'jml_barang'  => str_replace('.', '', $post['jml_barang']),   
                );
    
                $input = $this->MasterData->inputData($data,'tbl_so_rincian');
            // }

            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
                    alert_failed('Data gagal disimpan.');
                    redirect(base_url() . $this->controller.'/rincianBarangMasuk/'. $post['id_so']);
            }
            else
            {
                    $this->db->trans_commit();
                    if ($input) {
                        alert_success('Data berhasil disimpan.');
                        redirect(base_url() . $this->controller.'/rincianBarangMasuk/'. $post['id_so']);
                    } else {
                        alert_failed('Data gagal disimpan.');
                        redirect(base_url() . $this->controller.'/rincianBarangMasuk/'. $post['id_so']);
                    }
            }
        }
    }

    public function updateRincianBarangMasuk() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $this->db->trans_begin();

            $id = decode($post['id']);
            $id_barang = $this->db->query("SELECT id_barang FROM tbl_so_rincian WHERE id_so_rincian = $id")->row()->id_barang;

            $data = array(
                'nama_barang'     => $post['nama_barang'],   
                'merk_barang'     => $post['merk_barang'],   
                'sn_barang'       => $post['sn_barang'],   
                'satuan_barang'   => $post['satuan_barang'],   
                'harga_barang'    => str_replace('.', '', $post['harga_barang']),   
                'tgl_masuk'       => $post['tgl_nota'],   
            );

            $input = $this->MasterData->editData("id_barang = $id_barang", $data, 'tbl_barang');

            $data = array(  
                'jml_barang'    => $post['jml_barang'],   
            );

            $input = $this->MasterData->editData("id_so_rincian = $id", $data, 'tbl_so_rincian');

            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
                    alert_failed('Data gagal disimpan.');
                    redirect(base_url() . $this->controller.'/rincianBarangMasuk/'. $post['id_so']);
            }
            else
            {
                    $this->db->trans_commit();
                    if ($input) {
                        alert_success('Data berhasil disimpan.');
                        redirect(base_url() . $this->controller.'/rincianBarangMasuk/'. $post['id_so']);
                    } else {
                        alert_failed('Data gagal disimpan.');
                        redirect(base_url() . $this->controller.'/rincianBarangMasuk/'. $post['id_so']);
                    }
            }
        }
    }

    public function deleteRincianBarangMasuk($value = '') {
        if ($this->input->POST()) {
            $id = decode($this->input->POST('id'));
            $where = "id_barang = $id";
            $delete = $this->MasterData->deleteData($where, 'tbl_barang');
            if ($delete) {
                alert_success('Data berhasil dihapus.');
                echo 'Success';
            } else {
                alert_failed('Data gagal dihapus.');
                echo 'Gagal';
            }
        } else {
            redirect(base_url($this->controller));
        }
    }

    // ======================================================================

    // DELETE DATA ARRAY ====================================================
    public function deleteAll() {
        if ($this->input->POST()) {
            $post   = $this->input->POST();
            $table  = $post['table'];
            $dataid = $post['dataid'];
            $data   = explode(";", $dataid);

            $this->db->trans_begin();

            $this->db->where_in('id_'.$table, $data);
            $this->db->delete('tbl_'.$table); 

            if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    alert_failed('Data gagal dihapus.');
                    echo 'Gagal';
            } else {
                    $exec = $this->db->trans_commit();
                    if ($exec) {
                        alert_success('Data berhasil dihapus.');
                        echo 'Success';
                    } else {
                        alert_failed('Data gagal dihapus.');
                        echo 'Gagal';
                    }
            }
        } else {
            redirect(base_url($this->controller));
        }
    }

    // =====================================================================

    // DATA BARANG STOK OPNAME ============================================

    public function dataBarangSo() {

        $this->load->helper('searchbar');

        // ===============================================================================

        $this->head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/selects/select2.min.css";
        $this->head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/icheck.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/custom.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        // $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        // $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js";
        // $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js";
        // $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js";
        // $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js";
        // $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/select/select2.full.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        // $this->foot[] = base_url('assets/js/data_table.js');
        // $this->foot[] = base_url('assets/js/delete_all_data.js');
        // $this->foot[] = base_url('assets/js/delete_data.js');
        $this->foot[] = base_url('assets/js/tbl_barang_so.js');
        // ================================================================
        // $script[] = "showDataTable('Data Aset Diskominfo', '', '".date('dmY')."', [ 0, 2, 3, 4]);";
        $script[] = "showDataTable('" . base_url($this->controller.'/getDataBarangSo') . "')";
        $script[] = "function activeIcheck(){ $('.skin-check input').on('ifChecked ifUnchecked', function(event){
                        pilihAset(this, event.type);
                    }).iCheck({
                        checkboxClass: 'icheckbox_flat-green'
                    });}";
        $script[] = "$('.skin-check-all input').on('ifChecked ifUnchecked', function(event){
                        pilihAset(this, event.type);
                    }).iCheck({
                        checkboxClass: 'icheckbox_flat-green'
                    });";
        
        $script[] = "$('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy',
                        toggleActive: true,
                        orientation: 'bottom left'
                    });";
        $script[] = '$(".select2").select2();';
        // ================================================================
        $header['css']      = $this->head;
        $footer['js']       = $this->foot;
        $footer['script']   = $script;
        $menu['active']     = '4';

        // ================================================================

        // $statusAset = $this->MasterData->getWhereData('*', 'tbl_aset_status', "id_aset_status > 0")->result();
        // $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $content = array(
            // 'dataSkpd'        => $dataSkpd,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_barang_so',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function getDataBarangSo() {
        if ($this->input->POST()) {
            $this->load->model("Data_tbl_barang_so", "DataTable");
            $fetch_data = $this->DataTable->make_datatables();

            $data = array();
            $i = $_POST['start'];
            foreach ($fetch_data as $val) {
                $btn = '';
                $i++;

                $cekbox = "<div class='skin skin-check'>
                                <input type='checkbox' id='plh_brg_".$val->id_barang."' name='plh_brg[]' value='".$val->id_barang."'>
                            </div>";

                $btn_histori = ' <button type="button" onclick="historiModal(this)"
                                data-nama="'.$val->nama_barang.'"
                                data-kode="'.$val->kode_barang.'"
                                data-penanggung="'. $val->nama_penanggung .'"
                                data-pemegang="'. $val->pemegang .'"
                                data-ket="'. $val->ket_histori .'"
                                data-keperluan="'. $val->keperluan_histori .'"
                                data-lokasi="'. $val->lokasi_histori .'"
                                data-skpd="'. $val->nama_skpd .'"
                                data-tgl="'. $val->tgl_histori .'"
                                data-jml="'.$val->jml_histori.'"
                                style="margin-bottom: 3px;" class="btn btn-sm btn-success" title="Histori Aset"><i class="la la-history font-small-3"></i></button> ';

                // $btn_hapus = '<button type="button" onclick="hapusData(this)" 
                // data-id="'. encode($val->id_aset) .'" 
                // data-link="'. base_url($this->controller.'/deleteDataAset') .'" 
                // data-csrfname="'. $this->security->get_csrf_token_name() .'" 
                // data-csrfcode="'. $this->security->get_csrf_hash() .'" 
                // style="margin-bottom: 3px;" class="btn btn-sm btn-danger" title="Hapus Data"><i class="la la-trash-o font-small-3"></i></button> ';
                
                // $btn_edit = ' <a href="' . base_url($this->controller.'/editDataAset/' . encode($val->id_aset)) . '" type="button" style="margin-bottom: 3px;" class="btn btn-sm btn-primary" title="Update Data"><i class="la la-edit font-small-3"></i></a> ';

                // $btn_print = ' <a href="' . base_url($this->controller.'/editDataAset/'. $id . '/' . encode($val->id_aset)) . '" type="button" style="margin-bottom: 3px;" class="btn btn-sm btn-warning" title="Cetak Label"><i class="la la-print font-small-3"></i></a> ';

                $btn .= $btn_histori;

                $columns = array(
                    $i,
                    $cekbox,
                    $btn,
                    // '<input type="text" id="ambil_'.$val->id_barang.'" name="ambil_barang" style="width: 70px; text-align: center;" onkeypress="return inputAngka(event);" data-sisa="'.$val->sisa.'" onkeyup="cekVal(this)" disabled>',
                    $val->no_nota,
                    $val->kode_barang,
                    $val->tgl_masuk,
                    $val->nama_barang,
                    $val->merk_barang,
                    $val->sn_barang,
                    $val->satuan_barang,
                    nominal($val->harga_barang),
                    nominal($val->jml_barang),
                    nominal($val->sisa),
                );

                $data[] = $columns;
            }
            $output = array(
                "draw"               =>     $_POST["draw"],
                "recordsTotal"       =>     $this->DataTable->get_all_data(),
                "recordsFiltered"    =>     $this->DataTable->get_filtered_data(),
                "data"               =>     $data
            );
            echo json_encode($output);
        }
    }

    // =====================================================================

    // EKSEKUSI BARANG SO ================================================

    public function formEksekusiBarangSo() {

        $post = $this->input->post();
        if ($post) {
            $data_id = explode(';', $post['data_selected']);
            $this->session->set_userdata('data_id_so', $data_id);
        } else {
            if ($this->session->userdata('data_id_so') != null) {
                $data_id = $this->session->userdata('data_id_so');
            } else {
                redirect(base_url($this->controller.'/dataBarangSo'));
            }
        }

        // ===============================================================================

        $this->head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/selects/select2.min.css";
        $this->head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        $this->head[] = assets_url . "app-assets/css/plugins/forms/wizard.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        // $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/icheck.css";
        // $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/custom.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        // $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        // $this->foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
        // $this->foot[] = assets_url . "app-assets/js/scripts/forms/wizard-steps.js";
        $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/select/select2.full.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/jquery.steps.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        // $this->foot[] = base_url('assets/js/data_table.js');
        // $this->foot[] = base_url('assets/js/delete_data.js');
        // $this->foot[] = base_url('assets/js/'.$dataJenisKib->nama_tbl_kib.'.js');
        // ================================================================
        // $script[] = "showDataTable('Data Aset Diskominfo', '', '".date('dmY')."', [ 0, 2, 3, 4]);";
        // $script[] = "showDataTable('" . base_url($this->controller.'/getDataAset/' . $dataJenisKib->nama_tbl_kib . '/' . encode($id_jenis_kib)) . "')";
        
        $script[] = '$(".tab-steps").steps({
                        headerTag: "h6",
                        bodyTag: "fieldset",
                        transitionEffect: "fade",
                        titleTemplate: "<span class=step>#index#</span> #title#",
                        labels: {
                            finish: "Simpan",
                            next: "Lanjut",
                            previous: "Sebelumnya",
                            loading: "Loading..." 
                        },
                        onFinished: function (event, currentIndex) {
                            formSubmit(this);
                        }
                    });';
        $script[] = "$('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy',
                        toggleActive: true,
                        orientation: 'bottom left'
                    });";
        $script[] = '$(".select2").select2();';
        // $script[] = "$('.skin-check input').on('ifChecked ifUnchecked', function(event){
        //                 pilihAset(this, event.type);
        //             }).iCheck({
        //                 checkboxClass: 'icheckbox_flat-green'
        //             });";
        // $script[] = "$('.skin-radio input').on('ifChecked ifUnchecked', function(event){
        //                 asetUtama(this, event.type);
        //             }).iCheck({
        //                 radioClass: 'iradio_square-red'
        //             });";
        $script[] = '$("#dataTable").DataTable();';
       
        // ================================================================
        $header['css']      = $this->head;
        $footer['js']       = $this->foot;
        $footer['script']   = $script;
        $menu['active']     = '4';

        // ================================================================

        $select = array(
            'brg.id_barang',
            "(sr.jml_barang - IFNULL((SELECT SUM(bj.jml_bj_keluar) FROM tbl_bj_keluar bj WHERE bj.id_barang = brg.id_barang GROUP BY bj.id_barang), 0)) as sisa",
            // 'so.no_nota',
            'brg.kode_barang',
            'DATE_FORMAT(so.tgl_nota, "%d-%m-%Y") as tgl_masuk',
            'brg.nama_barang',
            'brg.merk_barang',
            'brg.sn_barang',
            'brg.satuan_barang',
            'brg.harga_barang',
            'sr.jml_barang',
        ); 

        $dataBarang = $this->db->select($select)
                               ->where("so.id_user = '".$this->id_user."'")
                               ->WHERE_IN('brg.id_barang', $data_id)
                               ->join('tbl_so_rincian sr', 'brg.id_barang = sr.id_barang')
                               ->join('tbl_so so', 'so.id_so = sr.id_so')
                               ->get('tbl_barang brg')->result();
        
        // $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $content = array(
            'dataBarang'     => $dataBarang,
            // 'dataSkpd'       => $dataSkpd,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/form_eksekusi_barang_so',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function eksekusiBarangSo() {
        $post = $this->input->POST();

        if ($post) {
            $this->db->trans_begin();

            if ($post['data_update_barang'] != null && $post['data_update_barang'] != '') {
                $data_update_barang = json_decode(html_entity_decode($post['data_update_barang']), true);

                foreach ($data_update_barang as $val) {
                    // $data = array(
                    //     'nama_barang'   => $val['nama_barang'],
                    //     'merk_barang'   => $val['merk_barang'],
                    //     'sn_barang'     => $val['sn_barang'],
                    // );
                    // $update_barang = $this->MasterData->editData("id_barang = ".$val['id_barang'], $data, 'tbl_barang');

                    $data_bj_keluar = array(
                        'id_barang'            => $val['id_barang'],
                        'id_user'              => $this->id_user,
                        'tgl_bj_keluar'        => date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_bj_keluar']))),
                        'jml_bj_keluar'        => str_replace('.', '', $val['jml_ambil']),
                        'id_skpd'              => $post['id_skpd'],
                        'lokasi_bj_keluar'     => $post['lokasi_bj_keluar'],
                        'keperluan_bj_keluar'  => $post['keperluan_bj_keluar'],
                        'pemegang'             => $post['pemegang'],
                        'ket_bj_keluar'        => $post['ket_bj_keluar'],
                        'jenis_barang'         => 'stokopname',
                    );
                    $input = $this->MasterData->inputData($data_bj_keluar,'tbl_bj_keluar');
                }
            }            

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                alert_failed('Data gagal disimpan.');
                redirect($post['back']);
            }
            else {
                $exec = $this->db->trans_commit();
                if ($exec) {
                    alert_success('Data berhasil disimpan.');
                    redirect($post['back']);
                } else {
                    alert_failed('Data gagal disimpan.');
                    redirect($post['back']);
                }
            }
        }
    }

    // =====================================================================

     // HISTORI BARANG SO ==================================================

    public function historiBarangSo($id = '') {
        $this->load->helper('searchbar');

        $skpd         = $_POST['id_skpd'];
        $tgl_awal     = $_POST['tgl_awal'];
        $tgl_akhir    = $_POST['tgl_akhir'];

        if (isset($skpd) OR ($skpd != null AND $skpd != '' AND !empty($skpd))) {
            $selectSkpd = $skpd;
        } else {
            $selectSkpd = '0';
        }

        if ($tgl_awal != null AND $tgl_awal != '' AND !empty($tgl_awal)) {
            $selectTglAwal = $tgl_awal;
        } else {
            $selectTglAwal = date('01/m/Y');
        }

        if ($tgl_akhir != null AND $tgl_akhir != '' AND !empty($tgl_akhir)) {
            $selectTglAkhir = $tgl_akhir;
        } else {
            $selectTglAkhir = date('d/m/Y');
        }

        $this->head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/selects/select2.min.css";
        $this->head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/icheck.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/custom.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        // $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        // $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js";
        // $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js";
        // $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js";
        // $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js";
        // $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/select/select2.full.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        // $this->foot[] = base_url('assets/js/data_table.js');
        // $this->foot[] = base_url('assets/js/delete_data.js');
        $this->foot[] = base_url('assets/js/delete_all_data.js');
        $this->foot[] = base_url('assets/js/tbl_histori_barang_so.js');
        // ================================================================
        // $script[] = "showDataTable('Data Penempatan Aset', '', '".date('dmY')."', [ 0, 2, 3, 4, 5, 6, 7, 8]);";
        $script[] = "showDataTable('" . base_url($this->controller.'/getDataHistoriBarangSo/' . $selectSkpd . '/' . date('Y-m-d', strtotime(str_replace('/', '-', $selectTglAwal))) . '/' . date('Y-m-d', strtotime(str_replace('/', '-', $selectTglAkhir)))) . "');";

        $script[] = "function activeIcheck(){ $('.skin-check input').on('ifChecked ifUnchecked', function(event){
                        pilihBarang(this, event.type);
                    }).iCheck({
                        checkboxClass: 'icheckbox_flat-green'
                    });}";
        $script[] = "$('.skin-check-all input').on('ifChecked ifUnchecked', function(event){
                        pilihBarang(this, event.type);
                    }).iCheck({
                        checkboxClass: 'icheckbox_flat-green'
                    });";
        $script[] = "$('.date-range').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy',
                        toggleActive: true,
                        orientation: 'bottom left'
                    });";
        $script[] = '$(".select2").select2({ dropdownCssClass: "sizeFontSm" });';
        // ================================================================
        $header['css']      = $this->head;
        $footer['js']       = $this->foot;
        $footer['script']   = $script;
        $menu['active']     = '5';

        // ================================================================
        $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $content = array(
            'selectSkpd'     => $selectSkpd,
            'selectTglAwal'  => $selectTglAwal,
            'selectTglAkhir' => $selectTglAkhir,
            'dataSkpd'       => $dataSkpd,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/histori_barang_so',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function getDataHistoriBarangSo($skpd='', $tgl_awal='', $tgl_akhir='')
    {
        if ($this->input->POST()) {
            $this->load->model("Data_tbl_histori_barang_so", "DataTable");
            $fetch_data = $this->DataTable->make_datatables($skpd, $tgl_awal, $tgl_akhir);

            $data = array();
            $i = $_POST['start'];
            foreach ($fetch_data as $val) {
                $i++;
                $cekbox = "<div class='skin skin-check'>
                                <input type='checkbox' id='plh_brg_".$val->id_bj_keluar."' name='plh_brg[]' value='".$val->id_bj_keluar."'>
                            </div>";

                $columns = array(
                    $i,
                    $cekbox,
                    $val->tgl_bj_keluar,
                    $val->no_nota,
                    $val->kode_barang,
                    $val->nama_barang,
                    ($val->merk_barang=='' && $val->merk_barang==null)?'-':$val->merk_barang,
                    ($val->sn_barang=='' && $val->sn_barang==null)?'-':$val->sn_barang,
                    $val->satuan_barang,
                    $val->jml_bj_keluar,
                    // $val->nama_skpd,
                    $val->lokasi_bj_keluar,
                    $val->pemegang,
                    $val->user_penanggung,
                    $val->keperluan_bj_keluar,
                    ($val->ket_bj_keluar=='' && $val->ket_bj_keluar==null)?'-':$val->ket_bj_keluar,
                );

                $data[] = $columns;
            }
            $output = array(
                "draw"               =>     $_POST["draw"],
                "recordsTotal"       =>     $this->DataTable->get_all_data($skpd, $tgl_awal, $tgl_akhir),
                "recordsFiltered"    =>     $this->DataTable->get_filtered_data($skpd, $tgl_awal, $tgl_akhir),
                "data"               =>     $data
            );
            echo json_encode($output);
        }
    }

    // =====================================================================

    // EDIT PROFIL =========================================================

    public function dataProfil() {

        $header['css'] = $this->head;
        $footer['js'] = $this->foot;
        $menu['active'] = '0';

        // ========================================

        $dataUser = $this->MasterData->getWhereData('*', 'tbl_user', "id_user = ".$this->id_user)->row();

        $content = array(
            'dataUser'  => $dataUser,
        );

        $data = array(
            'header' => $header,
            'menu'   => $menu,
            'konten' => 'data_profil',
            'footer' => $footer,
            'cont'   => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function simpanProfil() {
        $post = $this->input->POST();
        
        if ($post) {
            $simpanUser = $this->MasterData->editData("id_user = $this->id_user", $post, 'tbl_user');

            if ($simpanUser) {
                alert_success('Data berhasil disimpan.');
                redirect(base_url($this->controller.'/dataProfil'));
            } else {
                alert_failed('Data gagal disimpan.');
                redirect(base_url($this->controller.'/dataProfil'));
            }
        } else {
            alert_failed('Data gagal disimpan.');
            redirect(base_url($this->controller.'/dataProfil'));
        }
    }

    // =====================================================================

    // AKUN LOGIN ==========================================================

    public function akunLogin() {

        $this->head[] = assets_url . "app-assets/css/plugins/forms/validation/form-validation.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/validation/jqBootstrapValidation.js";
        $this->foot[] = assets_url . "app-assets/js/scripts/forms/validation/form-validation.js";

        $header['css'] = $this->head;
        $footer['js'] = $this->foot;
        $menu['active'] = '0';

        // ========================================

        $dataUser = $this->MasterData->getWhereData('*', 'tbl_user', "id_user = ".$this->id_user)->row();

        $content = array(
            'dataUser'  => $dataUser,
        );

        $data = array(
            'header' => $header,
            'menu'   => $menu,
            'konten' => 'akun_login',
            'footer' => $footer,
            'cont'   => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function simpanAkunLogin() {
        $post = $this->input->POST();
        
        if ($post) {
            $oldPass = $this->MasterData->getWhereData('password','tbl_user',"id_user = $this->id_user")->row()->password;

            if ($oldPass == md5($post['pass_old'])) {
                $data = array(
                    'username'  => $post['username'],
                    'password'  => md5($post['pass_new']),
                );
                $simpanUser = $this->MasterData->editData("id_user = $this->id_user", $data, 'tbl_user');

                if ($simpanUser) {
                    alert_success('Data berhasil disimpan.');
                    redirect(base_url($this->controller.'/akunLogin'));
                } else {
                    alert_failed('Data gagal disimpan.');
                    redirect(base_url($this->controller.'/akunLogin'));
                }
            } else {
                alert_failed('Data gagal disimpan. Password lama tidak sesuai');
                redirect(base_url($this->controller.'/akunLogin'));
            }
        } else {
            alert_failed('Data gagal disimpan.');
            redirect(base_url($this->controller.'/akunLogin'));
        }
    }

    // =====================================================================
}
