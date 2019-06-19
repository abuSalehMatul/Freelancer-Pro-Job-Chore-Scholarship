@extends('admin.layout.master')
@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">{{$page_title}}
                    <a href="{{route('admin.blog')}}" class="btn btn-success btn-md pull-right ">
                    <i class="fa fa-eye"></i> All Blog
                    </a>
                </h3>
                <div class="tile-body">
                    <form role="form" method="POST" action="" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-12">
                                <h6> Title</h6>
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg"
                                           name="title">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-font"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('title'))
                                    <div class="error">{{ $errors->first('title') }}</div>
                                @endif

                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <h6>Category</h6>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($category as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cat_id'))
                                    <div class="error">{{ $errors->first('cat_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                <h6>Image</h6>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                            <img style="width: 200px" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Fetured Image" alt="...">

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*" >
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <h6>Details</h6>
                                <textarea name="details" id="area1" cols="30" rows="12" class="form-control"></textarea>
                            </div>

                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <h6>Status</h6>
                                <input data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" type="checkbox" name="status">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <hr/>
                            <div class="col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save Blog</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('import-script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@stop
@section('script')
    <script src="{{ asset('assets/admin/js/nicEdit-latest.js') }}"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>
@stop