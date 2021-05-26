<?php

function DB__getRow($sql){
  global $dbConn;
  $rs = mysqli_query($dbConn, $sql);
  $row = mysqli_fetch_assoc($rs);

  return $row;
}


function DB__getRows($sql){
  global $dbConn;
  $rs = mysqli_query($dbConn, $sql);
  
  $rows = [];
  
  while($row = mysqli_fetch_assoc($rs)){
    $rows[] = $row;
  }
  
  return $rows;
}

function DB__delete($sql){
  global $dbConn;
  mysqli_query($dbConn, $sql);
}

function DB__modify($sql){
  global $dbConn;
  mysqli_query($dbConn, $sql);
}

function DB__insertId($sql){
  global $dbConn;
  mysqli_query($dbConn, $sql);
  
  return mysqli_insert_id($dbConn);
}
function DB__getReplies($sql){
  global $dbConn;
  $rs = mysqli_query($dbConn, $sql);

  $replies = [];

  while($reply = mysqli_fetch_assoc($rs)){
    $replies[] = $reply;
  }

  return $replies;
}
function DB__getReply($sql){
  global $dbConn;
  $rs = mysqli_query($dbConn, $sql);

  $reply = mysqli_fetch_assoc($rs);

  return $reply;
}
function DB__modifyReply($sql){
  global $dbConn;
  mysqli_query($dbConn, $sql);
}
function DB__query($sql){
  global $dbConn;
  mysqli_query($dbConn, $sql);
}
