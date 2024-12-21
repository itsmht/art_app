@include('layouts.header')
@include('layouts.topbar')
@include('layouts.sidebar')
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- Settings Form -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="section-block" id="basicform">
                    <h3 class="section-title">Update Settings</h3>
                    <p>Please update the settings information below.</p>
                </div>
                <div class="card">
                    <h5 class="card-header">Settings</h5>
                    <div class="card-body">
                        <form action="{{ route('updateSettings') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="logo" class="col-form-label">Logo</label>
                                <input id="logo" name="logo" type="file" class="form-control">
                                
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label">Business Name</label>
                                <input id="name" name="name" type="text" class="form-control" value="{{ $settings->name }}">
                                
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" name="email" type="email" class="form-control" value="{{ $settings->email }}">
                                
                            </div>
                            <div class="form-group">
                                <label for="bkash" class="col-form-label">Bkash Number</label>
                                <input id="bkash" name="bkash" type="text" class="form-control" value="{{ $settings->bkash }}">
                                
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Settings Form -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
</div>

@include('layouts.footer')
</div>

@include('layouts.js')
