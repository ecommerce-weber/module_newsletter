<?php
class ModelExtensionModuleNewsletter extends Model {
    public function createTable() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "newsletter` (
            `newsletter_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `email` VARCHAR(255) NOT NULL,
            `created` DATE NOT NULL,
            PRIMARY KEY (`newsletter_id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8");
   
    }

    public function insere($email, $date) {
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "newsletter SET email = '" . $this->db->escape($email) . "', 	created = '" . $this->db->escape($date) . "'");
	
	}
}
