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
                                                <button class="btn btn-info float-right" id="addTransaction">New Transaction</button>
                                                <table class="table" id="expenseTable" >
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
                    <div class="modal" tabindex="-1" id="expenseModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Manage Your &#x1F4E8;Income &#x1F19A;  Expense &#x23EC;</h5>
                        </div>
                        <div class="modal-body">
                        
                                <form id="expenseForm">
                                <input type="hidden" name="" id="get_update_id">
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
                                        <lable for="">Amount</lable>
                                        <div class="form-group">
                                            <input type="text" name="" id="amount" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                    <lable for="">Type</lable>
                                        <div class="form-group">
                                            <select value="type" name="" id="type" class="form-control">
                                                <option>
                                                    Income
                                                </option>
                                                <option>
                                                    Expense
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <lable for="">Description</lable>
                                        <div class="form-group">
                                            <input type="text" name="" id="description" class="form-control">
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

<script src="../js/expense.js"></script>