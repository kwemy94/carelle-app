<div class="row align-items-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <!-- Bg -->
        <div class="pt-16 rounded-top" style="
                background: url({{ asset('front-end/assets/images/background/profile-bg.jpg') }}) no-repeat;
                background-size: cover;
            "></div>
        <div class="card px-4 pt-2 pb-4 shadow-sm rounded-top-0 rounded-bottom-0 rounded-bottom-md-2 ">
            <div class="d-flex align-items-end justify-content-between  ">
                <div class="d-flex align-items-center">
                    <div
                        class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
                        <img src="{{ asset('front-end/assets/images/avatar/avatar-00.jpg') }}"
                            class="avatar-xl rounded-circle border border-4 border-white" alt="avatar">
                    </div>
                    <div class="lh-1">
                        <h2 class="mb-0">Sat-Cli
                            <a href="#" class="text-decoration-none" data-bs-toggle="tooltip"
                                data-placement="top" title="Beginner">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
                                    <rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9"></rect>
                                    <rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9">
                                    </rect>
                                </svg>
                            </a>
                        </h2>
                        <p class=" mb-0 d-block">@shell</p>
                    </div>
                </div>
                <div>
                    {{-- <a href="profile-edit.html" class="btn btn-primary btn-sm d-none d-md-block">Account
                        Setting</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>