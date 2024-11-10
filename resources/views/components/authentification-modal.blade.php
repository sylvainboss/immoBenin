<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tabs-listing mt-4">
                    <nav>
                        <div class="nav nav-tabs d-flex justify-content-center border-0" id="nav-tab2" role="tablist">
                            <button class="btn btn-outline-primary text-uppercase me-4 " id="nav-sign-in-tab2"
                                data-bs-toggle="tab" data-bs-target="#nav-sign-in2" type="button" role="tab"
                                aria-controls="nav-sign-in2" aria-selected="false">Connexion</button>
                            <button class="btn btn-outline-primary text-uppercase active" id="nav-register-tab2"
                                data-bs-toggle="tab" data-bs-target="#nav-register2" type="button" role="tab"
                                aria-controls="nav-register2" aria-selected="true">Inscription</button>
                        </div>
                    </nav>

                    {{-- Connexion --}}
                    <div class="tab-content" id="nav-tabContent1">
                        <div class="tab-pane fade " id="nav-sign-in2" role="tabpanel"
                            aria-labelledby="nav-sign-in-tab2">
                            @include('components.login-component')
                        </div>
                    </div>
                    {{-- Inscription --}}
                    <div class="tab-pane fade active show" id="nav-register2" role="tabpanel"
                        aria-labelledby="nav-register-tab2">
                        @include('components.register-component')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
