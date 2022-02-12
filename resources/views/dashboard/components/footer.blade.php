<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-12 text-end">
                <p class="mb-0">
                    &copy; 2021 - <a href="/" class="text-muted">Garib App</a>
                </p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>


<script src="{{ asset('dashboard/js/app.js') }}"></script>

<script>
    function store() {
        var name = $("#name").val();
        var categoryId = $("#categoryId").val();
        var colors = $("#colors").val();
        var sizes = $("#sizes").val();
        var description = $("#description").val();
        var quantity = $("#quantity").val();
        var price = $("#price").val();
        var sellingPrice = $("#sellingPrice").val();
        if ($('#isAvailable').is(":checked")) {
            var isChecked = 1;
        } else var isChecked = 0;
        $.ajax({
            url: '/dashboard/products/store',
            type: 'POST',
            data: {
                name: name,
                categoryId: categoryId,
                sizes: sizes,
                colors: colors,
                description: description,
                quantity: quantity,
                price: price,
                sellingPrice: sellingPrice,
                isAvailable: isChecked,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success: function(response) {
                var name = $("#name").val('');
                var description = $("#description").val('');
                var quantity = $("#quantity").val('');
                var price = $("#price").val('');
                var sellingPrice = $("#sellingPrice").val('');
                document.getElementById('successAlert').style.display = 'block';
            }
        });
    }
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Select2
        $(".select2").each(function() {
            $(this)
                .wrap("<div class=\"position-relative\"></div>")
                .select2({
                    placeholder: "Select value",
                    dropdownParent: $(this).parent()
                });
        })
        // Daterangepicker
        $("input[name=\"daterange\"]").daterangepicker({
            opens: "left"
        });
        $("input[name=\"datetimes\"]").daterangepicker({
            timePicker: true,
            opens: "left",
            startDate: moment().startOf("hour"),
            endDate: moment().startOf("hour").add(32, "hour"),
            locale: {
                format: "M/DD hh:mm A"
            }
        });
        $("input[name=\"datesingle\"]").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#reportrange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }
        $("#reportrange").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            }
        }, cb);
        cb(start, end);
        // Datetimepicker
        $('#datetimepicker-minimum').datetimepicker();
        $('#datetimepicker-view-mode').datetimepicker({
            viewMode: 'years'
        });
        $('#datetimepicker-time').datetimepicker({
            format: 'LT'
        });
        $('#datetimepicker-date').datetimepicker({
            format: 'L'
        });
    });
</script>

<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                responsive: true
            });
        });
    </script>
</body>

</html>