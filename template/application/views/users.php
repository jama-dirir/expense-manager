<?php
include("header.php");
include("sidebar.php");
?>

    <style>
        #showImage{
            border: solid 1px #744547;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>

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
                                                <button class="btn btn-info float-right" id="addUser">Add user</button>
                                                <table class="table" id="usersTable" >
                                                    <thead>
                                                       
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
                    <div class="modal" tabindex="-1" id="usersModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Manage Your &#x1F4E8;Income &#x1F19A;  Expense &#x23EC;</h5>
                        </div>
                        <div class="modal-body">
                        
                                <form id="usersForm" enctype="multipart/form-data">
                                <input type="hidden" id="update_id" name="update_id">
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
                                        <lable for="">username</lable>
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" class="form-control" placeholder="username">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                    <lable for="">Type</lable>
                                        <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="password">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                <div class="col-sm-8 ">
                                        <div class="form-group">
                                        <img   id="showImage"  width="150" height="150" >
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

<script src="../js/users.js"></script>