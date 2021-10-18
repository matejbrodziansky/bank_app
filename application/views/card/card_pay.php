<style>
  .submit-button {
    margin-top: 10px;
  }
</style>

<div class="container mt-4">
  <div class='row'>

    <!-- -------------------------------------------------- -->
    <div class='col-md-3 col-lg-5 mx-4 border rounded shadow-lg'>
      <form class="send-money" method="post">
        <div class='form-row'>
          <div class='col-xs-12 form-group required mt-3'>
            <label class='control-label'>Name on Card</label>
            <input class='form-control' size='4' type='text' value="<?= $card_details['card_holder'] ?>">
          </div>
        </div>
        <div class='form-row'>
          <div class='col-xs-12  required mt-3'>
            <label class='control-label'>Card Number</label>
            <input autocomplete='off' class='form-control card-number' size='20' type='text' value="<?= $card_details['card_number'] ?>">
          </div>
        </div>
        <div class='row my-3'>
          <div class="col">
            <div class='col-xs-4 form-group cvc required'>
              <label class='control-label'>CVC</label>
              <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' value="<?= $card_details['cvv'] ?>">
            </div>
          </div>
          <div class="col">
            <div class='col-xs-4 form-group expiration required'>
              <label class='control-label'>Ex month </label>
              <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' value="<?= $card_details['expiration_month'] ?>">
            </div>
          </div>
          <div class="col">
            <div class='col-xs-4 form-group expiration required'>
              <label class='control-label'> Ex year</label>
              <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' value="<?= $card_details['expiration_year'] ?>">
            </div>
          </div>
        </div>
        <div class="mt-3 bg-info p-2 border rounded my-3">
          <h5>Your account balance is: <span class="payer_balance"> <?= $card_details['account_balance'] ?></span> €</h5>
          <div class='form-row mt-3'>
            <div class='col-md-12'>
              <div class='form-control total btn btn-info'>
                Amount:
                <input class="amount" name="amount" type="number" value="" min="1">
                <input hidden readonly name="id" type="number" value="<?= $card_details['id'] ?>">
              </div>
            </div>
          </div>
          <div class='form-row'>
            <div class='col-md-12 form-group'>
              <button class='form-control btn btn-primary submit-button' type='submit'>Send money »</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- -------------------------------------------------- -->
    <div class='col-md-3 col-lg-5 mx-4 border rounded shadow-lg'>
      <h4>Select card for send money</h4>
      <form action="" method="post">
        <select class="border rounded recipient-select col-12" name="" id="">
          <option value="" selected></option>
          <?php foreach ($cards as $card) : ?>
            <?php if ($card_details['id'] != $card['id']) : ?>
              <option value="<?= $card['id'] ?>"><?= $card['card_holder'] ?> , <?= $card['card_number'] ?> </option>
            <?php endif ?>
          <?php endforeach ?>
        </select>
        <div class="selected_card_box">
          <!-- Appended by jquery -->
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Show recipien details  --------------------------------
  var encodedCards = JSON.parse('<?= $encoded_cards ?>'),
    recipientSelect = $('.recipient-select'),
    payerId = '<?= $card_details['id'] ?>'


  recipientSelect.on('change', function() {

    recipientId = this.value;

    $.each(encodedCards, function(key, value) {

      if (value.id == recipientId && payerId != value.id) {

        $('.selected_card_box').empty();

        let append =
          '<div class="text-light">' +
          '<div class="border rounded mt-3 bg-secondary">' +
          '<div class="m-3 text-light">' +
          '<h5>Card holder</h5>' +
          '<p>' + value.card_holder + '</p>' +
          '</div>' +
          '</div>' +
          '<div class="border rounded mt-3 bg-secondary">' +
          '<div class="m-3">' +
          '<h5>Card number</h5>' +
          '<p>' + value.card_number + '</p>' +
          '</div>' +
          '</div>' +
          '<div class="border rounded mt-3 mb-3 bg-secondary">' +
          '<div class="m-3">' +
          '<h5>Account ballance</h5>' +
          '<p class="recipient_balace">' + value.account_balance + ' €</p>' +
          '</div>' +
          '</div>' +
          '</div>';
        $('.selected_card_box').append(append);
      }

    });

  });

  // Send money --------------------------------
  $('.send-money').on('submit', function(e) {
    e.preventDefault();

    var val = recipientSelect.val(),
      recipient = $('.recipient_balace'),
      recipientBalace = parseInt(recipient.text()),
      cardCvv = '<?= $card_details['cvv'] ?>';

    if (!val) {
      alert('Select card for sending money')
    } else {
      if (prompt('Type your Cvv') == cardCvv) {
        var amount = parseInt($('.amount').val()),

          account_ballace = parseInt('<?= $card_details['account_balance'] ?>');

        if (!amount <= 0) {
          if (!(account_ballace < amount)) {

            var createUrl = '<?= base_url('card-pay/') ?>' + recipientId,
              body = $("body");

            $.ajax({
              url: createUrl,
              type: 'POST',
              data: new FormData(this),
              processData: false,
              contentType: false,
              success: function(response) {

                response = $.parseJSON(response);

                if (response.status != 0) {
                  var payer = $('.payer_balance'),
                    payerNewBalance = parseInt(payer.text()) - amount;
                  payer.text(payerNewBalance);
                  recipient.text((recipientBalace + amount) + " €");

                  flashMessage("green", response.message, 4000, response.status);
                } else {
                  flashMessage("red", response.message, 4000, response.status);
                }
              },
              error: function() {

              }
            });

          } else {
            alert('You do not have enough  money');
          }
        } else {
          alert('Your amount must by bigger  than 0€');
        }
      } else {
        alert('Bad Cvv');
      }


    }

  });
</script>