<section id="messenger-section" arialabelledby="messenger-title">  
    <div class="messaging-container">
        <!-- Colonne des conversations -->
        <div class="conversations-list">
            <h2 id="messenger-title">Messagerie</h2>
            <?php foreach ($conversations as $conversation): ?>
                <div class="conversation-item">
                    <a href="index.php?action=messages&user_id=<?= htmlspecialchars($conversation['participant_id']) ?>">
                        <div class="conversation-content">
                            <!-- Affiche la photo de profil -->
                            <div class="profile-picture">
                                <?php
                                $picturePath = "css/user_pic/" . $conversation['profile_picture'];
                                echo '<img src="' . $picturePath . '" alt="Photo de profil">';
                                ?>
                            </div>

                            <!-- Affiche le pseudo, le dernier message et la date -->
                            <div class="conversation-text">
                                <div class="conversation-header">
                                    <p class="username"><?= $conversation['username'] ?></p>
                                    <p class="last-message-date">
                                        <?php
                                        $sentDate = new DateTime($conversation['sent_at']);
                                        $now = new DateTime();
                                        echo $sentDate->format('Y-m-d') === $now->format('Y-m-d') ? $sentDate->format('H:i') : $sentDate->format('d.m');
                                        ?>
                                    </p>
                                </div>
                                <p class="last-message"><?= substr($conversation['message'], 0, 30) ?>...</p>
                            </div>
                        </div>
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
                    <div class="message <?= $message['sender_id'] === $currentUser['id'] ? 'message-self' : 'message-other' ?>">
                        <?php if ($message['sender_id'] !== $currentUser['id']): ?>
                            <!-- Affiche la photo de profil uniquement pour l'autre utilisateur -->
                            <img src="css/user_pic/<?= $otherUser['profile_picture'] ?>" alt="Photo de profil" class="message-profile-pic">
                        <?php endif; ?>

                        <div class="message-info">
                            <p class="message-date"><?= date('d.m H:i', strtotime($message['sent_at'])) ?></p>
                            
                            <div class="message-content">
                                <p><?= htmlspecialchars($message['message']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


            <form method="post" action="index.php?action=sendMessage">
                <input type="hidden" name="conversation_id" value="<?= htmlspecialchars($activeConversationId) ?>">
                <textarea name="message_content" placeholder="Tapez votre message ici" required></textarea>
                <!-- <div class="text-box" contenteditable="true" placeholder="Tapez votre message ici" oninput="adjustHeight(this)"></div> -->
                <button type="submit" class="submit">Envoyer</button>
            </form>
        </div>
    </div>
</section>
