<?php include('db_connect.php'); ?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="" id="manage-position">
                    <div class="card">
                        <div class="card-header text-white" style="background-color: #343a40;">
                            Position Form
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="control-label">Department</label>
                                <select class="custom-select browser-default select2" name="department_id">
                                    <option value=""></option>
                                    <?php
                                    $dept = $conn->query("SELECT * FROM department ORDER BY name ASC");
                                    while ($row = $dept->fetch_assoc()):
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Position Name</label>
                                <textarea name="name" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-sm btn-success col-sm-4">Save</button>
                                    <button class="btn btn-sm btn-secondary col-sm-4" type="button" onclick="_reset()">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #343a40;">
                        Position List
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $position = $conn->query("SELECT p.id, p.name as position_name, d.name as department_name FROM position p JOIN department d ON p.department_id = d.id ORDER BY p.id ASC");
                                while ($row = $position->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td><?php echo $row['department_name']; ?></td>
                                        <td><?php echo $row['position_name']; ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-info edit_position" type="button"
                                                data-id="<?php echo $row['id']; ?>" 
                                                data-name="<?php echo $row['position_name']; ?>" 
                                                data-department_id="<?php echo $row['department_name']; ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger delete_position" type="button" data-id="<?php echo $row['id']; ?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this position?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* General Style Adjustments */
    body {
        font-family: Arial, sans-serif;
        background-color:rgb(210, 212, 212);
    }
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        border: none;
        transition: 0.3s;
    }
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    td {
        vertical-align: middle !important;
    }

    td p {
        margin: unset;
    }

    .card-header {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .select2-container--default .select2-selection--single {
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
    }

    table thead {
        background-color: #343a40;
        color: white;
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Button Styling */
    .btn {
        font-size: 13px;
        border-radius: 5px;
        padding: 8px 16px;
        transition: all 0.3s ease;
    }

    .btn-success {
        background-color:rgb(126, 153, 7); /* Green background for success */
        border: rgb(8, 87, 233);
        color: rgb(255, 255, 255);
    }

    .btn-success:hover {
        background-color:rgb(6, 85, 23); /* Darker green on hover */
    }

    .btn-secondary {
        background-color:rgb(95, 110, 122); /* Gray background for cancel */
        border: rgb(8, 87, 233);
        color: rgb(255, 255, 255);
    }

    .btn-secondary:hover {
        background-color:rgb(52, 58, 63); /* Darker gray on hover */
    }

    .btn-info {
        background-color:rgb(253, 253, 253); /* Info background color */
        color: rgb(8, 43, 240);
    }

    .btn-info:hover {
        background-color:rgb(41, 27, 228); /* Darker blue on hover */
    }

    .btn-danger {
        background-color:rgb(255, 251, 251); /* Red background for delete */
        color: rgb(218, 18, 51);
    }

    .btn-danger:hover {
        background-color:rgb(180, 25, 40); /* Darker red on hover */
    }

    .btn-outline-danger {
        background-color: transparent;
        border: 1px solid #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .btn:focus, .btn:active {
        box-shadow: none;
        outline: none;
    }

    /* Modal Centering */
    .modal-dialog-centered {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<script>
    function _reset() {
        $('[name="id"]').val('');
        $('#manage-position').get(0).reset();
        $('.select2').val('').select2({
            placeholder: "Please Select Here",
            width: "100%"
        });
    }

    $('.select2').select2({
        placeholder: "Please Select Here",
        width: "100%"
    });

    $('#manage-position').submit(function(e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'ajax.php?action=save_position',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully added", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            }
        });
    });

    $('.edit_position').click(function() {
        start_load();
        var cat = $('#manage-position');
        cat.get(0).reset();
        cat.find("[name='id']").val($(this).attr('data-id'));
        cat.find("[name='name']").val($(this).attr('data-name'));
        $('[name="department_id"]').val($(this).attr('data-department_id')).select2({
            width: "100%"
        });
        end_load();
    });

    $('.delete_position').click(function() {
        $('#deleteConfirmationModal').modal('show');
        var positionId = $(this).attr('data-id');
        $('#confirmDeleteButton').data('id', positionId);
    });

    $('#confirmDeleteButton').click(function() {
        var positionId = $(this).data('id');
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_position',
            method: 'POST',
            data: { id: positionId },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            }
        });
        $('#deleteConfirmationModal').modal('hide');
    });
</script>
