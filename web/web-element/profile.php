

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Profile pengguna</h1>
    <ul>
        <li><?= $account['username'] ?></li>
        <li><?= $account['email'] ?></li>
        <li><?= $account['phone-number'] ?></li>
        <li><?= $account['address'] ?></li>
    </ul>
    <P>Belum ku desain halaman ini</P>
    <form method="POST" action="script/delete.php">
        <button>apus akun</button>
    </form>
        
</body>
</html>