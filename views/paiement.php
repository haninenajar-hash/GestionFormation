<?php
$pageTitle = 'Paiement';
require 'views/partials/header.php';
require 'views/partials/navbar.php';
?>

<main>
    <div class="page-header">
        <div class="container">
            <h1>Confirmation du paiement</h1>
            <p>Vérifiez votre commande avant de finaliser l'inscription.</p>
        </div>
    </div>

    <section class="section">
        <div class="container container-sm">

            <div class="summary-card">
                <h3>Résumé de la commande</h3>
                <table class="summary-table">
                    <tr>
                        <td>Formation</td>
                        <td><strong><?= htmlspecialchars($inscription['formation_titre']) ?></strong></td>
                    </tr>
                    <tr>
                        <td>Durée</td>
                        <td><?= htmlspecialchars($inscription['duree']) ?></td>
                    </tr>
                    <tr>
                        <td>Niveau</td>
                        <td><?= htmlspecialchars($inscription['niveau']) ?></td>
                    </tr>
                    <tr>
                        <td>Etudiant</td>
                        <td><?= htmlspecialchars($inscription['prenom'] . ' ' . $inscription['nom']) ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?= htmlspecialchars($inscription['email']) ?></td>
                    </tr>
                    <tr class="total-row">
                        <td>Total à payer</td>
                        <td><strong><?= number_format($inscription['prix'], 0, ',', ' ') ?> DT</strong></td>
                    </tr>
                </table>
            </div>

            <div class="form-card">
                <h3>Mode de paiement</h3>
                <p class="paiement-note">
                    Ceci est une simulation. Aucune donnée bancaire réelle n'est traitée.
                </p>

                <form method="POST" action="index.php?page=paiement&id=<?= $inscription['id'] ?>">

                    <div class="form-group">
                        <label for="num_carte">Numéro de carte</label>
                        <input
                            type="text"
                            id="num_carte"
                            placeholder="1234 5678 9012 3456"
                            maxlength="19"
                            autocomplete="off"
                        >
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="expiration">Date d'expiration</label>
                            <input type="text" id="expiration" placeholder="MM/AA" maxlength="5">
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" placeholder="123" maxlength="4">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="titulaire">Nom du titulaire</label>
                        <input type="text" id="titulaire" placeholder="NOM Prénom">
                    </div>

                    <input type="hidden" name="mode" value="payer">

                    <button type="submit" class="btn btn-primary btn-full">
                        Payer <?= number_format($inscription['prix'], 0, ',', ' ') ?> DT
                    </button>

                </form>
            </div>

        </div>
    </section>
</main>

<?php require 'views/partials/footer.php'; ?>
