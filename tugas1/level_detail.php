<?php
if (!isset($_SESSION['MEMBER'])) {
    echo '<div class="alert alert-warning"><i class="bi bi-lock-fill"></i> Anda harus <a href="index.php?hal=login">login</a> terlebih dahulu.</div>';
    return;
}
$id = $_GET['id'] ?? null;
$obj = new Level();
$row = $obj->getLevel($id);
?>

<div class="container mt-2">
    <h4><i class="bi bi-layers-fill text-warning"></i> Detail Level</h4>
    <table class="table table-bordered">
        <tr>
            <th width="30%">ID</th>
            <td><?= $row['id'] ?></td>
        </tr>
        <tr>
            <th>Nama Level</th>
            <td><?= htmlspecialchars($row['nama']) ?></td>
        </tr>
    </table>
    <a href="index.php?hal=level_list" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>
