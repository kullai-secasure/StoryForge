<?php
class Session {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function get($key, $default = null) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }
    
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public static function isAuthenticated() {
        return isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0;
    }
    
    public static function isAdmin() {
        return self::get('role') === 'admin';
    }
}
?>
