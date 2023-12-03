<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int $id
 * @property string $dt_add
 * @property string $email
 * @property string $name
 * @property string $password_hash
 * @property string $contacts
 * @property string $avatar_path
 *
 * @property Bet[] $bets
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName(): string
    {
        return '{{%user}}';
    }

    public function rules(): array
    {
        return [
            [['name'], 'trim'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique', 'targetClass' => self::class, 'targetAttribute' => 'name'],

            [['password_hash'], 'trim'],
            [['password_hash'], 'required'],
            [['password_hash'], 'string', 'max' => 255],

            [['email'], 'trim'],
            [['email'], 'required'],
            [['email'], 'string', 'max' => 64],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => self::class, 'targetAttribute' => 'email'],

            [['contacts'], 'trim'],
            [['contacts'], 'string', 'max' => 512],
            [['contacts'], 'default', 'value' => null],

            [['avatar_path'], 'trim'],
            [['avatar_path'], 'string', 'max' => 128],
            [['avatar_path'], 'unique', 'targetClass' => self::class, 'targetAttribute' => 'avatar_path']
        ];
    }

    public function getBets(): ActiveQuery
    {
        return $this->hasMany(Bet::class, ['user_id' => 'id']);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method
    }

    public function validatePasswordHash(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
