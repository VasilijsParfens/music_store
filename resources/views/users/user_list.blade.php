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

    <nav class="bg-orange-200 p-4 shadow-lg mt-8">
        <div class="max-w-7xl mx-auto flex justify-center space-x-60">
            <a href="/album_list" class="text-black text-xl px-4 py-2 rounded-lg hover:bg-orange-400">Albums</a>
            <a href="/user_list" class="text-black text-xl px-4 py-2 rounded-lg hover:bg-orange-400">Users</a>
            <a href="/comment_list" class="text-black text-xl px-4 py-2 rounded-lg hover:bg-orange-400">Comments</a>
            <a href="/order_list" class="text-black text-xl px-4 py-2 rounded-lg hover:bg-orange-400">Orders</a>
        </div>
    </nav>

    <div class="flex justify-center mt-6"> <!-- Centering the table -->
        <div class="max-w-4xl"> <!-- Adjusting the maximum width -->
            @if(count($users) > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">User Id</th>
                            <th class="px-4 py-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">E-mail</th>
                            <th class="px-4 py-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Is_admin</th>
                            <th class="px-4 py-4 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-base">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $user->id }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-4 py-4 whitespace-nowrap">{{ $user->is_admin}}</td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <form method="POST" action="/users/{{ $user->id }}" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white mt-2 p-2 px-4 rounded-xl bg-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">No users found</p>
            @endif
        </div>
    </div>




</body>
