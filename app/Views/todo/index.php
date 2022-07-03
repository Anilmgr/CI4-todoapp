<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
  <div class="container my-2">
  <?php $validation = \Config\Services::validation(); ?>

  <h1 class="text-center my-4 text-danger" >Code Igniter 4 Todo App </h1> 

  <?php if(session()->has('message')): ?>
      <div class="alert <?= session()->getFlashdata('alert-class') ?> alert-dismissible fade show mt-2" role="alert">
      <?= session()->getFlashdata('message') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif ?>

  <form method="post" action="<?=site_url()?>">
    <div class="row align-items-center m-0 mb-3">
      <div class="col-md-10">
      <div class="form-floating">
        <input type="text" class="form-control" id="task" placeholder="name@example.com" name="task">
        <label for="task">Enter task...</label>
      </div>
      </div>
      <div class="col-md-2">
        <div class="d-grid">
          <button class="btn btn-lg btn-primary" name="submit" type="submit">Add Task</button>
        </div>
      </div>
      <?php if( $validation->getError('task') ): ?>
          <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <?= $error = $validation->getError('task'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      <?php endif ?>
    </div>
  </form>

  <h1 class="text-center mt-4 text-danger">Todo List</h1> 
  <?php foreach($todos as $todo): ?>
    <div class="alert d-flex justify-content-between align-items-center <?= ($todo->completed)? "alert-success text-decoration-line-through" : "alert-warning" ?>" >
      <span><?= $todo->task ?></span> 
      <div class="d-flex">
        <?php if($todo->completed) : ?>
          <form action="markstatus/<?=$todo->id?>" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <button class="bg-transparent border-0" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as not completed">
              <img class="w-auto" src="<?=base_url('icons/uncheck.svg')?>">
            </button>
          </form>
        <?php else: ?>
          <form action="markstatus/<?=$todo->id?>" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <button class="bg-transparent border-0" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as completed">
              <img class="w-auto" src="<?=base_url('icons/check.svg')?>">
            </button>
          </form>
        <?php endif ?>

        <form action="<?=$todo->id?>" method="POST">
        <input type="hidden" name="_method" value="DELETE">
          <button class="bg-transparent border-0" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete task">
            <img class="w-auto" src="<?=base_url('icons/trash.svg')?>">
          </button>
        </form>
      </div>
    </div>
  <?php endforeach ?>
  </div>
<?= $this->endSection() ?>