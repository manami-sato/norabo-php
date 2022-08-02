<?php
//2022.07.20
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
session_start();
if (empty($_SESSION['email'])) {
    echo "<script> parent.location.href='sign_in.php'; </script>";
} else {
    $user_id = $_SESSION['user_id'];
    $email = $_SESSION['email'];
    $nick_name = $_SESSION['nick_name'];
    $age = $_SESSION['age'];
    $gender = $_SESSION['gender'];
    $img =  $_SESSION['img'];
    ///session ok
}
$sql_select = "	SELECT * FROM DB_USER";
$conn = mysqli_connect('localhost', 'sys3_itweb_g', 'w6AsjMem', 'sys3_itweb_g');
if (mysqli_connect_errno($conn)) {
  die("DB Error " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");
$result_select = mysqli_query($conn, $sql_select);
if ($result_select->num_rows > 0) {
  while ($row = $result_select->fetch_assoc()) {
    $IMG = $row['IMG'];
  }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>norabo</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css" rel="stylesheet" />
    <link href="./dist/css/tabler-flags.min.css" rel="stylesheet" />
    <link href="./dist/css/tabler-payments.min.css" rel="stylesheet" />
    <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet" />
    <link href="./dist/css/demo.min.css" rel="stylesheet" />
</head>
<body>
    <main class="index">
        <div style="text-align:center ;">
            <a href="./home.php"><img src="./static/logo.svg" height="120" alt=""></a>
        </div>
        <h1>Test profile</h1>
        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-report">
            <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url(./static/usr/<?php echo $IMG ?>)"></span>
        </a>
        <h3>ユーザID : <?php echo $user_id ?></h3>
        <h3>メールアドレス : <?php echo $email ?></h3>
        <h3>ニックネーム : <?php echo $nick_name ?></h3>
        <h3>世代 : <?php echo $age ?></h3>
        <h3>性別 : <?php echo $gender ?></h3>
        <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="user_change.php" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">イメージ変更</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">イメージを選択してください。</label>
                                <input type="file" name="file" class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                キャンセル
                            </a>
                            <button type="submit" class="btn btn-primary ms-auto">変更</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            function F_Open_dialog() {
                document.getElementById("btn_file").click();
            }
        </script>
        <script src="./dist/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="./dist/js/tabler.min.js"></script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
                    chart: {
                        type: "area",
                        fontFamily: 'inherit',
                        height: 40.0,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: .16,
                        type: 'solid'
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                        name: "Profits",
                        data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
                    }],
                    grid: {
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: 'datetime',
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    labels: [
                        '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                    ],
                    colors: ["#206bc4"],
                    legend: {
                        show: false,
                    },
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
                    chart: {
                        type: "line",
                        fontFamily: 'inherit',
                        height: 40.0,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    stroke: {
                        width: [2, 1],
                        dashArray: [0, 3],
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                        name: "May",
                        data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 4, 46, 39, 62, 51, 35, 41, 67]
                    }, {
                        name: "April",
                        data: [93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35, 41, 27, 35, 51, 46, 62, 37, 44, 53, 41, 65, 39, 37]
                    }],
                    grid: {
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        type: 'datetime',
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    labels: [
                        '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                    ],
                    colors: ["#206bc4", "#a8aeb7"],
                    legend: {
                        show: false,
                    },
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-active-users'), {
                    chart: {
                        type: "bar",
                        fontFamily: 'inherit',
                        height: 40.0,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%',
                        }
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: [{
                        name: "Profits",
                        data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
                    }],
                    grid: {
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: 'datetime',
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    labels: [
                        '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                    ],
                    colors: ["#206bc4"],
                    legend: {
                        show: false,
                    },
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
                    chart: {
                        type: "bar",
                        fontFamily: 'inherit',
                        height: 240,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: false
                        },
                        stacked: true,
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '50%',
                        }
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: [{
                        name: "Web",
                        data: [1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 2, 12, 5, 8, 22, 6, 8, 6, 4, 1, 8, 24, 29, 51, 40, 47, 23, 26, 50, 26, 41, 22, 46, 47, 81, 46, 6]
                    }, {
                        name: "Social",
                        data: [2, 5, 4, 3, 3, 1, 4, 7, 5, 1, 2, 5, 3, 2, 6, 7, 7, 1, 5, 5, 2, 12, 4, 6, 18, 3, 5, 2, 13, 15, 20, 47, 18, 15, 11, 10, 0]
                    }, {
                        name: "Other",
                        data: [2, 9, 1, 7, 8, 3, 6, 5, 5, 4, 6, 4, 1, 9, 3, 6, 7, 5, 2, 8, 4, 9, 1, 2, 6, 7, 5, 1, 8, 3, 2, 3, 4, 9, 7, 1, 6]
                    }],
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4
                        },
                        strokeDashArray: 4,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: 'datetime',
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    labels: [
                        '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20', '2020-07-21', '2020-07-22', '2020-07-23', '2020-07-24', '2020-07-25', '2020-07-26'
                    ],
                    colors: ["#206bc4", "#79a6dc", "#bfe399"],
                    legend: {
                        show: false,
                    },
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-activity'), {
                    chart: {
                        type: "radialBar",
                        fontFamily: 'inherit',
                        height: 40,
                        width: 40,
                        animations: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    plotOptions: {
                        radialBar: {
                            hollow: {
                                margin: 0,
                                size: '75%'
                            },
                            track: {
                                margin: 0
                            },
                            dataLabels: {
                                show: false
                            }
                        }
                    },
                    colors: ["#206bc4"],
                    series: [35],
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('chart-development-activity'), {
                    chart: {
                        type: "area",
                        fontFamily: 'inherit',
                        height: 192,
                        sparkline: {
                            enabled: true
                        },
                        animations: {
                            enabled: false
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        opacity: .16,
                        type: 'solid'
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                        name: "Purchases",
                        data: [3, 5, 4, 6, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 8, 4, 14, 30, 17, 19, 15, 14, 25, 32, 40, 55, 60, 48, 52, 70]
                    }],
                    grid: {
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false
                        },
                        axisBorder: {
                            show: false,
                        },
                        type: 'datetime',
                    },
                    yaxis: {
                        labels: {
                            padding: 4
                        },
                    },
                    labels: [
                        '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
                    ],
                    colors: ["#206bc4"],
                    legend: {
                        show: false,
                    },
                    point: {
                        show: false
                    },
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-1'), {
                    chart: {
                        type: "line",
                        fontFamily: 'inherit',
                        height: 24,
                        animations: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "#206bc4",
                        data: [17, 24, 20, 10, 5, 1, 4, 18, 13]
                    }],
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-2'), {
                    chart: {
                        type: "line",
                        fontFamily: 'inherit',
                        height: 24,
                        animations: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "#206bc4",
                        data: [13, 11, 19, 22, 12, 7, 14, 3, 21]
                    }],
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-3'), {
                    chart: {
                        type: "line",
                        fontFamily: 'inherit',
                        height: 24,
                        animations: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "#206bc4",
                        data: [10, 13, 10, 4, 17, 3, 23, 22, 19]
                    }],
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-4'), {
                    chart: {
                        type: "line",
                        fontFamily: 'inherit',
                        height: 24,
                        animations: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "#206bc4",
                        data: [6, 15, 13, 13, 5, 7, 17, 20, 19]
                    }],
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-5'), {
                    chart: {
                        type: "line",
                        fontFamily: 'inherit',
                        height: 24,
                        animations: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "#206bc4",
                        data: [2, 11, 15, 14, 21, 20, 8, 23, 18, 14]
                    }],
                })).render();
            });
            // @formatter:on
        </script>
        <script>
            // @formatter:off
            document.addEventListener("DOMContentLoaded", function() {
                window.ApexCharts && (new ApexCharts(document.getElementById('sparkline-bounce-rate-6'), {
                    chart: {
                        type: "line",
                        fontFamily: 'inherit',
                        height: 24,
                        animations: {
                            enabled: false
                        },
                        sparkline: {
                            enabled: true
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                    },
                    series: [{
                        color: "#206bc4",
                        data: [22, 12, 7, 14, 3, 21, 8, 23, 18, 14]
                    }],
                })).render();
            });
            // @formatter:on
        </script>

</body>

</html>