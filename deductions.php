<?php include('db_connect.php'); ?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <!-- FORM Panel -->
            <div class="col-md-4 col-sm-12">
                <form action="" id="manage-deductions">
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="font-weight-bold">Deductions Form</h4>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="control-label">Deduction Name</label>
                                <textarea name="deduction" cols="30" rows="2" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="description" cols="30" rows="2" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-sm btn-primary col-sm-4">Save</button>
                            <button class="btn btn-sm btn-default col-sm-4" type="button" onclick="_reset()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="font-weight-bold">Deductions List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <?php
                                        // Define table headers dynamically
                                        $headers = [
                                            '#' => 'text-center',
                                            'Deduction Name' => 'text-center',
                                            'Description' => 'text-center',
                                            'Action' => 'text-center',
                                        ];
                                        foreach ($headers as $header => $class) {
                                            echo "<th class='{$class}'>{$header}</th>";
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $deductions = $conn->query("SELECT * FROM deductions ORDER BY id ASC");
                                    while ($row = $deductions->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td><?php echo $row['deduction']; ?></td>
                                        <td class="description-cell"><?php echo $row['description']; ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary edit_deductions"
                                                type="button"
                                                data-id="<?php echo $row['id']; ?>"
                                                data-deduction="<?php echo $row['deduction']; ?>"
                                                data-description="<?php echo $row['description']; ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger delete_deductions" type="button"
                                                data-id="<?php echo $row['id']; ?>">Delete</button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>
</div>

<style>
    /* Global font family */
    body {
        font-family: Arial, sans-serif;
        background-color: rgb(210, 212, 212);
    }

    /* Header background color */
    :root {
        --attendance-header-bg: rgb(40, 47, 53);
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
        padding: 10px;
        background-color: var(--attendance-header-bg) !important;
        color: white;
    }

    h4 {
        margin: 0;
        font-size: 1.1rem;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        font-size: 0.875rem;
        letter-spacing: 1px;
        text-align: center;
        padding: 8px;
        background-color: #f8f9fa;
    }

    .table td {
        text-align: center;
        padding: 8px;
    }

    /* Update description cell style */
    .description-cell {
        text-align: left; /* Align text to the left */
        font-style: italic; /* Make text italic */
    }

    .table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table tbody tr:hover {
        background-color: #e9ecef;
    }

    /* Button styling */
    .btn-primary {
        background-color: rgb(245, 247, 250);
        color: rgb(26, 90, 187);
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: rgb(255, 255, 255);
        color: #dc3545;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #a71d2a;
    }

    .btn-default {
        background-color: rgb(216, 44, 44);
        color: white;
        transition: background-color 0.3s ease;
    }

    .btn-default:hover {
        background-color: rgb(102, 17, 6);
        color: white;
    }
</style>
