<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
     body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5; 
    color: #20253A; 
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.login-container {
    background-color: #FFFFFF;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 300px;
    color: #20253A;
}

        .login-container h1 {
            color: #20253A;
        }

        .login-form {
            margin-top: 20px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #a0a5b1;
            border-radius: 4px;
        }

        .form-button {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    background-color: #20253A; 
    color: #FFFFFF;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}


        .error{
            color:red;
            font-size:10px
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($no_user)) : ?>
        <p class="error"><?php echo $no_user; ?></p>
    <?php endif; ?>
        <form class="login-form" action="<?php echo URL; ?>users/login" method="POST">
            <input class="form-input" type="text" name="email" placeholder="Email" required>
            <input class="form-input" type="password" name="password" placeholder="Password" required>
            <input type="submit" name="Login" value="Login" class="form-button" />
           
        </form>
    </div>

</body>
</html>
