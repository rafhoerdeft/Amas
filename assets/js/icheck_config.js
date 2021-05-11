var iCek = $('.skin-check input').on('ifChecked ifUnchecked', function(event){
    pilihBarang(this, event.type);
}).iCheck({
    checkboxClass: 'icheckbox_flat-green'
});