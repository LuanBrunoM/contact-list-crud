<?php

session_start();

include_once("conection.php");
include_once("url.php");

$id;

if (!empty($_GET)) {
  $id = $_GET["id"];
}

//Retorno os dados de um contato por vez
if (!empty($id)) {

  $query = "SELECT * FROM contacts WHERE id = :id";

  $stmt = $conn->prepare($query);

  $stmt->bindParam(":id", $id);

  $stmt->execute();

  $contact = $stmt->fetch();
} else {
  //Retorno dos contatos
  $contacts = [];

  $query = "SELECT * FROM contacts";

  $stmt = $conn->prepare($query);

  $stmt->execute();

  $contacts = $stmt->fetchAll();
}
