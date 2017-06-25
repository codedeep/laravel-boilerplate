@extends('backend.body')

@section('header_title', trans('labels.backend.metas.titles.main'))
@section('header_description', trans('labels.backend.metas.titles.index'))

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-right">
                        <a href="{{ route('admin.meta.create') }}" class="btn btn-success btn-sm">@lang('buttons.metas.create')</a>
                    </div>
                    <h3 class="box-title">@lang('labels.backend.metas.titles.index')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover" id="dataTableBuilder" width="100%"></table>
                    {!! form_batch_action('admin.meta.batch-action', 'dataTableBuilder', [
                        'destroy' => trans('labels.backend.metas.actions.destroy'),
                    ]) !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@section('scripts')
    <script>
        $('#dataTableBuilder').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route('admin.meta.search') }}',
                type: 'post'
            },
            columns: [{
                defaultContent: '',
                title: '',
                data: 'checkbox',
                name: 'checkbox',
                orderable: false,
                searchable: false,
                width: 15,
                className: 'select-checkbox'
            }, {
                title: '{{ trans('validation.attributes.route') }}',
                data: 'route',
                name: 'route',
                defaultContent: '{{ trans('labels.no_value') }}',
                width: 75,
            }, {
                title: '{{ trans('validation.attributes.metable_type') }}',
                data: 'metable_type',
                name: 'metable_type',
                defaultContent: '{{ trans('labels.no_value') }}',
                width: 75,
            }, {
                title: '{{ trans('validation.attributes.title') }}',
                data: 'title',
                name: 'translations.title',
                defaultContent: '{{ trans('labels.no_value') }}',
                width: 150,
            }, {
                title: '{{ trans('validation.attributes.description') }}',
                data: 'description',
                name: 'translations.description',
                defaultContent: '{{ trans('labels.no_value') }}',
                orderable: false,
            }, {
                title: '{{ trans('labels.created_at') }}',
                data: 'created_at',
                name: 'created_at',
                width: 100,
                className: 'text-center'
            }, {
                title: '{{ trans('labels.updated_at') }}',
                data: 'updated_at',
                name: 'updated_at',
                width: 100,
                className: 'text-center'
            }, {
                title: '{{ trans('labels.actions') }}',
                data: 'actions',
                name: 'actions',
                orderable: false,
                width: 50,
            }],
            select: {style: 'os'},
            order: [[5, 'desc']],
            rowId: 'id'
        });
    </script>
@endsection