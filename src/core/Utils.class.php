<?php

namespace core;

class Utils {

    public static function addRoute($action, $controller, $roles = null) {
        App::getRouter()->addRoute($action, $controller, $roles);
    }

    public static function addRouteEx($action, $path, $controller, $method, $roles = null) {
        App::getRouter()->addRouteEx($action, $path, $controller, $method, $roles);
    }

    public static function addErrorMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::ERROR), $index);
    }

    public static function addInfoMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::INFO), $index);
    }

    public static function addWarningMessage($text, $index = null) {
        App::getMessages()->addMessage(new Message($text, Message::WARNING), $index);
    }

    private static function _url_maker($action, $params = null) {
        $url = $action;
        if ($params != null && is_array($params)) {
            foreach ($params as $key => $value) {
                if (App::getConf()->clean_urls) {
                    $url .= '/';
                } else {
                    $url .= '&' . $key . '=';
                }
                $url .= $value;
            }
        }
        return $url;
    }

    private static function _url_maker_noclean($action, $params = null) {
        $url = $action;
        if (App::getConf()->clean_urls) {
            $url .= '?';
        }
        if ($params != null && is_array($params)) {
            $first = true;
            foreach ($params as $key => $value) {
                if ($first && App::getConf()->clean_urls){
                    $url .= $key . '=' . $value;
                    $first = false;
                } else {
                    $url .= '&' . $key . '=' . $value;
                }
            }
        }
        return $url;
    }
    public static function URL($action, $params = null) {       
        return App::getConf()->action_url . self::_url_maker($action, $params);
    }

    public static function relURL($action, $params = null) {       
        return App::getConf()->action_root . self::_url_maker($action, $params);
    }

    public static function URL_noclean($action, $params = null) {       
        return App::getConf()->action_url . self::_url_maker_noclean($action, $params);
    }

    public static function relURL_noclean($action, $params = null) {       
        return App::getConf()->action_root . self::_url_maker_noclean($action, $params);
    }

//user defined
    public static function isPESELValid($login)
    {
        $loginValidator = new Validator();
	    $login = $loginValidator->validate($login, [
  	    	'trim' => true,
  	    	'required' => true,
  	    	'required_message' => 'PESEL jest wymagany',
  	    	'min_length' => 11,
  	    	'max_length' => 11,
  	    	'validator_message' => 'PESEL powinien składać się z 11 cyfr'
	    ]);

        return $loginValidator->isLastOK();
    }

    public static function isPasswordValid($password)
    {
        $passValidator = new Validator();
        $pass = $passValidator->validate($password, [
            'required' => true,
            'required_message' => 'Hasło jest wymagane',
            'min_length' => 5,
            'max_length' => 15,
            'validator_message' => 'Hasło powinno sie skłądać z 5 - 15 znaków'
        ]);

        return $passValidator->isLastOK();
    }

    public static function isEmailValid($email)
    {
        $emailValidator = new Validator();
        $email = $emailValidator->validate($email, [
            'required' => true,
            'email' => true,
            'required_message' => 'Email jest wymagany',
            'validator_message' => 'Format email nie jest poprawny'
        ]);

        return $emailValidator->isLastOK();
    }

    public static function isContactNumberValid($contactNumber)
    {
        $contactNumberValidator = new Validator();
        $contactNumber = $contactNumberValidator->validate($contactNumber, [
            'max_length' => 12,
            'validator_message' => 'Zbyt długi numer kontaktowy'
        ]);

        return $contactNumberValidator->isLastOK();
    }

    public static function isPhraseValid($phrase, $type, $maxLength)
    {
        $phraseValidator = new Validator();
        $p = $phraseValidator->validate($phrase, [
            'required' => true,
            'required_message' => "$type is required.",
            'max_length' => $maxLength,
            'validator_message' => "$type should have up to $maxLength characters."
        ]);

        return $phraseValidator->isLastOK();
    }

    public static function getIdRole($name)
    {
	    $idRole = App::getDB()->select("role", "idRole", [
	    	"name" => $name
	    ]);

	    return "$idRole[0]";
    }

    public static function getSpecializations($searchForm)
    {
        $specializationsId = App::getDB()->select("medicalfacility", "specialization_id");

        $result = array();

        if(!empty($specializationsId))
        {
            $specializations = App::getDB()->select("medicalspecialization", "name", ["id" => $specializationsId]);

            $uniqueSpecializations = array_unique($specializations);
            sort($uniqueSpecializations);

            $result = $uniqueSpecializations;
        }

        $searchForm->facilitiesSpecializations = $result;
    }

    public static function getWholeFacilitiesData(){
        return App::getDB()->select("medicalfacility", "*");
	}

    public static function getFacilitiesData($phrase)
    {
        $specializationIds = App::getDB()->select("medicalspecialization", "id", ["name" => $phrase]);
        return App::getDB()->select("medicalfacility", "*", ["specialization_id" => $specializationIds]);
    }

    public static function getTownsList()
    {
        $towns = App::getDB()->select("medicalfacility", "town");
        $uniqueTowns = array_unique($towns);
        sort($uniqueTowns);
        return $uniqueTowns;
    }

    public static function getVoivodeshipsList()
    {
        $voivodeships = App::getDB()->select("medicalfacility", "voivodeship");
        $uniqueVoivodeships = array_unique($voivodeships);
        sort($uniqueVoivodeships);
        return $uniqueVoivodeships;
    }

    public static function getSpecializationsList()
    {
        $specNames = App::getDB()->select("medicalfacility", "specialization_name");
        $uniqueSpecNames = array_unique($specNames);
        sort($uniqueSpecNames);
        return $uniqueSpecNames;
    }

    public static function getDataForSearchBar($searchForm)
    {
        $searchForm->townsData = Utils::getTownsList();
        $searchForm->voivodeshipsData = Utils::getVoivodeshipsList();
        $searchForm->specializationsData = Utils::getSpecializationsList();
    }

    public static function getFacilitiesDataFromQuery($searchForm)
    {
        $townSelected = (strcmp($searchForm->selectedTown, "0") !== 0);
        $voivodeshipSelected = (strcmp($searchForm->selectedVoivodeship, "0") !== 0);
        $specializationNameSelected = (strcmp($searchForm->selectedSpecialization, "0") !== 0);

        if($townSelected or $voivodeshipSelected or $specializationNameSelected)
        {
            $where = ' WHERE';
            $and = '';

            if($townSelected){
                $and .= " `town` = '$searchForm->selectedTown'";
            }
            if($voivodeshipSelected)
            {
                if(!empty($and)){
                    $and .= " AND";
                }
                $and .= " `voivodeship` = '$searchForm->selectedVoivodeship'";
            }
            if($specializationNameSelected)
            {
                if(!empty($and)){
                    $and .= " AND";
                }
                $and .= " `specialization_name` = '$searchForm->selectedSpecialization'";
            }

            $query = 'SELECT * FROM `medicalfacility`'.$where.$and;
            return App::getDB()->query($query)->fetchAll();
        }
        else
        {
            return Utils::getWholeFacilitiesData();
        }
    }






    






    public static function getGenreListForIds($idVinyls)
    {
        $genres = App::getDB()->select("vinyl", "genre", ["idVinyl" => $idVinyls]);
        $uniqueGenres = array_unique($genres);
        sort($uniqueGenres);
        return $uniqueGenres;
    }

    public static function getAuthorListForIds($idVinyls)
    {
        $authors = App::getDB()->select("vinyl", "author", ["idVinyl" => $idVinyls]);
        $uniqueAuthors = array_unique($authors);
        sort($uniqueAuthors);
        return $uniqueAuthors;
    }

    public static function getYearListForIds($idVinyls)
    {
        $years = App::getDB()->select("vinyl", "year", ["idVinyl" => $idVinyls]);
        $uniqueYears = array_unique($years);
        sort($uniqueYears);
        return $uniqueYears;
    }

    public static function getDataForSearchBarReservations($searchForm)
    {
        $user = unserialize($_SESSION['user']);
        $idVinyls = App::getDB()->select("rental", "idVinyl_fk", [
            "idUser_fk" => $user->idUser]);

        if(!empty($idVinyls))
        {
            $searchForm->genresData = Utils::getGenreListForIds($idVinyls);
            $searchForm->authorsData = Utils::getAuthorListForIds($idVinyls);
            $searchForm->yearsData = Utils::getYearListForIds($idVinyls);
        }
    }
}
