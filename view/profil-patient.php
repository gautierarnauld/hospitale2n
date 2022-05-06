<div class="row justify-content-center align-items-start">
  <div class="card col-md-5 col-12 m-2">
    <ul class="list-group list-group-flush">
      <li class="list-group-item card-entete fs-4">Informations personnelles</li>
      <li class="list-group-item"><i class="fa-solid fa-user"></i><span class="ms-3"><?= htmlspecialchars($dataPatient['firstname']) ?> <?= htmlspecialchars($dataPatient['lastname']) ?></span></li>
      <li class="list-group-item"><i class="fa-solid fa-cake-candles"></i><span class="ms-3"><?= utf8_encode($dataPatient['birthdateFr']) ?></span></li>
      <li class="list-group-item"><i class="fa-solid fa-phone"></i><span class="ms-3"><?= htmlspecialchars($dataPatient['phone']) ?></span></li>
      <li class="list-group-item"><i class="fa-solid fa-envelope"></i><span class="ms-3"><?= htmlspecialchars($dataPatient['mail']) ?></span></li>
      <li class="list-group-item li-center">
        <a class="btn btn-2 col-5 lh-lg" href="?op=updatePat&id=<?=$dataPatient['id']?>" role="button">Modifier le patient</a>
        <a class="btn btn-3 col-5 lh-lg" href="?op=deletePat&id=<?=$dataPatient['id']?>" role="button">Supprimer le patient</a>
      </li>
    </ul>
  </div>

<div class="card col-md-5 col-12 m-2">
  <ul class="list-group list-group-flush">
    <li class="list-group-item card-entete fs-4">Rendez-vous</li>
    <?php foreach ($dataPatientApps as $dataPatientApp) { ?>
      <li class="list-group-item li-center"><?= utf8_encode($dataPatientApp['dateAppointment']) ?></li>
      <li class="list-group-item li-center">
        <a href="?op=updateApp&id=<?=$dataPatientApp['id']?>" class="btn btn-2 mb-1">Modifier le rdv</a> 
        <a href="?op=deleteApp&id=<?=$dataPatientApp['id']?>" class="btn btn-3 mb-1">Supprimer le rdv</a>
      </li>
    <?php } ?>
    <li class="list-group-item li-center">
        <a href="?op=addAppForPat&id=<?=$dataPatient['id']?>" class="btn btn-1">Nouveau rendez-vous</a> 
    </li>
  </ul>
</div>
</div>