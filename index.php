<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/form.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Sign In</header>
            <form action="login.php" method="post">
                <div class="field input">
                    <label for="email">Email id</label>
                    <input type="text" name="email" id="email" required>
                    <span id="emailError" class="error"></span>
                </div>     
                <div class="field input">
                     <label for="password">Password</label>
                     <input type="password" name="password" id="password" required>
                     <span id="passwordError" class="error"></span>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>
            </form>      
        </div>
    </div>   
</body>
</html>
