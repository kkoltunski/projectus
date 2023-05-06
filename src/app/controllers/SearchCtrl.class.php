<?php

namespace app\controllers;

use app\forms\SearchForm;

use core\App;
use core\Utils;

class SearchCtrl 
{
    private $facilitiesData;
    private $searchForm;

	public function __construct(){
        $this->searchForm = new SearchForm();
	}

	public function action_searchShow()
    {
        $this->facilitiesData = Utils::getWholeFacilitiesData();
		$this->generateView();
	}

    private function generateView(){
		Utils::getDataForSearchBar($this->searchForm);

		App::getSmarty()->assign('page_title','Wybierz placówke');
		App::getSmarty()->assign('townsData',$this->searchForm->townsData);
        App::getSmarty()->assign('voivodeshipsData',$this->searchForm->voivodeshipsData);
        App::getSmarty()->assign('specializationsData',$this->searchForm->specializationsData);
        App::getSmarty()->assign('data',$this->facilitiesData);

		App::getSmarty()->display('searchView.tpl');
	}
}
