@extends('admin.master', ['title' => __('Add Item')])

@section('content')
    @include('admin.layout.topHeader', [
        'title' => __('Add Grocery Gallery') ,
        'headerData' => __('Grocery Item') ,
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
                                <h3 class="mb-0">{{ __('Add New Item') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url('GroceryItem') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{url('/GroceryItem/gallery/'.$data->id.'/store')}}" class="grocery-item"  autocomplete="off" enctype="multipart/form-data" >
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Item Gallery') }}</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('gallery') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-gallery">{{ __('Image Gallery') }}</label>
                                            <div class="custom-file">
                                                <input type="file"  accept=".png, .jpg, .jpeg, .svg" class="custom-file-input" name="gallery_img[]" id="gallery" multiple required>
                                                <label class="custom-file-label" for="gallery">{{__('Select file')}}</label>
                                            </div>
                                            @if ($errors->has('gallery'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('gallery') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                        </div>
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
