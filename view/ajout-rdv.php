<form class="formAppointments row justify-content-around" action="" method="POST">
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="dateHour" class="form-label">Date et Heure de RDV</label>
        <input type="datetime-local" class="form-control" id="dateHour" name="dateHour" value="<?= (($op =='updateApp') && (!empty($values))) ? substr_replace($values['dateHour'], 'T', 10, 1) : ''; ?>" required>
    </div>

    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="idPatients" class="form-label">Patient</label>
        <select class="form-select" id="idPatients" name="idPatients" required>
            <option selected value="<?= (($op =='updateApp' || $op= 'addAppForPat') && (!empty($values))) ? $values['idPatients'] : ''; ?>"><?= (($op =='updateApp' || $op= 'addAppForPat') && (!empty($values))) ? $values['lastname'] . ' ' . $values['firstname'] : ''; ?></option>
            <?php foreach ($patients as $patient) {
                echo '<option value="' . $patient['id'] . '">' . $patient['lastname'] . ' ' . $patient['firstname'] . '</option>';
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-1 col-6">Enregistrer</button>
</form>