<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Sertifikasi</title>
</head>

<body>
    <h2>Data Kelurahan</h2>
    <form id="formMasukkanDataKelurahan" method="post">
        Nama kelurahan: <input type="text" name="namaKelurahan" id="namaKelurahan"><br>
        Nama kecamatan: <input type="text" name="namaKecamatan" id="namaKecamatan"><br>
        <input type="submit" value="Simpan">
    </form>

    <table>
        <thead>
            <tr>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php
            require 'connect.php';
            // Query SQL untuk mengambil data
            $sql = "SELECT * FROM kelurahan";

            $result = $conn->query($sql);

            // Tampilkan data dalam tabel
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input name='namaKelurahanUpdate' type='text' value='" . $row['nama_kelurahan'] . "'></td>";
                    echo "<td><input name='namaKecamatanUpdate' type='text' value='" . $row['nama_kecamatan'] . "'></td>";
                    echo "<td><button onclick='updateKelurahan(" . $row['id'] . ", this)' id='updateKelurahan'>Update</button></td>";
                    echo "<td><button onclick='hapusKelurahan(" . $row['id'] . ")' id='hapusKelurahan'>Hapus</button></td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>


    <h2>Data Penduduk</h2>
    <form id="formMasukkanDataPenduduk" method="post">
        Nik Penduduk: <input type="text" name="nikPenduduk" id="nikPenduduk"><br>
        Nama Penduduk: <input type="text" name="namaPenduduk" id="namaPenduduk"><br>
        Kelurahan: <select name="idKelurahan" id="idKelurahan">
            <option value="">Pilih</option>
            <?php
            // Mengambil data dari database
            require 'connect.php'; // Koneksi ke database
            $sql = "SELECT id,nama_kelurahan FROM kelurahan"; // Ganti nama_tabel dengan nama tabel Anda
            $result = $conn->query($sql);

            // Mengecek apakah ada data yang ditemukan
            if ($result->num_rows > 0) {
                // Loop untuk menampilkan setiap baris data sebagai option dalam select
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nama_kelurahan'] . "</option>";
                }
            } else {
                echo "<option disabled>Tidak ada data</option>";
            }

            $conn->close();
            ?>
        </select>
        <br>
        <input type="submit" value="Simpan">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // kode input data ajax
        $(document).ready(function() {
            $("#formMasukkanDataKelurahan").submit(function(e) {
                if ($('#namaKelurahan').val() === '') {
                    alert("nama kelurahan tidak boleh kosong");
                    e.preventDefault()
                } else if ($('#namaKecamatan').val() === '') {
                    alert("nama kecamatan tidak boleh kosong");
                    e.preventDefault();
                } else {
                    let formData = $(this).serialize();
                    $.ajax({
                        url: 'kelurahan/tambahdata.php',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            alert(response)
                            location.reload()
                        }
                    })
                }
            })

            $("#formMasukkanDataPenduduk").submit(function(e) {
                if ($('#nikPenduduk').val() === '') {
                    alert("Nik penduduk tidak boleh kosong")
                } else if ($('#namaPenduduk').val() === '') {
                    alert("Nama penduduk tidak boleh kosong")
                } else if ($('#idKelurahan').val() === '') {
                    alert("Nama kelurahan penduduk tidak boleh kosong")
                } else {
                    let formData = $(this).serialize();
                    console.log(formData);
                    e.preventDefault();
                    $.ajax({
                        url: 'penduduk/tambahData.php',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            alert(response)
                            location.reload()
                        }
                    })
                }
            })
        })

        function updateKelurahan(id, button) {
            data = {
                id: id,
                namaKelurahan: $(button).closest('tr').find('input[name="namaKelurahanUpdate"]').val(),
                namaKecamatan: $(button).closest('tr').find('input[name="namaKecamatanUpdate"]').val(),
            }

            let result = confirm("Apakah anda yakin ingin memperbarui data");

            if (result) {
                $.ajax({
                    url: 'kelurahan/updateData.php',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        alert(response)
                        location.reload()
                    }
                })
            }

        }

        function hapusKelurahan(id) {
            data = {
                id: id
            }
            let result = confirm("Apakah anda yakin ingin menghapus");
            if (result) {
                $.ajax({
                    url: 'kelurahan/hapusData.php',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        alert(response)
                        location.reload()
                    }
                })
            }
        }
    </script>
</body>

</html>