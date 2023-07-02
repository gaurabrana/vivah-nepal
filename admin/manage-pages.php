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
		$sql = "SELECT id, name, hero_image from pages";
		$query = $conn->query($sql);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		if ($query->rowCount() > 0) {
			foreach ($result as $row) {
				if (strlen($row->hero_image) > 0) {
					$buttonName = "Update";
				} else {
					$buttonName = "Add";
				}
				$pageId = $row->id;
				$isHomepage = ($pageId == 1 && $row->name == "Homepage");
				$firstCol = !$isHomepage ? "col-md-8" : "col-md-12";
				$secondCol = !$isHomepage ? "col-md-4" : "col-md-12";
				$showName = $isHomepage ? "Video" : "Image";
				echo '<div class="card">
				<div class="card-header" id="page' . $pageId . '">
					<h2 class="mb-0">
						<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#pageCollapsible' . $pageId . '" aria-expanded="true" aria-controls="#pageCollapsible' . $pageId . '">
							' . $row->name . '
						</button>
					</h2>
				</div>
				<div id="pageCollapsible' . $pageId . '" class="collapse" aria-labelledby="' . $pageId . '" data-parent="#accordionExample">
					<div class="card-body">
						<div class="row">
							<div class="'.$firstCol.'">
								<form class="pageForms" id="formFor' . $pageId . '" enctype="multipart/form-data">
									<div class="form-group row">
										<label class="col-lg-2 col-form-label" for="val-image">Hero '.$showName.'<span class="text-danger"></span>
										</label>
										<input type="text" readonly hidden required value="' . $row->name . '"" id="pageNameFor' . $pageId . '">';
				$acceptType = $isHomepage ? "video/*" :  "image/*";
				echo '<input type="file" required id="image-input' . $pageId . '" name="fileToUpload" accept="' . $acceptType . '" onchange="previewHeroImage(this,' . $pageId . ')">';
				echo '</div>									
										<input id="heroImageFor' . $pageId . '" class="btn btn-large btn-secondary" type="submit" name="' . $buttonName . '">
								</form>
							</div>
							<div class="'.$secondCol.'">';
				if ($isHomepage) {
					echo '<video playsinline controls class="videoHolderForHero rounded" id="video-preview' . $pageId . '" src="../images/hero-image/' . $row->hero_image . '" alt="Video Preview"></video>';
				} else {
					echo '<img class="imageHolderForHero rounded" id="image-preview' . $pageId . '" src="../images/hero-image/' . $row->hero_image . '" alt="Image Preview">';
				}
				echo '</div>							
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
		var id  = idNum == 1 ? "video-preview" : "image-preview";
		var preview = document.getElementById(id +  idNum);
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				preview.src = e.target.result;
			}
			reader.readAsDataURL(input.files[0]);
			$("#" + id + idNum).css("display", "block");
		} else {
			$("#" + id + idNum).css("display", "none");
		}
	}
</script>
<?php
include("base/footer.php");
?>