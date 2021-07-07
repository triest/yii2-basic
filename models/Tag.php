<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $create_at
 * @property string|null $update_at
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_at', 'update_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    public function getPosts(){
        return $this->hasMany(Tag::className(), ['id' => 'post_id'])
                ->viaTable('post_tag', ['tag_id' => 'id']);
    }
}
