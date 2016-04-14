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
<div class="well well-sm" style="margin:30px auto;max-width:1024px;">
	<div class="task">
	    <div class="hidden-task-id" style="display:none"><?php echo $task->id?></div>
	    <div class="row">
	        <div class="col-sm-12">
	            <div class="well well-sm task-bg" style="box-shadow: none !important;border: none !important;">
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
	                    <? if($is_my) : ?>
	                        <div id="counter" class="collapse slidePop"> <div class="arrow"></div>
	                            <? require_once __DIR__.'/task/counter_offers.php' ?>
	                        </div>
	                    <? endif; ?>
	                    <div id="delegate" class="collapse slidePop"> <div class="arrow"></div>
	                        <!-- Nav tabs -->
	                        <ul class="nav nav-tabs" role="tablist">
	                            <li role="presentation" class="active"><a href="#search-block" aria-controls="search-block" role="tab" data-toggle="tab">Search</a></li>
	                            <li role="presentation"><a id="btn-offered-block" href="#offered-block" aria-controls="offered-block" role="tab" data-toggle="tab">Offered <!--<span class="label label-danger circle"></span>--></a></li>
	                        </ul>

	                        <!-- Tab panes -->
	                        <div class="tab-content">
	                            <div role="tabpanel" class="tab-pane active" id="search-block">
	                                <table style="width:100%;">
	                                    <thead>
	                                    <tr>
	                                        <th></th>
	                                        <th>Name</th>
	                                        <th>Level</th>
	                                        <th>Rate by hour</th>
	                                        <th>Location</th>
	                                        <th><button class="btn btn-primary offerall-btn">Offer <br> to all</button></th>
	                                    </tr>
	                                    </thead>
	                                    <tbody id="delegate_users">

	                                    </tbody>
	                                    <tfoot>
	                                    <tr>
	                                        <th colspan="5" style="border-right:0;">
	                                            <div class="pull-left">
	                                                <div id="invite-form" class="no-autoclose" style="display:none;">
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
	                                                                <option class="start" value="0">Select level</option>
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
	                                                                <option class="start" value="0">Select country</option>
	                                                                <?php foreach($countrylist as $c):?>
	                                                                    <option <?php echo $c->id == $profile->country_id?'selected':''?> value="<?php echo $c->id?>"><?php echo $c->title_en?></option>
	                                                                <?php endforeach; ?>
	                                                            </select>
	                                                        </div>
	                                                        <div class="col-sm-6">
	                                                            <label for="">City</label>
	                                                            <input style="width:auto" id="input-city"  type="text" value="<?=$profile->city_title ?>" class="form-control">
	                                                        </div>
	                                                    </div>
	                                                    <div class="row form-group">
	                                                        <label class="col-sm-12" for="">Skills</label>
	                                                        <div class="col-sm-12">
	                                                            <div class="input-group input-group-lg select2-bootstrap-append">
	                                                                <select id="select-skills" class="form-control" multiple>
	                                                                </select>
	                                                            </div>
	                                                        </div>

	                                                    </div>
	                                                    <div class="row form-group">
	                                                        <div class="col-sm-12">
	                                                            <div class="pull-right">
	                                                                <button type="submit" id="advanced-search-send" class="btn btn-primary">Send</button>
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                                <button class="btn btn-primary circle invite-by-email" data-toggle="popover">
	                                                    <i class="ico-mail"></i>
	                                                </button>
	                                                Invite by email
	                                                <button style="margin-left: 11px;" class="btn btn-primary circle advanced-search-btn" data-toggle="popover" data-not_autoclose="1">
	                                                    <i class="ico-search"></i>
	                                                </button>
	                                                Advanced search
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
	                            <div role="tabpanel" class="tab-pane" id="offered-block">
	                                <table style="width:100%;">
	                                    <thead>
	                                    <tr>
	                                        <th></th>
	                                        <th>Name</th>
	                                        <th>Level</th>
	                                        <th>Rate by hour</th>
	                                        <th>Location</th>
	                                        <th><button class="btn btn-primary cancelall-btn">Cancel <br> all</button></th>
	                                    </tr>
	                                    </thead>
	                                    <tbody id="cancel_delegate_users">
	                                        <?= $html_cancel_delegate_users ?>
	                                    </tbody>
	                                    <tfoot>
	                                    <tr>
	                                        <th colspan="5" style="border-right:0;">
	                                            <div class="pull-right">
	                                            </div>
	                                            <div class="clearfix"></div>
	                                        </th>
	                                        <th style="border-left:0;">
	                                            <button class="btn btn-primary cancel-offer" style="width:96px;font-size:11px !important;padding: 0px 15px !important;white-space: initial;">Cancel <br> an offer</button>
	                                        </th>
	                                    </tr>
	                                    </tfoot>
	                                </table>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="row task-body">
	                    <div class="col1">
	                        <div class="title">Speciality:  <?php echo $task->spec?></div>
	                        <div class="block desc">
	                            <div class="content">
	                                <?php echo $task->description?>
	                            </div>
	                            <div class="footer">
	                                <div>
	                                    <div class="btn-group btn-group-justified">
	                                        <?php if(count($task_videos) > 0):?>
	                                            <div class="btn" data-target="#collapseVideo" data-toggle="collapse" aria-expanded="false" aria-controls="collapseVideo">
	                                                <span class="label"><?php echo count($task_videos)?></span>
	                                                <span class="text">Video</span>
	                                            </div>
	                                        <?php endif; ?>
	                                        <?php if(count($files['audio']) > 0):?>
	                                            <div class="btn" data-target="#collapseAudio" data-toggle="collapse" aria-expanded="false" aria-controls="collapseAudio">
	                                                <span class="label"><?php echo count($files['audio'])?></span>
	                                                <span class="text">Sound</span>
	                                            </div>
	                                        <?php endif;?>
	                                        <?php if(count($files['photo']) > 0):?>
	                                            <div class="btn" data-target="#collapsePhotos" data-toggle="collapse" aria-expanded="false" aria-controls="collapsePhotos">
	                                                <span class="label"><?php echo count($files['photo'])?></span>
	                                                <span class="text">Photo</span>
	                                            </div>
	                                        <?php endif;?>
	                                        <?php if(count($files['document']) > 0):?>
	                                            <div class="btn" data-target="#collapseDocument" data-toggle="collapse" aria-expanded="false" aria-controls="collapseDocument">
	                                                <span class="label"><?php echo count($files['document'])?></span>
	                                                <span class="text">Doc</span>
	                                            </div>
	                                        <?php endif;?>
	                                        <?php if(count($files['archive']) > 0):?>
	                                            <div class="btn" data-target="#collapseArchives" data-toggle="collapse" aria-expanded="false" aria-controls="collapseArchives">
	                                                <span class="label"><?php echo count($files['archive'])?></span>
	                                                <span class="text">Archive</span>
	                                            </div>
	                                        <?php endif;?>
	                                        <?php if(count($task_links) > 0):?>
	                                            <div class="btn" data-target="#collapseLinks" data-toggle="collapse" aria-expanded="false" aria-controls="collapseLinks">
	                                                <span class="label"><?php echo count($task_links)?></span>
	                                                <span class="text">Link</span>
	                                            </div>
	                                        <?php endif;?>
	                                        <?php if(count($task_notes) > 0):?>
	                                            <div class="btn" data-target="#collapseNotes" data-toggle="collapse" aria-expanded="false" aria-controls="collapseNotes">
	                                                <span class="label"><?php echo count($task_notes)?></span>
	                                                <span class="text">Notes</span>
	                                            </div>
	                                        <?php endif;?>
	                                    </div>
	                                </div>
	                            </div>
	                            <div id="collapseVideo" class="collapse">
	                                <? foreach($task_videos as $task_video) : ?>
	                                    <div class="col-sm-3">
	                                        <a href="https://www.youtube.com/watch?v=<?= $task_video ?>" class="item" target="_blank">
	                                            <img height="200" class="img-responsive" data-toggle="modal" data-target="#modal-<?= $task_video ?>" src="http://img.youtube.com/vi/<?= $task_video ?>/1.jpg" tabindex="2"/>
	                                        </a>
	                                    </div>
	                                <? endforeach; ?>
	                                <div class="clearfix"></div>
	                            </div>
	                            <div id="collapseAudio" class="collapse">
	                                <? foreach($files['audio'] as $file) : ?>
	                                    <a href="<?= $file['path'] ?>" class="item" target="_blank">
	                                        <i class="icon-music-tone-alt"></i> <br>
	                                        <?= $file['name'] ?>
	                                    </a>
	                                <? endforeach; ?>
	                                <div class="clearfix"></div>
	                            </div>
	                            <div id="collapseDocument" class="collapse">
	                                <? foreach($files['document'] as $file) : ?>
	                                    <a href="<?= $file['path'] ?>" class="item" target="_blank">
	                                        <i class="ico-history"></i> <br>
	                                        <?= $file['name'] ?>
	                                    </a>
	                                <? endforeach; ?>
	                                <div class="clearfix"></div>
	                            </div>
	                            <div id="collapsePhotos" class="collapse">
	                                <? foreach($files['photo'] as $file) : ?>
	                                    <div class="col-sm-3">
	                                        <a href="<?= $file['path'] ?>" target="_blank">
	                                            <img src="<?= $file['path'] ?>" class="img-responsive" alt="">
	                                        </a>
	                                    </div>
	                                <? endforeach; ?>
	                                <div class="clearfix"></div>
	                            </div>
	                            <div id="collapseArchives" class="collapse">
	                                <? foreach($files['archive'] as $file) : ?>
	                                    <a href="<?= $file['path'] ?>" class="item" target="_blank">
	                                        <i class="fa fa-archive"></i> <br>
	                                        <?= $file['name'] ?>
	                                    </a>
	                                <? endforeach; ?>
	                                <div class="clearfix"></div>
	                            </div>
	                            <div id="collapseLinks" class="collapse">
	                                <? foreach($task_links as $task_link) : ?>
	                                    <a href="<?= $task_link->name ?>" class="item" target="_blank">
	                                        <i class="fa fa-link"></i> <br>
	                                        <?= $task_link->name ?>
	                                    </a>
	                                <? endforeach; ?>
	                                <div class="clearfix"></div>
	                            </div>
	                            <div id="collapseNotes" class="collapse">
	                                <? foreach($task_notes as $task_note) : ?>
	                                    <div class="collapse-line"><?= $task_note->name ?> </div>
	                                <? endforeach; ?>
	                                <div class="clearfix"></div>
	                            </div>
	                        </div>
	                        <div class="title text-center" style="margin-top: 15px;">Is this task was helpful to you?</div>
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
	                            <div class="content">
	                                <div class="ajax-content">
	                                    <div class="tab-content">
	                                        <div class="tab-pane active" id="portlet_tab1">
	                                            <div class="scroller" style="height: 200px;">
	                                                <ol id="taskUserNotes">
	                                                    <?= $taskUserNotes ?>
	                                                </ol>
	                                            </div>
	                                        </div>
	                                        <div class="tab-pane" id="portlet_tab2">
	                                            <div class="scroller" style="height: 200px;">
	                                                <ul id="taskUserMessages">
	                                                </ul>
	                                            </div>
	                                        </div>
	                                        <div class="tab-pane" id="portlet_tab3">
	                                            <div class="scroller" style="height: 200px;">
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
</div>