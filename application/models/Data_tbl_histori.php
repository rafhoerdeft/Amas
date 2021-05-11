<?php
class Data_tbl_histori extends CI_Model
{
    var $table = "tbl_aset_histori hst";
    var $select_column = array(
        'id_aset_histori',
        'DATE_FORMAT(hst.tgl_histori, "%d-%m-%Y") as tgl_histori',
        'nama_status',
        'nama_kib',
        'nama_aset',
        'kode_lama_aset',
        'kode_baru_aset',
        'no_reg',
        'satuan_aset',
        'merk_barang',
        'sn_barang',
        "sk.nama_skpd",
        'lokasi_histori',
        'pemegang',
        'nama_user as user_penanggung',
        'keperluan_histori',
        'ket_histori',
    );

    var $select_column_search = array();

    function make_query($status, $jenis, $skpd, $tgl_awal, $tgl_akhir) {

        $this->db->select($this->select_column);
        if ($status != '0') {
            $this->db->where('hst.id_aset_status', $status);
        }
        if ($jenis != '0') {
            $this->db->where('ast.id_jenis_kib', $jenis);
        }
        if ($skpd != '0') {
            $this->db->where('hst.id_skpd', $skpd);
        }
        $this->db->where("hst.tgl_histori BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'");
        $this->db->join('tbl_aset ast', 'hst.id_aset = ast.id_aset', 'left');
        $this->db->join('tbl_user usr', 'hst.id_user = usr.id_user', 'left');
        $this->db->join('tbl_aset_status st', 'hst.id_aset_status = st.id_aset_status', 'left');
        $this->db->join('tbl_aset_rincian rc', 'ast.id_aset = rc.id_aset AND rc.posisi = 1', 'left');
        $this->db->join('tbl_barang brg', 'rc.id_barang = brg.id_barang', 'left');
        $this->db->join('tbl_jenis_kib kib', 'ast.id_jenis_kib = kib.id_jenis_kib', 'left');
        $this->db->join('tbl_skpd sk', 'hst.id_skpd = sk.id_skpd', 'left');
        $this->db->from($this->table);

        $order_column = array();
        foreach ($this->select_column as $val) {
            $select = explode(" as ", $val);
            
            if ($select[0] != 'id_aset_histori') {
                if ($select[1] != null && $select[1] != '') {
                    $order_column[] = $select[1];
                } else {
                    $order_column[] = $select[0];
                }
                $this->select_column_search[] = $select[0];
            } else {
                $order_column[] = null;
            }
        }
        
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
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('hst.tgl_histori', 'DESC');
            $this->db->order_by('hst.id_aset_histori', 'DESC');
        }
    }

    function make_datatables($status, $jenis, $skpd, $tgl_awal, $tgl_akhir)
    {
        $this->make_query($status, $jenis, $skpd, $tgl_awal, $tgl_akhir);
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data($status, $jenis, $skpd, $tgl_awal, $tgl_akhir)
    {
        $this->make_query($status, $jenis, $skpd, $tgl_awal, $tgl_akhir);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data($status, $jenis, $skpd, $tgl_awal, $tgl_akhir)
    {
        $this->db->select("*");
        if ($status != '0') {
            $this->db->where('hst.id_aset_status', $status);
        }
        if ($jenis != '0') {
            $this->db->where("hst.id_aset IN (SELECT ast.id_aset FROM tbl_aset ast WHERE ast.id_jenis_kib = '".$jenis."')");
        }
        if ($skpd != '0') {
            $this->db->where('hst.id_skpd', $skpd);
        }
        $this->db->where("hst.tgl_histori BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
