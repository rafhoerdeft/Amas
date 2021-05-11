<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="konstruksi">Konstruksi :</label>
            <input type="text" class="form-control" name="konstruksi" id="konstruksi" value="<?php echo (isset($dataKib))?$dataKib->konstruksi:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="panjang">Panjang (m):</label>
            <input type="text" class="form-control" name="panjang" id="panjang" placeholder="0" onkeypress="return inputAngka(event);" value="<?php echo (isset($dataKib))?$dataKib->panjang:''; ?>" maxlength="9">
        </div>
        <div class="form-group">
            <label for="lebar">Lebar (m):</label>
            <input type="text" class="form-control" name="lebar" id="lebar" placeholder="0" onkeypress="return inputAngka(event);" value="<?php echo (isset($dataKib))?$dataKib->lebar:''; ?>" maxlength="9">
        </div>
        <div class="form-group">
            <label for="luas">Luas (m<sup>2</sup>):</label>
            <input type="text" class="form-control" name="luas" id="luas" placeholder="0" onkeypress="return inputAngka(event);" value="<?php echo (isset($dataKib))?$dataKib->luas:''; ?>" maxlength="11">
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
            <input type="text" class="form-control" name="no_kode_tanah" id="no_kode_tanah" value="<?php echo (isset($dataKib))?$dataKib->no_kode_tanah:''; ?>" >
        </div>
        <div class="form-group">
            <label for="asal_usul">Asal Usul :</label>
            <input type="text" class="form-control" name="asal_usul" id="asal_usul" value="<?php echo (isset($dataKib))?$dataKib->asal_usul:''; ?>" required>
        </div>
    </div>
</div>