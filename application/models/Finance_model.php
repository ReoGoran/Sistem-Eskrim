<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_model extends CI_Model {
    public function summary_range($start,$end){
        $sql="SELECT type,SUM(amount) as total FROM finance_transactions WHERE occurred_on BETWEEN ? AND ? GROUP BY type";
        $rows=$this->db->query($sql,[$start,$end])->result();
        $out=['expense'=>0,'revenue'=>0];
        foreach($rows as $r){$out[$r->type]=(int)$r->total;}
        $out['profit']=$out['revenue']-$out['expense'];
        return $out;
    }
    public function daily_trend($days=7){
        $sql="SELECT occurred_on, SUM(CASE WHEN type='revenue' THEN amount ELSE 0 END) rev, SUM(CASE WHEN type='expense' THEN amount ELSE 0 END) exp FROM finance_transactions WHERE occurred_on >= DATE_SUB(CURDATE(), INTERVAL ? DAY) GROUP BY occurred_on ORDER BY occurred_on";
        return $this->db->query($sql,[$days])->result();
    }
}
