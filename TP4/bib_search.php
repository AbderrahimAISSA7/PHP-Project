<?php
    spl_autoload_register(function($classe){// fonction anonyme
        require "lib/$classe.class.php";
    }); // règle de chargement des classes
    require("etc/dsn_filename.php"); // definition de DSN_FILENAME

    require("lib/fonctionsLivre.php");
    require("lib/fonctions_parms.php");
 
    try {
        // à compléter
        $year = checkUnsignedInt('year', NULL, FALSE);//$_GET['year']
        $authorId = checkUnsignedInt('author_id', NULL, FALSE);
        $word = checkString('word', NULL, FALSE);
        $categorie = checkString('categorie', NULL, FALSE);
        
        $dl = new DataLayer(DSN_FILENAME);// CREATE THE PDO OBJECT 
        $books = $dl->getBooksWithConds($year, $authorId, $word, $categorie);
        $libraryHTML = booksArrayToHTML($books);
        require("views/pageBibliotheque.php");
        
    } catch (ParmsException $e) {
        require "views/pageErreur.php";
    }
?>