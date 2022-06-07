<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <title>Data Mahasiswa</title>
</head>

<body>
    <h2 class="text-danger mx-4 mt-5">Data Mahasiswa</h2>
    <div class="mx-4 mt-3 mb-5">
        <div class="card">
            <span class="border-danger border-top border-5 rounded-top"></span>
            <div class="card-body">
                <table id="tabel-data" class="table table-striped" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jurusan</th>
                            <th>Nilai IPK</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="card mt-3">
            <span class="border-danger border-top border-5 rounded-top"></span>
            <div class="card-body row">
                <div id="bar-chart" class="col-md-6"></div>
                <div id="pie-chart" class="col-md-6"></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        $(document).ready(function() {
            const dTable = $('#tabel-data').DataTable({
                "sAjaxSource": "http://localhost/test/phprestapi.php?function=get_mahasiswa",
                columnDefs: [{
                    targets: 0,
                    type: "date-eu"
                }],
                "scrollX": true,
                "columns": [{
                        "data": "nama"
                    },
                    {
                        "data": "alamat"
                    },
                    {
                        "data": "jurusan"
                    },
                    {
                        "data": "nilai_ipk"
                    },
                    {
                        "data": "grade"
                    }
                ],
            });

            const tableData = getTableData(dTable);
            createHighCharts(tableData);
            setTableEvents(dTable);
        });

        function getTableData(dTable) {
            const dataArray = [],
                nama = [],
                alamat = [],
                jurusan = [],
                nilai_ipk = [],
                grade = [];
            dTable.rows({
                search: "applied"
            }).every(function() {
                const data = this.data();
                nama.push(data['nama']);
                alamat.push(data['alamat']);
                jurusan.push(data['jurusan']);
                nilai_ipk.push(parseFloat(data['nilai_ipk']));
                grade.push(data['grade']);
            });

            dataArray.push(nama, alamat, jurusan, nilai_ipk, grade);
            return dataArray;
        }

        function createHighCharts(data) {
            const memuaskan = data[3].filter(x => x >= 2.00 && x <= 2.75).length;
            const sangat_memuaskan = data[3].filter(x => x > 2.75 && x <= 3.50).length;
            const cum_laude = data[3].filter(x => x > 3.50 && x <= 4.00).length;

            Highcharts.chart("bar-chart", {
                title: {
                    text: "Grade Bar Chart"
                },
                subtitle: {
                    text: ""
                },
                xAxis: [{
                    categories: ['Memuaskan', 'Sangat Memuaskan', 'Cum Laude'],
                    labels: {
                        rotation: -45
                    }
                }],
                yAxis: [{
                    title: {
                        text: "Orang"
                    }
                }],
                series: [{
                    name: "Target Time",
                    color: "maroon",
                    type: "bar",
                    data: [memuaskan, sangat_memuaskan, cum_laude]
                }],
                credits: {
                    enabled: false
                }
            });

            Highcharts.chart("pie-chart", {
                title: {
                    text: "Grade Pie Chart"
                },
                subtitle: {
                    text: ""
                },
                series: [{
                    name: "Orang",
                    colorByPoint: true,
                    type: "pie",
                    data: [{
                            name: "Memuaskan",
                            y: memuaskan
                        },
                        {
                            name: "Sangat Memuaskan",
                            y: sangat_memuaskan
                        },
                        {
                            name: "Cum Laude",
                            y: cum_laude
                        }
                    ]
                }],
                credits: {
                    enabled: false
                }
            });
        }

        let draw = false;

        function setTableEvents(dTable) {
            dTable.on("page", () => {
                draw = true;
            });
            dTable.on("draw", () => {
                if (draw) {
                    draw = false;
                } else {
                    const tableData = getTableData(dTable);
                    createHighCharts(tableData);
                }
            });
        }
    </script>
</body>

</html>