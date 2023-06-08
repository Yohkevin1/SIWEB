<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <!-- Card -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Primary Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Warning Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Success Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Danger Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->

            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Grafik Transaksi Penjualan
                            <div class="col-sm-2 mt-3">
                                <input type="number" id="tahun-trans" class="form-control" value="<?= date('Y') ?>" onchange="chartTransaksi()">
                            </div>
                        </div>
                        <div class="card-body"><canvas id="chartTransaksi" width="100%" height="40"></canvas></div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary btn-sm" onclick="downloadChartTrans('PDF')">Unduh PDF</button>
                            <a id="download-trans" download="chart-transaksi.png">
                                <button class="btn btn-outline-secondary btn-sm" onclick="downloadChartTrans('PNG')">Unduh PNG</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class=" col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Grafik Customer
                            <div class="col-sm-2 mt-3">
                                <input type="number" id="tahun-cust" class="form-control" value="<?= date('Y') ?>" onchange="chartCust()">
                            </div>
                        </div>
                        <div class="card-body"><canvas id="chartCust" width="100%" height="40"></canvas></div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary btn-sm" onclick="downloadChartCust('PDF')">Unduh PDF</button>
                            <a id="download-cust" download="chart-Customer.png">
                                <button class="btn btn-outline-secondary btn-sm" onclick="downloadChartCust('PNG')">Unduh PNG</button>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Grafik Transaksi pembelian
                            <div class="col-sm-2 mt-3">
                                <input type="number" id="tahun-beli" class="form-control" value="<?= date('Y') ?>" onchange="chartPembelian()">
                            </div>
                        </div>
                        <div class="card-body"><canvas id="chartPembelian" width="100%" height="40"></canvas></div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary btn-sm" onclick="downloadChartBeli('PDF')">Unduh PDF</button>
                            <a id="download-Beli" download="chart-Pembelian.png">
                                <button class="btn btn-outline-secondary btn-sm" onclick="downloadChartBeli('PNG')">Unduh PNG</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Grafik Supplier
                            <div class="col-sm-2 mt-3">
                                <input type="number" id="tahun-supp" class="form-control" value="<?= date('Y') ?>" onchange="chartSupp()">
                            </div>
                        </div>
                        <div class="card-body"><canvas id="chartSupp" width="100%" height="40"></canvas></div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-outline-primary btn-sm" onclick="downloadChartSupp('PDF')">Unduh PDF</button>
                            <a id="download-Supp" download="chart-Supplier.png">
                                <button class="btn btn-outline-secondary btn-sm" onclick="downloadChartSupp('PNG')">Unduh PNG</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DataTable Contoh -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>$170,750</td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>$86,000</td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                            </tr>
                            <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>$162,700</td>
                            </tr>
                            <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012/12/02</td>
                                <td>$372,000</td>
                            </tr>
                            <tr>
                                <td>Herrod Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td>59</td>
                                <td>2012/08/06</td>
                                <td>$137,500</td>
                            </tr>
                            <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td>2010/10/14</td>
                                <td>$327,900</td>
                            </tr>
                            <tr>
                                <td>Colleen Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td>39</td>
                                <td>2009/09/15</td>
                                <td>$205,500</td>
                            </tr>
                            <tr>
                                <td>Sonya Frost</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>23</td>
                                <td>2008/12/13</td>
                                <td>$103,600</td>
                            </tr>
                            <tr>
                                <td>Jena Gaines</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>30</td>
                                <td>2008/12/19</td>
                                <td>$90,560</td>
                            </tr>
                            <tr>
                                <td>Quinn Flynn</td>
                                <td>Support Lead</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2013/03/03</td>
                                <td>$342,000</td>
                            </tr>
                            <tr>
                                <td>Charde Marshall</td>
                                <td>Regional Director</td>
                                <td>San Francisco</td>
                                <td>36</td>
                                <td>2008/10/16</td>
                                <td>$470,600</td>
                            </tr>
                            <tr>
                                <td>Haley Kennedy</td>
                                <td>Senior Marketing Designer</td>
                                <td>London</td>
                                <td>43</td>
                                <td>2012/12/18</td>
                                <td>$313,500</td>
                            </tr>
                            <tr>
                                <td>Tatyana Fitzpatrick</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>19</td>
                                <td>2010/03/17</td>
                                <td>$385,750</td>
                            </tr>
                            <tr>
                                <td>Michael Silva</td>
                                <td>Marketing Designer</td>
                                <td>London</td>
                                <td>66</td>
                                <td>2012/11/27</td>
                                <td>$198,500</td>
                            </tr>
                            <tr>
                                <td>Paul Byrd</td>
                                <td>Chief Financial Officer (CFO)</td>
                                <td>New York</td>
                                <td>64</td>
                                <td>2010/06/09</td>
                                <td>$725,000</td>
                            </tr>
                            <tr>
                                <td>Gloria Little</td>
                                <td>Systems Administrator</td>
                                <td>New York</td>
                                <td>59</td>
                                <td>2009/04/10</td>
                                <td>$237,500</td>
                            </tr>
                            <tr>
                                <td>Bradley Greer</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>41</td>
                                <td>2012/10/13</td>
                                <td>$132,000</td>
                            </tr>
                            <tr>
                                <td>Dai Rios</td>
                                <td>Personnel Lead</td>
                                <td>Edinburgh</td>
                                <td>35</td>
                                <td>2012/09/26</td>
                                <td>$217,500</td>
                            </tr>
                            <tr>
                                <td>Jenette Caldwell</td>
                                <td>Development Lead</td>
                                <td>New York</td>
                                <td>30</td>
                                <td>2011/09/03</td>
                                <td>$345,000</td>
                            </tr>
                            <tr>
                                <td>Yuri Berry</td>
                                <td>Chief Marketing Officer (CMO)</td>
                                <td>New York</td>
                                <td>40</td>
                                <td>2009/06/25</td>
                                <td>$675,000</td>
                            </tr>
                            <tr>
                                <td>Caesar Vance</td>
                                <td>Pre-Sales Support</td>
                                <td>New York</td>
                                <td>21</td>
                                <td>2011/12/12</td>
                                <td>$106,450</td>
                            </tr>
                            <tr>
                                <td>Doris Wilder</td>
                                <td>Sales Assistant</td>
                                <td>Sidney</td>
                                <td>23</td>
                                <td>2010/09/20</td>
                                <td>$85,600</td>
                            </tr>
                            <tr>
                                <td>Angelica Ramos</td>
                                <td>Chief Executive Officer (CEO)</td>
                                <td>London</td>
                                <td>47</td>
                                <td>2009/10/09</td>
                                <td>$1,200,000</td>
                            </tr>
                            <tr>
                                <td>Gavin Joyce</td>
                                <td>Developer</td>
                                <td>Edinburgh</td>
                                <td>42</td>
                                <td>2010/12/22</td>
                                <td>$92,575</td>
                            </tr>
                            <tr>
                                <td>Jennifer Chang</td>
                                <td>Regional Director</td>
                                <td>Singapore</td>
                                <td>28</td>
                                <td>2010/11/14</td>
                                <td>$357,650</td>
                            </tr>
                            <tr>
                                <td>Brenden Wagner</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>28</td>
                                <td>2011/06/07</td>
                                <td>$206,850</td>
                            </tr>
                            <tr>
                                <td>Fiona Green</td>
                                <td>Chief Operating Officer (COO)</td>
                                <td>San Francisco</td>
                                <td>48</td>
                                <td>2010/03/11</td>
                                <td>$850,000</td>
                            </tr>
                            <tr>
                                <td>Shou Itou</td>
                                <td>Regional Marketing</td>
                                <td>Tokyo</td>
                                <td>20</td>
                                <td>2011/08/14</td>
                                <td>$163,000</td>
                            </tr>
                            <tr>
                                <td>Michelle House</td>
                                <td>Integration Specialist</td>
                                <td>Sidney</td>
                                <td>37</td>
                                <td>2011/06/02</td>
                                <td>$95,400</td>
                            </tr>
                            <tr>
                                <td>Suki Burks</td>
                                <td>Developer</td>
                                <td>London</td>
                                <td>53</td>
                                <td>2009/10/22</td>
                                <td>$114,500</td>
                            </tr>
                            <tr>
                                <td>Prescott Bartlett</td>
                                <td>Technical Author</td>
                                <td>London</td>
                                <td>27</td>
                                <td>2011/05/07</td>
                                <td>$145,000</td>
                            </tr>
                            <tr>
                                <td>Gavin Cortez</td>
                                <td>Team Leader</td>
                                <td>San Francisco</td>
                                <td>22</td>
                                <td>2008/10/26</td>
                                <td>$235,500</td>
                            </tr>
                            <tr>
                                <td>Martena Mccray</td>
                                <td>Post-Sales support</td>
                                <td>Edinburgh</td>
                                <td>46</td>
                                <td>2011/03/09</td>
                                <td>$324,050</td>
                            </tr>
                            <tr>
                                <td>Unity Butler</td>
                                <td>Marketing Designer</td>
                                <td>San Francisco</td>
                                <td>47</td>
                                <td>2009/12/09</td>
                                <td>$85,675</td>
                            </tr>
                            <tr>
                                <td>Howard Hatfield</td>
                                <td>Office Manager</td>
                                <td>San Francisco</td>
                                <td>51</td>
                                <td>2008/12/16</td>
                                <td>$164,500</td>
                            </tr>
                            <tr>
                                <td>Hope Fuentes</td>
                                <td>Secretary</td>
                                <td>San Francisco</td>
                                <td>41</td>
                                <td>2010/02/12</td>
                                <td>$109,850</td>
                            </tr>
                            <tr>
                                <td>Vivian Harrell</td>
                                <td>Financial Controller</td>
                                <td>San Francisco</td>
                                <td>62</td>
                                <td>2009/02/14</td>
                                <td>$452,500</td>
                            </tr>
                            <tr>
                                <td>Timothy Mooney</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>37</td>
                                <td>2008/12/11</td>
                                <td>$136,200</td>
                            </tr>
                            <tr>
                                <td>Jackson Bradshaw</td>
                                <td>Director</td>
                                <td>New York</td>
                                <td>65</td>
                                <td>2008/09/26</td>
                                <td>$645,750</td>
                            </tr>
                            <tr>
                                <td>Olivia Liang</td>
                                <td>Support Engineer</td>
                                <td>Singapore</td>
                                <td>64</td>
                                <td>2011/02/03</td>
                                <td>$234,500</td>
                            </tr>
                            <tr>
                                <td>Bruno Nash</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>38</td>
                                <td>2011/05/03</td>
                                <td>$163,500</td>
                            </tr>
                            <tr>
                                <td>Sakura Yamamoto</td>
                                <td>Support Engineer</td>
                                <td>Tokyo</td>
                                <td>37</td>
                                <td>2009/08/19</td>
                                <td>$139,575</td>
                            </tr>
                            <tr>
                                <td>Thor Walton</td>
                                <td>Developer</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2013/08/11</td>
                                <td>$98,540</td>
                            </tr>
                            <tr>
                                <td>Finn Camacho</td>
                                <td>Support Engineer</td>
                                <td>San Francisco</td>
                                <td>47</td>
                                <td>2009/07/07</td>
                                <td>$87,500</td>
                            </tr>
                            <tr>
                                <td>Serge Baldwin</td>
                                <td>Data Coordinator</td>
                                <td>Singapore</td>
                                <td>64</td>
                                <td>2012/04/09</td>
                                <td>$138,575</td>
                            </tr>
                            <tr>
                                <td>Zenaida Frank</td>
                                <td>Software Engineer</td>
                                <td>New York</td>
                                <td>63</td>
                                <td>2010/01/04</td>
                                <td>$125,250</td>
                            </tr>
                            <tr>
                                <td>Zorita Serrano</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>56</td>
                                <td>2012/06/01</td>
                                <td>$115,000</td>
                            </tr>
                            <tr>
                                <td>Jennifer Acosta</td>
                                <td>Junior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>43</td>
                                <td>2013/02/01</td>
                                <td>$75,650</td>
                            </tr>
                            <tr>
                                <td>Cara Stevens</td>
                                <td>Sales Assistant</td>
                                <td>New York</td>
                                <td>46</td>
                                <td>2011/12/06</td>
                                <td>$145,600</td>
                            </tr>
                            <tr>
                                <td>Hermione Butler</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>47</td>
                                <td>2011/03/21</td>
                                <td>$356,250</td>
                            </tr>
                            <tr>
                                <td>Lael Greer</td>
                                <td>Systems Administrator</td>
                                <td>London</td>
                                <td>21</td>
                                <td>2009/02/27</td>
                                <td>$103,500</td>
                            </tr>
                            <tr>
                                <td>Jonas Alexander</td>
                                <td>Developer</td>
                                <td>San Francisco</td>
                                <td>30</td>
                                <td>2010/07/14</td>
                                <td>$86,500</td>
                            </tr>
                            <tr>
                                <td>Shad Decker</td>
                                <td>Regional Director</td>
                                <td>Edinburgh</td>
                                <td>51</td>
                                <td>2008/11/13</td>
                                <td>$183,000</td>
                            </tr>
                            <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                                <td>29</td>
                                <td>2011/06/27</td>
                                <td>$183,000</td>
                            </tr>
                            <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>27</td>
                                <td>2011/01/25</td>
                                <td>$112,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--  -->
        </div>
    </main>
    <script>
        $(document).ready(function() {
            chartTransaksi()
            chartCust();
            chartSupp();
            chartPembelian();
        })
        // Area Chart Example
        function setLineChart(dataset) {
            var ctx = document.getElementById("chartTransaksi");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "April", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
                    datasets: [{
                        label: "Total",
                        lineTension: 0.3,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: dataset,
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }

        function chartTransaksi() {
            // console.log('run');
            var tahun = $('#tahun-trans').val();
            $.ajax({
                url: "/chart-trans",
                method: "POST",
                data: {
                    'tahun': tahun,
                },
                success: function(response) {
                    var result = JSON.parse(response)
                    // console.log(result);
                    dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                    $.each(result.data, function(i, val) {
                        dataset[val.month - 1] = val.Total
                    });
                    setLineChart(dataset)
                }
            })
        }

        // Bar Chart Example
        function setBarChart(dataset) {
            var ctx = document.getElementById("chartCust");
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Jan", "Feb", "Mar", "April", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
                    datasets: [{
                        label: "Jumlah",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: dataset,
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }

        function chartCust() {
            console.log('run');
            var tahun = $('#tahun-cust').val();
            $.ajax({
                url: "/chart-cust",
                method: "POST",
                data: {
                    'tahun': tahun,
                },
                success: function(response) {
                    var result = JSON.parse(response)
                    console.log(result);
                    dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                    $.each(result.data, function(i, val) {
                        dataset[val.month - 1] = val.Total
                    });
                    setBarChart(dataset)
                }
            })
        }

        function setPieChartBeli(dataset) {
            var ctx = document.getElementById("chartPembelian");
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ["Jan", "Feb", "Mar", "April", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
                    datasets: [{
                        data: dataset,
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#116A7B', '#FFCDA8', '#40128B', '#F6FA70',
                            '#E55807', '#98EECC', '#A459D1', '#99627A'
                        ],
                    }],
                },
            });
        }

        function chartPembelian() {
            // console.log('run');
            var tahun = $('#tahun-beli').val();
            $.ajax({
                url: "/chart-beli",
                method: "POST",
                data: {
                    'tahun': tahun,
                },
                success: function(response) {
                    var result = JSON.parse(response)
                    // console.log(result);
                    dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                    $.each(result.data, function(i, val) {
                        dataset[val.month - 1] = val.Total
                    });
                    setPieChartBeli(dataset)
                }
            })
        }

        // Bar Chart Example
        function setBarChartSupp(dataset) {
            var ctx = document.getElementById("chartSupp");
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Jan", "Feb", "Mar", "April", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
                    datasets: [{
                        label: "Jumlah",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: dataset,
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                    },
                    legend: {
                        display: false
                    }
                }
            });
        }

        function chartSupp() {
            console.log('run');
            var tahun = $('#tahun-supp').val();
            $.ajax({
                url: "/chart-supp",
                method: "POST",
                data: {
                    'tahun': tahun,
                },
                success: function(response) {
                    var result = JSON.parse(response)
                    console.log(result);
                    dataset = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                    $.each(result.data, function(i, val) {
                        dataset[val.month - 1] = val.Total
                    });
                    setBarChartSupp(dataset)
                }
            })
        }

        function downloadChartIMG(download, chart) {
            var img = chart.toDataURL("image/jpg", 1.0).replace("image/jpg", "image/octet-stream")
            download.setAttribute("href", img)
        }

        function downloadChartPDF(chart, name) {
            html2canvas(chart, {
                onrendered: function(canvas) {
                    var img = canvas.toDataURL("image/jpg", 1.0)
                    var doc = new jsPDF('p', 'pt', 'A4')
                    var lebarKonten = canvas.width
                    var tinggiKonten = canvas.height
                    var tinggiPage = lebarKonten / 592.28 * 841.89
                    var leftHeight = tinggiKonten
                    var Position = 0
                    var imgWidth = 595.28
                    var imgHegiht = 592.28 / lebarKonten * tinggiKonten
                    if (leftHeight < tinggiPage) {
                        doc.addImage(img, 'PNG', 0, 0, imgWidth, imgHegiht)
                    } else {
                        while (leftHeight > 0) {
                            doc.addImage(img, 'PNG', 0, Position, imgWidth, imgHegiht)
                            leftHeight -= tinggiPage
                            Position -= 841.89
                            if (leftHeight > 0) {
                                pdf.addPage()
                            }
                        }
                    }
                    doc.save(name)
                }
            })
        }

        function downloadChartTrans(type) {
            var download = document.getElementById('download-trans')
            var chart = document.getElementById('chartTransaksi')
            if (type == "PNG") {
                downloadChartIMG(download, chart)
            } else {
                downloadChartPDF(chart, "Chart-Penjualan.pdf")
            }
        }

        function downloadChartCust(type) {
            var download = document.getElementById('download-cust')
            var chart = document.getElementById('chartCust')
            if (type == "PNG") {
                downloadChartIMG(download, chart)
            } else {
                downloadChartPDF(chart, "Chart-Customer.pdf")
            }
        }

        function downloadChartBeli(type) {
            var download = document.getElementById('download-Beli')
            var chart = document.getElementById('chartPembelian')
            if (type == "PNG") {
                downloadChartIMG(download, chart)
            } else {
                downloadChartPDF(chart, "Chart-Pembelian.pdf")
            }
        }

        function downloadChartSupp(type) {
            var download = document.getElementById('download-Supp')
            var chart = document.getElementById('chartSupp')
            if (type == "PNG") {
                downloadChartIMG(download, chart)
            } else {
                downloadChartPDF(chart, "Chart-Supplier.pdf")
            }
        }
    </script>
    <?= $this->endsection() ?>