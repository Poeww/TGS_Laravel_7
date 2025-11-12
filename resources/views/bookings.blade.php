<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dolanDjogja | Data Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-50 min-h-screen flex flex-col">

    <header class="text-center py-8">
        <h1 class="text-4xl font-bold text-blue-700 mb-2">Daftar Booking</h1>
        <p class="text-blue-500 mb-4">Kelola data pemesanan dolanDjogja</p>
        <a href="/view/bookings/create" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">+ Tambah
            Booking</a>
    </header>

    <main class="flex-1 flex justify-center">
        <div class="w-full max-w-6xl bg-white shadow-lg rounded-lg overflow-hidden border border-blue-200 mx-4">
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 text-center">{{ session('success') }}</div>
            @endif

            <table class="min-w-full table-auto text-sm text-gray-700">
                <thead class="bg-blue-600 text-white uppercase text-sm">
                    <tr>
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">User</th>
                        <th class="py-3 px-4 text-left">Package</th>
                        <th class="py-3 px-4 text-left">Tanggal</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $b)
                        <tr class="border-b hover:bg-blue-50 transition-colors duration-150">
                            <td class="py-3 px-4">{{ $b->id }}</td>
                            <td class="py-3 px-4">{{ $b->user_id }}</td>
                            <td class="py-3 px-4">{{ $b->package_id }}</td>
                            <td class="py-3 px-4">{{ $b->booking_date }}</td>
                            <td class="py-3 px-4 capitalize">{{ $b->status }}</td>
                            <td class="py-3 px-4">
                                <a href="/view/bookings/edit/{{ $b->id }}"
                                    class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="/view/bookings/delete/{{ $b->id }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <footer class="mt-auto bg-blue-700 text-white text-center py-4">
        <p class="text-sm tracking-wide">&copy; {{ date('Y') }} dolanDjogja by Universitas Atma Jaya Yogyakarta</p>
    </footer>
</body>

</html>