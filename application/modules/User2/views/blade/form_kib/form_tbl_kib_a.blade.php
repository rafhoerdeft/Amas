<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="luas_tanah">Luas Tanah (m<sup>2</sup>):</label>
            <input type="text" class="form-control" name="luas_tanah" id="luas_tanah" placeholder="0" onkeypress="return inputAngka(event);" value="<?php echo (isset($dataKib))?$dataKib->luas_tanah:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="thn_beli">Tahun Beli :</label>
            <input type="text" class="form-control" onkeypress="return inputAngka(event);" name="thn_beli" id="thn_beli" maxlength="4" value="<?php echo (isset($dataKib))?$dataKib->thn_beli:date('Y'); ?>" required>
        </div>
        <div class="form-group">
            <label for="letak">Lokasi :</label>
            <textarea name="letak" id="letak" rows="2" class="form-control" required><?php echo (isset($dataKib))?$dataKib->letak:''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="status_tanah">Status Tanah :</label>
            <input type="text" class="form-control" name="status_tanah" id="status_tanah" value="<?php echo (isset($dataKib))?$dataKib->status_tanah:''; ?>" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tgl_sertifikat">Tanggal Sertifikat :</label>
            <input type="date" class="form-control" id="tgl_sertifikat" name="tgl_sertifikat" value="<?php echo (isset($dataKib))?$dataKib->tgl_sertifikat:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="no_sertifikat">No. Sertifikat :</label>
            <input type="text" class="form-control" name="no_sertifikat" id="no_sertifikat" value="<?php echo (isset($dataKib))?$dataKib->no_sertifikat:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="penggunaan">Penggunaan :</label>
            <input type="text" class="form-control" name="penggunaan" id="penggunaan" value="<?php echo (isset($dataKib))?$dataKib->penggunaan:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="asal_usul">Asal Usul :</label>
            <input type="text" class="form-control" name="asal_usul" id="asal_usul" value="<?php echo (isset($dataKib))?$dataKib->asal_usul:''; ?>" required>
        </div>
    </div>
</div>