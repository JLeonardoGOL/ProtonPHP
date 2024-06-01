<?php

use HttpResponse as route;

route::get("/", function (){
    $data = \db\Database::query("select 'Hola mundo!' prueba;");
    Response::show($data);
});

route::get("/test", [TestController::class,"test"]);