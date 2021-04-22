<?php 

/******************************************
PRAKTIKUM RPL
******************************************/

class Task extends DB{
	
	function getTask(){
		$query = "SELECT * FROM datarental";

		return $this->execute($query);
	}
	
	function insertTask($id,$nama,  $alamat,  $jenislensa,$wakturental, $status){
		// query insert
		$sql_add = "INSERT INTO datarental  
				(id, nama, alamat, jenislensa, wakturental, status) VALUES  
				('$id', '$nama', '$alamat', '$jenislensa', '$wakturental', '$status')";

		return $this->execute($sql_add);
		
	}

	function delete($data){
        $sql = "DELETE FROM datarental WHERE id=$data";

		return $this->execute($sql);
    }

	function update($data){
		$sql = "UPDATE datarental SET status='Sudah Bayar' WHERE id=$data";

		return $this->execute($sql);
	}

}



?>
