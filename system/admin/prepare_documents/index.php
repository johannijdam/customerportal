<?php $active = "admin"; include_once '../../../includes/header.inc.php'; ?>
<div class="row">
    <div class="col-12">
        <h1>Prepare Documents</h1>
        
        <form method="post" action="">
            <div class="form-group">
                <label for="docName">Document Name</label>
                <input type="text" class="form-control" id="docName" placeholder="Name of the document">
            </div>
            <div class="form-group">
                <label for="docDateAdded">Date Added</label>
                <input type="date" class="form-control" id="docDateAdded" required>
            </div>
            <div class="form-group">
                <label for="docDateExpired">Date Expired</label>
                <input type="date" class="form-control" id="docDateExpired" required>
            </div>
        </form>
    </div>
</div>
<?php include_once '../../../includes/footer.inc.php'; ?>