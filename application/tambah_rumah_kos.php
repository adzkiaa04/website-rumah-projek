<?php
session_start(); // Mulai sesi
include 'db.php';

$alert = ""; // Inisialisasi variabel alert

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_rumah = $_POST['nama_rumah'];
    $harga = $_POST['harga'];
    $nomor_kontak = $_POST['nomor_kontak'];
    $alamat = $_POST['alamat'];
    $kamar_tidur = $_POST['kamar_tidur'];
    $kamar_mandi = $_POST['kamar_mandi'];
    $luas_rumah = $_POST['luas_rumah'];
    $user_id = $_SESSION['user_id']; // Ambil user_id dari sesi

    // Handle file upload
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $gambar_name = $_FILES['gambar']['name'];
        $gambar_tmp = $_FILES['gambar']['tmp_name'];
        $gambar_path = 'uploads/' . $gambar_name;

        // Move uploaded file to uploads folder
        if (move_uploaded_file($gambar_tmp, $gambar_path)) {
            // Insert data into database using prepared statements
            $sql = "INSERT INTO rumah_kos (nama_rumah, harga, nomor_kontak, alamat, kamar_tidur, kamar_mandi, luas_rumah, gambar, user_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssssi", $nama_rumah, $harga, $nomor_kontak, $alamat, $kamar_tidur, $kamar_mandi, $luas_rumah, $gambar_name, $user_id);

            if ($stmt->execute()) {
                $alert = "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data rumah kos berhasil ditambahkan!'
                                }).then(() => {
                                    window.location='rumah_kos.php';
                                });
                            });
                        </script>";
            } else {
                $alert = "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Terjadi kesalahan: " . addslashes($stmt->error) . "'
                                });
                            });
                        </script>";
            }
            $stmt->close();
        } else {
            $alert = "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Gagal mengupload gambar!'
                            });
                        });
                    </script>";
        }
    } else {
        $alert = "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Tidak ada gambar yang diupload atau terjadi kesalahan saat upload!'
                        });
                    });
                </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rumah Kos</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
       body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../Assets/img/bgtambah.png'); /* Ganti dengan path gambar Anda */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9); /* Tambahkan transparansi agar gambar terlihat */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-container h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .form-group .input-group {
            flex: 1 1 calc(50% - 10px);
            min-width: 200px;
        }
        .form-container label {
            font-weight: 500;
            display: block;
            margin-top: 15px;
            color: #555;
        }
        .form-container input {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        .form-container input:focus {
            border-color: rgb(4, 83, 107);
            outline: none;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
        }
        .form-container button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, rgb(4, 95, 148), rgb(1, 181, 222));
            color: white;
            border: none;
            border-radius: 8px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background 0.3s ease;
        }
        .form-container button:hover {
            background: linear-gradient(135deg, rgb(8, 118, 172), rgb(4, 108, 183));
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #0056b3;
        }
        .file-input {
            position: relative;
            overflow: hidden;
            margin-top: -10px;
        }
        .file-input input[type="file"] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: pointer;
            display: block;
        }
        .file-input label {
            display: block;
            padding: 10px;
            background: rgb(9, 118, 148);
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            color: #ffffff;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .file-input label:hover {
            background: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Rumah Kos</h2>
        <form action="tambah_rumah_kos.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>"> <!-- Kirim user_id -->
            <div class="form-group">
                <div class="input-group">
                    <label>Nama Rumah Kos:</label>
                    <input type="text" name="nama_rumah" required>
                </div>
                <div class="input-group">
                    <label>Harga:</label>
                    <input type="text" name="harga" required>
                </div>
                <div class="input-group">
                    <label>Nomor Kontak:</label>
                    <input type="text" name="nomor_kontak" required>
                </div>
                <div class="input-group">
                    <label>Alamat:</label>
                    <input type="text" name="alamat" required>
                </div>
                <div class="input-group">
                    <label>Kamar Tidur:</label>
                    <input type="number" name="kamar_tidur" min="1" required>
                </div>
                <div class="input-group">
                    <label>Kamar Mandi:</label>
                    <input type="number" name="kamar_mandi" min="1" required>
                </div>
                <div class="input-group">
                    <label>Luas Rumah (m<sup>2</sup>):</label>
                    <input type="number" name="luas_rumah" min="1" required>
                </div>
                <div class="input-group">
                    <label>Gambar:</label>
                    <div class="file-input">
                        <input type="file" name="gambar" accept="image/*" required>
                        <label for="gambar">Pilih Gambar</label>
                    </div>
                </div>
            </div>
            <button type="submit">Tambah Rumah Kos</button>
        </form>
        <a href="rumah_kos.php" class="back-link">Kembali</a>
    </div>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?= $alert; ?> <!-- SweetAlert muncul setelah HTML termuat -->
</body>
</html>