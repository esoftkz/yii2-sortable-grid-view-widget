<?php


namespace esoftkz\sortablegrid;

use yii\helpers\Url;
use yii\grid\GridView;


class SortableGridView extends GridView
{
    /** @var string|array Sort action */
    public $sortableAction = ['sort'];
	
	/** @var string|array Status action */
    public $statusAction = ['status'];

    public function init()
    {
        parent::init();
        $this->sortableAction = Url::to($this->sortableAction);
		
		$this->statusAction = Url::to($this->statusAction);
    }

    public function run()
    {
        $this->registerWidget();
        parent::run();
    }

    protected function registerWidget()
    {
        $view = $this->getView();
        $view->registerJs("jQuery('#{$this->id}').SortableGridView('{$this->sortableAction}');");
		
		//Регитрация смены статуса
		$view->registerJs("jQuery('.status_icon').ChangeStatus('{$this->statusAction}');");
		
        SortableGridAsset::register($view);
    }
}
