<?php
include __DIR__ . "/../layouts/header.php";
?>
<main>
    <div class="container-fluid p-0">
        <!-- Hero banner -->
        <div class="bg-primary text-white text-center py-5">
            <div class="container">
                <h1 class="display-4 fw-bold mb-3">Liên hệ với chúng tôi</h1>
                <p class="lead mb-0">Chúng tôi luôn sẵn sàng hỗ trợ và lắng nghe ý kiến của bạn</p>
            </div>
        </div>

        <div class="container py-5">
            <div class="row g-0 align-items-start shadow rounded-4 overflow-hidden">
                <!-- Cột trái: Thông tin liên hệ + ảnh -->
                <div class="col-lg-5 bg-light">
                    <div class="p-4 p-md-5 h-100">
                        <h3 class="mb-4">🎯 Kết nối với chúng tôi</h3>
                        <p class="text-muted mb-4">Bạn có câu hỏi, góp ý hoặc cần hỗ trợ? Hãy để lại thông tin, đội ngũ
                            của chúng tôi sẽ liên hệ lại trong thời gian sớm nhất.</p>

                        <!-- Ảnh minh họa -->
                        <div class="mb-4">
                            <img src="https://images.unsplash.com/photo-1423666639041-f56000c27a7a?w=600&h=400&fit=crop"
                                alt="Liên hệ" class="img-fluid rounded-3 shadow-sm w-100"
                                onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22600%22 height=%22400%22%3E%3Crect fill=%22%23e9ecef%22 width=%22600%22 height=%22400%22/%3E%3Ctext fill=%22%236c757d%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22%3ELiên hệ%3C/text%3E%3C/svg%3E'">
                        </div>

                        <div class="mt-4">
                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 48px; height: 48px;">
                                    <i class="bi bi-geo-alt" style="font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Địa chỉ</h6>
                                    <p class="text-muted mb-0 small">123 Đường ABC, Quận XYZ, TP.HCM</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 48px; height: 48px;">
                                    <i class="bi bi-telephone" style="font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Điện thoại</h6>
                                    <p class="text-muted mb-0 small">(84) 123 456 789</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start mb-3">
                                <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 48px; height: 48px;">
                                    <i class="bi bi-envelope" style="font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Email</h6>
                                    <p class="text-muted mb-0 small">contact@example.com</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 48px; height: 48px;">
                                    <i class="bi bi-clock" style="font-size: 1.2rem;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Giờ làm việc</h6>
                                    <p class="text-muted mb-0 small">Thứ 2 - Thứ 6: 8:00 - 17:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cột phải: Form liên hệ -->
                <div class="col-lg-7 bg-white p-4 p-md-5">
                    <h3 class="mb-4">📝 Gửi tin nhắn</h3>

                    <?php
                    $messageSent = false;
                    $error = '';
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
                        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
                        $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
                        $message = isset($_POST['message']) ? trim($_POST['message']) : '';

                        if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
                            $messageSent = true;
                        } else {
                            $error = "Vui lòng điền đầy đủ các trường bắt buộc và email hợp lệ.";
                        }
                    }
                    ?>

                    <?php if ($messageSent): ?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
                            <div>
                                <strong>Thành công!</strong><br>Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi trong vòng 24
                                giờ.
                            </div>
                        </div>
                    <?php else: ?>
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="bi bi-exclamation-triangle-fill fs-4 me-3 text-danger"></i>
                                <div><?= htmlspecialchars($error) ?></div>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold">Họ và tên <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-bold">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label fw-bold">Tiêu đề</label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                        value="<?= isset($subject) ? htmlspecialchars($subject) : '' ?>">
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label fw-bold">Nội dung tin nhắn <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="5"
                                        required><?= isset($message) ? htmlspecialchars($message) : '' ?></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="reset" class="btn btn-outline-secondary px-4">Làm mới</button>
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-send me-2"></i>Gửi tin nhắn
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . "/../layouts/footer.php"; ?>