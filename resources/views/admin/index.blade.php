@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
       <div class="col">
         <div class="card radius-10 border-start border-0 border-4 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Orders</p>
                        <h4 class="my-1 text-info">{{ $totalOrders }}</h4>
                        <p class="mb-0 font-13">{{ number_format($orderChange, 1) }}% from last week</p>
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
                       <p class="mb-0 font-13">+5.4% from last week</p> {{-- Replace with your own calculation if needed --}}
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
                   </div>
               </div>
           </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10 border-start border-0 border-4 border-success">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div>
                       <p class="mb-0 text-secondary">Bounce Rate</p>
                       <h4 class="my-1 text-success">{{ $bounceRate }}%</h4>
                       <p class="mb-0 font-13">-4.5% from last week</p> {{-- Replace with your own calculation if needed --}}
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
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
                       <p class="mb-0 font-13">+8.4% from last week</p> {{-- Replace with your own calculation if needed --}}
                   </div>
                   <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
                   </div>
               </div>
           </div>
        </div>
      </div>
    </div><!--end row-->

    <div class="row">
       <div class="col-12 col-lg-12 d-flex">
          <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Sales Overview</h6>
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
                <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
                    <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #14abef"></i>Sales</span>
                    <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Visits</span>
                </div>
                <div class="chart-container-1">
                    <canvas id="chart1"></canvas>
                  </div>
              </div>
              <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                <div class="col">
                  <div class="p-3">
                    <h5 class="mb-0">24.15M</h5>
                    <small class="mb-0">Overall Visitor <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
                  </div>
                </div>
                <div class="col">
                  <div class="p-3">
                    <h5 class="mb-0">12:38</h5>
                    <small class="mb-0">Visitor Duration <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
                  </div>
                </div>
                <div class="col">
                  <div class="p-3">
                    <h5 class="mb-0">639.82</h5>
                    <small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
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
