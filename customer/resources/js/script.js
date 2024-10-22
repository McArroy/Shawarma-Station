function resetNavBarButtons()
{
	$("body header a").removeClass("active");

	$("html, body").animate({ scrollTop: 0 }, 20);
}

function disabledPageHome()
{
	if (!$("body .page-contents .home").hasClass("hidden"))
		$("body .page-contents .home").addClass("hidden");

	if (!$("body .page-contents .about").hasClass("hidden"))
		$("body .page-contents .about").addClass("hidden");

	if (!$("body .page-contents .best-menu").hasClass("hidden"))
		$("body .page-contents .best-menu").addClass("hidden");
}

function enabledPageHome(flags)
{
	if ($("body .page-contents .home").hasClass("hidden"))
		$("body .page-contents .home").removeClass("hidden");

	if (flags === 1)
	{
		if ($("body .page-contents .about").hasClass("hidden"))
			$("body .page-contents .about").removeClass("hidden");
	
		if ($("body .page-contents .best-menu").hasClass("hidden"))
			$("body .page-contents .best-menu").removeClass("hidden");
	}
}

function pageHome()
{
	resetNavBarButtons();

	$("body header a[href='#home']").addClass("active");

	/* Just to make sure the hash changed to "#home" instead if the user or system not recognize the address */
	window.location.hash = "#home";

	if (!$("body .page-contents .home .left a.button.whatsapp").hasClass("hidden"))
		$("body .page-contents .home .left a.button.whatsapp").addClass("hidden");
	
	$("body .page-contents .home .left a.button.menu").removeClass("hidden");

	enabledPageHome(1);
}

function pageMenu(url)
{
	const queryIndex = url.indexOf("?query=");

	resetNavBarButtons();

	$("body header a[href='#menu']").addClass("active");

	disabledPageHome();

	if (queryIndex !== -1)
	{
		const queryValue = url.substring(queryIndex + 7);

		if (queryValue)
			alert(queryValue);
	}
}

function pageContact()
{
	resetNavBarButtons();

	$("body header a[href='#contact']").addClass("active");

	if (!$("body .page-contents .home .left a.button.menu").hasClass("hidden"))
		$("body .page-contents .home .left a.button.menu").addClass("hidden");

	$("body .page-contents .home .left a.button.whatsapp").removeClass("hidden");

	disabledPageHome();
	enabledPageHome(0);
}

$(document).ready(function()
{
	function checkHash()
	{
		var currentHash = window.location.hash;

		if ((currentHash === "#menu") || (/^#menu(\?query=.*)?$/.test(currentHash)))
			pageMenu(currentHash);
		else if (currentHash === "#contact")
			pageContact();
		else
			pageHome();
	}

	checkHash();

	$(window).on("hashchange", function()
	{
		checkHash();
	});
});