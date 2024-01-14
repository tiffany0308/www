<style>
    .field {
        width: 600px;
    }
</style>
<div class="form-fields">
    <div class="field">
        <label class="label" for="first_name">First Name</label>
        <input class="input <?= isset($errors['first_name']) ? 'is-danger' : '' ?>" type="text" name="first_name" id="first_name" value="<?= old('first_name', esc($user->first_name)) ?>">
        <?php if (isset($errors['first_name'])): ?>
            <p class="help is-danger"><?= $errors['first_name'] ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="last_name">Last Name</label>
        <input class="input <?= session('errors.last_name') ? 'is-danger' : '' ?>" type="text" name="last_name" id="last_name" value="<?= old('last_name', esc($user->last_name)) ?>">
        <?php if (isset($errors['last_name'])): ?>
            <p class="help is-danger"><?= $errors['last_name'] ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="email">Email</label>
        <input class="input <?= session('errors.email') ? 'is-danger' : '' ?>" type="text" name="email" id="email" value="<?= old('email', esc($user->email)) ?>">
        <?php if (isset($errors['email'])): ?>
            <p class="help is-danger"><?= $errors['email'] ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="phone_number">Phone Number</label>
        <input class="input <?= session('errors.phone_number') ? 'is-danger' : '' ?>" type="tel" name="phone_number" id="phone_number" value="<?= old('phone_number', esc($user->phone_number)) ?>">
        <?php if (isset($errors['phone_number'])): ?>
            <p class="help is-danger"><?= $errors['phone_number'] ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="password">Password</label>
        <input class="input <?= session('errors.password') ? 'is-danger' : '' ?>" type="password" name="password">
        <?php if ($user->id): ?>
            <p class="help">Leave blank to keep existing password</p>
        <?php endif; ?>
        <?php if (isset($errors['password'])): ?>
            <p class="help is-danger"><?= $errors['password'] ?></p>
        <?php endif; ?>
    </div>

    <div class="field">
        <label class="label" for="password_confirmation">Repeat password</label>
        <input class="input <?= session('errors.password_confirmation') ? 'is-danger' : '' ?>" type="password" name="password_confirmation">
        <?php if (isset($errors['password_confirmation'])): ?>
            <p class="help is-danger"><?= $errors['password_confirmation'] ?></p>
        <?php endif; ?>
    </div>

    <div class="field"> 
        <label class="label" for="is_active">
            <?php if ($user->id == current_user()->id): ?>
                <input type="checkbox" checked disabled> active

            <?php else: ?>

                <input type="hidden" name="is_active" value="0">
            
                <input type="checkbox" id="is_active" name="is_active" value="1"
                        <?php if (old('is_active', $user->is_active)): ?>checked<?php endif; ?>> active
            <?php endif; ?>
        </label>
    </div>

    <div class="field"> 
        <label class="label" for="is_admin">
            <?php if ($user->id == current_user()->id): ?>
                <input type="checkbox" checked disabled> administrator

            <?php else: ?>

                <input type="hidden" name="is_admin" value="0">
            
                <input type="checkbox" id="is_admin" name="is_admin" value="1"
                        <?php if (old('is_admin', $user->is_admin)): ?>checked<?php endif; ?>> administrator
            <?php endif; ?>
        </label>
    </div>
</div>