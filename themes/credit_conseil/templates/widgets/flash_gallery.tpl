<div id='gallery'></div>



<script language="javascript" type="text/javascript">
var so = new SWFObject("fla/flashgallery/flashgallery.swf", "gallery", "640", "480", "8"); // Location of swf file. You can change gallery width and height here (using pixels or percents).
so.addParam("quality", "high");
so.addParam("allowFullScreen", "true");
so.addParam("wmode", "transparent");
so.addVariable("content_path","{$gallerylink}"); // Location of a folder with JPG and PNG files (relative to php script).
so.addVariable("color_path","fla/flashgallery/default.xml"); // Location of xml file with settings.
{if $flickr == false }so.addVariable("script_path","fla/flashgallery/flashgallery.php"); {/if}
so.write("gallery");
</script>

