<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>dolanDjogja | Tambah Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="POST" action="/view/bookings/store" class="bg-white p-6 rounded shadow w-full max-w-md">
        @csrf
        <h2 class="text-2xl font-bold mb-4 text-blue-700">Tambah Booking</h2>

        <input type="number" name="user_id" placeholder="User ID" class="w-full border p-2 mb-3" required>
        <input type="number" name="package_id" placeholder="Package ID" class="w-full border p-2 mb-3" required>
        <input type="number" name="schedule_id" placeholder="Schedule ID" class="w-full border p-2 mb-3" required>
        <input type="date" name="booking_date" class="w-full border p-2 mb-3" required>
        <input type="number" name="total_person" placeholder="Jumlah Orang" class="w-full border p-2 mb-3" required>
        <input type="number" name="total_price" placeholder="Total Harga" class="w-full border p-2 mb-3" required>

        <select name="status" class="w-full border p-2 mb-3" required>
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>

        <div class="flex justify-between items-center mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="/view/bookings" class="text-gray-500 hover:underline">Batal</a>
        </div>
    </form>
</body>

</html>