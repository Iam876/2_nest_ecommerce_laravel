    <!--End header-->
    @extends('dashboardMaster')
    <!--End header-->
    @section('dashboard')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> Change Password
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            {{-- Menu Start --}}
                            @include('frontend.layouts.UserDashboardSideBar')
                            {{-- Menu End --}}
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Change Password</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{Route('user.user_password_update')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Current Password <span class="required">*</span></label>
                                                    <input required="" name="old_password" id="old_password" class="form-control  @error('old_password') is-invalid @enderror" type="password" />

                                                    @error('old_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>New Password <span class="required">*</span></label>
                                                    <input required="" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" type="password" />

                                                    @error('new_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Confirm Password <span class="required">*</span></label>
                                                    <input required="" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm_password" type="password" />

                                                    @error('confirm_password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="submit" class="btn btn-primary px-4" value="Change Password" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection