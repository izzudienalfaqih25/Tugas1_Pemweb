<?php
if (!isset($_SESSION['MEMBER'])) {
    echo '<div class="alert alert-warning"><i class="bi bi-lock-fill"></i> Anda harus <a href="index.php?hal=login">login</a> terlebih dahulu.</div>';
    return;
}
$id = $_GET['id'] ?? null;
$objS = new Studies();
$objL = new Level();
$rs_level = $objL->index();

if ($id) {
    $row = $objS->getStudies($id);
} else {
    $row = [];
}
function valS($r, $k) { return isset($r[$k]) ? $r[$k] : ''; }
?>

<div class="container mt-2">
    <h4><i class="bi bi-journal-bookmark-fill text-info"></i> Form Studies</h4>
    <form method="POST" action="controller/studiesController.php">

        <div class="mb-3">
            <label class="form-label">Nama Sekolah/Kampus</label>
            <input type="text" name="nama" class="form-control"
                value="<?= valS($row, 'nama') ?>" required placeholder="Contoh: SDN 01 Jakarta">
        </div>

        <div class="mb-3">
            <label class="form-label">Level (Jenjang)</label>
            <select name="idlevel" class="form-select" required>
                <option value="">-- Pilih Level --</option>
                <?php foreach ($rs_level as $lv) {
                    $sel = (valS($row, 'idlevel') == $lv['id']) ? 'selected' : '';
                ?>
                    <option value="<?= $lv['id'] ?>" <?= $sel ?>><?= $lv['nama'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="2"
                placeholder="Keterangan singkat"><?= valS($row, 'keterangan') ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Lulus</label>
            <input type="number" name="tahun_lulus" class="form-control"
                value="<?= valS($row, 'tahun_lulus') ?>" placeholder="Contoh: 2020" min="1990" max="2099">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Sekolah (nama file)</label>
            <input type="text" name="foto_sekolah" class="form-control"
                value="<?= valS($row, 'foto_sekolah') ?>" placeholder="Contoh: sdn01.jpg">
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
        <a href="index.php?hal=studies_list" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </form>
</div>
