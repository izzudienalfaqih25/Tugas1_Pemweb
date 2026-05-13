<?php
$obj = new Studies();
$rs = $obj->index();
?>

<div class="container mt-2">
    <h4><i class="bi bi-journal-bookmark-fill text-info"></i> Data Studies (Riwayat Pendidikan)</h4>
    <?php if (isset($_SESSION['MEMBER'])) { ?>
        <a href="index.php?hal=studies_form" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Tambah Studies
        </a>
    <?php } ?>
    <table class="table table-striped table-bordered">
        <thead class="table-info">
            <tr>
                <th width="4%">No</th>
                <th>Nama Sekolah/Kampus</th>
                <th>Level</th>
                <th>Keterangan</th>
                <th>Tahun Lulus</th>
                <th>Foto</th>
                <?php if (isset($_SESSION['MEMBER'])) { ?>
                    <th width="18%">Aksi</th>
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
                        <td><?= htmlspecialchars($row['nama_level']) ?></td>
                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                        <td><?= $row['tahun_lulus'] ?></td>
                        <td>
                            <?php if (!empty($row['foto_sekolah'])) { ?>
                                <img src="img/<?= $row['foto_sekolah'] ?>" width="60" />
                            <?php } else { ?>
                                <img src="img/nophoto.jpg" width="60" />
                            <?php } ?>
                        </td>
                        <?php if (isset($_SESSION['MEMBER'])) { ?>
                            <td>
                                <a href="index.php?hal=studies_detail&id=<?= $row['id'] ?>"
                                    class="btn btn-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="index.php?hal=studies_form&id=<?= $row['id'] ?>"
                                    class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <?php if ($_SESSION['MEMBER']['role'] == 'admin') { ?>
                                    <form method="POST" action="controller/studiesController.php" style="display:inline;">
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
                    <td colspan="<?= isset($_SESSION['MEMBER']) ? 7 : 6 ?>" class="text-center">Data belum tersedia</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>