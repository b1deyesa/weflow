<x-layout.admin>
    <div class="d-flex align-items-center justify-content-between gap-2">
        <h1 class="fs-5 fw-bold text-dark" style="margin: 0">Payment</h1>
    </div>
    <div class="mt-5">
        <x-table>
            <x-slot:head>
                <th style="white-space: nowrap">Customer ID</th>
                <th>Customer Name</th>
                <th>Total Payment</th>
                {{-- <th></th> --}}
            </x-slot:head>
            <x-slot:body>
                @foreach ($customers as $customer)
                    <tr>
                        <td width="1%">{{ $customer->code }}</td>
                        <td>{{ $customer->name }}</td>
                        <td width="1%">{{ currency($customer->totalPayment()) }}</td>
                        {{-- <td width="92px">                            
                            <div class="d-flex gap-1">
                                @livewire('admin.payment.status', ['customer' => $customer], ['key' => $customer->id])
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </x-slot:body>
        </x-table>
    </div>
</x-layout.admin>