<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTP Digital Preview</title>
    <style>
    body { font-family: Arial, sans-serif; }
    .ktp-card {
        width: 480px;
        height: 305px;
        border-radius: 18px;
        box-shadow: 0 0 12px #0002;
        padding: 24px 32px;
        color: #111;
        font-size: 16px;
        position: relative;
        overflow: hidden;
    }
    .ktp-title { font-weight: bold; letter-spacing: 2px; margin-bottom: 8px; font-size: 20px; }
    .ktp-card table { width: 100%; }
    .ktp-card td { padding: 1px 4px; vertical-align: top; font-size: 16px; }
    .gol-darah { position: absolute; right: 40px; top: 90px; font-size: 16px; }
    .photo {
        position: absolute; right: 32px; bottom: 24px;
        width: 70px; height: 92px; background: #eee; border: 2px solid #888;
    }
    .signature {
        position: absolute; right: 32px; bottom: 18px;
        font-size: 12px; text-align: center; width: 120px;
    }
    </style>
</head>
<body>
<div class="ktp-card" style="background: url('<?= $bg_ktp ?>') no-repeat center center/cover; background-size:cover;">
    <div class="ktp-title">PROVINSI SULAWESI TENGAH<br>KABUPATEN DONGGALA</div>
    <table>
        <tr><td style="width:120px;">NIK</td><td>:</td><td><?= esc($nik) ?></td></tr>
        <tr><td>Nama</td><td>:</td><td><?= esc($nama) ?></td></tr>
        <tr><td>Tempat/Tgl Lahir</td><td>:</td><td><?= esc($tempat_lahir) ?> / <?= date('d-m-Y', strtotime($tanggal_lahir)) ?></td></tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td><?= esc($jenis_kelamin) ?></td></tr>
        <tr><td>Alamat</td><td>:</td><td><?= esc($alamat) ?></td></tr>
        <tr><td style="padding-left:18px;">RT/RW</td><td>:</td><td><?= esc($rt) ?>/<?= esc($rw) ?></td></tr>
        <tr><td style="padding-left:18px;">Kel/Desa</td><td>:</td><td><?= esc($kelurahan) ?></td></tr>
        <tr><td style="padding-left:18px;">Kecamatan</td><td>:</td><td><?= esc($kecamatan) ?></td></tr>
        <tr><td>Agama</td><td>:</td><td><?= esc($agama) ?></td></tr>
        <tr><td>Status Perkawinan</td><td>:</td><td><?= esc($status_perkawinan) ?></td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td><?= esc($pekerjaan) ?></td></tr>
        <tr><td>Kewarganegaraan</td><td>:</td><td>WNI</td></tr>
        <tr><td>Berlaku Hingga</td><td>:</td><td>SEUMUR HIDUP</td></tr>
    </table>
    <div class="gol-darah">Gol. Darah : <?= esc($gol_darah ?? '-') ?></div>
    <div class="photo"></div>
    <div class="signature">
        Donggala,<br><?= date('d-m-Y') ?><br>
        <br><br>
        <b>Kepala Dinas</b>
        <br><br><br>
        <b>(........................)</b>
    </div>
</div>
</body>
</html>
