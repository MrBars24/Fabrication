<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="pt-2">
            <?php if(isset($_SESSION['user']) and $_SESSION['dashboard'] == 'hire'){ ?>
            <a class="waves-effect waves-dark" href="<?= base_url('hire'); ?>" aria-expanded="false">
                <span class="hide-menu">Dashboard</span><i></i>
            </a>
            <?php }elseif(isset($_SESSION['user']) and $_SESSION['dashboard'] == 'work'){ ?>
            <a class="waves-effect waves-dark" href="<?= base_url('work'); ?>" aria-expanded="false">
                <span class="hide-menu">Dashboard</span>
            </a>
            <!-- <ul>
                <li><a href="<?= base_url('work'); ?>">Work</a></li>
                <li><a href="<?= base_url('hire'); ?>">Hire</a></li>
            </ul> -->
            <?php } ?>
        </li>

        <li class="pt-1">
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
        <li class="pt-2">
            <a href="<?= base_url('jobs/create'); ?>">Post Job</a>
            <!-- <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Manage</span><i class="mdi mdi-chevron-down"></i></a>
            <ul>
                <li><a href="<?= base_url('jobs/create'); ?>">Post a Job</a></li>
                <li><a href="<?= base_url('jobs/posted'); ?>">My Posted Job</a></li>
                <li><a href="<?= base_url('members'); ?>">Browse Experts</a></li>
            </ul> -->
        </li>
        <li class="pt-2">
            <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url('/watch-list') ?>" aria-expanded="false">
                <span class="hide-menu">Watchlist</span>
            </a>
        </li>
    </ul>
</nav>
