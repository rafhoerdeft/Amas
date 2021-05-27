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
        $active = '0';

        $data = compact(
            'active'
        );

        view("blade/dash", $data);
    }
    
    public function dashBoard()
    {
        $active = '1';

        // JUMLAH BARANG MASUK
		$select = "IFNULL(SUM((SELECT SUM(sr.jml_barang) FROM tbl_so_rincian sr WHERE sr.id_so = so.id_so GROUP BY sr.id_so)), 0) jml_barang";
        $table = 'tbl_so so';
        $where = "MONTH(tgl_nota) = MONTH(now()) AND YEAR(tgl_nota) = YEAR(now())";
		$this_month = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_barang;
		$where = "tgl_nota > DATE_SUB(now(), INTERVAL 6 MONTH)";
        $last_6_month = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_barang;
        $where = "YEAR(tgl_nota) = YEAR(now())";
        $this_year = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_barang;

        $data = compact(
            'active',
            'this_month'  ,
            'last_6_month',
            'this_year'   ,
        );

        view("blade/dashboard", $data);
    }

    // REKANAN ==============================================================

    public function dataRekanan() {

        $active = '2';

        // ================================================================
        
        $dataRekanan = $this->MasterData->getWhereDataOrder('*', 'tbl_rekanan', "id_rekanan > 0", "id_rekanan", "DESC")->result();

        $data = compact(
            'active',
            'dataRekanan',
        );

        view("blade/data_rekanan", $data);
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

        $active  = '3';

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

        $data = compact(
            'active',
            'dataNota',
            'dataRekanan',
        );

        view("blade/data_barang_masuk", $data);
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

        // ================================================================

        $active  = '3';

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

        $data = compact(
            'active',
            'dataRincian',
            'dataNota'   ,
            // 'kodeBarang'    => $kodeBarang,
        );

        view("blade/data_barang_masuk_rincian", $data);
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

        $active  = '4';

        // ================================================================

        // $statusAset = $this->MasterData->getWhereData('*', 'tbl_aset_status', "id_aset_status > 0")->result();
        // $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $data = compact(
            'active',
            // 'dataSkpd',
        );

        view("blade/data_barang_so", $data);
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

        $active = '4';

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

        $data = compact(
            'active',
            'dataBarang',
            // 'dataSkpd',
        );

        view("blade/form_eksekusi_barang_so", $data);
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
        
        // ================================================================
        
        $active  = '5';

        // ================================================================
        $dataSkpd = $this->MasterData->getWhereData('*', 'tbl_skpd', "id_skpd > 0")->result();

        $data = compact(
            'active',
            'selectSkpd'    ,
            'selectTglAwal' ,
            'selectTglAkhir',
            'dataSkpd'      ,
        );

        view("blade/histori_barang_so", $data);
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

        $ctive = '0';

        // ========================================
        $dataUser = $this->MasterData->getWhereData('*', 'tbl_user', "id_user = ".$this->id_user)->row();

        $data = compact(
            'active',
            'dataUser',
        );

        view('blade/data_profil', $data);
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
        
        $ctive = '0';

        // ========================================

        $dataUser = $this->MasterData->getWhereData('*', 'tbl_user', "id_user = ".$this->id_user)->row();

        $data = compact(
            'active',
            'dataUser',
        );

        view('blade/akun_login', $data);
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
