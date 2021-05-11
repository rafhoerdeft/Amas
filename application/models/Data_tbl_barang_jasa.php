<?php
class Data_tbl_barang_jasa extends CI_Model
{
    var $table = "tbl_barang brg";
    var $select_column = array(
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

    var $select_column_search = array();

    function make_query() {

        $order_column = array();
        foreach ($this->select_column as $val) {
            $select = explode(" as ", $val);
            
            if ($select[0] != 'brg.id_barang') {
                if ($select[1] == null && $select[1] == '') {
                    $order_column[] = $select[0];
                    $this->select_column_search[] = $select[0];
                } else {
                    $order_column[] = $select[1];
                }
            } else {
                $order_column[] = null;
                $order_column[] = null;
                $order_column[] = null;
                $order_column[] = null;
            }
        }

        $this->select_column[] = "(SELECT GROUP_CONCAT((SELECT usr.nama_user FROM tbl_user usr WHERE usr.id_user = bj.id_user) ORDER BY bj.tgl_bj_keluar DESC SEPARATOR ';') FROM tbl_bj_keluar bj WHERE bj.id_barang = brg.id_barang) as nama_penanggung";
        $this->select_column[] = "(SELECT GROUP_CONCAT(bj.pemegang ORDER BY bj.tgl_bj_keluar DESC SEPARATOR ';') FROM tbl_bj_keluar bj WHERE bj.id_barang = brg.id_barang) as pemegang";
        $this->select_column[] = "(SELECT GROUP_CONCAT(bj.lokasi_bj_keluar ORDER BY bj.tgl_bj_keluar DESC SEPARATOR ';') FROM tbl_bj_keluar bj WHERE bj.id_barang = brg.id_barang) as lokasi_histori";
        $this->select_column[] = "(SELECT GROUP_CONCAT((SELECT sk.nama_skpd FROM tbl_skpd sk WHERE sk.id_skpd = bj.id_skpd) ORDER BY bj.tgl_bj_keluar DESC SEPARATOR ';') FROM tbl_bj_keluar bj WHERE bj.id_barang = brg.id_barang) as nama_skpd";
        $this->select_column[] = "(SELECT GROUP_CONCAT(DATE_FORMAT(bj.tgl_bj_keluar, '%d-%m-%Y') ORDER BY bj.tgl_bj_keluar DESC SEPARATOR ';') FROM tbl_bj_keluar bj WHERE bj.id_barang = brg.id_barang) as tgl_histori";
        $this->select_column[] = "(SELECT GROUP_CONCAT(bj.keperluan_bj_keluar ORDER BY bj.tgl_bj_keluar DESC SEPARATOR ';') FROM tbl_bj_keluar bj WHERE bj.id_barang = brg.id_barang) as keperluan_histori";
        $this->select_column[] = "(SELECT GROUP_CONCAT(bj.ket_bj_keluar ORDER BY bj.tgl_bj_keluar DESC SEPARATOR ';') FROM tbl_bj_keluar bj WHERE bj.id_barang = brg.id_barang) as ket_histori";
        $this->select_column[] = "(SELECT GROUP_CONCAT(bj.jml_bj_keluar ORDER BY bj.tgl_bj_keluar DESC SEPARATOR ';') FROM tbl_bj_keluar bj WHERE bj.id_barang = brg.id_barang) as jml_histori";

        $this->db->select($this->select_column);
        $this->db->where("kt.jenis_rekening = 'Barang Jasa'");
        $this->db->join('tbl_pengadaan pd', 'brg.id_barang = pd.id_barang');
        $this->db->join('tbl_kontrak kt', 'kt.id_kontrak = pd.id_kontrak');
        $this->db->from($this->table);
        
        $i = 0;
        foreach ($this->select_column_search as $item) {
            // if datatable send POST for search
            if ($_POST["search"]["value"]) {
                // first loop
                if ($i === 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $_POST["search"]["value"]);
                } else {
                    $this->db->or_like($item, $_POST["search"]["value"]);
                }

                // last loop
                if (count($this->select_column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST["order"])) {
            // $this->db->order_by('sisa', 'DESC');
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('sisa', 'DESC');
            $this->db->order_by('brg.tgl_masuk', 'DESC');
            $this->db->order_by('brg.id_barang', 'DESC');
        }
    }

    function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data()
    {
        $this->db->select("*");
        $this->db->where("kt.jenis_rekening = 'Barang Jasa'");
        $this->db->join('tbl_pengadaan pd', 'brg.id_barang = pd.id_barang');
        $this->db->join('tbl_kontrak kt', 'kt.id_kontrak = pd.id_kontrak');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
