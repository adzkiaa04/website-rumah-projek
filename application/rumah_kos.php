<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Kos</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #d1e7e7;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2, .card-content h3, .card-content p {
            color: #000;
            transition: color 0.3s ease;
        }
        .card:hover h2, .card:hover .card-content h3, .card:hover .card-content p {
            color: #fff;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            width: 100%;
            max-width: 1200px;
        }
        .card {
            position: relative;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            height: 430px; /* Tetapkan tinggi tetap */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 10px;
            display: flex;
            flex-direction: column; /* Atur arah flex ke kolom */
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-content {
            flex-grow: 1; /* Konten akan mengisi sisa ruang yang tersedia */
            padding: 20px;
            overflow-y: auto; /* Tambahkan scroll jika konten terlalu panjang */
            max-height: 300px; /* Batasi tinggi maksimal konten */
        }
        .card-content h3 {
            margin: 0;
            font-size: 1.5em;
            color: #333;
        }
        .card-content p {
            margin: 5px 0;
            color: #666;
        }
        .card-footer {
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
            flex-shrink: 0; /* Footer tidak akan menyusut */
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
        .fas {
            margin-right: 5px;
        }
        .searchBox {
            display: flex;
            height: 45px;
            width: 100%;
            max-width: 300px;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            background: #2f3640;
            border-radius: 50px;
            padding: 5px;
            position: relative;
            box-sizing: border-box;
            overflow: hidden;
            margin-bottom: 50px;
        }
        .searchInput {
            flex: 1;
            border: none;
            background: none;
            outline: none;
            color: white;
            font-size: 15px;
            padding: 10px 15px;
            width: 100%;
            box-sizing: border-box;
        }
        .searchButton {
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(90deg, #2AF598 0%, #009EFD 100%);
            border: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
        }
        .searchButton:hover {
            background-color: #1A1A1A;
            box-shadow: rgba(0, 0, 0, 0.5) 0 10px 20px;
            transform: translateY(-3px);
        }
        .searchButton:active {
            box-shadow: none;
            transform: translateY(0);
        }
        #hero {
        background: linear-gradient(160deg, var(--pr-color), #000);
        height: 100vh;
        width: 103%; /* Ubah dari 103% menjadi 100% untuk menghindari overflow */
        margin-top: -20px; /* Geser ke atas */
        position: relative; /* Tambahkan ini untuk memastikan posisi elemen anak */
        overflow: hidden; /* Hindari overflow */
        }

        .container.h-100 {
        height: 100%;
        display: flex;
        align-items: center; /* Pusatkan konten vertikal */
        }

        .row.h-100 {
        width: 100%;
        }

        .hero-tagline {
        max-width: 600px; /* Batas lebar untuk teks */
        text-align: left;
        color: white;
        z-index: 1; /* Pastikan teks di atas gambar */
        }

        .hero-tagline h1 {
        font-weight: 700;
        font-size: 50px;
        line-height: 72px;
        margin-bottom: 20px; /* Jarak bawah untuk judul */
        }

        .hero-tagline p {
        font-size: 16px;
        line-height: 30px;
        margin-bottom: 40px; /* Jarak bawah untuk paragraf */
        }

        .button-lg-primary {
        width: 237px;
        height: 70px;
        background-color: white;
        color: var(--pr-color);
        border: none;
        font-size: 20px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease; /* Efek transisi */
        }

        .button-lg-primary:hover {
        background-color: var(--pr-color);
        color: white;
        border: 2px solid white; /* Efek hover */
        }

        .img-hero {
        position: absolute;
        right: 0;
        bottom: 0;
        max-width: 40%;
        height: auto;
        z-index: 0; /* Pastikan gambar di belakang teks */
        }

        /* Media Query untuk Layar Tablet */
        @media (max-width: 768px) {
        .hero-tagline h1 {
            font-size: 36px;
            line-height: 50px;
        }

        .hero-tagline p {
            font-size: 14px;
            line-height: 25px;
        }

        .img-hero {
            max-width: 60%; /* Gambar lebih besar di layar kecil */
        }
        }

        /* Media Query untuk Layar Ponsel */
        @media (max-width: 576px) {
        .hero-tagline h1 {
            font-size: 28px;
            line-height: 40px;
        }
        }

        .hero-tagline p {
            font-size: 12px;
            line-height: 20px;
        }

        .img-hero {
            max-width: 80%; /* Gambar lebih besar di layar ponsel */
        }

        .button-lg-primary {
            width: 180px;
            height: 50px;
            font-size: 16px;
        }
        .add-button-fixed {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 30px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .add-button-fixed:hover {
            background-color: #218838;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section id="hero">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-6 hero-tagline my-auto">
                    <h1>CARI REKOMENDASI RUMAH KOS UNTUKMU</h1>
                    <p>
                        <span class="fw-bold">Rumah Kos Project</span> adalah sebuah website
                        yang dirancang untuk membantu masyarakat dalam mencari dan
                        menemukan rumah kos impian mereka dengan mudah dan cepat.
                    </p>
                    <form action="../index.php">
                        <button type="submit" class="button-lg-primary">KEMBALI</button>
                    </form>
                </div>
            </div>
            <img src="../Assets/img/Hero Image.png" alt="Hero Image" class="img-hero" />
        </div>
    </section>
    <h2>REKOMENDASI RUMAH KOS</h2>

    <div class="searchBox">
        <input type="text" id="search" class="searchInput" placeholder="Cari rumah kos...">
        <button class="searchButton"><i class="fas fa-search"></i></button>
    </div>

    <section id="rekomendasi">
        <div class="container">
            <?php
            $sql = "SELECT * FROM rumah_kos ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="card">
                        <a href="tambah_rumah_kos.php" class="add-button">+</a>
                        <img src="uploads/' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['nama_rumah']) . '">
                        <div class="card-content">
                            <h3 class="price">IDR ' . number_format($row['harga'], 0, ',', '.') . ' /Month</h3>
                            <p class="contact">Hub. ' . $row['nomor_kontak'] . '</p>
                            <p class="address">' . $row['alamat'] . '</p>
                            <p class="status" style="color: red;">' . htmlspecialchars($row['nama_rumah']) . '</p>
                        </div>
                        <div class="card-footer">
                            <div>
                                <i class="fas fa-bed"></i>
                                <span>' . $row['kamar_tidur'] . ' Kamar Tidur</span>
                            </div>
                            <div>
                                <i class="fas fa-bath"></i>
                                <span>' . $row['kamar_mandi'] . ' Kamar Mandi</span>
                            </div>
                            <div>
                                <i class="fas fa-ruler-combined"></i>
                                <span>' . $row['luas_rumah'] . ' m<sup>2</sup> Luas Rumah</span>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>Tidak ada rekomendasi rumah kos saat ini.</p>';
            }
            ?>
        </div>
        
    </section>

    <a href="tambah_rumah_kos.php" class="add-button-fixed">+</a>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(searchTerm) ? 'block' : 'none';
            });
        });
    </script>
</body>
</html>