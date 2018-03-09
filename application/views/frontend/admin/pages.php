<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Pages</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Content Menu</a></li>
            <li class="breadcrumb-item active">Pages Content</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 page-container">
            <?=$this->session->flashdata("page_msg")?>
            <div class="card">
                <div class="card-body">
                    <a href="/admin/pages/create" class="btn btn-info m-b-1"><i class="fa fa-plus"></i> New Pages</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pages Name</th>
                                    <th>Pages URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pages as $p): ?>
                                <tr>
                                    <td><?=$p->id?></td>
                                    <td><?=$p->name?></td>
                                    <td><?=$p->page_url?></td>
                                    <td>
                                        <a href="/admin/pages/update/<?=$p->id?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="#" data-id="<?=$p->id?>" class="btn btn-danger btn-delete"><i class="fa fa-close"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>