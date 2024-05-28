<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MusicStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wght@100..800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c35bfed5f0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
            extend: {
                colors: {
                laravel: '#ef3b2d',
                },
            },
            },
        }
    </script>
</head>

<body class="bg-orange-50 font-mono">
    <div class="ml-12 mt-10 mb-4 text-4xl font-martian">
        <a href="/">MusicStore</a>
    </div>
    @auth
    <form class="absolute top-0 right-0 mt-14 mr-14 mb-24" method="POST" action="/logout">
        @csrf
        <button type="submit" class="text-xl hover:underline" style="display: inline-flex; align-items: center;">
        <i class="fa-solid fa-door-open"></i>
        <span style="margin-left: 5px;">Logout</span>
        </button>

    </form>
    @else
    <div class="absolute top-0 right-0 mt-14 mr-14 mb-24">
        <a href="/login" title="Account" class="text-xl"><i class="fa-solid fa-right-to-bracket fa-xl"></i> Login</a>
    </div>
    <div class="absolute top-0 right-0 mt-14 mr-44 mb-24">
        <a href="/register" title="Account" class="text-xl"><i class="fa-solid fa-user-plus"></i> Register</a>
    </div>
    @endauth
    <hr class="border-t-2 border-gray-700">
    <!-- Conditionally display Admin panel link -->
    <div class="absolute top-0 right-0 mt-14 mr-52 mb-24">
        @if(auth()->check() && auth()->user()->is_admin)
            <a href="/album_list" class="text-xl hover:underline mr-12"><i class="fa-solid fa-hammer fa-lg"></i> Admin Panel</a>
            <a href="/stats" class="text-xl hover:underline"><i class="fa-solid fa-chart-simple fa-lg"></i> Statistics</a>
        @endif
    </div>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl text-center font-bold mb-4">Statistics</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
                <div class="font-bold">Total Users</div>
                <div class="text-2xl">{{ $totalUsers }}</div>
            </div>

            <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
                <div class="font-bold">Total Albums</div>
                <div class="text-2xl">{{ $totalAlbums }}</div>
            </div>

            <div class="bg-teal-500 text-white p-4 rounded-lg shadow-md">
                <div class="font-bold">Total Orders</div>
                <div class="text-2xl">{{ $totalOrders }}</div>
            </div>

            <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
                <div class="font-bold">Total Comments</div>
                <div class="text-2xl">{{ $totalComments }}</div>
            </div>
        </div>

        <h2 class="text-xl font-bold mt-8 mb-4">Top 5 Albums by Number of Orders</h2>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4">Album Title</th>
                    <th class="py-2 px-4">Artist</th>
                    <th class="py-2 px-4">Number of Orders</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topAlbums as $album)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $album->title }}</td>
                        <td class="py-2 px-4">{{ $album->artist }}</td>
                        <td class="py-2 px-4">{{ $album->orders_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="text-xl font-bold mt-8 mb-4">Top 5 Users by Number of Orders</h2>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4">User Name</th>
                    <th class="py-2 px-4">Email</th>
                    <th class="py-2 px-4">Number of Orders</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topUsers as $user)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $user->name }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4">{{ $user->orders_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
