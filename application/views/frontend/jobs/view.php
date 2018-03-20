
<div class="container job-view">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mt-2 mb-0"><strong><?= $jobdata->title ?></strong></h1>
            <small class="text-muted">Posted <?=date_new_format($jobdata->created_at)?></small>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div>
                                <span class="">New York, US</span>
                            </div>
                            <span class="badge badge-secondary"><?=$jobdata->project_category?></span>
                        </div>
                        <div>
                            <?php if($jobdata->fabricator_id != auth()->id): ?>
                                <button class="btn default btn-circle <?=($jobdata->is_watchlist==1)? "btn-unbook bg-danger text-white" : "btn-bookmark"?>"><i class="text-white fa fa-bookmark"></i></button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between mt-4">

                        <div>
                            <small class="text-muted">Bids</small>
                            <span class="d-block icon-2x bid-count"><?= count($bids) ?></span>
                        </div>

                        <div>
                            <small class="text-muted">Budget</small>
                            <span class="d-block icon-2x">$<?= $jobdata->budget_min ?> - <?= $jobdata->budget_max ?></span>
                        </div>

                        <div>
                            <small class="text-muted">Status</small>
                            <span class="d-block icon-2x text-primary">
                                <?= $jobdata->status ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <ul class="p-0 list-style-type-none">
                                <li class="">Bidding Start: <span class="font-weight-bold"><?= date_new_format($jobdata->bidding_start_at) ?></span></li>
                                <li class="">Expire: <span class="font-weight-bold"><?= date_new_format($jobdata->bidding_expire_at) ?></span></li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="p-0 list-style-type-none">
                                <li class="">Discipline: <span class="font-weight-bold">Structural</span></li>
                                <li class="">Materials: <span class="font-weight-bold">Steel, Wood, Concrete</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <ul class="p-0 list-style-type-none">
                                <li class="col-12">Attachments:<br>
                                <?php if($getAttachment): ?>
                                    <?php foreach($getAttachment as $attachment): ?>
                                        <a class="btn btn-primary btn-xs mt-1" href="<?= base_url(); ?><?= $attachment->path; ?>" download>download</a><span class="font-weight-bold ml-1"><?= $attachment->filename; ?></span><br>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h4 class="card-title">Job Description</h4>

                    <div class="description mt-4">
                        <?= $jobdata->description ?>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <small><a href="#" class="text-danger">Report this Job</a></small>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="float-left">
                            <h4 class="card-title">Experts Bidding <span class="bid-count"><?= count($bids) ?></span></h4>
                        </div>
                        <div class="float-right">
                            <select name="" class="form-control bidding-filter">
                                <option value="">Recent</option>
                                <option value="">Lowest First</option>
                                <option value="">Highest First</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="list-unstyled" id="bid-container">
                       <nav aria-label="Page navigation example" class="m-t-40">
                         <ul class="pagination pagination-bars d-flex justify-content-center">
                         </ul>
                      </nav>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
<!--            data-toggle="modal" data-target=".modal-bid-now"-->
            <!-- <a class="btn btn-success btn-lg btn-block" href="<?= base_url('jobs/proposal/'); ?><?= $fabricatordata->id ?>" target="_blank">Bid Now</a> -->
            <?php if($jobdata->fabricator_id == auth()->id): ?>
                <a href="/jobs/posted/manage/<?=$jobdata->id?>" class="text-white btn btn-success btn-lg btn-block">Manage Job</a>
                <?php if($jobdata->status == "close"): ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="card-title mb-0">AWARDED TO:</h4>
                    </div>
                     <hr class="m-0">
                    <div class="comment-widgets mb-0 mt-3">
                        <div class="comment-text w-100 py-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="font-weight-bold mb-0"><a href="#"><?= $awardedUser->fullname ?></a></h4>
                            </div>
                            <!-- <h6>Date Hired:  ?></h6> -->
                            <div class="comment-footer">
                                <span class="label label-info">Autocad 2010</span>
                                <span class="label label-info">Autocad 2015</span>
                            </div>
                            <br>
                            <h6>Rate: $ 33.5 /hr</h6>
                            <h6>Work Hour: 140 hrs</h6>

                        </div>
                        <hr>
                    </div>
                </div>
                <?php endif; ?>
            <?php else: ?>
                <?php if($jobdata->status == "open"):
                        $token = FALSE;
                    ?>

                    <?php foreach($bids as $bid): ?>
                        <?php $token = FALSE; ?>
                        <?php if($bid->expert_id == auth()->id): ?>
                            <?php
                                $token = TRUE;
                                break;
                             ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if($token == FALSE): ?>
                        <div class="card" id="card-bid-status">
                            <a class="text-white btn btn-success btn-lg btn-block" data-toggle="modal" data-target=".modal-bid-now">Bid Now</a>
                        </div>
                    <?php else: ?>
                        <div class="card" id="card-bid-status">
                            <div class="d-flex justify-content-center align-items-center card-body flex-column">
                                <h5 class="text-dark font-weight-bold">You already submitted a proposal </h5>
                                <?php if($bid->expert_id == auth()->id): ?>
                                    <div classs="d-flex">
                                        <button type="button" class="btn btn-success btn-sm" data-target=".modal-view-bid" data-toggle="modal">Edit Proposal</button>
                                        <button type="submit" class="btn btn-danger btn-sm cancel-bid" data-target-id="<?= $bid->id ?>">Cancel bid</button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">AWARDED TO:</h4>
                        </div>
                         <hr class="m-0">
                        <div class="comment-widgets mb-0 mt-3">
                            <div class="comment-text w-100 py-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="font-weight-bold mb-0"><a href="#"><?= $awardedUser->fullname ?></a></h4>

                                    <span>
                                        <a href="#" class="text-info mdi mdi-email"></a>
                                    </span>
                                </div>
                                <!-- <h6>Date Hired:  ?></h6> -->
                                <div class="comment-footer">
                                    <span class="label label-info">Autocad 2010</span>
                                    <span class="label label-info">Autocad 2015</span>
                                </div>
                                <br>
                                <h6>Rate: $ 33.5 /hr</h6>
                                <h6>Work Hour: 140 hrs</h6>

                            </div>
                            <hr>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <!-- Fabricator Snapshot -->
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title">About the Fabricator</h4>

                    <div class="row">
                        <div class="col-4">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAArlBMVEX///83YXmzUlqwSFEoWHKuu8MUT2y1Vl3asrW2UVg6aH+IZXSktL4wXnetPEfbtrgjVnCisbvL1Nrc4uZIbYNphZbm6u22wsphf5KruMGCmKbf5eiuQUvz9ffJ0tiOoq/UpKfmzM5Wd4u/ytH37u+Jnqvt8PJxi5zDe4BYeYx7k6IASWesN0KZqrVmg5XT29/x4uOZkZ26ZWzOlpvq09THhYrhwcO4X2by5eaUgY1NSwfmAAAH4ElEQVR4nO2d/2OaOBTAodJ0daZNFcVvaE+nnm7qbrvb7v7/f+xQZwskj0R8QHDv86OlNp/mkbyEJDgOQRAEQRAEQRAEQRDEhYQvXX+37VVdjOK49zzOuSc2N+q494V7grPNqOrS4LNcCe6+wcXq1hxf4n6nelx1qi4UIpOm50pw0b0Vx94uXYFv9XgbjlOm9js59vdVl+9aAq4I0ESs7mrt2JmJTL9TPa5r6xhugBtQqsd+u+qy5qJl5neqx1n9HNu+PkAT9biul+NypW5BuQAbHi5mk6qLbc4WCFCx3gcuWLf1cZy76oryvODw4wD48dHRr4HjaK2uQC6m50vus+rRn1dZegMWwA3I+vFRYRSrUENruWMAtCReMx19mY5NWx33QA/BxYvi6sw2xw9KL72e5QYK0E2o/o3Ah5MC4VrnKA1yz0WdZaSdc9gxilWrHCdQD8E1xcx0tKceoUFurIeAmcyyHO+LL70BU8CP7czmDdtreJRsgyM0yJV7CJg9kCYcv4cPCiy9HmiQy5mqh4Bpz+B69HiroNLrCcEeYrXU/Orzh9QH+35GPYqK8tWBB/QQvm6w9/wwbvz8O/VhOyNWWRVpDjTI1fYQzofHxl3E+M9PqR/sd2CsCl1QoJOcp48FqFgAKcyZ15NfxOP4e/qHHeBrXW9blAkAMMjlop/9ROLTa+Psd6Dx+CN9RaerrEc+K8xFBTjI1YwKPn0fx/2OofotfTtGjqp/Hy/MRmYEtHqcaSLpx1Pa7+j4T/p2jGJVrke/KB2JEBrkCm0P8UElGIXq+FW6tJe+H/miEBsFUAojfP3UNWAYOT5It6MzSva1rKSnOOAg1zNJrUDDw+34Vbq8F5s0F0N8GQVwCgMNcpNkGEY9h3w7OsshO0WMWKHLqGgB3bGYGUZQluHhdkwnchHLrcsEK2dSo616kuu+TYOakG0YOf78Q/Fby04p6Uyvy9Q3IJsaBegRneEhkfv3cOG89BQNnqc3HOSe0BseErnoP8bKHi6BKYx7WcZvYBiFauPZEeUOekfQIFdcmgwbGUaO39xSDYdQiqZNYSQMDe/umv/JPUdRDKAb0CCFkTA1fGh+/PKKrqIESmE8L9cM2AWGj40HVc+BDPgklxlMg6q4xFA1BYAN2ENoBrkwlxlGPccrpk8auIfIn0FdaHgYcxQWqj1oao/nDNAjFxsWF6pZi9GumBHKYVhMqIZ+1mI0r2meiKbIY1hIqM6yFzPln/XKZ4gfqnPdaiaRt63Ja3j3+PSKabjRrUfju7INkUNVE6SHW7F8Q9RQ1RuyKgwRW9WFpYZ4odpRz1dYYIgWqhtdY1qdIVaoDjNSmooNo1C9wwjVzsZlaWwxLC5X5dYYYicAZzSG+9ZAopWa6cAyLGhYpTFsMU+CpabMrjNsJPhymjsu0XCgGI+kZ3OuMnzCFiJDMiRDMiRDMiRDMiRDMiRDMiRDMiTDSmYxKjfcD+4lBqlVmfU2NIEMybBgyNAAMiTDgiFDA8iQDAuGDA0gQzIsGDI0gAzJsGDI0AAyJMMjo+l0ulgMh8PNZrXq7vrr2ayJc06vLYYTdjidn8cROKe72mLYllcwI52xZIvh/rc0xDlEymJD77YMOwpDnGMzLDbMvdXMTsORwjD3jkgrDXufC2porDF0JqlznLwNjqA9ho4zTCqi6DlWGTqrWGGQUjbHLsNh3BDttB6bDKdxQ7RjzqwyjN2IHtpRdTYZxqPUvfggIAibDLuJ/ZEC6TBlmwxTG0CRDqi1yLCX3qksUKYxEAy/jnEMX6RVggLjTXUIhs7zU8OEx+bHsfThl/evaUrblFHO4MUwdH48G8H/kj97P1RxoBghXnZ6eIGGhmSeSNdTbKa/KcOeq9hKf0uGc+Up6TdhGC4jAuCEw5sw7DPGBHDMPbqhN2ghEaiHPirDLiBXiKErL1rPC+tOFNNI3qKdYhKuSjVERP2yOS7S+LOsb7HZEAcyJMPfxLBqiUxQDPWHnFUIiuE2+93F1YJiGPJiKlGRBnCXKz4r3NDprRUb8K5FMNWzP08+k13xUA3dMPorgbwD70rUiakiL1WNe/ENS0NhOPp8CFUoVm/BMJwH9y/TrlCfb3wLhmcma1W43pKh47QV7eptGTqhL8+X3pahE8p1WP2bLi9D9wYPaU0NzoOLEtG+oyR9Tq4opViIaA3DVCWW91I2JPTvmUkeyV3eS9mw0BsmH7AhLd0rEb3hfcIQ5fFhqegN5wnDMt/+iIOBYbyp4f0yCoWK0L6zK2FY+ltYr0e/fiRpWLuGxtGviA3i96G45OVvdSFxaFPtMhoT4mv3ONYSWquIP2uryW04V5wz9eu0KdW4oRkP0vLfB5mHpSeA+cam4uowtu6Lr0svbD56wJw6VzWs8c6iPqPfvfLNIeo3HccXmDKc3RZlECgUge0wdW1Jt9JEIbDEOYhdiLfOuww2qXsRSql9/SW2sksO3VXNqJOsQla3OajEVCiUb8b/Cd1yy3c98alQBmx+TeyYqV/SPXprUAUwjx1vj2o4Mnzfqw1tSXuJpzO1m0U8cuoWocIP4z0Kq1+MHjmEIVcma44zi/cn0I1qP0MPSNaSK0JYbRJSmb5y/cKB2HR++pTiegE3kedtaxxr9691/KpE4ddumtuY9WE9EddOqNaYqeCbbX2GhHmobRdBEARBEARBEARBEAXyPwFOzXJ8sdKJAAAAAElFTkSuQmCC" alt="" class="img-fluid">
                        </div>
                        <div class="col-8 pl-0">
                            <h3 class="text-truncate font-weight-bold mb-0"><?= @$fabricatordata->fullname ?></h3>
                            <small class="text-muted">Client Verified</small>

                            <!-- <div class="d-flex flex-column align-items-start mb-3">
                                <span class="badge badge-warning px-3">4.5</span>
                                <ul class="d-flex flex-row list-style-type-none mb-0">
                                    <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                </ul>
                                <small class="text-muted d-block">(17 reviews)</small>
                            </div> -->
                        </div>
                    </div>

                    <div class="mt-2">
                        <small class="text-muted">Overview</small>
                        <h4>Lorem ipsum dolor sit amet.</h4>

                        <small class="text-muted">Industry</small>
                        <div>
                            <span class="badge badge-secondary py-2 px-3">Mining</span>
                            <span class="badge badge-secondary py-2 px-4">Commercial</span>
                        </div>

                        <div class="d-flex flex-row justify-content-between mt-3">
                            <div>
                                <small class="text-muted">Jobs Posted</small>
                                <h4>17</h4>
                            </div>
                            <div>
                                <small class="text-muted">Hire Rate</small>
                                <h4>100%</h4>
                            </div>
                            <div>
                                <small class="text-muted">Member Since</small>
                                <h4><?= date_new_format($jobdata->created_at); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Fabricator Snapshot -->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-bid-now" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?= form_open('jobs/submit/proposal', array('id'=>'form-proposal-submit')) ?>
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Proposal</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $jobdata->id ?>" >
                <h5 class="font-weight-bold">Bid</h5>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" name="budget" class="form-control form-control-lg" placeholder="Amount">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted">Client's Budget</small>
                        <h4 class="font-weight-bold text-success m-0">$<?= $jobdata->budget_min ?> - $<?= $jobdata->budget_max ?></h4>
                    </div>
                </div>
                <div class="form-group">
                    <h5 class="font-weight-bold">Additional Information</h5>
                    <textarea class="form-control" rows="5" name="cover_letter"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success waves-effect text-left">Submit Bid</button>
            </div>
            <?= form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade modal-view-bid" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <?php foreach($bids as $bid): ?>
            <?php if($bid->expert_id == auth()->id): ?>
                <?= form_open("jobs/edit/proposal/$bid->id", array('id' => 'form-edit-proposal')); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myLargeModalLabel">Proposal</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $jobdata->id ?>" >
                        <h5 class="font-weight-bold">Bid</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="number" name="budget" class="form-control form-control-lg" placeholder="Amount" value="<?= $bid->amount ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <small class="text-muted">Client's Budget</small>
                                <h4 class="font-weight-bold text-success m-0">$<?= $jobdata->budget_min ?> - $<?= $jobdata->budget_max ?></h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="font-weight-bold">Additional Information</h5>
                            <textarea class="form-control" rows="5" name="cover_letter"><?= $bid->cover_letter ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success waves-effect text-left">Save Changes</button>
                    </div>
                </div>
                <?= form_close(); ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div id="modal-job-error" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none; padding-right: 19px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Package Upgrade</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h4>You need to upgrade you membership to bid in job!</h4>
            </div>
            <div class="modal-footer">
                <a href="/settings/subscription" class="btn btn-success waves-effect">Upgrade Now</a>
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
