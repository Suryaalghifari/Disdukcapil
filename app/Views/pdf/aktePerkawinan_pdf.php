<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Akte Perkawinan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }
        .akte-card {
            width: 650px;
            margin: 20px auto;
            border: 2px solid #444;
            border-radius: 18px;
            background-color: #f8fafc;
            padding: 28px 34px;
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
            color: #1976d2;
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
            margin-bottom: 18px;
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
            color: #1976d2;
        }
        .separator {
            width: 16px;
            text-align: center;
            font-weight: bold;
        }
        .akte-watermark {
            position: absolute;
            top: 45%;
            left: 18%;
            font-size: 32px;
            color: rgba(25, 118, 210, 0.09);
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
            <h2>AKTE PERKAWINAN</h2>
            <div style="color:#222; font-size:12px; font-weight:normal;">
                Nomor: <?= esc($nomor_akte ?? '-') ?>
            </div>
        </div>

        <table class="akte-info-table">
            <tr>
                <td class="label">Nama Suami</td>
                <td class="separator">:</td>
                <td><?= esc($nama_suami ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">NIK Suami</td>
                <td class="separator">:</td>
                <td><?= esc($nik_suami ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Tempat, Tgl Lahir Suami</td>
                <td class="separator">:</td>
                <td><?= esc($tempat_lahir_suami ?? '-') ?>, <?= !empty($tanggal_lahir_suami) ? date('d-m-Y', strtotime($tanggal_lahir_suami)) : '-' ?></td>
            </tr>
            <tr>
                <td class="label">Agama Suami</td>
                <td class="separator">:</td>
                <td><?= esc($agama_suami ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Alamat Suami</td>
                <td class="separator">:</td>
                <td><?= esc($alamat_suami ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Nama Istri</td>
                <td class="separator">:</td>
                <td><?= esc($nama_istri ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">NIK Istri</td>
                <td class="separator">:</td>
                <td><?= esc($nik_istri ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Tempat, Tgl Lahir Istri</td>
                <td class="separator">:</td>
                <td><?= esc($tempat_lahir_istri ?? '-') ?>, <?= !empty($tanggal_lahir_istri) ? date('d-m-Y', strtotime($tanggal_lahir_istri)) : '-' ?></td>
            </tr>
            <tr>
                <td class="label">Agama Istri</td>
                <td class="separator">:</td>
                <td><?= esc($agama_istri ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Alamat Istri</td>
                <td class="separator">:</td>
                <td><?= esc($alamat_istri ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal Perkawinan</td>
                <td class="separator">:</td>
                <td><?= !empty($tanggal_perkawinan) ? date('d-m-Y', strtotime($tanggal_perkawinan)) : '-' ?></td>
            </tr>
            <tr>
                <td class="label">Tempat Perkawinan</td>
                <td class="separator">:</td>
                <td><?= esc($tempat_perkawinan ?? '-') ?></td>
            </tr>
        </table>

        <div class="akte-footer">
            Tanggal Pencatatan: <?= !empty($tanggal_pencatatan) ? date('d-m-Y', strtotime($tanggal_pencatatan)) : '-' ?>
        </div>

        <div class="signature-block">
            <div class="jabatan">Kepala Dinas</div>
            <div class="nama-ttd">( ................................ )</div>
        </div>
    </div>
</body>
</html>
