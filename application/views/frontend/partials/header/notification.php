<li class="nav-item dropdown show" id="dropdown-notification">
    <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-bell"></i>
        <div class="notify <?php echo ( !newNotificationCount() > 0) ? 'd-none' : '' ?>">
            <span class="heartbit"></span>
            <span class="point"></span>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-right mailbox animated slideInDown">
        <ul>
            <li>
                <div class="drop-title">
                <span class="float-left">
                    Notifications
                </span>
                <div class="float-right">
                    <a href="" class="font-weight-normal mr-2 btn-read-all-notifications">Read All</a>
                    <a href="<?php echo base_url('settings/notification') ?>"><i class="fa fa-cog"></i></div></a>
                <div class="clearfix"></div>
                </div>
            </li>
            <li>
                <ul class="list-group list-group-flush notification-list">
                    <div class="scrollable-wrapper">
                    </div>
                </ul>
            </li>
            <li>
                <a class="nav-link text-center" href="#"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
            </li>
        </ul>
    </div>
</li>
