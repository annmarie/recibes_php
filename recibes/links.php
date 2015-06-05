<?php

class Links {

    public static function recipe_all() {
        return "/recipe/all";
    }

    public static function recipe_add() {
        return "/recipe/add";
    }

    public static function recipe_item($id=0) {
        return ($id) ? "/recipe/".$id : "";
    }

#    public function tag($tag) {
#        if ($id) return $id."/";
#    }

}


