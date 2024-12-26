<?php include('db_connect.php') ?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color:rgb(210, 212, 212);
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        border: none;
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
                Attendance List
                <button class="btn btn-primary" type="button" id="new_attendance_btn">
                    <span class="fa fa-plus"></span> Add Attendance
                </button>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee No</th>
                            <th>Name</th>
                            <th>Time Record</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $att = $conn->query("SELECT a.*, e.employee_no, concat(e.lastname, ', ', e.firstname, ' ', e.middlename) as ename 
                                                 FROM attendance a 
                                                 INNER JOIN employee e on a.employee_id = e.id 
                                                 ORDER BY UNIX_TIMESTAMP(datetime_log) ASC") or die(mysqli_error());
                            $lt_arr = array(1 => "Time-in AM", 2 => "Time-out AM", 3 => "Time-in PM", 4 => "Time-out PM");
                            while($row = $att->fetch_array()) {
                                $date = date("Y-m-d", strtotime($row['datetime_log']));
                                $attendance[$row['employee_id']."_".$date]['details'] = array("eid" => $row['employee_id'], "name" => $row['ename'], "eno" => $row['employee_no'], "date" => $date);
                                if($row['log_type'] == 1 || $row['log_type'] == 3){
                                    if(!isset($attendance[$row['employee_id']."_".$date]['log'][$row['log_type']]))
                                        $attendance[$row['employee_id']."_".$date]['log'][$row['log_type']] = array('id' => $row['id'], "date" =>  $row['datetime_log']);
                                } else {
                                    $attendance[$row['employee_id']."_".$date]['log'][$row['log_type']] = array('id' => $row['id'], "date" =>  $row['datetime_log']);
                                }
                            }
                            foreach ($attendance as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo date("M d,Y", strtotime($attendance[$key]['details']['date'])) ?></td>
                            <td><?php echo $attendance[$key]['details']['eno'] ?></td>
                            <td><?php echo $attendance[$key]['details']['name'] ?></td>
                            <td>
                                <div>
                                    <?php 
                                    foreach($attendance[$key]['log'] as $k => $v) :
                                    ?>
                                    <p>
                                        <small><b><?php echo $lt_arr[$k].": " ?>
                                            <?php echo (date("h:i A", strtotime($attendance[$key]['log'][$k]['date'])))  ?></b>
                                            <span class="rem_att" data-id="<?php echo $attendance[$key]['log'][$k]['id'] ?>"><i class="fa fa-trash"></i></span>
                                        </small>
                                    </p>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                            <td>
                                <center>
                                    <button class="btn btn-outline-danger remove_attendance" data-id="<?php echo $key ?>" type="button"><i class="fa fa-trash"></i></button>
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

			

			
			$('.edit_attendance').click(function(){
				var $id=$(this).attr('data-id');
				uni_modal("Edit Employee","manage_attendance.php?id="+$id)
				
			});
			$('.view_attendance').click(function(){
				var $id=$(this).attr('data-id');
				uni_modal("Employee Details","view_attendance.php?id="+$id,"mid-large")
				
			});
			$('#new_attendance_btn').click(function(){
				uni_modal("New Time Record/s","manage_attendance.php",'mid-large')
			})
			$('.remove_attendance').click(function(){
				var d = '"'+($(this).attr('data-id')).toString()+'"';
				_conf("Are you sure to delete this employee's time log record?","remove_attendance",[d])
			})
			$('.rem_att').click(function(){
				var $id=$(this).attr('data-id');
				_conf("Are you sure to delete this time log?","rem_att",[$id])
			})
		});
		function remove_attendance(id){
				// console.log(id)
				// return false;
			start_load()
			$.ajax({
				url:'ajax.php?action=delete_employee_attendance',
				method:"POST",
				data:{id:id},
				error:err=>console.log(err),
				success:function(resp){
						if(resp == 1){
							alert_toast("Selected employee's time log data successfully deleted","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
					}
			})
		}
		function rem_att(id){
				
			start_load()
			$.ajax({
				url:'ajax.php?action=delete_employee_attendance_single',
				method:"POST",
				data:{id:id},
				error:err=>console.log(err),
				success:function(resp){
						if(resp == 1){
							alert_toast("Selected employee's time log data successfully deleted","success");
								setTimeout(function(){
								location.reload();

							},1000)
						}
					}
			})
		}
</script>