<?php

namespace app\controllers;

use app\forms\SearchForm;

use core\App;
use core\Utils;
use core\ParamUtils;

class ScheduleSelectionCtrl{
    private $scheduleData;
	
	public function __construct()
	{
	}

	public function action_scheduleSelected()
	{
		$schedule = ParamUtils::getFromRequest('buttonValue');
        $this->scheduleData = $this->getScheduleData($schedule);
		
        $this->generateView();

	}

    public function action_scheduleApproved()
    {
        Utils::addInfoMessage('Zarejestrowano się na wizytę.');
        App::getRouter()->forwardTo("homeShow");
    }

    public function getScheduleData()
    {
        $data = [
            [
                'date' => '2023-06-05',
                'time' => '09:00'
            ],
            [
                'date' => '2023-06-06',
                'time' => '10:00'
            ],
            [
                'date' => '2023-06-07',
                'time' => '18:30'
            ],
            [
                'date' => '2023-06-08',
                'time' => '14:30'
            ]
        ];

        return $data;
    }

	private function generateView()
	{
		App::getSmarty()->assign('page_title','Harmonogram Przyjęć');
		App::getSmarty()->assign('data', $this->scheduleData);
		App::getSmarty()->display('scheduleOverview.tpl');
	}
}