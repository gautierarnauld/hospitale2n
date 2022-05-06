<?php

namespace model; 

class PatientsRepository 
{
    private $db; 
    public $table;
    public $tableApp;

    public function getDb()
    {
        if(!$this->db)
        {
            try
            {
                $xml = simplexml_load_file('app/config.xml');
                $this->table = $xml->tablePatients;
                $this->tableApp = $xml->tableAppointments;

                try
                {
                    $this->db = new \PDO("mysql:host=" . $xml->host . ";dbname=" . $xml->db, $xml->user, $xml->password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
                    $this->db->query("SET lc_time_names = 'fr_FR'");
                }
                catch (\PDOException $e)
                {
                    echo "ERREUR : " . $e->getMessage();
                }
            }
            catch (\Exception $e){
            }
        }
        return $this->db;
    }

    public function selectAllPatientsRepository()
    {
        $data = $this->getDb()->query("SELECT * FROM $this->table ORDER BY lastname, firstname");
        $response = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }

    public function selectPageAllPatientsRepository($limitStart, $limitNb)
    {
        $data = $this->getDb()->query("SELECT * FROM $this->table ORDER BY lastname, firstname LIMIT $limitStart, $limitNb");
        $response = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }

    public function selectPatientRepository($id)
    {
        $data = $this->getDb()->query('SELECT id, id AS idPatients, lastname, firstname, birthdate, DATE_FORMAT(birthdate, "%e %M %Y") AS birthdateFr, phone, mail FROM ' . $this->table . ' WHERE id = ' .(int) $id);
        $response = $data->fetch();
        return $response;
    }

    public function searchPagePatientsRepository($search, $limitStart, $limitNb)
    {
        $data = $this->getDb()->query("SELECT * FROM $this->table WHERE lastname LIKE '%$search%' OR firstname LIKE '%$search%' LIMIT $limitStart, $limitNb");
        $response = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }

    public function countPatientsRepository()
    {
        $data = $this->getDb()->query("SELECT COUNT(*) FROM $this->table");
        $response = $data->fetchColumn();
        return $response;
    }

    public function countSearchPatientsRepository($search)
    {
        $data = $this->getDb()->query("SELECT COUNT(*) FROM $this->table WHERE lastname LIKE '%$search%' OR firstname LIKE '%$search%'");
        $response = $data->fetchColumn();
        return $response;
    }

    public function deletePatientRepository($id)
    {
        $this->getDb()->query("DELETE FROM " . $this->table . " WHERE id = " . (int) $id);
    }

    public function addPatientRepository($lastname, $firstname, $birthdate, $phone, $mail)
    {
        $request = $this->getDb()->prepare('INSERT INTO ' . $this->table . '(lastname, firstname, birthdate, phone, mail) VALUES (?, ?, ?, ?, ?)');
        $request->execute(array($lastname, $firstname, $birthdate, $phone, $mail));
    }

    public function updatePatientRepository($lastname, $firstname, $birthdate, $phone, $mail, $id)
    {
        $request = $this->getDb()->prepare("UPDATE " . $this->table . " SET lastname = ?, firstname = ?, birthdate = ?, phone = ?, mail = ? WHERE id = ?");
        $request->execute(array($lastname, $firstname, $birthdate, $phone, $mail, $id));
    }

    public function addPatientToAddPatientAndAppRepository($lastname, $firstname, $birthdate, $phone, $mail)
    {
        $request = $this->getDb()->prepare('INSERT INTO ' . $this->table . '(lastname, firstname, birthdate, phone, mail) VALUES (?, ?, ?, ?, ?)');
        $request->execute(array($lastname, $firstname, $birthdate, $phone, $mail));
    }

    public function selectPatientToAddPatientAndAppRepository()
    {
        $data = $this->getDb()->query('SELECT id FROM ' . $this->table . ' ORDER BY id DESC LIMIT 0, 1');
        $response = $data->fetch();
        return $response;
    }
    
}