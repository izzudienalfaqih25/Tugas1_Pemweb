<?php
$obj = new Level();
$rs = $obj->index();
?>

<div class="container mt-2">
    <h4><i class="bi bi-layers-fill text-warning"></i> Data Level</h4>
    <?php if (isset($_SESSION['MEMBER'])) { ?>
        <a href="index.php?hal=level_form" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Tambah Level
        </a>
    <?php } ?>
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th width="5%">No</th>
                <th>Nama Level</th>
                <?php if (isset($_SESSION['MEMBER'])) { ?>
                    <th width="20%">Aksi</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rs)) {
                $no = 1;
                foreach ($rs as $row) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <?php if (isset($_SESSION['MEMBER'])) { ?>
                            <td>
                                <a href="index.php?hal=level_detail&id=<?= $row['id'] ?>"
                                    class="btn btn-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="index.php?hal=level_form&id=<?= $row['id'] ?>"
                                    class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <?php if ($_SESSION['MEMBER']['role'] == 'admin') { ?>
                                    <form method="POST" action="controller/levelController.php" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="proses" value="hapus"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                <?php } ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="<?= isset($_SESSION['MEMBER']) ? 3 : 2 ?>" class="text-center">Data belum tersedia</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>