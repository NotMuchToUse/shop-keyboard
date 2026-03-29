<?php
include __DIR__ . "/../layouts/header.php";
include __DIR__ . "/../data/productData.php";

// Biến nhận giá trị từ query params
$keyword = $_GET['keyword'] ?? '';
$sort = $_GET['sort'] ?? '';
$p = (int)($_GET['p'] ?? 1);
$filterStr = $_GET['filter'] ?? '';
$filters = $filterStr ? explode(',', $filterStr) : [];

// Search sản phẩm (cái này cũng dễ nhưng không nghĩ ra được cách làm này)
if (!empty($keyword)) {
    $products = array_filter($products, function ($item) use ($keyword) {
        return stripos($item['name'], $keyword) !== false || stripos($item['desc'], $keyword) !== false;
    });
}

// Lọc sản phẩm (cái này khó vl)
if (!empty($filters)) {
    $products = array_filter($products, function ($item) use ($filters) {
        $match = false;
        foreach ($filters as $f) {
            if (stripos($item['name'], $f) !== false || stripos($item['desc'], $f) !== false) {
                $match = true;
                break;
            }
        }
        return $match;
    });
}

// Sắp xếp sản phẩm (cái này cũng khó vl :)))
if ($sort == 'price_asc') {
    usort($products, fn($a, $b) => (int)str_replace(['.', 'đ'], '', $a['price']) <=> (int)str_replace(['.', 'đ'], '', $b['price']));
} elseif ($sort == 'price_desc') {
    usort($products, fn($a, $b) => (int)str_replace(['.', 'đ'], '', $b['price']) <=> (int)str_replace(['.', 'đ'], '', $a['price']));
}

// Phân trang (cái này tưởng khó ai ngờ cũng dễ :)))
$perPage = 8;
$totalProducts = count($products);
$totalPages = ceil($totalProducts / $perPage);

if ($p > $totalPages && $totalPages > 0) $p = $totalPages;
$currentProducts = array_slice($products, ($p - 1) * $perPage, $perPage);
$filterParam = !empty($filterStr) ? '&filter=' . urlencode($filterStr) : '';
?>

<main class="py-4">
    <section class="container">

        <!-- Thanh search -->
        <div class="d-flex justify-content-between align-self-center flex-wrap gap-3">
            <div class="d-flex flex-column">
                <label for="searchInput" class="fw-bold mb-1">Tìm sản phẩm:</label>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary" type="button" onclick="applyFilters()">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <input type="text" id="searchInput" class="form-control" placeholder="Nhập tên phím..."
                        value="<?php echo htmlspecialchars($keyword); ?>" onkeypress="handleEnter(event)">
                </div>
            </div>

            <!-- Thanh sort với filter -->
            <div class="d-flex justify-content-between align-self-center gap-3">
                <div class="d-flex flex-column">
                    <label for="sortSelect" class="fw-bold mb-1">Sắp xếp:</label>
                    <select id="sortSelect" class="form-select w-auto" onchange="applyFilters()">
                        <option value="">Mặc định</option>
                        <option value="price_asc" <?php echo ($sort == 'price_asc' ? 'selected' : ''); ?>>Giá: Thấp đến
                            cao</option>
                        <option value="price_desc" <?php echo ($sort == 'price_desc' ? 'selected' : ''); ?>>Giá: Cao đến
                            thấp</option>
                    </select>
                </div>
                <div class="d-flex flex-column mb-3">
                    <span class="fw-bold mb-1">Bộ lọc: </span>
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">
                        <i class="fa-solid fa-filter"></i> Lọc
                    </button>
                </div>
            </div>
        </div>

        <hr class="border border-secondary border-3 opacity-25">

        <!-- Thông tin số lượng sản phẩm -->
        <div class="mb-4">
            <span class="fw-bold">Hiển thị <?php echo count($currentProducts); ?> / <?php echo $totalProducts; ?> sản
                phẩm</span>
            <?php if (!empty($keyword) || !empty($filters)): ?>
                (Đang áp dụng bộ lọc)
            <?php endif; ?>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="row g-4">
            <?php if (count($currentProducts) > 0): ?>
                <?php foreach ($currentProducts as $item): ?>
                    <div class="col-md-3">
                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <img src="<?php echo $item['image']; ?>" class="card-img-top" alt="<?php echo $item['name']; ?>"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-truncate" title="<?php echo $item['name']; ?>">
                                    <?php echo $item['name']; ?></h5>
                                <p class="card-text text-muted small flex-grow-1"><?php echo $item['desc']; ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-primary fw-bold fs-5"><?php echo $item['price']; ?></span>
                                    <button class="btn btn-outline-primary rounded-pill px-3">Mua</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted">Không tìm thấy sản phẩm nào phù hợp!</h3>
                </div>
            <?php endif; ?>
        </div>

        <!-- Phân trang -->
        <?php if ($totalPages > 1): ?>
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo ($p <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link"
                            href="?page=product&sort=<?php echo urlencode($sort); ?>&keyword=<?php echo urlencode($keyword); ?><?php echo $filterParam; ?>&p=<?php echo $p - 1; ?>">Trước</a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo ($i == $p ? 'active' : ''); ?>">
                            <a class="page-link"
                                href="?page=product&sort=<?php echo urlencode($sort); ?>&keyword=<?php echo urlencode($keyword); ?><?php echo $filterParam; ?>&p=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?php echo ($p >= $totalPages) ? 'disabled' : ''; ?>">
                        <a class="page-link"
                            href="?page=product&sort=<?php echo urlencode($sort); ?>&keyword=<?php echo urlencode($keyword); ?><?php echo $filterParam; ?>&p=<?php echo $p + 1; ?>">Sau</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>

    </section>
</main>

<!-- Sheet filter -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="filterOffcanvasLabel">Lọc Sản Phẩm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <!-- Nhu cầu -->
        <h6 class="fw-bold mb-3">Nhu cầu</h6>
        <div class="form-check mb-2">
            <input class="form-check-input filter-checkbox" type="checkbox" value="Gaming" id="filterGaming"
                <?php echo in_array('Gaming', $filters) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="filterGaming">Phím Gaming</label>
        </div>
        <div class="form-check mb-2">
            <input class="form-check-input filter-checkbox" type="checkbox" value="Văn phòng" id="filterOffice"
                <?php echo in_array('Văn phòng', $filters) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="filterOffice">Phím Văn phòng</label>
        </div>

        <!-- Loại Switch -->
        <h6 class="fw-bold mb-3 mt-4">Loại Switch</h6>
        <div class="form-check mb-2">
            <input class="form-check-input filter-checkbox" type="checkbox" value="Linear" id="filterLinear"
                <?php echo in_array('Linear', $filters) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="filterLinear">Switch Linear (Êm ái)</label>
        </div>
        <div class="form-check mb-2">
            <input class="form-check-input filter-checkbox" type="checkbox" value="Tactile" id="filterTactile"
                <?php echo in_array('Tactile', $filters) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="filterTactile">Switch Tactile (Có khấc)</label>
        </div>

        <!-- Màu sắc -->
        <h6 class="fw-bold mb-3 mt-4">Màu sắc phím</h6>
        <div class="form-check mb-2">
            <input class="form-check-input filter-checkbox" type="checkbox" value="Pink" id="filterPink"
                <?php echo in_array('Pink', $filters) ? 'checked' : ''; ?>>
            <label class="form-check-label text-danger" for="filterPink">Hồng (Pink)</label>
        </div>
        <div class="form-check mb-2">
            <input class="form-check-input filter-checkbox" type="checkbox" value="Blue" id="filterBlue"
                <?php echo in_array('Blue', $filters) ? 'checked' : ''; ?>>
            <label class="form-check-label text-primary" for="filterBlue">Xanh dương (Blue)</label>
        </div>
        <div class="form-check mb-2">
            <input class="form-check-input filter-checkbox" type="checkbox" value="Black" id="filterBlack"
                <?php echo in_array('Black', $filters) ? 'checked' : ''; ?>>
            <label class="form-check-label" for="filterBlack">Đen (Black)</label>
        </div>

    </div>

    <!-- Nút Áp dụng gắn ở đáy Sheet -->
    <div class="offcanvas-footer p-3 border-top">
        <button class="btn btn-primary w-100 fw-bold py-2" type="button" onclick="applyFilters()">
            Áp dụng bộ lọc
        </button>
    </div>
</div>

<?php include __DIR__ . "/../layouts/footer.php"; ?>