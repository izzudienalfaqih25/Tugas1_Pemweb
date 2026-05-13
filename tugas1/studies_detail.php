<?php
if (!isset($_SESSION['MEMBER'])) {
    echo '<div class="alert alert-warning"><i class="bi bi-lock-fill"></i> Anda harus <a href="index.php?hal=login">login</a> terlebih dahulu.</div>';
    return;
}
$id = $_GET['id'] ?? null;
$obj = new Studies();
$row = $obj->getStudies($id);
?>

<div class="container mt-2">
    <h4><i class="bi bi-journal-bookmark-fill text-info"></i> Detail Studies</h4>
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4 text-center p-3">
                <?php if (!empty($row['foto_sekolah'])) { ?>
                    <img src="img/<?= $row['foto_sekolah'] ?>" class="img-fluid rounded" alt="Foto Sekolah">
                <?php } else { ?>
                    <img src="img/nophoto.jpg" class="img-fluid rounded" alt="No Photo">
                <?php } ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr><th>ID</th><td><?= $row['id'] ?></td></tr>
                        <tr><th>Nama</th><td><?= htmlspecialchars($row['nama']) ?></td></tr>
                        <tr><th>Level</th><td><?= htmlspecialchars($row['nama_level']) ?></td></tr>
                        <tr><th>Keterangan</th><td><?= htmlspecialchars($row['keterangan']) ?></td></tr>
                        <tr><th>Tahun Lulus</th><td><?= $row['tahun_lulus'] ?></td></tr>
                    </table>
                    <a href="index.php?hal=studies_list" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
