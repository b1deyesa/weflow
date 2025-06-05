<x-layout.admin>
    <h1 class="fs-5 fw-bold text-dark" style="margin: 0">Add Team</h1>
    <x-form action="{{ route('admin.team.update', compact('team')) }}" method="PUT" enctype="multipart/form-data" class="mt-4">
        <div class="d-flex gap-4">
            <div class="d-flex flex-column w-100">
                <x-input label="Team Name" type="text" name="name" value="{{ $team->name }}" />
                <x-input label="Coach" type="select-search" name="employee_id" :options="$employees" :value="$team->employees?->first()->id" />
            </div>
            <div class="d-flex flex-column gap-2" style="width: 600px">
                <div class="d-flex align-items-center justify-content-center text-center bg-white border rounded" style="height: 177px; border-style: dashed !important;">
                    @if($team->logo)
                        <div>
                            <img id="preview" src="{{ asset('storage/Team/'. $team->logo) }}" alt="Preview" style="max-width: 200px; max-height: 150px;" class="img-thumbnail">
                        </div>
                    @else
                        <span id="preview-text" class="text-muted">Preview Photo</span>
                        <div>
                            <img id="preview" src="{{ asset('storage/Team/'. $team->logo) }}" alt="Preview" style="max-width: 200px; max-height: 150px; display: none;" class="img-thumbnail">
                        </div>
                    @endif
                </div>
                <x-input type="file" name="photo" />
            </div>
            <script>
                document.getElementById('photo').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('preview');
                    const previewText = document.getElementById('preview-text');
            
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                            previewText.style.display = 'none';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.src = '#';
                        preview.style.display = 'none';
                        previewText.style.display = 'block';
                    }
                });
            </script>
        </div>
        <x-table>
            <x-slot:head>
                <th width="30%">Name</th>
                <th>Course</th>
                <th></th>
            </x-slot:head>
            <x-slot:body>
                @foreach ($customers as $customer)
                    <tr>
                        <td>
                            <span class="fw-bold" style="font-size: .9em">{{ $customer->code }}</span> -- {{ $customer->name }}
                        </td>
                        <td>
                            <ul class="m-0 p-0 ps-2" style="list-style: square">
                                @foreach ($customer->courses as $course)
                                    <li>{{ $course->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td width="1%">
                            <input type="checkbox" class="btn-check" name="customer_id[{{ $customer->id }}]" id="customer-{{ $customer->id }}" @checked(old('customer_id[{{ $customer->id }}]', in_array($customer->id, $team->customers->pluck('id')->toArray()))) autocomplete="off">
                            <label class="btn btn-outline-secondary py-1" for="customer-{{ $customer->id }}" style="font-size: .9em">Select</label><br>
                        </td>
                    </tr>
                @endforeach
            </x-slot:body>
        </x-table>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('admin.team.index') }}" class="btn btn-outline-primary" style="min-width: 80px">Close</a>
            <x-button type="submit" class="btn-primary" width="80px">Submit</x-button>
        </div>
    </x-form>
</x-layout.admin>