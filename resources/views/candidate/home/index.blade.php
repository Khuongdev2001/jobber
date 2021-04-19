@extends("candidate.master.index")
@section("title","Việc làm")
@section("css")
@endsection
@section("js")
<script>
    const baseUrl="test";
    const baseAsset="{{ asset("") }}";    
</script>
<script src="{{ asset("candidate/js/home.js") }}"></script>
@endsection
@section("content")
<section class="category section bg-gray">
    <div class="container">
        <div id="carousel-area">
            <div id="banner-slider" class="carousel slide carousel-fadeOut" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#banner-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#banner-slider" data-slide-to="1"></li>
                    <li data-target="#banner-slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item" data-wow-delay="1s">
                        <img class="lazy" src="https://static.topcv.vn/img/ila-tuyen-dung.png" alt="test">
                    </div>
                    <div class="carousel-item active" data-wow-delay="1s">
                        <img class="lazy" src="https://static.topcv.vn/img/edupia-tuyen-dung-chuyen-vien-telesales-tu-van.jpg" alt="test">
                    </div>
                    <div class="carousel-item" data-wow-delay="1s">
                        <img class="lazy" src="https://static.topcv.vn/img/novaon-tuyen-dung-telesale.jpg" alt="test">
                    </div>                    
                </div>
                <a class="carousel-control-prev" href="#banner-slider" role="button" data-slide="prev">
                    <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-left"></i></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#banner-slider" role="button" data-slide="next">
                    <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-right"></i></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>
<section id="featured" class="section job-good">
    <div class="container">
        <div class="section-header mb-0">
            <h2 class="section-title text-left">VIỆC LÀM TỐT NHẤT</h2>
        </div>
        <div id="carousel-area" class="unset">
            <div id="recruitment-slider" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#recruitment-slider" data-slide-to="0" class="active"></li>
                </ol>
                <div class="carousel-inner overflow-unset" role="listbox">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="job-featured">
                                    <div class="job clearfix">
                                        <div class="avatar"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                        <div class="line"></div>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <a href="{{ route("job",["type"=>2]) }}" class="btn btn-common">Xem tất cả</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#recruitment-slider" role="button" data-slide="prev">
                <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-left"></i></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#recruitment-slider" role="button" data-slide="next">
                <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-right"></i></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>
<div id="browse-jobs" class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="text-wrapper">
                    <div>
                        <h3>7,000+ Browse Jobs</h3>
                        <p>Search all the open positions on the web. Get your own personalized salary estimate. Read reviews on over 600,000 companies worldwide. The right job is out there.</p>
                        <a class="btn btn-common" href="#">Search jobs</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="img-thumb">
                    <img class="img-fluid lazy" data-original="https://preview.uideck.com/items/thehunt/assets/img/search.png">
                </div>
            </div>
        </div>
    </div>
</div>
<section id="featured" class="how-it-works attractive-job section mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12 mb-4 job-attractive">
                <div class="section-header m-0">
                    <h2 class="section-title">Việc làm hấp dẫn</h2>
                </div>
                <div id="carousel-area" class="unset">
                    <div id="recruitment-slider" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#recruitment-slider" data-slide-to="0" class="active"></li>
                        </ol>
                        <div class="carousel-inner overflow-unset" role="listbox">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class=" col-md-6 col-xs-12">
                                        <div class="job-featured">
                                            <div class="job clearfix">
                                                <div class="avatar"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                              </div>
                                        </div>
                                    </div>
                                    <div class=" col-md-6 col-xs-12">
                                        <div class="job-featured">
                                            <div class="job clearfix">
                                                <div class="avatar"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                              </div>
                                        </div>
                                    </div>
                                    <div class=" col-md-6 col-xs-12">
                                        <div class="job-featured">
                                            <div class="job clearfix">
                                                <div class="avatar"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                              </div>
                                        </div>
                                    </div>
                                    <div class=" col-md-6 col-xs-12">
                                        <div class="job-featured">
                                            <div class="job clearfix">
                                                <div class="avatar"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                              </div>
                                        </div>
                                    </div>
                                    <div class=" col-md-6 col-xs-12">
                                        <div class="job-featured">
                                            <div class="job clearfix">
                                                <div class="avatar"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                              </div>
                                        </div>
                                    </div>
                                    <div class=" col-md-6 col-xs-12">
                                        <div class="job-featured">
                                            <div class="job clearfix">
                                                <div class="avatar"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                              </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <a href="{{ route("job",["type"=>3]) }}" class="btn btn-common">Xem tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#recruitment-slider" role="button" data-slide="prev">
                        <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-left"></i></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#recruitment-slider" role="button" data-slide="next">
                        <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-right"></i></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>                
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 advertisement-2">
                <div id="carousel-area">
                    <div id="carousel-slider" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-slider" data-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <a href="topcv.vn" class="banner"><img src="https://static.topcv.vn/img/right.png" alt="quang-cao-top-cv"></a>
                            </div>
                            <div class="carousel-item">
                                <a href="topcv.vn" class="banner"><img src="https://www.topcv.vn/v3/images/new/phone.png" alt="quang-cao-top-cv"></a>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
                            <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-left"></i></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
                            <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-right"></i></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<section id="featured" class="job mb-5">
    <div class="container">
        <div class="row">
            <section class="col-lg-4 job-urgently box-urgently-recruiting-job">
                <div class="section-header box-title">
                    <h2 class="section-title m-0">Việc làm tuyển gấp</h2>
                </div>
                <div class="list-job box-recruitment">
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div>                    
                </div>
                <div class="box-see-more">
                    <a href="{{ route("job",["type"=>4]) }}" class="btn-seemore">xem thêm</a>
                </div>
            </section>
            <section class="col-lg-4 job-high-paying box-urgently-recruiting-job">
                <div class="section-header box-title">
                    <h2 class="section-title m-0">Việc làm lương cao</h2>
                </div>
                <div class="list-job box-recruitment">
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div>                    
                </div>
                <div class="box-see-more">
                    <a href="{{ route("job",["type"=>5]) }}" class="btn-seemore">xem thêm</a>
                </div>
            </section>
            <section class="col-lg-4 job-manager  box-manager-jobs">
                <div class="section-header box-title">
                    <h2 class="section-title m-0">Việc làm cấp quản lý</h2>
                </div>
                <div class="list-job box-recruitment">
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div>                    
                </div>
                <div class="box-see-more">
                    <a href="{{ route("job",["type"=>6]) }}" class="btn-seemore">xem thêm</a>
                </div>
            </section>
        </div>
    </div>
</section>
<section id="featured" class="job mb-5">
    <div class="container">
        <div class="row">
            <section class="col-lg-4 job-intern box-urgently-recruiting-job">
                <div class="section-header box-title">
                    <h2 class="section-title m-0">Việc làm thực tập</h2>
                </div>
                <div class="list-job box-recruitment">
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div>                    
                </div>
                <div class="box-see-more">
                    <a href="{{ route("job",["type2"=>3]) }}" class="btn-seemore">xem thêm</a>
                </div>
            </section>
            <section class="col-lg-4 job-free-time box-urgently-recruiting-job">
                <div class="section-header box-title">
                    <h2 class="section-title m-0">Việc làm bán thời gian</h2>
                </div>
                <div class="list-job box-recruitment">
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div>                    
                </div>
                <div class="box-see-more">
                    <a href="{{ route("job",["type2"=>2]) }}" class="btn-seemore">xem thêm</a>
                </div>
            </section>
            <section class="col-lg-4 job-remote box-manager-jobs">
                <div class="section-header box-title">
                    <h2 class="section-title m-0">Việc làm từ xa</h2>
                </div>
                <div class="list-job box-recruitment">
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div> 
                    <div class="job-featured">
                        <div class="job clearfix">
                            <div class="avatar"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                          </div>
                    </div>                    
                </div>
                <div class="box-see-more">
                    <a href="{{ route("job",["type2"=>4]) }}" class="btn-seemore">xem thêm</a>
                </div>
            </section>
        </div>
    </div>
</section>
<section id="phone-support-recruitment" class="section">
    <div class="container">
        <div class="section-header my-1">
            <h2 class="section-title text-left">Nhà tuyển dụng Liên hệ chúng tôi </h2>
        </div>
        <div class="list-phone row">
            <div class="col-md-4">
                <h5><span class="icon"><i class="fas fa-headphones-alt"></i></span>Hot line liên hệ miền Bắc</h5>
                <p class="phone-item"><span>039343343</span> -Nguyễn Hữu Văn</p>
                <p class="phone-item"><span>039545444</span> -Thanh Thúy</p>
                <p class="phone-item"><span>039435345</span> -Văn Huynh</p>
                <p class="phone-item"><span>039418435</span> -Thiện Nhân</p>
            </div>
            <div class="col-md-4">
                <h5><span class="icon"><i class="fas fa-headphones-alt"></i></span>Hot line liên hệ miền Trung</h5>
                <p class="phone-item"><span>039343343</span> -Nguyễn Hữu Văn</p>
                <p class="phone-item"><span>039545444</span> -Thanh Thúy</p>
                <p class="phone-item"><span>039435345</span> -Văn Huynh</p>
                <p class="phone-item"><span>039418435</span> -Thiện Nhân</p>
            </div>
            <div class="col-md-4">
                <h5><span class="icon"><i class="fas fa-headphones-alt"></i></span>Hot line liên hệ miền Nam</h5>
                <p class="phone-item"><span>039343343</span> -Nguyễn Hữu Văn</p>
                <p class="phone-item"><span>039545444</span> -Thanh Thúy</p>
                <p class="phone-item"><span>039435345</span> -Văn Huynh</p>
                <p class="phone-item"><span>039418435</span> -Thiện Nhân</p>
            </div>
        </div>
    </div>
</section>
@endsection
