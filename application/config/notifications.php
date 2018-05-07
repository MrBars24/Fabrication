<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Map of templates for notifications
$config['notifications'] = array(
    'bid_accepted' => array(
        'template' => 'Your bid on the ::job_link:: was accepted.',
        'class' => 'BidAcceptedNotification'
    ),
    'bid_denied' => array(
        'template' => 'Your bid on the ::job_link:: was denied.',
        'class' => 'BidDeniedNotification'
    ),
    'contract_ended' => array(
        'template' => 'Your contract ::contract_link:: for the ::job_link:: was ended.',
        'class' => 'ContractEndedNotification'
    ),
    'new_bid' => array(
        'template' => 'A new bid was submitted for posted ::job_link::.',
        'class' => 'NewBidNotification'
    ),
    'new_job_invite' => array(
        'template' => 'You were invited to the ::job_link::.',
        'class' => 'NewJobInviteNotification'
    ),
);
