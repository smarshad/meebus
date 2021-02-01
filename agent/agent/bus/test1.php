<?php
function giftControler ($scope, $http, $q) 
{
  var $names = $http.get("names.json"),$naughty = $http.get("naughty.json"),
      $nice = $http.get("nice.json");
  $q.all([$names, $naughty,$nice]).then(function(arrayOfResults) 
  { 
      echo $q;
    });
?>


