<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pencatatan Data Penjualan</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Form Input untuk Data Penjualan</h2>
    <form method="POST" action="">
        <table align="center">
            <tr>
                <td>Nama Produk:</td>
                <td><input type="text" name="nama_produk" required></td>
            </tr>
            <tr>
                <td>Harga Per Produk:</td>
                <td><input type="number" name="harga" required></td>
            </tr>
            <tr>
                <td>Jumlah Terjual:</td>
                <td><input type="number" name="jumlah" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="submit">Tambahkan Penjualan</button>
                </td>
            </tr>
        </table>
    </form>

    <?php
    // Array untuk menyimpan data transaksi
    session_start();
    if (!isset($_SESSION['transaksi'])) {
        $_SESSION['transaksi'] = [];
    }

    // Menyimpan data input ke dalam array transaksi
    if (isset($_POST['submit'])) {
        $nama_produk = $_POST['nama_produk'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $total = $harga * $jumlah;

        $transaksi = [
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'total' => $total
        ];

        array_push($_SESSION['transaksi'], $transaksi);
    }

    // Menampilkan laporan penjualan
    if (!empty($_SESSION['transaksi'])) {
        echo "<h2 style='text-align: center;'>Laporan Penjualan</h2>";
        echo "<table align='center'>
                <tr>
                    <th>Nama</th>
                    <th>Harga Per Produk</th>
                    <th>Jumlah Terjual</th>
                    <th>Total</th>
                </tr>";

        $total_jumlah = 0;
        $grand_total = 0;

        foreach ($_SESSION['transaksi'] as $t) {
            echo "<tr>
                    <td>{$t['nama_produk']}</td>
                    <td>{$t['harga']}</td>
                    <td>{$t['jumlah']}</td>
                    <td>{$t['total']}</td>
                  </tr>";
            $total_jumlah += $t['jumlah'];
            $grand_total += $t['total'];
        }

        echo "<tr>
                <th colspan='2'>Total Penjualan</th>
                <td>$total_jumlah</td>
                <td>$grand_total</td>
              </tr>";
        echo "</table>";
    }
    ?>
</body>
</html>