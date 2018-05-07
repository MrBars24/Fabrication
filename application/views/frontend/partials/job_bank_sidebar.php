<div class="card">
  <div class="card-body inbox-panel p-0">
    <ul class="list-group list-group-flush">
      <?php if(isset($_SESSION['user']) && $_SESSION['dashboard'] == 'hire'): ?>
        <li class="list-group-item p-0 <?php echo (get_current_endpoint() == 'jobs/posted') ? 'active' : '' ?>"> <a href="<?php echo base_url('/jobs/posted') ?>" class="d-block p-3"><i class="mdi mdi-account"></i> My Posted Jobs</a></li>
		<li class="list-group-item p-0 <?php echo (get_current_endpoint() == 'jobs/posted/active') ? 'active' : '' ?>"> <a href="<?php echo base_url('/jobs/posted/active') ?>" class="d-block p-3"><i class="mdi mdi-account"></i> My Active Posted Jobs</a></li>
      <?php else:?>
        <li class="list-group-item p-0 <?php echo (get_current_endpoint() == 'jobs/bid-history') ? 'active' : '' ?>"><a href="<?php echo base_url('/jobs/bid-history') ?>" class="d-block p-3"><i class="fa fa-gears"></i> Bidding History</a></li>
        <li class="list-group-item p-0 <?php echo (get_current_endpoint() == 'jobs/invitations') ? 'active' : '' ?>"><a href="<?php echo base_url('/jobs/invitations') ?>" class="d-block p-3"><i class="mdi mdi-account-settings-variant"></i> Job Invitations</a></li>
        <li class="list-group-item p-0 <?php echo (get_current_endpoint() == 'jobs/my-jobs') ? 'active' : '' ?>"><a href="<?php echo base_url('/jobs/my-jobs') ?>" class="d-block p-3"><i class="mdi mdi-message-alert"></i> Jobs Won Active</a></li>
        <li class="list-group-item p-0 <?php echo (get_current_endpoint() == 'jobs/previous-project') ? 'active' : '' ?>"><a href="<?php echo base_url('/jobs/previous-project') ?>" class="d-block p-3"><i class="mdi mdi-message-alert"></i> Previous Projects</a></li>
      <?php endif; ?>
    </ul>
  </div>
</div>
