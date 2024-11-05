<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .fade-out {
            opacity: 0;
            transition: opacity 1s ease-out;
        }
    </style>
</head>
<body>
    <div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
        <?php
        session_start(); // Start the session

        // Define users with their usernames and passwords based on user types
        $users = [
            'Admin' => [
                'admin' => 'pass1234',
                'kenneth' => 'pogi1234',
            ],
            'Content Manager' => [
                'pepito' => 'manaloto',
                'juan' => 'delacruz',
            ],
            'System User' => [
                'pedro' => 'penduko',
            ],
        ];

        // Initialize message variables
        $errorMessage = '';
        $successMessage = '';

        // Check if form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedUserType = $_POST["userType"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Validate credentials
            if (isset($users[$selectedUserType][$username]) && $users[$selectedUserType][$username] === $password) {
                $successMessage = "Welcome to the System: $username"; // Updated message
                $_SESSION['successMessage'] = $successMessage; // Store message in session
            } else {
                $errorMessage = "Invalid Username / Password";
                $_SESSION['errorMessage'] = $errorMessage; // Store message in session
            }
            header("Location: " . $_SERVER['PHP_SELF']); // Redirect to clear POST data
            exit;
        }

        // Retrieve messages from session
        if (isset($_SESSION['successMessage'])) {
            $successMessage = $_SESSION['successMessage'];
            unset($_SESSION['successMessage']); // Clear message after displaying it
        }

        if (isset($_SESSION['errorMessage'])) {
            $errorMessage = $_SESSION['errorMessage'];
            unset($_SESSION['errorMessage']); // Clear message after displaying it
        }
        ?>

        <!-- Success Message -->
        <?php if ($successMessage): ?>
            <div class="alert alert-success fade-message" style="background-color: #d4edda; color: green; text-align: center; width: 100%; max-width: 350px; margin-bottom: 20px;">
                <?= $successMessage; ?>
            </div>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if ($errorMessage): ?>
            <div class="alert alert-danger fade-message" style="background-color: #f8d7da; color: red; text-align: center; width: 100%; max-width: 350px; margin-bottom: 20px;">
                <?= $errorMessage; ?>
            </div>
        <?php endif; ?>

        <div class="signin-container shadow p-4 rounded" style="background-color: #D3D3D3; width: 90%; max-width: 350px; padding: 30px; border-radius: 15px;">
            <!-- Profile Image -->
            <div class="text-center mb-4">
                <img src="images/vectorprofile.png" alt="Profile Image" class="profile-img" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
            </div>

            <form method="POST" action="">
                <div class="mb-3">
                    <!-- Dropdown for selecting user type -->
                    <select name="userType" class="form-select" required style="width: 100%; max-width: 300px; margin: 0 auto; display: block;">
                        <option value="Admin">Admin</option>
                        <option value="Content Manager">Content Manager</option>
                        <option value="System User">System User</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required style="width: 100%; max-width: 300px; margin: 0 auto; display: block;">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required style="width: 100%; max-width: 300px; margin: 0 auto; display: block;">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function to fade out messages
        function fadeOutMessages() {
            const messages = document.querySelectorAll('.fade-message');
            messages.forEach((message) => {
                setTimeout(() => {
                    message.classList.add('fade-out');
                }, 5000); // Time before fading out (5 seconds)
            });
        }

        // Call the fadeOutMessages function after the page loads
        window.onload = fadeOutMessages;
    </script>
</body>
</html>
