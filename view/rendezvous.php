<div class="row justify-content-center align-items-start">
  <div class="card col-md-5 col-12 m-2">
    <ul class="list-group list-group-flush">
      <li class="list-group-item li-center"><i class="fa-solid fa-clock"></i><span class="ms-3"><?= htmlspecialchars($dataApp['dateAppointment']) ?></span></li>
      <li class="list-group-item li-center"><i class="fa-solid fa-user"></i><span class="ms-3"><?= htmlspecialchars($dataApp['firstname']) ?> <?= htmlspecialchars($dataApp['lastname']) ?></span></li>
      <li class="list-group-item li-center"><i class="fa-solid fa-phone"></i><span class="ms-3"><?= htmlspecialchars($dataApp['phone']) ?></span></li>
      <li class="list-group-item li-center"><i class="fa-solid fa-envelope"></i><span class="ms-3"><?= htmlspecialchars($dataApp['mail']) ?></span></li>
      <li class="list-group-item li-center">
        <a class="btn btn-2 col-5 lh-lg" href="?op=updateApp&id=<?=$dataApp['id_appointment']?>" role="button">Modifier</a>
      </li>
    </ul>
  </div>
</div>