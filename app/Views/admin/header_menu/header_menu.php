<?= $this->include('admin/layout/front') ?>
<?php
$header_id = isset($headerData) ? $headerData['header_id'] : '';
$header_menu = isset($headerData) ? $headerData['header_menu'] : '';
$header_menu_link = isset($headerData) ? $headerData['menu_link'] : '';
$title = isset($headerData) ? $headerData['page_title'] : '';

$rowCount = isset($metaDataArr) ? count($metaDataArr) : 1;
// $header_sub_menu = isset($headerData) ? $headerData['header_sub_menu'] : '';
// $header_sub_menu_link = isset($headerData) ? $headerData['sub_menu_link'] : '';
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <?php if (session()->getFlashdata('success')) { ?>
            <div class="alert alert-primary"><?= session()->getFlashdata('success') ?></div>
        <?php } ?>
        <?php if (session()->getFlashdata('error')) { ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php } ?>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">

                <form method="post" id="header_form" action="<?php echo base_url() ?>admin/header_menu/save" enctype='multipart/form-data'>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Header Menu</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Menu Name</label>
                                <input type="text" value="<?php echo $header_menu; ?>" class="form-control" id="header_menu" name="header_menu" placeholder="Menu Name" />
                                <input type="hidden" name="header_id" value="<?php echo $header_id; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Menu Link</label>
                                <div class="input-group mb-3 link_error">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="menu_link"><?php echo base_url(''); ?></span>
                                        <!-- https://truflow.hostedwp.com.au/truflow/ -->
                                    </div>
                                    <input type="text" class="form-control" id="menu_link" name="menu_link" value="<?php echo $header_menu_link; ?>" aria-describedby="basic-addon3">
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Sub Menu Name</label>
                                <input type="text" value="" class="form-control" id="header_sub_menu" name="header_sub_menu" placeholder="Sub Menu Name" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Sub Menu Link</label>
                                <input type="text" value="" class="form-control" id="sub_menu_link" name="sub_menu_link" placeholder="Sub Menu Link" />
                            </div> -->

                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Meta Tags</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-sm-12">
                                    <label class="form-label" for="basic-default-fullname">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $title; ?>" />
                                </div>
                            </div>
                            <div id="row-container">
                                <div class="row">
                                    <div class="mb-3 col-sm-5">
                                        <label class="form-label" for="basic-default-fullname">Meta Name</label>
                                    </div>
                                    <div class="mb-3 col-sm-5">
                                        <label class="form-label" for="basic-default-fullname">Meta Content</label>
                                    </div>
                                    <div class="mb-3 col-sm-2 d-flex align-items-end">
                                    </div>
                                </div>
                            </div>
                            <div id="row-container">
                                <?php if(isset($metaDataArr) && count($metaDataArr) > 0) { foreach($metaDataArr as $key => $meta) { ?>
                                    <div class="row removeclass<?php echo $key+1; ?>">
                                        <div class="mb-3 col-sm-5">
                                            <input type="text" class="form-control" name="meta_name[]" placeholder="Meta Name" value="<?php echo $meta['meta_name'] ?>" />
                                        </div>
                                        <div class="mb-3 col-sm-5">
                                            <input type="text" class="form-control" name="meta_content[]" placeholder="Meta Content" value="<?php echo $meta['meta_content'] ?>" />
                                        </div>
                                        <div class="mb-3 col-sm-2 d-flex align-items-end">
                                            <?php if($key != 0) { ?>
                                                <button class="btn btn-danger" type="button" onclick="remove_meta_fields('<?php echo $key+1; ?>');">-</button>
                                            <?php } ?>
                                            <button class="btn btn-primary" type="button" onclick="meta_fields();">+</button>
                                        </div>
                                    </div>
                                <?php } } else { ?>
                                    <div class="row">
                                        <div class="mb-3 col-sm-5">
                                            <input type="text" class="form-control" name="meta_name[]" placeholder="Meta Name" />
                                        </div>
                                        <div class="mb-3 col-sm-5">
                                            <input type="text" class="form-control" name="meta_content[]" placeholder="Meta Content" />
                                        </div>
                                        <div class="mb-3 col-sm-2 d-flex align-items-end">
                                            <button class="btn btn-primary" type="button" onclick="meta_fields();">+</button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div id="meta_fields">
          
                            </div>
                            <!-- <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Sub Menu Name</label>
                                <input type="text" value="" class="form-control" id="header_sub_menu" name="header_sub_menu" placeholder="Sub Menu Name" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Sub Menu Link</label>
                                <input type="text" value="" class="form-control" id="sub_menu_link" name="sub_menu_link" placeholder="Sub Menu Link" />
                            </div> -->

                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary d-grid" value="Submit">
                </form>
            </div>

        </div>
    </div>
    <!-- / Content -->
</div>
<!-- Content wrapper -->
<?= $this->include('admin/layout/footer') ?>
<script src="<?php echo base_url(); ?>/public/admin/js/form_validation.js"></script>
<script>
    $(document).ready(function() {
        $("#header_form").validate({
            rules: {
                header_menu: {
                    required: true
                },
                // menu_link: {
                //     required: true
                // }
            },
            messages: {
                header_menu: {
                    required: "Title is required!"
                },
                // menu_link: {
                //     required: "Link is required!"
                // }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

    var room = '<?php echo $rowCount; ?>';
    function meta_fields() {
    
        room++;
        var objTo = document.getElementById('meta_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass"+room);
        var rdiv = 'removeclass'+room;
        divtest.innerHTML = '<div class="row"><div class="mb-3 col-sm-5"><input type="text" class="form-control" name="meta_name[]" placeholder="Meta Name" /></div><div class="mb-3 col-sm-5"><input type="text" class="form-control" name="meta_content[]" placeholder="Meta Content" /></div><div class="mb-3 col-sm-2 d-flex align-items-end"><button class="btn btn-danger" type="button" onclick="remove_meta_fields('+ room +');">-</button><button class="btn btn-primary" type="button" onclick="meta_fields();">+</button></div></div>';
        
        objTo.appendChild(divtest)
    }

    function remove_meta_fields(rid) {
        $('.removeclass'+rid).remove();
    }
</script>