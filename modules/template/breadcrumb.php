<?php
function pageBreadcrumb(string $sectionTitle, string $pageTitle)
{
?>
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-6 align-self-center">
        <h4 class="page-title">
          <?php echo $pageTitle; ?>
        </h4>

        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="javascript:gotoSection()">
                  <?php echo $sectionTitle; ?>
                </a>
              </li>
              <li class="breadcrumb-item">
                <a href="javascript:viewRouting()">
                  <?php echo $pageTitle; ?>
                </a>
              </li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="col-6 align-self-center">
        <div class="d-flex no-block justify-content-end align-items-center">
          <button onclick="viewRouting()" type="button" class="btn btn-rounded btn-primary">
            <i class="fas fa-redo"></i> Segarkan Halaman
          </button>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>
