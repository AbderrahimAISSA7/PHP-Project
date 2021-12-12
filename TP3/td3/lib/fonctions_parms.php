<?php
 require(__DIR__."/color_defs.php"); // definit la constante COLOR_KEYWORDS

 /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter une couleur CSS
  *  @return : valeur retenue
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
 function checkColor(string $name, string $defaultValue) : string {
      /* à compléter */
      if(isset($_GET[$name]) && $_GET[$name] !=""|| preg_match(COLOR_REGEXP,$_GET[$name])||$_GET[$name]==="transparent"){
          if(COLOR_KEYWORDS[$_GET[$name]] === NULL) throw new ParmsException("Cette couleur n'existe pas ! ");
          else return $_GET[$name];
      }else return $defaultValue;
  }
  
 /**
  *  prend en compte le paramètre $name passé en mode GET
  *   qui doit représenter un entier sans signe
  *  @return : valeur retenue, convertie en int.
  *   - si le paramètre est absent ou vide, renvoie  $defaultValue
  *   - si le paramètre est incorrect, déclenche une exception ParmsException
  *
  */
 function checkUnsignedInt(string $name, int $defaultValue) : int {
       /* à compléter */
       if(!isset($_GET[$name]) || $_GET[$name] ==="") return $defaultValue;
       elseif(!ctype_digit($_GET[$name])) throw new ParmsException();
       else return $_GET[$name];
       
  }
     
 ?>