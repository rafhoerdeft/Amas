<table id="data_aset" class="table table-hover table-bordered table-striped" style="font-size: 8pt">
    <thead>
        <tr style="text-align: center;">
            <th>No</th>
            <th>
                <div class="skin skin-check-all">
                    <input type="checkbox" name="plh_aset_all" id="check_all" value="0">
                </div>
            </th>
            <th>Aksi</th>
            <th>Nama</th>
            <th>Kode Lama</th>
            <th>Kode Baru</th>
            <th>No. Reg</th>
            <!-- <th>Jumlah</th> -->
            <th>Satuan</th>
            <th>Luas (m<sup>2</sup>)</th>
            <th>Thn Beli</th>
            <th>Lokasi</th>
            <th>Status Tanah</th>
            <th>Tgl. Sertif</th>
            <th>No. Sertif</th>
            <th>Penggunaan</th>
            <th>Asal Usul</th>
            <th>Harga (Rp)</th>
            <th>Keterangan</th>
        </tr>
    </thead>

    <!-- <tbody>
        <?php //$no=1; foreach ($dataAset as $val) { ?>
        <tr>
            <td align="center"><?php //echo $no++; ?></td>
            <td nowrap align="center">
                <button type="button" onclick="hapusData(this)" 
                data-id="<?php //echo encode($val->id_aset); ?>" 
                data-link="<?php //echo base_url('User1/deleteDataAset'); ?>" 
                data-csrfname="<?php //echo $this->security->get_csrf_token_name();; ?>" 
                data-csrfcode="<?php //echo $this->security->get_csrf_hash();; ?>" 
                class="btn btn-sm btn-danger" title="Hapus Data"><i class="la la-trash-o font-small-3"></i></button>

                <button type="button" 
                data-id="<?php //echo encode($val->id_aset); ?>" 
                onclick="editModal(this)" class="btn btn-sm btn-info" title="Update Data"><i class="la la-edit font-small-3"></i></button> 
            </td>
            <td><?php //echo $val->nama_aset; ?></td>
            <td><?php //echo ($val->kode_lama_aset=='' && $val->kode_lama_aset==null)?'-':$val->kode_lama_aset; ?></td>
            <td><?php //echo $val->kode_baru_aset; ?></td>
            <td align="center"><?php //echo $val->no_reg; ?></td>
            <td align="center"><?php //echo $val->luas_tanah; ?></td>
            <td align="center"><?php //echo $val->thn_beli; ?></td>
            <td><?php //echo $val->letak; ?></td>
            <td align="center"><?php //echo $val->status_tanah; ?></td>
            <td align="center"><?php //echo date('d/m/Y', strtotime($val->tgl_sertifikat)); ?></td>
            <td align="center"><?php //echo $val->no_sertifikat; ?></td>
            <td><?php //echo $val->penggunaan; ?></td>
            <td align="center"><?php //echo $val->asal_usul; ?></td>
            <td align="right"><?php //echo nominal($val->harga_aset); ?></td>
            <td><?php //echo $val->ket_aset; ?></td>
        </tr>
        <?php //} ?>
    </tbody> -->

</table>