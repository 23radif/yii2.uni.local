<?php

namespace app\models;

use app\validators\StatusValidate;
use yii\base\Model;

class Task extends Model
{
    public $title;
    public $description;
    public $author;
    public $responsible;
    public $status;

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title'], 'string', 'max' => 10],
            [['status'], StatusValidate::class],
            [['author', 'responsible'], 'safe']
        ];
    }

    public function statusValidate($attribute, $params)
    {
        if(!in_array($this->$attribute, ['В работе', 'Закрыта'])){
            $this->addError($attribute, 'Неверный статус');
        }
    }


    public function fields()
    {
        return [
            'header' => 'title',
            'description'
        ];
    }
}