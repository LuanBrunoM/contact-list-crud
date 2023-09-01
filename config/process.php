<?php

session_start();

include_once("conection.php");
include_once("url.php");

$data = $_POST;
//modificações no banco
if (!empty($data)) {

  //criar o contato
  if ($data["type"] === "create") {
    $name = $data["name"];
    $phone = $data["phone"];
    $email = $data["email"];
    $observations = $data["observations"];

    $query = "INSERT INTO contacts (name, phone, email, observations) VALUES (:name, :phone, :email, :observations)";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":observations", $observations);

    try {
      $stmt->execute();
      $_SESSION["msg"] = "Novo contato criado com sucesso";
    } catch (PDOException $e) {
      // erro na conexão
      $error = $e->getMessage();
      echo "Erro: $error";
    }
  } else if ($data["type"] === "edit") {
    $name = $data["name"];
    $phone = $data["phone"];
    $email = $data["email"];
    $observations = $data["observations"];
    $id = $data["id"];

    $query = "UPDATE contacts SET name = :name, phone = :phone, email = :email, observations = :observations WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":observations", $observations);
    $stmt->bindParam(":id", $id);

    try {
      $stmt->execute();
      $_SESSION["msg"] = "Contato editado com sucesso";
    } catch (PDOException $e) {
      // erro na conexão
      $error = $e->getMessage();
      echo "Erro: $error";
    }
  } else if ($data["type"] === "delete") {

    $id = $data["id"];

    $query = "DELETE FROM contacts WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":id", $id);

    try {

      $stmt->execute();
      $_SESSION["msg"] = "Contato removido com sucesso!";
    } catch (PDOException $e) {
      // erro na conexão
      $error = $e->getMessage();
      echo "Erro: $error";
    }
  }

  //Voltar para home depois do cadastro
  header("Location:" . $BASE_URL . "../index.php");

  // Seleção de dados
} else {

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
}

//Fechar conecção
$cnn = null;
