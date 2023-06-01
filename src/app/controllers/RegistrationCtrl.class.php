<?php

namespace app\controllers;

use app\forms\AccountForm;

use core\App;
use core\ParamUtils;
use core\Utils;

class RegistrationCtrl 
{
	private $form;

	public function __construct(){
		$this->form = new AccountForm();
	}
	
	public function action_registrationShow()
    {
		$this->generateView();
	}

    public function action_registration()
    {
        $this->getParams();

		if ($this->validate()) 
        {	
            $this->insertToDB();
			Utils::addInfoMessage('Poprawnie zarejestrowano. Poczekaj na weryfikacje.');
            App::getRouter()->forwardTo("homeShow");
		}
        else
        {
            $this->generateView();
        }
    }

	private function generateView(){
		App::getSmarty()->assign('page_title','Rejestracja');
		App::getSmarty()->assign('form',$this->form);

		App::getSmarty()->display('registrationView.tpl');
	}

	private function getParams()
	{
		$this->form->pesel = ParamUtils::getFromRequest('pesel');
		$this->form->name = ParamUtils::getFromRequest('name');
		$this->form->surname = ParamUtils::getFromRequest('surname');
		$this->form->passwordFirst = ParamUtils::getFromRequest('pass1');
		$this->form->passwordSecond = ParamUtils::getFromRequest('pass2');
		$this->form->email = ParamUtils::getFromRequest('email');
		$this->form->contactNumber = ParamUtils::getFromRequest('number');
	}

    private function isUniqeInDB()
    {
        $patientData = App::getDB()->select("patient", "pesel", [
            "pesel" => $this->form->pesel
        ]);

        $emailData = App::getDB()->select("patient", "pesel", [
            "email" => $this->form->email
        ]);

        return (empty($patientData) && empty($emailData));
    }

	private function validate() 
    {
        $peselValid = Utils::isPESELValid($this->form->pesel);
        $emailValid = Utils::isEmailValid($this->form->email);

        $isUniqe = $this->isUniqeInDB();
        if(!$isUniqe)
        {
			Utils::addErrorMessage('PESEL lub email już istnieją');
        }

        $passwordsTheSame = (strcmp($this->form->passwordFirst, $this->form->passwordSecond) === 0);
        $passFirstValid = null;
        if($passwordsTheSame)
        {
            $passFirstValid = Utils::isPasswordValid($this->form->passwordFirst);
        }
        else
        {
            Utils::addErrorMessage('Hasła nie są te same');
        }

        $contactNumberValid = Utils::isContactNumberValid($this->form->contactNumber);
		
		return ($peselValid && $passFirstValid && $passwordsTheSame && $emailValid && $contactNumberValid && $isUniqe);
	}

    private function insertToDB()
    {
        $hashed_pass = password_hash($this->form->passwordFirst, PASSWORD_DEFAULT);

        App::getDB()->insert("patient", [
            "pesel" => $this->form->pesel,
            "name" => $this->form->name,
            "surname" => $this->form->surname,
            "email" => $this->form->email,
            "password" => $hashed_pass
        ]);
	}
}
