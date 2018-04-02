<li class="nav-item dropdown show" id="dropdown-notification">
    <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-bell"></i>
        <?php if (newNotificationCount() > 0): ?>
            <div class="notify">
                <span class="heartbit"></span>
                <span class="point"></span>
            </div>
        <?php endif; ?>
    </a>
    <div class="dropdown-menu dropdown-menu-right mailbox animated slideInDown">
        <ul>
            <li>
                <div class="drop-title">
                <span class="float-left">
                    Notifications
                </span>
                <div class="float-right">
                    <a href="<?php echo base_url('settings/notification') ?>"><i class="fa fa-cog"></i></div></a>
                <div class="clearfix"></div>
                </div>
            </li>
            <li>
                <ul class="list-group list-group-flush notification-list">
                </ul>
            </li>
            <li>
                <a class="nav-link text-center" href="#"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
            </li>
        </ul>
    </div>
</li>
