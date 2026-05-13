<?php
include_once '../koneksi.php';
include_once '../models/Studies.php';

$obj = new Studies();
$proses = $_POST['proses'] ?? '';

$nama        = $_POST['nama'] ?? '';
$idlevel     = $_POST['idlevel'] ?? '';
$keterangan  = $_POST['keterangan'] ?? '';
$tahun_lulus = $_POST['tahun_lulus'] ?? '';
$foto_sekolah = $_POST['foto_sekolah'] ?? '';

$data = [$nama, $idlevel, $keterangan, $tahun_lulus, $foto_sekolah];

switch ($proses) {
    case 'simpan':
        $obj->simpan($data);
        break;
    case 'ubah':
        $id = $_POST['idx'] ?? '';
        if (!empty($id)) {
            $data[] = $id;
            $obj->ubah($data);
        }
        break;
    case 'hapus':
        $id = $_POST['id'] ?? '';
        if (!empty($id)) {
            $obj->hapus($id);
        }
        break;
}

header("Location: ../index.php?hal=studies_list");
exit;
