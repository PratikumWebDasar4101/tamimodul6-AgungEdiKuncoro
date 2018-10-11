<?php 
    include ('database.php');
    include('header.php');
    session_start();
    $nim = $_SESSION['nim'];
	$sql = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

	if (mysqli_num_rows($result) > 0) {
		?>
        <h2><center>Halaman Awal</center></h2>
        <hr>
            <table border="1" width="100%" style="border-spacing: 0px; text-align: center" >
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>JenisKelamin</th>
                    <th>Kelas</th>
                    <th>Fakultas</th>
                    <th>Alamat</th>
                    <th>Hobi</th>
                </tr>
                <tr>
                    <td><?php echo $row['nim']?></td>
                    <td><?php echo $row['nama']?></td>
                    <td><?php echo $row['gender']?></td>
                    <td><?php echo $row['kelas']?></td>
                    <td><?php echo $row['fakultas']?></td>
                    <td><?php echo $row['alamat']?></td>
                    <td><?php echo $row['hobi']?></td>
                </tr>
                <br>
            </table>
            <?php
	}
?>