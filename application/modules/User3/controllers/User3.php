<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(null);

class User3 extends Adm_Controller
{

    function __construct()
    {
        parent::__construct();

		$this->secure->auth('Sim_asset_User3');

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

        $dataKib = $this->MasterData->getData('tbl_jenis_kib')->result();

        $menu = array(
            'dataKib' => $dataKib,
        );
        $this->load->view('menu', $menu, TRUE);

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

        //JML ASET
        $select = array(
            'kib.nama_kib as jenis_aset', 
            "COUNT(ast.id_aset) as jml_aset",
        );
        $data_aset = $this->db->SELECT($select)
                              ->JOIN('tbl_aset ast', "kib.id_jenis_kib = ast.id_jenis_kib", 'LEFT')
                              ->group_by('kib.id_jenis_kib')
                              ->GET('tbl_jenis_kib kib')->result();

        $content = array(
            'data_aset'     => $data_aset,
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

    // DATA ASET ==============================================================

    public function dataAset($id = '') {

        $this->load->helper('searchbar');

        $id_jenis_kib = decode($id);

        $kib = $this->MasterData->getWhereData('*', 'tbl_jenis_kib', "id_jenis_kib = $id_jenis_kib");

        $cekKib = $kib->num_rows();

        if ($cekKib==0) {
            redirect(base_url('User3/dataAset/'.encode(1)));
        }

        $dataJenisKib = $kib->row();

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
        $this->foot[] = base_url('assets/js/delete_all_data.js');
        $this->foot[] = base_url('assets/js/delete_data.js');
        $this->foot[] = base_url('assets/js/'.$dataJenisKib->nama_tbl_kib.'.js');
        // ================================================================
        // $script[] = "showDataTable('Data Aset Diskominfo', '', '".date('dmY')."', [ 0, 2, 3, 4]);";
        $script[] = "showDataTable('" . base_url('User3/getDataAset/' . $dataJenisKib->nama_tbl_kib . '/' . encode($id_jenis_kib)) . "')";
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
        $menu['active']     = '2';
        $menu['active_sub']     = '2.'.$id_jenis_kib;

        // ================================================================
        
        // $select = array(
        //     'ast.*',
        //     'kib.*',
        //     "(SELECT SUM(br.harga_barang) FROM tbl_barang br WHERE br.id_barang IN (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset)) harga_aset",
        // );
        // $dataAset = $this->MasterData->selectJoinOrder($select, 'tbl_aset ast', $dataJenisKib->nama_tbl_kib.' kib', "ast.id_kib = kib.id_kib", 'LEFT', "ast.id_jenis_kib = $id_jenis_kib", 'ast.id_aset', 'DESC')->result();

        $statusAset = $this->MasterData->getWhereData('*', 'tbl_aset_status', "id_aset_status > 0")->result();
        $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $content = array(
            'id_jenis_kib'   => $id_jenis_kib,
            'dataJenisKib'   => $dataJenisKib,
            'statusAset'     => $statusAset,
            'dataSkpd'       => $dataSkpd,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_aset',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function addDataAset($id = '') {

        $id_jenis_kib = decode($id);

        $kib = $this->MasterData->getWhereData('*', 'tbl_jenis_kib', "id_jenis_kib = $id_jenis_kib");

        $cekKib = $kib->num_rows();

        if ($cekKib==0) {
            redirect(base_url('User3/dataAset/'.encode(1)));
        }

        $dataJenisKib = $kib->row();

        // ===============================================================================

        $this->head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/selects/select2.min.css";
        $this->head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        $this->head[] = assets_url . "app-assets/css/plugins/forms/wizard.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/icheck.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/custom.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        // $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
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
        // $script[] = "showDataTable('" . base_url('User3/getDataAset/' . $dataJenisKib->nama_tbl_kib . '/' . encode($id_jenis_kib)) . "')";
        $script[] = "$('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy',
                        toggleActive: true,
                        orientation: 'bottom left'
                    });";
        $script[] = '$(".select2").select2();';
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
        $script[] = "$('.skin-check input').on('ifChecked ifUnchecked', function(event){
                        pilihAset(this, event.type);
                    }).iCheck({
                        checkboxClass: 'icheckbox_flat-green'
                    });";
        $script[] = "$('.skin-radio input').on('ifChecked ifUnchecked', function(event){
                        asetUtama(this, event.type);
                    }).iCheck({
                        radioClass: 'iradio_square-red'
                    });";
        $script[] = '$("#dataTable").DataTable();';
       
        // ================================================================
        $header['css']      = $this->head;
        $footer['js']       = $this->foot;
        $footer['script']   = $script;
        $menu['active']     = '2';
        $menu['active_sub']     = '2.'.$id_jenis_kib;

        // ================================================================
        $select = array(
            '*',
            "(SELECT kt.no_kontrak FROM tbl_kontrak kt WHERE kt.id_kontrak = pd.id_kontrak) no_kontrak",
        );
        $dataBarang = $this->MasterData->selectJoinOrder($select, 'tbl_pengadaan pd', 'tbl_barang br', "pd.id_barang = br.id_barang", "LEFT", "br.id_barang NOT IN (SELECT ar.id_barang FROM tbl_aset_rincian ar)", "pd.id_pengadaan", "DESC")->result();

        $content = array(
            'id_jenis_kib'   => $id_jenis_kib,
            'dataJenisKib'   => $dataJenisKib,
            'dataBarang'     => $dataBarang,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/form_kib',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function editDataAset($kib = '', $id = '') {

        $id_aset = decode($id);
        $id_jenis_kib = decode($kib);

        $kib = $this->MasterData->getWhereData('*', 'tbl_jenis_kib', "id_jenis_kib = $id_jenis_kib");

        $cekKib = $kib->num_rows();

        if ($cekKib==0) {
            redirect(base_url('User3/dataAset/'.encode(1)));
        }

        $dataJenisKib = $kib->row();

        // ===============================================================================

        $this->head[] = assets_url . "app-assets/css/plugins/animate/animate.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/selects/select2.min.css";
        $this->head[] = assets_url . "app-assets/vendors/css/tables/datatable/datatables.min.css";
        $this->head[] = assets_url . "app-assets/css/plugins/forms/wizard.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css";
        $this->head[] = assets_url . "app-assets/vendors/bootstrap-datepicker/style-datepicker.css";
        $this->head[] = assets_url . "app-assets/vendors/css/extensions/sweetalert.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/icheck.css";
        $this->head[] = assets_url . "app-assets/vendors/css/forms/icheck/custom.css";
        // ================================================================
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/datatables.min.js";
        // $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
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
        // $script[] = "showDataTable('" . base_url('User3/getDataAset/' . $dataJenisKib->nama_tbl_kib . '/' . encode($id_jenis_kib)) . "')";
        $script[] = "$('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true,
                        format: 'dd/mm/yyyy',
                        toggleActive: true,
                        orientation: 'bottom left'
                    });";
        $script[] = '$(".select2").select2();';
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
        $script[] = "$('.skin-check input').on('ifChecked ifUnchecked', function(event){
                        pilihAset(this, event.type);
                    }).iCheck({
                        checkboxClass: 'icheckbox_flat-green'
                    });";
        $script[] = "$('.skin-radio input').on('ifChecked ifUnchecked', function(event){
                        asetUtama(this, event.type);
                    }).iCheck({
                        radioClass: 'iradio_square-red'
                    });";
       
        $script[] = '$("#dataTable").DataTable();';
        // ================================================================
        $header['css']      = $this->head;
        $footer['js']       = $this->foot;
        $footer['script']   = $script;
        $menu['active']     = '2';
        $menu['active_sub']     = '2.'.$id_jenis_kib;

        // ================================================================
        
        $select = array(
            'ast.*',
            "(SELECT SUM(br.harga_barang) FROM tbl_barang br WHERE br.id_barang IN (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset)) as harga_aset",
        );
        $dataAset = $this->MasterData->getWhereData($select, 'tbl_aset ast', "id_aset = $id_aset")->row();

        $select = array(
            "GROUP_CONCAT(id_barang SEPARATOR ';') as pilih_barang",
            "GROUP_CONCAT(jml_barang SEPARATOR ';') as pilih_jml_barang",
            "(SELECT ac.id_barang FROM tbl_aset_rincian ac WHERE ac.id_aset = ar.id_aset AND posisi = 1) as utama",
        );
        $dataRincian = $this->MasterData->getWhereData($select, 'tbl_aset_rincian ar', "id_aset = $id_aset")->row();

        $dataKib = $this->MasterData->getWhereData('*', $dataJenisKib->nama_tbl_kib, "id_kib = $dataAset->id_kib")->row();
        
        $select = array(
            '*',
            "(SELECT kt.no_kontrak FROM tbl_kontrak kt WHERE kt.id_kontrak = pd.id_kontrak) no_kontrak",
            "(SELECT COUNT(ar.id_barang) FROM tbl_aset_rincian ar WHERE ar.id_barang = br.id_barang AND id_aset = $id_aset) cek",
            "(SELECT COUNT(ar.id_barang) FROM tbl_aset_rincian ar WHERE ar.id_barang = br.id_barang AND ar.posisi = 1 AND id_aset = $id_aset) utama",
        );
        $dataBarang = $this->MasterData->selectJoinOrder($select, 'tbl_pengadaan pd', 'tbl_barang br', "pd.id_barang = br.id_barang", "LEFT", "br.id_barang NOT IN (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset <> $id_aset)", "pd.id_pengadaan", "DESC")->result();

        $content = array(
            'id_jenis_kib'   => $id_jenis_kib,
            'dataJenisKib'   => $dataJenisKib,
            'dataAset'       => $dataAset,
            'dataBarang'     => $dataBarang,
            'dataRincian'    => $dataRincian,
            'dataKib'        => $dataKib,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/form_kib_edit',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function simpanDataAset() {
        $post = html_escape($this->input->POST());

        // echo json_encode($post);exit();

        if ($post) {

            $this->db->trans_begin();

            $data_kib = array();
            foreach ($post as $key => $val) {
                if (
                    $key!='pilih_aset' && 
                    $key!='pilih_jml_aset' &&
                    $key!='aset_utama' && 
                    $key!='kib' && 
                    $key!='tbl_kib' && 
                    $key!='data_update_barang' && 
                    $key!='nama_barang' && 
                    $key!='merk_barang' && 
                    $key!='sn_barang' && 
                    $key!='satuan_barang' && 
                    $key!='dataTable_length' && 
                    $key!='plh_ast' && 
                    $key!='ast_utm' && 
                    $key!='nama_aset' && 
                    $key!='jml_aset' && 
                    $key!='kode_baru_aset' && 
                    $key!='no_reg' && 
                    $key!='status_masuk_aset' && 
                    $key!='satuan_aset' && 
                    $key!='ket_aset' 
                ) {
                    if ($key=='harga') {
                        $data_kib[$key] = str_replace('.', '', $val);
                    } else {
                        $data_kib[$key] = $val;
                    }
                }
            }

            $input = $this->MasterData->inputData($data_kib, $post['tbl_kib']);

            $id_kib = $this->db->insert_id();

            $data_aset = array(
                'id_jenis_kib'      => $post['kib'],  
                'id_kib'            => $id_kib,  
                'nama_aset'         => $post['nama_aset'],  
                'jml_aset'          => $post['jml_aset'],  
                'satuan_aset'       => $post['satuan_aset'],  
                'kode_baru_aset'    => $post['kode_baru_aset'],  
                'no_reg'            => $post['no_reg'],  
                'status_masuk_aset' => $post['status_masuk_aset'],  
                'ket_aset'          => $post['ket_aset'],  
            );

            $input = $this->MasterData->inputData($data_aset,'tbl_aset');

            $id_aset = $this->db->insert_id();

            if ($post['status_masuk_aset'] != 'pengadaan') {
                $data_brg = array(
                    'nama_barang'   => $post['nama_aset'],
                    'satuan_barang' => $post['satuan_aset'],
                    'harga_barang'  => str_replace('.', '', $post['harga']),
                    'tgl_masuk'     => date('Y-m-d'),
                );
                $input = $this->MasterData->inputData($data_brg,'tbl_barang');

                $id_barang = $this->db->insert_id();

                $data_rincian = array(
                    'id_aset'       => $id_aset,
                    'id_barang'     => $id_barang,
                    'jml_barang'    => $post['jml_aset'],
                    'posisi'        => 1
                );
                $input = $this->MasterData->inputData($data_rincian,'tbl_aset_rincian');

            } else {

                if ($post['data_update_barang'] != null && $post['data_update_barang'] != '') {
                    $data_update_barang = json_decode(html_entity_decode($post['data_update_barang']), true);
    
                    foreach ($data_update_barang as $val) {
                        $data = array(
                            'nama_barang'   => $val['nama_barang'],
                            'merk_barang'   => $val['merk_barang'],
                            'sn_barang'     => $val['sn_barang'],
                            'satuan_barang' => $val['satuan_barang'],
                        );
                        $update = $this->MasterData->editData("id_barang = ".$val['id_barang'], $data, 'tbl_barang');
                    }
                }

                $rincian_barang = explode(';', $post['pilih_aset']);
                $rincian_jml_barang = explode(';', $post['pilih_jml_aset']);

                foreach ($rincian_barang as $key => $val) {
                    $data_rincian = array(
                        'id_aset'       => $id_aset,
                        'id_barang'     => $val,
                        // 'jml_barang'    => $rincian_jml_barang[$key],
                        'posisi'        => ($val==$post['aset_utama'])?1:2
                    );
                    $input = $this->MasterData->inputData($data_rincian,'tbl_aset_rincian');
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                alert_failed('Data gagal disimpan.');
                redirect(base_url() . 'User3/dataAset/'. encode($post['kib']));
            }
            else {
                $input = $this->db->trans_commit();
                if ($input) {
                    alert_success('Data berhasil disimpan.');
                    redirect(base_url() . 'User3/dataAset/'. encode($post['kib']));
                } else {
                    alert_failed('Data gagal disimpan.');
                    redirect(base_url() . 'User3/dataAset/'. encode($post['kib']));
                }
            }
        }
    }

    public function updateDataAset() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $id_aset = decode($post['id_aset']);
            $id_kib = decode($post['id_kib']);

            $this->db->trans_begin();

            $data_kib = array();
            foreach ($post as $key => $val) {
                if (
                    $key!='id_aset' && 
                    $key!='id_kib' && 
                    $key!='pilih_aset' && 
                    $key!='pilih_jml_aset' &&
                    $key!='aset_utama' && 
                    $key!='kib' && 
                    $key!='tbl_kib' && 
                    $key!='data_update_barang' && 
                    $key!='nama_barang' && 
                    $key!='merk_barang' && 
                    $key!='sn_barang' && 
                    $key!='satuan_barang' && 
                    $key!='dataTable_length' && 
                    $key!='plh_ast' && 
                    $key!='ast_utm' && 
                    $key!='nama_aset' && 
                    $key!='jml_aset' && 
                    $key!='kode_baru_aset' && 
                    $key!='no_reg' && 
                    $key!='status_masuk_aset' && 
                    $key!='satuan_aset' && 
                    $key!='ket_aset' 
                ) {
                    if ($key=='harga') {
                        $data_kib[$key] = str_replace('.', '', $val);
                    } else {
                        $data_kib[$key] = $val;
                    }
                }
            }

            $input = $this->MasterData->editData("id_kib = $id_kib", $data_kib, $post['tbl_kib']);

            $data_aset = array(
                'id_jenis_kib'      => $post['kib'],  
                'id_kib'            => $id_kib,  
                'nama_aset'         => $post['nama_aset'],  
                'jml_aset'          => $post['jml_aset'],  
                'satuan_aset'       => $post['satuan_aset'],  
                'kode_baru_aset'    => $post['kode_baru_aset'],  
                'no_reg'            => $post['no_reg'],  
                'status_masuk_aset' => $post['status_masuk_aset'],  
                'ket_aset'          => $post['ket_aset'],  
            );

            $input = $this->MasterData->editData("id_aset = $id_aset", $data_aset, 'tbl_aset');

            if ($post['status_masuk_aset'] != 'pengadaan') {
                $id_barang = $post['pilih_aset'];
                $data_brg = array(
                    'nama_barang'   => $post['nama_aset'],
                    'satuan_barang' => $post['satuan_aset'],
                    'harga_barang'  => str_replace('.', '', $post['harga']),
                    'tgl_masuk'     => date('Y-m-d'),
                );
                $input = $this->MasterData->editData("id_barang = $id_barang", $data_brg, 'tbl_barang');

                $data_rincian = array(
                    // 'id_aset'       => $id_aset,
                    // 'id_barang'     => $id_barang,
                    'jml_barang'    => $post['jml_aset'],
                    'posisi'        => 1
                );
                $input = $this->MasterData->editData("id_barang = $id_barang AND id_aset = $id_aset", $data_rincian, 'tbl_aset_rincian');

            } else {
                if ($post['data_update_barang'] != null && $post['data_update_barang'] != '') {
                    $data_update_barang = json_decode(html_entity_decode($post['data_update_barang']), true);
    
                    foreach ($data_update_barang as $val) {
                        $data = array(
                            'nama_barang'   => $val['nama_barang'],
                            'merk_barang'   => $val['merk_barang'],
                            'sn_barang'     => $val['sn_barang'],
                            'satuan_barang' => $val['satuan_barang'],
                        );
                        $update = $this->MasterData->editData("id_barang = ".$val['id_barang'], $data, 'tbl_barang');
                    }
                }

                $deleteRincian = $this->MasterData->deleteData("id_aset = $id_aset", 'tbl_aset_rincian');

                $rincian_barang = explode(';', $post['pilih_aset']);
                $rincian_jml_barang = explode(';', $post['pilih_jml_aset']);

                foreach ($rincian_barang as $key => $val) {
                    $data_rincian = array(
                        'id_aset'       => $id_aset,
                        'id_barang'     => $val,
                        // 'jml_barang'    => $rincian_jml_barang[$key],
                        'posisi'        => ($val==$post['aset_utama'])?1:2
                    );
                    $input = $this->MasterData->inputData($data_rincian,'tbl_aset_rincian');
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                alert_failed('Data gagal disimpan.');
                redirect(base_url() . 'User3/dataAset/'. encode($post['kib']));
            }
            else {
                $input = $this->db->trans_commit();
                if ($input) {
                    alert_success('Data berhasil disimpan.');
                    redirect(base_url() . 'User3/dataAset/'. encode($post['kib']));
                } else {
                    alert_failed('Data gagal disimpan.');
                    redirect(base_url() . 'User3/dataAset/'. encode($post['kib']));
                }
            }
        }
    }

    public function deleteDataAset($value = '') {
        if ($this->input->POST()) {

            $this->db->trans_begin();

            $id = decode($this->input->POST('id'));
            
            $cekAset = $this->MasterData->getWhereData('*', 'tbl_aset', "id_aset = $id")->row();

            $tblKib = $this->MasterData->getWhereData('*', 'tbl_jenis_kib', "id_jenis_kib = $cekAset->id_jenis_kib")->row()->nama_tbl_kib; 

            $deleteKib = $this->MasterData->deleteData("id_kib = $cekAset->id_kib", $tblKib);
            $deleteAset = $this->MasterData->deleteData("id_aset = $id", 'tbl_aset');

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                alert_failed('Data gagal dihapus.');
                echo 'Gagal';
            }
            else {
                $delete = $this->db->trans_commit();
                if ($delete) {
                    alert_success('Data berhasil dihapus.');
                    echo 'Success';
                } else {
                    alert_failed('Data gagal dihapus.');
                    echo 'Gagal';
                }
            }

        } else {
            redirect(base_url('User3'));
        }
    }

    public function deleteAsetAll() {
        if ($this->input->POST()) {
            $post   = $this->input->POST();
            $table  = $post['table'];
            $dataid = $post['dataid'];
            $data   = explode(";", $dataid);

            $this->db->trans_begin();

            foreach ($data as $id) {
                $cekAset = $this->MasterData->getWhereData('*', 'tbl_aset', "id_aset = $id")->row();

                $tblKib = $this->MasterData->getWhereData('*', 'tbl_jenis_kib', "id_jenis_kib = $cekAset->id_jenis_kib")->row()->nama_tbl_kib; 

                $deleteKib = $this->MasterData->deleteData("id_kib = $cekAset->id_kib", $tblKib);
                $deleteAset = $this->MasterData->deleteData("id_aset = $id", 'tbl_aset');
            }

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
            redirect(base_url('User3'));
        }
    }

    public function getDataAset($tbl='', $id='') {
        if ($this->input->POST()) {
            $id_jenis_kib = decode($id);
            $this->load->model("Data_tbl_kib", "DataTable");
            $fetch_data = $this->DataTable->make_datatables($tbl, $id_jenis_kib);

            $data = array();
            $i = $_POST['start'];
            foreach ($fetch_data as $val) {
                $btn = '';
                $i++;

                $cekbox = "<div class='skin skin-check'>
                                <input type='checkbox' name='plh_ast[]' value='".$val->id_aset."' data-jenis='".$id_jenis_kib."'>
                            </div>";

                $btn_detail = ' <button type="button" onclick="rincianModal(this)"
                data-namaaset="'.$val->nama_aset.'"
                data-kode="'.$val->kode_baru_aset.'"
                data-noreg="'.$val->no_reg.'"
                data-nama="'. $val->nm_brg .'"
                data-merk="'. $val->merk_brg .'"
                data-sn="'. $val->sn_brg .'"
                data-satuan="'. $val->sat_brg .'"
                data-harga="'. $val->hrg_brg .'"
                style="margin-bottom: 3px;" class="btn btn-sm btn-info" title="Detail Barang"><i class="la la-eye font-small-3"></i></button> ';

                $btn_histori = ' <button type="button" onclick="historiModal(this)"
                data-namaaset="'.$val->nama_aset.'"
                data-kode="'.$val->kode_baru_aset.'"
                data-noreg="'.$val->no_reg.'"
                data-penanggung="'. $val->nama_penanggung .'"
                data-pemegang="'. $val->pemegang .'"
                data-ket="'. $val->ket_histori .'"
                data-keperluan="'. $val->keperluan_histori .'"
                data-lokasi="'. $val->lokasi_histori .'"
                data-skpd="'. $val->nama_skpd .'"
                data-tgl="'. $val->tgl_histori .'"
                style="margin-bottom: 3px;" class="btn btn-sm btn-success" title="Histori Aset"><i class="la la-history font-small-3"></i></button> ';

                // $btn_print = ' <a href="' . base_url('User3/cetakLabelAset/'. encode($val->id_aset)) . '" type="button" style="margin-bottom: 3px;" class="btn btn-sm btn-warning" title="Cetak Label"><i class="la la-print font-small-3"></i></a> ';

                $btn .= $btn_detail;
                $btn .= $btn_histori;
                // $btn .= $btn_print;

                $columns = array(
                    $i,
                    $cekbox,
                    $btn,
                    $val->nama_aset,
                    ($val->kode_lama_aset=='' && $val->kode_lama_aset==null)?'-':$val->kode_lama_aset,
                    $val->kode_baru_aset,
                    $val->no_reg,
                    // $val->jml_aset,
                    $val->satuan_aset,
                );

                if ($id_jenis_kib == 1) {
                    $columns[] = $val->luas_tanah;
                    $columns[] = $val->thn_beli;
                    $columns[] = $val->letak;
                    $columns[] = $val->status_tanah;
                    $columns[] = date('d/m/Y', strtotime(str_replace('/', '-', $val->tgl_sertifikat)));
                    $columns[] = $val->no_sertifikat;
                    $columns[] = $val->penggunaan;
                } else if ($id_jenis_kib == 2) {
                    $columns[] = $val->sn_aset;
                    $columns[] = $val->merk_type;
                    $columns[] = $val->ukuran_cc;
                    $columns[] = $val->bahan;
                    $columns[] = $val->warna;
                    $columns[] = $val->thn_beli;
                    $columns[] = ($val->no_pabrik==''&&$val->no_pabrik==null)?'-':$val->no_pabrik;
                    $columns[] = ($val->no_rangka==''&&$val->no_rangka==null)?'-':$val->no_rangka;
                    $columns[] = ($val->no_mesin==''&&$val->no_mesin==null)?'-':$val->no_mesin;
                    $columns[] = ($val->no_polisi==''&&$val->no_polisi==null)?'-':$val->no_polisi;
                    $columns[] = ($val->no_bpkb==''&&$val->no_bpkb==null)?'-':$val->no_bpkb;
                } else if ($id_jenis_kib == 3) {
                    $columns[] = $val->kondisi;
                    $columns[] = $val->bertingkat;
                    $columns[] = $val->beton;
                    $columns[] = $val->luas_lantai;
                    $columns[] = $val->letak;
                    $columns[] = date('d/m/Y', strtotime(str_replace('/', '-', $val->tgl_dokumen)));
                    $columns[] = $val->no_dokumen;
                    $columns[] = $val->luas_bangunan;
                    $columns[] = $val->status_tanah;
                    $columns[] = $val->no_kode_tanah;
                } else if ($id_jenis_kib == 4) {
                    $columns[] = ($val->kondisi==''&&$val->kondisi==null)?'-':$val->kondisi;
                    $columns[] = $val->konstruksi;
                    $columns[] = $val->panjang;
                    $columns[] = $val->lebar;
                    $columns[] = $val->luas;
                    $columns[] = $val->letak;
                    $columns[] = date('d/m/Y', strtotime(str_replace('/', '-', $val->tgl_dokumen)));
                    $columns[] = ($val->no_dokumen==''&&$val->no_dokumen==null)?'-':$val->no_dokumen;
                    $columns[] = $val->status_tanah;
                    $columns[] = ($val->no_kode_tanah==''&&$val->no_kode_tanah==null)?'-':$val->no_kode_tanah;
                } else if ($id_jenis_kib == 5) {
                    $columns[] = $val->judul_buku;
                    $columns[] = $val->spesifikasi_buku;
                    $columns[] = $val->asal_seni;
                    $columns[] = $val->pencipta_seni;
                    $columns[] = $val->bahan_seni;
                    $columns[] = $val->jenis_hewan_tumbuhan;
                    $columns[] = $val->ukuran_hewan_tumbuhan;
                    $columns[] = $val->jumlah;
                    $columns[] = $val->thn_beli;
                } else {
                    $columns[] = $val->kondisi;
                    $columns[] = $val->bertingkat;
                    $columns[] = $val->beton;
                    $columns[] = $val->luas_lantai;
                    $columns[] = $val->letak;
                    $columns[] = date('d/m/Y', strtotime(str_replace('/', '-', $val->tgl_dokumen)));
                    $columns[] = $val->no_dokumen;
                    $columns[] = date('d/m/Y', strtotime(str_replace('/', '-', $val->tgl_mulai)));
                    $columns[] = $val->status_tanah;
                    $columns[] = $val->no_kode_tanah;
                }

                $columns[] = $val->asal_usul;
                $columns[] = nominal($val->harga_aset);
                $columns[] = $val->ket_aset;

                $data[] = $columns;
            }
            $output = array(
                "draw"               =>     $_POST["draw"],
                "recordsTotal"       =>     $this->DataTable->get_all_data($id_jenis_kib),
                "recordsFiltered"    =>     $this->DataTable->get_filtered_data($tbl, $id_jenis_kib),
                "data"               =>     $data
            );
            echo json_encode($output);
        }
    }

    // =====================================================================

    // HISTORI ASET ========================================================

    public function historiAset($id = '') {
        $this->load->helper('searchbar');

        $skpd         = $_POST['id_skpd'];
        $status       = $_POST['status'];
        $jenis        = $_POST['jenis'];
        $tgl_awal     = $_POST['tgl_awal'];
        $tgl_akhir    = $_POST['tgl_akhir'];

        if (isset($skpd) OR ($skpd != null AND $skpd != '' AND !empty($skpd))) {
            $selectSkpd = $skpd;
        } else {
            $selectSkpd = '0';
        }

        if (isset($status) OR ($status != null AND $status != '' AND !empty($status))) {
            $selectStatus = $status;
        } else {
            $selectStatus = '0';
        }

        if (isset($jenis) OR ($jenis != null AND $jenis != '' AND !empty($jenis))) {
            $selectJenis = $jenis;
        } else {
            $selectJenis = '0';
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
        $this->foot[] = base_url('assets/js/tbl_histori_aset.js');
        // ================================================================
        // $script[] = "showDataTable('Data Penempatan Aset', '', '".date('dmY')."', [ 0, 2, 3, 4, 5, 6, 7, 8]);";
        $script[] = "showDataTable('" . base_url($this->controller.'/getDataHistori/' . $selectStatus . '/' . $selectJenis . '/' . $selectSkpd . '/' . date('Y-m-d', strtotime(str_replace('/', '-', $selectTglAwal))) . '/' . date('Y-m-d', strtotime(str_replace('/', '-', $selectTglAkhir)))) . "');";

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
        $menu['active']     = '3';

        // ================================================================

        $dataStatusAset = $this->MasterData->getWhereData('*', 'tbl_aset_status', "id_aset_status > 0")->result();
        $dataJenisAset = $this->MasterData->getWhereData('*', 'tbl_jenis_kib', "id_jenis_kib > 0")->result();
        $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $content = array(
            'selectSkpd'     => $selectSkpd,
            'selectStatus'   => $selectStatus,
            'selectJenis'    => $selectJenis,
            'selectTglAwal'  => $selectTglAwal,
            'selectTglAkhir' => $selectTglAkhir,
            'dataStatusAset' => $dataStatusAset,
            'dataJenisAset'  => $dataJenisAset,
            'dataSkpd'       => $dataSkpd,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/histori_aset',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function getDataHistori($status='', $jenis='', $skpd='', $tgl_awal='', $tgl_akhir='')
    {
        if ($this->input->POST()) {
            $this->load->model("Data_tbl_histori", "DataTable");
            $fetch_data = $this->DataTable->make_datatables($status, $jenis, $skpd, $tgl_awal, $tgl_akhir);

            $data = array();
            $i = $_POST['start'];
            foreach ($fetch_data as $val) {
                $i++;
                $cekbox = "<div class='skin skin-check'>
                                <input type='checkbox' id='plh_ast_".$val->id_aset_histori."' name='plh_ast[]' value='".$val->id_aset_histori."'>
                            </div>";
                
                if ($val->nama_status=='Mutasi') {
                    $span_color = 'warning';
                } else if ($val->nama_status=='Usulan Hapus') {
                    $span_color = 'danger';
                } else {
                    $span_color = 'info';
                }

                $columns = array(
                    $i,
                    $cekbox,
                    $val->tgl_histori,
                    "<span class='badge badge-$span_color w-100'>$val->nama_status</span>",
                    $val->nama_kib,
                    $val->nama_aset,
                    ($val->kode_lama_aset=='' && $val->kode_lama_aset==null)?'-':$val->kode_lama_aset,
                    $val->kode_baru_aset,
                    $val->no_reg,
                    $val->satuan_aset,
                    ($val->merk_barang=='' && $val->merk_barang==null)?'-':$val->merk_barang,
                    ($val->sn_barang=='' && $val->sn_barang==null)?'-':$val->sn_barang,
                    $val->nama_skpd,
                    $val->lokasi_histori,
                    $val->pemegang,
                    $val->user_penanggung,
                    $val->keperluan_histori,
                    ($val->ket_histori=='' && $val->ket_histori==null)?'-':$val->ket_histori,
                );

                $data[] = $columns;
            }
            $output = array(
                "draw"               =>     $_POST["draw"],
                "recordsTotal"       =>     $this->DataTable->get_all_data($status, $jenis, $skpd, $tgl_awal, $tgl_akhir),
                "recordsFiltered"    =>     $this->DataTable->get_filtered_data($status, $jenis, $skpd, $tgl_awal, $tgl_akhir),
                "data"               =>     $data
            );
            echo json_encode($output);
        }
    }

    // =====================================================================

    // MUTASI ASET =========================================================

    public function dataMutasi($id_kib='') {

        if ($id_kib == '') {
            $jenis  = $_POST['jenis'];

            if (isset($jenis) OR ($jenis != null AND $jenis != '' AND !empty($jenis))) {
                $selectJenis = $jenis;
            } else {
                $selectJenis = '';
            }
        } else {
            $selectJenis = decode($id_kib);
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
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js";
        $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js";
        $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/select/select2.full.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        $this->foot[] = base_url('assets/js/icheck_config.js');
        $this->foot[] = base_url('assets/js/data_table.js');
        // $this->foot[] = base_url('assets/js/cetak_excel.js');
        // $this->foot[] = base_url('assets/js/delete_data.js');
        // ================================================================
        $script[] = "showDataTable('Data Mutasi Aset', '', '".date('dmY')."', [ 0, 2, 3, 4, 5, 6, 7, 8]);";
        // $script[] = "function activeIcheck(){ $('.skin-check input').on('ifChecked ifUnchecked', function(event){
        //                 pilihAset(this, event.type);
        //             }).iCheck({
        //                 checkboxClass: 'icheckbox_flat-green'
        //             });}";
        // $script[] = "$('.skin-check-all input').on('ifChecked ifUnchecked', function(event){
        //                 pilihAset(this, event.type);
        //             }).iCheck({
        //                 checkboxClass: 'icheckbox_flat-green'
        //             });";
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
        $select = array(
            'ast.*',
            "(SELECT kib.nama_kib FROM tbl_jenis_kib kib WHERE kib.id_jenis_kib = ast.id_jenis_kib) nama_kib",
            "(SELECT sk.nama_skpd FROM tbl_skpd sk WHERE sk.id_skpd = (SELECT hst.id_skpd FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset AND hst.id_aset_status = 2 ORDER BY hst.tgl_histori DESC, hst.id_aset_histori DESC LIMIT 1)) nama_skpd",
            "(SELECT MAX(hst.tgl_histori) FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset AND hst.id_aset_status = 2 ORDER BY hst.id_aset_histori DESC LIMIT 1) tgl_histori",
        );
        if ($selectJenis != '') {
            $where_plus = "AND ast.id_jenis_kib = '$selectJenis'";
        } else {
            $where_plus = '';
        }
        $dataMutasi = $this->MasterData->getWhereDataOrder($select, 'tbl_aset ast', "ast.id_aset_status = 2 $where_plus", "ast.id_aset", "DESC")->result();

        $dataJenisAset = $this->MasterData->getWhereData('*', 'tbl_jenis_kib', "id_jenis_kib > 0")->result();
        $statusAset = $this->MasterData->getWhereData('*', 'tbl_aset_status', "nama_status != 'Mutasi'")->result();
        $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $content = array(
            'dataMutasi'      => $dataMutasi,
            'dataJenisAset'   => $dataJenisAset,
            'selectJenis'     => $selectJenis,
            'statusAset'      => $statusAset,   
            'dataSkpd'        => $dataSkpd,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_mutasi',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    // =====================================================================

    // USULAN HAPUS ASET ===================================================

    public function dataUsulanHapus($id_kib='') {

        if ($id_kib == '') {
            $jenis  = $_POST['jenis'];

            if (isset($jenis) OR ($jenis != null AND $jenis != '' AND !empty($jenis))) {
                $selectJenis = $jenis;
            } else {
                $selectJenis = '';
            }
        } else {
            $selectJenis = decode($id_kib);
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
        $this->foot[] = assets_url . "app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js";
        $this->foot[] = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js";
        $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js";
        $this->foot[] = "https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/icheck/icheck.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/forms/select/select2.full.min.js";
        $this->foot[] = assets_url . "app-assets/vendors/js/extensions/sweetalert.min.js";
        $this->foot[] = base_url('assets/js/icheck_config.js');
        $this->foot[] = base_url('assets/js/data_table.js');
        // $this->foot[] = base_url('assets/js/cetak_excel.js');
        // $this->foot[] = base_url('assets/js/delete_data.js');
        // ================================================================
        $script[] = "showDataTable('Data Usulan Hapus Aset', '', '".date('dmY')."', [ 0, 2, 3, 4, 5, 6, 7]);";
        // $script[] = "function activeIcheck(){ $('.skin-check input').on('ifChecked ifUnchecked', function(event){
        //                 pilihAset(this, event.type);
        //             }).iCheck({
        //                 checkboxClass: 'icheckbox_flat-green'
        //             });}";
        // $script[] = "$('.skin-check-all input').on('ifChecked ifUnchecked', function(event){
        //                 pilihAset(this, event.type);
        //             }).iCheck({
        //                 checkboxClass: 'icheckbox_flat-green'
        //             });";
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
        $menu['active']     = '5';

        // ================================================================
        $select = array(
            'ast.*',
            "(SELECT kib.nama_kib FROM tbl_jenis_kib kib WHERE kib.id_jenis_kib = ast.id_jenis_kib) nama_kib",
            "(SELECT MAX(hst.tgl_histori) FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset AND hst.id_aset_status = 3) tgl_histori",
        );
        if ($selectJenis != '') {
            $where_plus = "AND ast.id_jenis_kib = '$selectJenis'";
        } else {
            $where_plus = '';
        }
        $dataHapus = $this->MasterData->getWhereDataOrder($select, 'tbl_aset ast', "ast.id_aset_status = 3 $where_plus", "ast.id_aset", "DESC")->result();

        $dataJenisAset = $this->MasterData->getWhereData('*', 'tbl_jenis_kib', "id_jenis_kib > 0")->result();
        $statusAset = $this->MasterData->getWhereData('*', 'tbl_aset_status', "nama_status != 'Usulan Hapus'")->result();
        $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $content = array(
            'dataHapus'       => $dataHapus,
            'dataJenisAset'   => $dataJenisAset,
            'selectJenis'     => $selectJenis,
            'statusAset'      => $statusAset,
            'dataSkpd'        => $dataSkpd,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_usulan_hapus',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    // =====================================================================

    // EKSEKUSI ASET =======================================================

    public function formEksekusiAset($id = '') {

        $post = $this->input->post();
        if ($post) {
            $data_id = explode(';', $post['delete_all']);
            $this->session->set_userdata('data_id', $data_id);
        } else {
            if ($this->session->userdata('data_id') != null) {
                $data_id = $this->session->userdata('data_id');
            } else {
                redirect(base_url($this->controller.'/dataAset/'.$id));
            }
        }

        $id_jenis_kib = decode($id);

        $kib = $this->MasterData->getWhereData('*', 'tbl_jenis_kib', "id_jenis_kib = $id_jenis_kib");

        $cekKib = $kib->num_rows();

        if ($cekKib==0) {
            redirect(base_url($this->controller.'/dataAset/'.encode(1)));
        }

        $dataJenisKib = $kib->row();

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
        $menu['active']     = '2';
        $menu['active_sub']     = '2.'.$id_jenis_kib;

        // ================================================================

        $select = array('ast.*');
        if ($id_jenis_kib == 2) {
            $select[] = "(SELECT brg.sn_barang FROM tbl_barang brg WHERE brg.id_barang = (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset AND ar.posisi = 1)) as sn_aset";
            $select[] = 'merk_type';
        }

        $select[] = 'asal_usul';
        $select[] = "(SELECT SUM(br.harga_barang) FROM tbl_barang br WHERE br.id_barang IN (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset)) as harga_aset";
 
        $dataAset = $this->db->SELECT($select)
                             ->WHERE_IN('ast.id_aset', $data_id)
                             ->JOIN($dataJenisKib->nama_tbl_kib.' kib', 'ast.id_kib = kib.id_kib', 'left')
                             ->GET('tbl_aset ast')->result();
        
        $statusAset = $this->MasterData->getWhereData('*', 'tbl_aset_status', "id_aset_status > 0")->result();
        $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $content = array(
            'id_jenis_kib'   => $id_jenis_kib,
            'dataJenisKib'   => $dataJenisKib,
            'dataAset'       => $dataAset,
            'statusAset'     => $statusAset,
            'dataSkpd'       => $dataSkpd,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/form_eksekusi_aset',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function eksekusiAset() {
        $post = $this->input->POST();

        if ($post) {
            $this->db->trans_begin();

            if ($post['data_update_barang'] != null && $post['data_update_barang'] != '') {
                $data_update_barang = json_decode(html_entity_decode($post['data_update_barang']), true);

                foreach ($data_update_barang as $val) {
                    $data = array(
                        'merk_barang'   => $val['merk_barang'],
                        'sn_barang'     => $val['sn_barang'],
                    );
                    $update_barang = $this->MasterData->editData("id_barang = (SELECT rc.id_barang FROM tbl_aset_rincian rc WHERE rc.id_aset = '".$val['id_aset']."' AND posisi = 1)", $data, 'tbl_barang');

                    $data_aset = array(
                        'merk_type'   => $val['merk_barang'],
                    );
                    $update_aset = $this->MasterData->editData("id_kib = (SELECT ast.id_kib FROM tbl_aset ast WHERE ast.id_aset = '".$val['id_aset']."')", $data_aset, 'tbl_kib_b');
                }
            }

            $dataid = explode(';', $post['id']);

            foreach ($dataid as $id) {
                $data = array(
                    'id_aset'            => $id,
                    'id_user'            => $this->id_user,
                    'tgl_histori'        => date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_histori']))),
                    'lokasi_histori'     => $post['lokasi_histori'],
                    'id_skpd'            => $post['id_skpd'],
                    'keperluan_histori'  => $post['keperluan_histori'],
                    'pemegang'           => $post['pemegang'],
                    'id_aset_status'     => $post['id_aset_status'],
                    'ket_histori'        => $post['ket_histori'],
                );
                $input = $this->MasterData->inputData($data,'tbl_aset_histori');

                $data_aset = array(
                    'id_aset_status' => $post['id_aset_status'],
                );
                $update = $this->MasterData->editData("id_aset = $id", $data_aset, 'tbl_aset');
            }
            

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                alert_failed('Data gagal disimpan.');
                // redirect(base_url() . $this->controller.'/dataAset/'. $post['kib']);
                redirect($post['back']);
            }
            else {
                $exec = $this->db->trans_commit();
                if ($exec) {
                    alert_success('Data berhasil disimpan.');
                    // redirect(base_url() . $this->controller.'/dataAset/'. $post['kib']);
                    redirect($post['back']);
                } else {
                    alert_failed('Data gagal disimpan.');
                    // redirect(base_url() . $this->controller.'/dataAset/'. $post['kib']);
                    redirect($post['back']);
                }
            }
        }
    }

    // =====================================================================

    // CETAK LABEL ASET ====================================================

    public function cetakLabelAset($id='') {
        $post = $this->input->POST();

        if ($post) {
            $id_jenis_kib = decode($id);
            $tbl_kib = $this->MasterData->getWhereData('*','tbl_jenis_kib',"id_jenis_kib = $id_jenis_kib")->row()->nama_tbl_kib;
            $id_aset = explode(';', $post['delete_all']);
            // $dataAset = $this->MasterData->getWhereData('*','tbl_aset',"id_aset IN $id_aset")->row();
            $select = array(
                'ast.*',
                "IFNULL((SELECT brg.merk_barang FROM tbl_barang brg WHERE brg.id_barang = (SELECT rc.id_barang FROM tbl_aset_rincian rc WHERE rc.id_aset = ast.id_aset AND rc.posisi = 1)), '-') merk_aset",
                "IFNULL((SELECT brg.sn_barang FROM tbl_barang brg WHERE brg.id_barang = (SELECT rc.id_barang FROM tbl_aset_rincian rc WHERE rc.id_aset = ast.id_aset AND rc.posisi = 1)), '-') sn_aset",
                "IFNULL((SELECT kib.harga FROM $tbl_kib kib WHERE kib.id_kib = ast.id_kib), '-') harga_aset",
            );
            $dataAset = $this->db->SELECT($select)
                                 ->where_in('ast.id_aset', $id_aset)
                                 ->GET('tbl_aset ast')->result();

            if (count($dataAset) > 0) {
                $this->load->library('phpqrcode');

                $tempdir = FCPATH.'assets/img/qrcode/'; //Nama folder tempat menyimpan file qrcode
                // var_dump($tempdir);
                if (!file_exists($tempdir)) //Buat folder penyimpanan
                    mkdir($tempdir);

                foreach ($dataAset as $val) {
                    //isi qrcode jika di scan
                    $codeContents = $val->kode_baru_aset; 
                    $dirFile = $tempdir.$val->id_aset.'_code.png';
                    
                    if (!file_exists($dirFile)) {
                        //nilai konfigurasi Frame di bawah 4 tidak direkomendasikan 
                        QRcode::png($codeContents, $dirFile, QR_ECLEVEL_M, 4, 2);
                    }
                }

                $data = array(
                    'dataAset' => $dataAset,
                );

                $this->load->library('PhpExcelNew/PHPExcel');
                $this->load->view('User3/print/label_aset', $data);
            } else {
                redirect(base_url('User3'));
            }
        }

    }

    // =====================================================================

    // BARANG JASA =========================================================

    public function dataBarangJasa($id = '') {

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
        $this->foot[] = base_url('assets/js/tbl_barang_jasa.js');
        // ================================================================
        // $script[] = "showDataTable('Data Aset Diskominfo', '', '".date('dmY')."', [ 0, 2, 3, 4]);";
        $script[] = "showDataTable('" . base_url($this->controller.'/getDataBarangJasa') . "')";
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
        $menu['active']     = '6';

        // ================================================================

        // $statusAset = $this->MasterData->getWhereData('*', 'tbl_aset_status', "id_aset_status > 0")->result();
        // $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $content = array(
            // 'dataSkpd'        => $dataSkpd,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/data_barang_jasa',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function getDataBarangJasa() {
        if ($this->input->POST()) {
            $this->load->model("Data_tbl_barang_jasa", "DataTable");
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
                                data-jml="'. $val->jml_histori .'"
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

    // EKSEKUSI BARANG JASA ================================================

    public function formEksekusiBarangJasa() {

        $post = $this->input->post();
        if ($post) {
            $data_id = explode(';', $post['data_selected']);
            $this->session->set_userdata('data_id_bj', $data_id);
        } else {
            if ($this->session->userdata('data_id_bj') != null) {
                $data_id = $this->session->userdata('data_id_bj');
            } else {
                redirect(base_url($this->controller.'/dataBarangJasa'));
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
        $menu['active']     = '6';

        // ================================================================

        $select = array(
            'brg.id_barang',
            "(pd.jml_barang - IFNULL((SELECT SUM(bj.jml_bj_keluar) FROM tbl_bj_keluar bj WHERE bj.id_barang = brg.id_barang GROUP BY bj.id_barang), 0)) as sisa",
            'brg.kode_barang',
            'DATE_FORMAT(brg.tgl_masuk, "%d-%m-%Y") as tgl_masuk',
            'brg.nama_barang',
            'brg.merk_barang',
            'brg.sn_barang',
            'brg.satuan_barang',
            'brg.harga_barang',
            'pd.jml_barang',
        ); 
        $dataBarang = $this->db->select($select)
                               ->WHERE_IN('brg.id_barang', $data_id)
                               ->join('tbl_pengadaan pd', 'brg.id_barang = pd.id_barang')
                               ->GET('tbl_barang brg')->result();
        
        $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $content = array(
            'dataBarang'     => $dataBarang,
            'dataSkpd'       => $dataSkpd,
        );

        $data = array(
            'header'    => $header,
            'menu'      => $menu,
            'konten'    => 'pages/form_eksekusi_barang_jasa',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function eksekusiBarangJasa() {
        $post = $this->input->POST();

        if ($post) {
            $this->db->trans_begin();

            if ($post['data_update_barang'] != null && $post['data_update_barang'] != '') {
                $data_update_barang = json_decode(html_entity_decode($post['data_update_barang']), true);

                foreach ($data_update_barang as $val) {
                    $data = array(
                        'nama_barang'   => $val['nama_barang'],
                        'merk_barang'   => $val['merk_barang'],
                        'sn_barang'     => $val['sn_barang'],
                    );
                    $update_barang = $this->MasterData->editData("id_barang = ".$val['id_barang'], $data, 'tbl_barang');

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

     // HISTORI BARANG JASA ================================================

   
    public function historiBarangJasa($id = '') {
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
        $this->foot[] = base_url('assets/js/tbl_histori_barang_jasa.js');
        // ================================================================
        // $script[] = "showDataTable('Data Penempatan Aset', '', '".date('dmY')."', [ 0, 2, 3, 4, 5, 6, 7, 8]);";
        $script[] = "showDataTable('" . base_url($this->controller.'/getDataHistoriBarangJasa/' . $selectSkpd . '/' . date('Y-m-d', strtotime(str_replace('/', '-', $selectTglAwal))) . '/' . date('Y-m-d', strtotime(str_replace('/', '-', $selectTglAkhir)))) . "');";
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
        $menu['active']     = '7';

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
            'konten'    => 'pages/histori_barang_jasa',
            'footer'    => $footer,
            'cont'      => $content,
        );

        $this->load->view("view_master_admin", $data);
    }

    public function getDataHistoriBarangJasa($skpd='', $tgl_awal='', $tgl_akhir='')
    {
        if ($this->input->POST()) {
            $this->load->model("Data_tbl_histori_barang_jasa", "DataTable");
            $fetch_data = $this->DataTable->make_datatables($skpd, $tgl_awal, $tgl_akhir);

            $data = array();
            $i = $_POST['start'];
            foreach ($fetch_data as $val) {
                $i++;
                $btn = '';
                $cekbox = "<div class='skin skin-check'>
                                <input type='checkbox' id='plh_brg_".$val->id_bj_keluar."' name='plh_brg[]' value='".$val->id_bj_keluar."'>
                            </div>";
                // $btn_hapus = '<button type="button" onclick="hapusData(this)" 
                //                 data-id="'. encode($val->id_bj_keluar) .'" 
                //                 data-link="'. base_url($this->controller.'/deleteHistoriBarangJasa') .'" 
                //                 data-csrfname="'. $this->security->get_csrf_token_name() .'" 
                //                 data-csrfcode="'. $this->security->get_csrf_hash() .'" 
                //                 style="margin-bottom: 3px;" class="btn btn-sm btn-danger" title="Hapus Data"><i class="la la-trash-o font-small-3"></i></button> ';
                // $btn .= $btn_hapus;
                $columns = array(
                    $i,
                    // $btn,
                    $cekbox,
                    $val->tgl_bj_keluar,
                    $val->kode_barang,
                    $val->nama_barang,
                    ($val->merk_barang=='' && $val->merk_barang==null)?'-':$val->merk_barang,
                    ($val->sn_barang=='' && $val->sn_barang==null)?'-':$val->sn_barang,
                    $val->satuan_barang,
                    $val->jml_bj_keluar,
                    $val->nama_skpd,
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
