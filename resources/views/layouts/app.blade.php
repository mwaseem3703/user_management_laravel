<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS to ensure footer stays at the bottom even with little content -->
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navigation Bar -->
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('user.index') }}" class="text-white text-xl font-bold flex items-center gap-2">
                        <i class="fa-solid fa-users"></i> UserSystem
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('user.index') }}" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md transition"><i class="fa-solid fa-house"></i> Home</a>
                    <a href="{{ route('user.create') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-4 py-2 rounded-md font-semibold transition"><i class="fa-solid fa-plus"></i> Register User</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="max-w-7xl mx-auto py-8 px-4 w-full">
        @if(Session::has('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Brand & Description -->
                <div>
                    <h3 class="text-white text-lg font-bold mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-users"></i> UserSystem
                    </h3>
                    <p class="text-sm text-gray-400">
                        A modern Laravel application designed for secure and efficient user registration and management.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('user.index') }}" class="hover:text-blue-400 transition">View All Users</a></li>
                        <li><a href="{{ route('user.create') }}" class="hover:text-blue-400 transition">Register New User</a></li>
                    </ul>
                </div>

                <!-- Contact & Social -->
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Connect</h3>
                    <div class="flex space-x-4">
                        <a href="https://github.com/mwaseem3703" class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center hover:bg-blue-600 hover:text-white transition">
                            <i class="fa-brands fa-github"></i>
                        </a>
                        
                        <a href="https://www.linkedin.com/in/mwaseem3703/" class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center hover:bg-blue-800 hover:text-white transition">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright Line -->
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} UserSystem. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>