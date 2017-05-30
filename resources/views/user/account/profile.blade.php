<table class="table table-striped table-hover">
    <tr>
        <th>@lang('labels.user.attributes.name')</th>
        <td>{{ $logged_in_user->name }}</td>
    </tr>
    <tr>
        <th>@lang('labels.user.attributes.email')</th>
        <td>{{ $logged_in_user->email }}</td>
    </tr>
    <tr>
        <th>@lang('labels.user.attributes.created_at')</th>
        <td>{{ $logged_in_user->created_at }} ({{ $logged_in_user->created_at->diffForHumans() }})</td>
    </tr>
    <tr>
        <th>@lang('labels.user.attributes.updated_at')</th>
        <td>{{ $logged_in_user->updated_at }} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
    </tr>
</table>