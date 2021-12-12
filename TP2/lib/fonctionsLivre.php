<?php

/**
 * cette fonction va construire les elements html avec
 * les classes appropries si le param $elementClass est passe
 * et elle renvoie le code html final
 * @param string $elementType le type de l'element html
 * @param string $content le contenu du close html
 * @param string $elementClass the class du close html
 * @return string le code html final de l'element
 */
function elementBuilder(string $elementType, string  $content,string $elementClass="") : string {
    if ($elementClass != ""){
        $classPart = " class=\"$elementClass\"";
    } else {
        $classPart = "";
    }
    return "\t\t\t\t\t<$elementType$classPart>$content</$elementType>\n";
}

/**
 * cette fonction renvoie un string contenant la partie $content du fonction elementBuilder
 * llorsque $propName dans la fonction propertyToHTML est "auteur"
 * @param string $authors une chaine des auteur du livre chaque nom est separe par " - " == $propValue dans la fonction propertyToHTML
 * @return string le $content pour la fonction elementBuilder()
 */
function authorsToHTML(string $authors) : string {
    $author = explode(" - ", $authors);
    for ($i = 0; $i < sizeof($author); $i++){
        $author[$i] = "<span>".trim($author[$i])."</span>";
        if ($i != sizeof($author)-1 ){
            $author[$i] .= " ";
        }
    }
    return implode("", $author);
}

/**
* cette fonction renvoie un string contenant la partie $content du fonction elementBuilder
 * lorsque $propName dans la fonction propertyToHTML est "coverture"
 * @param string $fileName le nom de l'image (cover.jpg) == $propValue dans la fonction propertyToHTML
 * @return string le $content pour la fonction elementBuilder()
 */
function coverToHTML(string $fileName) : string {
    return "<img src=\"couvertures/$fileName\" alt=\"image de couverture\" />";
}

/**
 * la fonction qui va cree le code HTML de chaque propriete separement
 * @param string $propName
 * @param string @propValue
 * @return string le code html de chaque propriete
 */
function propertyToHTML(string $propName, string $propValue) : string {
	if($propName == "titre"){
        return elementBuilder("h2" , $propValue, $propName);
    } else if ($propName == "couverture"){
        return elementBuilder("div", coverToHTML($propValue), "couverture");
    } else if ($propName == "auteurs"){
        return elementBuilder("div", authorsToHTML($propValue), "auteurs");
    } else if ($propName == "annee"){
        return elementBuilder("time", $propValue, $propName);
    } else {
        return elementBuilder("div", $propValue, $propName);
    }
}

/**
 * cette fonction produit le code de chaque livre a partir des autres fonction
 * @param array $book une table contenant toutes les propretes present dans le fichier .txt
 * @return string the code html de chaque livre
 */
function bookToHTML(array $book) : string {
        $res = "\t\t<section>\n\t\t\t<article class=\"livre\">\n";
        if ($book["couverture"] != null){
            $res .= propertyToHTML("couverture", $book["couverture"]);
        }
        $res .= "\t\t\t\t<div class=\"description\">\n";// la couverture n'est pas inclue dans la class "description"
        foreach ($book as $cle => $valeur){
            if($cle != "couverture"){
                $res .= propertyToHTML($cle, $valeur);
            }
        }
        $res .= "\t\t\t\t</div>\n";
        $res .= "\t\t\t</article>\n";
        $res .= "\t\t</section>\n\n";
        return $res;
}


// exercice 2
/**
* on va lire les données de livres.txt et il continuera à appeler
* booktohtml tant qu'il y a un autre livre disponible
* après chaque lecture de livre, le résultat returnd (string) sera concaténé
* dans la fonction retournera tous les livres dans un code html
* @param $ datalayer un objet BookReader
* @return string le code html de plusieurs livres sur une seule page
 */
function libraryToHTML(BookReader $datalayer) : string {
    $books = "";
    while(($res = $datalayer->readBook()) != NULL){
        $books .= bookToHTML($res);
    }
    return $books;
}

?>
