<?php

namespace app\models\tables;

use app\models\tables\TaskStatuses;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator_id
 * @property int $responsible_id
 * @property string $deadline
 * @property int $status_id
 *
 * @property Test $status
 * @property Users $responsible
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['creator_id', 'responsible_id', 'status_id'], 'integer'],
            [['deadline'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'creator_id' => 'Creator ID',
            'responsible_id' => 'Responsible ID',
            'deadline' => 'Deadline',
            'status_id' => 'Status ID',
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(TaskStatuses::class, ['id' => 'status_id']);
    }

    public function getResponsible()
    {
        return $this->hasOne(Users::class, ['id' => 'responsible_id']);
    }

//id и логин создателя
    public static function getCreatorId ()
    {
        return function ($model) {
            return $model->creator_id . ' (' .
                $user = Users::find()
                        ->where(['id' => $model->creator_id])
                        ->one()
                        ->login . ')';
        };
    }

//id и логин ответственного
    public static function getResponsibleId ()
    {
        return function ($model) {
            return $model->responsible_id . ' (' .
                $user = Users::find()
                        ->where(['id' => $model->responsible_id])
                        ->one()
                        ->login . ')';
        };
    }

//id статуса
    public static function getStatusId ()
    {
        return function ($model) {
            return $model->status_id . ' (' .
                $user = TaskStatuses::find()
                        ->where(['id' => $model->status_id])
                        ->one()
                        ->name . ')';
        };
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
