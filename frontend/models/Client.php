<?php

namespace frontend\models;

use frontend\models\enums\GenderEnum;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $full_name
 * @property string $gender
 * @property string $birth_date
 * @property string $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 *
 * @property Club[] $clubs
 */
class Client extends \yii\db\ActiveRecord
{

    public $club_ids;


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }



    public function afterSave($insert, $changedAttributes): void
    {
        $this->unlinkAll('clubs', true); // удалим старые связи
        if (is_array($this->club_ids)) {
            $clubs = Club::find()->where(['id' => $this->club_ids])->all();
            foreach ($clubs as $club) {
                $this->link('clubs', $club);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    public function getClubs(): ActiveQuery
    {
        return $this->hasMany(Club::class, ['id' => 'club_id'])
            ->viaTable('client_club', ['client_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name'], 'required'],
            [['birth_date', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['full_name'], 'string', 'max' => 255],
            ['club_ids', 'required'],
            [['gender'], 'in', 'range' => GenderEnum::getValues()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
        ];
    }

    public function delete()
    {
        $this->deleted_at = new \yii\db\Expression('NOW()');
        $this->deleted_by = Yii::$app->user->id;
        return $this->save(false, ['deleted_at', 'deleted_by']);
    }

}
