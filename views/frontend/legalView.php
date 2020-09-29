<?php
$title = "Mentions légales";
?>

<?php ob_start(); ?>

<section id="legal">
	<div class="column"></div>
	<div class="blank">
		<h1>Mentions légales</h1>
		<p>
			Le présent site est la propriété de Nicolas Romanovitch.<br />
			Mail : <a href="mailto:nromanovitch@gmail.com">nromanovitch@gmail.com</a>
		</p>
		<p>
			Hébergeur :<br />
			1&1 IONOS SARL<br />
			7 Place de la Gare, 57200 SARREGUEMINES<br />
			09 70 80 89 11
		</p>
		<p>
			L’utilisation du présent site implique l’acceptation pleine et entière des conditions générales d’utilisation décrites ci-après. Ces conditions d’utilisation sont susceptibles d’être modifiées ou complétées à tout moment.
		</p>

		<h2>Conditions d'utilisations</h2>
		<p>
			L’utilisation du présent site implique l’acceptation pleine et entière des conditions générales d’utilisation décrites ci-après. Ces conditions d’utilisation sont susceptibles d’être modifiées ou complétées à tout moment.
		</p>
		<h3>Interactivité</h3>
		<p>
			Les utilisateurs du site peuvent éventuellement y déposer du contenu, apparaissant sur le site dans des espaces dédiés. Le contenu déposé reste sous la responsabilité de leurs auteurs, qui en assument pleinement l’entière responsabilité juridique.<br />
			Le propriétaire du site se réserve le droit de retirer sans préavis et sans justification tout contenu déposé par les utilisateurs qui ne satisferait pas à la charte déontologique du site, ou à la législation en vigueur.
		</p>
		<h3>Propriété intellectuelle</h3>
		<p>
			Sauf mention contraire, tous les éléments accessibles sur ce site restent la propriété exclusive de leurs auteurs, en ce qui concerne les droits de propriété intellectuelle, ou les droits d’usage.<br />
			Toute reproduction, représentation, modification, publication, adaptation de tout ou d'une partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de l’auteur.<br />
			Toute exploitation non autorisée du site ou de l’un quelconque des éléments qu’il contient est considérée comme constitutive d’une contrefaçon et peut être poursuivie en justice.
		</p>
		<h3>Liens sortants</h3>
		<p>
			La présence de liens hypertexte renvoyant vers d’autres sites ne constitue pas une garantie sur la qualité de contenu et de bon fonctionnement des dits sites. Notre responsabilité ne saurait être engagée quant au contenu de ces sites.<br />
			L’internaute doit utiliser ces informations avec les précautions d’usage.
		</p>
		<h3>Confidentialité</h3>
		<p>
			Tout utilisateur dispose d’un droit d’accès, de rectification et d’opposition aux données personnelles le concernant, en effectuant sa demande écrite et signée, accompagnée d’une preuve d’identité.<br />
			Ce site ne recueille pas d’informations personnelles, et n’est donc pas assujetti à déclaration à la CNIL.
		</p>
		<h3>Cookies</h3>
		<p>
			Le présent site peut-être amené à vous demander l’acceptation des cookies pour des besoins de statistiques. Ces cookies analysent le taux de fréquentation des internautes et identifient les éventuels soucis de navigation.<br />
			Un cookie est une information déposée sur votre navigateur par le serveur du site que vous visitez. Il contient plusieurs données qui sont stockées dans un simple fichier texte auquel un serveur accède pour lire et enregistrer des informations.<br />
			Ces cookies sont valables pour une durée de 12 mois au maximum, et peuvent être supprimés à tout moment dans les paramètres du navigateur.
		</p>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('frontendTemplate.php'); ?>