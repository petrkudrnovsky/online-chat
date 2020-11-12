<?php

class ChatHandler {
    
    public static function saveUser($nickname, $message) {
        Databaze::dotaz(
                "INSERT INTO `chat_user_info` (`nickname`, `message`, `datum`)"
                . " VALUES (?, ?, ?)",
                array($nickname, $message, time())
        );
        echo("<script>history.pushState({}, '', '')</script>");
    }
    
    public static function vypis() {
        $vyber = Databaze::dotaz(
                "SELECT * FROM `chat_user_info` ORDER BY `user_id` DESC LIMIT 10"
                );
        $uzivatele = $vyber->fetchAll();
        return $uzivatele;
    }   
}
