<?php

namespace controller;

use Exception;
use model\PatientsRepository;
use model\AppointmentsRepository;


class PatientsController
{
    private $dbPatientsRepository;
    private $dbAppForPatientsRepository;

    public function __construct()
    {
        $this->dbPatientsRepository = new PatientsRepository;
        $this->dbAppForPatientsRepository = new AppointmentsRepository;
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
            if($op =='addPat' || $op == 'updatePat')
            {
                $this->save($op);

            } elseif ($op =='selectPat')
            {
                $this->select();

            } elseif ($op == 'deletePat')
            {
                $this->delete();
            } elseif ($op == 'selectAllPat')
            {
                $this->selectAll();
            } elseif ($op == 'addPatAndApp')
            {
                $this->addPatAndApp();
            } elseif ($op == NULL)
            {
                $this->welcome();
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

    public function welcome()
    {
        $this->render('layout.php', 'accueil.php', [
            'title' => 'Bienvenue sur CRUD Hospital'
        ]);
    }

    public function selectAll()
    {
        if(!isset($_GET['page']) || $_GET['page'] <=0)
        {
            $page = 1;
        } else
        {
            $page = $_GET['page'];
        }

        $limitStart = ($page - 1) * 10;
        $limitNb = 10;

        if(isset($_GET['search']))
        {
            $count = $this->dbPatientsRepository->countSearchPatientsRepository($_GET['search']);
        }else
        {
            $count = $this->dbPatientsRepository->countPatientsRepository();
        }

        if($count > 1)
        {
            $nbPages = ceil($count / $limitNb);
        }else
        {
            $nbPages = 1;
        }

        if($page <= $nbPages)
        {
            if (!isset($_GET['search']))
            {
                $dataPatients = $this->dbPatientsRepository->selectPageAllPatientsRepository($limitStart, $limitNb);
                $title = 'Tous les patients';
                $reset = '';
            } else
            {
                $dataPatients = $this->dbPatientsRepository->searchPagePatientsRepository($_GET['search'], $limitStart, $limitNb);
                $title = 'Résultat de la recherche : "' . $_GET['search'] . '"';
                $reset = 'Réinitialiser la recherche : tous les patients';
            }
        }else
        {
            throw new Exception("Ce contenu est indisponible");
        }

        $this->render('layout.php', 'liste-patients.php', [
            'title' => $title, 
            'reset' => $reset,
            'dataPatients' => $dataPatients,
            'page' => $page,
            'nbPages' => $nbPages,
        ]);
    }

    public function select()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = NULL;
        }

        $this->render('layout.php', 'profil-patient.php', [
            'title' => "Profil du patient",
            'dataPatient' => $this->dbPatientsRepository->selectPatientRepository($id),
            'dataPatientApps' => $this->dbAppForPatientsRepository->selectPatientAppointmentRepository($id),
        ]);
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = NULL;
        }
        $this->dbAppForPatientsRepository->deletePatientAppointmentsRepository($id);
        $this->dbPatientsRepository->deletePatientRepository($id);
        $this->redirect('index.php');
    }

    public function save($op)
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = NULL;
        }

        if ($op == 'updatePat') {
            $values = $this->dbPatientsRepository->selectPatientRepository($id);
            $title = 'Modification du Patient';
        } else {
            $values = '';
            $title = 'Création de Patient';
        }

        if (!empty($_POST) && $op == 'updatePat') {
            $this->dbPatientsRepository->updatePatientRepository($_POST['lastname'], $_POST['firstname'], $_POST['birthdate'], $_POST['phone'], $_POST['mail'], $id);
            $this->redirect('index.php?op=selectPat&id='. $id);
        } elseif (!empty($_POST) && $op == 'addPat') {
            $this->dbPatientsRepository->addPatientRepository($_POST['lastname'], $_POST['firstname'], $_POST['birthdate'], $_POST['phone'], $_POST['mail']);
            $id = $this->dbPatientsRepository->selectPatientToAddPatientAndAppRepository()['id'];
            $this->redirect('index.php?op=selectPat&id='. $id);
        } 

        $this->render('layout.php', 'ajout-patient.php', [
            'title' => $title, 
            'op' => $op, 
            'values' => $values,
        ]);
    }

    public function addPatAndApp()
    {
        if(!empty($_POST))
        {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $birthdate = $_POST['birthdate'];
            $phone = $_POST['phone'];
            $mail = $_POST['mail'];
            $dateHour = $_POST['dateHour'];

            $this->dbPatientsRepository->addPatientToAddPatientAndAppRepository($lastname, $firstname, $birthdate, $phone, $mail);
            // var_dump($this->dbPatientsRepository->selectPatientToAddPatientAndAppRepository()['id']);
            $id = $this->dbPatientsRepository->selectPatientToAddPatientAndAppRepository()['id'];
            $this->dbAppForPatientsRepository->addAppointmentRepository($dateHour, $id);
            $this->redirect('index.php?op=selectPat&id='. $id);
        }

        $this->render('layout.php', 'ajout-patient-rendez-vous.php', [
            'title' => "Création d'un patient avec un rendez-vous", 
        ]);
    }
}