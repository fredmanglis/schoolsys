<?php

require_once( "Base.class.php" );

Class Person extends Base {

	private $surName;
	private $otherNames;

	function setSurName( $surName ) {

		$this -> surName = $surName;

	}

	function getSurName() {

		return $this -> surName;

	}

	function setOtherNames( $otherNames ) {

		$this -> otherNames = $otherNames;

	}

	function getOtherNames() {

		return $this -> otherNames;

	}

	function save() {

		GLOBAL $dbh;

		$returnValue = false;

		$query = '
INSERT INTO `personDetails` (
	  `uniqueID`
	, `surName`
	, `otherNames`
)
VALUES (
	  :uniqueID
	, :surName
	, :otherNames
)';

		try {

			$dbh -> beginTransaction();

				$statement = $dbh -> prepare( $query );
				$statement -> bindValue(":uniqueID", $this -> getUniqueID(), PDO::PARAM_STR);
				$statement -> bindValue(":surName", $this -> getSurName(), PDO::PARAM_STR);
				$statement -> bindValue(":otherNames", $this -> getOtherNames(), PDO::PARAM_STR);
				$statement -> execute();

			$dbh -> commit();

			$returnValue = true;

		}
		catch( PDOException $e ) {

		   print "Error!: " . $e -> getMessage() . "<br/>";
		   die();

		}

		return $returnValue;

	}

	function load() {

		GLOBAL $dbh;

		$returnValue = false;

		$query = '
SELECT
	  `surName`
	, `otherNames`
FROM
	`personDetails`
WHERE
	`uniqueID` = :uniqueID
';

		try {

			$statement = $dbh -> prepare( $query );
			$statement -> bindValue(":uniqueID", $this -> getUniqueID(), PDO::PARAM_STR);
			$statement -> execute();

			$row = $statement -> fetch();

			$this -> setSurName( $row[ "surName" ] );
			$this -> setOtherNames( $row[ "otherNames" ] );

			$returnValue = true;

		}
		catch( PDOException $e ) {

		   print "Error!: " . $e -> getMessage() . "<br/>";
		   die();

		}

		return $returnValue;

	}

	function update() {

		GLOBAL $dbh;

		$returnValue = false;

		$query = '
UPDATE
	`personDetails`
SET
	  `surName` = :surName
	, `otherNames` = :otherNames
WHERE
	`uniqueID` = :uniqueID';

		try {

			$statement = $dbh -> prepare( $query );
			$statement -> bindValue(":surName", $this -> getSurName(), PDO::PARAM_STR);
			$statement -> bindValue(":otherNames", $this -> getOtherNames(), PDO::PARAM_STR);
			$statement -> bindValue(":uniqueID", $this -> getUniqueID(), PDO::PARAM_STR);
			$statement -> execute();

			$returnValue = true;

		}
		catch( PDOException $e ) {

		   print "Error!: " . $e -> getMessage() . "<br/>";
		   die();

		}

		return $returnValue;

	}

	function __construct( $uniqueID = DEFAULT_UNIQUE_ID,
						  $surName = "",
						  $otherNames = "" ) {

		parent::__construct( $uniqueID );

		if( $uniqueID != "00000" ) {

			$this -> load();

		}
		else {

			if( $surName != "" ) {

				$this -> setSurName( $surName );

			}

			if( $otherNames != "" ) {

				$this -> setOtherNames( $otherNames );

			}

		}

	}

}

?>
