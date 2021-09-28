<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(null);

class User1 extends Adm_Controller
{

    function __construct()
    {
        parent::__construct();

		$this->secure->auth('');

        $this->controller = $this->router->fetch_class();
    } 

    public function index()
    {
        $data['active'] = '0';

        view('blade/dash', $data);
    }

    public function dashBoard()
    {
        $active = '1';

        // JUMLAH PENGADAAN MASUK
		$select = "IFNULL(SUM((SELECT SUM(pd.jml_barang) FROM tbl_pengadaan pd WHERE pd.id_kontrak = kt.id_kontrak GROUP BY pd.id_kontrak)), 0) jml_pengadaan";
        $table = 'tbl_kontrak kt';
        $where = "MONTH(tgl_kontrak) = MONTH(now()) AND YEAR(tgl_kontrak) = YEAR(now())";
		$this_month = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_pengadaan;
		$where = "tgl_kontrak > DATE_SUB(now(), INTERVAL 6 MONTH)";
        $last_6_month = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_pengadaan;
        $where = "YEAR(tgl_kontrak) = YEAR(now())";
        $this_year = $this->MasterData->getWhereData($select,$table,$where)->row()->jml_pengadaan;

        $data = compact(
            'active',
            'this_month',
            'last_6_month',
            'this_year',
        );

        view('blade/dashboard', $data);
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
            redirect(base_url('User1'));
        }
    }

    // ======================================================================

    // KONTRAK ==============================================================

    public function dataKontrak() {

        $active = '3';
        // ================================================================
        $select = array(
            '*',
            "(SELECT rk.nama_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = kt.id_rekanan) nama_rekanan",
            "(SELECT rk.alamat_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = kt.id_rekanan) alamat_rekanan",
            "(SELECT rk.kota_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = kt.id_rekanan) kota_rekanan",
            "(SELECT us.nama_user FROM tbl_user us WHERE us.id_user = kt.id_user) nama_ppkom",
        );
        $dataKontrak = $this->MasterData->getWhereDataOrder($select, 'tbl_kontrak kt', "kt.id_kontrak > 0", "kt.id_kontrak", "DESC")->result();

        // $dataPpkom   = $this->MasterData->getWhereData('*', 'tbl_user', "active = 1 AND id_role IN (SELECT rl.id_role FROM tbl_role rl WHERE rl.nama_role LIKE '%PPKom%')")->result();

        $dataRekanan = $this->MasterData->getWhereData('*', 'tbl_rekanan', "id_rekanan > 0")->result();

        $data = compact(
            'active',
            'dataKontrak',
            // 'dataPpkom',
            'dataRekanan',
        );

        view('blade/data_kontrak', $data);
    }

    public function simpanDataKontrak() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $data = array(
                'no_kontrak'          => $post['no_kontrak'],  
                'no_ba_serahterima'   => $post['no_ba_serahterima'],  
                'tgl_ba_serahterima'  => date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_ba_serahterima']))),   
                'no_sp2d'             => $post['no_sp2d'],  
                'nilai_kontrak'       => str_replace('.', '', $post['nilai_kontrak']),  
                'id_rekanan'          => $post['rekanan'],  
                'id_user'             => $this->id_user,  
                'jenis_rekening'      => $post['rekening'],
                'tgl_kontrak'         => date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_kontrak']))),   
            );

            $input = $this->MasterData->inputData($data,'tbl_kontrak');

            if ($input) {
                alert_success('Data berhasil disimpan.');
                redirect(base_url() . $this->controller.'/dataKontrak');
            } else {
                alert_failed('Data gagal disimpan.');
                redirect(base_url() . $this->controller.'/dataKontrak');
            }
        }
    }

    public function updateDataKontrak() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $id = decode($post['id']);

            $data = array(
                'no_kontrak'          => $post['no_kontrak'],  
                'no_ba_serahterima'   => $post['no_ba_serahterima'],  
                'tgl_ba_serahterima'  => date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_ba_serahterima']))), 
                'no_sp2d'             => $post['no_sp2d'],  
                'nilai_kontrak'       => str_replace('.', '', $post['nilai_kontrak']),  
                'id_rekanan'          => $post['rekanan'],  
                'id_user'             => $this->id_user,  
                'jenis_rekening'      => $post['rekening'],
                'tgl_kontrak'         => date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_kontrak']))), 
            );

            $input = $this->MasterData->editData("id_kontrak = $id", $data, 'tbl_kontrak');

            if ($input) {
                alert_success('Data berhasil disimpan.');
                redirect(base_url() . $this->controller.'/dataKontrak');
            } else {
                alert_failed('Data gagal disimpan.');
                redirect(base_url() . $this->controller.'/dataKontrak');
            }
        }
    }

    public function deleteDataKontrak($value = '') {
        if ($this->input->POST()) {
            $id = decode($this->input->POST('id'));
            $where = "id_kontrak = $id";
            $delete = $this->MasterData->deleteData($where, 'tbl_kontrak');
            if ($delete) {
                alert_success('Data berhasil dihapus.');
                echo 'Success';
            } else {
                alert_failed('Data gagal dihapus.');
                echo 'Gagal';
            }
        } else {
            redirect(base_url('User1'));
        }
    }

    // ======================================================================

    // PENGADAAN ============================================================

    public function dataPengadaan() {

        $active = '4';
        // ================================================================
        $select = array(
            'kt.*',
            "(SELECT rk.nama_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = kt.id_rekanan) nama_rekanan",
            "(SELECT rk.alamat_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = kt.id_rekanan) alamat_rekanan",
            "(SELECT rk.kota_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = kt.id_rekanan) kota_rekanan",
            "(SELECT us.nama_user FROM tbl_user us WHERE us.id_user = kt.id_user) nama_ppkom",
            "(SELECT COUNT(pd.id_kontrak) FROM tbl_pengadaan pd WHERE pd.id_kontrak = kt.id_kontrak) jml_rincian",
            "(SELECT GROUP_CONCAT((SELECT br.harga_barang FROM tbl_barang br WHERE br.id_barang = pd.id_barang) * pd.jml_barang SEPARATOR ';') FROM tbl_pengadaan pd WHERE pd.id_kontrak = kt.id_kontrak GROUP BY pd.id_kontrak) harga_pengadaan",

            "(SELECT GROUP_CONCAT((SELECT br.nama_barang FROM tbl_barang br WHERE br.id_barang = pd.id_barang) SEPARATOR ';') FROM tbl_pengadaan pd WHERE pd.id_kontrak = kt.id_kontrak GROUP BY pd.id_kontrak) nm_brg",
            "(SELECT GROUP_CONCAT((SELECT br.merk_barang FROM tbl_barang br WHERE br.id_barang = pd.id_barang) SEPARATOR ';') FROM tbl_pengadaan pd WHERE pd.id_kontrak = kt.id_kontrak GROUP BY pd.id_kontrak) merk_brg",
            "(SELECT GROUP_CONCAT((SELECT br.satuan_barang FROM tbl_barang br WHERE br.id_barang = pd.id_barang) SEPARATOR ';') FROM tbl_pengadaan pd WHERE pd.id_kontrak = kt.id_kontrak GROUP BY pd.id_kontrak) sat_brg",
            "(SELECT GROUP_CONCAT((SELECT br.harga_barang FROM tbl_barang br WHERE br.id_barang = pd.id_barang) SEPARATOR ';') FROM tbl_pengadaan pd WHERE pd.id_kontrak = kt.id_kontrak GROUP BY pd.id_kontrak) hrg_brg",
            "(SELECT GROUP_CONCAT(pd.jml_barang SEPARATOR ';') FROM tbl_pengadaan pd WHERE pd.id_kontrak = kt.id_kontrak  GROUP BY pd.id_kontrak) jml_brg",
            // "(SELECT SUM((SELECT br.harga_barang FROM tbl_barang br WHERE br.id_barang = pd.id_barang) * pd.jml_barang) FROM tbl_pengadaan pd WHERE pd.id_kontrak = kt.id_kontrak GROUP BY pd.id_kontrak) tot_harga",
        );
        $dataPengadaan = $this->MasterData->getWhereDataOrder($select, 'tbl_kontrak kt', "kt.id_kontrak > 0", "kt.id_kontrak", "DESC")->result();

        // $select = array(
        //     '*',
        //     "(SELECT rk.nama_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = kt.id_rekanan) nama_rekanan",
        //     "(SELECT us.nama_user FROM tbl_user us WHERE us.id_user = kt.id_user) nama_ppkom",
        // );
        // $dataKontrak = $this->MasterData->getWhereDataOrder($select, 'tbl_kontrak kt', "kt.id_kontrak NOT IN (SELECT pd.id_kontrak FROM tbl_pengadaan pd)", "kt.id_kontrak", "DESC")->result();

        $data = compact(
            'active',
            'dataPengadaan',
            // 'dataKontrak',
        );

        view('blade/data_pengadaan', $data);
    }

    public function simpanDataPengadaan() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $data = array(
                'id_kontrak'     => $post['kontrak'],  
                'tgl_pengadaan'  => date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_pengadaan']))),   
                'jenis_rekening' => $post['rekening'],  
            );

            $input = $this->MasterData->inputData($data,'tbl_pengadaan');

            if ($input) {
                alert_success('Data berhasil disimpan.');
                redirect(base_url() . $this->controller.'/dataPengadaan');
            } else {
                alert_failed('Data gagal disimpan.');
                redirect(base_url() . $this->controller.'/dataPengadaan');
            }
        }
    }

    public function updateDataPengadaan() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $id = decode($post['id']);

            $data = array(
                // 'id_kontrak'     => $post['kontrak'],  
                'tgl_pengadaan'  => date('Y-m-d', strtotime(str_replace('/', '-', $post['tgl_pengadaan']))),  
                'jenis_rekening' => $post['rekening'],  
            );

            $input = $this->MasterData->editData("id_pengadaan = $id", $data, 'tbl_pengadaan');

            if ($input) {
                alert_success('Data berhasil disimpan.');
                redirect(base_url() . $this->controller.'/dataPengadaan');
            } else {
                alert_failed('Data gagal disimpan.');
                redirect(base_url() . $this->controller.'/dataPengadaan');
            }
        }
    }

    public function deleteDataPengadaan($value = '') {
        if ($this->input->POST()) {
            $id = decode($this->input->POST('id'));
            $where = "id_pengadaan = $id";
            $delete = $this->MasterData->deleteData($where, 'tbl_pengadaan');
            if ($delete) {
                alert_success('Data berhasil dihapus.');
                echo 'Success';
            } else {
                alert_failed('Data gagal dihapus.');
                echo 'Gagal';
            }
        } else {
            redirect(base_url('User1'));
        }
    }

    // ======================================================================

    // RINCIAN PENGADAAN ====================================================

    public function rincianPengadaan($id = 0) {
        // $this->load->helper('kodeotomatis');

        $id_kontrak = decode($id);

        $active = '4';
        // ================================================================

        $select = array(
            'kt.*',
            "(SELECT rk.nama_rekanan FROM tbl_rekanan rk WHERE rk.id_rekanan = kt.id_rekanan) nama_rekanan",
        );
        
        $dataKontrak = $this->MasterData->getWhereData($select, 'tbl_kontrak kt', "kt.id_kontrak = $id_kontrak")->row();

        $select_rincian = array(
            '*',
            // "(SELECT CONCAT((SELECT sk.nama_skpd FROM tbl_skpd sk WHERE sk.id_skpd = hst.id_skpd), ';' ,hst.lokasi_histori) FROM tbl_aset_histori hst WHERE hst.id_aset = (SELECT rc.id_aset FROM tbl_aset_rincian rc WHERE rc.id_barang = br.id_barang) ORDER BY hst.tgl_histori DESC, hst.id_aset_histori DESC LIMIT 1) lokasi_aset",
            "CASE
                WHEN kt.jenis_rekening = 'Modal' THEN 
                    (SELECT CONCAT((SELECT sk.nama_skpd FROM tbl_skpd sk WHERE sk.id_skpd = hst.id_skpd), ';', COALESCE(hst.lokasi_histori, '')) FROM tbl_aset_histori hst WHERE hst.id_aset = (SELECT rc.id_aset FROM tbl_aset_rincian rc WHERE rc.id_barang = br.id_barang) ORDER BY hst.tgl_histori DESC, hst.id_aset_histori DESC LIMIT 1)
                ELSE 
                (SELECT CONCAT((SELECT sk.nama_skpd FROM tbl_skpd sk WHERE sk.id_skpd = bj.id_skpd), ';', COALESCE(bj.lokasi_bj_keluar, '')) FROM tbl_bj_keluar bj WHERE bj.id_barang = pd.id_barang ORDER BY bj.tgl_bj_keluar DESC, bj.id_bj_keluar DESC LIMIT 1) 
            END as lokasi_aset",
        );
        // $dataRincian = $this->MasterData->selectJoinOrder($select_rincian, 'tbl_pengadaan pd', 'tbl_barang br', "pd.id_barang = br.id_barang", "LEFT", "pd.id_kontrak = $id_kontrak", "pd.id_pengadaan", "DESC")->result();
        $dataRincian = $this->db->select($select_rincian)
                                ->join('tbl_barang br', "pd.id_barang = br.id_barang", 'LEFT')
                                ->join('tbl_kontrak kt', "pd.id_kontrak = kt.id_kontrak", 'LEFT')
                                ->where("pd.id_kontrak = $id_kontrak")
                                ->order_by('pd.id_pengadaan','DESC')
                                ->get('tbl_pengadaan pd')->result();

        // $kodeBarang = kodeOtomatis('kode_barang', 'tbl_barang', "id_barang > 0", 'B', 5);

        $data = compact(
            'active',
            'dataRincian',
            'dataKontrak',
            // 'kodeBarang',
        );

        view('blade/data_pengadaan_rincian', $data);
    }

    public function simpanRincianPengadaan() {
        $this->load->helper('kodeotomatis');
        $post = html_escape($this->input->POST());

        if ($post) {

            $this->db->trans_begin();

            if ($post['jenis_rekening'] == 'Modal') {
                for ($i=0; $i < (int)str_replace('.', '', $post['jml_barang']); $i++) { 
                    $kodeBarang = kodeOtomatis('kode_barang', 'tbl_barang', "id_barang > 0", 'B', 5);
                    $data = array(
                        'kode_barang'     => $kodeBarang,
                        'nama_barang'     => $post['nama_barang'],   
                        'merk_barang'     => $post['merk_barang'],   
                        'satuan_barang'   => $post['satuan_barang'],   
                        'harga_barang'    => str_replace('.', '', $post['harga_barang']),   
                        'tgl_masuk'       => $post['tgl_ba_serahterima'],   
                    );
        
                    $this->MasterData->inputData($data,'tbl_barang');
        
                    $id_barang = $this->db->insert_id();
        
                    $data = array(
                        'id_kontrak'    => decode($post['id_kontrak']),   
                        'id_barang'     => $id_barang,   
                        'jml_barang'    => 1,   
                    );
        
                    $input = $this->MasterData->inputData($data,'tbl_pengadaan');
                }
            } else {
                $kodeBarang = kodeOtomatis('kode_barang', 'tbl_barang', "id_barang > 0", 'B', 5);
                $data = array(
                    'kode_barang'     => $kodeBarang,
                    'nama_barang'     => $post['nama_barang'],   
                    'merk_barang'     => $post['merk_barang'],   
                    'satuan_barang'   => $post['satuan_barang'],   
                    'harga_barang'    => str_replace('.', '', $post['harga_barang']),   
                    'tgl_masuk'       => $post['tgl_ba_serahterima'],   
                );
    
                $this->MasterData->inputData($data,'tbl_barang');
    
                $id_barang = $this->db->insert_id();
    
                $data = array(
                    'id_kontrak'    => decode($post['id_kontrak']),   
                    'id_barang'     => $id_barang,   
                    'jml_barang'    => str_replace('.', '', $post['jml_barang']),   
                );
    
                $input = $this->MasterData->inputData($data,'tbl_pengadaan');
            }

            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
                    alert_failed('Data gagal disimpan.');
                    redirect(base_url() . $this->controller.'/rincianPengadaan/'. $post['id_kontrak']);
            }
            else
            {
                    $this->db->trans_commit();
                    if ($input) {
                        alert_success('Data berhasil disimpan.');
                        redirect(base_url() . $this->controller.'/rincianPengadaan/'. $post['id_kontrak']);
                    } else {
                        alert_failed('Data gagal disimpan.');
                        redirect(base_url() . $this->controller.'/rincianPengadaan/'. $post['id_kontrak']);
                    }
            }
        }
    }

    public function updateRincianPengadaan() {
        $post = html_escape($this->input->POST());

        if ($post) {

            $this->db->trans_begin();

            $id = decode($post['id']);
            $id_barang = $this->db->query("SELECT id_barang FROM tbl_pengadaan WHERE id_pengadaan = $id")->row()->id_barang;

            $data = array(
                'nama_barang'     => $post['nama_barang'],   
                'merk_barang'     => $post['merk_barang'],   
                'sn_barang'       => $post['sn_barang'],   
                'satuan_barang'   => str_replace('.', '', $post['satuan_barang']),   
                'harga_barang'    => str_replace('.', '', $post['harga_barang']),   
                'tgl_masuk'       => $post['tgl_ba_serahterima'],   
            );

            $input = $this->MasterData->editData("id_barang = $id_barang", $data, 'tbl_barang');

            $data = array(
                // 'id_kontrak'    => decode($post['id_kontrak']),   
                // 'id_barang'     => $id_barang,   
                'jml_barang'    => str_replace('.', '', $post['jml_barang']),   
            );

            $input = $this->MasterData->editData("id_pengadaan = $id", $data, 'tbl_pengadaan');

            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
                    alert_failed('Data gagal disimpan.');
                    redirect(base_url() . $this->controller.'/rincianPengadaan/'. $post['id_kontrak']);
            }
            else
            {
                    $this->db->trans_commit();
                    if ($input) {
                        alert_success('Data berhasil disimpan.');
                        redirect(base_url() . $this->controller.'/rincianPengadaan/'. $post['id_kontrak']);
                    } else {
                        alert_failed('Data gagal disimpan.');
                        redirect(base_url() . $this->controller.'/rincianPengadaan/'. $post['id_kontrak']);
                    }
            }
        }
    }

    public function deleteRincianPengadaan($value = '') {
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
            redirect(base_url('User1'));
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
            redirect(base_url('User1'));
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
