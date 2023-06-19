<?php

namespace app\models\form;

use app\models\User;
use mdm\admin\components\UserStatus;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class Signup extends Model
{
    public $username;
    public $email;
    public $password;
    public $retypePassword;
    public $fio;
    public $class;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $class = Yii::$app->getUser()->identityClass ?: 'mdm\admin\models\User';
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => $class, 'message' => 'Данный логин уже занят'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => $class, 'message' => 'Данный email уже зарегистрирован'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['retypePassword', 'required'],
            ['retypePassword', 'compare', 'compareAttribute' => 'password'],

            [['fio', 'class'], 'required'],
            ['fio', 'string', 'min' => 2, 'max' => 1024],
            ['class', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'E-mail',
            'fio' => 'ФИО',
            'class' => 'Класс',
            'password' => 'Пароль',
            'retypePassword' => 'Повтор пароля',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->fio = $this->fio;
            $user->class = $this->class;
            $user->status = UserStatus::INACTIVE;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                $authManager = Yii::$app->authManager;
                $authRole = $authManager->getRole('parent');
                $authManager->assign($authRole, $user->id);
                return $user;
            }
        }

        return null;
    }
}
