<?php
// var_dump($_POST['00']);
// die();

function cek($grid, $row, $col, $num)
{
    // row dan col
    for ($i = 0; $i < 9; $i++) {
        if ($grid[$row][$i] == $num || $grid[$i][$col] == $num) {
            return false;
        }
    }
    // Cek 3x3
    $startRow = $row - $row % 3;
    $startCol = $col - $col % 3;
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($grid[$startRow + $i][$startCol + $j] == $num) {
                return false;
            }
        }
    }
    return true;
}

function solve(&$grid)
{
    for ($row = 0; $row < 9; $row++) {
        for ($col = 0; $col < 9; $col++) {
            if ($grid[$row][$col] == 0) {
                for ($i = 1; $i < 10; $i++) {
                    if (cek($grid, $row, $col, $i)) {
                        $grid[$row][$col] = $i;
                        if (solve($grid)) {
                            return true;
                        }
                        $grid[$row][$col] = 0;
                    }
                }
                return false; //Tidak ada solusi
            }
        }
    }
    return true; //semua sel terisi
}

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $grid = $_POST['cell'];
    // Konversi nilai kosong ke 0
    foreach ($grid as $row => $cols) {
        foreach ($cols as $col => $value) {
            $grid[$row][$col] = $value ? intval($value) : 0;
        }
    }

    if (solve($grid)) {
        $_SESSION['status'] = 'success';
        $_SESSION['grid'] = $grid;
        header("Location:index.php");
        exit();
    } else {
        $_SESSION['status'] = 'failed';
        $_SESSION['grid'] = $_POST['cell'];
        header("Location:index.php");
        exit();
    }
}
?>