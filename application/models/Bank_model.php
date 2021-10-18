<?php

/**
 * @version: 1.0.0
 * @author: Michal Sejc https://webstranky-sejc.sk/
 * @copyright: Copyright (c) 2018-2019 Michal Sejc. All rights reserved.
 * @website: https://webstranky-sejc.sk/
 * @email michal.sejc@gmail.com
 */
defined('BASEPATH') or exit('No direct script access allowed');
class Bank_model extends CI_Model
{

    public function saveCard($data)
    {
        return $this->db->insert('cards', $data);
    }

    public function getCards()
    {
        return  $this->db->select('*')->from('cards')
            ->get()
            ->result_array();
    }

    public function getCardNumber($id)
    {
        return  $this->db->select('card_number')
            ->from('cards')
            ->where('id', $id)
            ->get()
            ->row()->card_number;
    }

    public function getNumberMonthYear($id)
    {
        return  $this->db->select('*')
            ->from('cards')
            ->where('id', $id)
            ->get()
            ->row_array();
    }

    public function getCardNumbers()
    {
        return  $this->db->select('card_number')
            ->from('cards')
            ->get()
            ->result_array();
    }

    public function getCard($id)
    {
        return  $this->db->select('*')->from('cards')
            ->where('id', $id)
            ->get()
            ->row_array();
    }

    public function depositOrWithdrawFromAccount($id, $amount, $depositOrWithdraw)
    {

        $account_ballance =  $this->db->select('account_balance')
            ->from('cards')
            ->where('id', $id)
            ->get()
            ->row()->account_balance;

        if ($depositOrWithdraw === 'withdraw') {
            if (!($account_ballance < $amount)) {
                $new_account_ballance = $account_ballance - $amount;
            } else {
                return false;
            }
        } else {
            $new_account_ballance = $account_ballance + $amount;
        };

        return  $this->db->where('id', $id)->update('cards', array('account_balance' => $new_account_ballance));
    }
}
