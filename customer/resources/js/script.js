$(document).ready(function()
{
	const QUERY_TYPE =
	{
		FOODS: 0,
		FOODS_SUBTYPES: 1,
		DRINKS: 2
	};

	const QUERY_FOODS_SUBTYPES =
	{
		PACKAGE: "1",
		SANDWICH: "2",
		SIDEORDERS: "3",
		BURGERS: "4"
	};

	function resetNavBarButtons()
	{
		$("body header .container a").removeClass("active");
		$("html, body").animate({ scrollTop: 0 }, 20);
	}

	function toggleVisibility(selector, show)
	{
		$(selector).toggleClass("hidden", !show);
	}

	function updateButtonState(button, selected)
	{
		button.toggleClass("button-selected", selected).toggleClass("button-unselected", !selected);
	}

	function pageHome()
	{
		resetNavBarButtons();

		$("body header .container a[href='/#home']").addClass("active");

		// Make sure reset the hash if page address is not valid
		window.location.hash = "#home";

		toggleVisibility("body .page-contents .home .left a.button.whatsapp", false);
		toggleVisibility("body .page-contents .home .left a.button.menu", true);
		enabledPageHome(1);
	}

	function disabledPageHome()
	{
		toggleVisibility("body .page-contents .home", false);
		toggleVisibility("body .page-contents .about", false);
		toggleVisibility("body .page-contents .best-menu", false);
	}

	function enabledPageHome(flags)
	{
		toggleVisibility("body .page-contents .home", true);
		toggleVisibility("body .page-contents .page-menu", false);

		if (flags === 1)
		{
			toggleVisibility("body .page-contents .about", true);
			toggleVisibility("body .page-contents .best-menu", true);
		}
	}

	function pageMenuQueries(type, subtype = 0)
	{
		const foodsButton = $("body .page-contents .page-menu .selections a.button.button-foods");
		const drinksButton = $("body .page-contents .page-menu .selections a.button.button-drinks");
		const subSelections = $("body .page-contents .page-menu .container .sub-selections");
		const isHidden = subSelections.hasClass("hidden");

		if (type === QUERY_TYPE.FOODS)
		{
			updateButtonState(foodsButton, true);
			toggleVisibility(subSelections, true);
			updateButtonState(drinksButton, false);

			toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods"), true);
			toggleVisibility($("body .page-contents .page-menu .contents-card .class-drinks"), false);

			if (subtype === QUERY_FOODS_SUBTYPES.PACKAGE)
			{
				toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods .card"), false);
				toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods .card.foods-subtypes-package"), true);
			}
			else if (subtype === QUERY_FOODS_SUBTYPES.SANDWICH)
			{
				toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods .card"), false);
				toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods .card.foods-subtypes-sandwich"), true);
			}
			else if (subtype === QUERY_FOODS_SUBTYPES.SIDEORDERS)
			{
				toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods .card"), false);
				toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods .card.foods-subtypes-sideorders"), true);
			}
			else if (subtype === QUERY_FOODS_SUBTYPES.BURGERS)
			{
				toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods .card"), false);
				toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods .card.foods-subtypes-burgers"), true);
			}
			else
			{
				toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods .card"), false);
				toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods .card"), true);
			}
		}
		else if (type === QUERY_TYPE.DRINKS)
		{
			updateButtonState(foodsButton, false);
			toggleVisibility(subSelections, false);
			updateButtonState(drinksButton, true);

			if (!isHidden)
				$("body .page-menu .selections a svg").removeClass("active");

			toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods"), false);
			toggleVisibility($("body .page-contents .page-menu .contents-card .class-drinks"), true);
		}
		else if (type === QUERY_TYPE.FOODS_SUBTYPES)
		{
			toggleVisibility(subSelections, isHidden);

			if (!isHidden)
				$("body .page-menu .selections a svg").removeClass("active");
			else
				$("body .page-menu .selections a svg").addClass("active");

			toggleVisibility($("body .page-contents .page-menu .contents-card .class-foods"), true);
			toggleVisibility($("body .page-contents .page-menu .contents-card .class-drinks"), false);
		}

		for (let i = 1; i <= 4; i++)
		{
			const button = $(`body .page-menu .container .sub-selections a.button.button-foods#foods-subtype-button-${i}`);
			const buttonSelected = $(`body .page-menu .container .sub-selections a.button.button-foods#foods-subtype-button-${subtype}`);

			updateButtonState(button, false);
			updateButtonState(buttonSelected, true);
		}
	}

	function pageMenu(url)
	{
		const queryIndex = url.indexOf("?query=");

		resetNavBarButtons();

		$("body header .container a[href='/#menu?query=foods']").addClass("active");

		disabledPageHome();

		toggleVisibility("body .page-contents .page-menu", true);

		$(".page-menu .selections a.button.button-foods").off("click").on("click", function()
		{
			pageMenuQueries(QUERY_TYPE.FOODS_SUBTYPES);
		});

		if (queryIndex !== -1)
		{
			const queryValue = url.substring(queryIndex + 7);

			if (queryValue === "drinks")
			{
				pageMenuQueries(QUERY_TYPE.DRINKS);
			}
			else
			{
				const queryFoodIndex = url.indexOf("?query=foods&subtype=");

				if (queryFoodIndex !== -1)
				{
					const queryFoodValue = url.substring(queryFoodIndex + 21);
					pageMenuQueries(QUERY_TYPE.FOODS, queryFoodValue);
				}
				else
				{
					pageMenuQueries(QUERY_TYPE.FOODS);
					pageMenuQueries(QUERY_TYPE.FOODS_SUBTYPES);
				}
			}
		}
		else
		{
			pageMenuQueries(QUERY_TYPE.FOODS);
			pageMenuQueries(QUERY_TYPE.FOODS_SUBTYPES);
		}
	}

	function pageContact()
	{
		resetNavBarButtons();

		$("body header .container a[href='/#contact']").addClass("active");

		toggleVisibility("body .page-contents .home .left a.button.menu", false);
		toggleVisibility("body .page-contents .home .left a.button.whatsapp", true);

		disabledPageHome();
		enabledPageHome(0);
	}

	function checkHash()
	{
		const currentHash = window.location.hash;

		if (currentHash === "#menu" || /^#menu(\?query=.*)?$/.test(currentHash))
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

	$("body header .menu-icon").on("click", function()
	{
		if ($("body header .menu-icon").hasClass("active"))
		{
			$("body header .menu-icon").removeClass("active");
			$("body header .container").removeClass("active-mobile");
		}
		else
		{
			$("body header .menu-icon").addClass("active");
			$("body header .container").addClass("active-mobile");
		}
	});

	$("body header .container a").on("click", function()
	{
		if ($("body header .menu-icon").hasClass("active"))
		{
			$("body header .menu-icon").click();
		}
	});
});