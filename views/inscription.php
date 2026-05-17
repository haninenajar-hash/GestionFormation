<?php
$pageTitle = 'Inscription';
require 'views/partials/header.php';
require 'views/partials/navbar.php';
?>

<main>
    <div class="page-header">
        <div class="container">
            <h1>Formulaire d'inscription</h1>
            <p>Remplissez vos informations pour vous inscrire a une formation.</p>
        </div>
    </div>

    <section class="section">
        <div class="container container-sm">

            <?php if (!empty($erreurs)): ?>
            <div class="alert alert-error">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul>
                    <?php foreach ($erreurs as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <div class="form-card">
                <form method="POST" action="index.php?page=inscription" id="form-inscription" novalidate>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input
                                type="text"
                                id="nom"
                                name="nom"
                                placeholder="Votre nom"
                                value="<?= htmlspecialchars($old['nom'] ?? '') ?>"
                                required
                            >
                            <span class="field-msg" id="msg-nom"></span>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input
                                type="text"
                                id="prenom"
                                name="prenom"
                                placeholder="Votre prénom"
                                value="<?= htmlspecialchars($old['prenom'] ?? '') ?>"
                                required
                            >
                            <span class="field-msg" id="msg-prenom"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="vous@exemple.com"
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                            required
                        >
                        <span class="field-msg" id="msg-email"></span>
                    </div>

                    <div class="form-group">
                        <label for="age">Age <span class="optional">(optionnel)</span></label>
                        <input
                            type="number"
                            id="age"
                            name="age"
                            placeholder="Votre age"
                            value="<?= htmlspecialchars($old['age'] ?? '') ?>"
                            min="16"
                            max="75"
                        >
                    </div>

                    <div class="form-group">
                        <label for="formation_id">Formation choisie</label>
                        <select id="formation_id" name="formation_id" required>
                            <option value="">-- Sélectionner une formation --</option>
                            <?php foreach ($formations as $f): ?>
                            <option
                                value="<?= $f['id'] ?>"
                                <?= (($old['formation_id'] ?? 0) == $f['id']) ? 'selected' : '' ?>
                            >
                                <?= htmlspecialchars($f['titre']) ?> — <?= number_format($f['prix'], 0, ',', ' ') ?> DT
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="field-msg" id="msg-formation"></span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-full">
                        Continuer vers le paiement
                    </button>

                </form>
            </div>

        </div>
    </section>
</main>

<?php require 'views/partials/footer.php'; ?>
