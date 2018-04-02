<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['notifications'] = array(
    'bid_accepted' => array(
        'template' => 'Your bid on the job ::job_link:: was accepted.',
        'class' => 'BidAcceptedNotification'
    ),
    'bid_denied' => array(
        'template' => 'Your bid on the job ::job_link:: was denied.',
        'class' => 'BidDeniedNotification'
    ),
    'contract_ended' => array(
        'template' => 'Your contract ::contract_link:: for the job ::job_link:: was ended.',
        'class' => 'ContractEndedNotification'
    ),
    'new_bid' => array(
        'template' => 'A new bid was submitted for the job you posted ::job_link::.',
        'class' => 'NewBidNotification'
    )
);
