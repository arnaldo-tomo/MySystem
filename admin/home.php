<?php 
	require_once '../connect/head.php';
	require_once '../connect/menu.php';
	require_once '../connect/javascrip.php';
?>
        
        
<title>Admin-Home</title>
            
            <main class="dash-content">
                <div class="container-fluid">
                    <div class="row dash-row">
                        <div class="col-xl-4 col-sm-4">
                            <div class="stats stats-dark">
                                <h3 class="stats-title"> Usuarios </h3>
                                <div class="stats-content">
                                    <div class="stats-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    
                                    <div class="stats-data">
                                        <div class="stats-number">114</div>
                                        <div class="stats-change">
                                            <span class="stats-percentage">+25%</span>
                                            <span class="stats-timeframe">from last month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="stats stats-success ">
                                <h3 class="stats-title"> Renovacao </h3>
                                <div class="stats-content">
                                    <div class="stats-icon">
                                        <i class="fas fa-cart-arrow-down"></i>
                                    </div>
                                    <div class="stats-data">
                                        <div class="stats-number">$25,541</div>
                                        <div class="stats-change">
                                            <span class="stats-percentage">+17.5%</span>
                                            <span class="stats-timeframe">from last month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-4">
                            <div class="stats stats-danger">
                                <h3 class="stats-title"> Relatorios </h3>
                                <div class="stats-content">
                                    <div class="stats-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="stats-data">
                                        <div class="stats-number">5</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card spur-card">
                                <div class="card-header">
                                    <div class="spur-card-icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <div class="spur-card-title"> Bar Chart </div>
                                    <div class="spur-card-menu">
                                        <div class="dropdown show">
                                            <a class="spur-card-menu-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body spur-card-body-chart">
                                    <canvas id="spurChartjsBar"></canvas>
                                    <script>
                                        var ctx = document.getElementById("spurChartjsBar").getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                                                datasets: [{
                                                    label: 'Blue',
                                                    data: [12, 19, 3, 5, 2],
                                                    backgroundColor: window.chartColors.primary,
                                                    borderColor: 'transparent'
                                                }]
                                            },
                                            options: {
                                                legend: {
                                                    display: false
                                                },
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card spur-card">
                                <div class="card-header">
                                    <div class="spur-card-icon">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="spur-card-title"> Notifications </div>
                                </div>
                                <div class="card-body ">
                                    <div class="notifications">
                                        <a href="#!" class="notification">
                                            <div class="notification-icon">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                            <div class="notification-text">New comment</div>
                                            <span class="notification-time">21 days ago</span>
                                        </a>
                                        <a href="#!" class="notification">
                                            <div class="notification-icon">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                            <div class="notification-text">New comment</div>
                                            <span class="notification-time">21 days ago</span>
                                        </a>
                                        <a href="#!" class="notification">
                                            <div class="notification-icon">
                                                <i class="fas fa-inbox"></i>
                                            </div>
                                            <div class="notification-text">New comment</div>
                                            <span class="notification-time">21 days ago</span>
                                        </a>
                                        <div class="notifications-show-all">
                                            <a href="#!">Show all</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
   
</body>

</html>