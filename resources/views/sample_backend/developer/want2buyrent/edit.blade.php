@extends('backend.developer.layouts.app')
@section('title', 'Edit want2buyrent Management')
@section('want2buyrent-active', 'mm-active')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Update Want2BuyRent
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
                    <form action="{{ route('developer.want2buyrent.update',$data->id) }}" id="update"
                        method="POST">
                        @method('PUT')
                        @csrf
                        {{-- Property Type --}}
                        <div class="form-group">
                            <h5>Info</h5>
                            <hr>
                            <div class="row">
                                <div class="col-6 col-md-6 form-group">
                                    <label for="properties_type">Property Type</label>
                                    <select name="properties_type" class="property_type form-control" disabled>
                                        <option value="">Select Type</option>
                                        @foreach (config('const.property_type') as $key => $property_type)
                                            <option value="{{ $key }}" @if ($data->properties_type == $key) selected @endif>
                                                {{ $property_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-6 form-group">
                                    <label for="properties_category">Property Category</label>
                                    <select name="properties_category" class="property_category form-control" disabled>
                                        <option value="">Select Category</option>
                                        @foreach (config('const.property_category') as $key => $category)
                                            <option value="{{ $key }}" @if ($data->properties_category == $key) selected @endif>{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 form-group">
                                    <label for="title">Title</label>
                                    <input type="text" value="{{ $data->title }}" name="title" class="form-control">
                                </div>
                                <div class="col-6 col-md-6 form-group">
                                    <label for="phone_no">Phone No</label>
                                    <input type="number" value="{{ $data->phone_no }}" name="phone_no" class="form-control">
                                </div>
                            </div>
                        </div>
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
                        </div>
                        {{-- Area Size & condition --}}
                        <div class="form-group">
                            <h5>Area Size And Condition</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="front_area">Measurement</label>
                                    <select name="area_unit" class="form-control">
                                        @foreach (config('const.area') as $key => $area)
                                            <option value="{{ $key }}"  @if ($data->area_unit == $key) selected @endif>{{ $area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="area_width">Width</label>
                                            <input type="text" value="{{ $data->area_width }}" name="area_width" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="area_length">Length</label>
                                            <input type="text" value="{{ $data->area_length }}" name="area_length" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($data->properties_category == 3)
                                <div class="col-md-4 hider">
                                    <div class="form-group">
                                        <label for="fence_width">Floor Level</label>
                                        <select name="floor_level" class="form-control">
                                            <option value="">Please Select</option>
                                            @foreach (config('const.floor_level') as $key => $level)
                                                <option value="{{ $key }}" @if ($data->floor_level == $key) selected @endif>{{ $level }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 hider">
                                    <div class="form-group">
                                        <label for="furnished_status">Furnished Status</label>
                                        <select name="furnished_status" class="form-control">
                                            <option value="">Please Select</option>
                                            @foreach (config('const.furnished_status') as $key => $f_status)
                                                <option value="{{ $key }}" @if ($data->furnished_status == $key) selected @endif>{{ $f_status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Completion</label>
                                        <fieldset class="position-relative mt-2 form-group">
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input name="completion" type="radio" value="1"
                                                    @if ($data->completion == 1) checked @endif class="form-check-input">
                                                    Complete
                                                </label>
                                                <label class="ml-4 form-check-label">
                                                    <input name="completion" type="radio" value="2"
                                                    @if ($data->completion == 2) checked @endif class="form-check-input">
                                                    New Launch
                                                </label>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- Budget Price --}}
                        <div class="form-group">
                            <h5>Budget Price</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="budget_from">Budget From</label>
                                    <input type="number" value="{{ $data->budget_from}}" name="budget_from" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="budget_to">Budget To</label>
                                    <input type="number" value="{{ $data->budget_to}}" name="budget_to" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="currency_code">Currency Code</label>
                                    <select name="currency_code" class="form-control">
                                        @foreach (config('const.currency_code') as $key => $currency)
                                            <option value="{{ $key }}" @if ($data->currency_code == $key) selected @endif>{{ $currency }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Detail --}}
                        <div class="form-group">
                            <h5>Detail Description</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <textarea name="descriptions" class="form-control">{{$data->descriptions}}</textarea>
                                </div>
                            </div>
                        </div>
                        {{-- Broker --}}
                        <div class="form-group">
                            <h5>Broker</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <fieldset class="position-relative">
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input @if ($data->co_broke == 1) checked @endif name="co_broke" type="radio" value="1" class="form-check-input"> Yes
                                            </label>
                                            <label class="ml-4 form-check-label">
                                                <input @if ($data->co_broke == 0) checked @endif name="co_broke" type="radio" value="0" class="form-check-input"> No
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        {{-- Terms And Condition --}}
                        <div class="form-group">
                            <h5>Terms And Condition</h5>
                            <hr>
                            {{-- Terms & Condition --}}
                            <div class="row">
                                <div class="col-6 col-md-5 form-group">
                                    <input name="terms_condition" type="checkbox" id="agreecheck">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateWant2BuyRentRequest', '#update') !!}
    @include('backend.developer.property.script')
    <script>
        $(document).ready(function() {
            $('.hider').hide();
            $('.property_category').on('change', function() {
                var category = this.value;

                if (category == 3) {
                    $('.hider').show();
                } else {
                    $('.hider').hide();
                }
            });
        })
    </script>
@endsection
