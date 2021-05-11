<?php
class Data_tbl_histori_barang_so extends CI_Model
{
    var $table = "tbl_bj_keluar bj";
    var $select_column = array(
        'id_bj_keluar',
        'DATE_FORMAT(bj.tgl_bj_keluar, "%d-%m-%Y") as tgl_bj_keluar',
        'so.no_nota',
        'br.kode_barang',
        'br.nama_barang',
        'br.merk_barang',
        'br.sn_barang',
        'br.satuan_barang',
        'bj.jml_bj_keluar',
        'sk.nama_skpd',
        'bj.lokasi_bj_keluar',
        'bj.pemegang',
        'usr.nama_user as user_penanggung',
        'bj.keperluan_bj_keluar',
        'bj.ket_bj_keluar',
    );

    var $select_column_search = array();

    function make_query($skpd, $tgl_awal, $tgl_akhir, $notAdm = true) {

        $this->db->select($this->select_column);
        if ($skpd != '0') {
            $this->db->where('bj.id_skpd', $skpd);
        }
        if ($notAdm) {
            $this->db->where("so.id_user = '".$this->id_user."'");
        }
        $this->db->where("bj.tgl_bj_keluar BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'");
        $this->db->where("bj.jenis_barang = 'stokopname'");
        $this->db->join('tbl_barang br', 'bj.id_barang = br.id_barang', 'left');
        $this->db->join('tbl_user usr', 'bj.id_user = usr.id_user', 'left');
        $this->db->join('tbl_skpd sk', 'bj.id_skpd = sk.id_skpd', 'left');
        $this->db->join('tbl_so_rincian sr', 'bj.id_barang = sr.id_barang', 'left');
        $this->db->join('tbl_so so', 'sr.id_so = so.id_so', 'left');
        $this->db->from($this->table);

        $order_column = array();
        foreach ($this->select_column as $val) {
            $select = explode(" as ", $val);
            
            if ($select[0] != 'id_bj_keluar') {
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
            $this->db->order_by('bj.tgl_bj_keluar', 'DESC');
            $this->db->order_by('bj.id_bj_keluar', 'DESC');
        }
    }

    function make_datatables($skpd, $tgl_awal, $tgl_akhir, $notAdm = true)
    {
        $this->make_query($skpd, $tgl_awal, $tgl_akhir, $notAdm);
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data($skpd, $tgl_awal, $tgl_akhir, $notAdm = true)
    {
        $this->make_query($skpd, $tgl_awal, $tgl_akhir, $notAdm);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data($skpd, $tgl_awal, $tgl_akhir, $notAdm = true)
    {
        $this->db->select("*");
        if ($skpd != '0') {
            $this->db->where('bj.id_skpd', $skpd);
        }
        if ($notAdm) {
            $this->db->where("so.id_user = '".$this->id_user."'");
        }
        $this->db->where("bj.tgl_bj_keluar BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'");
        $this->db->where("bj.jenis_barang = 'stokopname'");
        $this->db->join('tbl_so_rincian sr', 'bj.id_barang = sr.id_barang', 'left');
        $this->db->join('tbl_so so', 'sr.id_so = so.id_so', 'left');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
