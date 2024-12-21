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
                                <h5 class="card-header">Pending Sell Requests</h5> 
                                <!--<a href="{{route('addProduct')}}" class="btn btn-primary ml-auto" >Add Product</a>-->
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Request ID</th>
                                                <th scope="col">Account Name</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Buying Price</th>
                                                <th scope="col">Requested Quantity</th>
                                                <th scope="col">Requested QPA</th>
                                                <th scope="col">Total Amount</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($trades as $trxn)
                                            <tr>
                                                <th scope="row">{{$trxn->request_id}}</th>
                                                <td>{{$trxn->account_name}}</td>
                                                <td>{{$trxn->product_name}}</td>
                                                <td>{{$trxn->buying_price}}</td>
                                                <td>{{$trxn->request_quantity}}</td>
                                                <td>{{$trxn->request_amount_per_quantity}}</td>
                                                <td>{{$trxn->request_amount_total}}</td>
                                                <td>{{\Carbon\Carbon::parse($trxn->created_at)->format('d/m/Y H:i:s')}}</td>
                                                
                                                <td>
                                                    <form action="{{ route('approveTrade') }}" method="post" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="request_id" value="{{ $trxn->request_id }}">
                                                        <button type="submit" class="badge badge-success shadow-success border border-danger waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Approve'>Approve</button>
                                                    </form>
                                                    <form action="{{ route('rejectTrade') }}" method="post" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="request_id" value="{{ $trxn->request_id }}">
                                                        <button type="submit" class="badge badge-danger shadow-danger border border-danger waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Reject'>Reject</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $trades->onEachSide(1)->links() !!}
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
              title: `Are you sure you want to authorize this transaction?`,
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
