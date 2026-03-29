<?php include_once "./data/featureSectionData.php" ?>

<section class="py-5" style="background: linear-gradient(110deg, #ABF5F1 0%, rgba(255, 255, 255, 0.00) 99%);">
    <div class="container-xl">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="https://mechanicalkeyboards.com/cdn/shop/files/Keycaps_BannerB_19073280-6c9e-465c-9a0b-e709e35acb54.png?v=1754149856&width=1920"
                    alt="Bộ sưu tập bàn phím cơ và Keycap custom cao cấp" class="img-fluid rounded-4">
            </div>

            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Tùy biến bàn phím cơ mang đậm phong cách riêng</h2>

                <div class="mb-4">
                    <?php foreach ($features as $feature): ?>
                    <p class="mb-3">
                        <strong class="text-dark"><?php echo $feature['title']; ?></strong>
                        <?php echo $feature['description']; ?>
                    </p>
                    <?php endforeach; ?>
                </div>

                <a href="index.php?page=product" class="btn btn-primary btn-lg px-4">
                    Khám phá ngay <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>

        </div>
    </div>
</section>