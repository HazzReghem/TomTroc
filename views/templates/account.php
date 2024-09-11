<!-- TEMPLATE DE MON COMPTE -->

<section id="account-section" arialabelledby="account-section-title">
    
    <h1 id="account-section-title">Mon compte</h1>


    <div class="userContainer">
        <!-- Formulaire de mise à jour de la photo de profil -->
        <div class="userPicture">    
            <?php
                $picturePath = "css/user_pic/" . $user['profile_picture'];
                echo '<img src="' . $picturePath . '" alt="Photo de profil">';                
            ?>
            
            <form action="index.php?action=updateProfilePicture" method="post" enctype="multipart/form-data">
                
                <label for="profile_picture" class="custom-file-upload">modifier</label>
                <input type="file" id="profile_picture" name="profile_picture" onchange="this.form.submit()" accept="image/*">

            </form>

            <p class="lineTwo">_________________________________________</p>

            <h2><?= htmlspecialchars($user['username']) ?></h2>
        </div>

        <!-- Formulaire de mise à jour des informations personnelles -->
        <div class="userInfo">
            <form action="index.php?action=updateUserInfo" method="post">

                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

                 
                
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="********">
                
                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                
                <button class="submit-bg" type="submit">Enregistrer</button>

            </form>
        </div>
    </div>

    <!-- Liste des livres ajoutés par l'utilisateur -->
    <div>
        <table class="tableBooks">
            <thead>
                <tr>
                    <th class="tableHead">
                        PHOTO
                    </th>
                    <th class="tableHead">
                        TITRE
                    </th>
                    <th class="tableHead">
                        AUTEUR
                    </th>
                    <th class="tableHead">
                        DESCRIPTION
                    </th>
                    <th class="tableHead">
                        DISPONIBILITE
                    </th>
                    <th class="tableHead">
                        ACTION
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userBooks as $userBook) { ?>
                    <tr class="tableCell">
                        <td>
                        <?php 
                            $imagePath = "css/assets/" . $userBook['image'];
                            echo '<img src="' . $imagePath . '" alt="' . $userBook['title'] . '">';    
                        ?>
                        </td>
                        <td><?= htmlspecialchars($userBook['title']) ?></td>
                        <td><?= htmlspecialchars($userBook['author']) ?></td>
                        <td><p><?= htmlspecialchars($userBook['description']) ?></p></td>
                        <td >
                            <?php if ($userBook['availability_status'] !== 'Disponible'): ?>
                                <span class="availability-banner-no"><?= htmlspecialchars($userBook['availability_status']) ?></span>
                            <?php elseif ($userBook['availability_status'] == 'Disponible'): ?>
                                <span class="availability-banner-yes"><?= htmlspecialchars($userBook['availability_status']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($userBook['author']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</section>