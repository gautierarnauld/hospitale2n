<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>Date et heure de rdv</th>
            <th>Patient</th>
            <th>Voir</th>
            <th>Modif</th>
            <th>Suppr</th>
        </tr>
    </thead>


    <?php foreach ($dataApps as $dataApp) { ?>
        <tr>
            <td><a class="patlink" href="index.php?op=selectApp&id=<?= $dataApp['id_appointment']?>"><?= utf8_encode($dataApp['dateAppointment']) ?></a></td>
            <td><a class="patlink" href="index.php?op=selectPat&id=<?= $dataApp['idPatients']?>"><?= htmlspecialchars($dataApp['firstname']) ?> <?= htmlspecialchars($dataApp['lastname']) ?></a></td>
            <td><a href="?op=selectApp&id=<?=$dataApp['id_appointment']?>" class="btn btn-1"><i class="fas fa-eye"></i></a></td>
            <td><a href="?op=updateApp&id=<?=$dataApp['id_appointment']?>" class="btn btn-2"><i class="fas fa-edit"></i></a></td>
            <td><a href="?op=deleteApp&id=<?=$dataApp['id_appointment']?>" class="btn btn-3"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
    <?php } ?>
</table>