<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="kondisi">Kondisi :</label>
            <input type="text" class="form-control" name="kondisi" id="kondisi" value="<?php echo (isset($dataKib))?$dataKib->kondisi:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="bertingkat">Konstruksi Bertingkat :</label>
            <select id="bertingkat" name="bertingkat" class="form-control">
                <option value="BERTINGKAT" <?= (isset($dataKib) && $dataKib->bertingkat=='BERTINGKAT')?'selected':'' ?>>Ya</option>
                <option value="TIDAK" <?= (isset($dataKib) && $dataKib->bertingkat=='TIDAK')?'selected':'' ?>>Tidak</option>
            </select>
        </div>
        <div class="form-group">
            <label for="beton">Konstruksi Beton :</label>
            <select id="beton" name="beton" class="form-control">
                <option value="BETON" <?= (isset($dataKib) && $dataKib->beton=='BETON')?'selected':'' ?>>Ya</option>
                <option value="TIDAK" <?= (isset($dataKib) && $dataKib->beton=='TIDAK')?'selected':'' ?>>Tidak</option>
            </select>
        </div>
        <div class="form-group">
            <label for="luas_lantai">Luas Lantai (m<sup>2</sup>):</label>
            <input type="text" class="form-control" name="luas_lantai" id="luas_lantai" placeholder="0" onkeypress="return inputAngka(event);" value="<?php echo (isset($dataKib))?$dataKib->luas_lantai:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="luas_bangunan">Luas Bangunan (m<sup>2</sup>):</label>
            <input type="text" class="form-control" name="luas_bangunan" id="luas_bangunan" placeholder="0" onkeypress="return inputAngka(event);" value="<?php echo (isset($dataKib))?$dataKib->luas_bangunan:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="letak">Lokasi :</label>
            <textarea name="letak" id="letak" rows="2" class="form-control" required><?php echo (isset($dataKib))?$dataKib->letak:''; ?></textarea>
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl_dokumen">Tanggal Dokumen :</label>
            <input type="date" class="form-control" id="tgl_dokumen" name="tgl_dokumen" value="<?php echo (isset($dataKib))?$dataKib->tgl_dokumen:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="no_dokumen">No. Dokumen :</label>
            <input type="text" class="form-control" name="no_dokumen" id="no_dokumen" value="<?php echo (isset($dataKib))?$dataKib->no_dokumen:''; ?>" >
        </div>
        <div class="form-group">
            <label for="status_tanah">Status Tanah :</label>
            <input type="text" class="form-control" name="status_tanah" id="status_tanah" value="<?php echo (isset($dataKib))?$dataKib->status_tanah:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="no_kode_tanah">No. Kode Tanah :</label>
            <input type="text" class="form-control" name="no_kode_tanah" id="no_kode_tanah" value="<?php echo (isset($dataKib))?$dataKib->no_kode_tanah:''; ?>">
        </div>
        <div class="form-group">
            <label for="asal_usul">Asal Usul :</label>
            <input type="text" class="form-control" name="asal_usul" id="asal_usul" value="<?php echo (isset($dataKib))?$dataKib->asal_usul:''; ?>" required>
        </div>
    </div>
</div>