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
            Обзорное
            <small>окно</small>
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
                <h3 class="box-title">Редактирование записи</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                <?php //dd($item) ?>
                {!! Form::model($item, array('route' => array('slider/edit', $item->id), 'method' => 'post', 'role' => 'form', 'files' => 'true', 'class' => 'form')) !!}

                <div class="box-header with-border admin-tools">
                    <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-save"></i> Сохранить</button>
                    <a href="{!! \URL::route('slider/index') !!}" class="btn btn-warning btn-flat"><i class="fa fa-undo fa-fw"></i> Отменить</a>
                </div>


                <?php //echo Form::token(); ?>

                <div class="row">
                    <div class="col-xs-8">

                        <ul class="nav nav-tabs" id="localeTab" role="tablist">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a href="#{{ $localeCode }} " role="tab" data-toggle="tab">{{ $localeCode }}</a>
                            </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="tab-pane" id="{{ $localeCode }}">

                                <div class="form-group has-feedback">
                                    {!! Form::text('title_'.$localeCode, null, array('id'=>'title_'.$localeCode, 'class'=>'form-control', 'placeholder'=>'Название')) !!}
                                    <span class="glyphicon glyphicon-unchecked form-control-feedback"></span>
                                    @if ($errors->first('title_'.$localeCode))
                                    <div class="alert alert-danger" role="alert"><?php echo $errors->first('title_'.$localeCode); ?></div>
                                    @else
                                    @endif
                                </div>

                                <div class="form-group has-feedback">
                                    {!! Form::text('description_'.$localeCode, null, array('id'=>'description_'.$localeCode, 'class'=>'form-control', 'placeholder'=>'description_'.$localeCode)) !!}
                                    <span class="glyphicon glyphicon-unchecked form-control-feedback"></span>
                                    @if ($errors->first('description_'.$localeCode))
                                    <div class="alert alert-danger" role="alert"><?php echo $errors->first('description_'.$localeCode); ?></div>
                                    @else
                                    @endif
                                </div>

                            </div><!--tab 1 2 3 4 /// -->

                            <?php $description = 'description_'.$localeCode; ?>
                            <!-- CK Editor -->

                            <script type="text/javascript">
                                $( document ).ready(function() {
                                    var description = "<? echo $description ?>";
                                    var editor = CKEDITOR.replace(description);

                                    var fromBase = $("input#"+description).val();
                                    editor.setData(fromBase);

                                    timer = setInterval(updateDiv,100);
                                    function updateDiv(){
                                        var editorText = editor.getData();
                                        $( "input#"+description ).val(editorText);
                                    }
                                });
                            </script>
                            @endforeach
                        </div> <!--tab content -->



                        <div class="form-group">
                            {!! Form::label('Изображение') !!}
                            {!! Form::file('logo', array('class' => 'form-control')) !!}
                            @if ($errors->first('logo'))
                            <div class="alert alert-danger" role="alert"><?php echo $errors->first('logo'); ?></div>
                            @else
                            @endif
                        </div>

                    </div><!-- /.col -->



                    <div class="col-xs-4">
                        <div class="box">
                            <div class="box-header with-border">
                                <h5>Системные поля</h5>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">

                                <div class="form-group has-feedback block">
                                    {!! Form::label('Статус') !!}
                                    {!! Form::select('status', config('config.status'), null, array('class' => 'form-control')) !!}
                                    <span class="glyphicon glyphicon-off form-control-feedback"></span>
                                    @if ($errors->first('status'))
                                    <div class="alert alert-danger" role="alert"><?php echo $errors->first('status'); ?></div>
                                    @else
                                    @endif
                                </div>

                                <div class="form-group has-feedback">
                                    {!! Form::label('SEO теги') !!}
                                    {!! Form::textarea('keywords', null, array('class'=>'form-control', 'placeholder'=>'админ, пользователь, оператор, директор, менеджер')) !!}
                                    <span class="glyphicon glyphicon-tags form-control-feedback"></span>
                                    @if ($errors->first('keywords'))
                                    <div class="alert alert-danger" role="alert"><?php echo $errors->first('keywords'); ?></div>
                                    @else
                                    @endif
                                </div>

                            </div><!-- /.box-body -->
                            <div class="box-footer">

                            </div><!-- /.box-footer-->
                        </div><!-- /.box -->
                    </div><!-- /.col -->

                </div><!-- /.row -->


                <div class="form-group">
                    <div class="box-header with-border admin-tools">
                        <button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-save"></i> Сохранить</button>
                        <a href="{!! \URL::route('slider/index') !!}" class="btn btn-warning btn-flat"><i class="fa fa-undo fa-fw"></i> Отменить</a>
                    </div>
                </div>
                {!! \Form::close() !!}

            </div><!-- /.box-body -->
            <div class="box-footer">

            </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </section><!-- /.content -->
@stop












