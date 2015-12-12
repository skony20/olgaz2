<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $short_content
 * @property integer $user_id
 * @property integer $data_creation
 * @property integer $last_modification
 * @property integer $is_active
 * @property string $tags
 * @property string $nice_link
 * @property integer $category_id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'nice_link',
            ],
        ];
    }
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_content', 'content'], 'string'],
            [['user_id', 'data_creation', 'last_modification', 'is_active', 'category_id'], 'integer'],
            [['category_id'], 'required'],
            [['title', 'tags'], 'string', 'max' => 255],
            [['nice_link'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'short_content' => 'Krótki opis generowany automatycznie',
            'user_id' => 'Id użytkownika',
            'data_creation' => 'Daa utworzenia',
            'last_modification' => 'Ostania modyfikacja',
            'is_active' => 'Aktywny wpis ?',
            'tags' => 'Tags',
            'nice_link' => 'Nicename link(niepotrzebny)',
            'category_id' => 'Kategoria',
        ];
    }
}
