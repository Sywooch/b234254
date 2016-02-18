<div class="task-body">
    <div class="col-full">
        <div class="block desc" style="border: none;">
            <div class="content" style="
    border-width: 1px;
    border-color: #d7d7d7;
    border-style: solid;padding:0 15px;height:auto;overflow: auto;">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade" id="videos">
                    <? foreach($task_videos as $task_video) : ?>
                        <div class="col-sm-3">
                            <a href="https://www.youtube.com/watch?v=<?= $task_video ?>" class="item" target="_blank">
                                <img height="200" class="img-responsive" data-toggle="modal" href="#modal-<?= $task_video ?>" src="http://img.youtube.com/vi/<?= $task_video ?>/1.jpg" tabindex="2"/>
                            </a>
                        </div>
                    <? endforeach; ?>
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="audios">
                    <? foreach($files['audio'] as $file) : ?>
                        <a href="<?= $file['path'] ?>" class="item" target="_blank">
                            <i class="icon-music-tone-alt"></i> <br>
                            <?= $file['name'] ?>
                        </a>
                    <? endforeach; ?>
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="photos">
                    <? foreach($files['photo'] as $file) : ?>
                        <div class="col-sm-3">
                            <a href="<?= $file['path'] ?>" target="_blank">
                                <img src="<?= $file['path'] ?>" class="img-responsive" alt="">
                            </a>
                        </div>
                    <? endforeach; ?>
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="docs">
                    <? foreach($files['document'] as $file) : ?>
                        <a href="<?= $file['path'] ?>" class="item" target="_blank">
                            <i class="ico-history"></i> <br>
                            <?= $file['name'] ?>
                        </a>
                    <? endforeach; ?>
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="archive">
                    <? foreach($files['archive'] as $file) : ?>
                        <a href="<?= $file['path'] ?>" class="item" target="_blank">
                            <i class="fa fa-archive"></i> <br>
                            <?= $file['name'] ?>
                        </a>
                    <? endforeach; ?>
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="links">
                    <? foreach($task_links as $task_link) : ?>
                        <a href="<?= $task_link->name ?>" class="item" target="_blank">
                            <i class="fa fa-link"></i> <br>
                            <?= $task_link->name ?>
                        </a>
                    <? endforeach; ?>
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="notes">
                    <? foreach($task_notes as $task_note) : ?>
                        <div class="collapse-line"><?= $task_note->name ?> </div>
                    <? endforeach; ?>
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade in active" id="desc"><?php echo $task->description?></div>
              </div>
            </div>
            <? if(count($task_videos) > 0 ||
            count($files['audio']) > 0 ||
            count($files['photo']) > 0 ||
            count($files['document']) > 0 ||
            count($files['archive']) > 0 ||
            count($task_links) > 0 ||
            count($task_notes) > 0) : ?>
                <div class="footer">
                    <div>
                        <ul class="btn-group nav nav-tabs" role="tablist">
                            <?php if(count($task_videos) > 0):?>
                                <li><a class="btn" href="#videos" role="tab" data-toggle="tab">
                                    <span class="text">Video</span>
                                    <span class="label"><?php echo count($task_videos)?></span>
                                </a></li>
                            <?php endif; ?>
                            <?php if(count($files['audio']) > 0):?>
                                <li><a class="btn" href="#audios" role="tab" data-toggle="tab">
                                    <span class="text">Sound</span>
                                    <span class="label"><?php echo count($files['audio'])?></span>
                                </a></li>
                            <?php endif;?>
                            <?php if(count($files['photo']) > 0):?>
                                <li><a class="btn" href="#photos" role="tab" data-toggle="tab">
                                    <span class="text">Photo</span>
                                    <span class="label"><?php echo count($files['photo'])?></span>
                                </a></li>
                            <?php endif;?>
                            <?php if(count($files['document']) > 0):?>
                                <li><a class="btn" href="#docs" role="tab" data-toggle="tab">
                                    <span class="text">Doc</span>
                                    <span class="label"><?php echo count($files['document'])?></span>
                                </a></li>
                            <?php endif;?>
                            <?php if(count($files['archive']) > 0):?>
                                <li><a class="btn" href="#archive" role="tab" data-toggle="tab">
                                    <span class="text">Archive</span>
                                    <span class="label"><?php echo count($files['archive'])?></span>
                                </a></li>
                            <?php endif;?>
                            <?php if(count($task_links) > 0):?>
                                <li><a class="btn" href="#links" role="tab" data-toggle="tab">
                                    <span class="text">Link</span>
                                    <span class="label"><?php echo count($task_links)?></span>
                                </a></li>
                            <?php endif;?>
                            <?php if(count($task_notes) > 0):?>
                                <li><a class="btn" href="#notes" role="tab" data-toggle="tab">
                                    <span class="text">Notes</span>
                                    <span class="label"><?php echo count($task_notes)?></span>
                                </a></li>
                            <?php endif;?>
                            <li class="active"><a class="btn" href="#desc" role="tab" data-toggle="tab">
                                <span class="text">Description</span>
                            </a></li>
                        </ul>
                    </div>
                </div>
            <? endif; ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script>
$('.nav-tabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});
</script>
<style>
    .nav-tabs{
        border-bottom:none;
    }
</style>