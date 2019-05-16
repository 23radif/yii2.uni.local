<?php
echo $dataProvider->sort->link('deadline') . ' / ';
echo $dataProvider->sort->link('create_time') . ' / ';
echo $dataProvider->sort->link('update_time');
//$request = Yii::$app->request;
//$get = $request->get('sort');

$key = 'dataProviderTask';
if ($this->beginCache($key, [
    'duration' => 5,
    //'variation' => $get,
])) {
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => function ($model) {
            return \app\widgets\TaskPreview::widget(['model' => $model]);
        },
        'summary' => false,
        'options' => [
            'class' => 'preview-container'
        ]
    ]);
    $this->endCache();
}
