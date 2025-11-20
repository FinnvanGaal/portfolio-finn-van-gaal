<<<<<<< HEAD
<aside>
    <h1>Recente Posts</h1>
    <ul>
        <?php if (!empty($recentPosts)): ?>
            <?php foreach ($recentPosts as $post): ?>
                <li>
                    <a href=<?= urlencode($post['slug']) ?>>
                        <?= htmlspecialchars($post['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Geen recente posts gevonden.</li>
        <?php endif; ?>
    </ul>
</aside>
=======
<aside>
    <h1>Recente Posts</h1>
    <ul>
        <?php if (!empty($recentPosts)): ?>
            <?php foreach ($recentPosts as $post): ?>
                <li>
                    <a href=<?= urlencode($post['slug']) ?>>
                        <?= htmlspecialchars($post['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Geen recente posts gevonden.</li>
        <?php endif; ?>
    </ul>
</aside>
>>>>>>> 38ab6e3b03704417fcdbae3e967854145f00a340
