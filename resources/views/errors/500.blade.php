<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error (500)</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">

    <div class="w-full h-screen flex flex-col lg:flex-row items-center justify-center space-y-16 lg:space-y-0 space-x-8 2xl:space-x-0">
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center lg:px-2 xl:px-0 text-center">
            <p class="text-7xl md:text-8xl lg:text-9xl font-bold tracking-wider text-gray-300">500</p>
            <p class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-wider text-gray-300 mt-2">Server Error</p>
            <p class="text-lg md:text-xl lg:text-2xl text-gray-500 my-12">Whoops, something went wrong on our servers.</p>
        </div>
        <div class="w-1/2 lg:h-full flex lg:items-end justify-center p-4">
            <svg class="w-full text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1119.60911 699">
                <circle cx="292.60911" cy="213" r="213" fill="#f2f2f2"></circle>
                </svg>
        </div>
    </div>

</body>
</html>