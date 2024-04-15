<!-- content @s -->
<?= $this->extend('1layouts/main_auth') ?>

<?= $this->section('cp') ?>


<div class="card card-bordered">
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title"><?= lang('Auth.emailEnterCode') ?></h4>
                <div class="nk-block-des">
                    <p><?= lang('Auth.emailConfirmCode') ?></p>
                </div>
            </div>
        </div>

        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
        <?php endif ?>

        <form action="<?= url_to('auth-action-verify') ?>" method="post">
            <?= csrf_field() ?>

            <!-- Code -->
            <div class="form-group">
                <div class="form-control-wrap">
                    <input type="number" class="form-control" name="token" placeholder="000000" inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code" required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block"><?= lang('Auth.confirm') ?></button>
            </div>

        </form>
    </div>
</div>\

<?= $this->endSection() ?>