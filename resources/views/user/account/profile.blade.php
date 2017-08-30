<table class="table table-striped table-hover">
    <tr>
        <th>@lang('labels.user.avatar')</th>
        <td><img src="{{ $loggedInUser->avatar }}"
                 class="user-profile-image" alt="@lang('labels.user.avatar')"></td>
    </tr>
    <tr>
        <th>@lang('validation.attributes.name')</th>
        <td>{{ $loggedInUser->name }}</td>
    </tr>
    <tr>
        <th>@lang('validation.attributes.email')</th>
        <td>{{ $loggedInUser->email }}</td>
    </tr>
    <tr>
        <th>@lang('validation.attributes.locale')</th>
        <td>{{ $loggedInUser->locale }}</td>
    </tr>
    <tr>
        <th>@lang('validation.attributes.timezone')</th>
        <td>{{ $loggedInUser->timezone }}</td>
    </tr>
    <tr>
        <th>@lang('labels.created_at')</th>
        <td>{{ $loggedInUser->created_at->setTimezone($loggedInUser->timezone) }}
            ({{ $loggedInUser->created_at->diffForHumans() }})
        </td>
    </tr>
    <tr>
        <th>@lang('labels.updated_at')</th>
        <td>{{ $loggedInUser->updated_at->setTimezone($loggedInUser->timezone) }}
            ({{ $loggedInUser->updated_at->diffForHumans() }})
        </td>
    </tr>
</table>