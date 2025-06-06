<x-layout.app>
    <style>
        .sidebar {
            font-size: .92em;
            background: linear-gradient(120deg, #2d3338, #354656, #35393d) !important;
        }
        .active {
            opacity: 100% !important;
            text-shadow: 0 0 10px #ffffff60;
        }
        .content {
            position: relative;
            overflow: hidden;
        }
        .content > img {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(1);
            z-index: -2;
        }
        .content::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            background: linear-gradient(120deg, #d2f6ff50, #c9a28f50, #e1e1e1);
            z-index: -1;
        }
    </style>
    <div class="d-flex" style="font-size: .9em">
        <div class="sidebar" style="width: 100%; max-width: 200px;">
            <div class="container">
                <div class="d-flex flex-column px-2">
                    <span class="fw-bold text-light opacity-75 mt-4 mb-2" style="font-size: .8em">Employees</span>
                    <a href="{{ route('admin.employee.index') }}" class="text-decoration-none text-light py-1 opacity-50 {{ request()->routeIs('admin.employee.*') ? 'active' : '' }}"><i class="bi bi-person-rolodex me-2"></i>Employee Data</a>
                    <a href="{{ route('admin.salary.index') }}" class="text-decoration-none text-light py-1 opacity-50 {{ request()->routeIs('admin.salary.*') ? 'active' : '' }}"><i class="bi bi-credit-card me-2"></i>Salary</a>
                    <span class="fw-bold text-light opacity-50 mt-4 mb-2" style="font-size: .8em">Courses</span>
                    <a href="{{ route('admin.course.index') }}" class="text-decoration-none text-light py-1 opacity-50 {{ request()->routeIs('admin.course.*') ? 'active' : '' }}"><i class="bi bi-card-list me-2"></i>Course List</a>
                    <a href="{{ route('admin.customer.index') }}" class="text-decoration-none text-light py-1 opacity-50 {{ request()->routeIs('admin.customer.*') ? 'active' : '' }}"><i class="bi bi-people-fill me-2"></i>Customers</a>
                    <a href="{{ route('admin.payment.index') }}" class="text-decoration-none text-light py-1 opacity-50 {{ request()->routeIs('admin.payment.*') ? 'active' : '' }}"><i class="bi bi-wallet me-2"></i>Payments</a>
                    <span class="fw-bold text-light opacity-50 mt-4 mb-2" style="font-size: .8em">Pro</span>
                    <a href="{{ route('admin.team.index') }}" class="text-decoration-none text-light py-1 opacity-50 {{ request()->routeIs('admin.team.*') ? 'active' : '' }}"><i class="bi bi-people-fill me-2"></i>Teams</a>
                    <a href="{{ route('admin.game.index') }}" class="text-decoration-none text-light py-1 opacity-50 {{ request()->routeIs('admin.game.*') ? 'active' : '' }}"><i class="bi bi-people-fill me-2"></i>Games</a>
                    <span class="fw-bold text-light opacity-50 mt-4 mb-2" style="font-size: .8em">Reports</span>
                    <a href="" class="text-decoration-none disabled-link text-light py-1 {{ request()->routeIs('admin..*') ? 'active' : '' }}"><i class="bi bi-cash-coin me-2"></i>Monthly Payroll</a>
                    <a href="" class="text-decoration-none disabled-link text-light py-1 {{ request()->routeIs('admin..*') ? 'active' : '' }}"><i class="bi bi-currency-dollar me-2"></i>Course Payments</a>
                    {{-- <hr class="border-light mt-5">
                    <a href="{{ route('admin.setting.user.index') }}" class="text-decoration-none text-light py-1 opacity-50 {{ request()->routeIs('admin.setting.user.*') ? 'active' : '' }} mt-1"><i class="bi bi-gear-fill me-2"></i>Settings</a> --}}
                </div>
            </div>
        </div>
        <div class="content w-100 min-vh-100 p-5" style="font-size: .9em">
            <img src="{{ asset('img/background.jpg') }}" alt="">
            {{ $slot }}
        </div>
    </div>
</x-layout.app>