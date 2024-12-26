<?php include('db_connect.php') ?>
<?php
    $pay = $conn->query("SELECT * FROM payroll where id = ".$_GET['id'])->fetch_array();
    $pt = array(1=>"Monthly", 2=>"Semi-Monthly");
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color:rgb(210, 212, 212);
    }
    .container-fluid {
        font-family: Arial, sans-serif;
        transition: background-color 0.3s ease;
    }

    .row {
        margin: 0;
        padding: 0;
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        border-radius: 5px;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 2px 16px;
    }

    .btn-primary, .btn-outline-danger {
        border: none;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        font-size: 15px;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-outline-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    td p {
        margin: unset;
    }

    .rem_att {
        cursor: pointer;
    }

    /* Centering Modal using flexbox */
    .modal-dialog {
        display: flex;
        justify-content: flex-start; /* Align to the left */
        align-items: center;
        height: 80vh; /* Full height of the viewport */
        margin-left: 700px; /* Move the modal box to the right */
    }

    .modal-content {
        max-width: 600px;
        width: 100%; /* Set modal width to 100% of the available space */
    }

    .modal-backdrop {
        z-index: 1050 !important; /* Ensure the backdrop is behind the modal */
    }

    .modal-small .modal-dialog {
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 70vh;
    }

    .modal-small .modal-content {
        height: 90vh; /* Adjust height based on content */
        max-height: 400px; /* Max height for small modal */
        overflow-y: auto; /* Allow scrolling if content exceeds */
    }

    /* Custom z-index for modal dialog */
    .modal-backdrop.show {
        z-index: 1040 !important;
    }

    /* Centering the Add Payroll button */
    .card-header {
        display: flex;
        justify-content: space-between; /* Space between header content */
        align-items: center; /* Vertically center the content */
    }

    .btn-block {
        float: right;
    }

    /* Aligning buttons to the right */
    #print_btn {
        margin-left: 10px;
    }

    /* Center the table */
    table {
        width: 100%;
        margin-top: 20px;
    }

    .card-body p {
        margin: 5px 0;
    }

    /* Adjusting button sizes */
    .btn-sm {
        padding: 8px 10px;
        font-size: 14px;
    }
</style>

<div class="container-fluid">
    <div class="col-lg-12">
        <br />
        <br />
        <div class="card">
            <div class="card-header">
                <span><b>Payroll: <?php echo $pay['ref_no'] ?></b></span>
                <button class="btn btn-primary btn-sm btn-block col-md-2 float-right" type="button" id="new_payroll_btn"><span class="fa fa-plus"></span> Re-Calculate Payroll</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Payroll Range: <b><?php echo date("M d, Y", strtotime($pay['date_from'])) . " - " . date("M d, Y", strtotime($pay['date_to'])) ?></b></p>
                        <p>Payroll Type: <b><?php echo $pt[$pay['type']] ?></b></p>
                        <button class="btn btn-success btn-sm btn-block col-md-2 float-right" type="button" id="print_btn"><span class="fa fa-print"></span> Print</button>
                    </div>
                </div>
                <hr>
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Absent</th>
                            <th>Late</th>
                            <th>Total Allowance</th>
                            <th>Total Deduction</th>
                            <th>Net</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $payroll = $conn->query("SELECT p.*, concat(e.lastname, ', ', e.firstname, ' ', e.middlename) as ename, e.employee_no FROM payroll_items p INNER JOIN employee e ON e.id = p.employee_id") or die(mysqli_error());
                            while ($row = $payroll->fetch_array()) {
                        ?>
                        <tr>
                            <td><?php echo $row['employee_no'] ?></td>
                            <td><?php echo ucwords($row['ename']) ?></td>
                            <td><?php echo $row['absent'] ?></td>
                            <td><?php echo $row['late'] ?></td>
                            <td><?php echo number_format($row['allowance_amount'], 2) ?></td>
                            <td><?php echo number_format($row['deduction_amount'], 2) ?></td>
                            <td><?php echo number_format($row['net'], 2) ?></td>
                            <td>
                                <center>
                                    <button class="btn btn-sm btn-outline-primary view_payroll" data-id="<?php echo $row['id'] ?>" type="button"><i class="fa fa-eye"></i> View</button>
                                </center>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#table').DataTable();
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#print_btn').click(function(){
            var nw = window.open("print_payroll.php?id=<?php echo $_GET['id'] ?>", "_blank", "height=500,width=800");
            setTimeout(function(){
                nw.print();
                setTimeout(function(){
                    nw.close();
                }, 500);
            }, 1000);
        });

        $('.view_payroll').click(function(){
            var $id = $(this).attr('data-id');
            uni_modal("Employee Payslip", "view_payslip.php?id=" + $id, "large");
        });

        $('#new_payroll_btn').click(function(){
            start_load();
            $.ajax({
                url: 'ajax.php?action=calculate_payroll',
                method: "POST",
                data: {id: '<?php echo $_GET['id'] ?>'},
                error: err => console.log(err),
                success: function(resp){
                    if (resp == 1) {
                        alert_toast("Payroll successfully computed", "success");
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                }
            });
        });
    });

    function remove_payroll(id){
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_payroll',
            method: "POST",
            data: {id: id},
            error: err => console.log(err),
            success: function(resp){
                if (resp == 1) {
                    alert_toast("Payroll successfully deleted", "success");
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }
            }
        });
    }
</script>
