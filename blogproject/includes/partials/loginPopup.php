<div id="login">
    <div class="login-overlay"></div>
    <form method="post" class="login-form">
        <div class="login-form-header">
            <a href="#"><i class="fa-solid fa-xmark fa-2xl"></i></a>
            <h2>Login</h2>
        </div>

        <label>
            Username:<br>
            <input type="text" name="username" required>
        </label><br><br>

        <label>
            Password:<br>
            <input type="password" name="password" required>
        </label><br><br>

        <button type="submit" name="login">Login</button>
        <p class="register-link">
            Nog geen account? <a href="register.php">Maak er één aan</a>
        </p>

        <?php if (!empty($errorMsg)): ?>
            <p class="error"><?= htmlspecialchars($errorMsg) ?></p>
        <?php endif; ?>
    </form>
</div>

<!-- === Profiel popup === -->
<div id="profile">
    <?php if (isset($_SESSION['user'])): ?>
        <div class="profile-popup">
            <div class="profile-popup-header">
                <h2>Profiel</h2>
                <a href="#"><i class="fa-solid fa-xmark fa-lg"></i></a>
            </div>
            <div class="profile-popup-content">
                <p><strong>Gebruiker:</strong> <?= ucfirst(htmlspecialchars($_SESSION['user']['username'])) ?></p>

                <ul class="profile-links">
                    <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/posts">
                        <i class="fa-solid fa-utensils"></i> Mijn gerechten</a></li>
                    <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/create">
                        <i class="fa-solid fa-plus"></i> Nieuw gerecht</a></li>
                    <li><a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/profile/account">
                        <i class="fa-solid fa-gear"></i> Account</a></li>
                </ul>

                <form method="post" class="logout-form">
                    <input type="hidden" name="logout" value="true">
                    <button type="submit" class="logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i> Uitloggen
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>
