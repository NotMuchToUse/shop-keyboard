<?php include_once "./data/faqData.php" ?>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Các câu hỏi thường gặp (FAQ)</h2>

        <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden" id="faqAccordion">

            <?php foreach ($faqs as $faq) : ?>
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#<?= $faq['id'] ?>">
                        <?= $faq['question'] ?>
                    </button>
                </h3>
                <div id="<?= $faq['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-muted">
                        <?= $faq['answer'] ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>