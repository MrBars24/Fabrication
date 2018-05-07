<div class="row page-titles">
    <div class="col-md-5 align-self-center">

    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/jobs/<?= $job->id ?>">Job</a></li>
            <li class="breadcrumb-item active">Job Discussion</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header p-2">
            <h1>Discussion Board</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <?php $id = $this->uri->segment(3); ?>
                        <div class="col-12">
                            <h3 class="text-center"><?= $job->title ?></h3>
                            <hr>
                            <div class="profiletimeline pagination-job-discussion-container" data-id="<?= $id?>"></div>
                            <div class="pagination pagination-job-discussion-bars col-12 justify-content-center mb-4"></div>
                        </div>
                        <div class="col-12">
                        <?= form_open("jobs/job-discussion/submit/$id", array('id'=>'form-send-discussion', 'class'=>'')); ?>
                            <p class="mb-0">Does this project need clarification? Ask your question here.</p>
                            <textarea required class="form-control w-100 mt-2" rows="7" name="message" placeholder="Message here...."></textarea>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary float-right">Submit Discussion</button>
                                <a href="/jobs/<?= $id ?>" class="btn btn-success float-right mr-2">Back to Job</a>
                            </div>
                        <?= form_close(); ?>
                        </div>

                    </div>
                </div>

                <div class="col-sm-4">

                </div>

            </div>
        </div>
    </div>
</div>
