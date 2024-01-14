<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Home<?= $this->endSection() ?>

<?= $this->section("content") ?>

    <h1 class="title">Welcome</h1>

    <?php if (current_user()): ?>
        <p class="text">Hello <?= esc(current_user())->first_name ?> <?= esc(current_user())->last_name ?></p>
    <?php endif; ?>

<?= $this->endSection() ?>