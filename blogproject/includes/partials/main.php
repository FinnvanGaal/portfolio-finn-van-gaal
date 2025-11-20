<?php
$classes = ['post-big', 'post-small-top', 'post-small-bottom'];
$i = 0;

?>
<!-- index -->
<?php if ($currentPage === 'index.php'): ?>
    <main>
        <div class="content-container">
            <?php foreach ($limitPost as $key => $post): ?> 
                <div class="<?= $classes[$i] ?>" 
                    style="background-image: url('images/<?= htmlspecialchars($post['image']) ?>')" 
                    onclick="window.location='/rea-1/PHP/26-eindopdracht-php/mijn-blog/<?= htmlspecialchars($post['slug']) ?>'">
                    <h2><?= htmlspecialchars($post['title']) ?></h2>
                    <p>
                        <i class="fa-solid fa-user"></i>
                        Geschreven door: <?= ucfirst(htmlspecialchars($post['username'])) ?>
                    </p>
                    <h3 class="date">Gepubliceerd op <?= $postContent[$key]['created_at'] ?></h3>
                </div>
            <?php $i++; endforeach ?>
        </div>
    </main>
<!-- postPage -->
<?php elseif ($currentPage === 'postsPage.php'): ?>
    <main>    
    <div class="filter-section">
            <form method="post" class="filter-form">
                <label for="sort">Sorteer op:</label>
                <select id="sort" name="sort">
                    <option value="newest" <?= (($_POST['sort'] ?? '') === 'newest') ? 'selected' : '' ?>>Nieuw → Oud</option>
                    <option value="oldest" <?= (($_POST['sort'] ?? '') === 'oldest') ? 'selected' : '' ?>>Oud → Nieuw</option>
                    <option value="author-asc" <?= (($_POST['sort'] ?? '') === 'author-asc') ? 'selected' : '' ?>>Auteur (A-Z)</option>
                    <option value="author-desc" <?= (($_POST['sort'] ?? '') === 'author-desc') ? 'selected' : '' ?>>Auteur (Z-A)</option>
                </select>

                <label for="limit">Toon:</label>
                <select id="limit" name="limit">
                    <option value="4" <?= (($_POST['limit'] ?? '') === '4') ? 'selected' : '' ?>>4 resultaten</option>
                    <option value="8" <?= (($_POST['limit'] ?? '8') === '8') ? 'selected' : '' ?>>8 resultaten</option>
                    <option value="12" <?= (($_POST['limit'] ?? '') === '12') ? 'selected' : '' ?>>12 resultaten</option>
                    <option value="all" <?= (($_POST['limit'] ?? '') === 'all') ? 'selected' : '' ?>>Alle resultaten</option>
                </select>

                <label for="search">Zoeken:</label>
                <input type="text" id="search" name="q" placeholder="Zoek in titel, auteur of inhoud..."
                    value="<?= htmlspecialchars($_POST['q'] ?? '') ?>">

                <button type="submit"><i class="fa-solid fa-filter"></i> Toepassen</button>
            </form>
        </div>



        <h1>Ontdek onze nieuwste gerechten</h1>
        <div class="allposts">
            <?php foreach ($postContent as $posts): ?>
                <div class="post" onclick="window.location='/rea-1/PHP/26-eindopdracht-php/mijn-blog/<?= htmlspecialchars($posts['slug']) ?>'">
                    <img class="post-img" src="images/<?= htmlspecialchars($posts['image']) ?>">
                    <h3><?= htmlspecialchars($posts['title']) ?></h3>
                    <p>
                        <i class="fa-solid fa-user"></i>
                        Geschreven door: <?= ucfirst(htmlspecialchars($posts['username'])) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
<!-- currentPost -->
<?php elseif ($currentPage === 'currentPost.php'): ?>
    <main>
        <?php $key = $_GET['post'] ?? ''; ?>
        <img class="post-img" src="images/<?= htmlspecialchars($postContent[$key]['image']) ?>">
    </main>

<!-- register page -->
<?php elseif ($currentPage === 'register.php'): ?>
    <main>
    <h1><i class="fa-solid fa-user-plus"></i> Account aanmaken</h1>
    <form method="post" class="register-form">
        <label>
        Gebruikersnaam:<br>
        <input type="text" name="username">
        </label>
        <br><br>

        <label>
        E-mailadres:<br>
        <input type="email" name="email">
        </label>
        <br><br>

        <label>
        Wachtwoord:<br>
        <input type="password" name="password">
        </label>
        <br><br>

        <label>
        Bevestig wachtwoord:<br>
        <input type="password" name="password_confirm">
        </label>
        <br><br>

        <button type="submit" name="register"><i class="fa-solid fa-check"></i> Account aanmaken</button>
        <p class="error"><?=  $errorMsg ?? ''; ?></p>
    </form>
    </main>
<?php endif; ?>
