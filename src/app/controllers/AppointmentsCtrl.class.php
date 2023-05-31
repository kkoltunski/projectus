<?php

namespace app\controllers;

use app\forms\SearchForm;

use core\App;
use core\Utils;
use core\ParamUtils;

class AppointmentsCtrl{
    private $appointmentsData;
    private $doctorsData;
    private $scheduleData;
	
	public function __construct()
	{
        // $this->doctorsData = new FacilitySelectionCtrl();
        // $this->scheduleData = new ScheduleSelectionCtrl();
	}

	public function action_appointments()
	{ 
        // Pobieramy dane doktorów
        // $facilitySelectionCtrl = new FacilitySelectionCtrl();
        // $facilityRegon = ParamUtils::getFromRequest('buttonValue');
        // $this->doctorsData = $facilitySelectionCtrl->getHiredDoctors($facilityRegon);

        // Pobieramy harmonogram przyjęć
        // $scheduleSelectionCtrl = new ScheduleSelectionCtrl();
        // $this->scheduleData = $scheduleSelectionCtrl->getScheduleData();
        $this->appointmentsData = $this->getAppointmentsData();
		$this->generateView(); 
	}

    private function getAppointmentsData()
    {

        $data = [
            [
                'name' => 'Jan',
                'surname' => 'Kowal',
                'date' => '2023-06-05',
                'time' => '09:00'
            ]
        ];

        return $data;

        // $appointmentsData = [];

        // foreach ($this->doctorsData as $doctor) {
        //     foreach ($this->scheduleData as $schedule) {
        //         $appointment = [
        //             'name' => $doctor['name'],
        //             'surname' => $doctor['surname'],
        //             'date' => $schedule['date'],
        //             'time' => $schedule['time']
        //         ];

        //         $appointmentsData[] = $appointment;
        //     }
        // }

        // return $appointmentsData;
    }

	private function generateView()
	{
		App::getSmarty()->assign('page_title','Umówione wizyty lekarskie');
		App::getSmarty()->assign('data', $this->appointmentsData);
	    // App::getSmarty()->assign('data', $this->getAppointmentsData());
		App::getSmarty()->display('appointmentsView.tpl');
	}
}