<x-layout.admin>
    <h1 class="fs-5 fw-bold text-dark" style="margin: 0">Add Customer</h1>
    <x-form action="{{ route('admin.customer.update', compact('customer')) }}" method="PUT" class="mt-4">
        <div class="d-flex gap-3">
            <div class="d-flex flex-column" style="min-width: 70%">
                <div class="d-flex gap-3">
                    <div class="d-flex flex-column w-100">
                        <x-input label="Customer ID" type="text" name="code" value="{{ $customer->code }}" disabled />
                        <input type="hidden" name="code" value="{{ $customer->code }}">
                        <x-input label="Email" type="email" name="email" value="{{ $customer->email }}" />
                    </div>
                    <div class="d-flex flex-column w-100">
                        <x-input label="Full Name" type="text" name="name" value="{{ $customer->name }}" />
                        <x-input label="Phone" type="text" name="phone" value="{{ $customer->phone }}" />
                    </div>
                </div>
                <x-input label="Address" type="textarea" name="address" value="{{ $customer->address }}" />
            </div>
            <x-input label="Note" type="textarea" name="note" value="{{ $customer->note }}" rows="10" />
        </div>
        <x-input label="Status" type="switch" name="status" :value="$customer->status" />
        <hr class="my-2 border-dashed">
        <x-table>
            <x-slot:head>
                <th width="30%">Course</th>
                <th>Days in Week</th>
                <th>Date Start</th>
                <th>Date End</th>
                <th>Price</th>
                <th></th>
            </x-slot:head>
            <x-slot:body>
                @foreach ($courses as $course)
                    <tr>
                        <td>
                            <span class="fw-bold" style="font-size: .9em">{{ $course->code }}</span> -- {{ $course->name }}
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span>{!! days($course->days) !!}</span>
                            </div>
                        </td>
                        <td style="white-space: nowrap">{{ \Carbon\Carbon::parse($course->date_start)->format('d M Y') }}</td>
                        <td style="white-space: nowrap">{{ \Carbon\Carbon::parse($course->date_end)->format('d M Y') }}</td>
                        <td style="white-space: nowrap">{{ currency($course->price) }}</td>
                        <td width="1%">
                            <input type="checkbox" class="btn-check" name="course_id[{{ $course->id }}]" id="course-{{ $course->id }}" autocomplete="off" @checked(in_array($course->id, $customer->courses->pluck('id')->toArray()))>
                            <label class="btn btn-outline-secondary py-1" for="course-{{ $course->id }}" style="font-size: .9em">Select</label><br>
                        </td>
                    </tr>
                @endforeach
            </x-slot:body>
        </x-table>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('admin.customer.index') }}" class="btn btn-outline-primary" style="min-width: 80px">Close</a>
            <x-button type="submit" class="btn-primary" width="80px">Submit</x-button>
        </div>
    </x-form>
</x-layout.admin>