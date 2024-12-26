<?php include('db_connect.php'); ?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4">
                <form action="" id="manage-department">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            Department Form
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <textarea name="name" id="" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-success col-sm-3 offset-md-3"> Save</button>
                                    <button class="btn btn-sm btn-danger col-sm-3" type="button" onclick="_reset()"> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $department = $conn->query("SELECT * FROM department order by id asc");
                                while($row=$department->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td>
                                         <p> <b><?php echo $row['name'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary edit_department" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger delete_department" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modal-message">Are you sure you want to delete this department?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dn" id="confirmDelete">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Center the modal */
    body {
        font-family: Arial, sans-serif;
        background-color:rgb(210, 212, 212);
    }
    .modal-dialog {
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 20%;
        left: 40%;
        transform: translate(-50%, -50%);
        max-width: 400px;
        width: 100%;
        z-index: 1050;
    }

    .modal-content {
        border-radius: 5px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }

    .modal-backdrop {
        z-index: 1040;
    }

    /* Table and Card Styling */
    td {
        vertical-align: middle !important;
    }
    td p {
        margin: unset;
    }
    img {
        max-width: 100px;
        max-height: 150px;
    }

    .card {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(172, 161, 161, 0.2);
    }
    .card-header {
        font-size: 18px;
        font-weight: bold;
    }

    .card-footer {
        padding-top: 20px;
    }
    .btn-success{
        background-color:rgb(126, 153, 7); /* Green background for success */
        border: rgb(8, 87, 233);
        color: rgb(255, 255, 255);
    }
    .btn-success:hover {
        background-color:rgb(6, 85, 23); /* Darker green on hover */
    }
    .btn-danger{
        background-color:rgb(95, 110, 122); /* Gray background for cancel */
        border: rgb(8, 87, 233);
        color: rgb(255, 255, 255);
    }
    .btn-dn{
        background-color:rgb(167, 51, 16);  
        color: rgb(255, 255, 255);
    }
    .btn-dn:hover{
        background-color:rgb(121, 32, 5);  
        color: rgb(255, 255, 255);
    }
    .btn-secondary{
        background-color:rgb(95, 110, 122); /* Gray background for cancel */
    }
    .btn-secondary:hover{
        background-color:rgb(28, 41, 51); /* Gray background for cancel */
    }
    .btn-danger:hover{
        background-color:rgb(26, 61, 44); /* Darker gray on hover */
    }
    .btn-outline-primary, .btn-outline-danger {
        width: 100px;
    }

    .btn-outline-primary:hover, .btn-outline-danger:hover {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    .btn-sm {
        font-size: 13px;
    }

    .bg-dark {
        background-color: #343a40 !important;
    }

    .text-white {
        color: white !important;
    }

    .shadow-lg {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    function _reset() {
        $('[name="id"]').val('');
        $('#manage-department').get(0).reset();
    }
    
    $('#manage-department').submit(function(e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_department',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully added", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)
                }
            }
        })
    })
    
    $('.edit_department').click(function() {
        start_load()
        var cat = $('#manage-department')
        cat.get(0).reset()
        cat.find("[name='id']").val($(this).attr('data-id'))
        cat.find("[name='name']").val($(this).attr('data-name'))
        end_load()
    })

    $('.delete_department').click(function() {
        var departmentId = $(this).attr('data-id');
        $('#deleteModal').modal('show');
        $('#confirmDelete').off('click').on('click', function() {
            delete_department(departmentId);
            $('#deleteModal').modal('hide');
        });
    })

    function delete_department($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_department',
            method: 'POST',
            data: {id: $id},
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
</script>
