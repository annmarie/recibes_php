<?php

class AddRecipeFormRequest {

    function __construct() {
        $this->headline = htmlentities(@$_POST['headline']);
        $this->body = htmlentities(@$_POST['body']);
        $this->notes = htmlentities(@$_POST['notes']);
        $this->ingredient = $this->parseArray('ingredient');
        $this->tag = $this->parseArray('tag');
        $this->is_valid = ($this->headline) ? 1 : 0;
    }

    public function do_save() {
        $rcp = new Recipe();
        $rcp->headline = $this->headline;
        $rcp->body = $this->body;
        $rcp->notes = $this->notes;
        $rcp->saveIt();
        if ($rcp->id) {
            if ($this->ingredient) {
                foreach ($this->ingredient as $ingr) {
                    $rcp->addIngredient($ingr);
                }
                $rcp->getIngredients();
            }
            if ($this->tag) {
                foreach ($this->tag as $tag) {
                    $rcp->addTag($tag);
                }
                $rcp->getTags();
            }
        }
        return $rcp;
    }

    private function parseArray($key) {
        if (!is_array(@$_POST[$key])) return array();
        return array_map("htmlentities", $_POST[$key]);
    }
}

class SearchFormRequest {
    function __construct() {
        $this->qterms = htmlentities(@$_REQUEST['q']);
        $this->page = htmlentities(@$_REQUEST['pg']);
        if (!is_numeric($this->page)) $this->page = 1;
        $this->is_valid = ($this->phrase) ? 1 : 0;
    }

    public function do_search() {
        if (!$this->qterms) return;
        $rcps = new Recipes();
        return $rcps->searchKeywords($this->qterms);
    }

    public function do_tags_search() {
        if (!$this->qterms) return;
        $rcps = new Recipes();
        return $rcps->searchTags($this->qterms);
    }

    public function do_ingredients_search() {
        if (!$this->qterms) return;
        $rcps = new Recipes();
        return $rcps->searchIngredients($this->qterms);
    }

}

