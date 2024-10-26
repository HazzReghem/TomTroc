<section id="messenger-section" aria-labelledby="messenger-title">  
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
                                    // Chemin par défaut de la photo de profil
                                    $defaultPicturePath = "css/user_pic/default.webp"; // Assurez-vous que ce chemin est correct

                                    // Vérifiez si l'utilisateur a une photo de profil
                                    $picturePath = !empty($conversation['profile_picture']) ? "css/user_pic/" . $conversation['profile_picture'] : $defaultPicturePath;

                                    echo '<img src="' . $picturePath . '" alt="Photo de profil" class="profilePicture">';
                                ?>
                            </div>

                            <!-- Affiche le pseudo, le dernier message et la date -->
                            <div class="conversation-text">
                                <div class="conversation-header">
                                    <p class="username"><?= htmlspecialchars($conversation['username']) ?></p>
                                    <?php if (!empty($conversation['sent_at'])): ?>
                                        <p class="last-message-date">
                                            <?php
                                            $sentDate = new DateTime($conversation['sent_at']);
                                            $now = new DateTime();
                                            echo $sentDate->format('Y-m-d') === $now->format('Y-m-d') ? $sentDate->format('H:i') : $sentDate->format('d.m');
                                            ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($conversation['message'])): ?>
                                    <p class="last-message"><?= htmlspecialchars(substr($conversation['message'], 0, 30)) ?>...</p>
                                <?php endif; ?>
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
                // Chemin par défaut de la photo de profil
                $defaultPicturePath = "css/user_pic/default.webp"; // Assurez-vous que ce chemin est correct

                // Vérifiez si l'utilisateur a une photo de profil
                $picturePath = !empty($otherUser->getProfilePicture()) ? "css/user_pic/" . $otherUser->getProfilePicture() : $defaultPicturePath;

                echo '<img src="' . $picturePath . '" alt="Photo de profil" class="profilePicture">';
                ?>
                <h2><?= isset($otherUser) ? htmlspecialchars($otherUser->getUsername()) : 'Utilisateur inconnu' ?></h2>
            </div>
            <div class="messages">
                <?php foreach ($messages as $message): ?>
                    <div class="message <?= $message['sender_id'] === $currentUser->getId() ? 'message-self' : 'message-other' ?>">
                    <?php if ($message['sender_id'] !== $currentUser->getId()): ?>
                            <!-- Affiche la photo de profil uniquement pour l'autre utilisateur -->
                            <img src="css/user_pic/<?= htmlspecialchars($otherUser->getProfilePicture()) ?>" alt="Photo de profil" class="message-profile-pic">
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
                <button type="submit" class="submit">Envoyer</button>
            </form>
        </div>
    </div>
</section>
