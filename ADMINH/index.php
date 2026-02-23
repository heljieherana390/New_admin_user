<?php
// Database connection — inline so index.php works standalone outside ADMINH
$host   = "localhost";
$user   = "root";
$pass   = "";
$dbname = "herana_pastry";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herana Pastry | Exquisite Cakes & Cupcakes</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="loading_style.css">
</head>
<body>

    <!-- FANCY LOADING SCREEN -->
    <div id="loading-screen">
        <div class="ls-blob ls-blob-1"></div>
        <div class="ls-blob ls-blob-2"></div>
        <div class="ls-wrap">
            <div class="ls-wordmark">Herana <em>Pastry Admin Portal Acess </em></div>
            <div class="ls-spinner-ring">
                <div class="ls-ring ls-ring-outer"></div>
                <div class="ls-ring ls-ring-middle"></div>
                <div class="ls-ring ls-ring-inner"></div>
                <div class="ls-ring-dot"></div>
            </div>
            <div class="ls-ticks">
                <div class="ls-tick ls-tick-active"></div>
                <div class="ls-tick ls-tick-active"></div>
                <div class="ls-tick ls-tick-active"></div>
                <div class="ls-tick"></div>
                <div class="ls-tick"></div>
                <div class="ls-tick"></div>
                <div class="ls-tick"></div>
                <div class="ls-tick"></div>
            </div>
            <div class="ls-progress-wrap">
                <div class="ls-progress-row">
                    <div class="ls-status" id="ls-statusText">Preparing<span id="ls-dots">...</span></div>
                    <div class="ls-pct" id="ls-pct">0%</div>
                </div>
                <div class="ls-bar-track">
                    <div class="ls-bar-fill"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- NAV — logo only, no admin button -->
    <nav>
        <div class="nav-logo">
            <img src="pas.webp" alt="Herana Pastry Logo">
        </div>
    </nav>

    <!-- HERO — Staff Portal Access button in center, no Discover More -->
    <header class="hero" id="home">
        <div class="hero-content">
            <div class="hero-tag">HERANA PASTRY PORTAL ADMIN</div>
            <h1>Love Every Bite<br>at <em>Herana</em> Pastry</h1>
            <p>Experience handcrafted cakes and cupcakes made with the finest ingredients — baked with heart, served with joy.</p>
            <a href="admin_login.php" class="btn-portal">🔒 Staff Portal Access</a>
        </div>
    </header>

    <div class="divider">✦ ✦ ✦</div>

    <footer id="about">
        <img src="pas.webp" alt="Herana Pastry Logo">
        <div class="footer-divider"></div>
        <p>&copy; 2026 Herana Pastry Bakery. All rights reserved.</p>
        <p>123 Sweet Street, Dessert City</p>
    </footer>

    <script>
    (function () {
        const messages = ['Preparing', 'Loading sweets', 'Glazing details', 'Almost ready', 'Enjoy!'];
        const statusEl = document.getElementById('ls-statusText');
        const dotsEl   = document.getElementById('ls-dots');
        const pctEl    = document.getElementById('ls-pct');
        const screen   = document.getElementById('loading-screen');

        let dotCount = 0;
        const dotsInterval = setInterval(() => {
            dotCount = (dotCount + 1) % 4;
            if (dotsEl) dotsEl.textContent = '.'.repeat(dotCount || 1);
        }, 400);

        const DURATION = 3500;
        const start    = performance.now();
        const kf = [
            { t: 0,    p: 0   }, { t: 0.30, p: 38  },
            { t: 0.60, p: 67  }, { t: 0.80, p: 84  },
            { t: 0.95, p: 97  }, { t: 1.00, p: 100 },
        ];

        function lerp(a, b, t) { return a + (b - a) * t; }
        function getP(frac) {
            for (let i = 1; i < kf.length; i++) {
                if (frac <= kf[i].t)
                    return lerp(kf[i-1].p, kf[i].p, (frac - kf[i-1].t) / (kf[i].t - kf[i-1].t));
            }
            return 100;
        }

        function revealPage() {
            screen.remove();
            document.body.classList.add('ls-revealed');
            document.body.style.overflow = 'auto';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function tick(now) {
            const frac = Math.min((now - start) / DURATION, 1);
            if (pctEl) pctEl.textContent = Math.round(getP(frac)) + '%';
            const mi = Math.min(Math.floor(frac * messages.length), messages.length - 1);
            if (statusEl) statusEl.childNodes[0].nodeValue = messages[mi];

            if (frac < 1) {
                requestAnimationFrame(tick);
            } else {
                clearInterval(dotsInterval);
                if (dotsEl)   dotsEl.textContent = '';
                if (statusEl) statusEl.childNodes[0].nodeValue = 'Ready';
                setTimeout(() => {
                    screen.classList.add('ls-hide');
                    const fallback = setTimeout(revealPage, 1000);
                    screen.addEventListener('transitionend', () => { clearTimeout(fallback); revealPage(); }, { once: true });
                }, 400);
            }
        }
        requestAnimationFrame(tick);
    })();
    </script>

</body>
</html>