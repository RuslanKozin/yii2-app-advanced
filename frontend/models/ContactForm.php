<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()   //используется для валидации, проверки атрибутов модели
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'], //Валидатор required проверяет обязательные поля
            // email has to be a valid email address
            ['email', 'email'],     //Валидатор email проверяет правильность введенного электронного адреса
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],      //Валидатор captcha проверяет правильность проверочного кода
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()   //используется для описания меток, маркировок атрибутов
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)   //Отвечает за отправку "обратной связи"
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
