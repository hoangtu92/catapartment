<table style="width: 100%; text-align: left">
    <tbody>
    <tr>
        <th>{{ trans("frontend.customer_name") }}</th>
        <td>{{ $contact_info->customer_name }}</td>
    </tr>
    <tr>
        <th>{{ trans("frontend.customer_email") }}</th>
        <td>{{ $contact_info->customer_email }}</td>
    </tr>
    <tr>
        <th>{{ trans("frontend.customer_phone") }}</th>
        <td>{{ $contact_info->customer_phone }}</td>
    </tr>
    <tr>
        <th>{{ trans("frontend.free_time") }}</th>
        <td>{{ $contact_info->customer_free_time }}</td>
    </tr>
    <tr>
        <th>{{ trans("frontend.customer_message") }}</th>
        <td>{{ $contact_info->customer_message }}</td>
    </tr>
    </tbody>
</table>
