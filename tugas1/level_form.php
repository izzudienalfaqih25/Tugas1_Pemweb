<?php
if (!isset($_SESSION['MEMBER'])) {
    echo '<div class="alert alert-warning"><i class="bi bi-lock-fill"></i> Anda harus <a href="index.php?hal=login">login</a> terlebih dahulu.</div>';
    return;
}
$id = $_GET['id'] ?? null;
$obj = new Level();
if ($id) {
    $row = $obj->getLevel($id);
} else {
    $row = [];
}
function valL($r, $k) { return isset($r[$k]) ? $r[$k] : ''; }
?>

<div class="container mt-2">
    <h4><i class="bi bi-layers-fill text-warning"></i> Form Level</h4>
    <form method="POST" action="controller/levelController.php">
        <div class="mb-3">
            <label class="form-label">Nama Level</label>
            <input type="text" name="nama" class="form-control"
                value="<?= valL($row, 'nama') ?>" required placeholder="Contoh: TK, SD, SMP, SMA, S1">
        </div>
        <?php if (empty($id)) { ?>
            <button class="btn btn-primary" name="proses" value="simpan">
                <i class="bi bi-save"></i> Simpan
            </button>
        <?php } else { ?>
            <button class="btn btn-success" name="proses" value="ubah">
                <i class="bi bi-check-circle"></i> Ubah
            </button>
            <input type="hidden" name="idx" value="<?= $id ?>">
        <?php } ?>
        <a href="index.php?hal=level_list" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </form>
</div>
