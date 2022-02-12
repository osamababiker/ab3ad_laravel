<div class="modal fade" id="driverInfoModal_{{ $driver->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title"> معلومات المندوب  </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <ul>
                    <li style="font-size: 16px">
                        <span> رقم الهاتف :  </span> <span> {{ $driver->phone }} </span>
                    </li>
                    <li style="font-size: 16px">
                        <span>  العنوان :  </span> <span> {{ $driver->address }} </span>
                    </li>
                    <li style="font-size: 16px">
                        <span> وسيلة التوصيل  :  </span> <span> {{ $driver->transportType }} </span>
                    </li>
                    <li style="font-size: 16px">
                        <span> صورة لرخصة القيادة:  </span>
                        <div>
                            <a href="{{ asset('upload/drivers/license/'.$driver->licenseImage) }}" target="_blank">
                                <img src="{{ asset('upload/drivers/license/'.$driver->licenseImage) }}" width="100" height="100" alt="">
                            </a>
                        </div>
                    </li>
                    <li style="font-size: 16px">
                        <span> صورة وسيلة التوصيل :  </span>
                        <div>
                            <a href="{{ asset('upload/drivers/transport/'.$driver->transportImage) }}" target="_blank">
                                <img src="{{ asset('upload/drivers/transport/'.$driver->transportImage) }}" width="100" height="100" alt="">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

