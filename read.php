<?php
/**
 * Read/Display Students Page
 */

include 'top.php';
?>
<div class="container">
    <h2 class="text-center">Tampil Data</h2><hr><br>

    <!-- search form -->
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Pencarian..." id="keyword">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" id="btn-search">SEARCH</button>
                    <a href="index.php?page=tampil" class="btn btn-warning">RESET</a>
                </span>
            </div>
        </div>
    </div>
    <br>
    <!-- end search form -->

    <div id="view"><?php include 'view.php'; ?></div>

</div>

<?php include 'bottom.php'; ?>
