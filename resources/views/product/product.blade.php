@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-12">
  <a href="{{ route('manage-product.new')}}">
  <button type="submit" method="get" class="btn btn-fill btn-primary">{{ __('Add new Product') }}</button>
      </a>  
  <div class="card ">
        
      <div class="card-header">
      <br>
          <h2 class="card-title color-primary">All Available Products </h2>
          <br>
      </div>
      <div class="card-body">
        <div class="table-responsive" style="width: 1000px; height: auto; overflow: scroll;">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>
                  ID
                </th>
                <th>
                  Name In English
                </th>
                <th>
                  Name In Hindi
                </th>
                <th>
                  Category
                </th>
                <th>
                  Qty
                </th>
                <th>
                  Brand
                </th>
                <th>
                  MRP
                </th>
                <th>
                  Price
                </th>
                <th>
                  Popularity
                </th>
                <th >
                  Detail
                </th>
                <th>
                    Icon
                  </th>
                  <th>
                      Action
                    </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categoryData as $data)
                <tr>
                    <td>
                        {{ $data->product_id }}
                      </td>
                    <td>
                      {{ $data->name_in_eng }}
                    </td>
                    <td>
                      {{$data->name_in_hin}}
                    </td>
                    <td>
                      {{$data->category_id}}
                    </td>
                    <td>
                      {{$data->quantity}}
                    </td>
                    <td>
                      {{$data->brand}}
                    </td>
                    <td>
                      {{$data->mrp}}
                    </td>
                    <td>
                      {{$data->price}}
                    </td>
                    <td>
                      {{$data->popularity}}
                    </td>
                    <td>
                      {{$data->description}}
                    </td>
                    <td class="text-center">
                        <img src="{{ $data->image_url }}" alt="Icon {{$data->name_in_eng}}" style="width:100px; height:auto;">
                    </td>
                    <td>
                        <a method="get" href="{{ route('manage-product.edit',$data->product_id) }}"><i class="tim-icons icon-pencil"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('manage-product.delete',$data->product_id)}}"><i class="tim-icons icon-trash-simple"></i></a>
                        
                    </td>
                    
                    
                  </tr>
                  @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div>
        
  </div>
</div>
@endsection
