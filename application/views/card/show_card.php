<div id="card-box-all" class="container col-12 mt-5">

    <div class="container">
        <div class="row">
            <?php foreach ($cards as $card) : ?>
                <div class=" col-sm-12 col-md-8 col-lg-6 container border  rounded  my-4 bg-light">
                    <div class="card-container mt-5 mb-5">
                        <div id="front_<?= $card['id'] ?>" class="front ">
                            <div class="image">
                                <img src="<?= base_url('storage/image/card/chip.png') ?>" alt="">
                                <img src="<?= base_url('storage/image/card/visa.png') ?>" alt="">
                            </div>
                            <div id="card_number_<?= $card['id'] ?>" class="card-number-box"><?= $card['card_number'] ?></div>
                            <div class="flexbox ">
                                <div class="box">
                                    <span>card holder</span>
                                    <div class="card-holder-name"><?= $card['card_holder'] ?></div>
                                </div>
                                <div class="box">
                                    <span>expires</span>
                                    <div class="expiration">
                                        <span id="card_month_<?= $card['id'] ?>" class="exp-month"><?= $card['expiration_month'] ?></span>
                                        <span id="card_year_<?= $card['id'] ?>" class="exp-year"><?= $card['expiration_year'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="back_<?= $card['id'] ?>" class="show_cvv_<?= $card['id'] ?>">
                            <div class="back">
                                <div class="stripe"></div>
                                <div class="box">
                                    <span>cvv</span>
                                    <div id="card_cvv_<?= $card['id'] ?>" class="cvv-box"><?= $card['cvv'] ?></div>
                                    <img src="image/visa.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">

                        <a href="<?= base_url('card-pay/' . $card['id']) ?>" class="m-2 card_details btn btn-primary btn-sm ">
                            Details / Pay
                        </a>
                        <a href="<?= base_url('card-number/' . $card['id']) ?>" class="show_card_number btn btn-secondary btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>


<script>
    var showCartNumber = $('.show_card_number');

    showCartNumber.on('click', function(e) {
        event.preventDefault();


        var _selfHref = $(this).attr('href'),
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
            url: _selfHref,
            success: function(response) {
                response = $.parseJSON(response);

                if (response.status != 0) {
                    flashMessage("green", response.message, 4000, response.status);

                    let cardNumberId = $("#card_number_" + response.id),
                        cardMonthId = $("#card_month_" + response.id),
                        cardYearId = $("#card_year_" + response.id),
                        cardCvvId = $("#card_cvv_" + response.id),

                        oldNumber = cardNumberId.text(),
                        oldMonth = cardNumberId.text(),
                        oldYear = cardNumberId.text(),
                        oldCvv = cardNumberId.text();

                    cardNumberId.text(response.card_number);
                    cardMonthId.text(response.expiration_month);
                    cardYearId.text(response.expiration_year);
                    cardCvvId.text(response.cvv);

                } else {
                    flashMessage("red", response.message, 4000, response.status);
                }
            },
            error: function() {

            }
        });
    })
</script>