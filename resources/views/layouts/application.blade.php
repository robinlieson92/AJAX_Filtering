  <html>
    <head>
      <title>GeeksFarm Laravel Training</title>
      <link rel="SHORTCUT ICON" href="/logo.png" type="image/x-icon">
      <link href="/assets/css/bootstrap/bootstrap.css" rel="stylesheet">
      <link href="/assets/css/material-design/bootstrap-material-design.css" rel="stylesheet">
      <link href="/assets/css/material-design/ripples.css" rel="stylesheet">
      <link href="/assets/css/custom/layout.css" rel="stylesheet">
    </head>
    <body>
      <!--bagian navigation-->
      @include('shared.head_nav')
      <!-- Bagian Content -->
      <div class="container clearfix">
        <div class="row row-offcanvas row-offcanvas-left ">
          <!--Bagian Kiri-->
          @include("shared.left_nav")

          <!--Bagian Kanan-->
          <div id="main-content" class="col-xs-9 col-sm-9 main pull-right">
            <div class="panel-body">
              @if (Session::has('error'))
                <div class="session-flash alert alert-danger">
                    {{Session::get('error')}}
                </div>
              @endif
              @if (Session::has('notice'))
                <div class="session-flash alert alert-info">
                    {{Session::get('notice')}}
                </div>
              @endif
              @yield("content")
            </div>
          </div>
        </div>
      </div>
      <script src="/assets/js/jquery/jquery-1.11.1.min.js"></script>
      <script src="/assets/js/bootstrap/bootstrap.js"></script>
      <script src="/assets/js/material-design/material.js"></script>
      <script src="/assets/js/material-design/ripples.js"></script>
      <script src="/assets/js/masonry/masonry.pkgd.min.js"></script>
      <script src="/assets/js/custom/layout.js"></script>      
    </body>
  </html>