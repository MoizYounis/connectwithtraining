@extends('admin.layouts.master')
@section('title')
    Pricing List
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void();"></a>Pricing List</li>
                    </ol>
                </div>

                <div class="col-sm-3">
                    <div class="btn-group float-sm-right">
                        <button type="button" class="btn btn-behance text-white btn-sm waves-effect waves-light add_data"
                            data-toggle="modal" data-target="#addpricing"><i class="fa fa-plus mr-1"></i> Add Pricing
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addpricing" data-backdrop="static">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title modal_title_creat_update">Insert Pricing</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="{{ route('pricing.store') }}">
                                @csrf
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label>Name*</label>
                                        <input type="text" class="form-control input-check" name="pricing_name"
                                            id="pricing_name" placeholder="Enter Category Name"
                                            value="{{ old('pricing_name') }}" required="">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Type*</label>
                                        <select class="form-control input-check" name="pricing_type" id="pricing_type"
                                            required>
                                            <option value="">Select Type</option>
                                            <option value="single_1">SINGLE / FREE</option>
                                            <option value="single_2">SINGLE / NO DELAY INTERVIEW</option>
                                            <option value="corporate">CORPORATE</option>
                                            <option value="enterprise">ENETERPRISE</option>
                                            <option value="single_3">SIGNLE / TAILORED INTERVIEW</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Price*</label>
                                        <input type="number" type="any" class="form-control input-check" name="price"
                                            id="price" placeholder="Enter Price" value="{{ old('price') }}"
                                            required="">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Expiry Days*</label>
                                        <input type="number" class="form-control input-check" name="expiry_days"
                                            id="expiry_days" placeholder="Enter Expiry Days"
                                            value="{{ old('expiry_days') }}" required="">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Coursers*</label>
                                        <input type="number" class="form-control input-check" name="courses" id="courses"
                                            placeholder="Enter Courses" value="{{ old('courses') }}" required="">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Certificates*</label>
                                        <input type="number" class="form-control input-check" name="certificates"
                                            id="certificates" placeholder="Enter Certificates"
                                            value="{{ old('certificates') }}" required="">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Badges*</label>
                                        <input type="number" class="form-control input-check" name="badges" id="badges"
                                            placeholder="Enter Badges" value="{{ old('badges') }}" required="">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Days*</label>
                                        <input type="number" class="form-control input-check" name="days" id="days"
                                            placeholder="Enter Days" value="{{ old('days') }}" required="">
                                    </div>

                                    <div class="form-group col-md-12">
                                        <button type="submit" id="submit_btn" class="btn btn-sm btn-success px-3"><i
                                                class="fa fa-arrow-circle-right"></i> Insert</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div id="messages"></div>
                    <div class="card">
                        <div class="card-header"><i class="zmdi zmdi-reader"></i> Pricing</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table style="zoom:90%;" id="datatable" class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Price</th>
                                            <th>Expiry Days</th>
                                            <th>Courses</th>
                                            <th>Certificates</th>
                                            <th>Badges</th>
                                            <th>Days</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pricing_list as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ ucwords($row->pricing_name) }}</td>
                                                <td>
                                                    @if ($row->pricing_type == 'single_1')
                                                        SINGLE / FREE
                                                    @elseif($row->pricing_type == 'single_2')
                                                        SINGLE / NO DELAY INTERVIEW
                                                    @elseif($row->pricing_type == 'corporate')
                                                        CORPORATE
                                                    @elseif($row->pricing_type == 'enterprise')
                                                        ENTERPRISE
                                                    @elseif($row->pricing_type == 'single_3')
                                                        SINGLE / TAILORED INTERVIEW
                                                    @endif
                                                </td>
                                                <td>{{ $row->price }}</td>
                                                <td>{{ $row->expiry_days }}</td>
                                                <td>{{ $row->courses }}</td>
                                                <td>{{ $row->certificates }}</td>
                                                <td>{{ $row->badges }}</td>
                                                <td>{{ $row->days }}</td>
                                                <td>
                                                    <div class="btn-group m-1" role="group">
                                                        <button type="button"
                                                            class="btn btn-behance btn-sm text-white waves-effect waves-light dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);">
                                                            <a href="javascript:void();" class="dropdown-item edit_data"
                                                                data-toggle="modal"
                                                                data-target="#editpricing{{ $row->id }}"><i
                                                                    class="fa fa-edit mr-1"></i> Edit Data</a>
                                                            <div class="dropdown-divider"></div>

                                                            <form method="post" class="delete_form"
                                                                action="{{ action('Admin\PricingController@destroy', $row->id) }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="_method" value="Delete">
                                                                <button type="submit"
                                                                    class="dropdown-item delete_data"><i
                                                                        class="fa fa-trash mr-1"></i> Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                            <!-- edit -->
                                            <div class="modal fade" id="editpricing{{ $row->id }}"
                                                data-backdrop="static">
                                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title modal_title_creat_update">Update Pricing
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form method="post"
                                                                action="{{ route('pricing.update', [$row->id]) }}">
                                                                @csrf
                                                                {{ method_field('PATCH') }}
                                                                <div class="row">

                                                                    <div class="form-group col-md-12">
                                                                        <label>Name*</label>
                                                                        <input type="text"
                                                                            class="form-control input-check"
                                                                            name="pricing_name" id="pricing_name"
                                                                            placeholder="Enter Pricing Name"
                                                                            value="{{ $row->pricing_name }}"
                                                                            required="">
                                                                    </div>

                                                                    <div class="form-group col-md-4">
                                                                        <label>Type*</label>
                                                                        <select class="form-control input-check"
                                                                            name="pricing_type" id="pricing_type"
                                                                            required>
                                                                            <option value="">Select Type</option>
                                                                            <option value="single_1"
                                                                                @if ($row->pricing_type == 'single_1') selected @endif>
                                                                                SINGLE / FREE</option>
                                                                            <option value="single_2"
                                                                                @if ($row->pricing_type == 'single_2') selected @endif>
                                                                                SINGLE / NO DELAY INTERVIEW</option>
                                                                            <option value="corporate"
                                                                                @if ($row->pricing_type == 'corporate') selected @endif>
                                                                                CORPORATE</option>
                                                                            <option value="enterprise"
                                                                                @if ($row->pricing_type == 'enterprise') selected @endif>
                                                                                ENTERPRISE</option>
                                                                            <option value="single_3"
                                                                                @if ($row->pricing_type == 'single_3') selected @endif>
                                                                                SINGLE / TAILORED INTERVIEW</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group col-md-4">
                                                                        <label>Price*</label>
                                                                        <input type="number" type="any"
                                                                            class="form-control input-check"
                                                                            name="price" id="price"
                                                                            placeholder="Enter Price"
                                                                            value="{{ $row->price }}" required="">
                                                                    </div>

                                                                    <div class="form-group col-md-4">
                                                                        <label>Expiry Days*</label>
                                                                        <input type="number"
                                                                            class="form-control input-check"
                                                                            name="expiry_days" id="expiry_days"
                                                                            placeholder="Enter Expiry Days"
                                                                            value="{{ $row->expiry_days }}"
                                                                            required="">
                                                                    </div>

                                                                    <div class="form-group col-md-4">
                                                                        <label>Coursers*</label>
                                                                        <input type="number"
                                                                            class="form-control input-check"
                                                                            name="courses" id="courses"
                                                                            placeholder="Enter Courses"
                                                                            value="{{ $row->courses }}" required="">
                                                                    </div>

                                                                    <div class="form-group col-md-4">
                                                                        <label>Certificates*</label>
                                                                        <input type="number"
                                                                            class="form-control input-check"
                                                                            name="certificates" id="certificates"
                                                                            placeholder="Enter Certificates"
                                                                            value="{{ $row->certificates }}"
                                                                            required="">
                                                                    </div>

                                                                    <div class="form-group col-md-4">
                                                                        <label>Badges*</label>
                                                                        <input type="number"
                                                                            class="form-control input-check"
                                                                            name="badges" id="badges"
                                                                            placeholder="Enter Badges"
                                                                            value="{{ $row->badges }}" required="">
                                                                    </div>

                                                                    <div class="form-group col-md-4">
                                                                        <label>Days*</label>
                                                                        <input type="number"
                                                                            class="form-control input-check"
                                                                            name="days" id="days"
                                                                            placeholder="Enter Days"
                                                                            value="{{ $row->days }}" required="">
                                                                    </div>

                                                                    <div class="form-group col-md-12">
                                                                        <button type="submit" id="submit_btn"
                                                                            class="btn btn-sm btn-success px-3"><i
                                                                                class="fa fa-arrow-circle-right"></i>
                                                                            Update</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Row-->
        </div>
        <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->
@endsection
@section('script')
    <script type="text/javascript">
        $("#pricing").addClass("active");
        $(document).ready(function() {
            $('#datatable').DataTable({
                order: [
                    [0, 'desc']
                ]
            });

            $('.delete_form').on('submit', function() {
                if (confirm("Are you sure you want to delete it..?")) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection
