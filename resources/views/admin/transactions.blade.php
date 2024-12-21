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
                                <h5 class="card-header">Transaction History</h5> 
                                <!--<a href="{{route('addProduct')}}" class="btn btn-primary ml-auto" >Add Product</a>-->
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Transaction ID</th>
                                                <th scope="col">Account Name</th>
                                                <th scope="col">Transaction Type</th>
                                                <th scope="col">Debit Amount</th>
                                                <th scope="col">Credit Amount</th>
                                                <th scope="col">Transaction Status</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Unique Quirky Trxn ID</th>
                                                <th scope="col">Trxn Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transactions as $trxn)
                                            <tr>
                                                <th scope="row">{{$trxn->transaction_id}}</th>
                                                <td>{{$trxn->account_name}}</td>
                                                <td>{{$trxn->transaction_type}}</td>
                                                <td>{{$trxn->transaction_debit_amount}}</td>
                                                <td>{{$trxn->transaction_credit_amount}}</td>
                                                <td>{{$trxn->transaction_status}}</td>
                                                <td>{{$trxn->transaction_payment_method}}</td>
                                                <td>{{$trxn->transaction_unique_id}}</td>
                                                <td>{{\Carbon\Carbon::parse($trxn->created_at)->format('d/m/Y H:i:s')}}</td>
                                                
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $transactions->onEachSide(1)->links() !!}
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
    
