<?=$this->extend('layouts/main')?>

<?=$this->section('content')?>

    <div class="container-xxl flex-grow-1 container-p-y">

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?=session()->getFlashdata('error')?>
            </div>
        <?php elseif (session()->getFlashdata('success')): ?>
            <div class="alert alert-primary">
                <?=session()->getFlashdata('success')?>
            </div>
        <?php endif;?>

        <form id="formAuthentication" class="mb-3" action="<?=base_url('visit/single-submit');?>" method="POST">
            <div class="card mb-4">
                <h6 class="card-header px-3 pt-3">Single Input - IN</h6>
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

                    <div class="mt-3">
                        <label for="visit_type_id" class="form-label">Visit Type</label>
                        <select class="form-select" id="visit_type_id" name="visit_type_id" aria-label="Default select example">
                            <?php foreach ($visitTypes as $visitType): ?>
                                <option value="<?=$visitType['id']?>"><?=$visitType['name']?></option>
                            <?php endforeach;?>
                        </select>
                      </div>

                    <div class="mt-3">
                        <button class="btn btn-primary d-grid" type="submit">Submit</button>
                    </div>
                </div>

            </div>
        </form>

    </div>

<?=$this->endSection()?>