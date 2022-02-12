<div class="modal fade" id="driverOrdersListModal_{{ $driver->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> الطلبات المقدم عليها عروض من قبل {{ $driver->name }}  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <ul>
                    @foreach($offers as $offer)
                    <li style="font-size: 14px">
                        <span> {{ $offer->order->order }} </span>
                         <p> {{ $offer->offer }} جنيه </p>
                        <p style="font-size: 14px">
                            @if($offer->status == 1)
                                <i class="fa fa-check" style="color: green"> تم قبول العرض </i>
                            @else
                                <i class="fa fa-times" style="color: red"> تم رفض العرض </i>
                            @endif
                        </p>
                    </li> <hr>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

