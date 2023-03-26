<?php

namespace backend\modules\content\models;

use Yii;

/**
 * This is the model class for table "{{%question}}".
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property string $position
 * @property int|null $sort
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Question extends \yii\db\ActiveRecord
{

    const POSITION_BOTTOM = 'bottom';

    const POSITION_CARD = 'card';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%question}}';
    }

    public static function getPositionsArray()
    {
        return [
            self::POSITION_BOTTOM => Yii::t('app', 'Question position bottom'),
            self::POSITION_CARD => Yii::t('app', 'Question position inside card'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question', 'answer', 'position'], 'required'],
            [['answer'], 'string'],
            [['sort', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['question', 'position', 'status'], 'string', 'max' => 255],

            ['position', 'in', 'range' => array_keys(self::getPositionsArray())]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'question' => Yii::t('app', 'Question'),
            'answer' => Yii::t('app', 'Answer'),
            'position' => Yii::t('app', 'Position'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\content\models\query\QuestionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\content\models\query\QuestionQuery(get_called_class());
    }
}
