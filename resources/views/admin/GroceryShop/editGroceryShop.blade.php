@extends('admin.master', ['title' => __('Edit Shop')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Edit Grocery Shop') ,
        'headerData' => __('Grocery Shops') ,
        'url' => 'GroceryShop' ,
        'class' => 'col-lg-7'
    ])
    <div class="container-fluid mt--7">

            <div class="row">
                    <div class="col-xl-12 order-xl-1">
                        <div class="card form-card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{ __('Edit Grocery Shop') }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ url('GroceryShop') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" id="edit-groceyshop" action="{{url('GroceryShop/'.$data->id)}}" autocomplete="off" enctype="multipart/form-data" >
                                    @csrf
                                    @method('put')
                                    <h6 class="heading-small text-muted mb-4">{{ __('Edit Grocery Shop Detail') }}</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-name">{{ __('Shop Name') }}</label>
                                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Shop Name') }}" value="{{ $data->name }}" required autofocus>
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-address">{{ __('Shop Address') }}</label>
                                                    <input type="text" name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Shop Address') }}" value="{{$data->address }}" required >
                                                    @if ($errors->has('address'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                                        <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" required>{{ $data->description }}</textarea>
                                                        @if ($errors->has('description'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('description') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('latitude') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-latitude">{{ __('Latitude') }}</label>
                                                    <input type="text" name="latitude" id="input-latitude" class="form-control form-control-alternative{{ $errors->has('latitude') ? ' is-invalid' : '' }}" placeholder="{{ __('Latitude') }}" value="{{ $data->latitude }}" required >
                                                    @if ($errors->has('latitude'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('latitude') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('longitude') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-longitude">{{ __('Longitude') }}</label>
                                                    <input type="text" name="longitude" id="input-longitude" class="form-control form-control-alternative{{ $errors->has('longitude') ? ' is-invalid' : '' }}" placeholder="{{ __('Longitude') }}" value="{{ $data->longitude }}" required >
                                                    @if ($errors->has('longitude'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('longitude') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="input-location">{{ __('Location') }}</label>
                                                        <Select name="location" id="input-location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}"  required>
                                                            <option value="">{{__('Select Location')}}</option>
                                                            @foreach ($location as $item)
                                                                <option value="{{$item->id}}" {{ $data->location==$item->id ? 'Selected' : ''}}>{{$item->name}}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('location'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('location') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-phone">{{ __('Phone') }}</label>
                                                    <input type="text" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone') }}" value="{{ $data->phone }}" required >
                                                    @if ($errors->has('phone'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <input type='hidden' id="shop_category" name="shop_category" value="{{$data->category_id}}">
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-category_id">{{ __('Category') }}</label>
                                                    <Select name="category_id[]" id="input-category_id" multiple="multiple" class="form-control select2 select2-multiple form-control-alternative{{ $errors->has('category_id') ? ' is-invalid' : '' }}"  required>
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
                                                <div class="form-group{{ $errors->has('radius') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-radius">{{ __('Shop Radius') }}</label>
                                                    <input type="number" name="radius" id="input-radius" min="0" class="form-control form-control-alternative{{ $errors->has('radius') ? ' is-invalid' : '' }}" placeholder="{{ __('Shop Radius') }}" value="{{ $data->radius }}" required>
                                                    @if ($errors->has('radius'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('radius') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                                    <Select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}"  required>
                                                        <option value="">{{__('Select Status')}}</option>
                                                        <option value="0" {{ $data->status=="0" ? 'Selected' : ''}}>Active</option>
                                                        <option value="1" {{ $data->status=="1" ? 'Selected' : ''}}>Deactive</option>
                                                    </select>

                                                    @if ($errors->has('status'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('status') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('open_time') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-open_time">{{ __('Open Time') }}</label>
                                                    <input type="time" name="open_time" id="input-open_time" class="form-control form-control-alternative{{ $errors->has('open_time') ? ' is-invalid' : '' }}" placeholder="{{ __('Open Time') }}" value="{{ $data->open_time }}"  >
                                                    @if ($errors->has('open_time'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('open_time') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group{{ $errors->has('close_time') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-close_time">{{ __('Close Time') }}</label>
                                                    <input type="time" name="close_time" id="input-close_time" class="form-control form-control-alternative{{ $errors->has('close_time') ? ' is-invalid' : '' }}" placeholder="{{ __('Close Time') }}" value="{{ $data->close_time }}" >
                                                    @if ($errors->has('close_time'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('close_time') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-image">{{ __('Shop Logo') }}</label>
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
                                            <div class="col-10">
                                                <div class="form-group{{ $errors->has('cover_image') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-cover_image">{{ __('Cover Image') }}</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input read-cover-image" name="cover_image" id="cover_image">
                                                        <label class="custom-file-label" for="cover_image">{{__('Select file')}}</label>
                                                    </div>
                                                    @if ($errors->has('cover_image'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('cover_image') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <img class=" avatar-lg round-5 view-cover-image" style="width: 100%;height: 90px;" src="{{url('images/upload/'.$data->cover_image)}}">
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

@endsection
