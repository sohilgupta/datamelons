<form role="search" method="get" class="searchform" action="<?php echo home_url('/'); ?>">
    <div>
        <input type="text" value="Search" onfocus="if (this.value == 'Search') {
                    this.value = '';
                }" onblur="if (this.value == '') {
                    this.value = 'Search';
                }" name="s" id="search" />
        <input type="submit" id="searchsubmit" value="" />
    </div>
</form>
<div class="clear"></div>
<br/>
