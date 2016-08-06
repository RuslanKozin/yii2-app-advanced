<?php

namespace frontend\behaviors;

use yii\base\Behavior;
use yii\base\Event;
use yii\base\ActionEvent;

class AccessOnce extends Behavior
{
        //Событие при создании объекта поведения
    public function events()
    {
        $owner = $this->owner;

        if ($owner instanceof \yii\web\Controller) {
            return [
                $owner::EVENT_BEFORE_ACTION => 'checkAccess',
                $owner::EVENT_AFTER_ACTION => 'closeDoor',
            ];
        }

        return parent::events();
    }

    public function beforeAction($action)
    {
        $event = new ActionEvent($action);
        $this->trigger(self::EVENT_BEFORE_ACTION, $event);
        return $event->isValid;
    }

    public function afterAction($action, $result)
    {
        $event = new ActionEvent($action);
        $event->result = $result;
        $this->trigger(self::EVENT_AFTER_ACTION, $event);
        return $event->result;
    }

        //Создаем обработчик, который закрывает доступ, создает переменную в сессии.
    public $actions = [];

    public function closeDoor(\yii\base\ActionEvent $event)
    {
        if (in_array($event->action->id, $this->actions, true)) {
            \Yii::$app->session->set($event->action->id . '-access-lock', 1);
        }
    }

    public $message = 'Доступ ограничен. Вы ранее совершали действия на этой странице.';

    public function checkAccess(\yii\base\ActionEvent $event)
    {
        if (in_array($event->action->id, $this->actions, true)) {
            if (\Yii::$app->session->get($event->action->id . '-access-lock') !== null) {
                throw new \yii\web\HttpException(403, $this->message);
            }
        }
    }

}