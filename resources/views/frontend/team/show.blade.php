<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $employee['name'] }} - income-expense</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <nav class="bg-white shadow p-4 mb-4">
        <div class="container mx-auto">
            <a href="{{ route('frontend.team') }}" class="font-bold text-xl text-blue-800">INCOME-EXPENSE</a>
        </div>
    </nav>

    <div class="container mx-auto px-4 flex justify-center">
        <div class="bg-white w-full max-w-md rounded-xl shadow-xl overflow-hidden mt-6">

            <div class="h-32 bg-blue-600 relative">
                <!-- Cover Image/Background -->
            </div>

            <div class="px-6 pb-6">
                <div class="relative -top-12 text-center">
                    <div
                        class="w-24 h-24 bg-gray-200 rounded-full border-4 border-white mx-auto flex items-center justify-center text-3xl font-bold text-gray-500 shadow-sm">
                        {{ substr($employee['name'], 0, 1) }}
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 mt-2">{{ $employee['name'] }}</h1>
                    <p class="text-blue-600 font-medium text-lg">{{ $employee['role'] }}</p>
                    <span
                        class="inline-block bg-blue-50 rounded-full px-3 py-1 text-sm font-semibold text-blue-600 mt-2 border border-blue-100">
                        {{ $employee['dept'] }}
                    </span>
                </div>

                <div class="space-y-4 border-t pt-4 mt-2">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-500">Employee ID</span>
                        <span class="font-mono font-bold text-gray-800">{{ $employee['id'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-500">Email</span>
                        <span class="text-gray-900">contact@income-expense.com</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-500">Office Location</span>
                        <span class="text-gray-900 text-right">Dhaka, Bangladesh</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>