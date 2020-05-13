@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Add New Product') }}</h5>
                </div>
            <form method="post" action=" {{route('manage-product.new')}}" autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                            @csrf
                          

                            @include('alerts.success')

                            <div class="form-group">
                                <label>{{ __('Product ID') }}</label>
                                <input type="text" name="product_id" class="form-control" placeholder="{{ __('id') }}" value="" readonly>
                               
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
                                <label>{{ __('Description') }}</label>
                                <input type="text" name="description" class="form-control"placeholder="{{ __('description') }}"value="">
                            </div>
                            
                            <div class="form-group">
                            <label>{{ __('Which Category product belongs to?') }}</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categoryData as $data)
                                <option style="color:black" class="form-control" value="{{$data->cate_id}}">{{$data->name_in_eng}}</option>
                                
                                @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Quantity') }}</label>
                                <input type="text" name="quantity" class="form-control"placeholder="{{ __('quantity') }}"value="">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Brand') }}</label>
                                <input type="text" name="brand" class="form-control"placeholder="{{ __('brand') }}"value="">
                            </div>
                            <div class="form-group">
                                <label>{{ __('MRP') }}</label>
                                <input type="text" name="mrp" class="form-control"placeholder="{{ __('mrp') }}"value="">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Price') }}</label>
                                <input type="text" name="price" class="form-control"placeholder="{{ __('price') }}"value="">
                            </div>
                        <br>
                            <div class="form-group">
                                <img id="preview"  src="" alt="No Preview" style="width:100px; height:auto;">
                            </div>
                         <br>
                            <div class="form-group">
                                <label for="imageInput"><h4>Select Image</h4></label>
                                <input id="inputImg" type="file" data-preview="#preview" name="image_url" class="form-control">
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>

           
        </div>
        
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
@endsection