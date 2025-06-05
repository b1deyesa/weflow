<x-layout.admin>
    <div class="d-flex align-items-center gap-3">
        <h1 class="fs-5 fw-bold text-dark" style="margin: 0">Customers</h1>
        <a href="{{ route('admin.customer.create') }}" class="btn btn-outline-secondary btn-sm py-0">Add Customer</a>
    </div>
    <div class="mt-5">
        <x-table>
            <x-slot:head>
                <th>Code</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th></th>
            </x-slot:head>
            <x-slot:body>
                @foreach ($customers as $customer)
                    <tr>
                        <td width="1%">{{ $customer->code }}</td>
                        <td>{{ $customer->name }}</td>
                        <td width="1%">{{ $customer->email }}</td>
                        <td width="1%">{{ $customer->phone }}</td>
                        <td width="1%">{!! status($customer->status) !!}</td>
                        <td width="1%">
                            <div class="d-flex gap-1">
                            <a href="{{ route('admin.customer.edit', compact('customer')) }}" class="btn btn-outline-dark btn-sm px-1 py-0"><i class="bi bi-pencil-square"></i></a>
                            @livewire('admin.customer.delete', ['customer' => $customer], ['key' => 'delete-'.$customer->id])
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-slot:body>
        </x-table>
    </div>
</x-layout.admin>