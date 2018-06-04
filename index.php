<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Книги</title>
  <style>
    * {
      font-family: Helvetica, sans-serif;
    }

    table {
      border-collapse: collapse;
    }

    th, td {
      padding: 2px 10px;
      border: 1px solid #000;
    }

    th {
      background: #eee;
    }

    td:first-child {
      text-align: center;
    }

    .container > form {
      margin-bottom: 10px;
    }

    .container {
      width: 1200px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
<?php
    $host = 'localhost';
    $dbname = 'global';
    $user = 'cibizov';
    $pass = 'neto1762';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';
    
    $query = "SELECT * FROM books";
    $prepquery = $pdo->prepare($query);
    $prepquery->execute([
        'name' => "%$name%",
        'author' => "%$author%",
        'isbn' => "%$isbn%",
    ]);
    $queryResult = $prepquery->fetchAll();
?>
<div class="container">
  <h1>Библиотека</h1>
  <form action="" method="post" accept-charset="utf-8">
    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Название">
    <input type="text" name="author" value="<?php echo $author; ?>" placeholder="Автор">
    <input type="text" name="isbn" value="<?php echo $isbn; ?>" placeholder="ISBN">
    <input type="submit" name="submit" value="Найти">
  </form>
  <table>
    <thead>
    <tr>
      <th>№ п/п</th>
      <th>Название</th>
      <th>Автор</th>
      <th>Год выпуска</th>
      <th>Жанр</th>
      <th>ISBN</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($queryResult) : ?>
        <?php foreach ($queryResult as $index => $row) : ?>
        <tr>
          <td><?php echo $index + 1; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['author']; ?></td>
          <td><?php echo $row['year']; ?></td>
          <td><?php echo $row['genre']; ?></td>
          <td><?php echo $row['isbn']; ?></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>


/**
* Created by PhpStorm.
* User: konstantin
* Date: 04.06.2018
* Time: 19:31
*/