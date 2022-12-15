<?php
include("header.php");
include("sidebar.php");
?>

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->

                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                 <!-- [ basic-table ] start -->
                                 <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Basic Table</h5>
                                            <span class="d-block m-t-5">use class <code>table</code> inside table element</span>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                            <button class="btn btn-info float-right" id="addCategory">New Category</button>
                                                <table class="table" id="categoryTable" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Icon</th>
                                                            <th>Role</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                               
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ basic-table ] end -->
                            </div>
                    <div class="modal" tabindex="-1" id="categoryModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Categories</h5>
                        </div>
                        <div class="modal-body">
                        
                                <form id="categoryForm">
                                <input type="hidden" name="" id="update_id">
                                <div class="row">
                                    <div class="col-12">
                                    <div class="alert alert-success d-none" role="alert">
                                        This is a success alert—check it out!
                                        </div>
                                        <div class="alert alert-danger d-none" role="alert">
                                        This is a danger alert—check it out!
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <lable for="">name</lable>
                                        <div class="form-group">
                                            <input type="text" name="" id="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <lable for="">icon</lable>
                                        <div class="form-group">
                                            <input type="text" name="" id="icon" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                    <lable for="">Type</lable>
                                        <div class="form-group">
                                            <select value="role" name="" id="role" class="form-control">
                                                <option>
                                                Subscriber
                                                </option>
                                                <option>
                                                Super Admin
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                        </div>
                    </div>
                    </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

<?php
include("footer.php");
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../js/category.js"></script>