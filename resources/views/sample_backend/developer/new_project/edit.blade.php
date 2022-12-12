@extends('backend.developer.layouts.app')
@section('title', 'Edit new_project Management')
@section('new_project-active', 'mm-active')
@section('extra-css')
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="{{ asset('/backend/css/image-uploader.css') }}">
@endsection
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Update New Project
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary back-btn"><i class="fas fa-chevron-circle-left"></i> Back</button>
        </div>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    @include('backend.developer.layouts.flash')
                    <form action="{{ route('developer.new_project.update', $data->id) }}" id="update" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        {{-- address --}}
                        <div class="form-group">
                            <h5>Address</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="region">Region</label>
                                    @php
                                        $region = $data->region()->first('name');
                                    @endphp
                                    <span class="region_old badge badge-secondary">{{ $region['name'] }}</span>
                                    <select name="region" class="region form-control">
                                        <option value="">Select Region</option>
                                        @foreach ($regions as $key => $region)
                                            <option value="{{ $region->id }}" @if (old('region') == $region->id) selected="selected" @endif>
                                                {{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="township">Township</label>
                                    @php
                                        $township = $data->township()->first('name');
                                    @endphp
                                    <span class="township_old badge badge-secondary">{{ $township['name'] }}</span>
                                    <select name="township" class="township form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="wards">Wards</label>
                                    <input value="{{ $data->wards}}" type="text" name="wards" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="townsandvillages">Towns & Villages</label>
                                    <input value="{{ $data->townsandvillages}}" type="text" name="townsandvillages" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="street_name">Street Name</label>
                                    <input value="{{ $data->street_name}}" type="text" name="street_name" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="type_of_street">Type of Street</label>
                                    <select name="type_of_street" class="form-control">
                                        @foreach (config('const.type_of_street') as $key => $street)
                                            <option value="{{ $key }}" @if ($data->type_of_street == $key) selected @endif>
                                                {{ $street }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Price --}}
                        <div class="form-group">
                            <h5>Price</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="area_unit">Area Type</label>
                                    <select name="area_unit" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.area') as $key => $area)
                                            <option value="{{ $key }}" @if ($data->area_unit == $key) selected @endif>{{ $area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="min_price">Minimun Price</label>
                                    <input value="{{ $data->min_price}}" type="number" name="min_price" class="form-control">
                                </div>

                                <div class="col form-group">
                                    <label for="max_price">Maximum Price</label>
                                    <input value="{{ $data->max_price}}" type="number" name="max_price" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="currency_code">Currency Code</label>
                                    <select name="currency_code" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.currency_code') as $key => $currency)
                                            <option value="{{ $key }}" @if ($data->currency_code == $key) selected @endif>{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Payment --}}
                        <div class="form-group">
                            <h5>Payment</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="area">Purchase Type</label>
                                    <select name="purchase_type" class="form-control">
                                        <option value="">Select</option>
                                            @foreach (config('const.purchase_type') as $key => $purchase_type)
                                                <option value="{{ $key }}" @if ($data->purchase_type == $key) selected @endif>
                                                    {{ $purchase_type }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col form-group price_sale_hider">
                                    <label for="installment">Installment</label>
                                    <fieldset class="position-relative form-group">
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="installment" type="radio" value="1"
                                                    @if ($data->installment == 1) checked @endif class="form-check-input"> Yes
                                            </label>
                                        </div>
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="installment" type="radio" value="0"
                                                    @if ($data->installment == 0) checked @endif class="form-check-input"> No
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        {{-- Situation --}}
                        <div class="form-group">
                            <h5>Situation</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="new_project_sale_type">Sale Type</label>
                                    <select name="new_project_sale_type" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.developer_sale_type') as $key => $sale_type)
                                            <option value="{{ $key }}" @if ($data->new_project_sale_type == $key) selected @endif>{{ $sale_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="preparation">Preparation</label>
                                    <select name="preparation" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.preparation') as $key => $prepare)
                                            <option value="{{ $key }}" @if ($data->preparation == $key) selected @endif>{{ $prepare }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="project_start_at">EST Project Start Year </label>
                                    <select name="project_start_at" class="project_start_at form-control">
                                        <option value="">Select</option>
                                        @for ($i = (int) date('Y'); $i <= (int) date('Y') + 10; $i++)
                                            <option value='{{ $i }}' @if (\Carbon\Carbon::parse($data->project_start_at)->format('Y') == $i) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="project_end_at">EST Project End Year </label>
                                    @php
                                        $request_end_at = \Carbon\Carbon::parse($data->project_end_at)->format('Y');
                                    @endphp
                                    <select name="project_end_at" class="project_end_at form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Detail --}}
                        <div class="form-group">
                            <h5>About Project Description</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <textarea name="about_project" class="form-control">{{ $data->about_project }}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Facilities --}}
                        <div class="form-group">
                            <h5>Facilities</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="elevator" value="1" class="form-check-input"
                                                @if ($data->elevator == 1) checked @endif>Elevator</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="garage" value="1" class="form-check-input"
                                                @if ($data->garage == 1) checked @endif>Garage</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="fitness_center" value="1" class="form-check-input"
                                                @if ($data->fitness_center == 1) checked @endif>Fitness Center</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="security" value="1" class="form-check-input"
                                                @if ($data->security == 1) checked @endif>security</label></div>
                                </div>
                                <div class="col form-group">
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="swimming_pool" value="1" class="form-check-input"
                                                @if ($data->swimming_pool == 1) checked @endif>Swimming Pool</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="spa_hot_tub" value="1" class="form-check-input"
                                                @if ($data->spa_hot_tub == 1) checked @endif>Spa/
                                            Hot Tub</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="playground" value="1" class="form-check-input"
                                                @if ($data->playground == 1) checked @endif>Playground</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="garden" value="1" class="form-check-input"
                                                @if ($data->garden == 1) checked @endif>Garden</label></div>
                                </div>
                                <div class="col form-group">
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="carpark" value="1" class="form-check-input"
                                                @if ($data->carpark == 1) checked @endif>Carpark</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="own_transformer" value="1" class="form-check-input"
                                                @if ($data->own_transformer == 1) checked @endif>Own Transformer</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="disposal" value="1" class="form-check-input"
                                                @if ($data->disposal == 1) checked @endif>Disposal</label></div>

                                </div>
                            </div>
                        </div>
                        {{-- Image --}}
                        <div class="form-group">
                            <h5>Images</h5>
                            <hr>
                            <div class="input-field">
                                <label class="active">Photos</label>
                                <div class="input-images-2" style="padding-top: .5rem;"></div>
                            </div>
                        </div>
                        {{-- Terms & Condition --}}
                        <div class="row">
                            <div class="col-6 col-md-5 form-group">
                                <input name="agreecheck" type="checkbox" id="agreecheck">
                                <label for="agreecheck">By posting this content, I agree to be contacted by affiliates</label>
                            </div>
                        </div>
                        {{-- Submit Button --}}
                        <div class="row">
                            <div class="col form-group">
                                <button class="btn btn-secondary back-btn">Back</button>
                                <button type="submit" class="btn btn-primary" id="agreebtn">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateNewProjectRequest', '#update') !!}
    @include('backend.developer.property.script')
    <script>
        $(document).ready(function() {

            /* Edit Project Start and End */
            $('.project_end_at').html('<option value="">Select</option>');
            $('.project_end_at').html('');
                $('.project_end_at').html('<option value="">Select</option>');
                var start_at = document.querySelector('.project_start_at').value;
                var date = new Date(start_at);
                var year = date.getFullYear();
                var request_end_at = "@php echo $request_end_at @endphp";

                console.log(request_end_at);
                for (let index = (year + 1) ; index < (year+16); index++) {
                    if (index == request_end_at) {
                        $(".project_end_at").append('<option value="' + index + '" selected>' +
                        index + '</option>');    
                    }else{
                        $(".project_end_at").append('<option value="' + index + '">' +
                        index + '</option>');
                    }
                    
                    
                }
            /* Change Process */
            $('.project_start_at').change(function(){
                $('.project_end_at').html('');
                $('.project_end_at').html('<option value="">Select</option>');
                var start_at = this.value;
                var date = new Date(start_at);
                var year = date.getFullYear();
                console.log(year + 50);
                for (let index = (year + 1) ; index < (year+16); index++) {
                    $(".project_end_at").append('<option value="' + index + '">' +
                        index + '</option>');
                    
                }
            });
        });
    </script>
@endsection
