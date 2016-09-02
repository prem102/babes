</div> <!--our-latest-update -->
<?php $static_content=getStaticPageContent('footer');?>
<footer>
<ul>
<li><a href="#">how it works</a></li>
<li><a href="#">Advertising</a></li>
<li><a href="#">Contact</a></li>
<li><a href="#">Blog</a></li>
<li><a href="<?= base_url('privacypolicy')?>">Terms and conditions</a></li>
<li><a href="<?= base_url('termcondition')?>">Privacy Policy</a></li>

</ul>
<div class="copyright">
<?= ucwords($static_content['copyright']);?>
</div>
</footer><!--footer -->

</div><!--wrapper -->

