@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Product') }}</h5>
                </div>
            <form method="post" action=" {{route('manage-product.update',$product->product_id)}}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                          

                            @include('alerts.success')

                            <div class="form-group">
                                <label>{{ __('Product ID') }}</label>
                            <input type="text" name="product_id" class="form-control" placeholder="{{ __('id') }}" value="{{ $product->product_id}}" readonly>
                               
                            </div>

                            <div class="form-group">
                                <label>{{ __('Name in English') }}</label>
                                <input type="text" name="name_in_eng" class="form-control" placeholder="{{ __('name in english') }}" value="{{ $product->name_in_eng}}">
                                
                            </div>
                            <div class="form-group">
                                    <label>{{ __('Name in Hindi') }}</label>
                                    <input type="text" name="name_in_hin" class="form-control"placeholder="{{ __('name in hindi') }}"value="{{ $product->name_in_hin}}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Description') }}</label>
                                <textarea  name="description" class="form-control" rows="6" cols="50">
                                    {{ $product->description}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Which Category product belongs to?') }}</label>
                                <select name="category_id" class="form-control">
                                        @foreach ($categoryData as $data)
                                        <option style="color:black" class="form-control" {{ $data->cate_id == $product->category_id ? 'Selected' : '' }} value="{{$data->cate_id}}">{{$data->name_in_eng}}</option>
                                        
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Quantity') }}</label>
                                <input type="text" name="quantity" class="form-control"placeholder="{{ __('quantity') }}"value="{{ $product->quantity}}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Brand') }}</label>
                                <input type="text" name="brand" class="form-control"placeholder="{{ __('brand') }}"value="{{ $product->brand}}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('MRP') }}</label>
                                <input type="text" name="mrp" class="form-control"placeholder="{{ __('mrp') }}"value="{{ $product->mrp}}">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Price') }}</label>
                                <input type="text" name="price" class="form-control"placeholder="{{ __('price') }}"value=" {{ $product->price}}">
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
                <form method="post" action="{{route('manage-product.updateImage')}}" autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                            @csrf
                            

                            @include('alerts.success')
                                    <div class="form-group">
                                            <label>{{ __('Category ID') }}</label>
                                            <input type="text" name="product_id" class="form-control" placeholder="{{ __('id') }}" value="{{ $product->product_id}}" readonly>
                                           
                                        </div>
                           
                            
                            <div class="form-group">
                                <img id="preview"  src="" alt="No Preview" style="width:100px; height:auto;">
                            </div>
                                <div class="form-group">
                                        <label for="imageInput"><h4>Select Image</h4></label>
                                        <input id="inputImg" type="file" data-preview="#preview" name="image_url" class="form-control" placeholder="{{ __('select image') }}">
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