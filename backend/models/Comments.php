<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property string $content
 * @property string $nick
 * @property string $email
 * @property integer $data_creation
 * @property integer $last_modification
 * @property integer $is_active
 * @property integer $post_id
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'is_active', 'post_id'], 'required'],
            [['content'], 'string'],
            [['data_creation', 'last_modification', 'is_active', 'post_id'], 'integer'],
            [['nick', 'email'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'nick' => 'Nick',
            'email' => 'Email',
            'data_creation' => 'Data Creation',
            'last_modification' => 'Last Modification',
            'is_active' => 'Is Active',
            'post_id' => 'Post ID',
        ];
    }
}
