<div class="sidebar">
    <ul class="list-group">
        <li class="list-group-item">
            <a href="{{ route('admin.admin-dashboard') }}" class="nav-link">Dashboard</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('pengajar.index') }}" class="nav-link">Data Pengajar</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('murid.index') }}" class="nav-link">Data Murid</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('kelas.index') }}" class="nav-link">Data Kelas</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('mapel.index') }}" class="nav-link">Data Mapel</a>
        </li>
    </ul>
</div>

<style>
    .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 56px; /* Adjust according to navbar height */
        left: 0;
        background-color: #f8f9fa;
        padding: 15px;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }

    .nav-link {
        color: #333;
    }

    .nav-link:hover {
        background-color: #e2e6ea;
    }

    .list-group-item {
        border: none;
    }
</style>
