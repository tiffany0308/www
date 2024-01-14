<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Password reset<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Password reset</h1>

<?= form_open("/password/processreset/$token") ?>

    <div class="field">
        <label class="label" for="password">Password</label>
        <input class="input <?= session('errors.password') ? 'is-danger' : '' ?>" type="password" name="password">
        <?php if (session('errors.password')): ?>
            <p class="help is-danger"><?= session('errors.password') ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="password_confirmation">Repeat password</label>
        <input class="input <?= session('errors.password_confirmation') ? 'is-danger' : '' ?>" type="password" name="password_confirmation">
        <?php if (session('errors.password_confirmation')): ?>
            <p class="help is-danger"><?= session('errors.password_confirmation') ?></p>
        <?php endif; ?>
    </div>

    <button>Reset password</button>

</form>

<?= $this->endSection() ?>
