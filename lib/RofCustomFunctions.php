<?php
    if(!function_exists("trailSlash")) {
        function trailSlash($url) {
            if(strpos($url,"?")===false) {
                if(substr($url,-1)!=="/") {
                    $url .= "/";
                }
            } else {
                $urlParts = explode("?",$url,2);
                if(substr($urlParts[0],-1)!=="/") {
                    $urlParts[0] .= "/";
                    $url = $urlParts[0] . "?" . $urlParts[1];
                }
                if(isset($urlParts[1])&&$urlParts[1]==="p=1") {
                    $url = $urlParts[0];
                }
            }
            return $url;
        }
    }