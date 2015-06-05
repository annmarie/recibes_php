<?php
require_once("links.php");

class Views { 

    public function __construct($pgObj) {
       $this->pgObj = $pgObj;
    }

    public function index() {
        $this->render_tmpl("tmpl/index.php");
    }

    public function items() {
        $rcpsObj = new Recipes();
        $recipes = $rcpsObj->all();
        $this->pgObj->recipes = $recipes;
        $this->render_tmpl("tmpl/items.php");
    }

    public function item() {
        $rcp_id = $this->pgObj->rcp_id;
        $rcp = new Recipe($rcp_id);
        $rcp->getIngredients();
        $rcp->getTags();
        if (!$rcp->id) {
           return $this->error(); 
        }
        $this->pgObj->rcp = $rcp;
        $this->render_tmpl("tmpl/item.php");
    }

    public function add() {
        $this->render_tmpl("tmpl/add.php");
    }


    public function api_item() {
        $rcp_id = $this->pgObj->rcp_id;
        if (is_numeric($rcp_id)) {
            $rcp = new Recipe($rcp_id);
            $rcp->getIngredients();
            $rcp->getTags();
            $tpl = $rcp;
        } else {
            $tpl = array("error" => "there was a problem");
        }
        $this->render_json($tpl);
    }

    public function api_add() { 
        $post = new AddRecipeFormRequest();
        if ($post->is_valid ) {
            $tpl = $post->do_save();
        } else {
            $tpl = array("error" => "there was a problem");
        }
        $this->render_json($tpl);
    }


    public function api_list() { 
        $rcpsObj = new Recipes();
        $recipes = $rcpsObj->all();
        $rcps = array();
        foreach($recipes as $rcp) {
            $rcp->getIngredients();
            $rcp->getTags();
            $rcps[] = $rcp; 
        }
        $this->render_json($rcps);
    }

    public function api_delete() { 
        $rcp_id = $this->pgObj->rcp_id;
        if (is_numeric($rcp_id)) {
            $rcp = new Recipe($rcp_id);
            $rcp->removeit();
            if (!$rcp->id) {
                $tpl = array("message" => "recipe has been deleted");
            } else { 
                $tpl = array("error" => "delete failed");
            }
        } else {
            $tpl = array("error" => "there was a problem");
        }
        $this->render_json($tpl);
    }

    public function api_search() { 
        $searchform = new SearchFormRequest();
        if ($searchform->is_valid ) {
            $tpl = $searchform->do_search();
        } else {
            $tpl = array("error" => "there was a problem");
        }

        $this->render_json($tpl);
    }


    function render_tmpl($filepath) {
        $links = new Links();
        $vars = array("pgObj" => $this->pgObj,
                      "links" => $links);
        extract($vars);
        ob_start();
        require($filepath);
        $contents = ob_get_contents(); 
        ob_end_clean();
        echo $contents;
    }

    public function error() {
        header('HTTP/1.0 404 Not Found');
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
    }

    public function api_error() {
        $tpl = array("error" => "invalid request");
        $this->render_json($tpl);
    }

    private function render_json($tpl) {
        header('Content-type: application/json; charset=utf-8');
        header("Cache-Control: max-age=0, s-maxage=0, no-cache, no-store, must-revalidate, post-check=0, pre-check=0, private");
        header('Access-Control-Allow-Origin: *');
        echo json_encode($tpl);
    }
}


