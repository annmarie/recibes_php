<?php namespace Recibes;

class ApiCalls {

    function __construct($baseurl) {
        $this->baseurl = $baseurl;
    }

    public function addIt($data) {
        $url = rtrim($this->baseurl, "/") . '/api/add/';
        if ((!$data) or (!is_array($data))) return;
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return trim($result);
    }

    public function getIt($id) {
        $id = (int)trim($id);
        if (!$id) return;
        $url = rtrim($this->baseurl, "/") . '/api/get/'.$id;
        $result = file_get_contents($url, false);
        return trim($result);
    }

    public function searchIt($phrase, $page=1) {
        if (!$phrase) return;
        $url = rtrim($this->baseurl, "/") . '/api/search/?q='.$phrase."&pg=".$page;
        $result = file_get_contents($url, false);
        return trim($result);
    }

}

?>

