function resetNavBarButtons()
{
	$("body header a").removeClass("active");
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

	if ($("body .page-contents .home").hasClass("hidden"))
		$("body .page-contents .home").removeClass("hidden");
}

function pageMenu(url)
{
	const queryIndex = url.indexOf("?query=");

	resetNavBarButtons();

	$("body header a[href='#menu']").addClass("active");

	if (!$("body .page-contents .home").hasClass("hidden"))
		$("body .page-contents .home").addClass("hidden");

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

	if ($("body .page-contents .home").hasClass("hidden"))
		$("body .page-contents .home").removeClass("hidden");
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