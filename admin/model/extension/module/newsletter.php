<?php
class ModelExtensionModuleNewsletter extends Model {    
    public function getEmail() {
		$sql = "SELECT email, created FROM " . DB_PREFIX . "newsletter ORDER BY created DESC";

		$query = $this->db->query($sql);

		return $query->rows;
	}

    public function checkTable() {
        $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . DB_DATABASE . "' AND TABLE_NAME  = '" . DB_PREFIX . "newsletter'";
        
		$query = $this->db->query($sql);

		return $query->rows;
	}

    public function install() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "newsletter` (
            `newsletter_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `email` VARCHAR(255) NOT NULL,
            `created` DATE NOT NULL,
            PRIMARY KEY (`newsletter_id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8");
    }
}
