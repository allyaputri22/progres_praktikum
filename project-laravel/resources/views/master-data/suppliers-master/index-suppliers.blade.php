<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>


 
  <div class="container p-4 mx-auto flex justify-center">
    <div class="overflow-x-auto">
      @if (session('success'))
      <div class = "mb-4 rounded-lg bg-green-50 p-4 text-green-500">
        {{session('success')}}
      </div>
 @elseif (session('error'))
      <div class = "mb-4 rounded-lg bg-green-50 p-4 text-red-500">
        {{session('error')}}
      </div>
@endif
      <a href="{{ route('suppliers-create')}}">
        <button class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
            Add suppliers data
        </button>
    </a>
      <table class="min-w-full border border-collapse border-gray-200">
        <thead>
          <tr class="bg-gray-100">
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Suppliers Name</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Suppliers Addres</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Phone</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Comment</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
            <tr class="bg-white">
              <td class="px-4 py-2 border border-gray-200">{{ $item->id }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->supplier_name }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->supplier_address }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->phone }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $item->comment }}</td>
              <td class="px-4 py-2 border border-gray-200">
                <a href="{{ route('suppliers-edit', $item->id) }}" class="px-2 text-blue-600 hover:text-blue-800">Edit</a>
                <button class="px-2 text-red-600 hover:text-red-800" onclick="confirmDelete('{{route('suppliers-deleted', $item->id)}}')">Hapus</button>
              </td>
            </tr>
          @endforeach


          <!-- Tambahkan baris lainnya sesuai kebutuhan -->
        </tbody>
      </table>
    </div>
  </div>


  <script>
    function confirmDelete(deleteUrl) {
      console.log(deleteUrl);
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                // Jika user mengonfirmasi, kita dapat membuat form dan mengirimkan permintaan delete
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
   
                // Tambahkan CSRF token
                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);
   
                // Tambahkan method spoofing untuk DELETE (karena HTML form hanya mendukung GET dan POST)
                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
   
                // Tambahkan form ke body dan submit
                document.body.appendChild(form);
                form.submit();
            }
        }
  </script>




</x-app-layout>
