
	<!-- Category Model Start-->
	<div id="category_model" class="header-cate-model main-gambo-model modal fade" tabindex="-1" role="dialog" aria-modal="false">
        <div class="modal-dialog category-area" role="document">
            <div class="category-area-inner">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
						<i class="uil uil-multiply"></i>
                    </button>
                </div>
                <div class="category-model-content modal-content"> 
					<div class="cate-header">
						<h4> {{__('Select Category')}} </h4>
					</div>
					@php
						$categories = \App\GroceryCategory::where('status',0)->get();
					@endphp
					
					@if (count($categories) >= 1)
						<ul class="category-by-cat">
							@foreach ($categories as $item)
								<li>
									<a href="{{url('category/'.$item->id.'/'.Str::slug($item->name))}}" class="single-cat-item">
										<div class="icon">
											<img src="{{ $item->imagePath . $item->image }}" alt="">
										</div>
										<div class="text"> {{$item->name}} </div>
									</a>
								</li>
							@endforeach
						</ul>
						<a href="{{url('/all-categories')}}" class="morecate-btn"><i class="uil uil-apps"></i> {{__('More Categories')}} </a>
					@else
						<div class="col-lg-12 col-md-12">
							<div class="how-order-steps">
								<div class="how-order-icon">
									<i class="uil uil-apps"></i>
								</div>
								<h4> {{__('No Category Available')}} </h4>
							</div>
						</div>
					@endif
                </div>
            </div>
        </div>
    </div>
	<!-- Category Model End-->