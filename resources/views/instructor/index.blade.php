@extends('instructor.instructor_dashboard')
@section('instructor')

@php
  $id = Auth::user()->id;
  $instructorId = App\Models\User::find($id);
  $status = $instructorId->status;
@endphp

<div class="page-content">

  @if ($status === '1')
  <h4>Instructor Account Is <span class="text-success">Active</span> </h4>
  @else
  <h4>Instructor Account Is <span class="text-danger">InActive</span> </h4>
 <p class="text-danger"><b> Plz wait admin will check and approve your account</b> </p>
  @endif


    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
       <div class="col">
         <div class="card radius-10 border-start border-0 border-4 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Orders</p>
                        <h4 class="my-1 text-info">{{ $totalOrders }}</h4>
                        <p class="mb-0 font-13">+2.5% from last week</p>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
                    </div>
                </div>
            </div>
         </div>
       </div>
       <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-danger">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Total Revenue</p>
                       <h4 class="my-1 text-danger">${{ number_format($totalRevenue, 2) }}</h4>
                       <p class="mb-0 font-13">+5.4% from last week</p>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
                   </div>
               </div>
           </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-warning">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Total Customers</p>
                       <h4 class="my-1 text-warning">{{ $totalCustomers }}</h4>
                       <p class="mb-0 font-13">+8.4% from last week</p>
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
                   </div>
               </div>
           </div>
        </div>
      </div>
    </div><!--end row-->

     <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Recent Orders</h6>
                </div>
                <div class="dropdown ms-auto">
                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:;">Action</a>
                        </li>
                        <li><a class="dropdown-item" href="javascript:;">Another action</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
             <div class="card-body">
             <div class="table-responsive">
               <table class="table align-middle mb-0">
                <thead class="table-light">
                 <tr>
                   <th>Product</th>
                   <th>Photo</th>
                   <th>Product ID</th>
                   <th>Status</th>
                   <th>Amount</th>
                   <th>Date</th>
                   <th>Shipping</th>
                 </tr>
                 </thead>
                 <tbody>
                 @foreach($recentOrders as $order)
    <tr>
        <td>{{ $order->course->course_name ?? 'N/A' }}</td>
        <td>
            @if(isset($order->course->course_image))
                <img src="{{ asset($order->course->course_image) }}" class="product-img-2" alt="product img">
            @else
                N/A
            @endif
        </td>
        <td>#{{ $order->id }}</td>
        <td>
            @if($order->status == 'paid')
                <span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span>
            @elseif($order->status == 'pending')
                <span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span>
            @else
                <span class="badge bg-gradient-bloody text-white shadow-sm w-100">{{ ucfirst($order->status) }}</span>
            @endif
        </td>
        <td>${{ number_format($order->price, 2) }}</td>
        <td>{{ $order->created_at->format('d M Y') }}</td>
        <td>
            <div class="progress" style="height: 6px;">
                <div class="progress-bar
                    @if($order->status == 'paid') bg-gradient-quepal
                    @elseif($order->status == 'pending') bg-gradient-blooker
                    @else bg-gradient-bloody
                    @endif"
                    role="progressbar" style="width:
                    @if($order->status == 'paid') 100%
                    @elseif($order->status == 'pending') 60%
                    @else 40%
                    @endif
                    "></div>
            </div>
        </td>
    </tr>
@endforeach
                 </tbody>
              </table>
              </div>
             </div>
        </div>



</div>
@endsection
