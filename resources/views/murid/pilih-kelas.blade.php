@extends('layouts.header.murid')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif
    <h2>Pilih Kelas dan Jurusan</h2>
    <form action="{{ route('kelas.simpan') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="search" class="form-label">Cari Kelas dan Jurusan</label>
            <input type="text" id="search" class="form-control" placeholder="Masukkan nama kelas atau jurusan...">
            <div id="search-results" class="list-group mt-2 p-0" style="display: none; position: absolute; z-index: 1000; width: 100%; max-height: 200px; overflow-y: auto; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);"></div>
        </div>
        <div class="mb-3">
            <label for="kelas" class="form-label">Pilih Kelas dan Jurusan</label>
            <select name="kelas_id" id="kelas" class="form-select" required>
                <option value="">-- Pilih Kelas dan Jurusan --</option>
                @foreach($kelas as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kelas }} - {{ $item->jurusan }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    const searchInput = document.getElementById('search');
    const searchResults = document.getElementById('search-results');
    const kelasSelect = document.getElementById('kelas');
    const kelasOptions = Array.from(kelasSelect.options).slice(1); // Exclude the placeholder option

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase().trim();
        searchResults.innerHTML = ''; // Clear previous results

        if (query) {
            let matches = kelasOptions.filter(option => option.text.toLowerCase().includes(query));
            if (matches.length > 0) {
                searchResults.style.display = 'block';
                matches.forEach(option => {
                    const item = document.createElement('button');
                    item.type = 'button';
                    item.classList.add('list-group-item', 'list-group-item-action');
                    item.textContent = option.text;
                    item.style.padding = '10px 15px';
                    item.style.cursor = 'pointer';
                    item.onmouseover = function() { this.style.backgroundColor = '#f8f9fa'; }
                    item.onmouseout = function() { this.style.backgroundColor = ''; }
                    item.onclick = function() {
                        kelasSelect.value = option.value; // Set the selected value in the dropdown
                        searchResults.style.display = 'none';
                        searchInput.value = option.text;
                    };
                    searchResults.appendChild(item);
                });
            } else {
                searchResults.style.display = 'none';
            }
        } else {
            searchResults.style.display = 'none';
        }
    });

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });
</script>
@endsection