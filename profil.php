<?php
require("./controller.php");

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userData = getDataDiriBySession();
$userAkun = getDataAkunBySession();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Profil</title>
    <style type="text/tailwindcss">
        @layer utilities {
            .neu-input {
                @apply border-4 border-slate-900 rounded-xl w-full py-2 px-4 shadow-[2px_2px_0px_0px_rgba(0,0,0)] focus:outline-none focus:ring-0
            }
            .neu-button {
                @apply font-bold p-2 rounded-lg border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-transform duration-100
            }
        }
    </style>
</head>

<body>
    <div class="flex flex-col gap-8 items-center justify-center w-full h-screen bg-yellow-300">

        <div class="flex gap-4 max-w-screen-sm w-full">
            <div class="bg-white w-24 aspect-square rounded-full border-4 border-slate-900">
            </div>
            <div class="flex justify-between flex-1">
                <div class="flex flex-col justify-between">
                    <h2 class="text-3xl font-semibold">Hai, <?php echo isset($userData['nama']) ? $userData['nama'] : 'User'; ?> </h2>
                    <a href="dashboard.php" class="neu-button bg-white hover:cursor-pointer w-fit">Ubah Data Diri</a>
                </div>
                <form action="controller.php" method="post">
                    <button type="submit" name="logout" class="bg-red-400 text-slate-900 font-bold neu-button h-fit" onclick="return confirm('Apakah anda yakin ingin keluar?');">Keluar</button>
                </form>
            </div>
        </div>

        <div class="flex flex-col gap-8 border-4 border-slate-900 rounded-xl w-full max-w-screen-sm p-8 bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0)]">
            <h1 class="text-center text-4xl font-semibold text-slate-900">Data Akun</h1>
            <form action="controller.php" method="post" class="flex flex-col gap-4">
                <div class="w-full flex flex-col gap-4">
                    <div class="w-full space-y-1">
                        <p class="font-semibold text-slate-900">Email</p>
                        <input type="text" name="email" required class="neu-input" value="<?php echo isset($userAkun['email']) ? $userAkun['email'] : ''; ?>">
                    </div>
                    <div class="w-full space-y-1">
                        <p class="font-semibold text-slate-900">Password</p>
                        <input type="password" name="password" class="neu-input">
                    </div>
                </div>
                <button type="submit" name="ubahDataAkun" class="bg-yellow-300 text-slate-900 font-bold neu-button" onclick="return confirm('Apakah anda yakin ingin mengubah data akun anda?');">Ubah Data Akun</button>
                <button type="submit" name="hapusAkun" class="bg-red-400 text-slate-900 font-bold neu-button" onclick="return confirm('Apakah anda yakin ingin menghapus akun anda?');">Hapus Akun</button>
            </form>
        </div>
    </div>
</body>

</html>