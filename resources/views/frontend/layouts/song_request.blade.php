<section>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="text-uppercase">Contact us.</h2>
                </div>
            </div>
        </div>
    </header>
    <!--section header-->
    <div class="container">
        <form id="contactForm" novalidate class="text-uppercase text-semibold row">
            <div class="col-xs-12 col-sm-6">
                <div class="field-wrap">
                    <label for="xv_name">your Name</label>
                    <input name="xv_name" id="xv_name" type="text" required="required" />
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="field-wrap">
                    <label class="tranparent" for="xv_email">you@example.com</label>
                    <input name="xv_email" class="tranparent" id="xv_email" type="email"
                        required="required" />
                </div>
            </div>
            <div class="col-xs-12">
                <div class="field-wrap textarea-wrap">
                    <label for="xv_message">Your Message</label>
                    <textarea name="xv_message" id="xv_message" required></textarea>
                </div>
            </div>
            <div class="col-xs-12 text-center">
                <button class="btn btn-default btn-md" type="submit">send message</button>
            </div>
            <div class="col-xs-12 text-center">
                <div class="validationError">
                    <div class="alert alert-danger" role="alert">
                        Oh snap! Change a few things up and try submitting again.
                    </div>
                </div>
            </div>
        </form>

        <div class="messageSentSuccess">
            <div class="alert alert-success" role="alert">Message has been sent successfully, we will be
                in touch</div>
        </div>

    </div>
    <!--container-->

</section>