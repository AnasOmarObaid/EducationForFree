<x-front.app title='Suuport'>

 <!--support-->
 <section class="support">
    <x-front.nav />
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="body-area">

                <!-- image-area -->
                <div class="col-12 col-md-7 d-none d-md-block" style="margin-right: 3rem;">
                    <img class="img-fluid" src="{{ asset('front/images/support.svg') }}" alt="about us image" />
                </div>

                <!--form area-->
                <div class="col-12 col-md-5">
                    <section class="form-area">
                        <!--form-->
                        <form action="{{ route('support.store') }}" method="post" class="mt-3">
                            @csrf
                            <!-- name  -->
                            <div class="mb-4 field">
                                <input type="text" name="name" required class="form-control" placeholder="Enter name">
                                <div class="input-icon">
                                    <i class="fas fa-user fa-fw"></i>
                                </div>
                            </div>

                            <!-- email address -->
                            <div class="mb-4 field">
                                <input type="email" name='email' required class="form-control" placeholder="Enter email">
                                <div class="input-icon">
                                    <i class="fas fa-envelope fa-fw"></i>
                                </div>
                            </div>

                            <!-- question -->
                            <div class="mb-4 field">
                                <textarea rows="10" name='question' required class="w-100" placeholder="What's your question?"></textarea>
                                <div class="input-icon">
                                    <i class="fas fa-paragraph fa-fw"></i>
                                </div>
                            </div>

                            <!-- submit -->
                            <div class="d-grid gap-1 pt-2">
                                <button type="submit" class="btn btn-primary btn-block"> <i
                                        class="far fa-share-square fa-fw" style="font-size: 1rem;"></i>
                                    Send</button>
                            </div>
                        </form>
                    </section>
                </div>

            </div>
        </div>
    </div>


</section>

    <x-front.footer />
</x-front.app>
