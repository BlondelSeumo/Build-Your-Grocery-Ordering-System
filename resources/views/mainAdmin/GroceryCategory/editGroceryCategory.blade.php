@extends('admin.master', ['title' => __('Edit Category')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Edit Grocery Category') ,
        'headerData' => __('Grocery Category') ,
        'url' => 'GroceryCategory' ,
        'class' => 'col-lg-7'
    ])
    <div class="container-fluid mt--7">

            <div class="row">
                    <div class="col-xl-12 order-xl-1">
                        <div class="card form-card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{ __('Edit Grocery Category') }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ url('GroceryCategory') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{url('GroceryCategory/'.$data->id)}}" autocomplete="off" enctype="multipart/form-data" >
                                    @csrf
                                    @method('put')
                                    <h6 class="heading-small text-muted mb-4">{{ __('Grocery Category Detail') }}</h6>
                                    <div class="pl-lg-4">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ $data->name }}" required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label " for="input-image">{{ __('Image') }}</label>
                                                    <div class="custom-file">
                                                        <input type="file"  accept=".png, .jpg, .jpeg, .svg" class="custom-file-input read-image" name="image" id="image">
                                                        <label class="custom-file-label" for="image">Select file</label>
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
                                        
                                        <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                            <Select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}"  required>
                                                <option value="">Select Status</option>
                                                <option value="0" {{ $data->status=="0" ? 'Selected' : ''}}>Avaliable</option>
                                                <option value="1" {{ $data->status=="1" ? 'Selected' : ''}}>Not Avaliable</option>
                                            </select>

                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
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
