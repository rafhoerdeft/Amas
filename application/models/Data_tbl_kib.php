<?php
class Data_tbl_kib extends CI_Model
{
    var $table = "tbl_aset ast";
    var $select_column = array(
        'id_aset',
        'nama_aset',
        'kode_lama_aset',
        'kode_baru_aset',
        'no_reg',
        // 'jml_aset',
        'satuan_aset',
    );

    var $select_column_search = array();

    function make_query($tbl, $id_jenis_kib) {

        if ($id_jenis_kib == 1) {
            $this->select_column[] = 'luas_tanah';
            $this->select_column[] = 'thn_beli';
            $this->select_column[] = 'letak';
            $this->select_column[] = 'status_tanah';
            $this->select_column[] = 'DATE_FORMAT(tgl_sertifikat, "%d/%m/%Y") as tgl_sertifikat';
            $this->select_column[] = 'no_sertifikat';
            $this->select_column[] = 'penggunaan';
        } else if ($id_jenis_kib == 2) {
            $this->select_column[] = "(SELECT brg.sn_barang FROM tbl_barang brg WHERE brg.id_barang = (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset AND ar.posisi = 1)) as sn_aset";
            $this->select_column[] = 'merk_type';
            $this->select_column[] = 'ukuran_cc';
            $this->select_column[] = 'ukuran_cc';
            $this->select_column[] = 'bahan';
            $this->select_column[] = 'warna';
            $this->select_column[] = 'thn_beli';
            $this->select_column[] = 'no_pabrik';
            $this->select_column[] = 'no_rangka';
            $this->select_column[] = 'no_mesin';
            $this->select_column[] = 'no_polisi';
            $this->select_column[] = 'no_bpkb';
        } else if ($id_jenis_kib == 3) {
            $this->select_column[] = 'kondisi';
            $this->select_column[] = 'bertingkat';
            $this->select_column[] = 'beton';
            $this->select_column[] = 'luas_lantai';
            $this->select_column[] = 'letak';
            $this->select_column[] = 'DATE_FORMAT(tgl_dokumen, "%d/%m/%Y") as tgl_dokumen';
            $this->select_column[] = 'no_dokumen';
            $this->select_column[] = 'luas_bangunan';
            $this->select_column[] = 'status_tanah';
            $this->select_column[] = 'no_kode_tanah';
        } else if ($id_jenis_kib == 4) {
            $this->select_column[] = 'kondisi';
            $this->select_column[] = 'konstruksi';
            $this->select_column[] = 'panjang';
            $this->select_column[] = 'lebar';
            $this->select_column[] = 'luas';
            $this->select_column[] = 'letak';
            $this->select_column[] = 'DATE_FORMAT(tgl_dokumen, "%d/%m/%Y") as tgl_dokumen';
            $this->select_column[] = 'no_dokumen';
            $this->select_column[] = 'status_tanah';
            $this->select_column[] = 'no_kode_tanah';
        } else if ($id_jenis_kib == 5) {
            $this->select_column[] = 'judul_buku';
            $this->select_column[] = 'spesifikasi_buku';
            $this->select_column[] = 'asal_seni';
            $this->select_column[] = 'pencipta_seni';
            $this->select_column[] = 'bahan_seni';
            $this->select_column[] = 'jenis_hewan_tumbuhan';
            $this->select_column[] = 'ukuran_hewan_tumbuhan';
            $this->select_column[] = 'jumlah';
            $this->select_column[] = 'thn_beli';
        } else {
            $this->select_column[] = 'kondisi';
            $this->select_column[] = 'bertingkat';
            $this->select_column[] = 'beton';
            $this->select_column[] = 'luas_lantai';
            $this->select_column[] = 'letak';
            $this->select_column[] = 'DATE_FORMAT(tgl_dokumen, "%d/%m/%Y") as tgl_dokumen';
            $this->select_column[] = 'no_dokumen';
            $this->select_column[] = 'DATE_FORMAT(tgl_dokumen, "%d/%m/%Y") as tgl_mulai';
            $this->select_column[] = 'status_tanah';
            $this->select_column[] = 'no_kode_tanah';
        }

        $this->select_column[] = 'asal_usul';
        $this->select_column[] = "(SELECT SUM(br.harga_barang) FROM tbl_barang br WHERE br.id_barang IN (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset)) as harga_aset";
        $this->select_column[] = 'ket_aset';

        // Detail Rincian Aset
        $this->select_column[] = "(SELECT GROUP_CONCAT(br.nama_barang SEPARATOR ';') FROM tbl_barang br WHERE br.id_barang IN (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset)) as nm_brg";
        $this->select_column[] = "(SELECT GROUP_CONCAT(br.merk_barang SEPARATOR ';') FROM tbl_barang br WHERE br.id_barang IN (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset)) as merk_brg";
        $this->select_column[] = "(SELECT GROUP_CONCAT(br.sn_barang SEPARATOR ';') FROM tbl_barang br WHERE br.id_barang IN (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset)) as sn_brg";
        $this->select_column[] = "(SELECT GROUP_CONCAT(br.satuan_barang SEPARATOR ';') FROM tbl_barang br WHERE br.id_barang IN (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset)) as sat_brg";
        $this->select_column[] = "(SELECT GROUP_CONCAT(br.harga_barang SEPARATOR ';') FROM tbl_barang br WHERE br.id_barang IN (SELECT ar.id_barang FROM tbl_aset_rincian ar WHERE ar.id_aset = ast.id_aset)) as hrg_brg";

        $order_column = array();
        foreach ($this->select_column as $val) {
            $select = explode(" as ", $val);
            if ($select[1] != 'harga_aset' && $select[1] != 'nm_brg' && $select[1] != 'merk_brg' && $select[1] != 'sat_brg' && $select[1] != 'hrg_brg' && $select[1] != 'sn_brg' && $select[1] != 'sn_aset') {
                $this->select_column_search[] = $select[0];
            }

            if ($select[0] != 'id_aset') {
                if ($select[1] != null && $select[1] != '') {
                    if ($select[1] != 'nm_brg' && $select[1] != 'merk_brg' && $select[1] != 'sat_brg' && $select[1] != 'hrg_brg' && $select[1] != 'sn_brg') {
                        $order_column[] = $select[1];
                    }
                } else {
                    $order_column[] = $select[0];
                }
            } else {
                $order_column[] = null;
                $order_column[] = null;
                $order_column[] = null;
            }
        }

         //Detail Histori Aset
        // $this->select_column[] = "(SELECT GROUP_CONCAT(st.nama_status SEPARATOR ';') FROM tbl_aset_status st WHERE st.id_aset_status IN (SELECT hst.id_aset_status FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset)) as status_aset";
        $this->select_column[] = "(SELECT GROUP_CONCAT((SELECT usr.nama_user FROM tbl_user usr WHERE usr.id_user = hst.id_user) ORDER BY hst.tgl_histori DESC SEPARATOR ';') FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset AND hst.id_aset_status = 1) as nama_penanggung";
        $this->select_column[] = "(SELECT GROUP_CONCAT(hst.pemegang ORDER BY hst.tgl_histori DESC SEPARATOR ';') FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset AND hst.id_aset_status = 1) as pemegang";
        $this->select_column[] = "(SELECT GROUP_CONCAT(hst.lokasi_histori ORDER BY hst.tgl_histori DESC SEPARATOR ';') FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset AND hst.id_aset_status = 1) as lokasi_histori";
        $this->select_column[] = "(SELECT GROUP_CONCAT((SELECT sk.nama_skpd FROM tbl_skpd sk WHERE sk.id_skpd = hst.id_skpd) ORDER BY hst.tgl_histori DESC SEPARATOR ';') FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset AND hst.id_aset_status = 1) as nama_skpd";
        $this->select_column[] = "(SELECT GROUP_CONCAT(DATE_FORMAT(hst.tgl_histori, '%d-%m-%Y') ORDER BY hst.tgl_histori DESC SEPARATOR ';') FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset AND hst.id_aset_status = 1) as tgl_histori";
        $this->select_column[] = "(SELECT GROUP_CONCAT(hst.keperluan_histori ORDER BY hst.tgl_histori DESC SEPARATOR ';') FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset AND hst.id_aset_status = 1) as keperluan_histori";
        $this->select_column[] = "(SELECT GROUP_CONCAT(hst.ket_histori ORDER BY hst.tgl_histori DESC SEPARATOR ';') FROM tbl_aset_histori hst WHERE hst.id_aset = ast.id_aset AND hst.id_aset_status = 1) as ket_histori";

        $this->db->select($this->select_column);
        $this->db->where("ast.id_jenis_kib = $id_jenis_kib");
        $this->db->where("ast.id_aset_status  = 1");
        $this->db->join($tbl.' kib', 'ast.id_kib = kib.id_kib', 'left');
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
            $this->db->order_by($order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('ast.id_aset', 'DESC');
        }
    }

    function make_datatables($tbl = '', $id_jenis_kib='')
    {
        $this->make_query($tbl, $id_jenis_kib);
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data($tbl = '', $id_jenis_kib='')
    {
        $this->make_query($tbl, $id_jenis_kib);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data($id_jenis_kib='')
    {
        $this->db->select("*");
        $this->db->where('id_jenis_kib', $id_jenis_kib);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
