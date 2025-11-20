<?php
$key = $_GET['post'] ?? '';

$recipe = $recipes[$key] ?? null;
$post = $postContent[$key] ?? null;

$ingredients = json_decode($recipe['ingredients'], true);
$steps = json_decode($recipe['steps'], true);
?>
<div class="recipe">
    <div class="recipecontainer">
        <h1><?= htmlspecialchars($post['title']) ?></h1>

        <h3>
            <i class="fa-solid fa-user"></i>
            Geschreven door: <?= ucfirst(htmlspecialchars($post['username'])) ?>
        </h3>

        <h3 class="date">Gepubliceerd op <?= htmlspecialchars($post['created_at']) ?></h3>
        <div class="post-content">
            <?= $recipe['content'] ?>
        </div>

        <p>Porties: <?= htmlspecialchars($recipe['serves']) ?></p>
        <p>Bereidingstijd: <?= htmlspecialchars($recipe['total_minutes']) ?> minuten</p>

        <h3>Ingrediënten:</h3>
        <ul>
            <?php foreach ($ingredients as $ingredient): ?>
                <li><?= htmlspecialchars($ingredient) ?></li>
            <?php endforeach; ?>
        </ul>

        <h3>Bereiding:</h3>
        <ol>
            <?php foreach ($steps as $step): ?>
                <li><?= htmlspecialchars($step) ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
</div>
