<style>
    th {
        border-right: 1px solid #00000050;
        background: #2d3338 !important;
        font-size: .9em;
        padding: .5em 1em !important;
    }
    th:first-child {
        border-left: 1px solid #00000050;
    }
    td {
        padding: .3em 1em !important;
    }
</style>

<div class="border p-4 mt-4 rounded" style="background: linear-gradient(20deg, #ffffff60, #ffffff40, #ffffff90)">
    <table id="{{ $id }}" class="display compact cell-border {{ $class }}" style="font-size: .85em">
        <thead>
            <tr class="text-light" style="font-size: .9em">
                {{ $head }}
            </tr>
        </thead>
        <tbody>
            {{ $body }}
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#{{ $id }}').DataTable({
            paging: false,
            info: false,
            lengthChange: false,
            ordering: false
        });
        $('.dataTables_filter input').attr('placeholder', 'Search data here ..');
    });
</script>