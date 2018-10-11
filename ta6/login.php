<?php
session_start();
require ('database.php');
?>
<form method="post" align="center">
<h3>Silahkan Login</h3>
    <pre>
        Username : <input type="text" name="username"><br>
        Password : <input type="password" name="pass"><br><br>
                <input type="submit" value="Login"> | <a href="register.php"><input type="button" value="Register"></a>
        
    </pre>
</form>
<?php

if (isset($_SESSION['sukses'])) {
    header("location: home.php");
}
if (isset($_GET['gagal'])) {
    session_destroy();
    header("location: login.php");
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $pass     = $_POST['pass'];

    $sql = mysqli_query($conn,"SELECT * from user where username='$username' AND password='$pass'");
    $row = mysqli_fetch_assoc($sql);
    $num = mysqli_num_rows($sql);

    if ($num != 0) {
        $id = $row['id'];
        $query = mysqli_query($conn, "SELECT nim FROM mahasiswa WHERE id = '$id'");
        $data = mysqli_fetch_assoc($query);
        $_SESSION['nim'] = $data['nim'];
        $_SESSION['sukses'] = 1;
        header("location: home.php");
    }else{
        ?>
        <script>
            alert("Ups! Ada yang salah");
        </script>
        <?php
    }
    mysqli_close($conn);
}   
?>