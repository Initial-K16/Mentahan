<div class="sidebar">
    <h5>Menu Pengajar</h5>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('pengajar.pengajar-dashboard') }}" class="nav-link">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
        </li>
        <li class="list-group-item">
            <a class="nav-link" href="{{ route('upload.index') }}">
                <i class="bi bi-upload"></i> Upload Materi/Tugas
            </a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('materi.index') }}" class="nav-link">
                <i class="bi bi-journal-text"></i> Kelola Materi
            </a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('tugas.index') }}" class="nav-link">
                <i class="bi bi-list-check"></i> Kelola Tugas
            </a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('pengajar.tugas.tugas-murid') }}" class="nav-link">
                <i class="bi bi-list-check"></i> Submittion Tugas Murid
            </a>
        </li>
    </ul>
</div>