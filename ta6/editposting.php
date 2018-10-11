<?php
include("database.php");
session_start();
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM posting WHERE id = '$id'");
$row = mysqli_fetch_assoc($sql);
?>
<form method="post" enctype="multipart/form-data">
    <pre>
        Konten : <textarea name="konten" cols="30" rows="10"><?php echo $row['konten']; ?></textarea>
        Foto   : <input type="file" name="foto">
        <input type="submit" value="Simpan">
    </pre>
</form>
<?php
if (isset($_POST['konten'])) {
    $konten = $_POST['konten'];

    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $dir = "foto/";
    $target = $dir.$foto;

    $update_konten = mysqli_query($conn, "UPDATE posting SET konten = '$konten', foto = '$target' WHERE id = '$id'");
        
    $upload = move_uploaded_file($tmp_name,$target);
    if (!$upload) {
        die("Post Gagal");
    }
        
    elseif ($upload && $update_konten) {
        echo "	<script>
                alert('Data berhasil di tambah');
                location='home.php';
                </script>";
    }else {
        echo "Error: " . $input_konten . "<br?" . mysqli_error($conn);
    }
}
?>