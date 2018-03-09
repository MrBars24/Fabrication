                <ul id="training-id" class="list-group list-group-flush">
                            <?php foreach($trainings as $training): ?>
                         <li class="list-group-item">

                            <h5 class="font-weight-bold mb-1"><?= $training['training_name']; ?></h5>
                            <h6 class="text-muted"><?= $training['created_at']; ?></h6>
                            <h6><?= $training['description']; ?></h6>
                                        
                            <a href="<?php echo base_url('settings/training/'.$training['id']) ?>" class="btn btn-success"><span class="align-middle">View</span><i class="icon-eye align-middle ml-2"></i></a>

                            <a href="<?php echo base_url('settings/training/update/'.$training['id']) ?>" class="btn btn-warning"><span class="align-middle">Edit</span><i class="icon-pencil align-middle ml-2"></i></a>

                            <!--<button type="submit" class="btn btn-danger"><span class="align-middle">Delete</span></button>-->

                            <a class="btn btn-deleted btn-danger text-white" data-id="<?= $training['id'] ?>"><span class="align-middle">Delete</span><i class="icon-trash align-middle ml-2"></i></a>
            
                        </li>      
                <?php endforeach; ?>
                </ul>