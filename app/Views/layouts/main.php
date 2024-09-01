<?= $this->include('partials/header') ?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
    
    <!-- Menu -->
    <?= $this->include('partials/menu') ?>
    <!-- / Menu -->

    <!-- Layout container -->
    <div class="layout-page">

        <?= $this->include('partials/navbar') ?>

        <!-- Content wrapper -->
        <div class="content-wrapper">
        
            <!-- Content -->
                <?= $this->renderSection('content') ?>
            <!-- / Content -->
        
            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<?= $this->include('partials/footer') ?>