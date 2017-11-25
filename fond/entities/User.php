<?php

namespace app\fond\entities;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


/**
 * @property integer id
 * @property string $username [varchar(255)]
 * @property string $password [varchar(255)]
 * @property string $authKey [varchar(255)]
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id) ? : NULL;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /*foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;*/
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]) ? : NULL;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    public static function tableName() {
        return '{{%users}}';
    }
}
