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
                                <h5 class="card-header">Users</h5> 
                                <!--<a href="{{route('addProduct')}}" class="btn btn-primary ml-auto" >Add Product</a>-->
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">User ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <th scope="row">{{$user->account_id}}</th>
                                                <td>{{$user->account_name}}</td>
                                                <td>{{$user->account_phone}}</td>
                                                <td>{{$user->account_balance}}</td>
                                                @if($user->account_status=="A")
                                                <td>Active</td>
                                                {{-- <button type="button" class="btn btn-success btn-round waves-effect waves-light m-1">Active</button>  --}}
                                                @else
                                                {{-- <button type="button" class="btn btn-danger btn-round waves-effect waves-light m-1">Inactive</button>  --}}
                                                <td>Inactive</td>
                                                @endif
                                                

                                                <td>
                                                    <form action="{{route('blockUser')}}" method="post">
                                                      {{@csrf_field()}}
                                                      <input type="hidden" type="hidden" name="account_id" value="{{$user->account_id}}">
                                                      @if($user->account_status=="A")
                                                      <button type="submit" class="badge badge-danger shadow-danger border border-danger waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Block'>Block</button>
                                                      @else
                                                      <button type="submit" class="badge badge-success shadow-success border border-danger waves-effect waves-light m-1 show_confirm" data-toggle="tooltip" title='Delete'>Unblock</button>
                                                      @endif
                                                    </form>
                                                </td>
                                                
                                                
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $users->onEachSide(1)->links() !!}
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
              title: `Are you sure you want to change the status of this user?`,
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