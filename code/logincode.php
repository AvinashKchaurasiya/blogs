<?php
include '../config/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare SQL Statement
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $user['email'];
            $_SESSION['admin_name'] = $user['name'];

            echo json_encode([
                "success" => true,
                "message" => "Login successful",
                "redirect" => "dashboard.php"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Incorrect password"
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Email not registered"
        ]);
    }

    $stmt->close();
}
