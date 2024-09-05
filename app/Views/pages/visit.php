<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>

    <div class="container-xxl flex-grow-1 container-p-y">

        <?= $this->include('partials/alert') ?>

        <form id="formAuthentication" class="mb-3" action="<?=base_url('visit/single-submit');?>" method="POST">
            <div class="card mb-4">
                <h6 class="card-header px-3 pt-3"><?= $title ?></h6>
                <div class="card-body px-3">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control"
                            id="person_code"
                            name="person_code"
                            placeholder="id-person-or-vistor"
                            aria-describedby="id-person-or-vistor"
                        />
                        <label for="person_code">Input ID</label>
                    </div>

                    <input 
                        type="text"
                        class="form-control"
                        id="visit_type_id"
                        name="visit_type_id"
                        value="<?= $visit_id ?>"
                        disabled
                        hidden
                    />

                    <div class="mt-3">
                        <button class="btn btn-primary d-grid" type="submit">Submit</button>
                    </div>
                </div>

            </div>
        </form>

    </div>

<?=$this->endSection()?>