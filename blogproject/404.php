<?php
http_response_code(404);
$currentYear = date('Y');
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Pagina niet gevonden - Mijn Blog</title>
  <link rel="stylesheet" href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/css/default.css">
  <script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
  <style>
    .error-404 {
      text-align: center;
      padding: 80px 20px;
    }
    .error-404 h1 {
      font-size: 4rem;
      color: #588157;
    }
    .error-404 p {
      font-size: 1.2rem;
      color: #555;
    }
    .error-404 a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 16px;
      background: #588157;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
    }
    .error-404 a:hover {
      background: #3a5a40;
    }
  </style>
</head>
<body>
  <div class="error-404">
    <h1><i class="fa-solid fa-triangle-exclamation"></i> 404</h1>
    <p>Oeps! Deze pagina bestaat niet (meer).</p>
    <a href="/rea-1/PHP/26-eindopdracht-php/mijn-blog/home">
      <i class="fa-solid fa-house"></i> Terug naar Home
    </a>
  </div>

  <footer style="text-align:center; margin-top:50px; color:#777;">
    &copy; <?= $currentYear ?> Mijn Blog
  </footer>
</body>
</html>
