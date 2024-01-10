<!DOCTYPE html>
<html lang="pl">
<?php require_once(__DIR__.'/frame/head.php'); ?>
<?php require_once(__DIR__.'/frame/topBar.php'); ?>

<head>
<link rel="stylesheet" type="text/css" href="./css/login.css">
</head>

<body>
    <div class="container">
        <h2>Logowanie</h2>
        <form id="loginForm" class="form-container" action="login_process.php" method="post">
            <label for="username">Nazwa uzytkownika:</label>
            <input type="text" name="username" required>

            <label for="password">Haslo:</label>
            <input type="password" name="password" required>

            <button type="submit">Zaloguj sie</button>
            <p>Nie masz konta? <a href="javascript:void(0);" onclick="switchForm()">Stworz konto</a></p>
        </form>

        <!-- Formularz rejestracji - ukryty na pocz¹tku -->
        <form id="registerForm" class="form-container" action="register_process.php" method="post" style="display: none;">
            <label for="newUsername">Nowa nazwa uzytkownika:</label>
            <input type="text" name="newUsername" required>

            <label for="newPassword">Nowe haslo:</label>
            <input type="password" name="newPassword" required>

            <label for="confirmNewPassword">Potwierdz nowe haslo:</label>
            <input type="password" name="confirmNewPassword" required>

            <button type="submit">Zarejestruj sie</button>
            <p>Masz juz konto? <a href="javascript:void(0);" onclick="switchForm()">Zaloguj sie</a></p>
        </form>
    </div>

    <script>
        function switchForm() {
            var loginForm = document.getElementById('loginForm');
            var registerForm = document.getElementById('registerForm');

            if (loginForm.style.display === 'block' || loginForm.style.display === '') {
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            } else {
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
            }
        }
    </script>
</body>
<?php require_once(__DIR__.'/frame/footer.php'); ?>
</html>
