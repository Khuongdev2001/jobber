@extends("admin.master.layout")
@section('title', 'Trang đăng nhập')
@section('css')
    {{-- require css more --}}
@endsection

@section('js')
    {{-- require js more --}}
    <script>
			(function () {
			  'use strict'	
			  var forms = document.querySelectorAll('.needs-validation')	
			  // Loop over them and prevent submission
			  Array.prototype.slice.call(forms)
				.forEach(function (form) {
				  form.addEventListener('submit', function (event) {
					if (!form.checkValidity()) {
					  event.preventDefault()
					  event.stopPropagation()
					}	
					form.classList.add('was-validated')
				  }, false)
				})
			})()
	</script>

@endsection()


@section('sidebar')@endsection

@section('header')@endsection

@section('content')
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Jobber Login</h3>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" action="{{ route("admin.user.login") }}" method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="User_Email" class="form-label">Email:</label>
                                            <input type="email" class="form-control needs-validation" id="User_Email" name="User_Email" value="{{ old("User_Email") }}" placeholder="Nhập địa chỉ Email... ">
                                        </div>
                                        <div class="col-12">
                                            <label for="User_Password" class="form-label">Mật khẩu:</label>
                                            <div class="input-group" id="User_Password">
                                                <input type="password" class="form-control border-end-0 needs-validation" id="User_Password" name="User_Password" value="{{ old("User_Password") }}" placeholder="Nhập Mật khẩu... ">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-light"><i class="bx bxs-lock-open"></i>Đăng nhập</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')@endsection
