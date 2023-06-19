<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use app\models\User;

class RbacController extends Controller
{
    public function actionInit()
    {
        if (User::find()->count() > 0) {
            $this->stdout('Users already initialized' . PHP_EOL, Console::FG_RED);
            return;
        }

        $roles = ['admin', 'teacher', 'parent'];
        foreach ($roles as $role) {
            $roleName = $role;
            $this->actionCreateUser($roleName, $roleName . '-test');
            $this->manageRole('assign', $roleName, $roleName);
        }
    }


    /**
     * @params string $username, string $password
     */
    public function actionCreateUser($username, $password)
    {
        $model = new User();
        $model->username = $username;
        $model->email = $username . '@rbac.ru';
        $model->fio = $username;
        $model->class = '1a';
        $model->setPassword($password);
        $model->status = User::STATUS_ACTIVE;
        $model->generateAuthKey();
        if ($model->save()) {
            $this->stdout("User created success \n", Console::FG_GREEN);
        } else {
            $this->stdout("User created error \n", Console::FG_RED);
            var_dump($model->errors);
        }
    }

    /**
     * @params string $username, string $password
     */
    public function actionChangePassword($username, $password)
    {
        $this->stdout(sprintf("Change password on user '%s' set to '%s' \n", $username, $password));
        $user = User::findByUsername($username);
        if ($user === null) {
            $this->stdout("User not found \n", Console::FG_RED);
            exit();
        }
        $user->password_hash = Yii::$app->security->generatePasswordHash($password);
        if ($user->save()) {
            $this->stdout("Success\n", Console::FG_GREEN);
        } else {
            $this->stdout("Error\n", Console::FG_RED);
        }
    }

    /**
     * @params string $username, string $role
     */
    public function actionAssignRole($username, $role)
    {
        $this->manageRole('assign', $username, $role);
    }

    /**
     * @params string $username, string $role
     */
    public function actionRevokeRole($username, $role)
    {
        $this->manageRole('revoke', $username, $role);
    }

    /**
     * @param string $action
     * @param string $username
     * @param string $role
     */
    private function manageRole($action, $username, $role)
    {
        $this->stdout(sprintf("$action '%s' role to '%s' \n", $role, $username));
        $user = User::findByUsername($username);
        if ($user === null) {
            $this->stdout("User not found \n", Console::FG_RED);
            exit();
        }

        $authManager = Yii::$app->authManager;
        $authRole = $authManager->getRole($role);
        if ($authRole === null) {
            $this->stdout(sprintf("Role %s not found \n", $role), Console::FG_RED);
            exit();
        }

        try {
            $authManager->$action($authRole, $user->id);
        } catch (\Exception $e) {
            $this->stdout(
                sprintf("Role %s has already been %s to the user \n", $role, $action),
                Console::FG_RED
            );
            exit();
        }

        $this->stdout(sprintf("Role %s has been %s\n", $role, $action), Console::FG_GREEN);
    }

}
