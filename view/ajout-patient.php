<form class="formPatients row justify-content-around" action="" method="POST">
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="lastname" class="form-label">Nom</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?= (($op =='updatePat') && (!empty($values))) ? $values['lastname'] : ''; ?>" required>
    </div>
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="lastname" name="firstname" value="<?= (($op =='updatePat') && (!empty($values))) ? $values['firstname'] : ''; ?>" required>
    </div>
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="birthdate" class="form-label">Date de Naissance</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= (($op =='updatePat') && (!empty($values))) ? $values['birthdate'] : ''; ?>" required>
    </div>
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="phone" class="form-label">Téléphone</label>
        <input type="tel" class="form-control" id="phone" name="phone" value="<?= (($op =='updatePat') && (!empty($values))) ? $values['phone'] : ''; ?>" required>
    </div>
    <div class="mb-3 col-lg-9 col-xl-7">
        <label for="mail" class="form-label">Email</label>
        <input type="email" class="form-control" id="mail" name="mail" value="<?= (($op =='updatePat') && (!empty($values))) ? $values['mail'] : ''; ?>" required>
    </div>
    <button type="submit" class="btn btn-1 col-6">Enregistrer</button>
</form>