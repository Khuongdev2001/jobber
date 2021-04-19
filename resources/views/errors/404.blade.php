@extends("employer.master.layout")
@section("header")
    @include("employer.include.header")
@endsection
@section("content")
<section class="space-ptb">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <img class="img-fluid" src="{{ asset("errors/404/error-img.png") }}" alt="Lỗi 404">
        </div>
        <div class="col-lg-6 col-md-6 mt-4 mt-sm-0 text-center">
          <div id="notfound">
            <div class="notfound">
              <div class="notfound-404">
                <h1>Oops!</h1>
              </div>
              <h2>404 - Page not found</h2>
              <p>Trang bạn yêu cầu không có</p>
              <a class="btn btn-primary" href="javascript:void(0)" onclick="window.history.back()">Quay về</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=================================
  404 error -->
 
@endsection