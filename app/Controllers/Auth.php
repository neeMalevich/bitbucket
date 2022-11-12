<?php

namespace App\Controllers;

use App\Services\App;
use App\Services\Router;

class Auth
{
    public $dbUsers;

    public $errorsValidate = null;

    public function __construct()
    {
        $this->dbUsers = App::db();
    }

    public function register($data)
    {
        $login = $data['login'];
        $password = $data['password'];
        $confirm_password = $data['confirm_password'];
        $email = $data['email'];
        $name = $data['name'];

        $this->validateNotNull($login, $password, $name);
        $this->validatePassword($password, $confirm_password);
        $this->validateEmail($email);

        $this->validateUniqueLoginAndEmail($login, $email);

        if ($this->errorsValidate !== null) {
            $_SESSION['message'] = $this->errorsValidate;
            Router::redirect('/register');
        } else {

            $newUser = $this->dbUsers->addChild('user');
            $newUser->addChild('login', $login);
            $newUser->addChild('email', $email);
            $newUser->addChild('name', $name);
            $newUser->addChild('password_hash', md5($password));
            $newUser->addChild('session_hash', self::generateSessionKey());
            $this->dbUsers->asXML(App::dbFilePath()['users']);

            Router::redirect('/login');
        }
    }

    public static function generateSessionKey($lehgth = 10)
    {
        return substr(md5(mt_rand()), 0, $lehgth);
    }

    public function login($data)
    {
        $login = $data['login'];
        $password = $data['password'];

        $this->validateForSignIn($login, $password);

        if ($this->errorsValidate !== null) {
            $_SESSION['message_login'] = $this->errorsValidate;
            Router::redirect('/login');
        } else {
            $_SESSION['name'] = $login;
            Router::redirect('/user');
        }
    }

    public function logout()
    {
        unset($_SESSION['name']);
        Router::redirect('/login');
    }


    public function validateNotNull($login, $password, $name)
    {
        $arr_validats = [
            'логин' => $login,
            'пароль' => $password,
            'имя' => $name
        ];

        foreach ($arr_validats as $key => $value) {
            $value = trim($value);
            if (strlen($value) < 5) {
                $this->errorsValidate[] = 'Поле ' . mb_strtoupper($key) . ' не должно быть меньше 5 символов';
            } elseif (strlen($value) > 50) {
                $this->errorsValidate[] = 'Поле ' . mb_strtoupper($key) . ' не должно быть больше 50 символов';
            }
        }

        return true;
    }

    public function validatePassword($password, $confirm_password)
    {
        if ($password !== $confirm_password) {
            $this->errorsValidate[] = 'пароль и подтверждение пароля не совпадают';
            return false;
        }
        return true;
    }

    public function validateEmail($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorsValidate[] = 'Почта: ' . $email . ' не соответствует формату email';
            return false;
        }

        return true;
    }

    public function validateUniqueLoginAndEmail($login, $email)
    {

        $obj_user = (array)$this->dbUsers;

        $login = trim($login);
        $email = trim($email);

        foreach ($obj_user['user'] as $key => $value) {

            if ($value->login == $login || $value->login == $email) {

                if ($value->login == $login && $value->email == $email) {
                    $this->errorsValidate[] = 'Логин ' . $login . ' и email: - ' . $email . ' уже есть занят';
                    break;
                } elseif ($value->email == $email) {
                    $this->errorsValidate[] = 'Email ' . $email . ' уже есть занят';
                    break;
                } else {
                    $this->errorsValidate[] = 'Логин ' . $login . ' уже есть занят';
                    break;
                }
            }
        }
        return true;
    }

    public function signInLogin($login)
    {
        $obj_user = (array)$this->dbUsers;
        $login = trim($login);

        foreach ($obj_user['user'] as $key => $value) {

            if ((string)$value->login !== $login) {
                $this->errorsValidate[] = 'Логин ' . $login . ' не совпадает';
                break;
            }
            return true;
        }
        return true;
    }

    public function validateForSignIn($login, $password)
    {
        $user = $this->searchByLogin($login);

        if ($user === false || !$this->equalityPassword($user, $password)) {
            $this->errorsValidate[] = 'ошибка в логине или пароле';
        }
    }

    public function searchByLogin($login)
    {
        $resultObject = false;
        foreach ($this->dbUsers as $value) {
            if ((trim($login)) == trim($value->login)) {
                $resultObject = $value;
                break;
            }
        }

        return $resultObject;
    }

    public function equalityPassword($user, $password)
    {
        $hashPasswordUser = md5($password);
        if ($hashPasswordUser == $user->password_hash) {
            return true;
        }
        return false;
    }

}