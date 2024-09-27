<section id="messenger-section" arialabelledby="messenger-title">  
    <div class="messaging-container">
        <div class="conversations-list">
            <?php foreach ($conversations as $conversation): ?>
                <div class="conversation-item">
                    <a href="index.php?action=showMessages&user_id=<?= $conversation['participant_id'] ?>">
                        <?php
                        $picturePath = "css/user_pic/" . $conversation['profile_picture'];
                        echo '<img src="' . $picturePath . '" alt="Photo de profil">';                
                        ?>
                        <p><?= $conversation['username'] ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        
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
