<x-layout.admin>
    
    <h1 class="fs-5 fw-bold text-dark">Settings</h1>
    
    <ul class="nav nav-tabs mt-5">
        <li class="nav-item">
            <a class="nav-link text-dark @if(request()->routeIs('admin.setting.user.index')) fw-bold active @endif" href="{{ route('admin.setting.user.index') }}">User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="">Setting</a>
        </li>
    </ul>
    
    <div class="bg-white border border-top-0 rounded-bottom p-4">
        {{ $slot }}
    </div>
    
</x-layout.admin>