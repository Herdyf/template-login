<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card border-info float-right" style="max-width: 18rem;">
        <div class="card-header bg-transparent border-primary text-center  " style="font-family: hack;"><?= $data['name'] ?></div>
        <div class="card-body text-primary text-center">
            <h5 class="card-title">Status : <?= $data['role_id'] ?></h5>
            <p class="card-text">Email : <?= $data['email'] ?></p>
        </div>
        <div class="card-footer bg-transparent border-primary text-right" style="font-family: hack;"><?= date('d F Y', $data['date_created']) ?></div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->