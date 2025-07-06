<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Kartu Identitas Anak (KIA)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0; padding: 0;
            background: #f9f9f9;
        }
        .kia-card {
            width: 650px;
            margin: 20px auto;
            border: 2px solid #444;
            border-radius: 18px;
            background-color: #f8fafc;
            padding: 28px 34px;
            box-shadow: 0 4px 12px #dddddd;
            position: relative;
        }
        .kia-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #b9b9b9;
            padding-bottom: 8px;
        }
        .kia-header h1 {
            font-size: 1.25rem;
            color: #2563eb;
            margin: 0 0 2px 0;
            letter-spacing: 1.5px;
        }
        .kia-header h2 {
            font-size: 1.1rem;
            color: #222;
            margin: 0 0 8px 0;
            letter-spacing: 1.2px;
        }
        .kia-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
            background: #fff;
            border-radius: 10px;
        }
        .kia-info-table td {
            padding: 6px 10px;
            font-size: 13px;
            color: #343a40;
        }
        .label {
            width: 180px;
            font-weight: bold;
            color: #2563eb;
        }
        .separator {
            width: 16px;
            text-align: center;
            font-weight: bold;
        }
        .kia-watermark {
            position: absolute;
            top: 45%;
            left: 18%;
            font-size: 32px;
            color: rgba(37, 99, 235, 0.08);
            font-weight: bold;
            z-index: 0;
            transform: rotate(-10deg);
            letter-spacing: 5px;
        }
        .kia-footer {
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
    <div class="kia-card">
        <div class="kia-watermark">REPUBLIK INDONESIA</div>
        <div class="kia-header">
            <h1>DINAS KEPENDUDUKAN &amp; CATATAN SIPIL</h1>
            <h2>KARTU IDENTITAS ANAK (KIA)</h2>
            <div style="color:#222; font-size:12px; font-weight:normal;">
                Nomor: <?= esc($nomor_kia ?? '-') ?>
            </div>
        </div>

        <table class="kia-info-table">
            <tr>
                <td class="label">Nama Anak</td>
                <td class="separator">:</td>
                <td><?= esc($nama_anak ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">NIK Anak</td>
                <td class="separator">:</td>
                <td><?= esc($nik_anak ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Tempat, Tanggal Lahir</td>
                <td class="separator">:</td>
                <td><?= esc($tempat_lahir ?? '-') ?>, <?= !empty($tanggal_lahir) ? date('d-m-Y', strtotime($tanggal_lahir)) : '-' ?></td>
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
                <td class="label">Nama Ayah</td>
                <td class="separator">:</td>
                <td><?= esc($nama_ayah ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">NIK Ayah</td>
                <td class="separator">:</td>
                <td><?= esc($nik_ayah ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Nama Ibu</td>
                <td class="separator">:</td>
                <td><?= esc($nama_ibu ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">NIK Ibu</td>
                <td class="separator">:</td>
                <td><?= esc($nik_ibu ?? '-') ?></td>
            </tr>
        </table>

        <div class="kia-footer">
            Tanggal Pengajuan: <?= !empty($tanggal_pengajuan) ? date('d-m-Y', strtotime($tanggal_pengajuan)) : '-' ?>
        </div>

        <div class="signature-block">
            <div class="jabatan">Kepala Dinas</div>
            <div class="nama-ttd">( ................................ )</div>
        </div>
    </div>
</body>
</html>
