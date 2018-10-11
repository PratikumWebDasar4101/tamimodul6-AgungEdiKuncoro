<?php
include("database.php");
include('header.php');
session_start();
?>
    <h2><center>Buat Post</center></h2>
    <hr>
<form method="post" enctype="multipart/form-data">
    <pre>
        Konten : <textarea name="konten" cols="30" rows="10"></textarea><br>
        Foto   : <input type="file" name="foto">
        <input type="submit" value="Simpan">
    </pre>
</form>
<?php
if (isset($_POST['konten'])) {
    $konten = $_POST['konten'];
    $nim = $_SESSION['nim'];

    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $dir = "foto/";
    $target = $dir.$foto;

    $input_konten = mysqli_query($conn, "INSERT INTO posting(konten,nim,foto) 
                    VALUES ('$konten','$nim','$target')");
        
    $upload = move_uploaded_file($tmp_name,$target);
    if (!$upload) {
        die("Post Gagal");
    }
        
    if ($upload && $input_konten) {
        echo "	<script>
                alert('Data berhasil di tambah');
                location='home.php';
                </script>";
    }else {
        echo "Error: " . $input_konten . "<br?" . mysqli_error($conn);
    }
}
?>