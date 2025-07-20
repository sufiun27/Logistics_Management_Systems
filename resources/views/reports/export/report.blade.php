@php
    function formatDate($date) {
        try {
            return $date ? \Carbon\Carbon::parse($date)->format('Y-m-d') : '-';
        } catch (\Exception $e) {
            return '-';
        }
    }
@endphp
<table class="table table-bordered table-hover text-nowrap">
    <thead class="table-dark">
        <tr>
            @foreach($table as $section => $fields)
                @foreach($fields as $field)
                    <th>{{ $section }}</th>
                @endforeach
            @endforeach
        </tr>
        <tr>
            @foreach($table as $section => $fields)
                @foreach($fields as $field)
                    <th>{{ $field['title'] }}</th>
                @endforeach
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                @foreach($table as $section => $fields)
                    @foreach($fields as $field)
                        @php
                            $value = $row[$section][$field['column']] ?? '-';
                            // Optional: format dates
                            if (str_contains($field['column'], 'date')) {
                                $value = formatDate($value);
                            }
                        @endphp
                        <td>{{ $value }}</td>
                    @endforeach
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
