<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Akte Kematian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }
        .akte-card {
            width: 600px;
            margin: 20px auto;
            border: 2px solid #444;
            border-radius: 18px;
            background-color: #f8fafc;
            padding: 24px 28px;
            box-shadow: 0 4px 12px #dddddd;
            position: relative;
        }
        .akte-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #b9b9b9;
            padding-bottom: 8px;
        }
        .akte-header h1 {
            font-size: 1.25rem;
            color: #e11d48;
            margin: 0 0 2px 0;
            letter-spacing: 1.5px;
        }
        .akte-header h2 {
            font-size: 1.1rem;
            color: #222;
            margin: 0 0 8px 0;
            letter-spacing: 1.2px;
        }
        .akte-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            background: #fff;
            border-radius: 10px;
        }
        .akte-info-table td {
            padding: 6px 10px;
            font-size: 13px;
            color: #343a40;
        }
        .label {
            width: 170px;
            font-weight: bold;
            color: #e11d48;
        }
        .separator {
            width: 16px;
            text-align: center;
            font-weight: bold;
        }
        .akte-watermark {
            position: absolute;
            top: 45%;
            left: 16%;
            font-size: 32px;
            color: rgba(220, 38, 38, 0.09);
            font-weight: bold;
            z-index: 0;
            transform: rotate(-10deg);
            letter-spacing: 5px;
        }
        .akte-footer {
            margin-top: 25px;
            font-size: 13px;
            color: #555;
            text-align: right;
        }
        .pelapor-info {
            margin-top: 15px;
            background: #f1f5f9;
            border-radius: 10px;
            padding: 12px;
        }
        .pelapor-title {
            font-size: 13px;
            color: #e11d48;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .signature-block {
            margin-top: 24px;
            text-align: right;
            font-size: 12px;
        }
        .signature-block .jabatan {
            font-weight: bold;
        }
        .signature-block .nama-ttd {
            margin-top: 40px;
            font-weight: bold;
            letter-spacing: 1px;
            border-bottom: 1px dotted #bbb;
            display: inline-block;
            min-width: 100px;
        }
    </style>
</head>
<body>
    <div class="akte-card">
        <div class="akte-watermark">REPUBLIK INDONESIA</div>
        <div class="akte-header">
            <h1>DINAS KEPENDUDUKAN &amp; CATATAN SIPIL</h1>
            <h2>SURAT AKTE KEMATIAN</h2>
            <div style="color:#222; font-size:12px; font-weight:normal;">
                Nomor: <?= esc($nomor_akte ?? '-') ?>
            </div>
        </div>

        <table class="akte-info-table">
    <tr>
        <td class="label">Nama Almarhum</td>
        <td class="separator">:</td>
        <td><?= esc($nama_meninggal ?? '-') ?></td>
    </tr>
    <tr>
        <td class="label">NIK Almarhum</td>
        <td class="separator">:</td>
        <td><?= esc($nik_meninggal ?? '-') ?></td>
    </tr>
    <tr>
        <td class="label">Tempat Kematian</td>
        <td class="separator">:</td>
        <td><?= esc($tempat_meninggal ?? '-') ?></td>
    </tr>
    <tr>
        <td class="label">Tanggal Kematian</td>
        <td class="separator">:</td>
        <td><?= !empty($tanggal_meninggal) ? date('d-m-Y', strtotime($tanggal_meninggal)) : '-' ?></td>
    </tr>
    <tr>
        <td class="label">Jenis Kelamin</td>
        <td class="separator">:</td>
        <td><?= esc($jenis_kelamin ?? '-') ?></td>
    </tr>
    <tr>
        <td class="label">Agama</td>
        <td class="separator">:</td>
        <td><?= esc($agama ?? '-') ?></td>
    </tr>
    <tr>
        <td class="label">Alamat</td>
        <td class="separator">:</td>
        <td><?= esc($alamat ?? '-') ?></td>
    </tr>
    <tr>
        <td class="label">Sebab Kematian</td>
        <td class="separator">:</td>
        <td><?= esc($penyebab_kematian ?? '-') ?></td>
    </tr>
</table>

<div class="pelapor-info">
    <div class="pelapor-title">Data Pelapor:</div>
    <table style="width:100%;">
        <tr>
            <td class="label">Nama Pelapor</td>
            <td class="separator">:</td>
            <td><?= esc($nama_pelapor ?? '-') ?></td>
        </tr>
        <tr>
            <td class="label">NIK Pelapor</td>
            <td class="separator">:</td>
            <td><?= esc($nik_pelapor ?? '-') ?></td>
        </tr>
        <tr>
            <td class="label">Hubungan Pelapor</td>
            <td class="separator">:</td>
            <td><?= esc($hubungan_pelapor ?? '-') ?></td>
        </tr>
    </table>
</div>

        <div class="akte-footer">
            Dicatat di: <?= esc($tempat_pencatatan ?? 'Kantor Disdukcapil') ?> <br>
            Tanggal Pencatatan: <?= !empty($tanggal_pencatatan) ? date('d-m-Y', strtotime($tanggal_pencatatan)) : '-' ?>
        </div>

        <div class="signature-block">
            <div class="jabatan">Kepala Dinas</div>
            <div class="nama-ttd">( ................................ )</div>
        </div>
    </div>
</body>
</html>
