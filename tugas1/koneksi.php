<?php
$dsn  = 'mysql:host=localhost;port=3306;charset=utf8mb4';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buat database jika belum ada, lalu pilih
    $dbh->exec("CREATE DATABASE IF NOT EXISTS `dbpersonal` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $dbh->exec("USE `dbpersonal`");

    // Buat tabel member
    $dbh->exec("CREATE TABLE IF NOT EXISTS `member` (
        `id`       int(11)          NOT NULL AUTO_INCREMENT,
        `username` varchar(50)      NOT NULL,
        `password` varchar(100)     NOT NULL,
        `role`     enum('admin','staff') NOT NULL DEFAULT 'staff',
        PRIMARY KEY (`id`),
        UNIQUE KEY `username` (`username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Seed member jika kosong
    $cek = $dbh->query("SELECT COUNT(*) FROM member")->fetchColumn();
    if ($cek == 0) {
        $dbh->exec("INSERT INTO member (username, password, role) VALUES
            ('admin',  SHA1(MD5('admin123')), 'admin'),
            ('ijud',  SHA1(MD5('ijud123')), 'admin'),
            ('gipa',  SHA1(MD5('gipa123')), 'admin'),
            ('staff1', SHA1(MD5('staff123')), 'staff')");
    }

    // Buat tabel level
    $dbh->exec("CREATE TABLE IF NOT EXISTS `level` (
        `id`   int(11)     NOT NULL AUTO_INCREMENT,
        `nama` varchar(30) NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Seed level jika kosong
    $cek = $dbh->query("SELECT COUNT(*) FROM level")->fetchColumn();
    if ($cek == 0) {
        $dbh->exec("INSERT INTO level (nama) VALUES
            ('TK'),('SD'),('SMP'),('SMA'),('D3'),('S1')");
    }

    // Buat tabel studies
    $dbh->exec("CREATE TABLE IF NOT EXISTS `studies` (
        `id`           int(11)      NOT NULL AUTO_INCREMENT,
        `nama`         varchar(100) NOT NULL,
        `idlevel`      int(11)      NOT NULL,
        `keterangan`   text         DEFAULT NULL,
        `tahun_lulus`  int(4)       DEFAULT NULL,
        `foto_sekolah` varchar(50)  DEFAULT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`idlevel`) REFERENCES `level`(`id`) ON DELETE RESTRICT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Seed studies jika kosong
    $cek = $dbh->query("SELECT COUNT(*) FROM studies")->fetchColumn();
    if ($cek == 0) {
        $dbh->exec("INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus, foto_sekolah) VALUES
            ('TK Harapan Bangsa', 1, 'Pendidikan dasar anak usia dini', 2009, NULL),
            ('SDN 01 Jakarta',    2, 'Sekolah Dasar Negeri terbaik di kecamatan', 2015, NULL),
            ('SMPN 02 Jakarta',   3, 'Lulus dengan nilai memuaskan', 2018, NULL),
            ('SMAN 03 Jakarta',   4, 'Jurusan IPA, Ekskul: Robotik dan Paskibra', 2021, NULL),
            ('Universitas Contoh',6, 'Program Studi Teknik Informatika', NULL, 'sttnf.png')");
    }

} catch (PDOException $e) {
    echo 'Terjadi kesalahan koneksi dengan sebab ' . $e->getMessage();
}
?>
