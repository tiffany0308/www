<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit profile<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Edit profile</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

<style>
    .form_fields .field:not(:last-child) {
        margin-bottom: 20px;
    }
    .field {
        width: 600px;
    }
</style>

<div class="form-fields">
    <?= form_open("/profile/update")?>

        <div class="field">
            <label class="label" for="first_name">First Name*</label>
            <div class="control">
                <input class="input <?= session('errors.first_name') ? 'is-danger' : '' ?>" type="text" name="first_name" id="first_name" value="<?= old('first_name', esc($user->first_name)) ?>">
            </div>
        <?php if (session('errors.first_name')): ?>
		    <p class="help is-danger"><?= session('errors.first_name') ?></p>
	    <?php endif; ?>
        </div>

        <div class="field">
            <label class="label" for="last_name">Last Name*</label>
            <div class="control">
                <input class="input <?= session('errors.last_name') ? 'is-danger' : '' ?>" type="text" name="last_name" id="last_name" value="<?= old('last_name', esc($user->last_name)) ?>">
            </div>
        <?php if (session('errors.last_name')): ?>
		    <p class="help is-danger"><?= session('errors.last_name') ?></p>
	    <?php endif; ?>
        </div>

        <div class="field">
            <label class="label" for="email">Email*</label>
            <div class="control">
                <input class="input <?= session('errors.email') ? 'is-danger' : '' ?>" type="text" name="email" id="email" value="<?= old('email', esc($user->email)) ?>">
            </div>
        <?php if (session('errors.email')): ?>
		    <p class="help is-danger"><?= session('errors.email') ?></p>
	    <?php endif; ?>
        </div>

        <div class="field">
            <label class="label" for="phone_number">Phone Number</label>
            <div class="control">
                <input class="input <?= session('errors.phone_number') ? 'is-danger' : '' ?>" type="tel" name="phone_number" id="phone_number" value="<?= old('phone_number', esc($user->phone_number)) ?>">
            </div>
        <?php if (session('errors.phone_number')): ?>
		    <p class="help is-danger"><?= session('errors.phone_number') ?></p>
	    <?php endif; ?>
        </div>

        <div class="form_actions">
            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-primary">Save</button>
                </div>
                <div class="control">
                    <a class="button" href="<?= site_url("/profile/show") ?>">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>