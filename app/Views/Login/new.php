<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Login<?- $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Login</h1>
<style>
    .field {
        width: 600px;
    }
</style>
<div class="form-fields">

    <?= form_open("/login/create") ?>

        <div class="field">
            <label class="label" for="email">Email</label>
            <input class="input" type="text" name="email" id="email" value="<?= old('email') ?>">
        </div>

        <div class="field">
            <label class="label" for="password">Password</label>
            <input class="input" type="password" name="password">
        </div>

        <div class="field">
            <label for="remember_me">
                <input type="checkbox" id="remember_me" name="remember_me"
                <?php if (old('remember_me')): ?>checked<?php endif; ?>> Remember me
            </label>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-primary">Log in</button>
            </div>

        <a href="<?= site_url("/password/forgot") ?>">Forgot password?</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
