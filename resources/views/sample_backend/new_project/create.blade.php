@extends('backend.layouts.app')
@section('title', 'New Project Management')
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
                    <div>Create New Project
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
                    @include('backend.layouts.flash')
                    <form action="{{ route('admin.new_project.store') }}" method="POST" id="create"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- address --}}
                        <div class="form-group">
                            <h5>Address</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="region">Region</label>
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
                                    <select name="township" class="township form-control">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="wards">Wards</label>
                                    <input type="text" name="wards" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="townsandvillages">Towns & Villages</label>
                                    <input type="text" name="townsandvillages" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="street_name">Street Name</label>
                                    <input type="text" name="street_name" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="type_of_street">Type of Street</label>
                                    <select name="type_of_street" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.type_of_street') as $key => $street)
                                            <option value="{{ $key }}">{{ $street }}</option>
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
                                            <option value="{{ $key }}">{{ $area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="min_price">Minimun Price</label>
                                    <input type="number" name="min_price" class="form-control">
                                </div>

                                <div class="col form-group">
                                    <label for="max_price">Maximum Price</label>
                                    <input type="number" name="max_price" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <label for="currency_code">Currency Code</label>
                                    <select name="currency_code" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.currency_code') as $key => $currency)
                                            <option value="{{ $key }}">{{ $currency }}</option>
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
                                            <option value="{{ $key }}">{{ $purchase_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group price_sale_hider">
                                    <label for="installment">Installment</label>
                                    <fieldset class="position-relative form-group">
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="installment" id="installment" type="radio" value="1" class="form-check-input"> Yes
                                            </label>
                                        </div>
                                        <div class="position-relative form-check">
                                            <label class="form-check-label">
                                                <input name="installment" id="installment" type="radio" value="0" class="form-check-input"> No
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
                                            <option value="{{ $key }}">{{ $sale_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="preparation">Preparation</label>
                                    <select name="preparation" class="form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.preparation') as $key => $prepare)
                                            <option value="{{ $key }}">{{ $prepare }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="project_start_at">EST Project Start Year </label>
                                    <select name="project_start_at" class="project_start_at form-control">
                                        <option value="">Select</option>
                                        @for ($i = (int) date('Y'); $i <= (int) date('Y') + 10; $i++)
                                            <option value='{{ $i }}'>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="project_end_at">EST Project End Year </label>
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
                                    <textarea name="about_project" class="form-control"></textarea>
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
                                                type="checkbox" name="elevator" value="1"
                                                class="form-check-input">Elevator</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="garage" value="1"
                                                class="form-check-input">Garage</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="fitness_center" value="1"
                                                class="form-check-input">Fitness Center</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="security" value="1"
                                                class="form-check-input">security</label></div>
                                </div>
                                <div class="col form-group">
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="swimming_pool" value="1"
                                                class="form-check-input">Swimming Pool</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="spa_hot_tub" value="1" class="form-check-input">Spa/
                                            Hot Tub</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="playground" value="1"
                                                class="form-check-input">Playground</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="garden" value="1"
                                                class="form-check-input">Garden</label></div>
                                </div>
                                <div class="col form-group">
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="carpark " value="1"
                                                class="form-check-input">Carpark</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="own_transformer" value="1"
                                                class="form-check-input">Own Transformer</label></div>
                                    <div class="position-relative form-check"><label class="form-check-label"><input
                                                type="checkbox" name="disposal" value="1"
                                                class="form-check-input">Disposal</label></div>

                                </div>
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="form-group">
                            <h5>Images</h5>
                            <hr>
                            <div class="input-field">
                                <div class="input-images-1" style="padding-top: .5rem;"></div>
                            </div>
                        </div>
                        {{-- Button --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col form-group">
                                    <button class="btn btn-secondary back-btn">Back</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
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
    {!! JsValidator::formRequest('App\Http\Requests\CreateNewProjectRequest', '#create') !!}
    @include('backend.property.script')

    <script>
        $(document).ready(function() {
            $('.project_end_at').html('<option value="">Select</option>');
            
            $('.project_start_at').change(function(){
                $('.project_end_at').html('');
                $('.project_end_at').html('<option value="">Select</option>');
                var start_at = this.value;
                var date = new Date(start_at);
                var year = date.getFullYear();
                console.log(year + 50);
                for (let index = (year + 1) ; index < (year+16); index++) {
                    // const element = array[index];
                    console.log(index);
                    $(".project_end_at").append('<option value="' + index + '">' +
                        index + '</option>');
                    
                }
            });
        });
    </script>
@endsection
