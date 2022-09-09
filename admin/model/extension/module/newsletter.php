<?php
class ModelExtensionModuleNewsletter extends Model {
    
    public function getEmail() {

		$sql = "SELECT email, created FROM " . DB_PREFIX . "newsletter ORDER BY created DESC";

		$query = $this->db->query($sql);

		return $query->rows;
	}

    public function verificaTabela() {

        $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . DB_DATABASE . "' AND TABLE_NAME  = '" . DB_PREFIX . "newsletter'";
        
		$query = $this->db->query($sql);

		return $query->rows;
	}

}
