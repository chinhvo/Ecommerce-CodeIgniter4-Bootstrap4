<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="content orders-page">
    <table class="table">
        <thead class="blue-grey lighten-4">
            <tr>
                <th>#</th>
                <th><?= lang('Orders.time_created') ?></th>
                <th><?= lang('Orders.order_type') ?></th>
                <th><?= lang('Orders.phone') ?></th>
                <th><?= lang('Orders.status') ?></th>
                <th class="text-right"><i class="fa fa-list" aria-hidden="true"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach ($orders as $order): ?>
                <tr>
                    <td><?= esc($order['order_id']) ?></td>
                    <td><?= date('d.m.Y', $order['date']) ?></td>
                    <td><?= esc($order['payment_type']) ?></td>
                    <td><?= esc($order['phone']) ?></td>
                    <td>
                        <select class="selectpicker change-ord-status" data-ord-id="<?= esc($order['id']) ?>" data-style="btn-green"> 
                            <option <?= $order['processed'] == 0 ? 'selected' : '' ?> value="0"><?= lang('Orders.new') ?></option>
                            <option <?= $order['processed'] == 1 ? 'selected' : '' ?> value="1"><?= lang('Orders.processed') ?></option>
                            <option <?= $order['processed'] == 2 ? 'selected' : '' ?> value="2"><?= lang('Orders.rejected') ?></option>
                        </select>
                    </td>
                    <td class="text-right">
                        <a href="javascript:void(0);" class="btn btn-sm btn-green show-more" data-show-tr="<?= $i ?>">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                <tr class="tr-more" data-tr="<?= $i ?>">
                    <td colspan="6">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul>
                                    <li><b><?= lang('Orders.first_name') ?></b> <span><?= esc($order['first_name']) ?></span></li>
                                    <li><b><?= lang('Orders.last_name') ?></b> <span><?= esc($order['last_name']) ?></span></li>
                                    <li><b><?= lang('Orders.email') ?></b> <span><?= esc($order['email']) ?></span></li>
                                    <li><b><?= lang('Orders.phone') ?></b> <span><?= esc($order['phone']) ?></span></li>
                                    <li><b><?= lang('Orders.address') ?></b> <span><?= esc($order['address']) ?></span></li>
                                    <li><b><?= lang('Orders.city') ?></b> <span><?= esc($order['city']) ?></span></li>
                                    <li><b><?= lang('Orders.post_code') ?></b> <span><?= esc($order['post_code']) ?></span></li>
                                    <li><b><?= lang('Orders.notes') ?></b> <span><?= esc($order['notes']) ?></span></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <?php foreach ($order['products_info'] as $productInfo): ?>
                                    <div class="product">
                                        <a href="#" target="_blank">
                                            <img src="<?= base_url('attachments/shop_images/' . $productInfo['image']) ?>" alt="">
                                            <span class="info">
                                                <span class="quantity">
                                                    <b><?= lang('Orders.quantity') ?></b> <?= esc($productInfo['quantity']) ?>
                                                </span>
                                            </span>
                                            <span class="clearfix"></span>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>
</div>
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>