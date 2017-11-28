<?php

namespace app\fond\entities\manage;


use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property string $phone [varchar(255)]
 * @property string $email [varchar(255)]
 * @property string $body
 * @property int $status [smallint(6)]
 * @property int $created_at [int(11)]
 */
class Message extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public static function create($name, $phone, $email, $body): self
    {
        $message = new static();
        $message->name = $name;
        $message->phone = $phone;
        $message->email = $email;
        $message->body = $body;
        $message->status = self::STATUS_DRAFT;
        $message->created_at = time();

        return $message;
    }

    public function isDraft()
    {
        return $this->status == self::STATUS_DRAFT;
    }

    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function activate()
    {
        if ($this->isActive()){
            throw new \DomainException('Сообщение уже прочитано');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function attributeLabels() {
        return [
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'body' => 'Текст сообщения',
            'status' => 'Состояние',
            'created_at' => 'Отправлено',
        ];
    }

    public static function tableName() {
        return '{{%messages}}';
    }
}