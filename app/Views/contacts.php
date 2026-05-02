<?= $this->extend('_parts/layout') ?>
<?= $this->section('contacts') ?>
<div class="container body" id="contacts">
    <?php $errors = session('errors') ?? []; ?>

    <div class="col-12 mb-4">
        <div class="bg-light rounded p-1">
            <h3 class="h3 mb-0">
                <?= lang('contact_us') ?> <small><?= lang('contact_us_feel_free') ?></small>
            </h3>
        </div>
    </div>

    <div class="col-12 mb-4 order-md-2">
        <?php if (session()->getFlashdata('resultSend')) { ?>
            <hr>
            <div class="alert alert-info"><?= session()->getFlashdata('resultSend') ?></div>
            <hr>
        <?php } ?>

        <?php if (!empty($errors)) { ?>
            <div class="alert alert-danger">
                <ul class="mb-0 pl-3">
                    <?php foreach ($errors as $error) { ?>
                        <li><?= esc($error) ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
        <div class="card shadow-sm">
            <div class="card-body d-flex flex-column">
                <form method="POST" action="" novalidate class="d-flex flex-column">
                    <?= csrf_field() ?>

                    <div class="d-flex flex-column">
                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label for="name"><?= lang('name') ?></label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control<?= isset($errors['name']) ? ' is-invalid' : '' ?>"
                                    id="name"
                                    placeholder="<?= lang('please_enter_name') ?>"
                                    value="<?= old('name') ?>" />
                                <?php if (isset($errors['name'])) { ?>
                                    <div class="invalid-feedback"><?= esc($errors['name']) ?></div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label for="email"><?= lang('email_address') ?></label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>"
                                    id="email"
                                    placeholder="<?= lang('enter_email') ?>"
                                    value="<?= old('email') ?>" />
                                <?php if (isset($errors['email'])) { ?>
                                    <div class="invalid-feedback d-block"><?= esc($errors['email']) ?></div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label for="subject"><?= lang('subject') ?></label>
                                <input
                                    type="text"
                                    name="subject"
                                    class="form-control<?= isset($errors['subject']) ? ' is-invalid' : '' ?>"
                                    placeholder="<?= lang('please_enter_subject') ?>"
                                    id="subject"
                                    value="<?= old('subject') ?>">
                                <?php if (isset($errors['subject'])) { ?>
                                    <div class="invalid-feedback"><?= esc($errors['subject']) ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-12 px-0">
                            <div class="form-group">
                                <label for="message"><?= lang('message') ?></label>
                                <textarea
                                    name="message"
                                    id="message"
                                    class="form-control<?= isset($errors['message']) ? ' is-invalid' : '' ?>"
                                    rows="9"
                                    cols="25"
                                    placeholder="<?= lang('message') ?>"><?= old('message') ?></textarea>
                                <?php if (isset($errors['message'])) { ?>
                                    <div class="invalid-feedback"><?= esc($errors['message']) ?></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-12 px-0 d-flex justify-content-end">
                            <button type="submit" class="btn cloth-bg-color" id="btnContactUs">
                                <?= lang('send_message') ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 order-md-1">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h2 class="h5 mb-3"><i class="fa fa-info" aria-hidden="true"></i> <?= lang('our_office') ?></h2>
                <address class="mb-0">
                    <?= html_entity_decode($contactspage) ?>
                </address>
            </div>
        </div>
    </div>

    <?php if (trim($googleApi) != null && trim($googleMaps) != null) { ?>
        <div class="col-12 mt-4">
            <div id="map" class="rounded overflow-hidden"></div>
        </div>

        <?php $coordinates = explode(',', $googleMaps); ?>

        <script src="https://maps.googleapis.com/maps/api/js?key=<?= $googleApi ?>"></script>
        <script>
            function initialize() {
                var myLatlng = new google.maps.LatLng(<?= $coordinates[0] ?>, <?= $coordinates[1] ?>);
                var mapOptions = {
                    zoom: 10,
                    center: myLatlng
                }
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    title: "Here we are!"
                });
                marker.setMap(map);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    <?php } ?>

    <div class="bottom-30"></div>
</div>
<?= $this->endSection() ?>