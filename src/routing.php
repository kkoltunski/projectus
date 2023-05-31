<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('homeShow');
App::getRouter()->setLoginRoute('loginShow');

Utils::addRoute('homeShow', 'HomeCtrl');
Utils::addRoute('searchFromHome', 'HomeCtrl');

// patient registration
Utils::addRoute('registrationShow', 'RegistrationCtrl');
Utils::addRoute('registration', 'RegistrationCtrl');

//logging managment
Utils::addRoute('loginShow', 'LoginCtrl');
Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl', ['user', 'admin']);

// searching and filtering
Utils::addRoute('processFiltering', 'FilteringCtrl');
Utils::addRoute('searchShow', 'SearchCtrl');

// facility selection
Utils::addRoute('facilitySelected', 'FacilitySelectionCtrl');

// schedule selection
Utils::addRoute('scheduleSelected', 'ScheduleSelectionCtrl');
Utils::addRoute('scheduleApproved', 'ScheduleSelectionCtrl', ['user', 'admin']);
Utils::addRoute('appointments', 'AppointmentsCtrl', ['user', 'admin']);