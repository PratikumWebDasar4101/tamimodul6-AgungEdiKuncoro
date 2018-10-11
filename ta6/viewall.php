<?php
 include ('database.php');
 include('header.php');
 session_start();
 $nim = $_SESSION['nim'];
?>
    <h2><center>Semua Post</center></h2>
    <hr>
<table border=1 style="border-spacing: 0; text-align: center;">
    <tr>
        <th width=20% height=40px>NIM</th>
        <th>Konten</th>
        <th width=10%>Foto</th>
    </tr>
    <?php
        $sql = "SELECT mahasiswa.nim, konten, foto FROM posting JOIN mahasiswa ON mahasiswa.nim = posting.nim";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num != 0) {
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td height=40px><?php echo $row['nim'];?></td>
                    <td><?php echo $row['konten'];?></td>
                    <td><img src="<?php echo $row['foto']?>" width=100%;></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="3"> DATA GA ADA CUK</td></tr>
            <?php
        }
    ?>
</table>