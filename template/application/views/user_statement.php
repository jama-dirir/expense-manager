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

                                <form id="userForm">
                                        <div class="row">
                                <div class="col-sm-4">
                                    <select id="type" class="form-control">
                                        <option value="0">
                                            All 
                                        </option>
                                        <option value="custom">
                                            Custom
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                <input type="date" name="" id="from" class="form-control">
                                </div>
                                <div class="col-sm-4">
                                <input type="date" name="" id="to" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-info float-left mt-2" id="addTransaction">Get Statement &#x1F4C3;</button>
                            </div>
                        </form>
                                            <div class="table-responsive">
                                             
                                                <table class="table" id="userTable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Amount</th>
                                                            <th>Type</th>
                                                            <th>Description</th>
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

<script src="../js/user_statement.js"></script>