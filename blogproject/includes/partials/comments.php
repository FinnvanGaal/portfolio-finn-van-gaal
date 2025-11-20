<div class="comments" id="comments">
    <div class="comment-box">
        <?php if (!empty($_SESSION['error'])): ?>
            <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form method="post">
            <textarea name="comment" placeholder="Write your comment..." required></textarea><br>
            <button class="post-comment" type="submit">Post Comment</button>
        </form>

        <div class="comments-list">
            <h2>Comments</h2>
            <?php if (empty($commentArr)): ?>
                <p>Nog geen reacties geplaatst.</p>
            <?php else: ?>
                <?php foreach ($commentArr as $comment): ?>
                    <div class="comment">
                        <?php if (!empty($comment['is_deleted'])): ?>
                            <em class="deleted-comment">
                                <?php if (!empty($comment['deleted_reason'])): ?>
                                    Dit bericht is verwijderd wegens "<?= htmlspecialchars($comment['deleted_reason']) ?>".
                                <?php else: ?>
                                    Dit bericht is verwijderd.
                                <?php endif; ?>
                            </em>
                        <?php else: ?>
                            <strong><?= ucfirst(htmlspecialchars($comment['name'])) ?></strong><br>
                            <?= htmlspecialchars($comment['comment']) ?><br>
                            <small><?= htmlspecialchars($comment['created_at']) ?></small>
                            <div class="comment-votes">
                                <form method="post" action="">
                                    <input type="hidden" name="vote" value="like">
                                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                    <button type="submit" class="btn-like">
                                        <i class="fa-solid fa-thumbs-up"></i>
                                        <?= (int)$comment['likes'] ?>
                                    </button>
                                </form>
                                <form method="post" action="">
                                    <input type="hidden" name="vote" value="dislike">
                                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                    <button type="submit" class="btn-dislike">
                                        <i class="fa-solid fa-thumbs-down"></i>
                                        <?= (int)$comment['dislikes'] ?>
                                    </button>
                                </form>
                            </div>

                            <!-- Delete knop -->
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] === (int)$comment['user_id']): ?>
                                <form method="post" action="/rea-1/PHP/26-eindopdracht-php/mijn-blog/<?= urlencode($comment['slug']) ?>/delete_comment/<?= $comment['id'] ?>">
                                    <select name="reason" class="delete-reason">
                                        <option value="">Reden kiezen (optioneel)</option>
                                        <option value="Ongepast taalgebruik">Ongepast taalgebruik</option>
                                        <option value="Spam of reclame">Spam of reclame</option>
                                        <option value="Niet relevant">Niet relevant</option>
                                        <option value="Anders">Anders</option>
                                    </select>
                                    <button type="submit" class="btn-delete"
                                            onclick="return confirm('Weet je zeker dat je deze reactie wil verwijderen?')">
                                        <i class="fa-solid fa-trash"></i> Verwijderen
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
