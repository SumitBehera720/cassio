<!DOCTYPE html>
<html><head><script src='https://cdn.tailwindcss.com'></script></head>
<body class='bg-gray-200 flex items-center justify-center h-screen'>
    <form action='{{ route('admin.login.submit') }}' method='POST' class='bg-white p-8 rounded shadow-md w-96'>
        @csrf
        <h2 class='text-2xl mb-4 font-bold'>Admin Login</h2>
        <input type='email' name='email' placeholder='Email' class='w-full border p-2 mb-4 rounded' required>
        <input type='password' name='password' placeholder='Password' class='w-full border p-2 mb-4 rounded' required>
        <button class='w-full bg-blue-600 text-white p-2 rounded'>Login</button>
    </form>
</body></html>