@extends('backend.developer.layouts.app')
@section('title', 'Property Management')
@section('property-active', 'mm-active')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Property Management
                </div>
            </div>
        </div>

    </div>
    <div class="mb-3 d-flex align-items-end flex-column">
        <div class="d-inline-block dropdown">
            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="btn-shadow dropdown-toggle btn btn-primary">
                <span class="btn-icon-wrapper pr-2 opacity-7">
                    <i class="fa fa-business-time fa-w-20"></i>
                </span>
                Create
                Property
            </button>
            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right"
                x-placement="bottom-end"
                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(112px, 33px, 0px);">
                <ul class="nav flex-column">
                    @foreach (config('const.property_category') as $key => $item)
                        <li class="nav-item">
                            <a href="{{ route('developer.property.create') }}?property_category={{ $key }}"
                                class="dropdown-item">
                                {{ $item }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="card mb-2">
        <div class="card-body">
            <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="pe-7s-filter"></i> Advance Filter</button>
        </div>
    </div>
    
    <div class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderd DataTables">
                    <thead>
                        <th class="no-sort">Img</th>
                        <th class="no-sort">Title</th>
                        <th class="no-sort">P-Code</th>
                        <th>Region</th>
                        <th>Township</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th class="no-sort">Recommend</th>
                        <th>Expired</th>
                        <th>Created</th>
                        <th class="no-sort">Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table = $('.DataTables').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [],
                ajax: {
                    url: "/developer/property/datatables/ssd",
                    type: 'GET',
                    data: function(d) {
                        d.status = $('#status').val();
                        d.type = $('#type').val();
                        d.title = $('#title').val();
                        d.region = $('#region').val();
                        d.township = $('#township').val();
                        d.category = $('#category').val();
                        d.p_code = $('#p_code').val();
                        d.min_price = $('#min_price').val();
                        d.max_price = $('#max_price').val();
                        d.currency_code = $('#currency_code').val();
                        d.purchase_type = $('#purchase_type').val();
                        d.installment = $('#installment').val();
                        d.year_of_construction = $('#year_of_construction').val();
                        d.building_repairing = $('#building_repairing').val();
                        d.building_condition = $('#building_condition').val();
                        d.fence_condition = $('#fence_condition').val();
                        d.water_sys = $('#water_sys').val();
                        d.electricity_sys = $('#electricity_sys').val();
                        d.type_of_street = $('#type_of_street').val();
                        d.measurement = $('#measurement').val();
                        d.front_area = $('#front_area').val();
                        d.building_width = $('#building_width').val();
                        d.building_length = $('#building_length').val();
                        d.fence_width = $('#fence_width').val();
                        d.fence_length = $('#fence_length').val();
                        d.floor_level = $('#floor_level').val();
                        d.height = $('#height').val();
                        d.partation_type = $('#partation_type').val();
                        d.bed_room = $('#bed_room').val();
                        d.bath_room = $('#bath_room').val();
                        d.sorter = $('#sorter').val();
                    }
                },
                columns: [{
                        data: 'images',
                        name: 'images',
                        sortable: false,
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'title',
                        name: 'title',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'p_code',
                        name: 'p_code',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'region',
                        name: 'region',
                        sortable: false,

                    },
                    {
                        data: 'township',
                        name: 'township',
                        sortable: false,
                    },
                    {
                        data: 'price',
                        name: 'price',
                        sortable: false,
                    },
                    {
                        data: 'properties_type',
                        name: 'properties_type',
                        sortable: false,
                        searchable: false,

                    },
                    {
                        data: 'category',
                        name: 'category',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'status',
                        name: 'status',
                        sortable: false,
                        searchable: false,
                    },

                    {
                        data: 'expired_at',
                        name: 'expired_at',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sortable: false,
                        searchable: false,
                    },
                ]
            });
            $('#btnFiterSubmitSearch').click(function() {
                $('.DataTables').DataTable().draw(true);
            });
            // Delete Button
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/developer/property/' + id,
                            type: 'DELETE',
                            data: {
                                '_token': "{{ csrf_token() }}",
                            },
                            success: function() {
                                table.ajax.reload();
                            }
                        });
                    }
                })
            });
            /* Area Size*/
            $('.area').hide();
            $('.area_widthxlenght').hide();
            $('.area_option').on('change', function() {
                $('.area').hide();
                $('.area_widthxlenght').hide();
                var type = this.value;
                if (type == 1) {
                    $('.area').hide();
                    $('.area_widthxlenght').show();
                }
                if (type == 2) {
                    $('.area').show();
                    $('.area_widthxlenght').hide();
                }
            });
            /* Type change Installment change */
            $('#installment_holder').hide();
            $('#type').on('change', function() {
                if ($('#type').val() == '1') {
                    $('#installment_holder').show('fast');
                }
                if ($('#type').val() == '2' || $('#type').val() == '') {
                    $('#installment_holder').hide("fast");
                }
            });

            $('#bath_room').hide();
            $('#bed_room').hide();
            $('#partation_type').on('change', function() {
                var p_type = $("#partation_type").find('.partation_type').val();
                if (p_type == '2') {
                    $('#bath_room').show('fast');
                    $('#bed_room').show('fast');
                }else{
                    $('#bath_room').hide();
                    $('#bed_room').hide();
                }
            });
            $('#floor_level_wrap').hide('fast');
            $('#building_condition').hide('fast');
            $('#building_repairing').hide('fast');
            $('#year_of_construction').hide('fast');
            $('#partation_type').hide('fast');
            $('#land_type_holder').hide('fast');
            $('#repairing').hide('fast');
            $('.measurement_wrap').hide('fast');
            $('.situation_wrap').hide('fast');
            $('.partation_wrap').hide('fast');
            
            $('#category').on('change', function() {
                $('#floor_level_wrap').hide('fast');    
                $('#building_condition').hide('fast');
                $('#building_repairing').hide('fast');
                $('#year_of_construction').hide('fast');
                $('#partation_type').hide('fast');
                $('#bath_room').hide();
                $('#bed_room').hide();
                $('#land_type_holder').hide('fast');
                $('.measurement_wrap').hide('fast');
                $('.situation_wrap').hide('fast');
                $('.partation_wrap').hide('fast');
                $('#repairing').hide('fast');
                $('#fence_condition').hide('fast');    
                /* House */
                if ($('#category').val() == '1') {
                    $('#building_condition').show('fast');
                    $('#building_repairing').show('fast');
                    $('#year_of_construction').show('fast');
                    $('#partation_type').show('fast');
                    $('.measurement_wrap').show('fast');
                    $('.situation_wrap').show('fast');
                    $('.partation_wrap').show('fast');
                    $('#bed_room').addClass('pl-0');
                    $( "#fence_condition" ).addClass( "pl-0");
                    $('#repairing').addClass('mt-2');
                    $('#building_repairing').addClass('pl-0');
                    $('#partation_type').on('change', function() {
                        if ($('#partation_type').val() == '2') {
                            console.log($('#partation_type').val());
                            $('#bath_room').show('fast');
                            $('#bed_room').show('fast');
                        }
                    });
                }
                /* Land for House */
                if ($('#category').val() == '2') {
                    $('#fence_condition').show('fast');
                    $('#building_repairing').show('fast');
                    $('#partation_type').show('fast');
                    $( "#building_repairing" ).removeClass( "pl-0");
                    $( "#fence_condition" ).addClass( "pl-0");
                    $('.measurement_wrap').show('fast');
                    $('.situation_wrap').show('fast');
                    $('.partation_wrap').show('fast');
                    $('#bed_room').addClass('pl-0');
                    
                }
                /* Apartment and office */
                if ($('#category').val() == '3' || $('#category').val() == '4') {
                    $('#floor_level_wrap').show('fast');
                    $('#building_condition').show('fast');
                    $('#building_repairing').show('fast');
                    $('#year_of_construction').show('fast');
                    $('#partation_type').show('fast');
                    $('.measurement_wrap').show('fast');
                    $('.situation_wrap').show('fast');
                    $('.partation_wrap').show('fast');
                    $( "#building_repairing" ).addClass( "pl-0");
                    $('#repairing').addClass('pl-0');
                }
                /* Land */
                if ($('#category').val() == '5') {
                    $('#land_type_holder').show('fast');
                    $('#repairing').show('fast');
                    $('.measurement_wrap').show('fast');
                    $('.situation_wrap').show('fast');
                    $('#fence_condition').removeClass('pl-0');
                    $('#repairing').removeClass('mt-2 pl-0');
                    
                }
                /* Shop */
                if ($('#category').val() == '6') {
                    $('#floor_level_wrap').show('fast');
                    $('#partation_type').show('fast');
                    $('#year_of_construction').show('fast');
                    $('#building_repairing').show('fast');
                    $('#building_condition').show('fast');
                    $('.measurement_wrap').show('fast');
                    $('.situation_wrap').show('fast');
                    $('.partation_wrap').show('fast');
                    $('#fence_condition').addClass('pl-0');
                    // $('#repairing').addClass('pl-0');
                    // $('#bed_room').addClass('mt-2');
                }
                /* Industrial Zone */
                if ($('#category').val() == '7') {
                    $('#partation_type').show('fast');
                    $('#repairing').show('fast');
                    $('#year_of_construction').show('fast');
                    $('#building_condition').show('fast');
                    $('.measurement_wrap').show('fast');
                    $('.situation_wrap').show('fast');
                    $('.partation_wrap').show('fast');
                    $('#repairing').addClass('pl-0');
                    $('#bed_room').addClass('pl-0');
                }
                /* Condo */
                if ($('#category').val() == '8') {
                    $('#floor_level_wrap').show('fast');
                    $('#partation_type').show('fast');
                    $('#year_of_construction').show('fast');
                    $('#building_condition').show('fast');
                    $('#building_repairing').show('fast');
                    $('.measurement_wrap').show('fast');
                    $('.situation_wrap').show('fast');
                    $('.partation_wrap').show('fast');
                    // $('#bed_room').removeClass('pl-0');
                    // $('#bed_room').addClass('mt-2');
                }
            });
            
            
            $('#township').html('<option value="">Choose First Region</option>');
            $('#region').on('change', function() {
                var region_id = this.value;
                $("#township").html('');
                $.ajax({
                    url: "{{ url('/admin/township') }}",
                    type: "POST",
                    data: {
                        region_id: region_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#township').html('<option value="">Select Township</option>');
                        $.each(result.township, function(key, value) {
                            $("#township").append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            }); 
        });
    </script>

@endsection
@section('modal')
{{-- Modal Box --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Generel --}}
                <form>
                    <div class="form-group">
                        <h5>Generel</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                            </div>
                            <div class="col-md-3 pl-0">
                                <input type="text" class="form-control" name="p_code" id="p_code" placeholder="P-Code">
                            </div>
                            <div class="col-md-3 pl-0">
                                <select id='category' class="form-control">
                                    <option value="">Category</option>
                                    @foreach (config('const.property_category') as $key => $category)
                                        <option value="{{ $key }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 pl-0">
                                <select id='type' class="form-control">
                                    <option value="">Type</option>
                                    @foreach (config('const.property_type') as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mt-2" id='land_type_holder'>
                                <select id='land_type' class="form-control">
                                    <option value="">Land Type</option>
                                    @foreach (config('const.land_type') as $key => $land_type)
                                        <option value="{{ $key }}">{{ $land_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- Address --}}
                    <div class="form-group">
                        <h5>Address</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <select id='region' class="form-control">
                                    <option value="">Region</option>
                                    @foreach ($regions as $key => $reg)
                                        <option value="{{ $reg->id }}">{{ $reg->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 pl-0">
                                <select id='township' class="form-control">
                                </select>
                            </div>
                            <div class="col-md-3 pl-0" id='type_of_street_holder'>
                                <select id='type_of_street' class="form-control">
                                    <option value="">Type Of Street</option>
                                    @foreach (config('const.type_of_street') as $key => $type_of_street)
                                        <option value="{{ $key }}">{{ $type_of_street }}</option>
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
                            <div class="col-md-3">
                                <select id='currency_code' class="form-control">
                                    <option value="">Currency Code</option>
                                    @foreach (config('const.currency_code') as $key => $code)
                                        <option value="{{ $key }}">{{ $code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 pl-0">
                                <input type="number" class="form-control" name="min_price" id="min_price" placeholder="Min Price">
                            </div>
                            <div class="col-md-3 pl-0">
                                <input type="number" class="form-control" name="max_price" id="max_price" placeholder="Max Price">
                            </div>
                            <div class="col-md-3 pl-0" id='purchase_type_holder'>
                                <select id='purchase_type' class="form-control">
                                    <option value="">Purchase Type</option>
                                    @foreach (config('const.purchase_type') as $key => $purchase_type)
                                        <option value="{{ $key }}">{{ $purchase_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mt-2" id='installment_holder'>
                                <select id='installment' class="form-control">
                                    <option value="">Installment</option>
                                    @foreach (config('const.installment') as $key => $installment)
                                        <option value="{{ $installment }}">{{ $installment }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- ELECTRIC & WATER SUPPLIMENT --}}
                    <div class="form-group">
                        <h5>ELECTRIC & WATER SUPPLIMENT</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-3" id='water_sys_holder'>
                                <select id='water_sys' class="form-control">
                                    <option value="">Water System</option>
                                    @foreach (config('const.water_sys') as $key => $water_sys)
                                        <option value="{{ $water_sys }}">{{ $water_sys }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 pl-0" id='electricity_sys_holder'>
                                <select id='electricity_sys' class="form-control">
                                    <option value="">Electricity System</option>
                                    @foreach (config('const.electricity_sys') as $key => $electricity_sys)
                                        <option value="{{ $electricity_sys }}">{{ $electricity_sys }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- Area Size --}}
                    <div class="form-group">
                        <h5>Area Size</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="area_option">Area Option</label>
                                    <select name="area_option" id="area_option" class="area_option form-control">
                                        <option value="">Select</option>
                                        @foreach (config('const.area_option') as $key => $area_opt)
                                            <option value="{{ $key }}">{{ $area_opt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 area_widthxlenght">
                                <div class="row area_widthxlenght">
                                    <div class="col pl-0 form-group">
                                        <label for="width">Width</label>
                                        <input type="number" name="width" id="width_val" class="form-control">
                                    </div>
                                    <div class="col pl-0 form-group">
                                        <label for="length_val">Length</label>
                                        <input type="number" name="length_val" id="length_val" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 area">
                                <div class="row area">
                                    <div class="col pl-0 form-group">
                                        <label for="area_size">Area Size</label>
                                        <input type="number" name="area_size" id="area_size" class="form-control">
                                    </div>
                                    <div class="col pl-0 form-group">
                                        <label for="area_unit">Area Unit</label>
                                        <select name="area_unit" id="area_unit" class="area form-control">
                                            <option value="">Select</option>
                                            @foreach (config('const.area') as $key => $val)
                                                <option value="{{ $key }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pl-0" id="floor_level_wrap">
                                <div class="form-group">
                                    <label for="fence_width">Floor Level</label>
                                    <select name="floor_level" id="floor_level" class="form-control">
                                        <option value="">Please Select</option>
                                        @foreach (config('const.floor_level') as $key => $level)
                                            <option value="{{ $key }}">{{ $level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Situation --}}
                    <div class="form-group situation_wrap">
                        <h5>Situation</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-3" id="year_of_construction">
                                <select id="year_of_construction" name="year_of_construction" class="form-control">
                                    <option value="">Year Of Construction</option>
                                    @for ($i = (int) date('Y'); $i >= (int) date('Y') - 100; $i--)
                                        <option value='{{ $i }}'>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3 pl-0" id='building_repairing'>
                                <select id='building_repairing' class="form-control">
                                    <option value="">Building Repairing</option>
                                    @foreach (config('const.building_repairing') as $key => $building_repairing)
                                        <option value="{{ $key }}">{{ $building_repairing }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 pl-0" id='building_condition'>
                                <select id='building_condition' class="form-control">
                                    <option value="">Building Condition</option>
                                    @foreach (config('const.building_condition') as $key => $building_condition)
                                        <option value="{{ $key }}">{{ $building_condition }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3" id='fence_condition'>
                                <select id='fence_condition' class="form-control">
                                    <option value="">Fence Condition</option>
                                    @foreach (config('const.fence_condition') as $key => $fence_condition)
                                        <option value="{{ $key }}">{{ $fence_condition }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="col-md-3" id='repairing'>
                                <select id='building_repairing' class="form-control">
                                    <option value="">Repairing</option>
                                    @foreach (config('const.building_repairing') as $key => $building_repairing)
                                        <option value="{{ $key }}">{{ $building_repairing }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>    
                        
                    </div>
                    {{-- Partation --}}
                    <div class="form-group partation_wrap">
                        <h5>Partation</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-3" id='partation_type'>
                                <select id='partation_type' class="form-control partation_type">
                                    <option value="">Partation Type</option>
                                    @foreach (config('const.partation_type') as $key => $partation_type)
                                        <option value="{{ $key }}">{{ $partation_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 pl-0" id='bath_room'>
                                <select id='bath_room' class="form-control">
                                    <option value="">Bath Room</option>
                                    @foreach (config('const.bath_room') as $key => $bath_room)
                                        <option value="{{ $key }}">{{ $bath_room }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 pl-0" id='bed_room'>
                                <select id='bed_room' class="form-control">
                                    <option value="">Bed Room</option>
                                    @foreach (config('const.bed_room') as $key => $bed_room)
                                        <option value="{{ $key }}">{{ $bed_room }}</option>
                                        @if ($key == 4)
                                            <option value="{{ $key + 1 }}">5+</option>
                                            @php
                                                break;    
                                            @endphp
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    {{-- Sort --}}        
                    <div class="form-group">
                        <h5>Sort</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <select id="sorter" name="sorter" class="form-control">
                                    <option value="">Sort</option>
                                    @foreach (config('const.sort') as $key => $sort)
                                        <option value="{{ $sort }}">{{ $sort }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 pl-0">
                                <select id='status' class="form-control">
                                    <option value="">Feature</option>
                                    @foreach (config('const.publish_status') as $key => $status)
                                        <option value="{{ $key }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <input type="reset" value="Clear" class="btn btn-secondary">
                <button type="text" id="btnFiterSubmitSearch" class="btn btn-primary" data-dismiss="modal">
                    <i class="pe-7s-filter"></i> Advance Filter</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection