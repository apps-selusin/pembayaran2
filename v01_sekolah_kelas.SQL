create view v01_sekolah_kelas as
SELECT a.id AS kelas_id,
  b.Nama AS sekolah_nama,
  a.Nama AS kelas_nama
FROM t02_kelas a
  LEFT JOIN t01_sekolah b ON a.sekolah_id = b.id
