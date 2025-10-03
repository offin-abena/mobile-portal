@extends('layouts.app')
@section('title', 'Monthly Revenue')
@section('sub-title', 'Monthly Revenue Dashboard')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-9">

            </div>
            <div class="col-md-3">
                <form id="fromDateChange" class="row">
                    <!-- Date From -->
                    <div class="col-12 col-sm-4">
                        <label for="dateFrom" class="form-label">Date From</label>
                        <input type="date" class="form-control" id="dateFrom" name="dateFrom">
                    </div>

                    <!-- Date To -->
                    <div class="col-12 col-sm-4">
                        <label for="dateTo" class="form-label">Date To</label>
                        <input type="date" class="form-control" id="dateTo" name="dateTo">
                    </div>

                    <!-- Go Button -->
                    <div class="col-12 col-sm-4 d-flex align-items-end">
                        <button id="goBtn" type="button" class="btn btn-primary w-100">
                            <span class="spinner d-none me-2">
                                <i class="fa fa-spinner fa-spin"></i>
                            </span>
                            Fetch Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <canvas id="ctx_monthly_reg" height="120px"></canvas>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var barGraph=null;
        function monthly_revenue() {
            const url = "{{ route('api.transactions.monthly_revenue') }}";
            console.log('Url', url);

            $.post(url, {
                    _token: $('input[name="_token"]').val(),
                    d_from: $('#dateFrom').val(),
                    d_to: $('#dateTo').val()
                })
                .done(function(data) {
                    var myDay = [];
                    var myNum = [];
                    var myNum2 = [];
                    var myNum3 = [];
                    //var myYear = [];

                    data=data.data
                    for (var i=0;i<data.length;i++) {
                        //myDay.push("Day " + data[i].Day);
                        var month_name = "";

                        if (data[i].Month == "1") {
                            month_name = "January " + data[i].Year;
                        } else if (data[i].Month == "2") {
                            month_name = "February " + data[i].Year;
                        } else if (data[i].Month == "3") {
                            month_name = "March " + data[i].Year;
                        } else if (data[i].Month == "4") {
                            month_name = "April " + data[i].Year;
                        } else if (data[i].Month == "5") {
                            month_name = "May " + data[i].Year;
                        } else if (data[i].Month == "6") {
                            month_name = "June " + data[i].Year;
                        } else if (data[i].Month == "7") {
                            month_name = "July " + data[i].Year;
                        } else if (data[i].Month == "8") {
                            month_name = "August " + data[i].Year;
                        } else if (data[i].Month == "9") {
                            month_name = "September " + data[i].Year;
                        } else if (data[i].Month == "10") {
                            month_name = "October " + data[i].Year;
                        } else if (data[i].Month == "11") {
                            month_name = "November " + data[i].Year;
                        } else if (data[i].Month == "12") {
                            month_name = "December " + data[i].Year;
                        }

                        myDay.push(month_name);
                        myNum.push(data[i].Num);
                        myNum2.push(data[i].Num2);
                        myNum3.push(data[i].Num3);


                    }

                    var chartData = {
                        labels: myDay,
                        datasets: [{
                                label: 'Revenue Chart (GHS)',
                                backgroundColor: 'rgba(0, 175, 80, 1)',
                                borderColor: 'rgba(200,200,200,0.75)',
                                hoverBackgroundColor: 'rgba(200,200,200,1)',
                                hoverBorderColor: 'rgba(200,200,200,0.75)',
                                data: myNum

                            },

                            {
                                label: 'Transactions Chart (GHS)',
                                backgroundColor: 'rgba(150, 150, 150, 1)',
                                borderColor: 'rgba(200,200,200,0.75)',
                                hoverBackgroundColor: 'rgba(200,200,200,1)',
                                hoverBorderColor: 'rgba(200,200,200,0.75)',
                                data: myNum2

                            },

                            {
                                label: 'Transactions Count Chart',
                                backgroundColor: 'rgba(150, 0, 150, 1)',
                                borderColor: 'rgba(200,200,200,0.75)',
                                hoverBackgroundColor: 'rgba(200,200,200,1)',
                                hoverBorderColor: 'rgba(200,200,200,0.75)',
                                data: myNum3

                            }
                        ],
                         options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Revenue vs Transactions Amount vs Volumes'
                                    }
                                }
                            }
                    }

                    var ctx = $('#ctx_monthly_reg');

                    if(barGraph)
                      barGraph.destroy();

                    barGraph = new Chart(ctx,{
                        type: 'bar',
                        data: chartData
                    });
                })
                .fail(function(xhr, status, error) {
                    $('.alert-dismissible').hide();

                    let errorHtml = '<div class="alert alert-danger"><ul>';

                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        // Laravel validation error
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                    } else if (xhr.status === 400) {
                        // Bad request
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorHtml += '<li>' + xhr.responseJSON.message + '</li>';
                        } else {
                            errorHtml += '<li>Bad request. Please check your input.</li>';
                        }
                    } else {
                        // General / server error
                        errorHtml += '<li>An unexpected error occurred. Please try again later.</li>';
                    }

                    errorHtml += '</ul></div>';
                    $('#alertWarning').html(errorHtml).show();
                });
        }
        $(document).ready(function() {
            $('#goBtn').trigger('click')
        })
    </script>
    <script>
        const goBtn = document.getElementById("goBtn");
        const spinner = goBtn.querySelector(".spinner");

        goBtn.addEventListener("click", function() {
            // Show spinner
            spinner.classList.remove("d-none");
            goBtn.setAttribute("data-loading", "true");

            // Simulate a process
            setTimeout(() => {
                spinner.classList.add("d-none");
                goBtn.removeAttribute("data-loading");

                //evt.preventDefault();
                dateFrom = $('#dateFrom').val()
                dateTo = $('#dateTo').val()

                monthly_revenue(dateFrom, dateTo)
            }, 3000); // 3s fake load
        });
    </script>
        <script defer>
        document.addEventListener("DOMContentLoaded", function() {
            function formatDate(date) {
                return date.toISOString().split('T')[0];
            }

            const today = new Date();
            const lastWeek = new Date();
            lastWeek.setDate(today.getDate() - 7);

            document.getElementById("dateFrom").value = formatDate(lastWeek);
            document.getElementById("dateTo").value = formatDate(today);

            // Optional: prevent selecting future dates
            document.getElementById("dateTo").setAttribute("max", formatDate(today));
        });
    </script>

@endsection
