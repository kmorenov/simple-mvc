<?php

namespace Routing;

class Request {

    public static function _GET($key) {
        return isset($_GET[$key]) ? $_GET[$key] : null;
    }

    public static function _POST($key) {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public static function IS_POST() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public static function GET_METHOD() {
        $method = $_SERVER['REQUEST_METHOD'];

        if (self::IS_POST()) {
            if (isset($_SERVER['X-HTTP-METHOD-OVERRIDE'])) {
                $method = strtoupper($_SERVER['X-HTTP-METHOD-OVERRIDE']);
            }
        }

        return $method;
    }

    public static function _e($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    public static function _d($str, $default) {
        return $str ? self::_e($str) : self::_e($default);
    }

    public static function IS_HTTPS() {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off';
    }

    public static function GET_HTTP_HOST() {
        $host = self::IS_HTTPS() ? 'https://' : 'http://';
        $host .= self::GET_HOST();
        return $host;
    }

    public static function GET_HOST() {
        $host = $_SERVER['HTTP_HOST'];

        $host = strtolower(preg_replace('/:\d+$/', '', trim($host)));

        if ($host && !preg_match('/^\[?(?:[a-zA-Z0-9-:\]_]+\.?)+$/', $host)) {
            throw new \UnexpectedValueException(sprintf('Invalid Host "%s"', $host));
        }

        return $host;
    }

    public static function GET_PATH_INFO($baseUrl = null) {
        static $pathInfo;

        if (!$pathInfo) {
            $pathInfo = $_SERVER['REQUEST_URI'];

            if (!$pathInfo) {
                $pathInfo = '/';
            }

            $schemeAndHttpHost = self::IS_HTTPS() ? 'https://' : 'http://';
            $schemeAndHttpHost .= $_SERVER['HTTP_HOST'];

            if (strpos($pathInfo, $schemeAndHttpHost) === 0) {
                $pathInfo = substr($pathInfo, strlen($schemeAndHttpHost));
            }

            if ($pos = strpos($pathInfo, '?')) {
                $pathInfo = substr($pathInfo, 0, $pos);
            }

            if (null != $baseUrl) {
                $pathInfo = substr($pathInfo, strlen($pathInfo));
            }

            if (!$pathInfo) {
                $pathInfo = '/';
            }
        }

        return $pathInfo;
    }

}
