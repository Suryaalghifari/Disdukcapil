<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Pindah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }
        .surat-card {
            width: 650px;
            margin: 20px auto;
            border: 2px solid #444;
            border-radius: 18px;
            background-color: #f8fafc;
            padding: 28px 34px;
            box-shadow: 0 4px 12px #dddddd;
            position: relative;
        }
        .surat-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #b9b9b9;
            padding-bottom: 8px;
        }
        .surat-header h1 {
            font-size: 1.25rem;
            color: #059669;
            margin: 0 0 2px 0;
            letter-spacing: 1.5px;
        }
        .surat-header h2 {
            font-size: 1.1rem;
            color: #222;
            margin: 0 0 8px 0;
            letter-spacing: 1.2px;
        }
        .surat-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
            background: #fff;
            border-radius: 10px;
        }
        .surat-info-table td {
            padding: 6px 10px;
            font-size: 13px;
            color: #343a40;
        }
        .label {
            width: 190px;
            font-weight: bold;
            color: #059669;
        }
        .separator {
            width: 16px;
            text-align: center;
            font-weight: bold;
        }
        .surat-watermark {
            position: absolute;
            top: 45%;
            left: 18%;
            font-size: 32px;
            color: rgba(5, 150, 105, 0.08);
            font-weight: bold;
            z-index: 0;
            transform: rotate(-10deg);
            letter-spacing: 5px;
        }
        .surat-footer {
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
    <div class="surat-card">
        <div class="surat-watermark">REPUBLIK INDONESIA</div>
        <div class="surat-header">
            <h1>DINAS KEPENDUDUKAN &amp; CATATAN SIPIL</h1>
            <h2>SURAT KETERANGAN PINDAH</h2>
            <div style="color:#222; font-size:12px; font-weight:normal;">
                Nomor: <?= esc($nomor_pindah ?? '-') ?>
            </div>
        </div>

        <table class="surat-info-table">
            <tr>
                <td class="label">Nama Pemohon</td>
                <td class="separator">:</td>
                <td><?= esc($nama_pemohon ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">NIK Pemohon</td>
                <td class="separator">:</td>
                <td><?= esc($nik_pemohon ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Alamat Asal</td>
                <td class="separator">:</td>
                <td>
                    <?= esc($alamat_asal ?? '-') ?>, Kel. <?= esc($kelurahan_asal ?? '-') ?>, Kec. <?= esc($kecamatan_asal ?? '-') ?>, <?= esc($kabupaten_asal ?? '-') ?>, <?= esc($provinsi_asal ?? '-') ?>
                </td>
            </tr>
            <tr>
                <td class="label">Alamat Tujuan</td>
                <td class="separator">:</td>
                <td>
                    <?= esc($alamat_tujuan ?? '-') ?>, Kel. <?= esc($kelurahan_tujuan ?? '-') ?>, Kec. <?= esc($kecamatan_tujuan ?? '-') ?>, <?= esc($kabupaten_tujuan ?? '-') ?>, <?= esc($provinsi_tujuan ?? '-') ?>
                </td>
            </tr>
            <tr>
                <td class="label">Alasan Pindah</td>
                <td class="separator">:</td>
                <td><?= esc($alasan_pindah ?? '-') ?></td>
            </tr>
            <tr>
                <td class="label">Jumlah Anggota yang Pindah</td>
                <td class="separator">:</td>
                <td><?= esc($jumlah_anggota_pindah ?? '-') ?> orang</td>
            </tr>
        </table>

        <div class="surat-footer">
            Tanggal Pengajuan: <?= !empty($tanggal_pengajuan) ? date('d-m-Y', strtotime($tanggal_pengajuan)) : '-' ?>
        </div>

        <div class="signature-block">
            <div class="jabatan">Kepala Dinas</div>
            <div class="nama-ttd">( ................................ )</div>
        </div>
    </div>
</body>
</html>
