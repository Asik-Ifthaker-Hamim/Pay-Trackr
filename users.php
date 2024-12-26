<?php include('db_connect.php'); ?>

<style>
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

    .card-header {
        background-color: #343a40;
        color: white;
        font-size: 20px;
        font-weight: bold;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 8px 16px;
        transition: background-color 0.3s ease;
        font-size: 14px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-outline-danger {
        border: 1px solid #dc3545;
        color: #dc3545;
        border-radius: 5px;
        font-size: 14px;
        transition: background-color 0.3s ease, color 0.3s ease;
        padding: 5px 10px;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .card-body {
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background-color: #343a40;
        color: white;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    .rem_att {
        color: #dc3545;
        cursor: pointer;
    }

    .rem_att:hover {
        text-decoration: underline;
    }

    .modal-dialog {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .modal-content {
        border-radius: 8px;
    }

    .alert-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
    }
</style>

<div class="container-fluid">
    <div class="col-lg-12">
        <br />
        <br />
        <div class="card">
            <div class="card-header">
                Users List
                <button class="btn btn-primary" type="button" id="new_user">
                    <span class="fa fa-plus"></span> New User
                </button>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $users = $conn->query("SELECT * FROM users order by name asc");
                            $i = 1;
                            while($row = $users->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td class="text-center"><?php echo $row['name'] ?></td>
                            <td class="text-center"><?php echo $row['username'] ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Action</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item edit_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
	
    $('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(){
    _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')]); // Confirm the action
});

function delete_user(id){
    start_load();
    $.ajax({
        url: 'ajax.php?action=delete_user',  // Call the delete_user action in ajax.php
        method: 'POST',
        data: {id: id},  // Pass the id of the user to be deleted
        success: function(resp){
            if(resp == 1){
                alert_toast("Data successfully deleted", 'success');
                setTimeout(function(){
                    location.reload();  // Reload the page after successful deletion
                }, 1500);
            } else {
                alert_toast("Error deleting user", 'danger');  // Display error message if the deletion failed
            }
        }
    });
}
</script>
