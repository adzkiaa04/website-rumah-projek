<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: application/login.php');
    exit();
}
include 'application/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- My Style -->
    <link rel="stylesheet" href="css/style.css" />

    <!-- Logo Title Bar -->
    <link rel="icon" href="Assets/img/logo.png" type="image/x-icon" />

    <title>Rumah Project</title>

    <style>
        .custom-search-container {
            display: flex;
            align-items: center;
            background: white;
            padding: 20px;
            border-radius: 60px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
            max-width: 1000px;
            width: 100%;
            margin: 30px auto;
            transition: box-shadow 0.3s ease;
        }

        .custom-search-container:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .custom-search-container .custom-dropdown {
            background-color: #f8f9fa;
            color: #333;
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            appearance: none;
            position: relative;
            padding-left: 10px;
            margin-right: 15px;
            display: flex;
            align-items: center; /* Pusatkan vertikal */
            justify-content: center; /* Pusatkan horizontal */
            text-align: center; /* Pastikan teks rata tengah */
        }

        .custom-search-container .custom-dropdown:hover {
            background-color: #e9ecef;
        }

        .custom-search-container .custom-search-input {
            flex-grow: 1;
            border: none;
            outline: none;
            padding: 12px 15px;
            font-size: 16px;
            color: #555;
            background-color: #f8f9fa;
            border-radius: 50px;
            transition: all 0.3s ease;
            margin-right: 15px;
            margin-left:15px; /* Memberikan jarak antar elemen */
        }

        .custom-search-container .custom-search-input:focus {
            background-color: #fff;
            border: 1px solid #28a745;
        }

        .custom-search-container .custom-search-button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border-radius: 50px;
            padding: 12px;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: -5px;
        }

        .custom-search-container .custom-search-button:hover {
            background-color: #218838;
            transform: scale(1.1);
        }

        /* Custom Dropdown Icon */
        .custom-dropdown-wrapper {
            position: relative;
        }

        .custom-dropdown-wrapper select {
            padding-right: 40px;
        }

        .custom-dropdown-wrapper::after {
            content: "\f078"; /* FontAwesome icon */
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            pointer-events: none;
        }

        /* Floating Label Effect */
        .custom-input-container {
            position: relative;
            width: 100%;
        }

        .custom-input-container input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 50px;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
        }

        .custom-input-container label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            background: white;
            padding: 0 5px;
            color: #999;
            font-size: 14px;
            transition: 0.3s;
        }

        .custom-input-container input:focus + label,
        .custom-input-container input:not(:placeholder-shown) + label {
            top: 5px;
            font-size: 12px;
            color: #28a745;
        }

        .card-container {
            display: flex; /* Menggunakan flexbox */
            flex-wrap: wrap; /* Membungkus kartu jika tidak muat dalam satu baris */
            justify-content: center; /* Menempatkan kartu di tengah */
            gap: 20px; /* Jarak antar kartu */
            max-width: 1200px; /* Lebar maksimum */
            margin: 20px auto; /* Margin atas dan bawah, dan auto untuk tengah */
        }

        .card {
            position: relative;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px; /* Lebar kartu */
            height: 430px; /* Tinggi kartu */
            transition: background-color 0.3s ease, transform 0.3s ease;
            padding: 10px;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            background-color: #103434;
            transform: translateY(-5px);
            color: white;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content h3 {
            margin: 0;
            font-size: 1.5em;
            color: black;
        }

        .card:hover h3 {
            color: yellow; /* Warna judul berubah jadi kuning */
        }

        .card-content {
            font-size: 15px;
            font-weight: bold; /* Membuat teks menjadi bold */
            flex-grow: 1;
            padding: 3px;
            overflow-y: auto;
            max-height: 300px;
        }
        .card-content p {
            margin: 0 0 8px 0; /* Jarak bawah untuk paragraf (alamat, nomor kontak) */
        }

        .card-footer {
    display: flex; /* Menggunakan flexbox */
    justify-content: space-between; /* Menjaga jarak antar elemen */
    align-items: center; /* Menjaga elemen tetap sejajar secara vertikal */
    padding: 8px 15px; /* Padding diperkecil */
    background-color: #f9f9f9; /* Warna latar belakang footer */
    border-top: 1px solid #eee; /* Garis atas footer */
    flex-shrink: 0; /* Mencegah footer menyusut */
    min-height: 50px; /* Tinggi minimum diperkecil */
    font-size: 14px; /* Ukuran font diperkecil */
}

        .card:hover .card-footer {
            color: black;
        }

        .add-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #28a745;
            color: white;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 20px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-fixed w-100">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="Assets/img/logo.png" alt="" width="30" class="d-inline-block align-text-top" />
                Rumah Project
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="#">BERANDA</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#" id="layanan-link">LAYANAN</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" onclick="scrollToSearch()">CARI</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="https://wa.me/6283831098061?text=Halo,%20saya%20tertarik%20dengan%20layanan%20Rumah%20Project">KONTAK</a>
                    </li>
                </ul>
            </div>
            <button class="button-secondary" onclick="window.location.href='application/login.php'">KELUAR</button>
        </div>
    </nav>

    <section id="hero">
  <div class="container">
    <div class="hero-tagline">
      <h1>Membantumu mendapatkan rumah <br> yang kamu inginkan.</h1>
      <p>
        <span class="fw-bold">Rumah Project</span> adalah sebuah website
        yang dirancang untuk membantu masyarakat  dalam mencari dan
        menemukan rumah impian mereka dengan mudah dan cepat. Melalui
        platform ini, pengguna dapat mengakses berbagai informasi mengenai rumah yang tersedia, mulai dari lokasi, harga, tipe, hingga fasilitas yang ditawarkan.
      </p>
      <button class="button-lg-primary" onclick="scrollToSearch()">Temukan Rumah</button>
    </div>
    <img
      src="Assets/img/Hero Image.png"
      alt="Gambar Rumah Modern"
      class="img-hero"
    />
  </div>
</section>


    <!-- Layanan Section -->
    <section id="layanan">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Layanan Kami</h2>
                    <span class="sub-title">
                        Rumah Project hadir menjadi solusi bagi masyarakat
                    </span>
                </div>
            </div>

            <div class="row mt-5">
                <!-- Property Baru -->
                <div class="col-md-3 text-center">
                    <a href="application/property_baru.php" class="text-decoration-none text-dark">
                        <div class="card-layanan">
                            <div class="circle-icon position-relative mx-auto">
                                <img src="Assets/img/Icon-propertybaru.png" alt="" class="position-absolute top-50 start-50 translate-middle" />
                            </div>
                            <h3 class="mt-4">Property Baru</h3>
                            <p class="mt-3">
                                Rumah Project akan membuat mimpimu menjadi nyata. Beli rumah baru dengan fasilitas terbaik dan lingkungan yang nyaman.
                            </p>
                        </div>
                    </a>
                </div>

                <!-- Sewa Rumah -->
                <div class="col-md-3 text-center">
                    <a href="application/sewa_rumah.php" class="text-decoration-none text-dark">
                        <div class="card-layanan">
                            <div class="circle-icon position-relative mx-auto">
                                <img src="Assets/img/Icon Sewa.png" alt="" class="position-absolute top-50 start-50 translate-middle" />
                            </div>
                            <h3 class="mt-4">Rumah Sewa</h3>
                            <p class="mt-3">
                                Rumah Project menyediakan sewa rumah nyaman dan strategis cocok untuk tempat tinggal keluarga. Lingkungan aman, akses mudah, dan fasilitas lengkap.
                            </p>
                        </div>
                    </a>
                </div>

                <!-- Beli Rumah -->
                <div class="col-md-3 text-center">
                    <a href="application/beli_rumah.php" class="text-decoration-none text-dark">
                        <div class="card-layanan">
                            <div class="circle-icon position-relative mx-auto">
                                <img src="Assets/img/Icon Beli.png" alt="" class="position-absolute top-50 start-50 translate-middle" />
                            </div>
                            <h3 class="mt-4">Beli Rumah</h3>
                            <p class="mt-3">
                                Rumah Project menyediakan rumah siap huni di lokasi strategis dengan lingkungan aman dan nyaman. Cocok untuk investasi atau tempat tinggal.
                            </p>
                        </div>
                    </a>
                </div>

                <!-- Rumah Kos (Layanan Baru) -->
                <div class="col-md-3 text-center">
                    <a href="application/rumah_kos.php" class="text-decoration-none text-dark">
                        <div class="card-layanan">
                            <div class="circle-icon position-relative mx-auto">
                                <img src="Assets/img/Icon Kos.png" alt="" class="position-absolute top-50 start-50 translate-middle" style="width: 60px; height: 60px; object-fit: contain;" />
                            </div>
                            <h3 class="mt-4">Rumah Kos</h3>
                            <p class="mt-3">
                                Temukan rumah kos nyaman dan strategis dengan harga terjangkau. Cocok untuk mahasiswa dan pekerja yang membutuhkan hunian sementara.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section id="search-section">
        <div class="col-12 text-center">
            <h2 class="fw-bold text-uppercase" style="color: #015C92; font-family: 'Poppins', sans-serif; font-size: 4rem; 
                text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);">
                Temukan Rumah Impian Anda
            </h2>
            <p class="text-white fw-semibold" style="font-size: 2.5rem; margin-bottom: 100px; 
                text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);">
                Hemat waktu dan biaya <br>  
                dengan memilih ratusan rumah berkualitas dengan harga terbaik.
            </p>
        </div>

        <form method="GET" class="custom-search-container">
            <select name="kategori_properti" class="custom-dropdown">
                <option value="">Semua Kategori</option>
                <option value="properti_baru">Properti Baru</option>
                <option value="rumah_sewa">Rumah Sewa</option>
                <option value="rumah_kos">Rumah Kos</option>
                <option value="beli_rumah">Beli Rumah</option>
            </select>
            <select name="kategori" class="custom-dropdown">
                <option value="">Pilih Kategori</option>
                <option value="harga">Harga Maksimal</option>
                <option value="luas_rumah">Luas Rumah Min</option>
                <option value="kamar_tidur">Jumlah Kamar Tidur</option>
                <option value="kamar_mandi">Jumlah Kamar Mandi</option>
                <option value="lokasi">Lokasi/Alamat</option>
                <option value="tipe_rumah">Tipe Rumah</option> <!-- Opsi baru untuk tipe rumah -->
            </select>
            <input type="text" name="keyword" class="custom-search-input" placeholder="Masukkan pencarian...">
            <button type="submit" class="custom-search-button"><i class="fas fa-search"></i></button>
        </form>
    </section>

    <div class="card-container">
        <?php
        $kategori_properti = isset($_GET['kategori_properti']) ? $_GET['kategori_properti'] : '';
        $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        $query = "SELECT * FROM (";
        $query .= "SELECT 'beli_rumah' AS kategori, nama_rumah, harga, nomor_kontak, alamat, kamar_tidur, kamar_mandi, luas_rumah, gambar FROM beli_rumah";
        $query .= " UNION ALL ";
        $query .= "SELECT 'properti_baru', nama_rumah, harga, nomor_kontak, alamat, kamar_tidur, kamar_mandi, luas_rumah, gambar FROM properti_baru";
        $query .= " UNION ALL ";
        $query .= "SELECT 'rumah_kos', nama_rumah, harga, nomor_kontak, alamat, kamar_tidur, kamar_mandi, luas_rumah, gambar FROM rumah_kos";
        $query .= " UNION ALL ";
        $query .= "SELECT 'rumah_sewa', nama_rumah, harga, nomor_kontak, alamat, kamar_tidur, kamar_mandi, luas_rumah, gambar FROM rumah_sewa";
        $query .= ") AS all_houses WHERE 1=1";

        $params = [];
        $types = "";

        if (!empty($kategori_properti)) {
            $query .= " AND kategori = ?";
            $types .= "s";
            $params[] = $kategori_properti;
        }

        if (!empty($kategori) && !empty($keyword)) {
            if ($kategori === 'harga') {
                $query .= " AND harga <= ?";
                $types .= "i";
                $params[] = $keyword;
            } elseif ($kategori === 'luas_rumah') {
                $query .= " AND luas_rumah >= ?";
                $types .= "i";
                $params[] = $keyword;
            } elseif ($kategori === 'kamar_tidur') {
                $query .= " AND kamar_tidur = ?";
                $types .= "i";
                $params[] = $keyword;
            } elseif ($kategori === 'kamar_mandi') {
                $query .= " AND kamar_mandi = ?";
                $types .= "i";
                $params[] = $keyword;
            } elseif ($kategori === 'lokasi') {
                $query .= " AND alamat LIKE ?";
                $types .= "s";
                $params[] = "%" . $keyword . "%";
            } elseif ($kategori === 'tipe_rumah') {
                $query .= " AND nama_rumah LIKE ?"; // Pencarian berdasarkan nama_rumah
                $types .= "s";
                $params[] = "%" . $keyword . "%";
            }
        }

        $stmt = $conn->prepare($query);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="application/uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['nama_rumah']); ?>">
                <div class="card-content">
                    <h3>IDR <?php echo number_format($row['harga'], 0, ',', '.'); ?></h3>
                    <p>Hubungi: <?php echo htmlspecialchars($row['nomor_kontak']); ?></p>
                    <p><?php echo htmlspecialchars($row['alamat']); ?></p>
                    <p class="status" style="color: red;">
                        <?php echo htmlspecialchars($row['nama_rumah']); ?> 
                    </p>
                </div>
                <div class="card-footer">
                    <span><i class="fas fa-bed"></i> <?php echo htmlspecialchars($row['kamar_tidur']); ?> Kamar</span>
                    <span><i class="fas fa-bath"></i> <?php echo htmlspecialchars($row['kamar_mandi']); ?> Bathroom</span>
                    <span><i class="fas fa-ruler-combined"></i> <?php echo htmlspecialchars($row['luas_rumah']); ?> m<sup>2</sup></span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>

    <script>
        // Cek apakah ada parameter di URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('kategori') || urlParams.has('keyword')) {
            // Jika ada, gulir ke bagian pencarian
            document.getElementById('search-section').scrollIntoView({ behavior: 'smooth' });
        }
    </script>

    <script>
      function scrollToSearch() {
          document.getElementById('search-section').scrollIntoView({ behavior: 'smooth' });
      }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen link layanan
        const layananLink = document.getElementById('layanan-link');

        // Tambahkan event listener untuk klik
        layananLink.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah perilaku default link

            // Ambil elemen section layanan
            const layananSection = document.getElementById('layanan');

            // Lakukan scroll ke section layanan dengan efek smooth
            layananSection.scrollIntoView({ behavior: 'smooth' });
        });
});
</script>
</body>
</html>