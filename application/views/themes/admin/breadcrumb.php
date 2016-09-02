<div id="ribbon">
    <span class="ribbon-button-alignment"> 
        <span data-html="true" data-original-title="&lt;i class='text-warning fa fa-warning'&gt;&lt;/i&gt; Warning! This will reset all your widget settings." data-placement="bottom" rel="tooltip" data-title="refresh" data-action="resetWidgets" class="btn btn-ribbon" id="refresh"><i class="fa fa-refresh"></i></span> 
    </span>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo base_url('admin/dashboard')?>">Home</a>
        </li>
        <?php
			echo (!empty($breadcrum)) ? $breadcrum : "";
        ?>
    </ol>
</div>
