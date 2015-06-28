<?php


namespace esoftkz\sortablegrid;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\web\BadRequestHttpException;


class StatusAction extends Action
{
    public $modelName;

    public function run()
    {
        if (!$id = Yii::$app->request->post('id')) {
            throw new BadRequestHttpException('Don\'t received POST param `id`.');
        }
        /** @var \yii\db\ActiveRecord $model */
        $model = new $this->modelName;
        if (!$model->hasMethod('changeStatus')) {
            throw new InvalidConfigException(
                "Not found right `StatusBehavior` behavior in `{$this->modelName}`."
            );
        }

        $model->changeStatus($id);
    }
}
