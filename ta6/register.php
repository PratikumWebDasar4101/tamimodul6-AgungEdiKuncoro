<?php
    include("database.php");    
?>
<form method="post">
    <pre>
    <h3>Buat Akun :</h3>
        Username : <input type="text" name="username"><br>
        Password : <input type="text" name="pass">
    </pre>
    <pre>
    <h3>Isikan Data Diri :</h3>
        NIM         : <input type="text" name="nim"><br>
        Nama        : <input type="text" name="nama"><br>
        Gender      : <input type="radio" name="gender" value="Laki-laki">Laki-laki <input type="radio" name="gender" value="Perempuan">Perempuan<br>
        Kelas       : <input type="radio" name="kelas" value="41-01">41-01
                      <input type="radio" name="kelas" value="41-01">41-02
                      <input type="radio" name="kelas" value="41-01">41-03
                      <input type="radio" name="kelas" value="41-01">41-04<br>
        Fakultas    : <select name="fakultas">
                        <option value="FIT">FIT</option>
                        <option value="FTE">FTE</option>
                        <option value="FIK">FIK</option>
                        <option value="FKB">FKB</option>
                      </select><br>
        Alamat      : <textarea name="alamat" cols="30" rows="10"></textarea><br>
        Hobi        : <input type="checkbox" name="hobi[]" value="Membaca">Membaca 
                      <input type="checkbox" name="hobi[]" value="Menulis">Menulis
                      <input type="checkbox" name="hobi[]" value="Menggambar">Menggambar<br><br>
                <input type="submit" value="Simpan"> | <a href="login.php"><input type="button" value="Login"></a>
    </pre>
</form>
<?php
if (isset($_POST['username'])) {
    $username   = $_POST['username'];
    $pass       = $_POST['pass'];
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $gender     = $_POST['gender'];
    $kelas      = $_POST['kelas'];
    $fakultas   = $_POST['fakultas'];
    $alamat     = $_POST['alamat'];
    $hobi       = $_POST['hobi'];
    $list_hobi = implode(", ", $hobi);

    $input_user = mysqli_query($conn, "INSERT INTO user(username, password) 
                                                VALUES ('$username', '$pass')");

    $ambil_id = mysqli_query($conn, "SELECT id FROM user WHERE username = '$username'");
    $row = mysqli_fetch_assoc($ambil_id);
    $id = $row['id'];

    $input_mahasiswa = "INSERT INTO mahasiswa(nim, nama, gender, kelas, fakultas, alamat, hobi, id) 
                        VALUES ('$nim', '$nama', '$gender', '$kelas', '$fakultas', '$alamat', '$list_hobi', '$id')";
    
    if (mysqli_query($conn, $input_mahasiswa)) {
        echo "	<script>
                alert('Data berhasil di tambah');
                location='login.php';
                </script>";
    }else {
        echo "Error: " . $input_mahasiswa . "<br?" . mysqli_error($conn);
    }
}
?>