<?php
$base = '/rea-1/PHP/26-eindopdracht-php/mijn-blog';
?>
<!-- Tab: Mijn Recepten -->
<?php if ($currentTab === 'posts'): ?>
<div class="content content--slider">
    <h1>Mijn Recepten</h1>
    <div class="posts-slider" id="slider">
        <?php if (!empty($userPosts)): ?>
            <?php foreach ($userPosts as $postItem): ?>
                <div class="post-card">
                    <img class="post-img" src="images/<?= htmlspecialchars($postItem['image']) ?>" alt="">
                    <h3><?= htmlspecialchars($postItem['title']) ?></h3>
                    <p><i class="fa-solid fa-user"></i> Geschreven door: <?= ucfirst(htmlspecialchars($postItem['username'])) ?></p>

                    <div class="post-actions">
                    <a href="<?= $base ?>/profile/edit/<?= urlencode($postItem['slug']) ?>" class="btn-edit">
                        <i class="fa-solid fa-pen"></i> Bewerken
                    </a>

                    <form method="post" action="<?= $base ?>/profile/posts" style="display:inline;"
                        onsubmit="return confirm('Weet je zeker dat je dit recept wil verwijderen?')">
                        <input type="hidden" name="delete_post" value="true">
                        <input type="hidden" name="slug" value="<?= htmlspecialchars($postItem['slug']) ?>">
                        <button type="submit" class="btn-delete">
                            <i class="fa-solid fa-trash"></i> Verwijderen
                        </button>
                    </form>


                    </div>
                    </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-posts">
                <i class="fa-solid fa-utensils fa-2xl"></i>
                <h2>Nog geen gerechten geplaatst</h2>
                <p>Je hebt nog geen recepten toegevoegd. Klik hieronder om je eerste gerecht te maken.</p>
                <a href="<?= $base ?>/profile/create" class="btn">Nieuw gerecht toevoegen</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Tab: Nieuw gerecht -->
<?php elseif ($currentTab === 'create'): ?>
<div class="content content--form">
    <h1>Nieuw gerecht toevoegen</h1>
    <form method="post" action="<?= $base ?>/profile/create" class="create-post-form" enctype="multipart/form-data">
        <?php if (!empty($_SESSION['error'])): ?>
    <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

        <!-- Titel -->
        <label>Titel:<br>
            <input type="text" name="title" required>
        </label><br><br>

        <!-- Omschrijving -->
        <label>Omschrijving:<br>
            <textarea name="content" class="wysiwyg" rows="6" required></textarea>
        </label><br><br>

        <!-- Porties -->
        <label>Aantal porties:<br>
            <input type="number" name="serves" min="1" required>
        </label><br><br>

        <!-- Bereidingstijd -->
        <label>Totale bereidingstijd (minuten):<br>
            <input type="number" name="total_minutes" min="1" required>
        </label><br><br>

        <!-- Ingrediënten -->
        <label>Ingrediënten (één per regel):<br>
            <textarea  name="ingredients" rows="5" placeholder="Bijv.&#10;400 g spaghetti&#10;150 g pancetta&#10;2 eieren" required></textarea>
        </label><br><br>

        <!-- Stappen -->
        <label>Bereidingsstappen (één per regel):<br>
            <textarea name="steps" rows="5" placeholder="Bijv.&#10;Kook de pasta&#10;Bak de spek" required></textarea>
        </label><br><br>

        <!-- Afbeelding -->
        <label>Afbeelding uploaden:<br>
            <input type="file" name="image" accept="image/*">
        </label><br><br>

        <!-- Submit -->
        <button type="submit" name="create_post">
            <i class="fa-solid fa-check"></i> Opslaan
        </button>

        <?= !empty($errorMsg) ? '<p class="error">'.$errorMsg.'</p>' : '' ?>
    </form>
</div>

<!-- Tab: Bewerken -->
<?php elseif ($currentTab === 'edit'): ?>
<div class="content content--form">
    <h1>Gerecht bewerken</h1>
    <form method="post" action="<?= $base ?>/profile/edit/<?= htmlspecialchars($slug) ?>" class="create-post-form" enctype="multipart/form-data">
        <?php if (!empty($_SESSION['error'])): ?>
    <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

        <!-- Titel -->
        <label>Titel:<br>
            <input type="text" name="title" value="<?= htmlspecialchars($editTitle ?? '') ?>" required>
        </label><br><br>

        <!-- Omschrijving -->
        <label>Omschrijving:<br>
            <textarea name="content" class="wysiwyg" rows="6" required><?= $editContent ?? '' ?></textarea>
        </label><br><br>

        <!-- Porties -->
        <label>Aantal porties:<br>
            <input type="number" name="serves" min="1" value="<?= (int)($editServes ?? 1) ?>" required>
        </label><br><br>

        <!-- Bereidingstijd -->
        <label>Totale bereidingstijd (minuten):<br>
            <input type="number" name="total_minutes" min="1" value="<?= (int)($editMinutes ?? 1) ?>" required>
        </label><br><br>

        <!-- Ingrediënten -->
        <label>Ingrediënten (één per regel):<br>
            <textarea name="ingredients" rows="5" required><?= htmlspecialchars($editIngredients ?? '') ?></textarea>
        </label><br><br>

        <!-- Stappen -->
        <label>Bereidingsstappen (één per regel):<br>
            <textarea name="steps" rows="5" required><?= htmlspecialchars($editSteps ?? '') ?></textarea>
        </label><br><br>

        <!-- Afbeelding -->
        <label>Nieuwe afbeelding uploaden (optioneel):<br>
            <input type="file" name="image" accept="image/*">
        </label><br><br>

        <!-- Submit -->
        <button type="submit" name="update_post">
            <i class="fa-solid fa-save"></i> Bijwerken
        </button>

        <?= !empty($errorMsg) ? '<p class="error">'.$errorMsg.'</p>' : '' ?>
    </form>
</div>

<!-- Tab: Reacties -->
<?php elseif ($currentTab === 'comments'): ?>
<div class="content">
    <h1>Reacties op jouw posts</h1>
    <!-- Reacties hier tonen -->
</div>

<!-- Tab: Account -->
<?php elseif ($currentTab === 'account'): ?>
<div class="content">
    <h1>Accountinstellingen</h1>
    <!-- Form voor wachtwoord/email wijzigen -->
</div>
<?php endif; ?>
