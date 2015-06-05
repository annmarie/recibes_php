<?php

class PathParser {

    function __construct($urls) {
        $this->setView($urls);
    }

    public function setView($urls) {
        $requri = strtolower(strtok($_SERVER['REQUEST_URI'], "?"));
        #$requri = substr($requri, strlen($_SERVER['SCRIPT_NAME']));
        foreach($urls as $urlinfo) {
            list($path, $view) = $urlinfo;
            if (preg_match("#$path#", $requri, $matches)) {
                foreach ($matches as $k => $v) {
                    if(!is_numeric($k)) $this->$k = $v;
                }
                $this->view = $view;
                return;
            }
        }
    }

} // end class PathParser


