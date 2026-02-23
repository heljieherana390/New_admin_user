<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herana Pastry | Handcrafted Pastries</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* ── SIMPLE LOADING SCREEN ── */
        #loading-screen {
            position: fixed; inset: 0; background: #FAF6F0;
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            z-index: 9999; transition: opacity 0.6s ease;
        }
        #loading-screen.hide { opacity: 0; pointer-events: none; }
        .loader {
            width: 56px; height: 56px;
            border: 3px solid #F5E8CC; border-top: 3px solid #C9973A;
            border-radius: 50%; animation: spin 0.9s linear infinite; margin-bottom: 24px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        #loading-screen h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px; font-style: italic;
            color: #5C3A1E; margin-bottom: 6px; letter-spacing: 0.5px;
        }
        #loading-screen p { font-size: 13px; color: #8A7560; letter-spacing: 0.5px; }
    </style>
</head>
<body>

    <!-- SIMPLE LOADING SCREEN -->
    <div id="loading-screen">
        <div class="loader"></div>
        <h2>Herana Pastry</h2>
        <p>Preparing something sweet for you...</p>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar">
        <span class="navbar-brand">Herana Pastry</span>
        <div class="nav-links">
            <?php if ($is_logged_in): ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php" class="logout-btn">Logout</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-tag">Herana Pastry Shop</div>
            <h1>Baked With <em>Love</em> 🍰</h1>
            <p>Handcrafted cakes & served with joy.</p>
            <?php if (!$is_logged_in): ?>
                <a href="login.php" class="btn btn-primary">Get Started</a>
            <?php else: ?>
                <a href="dashboard.php" class="btn btn-primary">Order Now</a>
            <?php endif; ?>
        </div>
    </section>

   
        </div>
    </section>

    <div class="divider">✦ ✦ ✦</div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-divider"></div>
        <p>&copy; <?php echo date("Y"); ?> Herana Pastry. All sweetness reserved.</p>
    </footer>

    <!-- LOGIN MODAL -->
    <div class="modal" id="loginModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeLogin()">&times;</span>
            <h2>Welcome Back</h2>
            <form method="POST" action="login.php">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p>No account? <a href="#" onclick="switchToSignup()">Sign up</a></p>
        </div>
    </div>

    <!-- SIGNUP MODAL -->
    <div class="modal" id="signupModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeSignup()">&times;</span>
            <h2>Create Account</h2>
            <form method="POST" action="signup.php">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
            </form>
            <p>Already have an account? <a href="#" onclick="switchToLogin()">Login</a></p>
        </div>
    </div>

    <script>
        /* ── Loader: dismiss and reveal page ── */
        setTimeout(function () {
            var loader = document.getElementById('loading-screen');
            loader.classList.add('hide');
            setTimeout(function () {
                loader.style.display = 'none';
            }, 600);
        }, 2500);

        /* ── Modal helpers ── */
        function openLogin()   { document.getElementById("loginModal").style.display  = "flex"; }
        function closeLogin()  { document.getElementById("loginModal").style.display  = "none"; }
        function openSignup()  { document.getElementById("signupModal").style.display = "flex"; }
        function closeSignup() { document.getElementById("signupModal").style.display = "none"; }
        function switchToSignup() { closeLogin();  openSignup(); }
        function switchToLogin()  { closeSignup(); openLogin();  }
        window.onclick = e => { if (e.target.classList.contains("modal")) e.target.style.display = "none"; }
    </script>

</body>
</html>