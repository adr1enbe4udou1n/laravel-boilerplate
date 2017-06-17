<table class="table table-striped table-hover">
    <tr>
        <th>@lang('labels.user.avatar')</th>
        <td><img src="{{ $logged_in_user->avatar }}"
                 class="user-profile-image" alt="@lang('labels.user.avatar')"></td>
    </tr>
    <tr>
        <th>@lang('validation.attributes.name')</th>
        <td>{{ $logged_in_user->name }}</td>
    </tr>
    <tr>
        <th>@lang('validation.attributes.email')</th>
        <td>{{ $logged_in_user->email }}</td>
    </tr>
    <tr>
        <th>@lang('validation.attributes.locale')</th>
        <td>{{ $logged_in_user->locale }}</td>
    </tr>
    <tr>
        <th>@lang('validation.attributes.timezone')</th>
        <td>{{ $logged_in_user->timezone }}</td>
    </tr>
    <tr>
        <th>@lang('labels.created_at')</th>
        <td>{{ $logged_in_user->created_at->setTimezone($logged_in_user->timezone) }}
            ({{ $logged_in_user->created_at->diffForHumans() }})
        </td>
    </tr>
    <tr>
        <th>@lang('labels.updated_at')</th>
        <td>{{ $logged_in_user->updated_at->setTimezone($logged_in_user->timezone) }}
            ({{ $logged_in_user->updated_at->diffForHumans() }})
        </td>
    </tr>
</table>