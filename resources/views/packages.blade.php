<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dolanDjogja | Data Paket Wisata</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-50 min-h-screen flex flex-col">

    <header class="text-center py-8">
        <h1 class="text-4xl font-bold text-blue-700 mb-2">Daftar Paket Wisata</h1>
        <p class="text-blue-500 mb-4">Kelola data paket wisata dolanDjogja</p>
        <a href="/view/packages/create" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">+ Tambah
            Paket</a>
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
                        <th class="py-3 px-4 text-left">Nama Paket</th>
                        <th class="py-3 px-4 text-left">Lokasi</th>
                        <th class="py-3 px-4 text-left">Durasi</th>
                        <th class="py-3 px-4 text-left">Harga</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $p)
                        <tr class="border-b hover:bg-blue-50 transition-colors duration-150">
                            <td class="py-3 px-4">{{ $p->id }}</td>
                            <td class="py-3 px-4">{{ $p->package_name }}</td>
                            <td class="py-3 px-4">{{ $p->location }}</td>
                            <td class="py-3 px-4">{{ $p->duration }}</td>
                            <td class="py-3 px-4 font-semibold text-blue-600">Rp {{ number_format($p->price, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-4">
                                <a href="/view/packages/edit/{{ $p->id }}"
                                    class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="/view/packages/delete/{{ $p->id }}" method="POST" class="inline">
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