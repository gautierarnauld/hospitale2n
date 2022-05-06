<form class="formPatients row justify-content-around" action="" method="POST">
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="lastname" class="form-label">Nom</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom" required>
    </div>
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="lastname" name="firstname" placeholder="Prénom" required>
    </div>
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="birthdate" class="form-label">Date de Naissance</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
    </div>
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="phone" class="form-label">Téléphone</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Téléphone" required>
    </div>
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="mail" class="form-label">Email</label>
        <input type="email" class="form-control" id="mail" name="mail" placeholder="Email" required>
    </div>
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="dateHour" class="form-label">Date et Heure de RDV</label>
        <input type="datetime-local" class="form-control" id="dateHour" name="dateHour" required>
    </div>
    <button type="submit" class="btn btn-1 col-6">Enregistrer</button>

</form>