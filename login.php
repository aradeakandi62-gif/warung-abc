<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login - warung abc</title>
</head>
<body>
    <h1>login aplikasi kasir warung ABC</h1>
    
    <?php
    session_start();
    if (isset($_SESSION['pesan error'])) {
        echo '<p>' . $_SESSION['pesan_error'] . '</p>';
        unset($_SESSION['pesan error']);
    }
    ?>

    <form action="proses_login.php" method="post">
        <table>
            <tr>
                <td>username</td>
                <td>:</td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td>password</td>
                <td>:</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td>login</td>
                <td>:</td>
                <td><input type="submit" value="login">
            </td>
            </tr>
        </table>
    </form>
</body>
</html>