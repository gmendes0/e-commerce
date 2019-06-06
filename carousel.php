<div id="carousel-index" class="carousel slide mb-5" data-ride="carousel">
    <div class="carousel-inner">
        <?php for($i = 0; $i < 1; $i++){ ?>
        <div class="carousel-item <?php echo ($i == 0) ? 'active' : ''; ?>">
            <img class="d-block w-100" src="assets/imgs/carousel/<?= $i; ?>.jpg" alt="First slide"/>
        </div>
        <?php } ?>
    </div>
</div>