<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>404 Not Found</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #20253A;
    color: #FFFFFF;
    margin: 0;
    padding: 0;
    /* display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; */
  }
  .container {
    text-align: center;
  }
  h1 {
    font-size: 3rem;
    margin-bottom: 20px;
  }
  p {
    font-size: 1.2rem;
    margin-bottom: 40px;
  }
  a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #E600A0;
    color: #FFFFFF;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
  }
  a:hover {
    background-color: #FF1493;
  }
</style>
</head>
<body>
  <div class="container">
    <h1>404 Not Found</h1>
    <p>Oops! The page you're looking for doesn't exist.</p>
    <a href="<?php echo URL; ?>casuals/dashboard">Go Home</a>
  </div>
</body>
</html>

