<?php
session_start();
include 'db.php';

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $db_username, $hashed_password);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $db_username;
        echo json_encode(['success' => true, 'message' => 'Login berhasil!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Username atau password salah.']);
    }

    $stmt->close();
    $conn->close();
    exit;
}

// Handle Registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_username'], $_POST['register_password'])) {
    $username = trim($_POST['register_username']);
    $password = password_hash(trim($_POST['register_password']), PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Registrasi berhasil!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registrasi gagal.']);
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Company Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/css/style.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');

        body.login-page {
            background: url('../Assets/img/bglog.jpg') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .welcome-text {
            text-align: center;
            color: #5f9ea0;
            font-size: 3rem;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 20px;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.4);
        }

        .btn-container {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .btn-toggle {
            font-size: 1.2rem;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-login {
            background-color: #5f9ea0;
            color: white;
        }

        .btn-signup {
            background-color: #5f9ea0;
            color: black;
        }

        .btn-toggle:hover {
            opacity: 0.8;
        }

        .form-container {
            display: none;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        .active {
            display: block;
        }

        .form-container h2 {
            text-align: center;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 5px;
            padding: 10px;
        }

        .btn-submit {
            background-color: #5f9ea0;
            border: none;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            border-radius: 5px;
        }

        .btn-submit:hover {
            background-color: #4e8c8e;
        }

        .loading {
            display: none;
            text-align: center;
            font-weight: bold;
            color: #007bff;
            margin-top: 10px;
        }

        /* Loader Styles */
        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .loader {
            --cell-size: 52px;
            --cell-spacing: 1px;
            --cells: 3;
            --total-size: calc(var(--cells) * (var(--cell-size) + 2 * var(--cell-spacing)));
            display: flex;
            flex-wrap: wrap;
            width: var(--total-size);
            height: var(--total-size);
        }

        .cell {
            flex: 0 0 var(--cell-size);
            margin: var(--cell-spacing);
            background-color: transparent;
            box-sizing: border-box;
            border-radius: 4px;
            animation: 1.5s ripple ease infinite;
        }

        .cell.d-1 {
            animation-delay: 100ms;
        }

        .cell.d-2 {
            animation-delay: 200ms;
        }

        .cell.d-3 {
            animation-delay: 300ms;
        }

        .cell.d-4 {
            animation-delay: 400ms;
        }

        .cell:nth-child(1) {
            --cell-color: #00FF87;
        }

        .cell:nth-child(2) {
            --cell-color: #0CFD95;
        }

        .cell:nth-child(3) {
            --cell-color: #17FBA2;
        }

        .cell:nth-child(4) {
            --cell-color: #23F9B2;
        }

        .cell:nth-child(5) {
            --cell-color: #30F7C3;
        }

        .cell:nth-child(6) {
            --cell-color: #3DF5D4;
        }

        .cell:nth-child(7) {
            --cell-color: #45F4DE;
        }

        .cell:nth-child(8) {
            --cell-color: #53F1F0;
        }

        .cell:nth-child(9) {
            --cell-color: #60EFFF;
        }

        @keyframes ripple {
            0% {
                background-color: transparent;
            }

            30% {
                background-color: var(--cell-color);
            }

            60% {
                background-color: transparent;
            }

            100% {
                background-color: transparent;
            }
        }
    </style>
</head>
<body class="login-page">

    <div class="welcome-text">
        <h1>Selamat Datang di Rumah Projek</h1>
    </div>

    <div class="btn-container">
        <button class="btn-toggle btn-login" onclick="toggleForm('login')">Login</button>
        <button class="btn-toggle btn-signup" onclick="toggleForm('register')">Sign Up</button>
    </div>

    <div id="loginFormContainer" class="form-container active">
        <h2>Login</h2>
        <form id="loginForm">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <button type="submit" class="btn-submit">Login</button>
        </form>
        <p class="loading">Memproses login...</p>
    </div>

    <div id="registerFormContainer" class="form-container">
        <h2>Sign Up</h2>
        <form id="registerForm">
            <input type="text" name="register_username" class="form-control" placeholder="Username" required>
            <input type="password" name="register_password" class="form-control" placeholder="Password" required>
            <button type="submit" class="btn-submit">Sign Up</button>
        </form>
        <p class="loading">Memproses registrasi...</p>
    </div>

    <!-- Loader Overlay -->
    <div id="loaderOverlay" class="loader-overlay" style="display: none;">
        <div class="loader">
            <div class="cell d-1"></div>
            <div class="cell d-2"></div>
            <div class="cell d-3"></div>
            <div class="cell d-4"></div>
            <div class="cell d-5"></div>
            <div class="cell d-6"></div>
            <div class="cell d-7"></div>
            <div class="cell d-8"></div>
            <div class="cell d-9"></div>
        </div>
    </div>

    <script>
        function toggleForm(type) {
            document.getElementById('loginFormContainer').classList.remove('active');
            document.getElementById('registerFormContainer').classList.remove('active');

            if (type === 'login') {
                document.getElementById('loginFormContainer').classList.add('active');
            } else {
                document.getElementById('registerFormContainer').classList.add('active');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const loadingText = document.querySelector('#loginFormContainer .loading');

            loadingText.style.display = 'block';

            const res = await fetch(window.location.href, {
                method: 'POST',
                body: formData
            });

            const data = await res.json();
            loadingText.style.display = 'none';

            if (data.success) {
                // Tampilkan loader overlay
                document.getElementById('loaderOverlay').style.display = 'flex';

                // Redirect ke index.php setelah 2 detik
                setTimeout(() => {
                    window.location.href = '../index.php';
                }, 2000);
            } else {
                alert(data.message);
            }
        });

        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const loadingText = document.querySelector('#registerFormContainer .loading');

            loadingText.style.display = 'block';

            const res = await fetch(window.location.href, {
                method: 'POST',
                body: formData
            });

            const data = await res.json();
            loadingText.style.display = 'none';

            alert(data.message);
            if (data.success) toggleForm('login');
        });
    </script>

</body>
</html>