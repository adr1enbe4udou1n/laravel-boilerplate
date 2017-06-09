@extends('backend.body')

@section('header_title', trans('labels.backend.form_submissions.titles.main'))
@section('header_description', trans('labels.backend.form_submissions.titles.show'))

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('labels.backend.form_submissions.titles.show')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
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
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
@endsection
