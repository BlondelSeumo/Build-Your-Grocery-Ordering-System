@extends('admin.master', ['title' => __('Edit Item')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Edit Grocery Item') ,
        'headerData' => __('Grocery Items') ,
        'url' => 'GroceryItem' ,
        'class' => 'col-lg-7'
    ]) 
    <div class="container-fluid mt--7">
           
            <div class="row">
                    <div class="col-xl-12 order-xl-1">
                        <div class="card form-card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{ __('Edit Item') }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ url('GroceryItem') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{url('GroceryItem/'.$data->id)}}" class="grocery-item" autocomplete="off" enctype="multipart/form-data" >
                                    @csrf
                                    @method('put')

                                    <h6 class="heading-small text-muted mb-4">{{ __('Item Detail') }}</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ $data->name }}" required autofocus>
                                                        @if ($errors->has('name'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('shop_id') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-shop_id">{{ __("Item's Shop") }}</label>
                                                    <select name="shop_id" id="input-shop_id" class="form-control form-control-alternative{{ $errors->has('shop_id') ? ' is-invalid' : '' }}"required>
                                                        <option value="">{{__('Select Shop')}}</option>
                                                        @foreach ($shop as $item)
                                                        <option value="{{$item->id}}"{{ $data->shop_id==$item->id ? 'Selected' : ''}}>{{$item->name}}</option>    
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('shop_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('shop_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <div class="col-6">
                                                <div class="form-group{{ $errors->has('fake_price') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-fake_price">{{ __('Price') }}</label>
                                                    <input type="number" min="0" name="fake_price" id="input-fake_price" class="form-control form-control-alternative{{ $errors->has('fake_price') ? ' is-invalid' : '' }}" placeholder="{{ __('Price') }}"  value="{{ $data->fake_price }}" required>
                                                    @if ($errors->has('fake_price'))
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('fake_price') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-6">
                                                <div class="form-group{{ $errors->has('sell_price') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="input-sell_price">{{ __('Sell Price') }}</label>
                                                        <input type="number" min="0" name="sell_price" id="input-sell_price" class="form-control form-control-alternative{{ $errors->has('sell_price') ? ' is-invalid' : '' }}" placeholder="{{ __('Sell Price') }}"  value="{{ $data->sell_price }}"required>
                                                        @if ($errors->has('sell_price'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('sell_price') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                            </div> --}}
                                            <div class="col-12">
                                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                                    <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('description') }}"required>{{$data->description}}</textarea>
                                                    @if ($errors->has('description'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group{{ $errors->has('detail_desc') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-detail_desc">{{ __('Detail') }}</label>
                                                    <textarea name="detail_desc" id="input-detail_desc" class="form-control form-control-alternative{{ $errors->has('detail_desc') ? ' is-invalid' : '' }}" required>{{$data->detail_desc}}</textarea>
                                                    @if ($errors->has('detail_desc'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('detail_desc') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-category_id">{{ __("Item's Category") }}</label>
                                                    <select name="category_id" id="input-category_id" class="form-control form-control-alternative{{ $errors->has('category_id') ? ' is-invalid' : '' }}"required>
                                                        <option value="">{{__('Select Category')}}</option>
                                                        @foreach ($category as $item)
                                                        <option value="{{$item->id}}" {{ $data->category_id==$item->id ? 'Selected' : ''}}>{{$item->name}}</option>    
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('category_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('category_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('subcategory_id') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-subcategory_id">{{ __("Sub Category") }}</label>
                                                    <select name="subcategory_id" id="input-subcategory_id" class="form-control form-control-alternative{{ $errors->has('subcategory_id') ? ' is-invalid' : '' }}"required>
                                                        <option value="">{{__('Select Sub Category')}}</option>
                                                        @foreach ($subcategory as $item)
                                                            <option value="{{$item->id}}" {{ $data->subcategory_id==$item->id ? 'Selected' : ''}}>{{$item->name}}</option>    
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('subcategory_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('subcategory_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-stock">{{ __('Stock') }}</label>
                                                    <input type="number" name="stock" id="input-stock" class="form-control form-control-alternative{{ $errors->has('stock') ? ' is-invalid' : '' }}" placeholder="{{ __('Stock') }}" value="{{ $data->stock }}" required >
                                                    @if ($errors->has('stock'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('stock') }}</strong>
                                                        </span>
                                                   @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('stock_unit') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-stock-unit">{{ __('Stock Unit') }}</label>
                                                    <select name="stock_unit" id="input-stock_unit" class="form-control form-control-alternative{{ $errors->has('stock_unit') ? ' is-invalid' : '' }}" required>
                                                        <option value=""> {{__('Select Item Unit')}} </option>
                                                        <option value="kg" {{$data->stock_unit == 'kg'?'selected':''}}> kg </option>
                                                        <option value="gm" {{$data->stock_unit == 'gm'?'selected':''}}> gm </option>
                                                        <option value="ltr" {{$data->stock_unit == 'ltr'?'selected':''}}> ltr </option>
                                                        <option value="ml" {{$data->stock_unit == 'ml'?'selected':''}}> ml </option>
                                                        <option value="unit" {{$data->stock_unit == 'unit'?'selected':''}}> unit </option>
                                                    </select>
                                                    @if ($errors->has('stock_unit'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong> {{ $errors->first('stock_unit') }} </strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                                            <label class="form-control-label" for="input-image">{{ __('Image') }}</label>
                                                            <div class="custom-file">
                                                                <input type="file"  accept=".png, .jpg, .jpeg, .svg" class="custom-file-input read-image" name="image" id="image">
                                                                <label class="custom-file-label" for="image">{{__('Select file')}}</label>
                                                            </div>
                                                            @if ($errors->has('image'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('image') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <img class=" avatar-lg round-5 view-image" style="width: 100%;height: 90px;" src="{{url('images/upload/'.$data->image)}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                                    <Select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}"  required>
                                                        <option value="">Select Status</option>
                                                        <option value="0" {{ $data->status=="0" ? 'Selected' : ''}}>Available</option>
                                                        <option value="1" {{ $data->status=="1" ? 'Selected' : ''}}>Not Available</option>
                                                    </select>
                
                                                    @if ($errors->has('status'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('top_featured') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-top_featured">{{ __('Top Featured') }}</label>
                                                    <Select name="top_featured" id="input-top_featured" class="form-control form-control-alternative{{ $errors->has('top_featured') ? ' is-invalid' : '' }}"  required>
                                                        <option value="0" {{ $data->top_featured=="0" ? 'Selected' : ''}}>False</option>
                                                        <option value="1" {{ $data->top_featured=="1" ? 'Selected' : ''}}>True</option>
                                                    </select>
        
                                                    @if ($errors->has('status'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row flex">
                                        <div class="col-6">
                                            <h6 class="heading-small text-muted mb-4">{{ __('Item Unit Detail') }}</h6>
                                        </div>
                                        <div class="col-6 text-right">
                                            <button type="button" class="btn btn-success btn-add"> + </button>
                                        </div>
                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="append">
                                            @foreach (json_decode($data->detail) as $key => $item)
                                                <div class="row {{$key != 0 ? 'mt-3':''}}">
                                                    <div class="col-2">
                                                        <label class="form-control-label"> {{__("Quantity")}} </label>
                                                        <input type="number" value="{{$item->qty}}" name="qty[]" class="form-control form-control-alternative" placeholder="Quantity" required>
                                                    </div>
                                                    <div class="col-2">
                                                        <label class="form-control-label"> {{__("Unit")}} </label>
                                                        <select name="unit[]" class="form-control form-control-alternative" required>
                                                            <option value=""> Select Item Unit </option>
                                                            <option value="kg" {{$item->unit == 'kg'?'selected':''}}> kg </option>
                                                            <option value="gm" {{$item->unit == 'gm'?'selected':''}}> gm </option>
                                                            <option value="ltr" {{$item->unit == 'ltr'?'selected':''}}> ltr </option>
                                                            <option value="ml" {{$item->unit == 'ml'?'selected':''}}> ml </option>
                                                            <option value="unit" {{$item->unit == 'unit'?'selected':''}}> unit </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-2">
                                                        <label class="form-control-label"> {{__("Discounted Price")}} </label>
                                                        <input value="{{$item->price}}" type="number" name="price[]" class="form-control form-control-alternative" placeholder="Price" required>
                                                    </div>
                                                    <div class="col-2">
                                                        <label class="form-control-label"> {{__('Original Price')}} </label>
                                                        <input value="{{$item->fake_price}}" type="number" name="fake_price[]" class="form-control form-control-alternative" placeholder="Fake Price" required>
                                                    </div>
                                                    <div class="col-2 mt-auto">
                                                        @if ($key != 0)
                                                            <button type="button" class="btn btn-danger btn-remove"> - </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-12">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
       
    </div>

@endsection