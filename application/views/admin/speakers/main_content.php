<?php
/** @var $speakers */
?>


<!-- Main content -->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">

                        <h3 class="card-title">List of speakers</h3>

                        <!-- /.card-header -->

                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Image</th>
                                    <th>Actions</th>

                                </tr>
                                </thead>


                                <?php foreach ($speakers as $speaker): ?>

                                    <tr>
                                        <td> <?php echo $speaker['s_id']; ?></td>
                                        <td> <?php echo $speaker['s_name']; ?></td>
                                        <td> <?php echo $speaker['s_company']; ?></td>
                                        <td><img style="width: 50px; height: 50px;"
                                                 src="<?php echo base_url() . $speaker['s_image']; ?>"
                                                 alt="company image" class="speaker-img"></td>

                                        <td>
                                            <?= form_open(base_url('admin/delete_speaker'), ['method' => 'post', 'display' => 'inline-block', 'width' => '44px;',"onsubmit" => "return(update());"]) ?>
                                            <input type="hidden" name="speakerId"
                                                   value="<?= set_value('speakerId', $speaker['s_id']); ?>">


                                            <a href="<?php echo base_url('admin/edit_speaker/');
                                            echo '' . $speaker['s_id']; ?>">
                                                <button type="button" class="btn btn-warning mr-1"><i
                                                            class="fas fa-edit"></i></button>
                                            </a>

                                            <button type="submit" class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>



                                            <?= form_close() ?>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>
                            </table>
                        </div>


                    </div>
                </div>
                <a style="float:right" href="<?= base_url('admin/add_speaker') ?>" type="button"
                   class="btn btn-primary">Add a speaker</a>


            </div>
        </div>
    </div>
</section>



