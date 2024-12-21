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
                                <h5 class="card-header">Product Buy History</h5> 
                                <!--<a href="{{route('addProduct')}}" class="btn btn-primary ml-auto" >Add Product</a>-->
                                <div class="card-body">
                                    <table id="purchasesTable" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Request ID</th>
                                                <th scope="col">Unique Purchase ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Bkash Number</th>
                                                <th scope="col">IP Address</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($purchases as $trxn)
                                            <tr>
                                                <th scope="row">{{$trxn->purchase_id}}</th>
                                                <td>{{$trxn->purchase_unique_id}}</td>
                                                <td>{{$trxn->purchase_name}}</td>
                                                <td>{{$trxn->product->product_name}}</td>
                                                <td>{{$trxn->purchase_phone}}</td>
                                                <td>{{$trxn->purchase_address}}</td>
                                                <td>{{$trxn->purchase_bkash}}</td>
                                                <td>{{$trxn->ip_address}}</td>
                                                <td>{{\Carbon\Carbon::parse($trxn->created_at)->format('d/m/Y H:i:s')}}</td>
                                                <td>{{$trxn->purchase_status}}</td>
                                                <td>
                                                    @if($trxn->purchase_status == 'Requested')
                                                    <form action="{{route('changeStatus')}}" method="post"class="d-inline">
                                                      {{@csrf_field()}}
                                                      <input type="hidden" type="hidden" name="purchase_id" value="{{$trxn->purchase_id}}">
                                                        <input type="hidden" type="hidden" name="purchase_status" value="Preparing">
                                                      <button type="submit" class="badge badge-warning shadow-warning border border-warning waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Preparing'>Preparing</button>                            
                                                    </form>
                                                    <form action="{{ route('changeStatus') }}" method="post" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" type="hidden" name="purchase_id" value="{{$trxn->purchase_id}}">
                                                        <input type="hidden" name="purchase_status" value="Shipped">
                                                        <button type="submit" class="badge badge-success shadow-danger border border-success waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Shipped'>Shipped</button>
                                                    </form>
                                                    <form action="{{ route('changeStatus') }}" method="post" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" type="hidden" name="purchase_id" value="{{$trxn->purchase_id}}">
                                                        <input type="hidden" name="purchase_status" value="Delivered">
                                                        <button type="submit" class="badge badge-success shadow-success border border-success waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Delivered'>Delivered</button>
                                                    </form>
                                                    <form action="{{ route('changeStatus') }}" method="post" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" type="hidden" name="purchase_id" value="{{$trxn->purchase_id}}">
                                                        <input type="hidden" name="purchase_status" value="Rejected">
                                                        <button type="submit" class="badge badge-danger shadow-danger border border-danger waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Rejected'>Rejected</button>
                                                    </form>
                                                    @elseif($trxn->purchase_status == 'Preparing')
                                                    <form action="{{ route('changeStatus') }}" method="post" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" type="hidden" name="purchase_id" value="{{$trxn->purchase_id}}">
                                                        <input type="hidden" name="purchase_status" value="Shipped">
                                                        <button type="submit" class="badge badge-success shadow-success border border-success waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Shipped'>Shipped</button>
                                                    </form>
                                                    <form action="{{ route('changeStatus') }}" method="post" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" type="hidden" name="purchase_id" value="{{$trxn->purchase_id}}">
                                                        <input type="hidden" name="purchase_status" value="Delivered">
                                                        <button type="submit" class="badge badge-success shadow-success border border-success waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Delivered'>Delivered</button>
                                                    </form>
                                                    @elseif($trxn->purchase_status == 'Shipped')
                                                    <form action="{{ route('changeStatus') }}" method="post" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" type="hidden" name="purchase_id" value="{{$trxn->purchase_id}}">
                                                        <input type="hidden" name="purchase_status" value="Delivered">
                                                        <button type="submit" class="badge badge-success shadow-success border border-success waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Delivered'>Delivered</button>
                                                    </form>
                                                    @elseif($trxn->purchase_status == 'Rejected')
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $purchases->onEachSide(1)->links() !!}
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
    

