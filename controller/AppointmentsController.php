<?php

namespace controller;

use model\PatientsRepository;
use model\AppointmentsRepository;


class AppointmentsController
{
    private $dbAppointmentsRepository;
    private $dbPatientsforAppRepository;

    public function __construct()
    {
        $this->dbAppointmentsRepository = new AppointmentsRepository;
        $this->dbPatientsforAppRepository = new PatientsRepository;
    }

    public function handleRequest()
    {
        if (isset($_GET['op']))
        {
            $op = $_GET['op'];
        } else {
            $op = NULL;
        }

        try{
            if($op =='addApp' || $op == 'updateApp' || $op == 'addAppForPat')
            {
                $this->save($op);

            } elseif ($op =='selectApp')
            {
                $this->select();

            } elseif ($op == 'deleteApp')
            {
                $this->delete();
            } elseif ($op == 'selectAllApp')
            {
                $this->selectAll();
            }

        }
        catch (\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function render($layout, $template, $parameters = array())
    {
        extract($parameters);
        ob_start();
        require_once "view/$template";
        $content = ob_get_clean();
        ob_start();
        require_once "view/$layout";
        return ob_end_flush();
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
    }

    public function selectAll()
    {
        $this->render('layout.php', 'liste-rendezvous.php', [
            'title' => 'Tous les rendez-vous', 
            'dataApps' => $this->dbAppointmentsRepository->selectAllAppointmentsRepository()
        ]);
    }

    public function select()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = NULL;
        }

        $this->render('layout.php', 'rendezvous.php', [
            'title' => "Détails du rendez-vous n° $id",
            'dataApp' => $this ->dbAppointmentsRepository->selectAppointmentRepository($id),
        ]);
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = NULL;
        }
        $this->dbAppointmentsRepository->deleteAppointmentRepository($id);
        $this->redirect('index.php');
    }

    public function save($op)
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = NULL;
        }

        if ($op == 'updateApp') {
            $values = $this->dbAppointmentsRepository->selectAppointmentRepository($id);
            $patients = $this->dbPatientsforAppRepository->selectAllPatientsRepository();
            $title = "Modification du Rendez-vous";
        }
        elseif ($op == 'addAppForPat')
        {
            $values = $this->dbPatientsforAppRepository->selectPatientRepository($id);
            $patients = $this->dbPatientsforAppRepository->selectAllPatientsRepository();
            $title = "Création du Rendez-vous";
        } 
        else
        {
            $values = '';
            $patients = $this->dbPatientsforAppRepository->selectAllPatientsRepository();
            $title = 'Création de Rendez-vous';
        }

        if (!empty($_POST) && $op == 'updateApp')
        {
            $this->dbAppointmentsRepository->updateAppointmentRepository($_POST['dateHour'], $_POST['idPatients'], $id);
            $this->redirect('index.php?op=selectApp&id=' . $id);
        } 
        elseif (!empty($_POST) && $op == 'addApp')
        {
            $this->dbAppointmentsRepository->addAppointmentRepository($_POST['dateHour'], $_POST['idPatients']);
            $id = $this->dbAppointmentsRepository->selectLastAppointmentRepository()['id'];
            $this->redirect('index.php?op=selectApp&id=' . $id);
        }

        if (!empty($_POST) && $op == 'addAppForPat')
        {
            $this->dbAppointmentsRepository->addAppointmentRepository($_POST['dateHour'], $_GET['id']);
            $this->redirect('index.php?op=selectPat&id=' . $_GET['id']);
        }

        $this->render('layout.php', 'ajout-rdv.php', [
            'title' => $title, 
            'op' => $op, 
            'values' => $values,
            'patients' => $patients
        ]);
    }
}