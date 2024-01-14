<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Events<?= $this->endSection() ?>

<?= $this->section('content') ?>

<a class="button is-link is-light" href="<?= site_url("/events") ?>">&laquo; back </a>

<h1 class="title"><?= esc($event->title) ?></h1>

<div class="content" style="margin-top: 20px">
    <table>
        <tr>
            <th class="has-text-weight-bold">Description</th>
            <td><?= $event->description ?></td>
        </tr>
        <tr>
            <th class="has-text-weight-bold">Day of Week</th>
            <td><?= $event->day_of_week ?></td>
        </tr>
        <tr>
            <th class="has-text-weight-bold">Event Duration</th>
            <td><?= date('H:i', strtotime($event->start_time)) ?> to <?= date('H:i', strtotime($event->end_time)) ?></td>
        </tr>
        <tr>
            <th class="has-text-weight-bold">Location</th>
            <td><?= $event->location ?></td>
        </tr>
        <tr>
            <th class="has-text-weight-bold">Organizer</th>
            <td><?= $event->organizer ?></td>
        </tr>
        <tr>
            <th class="has-text-weight-bold">Contact Number</th>
            <td><?= $event->contact_number ?></td>
        </tr>
        <tr>
            <th class="has-text-weight-bold">Email</th>
            <td><?= $event->email ?></td>
        </tr>
        <tr>
        <th class="has-text-weight-bold">Tags</th>
            <td>
            <?php if ($event->tags !== null): ?>
            <?php $tags = explode(',', $event->tags); ?>
            <?php foreach ($tags as $tag): ?>
                <span class="tag is-primary is-light is-medium is-rounded"><?= $tag ?></span>            
            <?php endforeach; ?>
            <?php else: ?>
                N.A.
            <?php endif; ?>
            </td>
        </tr>
        <?php if (current_user()->is_admin == 1): ?>
            <tr>
                <th class="has-text-weight-bold">Created at</th>
                <td><?= $event->created_at ?></td>
            </tr>
        <?php endif; ?>
        <?php if (current_user()->is_admin == 1): ?>
            <tr>
                <th class="has-text-weight-bold">Updated at</th>
                <td><?= $event->updated_at ?></td>
            </tr>
        <?php endif; ?>
    </table>
</div>
<?php if ($event->approval == 1 ): ?>
<a class="button is-warning " href="<?= site_url('/events/rating/' . $event->id) ?>">Rating <span class="star">&#9733;</span></a>
<?php endif; ?>

<style>
    .button{
        margin: 5px;
    }
    .tag {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        margin-right: 5px;
    }
</style>
<br>
<?php if ($event->user_id == current_user()->id || current_user()->is_admin == 1): ?>
    <a class="button is-link is-light" href="<?= site_url('/events/edit/' . $event->id) ?>">Edit</a>
<?php endif; ?>

<?php if ($event->user_id == current_user()->id || current_user()->is_admin == 1): ?>
    <a class="button is-danger is-light" href="<?= site_url('/events/delete/' . $event->id) ?>">Delete</a>
<?php endif; ?>

<?php if (current_user()->is_admin == 1 && $event->approval == 1 ): ?>
    <a class="button is-danger" href="<?php echo site_url('events/unapproveEvent/'.$event->id); ?>">Unapprove</a>
<?php endif; ?>
<br>
<?php if ($event->approval == 1 ): ?>
<a class="button is-big is-link is-rounded" href="/volunteers/showVolunteerForm/<?php echo $event->id; ?>">Volunteer for this event</a>

<a class="button is-big is-primary is-rounded" href="/joinevent/showJoinEventForm/<?php echo $event->id; ?>">Join this event</a>
<?php endif; ?>

<?= $this->endSection() ?>
