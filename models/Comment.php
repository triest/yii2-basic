<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $post_id
 * @property string|null $text
 * @property string|null $create_at
 * @property string|null $update_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id','post_id'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'post_id' => 'Post_id',
            'text' => 'Text',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
