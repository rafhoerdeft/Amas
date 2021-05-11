<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="body bg-default">
                        <div class="row">
                            <div class="col-md-10">
                                <font style="font-size: 25px;">Daftar Unit</font>
                            </div>
                            <div class="col-md-2">
                                <button type="button" name="add" id="add" class="btn btn-block btn-info waves-effect" data-toggle="modal" data-target="#Modal_Add">Add <i class="material-icons">library_add</i></button>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tbl-unit" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Kode Unit</th>
                                        <th>Nama Unit</th>
                                        <th>Note</th>
                                        <th width="150">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="show-unit">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW TASKS</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">help</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW TICKETS</div>
                        <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW COMMENTS</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW VISITORS</div>
                        <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->


    </div>
</section>

<!-- MODAL ADD -->
<div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="defaultModalLabel">Tambah Unit</h4>
                </center>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Kode Unit</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line" id="kdUnit">
                                <input type="text" name="kode_unit" id="kode_unit" class="form-control" placeholder="Kode Unit" />
                            </div>
                            <label id="error_kdUnit" class="error" for="kode_unit" style="display: block;"></label>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Nama Unit</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama_unit" id="nama_unit" class="form-control" placeholder="Nama Unit" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Note</label>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="note" id="note" class="form-control" placeholder="Note" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jumlah Staff</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="jumlah_staff" id="jumlah_staff" class="form-control" placeholder="Jumlah Staff" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Username</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Level</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group" name="level" id="level">
                            <select class="form-control show-tick">
                                <option value="">-- Please select --</option>
                                <option value="Admin">Admin</option>
                                <option value="Operator">Operator</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Password</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" id="btn_save">SAVE CHANGES</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!--END MODAL ADD-->

<!-- MODAL View -->
<div class="modal fade" id="Modal_View" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="defaultModalLabel">View Unit</h4>
                </center>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Kode Unit</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kode_unit_view" id="kode_unit_view" class="form-control" placeholder="Kode Unit" readonly disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Nama Unit</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama_unit_view" id="nama_unit_view" class="form-control" placeholder="Nama Unit" readonly disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Note</label>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="note_view" id="note_view" class="form-control" placeholder="Note" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jumlah Staff</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="jumlah_staff_view" id="jumlah_staff_view" class="form-control" placeholder="Jumlah Staff" readonly disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Username</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="username_view" id="username_view" class="form-control" placeholder="Username" readonly disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Level</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="level_view" id="level_view" class="form-control" placeholder="Level" readonly disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Password</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" name="password_view" id="password_view" class="form-control" placeholder="Password" readonly disabled />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!--END MODAL View-->

<!-- MODAL Edit -->
<div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h4 class="modal-title" id="defaultModalLabel">Edit Unit</h4>
                </center>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Kode Unit</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kode_unit_edit" id="kode_unit_edit" class="form-control" placeholder="Kode Unit" readonly disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Nama Unit</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama_unit_edit" id="nama_unit_edit" class="form-control" placeholder="Nama Unit" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                            <label class="form-label">Note</label>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="note_edit" id="note_edit" class="form-control" placeholder="Note" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Jumlah Staff</label>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="jumlah_staff_edit" id="jumlah_staff_edit" class="form-control" placeholder="Jumlah Staff" />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Username</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="username_edit" id="username_edit" class="form-control" placeholder="Username" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Level</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group" name="lvl" id="lvl">
                        </div>
                    </div>
                </div>
                <!-- <div class="row clearfix">
                    <div class="col-md-2">
                        <label class="form-label">Password</label>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" name="password_edit" id="password_edit" class="form-control" placeholder="Password" />
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" id="btn_update">SAVE CHANGES</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!--END MODAL Edit-->