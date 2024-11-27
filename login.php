<?php
require("./controller.php");

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
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
    <div class="flex items-center justify-center w-full h-screen bg-yellow-300">
        <div class="flex flex-col gap-8 border-4 border-slate-900 rounded-xl w-full max-w-screen-sm p-8 bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0)]">
            <h1 class="text-center text-4xl font-semibold text-slate-900">Halaman Login</h1>
            <form action="controller.php" method="post" class="flex flex-col gap-4">
                <div class="w-full flex flex-col gap-4">
                    <div class="w-full space-y-1">
                        <p class="font-semibold text-slate-900">Email</p>
                        <input type="text" name="email" class="neu-input">
                    </div>
                    <div class="w-full space-y-1">
                        <p class="font-semibold text-slate-900">Password</p>
                        <input type="password" name="password" class="neu-input">
                    </div>
                </div>
                <button type="submit" name="login" class="bg-yellow-300 text-slate-900 font-bold neu-button">Masuk</button>
            </form>
            <a href="./register.php" class="text-center">Atau bikin akun baru</a>
        </div>
    </div>
</body>

</html>