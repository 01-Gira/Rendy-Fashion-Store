<?php
session_start();
session_destroy();
echo "<script>alert('Anda keluar dari halaman administrator'); window.location = 'index.php'</script> ";

?>