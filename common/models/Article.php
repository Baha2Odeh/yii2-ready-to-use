<?php

namespace common\models;

use common\behaviors\SluggableBehavior;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $body
 * @property int $media_id
 * @property int $status
 * @property int $views
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $is_deleted
 * @property string $deleted_at
 * @property int $deleted_by
 * @property string $ip_address
 * @property string $user_agent
 * @property string $avatar
 *
 * @property Category $category
 * @property User $user
 * @property Media $media
 */
class Article extends \common\models\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /** @var UploadedFile */
    public $image;


    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'slug' => [
                'class' => SluggableBehavior::className(),
                'attribute' => ['title'],
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
                // 'skipOnEmpty' => true
            ],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'body', 'description'], 'required'],
            [['category_id', 'user_id', 'media_id', 'is_active', 'views'], 'integer'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['category_id'], 'exist', 'skipOnError' => false, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['media_id'], 'exist', 'skipOnError' => true, 'targetClass' => Media::className(), 'targetAttribute' => ['media_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,png,gif,mp4,wav', 'maxSize' => 1024 * 1024 * 10, 'tooBig' => Yii::t('app', 'Max Size Is 10MB')],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'slug' => Yii::t('app', 'Slug'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'body' => Yii::t('app', 'Body'),
            'media_id' => Yii::t('app', 'Media ID'),
            'is_active' => Yii::t('app', 'Is Active'),
            'views' => Yii::t('app', 'Views'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'user_agent' => Yii::t('app', 'User Agent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasOne(Media::className(), ['id' => 'media_id']);
    }

    public function getAvatar($size = ImagePreset::TYPE_THUMB)
    {
        if (!empty($this->media)) {
            return $this->media->getThumb($size);
        }
        return Yii::$app->imageCache->url('article_placeholder.jpg',$size);
    }

    public function getRoute(){
        return ['article/view','id'=>$this->id,'slug'=>$this->slug,'category'=>$this->category->slug];
    }
    public function getUrl(){
        return Url::to($this->getRoute());
    }
}
