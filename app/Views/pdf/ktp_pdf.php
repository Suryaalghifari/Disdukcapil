<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KTP Digital</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 13px; 
            margin: 0; 
            padding: 0; 
            background: #f9f9f9;
        }
        
        .ktp-card {
            width: 540px;
            height: 340px;
            margin: 20px auto 0 auto;
            border: 2px solid #2c5aa0;
            border-radius: 15px;
            /* Menggunakan warna solid instead of gradient */
            background-color: #4a90e2;
            position: relative;
            overflow: hidden;
            padding: 0;
            box-shadow: 0 4px 8px #cccccc;
        }

        /* Background pattern dengan border saja, tanpa gradient */
        .ktp-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* Menggunakan pattern sederhana yang didukung mPDF */
            background-color: rgba(255,255,255,0.05);
            z-index: 1;
        }

        .ktp-header {
            text-align: center;
            padding: 15px 0 10px 0;
            position: relative;
            z-index: 3;
            background-color: rgba(0,0,0,0.1);
        }

        .ktp-header h1 {
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 2px 0;
        }

        .ktp-header h2 {
            color: white;
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }
        
        .ktp-main-table { 
            width: 100%; 
            height: 260px;
            position: relative;
            z-index: 3;
            padding: 15px 20px 20px 20px;
        }
        
        .ktp-main-table td { 
            vertical-align: top; 
        }
        
        .ktp-info-table {
            width: 100%;
            background-color: rgba(255,255,255,0.95);
            border-radius: 10px;
            padding: 15px;
            border: 1px solid #dddddd;
        }
        
        .ktp-info-table td { 
            padding: 5px 8px; 
            font-size: 13px;
            color: #2c5aa0;
            font-weight: 500;
        }
        
        .label { 
            font-weight: bold; 
            width: 140px;
            color: #1e5f99;
        }

        .separator {
            width: 20px;
            text-align: center;
            font-weight: bold;
            color: #1e5f99;
        }
        
        .gol-darah {
            font-weight: bold; 
            background-color: #2c5aa0;
            color: white;
            padding: 6px 15px; 
            border-radius: 10px; 
            font-size: 12px;
            margin-top: 10px;
            display: inline-block;
            border: 1px solid #1e5f99;
        }
        
        .photo-ttd {
            width: 130px;
            text-align: center;
            padding-left: 20px;
        }
        
        .photo {
            width: 100px; 
            height: 130px;
            border-radius: 10px; 
            border: 3px solid #1e5f99;
            background-color: rgba(255,255,255,0.95);
            overflow: hidden; 
            margin: 0 auto 15px auto;
            display: block;
        }
        
        .photo img {
            width: 100%; 
            height: 100%; 
        }
        
        .signature {
            font-size: 12px; 
            text-align: center; 
            width: 100%; 
            color: white; 
            margin: 0 auto;
        }
        
        .signature .ttd-label {
            margin-bottom: 8px;
            font-weight: bold;
            display: block;
            font-size: 11px;
        }

        .signature .location {
            font-size: 11px;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .signature .ttd-name {
            font-weight: bold;
            border-bottom: 1px solid white;
            padding-bottom: 2px;
            display: inline-block;
            min-width: 80px;
        }

        /* Watermark sederhana tanpa transform yang kompleks */
        .watermark {
            position: absolute;
            top: 45%;
            left: 25%;
            font-size: 24px;
            color: rgba(255,255,255,0.1);
            font-weight: bold;
            z-index: 1;
        }

        /* Styling khusus untuk mPDF */
        table {
            border-collapse: collapse;
        }
        
        /* Menghindari properti CSS3 yang tidak didukung mPDF */
        * {
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="ktp-card">
        <!-- Watermark sederhana -->
        <div class="watermark">REPUBLIK INDONESIA</div>
        
        <div class="ktp-header">
            <h1>PROVINSI DKI JAKARTA</h1>
            <h2>JAKARTA SELATAN</h2>
        </div>
        
        <table class="ktp-main-table">
            <tr>
                <!-- KIRI: Data KTP -->
                <td style="width:67%;">
                    <table class="ktp-info-table">
                        <tr>
                            <td class="label">NIK</td>
                            <td class="separator">:</td>
                            <td><?= esc($nik ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="label">Nama</td>
                            <td class="separator">:</td>
                            <td><?= esc($nama ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="label">Tempat / Tgl Lahir</td>
                            <td class="separator">:</td>
                            <td><?= esc($tempat_lahir ?? '-') ?> / <?= !empty($tanggal_lahir) ? date('d-m-Y', strtotime($tanggal_lahir)) : '-' ?></td>
                        </tr>
                        <tr>
                            <td class="label">Jenis Kelamin</td>
                            <td class="separator">:</td>
                            <td><?= esc($jenis_kelamin ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="label">Alamat</td>
                            <td class="separator">:</td>
                            <td><?= esc($alamat ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="label">RT / RW</td>
                            <td class="separator">:</td>
                            <td><?= esc($rt ?? '-') ?>/<?= esc($rw ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="label">Kelurahan</td>
                            <td class="separator">:</td>
                            <td><?= esc($kelurahan ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="label">Kecamatan</td>
                            <td class="separator">:</td>
                            <td><?= esc($kecamatan ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="label">Agama</td>
                            <td class="separator">:</td>
                            <td><?= esc($agama ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="label">Status</td>
                            <td class="separator">:</td>
                            <td><?= esc($status_perkawinan ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="label">Pekerjaan</td>
                            <td class="separator">:</td>
                            <td><?= esc($pekerjaan ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td class="label">Kewarganegaraan</td>
                            <td class="separator">:</td>
                            <td><?= esc($kewarganegaraan ?? 'WNI') ?></td>
                        </tr>
                        <tr>
                            <td class="label">Berlaku Hingga</td>
                            <td class="separator">:</td>
                            <td><?= esc($berlaku_hingga ?? 'SEUMUR HIDUP') ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <span class="gol-darah">Gol. Darah : <?= esc($gol_darah ?? '-') ?></span>
                            </td>
                        </tr>
                    </table>
                </td>
                <!-- KANAN: Foto & TTD -->
                <td class="photo-ttd">
                    <div class="photo">
                        <?php if (!empty($foto_path)): ?>
                            <img src="<?= base_url($foto_path) ?>" alt="Foto Pemilik KTP">
                        <?php else: ?>
                            <img src="<?= base_url('assets/Frontend/img/boy.png') ?>" alt="Foto Pemilik KTP">
                        <?php endif; ?>
                    </div>
                    <div class="signature">
                        <div class="location">
                            <?= esc($kota ?? 'Donggala') ?>, <?= date('d-m-Y') ?>
                        </div>
                        <div class="ttd-label">Kepala Dinas</div>
                        <?php if (!empty($file_ttd)): ?>
                            <img src="<?= base_url($file_ttd) ?>" style="max-width:80px; max-height:40px; margin-bottom:5px;">
                        <?php else: ?>
                            <div class="ttd-name">(.....................)</div>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
