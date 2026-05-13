<?php
class Level
{
    private $koneksi;
    public function __construct()
    {
        global $dbh;
        $this->koneksi = $dbh;
    }

    public function index()
    {
        return $this->koneksi->query("SELECT * FROM level ORDER BY id ASC");
    }

    public function getLevel($id)
    {
        $sql = "SELECT * FROM level WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
        return $ps->fetch(PDO::FETCH_ASSOC);
    }

    public function simpan($data)
    {
        $sql = "INSERT INTO level (nama) VALUES (?)";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute($data);
    }

    public function ubah($data)
    {
        $sql = "UPDATE level SET nama=? WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute($data);
    }

    public function hapus($id)
    {
        $sql = "DELETE FROM level WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute([$id]);
    }
}
