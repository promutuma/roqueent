<!-- content @s -->
<?= $this->extend('1layouts/main_auth') ?>

<?= $this->section('cp') ?>

<div class="card card-bordered">
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="card-title mb-5"><?= lang('Auth.email2FATitle') ?></h5>
                <div class="nk-block-des">
                    <p><?= lang('Auth.confirmEmailAddress') ?></p>
                </div>
            </div>
        </div>

        <?php if (session('error')) : ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
        <?php endif ?>

        <form action="<?= url_to('auth-action-handle') ?>" method="post" name="frm2fa" id="frm2fa">
            <?= csrf_field() ?>

            <!-- Email -->
            <div class="form-group">
                <div class="form-control-wrap">
                    <input type="email" class="form-control" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" <?php /** @var CodeIgniter\Shield\Entities\User $user */ ?> value="<?= old('email', $user->email) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">
                    <span class="submitText"><?= lang('Auth.send') ?></span>
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <span class="loadingText d-none">Loading...</span>
                </button>
            </div>

        </form>



    </div>
</div>

<?= $this->endSection() ?>