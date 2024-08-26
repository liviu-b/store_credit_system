<?php
class ModelExtensionModuleStoreCredit extends Model {
    
    public function addCredit($customer_id, $amount) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer_credit SET customer_id = '" . (int)$customer_id . "', amount = '" . (float)$amount . "', date_added = NOW()");
    }

    public function getCredits($customer_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_credit WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC");

        return $query->rows;
    }

    public function getTotalCredits($customer_id) {
        $query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_credit WHERE customer_id = '" . (int)$customer_id . "'");

        return $query->row['total'];
    }

    public function redeemCredits($customer_id, $amount) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer_credit SET customer_id = '" . (int)$customer_id . "', amount = '-" . (float)$amount . "', date_added = NOW()");
    }
}
