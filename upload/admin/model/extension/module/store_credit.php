<?php
class ModelExtensionModuleStoreCredit extends Model {
    public function addCredit($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "customer_credit SET customer_id = '" . (int)$data['customer_id'] . "', amount = '" . (float)$data['amount'] . "', date_added = NOW()");
    }

    public function getCredits($customer_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_credit WHERE customer_id = '" . (int)$customer_id . "'");

        return $query->rows;
    }
}
