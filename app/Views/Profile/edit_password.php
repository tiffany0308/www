<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit password<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Edit password</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
        <?php endforeach; ?>
    </ul>
<?php endif ?>
<style>
    .field {
        width: 300px;
    }
</style>
<div class="form-fields">

    <?= form_open("/profile/updatepassword")?>

        <div class="field">
            <label class="label" for="current_password">Current password</label>
            <input class="input" type="password" name="current_password">
        </div>

        <div class="field">
            <label class="label" for="password">New password</label>
                <input class="input <?= session('errors.password') ? 'is-danger' : '' ?>" type="password" name="password">
        <?php if (session('errors.password')): ?>
		    <p class="help is-danger"><?= session('errors.password') ?></p>
	    <?php endif; ?>
        </div>

        <div class="field">
            <label class="label" for="password_confirmation">Repeate new password</label>
                <input class="input <?= session('errors.password_confirmation') ? 'is-danger' : '' ?>" type="password" name="password_confirmation">
        <?php if (session('errors.password_confirmation')): ?>
		    <p class="help is-danger"><?= session('errors.password_confirmation') ?></p>
	    <?php endif; ?>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-primary">Save</button>
            </div>
            <div class="control">
                <a class="button" href="<?= site_url("/profile/show") ?>">Cancel</a>
            </div>
        </div>
    </form>

</div>
<?= $this->endSection() ?>