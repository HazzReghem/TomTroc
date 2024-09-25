<section id="messenger-section" arialabelledby="messenger-title">  
    <div class="messaging-container">
        <div class="conversations-list">
            <?php foreach ($conversations as $conversation): ?>
                <div class="conversation-item">
                    <a href="index.php?action=showMessages&user_id=<?= $conversation['participant_id'] ?>">
                        <p><?= $conversation['username'] ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        
        <div class="messages-section">
            <div class="messages-header">
            <h2>Conversation avec <?= isset($currentUser) ? htmlspecialchars($currentUser['username']) : 'Utilisateur inconnu' ?></h2>
            </div>
            <div class="messages">
            
                <?php foreach ($messages as $message): ?>
                    <div class="message">
                        <p><strong><?= $message['username'] ?>:</strong> <?= $message['message'] ?></p>
                        <p><?= $message['sent_at'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <form method="post" action="index.php?action=sendMessage&user_id=<?= $currentUser['id'] ?>">
                <textarea name="message_content" placeholder="Écrire un message..." required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
</section>
