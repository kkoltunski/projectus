<?php

namespace app\controllers;

use app\forms\SearchForm;

use core\App;
use core\Utils;
use core\ParamUtils;

class HomeCtrl{
    private $searchForm;
    private $facilitiesData;
    private $specializationsMap;
	
	public function __construct()
	{
        $this->searchForm = new SearchForm();
	}

	public function action_homeShow()
	{
		$this->generateView(); 
	}

	public function action_searchFromHome()
	{
		$this->prepareForSearch(); 
		$this->generateSearchView();
	}

    public function prepareForSearch()
    {
		$specialization = ParamUtils::getFromRequest('buttonValue');

		$this->facilitiesData = Utils::getFacilitiesData($specialization);
	}

	private function generateView()
	{
		Utils::getSpecializations($this->searchForm);

		App::getSmarty()->assign('page_title','Nasze specjalizacje');
		App::getSmarty()->assign('facilitiesSpecializations', $this->searchForm->facilitiesSpecializations);
		
		App::getSmarty()->display('homeView.tpl');
	}

	private function generateSearchView()
	{
		Utils::getSpecializations($this->searchForm);
		Utils::getDataForSearchBar($this->searchForm);

		App::getSmarty()->assign('page_title','Wybierz placówkę');
		App::getSmarty()->assign('townsData',$this->searchForm->townsData);
        App::getSmarty()->assign('voivodeshipsData',$this->searchForm->voivodeshipsData);
        App::getSmarty()->assign('specializationsData',$this->searchForm->specializationsData);
        App::getSmarty()->assign('data',$this->facilitiesData);

		App::getSmarty()->display('searchView.tpl');
	}
}