<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan Acara</title>
</head>
<body>
    <?php
   
    include_once 'Database.php';
    
    // Membua objek Acara
    $acaraObj = new Acara();

    
    if(isset($_POST['submit'])){
        // Mengambil nilai 
        $nama_acara = $_POST['nama_acara'];
        $tanggal = $_POST['tanggal'];
        $lokasi = $_POST['lokasi'];
        
        // Menambah acara
        $acaraObj->tambahAcara($nama_acara, $tanggal, $lokasi);
    }
    ?>

    <h2>Jadwal Acara Maulid Akbar Di Indramayu</h2>
    
    <h3>Tambah Acara</h3>
    <form method="post" action="">
        Nama Acara: <input type="text" name="nama_acara" required><br>
        Tanggal: <input type="date" name="tanggal" required><br>
        Lokasi: <input type="text" name="lokasi" required><br>
        <input type="submit" name="submit" value="Tambah Acara">
    </form>

    <h3>Daftar Acara</h3>
    <?php
    // Mendapatkan daftar acara dari database
    $daftarAcara = $acaraObj->lihatAcara();
    
    // Menampilkan daftar acara
    if (!empty($daftarAcara)) {
        echo "<ul>";
        foreach ($daftarAcara as $acara) {
            echo "<li>Nama Acara: " . $acara['nama_acara'] . ", Tanggal: " . $acara['tanggal'] . ", Lokasi: " . $acara['lokasi'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Tidak ada acara.";
    }
    ?>
</body>
</html>
