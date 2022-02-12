@include('dashboard/components/header')

<body data-theme="default" data-layout="fluid" data-sidebar-position="right" data-sidebar-behavior="sticky">
    <div class="wrapper">

        @include('dashboard/components/sidebar')

        <div class="main">

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"> جدول ادارة السائقين </h1>

                    @if(session()->has('driverUpdated'))
                        <div class="alert alert-success alert-dismissible" id="successAlert"  role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                <strong> اهلا {{ Auth::user()->name }} </strong> {{session()->get('driverUpdated')}}
                            </div>
                        </div>
                    @endif

                    @if(session()->has('driverDeleted'))
                        <div class="alert alert-success alert-dismissible" id="successAlert"  role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                <strong> اهلا {{ Auth::user()->name }} </strong> {{session()->get('driverDeleted')}}
                            </div>
                        </div>
                    @endif

                    @if(session()->has('paymentCreated'))
                        <div class="alert alert-success alert-dismissible" id="successAlert"  role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                <strong> اهلا {{ Auth::user()->name }} </strong> {{session()->get('paymentCreated')}}
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"> ادارة السائقين </h5>
                                    <h6 class="card-subtitle text-muted"> بمقدورك الموافقة على بيانات السائق وصوره في التطبيق او حتى حذفه </h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-reponsive" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>اسم المندوب</th>
                                                <th> معلومات المندوب </th>
                                                <th> تقرير عن المندوب </th>
                                                <th> حالة المندوب </th>
                                                <th>ادارة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($drivers as $driver)
                                            <tr>
                                                <td>{{ $driver->name }}</td>
                                                <td>
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#driverInfoModal_{{ $driver->id }}"> <i class="fa fa-ellipsis-h"></i> </a>
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{ route('driversTable.driverReport',['driverId' => $driver->id]) }}"> <i class="fa fa-page"> اعرض التقرير </i> </a>
                                                </td>
                                                <td>
                                                    @if($driver->isAccepted == 1)
                                                        <i class="fa fa-check" style="color: green"></i>
                                                    @else
                                                        <i class="fa fa-times" style="color: red"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#deleteDriverModal_{{ $driver->id }}"  style="color: red;"> <i class="fa fa-trash"></i> </a>
                                                    &nbsp;
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#editDriverModal_{{ $driver->id }}"> <i class="fa fa-edit"></i> </a>
                                                    &nbsp;
                                                    <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#paymentDriverModal_{{ $driver->id }}"> <i class="fa fa-money-check"></i> </a>
                                                </td>
                                            </tr>
                                            <!--  driver info Modal --->
                                            @include('dashboard/drivers/components/driverInfoModal');
                                            <!--  driver payment Modal --->
                                            @include('dashboard/drivers/components/paymentDriverModal');
                                            <!-- to edit driver info --->
                                            @include('dashboard/drivers/components/editModal');
                                            <!-- to delete driver -->
                                            @include('dashboard/drivers/components/deleteModal');
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
