<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Be a volunteer<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title is-2">Be a volunteer</h1>

<h2 class="title is-5">Volunteer Registration</h2>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
        <?php endforeach; ?>
    </ul>
<?php endif ?>

<?= form_open("/volunteers/saveVolunteerForm/$eventId") ?>
<div class="form-fields">
    <div class="field" style="width: 400px">
        <label class="label" for="name">Name:</label>
        <input class="input <?= session('errors.name') ? 'is-danger' : '' ?>" type="text" name="name" id="name" placeholder="name" value="<?= old('name', esc($volunteer->name)) ?>">
        <?php if (session('errors.name')): ?>
            <p class="help is-danger"><?= session('errors.name') ?></p>
        <?php endif; ?>
    </div>

    <div class="field" style="width: 400px">
        <label class="label" for="phone">Phone:</label>
        <input class="input <?= session('errors.phone') ? 'is-danger' : '' ?>" type="text" name="phone" id="phone" placeholder="contact number" value="<?= old('phone', esc($volunteer->phone)) ?>">
        <?php if (session('errors.phone')): ?>
            <p class="help is-danger"><?= session('errors.phone') ?></p>
        <?php endif; ?>
    </div>
    
    <div class="field" style="width: 400px">
        <label class="label" for="email">Email:</label>
        <input class="input <?= session('errors.email') ? 'is-danger' : '' ?>" type="email" name="email" id="email" placeholder="email address" value="<?= old('email', esc($volunteer->email)) ?>">
        <?php if (session('errors.email')): ?>
            <p class="help is-danger"><?= session('errors.email') ?></p>
        <?php endif; ?>
    </div>
    
    <div class="field" style="width: 400px">
        <label class="label" for="occupation">Occupation:</label>
        <input class="input <?= session('errors.occupation') ? 'is-danger' : '' ?>" type="text" name="occupation" placeholder="occupation" id="occupation" value="<?= old('occupation', esc($volunteer->occupation)) ?>">
        <?php if (session('errors.occupation')): ?>
            <p class="help is-danger"><?= session('errors.occupation') ?></p>
        <?php endif; ?>
    </div>
    
    <div class="field" style="width: 800px">
        <label class="label" for="reason">Reason for joining:</label>
        <textarea class="textarea <?= session('errors.reason') ? 'is-danger' : '' ?>" name="reason" id="reason" placeholder="reason for being a volunteer" value="<?= old('reason', esc($volunteer->reason)) ?>"></textarea>
        <?php if (session('errors.reason')): ?>
            <p class="help is-danger"><?= session('errors.reason') ?></p>
        <?php endif; ?>
    </div>

        <button class="button is-primary" style="margin:10px" type="submit">Submit</button>
        <a class="button" style="margin:10px" href="<?= site_url("/events/show/$eventId") ?>">Cancel</a>
    </form>
</div>
<?= $this->endSection() ?>  