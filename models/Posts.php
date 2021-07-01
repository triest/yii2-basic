<?php

namespace app\models;

use DateTime;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $author_id
 * @property string $update_at
 * @property string $create_at
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['update_at', 'create_at'], 'required'],
            [['update_at', 'create_at'], 'safe'],
            [['title','main_image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2048],
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
            'description' => 'Description',
            'author_id' => 'Author ID',
            'update_at' => 'Update At',
            'create_at' => 'Create At',
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert)
                $this->create_at = date('Y-m-d H:i:s');
            $this->update_at = date('Y-m-d H:i:s');
            return true;
        } else {
            return false;
        }
    }

    public function getHumanDate(){
        $date = new DateTime($this->create_at);
        return $date->format('Y-m-d H:i');
    }
}
