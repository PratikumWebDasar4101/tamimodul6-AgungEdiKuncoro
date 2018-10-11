<?php
 include ('database.php');
 include('header.php');
 session_start();
 $nim = $_SESSION['nim'];
?>
    <h2><center>Post Saya</center></h2>
    <hr>
<table border=1 style="border-spacing: 0; text-align: center;">
    <tr>
        <th width=20% height=40px>NIM</th>
        <th>Konten</th>
        <th width=10%>Foto</th>
        <th width=3%>Pilihan</th>
    </tr>
    <?php
        $sql = "SELECT * FROM posting WHERE nim = '$nim'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num != 0) {
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td height=40px><?php echo $row['nim'];?></td>
                    <td><?php echo $row['konten'];?></td>
                    <td><img src="<?php echo $row['foto']?>" width=100%;></td>
                    <td><a href="editposting.php?id=<?php echo $row['id']; ?>"><input type="button" value="Edit"></a></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr><td colspan="4"> Belum Ada Post</td></tr>
            <?php
        }
    ?>
</table>