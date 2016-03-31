<?php
//use frontend\modules\news\widgets\LastNews;
use modules\tasks\models\DelegateTask;
use yii\helpers\Url;
//use yii\widgets\Pjax;
use modules\departments\models\Department;
use modules\departments\models\Specialization;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use modules\tasks\models\TaskUserLog;
use modules\user\models\Profile;
use modules\tasks\models\UserTool;
/**
* @var modules\core\site\base\View $this
*/
$this->registerCssFile("/plugins/datetimepicker/jquery.datetimepicker.css");
// $this->registerCssFile("/metronic/theme/assets/global/plugins/jquery-ui/jquery-ui.min.css");
// $this->registerJsFile("/plugins/datetimepicker/build/jquery.datetimepicker.full.js");
// $this->registerJsFile("/metronic/theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js");
$this->registerJsFile("/metronic/theme/assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js");
// $this->registerJsFile("/metronic/theme/assets/global/plugins/jquery-ui/jquery-ui.js");
$this->registerJsFile("/js/readmore.min.js");
$this->registerJsFile("/js/global/task.js");
$this->registerCssFile("/fonts/Open Sans/OpenSans-Bold.css");
// $this->registerCssFile("/css/page_test.css");
//$this->registerCssFile("/css/task.css");
$this->title = 'Главная страница';
$specialization = null;
if($task->specialization_id > 0) {
$specialization = Specialization::find()->where(['id' => $task->specialization_id])->one();
}
?>
<?php /*$form = ActiveForm::begin(
[
'id' => 'task-form',
]
) */?>
<link rel="stylesheet" type="text/css" href="/css/task.css">
<div class="well well-sm" style="margin:0px auto;max-width:1024px;">
    <div class="task">
        <div class="hidden-task-id" style="display:none"><?php echo $task->id?></div>
        <div class="row">
            <div class="col-sm-12">
                <div class="task-bg" style="box-shadow: none !important;border: none !important;">
                    <div class="row task-title">
                        <div class="name pull-left"><?= $task->name ?></div>
                        <div id="action_panel" class="pull-right inline">
                            <? require_once __DIR__.'/task/action_panel.php' ?>
                        </div>
                        <div class="clearfix"></div>
                        <div id="datepicker" class="collapse slidePop">
                            <div class="arrow"></div>
                            <table style="width:100%;">
                                <tr>
                                    <td style="vertical-align:top;"><div id="startDate"></div></td>
                                    <td style="vertical-align:top;"><div id="endDate"></div></td>
                                </tr>
                            </table>
                        </div>

                    </div>

                    <div id="delegate" class="collapse slidePop"> <div class="arrow"></div>
                    <!-- Nav tabs -->
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="search-block" style="border: 1px solid #5184f3;border-radius: 10px !important;overflow: hidden;">
                            <table style="width:100%">
                                <tbody class="counter_users">
                                    <? if($is_my) : ?>
                                        <? require_once __DIR__.'/task/counter_offers.php' ?>
                                    <? endif; ?>
                                </tbody>
                            </table>
                            <table id="offers" style="width:100%">
                                <tbody id="cancel_delegate_users">

                                    <?= $html_cancel_delegate_users ?>
                                </tbody>
                            </table>
                            <table style="width:100%;margin-bottom:0;" class="table with-foot table-bordered">
                                <thead>
                                    <tr>
                                        <th width="50"><button style="margin:0;border:none !important;font-size: 24px;line-height: 20px !important;" class="btn btn-primary static circle"><i class="ico-user1"></i></button></th>
                                        <th width="280">Name</th>
                                        <th width="160">Location</th>
                                        <th width="105" class="rate">Rate / h</th>
                                        <th>Level</th>
                                        <th width="130">Offers</th>
                                    </tr>
                                </thead>
                                <tbody id="delegate_users">
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="5" style="border-right:0;">
                                        <div class="pull-left" style="margin-left: 10px;">
                                            <div id="invite-form" class="no-autoclose" style="display:none;">
                                            <legend>Delegate by email</legend>
                                                <div class="form-group">
                                                    <input type="text" id="input-invite-email" class="form-control" placeholder="Email Address">
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="name" id="input-invite-offer" class="form-control" rows="8" cols="40" placeholder="Offer text"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="pull-right">
                                                        <button type="submit" id="invite-form-send" class="btn btn-primary">Send</button>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div id="advanced-search-form" class="no-autoclose" style="display:none;">
                                                <legend>Advanced search</legend>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <label for="">Rate by/H</label> <br>
                                                        <?
                                                        $rate = 0;
                                                        $rate_min = 0;
                                                        $rate_max = 0;
                                                        if($task_user->price > 0 && $task_user->time > 0) {
                                                        $rate = intval($task_user->price / $task_user->time);
                                                        $rate_min = $rate - 15;
                                                        $rate_max = $rate + 15;
                                                        if ($rate_min < 0) {
                                                        $rate_min = 0;
                                                        }
                                                        }
                                                        ?>
                                                        <div class="col-sm-5 pull-left" style="padding:0;"><input type="text" id="input-rate-start" value="<?=$rate_min?>" class="form-control"></div>
                                                        <div class="col-sm-5 pull-right" style="padding:0;"><input type="text" id="input-rate-end" value="<?=$rate_max?>" class="form-control"></div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Level</label> <br>
                                                        <select id="select-level" class="update form-control selectpicker">
                                                            <?php foreach($skill_list as $skill):?>
                                                            <option value="<?php echo $skill->id?>"><?php echo $skill->name?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <label for="">Country</label> <br>
                                                        <select id="select-country" class="form-control selectpicker country">
                                                            <?php foreach($countrylist as $c):?>
                                                            <option <?php echo $c->id == $profile->country_id?'selected':''?> value="<?php echo $c->id?>"><?php echo $c->title_en?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">City</label>
                                                        <input id="input-city"  type="text" value="<?=$profile->city_title ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-12">
                                                        <div class="pull-right">
                                                            <button type="submit" id="advanced-search-send-task" class="btn btn-primary">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary circle invite-by-email" data-toggle="popover">
                                            <i class="ico-mail"></i>
                                            </button>
                                            <!-- Delegate by email -->
                                            <button style="margin-left: 32px;" class="btn btn-primary circle advanced-search-btn" data-toggle="popover" data-not_autoclose="1">
                                            <i class="ico-search"></i>
                                            </button>
                                            <!-- Advanced search -->
                                        </div>
                                        <div class="pull-right">
                                        </div>
                                        <div class="clearfix"></div>
                                    </th>
                                    <th style="border-left:0;">
                                        <button class="btn btn-primary make-offer" style="width:96px;font-size:11px !important;padding: 0px 15px !important;white-space: initial;">Make <br> an offer</button>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div id="status-menu" style="display:none !important;">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#search-block" aria-controls="search-block" role="tab" data-toggle="tab">Search</a></li>
                            <li id="liofer" <?php echo $hide ==1?'class="disabled"':''?> role="presentation"><a id="btn-offered-block" <?php echo $hide ==1?'':'data-toggle="tab"'?> href="#offered-block" aria-controls="offered-block" role="tab" >Offered <!--<span class="label label-danger circle"></span>--></a></li>
                        </ul>
                    </div>
                </div>
            </div>
                    <script>
                        function showLi(id){
                            if(id == 1){
                                $('#liofer').removeClass('disabled');
                                $('#btn-offered-block').attr('data-toggle','tab');
                                $('#btn-offered-block').attr('href','#offered-block');
                                
                            }else{
                                $('#liofer').addClass('disabled');
                                $('#btn-offered-block').removeAttr('data-toggle');
                                $('#btn-offered-block').removeAttr('href');
                                $("a[href='#search-block']").tab('show')
                            }
                        }
                    </script>
            <div class="row task-body">
                <div class="col1">
                    <div class="title">Speciality:  <?php echo $task->spec?></div>
                    <div class="block desc" style="border: none;">
                        <div class="content" style="
                            border-width: 1px;
                            border-color: #d7d7d7;
                            border-style: solid;padding:0 15px;height:auto;overflow: auto;">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="videos">
                                    <? foreach($task_videos as $task_video) : ?>
                                    <a href="https://www.youtube.com/watch?v=<?= $task_video ?>" data-toggle="popover"  data-content="&nbsp;" target='_blank' class="item" target="_blank">
                                        <i class="ico-video"></i> <br>
                                    </a>
                                    <? endforeach; ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="audios">
                                    <? foreach($files['audio'] as $file) : ?>
                                    <a href="<?= $file['path'] ?>" target='_blank' data-toggle="popover"  data-content="&nbsp;" class="item" target="_blank">
                                        <i class="ico-sound"></i> <br>
                                    </a>
                                    <? endforeach; ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="photos">
                                    <? foreach($files['photo'] as $file) : ?>
                                    <a href="<?= $file['path'] ?>" target='_blank' data-toggle="popover"  data-content="&nbsp;" target="_blank">
                                        <i class="ico-photo"></i> <br>
                                    </a>
                                    <? endforeach; ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="docs">
                                    <? foreach($files['document'] as $file) : ?>
                                    <a href="<?= $file['path'] ?>" target='_blank' data-toggle="popover"  data-content="&nbsp;" class="item" target="_blank">
                                        <i class="ico-docs"></i> <br>
                                        <?= $file['name'] ?>
                                    </a>
                                    <? endforeach; ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="archive">
                                    <? foreach($files['archive'] as $file) : ?>
                                    <a href="<?= $file['path'] ?>" target='_blank' data-toggle="popover"  data-content="&nbsp;" class="item" target="_blank">
                                        <i class="ico-archive"></i> <br>
                                        <?= $file['name'] ?>
                                    </a>
                                    <? endforeach; ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="links">
                                    <? foreach($task_links as $task_link) : ?>
                                    <a href="<?= $task_link->name ?>" target='_blank' data-toggle="popover"  data-content="&nbsp;" class="item">
                                        <i class="ico-link"></i> <br>
                                    </a>
                                    <? endforeach; ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="notes">
                                    <? foreach($task_notes as $task_note) : ?>
                                    <a href="<?= $task_link->name ?>" target="_blank" class="item"><?= $task_note->name ?>
                                        <i class="ico-history"></i> <br>
                                        Name
                                    </a>
                                    <? endforeach; ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="desc"><?php echo $task->description?></div>
                            </div>
                        </div>
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
                                    <li class="active"><a class="btn" href="#desc" role="tab" data-toggle="tab">
                                        <span class="text">Description</span>
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="title text-center" style="margin-top: 4px;">Is this task was helpful to you?</div>
                    <div class="step">
                        <div class="question-name">
                            <h4 class="left pull-left">No</h4>
                            <h4 class="right pull-right">Yes</h4>
                            <div class="clearfix"></div>
                        </div>
                        <div id="helpful" class="form-md-radios md-radio-inline b-page-checkbox-wrap <?= !is_null($user_task_helpful->helpful) ? 'disabled off' : '' ?>">
                            <? for($i = 0; $i < 4; $i++) : ?>
                            <div class="md-radio has-test b-page-checkbox">
                                <input type="radio" id="Helpful[<?= $i ?>]" <?= !is_null($user_task_helpful->helpful) ? 'disabled' : '' ?> name="Helpful" class="md-radiobtn" <? if(!is_null($user_task_helpful->helpful) && $user_task_helpful->helpful == $i) echo 'checked' ?> value="<?= $i ?>">
                                <label for="Helpful[<?= $i ?>]">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                </label>
                            </div>
                            <? endfor; ?>
                            <div style="display:inline-block;width:100%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col2">
                    <div id="delegate_active_users" class="milestones-users">
                        <? if($is_my) : ?>
                        <? require_once __DIR__.'/task/delegate_active_users.php' ?>
                        <? else: ?>
                        <img  onError="this.onerror=null;this.src='/images/avatar/nophoto.png';" class="active gant_avatar" src="<?php echo $delegate_user->ava ? $folder_assets = Yii::$app->params['staticDomain'] .'avatars/'.$delegate_user->ava:'/images/avatar/nophoto.png'?>">
                        <? endif; ?>
                    </div>
                    <div class="block chat">
                        <div id="active-user-info" style="display: none;">
                            Иван Ч., USA, Califonia <br>
                            30 Mar - 19 Apr, $60
                        </div>
                        <div class="content">
                            <div class="ajax-content">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="portlet_tab1">
                                        <div class="scroller" style="height: 255px;">
                                            <ol id="taskUserNotes">
                                                <?= $taskUserNotes ?>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="portlet_tab2">
                                        <div class="scroller" style="height: 255px;">
                                            <ul id="taskUserMessages">
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="portlet_tab3">
                                        <div class="scroller" style="height: 255px;">
                                            <ol id="taskUserLogs">
                                                <?= $taskUserLogs ?>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="actions">
                                <ul class="nav nav-tabs pull-right">
                                    <li class="active">
                                        <a href="#portlet_tab1" data-toggle="tab" class="btn btn-primary circle" id="btn-tab-note">
                                            <span class="ico-edit"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#portlet_tab2" data-toggle="tab" class="btn btn-primary circle disabled static" id="btn-tab-message">
                                            <span class="ico-chat"></span>
                                        </a>
                                        <span id="badge-chat" class="badge badge-danger"></span>
                                    </li>
                                    <li>
                                        <a href="#portlet_tab3" data-toggle="tab" class="btn btn-primary circle" id="btn-tab-log">
                                            <span class="ico-history"></span>
                                        </a>
                                        <span id="badge-log" class="badge badge-danger"></span>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="footer">
                            <div id="message-input">
                                <input type="text" id="textarea-task" class="form-control" placeholder="Put your message here...">
                                <button onclick="return false" id="btn-note" type="submit" class="btn btn-primary" data-task_user_id="<?= $task_user->id ?>">Send</button>
                            </div>
                        </div>
                    </div>
                    <div class="title">Feedback</div>
                    <div class="block feedback">
                        <div class="footer">
                            <div>
                                <input type="text" id="feedback-input" class="form-control" placeholder="Put your message here...">
                                <button type="submit" id="btn-feedback" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
</div>
<div id="invite-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<style>
#btn-delegate+.popover{
min-width:250px !important;
width:250px !important;
}
#btn-delegate+.popover > .arrow{
margin-left:0 !important;
}
</style>