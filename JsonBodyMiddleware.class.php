<?php

class JsonBodyMiddleware extends Zaphpa_Middleware {

  function preroute(&$req, &$res) {
    if (isset($req->data["_RAW_HTTP_DATA"]))
      $req->body = json_decode($req->data["_RAW_HTTP_DATA"]);
    else
      $req->body = NULL;
  }

}