@include('dashboard/components/header')

<body data-theme="default" data-layout="fluid" data-sidebar-position="right" data-sidebar-behavior="sticky">
    <div class="wrapper">

        @include('dashboard/components/sidebar')

        <div class="main">

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"> جدول ادارة طلبات التوصيل </h1>

                    @if(session()->has('feedback'))
                        <div class="alert alert-success alert-dismissible" id="successAlert"  role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                <strong> اهلا {{ Auth::user()->name }} </strong> {{session()->get('feedback')}}
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> ادارة طلبات التوصيل </h5>
                                    <h6 class="card-subtitle text-muted"> بمقدورك الموافقة او رفض   طلبات التوصيل  من المناديب  </h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>اسم العميل</th>
                                                <th> رقم العميل </th>
                                                <th>اسم المندوب</th>
                                                <th> رقم المندوب </th>
                                                <th> الطلب </th>
                                                <th> الكمية </th>
                                                <th> تاريخ الطلب </th>
                                                <th> تاريخ ارسال طلب التوصيل </th>
                                                <th> حالة الطلب </th>
                                                <th>ادارة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($requests as $request)
                                            <tr>
                                                <td>{{ $request->customer->name }}</td>
                                                <td>{{ $request->customer->phone }}</td>
                                                <td>{{ $request->driver->name }}</td>
                                                <td>{{ $request->driver->phone }}</td>
                                                <td>{{ $request->order->item->name }}</td>
                                                <td>{{ $request->order->quantity }}</td>
                                                <td>{{ $request->order->created_at }}</td>
                                                <td>{{ $request->created_at }}</td>
                                                <td>
                                                    @if($request->isAccepted == 1)
                                                        <i class="fa fa-check" style="color: green"></i> تمت الموافقة
                                                    @else
                                                        <i class="fa fa-times" style="color: red"></i> لم يتم الموافقة
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#deleteRequestModal_{{ $request->id }}"  style="color: red;"> <i class="fa fa-trash"></i> </a>
                                                    &nbsp;
                                                    @if($request->isAccepted == 0)
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#approveRequestModal_{{ $request->id }}"> <i class="fa fa-check"></i> </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <!-- to approve requests info --->
                                            @include('dashboard/deliveryRequests/components/approveModal');
                                            <!-- to delete requests -->
                                            @include('dashboard/deliveryRequests/components/deleteModal');
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            @include('dashboard/components/footer')
