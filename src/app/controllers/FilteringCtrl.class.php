<?php

namespace app\controllers;

use app\forms\VinylForm;
use app\forms\SearchForm;

use core\App;
use core\ParamUtils;
use core\Utils;
use core\Validator;

class FilteringCtrl 
{
    private $facilitiesData;
    private $searchForm;

	public function __construct(){
        $this->searchForm = new SearchForm();
	}
	
    public function action_processFiltering()
    {
        $action = ParamUtils::getFromRequest('buttonValue');

        if(strcmp($action, "reset") == 0)
        {
		    App::getRouter()->forwardTo("searchShow");
        }
        else
        {
            $this->filterVinylView();
        }
    }

    public function filterVinylView()
    {
        ParamUtils::getParamsForFiltering($this->searchForm);
        $this->facilitiesData = Utils::getFacilitiesDataFromQuery($this->searchForm);

		$this->generateSearchView();
	}

    private function generateSearchView(){
        Utils::getDataForSearchBar($this->searchForm);

		App::getSmarty()->assign('page_title','Wybierz placówke');
		App::getSmarty()->assign('townsData',$this->searchForm->townsData);
        App::getSmarty()->assign('voivodeshipsData',$this->searchForm->voivodeshipsData);
        App::getSmarty()->assign('specializationsData',$this->searchForm->specializationsData);
        App::getSmarty()->assign('data',$this->facilitiesData);

		App::getSmarty()->display('searchView.tpl');
	}
}
