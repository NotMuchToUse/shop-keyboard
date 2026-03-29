<?php include_once "./data/footerData.php" ?>

<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="mb-3">
                    <h4 class="d-flex align-items-center gap-2" href="index?page=home">
                        <img src="../asset/logo-main.jpg" alt="logo" width="40px">
                        <span class="logo">Juko</span>
                    </h4>
                </div>
                <p class="text-white-50 small">Tất cả đều có ở đây</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                </div>
            </div>
            <?php foreach ($footers as $footer) : ?>
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-uppercase fw-bold mb-3"><?= $footer['title'] ?></h6>
                    <ul class="list-unstyled text-white-50">
                        <?php foreach ($footer["links"] as $link) : ?>
                            <li class="mb-2">
                                <a href="<?= $link['url'] ?>"
                                    class="text-decoration-none text-white-50"><?= $link['name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

        </div>

        <hr class="my-4 border-secondary">


        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 text-white-50">&copy; 2026, Bản quyền thuộc về <span class="logo">Junko</span>.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <img src="https://images.dmca.com/Badges/dmca-badge-w100-5x1-11.png" alt="DMCA" style="height: 30px;">
            </div>
        </div>
    </div>
</footer>
<script src="../js/main.js"></script>
</body>

</html>