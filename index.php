<?php

include("config/database.php");
include("database/database.php");
include("config/httpResponse.php");
include("config/Response.php");
include("paths.php");

try {
    \HttpResponse::run();
}catch(\Exception $e){
    print $e->getMessage();
}