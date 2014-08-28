<?php
/**
 * BlackLight skin
 *
 * This is an blacklight skin showcasing the best practices, a companion to the MediaWiki skinning
 * guide available at <https://www.mediawiki.org/wiki/Manual:Skinning>.
 *
 * The code is released into public domain, which means you can freely copy it, modify and release
 * as your own skin without providing attribution and with absolutely no restrictions. Remember to
 * change the license information if you do not intend to provide your changes on the same terms.
 *
 * @file
 * @ingroup Skins
 * @author Calimonius the Estrange
 * @license I'unno
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This is an extension to the MediaWiki package and cannot be run standalone.' );
}

$wgExtensionCredits['skin'][] = array(
	'path' => __FILE__,
	'name' => 'BlackLight',
	'namemsg' => 'skinname-blacklight',
	'version' => '0.3.0',
	'url' => 'https://www.mediawiki.org/wiki/Skin:BlackLight',
	'author' => 'Calimonius the Estrange',
	'descriptionmsg' => 'blacklight-desc',
	'license' => 'GPLv2+',
);

$wgValidSkinNames['blacklight'] = 'BlackLight';

$wgAutoloadClasses['SkinBlackLight'] = __DIR__ . '/BlackLight.skin.php';
$wgMessagesDirs['BlackLight'] = __DIR__ . '/i18n';

$wgResourceModules['skins.blacklight'] = array(
	'styles' => array(
		'BlackLight/resources/main.less' => array( 'media' => 'screen' ),
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath' => &$GLOBALS['wgStyleDirectory'],
);
