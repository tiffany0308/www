<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Signup<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Signup</h1>

<?= form_open("/signup/create") ?>
<style>
    .form-fields {
        margin-bottom: 20px;
    }

    .form-actions {
        margin-top: 20px;
    }

    .field {
        width: 600px;
    }
</style>

<div class="form-fields">

    <div class="field">
        <label class="label" for="first_name">First Name</label>
        <div class="control">
            <input class="input <?= session('errors.first_name') ? 'is-danger' : '' ?>" type="text" name="first_name" id="first_name" value="<?= old('first_name') ?>">
        </div>
        <?php if (session('errors.first_name')): ?>
            <p class="help is-danger"><?= session('errors.first_name') ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="last_name">Last Name</label>
        <div class="control">
            <input class="input <?= session('errors.last_name') ? 'is-danger' : '' ?>" type="text" name="last_name" id="last_name" value="<?= old('last_name') ?>">
        </div>
        <?php if (session('errors.last_name')): ?>
            <p class="help is-danger"><?= session('errors.last_name') ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="email">Email</label>
        <div class="control">
            <input class="input <?= session('errors.email') ? 'is-danger' : '' ?>" type="text" name="email" id="email" value="<?= old('email') ?>">
        </div>
        <?php if (session('errors.email')): ?>
            <p class="help is-danger"><?= session('errors.email') ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="phone_number">Phone Number</label>
        <div class="control">
            <input class="input <?= session('errors.phone_number') ? 'is-danger' : '' ?>" type="tel" name="phone_number" id="phone_number" value="<?= old('phone_number') ?>">
        </div>
        <?php if (session('errors.phone_number')): ?>
            <p class="help is-danger"><?= session('errors.phone_number') ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="password">Password</label>
        <div class="control">
            <input class="input <?= session('errors.password') ? 'is-danger' : '' ?>" type="password" name="password">
        </div>
        <?php if (session('errors.password')): ?>
            <p class="help is-danger"><?= session('errors.password') ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="password_confirmation">Repeat password</label>
        <div class="control">
            <input class="input <?= session('errors.password_confirmation') ? 'is-danger' : '' ?>" type="password" name="password_confirmation">
        <?php if (session('errors.password_confirmation')): ?>
            <p class="help is-danger"><?= session('errors.password_confirmation') ?></p>
        <?php endif; ?>
        </div>
    </div>

</div>

    <div class="form-actions">
        <div class="field is-grouped">
            <div class="control"> 
                <button class="button is-primary">Sign up</button>
            </div>

            <div class="control">
                <a class="button" href="<?= site_url("/") ?>">Cancel</a>
            </div>
        </div>
    </div>

</form>

<?= $this->endSection() ?>