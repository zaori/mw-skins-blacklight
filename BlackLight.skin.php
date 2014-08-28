<?php
/**
 * Skin file for the BlackLight skin.
 *
 * @file
 * @ingroup Skins
 */

/**
 * SkinTemplate class for the BlackLight skin
 *
 * @ingroup Skins
 */
class SkinBlackLight extends SkinTemplate {
	var $skinname = 'blacklight', $stylename = 'BlackLight',
		$template = 'BlackLightTemplate', $useHeadElement = true;

	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param $out OutputPage
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( array(
			'skins.blacklight'
		) );
	}
}

/**
 * BaseTemplate class for the BlackLight skin
 *
 * @ingroup Skins
 */
class BlackLightTemplate extends BaseTemplate {
	/**
	 * Outputs a single sidebar portlet of any kind.
	 */
	private function outputPortlet( $box ) {
		if ( !$box['content'] ) {
			return;
		}

		?>
		<div
			id="<?php echo Sanitizer::escapeId( $box['id'] ) ?>"
			<?php echo Linker::tooltip( $box['id'] ) ?>
			class="portlet"
		>
			<h3>
				<?php
				if ( isset( $box['headerMessage'] ) ) {
					$this->msg( $box['headerMessage'] );
				} else {
					echo htmlspecialchars( $box['header'] );
				}
				?>
			</h3>

			<?php
			if ( is_array( $box['content'] ) ) {
				echo '<ul>';
				foreach ( $box['content'] as $key => $item ) {
					echo $this->makeListItem( $key, $item );
				}
				echo '</ul>';
			} else {
				echo $box['content'];
			}?>
		</div>
		<?php
	}

	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		?>

		<?php $this->html( 'headelement' ) ?>

		<div id="mw-container">
			<div id="mw-banner">
			<div id="mw-banner-inner">
				<div id="mw-navigation-personal">
					<?php
					$this->outputPortlet( array(
						'id' => 'p-personal',
						'headerMessage' => 'personaltools',
						'content' => $this->getPersonalTools(),
					) );
					?>
				</div>
				<a
					role="banner"
					href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] ) ?>"
					<?php echo Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( 'p-logo' ) ) ?>
				>
					<div id="mw-site-logo">
						<img
							src="<?php $this->text( 'logopath' ) ?>"
							alt="<?php $this->text( 'sitename' ) ?>"
						/>
					</div>
					<div id="mw-site-banner">
						<h2><?php echo wfMessage( 'sitetitle' )->escaped() ?></h2>
					</div>
				</a>
				<div id="mw-site-banner-sub"><?php echo wfMessage( 'sitesubtitle' )->escaped() ?></div>
				<div id="mw-navigation-search">
					<form action="<?php $this->text( 'wgScript' ) ?>" id="p-search" role="search">
						<input type="hidden" name="title" value="<?php $this->text( 'searchtitle' ) ?>" />

						<h3><label for="searchInput"><?php $this->msg( 'search' ) ?></label></h3>

						<?php echo $this->makeSearchInput( array( "id" => "searchInput" ) ) ?>
						<?php echo $this->makeSearchButton( 'go' ) ?>

					</form>
				</div>
				<div class="visualclear"></div>
			</div>
			</div>
			<div id="mw-body-container">
			<div id="mw-body-container-inner">
				<div id="mw-navigation" role="navigation">
				<div id="mw-navigation-inner">
					<h2><?php $this->msg( 'navigation-heading' ) ?></h2>

					<div id="mw-navigation-sitewide">
						<div id="mw-navigation-main">
							<?php
							foreach ( $this->getSidebar() as $boxName => $box ) {
								$this->outputPortlet( $box );
							}
							?>
						</div>
					</div>

				</div>
				</div>
				<div id="mw-content-wrapper">
				<div id="mw-content-wrapper-inner">
					<div id="mw-page-header">
						<div id="mw-notices">
							<?php if ( $this->data['sitenotice'] ) { ?>
								<div id="siteNotice"><?php $this->html( 'sitenotice' ) ?></div>
							<?php } ?>

							<?php if ( $this->data['newtalk'] ) { ?>
								<div class="usermessage"><?php $this->html( 'newtalk' ) ?></div>
							<?php } ?>
						</div>

						<h1 id="firstHeading" class="firstHeading">
							<span dir="auto"><?php $this->html( 'title' ) ?></span>
						</h1>

						<div id="mw-navigation-pagetabs">
							<?php
							$this->outputPortlet( array(
								'id' => 'p-namespaces',
								'headerMessage' => 'namespaces',
								'content' => $this->data['content_navigation']['namespaces'],
							) );
							?>
						</div>
					</div>
					<div id="mw-page-tools">
					<div id="mw-page-tools-inner">
						<div id="mw-navigation-pagetools">
							<div id="mw-navigation-pagevariants">
								<?php
								$this->outputPortlet( array(
									'id' => 'p-variants',
									'headerMessage' => 'variants',
									'content' => $this->data['content_navigation']['variants'],
								) );
								?>
							</div>
							<div id="mw-navigation-pageactions">
								<?php
								$this->outputPortlet( array(
									'id' => 'p-actions',
									'headerMessage' => 'actions',
									'content' => $this->data['content_navigation']['actions'],
								) );
								?>
							</div>
							<div id="mw-navigation-pageviews">
								<?php
								$this->outputPortlet( array(
									'id' => 'p-views',
									'headerMessage' => 'views',
									'content' => $this->data['content_navigation']['views'],
								) );
								?>
							</div>
						</div>
					</div>
					</div>
					<div class="mw-body" id="mw-body" role="main">
					<div id="mw-body-inner">
						<div id="siteSub"><?php $this->msg( 'tagline' ) ?></div>

						<div class="mw-body-content">
							<div id="contentSub">
								<?php if ( $this->data['subtitle'] ) { ?>
									<p><?php $this->html( 'subtitle' ) ?></p>
								<?php } ?>
								<?php if ( $this->data['undelete'] ) { ?>
									<p><?php $this->html( 'undelete' ) ?></p>
								<?php } ?>
							</div>

							<?php $this->html( 'bodytext' ) ?>

						</div>

						<?php $this->html( 'catlinks' ) ?>

						<?php $this->html( 'dataAfterContent' ); ?>
						<div class="visualclear"></div>
					</div>
					</div>
					<div class="visualclear"></div>
				</div>
				</div>
			</div>
			</div>

			<div id="mw-footer">
			<div id="mw-footer-inner">
				<div id="mw-footer-info">
					<ul role="contentinfo">
						<?php foreach ( $this->getFooterIcons( 'icononly' ) as $blockName => $footerIcons ) { ?>
							<li>
								<?php
								foreach ( $footerIcons as $icon ) {
									echo $this->getSkin()->makeFooterIcon( $icon );
								}
								?>
							</li>
						<?php } ?>
					</ul>
				</div>
				<div id="mw-footer-links">
					<?php foreach ( $this->getFooterLinks() as $category => $links ) { ?>
						<ul role="contentinfo">
							<?php foreach ( $links as $key ) { ?>
								<li><?php $this->html( $key ) ?></li>
							<?php } ?>
						</ul>
					<?php } ?>
				</div>
			</div>
			</div>
		</div>

		<?php $this->printTrail() ?>
		</body></html>

		<?php
	}
}
