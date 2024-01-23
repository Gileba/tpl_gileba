<?php
defined("_JEXEC") or die("Restricted access");

use Joomla\CMS\Factory;

/** @var JDocumentHtml $this */
$app = Factory::getApplication();
$menu = $app->getMenu();
$params = $app->getTemplate(true)->params;
$lang = $app->getLanguage();
$pageclass = "";
if ($menu->getActive() != null) {
	$pageclass = $menu
		->getActive()
		->getParams(true)
		->get("pageclass_sfx");
}

$page = $app->getRouter()->getVars();

$wa = $this->getWebAssetManager();
switch ($page["option"]) {
	case "com_osmembership":
		$wa->useStyle("template.gileba.membership");
}

/*
 *	Mobile device detection
 */
if (!function_exists("mobile_user_agent_switch")) {
	function mobile_user_agent_switch()
	{
		$device = "";

		if (stristr($_SERVER["HTTP_USER_AGENT"], "ipad")) {
			$device = "ipad";
		} elseif (stristr($_SERVER["HTTP_USER_AGENT"], "iphone") || strstr($_SERVER["HTTP_USER_AGENT"], "iphone")) {
			$device = "iphone";
		} elseif (stristr($_SERVER["HTTP_USER_AGENT"], "blackberry")) {
			$device = "blackberry";
		} elseif (stristr($_SERVER["HTTP_USER_AGENT"], "android")) {
			$device = "android";
		}

		if ($device) {
			return "mobile";
		}
		return false;
		return false;
	}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/templates/<?php echo $this->template; ?>/images/favicon.png" />
	<jdoc:include type="head" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" type="text/css" />
<?php if ($this->params->get("tagmanager")) { ?>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/system/css/joomla-fontawesome.min.css" />
<!-- Google Tag Manager -->
	<script>
		(function(w,d,s,l,i){
			w[l]=w[l]||[];
			w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});
			var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
			j.async=true;
			j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
			f.parentNode.insertBefore(j,f);
		})
		(window,document,'script','dataLayer','<?php echo $this->params->get("tagmanager"); ?>');
	</script>
	<!-- End Google Tag Manager -->
	<script>
jQuery( document ).ready(function() {
	var images = document.getElementsByClassName('main-image');
	var index;
	var image_height;
	var intro_height;

	for (index = 0; index < images.length; index++) {
		image_height = images[index].clientHeight;
		intro_height = document.getElementsByClassName('text-container')[index].clientHeight;

		if (image_height > intro_height) {
			document.getElementsByClassName('main-image')[index].getElementsByTagName("img")[0].height = intro_height;
		}
	}
});
	</script>
<?php } ?>
</head>
<body class="<?php echo $pageclass
	? htmlspecialchars($pageclass)
	: "default"; ?> <?php echo mobile_user_agent_switch(); ?>">
<?php if ($this->params->get("tagmanager")) { ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo $this->params->get("tagmanager"); ?>"
			height="0" width="0" style="display: none; visibility: hidden;">
		</iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->
<?php } ?>
	<div class="container">
		<div class="top">
			<div class="logo">
				<!-- FIX: use proper routing -->
				<a href="/<?php echo substr($lang->getTag(), 0, 2); ?>">
					<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/logo_liggend.png" alt="Gileba" />
				</a>
			</div>
			<div class="navigation">
				<jdoc:include type="modules" name="nav" style="none" />
			</div>
		</div>
		<div class="intro">
			<jdoc:include type="modules" name="intro" style="none" />
		</div>
		<?php if ($menu->getActive() == $menu->getDefault($lang->getTag())): ?>
		<div class="home">
			<jdoc:include type="modules" name="home" style="none" />
		</div>
		<?php endif; ?>
			<?php if ($menu->getActive() != $menu->getDefault($lang->getTag())): ?>
			<div class="component">
<jdoc:include type="component" style="none" />
		</div>
<?php endif; ?>	</div>
	<div id="contact" class="contact">
		<jdoc:include type="modules" name="contact" style="none" />
	</div>
	<div class="footer">
		<jdoc:include type="modules" name="footer" style="none" />
	</div>
</body>
</html>
