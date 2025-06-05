<x-layout.admin>
    <h1 class="fs-5 fw-bold text-dark" style="margin: 0">Add Employee</h1>
    <x-form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="d-flex gap-5 w-100">
            <div class="d-flex flex-column w-100">
                <div class="d-flex gap-3 w-100">
                    <x-input label="Employee ID" type="text" name="code" value="{{ $code }}" disabled />
                    <input type="hidden" name="code" value="{{ $code }}">
                    <x-input label="Full Name" type="text" name="name" />
                </div>
                <div class="d-flex gap-3 w-100">
                    <x-input label="Email" type="email" name="email" />
                    <x-input label="Phone" type="text" name="phone" />
                </div>
                <div class="d-flex gap-3 w-100">
                    <x-input label="Position" type="text" name="position" />
                    <x-input label="Join Date" type="date" name="join_date" />            
                </div>
            </div>
            <div class="d-flex flex-column gap-2" style="width: 300px">
                <div class="d-flex align-items-center justify-content-center text-center bg-white border rounded" style="height: 177px; border-style: dashed !important;">
                    <span id="preview-text" class="text-muted">Preview Photo</span>
                    <img id="preview" src="#" alt="Preview" style="max-width: 200px; display: none;" class="img-thumbnail">
                </div>
                <x-input type="file" name="photo" />
            </div>
        </div>
        <x-input label="Working Days" type="checkbox" :options="json_encode([1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'])" name="working_days" />
        <x-input label="Status" type="switch" name="status" :value="true" />
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('admin.employee.index') }}" class="btn btn-outline-primary" style="min-width: 80px">Close</a>
            <x-button type="submit" class="btn-primary" width="80px">Submit</x-button>
        </div>
    </x-form>
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
</x-layout.admin>