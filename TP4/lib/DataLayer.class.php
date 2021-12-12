<?php
/**
 * Classe dédiée à l'interrogation de la base de données
 * 
 */
class DataLayer {
	// private ?PDO $conn = NULL; // le typage des attributs est valide uniquement pour PHP>=7.4
	private  $conn = NULL; // connexion,  de type PDO 
	
	/**
	 * @param $DSNFileName : file containing DSN 
	 */
	function __construct(string $DSNFileName){
		$dsn = "uri:$DSNFileName";
		$this->conn = new PDO($dsn);
		// paramètres de fonctionnement de PDO :
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // déclenchement d'exception en cas d'erreur
		$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // fetch renvoie une table associative
		// réglage d'un schéma par défaut :
		$this->conn->query('set search_path=livres');
	}
	/*
	* PDO::ATTR_ERRMODE: Error reporting.
     	PDO::ERRMODE_SILENT: Just set error codes.
      	PDO::ERRMODE_WARNING: Raise E_WARNING.
      	PDO::ERRMODE_EXCEPTION: Throw exceptions.

	PDO::ATTR_DEFAULT_FETCH_MODE: Set default fetch mode.
		PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set 
	*/

	/**
	 * user et password
	 */

	/**
	 * Liste des livres de la base (renvoie un tableau de livres)
	 * un livre est représenté par une table associative
	 */
	function getBooks() : array {
		$sql = <<<EOD
			select titre, annee, categorie, serie, couverture, auteurs 
			from livres_complets
EOD;
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	/**
	 * Liste des auteurs (renvoie un tableau d'auteurs)
	 * chaque auteur est représenté par une table comportant les clés id et nom
	 */
	function getAuthors() : array {
	  // à compléter
	  $sql = <<<EOD
			select id, nom
			from auteurs
EOD;
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/**
	 * Liste des annees (renvoie un tableau d'annees UNIQUES)
	 * chaque annee est représenté par une table comportant le cle annee
	 */
	function getYears() : array {
		// à compléter
		$sql = <<<EOD
			select DISTINCT annee
			from livres
EOD;
		  $stmt = $this->conn->prepare($sql);
		  $stmt->execute();
		  return $stmt->fetchAll();
	  }

	/**
	 * Liste des categories (renvoie un tableau de categories UNIQUES)
	 * chaque categorie est représenté par une table comportant le cle categorie
	 */
	function getCategories() : array {
		// à compléter
		$sql = <<<EOD
			select DISTINCT categorie
			from livres
EOD;
		  $stmt = $this->conn->prepare($sql);
		  $stmt->execute();
		  return $stmt->fetchAll();
	  }



	/**
	 * Recherche les livres de la base selon leur auteur (renvoie un tableau de livres)
	 * @param int $authorId : identifiant de l'auteur recherché
	 */
	function getBooksByAuthor(int $authorID) : array {
		$sql = <<<EOD
			select titre, annee, categorie, serie, couverture
			from livres
			where id in (select livre from ecriture where auteur=:authorid)
EOD;
		// à compléter
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue('authorid', $authorID);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	/**
	 * Recherche les livres de la base selon l'année de parution (renvoie un tableau de livres)
	 * @param int $year : année de parution 
	 */
	function getBooksByYear(int $year) : array {
		// à compléter
		$sql = <<<EOD
		select id, titre, categorie, serie, couverture, annee 
		from livres
		where annee = :year
EOD;
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue('year', $year);
		$stmt->execute();
		return $stmt->fetchAll();
	}
		
	
// Pour les questions 4 et 5 
	/**
	 * Recherche les livres de la base selon plusieurs critères cumulatifs (renvoie un tableau de livres)
	 * @param int $year : année de parution
	 * @param int $authorId : identifiant de l'auteur
	 *
	 * un critère est ignoré quand la valeur NULL est fournie
	 */
	function getBooksWithConds(?int $year=NULL, ?int $authorId=NULL, ?string $word = NULL, ?string $categorie = NULL){
		$sql = <<<EOD
			select titre, annee, categorie, serie, couverture
			from livres
EOD;
		$conds = [];  // tableau contenant les code SQL de chaque condition à appliquer
		$binds = [];   // association entre le nom de pseudo-variable et sa valeur
		if ($year != NULL){
			$conds[] .= "annee = :year";
			$binds[':year'] = $year;
			debug_to_console("year n'est pas NULL");
		}
		if ($authorId != NULL){
			$conds[] .= "id in (select livre from ecriture where auteur=:authorid)";
			$binds[':authorid'] = $authorId;
			debug_to_console("author_id n'est pas NULL");
		}
		if ($word != NULL){
			$conds[] .= "titre ILIKE :word";
			$binds[':word'] = "%$word%";// % wildcard 
		}
		if ($categorie != NULL){
			$conds[] .= "categorie = :categorie";
			$binds[':categorie'] = $categorie;
		}
		if (count($conds)>0){ // il ya au moins une condition à appliquer ---> ajout d'ue clause where
			$sql .= " where ". implode(' and ', $conds); // les conditions sont reliées par AND
		}
		$stmt = $this->conn->prepare($sql);
		$stmt->execute($binds);
		return $stmt->fetchAll();
	}

	
}


?>
