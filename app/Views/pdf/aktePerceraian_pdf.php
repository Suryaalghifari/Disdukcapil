<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Akte Perceraian</title>
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
            color: #e67e22;
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
            width: 180px;
            font-weight: bold;
            color: #e67e22;
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
            color: rgba(230, 126, 34, 0.08);
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
            <h2>AKTE PERCERAIAN</h2>
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
                <td class="label">Nomor Akte Perkawinan</td>
                <td class="separator">:</td>
                <td><?= esc($nomor_perkawinan ?? '-') ?></td>
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
            <tr>
                <td class="label">Tanggal Perceraian</td>
                <td class="separator">:</td>
                <td><?= !empty($tanggal_perceraian) ? date('d-m-Y', strtotime($tanggal_perceraian)) : '-' ?></td>
            </tr>
            <tr>
                <td class="label">Tempat Perceraian</td>
                <td class="separator">:</td>
                <td><?= esc($tempat_perceraian ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Penyebab Perceraian</td>
                <td class="separator">:</td>
                <td><?= esc($penyebab_perceraian ?? '-') ?></td>
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
