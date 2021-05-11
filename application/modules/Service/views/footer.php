    <!-- Jquery Core Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Bootstrap Colorpicker Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

    <!-- Dropzone Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>dropzone/dropzone.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>multi-select/js/jquery.multi-select.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- noUISlider Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>nouislider/nouislider.js"></script>


    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url().'assets/plugins/'; ?>jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url().'assets/js/'; ?>pages/tables/jquery-datatable.js"></script>
    <script src="<?php echo base_url().'assets/js/'; ?>admin.js"></script>
    <script src="<?php echo base_url().'assets/js/'; ?>pages/index.js"></script>
    <script src="<?php echo base_url().'assets/js/'; ?>pages/forms/advanced-form-elements.js"></script>

    <!-- Fungsi Dialog -->
    <script type="text/javascript">
        //These codes takes from http://t4t5.github.io/sweetalert/
        function showBasicMessage() {
            swal("Here's a message!");
        }

        function showWithTitleMessage() {
            swal("Here's a message!", "It's pretty, isn't it?");
        }

        function validasiMessage(){
            swal({
                title: "Dilarang!",
                text: "Data tidak boleh lebih dari jumlah permintaan!",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
        }

        function showSuccessMessage(input) {
            swal({
                title: input+"!",
                text: "Data Berhasil "+input+"!",
                type: "success",
                timer: 1000,
                showConfirmButton: false
            });
        }

        function showFailedMessage(input) {
            swal({
                title: "Gagal!",
                text: "Data Gagal "+input+"!",
                type: "error",
                timer: 1000,
                showConfirmButton: false
            });
        }

        function showConfirmMessage(id) {
            swal({
                title: "Anda yakin data akan dihapus?",
                text: "Data tidak akan dapat di kembalikan lagi!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    type : "GET",
                    url  : "<?php echo base_url('Admin/deleteUnit')?>",
                    dataType : "html",
                    data : {id:id},
                    success: function(data){
                        // alert(data);

                        $('#tbl-unit').DataTable().destroy();
                        showUnit();
                        $('#tbl-unit').DataTable().draw();
                        // kode_otomatis();
                        // $('#editModal #pilihBrg').attr('selected','');
                        // $('#editModal').modal('hide');

                        if(data=='Success'){
                            showSuccessMessage('Dihapus');
                        }else{
                            showFailedMessage('Dihapus');
                        } 
                    }
                });
                return false;
                // swal("Hapus!", "Data telah berhasil dihapus.", "success");
            });
        }

        function showCancelMessage() {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        }
    </script>

    <script type="text/javascript">
        $('.page-loader-wrapper2').hide();

        $('.form-control').keydown(function (e) {
            if (e.which === 13) {
                var index = $('.form-control').index(this) + 1;
                $('.form-control').eq(index).focus();
            }
        });

        // Show Unit
        showUnit();
        function showUnit(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('Admin/showUnit')?>',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    var j;
                    for(i=0; i<data.length; i++){
                        var del = data[i].id_user;

                        j = i + 1;
                        html += '<tr>'+
                                    '<td>'+j+'</td>'+
                                    '<td>'+data[i].ukerja_kode+'</td>'+
                                    '<td>'+data[i].ukerja_name+'</td>'+
                                    '<td>'+data[i].ukerja_note+'</td>'+
                                    '<td style="text-align:right;">'+
                                        '<center>'+
                                            '<button type="button" title="View" class="btn btn-primary" id="item_view" data="'+data[i].ukerja_kode+'"><i class="material-icons">visibility</i></button>'+
                                            '<button type="button" title="Edit" class="btn btn-warning" id="item_edit" data="'+data[i].ukerja_kode+'"><i class="material-icons">edit</i></button>'+
                                            '<button type="button" title="Delete" class="btn btn-danger" onClick="showConfirmMessage('+del+')" data="'+data[i].ukerja_id+'"><i class="material-icons">clear</i></button>'+
                                        '</center>'+
                                    '</td>'+
                                '</tr>';
                    }
                    $('#show-unit').html(html);
                }
            });
        }
        // End Show Unit


        // Selected Level Unit
        function lvlSelected(cekPilih){
            var id = [1,2,3];
            var data = ['User','Admin', 'Operator'];
            var opt = '';
                    opt += '<option id="pilihUnit" value="">-- Pilih Unit --</option>';
                    for (var i = 0; i<data.length; i++) {
                        if (cekPilih==id[i]) {
                            opt += '<option selected value="'+data[i]+'">'+data[i]+'</option>';
                        }else{
                            opt += '<option value="'+data[i]+'">'+data[i]+'</option>';
                        }
                    }
                    $('#Modal_Edit #lvl').html('<select class="form-control show-tick" name="level_edit" id="level_edit"></select>');
                    $('#Modal_Edit #level_edit').html(opt);
        }
        // End Selected Level Unit

        // Save
        $('#Modal_Add #btn_save').on('click',function(){
            var kode_unit    = $('#kode_unit').val();
            var nama_unit    = $('#nama_unit').val();
            var note         = $('#note').val();
            var jumlah_staff = $('#jumlah_staff').val();
            var username     = $('#username').val();
            var level        = $('#level option:selected').val();
            var password     = $('#password').val();

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('Admin/saveUnit')?>",
                dataType : "html",
                data : {
                    kode_unit:kode_unit,
                    nama_unit:nama_unit,
                    note:note,
                    jumlah_staff:jumlah_staff,
                    username:username,
                    level:level,
                    password:password
                },
                success: function(data){
                    // alert(data);

                    // $('.page-loader-wrapper2').hide();
                    $('[name="ukerja_kode"]').val("");
                    $('[name="ukerja_name"]').val("");
                    $('[name="ukerja_note"]').val("");
                    $('[name="jumlah_staff"]').val("");
                    $('[name="username"]').val("");
                    $('[name="level"]').val("");
                    $('[name="password"]').val("");

                    $('#tbl-unit').DataTable().destroy();
                    showUnit();
                    $('#tbl-unit').DataTable().draw();
                    $('#Modal_Add').modal('hide');

                    if(data=='Success'){
                        showSuccessMessage('Tersimpan');
                    }else if(data=='Gagal'){
                        showFailedMessage('Tersimpan');
                    }else{
                        swal("Gagal!", "Data Sudah Tersedia!", "error");
                    }   
                }
            });
            return false;
        });
        // End Save

        // View Detail
        $('#show-unit').on('click', '#item_view', function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/viewUnit')?>",
                async : false,
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    for(i=0; i<data.length; i++){
                        var ukerja_kode = data[i].ukerja_kode;
                        var ukerja_name = data[i].ukerja_name;
                        var ukerja_note = data[i].ukerja_note;
                        var uskerja_staff_fk = data[i].uskerja_staff_fk;
                        var username = data[i].username;
                        var password = data[i].password;
                        var level = data[i].level;
                    }

                    $('#Modal_View').modal('show');
                    $('[name="kode_unit_view"]').val(ukerja_kode);
                    $('[name="nama_unit_view"]').val(ukerja_name);
                    $('[name="note_view"]').val(ukerja_note);
                    $('[name="jumlah_staff_view"]').val(uskerja_staff_fk);
                    $('[name="username_view"]').val(username);
                    $('[name="password_view"]').val(password);
                    $('[name="level_view"]').val(level);
                }
            });
        });
        // End View Detail

        // View Edit
        $('#show-unit').on('click', '#item_edit', function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('admin/getdataUnit')?>",
                async : false,
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                    for(i=0; i<data.length; i++){
                        var ukerja_kode = data[i].ukerja_kode;
                        var ukerja_name = data[i].ukerja_name;
                        var ukerja_note = data[i].ukerja_note;
                        var uskerja_staff_fk = data[i].uskerja_staff_fk;
                        var username = data[i].username;
                        var password = data[i].password;
                        var level = data[i].level;
                    }

                    $('#Modal_Edit').modal('show');
                    $('[name="kode_unit_edit"]').val(ukerja_kode);
                    $('[name="nama_unit_edit"]').val(ukerja_name);
                    $('[name="note_edit"]').val(ukerja_note);
                    $('[name="jumlah_staff_edit"]').val(uskerja_staff_fk);
                    $('[name="username_edit"]').val(username);
                    $('[name="password_edit"]').val(password);
                    // $('[name="level_edit"]').val(level);
                    if (level=='User') {
                        lvlSelected(1);
                    }else if(level=='Admin'){
                        lvlSelected(2);
                    }else{
                        lvlSelected(3);
                    }
                }
            });
        });
        // End View Edit

        // Save
        $('#Modal_Edit #btn_update').on('click',function(){
            var kode_unit_edit    = $('#kode_unit_edit').val();
            var nama_unit_edit    = $('#nama_unit_edit').val();
            var note_edit         = $('#note_edit').val();
            var jumlah_staff_edit = $('#jumlah_staff_edit').val();
            var username_edit     = $('#username_edit').val();
            var level_edit        = $('#level_edit option:selected').val();
            
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('Admin/updateUnit')?>",
                dataType : "html",
                data : {
                    kode_unit_edit:kode_unit_edit,
                    nama_unit_edit:nama_unit_edit,
                    note_edit:note_edit,
                    jumlah_staff_edit:jumlah_staff_edit,
                    username_edit:username_edit,
                    level_edit:level_edit
                },
                success: function(data){
                    $('[name="kode_unit_edit"]').val("");
                    $('[name="nama_unit_edit"]').val("");
                    $('[name="note_edit"]').val("");
                    $('[name="jumlah_staff_edit"]').val("");
                    $('[name="username_edit"]').val("");
                    $('[name="level_edit"]').val("");
                    $('[name="password_edit"]').val("");

                    $('#tbl-unit').DataTable().destroy();
                    showUnit();
                    $('#tbl-unit').DataTable().draw();
                    $('#Modal_Edit').modal('hide');

                    if(data=='Success'){
                        showSuccessMessage('Tersimpan');
                    }else if(data=='Gagal'){
                        showFailedMessage('Tersimpan');
                    }else{
                        swal("Gagal!", "Data Sudah Tersedia!", "error");
                    }   
                }
            });
            return false;
        });
        // End Save

    </script>

    <script type="text/javascript">
        $('#kode_unit').keyup(function() {
            var unitCode = $('#kode_unit').val();
                $.ajax({
                type  : 'post',
                url   : '<?php echo site_url('Admin/codeUnit')?>',
                data  : {unitCode:unitCode},
                dataType : 'html',
                success : function(data){
                    if (data == 'Valid') {
                        $('#Modal_Add #kdUnit').attr('class','form-line focused error');
                        $('#Modal_Add #error_kdUnit').html('Kode Unit Sudah Terpakai');
                        // $('#nama_unit').focus();
                    } else {
                        $('#Modal_Add #kdUnit').attr('class','form-line focused');
                        $('#Modal_Add #error_kdUnit').html('');
                        // $('#nama_unit').focus();
                    }
                }
            });
        });
    </script>

</body>

</html>
