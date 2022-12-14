<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "new_user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $password
 * @property string|null $email
 * @property string|null $authKey
 * @property string|null $accessToken
 * @property string|null $role
 * @property int|null $has_booking
 *
 * @property BorrowedBike[] $borrowedBikes
 */
class NewUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'new_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['has_booking'], 'integer'],
            [['username', 'email', 'role'], 'string', 'max' => 80],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 255],
            [['username', 'email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'role' => 'Role',
            'has_booking' => 'Has Booking',
            'authKey' => 'Ac Code'
        ];
    }

    /**
     * Gets query for [[BorrowedBikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowedBikes()
    {
        return $this->hasMany(BorrowedBike::class, ['user_id' => 'id']);
    }
    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type=null){
        return self::findOne(['accessToken'=>$token]);
    }

    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){
        return $this->authKey;
    }

    public function validateAuthKey($authKey){
        return $this->authKey == $authKey;
    }

    public function validatePassword($password){
        return password_verify($password, $this->password);
    }
}
