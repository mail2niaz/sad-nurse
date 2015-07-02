<?php /* * / ?><script type="text/javascript">
    jQuery(document).ready(function() {
		function showTooltip(x, y, contents) {
			jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}
        // tabbed widget
        jQuery('.tabbedwidget').tabs();

    });
</script><?php / * */ ?>
</body>
</html>