<?php

class Flasher {
    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<script>
                    Swal.fire({
                        title: "' . $_SESSION['flash']['aksi'] . '",
                        text: "' . $_SESSION['flash']['pesan'] . '",
                        icon: "' . $_SESSION['flash']['tipe'] . '"
                    });
                  </script>';
            unset($_SESSION['flash']);
        }
    }
}
