@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-12">
  <a href="{{ route('manage-category.new')}}">
  <button type="submit" method="get" class="btn btn-fill btn-primary">{{ __('Add new Category') }}</button>
      </a>  
  <div class="card ">
        
      <div class="card-header">
      <br>
          <h2 class="card-title color-primary">All Available Categories </h2>
          <br>
      </div>
      <div class="card-body">
        <div class="table-responsive">
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
                        {{ $data->cate_id }}
                      </td>
                    <td>
                      {{ $data->name_in_eng }}
                    </td>
                    <td>
                      {{$data->name_in_hin}}
                    </td>
                    <td>
                      {{$data->details}}
                    </td>
                    <td class="text-center">
                        <img src="{{ $data->cate_icon_url }}" alt="Icon {{$data->name_in_eng}}" style="width:100px; height:auto;">
                    </td>
                    <td>
                        <a method="get" href="{{route('manage-category.edit',$data->cate_id)}}"><i class="tim-icons icon-pencil"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{route('manage-category.delete',$data->cate_id)}}"><i class="tim-icons icon-trash-simple"></i></a>
                        
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
