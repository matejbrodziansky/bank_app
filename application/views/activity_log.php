<div class="container">
    <h3>Count of all logs: <?= $count_logs ?></h3>
    <div class="row">
        <div class="col-6">
            <form action="" method="post">
                <select class="border rounded log-select col-12">
                    <option value="all">All</option>
                    <option value="card">Card</option>
                    <option value="auth">Auth</option>
                    <option value="transaction">Transaction</option>
                </select>
                <div class="selected_log_box shadow border rounded my-4">
                    <?php foreach ($all_logs as $log) : ?>
                        <h4 style="color: blue;"><?= $log['log_type'] ?></h4>
                        <p><?= $log['action'] ?></p>
                        <p>Created at: <?= $log['created_at'] ?></p>
                        <hr>
                    <?php endforeach ?>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
    // Show recipien details  --------------------------------
    var encodedLogs = JSON.parse('<?= $encoded_all_logs ?>'),
        logSelect = $('.log-select');

    logSelect.on('change', function() {
        $('.selected_log_box').empty();

        logVal = this.value;

        $.each(encodedLogs, function(key, value) {

            if (value.log_type == logVal) {
                let append =
                    '<h4>' + value.log_type + '</h4>' +
                    '<p>' + value.action + '</p>' +
                    '<p><span>Created at:</span> ' + value.created_at + '</p>' +
                    '<hr>';

                $('.selected_log_box').append(append);

            }
            if (logVal == 'all') {
                let append =
                    '<h4>' + value.log_type + '</h4>' +
                    '<p>' + value.action + '</p>' +
                    '<p><span>Created at:</span>  ' + value.created_at + '</p>' +
                    '<hr>';

                $('.selected_log_box').append(append);
            }

        });

    });
</script>