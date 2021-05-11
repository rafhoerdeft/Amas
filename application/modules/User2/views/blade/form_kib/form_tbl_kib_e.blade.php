<div class="row">
    <div class="col-md-6">
        <h4 class="form-section"><i class="la la-book"></i> Buku Perpustakaan</h4>
        <div class="form-group">
            <label for="judul_buku">Judul Buku :</label>
            <input type="text" class="form-control" name="judul_buku" id="judul_buku" value="<?php echo (isset($dataKib))?$dataKib->judul_buku:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="spesifikasi_buku">Spesifikasi Buku :</label>
            <input type="text" class="form-control" name="spesifikasi_buku" id="spesifikasi_buku" value="<?php echo (isset($dataKib))?$dataKib->spesifikasi_buku:''; ?>" required>
        </div>

        <h4 class="form-section"><i class="la la-paint-brush"></i> Barang Bercorak Kesenian/Kebudayaan</h4>
        <div class="form-group">
            <label for="asal_seni">Asal Daerah :</label>
            <input type="text" class="form-control" name="asal_seni" id="asal_seni" value="<?php echo (isset($dataKib))?$dataKib->asal_seni:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="pencipta_seni">Pencipta :</label>
            <input type="text" class="form-control" name="pencipta_seni" id="pencipta_seni" value="<?php echo (isset($dataKib))?$dataKib->pencipta_seni:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="bahan_seni">Bahan :</label>
            <input type="text" class="form-control" name="bahan_seni" id="bahan_seni" value="<?php echo (isset($dataKib))?$dataKib->bahan_seni:''; ?>" required>
        </div>

    </div>
    <div class="col-md-6">
        <h4 class="form-section"><i class="la la-leaf"></i> Hewan Ternak & Tumbuhan</h4>
        <div class="form-group">
            <label for="jenis_hewan_tumbuhan">Jenis Hewan/Tumbuhan :</label>
            <input type="text" class="form-control" name="jenis_hewan_tumbuhan" id="jenis_hewan_tumbuhan" value="<?php echo (isset($dataKib))?$dataKib->jenis_hewan_tumbuhan:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="ukuran_hewan_tumbuhan">Ukuran Hewan/Tumbuhan :</label>
            <input type="text" class="form-control" name="ukuran_hewan_tumbuhan" id="ukuran_hewan_tumbuhan" value="<?php echo (isset($dataKib))?$dataKib->ukuran_hewan_tumbuhan:''; ?>" required>
        </div>
        
        <h4 class="form-section"></h4>
        <div class="form-group">
            <label for="jumlah">Jumlah :</label>
            <input type="text" class="form-control" name="jumlah" id="jumlah" value="<?php echo (isset($dataKib))?$dataKib->jumlah:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="thn_beli">Tahun Beli :</label>
            <input type="text" class="form-control" onkeypress="return inputAngka(event);" name="thn_beli" id="thn_beli" maxlength="4" value="<?php echo (isset($dataKib))?$dataKib->thn_beli:date('Y'); ?>" required>
        </div>
        <div class="form-group">
            <label for="asal_usul">Asal Usul :</label>
            <input type="text" class="form-control" name="asal_usul" id="asal_usul" value="<?php echo (isset($dataKib))?$dataKib->asal_usul:''; ?>" required>
        </div>

    </div>
</div>