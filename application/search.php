<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Rumah</title>
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
        .search-container {
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }
        .search-container select, .search-container input, .search-container button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-container button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border: none;
        }
        .search-container button:hover {
            background-color: #218838;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 80px;
            justify-content: center;
            max-width: 1200px;
            width: 100%;
        }
        .card {
            position: relative;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            height: 430px;
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
            flex-grow: 1;
            padding: 3px;
            overflow-y: auto;
            max-height: 300px;
        }
        .card-footer {
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
            flex-shrink: 0;
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
        .search-container {
            display: flex;
            align-items: center;
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }
        .dropdown {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 10px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 16px;
            color: #333;
            outline: none;
        }
        .dropdown i {
            color: #1f7a7a;
        }
        .search-input {
            flex-grow: 1;
            border: none;
            outline: none;
            padding: 10px;
            font-size: 16px;
            color: #555;
        }
        .search-button {
            background-color: #2f8f8f;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        .search-button:hover {
            background-color: #257676;
        }
    </style>
</head>
<body>
    <!-- Form Pencarian dan Hasil Pencarian -->
    <?php
    require 'db.php';

    $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

    $query = "SELECT * FROM (
        SELECT 'beli_rumah' AS kategori, nama_rumah, harga, nomor_kontak, alamat, kamar_tidur, kamar_mandi, luas_rumah, gambar FROM beli_rumah
        UNION ALL
        SELECT 'properti_baru', nama_rumah, harga, nomor_kontak, alamat, kamar_tidur, kamar_mandi, luas_rumah, gambar FROM properti_baru
        UNION ALL
        SELECT 'rumah_kos', nama_rumah, harga, nomor_kontak, alamat, kamar_tidur, kamar_mandi, luas_rumah, gambar FROM rumah_kos
        UNION ALL
        SELECT 'rumah_sewa', nama_rumah, harga, nomor_kontak, alamat, kamar_tidur, kamar_mandi, luas_rumah, gambar FROM rumah_sewa
    ) AS all_houses WHERE 1=1";

    $params = [];
    $types = "";

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
        } elseif ($kategori === 'sewa') {
            $query .= " AND kategori = 'rumah_sewa'";
        } elseif ($kategori === 'jual') {
            $query .= " AND (kategori = 'beli_rumah' OR kategori = 'properti_baru')";
        }
    }

    $stmt = $conn->prepare($query);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <h2>Pencarian Rumah</h2>
    <form method="GET" class="search-container">
        <select name="kategori" class="dropdown">
            <option value="">Pilih Kategori</option>
            <option value="harga">Harga Maksimal</option>
            <option value="luas_rumah">Luas Rumah Min</option>
            <option value="kamar_tidur">Jumlah Kamar Tidur</option>
            <option value="kamar_mandi">Jumlah Kamar Mandi</option>
            <option value="sewa">Sewa</option>
            <option value="jual">Jual</option>
        </select>
        <input type="text" name="keyword" class="search-input" placeholder="Masukkan pencarian...">
        <button type="submit" class="search-button">Cari</button>
    </form>

    <div class="card-container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="application/uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar Rumah">
                <div class="card-content">
                    <h3>IDR <?php echo number_format($row['harga'], 0, ',', '.'); ?></h3>
                    <p>Hubungi: <?php echo htmlspecialchars($row['nomor_kontak']); ?></p>
                    <p><?php echo htmlspecialchars($row['alamat']); ?></p>
                    <p class="status" style="color: red;"><?php echo $row['kategori'] === 'rumah_sewa' ? 'Sewa Rumah' : 'Beli Rumah'; ?></p>
                </div>
                <div class="card-footer">
                    <span><i class="fas fa-bed"></i> <?php echo $row['kamar_tidur']; ?> Kamar</span>
                    <span><i class="fas fa-bath"></i> <?php echo $row['kamar_mandi']; ?> Mandi</span>
                    <span><i class="fas fa-ruler-combined"></i> <?php echo $row['luas_rumah']; ?> m<sup>2</sup></span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>