<?php include('db_connect.php'); ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color:rgb(210, 212, 212);
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        border-radius: 5px;
    }

    .card-header {
        font-size: 1.2rem;
        font-weight: bold;
        color: #fff;
        background-color: #343a40;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 16px;
    }

    table {
        width: 100%;
    }

    table thead {
        background-color: #343a40;
        color: white;
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
    }

    td {
        vertical-align: middle !important;
    }

    td p {
        margin: unset;
    }

    /* Button Styles to match position page */
    .btn {
        font-size: 13px;
        border-radius: 5px;
        padding: 8px 16px;
        transition: all 0.3s ease;
    }

    .btn-sm {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }

    .btn-primary {
        background-color:rgb(255, 255, 255);
        color: rgb(11, 32, 219);
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background-color:rgb(52, 58, 63);
    }

    .btn-danger {
        background-color:rgb(255, 255, 255);
        color:  #dc3545;
    }

    .btn-danger:hover {
        background-color:rgb(161, 22, 36);
    }

    /* Modal Centering */
    .modal-dialog-centered {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-dialog {
        max-width: 500px;
        margin: 30px auto;
    }
</style>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="" id="manage-allowances">
                    <div class="card">
                        <div class="card-header">
                            Allowances Form
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="control-label">Allowance</label>
                                <textarea name="allowance" cols="30" rows="2" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="description" cols="30" rows="2" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary col-sm-4">Save</button>
                            <button class="btn btn-secondary col-sm-4" type="button" onclick="_reset()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Allowances List
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Allowance Information</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $allowances = $conn->query("SELECT * FROM allowances ORDER BY id ASC");
                                while ($row = $allowances->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td>
                                            <p><b><?php echo $row['allowance'] ?></b></p>
                                            <p class="truncate"><small><b><?php echo $row['description'] ?></b></small></p>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary edit_allowances" 
                                                    type="button" 
                                                    data-id="<?php echo $row['id'] ?>" 
                                                    data-allowance="<?php echo $row['allowance'] ?>" 
                                                    data-description="<?php echo $row['description'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger delete_allowances" 
                                                    type="button" 
                                                    data-id="<?php echo $row['id'] ?>">Delete</button>
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
                Are you sure you want to delete this allowance?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    function _reset() {
        $('[name="id"]').val('');
        $('#manage-allowances').get(0).reset();
    }

    $('#manage-allowances').submit(function(e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'ajax.php?action=save_allowances',
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

    $('.edit_allowances').click(function() {
        start_load();
        var cat = $('#manage-allowances');
        cat.get(0).reset();
        cat.find("[name='id']").val($(this).attr('data-id'));
        cat.find("[name='allowance']").val($(this).attr('data-allowance'));
        cat.find("[name='description']").val($(this).attr('data-description'));
        end_load();
    });

    $('.delete_allowances').click(function() {
        $('#deleteConfirmationModal').modal('show');
        var allowanceId = $(this).attr('data-id');
        $('#confirmDeleteButton').data('id', allowanceId);
    });

    $('#confirmDeleteButton').click(function() {
        var allowanceId = $(this).data('id');
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_allowances',
            method: 'POST',
            data: { id: allowanceId },
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
