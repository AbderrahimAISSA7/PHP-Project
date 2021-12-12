<?php
//  créer les fonctions ici
/**
*Afficher les attributs
*@param n,b
*@return lesValeursDe_a_et_b
**/
function afficheVar(int $n,string $s) : string {
  return '$n vaut '.$n.' et $s vaut '.$s;
}

/**
*Repeter le texte $n fois
*@param n : nombre de repetiton
*@param texte : le texte
*@return resultat : string en html represente la repetion de texte donné $n fois
**/
function n_parag(string $texte, int $n):string{
  $resultat = "";
  for($i=0;$i<$n;$i++){
    $resultat = "<p> {$texte} </p>".$resultat;
  }
  return $resultat;
}

/**
*c'est pour avoir un paragraphe contenant uniquement les $a premiers caractères de la chaîne.
*@param a : nombre de caractere souhaité
*@param s : le string
*@return s : string en html represente le paragraphe de $a caracteres
**/
function paragrapheTronque(string $s,int $a):string{
  $s=substr($s,0,$a);
  return $s;
}
/**
*Le résultat sera une chaîne contenant le source HTML de plusieurs paragraphes : le premier contient la chaîne, le suivant la chaîne privée de son dernier caractère,...etc.
*@param s : le string
*@return resultat : string en html represente le paragraphe souhaité.
**/
function diminue($s):string{
  $resultat = "";
  $l = strlen($s);
  for($i=0;$i<=$l;$i++){
    $su = substr($s,0,$i);
    $resultat = "<p> $su </p>".$resultat;
  }
  return $resultat;
}
/**
*Le résultat sera une liste HTML : le premier contient la chaîne, le suivant la chaîne privée de son dernier caractère,...etc.
*@param s : le string
*@return resultat : string en html represente la liste souhaité.
**/
function diminue_liste($s):string{
  $resultat = "";
  $l = strlen($s);

  for($i=0;$i<=$l;$i++){
    $su = substr($s,0,$i);
    if($i==0) $resultat = "<ul><li> $su </li>".$resultat;
    elseif ($i==$l) $resultat = "<li> $su </li></ul>".$resultat;
    else $resultat = "<li> $su </li>".$resultat;
  }
  return $resultat;
}
/**
*Le résultat sera la multiplication de a et b
*@param a_b : les nombres
*@return MultiplicationDe_a_et_b
**/
function multiplication(int $a, int $b):string{
  $c = $a*$b;
  return "<ul><li> $a * $b = $c</li></ul>";
}
/**
*Le résultat sera une liste des operations de multiplication sur $n.
*@param n : les nombres
*@return table : table de multiplication de $n.
**/
function tableMultiplication(int $n):string{
  $table = '';
for($i=9;$i>=1;$i--){
  $memoire = $i*$n;
  if($i==0) $table = "<ul><li> $n * $i = $memoire </li>".$table;
  elseif ($i==9) $table = "<li> $n * $i = $memoire </li></ul>".$table;
  else $table = "<li> $n * $i = $memoire </li>".$table;
}
return $table;

}
/**
*Le résultat sera une liste des operations de multiplication des nombres de 1 à 9.

*@return table : table de multiplication des 1 à 9.
**/
function tableMultiplications():string{
  $table1 = '';
for($i=9;$i>=1;$i--){
  $memoire1 = tableMultiplication($i);
  if($i==0) $table1 = "<ul><li> $memoire1 </li>".$table1;
  elseif ($i==9) $table1 = "<li> $memoire1 </li></ul>".$table1;
  else $table1 = "<li> $memoire1 </li>".$table1;
}
return $table1;
}
/**
*l'en tete de tableau
*@return d : Tableau qui contient les elements de l'en tete.
**/
function ligneEntete():string{
  $d = "<table id=\"multiplications\"><tr><th>*  </th>";
  for($i=1;$i<10;$i++){
    $d = $d."<th>$i  </th>";
  }
  $d = $d."</tr>";//</table> sera à la fin de la fonction Ligne table pour avoir un seul tableau
  return $d;
}
/**
*les lignes de tableau
*@return dd : la suite de tableau qui contient les données.
**/
function ligneTable(int $mult):string{

  for($i=1;$i<10;$i++){
    if($i==1) $dd = "<th>$mult </th>";
    $memoire = $i*$mult;
    $dd = $dd."<td>$memoire  </td>";
  }
  $dd = $dd."</tr>";
  return $dd;
}
/**
*le  tableau finale
*@return resu : le tableau souhaité
**/
function tableauMult():string{
  $resu = ligneEntete();
  for($i=1;$i<10;$i++){
  $resu = $resu.ligneTable($i);
  }
$resu = $resu."</table";

return $resu;

}
/**
* supprrimer les + et transformer les mots à des paragraphes HTML
*@param text : le texte sur lequel on va travailler
*@return result : le resultat final
**/
function separateur(string $text):string{
  $result = "<p>".trim(str_replace('+','</p><p>',$text))."</p>";

  return $result;
}
/**
* supprrimer les + et transformer les mots à des paragraphes HTML
*@param text : le texte sur lequel on va travailler
*@return res :  le resultat final
**/
function enSpan(string $s):string{
  $res = "<span>".trim(str_replace('-','</span><span>',$s))."</span>";
  return $res;
}
?>
