<?php
session_start();
if (isset($_SESSION['phpstartup_adminid'])) {
	include "base/header.php";
	include 'base/db.php';
	$username = $_SESSION['phpstartup_adminid'];
} else {
	echo "<script> location.href='index.php'; </script>";
}

?>

<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>All Admins</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page"><a href="manage-admin.php">All Admins</a></li>
							</ol>
						</nav>
					</div>

				</div>
			</div>

			<?php
			if (isset($_SESSION['role']) && $_SESSION['role'] == 0) {
				$isUpdate = isset($_GET['adminId']) && $_GET['adminId'] != "";
				$id = $isUpdate ? $_GET['adminId'] : "";
				$isSelfEdit = $id == $_SESSION['phpstartup_adminid'];
				$autoShowCollapsible = $isUpdate ? "show" : "";
				$info = $isUpdate ? "Update Admin" : "Add New Admin";
				$formId = $isUpdate ? "updateAdminInSystemForm"  : "addNewAdminInSystemForm";
				if ($isUpdate && $id != "") {
					$updateSql = "SELECT * from admin where id = '$id'";
					$updateQuery = $conn->prepare($updateSql);
					$updateQuery->execute();
					$res = $updateQuery->fetch(PDO::FETCH_OBJ);
					$name = $res->name;
					$email = $res->email;
					$password = $res->password;
					$username = $res->userName;
					$mobile = $res->mobile;
					$role = $res->role;					
					$status = $res->status;
				}
				else{
					$name = "";
					$email = "";
					$password = "";
					$username = "";
					$mobile = "";
					$role = 1;
					$status  = "";
				}
				echo '<div class="page-header">
                <div class="container">                    
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#adminInfo" aria-expanded="false" aria-controls="adminInfo">
                            ' . $info . '
                        </button>
                        <div class="collapse ' . $autoShowCollapsible . '" id="adminInfo">
                            <div class="container mt-4">
                                <form id="'.$formId.'">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
												<label for="adminName">Name</label>
												<input type="text" id="adminId" readonly hidden class="form-control" value="'.$id.'" name="adminId"  required />
                                                <input type="text" id="adminName" class="form-control" value="'.$name.'" name="adminName"  required />
                                            </div>
                                        </div>                                        
										<div class="col-md-6">
                                            <div class="form-group">
											<label for="adminUsername">Username</label>
                                                <input type="text" readonly id="adminUsername" class="form-control" value="'.$username.'" name="adminUsername"  required />
                                            </div>
                                        </div>										
									</div>
									<div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">											
                                            <label for="adminEmail">Email Address</label>    
											<input type="email" class="form-control" value="'.$email.'" name="adminEmail" required />
                                            </div>
                                        </div>
										<div class="col-md-6">
                                            <div class="form-group">
                                            <label for="adminPassword">Password</label>    
											<input type="password" class="form-control" value="'.$password.'" name="adminPassword" required />
                                            </div>
                                        </div>
									</div>
									<div class="row">
									<div class="col-md-6">
                                            <div class="form-group">
											<label for="adminRole">Admin Role</label>
                                                <select class="form-control" name="adminRole">
												<option value="1" '; if($role==1){echo' selected ';} if($isSelfEdit){echo ' disabled ';} echo'title="Cannot add new admin">Normal Admin</option>
												<option value="0" '; if($role==0){echo' selected ';} echo'title="Can add new admin">Master Admin</option>
												</select>
                                            </div>
                                        </div>									
									<div class="col-md-6">
                                            <div class="form-group">
                                            <label for="adminMobile">Phone Number</label>    
											<input type="text" class="form-control" value="'.$mobile.'" name="adminMobile"   />
                                            </div>
                                        </div>
									</div>';
									if($isUpdate){
										echo'<div class="row justify-content-start">
											<div class="col-md-6">
												<div class="form-group">
												<label for="adminEmail">Status</label>    
												<select class="form-control" name="adminStatus">
													<option value="0" '; if($status==0){echo' selected ';} echo'title="Has access">Active</option>
													<option value="1" '; if($status==1){echo' selected ';} if($isSelfEdit){echo ' disabled ';}  echo'title="Does not have access">Inactive</option>
													</select>
												</div>
											</div>										
										</div>';
									}
									echo'<div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="submit" class="form-control btn btn-secondary" name="Update" />
											</div>
                                        </div>
										<div class="col-md-6">
										<div class="form-group">';
										if($role == 1 && $isUpdate){
											echo'<button type="btn" id="deleteAdmin'.$id.'" class="form-control btn btn-danger deleteAdminButton">Delete</button>';
										}
										echo'</div>
										</div>
                                    </div>
                                </form>
                            </div>
                        </div>                    
                </div>
            </div>';
			}
			?>
			<!-- Export Datatable start -->
			<div class="card-box mb-30">
				<div class="pd-20">

				</div>
				<div class="pb-20">


					<table class="table hover multiple-select-row data-table-export nowrap">
						<thead>
							<tr>
								<th>Name</th>
								<th>Username</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Type</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$sql = "SELECT * from admin order by id asc";

							$query = $conn->prepare($sql);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);

							$cnt = 1;
							if ($query->rowCount() > 0) {
								foreach ($results as $row) {
									$role = $row->role == 0 ? "Master Admin":"Normal Admin";
							?>
									<tr>
										<td><?php echo htmlentities($row->name); ?></td>
										<td><?php echo htmlentities($row->userName); ?></td>
										<td><?php echo htmlentities($row->mobile); ?></td>
										<td><?php echo htmlentities($row->email); ?></td>
										<td><?php echo htmlentities($role); ?></td>
										<td><a href="manage-admin.php?adminId=<?php echo htmlentities($row->id); ?>" class="btn btn-primary"><i class="icon-copy fa fa-eye" aria-hidden="true"></i></a></td>
									</tr>
							<?php $cnt = $cnt + 1;
								}
							} ?>

						</tbody>
					</table>

				</div>
			</div>
			<!-- Export Datatable End -->
		</div>
		<script>
			// Get the name input field and username input field
			var nameInput = document.getElementById("adminName");
			var usernameInput = document.getElementById("adminUsername");

			nameInput.addEventListener("input", function() {
				// Get the name entered by the user
				var name = nameInput.value;

				if (name.trim() === "") {
					// If the name is empty, clear the username
					usernameInput.value = "";
				} else {
					// Generate a random number
					var randomNumber = Math.floor(Math.random() * 1000);

					// Concatenate the name and random number to create the username
					var username = name + randomNumber;

					// Update the value of the username input field
					usernameInput.value = username;
				}
			});
		</script>
		<?php
		include("base/footer.php");
		?>