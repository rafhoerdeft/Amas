<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="merk_type">Merk/Type :</label>
            <input type="text" class="form-control" name="merk_type" id="merk_type" value="<?php echo (isset($dataKib))?$dataKib->merk_type:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="ukuran_cc">Ukuran/CC :</label>
            <input type="text" class="form-control" name="ukuran_cc" id="ukuran_cc" value="<?php echo (isset($dataKib))?$dataKib->ukuran_cc:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="bahan">Bahan :</label>
            <input type="text" class="form-control" name="bahan" id="bahan" value="<?php echo (isset($dataKib))?$dataKib->bahan:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="warna">Warna :</label>
            <input type="text" class="form-control" name="warna" id="warna" value="<?php echo (isset($dataKib))?$dataKib->warna:''; ?>" required>
        </div>
        <div class="form-group">
            <label for="thn_beli">Tahun Beli :</label>
            <input type="text" class="form-control" onkeypress="return inputAngka(event);" name="thn_beli" id="thn_beli" maxlength="4" value="<?php echo (isset($dataKib))?$dataKib->thn_beli:date('Y'); ?>" required>
        </div>
        <div class="form-group">
            <label for="no_pabrik">No. Pabrik :</label>
            <input type="text" class="form-control" name="no_pabrik" id="no_pabrik" value="<?php echo (isset($dataKib))?$dataKib->no_pabrik:''; ?>" >
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="no_rangka">No. Rangka :</label>
            <input type="text" class="form-control" name="no_rangka" id="no_rangka" value="<?php echo (isset($dataKib))?$dataKib->no_rangka:''; ?>" >
        </div>
        <div class="form-group">
            <label for="no_mesin">No. Mesin :</label>
            <input type="text" class="form-control" name="no_mesin" id="no_mesin" value="<?php echo (isset($dataKib))?$dataKib->no_mesin:''; ?>" >
        </div>
        <div class="form-group">
            <label for="no_polisi">No. Polisi :</label>
            <input type="text" class="form-control" name="no_polisi" id="no_polisi" value="<?php echo (isset($dataKib))?$dataKib->no_polisi:''; ?>" >
        </div>
        <div class="form-group">
            <label for="no_bpkb">Warna :</label>
            <input type="text" class="form-control" name="no_bpkb" id="no_bpkb" value="<?php echo (isset($dataKib))?$dataKib->no_bpkb:''; ?>" >
        </div>
        <div class="form-group">
            <label for="asal_usul">Asal Usul :</label>
            <input type="text" class="form-control" name="asal_usul" id="asal_usul" value="<?php echo (isset($dataKib))?$dataKib->asal_usul:''; ?>" required>
        </div>
    </div>
</div>