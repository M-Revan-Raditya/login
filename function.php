<?php
$conn = mysqli_connect("localhost", "root", "", "db_login");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['register'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // 1️⃣ Cek apakah email sudah terdaftar
    $cek_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");

    if (mysqli_num_rows($cek_email) > 0) {
        echo "<script>
                alert('Email sudah terdaftar!');
                window.history.back();
              </script>";
        exit;
    }

    // 2️⃣ Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // 3️⃣ Simpan ke database
    $query = "INSERT INTO users (email, password) 
              VALUES ('$email', '$password_hash')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Register berhasil!');
                window.location='login.php';
              </script>";
    } else {
        echo "<script>
                alert('Register gagal!');
              </script>";
    }
}
?>
