<?php

use yii\helpers\Html;

/**
 * @var frontend\modules\core\base\View $this
 */

?>

<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('mail', 'Здравствуйте') ?>,
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('mail', 'Вы недавно запросили смену e-mail на {0}', [Yii::$app->name]) ?>.
    <?= Yii::t('mail', 'Чтобы завершить запрос, нажмите на ссылку ниже') ?>.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Html::a(Html::encode($params['tokenUrl']), $params['tokenUrl']) ?>
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('mail', 'Эта ссылка будет действовать ограниченное количество времени') ?>.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('mail', 'Если вы получили это письмо по ошибке, просто удалите его') ?>.
</p>