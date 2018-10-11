<?php
    include("database.php");
    session_start();
    $nim = $_SESSION['nim'];
    $sql = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
	$result = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_assoc($result);
    $hobi_dipilih = explode(", ", $row['hobi']);
?>
<form method="post">
        <h2><center>Edit Profil</center></h2>
        <hr>
    <pre>
        NIM         : <input type="text" name="nim" value="<?php echo $row['nim'] ?>" readonly><br>
        Nama        : <input type="text" name="nama" value="<?php echo $row['nama'] ?>"><br>
        Gender      : <input type="radio" name="gender" <?php if($row['gender'] == "Laki-laki") { ?> checked <?php } ?> value="Laki-laki">Laki-laki 
                      <input type="radio" name="gender" <?php if($row['gender'] == "Perempuan") { ?> checked <?php } ?> value="Perempuan">Perempuan<br>
        Kelas       : <input type="radio" name="kelas" <?php if($row['kelas'] == "41-01") { ?> checked <?php } ?> value="41-01">41-01
                      <input type="radio" name="kelas" <?php if($row['kelas'] == "41-02") { ?> checked <?php } ?> value="41-02">41-02
                      <input type="radio" name="kelas" <?php if($row['kelas'] == "41-03") { ?> checked <?php } ?> value="41-03">41-03
                      <input type="radio" name="kelas" <?php if($row['kelas'] == "41-04") { ?> checked <?php } ?> value="41-04">41-04
        Fakultas    : <select name="fakultas">
                        <option <?php if($row['fakultas'] == "FIT") { ?> selected <?php } ?> value="FIT">FIT</option>
                        <option <?php if($row['fakultas'] == "FTE") { ?> selected <?php } ?> value="FTE">FTE</option>
                        <option <?php if($row['fakultas'] == "FIK") { ?> selected <?php } ?> value="FIK">FIK</option>
                        <option <?php if($row['fakultas'] == "FKB") { ?> selected <?php } ?> value="FKB">FKB</option>
                      </select><br>
        Alamat      : <textarea name="alamat" cols="30" rows="10"><?php echo $row['nim'] ?></textarea><br>
        Hobi        : <input type="checkbox" name="hobi[]" <?php if(array_search("Membaca", $hobi_dipilih) > -1 ) { ?> checked <?php } ?> value="Membaca">Membaca 
                      <input type="checkbox" name="hobi[]" <?php if(array_search("Menulis", $hobi_dipilih) > -1 ) { ?> checked <?php } ?> value="Menulis">Menulis
                      <input type="checkbox" name="hobi[]" <?php if(array_search("Menggambar", $hobi_dipilih) > -1 ) { ?> checked <?php } ?> value="Menggambar">Menggambar<br><br>
                <input type="submit" value="Simpan"> | <a href="home.php"><input type="button" value="Home"></a>
    </pre>
</form>
<?php
if (isset($_POST['nim'])) {
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $gender     = $_POST['gender'];
    $kelas      = $_POST['kelas'];
    $fakultas   = $_POST['fakultas'];
    $alamat     = $_POST['alamat'];
    $hobi       = $_POST['hobi'];
    $list_hobi = implode(", ", $hobi);

    $input_mahasiswa = "UPDATE mahasiswa SET nama = '$nama', gender = '$gender', kelas = '$kelas', fakultas = '$fakultas', alamat = '$alamat', hobi = '$list_hobi' WHERE nim = '$nim'";
    
    if (mysqli_query($conn, $input_mahasiswa)) {
        echo "	<script>
                alert('Data berhasil di tambah');
                location='home.php';
                </script>";
    }else {
        echo "Error: " . $input_mahasiswa . "<br?" . mysqli_error($conn);
    }
}
?>