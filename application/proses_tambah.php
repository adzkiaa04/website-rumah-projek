<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis = $_POST["jenis"];
    $nama_rumah = $_POST["nama_rumah"];
    $harga = $_POST["harga"];
    $nomor_kontak = $_POST["nomor_kontak"];
    $alamat = $_POST["alamat"];
    $kamar_tidur = $_POST["kamar_tidur"];
    $kamar_mandi = $_POST["kamar_mandi"];
    $luas_rumah = $_POST["luas_rumah"];

    // Upload Gambar
    $gambar = $_FILES["gambar"]["name"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

    // Query Insert
    $sql = "INSERT INTO $jenis (nama_rumah, harga, nomor_kontak, alamat, kamar_tidur, kamar_mandi, luas_rumah, gambar, created_at) 
            VALUES ('$nama_rumah', '$harga', '$nomor_kontak', '$alamat', '$kamar_tidur', '$kamar_mandi', '$luas_rumah', '$gambar', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                setTimeout(function() {
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data rumah berhasil ditambahkan.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'property_baru.php';
                    });
                }, 100);
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menambahkan data.',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi'
                });
              </script>";
    }
}
?>
<!-- Tambahkan SweetAlert2 -->
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
