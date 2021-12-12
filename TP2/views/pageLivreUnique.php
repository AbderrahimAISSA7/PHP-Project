<?php /*


   Assert : Une variable globale nommée $bookHTML contient le code HTML permettant l'affcihage d'un livre

*/
$bookHTML = coverToHTML("dune.jpg");

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Bibliothèque</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href=""/>
    </head>
    <body>
        <header>
            <h1>Bibliothèque</h1>
        </header>

        <?php
          echo $bookHTML;
          echo bookToHTML(readbook());
          elementBuilder();
        ?>
    </body>

</html>
