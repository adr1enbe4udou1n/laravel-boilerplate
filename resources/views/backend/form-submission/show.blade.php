@extends('backend.body')

@section('title', trans('labels.backend.form_submissions.titles.main'))
@section('header_description', trans('labels.backend.form_submissions.titles.show'))

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('labels.backend.form_submissions.titles.show')</h4>
                </div>
                <div class="card-block">
                    <table class="table table-striped table-hover">
                        @foreach($form_submission->formatted_data as $name => $value)
                        <tr>
                            <th>{{ trans("validation.attributes.$name") }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th>{{ trans('labels.created_at') }}</th>
                            <td>{{ $form_submission->created_at }} ({{ $form_submission->created_at->diffForHumans() }})</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
