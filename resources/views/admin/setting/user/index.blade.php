<x-layout.admin.setting>
    <div>
        <div class="d-flex align-items-center justify-content-end mb-4">
            @livewire('admin.user.create')
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success py-2 px-3" style="font-size: .9em" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div>
        <x-table>
            <x-slot:head>
                <th>User Fullname</th>
                <th>User Email</th>
                <th>Password</th>
                <th></th>
            </x-slot:head>
            <x-slot:body>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->password }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                @livewire('admin.user.update', ['user' => $user], ['key' => 'update-'.$user->id])
                                @livewire('admin.user.delete', ['user' => $user], ['key' => 'delete-'.$user->id])
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-slot:body>
        </x-table>
    </div>
</x-layout.admin.setting>