<?php
class FileBookReader implements BookReader{

	private $file; // file resource

	function __construct(string $fileName){
		$this->file = fopen($fileName,'r');
	}


	function readBook() : ?array {
		//passe les lignes vides
		$line = fgets($this->file);
		while(($line !== FALSE) && (trim($line) == ""))
			$line = fgets($this->file);
		// $line == FALSE OU line n'est pas vide
		if ($line !== FALSE) {
			// j'ai trouve un livre
			$res = array();
			while (($line !== FALSE) && (trim($line) != "")) {
				$pos = strpos($line, ':');
				if ($pos === FALSE) {
					throw new Exception('absence de :');
				}
				$cle = trim(substr($line, 0, $pos));
				$valeur = trim(substr($line, $pos+1));
				$res[$cle] = $valeur;
				$line = fgets($this->file);
			}
			//$line FALSE Ou lin est vide

		} else {
			// plus de livre
			$res = NULL;
		}
		return $res;

	}


}

?>
