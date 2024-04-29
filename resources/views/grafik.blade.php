@extends('template.layout')

@push('style')
    <!-- Tambahkan style khusus di sini jika diperlukan -->
@endpush

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row" style="display: inline-block;">
            <div class="top_tiles">
            <div class="header">
              <p style="font-size: 30px;"><strong>Halo, Selamat datang di JCafe</strong> </br></p></div>
              <div class="animated flipInY col-lg-4  col-md-3 col-sm-6 ">
                <div class="tile-stats">
                <div class="icon"><i class="fa fa-utensils"></i></div>
                  <div class="count">{{$count_menu}}</div>
                  <h3>Menu</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-3 col-sm-5 ">
                <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count">{{$count_pelanggan}}</div>
                  <h3>Pelanggan</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                <div class="icon"><i class="fa fa-credit-card"></i></div>
                  <div class="count">{{$count_transaksi}}</div>
                  <h3>Transaksi</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-3 col-sm-6 ">
                <div class="tile-stats">
                <div class="icon"><i class="fa fa-money-bill-wave"></i></div>
                  <div class="count" style="font-size: 30px;">Rp. {{ number_format($pendapatan, 0, ',', '.') }}</div>
                  <h3>Pendapatan</h3>
                </div>
              </div>
            </div>
          </div>

            <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Grafik Transaksi <small>Weekly progress</small></h2>
                        <div class="filter" >
                            <!-- Elemen input tanggal -->
                            <form action="{{ route('grafik.index') }}" method="GET">
                                <label for="tanggal_mulai">Tanggal Mulai : </label>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai">

                                <label for="tanggal_selesai">Tanggal Selesai: </label>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai">
                                <button type="submit">Filter</button>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-9 col-sm-12">

                            <!-- Grafik dan data lainnya -->
                            <div class="demo-container" style="height:280px">
                                <div id="chart_plot_02" class="demo-placeholder"></div>
                            </div>
                            <div class="tiles">
                                <div class="col-md-4 tile">
                                    <span>Total Transaksi</span>
                                    <h2>{{ $count_transaksi }}</h2>
                                    <span class="sparkline11 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>
                                </div>
                                <div class="col-md-4 tile">
                                    <span>Total Pendapatan</span>
                                    <h2>Rp. {{ number_format($pendapatan, 0, ',', '.') }}</h2>
                                    <span class="sparkline22 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>
                                </div>
                                <div class="col-md-4 tile">
                                    <span>Total Pelanggan</span>
                                    <h2>{{ $count_pelanggan }}</h2>
                                    <span class="sparkline11 graph" style="height: 160px;">
                                        <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                    </span>
                                </div>
                            </div>
                        </div>


                      <!-- jumlah penjualan teratas -->
                    <div class="col-md-3 col-sm-12 ">
                      <div>
                        <div class="x_title">
                          <h2>Top 5 Penjualan</h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                          </ul>
                          <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles scroll-view">
                        @foreach ($detail_transaksi  as $p)
                        <li class="media event">
                            <a>
                            <img width="70px" src="{{asset('image')}}/{{ $p->menu-> image }}" alt="" style="margin-right: 20px;">
                            </a>
                            <div class="media-body">
                              <a class="title" style="font-size: 18px;">Menu : {{ $p->menu->nama_menu}}</a>
                              <p style="font-size: 14px;"><strong> Harga : Rp. {{ number_format($p->menu->harga, 0, ',', '.') }}</strong></p>
                              </p>
                            </div>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>

                      
                  </div>
                  <!-- jumlah pelanggan teratas -->
                  <div class="col-md-4 col-sm-12 ">
                      <div>
                      <div class="x_panel">
                        <div class="x_title">
                                <h2>Top 5 Pelanggan</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                                  </li>
                                </ul>
                                <div class="clearfix"></div>
                              </div>
                              <ul class="list-unstyled top_profiles scroll-view">
                              @foreach ($pelanggan  as $p)
                              <li class="media event">
                                  <a class="pull-left border-aero profile_thumb">
                                    <i class="fa fa-user aero"></i>
                                  </a>
                                  <div class="media-body">
                                    <a class="title" >{{ $p->nama }}</a>
                                    <p><strong>{{ $p->email }}</strong><strong> | +{{ $p->no_tlp }}</strong></p>
                                    <p> <medium>{{ $p->alamat }}</medium>
                                    </p>
                                  </div>
                                </li>
                                @endforeach
                              </ul>
                        </div>
                      </div>
                    </div>

                      <!-- <div class="row">
                        <div class="col-md-12">
                          <div class="x_panel">
                            <div class="x_title">
                              <h2>Weekly Summary <small>Activity shares</small></h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="#">Settings 1</a>
                                      <a class="dropdown-item" href="#">Settings 2</a>
                                    </div>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                              <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                                <div class="col-md-7" style="overflow:hidden;">
                                  <span class="sparkline_one" style="height: 160px; padding: 10px 25px;">
                                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                            </span>
                                  <h4 style="margin:18px">Weekly sales progress</h4>
                                </div>

                                <div class="col-md-5">
                                  <div class="row" style="text-align: center;">
                                    <div class="col-md-4">
                                      <canvas class="canvasDoughnut" height="110" width="110" style="margin: 5px 10px 10px 0"></canvas>
                                      <h4 style="margin:0">Bounce Rates</h4>
                                    </div>
                                    <div class="col-md-4">
                                      <canvas class="canvasDoughnut" height="110" width="110" style="margin: 5px 10px 10px 0"></canvas>
                                      <h4 style="margin:0">New Traffic</h4>
                                    </div>
                                    <div class="col-md-4">
                                      <canvas class="canvasDoughnut" height="110" width="110" style="margin: 5px 10px 10px 0"></canvas>
                                      <h4 style="margin:0">Device Share</h4>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->


                        <!-- jumlah stok terendah -->
                        <div class="col-md-4 col-sm-12 ">
                          <div>
                          <div class="x_panel">
                            <div class="x_title">
                                    <h2>Stok Menu</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                      </li>
                                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                                      </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                  </div>
                                  <ul class="list-unstyled top_profiles scroll-view">
                                  @foreach ($stok  as $p)
                                  <li class="media event">
                                  <a>
                                      <img width="70px" src="{{asset('image')}}/{{ $p->menu-> image }}" alt="" style="margin-right: 20px;">
                                      </a>
                                      <div class="media-body">
                                        <a class="title" style="font-size: 18px;">Menu : {{ $p->menu->nama_menu}}</a>
                                        <p style="font-size: 14px;"><strong>Stok : {{ $p->jumlah }}</strong></p>
                                      </div>
                                    </li>
                                    @endforeach
                                  </ul>
                            </div>
                          </div>
                        </div>


                        <!-- jumlah penjualan teratas -->
                        <div class="col-md-4 col-sm-12 ">
                          <div>
                          <div class="x_panel">
                            <div class="x_title">
                                    <h2>Transaksi Terakhir</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                      </li>
                                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                                      </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                  </div>
                                  <ul class="list-unstyled top_profiles scroll-view">
                                  @foreach ($transaksi  as $p)
                                  <li class="media event">
                                  <a>
                                      <img width="70px" src="{{asset('image')}}/{{ $p->menu-> image }}" alt="" style="margin-right: 20px;">
                                      </a>
                                      <div class="media-body">
                                        <a class="title" style="font-size: 18px;">{{ $p->menu->nama_menu }}</a>
                                        <p style="font-size: 14px;"><strong>Rp. {{ number_format($p->transaksi->total_harga, 0, ',', '.') }}</strong></p>
                                      </div>
                                    </li>
                                    @endforeach
                                  </ul>
                            </div>
                          </div>
                        </div>

                        <!-- <div class="col-md-4">
                          <div class="x_panel">
                            <div class="x_title">
                              <h2>Top Profiles <small>Sessions</small></h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="#">Settings 1</a>
                                      <a class="dropdown-item" href="#">Settings 2</a>
                                    </div>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              ul class="list-unstyled top_profiles scroll-view">
                                  @foreach ($transaksi  as $p)
                                  <li class="media event">
                                  <a>
                                      <img width="70px" src="{{asset('image')}}/{{ $p->menu-> image }}" alt="" style="margin-right: 20px;">
                                      </a>
                                      <div class="media-body">
                                        <a class="title" >{{ $p->menu->nama_menu }}</a>
                                        <p><strong>Rp. {{ number_format($p->transaksi->total_harga, 0, ',', '.') }}</strong></p>
                                      </div>
                                    </li>
                                    @endforeach
                                  </ul>

                            </div>
                          </div>
                        </div> -->

                        <!-- <div class="col-md-4">
                          <div class="x_panel">
                            <div class="x_title">
                              <h2>Top Profiles <small>Sessions</small></h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="#">Settings 1</a>
                                      <a class="dropdown-item" href="#">Settings 2</a>
                                    </div>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              <article class="media event">
                                <a class="pull-left date">
                                  <p class="month">April</p>
                                  <p class="day">23</p>
                                </a>
                                <div class="media-body">
                                  <a class="title" href="#">Item One Title</a>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                              </article>
                              <article class="media event">
                                <a class="pull-left date">
                                  <p class="month">April</p>
                                  <p class="day">23</p>
                                </a>
                                <div class="media-body">
                                  <a class="title" href="#">Item Two Title</a>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                              </article>
                              <article class="media event">
                                <a class="pull-left date">
                                  <p class="month">April</p>
                                  <p class="day">23</p>
                                </a>
                                <div class="media-body">
                                  <a class="title" href="#">Item Two Title</a>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                              </article>
                              <article class="media event">
                                <a class="pull-left date">
                                  <p class="month">April</p>
                                  <p class="day">23</p>
                                </a>
                                <div class="media-body">
                                  <a class="title" href="#">Item Two Title</a>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                              </article>
                              <article class="media event">
                                <a class="pull-left date">
                                  <p class="month">April</p>
                                  <p class="day">23</p>
                                </a>
                                <div class="media-body">
                                  <a class="title" href="#">Item Three Title</a>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                              </article>
                            </div>
                          </div>
                        </div> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>



            
        <!-- /page content -->
        
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('chart_transaksi').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: json_encode($labels),
            datasets: [{
                label: 'Jumlah Transaksi',
                data: json_encode($data),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
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
@endpush