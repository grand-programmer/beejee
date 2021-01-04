<?php


if (! function_exists('status_name')) {
    /**
     * Get status name
     *
     * @param $status
     * @return mixed
     */
    function status_name($status)
    {
        switch ($status) {
            case 0:
                return "Draft";
                break;
            case 1:
                return "Completed";
                break;
            default:
                return "Draft";
                break;
        }
    }
}

if (! function_exists('clear_session')) {

    /**
     * Clear session
     */
    function clear_session()
    {
        session_start();

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();
    }
}
if (! function_exists('change_params_url')) {

    /**
     * Clear session
     */
    function change_params_url($params=[])
    {
        $url=$_SERVER['REQUEST_URI'];
        if($params) {
            $currentParams = parse_url($url, PHP_URL_QUERY);
            foreach(explode('&',$currentParams) as $v){
                $param=explode('=',$v);
                $currentParamsArray[$param[0]]=$param[1];
            }
            foreach ($params as $k => $v) {
                $currentParamsArray[$k]=$v;
            }
            foreach($currentParamsArray as $key=>$value)
                $newurl[]=$key.'='.$value;
            $url='?'.implode('&',$newurl);

        }
        return $url;

    }
}
if (! function_exists('custom_filter_var')) {

    /**
     * Clear session
     */
    function custom_filter_var($var=null)
    {
        $jsxss="onabort,oncanplay,oncanplaythrough,ondurationchange,onemptied,onended,onerror,onloadeddata,onloadedmetadata,onloadstart,onpause,onplay,onplaying,onprogress,onratechange,onseeked,onseeking,onstalled,onsuspend,ontimeupdate,onvolumechange,onwaiting,oncopy,oncut,onpaste,ondrag,ondragend,ondragenter,ondragleave,ondragover,ondragstart,ondrop,onblur,onfocus,onfocusin,onfocusout,onchange,oninput,oninvalid,onreset,onsearch,onselect,onsubmit,onabort,onbeforeunload,onerror,onhashchange,onload,onpageshow,onpagehide,onresize,onscroll,onunload,onkeydown,onkeypress,onkeyup,altKey,ctrlKey,shiftKey,metaKey,key,keyCode,which,charCode,location,onclick,ondblclick,oncontextmenu,onmouseover,onmouseenter,onmouseout,onmouseleave,onmouseup,onmousemove,onwheel,altKey,ctrlKey,shiftKey,metaKey,button,buttons,which,clientX,clientY,detail,relatedTarget,screenX,screenY,deltaX,deltaY,deltaZ,deltaMode,animationstart,animationend,animationiteration,animationName,elapsedTime,propertyName,elapsedTime,transitionend,onerror,onmessage,onopen,ononline,onoffline,onstorage,onshow,ontoggle,onpopstate,ontouchstart,ontouchmove,ontouchend,ontouchcancel,persisted,javascript";
        $jsxss = explode(",",$jsxss);

        $var = preg_replace ( "'<script[^>]*?>.*?</script>'si", "", $var );
        //Вырезаем все известные javascript события для защиты от xss-атак
        $var = str_replace($jsxss,"",$var);
        //Удаляем экранирование для защиты от SQL-инъекций
        $var = str_replace (array("*","\\"), "", $var );
        //Удаляем другие лишние теги.
        $var = strip_tags($var);
        //Преобразуем все возможные символы в соответствующие HTML-сущности
        $var = htmlentities($var, ENT_QUOTES, "UTF-8");
        $var = htmlspecialchars($var, ENT_QUOTES);

        return $var;
    }
}