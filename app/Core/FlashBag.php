<?php

namespace Core;

class FlashBag {

    public static function addFlash($alias, $message){
        //$flashBag = $_SESSION['flashBag'] ?? [];
        $flashBag = isset($_SESSION['flashBag']) ? $_SESSION['flashBag'] : [];
        $flashBag[$alias] = $message;
        $_SESSION['flashBag'] = $flashBag;
    }

    public static function hasFlash($alias)
    {
        $flashBag = isset($_SESSION['flashBag']) ? $_SESSION['flashBag'] : [];
        return isset($flashBag[$alias]) ? true : false;
    }

    public static function getFlash($alias)
    {
        $flashBag = isset($_SESSION['flashBag']) ? $_SESSION['flashBag'] : [];
        if (isset($flashBag[$alias])) {
            $message = $flashBag[$alias];
            unset($flashBag[$alias]);
            $_SESSION['flashBag'] = $flashBag;
            return $message;
        }
    }
}