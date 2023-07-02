<?php
include "base/header.php";
include 'admin/base/db.php';
include('getHeroBanner.php');
$breadCrumbName = "Family Rituals";
?>
<?php
$pageId = 3;
$child = ' <div class="overlay"></div>
<div class="container-fluid">
  <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
    <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: \'70%\' }">
      <p class="breadcrumbs" data-scrollax="properties: { translateY: \'30%\', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span>'.$breadCrumbName.'</span></p>
      <h1 class="mb-3 bread" data-scrollax="properties: { translateY: \'30%\', opacity: 1.6 }">'.$breadCrumbName.'</h1>
    </div>
  </div>
</div>';
getBannerByPageId($conn, $pageId, $child);
?>

<section class="exclusive_item_part blog_item_section">
  <div class="container">
    <div class="row">
      <div class="col-xl-5">
        <div class="section_tittle">
          <p></p>
          <h2><?php echo $breadCrumbName; ?></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      include 'single-feature-card.php';
      getServiceById($conn, 2);
      ?>
    </div>
  </div>
</section>

<?php
include('base/footer.php');
?>