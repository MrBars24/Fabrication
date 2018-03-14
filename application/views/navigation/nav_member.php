<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="pt-1">
            <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url('/dashboard') ?>" aria-expanded="false">
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>

        <li>
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <span class="hide-menu">Job Bank</span><i class="mdi mdi-chevron-down"></i>
            </a>
            <ul>
                <!-- <li><a href="<?= base_url('jobs'); ?>">Browse Jobs </a></li> -->
                <li><a href="<?= base_url('jobs/posted'); ?>">My Posted Job</a></li>
                <li><a href="<?= base_url('jobs/invitations'); ?>">Job Invitations</a></li>
                <li><a href="<?= base_url('jobs/bid-history') ?>">My Bids</a></li>
                <li><a href="<?= base_url('jobs/previous-project') ?>"> Previous Project </a></li>
            </ul>
        </li>
        <li class="pt-1">
            <a href="<?= base_url('jobs/create'); ?>">Post Job</a>
            <!-- <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Manage</span><i class="mdi mdi-chevron-down"></i></a>
            <ul>
                <li><a href="<?= base_url('jobs/create'); ?>">Post a Job</a></li>
                <li><a href="<?= base_url('jobs/posted'); ?>">My Posted Job</a></li>
                <li><a href="<?= base_url('members'); ?>">Browse Experts</a></li>
            </ul> -->
        </li>
        <li class="pt-1">
            <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url('/watch-list') ?>" aria-expanded="false">
                <span class="hide-menu">Watchlist</span>
            </a>
        </li>
    </ul>
</nav>
