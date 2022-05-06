<?php

use controller\AppointmentsController;
use controller\PatientsController;

require_once('autoload.php');

$patientsController = new PatientsController;
$patientsController->handleRequest();

$appointmentsController = new AppointmentsController;
$appointmentsController->handleRequest();