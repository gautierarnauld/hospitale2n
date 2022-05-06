<form method="GET" class="input-group mb-1">
  <input type="search" class="form-control" name="search" placeholder="Recherche par nom ou prénom" aria-label="Recherche" aria-describedby="basic-addon2">
  <input type="hidden" name="op" value="selectAllPat">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
  </div>
</form>

<?php 
if(isset($_GET['search']))
{
    echo "<a style='text-decoration: none;' href='index.php?op=selectAllPat'>$reset</a>";
}
?>

<table class="table table-bordered text-center mt-4 liste-patients">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Voir</th>
            <th>Modif</th>
            <th>Suppr</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($dataPatients as $dataPatient) { ?>
        <tr>
            <td><a class="patlink" href="index.php?op=selectPat&id=<?= $dataPatient['id']?>"><?= htmlspecialchars($dataPatient['lastname']) ?></a></td>
            <td><a class="patlink" href="index.php?op=selectPat&id=<?= $dataPatient['id']?>"><?= htmlspecialchars($dataPatient['firstname']) ?></a></td>
            <td><a href="?op=selectPat&id=<?=$dataPatient['id']?>" class="btn btn-1"><i class="fas fa-eye"></i></a></td>
            <td><a href="?op=updatePat&id=<?=$dataPatient['id']?>" class="btn btn-2"><i class="fas fa-edit"></i></a></td>
            <td><a href="?op=deletePat&id=<?=$dataPatient['id']?>" class="btn btn-3"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination my-3 justify-content-center">
        <li class="page-item <?php if ($page <= 1) { echo 'disabled'; } ?>">
            <a class="page-link" href="?op=selectAllPat<?php if(isset($_GET['search'])) { echo "&search=".htmlspecialchars($_GET['search']); } ?>&page=<?php echo $page - 1; ?>">
                <i class="fas fa-angle-left" aria-hidden="true"></i>
            </a>
        </li>
        <li class="page-item disabled" >
            <span class="page-link" >Page <?= $page ?> sur <?= $nbPages ?></span>
        </li>
        <li class="page-item <?php if ($page == $nbPages) { echo 'disabled'; } ?>">
            <a class="page-link" href="?op=selectAllPat<?php if(isset($_GET['search'])) { echo "&search=".htmlspecialchars($_GET['search']); } ?>&page=<?php echo $page + 1; ?>">
                <i class="fas fa-angle-right" aria-hidden="true"></i>
            </a>
        </li>
    </ul>
</nav>