<?php

namespace esoftkz\sortablegrid;

use yii\web\AssetBundle;

class SortableGridAsset extends AssetBundle
{
    public $sourcePath = '@vendor/esoftkz/yii2-sortable-grid-view-widget/assets';

    public $js = [
        'js/jquery.sortable.gridview.js',
		'js/jquery.status.gridview.js',
    ];

    public $depends = [
        'yii\jui\JuiAsset',
		'yii\grid\GridViewAsset'
    ];
}
