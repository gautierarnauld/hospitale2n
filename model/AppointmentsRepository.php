<?php

namespace model; 

class AppointmentsRepository 
{
    private $db; 
    public $table;
    public $tablePat;

    public function getDb()
    {
        if(!$this->db)
        {
            try
            {
                $xml = simplexml_load_file('app/config.xml');
                $this->table = $xml->tableAppointments;
                $this->tablePat = $xml->tablePatients;

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

    public function selectAllAppointmentsRepository()
    {
        $data = $this->getDb()->query('SELECT lastname, firstname, birthdate, phone, mail, appointments.id AS id_appointment, dateHour, DATE_FORMAT(dateHour, "%d %M %Y - %kh%i") AS dateAppointment, idPatients FROM ' . $this->tablePat . ' INNER JOIN ' . $this->table . ' ON ' . $this->table . '.idPatients = ' . $this->tablePat . '.id ORDER BY dateHour');
        $response = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }

    public function selectAppointmentRepository($id)
    {
        $data = $this->getDb()->query('SELECT lastname, firstname, birthdate, phone, mail, appointments.id AS id_appointment, dateHour, DATE_FORMAT(dateHour, "%d %M %Y - %kh%i") AS dateAppointment, idPatients FROM ' . $this->tablePat . ' INNER JOIN ' . $this->table . ' ON ' . $this->table . '.idPatients = ' . $this->tablePat . '.id WHERE ' . $this->table . '.id =' .(int) $id);
        $response = $data->fetch();
        return $response;
    }

    public function selectPatientAppointmentRepository($id)
    {
        $data = $this->getDb()->query('SELECT lastname, firstname, birthdate, phone, mail, appointments.id, dateHour, DATE_FORMAT(dateHour, "%d %M %Y - %kh%i") AS dateAppointment, idPatients FROM ' . $this->tablePat . ' INNER JOIN ' . $this->table . ' ON ' . $this->table . '.idPatients = ' . $this->tablePat . '.id WHERE idPatients = '.(int) $id . ' ORDER BY dateHour');
        $response = $data->fetchAll(\PDO::FETCH_ASSOC);
        return $response;
    }    

    public function deleteAppointmentRepository($id)
    {
        $this->getDb()->query("DELETE FROM " . $this->table . " WHERE id = " . (int) $id);
    }

    public function deletePatientAppointmentsRepository($id)
	{
		$this->getDb()->query('DELETE FROM appointments WHERE idPatients = ' . (int) $id);
	}

    public function addAppointmentRepository($dateHour, $idPatients)
    {
        $request = $this->getDb()->prepare('INSERT INTO ' . $this->table . '(dateHour, idPatients) VALUES (?, ?)');
        $request->execute(array($dateHour, $idPatients));
    }

    public function updateAppointmentRepository($dateHour, $idPatients, $id)
    {
        $request = $this->getDb()->prepare("UPDATE " . $this->table . " SET dateHour = ?, idPatients = ? WHERE id = ?");
        $request->execute(array($dateHour, $idPatients, $id));
    }

    public function selectLastAppointmentRepository()
    {
        $data = $this->getDb()->query('SELECT id FROM ' . $this->table . ' ORDER BY id DESC LIMIT 0, 1');
        $response = $data->fetch();
        return $response;
    }

}