<section id="messenger-section" arialabelledby="messenger-title">  
    <div class="messaging-container">
        <!-- Colonne des conversations -->
        <div class="conversations-list">
            <h2 id="messenger-title">Messagerie</h2>
            <?php foreach ($conversations as $conversation): ?>
                <div class="conversation-item">
                    <a href="index.php?action=showMessages&conversation_id=<?= $conversation['conversation_id'] ?>">
                        <?php
                        $picturePath = "css/user_pic/" . $conversation['profile_picture'];
                        echo '<img src="' . $picturePath . '" alt="Photo de profil">';                
                        ?>
                        <p><?= htmlspecialchars($conversation['username']) ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Section des messages -->
        <div class="messages-section">
            <div class="messages-header">
                <?php
                    $picturePath = "css/user_pic/" . $otherUser['profile_picture'];
                    echo '<img src="' . $picturePath . '" alt="Photo de profil">';                
                ?>
                <h2><?= isset($otherUser) ? htmlspecialchars($otherUser['username']) : 'Utilisateur inconnu' ?></h2>
            </div>
            <div class="messages">
                <?php foreach ($messages as $message): ?>
                    <div class="message">
                        <p><strong><?= htmlspecialchars($message['username']) ?>:</strong> <?= htmlspecialchars($message['message']) ?></p>
                        <p><?= htmlspecialchars($message['sent_at']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <form method="post" action="index.php?action=sendMessage">
                <input type="hidden" name="conversation_id" value="<?= htmlspecialchars($activeConversationId) ?>">
                <textarea name="message_content" placeholder="Écrire un message..." required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
</section>
