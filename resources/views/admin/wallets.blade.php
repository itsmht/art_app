@include('layouts.header')
@include('layouts.topbar')
@include('layouts.sidebar')
<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                    
                    <div class="row">
                        
                        <!-- hoverable table -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Pending Wallet Verifications</h5> 
                                <!--<a href="{{route('addProduct')}}" class="btn btn-primary ml-auto" >Add Product</a>-->
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Wallet ID</th>
                                                <th scope="col">Account Name</th>
                                                <th scope="col">Wallet Name</th>
                                                <th scope="col">Wallet Number</th>
                                                <th scope="col">District</th>
                                                <th scope="col">Branch</th>
                                                <th scope="col">Trxn Method</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($wallets as $wallet)
                                            <tr>
                                                <th scope="row">{{$wallet->wallet_id}}</th>
                                                <td>{{$wallet->account_name}}</td>
                                                <td>{{$wallet->wallet_name}}</td>
                                                <td>{{$wallet->wallet_number}}</td>
                                                <td>{{$wallet->wallet_district}}</td>
                                                <td>{{$wallet->wallet_branch}}</td>
                                                <td>{{$wallet->pm_name}}</td>
                                                
                                                <td>
                                                    <form action="{{route('approveWallet')}}" method="post" class="d-inline">
                                                      {{@csrf_field()}}
                                                      <input type="hidden" name="wallet_id" value="{{$wallet->wallet_id}}">
                                                      <button type="submit" class="badge badge-success shadow-success border border-danger waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Approve'>Approve</button>                            
                                                    </form>
                                                    <form action="{{ route('rejectWallet') }}" method="post" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="wallet_id" value="{{$wallet->wallet_id}}">
                                                        <button type="submit" class="badge badge-danger shadow-danger border border-danger waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Reject'>Reject</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $wallets->onEachSide(1)->links() !!}
                                </div>
                            </div>
                        </div>
                        
                        <!-- end hoverable table -->
                        <!-- ============================================================== -->
                    </div>
                    @include('layouts.footer')
                    </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        
              </div>
    @include('layouts.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to authorize this wallet?`,
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>
