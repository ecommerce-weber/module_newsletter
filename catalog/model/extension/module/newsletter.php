<?php
class ModelExtensionModuleNewsletter extends Model {
    public function register($email, $date) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "newsletter WHERE email = '" . $this->db->escape($email) . "'");
        
        if ($query->num_rows == 0) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "newsletter SET email = '" . $this->db->escape($email) . "', created = '" . $this->db->escape($date) . "'");
            return true;
        }
        
        return false;
    }
}
