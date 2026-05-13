<?php
class Studies
{
    private $koneksi;
    public function __construct()
    {
        global $dbh;
        $this->koneksi = $dbh;
    }

    public function index()
    {
        $sql = "SELECT studies.*, level.nama AS nama_level
                FROM studies INNER JOIN level ON level.id = studies.idlevel
                ORDER BY studies.id DESC";
        return $this->koneksi->query($sql);
    }

    public function getStudies($id)
    {
        $sql = "SELECT studies.*, level.nama AS nama_level
                FROM studies INNER JOIN level ON level.id = studies.idlevel
                WHERE studies.id = ?";
        $ps = $this->koneksi->prepare($sql);
        $ps->execute([$id]);
        return $ps->fetch(PDO::FETCH_ASSOC);
    }

    public function simpan($data)
    {
        $sql = "INSERT INTO studies (nama, idlevel, keterangan, tahun_lulus, foto_sekolah) VALUES (?,?,?,?,?)";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute($data);
    }

    public function ubah($data)
    {
        $sql = "UPDATE studies SET nama=?, idlevel=?, keterangan=?, tahun_lulus=?, foto_sekolah=? WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute($data);
    }

    public function hapus($id)
    {
        $sql = "DELETE FROM studies WHERE id=?";
        $ps = $this->koneksi->prepare($sql);
        return $ps->execute([$id]);
    }
}
