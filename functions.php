<?php
$db = mysqli_connect("localhost", "root", "", "praktik industri");


function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;

}

function tahapsatu($data) {
    global $db;
    $id_author = $_REQUEST['id_author'];
    $NIM = htmlspecialchars($data["NIM"]);
    $Nama = htmlspecialchars($data["Nama"]);
    $judul = htmlspecialchars($data["judul"]);
    $dospem = htmlspecialchars($data["dospem"]);

    $surfak = surfak();
    if(!$surfak){
        return false;
    }

    $surbal = surbal();
    if(!$surbal){
        return false;
    }

    $proposal = proposal();
    if(!$proposal){
        return false;
    }

    $tahap1 = htmlspecialchars($data["tahap1"]);  



    $query = "INSERT INTO mahasiswa
                VALUES
            ('', '$NIM', '$Nama', '$judul', '$dospem', '$surfak', '$surbal', '$proposal', '$tahap1', '$id_author', '')
        ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}

function tahapdua($data2) {
    global $db;
    $id_author = $_REQUEST['id_author'];
    $jadwal = htmlspecialchars($data2["jadwal"]);
    $pukul = htmlspecialchars($data2["pukul"]);
    $uji = htmlspecialchars($data2["uji"]);
   

    $laporan = laporan();
    if(!$laporan){
        return false;
    }

    $nilai = nilai();
    if(!$nilai){
        return false;
    }

    $pengesahan = pengesahan();
    if(!$pengesahan){
        return false;
    }

    $tahapan = htmlspecialchars($data2["tahapan"]);

    $query = "INSERT INTO file 
                VALUES ('', '$jadwal', '$pukul', '$uji', '$laporan', '$nilai', '$pengesahan', '$tahapan', '$id_author', '')
        ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}

function tambah1($data1) {
    global $db;
    $nama = htmlspecialchars($data1["nama"]);
    $nim = htmlspecialchars($data1["nim"]);
    $level = htmlspecialchars($data1["level"]);
    $password = mysqli_real_escape_string($db, $data1["password"]);

    $result = mysqli_query($db, "SELECT nim FROM user WHERE nim = '$nim'");

    $password = password_hash($password, PASSWORD_DEFAULT);




    $query = "INSERT INTO user
                VALUES
            ('', '$nim', '$nama', '', '$level', '','','' ,'','$password')
        ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}

function laporan(){
    
    $namaFile = $_FILES['laporan']['name'];
    $ukuranFile = $_FILES['laporan']['size'];
    $error = $_FILES['laporan']['error'];
    $tmpName = $_FILES['laporan']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih file terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan pdf!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran pdf terlalu besar!');
                </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'pdf/'. $namaFile);
    return $namaFile;

}

function nilai(){
    
    $namaFile = $_FILES['nilai']['name'];
    $ukuranFile = $_FILES['nilai']['size'];
    $error = $_FILES['nilai']['error'];
    $tmpName = $_FILES['nilai']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih file terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan pdf!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran pdf terlalu besar!');
                </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'pdf/'. $namaFile);
    return $namaFile;

}

function pengesahan(){
    
    $namaFile = $_FILES['pengesahan']['name'];
    $ukuranFile = $_FILES['pengesahan']['size'];
    $error = $_FILES['pengesahan']['error'];
    $tmpName = $_FILES['pengesahan']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih file terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan pdf!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran pdf terlalu besar!');
                </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'pdf/'. $namaFile);
    return $namaFile;

}

function hapus1($id){
    global $db;
    mysqli_query($db, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($db);
}

function hapus2($id){
    global $db;
    mysqli_query($db, "DELETE FROM file WHERE id = $id");
    return mysqli_affected_rows($db);
}


function ubah1($data){
    global $db;

    $id = $data["id"];
    $NIM = htmlspecialchars($data["NIM"]);
    $Nama = htmlspecialchars($data["Nama"]);
    $judul = htmlspecialchars($data["Judul"]);
    $dospem = htmlspecialchars($data["dospem"]);
    $tahap1 = htmlspecialchars($data["tahap"]);  

    $query = "UPDATE mahasiswa SET 
               NIM='$NIM',
               Nama='$Nama',
               Judul='$judul',
               dospem='$dospem',
               tahap='$tahap1'
                WHERE id = $id
                ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function ubah2($data2){
    global $db;

    $id = $data2["id"];
    $jadwal = htmlspecialchars($data2["jadwal"]);
    $pukul = htmlspecialchars($data2["pukul"]);
    $uji = htmlspecialchars($data2["uji"]);
    $tahapan = htmlspecialchars($data2["tahapan"]);

    $query = "UPDATE file SET 
               jadwal='$jadwal',
               pukul='$pukul',
               uji='$uji',
               tahapan='$tahapan'
                WHERE id = $id
                ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function cari($keyword){
    $query = "SELECT * FROM mahasiswa
                WHERE 
                NIM LIKE '%$keyword%' OR
                Nama LIKE '%$keyword%' OR
                judul LIKE '%$keyword%'
                ";

    return query($query);
}

function cari1($keyword){
    $query = "SELECT * FROM user
                WHERE 
                nama LIKE '%$keyword%' OR
                nim LIKE '%$keyword%' OR
                prodi LIKE '%$keyword%' OR
                angkatan LIKE '%$keyword%' OR
                program LIKE '%$keyword%' OR
                perusahaan LIKE '%$keyword%'OR
                level LIKE '%$keyword%'
                ";

    return query($query);
}
function cari2($keyword){
    $query = "SELECT * FROM mahasiswa
                WHERE 
                NIM LIKE '%$keyword%' OR
                Nama LIKE '%$keyword%' OR
                judul LIKE '%$keyword%'
                ";

    return query($query);
}

function registrasi($data){
    global $db;
    $nim = stripslashes($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $program = htmlspecialchars($data["program"]);
    $prodi = htmlspecialchars($data["prodi"]);
    $angkatan = htmlspecialchars($data["angkatan"]);
    $perusahaan = htmlspecialchars($data["perusahaan"]);
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);
    $level = htmlspecialchars($data["level"]);

   


    $result = mysqli_query($db, "SELECT nim FROM user WHERE nim = '$nim'");



    if (mysqli_fetch_assoc($result)){
        echo "<script>
                alert('nim sudah terdaftar!')
            </script>";
        return false;
    }

    if($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
                </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($db, "INSERT INTO user VALUES('','$nim','$nama','$email','$level','$program', '$prodi','$angkatan', '$perusahaan','$password') ");

    return mysqli_affected_rows($db);

    
}

function ubahprofile($data1){
    global $db;



    $id = $data1["id"];
    $nama = htmlspecialchars($data1["nama"]);
    $nim = htmlspecialchars($data1["nim"]);
    $program = htmlspecialchars($data1["program"]);
    $prodi = htmlspecialchars($data1["prodi"]);
    $angkatan = htmlspecialchars($data1["angkatan"]);
    $perusahaan = htmlspecialchars($data1["perusahaan"]);


    $query = "UPDATE user SET 
                nama='$nama',
               nim='$nim',
               program='$program',
               prodi='$prodi',
                angkatan='$angkatan',
                perusahaan='$perusahaan'
                WHERE id = $id
                ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
function hapusprofile($id){
    global $db;
    mysqli_query($db, "DELETE FROM user WHERE id = $id");
    return mysqli_affected_rows($db);
}

function approved($id_author)
{
    global $db;
    $query = "UPDATE mahasiswa SET is_approved=true WHERE id_author = $id_author";
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function surfak(){

    $namaFile = $_FILES['surfak']['name'];
    $ukuranFile = $_FILES['surfak']['size'];
    $error = $_FILES['surfak']['error'];
    $tmpName = $_FILES['surfak']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih file terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan pdf!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran pdf terlalu besar!');
                </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'pdf/'. $namaFile);
    return $namaFile;

}

function surbal(){

    $namaFile = $_FILES['surbal']['name'];
    $ukuranFile = $_FILES['surbal']['size'];
    $error = $_FILES['surbal']['error'];
    $tmpName = $_FILES['surbal']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih file terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan pdf!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran pdf terlalu besar!');
                </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'pdf/'. $namaFile);
    return $namaFile;

}

function proposal(){

    $namaFile = $_FILES['proposal']['name'];
    $ukuranFile = $_FILES['proposal']['size'];
    $error = $_FILES['proposal']['error'];
    $tmpName = $_FILES['proposal']['tmp_name'];


    if($error === 4){
        echo "<script>
                alert('pilih file terlebuh dahulu!');
                </script>";
        return false;
    }

    $ekstensiGambarValid = ['pdf'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
                    alert('yang anda upload bukan pdf!');
                    </script>";
            return false;
        
    }

    if($ukuranFile > 10000000) {
        echo "<script>
                alert('ukuran pdf terlalu besar!');
                </script>";
        return false;
    }

    move_uploaded_file($tmpName, 'pdf/'. $namaFile);
    return $namaFile;

}

function tambahnilai($data3) {
    global $db;
    $id_author = $_REQUEST['id_author'];
    $nim = htmlspecialchars($data3["nim"]);
    $nama = htmlspecialchars($data3["nama"]);
    $prodi = htmlspecialchars($data3["prodi"]);
    $angkatan = htmlspecialchars($data3["angkatan"]);
    $nilai = htmlspecialchars($data3["nilai"]);  



    $query = "INSERT INTO nilai_sempi
                VALUES
            ('', '$nim', '$nama', '$prodi', '$angkatan', '$nilai', '$id_author')
        ";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}



?>