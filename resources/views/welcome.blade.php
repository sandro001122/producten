<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-md p-6 bg-white rounded shadow-md">
        <h1 class="text-3xl font-bold mb-4">Welcome to our website!</h1>
        <p class="text-gray-600">Click the button below to see our products:</p>
        <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300">View Products</a>
    </div>
</body>
</html>


