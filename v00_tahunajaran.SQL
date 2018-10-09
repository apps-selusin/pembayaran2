create view v00_tahunajaran as
SELECT t00_tahunajaran.id AS id,
  t00_tahunajaran.awal_bulan AS awal_bulan,
  t00_tahunajaran.awal_tahun AS awal_tahun,
  t00_tahunajaran.akhir_bulan AS akhir_bulan,
  t00_tahunajaran.akhir_tahun AS akhir_tahun,
  Concat(t00_tahunajaran.awal_tahun, ' / ', t00_tahunajaran.akhir_tahun) AS
  tahun_pelajaran
FROM t00_tahunajaran
