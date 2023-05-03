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
	<div class="card">
		<div class="card-header" id="addPageButton">

			<button class="btn btn-large btn-primary collapsed" type="button" data-toggle="collapse" data-target="#addPage" aria-expanded="false" aria-controls="addPage">Add new page</button>

		</div>
		<div id="addPage" class="collapse" aria-labelledby="addPageButton" data-parent="#addPageButton">
			<div class="card-body">
				<div class="row ml-2">
					<form id="addNewPageForm" class="tab-wizard wizard-circle wizard">
						<div class="form-group">
							<label>Page Name</label>
							<input type="text" class="form-control" name="pageName" placeholder="" required>
							<input type="submit" class="fomr-control btn btn-secondary mt-2" name="submit">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="accordion" id="accordionExample">
		<?php
		$sql = "SELECT id, name from pages";
		$query = $conn->query($sql);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		if ($query->rowCount() > 0) {
			foreach ($result as $row) {
				echo '<div class="card">
				<div class="card-header" id="page' . $row->id . '">
					<h2 class="mb-0">
						<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#pageCollapsible' . $row->id . '" aria-expanded="true" aria-controls="#pageCollapsible' . $row->id . '">
							' . $row->name . '
						</button>
					</h2>
				</div>
				<div id="pageCollapsible' . $row->id . '" class="collapse" aria-labelledby="' . $row->id . '" data-parent="#accordionExample">
					<div class="card-body">
						<div class="row">
							<div class="col-md-8">
								<form>
									<div class="form-group row">
										<label class="col-lg-2 col-form-label" for="val-image">Hero Image<span class="text-danger"></span>
										</label>
										<input type="file" required id="image-input' . $row->id . '" name="fileToUpload" accept="image/*" onchange="previewHeroImage(this,' . $row->id . ')">
										</div>									
										<input id="heroImageFor' . $row->id . '" class="btn btn-large btn-secondary" type="submit" name="submit">
								</form>
							</div>
							<div class="col-md-4">
							<img class="imageHolderForHero rounded" id="image-preview' . $row->id . '" src="" alt="Image Preview">
							</div>							
						</div>
					</div>
				</div>
			</div>';
			}
		}
		?>
	</div>
</div>
<script type="text/javascript">
	function previewHeroImage(input, idNum) {
		var preview = document.getElementById("image-preview" + idNum);
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				preview.src = e.target.result;
			}
			reader.readAsDataURL(input.files[0]);
			$("#image-preview" + idNum).css("display", "block");
		}
		else{
			$("#image-preview" + idNum).css("display", "none");
		}
	}
</script>
<script type="text/javascript" src="src/scripts/pages.js"></script>
<?php
include("base/footer.php");
?>