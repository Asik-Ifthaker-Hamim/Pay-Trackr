<?php include('db_connect.php') ?>
<style>
     body {
        font-family: Arial, sans-serif;
        background-color:rgb(210, 212, 212);
    }
    :root {
        --attendance-header-bg:rgb(40, 47, 53); /* Example: Dark Gray */
        --attendance-header-text: #ffffff; /* White Text */
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

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: var(--attendance-header-bg); /* Use Attendance-like color */
        color: var(--attendance-header-text); /* White text */
        padding: 15px;
        font-size: 20px;
        font-weight: bold;
        border-radius: 5px 5px 0 0;
    }

    .btn-primary, .btn-outline-danger {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 8px 12px;
        transition: background-color 0.3s ease;
        font-size: 14px;
    }

    .btn-primary {
        background-color:  #007bff;
        color: var(--attendance-header-text);
    }

    .btn-primary:hover {
        background-color:rgb(15, 83, 134); /* Slightly darker shade */
    }

    .btn-outline-danger {
        border: 1px solid #dc3545;
        color: #dc3545;
        border-radius: 5px;
        font-size: 14px;
        transition: background-color 0.3s ease, color 0.3s ease;
        padding: 5px 10px;
		background-color:rgb(241, 241, 241);
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
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
        height: 70vh; /* Full height of the viewport */
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
        height: auto; /* Adjust height based on content */
        max-height: 400px; /* Max height for small modal */
        overflow-y: auto; /* Allow scrolling if content exceeds */
    }

    /* Custom z-index for modal dialog */
    .modal-backdrop.show {
        z-index: 1040 !important;
    }
</style>

<div class="container-fluid">
    <div class="col-lg-12">
        <br />
        <br />
        <div class="card">
            <div class="card-header">
                <span><b>Payroll List</b></span>
                <button class="btn btn-primary btn-sm btn-block col-md-3 float-right" type="button" id="new_payroll_btn">
                    <span class="fa fa-plus"></span> Add Payroll
                </button>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Ref No</th>
                            <th>Date From</th>
                            <th>Date To</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $payroll = $conn->query("SELECT * FROM payroll order by date(date_from) desc") or die(mysqli_error());
                            while ($row = $payroll->fetch_array()) {
                        ?>
                        <tr>
                            <td><?php echo $row['ref_no'] ?></td>
                            <td><?php echo date("M d, Y", strtotime($row['date_from'])) ?></td>
                            <td><?php echo date("M d, Y", strtotime($row['date_to'])) ?></td>
                            <?php if ($row['status'] == 0): ?>
                            <td class="text-center"><span class="badge badge-primary">New</span></td>
                            <?php else: ?>
                            <td class="text-center"><span class="badge badge-success">Calculated</span></td>
                            <?php endif ?>
                            <td>
                                <center>
                                    <?php if ($row['status'] == 0): ?>
                                    <button class="btn btn-sm btn-outline-primary calculate_payroll" data-id="<?php echo $row['id'] ?>" type="button">Calculate</button>
                                    <?php else: ?>
                                    <button class="btn btn-sm btn-outline-primary view_payroll" data-id="<?php echo $row['id'] ?>" type="button"><i class="fa fa-eye"></i></button>
                                    <?php endif ?>
                                    <button class="btn btn-sm btn-outline-primary edit_payroll" data-id="<?php echo $row['id'] ?>" type="button"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger remove_payroll" data-id="<?php echo $row['id'] ?>" type="button"><i class="fa fa-trash"></i></button>
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
    $(document).ready(function () {
        $('#table').DataTable();
    });

    $(document).ready(function () {

        $('.edit_payroll').click(function () {
            var $id = $(this).attr('data-id');
            uni_modal("Edit Payroll", "manage_payroll.php?id=" + $id)
        });

        $('.view_payroll').click(function () {
            var $id = $(this).attr('data-id');
            location.href = "index.php?page=payroll_items&id=" + $id;
        });

        $('#new_payroll_btn').click(function () {
            uni_modal("New Payroll", "manage_payroll.php")
        })

        $('.remove_payroll').click(function () {
            _conf("Are you sure to delete this payroll?", "remove_payroll", [$(this).attr('data-id')])
        })

        $('.calculate_payroll').click(function () {
            start_load()
            $.ajax({
                url: 'ajax.php?action=calculate_payroll',
                method: "POST",
                data: { id: $(this).attr('data-id') },
                error: err => console.log(err),
                success: function (resp) {
                    if (resp == 1) {
                        alert_toast("Payroll successfully computed", "success");
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
                    }
                }
            })
        })
    });

    function remove_payroll(id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_payroll',
            method: "POST",
            data: { id: id },
            error: err => console.log(err),
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Payroll successfully deleted", "success");
                    setTimeout(function () {
                        location.reload();
                    }, 1000)
                }
            }
        })
    }
</script>
