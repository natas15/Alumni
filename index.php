<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Alumni - Home</title>
</head>
<body>
<header>
    <?php include 'includes/nav.php'; ?>
</header>
<main>
    <section class="hero">
        <div class="hero-top">
            <div class="hero-left">
                <h2>Sign up now<br>for Alumni</h2>
                <p>Stay connected with fellow graduates or with your old teachers(if you like them) and never miss an event or opportunity again.</p>
                <a href="#" class="hero-btn">Sign up/Log in</a>
            </div>
            <div class="hero-right">Stay<br>connected with<br>yo homies!</div>
        </div>
    </section>

    <section class="cards-section">
        <div class="cards-header">
            <h2>Which direction suits<br>you?</h2>
        </div>
        <div class="cards-grid">
            <div class="card">
                <div class="card-image">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=600&q=80" alt="Student 1">
                </div>
                <div class="card-body">
                    <h3>I have no idea which direction suits me</h3>
                    <p>We've lined up a number of steps to help you make your choice. Read on quickly.</p>
                    <span class="card-arrow">↗</span>
                </div>
            </div>
            <div class="card">
                <div class="card-image">
                    <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=600&q=80" alt="Student 2">
                </div>
                <div class="card-body">
                    <h3>I'm torn between options</h3>
                    <p>Read about our programs and find out which direction suits you best.</p>
                    <span class="card-arrow">↗</span>
                </div>
            </div>
            <div class="card">
                <div class="card-image">
                    <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=600&q=80" alt="Student 3">
                </div>
                <div class="card-body">
                    <h3>I already know exactly where I want to go</h3>
                    <p>Go straight to our program overview and sign up!</p>
                    <span class="card-arrow">↗</span>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>