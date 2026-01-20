<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Expired</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Fredoka:wght@600&display=swap"
        rel="stylesheet">
</head>

<body class="bg-yellow-50 flex items-center justify-center min-h-screen font-mono text-center px-4">
    <div class="bg-white border-4 border-black p-8 rounded-2xl shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] max-w-sm w-full">
        <span class="material-icons-round text-6xl text-gray-400 mb-4">sentiment_dissatisfied</span>
        <h1 class="font-fredoka text-3xl font-bold mb-2">Oops!</h1>
        <p class="mb-6 text-gray-600">This card has reached its view limit (3/3). <br /> The party is over!</p>
        <a href="{{ route('home') }}"
            class="inline-block bg-yellow-400 border-2 border-black px-6 py-3 rounded-xl font-bold hover:bg-yellow-300 hover:-translate-y-1 transition-transform shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            Create New Card
        </a>
    </div>
</body>

</html>
