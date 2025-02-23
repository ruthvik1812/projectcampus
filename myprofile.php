<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT name, phone, email, college FROM users WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Campus Sphere</title>
    
    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Background Styling */
        body {
            background: linear-gradient(135deg, #4b0082, #6a0dad);
            color: white;
            font-family: 'Arial', sans-serif;
            text-align: center;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background-color: #4b0082;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .nav-link {
            color: white !important;
        }
        .nav-link:hover {
            color: #ddd !important;
        }
        .navbar-nav .nav-item .active {
            font-weight: bold;
            border-bottom: 2px solid white;
        }

        /* Profile Container */
        .profile-container {
            max-width: 500px;
            background: white;
            color: #6a0dad;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
            margin-top: 80px;
        }
        .profile-container:hover {
            transform: translateY(-5px);
        }

        /* Profile Icon */
        .profile-icon {
            font-size: 90px;
            color: #6a0dad;
            margin-bottom: 15px;
        }

        /* Profile Details */
        p {
            font-size: 18px;
            font-weight: 500;
            margin: 10px 0;
        }

        /* Logout Button */
        .btn-purple {
            background-color: #6a0dad;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-purple:hover {
            background-color: #580aa8;
            transform: scale(1.05);
        }

        /* Footer */
        .footer {
            background-color: #4b0082;
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            color: white;
        }
        .footer a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand text-white" href="index.html">Campus Sphere</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="networks.html">Network</a></li>
                <li class="nav-item"><a class="nav-link" href="contacts.html">Contacts</a></li>
                <li class="nav-item"><a class="nav-link" href="job.html">Jobs</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                <li class="nav-item"><a class="nav-link" href="myprofile.php">My Profile</a></li>
            </ul>
        </div>
        <!-- <a href="logout.php" class="btn btn-danger">Logout</a> -->
    </div>
</nav>

<!-- Profile Section -->
<div class="container">
    <div class="profile-container">
        <i class="fa-solid fa-user-circle profile-icon"></i>
        <h2>Welcome to <strong>Campus Sphere</strong>, <?php echo htmlspecialchars($user['name']); ?>!</h2>
        <hr>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
        <p><strong>College:</strong> <?php echo htmlspecialchars($user['college']); ?></p>
        <div class="text-center mt-4">
            <a href="logout.php" class="btn btn-purple">Logout</a>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2025 Campus Sphere | <a href="privacy.html">Privacy Policy</a> | <a href="terms.html">Terms of Use</a></p>
    <div>
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin"></i></a>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
