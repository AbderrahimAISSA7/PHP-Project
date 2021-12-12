<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Premier exercice PHP</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="iniPHP.css" />
    </head>
    <body>
        <header>
            <h1>Premier exercice PHP</h1>
            <h2>Réalisé par <span class="nom">Abderrahim AISSA</span></h2>
        </header>
        <!-- section résultat. Créer une section pour chaque question -->
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p>Nous sommes le <?= date('d / m / Y') ?></p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= afficheVar(18,'Age') ?> </p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= n_parag('Bonjour',10) ?> </p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= paragrapheTronque('Bonjour',4) ?> </p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= diminue('Bonjour') ?> </p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= diminue_liste('Bonjour') ?> </p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= multiplication(7,9) ?> </p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= tableMultiplication(2) ?> </p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= tableMultiplications() ?> </p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= tableauMult() ?> </p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= separateur('Rendu TP1 de TW2 + Le 10/10/2020 + Réaliser par : AISSA Abderrahim ') ?> </p>
        </section>
        <section>
            <h2>Question <?= $num_quest++ ?></h2>
            <p><?= enSpan('Rendu TP1 de TW2 - Le 10/10/2020 - Réaliser par : AISSA Abderrahim ') ?> </p>
        </section>
    </body>

</html>
