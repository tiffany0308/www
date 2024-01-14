<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Users<?= $this->endSection() ?>

<?= $this->section("content") ?>

    <h1 class="title">Users</h1>
<style>
    .button {
        margin-bottom: 10px;
    }
</style>

    <a class="button is-link is-light" href="<?= site_url("/admin/users/new") ?>">
    <span class="icon is-small">
        <i class="fas fa-plus"></i>
    </span>
    <span>New user</span></a>
    
    <?php if ($users): ?>
    <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thread>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Active</th>
                    <th>Administrator</th>
                    <th>Created at</th>
                </tr>
            </thread>
            <tbody>
                <?php foreach($users as $user): ?>

                <tr>
                    <td>
                        <a href="<?= site_url("/admin/users/show/" . $user->id) ?>">
                            <?= esc($user->first_name) ?> <?= esc($user->last_name) ?>
                        </a>
                    </td>
                    <td><?= esc($user->email) ?></td>
                    <td><?= $user->is_active ? 'yes' : 'no' ?></td>
                    <td><?= $user->is_admin ? 'yes' : 'no' ?></td>
                    <td><?= $user->created_at ?></td>
                </tr>
            
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $pager->simpleLinks() ?>

    <?php else: ?>

        <p>No users found.</p>

    <?php endif; ?>

<?= $this->endSection() ?>