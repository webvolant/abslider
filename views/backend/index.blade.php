@extends(config('config.template'))
<!--
@section('title', 'Page Title')

@section('sidebar')
@parent

<p>This is appended to the master sidebar.</p>
@stop
-->

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Слайдер
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Список записей</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>



            <div class="box-body">

                <div class="box-header with-border admin-tools">
                    <a href="{!! \URL::route('slider/add') !!}" class="btn btn-primary btn-flat"><i class="fa fa-user-plus fa-fw"></i> Добавить</a>
                </div>

                <table id="data_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <?php $title_lang = "title_$localeCode"; ?>
                    <th>{!! $title_lang !!}</th>
                    @endforeach
                    <th>Изображение</th>
                    <th>Статус</th>
                    <th>Управление</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $item)
                        <tr>
                            <td>{!! $item->id !!}</td>
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <?php $title_lang = "title_$localeCode" ?>
                            <td>{!! $item->$title_lang !!}</td>
                            @endforeach
                            <td class="logo">{!! Html::image($item->small_thumb) !!}</td>
                            <td>{!! \User::getStrStatus($item->status) !!}</td>
                            <td>
                                <a href='{{ URL::route("slider/edit", array($item->id)) }}' class="btn btn-primary btn-flat"><i class="fa fa-wrench fa-fw"></i></a>
                                <a href='{{ URL::route("slider/delete", array($item->id)) }}' class="btn btn-danger btn-flat"><i class="fa fa-trash-o fa-fw"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Имя</th>
                    <th>E-mail</th>
                    <th>Роль</th>
                    <th>Статус</th>
                    <th>Управление</th>
                </tr>
                </tfoot>
                </table>

            </div><!-- /.box-body -->
            <div class="box-footer">

            </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </section><!-- /.content -->
@stop