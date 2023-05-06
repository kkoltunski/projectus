<?php

namespace app\controllers;

use app\transfer\User;
use app\forms\LoginForm;

use core\App;
use core\Message;
use core\Utils;
use core\ParamUtils;
use core\RoleUtils;

class LoginCtrl{
	private $form;
	
	public function __construct()
	{
		$this->form = new LoginForm();
	}

	public function action_loginShow()
	{
		$this->generateView(); 
	}

	public function action_login()
	{
		$this->getParams();
		if ($this->validate()){
			$this->createUser();
			Utils::addInfoMessage('Zalogowano.');
			App::getRouter()->forwardTo("homeShow");
		} else {
			$this->generateView(); 
		}
	}
	
	public function action_logout()
	{
		session_destroy();
		Utils::addInfoMessage('Wylogowano');
		App::getRouter()->forwardTo("homeShow");
	}

	private function generateView()
	{
		App::getSmarty()->assign('page_title','Strona logowania');
		App::getSmarty()->assign('form',$this->form);
		App::getSmarty()->display('loginView.tpl');
	}

	private function getParams()
	{
		$this->form->pesel = ParamUtils::getFromRequest('pesel');
		$this->form->pass = ParamUtils::getFromRequest('pass');
	}
	
	private function validateWithDataBase()
	{
		$data = App::getDB()->select("patient", ["password", "verified"], [
            "pesel" => $this->form->pesel
        ]);

		if(!empty($data))
		{
			if(strcmp($this->form->pass, $data[0]["password"]) !== 0)
			{
				Utils::addErrorMessage("Hasło nie pasuje.");
			}

			if($data[0]["verified"] == 0)
			{
				Utils::addErrorMessage("Konto nie zostało jeszcze zweryfikowane.");
			}
		}
		else
		{
			Utils::addErrorMessage("Pacjent nie istnieje");
		}
	}

	private function validate() 
	{
		$peselValid = Utils::isPESELValid($this->form->pesel);
		$passValid = Utils::isPasswordValid($this->form->pass);

		if($peselValid && $passValid)
		{
			$this->validateWithDataBase();
		}
		

		return (!App::getMessages()->isError() && $peselValid && $passValid);
	}

	function createUser()
	{
		$data = App::getDB()->select("patient", 'pesel', [
            "pesel" => $this->form->pesel
        ]);

		$user = new User($data);
		$_SESSION['user'] = serialize($user);
		RoleUtils::addRole($user->role);
	}
}