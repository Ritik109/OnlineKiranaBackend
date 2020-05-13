@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Add New Category') }}</h5>
                </div>
            <form method="post" action=" {{route('manage-category.new')}}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                          

                            @include('alerts.success')

                            <div class="form-group">
                                <label>{{ __('Category ID') }}</label>
                                <input type="text" name="cate_id" class="form-control" placeholder="{{ __('id') }}" value="" readonly>
                               
                            </div>

                            <div class="form-group">
                                <label>{{ __('Name in English') }}</label>
                                <input type="text" name="name_in_eng" class="form-control" placeholder="{{ __('name in english') }}" value="">
                                
                            </div>
                            <div class="form-group">
                                    <label>{{ __('Name in Hindi') }}</label>
                                    <input type="text" name="name_in_hin" class="form-control"placeholder="{{ __('name in hindi') }}"value="">
                                    
                                </div>
                                <div class="form-group">
                                        <label>{{ __('Details') }}</label>
                                        <input type="test" name="details" class="form-control" placeholder="{{ __('details') }}" value="">
                                        
                                    </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>

           
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Category Image') }}</h5>
                </div>
                <form method="post" action="{{route('manage-category.updateImage')}}" autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                            @csrf
                            

                            @include('alerts.success')
                                    <div class="form-group">
                                            <label>{{ __('Category ID') }}</label>
                                            <input type="text" name="cate_id" class="form-control" placeholder="{{ __('id') }}">
                                           
                                        </div>
                           
                            
                            <div class="form-group">
                                <img id="preview"  src="" alt="No Preview" style="width:100px; height:auto;">
                            </div>
                                <div class="form-group">
                                        <label for="imageInput"><h4>Select Image</h4></label>
                                        <input id="inputImg" type="file" data-preview="#preview" name="cate_icon_url" class="form-control" placeholder="{{ __('select image') }}">
                                </div>
                                
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Upload') }}</button>
                    </div>
                </form>
                <script type="text/javascript">

                    function readURL(input) {
                
                        if (input.files && input.files[0]) {
                
                            var reader = new FileReader();
                
                            
                
                            reader.onload = function (e) {
                
                                $('#preview').attr('src', e.target.result);
                
                            }
                
                            reader.readAsDataURL(input.files[0]);
                
                        }
                
                    }
                
                    $("#inputImg").change(function(){
                
                        readURL(this);
                
                    });
                
                </script>
            </div>

           
        </div>
        
    </div>
@endsection