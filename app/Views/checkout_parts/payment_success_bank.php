<?= $this->extend('_parts/layout') ?>
<?= $this->section('checkout') ?>
<div class="container">
    <div class="body">
        <?php
        if (isset($_SESSION['order_id'])) {
        ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr class="table-info">
                            <td colspan="2" class="font-weight-bold"><?= lang('bank_recipient_name') ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?= $bank_account != null ? $bank_account['name'] : '' ?></td>
                        </tr>
                        <tr class="table-info">
                            <td class="font-weight-bold"><?= lang('bank_iban') ?></td>
                            <td class="font-weight-bold"><?= lang('bank_bic') ?></td>
                        </tr>
                        <tr>
                            <td><?= $bank_account != null ? $bank_account['iban'] : '' ?></td>
                            <td><?= $bank_account != null ? $bank_account['bic'] : '' ?></td>
                        </tr>
                        <tr class="table-info">
                            <td colspan="2" class="font-weight-bold"><?= lang('bank_name') ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?= $bank_account != null ? $bank_account['bank'] : '' ?></td>
                        </tr>
                        <tr class="table-info">
                            <td colspan="2" class="font-weight-bold"><?= lang('bank_reason') ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?= lang('the_reason') ?> - <?= $_SESSION['order_id'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?= lang('final_amount_for_pay') ?> <?= $_SESSION['final_amount'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>
<?= $this->endSection() ?>