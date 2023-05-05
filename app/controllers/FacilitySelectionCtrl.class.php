<?php

namespace app\controllers;

use app\forms\SearchForm;

use core\App;
use core\Utils;
use core\ParamUtils;

class FacilitySelectionCtrl{
    private $doctorsData;
	
	public function __construct()
	{
	}

	public function action_facilitySelected()
	{
		$facilityRegon = ParamUtils::getFromRequest('buttonValue');
        $this->doctorsData = $this->getHiredDoctors($facilityRegon);

		$this->generateView(); 
	}

    public function getHiredDoctors($regon)
    {
        $doctorIds = App::getDB()->select("employment", "doctor_id_fk", [
            "facility_regon_fk" => $regon
        ]);

        $doctors = App::getDB()->select("doctor", "*", [
            "id" => $doctorIds
        ]);

        return $doctors;
    }

	private function generateView()
	{
		App::getSmarty()->assign('page_title','Doktorzy wybranej placówki');
		App::getSmarty()->assign('data', $this->doctorsData);
		
		App::getSmarty()->display('facilityOverwiev.tpl');
	}
}