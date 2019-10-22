<?php

namespace app;

use app\model\API;

require_once('model/API.php');

class NasaApp
{
    private $API;
    private $getData;
    private $response;
    private $img;

    function getDataFromAPI()
    {
        $this->API = new API();
        $this->getData = $this->API->callAPI('GET', 'https://api.nasa.gov/planetary/apod?api_key=FGydqx1tqutLSKo9P2Uy1b900aD9liDYPhmgkG43', false);
        $this->response = json_decode($this->getData, true);
        // var_dump($this->response);

        $this->img = $this->response["hdurl"];
        // var_dump($this->img);
        // echo "<img src='$this->img'></img>";
    }
}
