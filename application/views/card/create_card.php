<div id="card-box" class="container col-12 mt-5">

    <div class="card-container mt-5">

        <div class="front">
            <div class="image">
                <img src="<?= base_url('storage/image/card/chip.png') ?>" alt="">
                <img src="<?= base_url('storage/image/card/visa.png') ?>" alt="">
            </div>
            <div class="card-number-box">#### #### #### ####</div>
            <div class="flexbox ">
                <div class="box">
                    <span>card holder</span>
                    <div class="card-holder-name">full name</div>
                </div>
                <div class="box">
                    <span>expires</span>
                    <div class="expiration">
                        <span class="exp-month">mm</span>
                        <span class="exp-year">yy</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="back">
            <div class="stripe"></div>
            <div class="box">
                <span>cvv</span>
                <div class="cvv-box"></div>
                <img src="image/visa.png" alt="">
            </div>
        </div>

    </div>

    <form id="add-card" method="post">
        <div class="inputBox">
            <span>card number</span>
            <input readonly name="card_number" type="text" maxlength="19" class="card-number-input creditCardText">
        </div>
        <div class="inputBox">
            <span>card holder</span>
            <input name="card_holder" type="text" class="card-holder-input">
        </div>
        <div class="flexbox">
            <div class="row container">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="inputBox">
                        <span>expiration mm</span>
                        <input name="expiration_month" type="number" readonly class="month-input">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">

                    <div class="inputBox">
                        <span>expiration yy</span>
                        <input name="expiration_year" type="number" readonly class="year-input">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">

                    <div class="inputBox">
                        <span>cvv</span>
                        <input readonly name="cvv" type="text" maxlength="4" class="cvv-input" value="">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-3">

                    <div class="inputBox">
                        <span><i class="fas fa-eye"></i></span>
                        <div class="btn btn-secondary show_cvv">CVV</div>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" value="submit" class="submit-btn">
        <div class="container text-center mt-3">
            <a id="rando_generate" href="" class="btn btn-primary">
                Random generate
            </a>
        </div>
    </form>


</div>



<script>
    document.querySelector('.card-holder-input').oninput = () => {
        document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
    }
    //Rotate card 
    document.querySelector('.show_cvv').onmouseenter = () => {
        document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
        document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
    }

    document.querySelector('.show_cvv').onmouseleave = () => {
        document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
        document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
    }

    $('#rando_generate').click(function(e) {
        event.preventDefault();

        // Generate 16 digit number
        let creditCardText = $('.creditCardText');
        creditCardText.val((Math.random() + '').substring(2, 18));
        creditCardText.val((Math.random() + '').substring(2, 18));

        while (creditCardText.val().length < 16) {
            creditCardText.val((Math.random() + '').substring(2, 18));
        }

        var cardNumber = creditCardText.val().split(" ").join(""); // remove hyphens
        if (cardNumber.length > 0) {
            cardNumber = cardNumber.match(new RegExp('.{1,4}', 'g')).join(" ");
        }
        document.querySelector('.card-number-box').innerText = cardNumber;
        creditCardText.val(cardNumber);

        // Generate CVV
        let cvv = (Math.random() + '').substring(2, 5);
        $('.cvv-input').val(cvv);
        document.querySelector('.cvv-box').innerText = cvv;


        // Generate month, year 
        let currentTime = new Date()
        let month = currentTime.getMonth() + 1
        let year = currentTime.getFullYear() + 5

        document.querySelector('.exp-month').innerText = month;
        document.querySelector('.exp-year').innerText = year;

        $('.month-input').val(month);
        $('.year-input').val(year);

    });




    $('#add-card').submit(function(e) {

        var createUrl = '<?= base_url('/create-card') ?>',
            body = $("body");

        e.preventDefault();
        $(document).on({
            ajaxStart: function() {
                body.addClass("loading").css({
                    backgroundColor: 'gray'
                });
            },
            ajaxStop: function() {
                body.removeClass("loading").css({
                    backgroundColor: '#F4F3F3'
                });

            }
        });

        $.ajax({
            url: createUrl,
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {

                response = $.parseJSON(response);

                if (response.status != 0) {
                    flashMessage("green", response.message, 4000, response.status);
                } else {
                    flashMessage("red", response.message, 4000, response.status);
                }
            },
            error: function() {

            }
        });
        e.preventDefault();
    });
</script>