<?php
    spl_autoload_register(function($classe){// fonction anonyme
        require "lib/$classe.class.php";
    }); // règle de chargement des classes
    require("etc/dsn_filename.php"); // definition de DSN_FILENAME

    require("lib/fonctionsLivre.php");
    require("lib/fonctions_parms.php");
 
    try {
        // author_id : entier sans signe - obligatoire
        // à compléter
        $dl = new DataLayer(DSN_FILENAME);
        $authorId = checkUnsignedInt('author_id');
        $books = $dl->getBooksByAuthor($authorId);
        $libraryHTML = booksArrayToHTML($books);
        require("views/pageBibliotheque.php");
        
    } catch (ParmsException $e) {
        require "views/pageErreur.php";
    }
?>