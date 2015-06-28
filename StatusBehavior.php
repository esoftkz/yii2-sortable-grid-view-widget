<?php


namespace esoftkz\sortablegrid;

use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;


class StatusBehavior extends Behavior
{
    /** @var string database field name for row sorting */
    public $statusAttribute = 'status';
	
	/** Активный статус*/
	public $active_status = 1;
	
	/** Неактивный статус*/
	public $notactive_status = 0;

    public function events()
    {
        return [ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert'];
    }

    public function changeStatus($id)
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        if (!$model->hasAttribute($this->statusAttribute)) {
            throw new InvalidConfigException("Model does not have sortable attribute `{$this->statusAttribute}`.");
        }		
		$status_model = $model::find()->where('id = '.$id)->one();		
		$model::getDb()->transaction(function () use ($status_model) {
			$attribute = $this->statusAttribute;
			$status_value = ($status_model->$attribute == $this->active_status) ? $this->notactive_status : $this->active_status;		
            $status_model->updateAttributes([$this->statusAttribute => $status_value]);  
			echo json_encode(['status' => $status_value]);	
        });
		
 
    }

    public function beforeInsert()
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        if (!$model->hasAttribute($this->statusAttribute)) {
            throw new InvalidConfigException("Invalid status attribute `{$this->statusAttribute}`.");
        }
    }
}
