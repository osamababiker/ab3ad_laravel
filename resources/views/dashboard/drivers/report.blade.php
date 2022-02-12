@include('dashboard/components/header')

<body data-theme="default" data-layout="fluid" data-sidebar-position="right" data-sidebar-behavior="sticky">
    <div class="wrapper">

        @include('dashboard/components/sidebar')

        <div class="main">

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"> تقرير عن مبيعات {{ $driver->name }} </h1>

                    @if(session()->has('driverUpdated'))
                        <div class="alert alert-success alert-dismissible" id="successAlert"  role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                <strong> اهلا {{ Auth::user()->name }} </strong> {{session()->get('driverUpdated')}}
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>اسم المندوب</th>
                                                <th> اجمالي عدد الطلبات  </th>
                                                <th> عدد الطلبات المكتملة <i class="fa fa-check" style="color: green"></i> </th>
                                                <th> عدد الطلبات الملغاة <i class="fa fa-times" style="color: red"></i> </th>
                                                <th>اجمالي المبيعات </th>
                                                <th> اجمالي الملبغ المدفوع </th>
                                                <th> قائمة الطلبات  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $driver->name }}</td>
                                                <td>
                                                    {{ $orders_count }}
                                                </td>
                                                <td>
                                                    {{ $completed_orders_counter }}
                                                </td>
                                                <td>
                                                    {{ $canceled_orders_counter }}
                                                </td>
                                                <td>{{ $total_income }}</td>
                                                <td>{{ $total_payments }}</td>
                                                <td>
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#driverOrdersListModal_{{ $driver->id }}"> <i class="fa fa-ellipsis-h"></i> </a>
                                                </td>
                                                @include('dashboard/drivers/components/driverOrdersListModal');
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            @include('dashboard/components/footer')
