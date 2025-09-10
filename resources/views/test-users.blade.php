<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Test Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white p-6">
    <h1 class="text-3xl font-bold mb-6">🔐 Test Users in Database</h1>

    @foreach ($users as $role => $group)
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-teal-400 capitalize mb-2">{{ str_replace('_', ' ', $role) }}</h2>
        <table class="w-full border border-gray-700 rounded-lg overflow-hidden text-sm">
            <thead class="bg-gray-800 text-gray-300">
                <tr>
                    <th class="px-3 py-2 text-left">Role ID</th>
                    <th class="px-3 py-2 text-left">Name</th>
                    <th class="px-3 py-2 text-left">Email</th>
                    <th class="px-3 py-2 text-left">Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group as $user)
                <tr class="border-t border-gray-700 hover:bg-gray-800">
                    <td class="px-3 py-2 font-mono">{{ $user->role_id }}</td>
                    <td class="px-3 py-2">{{ $user->name }}</td>
                    <td class="px-3 py-2">{{ $user->email }}</td>
                    <td class="px-3 py-2 text-gray-400">password123</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach

    <p class="text-gray-400 mt-10 text-xs">⚡ All seeded users use <code>password123</code> by default.</p>
</body>

</html>