<?php
namespace CHSOOPREMA;

class Users
{
    public $user;

    public function __construct()
    {
         $this->user=wp_get_current_user();
    }
    
    public function show_users()
    {
        global $wpdb;
        $usernames = $wpdb->get_results("SELECT ID, user_nicename FROM $wpdb->users ORDER BY ID DESC LIMIT 100"); 
        return $usernames;
    }
}
